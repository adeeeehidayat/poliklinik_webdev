<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;

class JadwalPeriksaController extends Controller
{
    /**
     * Menampilkan daftar jadwal periksa dokter yang sedang login.
     */
    public function index()
    {
        $dokter = session('dokter');

        // Validasi jika dokter belum login
        if (!$dokter) {
            return redirect()->route('dokter.login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Mengambil jadwal periksa berdasarkan id dokter
        $jadwalPeriksa = JadwalPeriksa::where('id_dokter', $dokter->id)->get();

        return view('dokter.jadwal_periksa.index', compact('jadwalPeriksa', 'dokter'));
    }

    /**
     * Menampilkan form untuk membuat jadwal periksa baru.
     */
    public function create()
    {
        $dokter = session('dokter');

        if (!$dokter) {
            return redirect()->route('dokter.login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return view('dokter.jadwal_periksa.create', compact('dokter'));
    }

    /**
     * Menyimpan jadwal periksa baru ke database.
     */
    public function store(Request $request)
    {
        $dokter = session('dokter');

        if (!$dokter) {
            return redirect()->route('dokter.login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $request->validate([
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        JadwalPeriksa::create([
            'id_dokter' => $dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal_periksa.index')->with('success', 'Jadwal periksa berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit jadwal periksa.
     */
    public function edit($id)
    {
        $dokter = session('dokter');

        if (!$dokter) {
            return redirect()->route('dokter.login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $jadwalPeriksa = JadwalPeriksa::where('id', $id)
            ->where('id_dokter', $dokter->id)
            ->first();

        if (!$jadwalPeriksa) {
            return redirect()->route('dokter.jadwal_periksa.index')->with('error', 'Jadwal periksa tidak ditemukan.');
        }

        return view('dokter.jadwal_periksa.edit', compact('jadwalPeriksa', 'dokter'));
    }

    /**
     * Memperbarui jadwal periksa di database.
     */
    public function update(Request $request, $id)
    {
        $dokter = session('dokter');

        if (!$dokter) {
            return redirect()->route('dokter.login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $jadwalPeriksa = JadwalPeriksa::where('id', $id)
            ->where('id_dokter', $dokter->id)
            ->first();

        if (!$jadwalPeriksa) {
            return redirect()->route('jadwal_periksa.index')->with('error', 'Jadwal periksa tidak ditemukan.');
        }

        $request->validate([
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwalPeriksa->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal_periksa.index')->with('success', 'Jadwal periksa berhasil diperbarui!');
    }

    /**
     * Menghapus jadwal periksa dari database.
     */
    public function destroy($id)
    {
        $dokter = session('dokter');

        if (!$dokter) {
            return redirect()->route('dokter.login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $jadwalPeriksa = JadwalPeriksa::where('id', $id)
            ->where('id_dokter', $dokter->id)
            ->first();

        if (!$jadwalPeriksa) {
            return redirect()->route('jadwal_periksa.index')->with('error', 'Jadwal periksa tidak ditemukan.');
        }

        $jadwalPeriksa->delete();

        return redirect()->route('jadwal_periksa.index')->with('success', 'Jadwal periksa berhasil dihapus!.');
    }
}
