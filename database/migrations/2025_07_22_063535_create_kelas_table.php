<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('wali_kelas');
            $table->unsignedBigInteger('wali_kelas_id')->nullable(); // simpan ID guru
            $table->foreign('wali_kelas_id')->references('id')->on('guru')->onDelete('set null');
            $table->string('nama_kelas');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
