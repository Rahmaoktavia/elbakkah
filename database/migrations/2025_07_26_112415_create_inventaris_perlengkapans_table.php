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
        Schema::create('inventaris_perlengkapans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perlengkapan', 255);
            $table->integer('jumlah_total');
            $table->integer('jumlah_tersedia');
            $table->enum('satuan', ['Pcs', 'Set', 'Paket']);
            $table->date('tanggal_input');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris_perlengkapans');
    }
};
