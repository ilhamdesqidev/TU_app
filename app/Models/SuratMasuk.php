<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tanggal_diterima',
        'pengirim',
        'perihal',
        'isi_surat',
        'kategori',
        'status',
        'lampiran',
    ];

    protected $casts = [
        'lampiran' => 'array',
        'tanggal_surat' => 'date',
        'tanggal_diterima' => 'date'
    ];
}