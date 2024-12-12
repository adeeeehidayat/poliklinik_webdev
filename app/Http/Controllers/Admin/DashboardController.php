<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Obat;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Mengambil jumlah pasien, dokter, poli, dan obat
        $jumlahPasien = Pasien::count();
        $jumlahDokter = Dokter::count();
        $jumlahPoli = Poli::count();
        $jumlahObat = Obat::count();

        // Menampilkan data ke view
        return view('admin.dashboard', compact('jumlahPasien', 'jumlahDokter', 'jumlahPoli', 'jumlahObat'));
    }
}
