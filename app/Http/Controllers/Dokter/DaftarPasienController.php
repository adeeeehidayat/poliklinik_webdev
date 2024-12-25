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

    // Method untuk form edit pasien yang sudah diperiksa
    public function editSudahDiperiksa($id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $pendaftaran = DaftarPoli::findOrFail($id);

        // Ambil data pemeriksaan dan obat yang telah diberikan
        $periksa = Periksa::where('id_daftar_poli', $id)->first();
        $obat = Obat::all();

        // Tampilkan view edit untuk pasien yang sudah diperiksa
        return view('dokter.daftar_pasien.edit_sudah_diperiksa', compact('pendaftaran', 'periksa', 'obat'));
    }

    public function updateSudahDiperiksa(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Ambil data pendaftaran
            $pendaftaran = DaftarPoli::findOrFail($id);

            // Ambil data pemeriksaan yang sudah ada
            $periksa = Periksa::where('id_daftar_poli', $id)->first();

            // Update data pemeriksaan
            $periksa->update([
                'tgl_periksa' => $request->input('tanggal_periksa'),
                'catatan' => $request->input('catatan'),
                'biaya_periksa' => $request->input('biaya_periksa'),
            ]);

            // Hapus detail obat yang sudah ada sebelumnya
            $periksa->detailPeriksa()->delete();

            // Simpan detail obat baru
            if ($request->has('obat')) {
                foreach ($request->input('obat') as $obatId) {
                    DetailPeriksa::create([
                        'id_periksa' => $periksa->id,
                        'id_obat' => $obatId,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('daftar_pasien.index')->with('success', 'Data pemeriksaan pasien berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data pemeriksaan: ' . $e->getMessage());
        }
    }

}
