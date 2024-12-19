<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    protected $fillable = ['nama', 'username', 'alamat', 'no_hp', 'password', 'id_poli'];
    public $timestamps = false;
    
    /**
     * Relasi ke model Poli
     * Setiap dokter berhubungan dengan satu poli
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    /**
     * Relasi ke model JadwalPeriksa
     * Satu dokter memiliki banyak jadwal periksa
     */
    public function jadwalPeriksa()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }
}