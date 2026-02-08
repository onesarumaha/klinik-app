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
        Schema::table('data_pasien', function (Blueprint $table) {
            $table->renameColumn('jenis_kelamin', 'jk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_pasien', function (Blueprint $table) {
            $table->renameColumn('jk', 'jenis_kelamin');
        });
    }
};
