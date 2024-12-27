<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter; // Model untuk data dokter
use App\Models\Poli;   // Model untuk data poli
use Illuminate\Http\Request;

class DokterController extends Controller
{
    // Menampilkan daftar dokter
    public function index()
    {
        $dokters = Dokter::all();  // Ambil semua data dokter
        return view('admin.dokter.index', compact('dokters')); // Kirim data ke view
    }

    // Menampilkan form untuk membuat dokter baru
    public function create()
    {
        $polis = Poli::all();  // Ambil semua data poli untuk dropdown
        return view('admin.dokter.create', compact('polis')); // Kirim data poli ke view
    }

    // Menyimpan dokter baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:150',
            'username' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string',
            'password' => 'required|string|max:100',
            'id_poli' => 'required|exists:poli,id', // Validasi id_poli harus ada di tabel poli
        ]);

        Dokter::create($request->all());  // Simpan data dokter

        return redirect()->route('dokter.index')->with('success', 'Dokter baru berhasil ditambahkan!'); // Redirect dengan pesan sukses
    }

    // Menampilkan form untuk mengedit data dokter
    public function edit(Dokter $dokter)
    {
        $polis = Poli::all();  // Ambil semua data poli untuk dropdown
        return view('admin.dokter.edit', compact('dokter', 'polis')); // Kirim data dokter dan poli ke view
    }

    // Memperbarui data dokter
    public function update(Request $request, Dokter $dokter)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:150',
            'username' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string',
            'password' => 'required|string|max:100',
            'id_poli' => 'required|exists:poli,id',
        ]);

        $dokter->update($request->all());  // Perbarui data dokter
        
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil di edit!'); // Redirect dengan pesan sukses
    }

    // Menghapus dokter
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();  // Hapus data dokter
        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus'); // Redirect dengan pesan sukses
    }
}