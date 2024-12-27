<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    // Menampilkan daftar pasien
    public function index()
    {
        $pasiens = Pasien::all();  // Ambil semua data pasien
        return view('admin.pasien.index', compact('pasiens'));
    }

    // Menampilkan form untuk membuat pasien baru
    public function create()
    {
        return view('admin.pasien.create');
    }

    // Menyimpan pasien baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'username' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string',
            'no_hp' => 'required|string',
            'password' => 'required|string|max:100',
        ]);

        // Mendapatkan tahun dan bulan saat ini
        $tahunBulan = now()->format('Ym'); // Format: YYYYMM

        // Menghitung jumlah pasien yang sudah terdaftar
        $urutanPasien = Pasien::count() + 1;  // Jumlah pasien + 1 untuk urutan pasien baru

        // Membuat nomor RM dengan format TahunBulan-UrutanPasien
        $no_rm = $tahunBulan . '-' . str_pad($urutanPasien, 3, '0', STR_PAD_LEFT); // Misal: 202411-101

        // Menambahkan no_rm ke dalam data pasien
        $data = $request->all();
        $data['no_rm'] = $no_rm;

        // Menyimpan data pasien ke database
        Pasien::create($data);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit data pasien
    public function edit(Pasien $pasien)
    {
        return view('admin.pasien.edit', compact('pasien'));
    }

    // Memperbarui data pasien
    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'username' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string',
            'no_hp' => 'required|string',
            'password' => 'required|string|max:100',
            'no_rm' => 'required|string',
        ]);

        $pasien->update($request->all());  // Perbarui data pasien
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diperbarui');
    }

    // Menghapus pasien
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();  // Hapus data pasien
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus');
    }
}
