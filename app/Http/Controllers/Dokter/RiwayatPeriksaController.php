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

        // Validasi jika dokter belum login
        if (!$dokter) {
            return redirect()->route('dokter.login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

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

        // Validasi jika dokter belum login
        if (!$dokter) {
            return redirect()->route('dokter.login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil riwayat pemeriksaan pasien berdasarkan dokter yang sedang login
        $riwayatPeriksa = Periksa::whereHas('daftarPoli.jadwal', function ($query) use ($dokter) {
            $query->where('id_dokter', $dokter->id);
        })->whereHas('daftarPoli', function ($query) use ($id) {
            $query->where('id_pasien', $id);
        })->with(['daftarPoli.pasien', 'detailPeriksa.obat'])
        ->get();

        return view('dokter.riwayat_periksa.detail', compact('riwayatPeriksa'));
    }
}
