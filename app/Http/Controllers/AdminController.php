<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\BobotGap;
use App\Models\HasilPerhitungan;
use PDF;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function tambahMahasiswa()
    {
        $kriterias = Kriteria::with('sub_kriteria')->get();
        return view('admin.tambah_mahasiswa', compact('kriterias'));
    }

    public function simpanMahasiswa(Request $request)
    {
        // Gunakan input 'peserta' supaya konsisten dengan form edit/update
        $namaPeserta = $request->input('peserta') ?? $request->input('nama_peserta');

        $kriterias = Kriteria::with('sub_kriteria')->get();

        $totalCf = 0;
        $totalSf = 0;
        $jumlahCf = 0;
        $jumlahSf = 0;

        foreach ($kriterias as $kriteria) {
            $nilaiSub = $request->input('kriteria_' . $kriteria->id);
            if ($nilaiSub === null) continue;

            $nilaiIdeal = $kriteria->nilai_ideal;
            $nilaiGap = $nilaiSub - $nilaiIdeal;

            $bobotRecord = BobotGap::where('selisih', $nilaiGap)->first();
            $nilaiBobot = $bobotRecord ? $bobotRecord->nilai_bobot : 0;

            if (strtolower($kriteria->faktor) === 'core') {
                $nilai_cf = $nilaiBobot;
                $nilai_sf = null;
                $totalCf += $nilai_cf;
                $jumlahCf++;
            } else {
                $nilai_cf = null;
                $nilai_sf = $nilaiBobot;
                $totalSf += $nilai_sf;
                $jumlahSf++;
            }

           $subKriteria = $kriteria->sub_kriteria()->where('nilai', $nilaiSub)->first();

            HasilPerhitungan::create([
                'nama_peserta' => $namaPeserta,
                'kriteria_id' => $kriteria->id,
                'sub_kriteria_id' => $subKriteria ? $subKriteria->id : null,
                'nilai_subkriteria' => $nilaiSub,
                'nilai_ideal' => $nilaiIdeal,
                'nilai_gap' => $nilaiGap,
                'nilai_bobot' => $nilaiBobot,
                'nilai_cf' => $nilai_cf,
                'nilai_sf' => $nilai_sf,
                'nilai_total' => 0,
            ]);

        }

        $rataCf = $jumlahCf ? $totalCf / $jumlahCf : 0;
        $rataSf = $jumlahSf ? $totalSf / $jumlahSf : 0;
        $nilaiTotal = ($rataCf * 0.6) + ($rataSf * 0.4);

        HasilPerhitungan::where('nama_peserta', $namaPeserta)
            ->update(['nilai_total' => $nilaiTotal]);

        return redirect('/admin/tambah_mahasiswa')->with('success', 'Data mahasiswa berhasil disimpan!');
    }


    public function perhitungan(Request $request)
    {
        $daftar_peserta = HasilPerhitungan::select('nama_peserta')->distinct()->pluck('nama_peserta');

        $hasilPerhitungan = null;
        $peserta_terpilih = $request->peserta;

        if ($peserta_terpilih) {
            $hasilPerhitungan = HasilPerhitungan::with(['kriteria', 'sub_kriteria'])
                ->where('nama_peserta', $peserta_terpilih)
                ->orderBy('kriteria_id')
                ->get();
        }

        return view('admin.perhitungan', compact('daftar_peserta', 'hasilPerhitungan', 'peserta_terpilih'));
    }

   public function hasilPerhitungan()
    {
    // Total mahasiswa unik berdasarkan nama_peserta
    $totalMahasiswa = HasilPerhitungan::distinct()->count('nama_peserta');

    // Ambil nilai_total tertinggi per mahasiswa
    $nilaiTotals = HasilPerhitungan::select('nama_peserta', DB::raw('MAX(nilai_total) as nilai_total'))
        ->groupBy('nama_peserta')
        ->orderByDesc('nilai_total')
        ->get();

    // Total data perhitungan (jumlah semua baris pada tabel hasil_perhitungan)
    $totalDataPerhitungan = HasilPerhitungan::count();

    // Rata-rata nilai_total semua mahasiswa (dari nilai tertinggi masing-masing mahasiswa)
    $rataRataTotal = $nilaiTotals->avg('nilai_total');

    // Rata-rata nilai Core Factor dan Secondary Factor secara global (semua mahasiswa)
    $rataCf = HasilPerhitungan::whereHas('kriteria', function ($query) {
        $query->where('faktor', 'core');
    })->avg('nilai_bobot');

    $rataSf = HasilPerhitungan::whereHas('kriteria', function ($query) {
        $query->where('faktor', 'secondary');
    })->avg('nilai_bobot');

    // Data grafik peringkat mahasiswa berdasarkan nilai_total
    $dataGrafikPeringkat = $nilaiTotals->map(function ($item) {
        return [
            'nama' => $item->nama_peserta,
            'nilai_total' => round($item->nilai_total, 2),
        ];
    });

    // --- DATA CORE & SECONDARY FACTOR PER MAHASISWA ---
    $namaPesertaList = HasilPerhitungan::select('nama_peserta')->distinct()->pluck('nama_peserta');

    $dataCoreSecondary = $namaPesertaList->map(function ($nama) {
        $core = HasilPerhitungan::where('nama_peserta', $nama)
            ->whereHas('kriteria', function ($q) {
                $q->where('faktor', 'core');
            })->avg('nilai_bobot');

        $secondary = HasilPerhitungan::where('nama_peserta', $nama)
            ->whereHas('kriteria', function ($q) {
                $q->where('faktor', 'secondary');
            })->avg('nilai_bobot');

        return [
            'nama' => $nama,
            'core_factor' => round($core ?? 0, 2),
            'secondary_factor' => round($secondary ?? 0, 2),
        ];
    });

    // Jumlah mahasiswa yang punya minimal satu nilai_total < 3
    $jumlahMahasiswaRendah = HasilPerhitungan::where('nilai_total', '<', 3)
        ->distinct('nama_peserta')
        ->count('nama_peserta');

    return view('admin.hasil_perhitungan', compact(
        'totalMahasiswa',
        'totalDataPerhitungan',
        'nilaiTotals',
        'rataRataTotal',
        'rataCf',
        'rataSf',
        'dataGrafikPeringkat',
        'dataCoreSecondary',
        'jumlahMahasiswaRendah'
    ));
}


    public function editMahasiswa(Request $request)
    {
        $daftar_peserta = HasilPerhitungan::select('nama_peserta')->distinct()->pluck('nama_peserta');
        $peserta = $request->input('peserta');
        $kriterias = Kriteria::with('sub_kriteria')->get();
        $dataNilai = [];

        if ($peserta) {
            $dataNilai = HasilPerhitungan::where('nama_peserta', $peserta)
                ->pluck('nilai_subkriteria', 'kriteria_id')->toArray();
        }

        return view('admin.edit_mahasiswa', compact('daftar_peserta', 'peserta', 'kriterias', 'dataNilai'));
    }


    public function updateMahasiswa(Request $request)
    {
        $namaPeserta = $request->input('peserta');
        HasilPerhitungan::where('nama_peserta', $namaPeserta)->delete();

        return $this->simpanMahasiswa($request);
    }

    public function hapusMahasiswa()
    {
        $mahasiswas = HasilPerhitungan::select('nama_peserta')->distinct()->get();
        return view('admin.hapus_mahasiswa', compact('mahasiswas'));
    }

    public function destroyMahasiswa($namaPeserta)
    {
        HasilPerhitungan::where('nama_peserta', $namaPeserta)->delete();
        return redirect()->route('admin.hapus_mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    
public function laporan(Request $request)
{
    $query = HasilPerhitungan::select('nama_peserta', DB::raw('
            AVG(CASE WHEN kriteria.faktor = "core" THEN nilai_bobot ELSE NULL END) as nilai_core_factor,
            AVG(CASE WHEN kriteria.faktor = "secondary" THEN nilai_bobot ELSE NULL END) as nilai_secondary_factor,
            MAX(nilai_total) as nilai_total
        '))
        ->join('kriteria', 'hasil_perhitungan.kriteria_id', '=', 'kriteria.id')
        ->groupBy('nama_peserta');

    // Jika ada keyword pencarian
    if ($request->filled('cari')) {
        $query->having('nama_peserta', 'like', '%' . $request->cari . '%');
    }

    $rankingData = $query->orderByDesc('nilai_total')->get();

    // Ranking dan pembulatan nilai
    $rankingData->transform(function ($item, $key) {
        $item->ranking = $key + 1;
        $item->nilai_core_factor = round($item->nilai_core_factor, 2);
        $item->nilai_secondary_factor = round($item->nilai_secondary_factor, 2);
        $item->nilai_total = round($item->nilai_total, 2);
        return $item;
    });

    return view('admin.laporan', compact('rankingData'));
}

public function laporanPdf()
{
    $rankingData = HasilPerhitungan::select('nama_peserta', DB::raw('
            AVG(CASE WHEN kriteria.faktor = "core" THEN nilai_bobot ELSE NULL END) as nilai_core_factor,
            AVG(CASE WHEN kriteria.faktor = "secondary" THEN nilai_bobot ELSE NULL END) as nilai_secondary_factor,
            MAX(nilai_total) as nilai_total
        '))
        ->join('kriteria', 'hasil_perhitungan.kriteria_id', '=', 'kriteria.id')
        ->groupBy('nama_peserta')
        ->orderByDesc('nilai_total')
        ->get();

    $rankingData->transform(function ($item, $key) {
        $item->ranking = $key + 1;
        $item->nilai_core_factor = round($item->nilai_core_factor, 2);
        $item->nilai_secondary_factor = round($item->nilai_secondary_factor, 2);
        $item->nilai_total = round($item->nilai_total, 2);
        return $item;
    });

    $pdf = PDF::loadView('admin.laporan_pdf', compact('rankingData'))->setPaper('a4', 'landscape');

    return $pdf->download('laporan_mahasiswa.pdf');
}

}
