<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_pasien', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekam_medis');
            $table->string('nik');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tanggal_lahir');
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('gol_darah')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pasien');
    }
};
