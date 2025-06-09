@extends('admin.layout')

@section('title', 'Hasil Perhitungan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-extrabold text-indigo-700 mb-8">Dashboard Hasil Perhitungan Mahasiswa</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-indigo-100 rounded-lg shadow p-6 text-center">
            <h2 class="text-xl font-semibold mb-2 text-indigo-800">Total Data Perhitungan</h2>
            <p class="text-3xl font-bold text-indigo-900">{{ $totalDataPerhitungan }}</p>
            <span class="inline-block mt-2 text-sm text-indigo-700 bg-indigo-200 rounded-full px-3 py-1">Jumlah mahasiswa × kategori</span>
        </div>

        <div class="bg-green-100 rounded-lg shadow p-6 text-center">
            <h2 class="text-xl font-semibold mb-2 text-green-800">Rata-rata Nilai Total</h2>
            <p class="text-3xl font-bold text-green-900">{{ number_format($rataRataTotal, 2) }}</p>
        </div>

        <div class="bg-yellow-100 rounded-lg shadow p-6 text-center">
            <h2 class="text-xl font-semibold mb-2 text-yellow-800">Jumlah Mahasiswa</h2>
            <p class="text-3xl font-bold text-yellow-900">{{ $totalMahasiswa }}</p>
        </div>

        <div class="bg-red-100 rounded-lg shadow p-6 text-center">
            <h2 class="text-xl font-semibold mb-2 text-red-800">Mahasiswa Nilai < 3</h2>
            <p class="text-3xl font-bold text-red-900">{{ $jumlahMahasiswaRendah }}</p>
            <span class="inline-block mt-2 text-sm text-red-700 bg-red-200 rounded-full px-3 py-1">Perlu perhatian khusus</span>
        </div>
    </div>

    <section class="mb-8">
        <h2 class="text-3xl font-semibold mb-5 border-b-2 border-indigo-500 pb-2">Daftar Nilai Total Mahasiswa</h2>

        @if($nilaiTotals->isEmpty())
            <p class="text-center text-gray-600 italic">Data mahasiswa belum tersedia.</p>
        @else
            <div class="overflow-x-auto rounded shadow">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-indigo-50 text-indigo-700 font-semibold">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-300 text-left">Nama Mahasiswa</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-right">Nilai Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilaiTotals as $item)
                        <tr class="hover:bg-indigo-50 transition-colors duration-150">
                            <td class="px-6 py-3 border-b border-gray-200">{{ $item->nama_peserta }}</td>
                            <td class="px-6 py-3 border-b border-gray-200 text-right font-mono">{{ number_format($item->nilai_total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="mt-4 text-sm text-gray-600 italic">
    <strong>Kelompok Nilai:</strong><br>
    • <span class="font-semibold text-red-600">Rendah:</span> Nilai total kurang dari 3.<br>
    • <span class="font-semibold text-yellow-600">Sedang:</span> Nilai total antara 3 sampai 3.5 (inklusif).<br>
    • <span class="font-semibold text-green-600">Tinggi:</span> Nilai total lebih dari 3.5.
</p>

        @endif
    </section>

    <section>
        <h2 class="text-3xl font-semibold mb-6 border-b-2 border-indigo-500 pb-2">Visualisasi Grafik</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- Peringkat Mahasiswa -->
            <div class="p-4 bg-white rounded-lg shadow" style="height: 350px;">
                <h3 class="text-xl font-semibold mb-4">Peringkat Mahasiswa Berdasarkan Nilai Total</h3>
                <canvas id="chartPeringkatMahasiswa" style="height: 250px;"></canvas>
            </div>

            <!-- Core & Secondary Factor -->
            <div class="p-4 bg-white rounded-lg shadow" style="height: 350px;">
                <h3 class="text-xl font-semibold mb-4">Nilai Core Factor dan Secondary Factor per Mahasiswa</h3>
                <canvas id="chartCoreSecondaryPerPeserta" style="height: 250px;"></canvas>
            </div>

            <!-- Persentase Kelompok Nilai -->
            <div class="p-4 bg-white rounded-lg shadow" style="height: 350px;">
                <h3 class="text-xl font-semibold mb-4">Persentase Mahasiswa berdasarkan Kelompok Nilai</h3>
                <canvas id="chartPersentaseKelompok" style="height: 250px;"></canvas>
            </div>

            <!-- Rata-rata Core vs Secondary -->
            <div class="p-4 bg-white rounded-lg shadow" style="height: 350px;">
                <h3 class="text-xl font-semibold mb-4">Rata-rata Nilai Core Factor vs Secondary Factor</h3>
                <canvas id="chartCoreVsSecondary" style="height: 250px;"></canvas>
            </div>

            <!-- Histogram Distribusi Nilai Total -->
            <div class="p-4 bg-white rounded-lg shadow md:col-span-2" style="height: 350px;">
                <h3 class="text-xl font-semibold mb-4">Distribusi Nilai Total Mahasiswa (Histogram)</h3>
                <canvas id="chartHistogramNilaiTotal" style="height: 280px;"></canvas>
            </div>

        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data peringkat mahasiswa
    const dataPeringkat = @json($dataGrafikPeringkat);
    const labelsPeringkat = dataPeringkat.map(item => item.nama);
    const valuesPeringkat = dataPeringkat.map(item => item.nilai_total);

    const ctxPeringkat = document.getElementById('chartPeringkatMahasiswa').getContext('2d');
    new Chart(ctxPeringkat, {
        type: 'bar',
        data: {
            labels: labelsPeringkat,
            datasets: [{
                label: 'Nilai Total',
                data: valuesPeringkat,
                backgroundColor: 'rgba(14, 165, 233, 0.7)',
                borderColor: 'rgba(2, 132, 199, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            scales: { x: { beginAtZero: true } },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Core & Secondary Factor per mahasiswa
    const dataCoreSecondary = @json($dataCoreSecondary);
    const labelsCoreSecondary = dataCoreSecondary.map(item => item.nama);
    const coreValues = dataCoreSecondary.map(item => item.core_factor);
    const secondaryValues = dataCoreSecondary.map(item => item.secondary_factor);

    const ctxCoreSecondary = document.getElementById('chartCoreSecondaryPerPeserta').getContext('2d');
    new Chart(ctxCoreSecondary, {
        type: 'bar',
        data: {
            labels: labelsCoreSecondary,
            datasets: [
                {
                    label: 'Core Factor',
                    data: coreValues,
                    backgroundColor: 'rgba(99, 102, 241, 0.7)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Secondary Factor',
                    data: secondaryValues,
                    backgroundColor: 'rgba(251, 191, 36, 0.7)',
                    borderColor: 'rgba(202, 138, 4, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: { y: { beginAtZero: true } },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Persentase mahasiswa berdasarkan kelompok nilai
    const nilaiTotals = @json($nilaiTotals->pluck('nilai_total'));

// Sesuaikan sesuai ketentuan baru
const lowCount = nilaiTotals.filter(v => v < 3).length;
const midCount = nilaiTotals.filter(v => v >= 3 && v <= 3.5).length;
const highCount = nilaiTotals.filter(v => v > 3.5).length;


    const ctxPersentase = document.getElementById('chartPersentaseKelompok').getContext('2d');
    new Chart(ctxPersentase, {
        type: 'pie',
        data: {
            labels: ['Rendah', 'Sedang', 'Tinggi'],
            datasets: [{
                data: [lowCount, midCount, highCount],
                backgroundColor: [
                    'rgba(250, 204, 21, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(34, 197, 94, 0.8)'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Rata-rata Core Factor dan Secondary Factor
    const rataCf = {{ number_format($rataCf, 2, '.', '') }};
    const rataSf = {{ number_format($rataSf, 2, '.', '') }};

    const ctxCoreVsSecondary = document.getElementById('chartCoreVsSecondary').getContext('2d');
    new Chart(ctxCoreVsSecondary, {
        type: 'doughnut',
        data: {
            labels: ['Core Factor', 'Secondary Factor'],
            datasets: [{
                label: 'Rata-rata Nilai',
                data: [rataCf, rataSf],
                backgroundColor: [
                    'rgba(147, 197, 253, 0.8)',
                    'rgba(253, 224, 71, 0.8)'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

   // Histogram Distribusi Nilai Total Mahasiswa
const nilaiTotalArray = @json($nilaiTotals->pluck('nilai_total'));

// Tentukan bins dengan rentang 0.5
const binWidth = 0.5;
const minVal = Math.floor(Math.min(...nilaiTotalArray) / binWidth) * binWidth;
const maxVal = Math.ceil(Math.max(...nilaiTotalArray) / binWidth) * binWidth;

// Hitung jumlah bins
const binCount = Math.ceil((maxVal - minVal) / binWidth);

let bins = new Array(binCount).fill(0);
nilaiTotalArray.forEach(v => {
    let binIndex = Math.floor((v - minVal) / binWidth);
    if (binIndex >= binCount) binIndex = binCount - 1; // kasus nilai max
    bins[binIndex]++;
});

let labelsHistogram = [];
for(let i = 0; i < binCount; i++){
    let start = (minVal + i * binWidth).toFixed(2);
    let end = (minVal + (i + 1) * binWidth).toFixed(2);
    labelsHistogram.push(`${start} - ${end}`);
}

const ctxHistogram = document.getElementById('chartHistogramNilaiTotal').getContext('2d');
new Chart(ctxHistogram, {
    type: 'bar',
    data: {
        labels: labelsHistogram,
        datasets: [{
            label: 'Jumlah Mahasiswa',
            data: bins,
            backgroundColor: 'rgba(99, 102, 241, 0.7)',
            borderColor: 'rgba(79, 70, 229, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
        responsive: true,
        maintainAspectRatio: false
    }
});


</script>
@endsection
