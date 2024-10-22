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
        Schema::create('klapper', function (Blueprint $table) {
            $table->id();
            // $table->integer('nis');
            $table->string('nama_buku');
            $table->string('tahun_ajaran');
            // $table->string('gender');
            // $table->string('kelas');
            // $table->string('jurusan');
            // $table->string('angkatan');
            // $table->string('tempat_tanggal_lahir');
            // $table->date('tanggal_lahir');
            // $table->string('nama_orang_tua');
            // $table->date('tanggal_masuk');
            // $table->date('tanggal_naik_kelas_xi');
            // $table->date('tanggal_naik_kelas_xii');
            // $table->date('tanggal_lulus');
            // $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klappers');
    }
};
