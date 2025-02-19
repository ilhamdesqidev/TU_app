<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('show', function (Blueprint $table) {
            $table->id();
            $table->integer('nis');
            $table->string('nama_siswa');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('gender');
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('angkatan');
            $table->string('nama_ibu');
            $table->string('nama_ayah');
            $table->date('tanggal_masuk');
            $table->date('tanggal_naik_kelas_xi');
            $table->date('tanggal_naik_kelas_xii');
            $table->date('tanggal_lulus');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('show');
    }
};
