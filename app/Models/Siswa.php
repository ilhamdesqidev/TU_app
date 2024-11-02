<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_siswa',
        'nis',
        'tempat_lahir', 
        'tanggal_lahir',
        'gender',
        'kelas',
        'jurusan',
        'angkatan',
        'nama_orang_tua',
        'tanggal_masuk',
        'tanggal_naik_kelas_xi',
        'tanggal_naik_kelas_xii',
        'tanggal_lulus', 'foto',
        'klapper_id'];

    public function klappers()
    {
        return $this->belongsTo(Klapper::class);
    }
}
