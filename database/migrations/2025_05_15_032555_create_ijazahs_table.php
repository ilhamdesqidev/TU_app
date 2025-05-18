<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIjazahsTable extends Migration
{
    public function up()
    {
        Schema::create('ijazahs', function (Blueprint $table) {
            $table->id();
            // relasi ke siswa (yang sudah ada di klapper)
            $table->foreignId('siswa_id')->constrained()->onDelete('cascade');
            $table->string('nomor_ijazah')->unique();
            $table->date('tgl_terbit');
            $table->string('file_path');    // path upload PDF/gambar ijazah
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('ijazahs');
    }
}


  