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
          Schema::create('hasil_perhitungan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peserta');               // Nama peserta manual
            $table->unsignedBigInteger('kriteria_id');    // id kriteria
            $table->integer('nilai_subkriteria');         // nilai 1-5
            $table->integer('nilai_gap');                  // gap nilai
            $table->float('nilai_bobot');                  // bobot nilai dari tabel bobot_gap
            $table->timestamps();

            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_perhitungan');
    }
};
