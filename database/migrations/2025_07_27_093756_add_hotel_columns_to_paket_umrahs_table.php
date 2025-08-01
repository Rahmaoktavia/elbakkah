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
        Schema::table('paket_umrahs', function (Blueprint $table) {
            $table->string('hotel_makkah')->after('jumlah_hari');
            $table->string('hotel_madinah')->after('hotel_makkah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paket_umrahs', function (Blueprint $table) {
            $table->dropColumn(['hotel_makkah', 'hotel_madinah']);
        });
    }
};
