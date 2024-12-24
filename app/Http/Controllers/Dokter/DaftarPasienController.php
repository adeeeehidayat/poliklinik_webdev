<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;

class DaftarPasienController extends Controller
{
    public function index()
    {
        $dokter = session('dokter');

        // Validasi jika dokter belum login
        if (!$dokter) {
            return redirect()->route('dokter.login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil daftar pasien berdasarkan jadwal dokter yang sedang login
        $daftarPoli = DaftarPoli::whereHas('jadwal', function ($query) use ($dokter) {
            $query->where('id_dokter', $dokter->id);
        })->with(['pasien', 'jadwal'])->get();

        return view('dokter.daftar_pasien.index', compact('daftarPoli'));
    }

    // Method edit untuk form pemeriksaan
    public function edit($id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $pendaftaran = DaftarPoli::findOrFail($id);

        // Ambil data obat yang tersedia
        $obat = Obat::all();

        // Tampilkan view edit dengan data pasien dan obat
        return view('dokter.daftar_pasien.edit', compact('pendaftaran', 'obat'));
    }

    public function simpan(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Ambil data pendaftaran
            $pendaftaran = DaftarPoli::findOrFail($id);

            $tanggalPeriksa = $request->input('tanggal_periksa');
            $formattedTanggalPeriksa = date('Y-m-d', strtotime($tanggalPeriksa));

            // Ambil biaya dari form
            $totalBiayaObat = $request->input('total_biaya_obat', 0); // Default 0 jika tidak ada
            $biayaJasaDokter = 150000; // Biaya tetap untuk jasa dokter
            $biayaPeriksa = $totalBiayaObat + $biayaJasaDokter;

            // Simpan data ke tabel periksa
            $periksa = Periksa::create([
                'id_daftar_poli' => $pendaftaran->id,
                'tgl_periksa' => $formattedTanggalPeriksa,
                'catatan' => $request->input('catatan'),
                'biaya_periksa' => $biayaPeriksa,
            ]);

            // Simpan detail obat ke tabel detail_periksa
            if ($request->has('obat')) {
                foreach ($request->input('obat') as $obatId) {
                    DetailPeriksa::create([
                        'id_periksa' => $periksa->id,
                        'id_obat' => $obatId,
                    ]);
                }
            }

            // Update status_periksa menjadi 1 untuk pasien yang telah diperiksa
            $pendaftaran->update([
                'status_periksa' => 1,
            ]);

            DB::commit();

            return redirect()->route('daftar_pasien.index')->with('success', 'Data periksa pasien berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data periksa: ' . $e->getMessage());
        }
    }

    public function editSudahDiperiksa($id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $pendaftaran = DaftarPoli::findOrFail($id);

        // Pastikan pasien sudah diperiksa
        if ($pendaftaran->status_periksa != 1) {
            return redirect()->route('daftar_pasien.index')->with('error', 'Pasien belum diperiksa.');
        }

        // Ambil data pemeriksaan
        $periksa = Periksa::where('id_daftar_poli', $id)->first();

        return view('dokter.daftar_pasien.edit_sudah_diperiksa', compact('pendaftaran', 'periksa'));
    }

    public function updateSudahDiperiksa(Request $request, $id)
    {
        $request->validate([
            'tanggal_periksa' => 'required|date',
            'catatan' => 'nullable|string|max:255',
        ]);

        try {
            // Ambil data pemeriksaan
            $periksa = Periksa::where('id_daftar_poli', $id)->firstOrFail();

            $tanggalPeriksa = $request->input('tanggal_periksa');
            $formattedTanggalPeriksa = date('Y-m-d', strtotime($tanggalPeriksa));

            // Update data
            $periksa->update([
                'tgl_periksa' => $formattedTanggalPeriksa,
                'catatan' => $request->input('catatan'),
            ]);

            return redirect()->route('daftar_pasien.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
