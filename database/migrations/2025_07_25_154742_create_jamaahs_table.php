<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJamaahsTable extends Migration
{
    public function up()
    {
        Schema::create('jamaahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('nik', 255)->nullable();
            $table->string('tempat_lahir', 255)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telepon', 255)->nullable();
            $table->string('nama_ayah', 255)->nullable();
            $table->string('pekerjaan', 255)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('pas_foto', 255)->nullable();
            $table->string('file_ktp', 255)->nullable();
            $table->string('file_kk', 255)->nullable();
            $table->string('file_paspor', 255)->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jamaahs');
    }
}

