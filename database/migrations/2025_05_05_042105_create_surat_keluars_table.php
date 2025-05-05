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
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->string('penerima');
            $table->date('tanggal_pengiriman');
            $table->string('kategori'); // penting, segera, biasa
            $table->string('status');   // draft, dikirim, diterima
            $table->string('perihal');
            $table->text('isi_surat');
            $table->json('lampiran')->nullable(); // disimpan sebagai array path
            $table->string('penandatangan')->nullable();
            $table->string('metode_pengiriman')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
