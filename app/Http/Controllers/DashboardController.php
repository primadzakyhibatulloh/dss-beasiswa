<?php

namespace App\Http\Controllers;

use App\Models\HasilPerhitungan;
use App\Models\Kriteria;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah peserta unik
        $jumlahPeserta = HasilPerhitungan::distinct('nama_peserta')->count('nama_peserta');

        // Hitung jumlah kriteria
        $jumlahKriteria = Kriteria::count();

        // Hitung total data perhitungan
        $totalPerhitungan = HasilPerhitungan::count();

        // Grafik: rata-rata bobot per kriteria
        $grafikData = HasilPerhitungan::select('kriteria_id', DB::raw('AVG(nilai_bobot) as rata_rata_bobot'))
            ->groupBy('kriteria_id')
            ->with('kriteria')
            ->get();

        // Ambil semua peserta unik
        $pesertaList = HasilPerhitungan::select('nama_peserta')->distinct()->pluck('nama_peserta');

        $hasilPeserta = [];

        foreach ($pesertaList as $peserta) {
            // Ambil data per peserta
            $dataPeserta = HasilPerhitungan::where('nama_peserta', $peserta)->get();

            // Ambil nilai rata-rata CF, SF, dan total dari database (bukan dihitung ulang)
            $nilaiCF = $dataPeserta->avg('nilai_cf');
            $nilaiSF = $dataPeserta->avg('nilai_sf');
            $nilaiTotal = $dataPeserta->avg('nilai_total');

            $hasilPeserta[] = [
                'nama' => $peserta,
                'nilai_cf' => round($nilaiCF, 2),
                'nilai_sf' => round($nilaiSF, 2),
                'nilai_total' => round($nilaiTotal, 2),
            ];
        }

        return view('admin.dashboard', compact(
            'jumlahPeserta',
            'jumlahKriteria',
            'totalPerhitungan',
            'grafikData',
            'hasilPeserta'
        ));
    }
}
