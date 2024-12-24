# Poliklinik Web Development

Proyek ini adalah aplikasi web untuk sistem janji temu antara pasien dan dokter yang dibangun menggunakan framework Laravel versi 10.48.25. Sistem ini memiliki tiga jenis pengguna utama:

1. **Admin**: Mengelola data pengguna, dokter, pasien, poli dan obat.
2. **Dokter**: Melihat jadwal janji temu mereka dan memberikan catatan medis.
3. **Pasien**: Membuat janji temu dengan dokter dan melihat riwayat janji temu mereka.

## Instalasi

### Prasyarat
- Minimal versi PHP 8.1 - 8.3
- XAMPP atau Laragon
- VSCode

### Langkah-Langkah

1. **Clone Repository**
   ```bash
   git clone https://github.com/adeeeehidayat/poliklinik_webdev.git
   cd poliklinik_webdev
   ```

2. **Sesuaikan Database**
    - Buat database dengan nama `bk_poliklinik_2024` dan import file `bk_poliklinik_2024.sql` ke database tersebut

2. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Aplikasi akan tersedia di [http://localhost:8000](http://localhost:8000).

### Endpoint
**Admin**
1. ```/admin/login``` : halaman login admin
2. ```/admin/dashboard``` : halaman dashboard admin
2. ```/admin/dokter``` : halaman admin untuk mengelola dokter
2. ```/admin/pasien``` : halaman admin untuk mengelola pasien 
2. ```/admin/poli``` : halaman admin untuk mengelola poli 
2. ```/admin/obat``` : halaman admin untuk mengelola obat 

**Pasien**
1. ```/pasien/login``` : halaman login pasien
2. ```/pasien/register``` : halaman register pasien
3. ```/pasien/dashboard``` : halaman dashboard pasien
4. ```/pasien/daftar_poli``` : halaman pasien mendaftar poli
5. ```/pasien/riwayat_pendaftaran``` : halaman riwayat pendaftaran poli pasien

**Dokter**
1. ```/dokter/login``` : halaman login dokter
2. ```/dokter/register``` : halaman register dokter
3. ```/dokter/dashboard``` : halaman dashboard dokter
4. ```/dokter/daftar_pasien``` : halaman kelola periksa daftar pasien
5. ```/dokter/jadwal_periksa``` : halaman kelola jadwal periksa dokter
6. ```/dokter/profil_dokter``` : halaman profil dokter