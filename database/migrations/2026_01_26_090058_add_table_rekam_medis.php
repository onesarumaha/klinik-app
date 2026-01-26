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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran_pasien')->cascadeOnDelete();
            $table->foreignId('pasien_id')->constrained('data_pasien')->cascadeOnDelete();
            $table->foreignId('dokter_id')->constrained('data_dokter')->cascadeOnDelete();
            $table->text('keluhan');
            $table->text('diagnosis');
            $table->text('catatan');
            $table->string('tekanan_darah');
            $table->string('suhu');
            $table->string('berat_badan');
            $table->string('tinggi_badan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');

    }
};
