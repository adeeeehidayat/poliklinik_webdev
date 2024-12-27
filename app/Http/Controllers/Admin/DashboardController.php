<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien; // Model untuk data pasien
use App\Models\Dokter; // Model untuk data dokter
use App\Models\Poli;   // Model untuk data poli
use App\Models\Obat;   // Model untuk data obat

class DashboardController extends Controller
{
    // Fungsi untuk menampilkan dashboard
    public function dashboard()
    {
        // Mengambil jumlah data dari masing-masing model
        $jumlahPasien = Pasien::count();
        $jumlahDokter = Dokter::count();
        $jumlahPoli = Poli::count();
        $jumlahObat = Obat::count();

        // Mengirim data ke view 'admin.dashboard'
        return view('admin.dashboard', compact('jumlahPasien', 'jumlahDokter', 'jumlahPoli', 'jumlahObat'));
    }
}