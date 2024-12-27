<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\DB;

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

        // Cek apakah jadwal sudah ada atau bertabrakan
        $jadwalBertabrakan = JadwalPeriksa::where('id_dokter', $dokter->id)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($subQuery) use ($request) {
                        $subQuery->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->exists();

        if ($jadwalBertabrakan) {
            return redirect()->route('jadwal_periksa.index')->with('error', 'Jadwal periksa bertabrakan dengan jadwal lain.');
        }

        JadwalPeriksa::create([
            'id_dokter' => $dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status ?? 'N',
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
            'status' => 'required|string|max:10',
        ]);

        // Validasi jika status akan diubah menjadi aktif
        if ($request->status === 'Y') {
            $jadwalAktif = JadwalPeriksa::where('id_dokter', $dokter->id)
                ->where('status', 'Y')
                ->where('id', '!=', $id)
                ->exists();

            if ($jadwalAktif) {
                return redirect()->route('jadwal_periksa.index')->with('error', 'Terdapat jadwal yang sedang aktif. Mohon nonaktifkan jadwal tersebut terlebih dahulu.');
            }
        }

        $jadwalPeriksa->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
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

        // Cek apakah jadwal ini memiliki pasien yang terdaftar
        $pasienTerdaftar = DB::table('daftar_poli')->where('id_jadwal', $jadwalPeriksa->id)->exists();

        if ($pasienTerdaftar) {
            return redirect()->route('jadwal_periksa.index')->with('error', 'Jadwal ini tidak dapat dihapus karena masih ada pasien yang terdaftar.');
        }

        $jadwalPeriksa->delete();

        return redirect()->route('jadwal_periksa.index')->with('success', 'Jadwal periksa berhasil dihapus!');
    }

}
