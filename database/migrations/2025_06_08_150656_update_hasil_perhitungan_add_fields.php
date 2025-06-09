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
        Schema::table('hasil_perhitungan', function (Blueprint $table) {
               $table->float('nilai_ideal')->nullable()->after('nilai_subkriteria');
            $table->float('nilai_cf')->nullable()->after('nilai_bobot');
            $table->float('nilai_sf')->nullable()->after('nilai_cf');
            $table->float('nilai_total')->nullable()->after('nilai_sf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_perhitungan', function (Blueprint $table) {
              $table->dropColumn(['nilai_ideal', 'nilai_cf', 'nilai_sf', 'nilai_total']);
        });
    }
};
