<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPoli;

class RiwayatPendaftaranController extends Controller
{
    public function index()
    {
        // Ambil data pasien yang sedang login
        $pasien = session('pasien');

        // Ambil riwayat pendaftaran poli berdasarkan pasien yang sedang login
        $riwayatPendaftaran = DaftarPoli::with(['jadwal.dokter.poli'])
            ->where('id_pasien', $pasien->id)
            ->get();

        // Kirim data ke view
        return view('pasien.riwayat_pendaftaran.index', compact('riwayatPendaftaran'));
    }
}

