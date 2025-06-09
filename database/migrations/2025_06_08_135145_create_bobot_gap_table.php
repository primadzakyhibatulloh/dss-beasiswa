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
    Schema::create('bobot_gap', function (Blueprint $table) {
        $table->id();
        $table->integer('selisih'); // dari -4 sampai 4
        $table->float('nilai_bobot'); // misal 3.5, 5, dll
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_gap');
    }
};
