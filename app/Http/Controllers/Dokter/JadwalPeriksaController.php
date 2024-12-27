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

        return view('dokter.jadwal_periksa.create', compact('dokter'));
    }

    /**
     * Menyimpan jadwal periksa baru ke database.
     */
    public function store(Request $request)
    {
        $dokter = session('dokter');

        $request->validate([
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Memeriksa apakah ada jadwal periksa yang bertabrakan dengan jadwal baru
        $jadwalBertabrakan = JadwalPeriksa::where('id_dokter', $dokter->id) // Filter berdasarkan ID dokter yang sedang login
            ->where('hari', $request->hari) // Filter berdasarkan hari yang sama dengan jadwal baru
            ->where(function ($query) use ($request) {
                // Memeriksa apakah jam mulai dari jadwal yang sudah ada berada dalam rentang waktu jadwal baru
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    // Memeriksa apakah jam selesai dari jadwal yang sudah ada berada dalam rentang waktu jadwal baru
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    // Memeriksa kondisi tambahan untuk tabrakan
                    ->orWhere(function ($subQuery) use ($request) {
                        // Memeriksa apakah jam mulai dari jadwal yang sudah ada lebih awal atau sama dengan jam mulai jadwal baru
                        $subQuery->where('jam_mulai', '<=', $request->jam_mulai)
                            // Memeriksa apakah jam selesai dari jadwal yang sudah ada lebih lambat atau sama dengan jam selesai jadwal baru
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            // Mengecek apakah ada hasil yang ditemukan berdasarkan kondisi di atas
            ->exists(); // Jika ada jadwal yang bertabrakan, $jadwalBertabrakan akan bernilai true

        // Jika jadwal bertabrakan, tampilkan pesan error
        if ($jadwalBertabrakan) {
            return redirect()->route('jadwal_periksa.index')->with('error', 'Jadwal periksa bertabrakan dengan jadwal lain.');
        }

        // Simpan jadwal periksa baru
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
        $dokter = session('dokter'); // Mengambil data dokter dari session

        // Mengambil jadwal periksa berdasarkan id dan dokter yang login
        $jadwalPeriksa = JadwalPeriksa::where('id', $id)
            ->where('id_dokter', $dokter->id)
            ->first();

        return view('dokter.jadwal_periksa.edit', compact('jadwalPeriksa', 'dokter')); // Kirim data ke view
    }

    /**
     * Memperbarui jadwal periksa di database.
     */
    public function update(Request $request, $id)
    {
        $dokter = session('dokter');

        // Ambil jadwal periksa berdasarkan id dan dokter yang login
        $jadwalPeriksa = JadwalPeriksa::where('id', $id)
            ->where('id_dokter', $dokter->id)
            ->firstOrFail();

        $request->validate([
            'status' => 'required|string|in:Y,N', // Validasi nilai hanya Y atau N
        ]);

        // Jika status akan diubah menjadi aktif (Y)
        if ($request->status === 'Y') {
            // Nonaktifkan jadwal lain yang sedang aktif untuk dokter yang sama
            JadwalPeriksa::where('id_dokter', $dokter->id)
                ->where('status', 'Y')
                ->where('id', '!=', $id)
                ->update(['status' => 'N']);
        }

        // Perbarui status jadwal yang dipilih
        $jadwalPeriksa->update([
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal_periksa.index')->with('success', 'Status jadwal periksa berhasil diperbarui!');
    }

    /**
     * Menghapus jadwal periksa dari database.
     */
    /* public function destroy($id)
    {
        $dokter = session('dokter');

        $jadwalPeriksa = JadwalPeriksa::where('id', $id)
            ->where('id_dokter', $dokter->id)
            ->first();

        // Cek apakah jadwal ini memiliki pasien yang terdaftar
        $pasienTerdaftar = DB::table('daftar_poli')->where('id_jadwal', $jadwalPeriksa->id)->exists();

        if ($pasienTerdaftar) {
            return redirect()->route('jadwal_periksa.index')->with('error', 'Jadwal ini tidak dapat dihapus karena ada pasien yang terdaftar.');
        }

        $jadwalPeriksa->delete();

        return redirect()->route('jadwal_periksa.index')->with('success', 'Jadwal periksa berhasil dihapus!');
    } */

}
