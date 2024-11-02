<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klapper extends Model
{
    use HasFactory;

    protected $fillable = ['nama_buku', 'tahun_ajaran']; // Tambahkan field yang sesuai

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
