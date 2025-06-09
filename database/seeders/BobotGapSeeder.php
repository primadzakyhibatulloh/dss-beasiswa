<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BobotGapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['selisih' => 0, 'nilai_bobot' => 5],
            ['selisih' => 1, 'nilai_bobot' => 4.5],
            ['selisih' => -1, 'nilai_bobot' => 4],
            ['selisih' => 2, 'nilai_bobot' => 3.5],
            ['selisih' => -2, 'nilai_bobot' => 3],
            ['selisih' => 3, 'nilai_bobot' => 2.5],
            ['selisih' => -3, 'nilai_bobot' => 2],
            ['selisih' => 4, 'nilai_bobot' => 1.5],
            ['selisih' => -4, 'nilai_bobot' => 1],
        ];

        DB::table('bobot_gap')->insert($data);
    }
}
