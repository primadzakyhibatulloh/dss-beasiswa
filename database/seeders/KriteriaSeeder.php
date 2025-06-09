<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => 'K1', 'nama' => 'IPK', 'faktor' => 'core', 'bobot' => 15, 'nilai_ideal' => 4],
            ['kode' => 'K2', 'nama' => 'Penghasilan Orang Tua', 'faktor' => 'core', 'bobot' => 10, 'nilai_ideal' => 4],
            ['kode' => 'K3', 'nama' => 'Motivation Letter', 'faktor' => 'core', 'bobot' => 10, 'nilai_ideal' => 4],
            ['kode' => 'K4', 'nama' => 'Sertifikat Prestasi', 'faktor' => 'core', 'bobot' => 10, 'nilai_ideal' => 2],
            ['kode' => 'K5', 'nama' => 'Status Tempat Tinggal', 'faktor' => 'core', 'bobot' => 5, 'nilai_ideal' => 4],
            ['kode' => 'K6', 'nama' => 'Keaktifan Volunteer', 'faktor' => 'secondary', 'bobot' => 10, 'nilai_ideal' => 3],
            ['kode' => 'K7', 'nama' => 'Keaktifan Organisasi', 'faktor' => 'secondary', 'bobot' => 15, 'nilai_ideal' => 3],
            ['kode' => 'K8', 'nama' => 'Jumlah Tanggungan Orang Tua', 'faktor' => 'secondary', 'bobot' => 10, 'nilai_ideal' => 3],
            ['kode' => 'K9', 'nama' => 'Skor TOEFL', 'faktor' => 'secondary', 'bobot' => 10, 'nilai_ideal' => 3],
            ['kode' => 'K10', 'nama' => 'Kelengkapan Dokumen', 'faktor' => 'secondary', 'bobot' => 10, 'nilai_ideal' => 4],
        ];

        DB::table('kriteria')->insert($data);
    }
}
