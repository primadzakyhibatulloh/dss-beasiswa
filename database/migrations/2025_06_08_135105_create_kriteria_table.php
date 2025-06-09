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
    Schema::create('kriteria', function (Blueprint $table) {
        $table->id();
        $table->string('kode'); // K1, K2, ...
        $table->string('nama');
        $table->enum('faktor', ['core', 'secondary']);
        $table->decimal('bobot', 5, 2); // contoh: 15.00
        $table->integer('nilai_ideal');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria');
    }
};
