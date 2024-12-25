<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poli;

class ProfilDokterController extends Controller
{
    // Menampilkan profil dokter yang sedang login
    public function index()
    {
        $dokter = session('dokter'); // Mengambil data dokter yang sedang login dari session
        return view('dokter.profil_dokter.index', compact('dokter'));
    }

    // Menampilkan form untuk mengedit profil dokter
    public function edit()
    {
        $polis = Poli::all();  // Ambil semua data poli untuk dropdown

        $dokter = session('dokter');
        return view('dokter.profil_dokter.edit', compact('dokter','polis'));
    }

    // Mengupdate data dokter
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:150',
            'username' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|integer',
            'password' => 'required|string|max:100',
            // 'id_poli' => 'required|exists:poli,id',
        ]);

        // Ambil data dokter dari sesi
        $dokter = session('dokter');

        // Update data dokter
        $dokter->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'password' => $request->password,
            // 'id_poli' => $request->id_poli,
        ]);

        // Ambil data dokter yang terbaru dari database
        $dokter = Dokter::find($dokter->id); // Mengambil data dokter berdasarkan ID dokter

        // Update session setelah data dokter diperbarui
        session(['dokter' => $dokter]);

        return redirect()->route('profil_dokter.index')->with('success', 'Profil berhasil diperbarui!.');
    }
}
