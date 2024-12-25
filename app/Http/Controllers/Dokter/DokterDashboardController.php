<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;

class DokterDashboardController extends Controller
{
    public function dashboard()
    {
        // Ambil ID dokter yang sedang login
        $dokterId = session('dokter')->id;

        // Ambil jumlah pasien yang sudah diperiksa berdasarkan jadwal dokter yang sedang login
        $pasienSudahDiperiksa = DaftarPoli::whereHas('jadwal', function($query) use ($dokterId) {
            $query->where('id_dokter', $dokterId);
        })->where('status_periksa', 1)->count();

        // Ambil jumlah pasien yang belum diperiksa berdasarkan jadwal dokter yang sedang login
        $pasienBelumDiperiksa = DaftarPoli::whereHas('jadwal', function($query) use ($dokterId) {
            $query->where('id_dokter', $dokterId);
        })->where('status_periksa', 0)->count();

        // Ambil jumlah jadwal periksa dokter yang sedang login
        $jumlahJadwal = JadwalPeriksa::where('id_dokter', $dokterId)->count();

        // Kirim data ke view
        return view('dokter.dashboard', compact('pasienSudahDiperiksa', 'pasienBelumDiperiksa', 'jumlahJadwal'));
    }
}
