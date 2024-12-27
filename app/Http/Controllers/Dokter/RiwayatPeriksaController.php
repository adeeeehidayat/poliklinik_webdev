<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\Periksa;

class RiwayatPeriksaController extends Controller
{
    public function index()
    {
        $dokter = session('dokter');

        // Ambil daftar pasien unik berdasarkan dokter yang sedang login
        $daftarPasien = DaftarPoli::whereHas('jadwal', function ($query) use ($dokter) {
            $query->where('id_dokter', $dokter->id);
        })->with('pasien')
          ->get()
          ->unique('id_pasien');

        return view('dokter.riwayat_periksa.index', compact('daftarPasien'));
    }

    public function detail($id)
    {
        $dokter = session('dokter');

        // Ambil riwayat pemeriksaan pasien berdasarkan dokter yang sedang login
        $riwayatPeriksa = Periksa::whereHas('daftarPoli.jadwal', function ($query) use ($dokter) {
            // Memfilter hanya untuk jadwal yang terkait dengan dokter yang sedang login
            $query->where('id_dokter', $dokter->id);
        })
        ->whereHas('daftarPoli', function ($query) use ($id) {
            // Memfilter hanya untuk poli yang terkait dengan pasien tertentu
            $query->where('id_pasien', $id);
        })
        // Mengambil data terkait dengan relasi yang ditentukan
        ->with(['daftarPoli.pasien', 'detailPeriksa.obat'])
        // Mengeksekusi query dan mendapatkan hasilnya
        ->get();

        return view('dokter.riwayat_periksa.detail', compact('riwayatPeriksa'));
    }
}
