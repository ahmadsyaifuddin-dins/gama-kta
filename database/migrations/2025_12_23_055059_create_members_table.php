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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            // --- Identitas Utama ---
            // Nomor Anggota KUD (Biasanya ada format khusus, kita buat string agar fleksibel)
            $table->string('nomor_anggota')->unique()->comment('Nomor unik anggota KUD');

            // NIK (Wajib unik untuk menghindari data ganda)
            $table->string('nik', 16)->unique();

            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);

            // --- Kontak & Alamat (Mendukung Laporan per Wilayah) ---
            $table->text('alamat_lengkap'); // Alamat jalan/rt/rw
            $table->string('dusun')->nullable()->comment('Untuk filter Laporan per Wilayah');
            $table->string('desa')->default('Telaga Sari'); // Default desa sesuai judul
            $table->string('no_hp')->nullable();

            // --- Data Keanggotaan ---
            $table->string('pekerjaan')->nullable();
            $table->date('tanggal_bergabung')->comment('Untuk filter Laporan Anggota per Periode');

            // --- File & Status Cetak ---
            $table->string('foto')->nullable()->comment('Path file foto yang diupload');

            // Status Cetak: Penting untuk Laporan no 3 (Monitoring)
            // 0 = Belum Dicetak, 1 = Sudah Dicetak
            $table->boolean('status_cetak')->default(0);
            $table->timestamp('tanggal_cetak')->nullable()->comment('Tercatat otomatis saat admin klik cetak');

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
