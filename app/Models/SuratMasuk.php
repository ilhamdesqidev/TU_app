<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk'; // Pastikan ini sesuai dengan nama tabel di database
    protected $fillable = ['nomor_surat', 'pengirim', 'perihal', 'tanggal_masuk'];
}
