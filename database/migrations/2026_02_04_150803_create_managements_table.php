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
        Schema::create('managements', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan'); // Ketua, Sekretaris, dll
            $table->string('no_hp')->nullable();
            $table->string('foto')->nullable();

            // Periode menjabat, misal 2024-2029
            $table->year('periode_mulai');
            $table->year('periode_selesai');

            $table->boolean('is_active')->default(true); // Masih menjabat atau demisioner
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('managements');
    }
};
