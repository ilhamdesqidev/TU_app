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
        'kategori',
        'status',
        'isi_surat',
        'lampiran'
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_pengiriman' => 'date'
    ];

    public function getLampiranListAttribute()
    {
        return $this->lampiran ? explode('|', $this->lampiran) : [];
    }
}