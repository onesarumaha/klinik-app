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
        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->foreignId('pendaftaran_id')->nullable()->change();
            $table->foreignId('dokter_id')->nullable()->change();
            $table->string('tekanan_darah')->nullable()->change();
            $table->string('suhu')->nullable()->change();
            $table->string('berat_badan')->nullable()->change();
            $table->string('tinggi_badan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekam_medis', function (Blueprint $table) {
            //
        });
    }
};
