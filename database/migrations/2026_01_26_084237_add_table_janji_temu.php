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
        Schema::create('janji_temu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('data_pasien')->cascadeOnDelete();
            $table->foreignId('cabang_id')->constrained('cabang')->cascadeOnDelete();
            $table->foreignId('poli_id')->constrained('data_poli')->cascadeOnDelete();
            $table->foreignId('dokter_id')->constrained('data_dokter')->cascadeOnDelete();
            $table->date('tanggal_janji');
            $table->enum('status', ['booked', 'hadir', 'batal', 'reschedule'])->default('booked');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('janji_temu');

    }
};
