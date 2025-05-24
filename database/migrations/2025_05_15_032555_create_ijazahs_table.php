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
            
            // Relasi ke klapper dan siswa
            $table->foreignId('klapper_id')->constrained()->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained()->onDelete('cascade');
            
            // Data siswa (denormalized untuk arsip)
            $table->string('nama_siswa');
            $table->string('nis');
            $table->string('jurusan');
            $table->date('tanggal_lulus');
            $table->string('nomor_ijazah')->unique();
            
            $table->timestamps();
            
            // Index untuk pencarian
            $table->index('nomor_ijazah');
            $table->index('nis');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ijazahs');
    }
}


  