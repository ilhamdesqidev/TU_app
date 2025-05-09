<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'penerima',
        'tanggal_pengiriman',
        'perihal',
        'isi_surat',
        'kategori',
        'status',
        'lampiran',
    ];

    protected $casts = [
        'lampiran' => 'array',
        'tanggal_surat' => 'date',
        'tanggal_pengiriman' => 'date'
    ];
}