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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 100)->after('name')->unique();
            $table->enum('role', ['Jamaah', 'Admin', 'Direktur Keuangan', 'Pimpinan'])->after('username')->default('Jamaah');
            $table->string('foto_profil', 255)->nullable()->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'role', 'foto_profil']);
        });
    }
};
