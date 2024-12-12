# Poliklinik Web Development

Proyek ini adalah aplikasi web untuk sistem janji temu antara pasien dan dokter yang dibangun menggunakan framework Laravel. Sistem ini memiliki tiga jenis pengguna utama:

1. **Admin**: Mengelola data pengguna, dokter, pasien, poli dan obat.
2. **Dokter**: Melihat jadwal janji temu mereka dan memberikan catatan medis.
3. **Pasien**: Membuat janji temu dengan dokter dan melihat riwayat janji temu mereka.

## Instalasi

### Prasyarat
- PHP >= 8.0
- Composer
- MySQL

### Langkah-Langkah

1. **Clone Repository**
   ```bash
   git clone https://github.com/adeeeehidayat/poliklinik_webdev.git
   cd poliklinik_webdev
   ```

2. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Aplikasi akan tersedia di [http://localhost:8000](http://localhost:8000).