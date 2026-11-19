<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $role = auth()->user()->role;

        abort_unless(
            in_array($role, ['admin', 'petugas', 'peminjam']),
            403
        );

        $query = Peminjaman::with(['user', 'alat'])->latest();

        if ($role === 'peminjam') {
            $query->where('user_id', auth()->id());
        }

        $statusDiizinkan = [
            'menunggu',
            'disetujui',
            'ditolak',
            'dikembalikan'
        ];

        if (
            $request->filled('status') &&
            in_array($request->status, $statusDiizinkan)
        ) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal_awal')) {
            $query->whereDate(
                'tanggal_pinjam',
                '>=',
                $request->tanggal_awal
            );
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate(
                'tanggal_pinjam',
                '<=',
                $request->tanggal_akhir
            );
        }

        $totalTransaksi = (clone $query)->count();

        $totalPengembalian = (clone $query)
            ->where('status', 'dikembalikan')
            ->count();

        $totalDenda = (clone $query)->sum('denda');

        $peminjamans = $query->paginate(15)->withQueryString();

        return view('laporan.index', compact(
            'peminjamans',
            'totalTransaksi',
            'totalPengembalian',
            'totalDenda',
            'role'
        ));
    }

    // Khusus Petugas yang boleh mencetak nota
    public function nota(Peminjaman $peminjaman)
    {
        abort_unless(auth()->user()->role === 'petugas', 403);

        $peminjaman->load(['user', 'alat']);

        return view('laporan.nota', compact('peminjaman'));
    }
}
