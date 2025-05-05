<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'penerima',
        'tanggal_pengiriman',
        'kategori',
        'status',
        'perihal',
        'isi_surat',
        'lampiran',
        'penandatangan',
        'metode_pengiriman'
    ];

    protected $casts = [
        'lampiran' => 'array',
        'tanggal_surat' => 'date',
        'tanggal_pengiriman' => 'date'
    ];
}
