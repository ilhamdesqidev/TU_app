<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klapper extends Model
{
    use HasFactory;

    protected $fillable = ['nis', 'nama_siswa', 'gender', 'kelas', 'jurusan', 'angkatan', 'tempat_tanggal_lahir', 'tanggal_lahir', 'nama_orang_tua', 'tanggal_masuk', 'tanggal_naik_kelas_xi', 'tanggal_naik_kelas_xii', 'tanggal_lulus', 'foto'];
}
