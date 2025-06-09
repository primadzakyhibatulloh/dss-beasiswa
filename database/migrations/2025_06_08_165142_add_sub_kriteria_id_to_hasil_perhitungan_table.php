<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubKriteriaIdToHasilPerhitunganTable extends Migration
{
    public function up()
    {
        Schema::table('hasil_perhitungan', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_kriteria_id')->nullable()->after('kriteria_id');

            $table->foreign('sub_kriteria_id')
                ->references('id')
                ->on('sub_kriteria')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('hasil_perhitungan', function (Blueprint $table) {
            $table->dropForeign(['sub_kriteria_id']);
            $table->dropColumn('sub_kriteria_id');
        });
    }
}
