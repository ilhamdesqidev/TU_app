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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nis');
            $table->string('nisn');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('gender');
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('nama_orang_tua');
            $table->date('tanggal_masuk');
            $table->date('tanggal_naik_kelas_xi')->nullable();
            $table->date('tanggal_naik_kelas_xii')->nullable();
            $table->date('tanggal_lulus')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('foto')->nullable();
            $table->foreignId('klapper_id')->constrained('klappers')->onDelete('cascade'); // Menghubungkan ke tabel klappers
            $table->integer('status')->default(2); // 2 untuk Pelajar, 1 untuk Lulus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
