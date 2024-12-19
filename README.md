# Poliklinik Web Development

Proyek ini adalah aplikasi web untuk sistem janji temu antara pasien dan dokter yang dibangun menggunakan framework Laravel. Sistem ini memiliki tiga jenis pengguna utama:

1. **Admin**: Mengelola data pengguna, dokter, pasien, poli dan obat.
2. **Dokter**: Melihat jadwal janji temu mereka dan memberikan catatan medis.
3. **Pasien**: Membuat janji temu dengan dokter dan melihat riwayat janji temu mereka.

## Instalasi

### Prasyarat
- PHP >= 8.0
- XAMPP
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

**Pasien**
1. ```/pasien/login``` : halaman login pasien
2. ```/pasien/register``` : halaman register pasien
3. ```/pasien/dashboard``` : halaman dashboard pasien

**Dokter**
1. ```/dokter/login``` : halaman login dokter
2. ```/dokter/register``` : halaman register dokter
3. ```/dokter/dashboard``` : halaman dashboard dokter
4. ```/dokter/jadwal_periksa``` : halaman kelola jadwal periksa dokter
5. ```/dokter/profil_dokter``` : halaman profil dokter