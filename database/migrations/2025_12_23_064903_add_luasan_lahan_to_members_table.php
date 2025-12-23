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
        Schema::table('members', function (Blueprint $table) {
            // Kita taruh setelah kolom 'pekerjaan' biar rapi
            // Pakai tipe double/decimal biar bisa input koma (misal 1.5 Hektar)
            $table->double('luasan_lahan')->nullable()->after('pekerjaan')->comment('Luasan dalam Hektar');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('luasan_lahan');
        });
    }
};
