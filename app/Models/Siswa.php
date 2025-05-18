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
        'nisn',
        'tempat_lahir', 
        'tanggal_lahir',
        'gender',
        'kelas',
        'jurusan',
        'angkatan',
        'nama_ibu',
        'nama_ayah',
        'tanggal_masuk',
        'tanggal_naik_kelas_xi',
        'tanggal_naik_kelas_xii',
        'tanggal_lulus', 'foto',
        'klappers_id'];

    public function klapper()
    {
        return $this->belongsTo(Klapper::class, 'klappers_id');
    }

    public function getJurusanAttribute($value)
    {
        return strtoupper($value);
    }

    public function ijazah()
{
    return $this->hasOne(Ijazah::class);
}

}
