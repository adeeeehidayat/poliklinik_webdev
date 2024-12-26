<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPoli;

class PasienDashboardController extends Controller
{
    public function dashboard()
    {
        $pasienId = session('pasien')->id;
        $jumlahDaftarPeriksa = DaftarPoli::where('id_pasien', $pasienId)->count();

        return view('pasien.dashboard', compact('jumlahDaftarPeriksa'));
    }
}
