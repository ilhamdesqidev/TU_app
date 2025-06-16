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
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_masuk_id')->constrained()->onDelete('cascade');
            $table->enum('tujuan_disposisi', ['kepala_bagian', 'sekretaris', 'staff_admin', 'wadir', 'direktur']);
            $table->text('catatan_disposisi');
            $table->date('tenggat_waktu');
            $table->enum('prioritas_disposisi', ['tinggi', 'sedang', 'rendah']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};
