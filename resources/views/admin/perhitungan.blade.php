@extends('admin.layout')

@section('title', 'Proses Perhitungan Data')

@section('content')
<div class="container mx-auto max-w-7xl px-4 py-8 animate-fadeIn">
    <div class="mb-10">
        <h2 class="text-4xl font-extrabold text-yellow-800 mb-3 border-b-4 border-yellow-400 pb-3 shadow-md">📊 Perhitungan Profile Matching</h2>
        <p class="text-yellow-900 text-lg">Analisis lengkap nilai peserta berdasarkan kriteria, GAP, dan faktor.</p>
    </div>

    {{-- Pilih Peserta --}}
    <form method="GET" action="{{ route('admin.perhitungan') }}" class="mb-8 max-w-md transition-transform hover:scale-105">
        <label for="peserta" class="block mb-2 text-lg font-medium text-yellow-700">Pilih Peserta:</label>
        <select name="peserta" id="peserta"
            onchange="this.form.submit()"
            class="w-full p-3 border border-yellow-400 rounded-lg text-yellow-800 bg-yellow-50 shadow-sm hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            <option value="">-- Pilih Peserta --</option>
            @foreach($daftar_peserta as $peserta)
                <option value="{{ $peserta }}" {{ ($peserta == $peserta_terpilih) ? 'selected' : '' }}>{{ $peserta }}</option>
            @endforeach
        </select>
    </form>

    @if($hasilPerhitungan && $hasilPerhitungan->count())
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-yellow-900">Nama Peserta:
                <span class="text-yellow-600 font-bold">{{ $peserta_terpilih }}</span>
            </h3>
        </div>

        {{-- Accordion untuk setiap bagian --}}
        <div class="space-y-6">

            {{-- SECTION 1 --}}
            <details class="group border-l-4 border-yellow-500 bg-yellow-50 shadow-md p-4 rounded-md">
                <summary class="cursor-pointer font-semibold text-yellow-800 text-lg hover:text-yellow-600 flex justify-between items-center">
                    1. Nilai Input Per Kriteria
                    <span class="transition-transform duration-300 group-open:rotate-180">▼</span>
                </summary>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full text-sm bg-white border border-yellow-300 rounded-md shadow-sm">
                        <thead class="bg-yellow-100 text-yellow-700 font-semibold">
                            <tr>
                                <th class="px-4 py-2 text-left">Kriteria</th>
                                <th class="px-4 py-2 text-center">Nilai Input</th>
                                <th class="px-4 py-2 text-left">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hasilPerhitungan as $item)
                            <tr class="hover:bg-yellow-50 transition">
                                <td class="border-t px-4 py-2">{{ $item->kriteria->nama }}</td>
                                <td class="border-t px-4 py-2 text-center font-mono text-yellow-900">{{ $item->nilai_subkriteria }}</td>
                                <td class="border-t px-4 py-2 italic">{{ $item->deskripsi_sub_kriteria }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            {{-- SECTION 2 --}}
            <details class="group border-l-4 border-yellow-500 bg-yellow-50 shadow-md p-4 rounded-md">
                <summary class="cursor-pointer font-semibold text-yellow-800 text-lg hover:text-yellow-600 flex justify-between items-center">
                    2. GAP, Nilai Ideal, Bobot dan Faktor
                    <span class="transition-transform duration-300 group-open:rotate-180">▼</span>
                </summary>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full text-sm bg-white border border-yellow-300 rounded-md shadow-sm">
                        <thead class="bg-yellow-100 text-yellow-700 font-semibold">
                            <tr>
                                <th class="px-3 py-2">Kriteria</th>
                                <th class="px-3 py-2 text-center">Ideal</th>
                                <th class="px-3 py-2 text-center">Input</th>
                                <th class="px-3 py-2 text-center">GAP</th>
                                <th class="px-3 py-2 text-center">Bobot</th>
                                <th class="px-3 py-2 text-center">Faktor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hasilPerhitungan as $item)
                            <tr class="hover:bg-yellow-50 transition">
                                <td class="border-t px-3 py-2">{{ $item->kriteria->nama }}</td>
                                <td class="border-t text-center px-3 py-2 font-mono">{{ $item->nilai_ideal }}</td>
                                <td class="border-t text-center px-3 py-2 font-mono">{{ $item->nilai_subkriteria }}</td>
                                <td class="border-t text-center px-3 py-2 font-mono">{{ $item->nilai_gap }}</td>
                                <td class="border-t text-center px-3 py-2 font-mono">{{ $item->nilai_bobot }}</td>
                                <td class="border-t text-center px-3 py-2 capitalize">{{ $item->kriteria->faktor }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            {{-- SECTION: Tabel Bobot GAP --}}
<details class="group border-l-4 border-yellow-500 bg-yellow-50 shadow-md p-4 rounded-md">
    <summary class="cursor-pointer font-semibold text-yellow-800 text-lg hover:text-yellow-600 flex justify-between items-center">
        3. Tabel Bobot GAP
        <span class="transition-transform duration-300 group-open:rotate-180">▼</span>
    </summary>
    <div class="mt-4 overflow-x-auto">
        <p class="text-sm text-yellow-700 mb-3 italic">
    Tabel berikut menjelaskan konversi GAP ke bobot dalam metode Profile Matching:
</p>

       <table class="min-w-full text-sm bg-white border border-yellow-300 rounded-md shadow-sm"> 
    <thead class="bg-yellow-100 text-yellow-700 font-semibold">
        <tr>
            <th class="px-4 py-2 text-center">GAP</th>
            <th class="px-4 py-2 text-center">Bobot</th>
            <th class="px-4 py-2 text-left">Keterangan</th>
        </tr>
    </thead>
    <tbody class="text-yellow-900">
        <tr class="hover:bg-yellow-50 transition">
            <td class="border-t px-4 py-2 text-center">0</td>
            <td class="border-t px-4 py-2 text-center">5.0</td>
            <td class="border-t px-4 py-2">Kompetensi sesuai dengan yang dibutuhkan</td>
        </tr>
        <tr class="hover:bg-yellow-50 transition">
            <td class="border-t px-4 py-2 text-center">1</td>
            <td class="border-t px-4 py-2 text-center">4.5</td>
            <td class="border-t px-4 py-2">Kompetensi individu kelebihan 1 tingkat</td>
        </tr>
        <tr class="hover:bg-yellow-50 transition">
            <td class="border-t px-4 py-2 text-center">-1</td>
            <td class="border-t px-4 py-2 text-center">4.0</td>
            <td class="border-t px-4 py-2">Kompetensi individu kurang 1 tingkat</td>
        </tr>
        <tr class="hover:bg-yellow-50 transition">
            <td class="border-t px-4 py-2 text-center">2</td>
            <td class="border-t px-4 py-2 text-center">3.5</td>
            <td class="border-t px-4 py-2">Kompetensi individu kelebihan 2 tingkat</td>
        </tr>
        <tr class="hover:bg-yellow-50 transition">
            <td class="border-t px-4 py-2 text-center">-2</td>
            <td class="border-t px-4 py-2 text-center">3.0</td>
            <td class="border-t px-4 py-2">Kompetensi individu kurang 2 tingkat</td>
        </tr>
        <tr class="hover:bg-yellow-50 transition">
            <td class="border-t px-4 py-2 text-center">3</td>
            <td class="border-t px-4 py-2 text-center">2.5</td>
            <td class="border-t px-4 py-2">Kompetensi individu kelebihan 3 tingkat</td>
        </tr>
        <tr class="hover:bg-yellow-50 transition">
            <td class="border-t px-4 py-2 text-center">-3</td>
            <td class="border-t px-4 py-2 text-center">2.0</td>
            <td class="border-t px-4 py-2">Kompetensi individu kurang 3 tingkat</td>
        </tr>
        <tr class="hover:bg-yellow-50 transition">
            <td class="border-t px-4 py-2 text-center">4</td>
            <td class="border-t px-4 py-2 text-center">1.5</td>
            <td class="border-t px-4 py-2">Kompetensi individu kelebihan 4 tingkat</td>
        </tr>
        <tr class="hover:bg-yellow-50 transition">
            <td class="border-t px-4 py-2 text-center">-4</td>
            <td class="border-t px-4 py-2 text-center">1.0</td>
            <td class="border-t px-4 py-2">Kompetensi individu kurang 4 tingkat</td>
        </tr>
    </tbody>
</table>

    </div>
</details>


           
             {{-- SECTION 3 --}}
            <details class="group border-l-4 border-yellow-500 bg-yellow-50 shadow-md p-4 rounded-md">
                <summary class="cursor-pointer font-semibold text-yellow-800 text-lg hover:text-yellow-600 flex justify-between items-center">
                    3. Perhitungan CF dan SF
                    <span class="transition-transform duration-300 group-open:rotate-180">▼</span>
                </summary>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Core Factor --}}
                    <div class="bg-white border border-yellow-300 rounded-md shadow-sm p-4">
                        <h4 class="text-yellow-800 font-semibold mb-3">Core Factor (CF)</h4>
                        <ul class="space-y-2">
                            @php
                                $totalCf = 0;
                                $countCf = 0;
                                $nilaiCfList = [];
                            @endphp
                            @foreach($hasilPerhitungan as $item)
                                @if($item->kriteria->faktor == 'core')
                                    <li class="flex justify-between border-b pb-1 text-sm">
                                        <span>{{ $item->kriteria->nama }}</span>
                                        <span class="font-mono">{{ $item->nilai_cf ?? '-' }}</span>
                                        @php
                                            if($item->nilai_cf !== null) {
                                                $totalCf += $item->nilai_cf;
                                                $countCf++;
                                                $nilaiCfList[] = $item->nilai_cf;
                                            }
                                        @endphp
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="mt-3 text-yellow-800 text-sm">
                            Perhitungan: ({{ implode(' + ', $nilaiCfList) }}) / {{ $countCf }} = <strong>{{ number_format($countCf ? $totalCf / $countCf : 0, 2) }}</strong>
                        </div>
                        <div class="text-right font-bold text-yellow-700">
                            Rata-rata CF: {{ number_format($countCf ? $totalCf / $countCf : 0, 2) }}
                        </div>
                    </div>

                    {{-- Secondary Factor --}}
                    <div class="bg-white border border-yellow-300 rounded-md shadow-sm p-4">
                        <h4 class="text-yellow-800 font-semibold mb-3">Secondary Factor (SF)</h4>
                        <ul class="space-y-2">
                            @php
                                $totalSf = 0;
                                $countSf = 0;
                                $nilaiSfList = [];
                            @endphp
                            @foreach($hasilPerhitungan as $item)
                                @if($item->kriteria->faktor == 'secondary')
                                    <li class="flex justify-between border-b pb-1 text-sm">
                                        <span>{{ $item->kriteria->nama }}</span>
                                        <span class="font-mono">{{ $item->nilai_sf ?? '-' }}</span>
                                        @php
                                            if($item->nilai_sf !== null) {
                                                $totalSf += $item->nilai_sf;
                                                $countSf++;
                                                $nilaiSfList[] = $item->nilai_sf;
                                            }
                                        @endphp
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="mt-3 text-yellow-800 text-sm">
                            Perhitungan: ({{ implode(' + ', $nilaiSfList) }}) / {{ $countSf }} = <strong>{{ number_format($countSf ? $totalSf / $countSf : 0, 2) }}</strong>
                        </div>
                        <div class="text-right font-bold text-yellow-700">
                            Rata-rata SF: {{ number_format($countSf ? $totalSf / $countSf : 0, 2) }}
                        </div>
                    </div>
                </div>

                {{-- Nilai Total --}}
                @php
                    $rataCf = $countCf ? $totalCf / $countCf : 0;
                    $rataSf = $countSf ? $totalSf / $countSf : 0;
                    $totalNilai = ($rataCf * 0.6) + ($rataSf * 0.4);
                @endphp
                <div class="mt-6 text-center text-xl font-extrabold bg-yellow-200 border border-yellow-500 p-4 rounded-md text-yellow-800 shadow-inner">
                    Nilai Total = (CF × 60%) + (SF × 40%)<br>
                    = ({{ number_format($rataCf, 2) }} × 0.60) + ({{ number_format($rataSf, 2) }} × 0.40)<br>
                    = <span class="text-yellow-900">{{ number_format($totalNilai, 2) }}</span>
                </div>
            </details>
               

            {{-- SECTION 4 --}}
            <details class="group border-l-4 border-yellow-500 bg-yellow-50 shadow-md p-4 rounded-md">
                <summary class="cursor-pointer font-semibold text-yellow-800 text-lg hover:text-yellow-600 flex justify-between items-center">
                    4. Penjelasan Rumus & Konsep
                    <span class="transition-transform duration-300 group-open:rotate-180">▼</span>
                </summary>
                <div class="mt-4 text-sm text-yellow-900 leading-relaxed space-y-2">
                    <ul class="list-disc list-inside">
                        <li><strong>Nilai GAP</strong> = Nilai Subkriteria - Nilai Ideal</li>
                        <li><strong>Bobot</strong> didapat dari konversi nilai GAP ke skor pembobotan</li>
                        <li><strong>CF</strong> = Rata-rata bobot dari kriteria bertipe <code>core</code></li>
                        <li><strong>SF</strong> = Rata-rata bobot dari kriteria bertipe <code>secondary</code></li>
                        <li><strong>Nilai Total</strong> = (CF × 60%) + (SF × 40%)</li>
                    </ul>
                </div>
            </details>
        </div>
    @endif
</div>

{{-- Optional: Tambahkan animasi fadeIn --}}
<style>
    .animate-fadeIn {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    summary::-webkit-details-marker {
        display: none;
    }
</style>
@endsection
