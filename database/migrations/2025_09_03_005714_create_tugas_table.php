<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwal')->onDelete('cascade'); 
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('foto_tugas');
            $table->date('deadline');
            $table->timestamps();

        });
    }

    public function down(): void {
        Schema::dropIfExists('tugas');
    }
};
