<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'judul_laporan', 
        'isi_laporan', 
        'foto',
        'status'
    ];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik_masyarakat', 'nik');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
    }
}
