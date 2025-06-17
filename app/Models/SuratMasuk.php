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
    
    // Sebaiknya gunakan $fillable daripada $guarded untuk keamanan yang lebih baik
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tanggal_diterima',
        'pengirim',
        'perihal',
        'isi_surat',
        'kategori',
        'status',
        'lampiran_path',
        'lampiran_nama',
        'lampiran_tipe',
        'lampiran_size'
    ];

    // Jika Anda menggunakan $guarded, pastikan benar-benar perlu
    // protected $guarded = ['id']; 

    protected $dates = ['tanggal_surat', 'tanggal_diterima'];

    protected $casts = [
        'tanggal_surat' => 'datetime',
        'tanggal_diterima' => 'datetime',
        // Tambahkan cast untuk enum jika perlu
        'kategori' => 'string',
        'status' => 'string',
    ];

    /**
     * Relasi ke tabel lampiran (jika menggunakan tabel terpisah)
     * Jika lampiran disimpan langsung di tabel surat_masuks, relasi ini tidak diperlukan
     */
    public function lampiran(): HasMany
    {
        return $this->hasMany(LampiranSurat::class, 'surat_masuk_id');
    }

    /**
     * Relasi ke tabel disposisi
     */
    public function disposisi(): HasOne
    {
        return $this->hasOne(Disposisi::class, 'surat_masuk_id');
    }

    /**
     * Scope untuk surat belum diproses
     */
    public function scopeBelumDiproses($query)
    {
        return $query->where('status', 'belum_diproses');
    }

    /**
     * Scope untuk surat sedang diproses
     */
    public function scopeSedangDiproses($query)
    {
        return $query->where('status', 'sedang_diproses');
    }

    /**
     * Scope untuk surat selesai
     */
    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    /**
     * Accessor untuk format tanggal surat
     */
    public function getTanggalSuratFormattedAttribute()
    {
        return $this->tanggal_surat->format('d M Y');
    }

    /**
     * Accessor untuk format tanggal diterima
     */
    public function getTanggalDiterimaFormattedAttribute()
    {
        return $this->tanggal_diterima->format('d M Y');
    }

    public function getLampiranSizeAttribute($value)
    {
        if ($value >= 1048576) {
            return round($value / 1048576, 2) . ' MB';
        } elseif ($value >= 1024) {
            return round($value / 1024, 2) . ' KB';
        }
        return $value . ' bytes';
    }
}