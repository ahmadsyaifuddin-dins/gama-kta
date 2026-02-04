<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel members
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');

            // Jenis: Pokok (Sekali awal), Wajib (Bulanan), Sukarela (Nabung biasa)
            $table->enum('jenis_simpanan', ['pokok', 'wajib', 'sukarela']);

            $table->decimal('jumlah', 15, 2); // Pakai decimal biar presisi duitnya
            $table->date('tanggal_bayar');
            $table->string('keterangan')->nullable(); // Misal: "Iuran Bulan Januari 2025"
            $table->string('bukti_transfer')->nullable(); // Upload foto struk

            // Siapa admin yang input? (Opsional, biar ketahuan jejaknya)
            $table->foreignId('user_id')->nullable()->constrained('users');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('savings');
    }
};
