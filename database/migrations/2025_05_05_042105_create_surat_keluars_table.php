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
            $table->id(); // tambahkan primary key
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->string('penerima');
            $table->date('tanggal_pengiriman')->nullable();
            $table->string('perihal');
            $table->text('isi_surat')->nullable();
            $table->enum('kategori', ['penting', 'segera', 'biasa'])->default('biasa');
            $table->enum('status', ['draft', 'dikirim', 'diterima'])->default('draft');
            $table->json('lampiran')->nullable(); // disimpan sebagai array path
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
