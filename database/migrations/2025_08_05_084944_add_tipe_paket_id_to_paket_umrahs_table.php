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
            $table->unsignedBigInteger('tipe_paket_id')->nullable()->after('id');
            $table->foreign('tipe_paket_id')->references('id')->on('tipe_pakets')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paket_umrahs', function (Blueprint $table) {
            $table->dropForeign(['tipe_paket_id']);
            $table->dropColumn('tipe_paket_id');
        });
    }
};
