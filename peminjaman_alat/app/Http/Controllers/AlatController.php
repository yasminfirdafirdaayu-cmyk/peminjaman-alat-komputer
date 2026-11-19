<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    // DAFTAR ALAT
    public function index()
    {
        $alats = Alat::with('kategori')->get();

        return view('alat.index', compact('alats'));
    }

    // FORM TAMBAH
    public function create()
    {
        $kategori = Kategori::all();

        return view('alat.create', compact('kategori'));
    }

    // SIMPAN ALAT
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
        ]);

        Alat::create([
            'nama_alat' => $request->nama_alat,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'kondisi' => $request->kondisi,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil ditambahkan.');
    }

    // FORM EDIT
    public function edit($id)
    {
        $alat = Alat::findOrFail($id);

        $kategoris = Kategori::all();

        return view('alat.edit', compact('alat', 'kategoris'));
    }

    // UPDATE ALAT
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
        ]);

        $alat = Alat::findOrFail($id);

        $alat->update([
            'nama_alat' => $request->nama_alat,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'kondisi' => $request->kondisi,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil diperbarui.');
    }

    // HAPUS ALAT
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);

        $alat->delete();

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil dihapus.');
    }
}
