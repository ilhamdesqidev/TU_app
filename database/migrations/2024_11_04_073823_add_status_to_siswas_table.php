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
        Schema::table('siswas', function (Blueprint $table) {
            $table->integer('status')->default(0); // 0 untuk 'pelajar', 1 untuk 'lulus', dsb.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
