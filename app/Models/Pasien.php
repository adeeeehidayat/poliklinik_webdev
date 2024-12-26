<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $fillable = ['nama', 'username', 'alamat', 'no_ktp', 'no_hp', 'password', 'no_rm'];
    public $timestamps = false;

    // Relasi ke tabel daftar_poli
    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }
}
