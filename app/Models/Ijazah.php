<?php
// app/Models/Ijazah.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ijazah extends Model
{
    use HasFactory;

    protected $fillable = [
        'klapper_id',
        'siswa_id',
        'nama_siswa',
        'nis',
        'jurusan',
        'tanggal_lulus',
        'nomor_ijazah',
        'file_path' // Pastikan ini ada
    ];

    public function klapper()
    {
        return $this->belongsTo(Klapper::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    protected $casts = [
        'tanggal_lulus' => 'datetime',
    ];
}