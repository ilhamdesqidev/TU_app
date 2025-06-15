<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuks';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $dates = ['tanggal_surat', 'tanggal_diterima'];

    public function lampiran(): HasMany
    {
        return $this->hasMany(LampiranSurat::class, 'surat_masuk_id');
    }

    public function disposisi(): HasOne
    {
        return $this->hasOne(Disposisi::class, 'surat_masuk_id');
    }

    protected $casts = [
        'tanggal_surat' => 'datetime',
        'tanggal_diterima' => 'datetime',
    ];
}