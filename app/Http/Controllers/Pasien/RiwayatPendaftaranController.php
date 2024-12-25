<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\Periksa;

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

    public function detailPeriksa($id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $pendaftaran = DaftarPoli::findOrFail($id);

        // Ambil data pemeriksaan jika sudah diperiksa
        $periksa = Periksa::where('id_daftar_poli', $id)->first();

        // Cek status pemeriksaan
        if ($pendaftaran->status_periksa == 0) {
            // Jika belum diperiksa, hanya tampilkan informasi dasar
            return view('pasien.riwayat_pendaftaran.detail_periksa', compact('pendaftaran'));
        } else {
            // Jika sudah diperiksa, tampilkan informasi lengkap
            return view('pasien.riwayat_pendaftaran.detail_periksa', compact('pendaftaran', 'periksa'));
        }
    }
}

