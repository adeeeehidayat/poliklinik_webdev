<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    // Menampilkan daftar obat
    public function index()
    {
        $obats = Obat::all();  // Ambil semua data obat
        return view('admin.obat.index', compact('obats'));
    }

    // Menampilkan form untuk membuat pasien baru
    public function create()
    {
        return view('admin.obat.create');
    }

    // Menyimpan obat baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:50',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|integer',
        ]);

        Obat::create($request->all());  // Simpan data obat
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit data obat
    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat'));
    }

    // Memperbarui data obat
    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:50',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|integer',
        ]);

        $obat->update($request->all());  // Perbarui data obat
        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui');
    }

    // Menghapus obat
    public function destroy(Obat $obat)
    {
        $obat->delete();  // Hapus data obat
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus');
    }
}
