<?php

use App\Http\Controllers\DashboardController;  
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Exports\RankingMahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\HasilPerhitungan;



Route::get('/', function () {
    return view('homepage');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/tambah_mahasiswa', [AdminController::class, 'tambahMahasiswa'])->name('admin.tambah_mahasiswa');
    Route::post('/tambah_mahasiswa', [AdminController::class, 'simpanMahasiswa'])->name('admin.simpan_mahasiswa');

    Route::get('/perhitungan', [AdminController::class, 'perhitungan'])->name('admin.perhitungan');

    Route::get('/hasil_perhitungan', [AdminController::class, 'hasilPerhitungan'])->name('admin.hasil_perhitungan');

    Route::get('/edit_mahasiswa', [AdminController::class, 'editMahasiswa'])->name('admin.edit_mahasiswa');
    Route::post('/update_mahasiswa', [AdminController::class, 'updateMahasiswa'])->name('admin.update_mahasiswa');

    Route::get('/hapus_mahasiswa', [AdminController::class, 'hapusMahasiswa'])->name('admin.hapus_mahasiswa');
    Route::delete('/hapus_mahasiswa/{id}', [AdminController::class, 'destroyMahasiswa'])->name('admin.destroy_mahasiswa');

    // Route untuk halaman laporan (view)
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');

    // Route untuk generate dan download PDF laporan
    Route::get('/laporan/pdf', [AdminController::class, 'laporanPdf'])->name('admin.laporan.pdf');

    Route::get('/laporan/excel', function () {
    $rankingData = HasilPerhitungan::select('nama_peserta')
        ->selectRaw('AVG(nilai_cf) as nilai_core_factor')
        ->selectRaw('AVG(nilai_sf) as nilai_secondary_factor')
        ->selectRaw('AVG(nilai_total) as nilai_total')
        ->groupBy('nama_peserta')
        ->orderByDesc('nilai_total')
        ->get();

    return Excel::download(new RankingMahasiswaExport($rankingData), 'laporan_mahasiswa.xlsx');
})->name('admin.laporan.excel');


});



require __DIR__.'/auth.php';