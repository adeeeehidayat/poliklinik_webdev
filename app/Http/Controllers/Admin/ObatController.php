<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat; // Model untuk data obat

class ObatController extends Controller
{
    // Menampilkan daftar obat
    public function index()
    {
        $obats = Obat::all();  // Ambil semua data obat
        return view('admin.obat.index', compact('obats')); // Kirim data ke view
    }

    // Menampilkan form untuk membuat obat baru
    public function create()
    {
        return view('admin.obat.create'); // Tampilkan form untuk menambah obat
    }

    // Menyimpan obat baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama_obat' => 'required|string|max:50',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|integer',
        ]);

        Obat::create($request->all());  // Simpan data obat
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan'); // Redirect dengan pesan sukses
    }

    // Menampilkan form untuk mengedit data obat
    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat')); // Kirim data obat ke view
    }

    // Memperbarui data obat
    public function update(Request $request, Obat $obat)
    {
        // Validasi input dari form
        $request->validate([
            'nama_obat' => 'required|string|max:50',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|integer',
        ]);

        $obat->update($request->all());  // Perbarui data obat
        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui'); // Redirect dengan pesan sukses
    }

    // Menghapus obat
    public function destroy(Obat $obat)
    {
        $obat->delete();  // Hapus data obat
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus'); // Redirect dengan pesan sukses
    }
}