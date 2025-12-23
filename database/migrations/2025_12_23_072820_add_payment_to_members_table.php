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
            // Biaya pendaftaran default 150.000
            $table->integer('biaya_pendaftaran')->default(150000);

            // Bukti bayar (Struk transfer / Foto uang tunai)
            $table->string('file_bukti_bayar')->nullable()->comment('Foto Struk/Transfer');

            // Tanggal bayar
            $table->date('tanggal_bayar')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['biaya_pendaftaran', 'file_bukti_bayar', 'tanggal_bayar']);
        });
    }
};
