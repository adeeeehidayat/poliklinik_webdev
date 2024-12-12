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
    
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }
}