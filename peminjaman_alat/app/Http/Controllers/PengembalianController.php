<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Menampilkan seluruh riwayat pengembalian alat.
     * Halaman ini khusus untuk dipantau oleh Petugas.
     */
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->where('status', 'dikembalikan')
            ->whereNotNull('tanggal_dikembalikan')
            ->latest('tanggal_dikembalikan')
            ->get();

        // Statistik pengembalian.
        $totalPengembalian = $peminjamans->count();

        $totalTerlambat = $peminjamans->filter(function ($peminjaman) {
            return (int) $peminjaman->denda > 0;
        })->count();

        $totalDenda = $peminjamans->sum('denda');

        return view('pengembalian.index', compact(
            'peminjamans',
            'totalPengembalian',
            'totalTerlambat',
            'totalDenda'
        ));
    }

    /**
     * Menampilkan detail satu transaksi pengembalian.
     */
    public function show(Peminjaman $peminjaman)
    {
        abort_unless($peminjaman->status === 'dikembalikan', 404);

        $peminjaman->load(['user', 'alat']);

        return view('pengembalian.show', compact('peminjaman'));
    }
}
