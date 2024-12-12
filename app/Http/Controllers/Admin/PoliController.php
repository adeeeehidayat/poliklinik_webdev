<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;

class PoliController extends Controller
{
    // Menampilkan daftar poli
    public function index()
    {
        $polis = Poli::all();  // Ambil semua data poli
        return view('admin.poli.index', compact('polis'));
    }

    // Menampilkan form untuk membuat poli baru
    public function create()
    {
        return view('admin.poli.create');
    }

    // Menyimpan poli baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:25',
            'keterangan' => 'required|string|max:255',
        ]);

        Poli::create($request->all());  // Simpan data poli
        return redirect()->route('poli.index')->with('success', 'Poli berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit data poli
    public function edit(Poli $poli)
    {
        return view('admin.poli.edit', compact('poli'));
    }

    // Memperbarui data poli
    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:25',
            'keterangan' => 'required|string|max:255',
        ]);

        $poli->update($request->all());  // Perbarui data poli
        return redirect()->route('poli.index')->with('success', 'Poli berhasil diperbarui');
    }

    // Menghapus poli
    public function destroy(Poli $poli)
    {
        $poli->delete();  // Hapus data poli
        return redirect()->route('poli.index')->with('success', 'Poli berhasil dihapus');
    }
}
