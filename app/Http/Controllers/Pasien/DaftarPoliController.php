<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;

class DaftarPoliController extends Controller
{
    // Menampilkan form pendaftaran poli
    public function index()
    {
        // Mengambil data pasien yang sedang login dari sesi
        $pasien = session('pasien');

        // Mengambil nomor rekam medis pasien yang sedang login
        $no_rm = $pasien->no_rm;

        // Mengambil data poli untuk dropdown pilihan poli
        $polis = Poli::all();

        // Mengirim data ke view
        return view('pasien.daftar_poli.index', compact('no_rm', 'polis'));
    }

    // Menyimpan pendaftaran poli
    public function store(Request $request)
    {
        $request->validate([
            'id_poli' => 'required|exists:poli,id',
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
            'keluhan' => 'required|string|max:255',
        ]);

        // Ambil data pasien yang sedang login
        $pasien = session('pasien');

        // Ambil data nomor antrian untuk pasien pada jadwal dokter yang dipilih
        $lastAntrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)->max('no_antrian');

        // Tentukan nomor antrian, jika belum ada pendaftaran maka mulai dari 1
        $no_antrian = $lastAntrian ? $lastAntrian + 1 : 1;

        // Simpan pendaftaran poli
        DaftarPoli::create([
            'id_pasien' => $pasien->id,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $no_antrian,
            'status_periksa' => 0, // Set nilai default untuk status_periksa
        ]);

        return redirect()->route('riwayat_pendaftaran.index')->with('success', 'Pendaftaran poli berhasil.');
    }

    // Endpoint untuk mendapatkan jadwal dokter berdasarkan poli
    public function getJadwalDokter($poliId)
    {
        // Ambil jadwal dokter berdasarkan poli yang dipilih dengan status aktif (Y) dan sertakan nama dokter
        $jadwals = JadwalPeriksa::whereHas('dokter', function ($query) use ($poliId) {
            $query->where('id_poli', $poliId);
        })
        ->where('status', 'Y') // Tambahkan kondisi status aktif
        ->with('dokter') // Sertakan relasi dokter
        ->get();

        return response()->json($jadwals);
    }

}
