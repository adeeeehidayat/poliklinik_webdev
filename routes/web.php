<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Admin
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\DashboardController;

// Pasien
use App\Http\Controllers\Pasien\PasienDashboardController;
use App\Http\Controllers\Pasien\DaftarPoliController;
use App\Http\Controllers\Pasien\RiwayatPendaftaranController;

// Dokter
use App\Http\Controllers\Dokter\DokterDashboardController;
use App\Http\Controllers\Dokter\DaftarPasienController;
use App\Http\Controllers\Dokter\RiwayatPeriksaController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\ProfilDokterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route untuk login admin
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login.form');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.adminLogin');

// Route grup untuk admin (butuh autentikasi)
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Route untuk CRUD Dokter
    Route::resource('/admin/dokter', DokterController::class)->except(['show']); // Menangani CRUD Dokter (create, store, edit, update, destroy)

    // Route untuk CRUD Pasien
    Route::resource('/admin/pasien', PasienController::class)->except(['show']); // Menangani CRUD Pasien (create, store, edit, update, destroy)

    // Route untuk CRUD Poli
    Route::resource('/admin/poli', PoliController::class)->except(['show']); // Menangani CRUD Poli (create, store, edit, update, destroy)

    // Route untuk CRUD Obat
    Route::resource('/admin/obat', ObatController::class)->except(['show']); // Menangani CRUD Obat (create, store, edit, update, destroy)

    Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.adminLogout');
});

// Route untuk login pasien
Route::get('/pasien/login', [AuthController::class, 'showPasienLogin'])->name('pasien.login.form');
Route::post('/pasien/login', [AuthController::class, 'pasienLogin'])->name('pasien.pasienLogin');
Route::get('/pasien/register', [AuthController::class, 'showPasienRegister'])->name('pasien.register.form');
Route::post('/pasien/register', [AuthController::class, 'pasienRegister'])->name('pasien.pasienRegister');

// Route grup untuk pasien (butuh autentikasi)
Route::middleware(['pasien.auth'])->group(function () {
    Route::get('/pasien/dashboard', [PasienDashboardController::class, 'dashboard'])->name('pasien.dashboard');

    // Rute untuk menampilkan form pendaftaran poli
    Route::get('/pasien/daftar-poli', [DaftarPoliController::class, 'index'])->name('daftar_poli.index');
    Route::get('/get-jadwal-dokter/{poliId}', [DaftarPoliController::class, 'getJadwalDokter']);

    // Rute untuk menampilkan riwayat pendaftaran pasien
    Route::get('/pasien/riwayat-pendaftaran', [RiwayatPendaftaranController::class, 'index'])->name('riwayat_pendaftaran.index');
    Route::get('/pasien/riwayat-pendaftaran/detail-periksa/{id}', [RiwayatPendaftaranController::class, 'detailPeriksa'])->name('riwayat_pendaftaran.detail_periksa');

    // Rute untuk menyimpan pendaftaran poli
    Route::post('/pasien/daftar-poli', [DaftarPoliController::class, 'store'])->name('daftar_poli.store');

    Route::post('/pasien/logout', [AuthController::class, 'pasienLogout'])->name('pasien.pasienLogout');
});

// Route untuk login dokter
Route::get('/dokter/login', [AuthController::class, 'showDokterLogin'])->name('dokter.login.form');
Route::post('/dokter/login', [AuthController::class, 'dokterLogin'])->name('dokter.dokterLogin');

// Route grup untuk dokter (butuh autentikasi)
Route::middleware(['dokter.auth'])->group(function () {
    Route::get('/dokter/dashboard', [DokterDashboardController::class, 'dashboard'])->name('dokter.dashboard');

    Route::get('/dokter/profil', [ProfilDokterController::class, 'index'])->name('profil_dokter.index');
    Route::get('/dokter/profil/edit', [ProfilDokterController::class, 'edit'])->name('profil_dokter.edit');
    Route::post('/dokter/profil/update', [ProfilDokterController::class, 'update'])->name('profil_dokter.update');

    Route::get('/dokter/daftar-pasien', [DaftarPasienController::class, 'index'])->name('daftar_pasien.index');
    Route::get('/dokter/daftar-pasien/edit/{id}', [DaftarPasienController::class, 'edit'])->name('daftar_pasien.edit');
    Route::post('/dokter/daftar-pasien/{id}/simpan', [DaftarPasienController::class, 'simpan'])->name('daftar_pasien.simpan');

    Route::get('/dokter/daftar-pasien/{id}/edit-sudah-diperiksa', [DaftarPasienController::class, 'editSudahDiperiksa'])->name('daftar_pasien.editSudahDiperiksa');
    Route::post('/dokter/daftar-pasien/{id}/update-sudah-diperiksa', [DaftarPasienController::class, 'updateSudahDiperiksa'])->name('daftar_pasien.updateSudahDiperiksa');

    Route::get('/dokter/riwayat-periksa', [RiwayatPeriksaController::class, 'index'])->name('riwayat_periksa.index');
    Route::get('/dokter/riwayat-periksa/{id}', [RiwayatPeriksaController::class, 'detail'])->name('riwayat_periksa.detail');

    Route::resource('/jadwal-periksa', JadwalPeriksaController::class)->except(['show'])->names([
        'index' => 'jadwal_periksa.index',
        'create' => 'jadwal_periksa.create',
        'store' => 'jadwal_periksa.store',
        'edit' => 'jadwal_periksa.edit',
        'update' => 'jadwal_periksa.update',
        'destroy' => 'jadwal_periksa.destroy',
    ]);
    
    Route::post('/dokter/logout', [AuthController::class, 'dokterLogout'])->name('dokter.dokterLogout');
});
