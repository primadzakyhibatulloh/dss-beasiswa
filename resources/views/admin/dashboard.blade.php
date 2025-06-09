@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-indigo-800">Dashboard Admin</h1>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-gradient-to-r from-indigo-200 via-indigo-100 to-white p-5 rounded-2xl shadow-md">
            <h2 class="text-xl font-semibold text-indigo-800">Jumlah Peserta</h2>
            <p class="text-4xl font-bold text-indigo-900 mt-2">{{ $jumlahPeserta }}</p>
        </div>
        <div class="bg-gradient-to-r from-purple-200 via-purple-100 to-white p-5 rounded-2xl shadow-md">
            <h2 class="text-xl font-semibold text-purple-800">Jumlah Kriteria</h2>
            <p class="text-4xl font-bold text-purple-900 mt-2">{{ $jumlahKriteria }}</p>
        </div>
    </div>

    {{-- Nilai Tertinggi & Terendah --}}
    @php
        $nilaiTertinggi = collect($hasilPeserta)->max('nilai_total');
        $nilaiTerendah = collect($hasilPeserta)->min('nilai_total');
        $pesertaTertinggi = collect($hasilPeserta)->firstWhere('nilai_total', $nilaiTertinggi);
        $pesertaTerendah = collect($hasilPeserta)->firstWhere('nilai_total', $nilaiTerendah);
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-green-100 p-5 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-green-800 mb-2">Nilai Tertinggi</h2>
            <div class="flex justify-between items-center">
                <span class="font-bold text-lg text-green-900">{{ $pesertaTertinggi['nama'] }}</span>
                <span class="bg-green-200 px-3 py-1 rounded-full text-sm font-semibold text-green-800">{{ number_format($nilaiTertinggi, 2) }}</span>
            </div>
        </div>
        <div class="bg-red-100 p-5 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-red-800 mb-2">Nilai Terendah</h2>
            <div class="flex justify-between items-center">
                <span class="font-bold text-lg text-red-900">{{ $pesertaTerendah['nama'] }}</span>
                <span class="bg-red-200 px-3 py-1 rounded-full text-sm font-semibold text-red-800">{{ number_format($nilaiTerendah, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Grafik Perbandingan Nilai Total --}}
    <div class="mb-12 bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-4 text-indigo-700">Grafik Perbandingan Nilai Peserta</h2>
        <canvas id="chartNilaiTotal" height="100"></canvas>
    </div>

    {{-- Tabel Daftar Peserta --}}
    <div class="mb-6 bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-4 text-indigo-700">Daftar Peserta dan Nilai</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-indigo-100 text-indigo-900">
                        <th class="py-3 px-6 border">Nama Peserta</th>
                        <th class="py-3 px-6 border">Nilai Core Factor (CF)</th>
                        <th class="py-3 px-6 border">Nilai Secondary Factor (SF)</th>
                        <th class="py-3 px-6 border">Nilai Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hasilPeserta as $peserta)
                        <tr class="text-center border-t border-gray-200 hover:bg-indigo-50 transition-all duration-300">
                            <td class="py-3 px-6">{{ $peserta['nama'] }}</td>
                            <td class="py-3 px-6 font-semibold text-indigo-700">{{ number_format($peserta['nilai_cf'], 2) }}</td>
                            <td class="py-3 px-6 font-semibold text-indigo-700">{{ number_format($peserta['nilai_sf'], 2) }}</td>
                            <td class="py-3 px-6 font-bold text-indigo-900">{{ number_format($peserta['nilai_total'], 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">Belum ada data peserta.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('chartNilaiTotal').getContext('2d');
        const labels = @json(collect($hasilPeserta)->pluck('nama'));
        const data = @json(collect($hasilPeserta)->pluck('nilai_total'));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai Total Peserta',
                    data: data,
                    backgroundColor: 'rgba(79, 70, 229, 0.7)',
                    borderColor: 'rgba(67, 56, 202, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                    hoverBackgroundColor: 'rgba(99, 102, 241, 1)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5,
                        ticks: {
                            stepSize: 0.5
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' Nilai: ' + context.parsed.y.toFixed(2);
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
