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
            // Kita taruh file-file ini di bagian akhir tabel
            $table->string('file_sertifikat_tanah')->nullable()->comment('Scan Bukti Kepemilikan Lahan');
            $table->string('file_ktp')->nullable()->comment('Scan KTP');
            $table->string('file_kk')->nullable()->comment('Scan Kartu Keluarga');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['file_sertifikat_tanah', 'file_ktp', 'file_kk']);
        });
    }
};
