<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\KriteriaSeeder;
use Database\Seeders\SubKriteriaSeeder;
use Database\Seeders\BobotGapSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        KriteriaSeeder::class,
        SubKriteriaSeeder::class,
        BobotGapSeeder::class,
    ]);
    }
}
