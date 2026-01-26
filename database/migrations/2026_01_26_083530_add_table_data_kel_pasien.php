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
        Schema::create('data_kel_pasien', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('data_pasien')->cascadeOnDelete();
            $table->string('nama');
            $table->string('hubungan');
            $table->string('no_hp')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kel_pasien');

    }
};
