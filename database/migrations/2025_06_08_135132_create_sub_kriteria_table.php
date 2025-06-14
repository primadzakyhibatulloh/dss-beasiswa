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
    Schema::create('sub_kriteria', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('kriteria_id');
        $table->tinyInteger('nilai'); // 1-5
        $table->string('deskripsi');
        $table->timestamps();

        $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_kriteria');
    }
};
