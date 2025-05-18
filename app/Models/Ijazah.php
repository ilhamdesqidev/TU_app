<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ijazah extends Model
{
    protected $fillable = ['siswa_id','nomor_ijazah','tgl_terbit','file_path'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
