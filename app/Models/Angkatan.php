<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;

    protected $table = 'angkatan';

    protected $fillable = ['nama'];

    public function ijazah()
    {
        return $this->hasMany(Ijazah::class);
    }

    public function klapper() {
        return $this->hasOne(Klapper::class);
    }
}

