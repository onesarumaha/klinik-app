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
        Schema::create('stok_obat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obat_id')->constrained('data_obat')->cascadeOnDelete();
            $table->foreignId('cabang_id')->constrained('cabang')->cascadeOnDelete();
            $table->string('qty_sebelum')->nullable();
            $table->string('qty');
            $table->string('qty_sesudah')->nullable();
            $table->enum('type', ['masuk', 'keluar'])->default('masuk');
            $table->string('tgl_kadarluarsa')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_obat');

    }
};
