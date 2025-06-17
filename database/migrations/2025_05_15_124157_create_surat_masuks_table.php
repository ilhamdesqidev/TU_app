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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_surat');
            $table->date('tanggal_diterima');
            $table->string('pengirim');
            $table->string('perihal');
            $table->text('isi_surat')->nullable();
            $table->enum('kategori', ['penting', 'segera', 'biasa']);
            $table->enum('status', ['belum_diproses', 'sedang_diproses', 'selesai']);
            $table->string('lampiran_path')->nullable();
            $table->string('lampiran_nama')->nullable();
            $table->string('lampiran_tipe')->nullable();
            $table->integer('lampiran_size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
