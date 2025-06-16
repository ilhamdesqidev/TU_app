<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LampiranSurat extends Model
{
    use HasFactory;

    protected $table = 'lampiran_surats';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function suratMasuk(): BelongsTo
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    protected $fillable = ['path', 'original_name', 'file_type', 'surat_masuk_id'];
}