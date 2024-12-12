<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showAdminLogin()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $admin = Admin::where('username', $request->username)->first();
    
        if ($admin && $request->password === $admin->password) {
            session(['admin' => $admin]);
            return redirect('/admin/dashboard');
        }
    
        return redirect()->route('admin.login.form')->with('error', 'Invalid username or password.');
    }

    public function adminLogout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect()->route('admin.login.form');
    }

    public function showPasienLogin()
    {
        return view('pasien.login');
    }

    public function showPasienRegister()
    {
        return view('pasien.register');
    }

    // Menyimpan pasien baru
    public function pasienRegister(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'username' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|integer',
            'no_hp' => 'required|integer',
            'password' => 'required|string|max:100',
        ]);

        // Mendapatkan tahun dan bulan saat ini
        $tahunBulan = now()->format('Ym'); // Format: YYYYMM

        // Menghitung jumlah pasien yang sudah terdaftar
        $urutanPasien = Pasien::count() + 1;  // Jumlah pasien + 1 untuk urutan pasien baru

        // Membuat nomor RM dengan format TahunBulan-UrutanPasien
        $no_rm = $tahunBulan . '-' . str_pad($urutanPasien, 3, '0', STR_PAD_LEFT); // Misal: 202411-101

        // Menambahkan no_rm ke dalam data pasien
        $data = $request->all();
        $data['no_rm'] = $no_rm;

        // Menyimpan data pasien ke database
        Pasien::create($data);

        return redirect()->route('pasien.login.form')->with('success', 'Pendaftaran berhasil, silahkan login.');
    }

    public function pasienLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $pasien = Pasien::where('username', $request->username)->first();
    
        if ($pasien && $request->password === $pasien->password) {
            session(['pasien' => $pasien]);
            return redirect('/pasien/dashboard');
        }
    
        return redirect()->route('pasien.login.form')->with('error', 'Invalid username or password.');
    }

    public function pasienLogout(Request $request)
    {
        $request->session()->forget('pasien');
        return redirect()->route('pasien.login.form');
    }

    public function showDokterLogin()
    {
        return view('dokter.login');
    }

    public function showDokterRegister()
    {
        return view('dokter.register');
    }

    public function dokterLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $dokter = Dokter::where('username', $request->username)->first();
    
        if ($dokter && $request->password === $dokter->password) {
            session(['dokter' => $dokter]);
            return redirect('/dokter/dashboard');
        }
    
        return redirect()->route('dokter.login.form')->with('error', 'Invalid username or password.');
    }

    public function dokterLogout(Request $request)
    {
        $request->session()->forget('dokter');
        return redirect()->route('dokter.login.form');
    }
}