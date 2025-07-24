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
        Schema::create('jadwal_keberangkatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('paket_umrahs')->onDelete('cascade');
            $table->date('tanggal_berangkat');
            $table->integer('kuota')->nullable(); // jika kamu punya kuota
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_keberangkatans');
    }
};
