<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    // Menampilkan daftar dokter
    public function index()
    {
        $dokters = Dokter::all();  // Ambil semua data dokter
        return view('admin.dokter.index', compact('dokters'));
    }

    // Menampilkan form untuk membuat dokter baru
    public function create()
    {
        $polis = Poli::all();  // Ambil semua data poli untuk dropdown
        return view('admin.dokter.create', compact('polis'));
    }

    // Menyimpan dokter baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'username' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|integer',
            'password' => 'required|string|max:100',
            'id_poli' => 'required|exists:poli,id', // Validasi id_poli harus ada di tabel poli
        ]);

        Dokter::create($request->all());  // Simpan data dokter
        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit data dokter
    public function edit(Dokter $dokter)
    {
        $polis = Poli::all();  // Ambil semua data poli untuk dropdown
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    // Memperbarui data dokter
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'username' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|integer',
            'password' => 'required|string|max:100',
            'id_poli' => 'required|exists:poli,id',
        ]);

        $dokter->update($request->all());  // Perbarui data dokter
        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil diperbarui');
    }

    // Menghapus dokter
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();  // Hapus data dokter
        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus');
    }
}