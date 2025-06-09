<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $kriteria = DB::table('kriteria')->get()->keyBy('kode');

        $data = [
            ['K1', 1, '< 2.75'],
            ['K1', 2, '2.75 - 3.00'],
            ['K1', 3, '> 3.00 - 3.25'],
            ['K1', 4, '> 3.25 - 3.50'],
            ['K1', 5, '> 3.50'],

            ['K2', 1, '> Rp5.000.000'],
            ['K2', 2, 'Rp4.000.000 - Rp5.000.000'],
            ['K2', 3, '> Rp2.500.000 – Rp4.000.000'],
            ['K2', 4, '> Rp1.000.000 – Rp2.500.000'],
            ['K2', 5, '≤ Rp1.000.000'],

            ['K3', 1, 'Tidak ada struktur, tujuan tidak jelas, banyak kesalahan bahasa'],
            ['K3', 2, 'Tujuan tidak sesuai beasiswa, kurang relevansi, argumen tidak logis'],
            ['K3', 3, 'Menyampaikan alasan yang relevan namun kurang mendalam'],
            ['K3', 4, 'Tujuan pendidikan dan kontribusi sosial cukup jelas dan terstruktur'],
            ['K3', 5, 'Tujuan karir kuat, relevan, personal, dan sesuai visi beasiswa'],

            ['K4', 1, 'Sebagai Peserta'],
            ['K4', 2, 'Tingkat Kabupaten / Kota'],
            ['K4', 3, 'Tingkat Provinsi'],
            ['K4', 4, 'Tingkat Nasional'],
            ['K4', 5, 'Tingkat Internasional'],

            ['K5', 1, 'Rumah milik sendiri tipe besar / memiliki aset lain'],
            ['K5', 2, 'Rumah milik sendiri tipe sederhana'],
            ['K5', 3, 'Rumah milik orang tua non permanen / subsidi'],
            ['K5', 4, 'Mengontrak / kos sederhana'],
            ['K5', 5, 'Menumpang di rumah saudara / kerabat'],

            ['K6', 1, 'Tidak Mengikuti'],
            ['K6', 2, '1 kegiatan'],
            ['K6', 3, '2 kegiatan'],
            ['K6', 4, '3 kegiatan'],
            ['K6', 5, '> 4 kegiatan'],

            ['K7', 1, 'Tidak Mengikuti'],
            ['K7', 2, 'Anggota'],
            ['K7', 3, 'Staf'],
            ['K7', 4, 'Koordinator Divisi / Setingkat'],
            ['K7', 5, 'Ketua / Wakil Umum'],

            ['K8', 1, '1 orang'],
            ['K8', 2, '2 orang'],
            ['K8', 3, '3 orang'],
            ['K8', 4, '4 orang'],
            ['K8', 5, '> 5 orang'],

            ['K9', 1, '< 350'],
            ['K9', 2, '350 - 399'],
            ['K9', 3, '400 - 449'],
            ['K9', 4, '450 - 499'],
            ['K9', 5, '>= 500'],

            ['K10', 1, 'Tidak melampirkan dokumen sama sekali'],
            ['K10', 2, 'Dokumen tidak lengkap dan tidak sesuai format'],
            ['K10', 3, 'Lengkap tapi tidak sesuai format'],
            ['K10', 4, 'Lengkap dan sesuai format'],
            ['K10', 5, 'Lengkap, terstruktur & bukti tambahan'],
        ];

        foreach ($data as $item) {
            DB::table('sub_kriteria')->insert([
                'kriteria_id' => $kriteria[$item[0]]->id,
                'nilai' => $item[1],
                'deskripsi' => $item[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
