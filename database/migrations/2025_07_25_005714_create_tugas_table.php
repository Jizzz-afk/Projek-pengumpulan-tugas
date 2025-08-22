<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('mapel_id');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('foto_tugas');
            $table->date('deadline');
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->timestamps();
            
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('mapel_id')->references('id')->on('mapel')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('tugas');
    }
};
