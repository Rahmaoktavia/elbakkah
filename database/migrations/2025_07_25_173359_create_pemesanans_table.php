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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jamaah_id')->constrained('jamaahs')->onDelete('cascade'); 
            $table->foreignId('keberangkatan_id')->constrained('jadwal_keberangkatans')->onDelete('cascade');
            $table->date('tanggal_pesan'); 
            $table->decimal('total_tagihan', 12, 2)->default(0); 
            $table->enum('status_pembayaran', ['Belum Lunas', 'Lunas'])->default('Belum Lunas'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
