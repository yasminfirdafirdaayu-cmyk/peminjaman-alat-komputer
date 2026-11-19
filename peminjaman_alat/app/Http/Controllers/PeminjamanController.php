<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // ==========================================
    // FUNGSI MENCATAT LOG AKTIVITAS
    // ==========================================

    private function catatAktivitas($aktivitas, $deskripsi)
    {
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => $aktivitas,
            'deskripsi' => $deskripsi,
            'ip_address' => request()->ip(),
        ]);
    }

    // ==========================================
    // PEMINJAMAN UNTUK PETUGAS
    // ==========================================

    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    // ==========================================
    // FORM PENGAJUAN PEMINJAMAN
    // ==========================================

    public function create(Alat $alat)
    {
        if ($alat->stok < 1) {
            return redirect()
                ->route('pengguna.alat')
                ->with('error', 'Stok alat sedang habis.');
        }

        return view('peminjaman.create', compact('alat'));
    }

    // ==========================================
    // MENYIMPAN PENGAJUAN PEMINJAMAN
    // ==========================================

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali' => 'required|date|after_or_equal:today',
        ], [
            'jumlah.required' => 'Jumlah alat wajib diisi.',
            'jumlah.integer' => 'Jumlah alat harus berupa angka.',
            'jumlah.min' => 'Jumlah alat minimal 1.',
            'tanggal_kembali.required' => 'Tanggal pengembalian wajib diisi.',
            'tanggal_kembali.after_or_equal' => 'Tanggal pengembalian tidak boleh sebelum hari ini.',
        ]);

        $alat = Alat::findOrFail($validated['alat_id']);

        if ($validated['jumlah'] > $alat->stok) {
            return back()
                ->withInput()
                ->with('error', 'Jumlah yang diminta melebihi stok tersedia.');
        }

        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $alat->id,
            'jumlah' => $validated['jumlah'],
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => 'menunggu',
        ]);

        $this->catatAktivitas(
            'Mengajukan Peminjaman',
            auth()->user()->name .
            ' mengajukan peminjaman alat ' .
            $alat->nama_alat .
            ' sebanyak ' .
            $validated['jumlah'] .
            ' unit. ID transaksi: ' .
            $peminjaman->id
        );

        return redirect()
            ->route('pengguna.alat')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim. Silakan tunggu persetujuan petugas.');
    }

    // ==========================================
    // MENYETUJUI PENGAJUAN OLEH PETUGAS
    // ==========================================

    public function setujui(Peminjaman $peminjaman)
    {
        $hasil = DB::transaction(function () use ($peminjaman) {
            $data = Peminjaman::whereKey($peminjaman->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($data->status !== 'menunggu') {
                return 'sudah_diproses';
            }

            $alat = Alat::whereKey($data->alat_id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($alat->stok < $data->jumlah) {
                return 'stok_kurang';
            }

            $alat->decrement('stok', $data->jumlah);

            $data->update([
                'status' => 'disetujui',
            ]);

            return 'berhasil';
        });

        if ($hasil === 'stok_kurang') {
            return back()->with('error', 'Stok alat tidak mencukupi. Pengajuan tidak dapat disetujui.');
        }

        if ($hasil === 'sudah_diproses') {
            return back()->with('error', 'Pengajuan ini sudah pernah diproses.');
        }

        $peminjaman->load(['user', 'alat']);

        $this->catatAktivitas(
            'Menyetujui Peminjaman',
            auth()->user()->name .
            ' menyetujui peminjaman milik ' .
            $peminjaman->user->name .
            ' untuk alat ' .
            $peminjaman->alat->nama_alat .
            ' sebanyak ' .
            $peminjaman->jumlah .
            ' unit. ID transaksi: ' .
            $peminjaman->id
        );

        return back()->with('success', 'Pengajuan peminjaman berhasil disetujui.');
    }

    // ==========================================
    // MENOLAK PENGAJUAN OLEH PETUGAS
    // ==========================================

    public function tolak(Peminjaman $peminjaman)
    {
        $hasil = DB::transaction(function () use ($peminjaman) {
            $data = Peminjaman::whereKey($peminjaman->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($data->status !== 'menunggu') {
                return false;
            }

            $data->update([
                'status' => 'ditolak',
            ]);

            return true;
        });

        if (!$hasil) {
            return back()->with('error', 'Pengajuan ini sudah pernah diproses.');
        }

        $peminjaman->load(['user', 'alat']);

        $this->catatAktivitas(
            'Menolak Peminjaman',
            auth()->user()->name .
            ' menolak peminjaman milik ' .
            $peminjaman->user->name .
            ' untuk alat ' .
            $peminjaman->alat->nama_alat .
            '. ID transaksi: ' .
            $peminjaman->id
        );

        return back()->with('success', 'Pengajuan peminjaman berhasil ditolak.');
    }

    // ==========================================
    // RIWAYAT PEMINJAMAN MILIK PEMINJAM
    // ==========================================

    public function saya()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('peminjaman.saya', compact('peminjamans'));
    }

    // ==========================================
    // MENAMPILKAN FORM DAN RIWAYAT PENGEMBALIAN
    // ==========================================

    public function pengajuanSaya()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->whereIn('status', [
                'disetujui',
                'dikembalikan',
            ])
            ->latest()
            ->get();

        return view(
            'pengembalian.peminjam.index',
            compact('peminjamans')
        );
    }

    // ==========================================
    // PEMINJAM MENCATAT PENGEMBALIAN ALAT
    // ==========================================

    public function ajukanPengembalian(
        Request $request,
        Peminjaman $peminjaman
    ) {
        $validated = $request->validate([
            'catatan_transaksi' => 'required|string|max:1000',
            'kondisi_pengembalian' => 'required|in:baik,rusak_ringan,rusak_berat',
        ], [
            'catatan_transaksi.required' => 'Catatan pengembalian wajib diisi.',
            'catatan_transaksi.max' => 'Catatan maksimal 1000 karakter.',
            'kondisi_pengembalian.required' => 'Kondisi alat wajib dipilih.',
            'kondisi_pengembalian.in' => 'Pilihan kondisi alat tidak valid.',
        ]);

        if ((int) $peminjaman->user_id !== (int) auth()->id()) {
            abort(403, 'Kamu tidak memiliki akses ke transaksi ini.');
        }

        $hasil = DB::transaction(function () use (
            $peminjaman,
            $validated
        ) {
            $data = Peminjaman::whereKey($peminjaman->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (
                (int) $data->user_id !== (int) auth()->id() ||
                $data->status !== 'disetujui'
            ) {
                return [
                    'status' => 'sudah_diproses',
                ];
            }

            $alat = Alat::whereKey($data->alat_id)
                ->lockForUpdate()
                ->firstOrFail();

            $tanggalAktual = Carbon::today();

            $tanggalJatuhTempo = Carbon::parse(
                $data->tanggal_kembali
            )->startOfDay();

            $hariTerlambat = 0;

            if ($tanggalAktual->greaterThan($tanggalJatuhTempo)) {
                $hariTerlambat = (int) $tanggalJatuhTempo
                    ->diffInDays($tanggalAktual);
            }

            // Denda Rp10.000 per hari, tidak berdasarkan jumlah unit.
            $dendaPerHari = 10000;

            $denda = $hariTerlambat * $dendaPerHari;    

            $data->update([
                'tanggal_dikembalikan' => $tanggalAktual->toDateString(),
                'catatan_transaksi' => $validated['catatan_transaksi'],
                'kondisi_pengembalian' => $validated['kondisi_pengembalian'],
                'denda' => $denda,
                'status' => 'dikembalikan',
            ]);

            $alat->increment('stok', $data->jumlah);

            return [
                'status' => 'berhasil',
                'denda' => $denda,
                'alat' => $alat->nama_alat,
                'jumlah' => $data->jumlah,
                'peminjaman_id' => $data->id,
            ];
        });

        if ($hasil['status'] === 'sudah_diproses') {
            return back()->with(
                'error',
                'Pengembalian ini sudah pernah dicatat atau transaksi belum disetujui.'
            );
        }

        $this->catatAktivitas(
            'Mengajukan Pengembalian',
            auth()->user()->name .
            ' mengembalikan alat ' .
            $hasil['alat'] .
            ' sebanyak ' .
            $hasil['jumlah'] .
            ' unit. Total denda: Rp' .
            number_format($hasil['denda'], 0, ',', '.') .
            '. ID transaksi: ' .
            $hasil['peminjaman_id']
        );

        return redirect()
            ->route('pengembalian.peminjam.index')
            ->with(
                'success',
                'Pengembalian berhasil dicatat. Total denda: Rp' .
                number_format($hasil['denda'], 0, ',', '.')
            );
    }

    // ==========================================
    // PENGELOLAAN PEMINJAMAN OLEH ADMIN
    // ==========================================

    public function adminIndex(Request $request)
    {
        $query = Peminjaman::with(['user', 'alat'])
            ->latest();

        $statusDiizinkan = [
            'menunggu',
            'disetujui',
            'ditolak',
            'dikembalikan',
        ];

        if (
            $request->filled('status') &&
            in_array($request->status, $statusDiizinkan)
        ) {
            $query->where('status', $request->status);
        }

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->whereHas('user', function ($user) use ($cari) {
                    $user->where('name', 'like', "%{$cari}%");
                })->orWhereHas('alat', function ($alat) use ($cari) {
                    $alat->where('nama_alat', 'like', "%{$cari}%");
                });
            });
        }

        $peminjamans = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.peminjaman.index',
            compact('peminjamans')
        );
    }

    // ==========================================
    // HAPUS PENGAJUAN OLEH ADMIN
    // ==========================================

    public function adminDestroy(Peminjaman $peminjaman)
    {
        if (!in_array($peminjaman->status, ['menunggu', 'ditolak'])) {
            return back()->with(
                'error',
                'Data yang sudah disetujui atau dikembalikan tidak boleh dihapus.'
            );
        }

        $peminjaman->load(['user', 'alat']);

        $deskripsi = auth()->user()->name .
            ' menghapus data peminjaman milik ' .
            $peminjaman->user->name .
            ' untuk alat ' .
            $peminjaman->alat->nama_alat .
            '. ID transaksi: ' .
            $peminjaman->id;

        $peminjaman->delete();

        $this->catatAktivitas(
            'Menghapus Data Peminjaman',
            $deskripsi
        );

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}