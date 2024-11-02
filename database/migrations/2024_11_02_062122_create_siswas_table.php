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
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('gender');
        $table->string('kelas');
        $table->string('jurusan');
        $table->year('angkatan');
        $table->string('nama_orang_tua');
        $table->date('tanggal_masuk');
        $table->date('tanggal_naik_kelas_xi')->nullable();
        $table->date('tanggal_naik_kelas_xii')->nullable();
        $table->date('tanggal_lulus')->nullable();
        $table->string('foto')->nullable();
        $table->foreignId('klapper_id')->constrained('klapper')->onDelete('cascade'); // Hubungkan dengan tabel klapper
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
