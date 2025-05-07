<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spensasi extends Model
{
    protected $table = 'spensasi';
    
    protected $fillable = [
        'nama_siswa', 
        'kelas', 
        'jurusan',
        'kategori_spensasi', 
        'waktu_mulai',
        'waktu_selesai', 
        'detail_spensasi', 
        'status', 
        'tanggal_spensasi'
    ];

}
