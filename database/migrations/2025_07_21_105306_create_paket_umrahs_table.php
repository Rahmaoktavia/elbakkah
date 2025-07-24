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
        Schema::create('paket_umrahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket', 255);
            $table->string('gambar_paket', 255);
            $table->decimal('harga', 12, 2);
            $table->integer('jumlah_hari');
            $table->text('fasilitas');
            $table->text('deskripsi');
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_umrahs');
    }
};
