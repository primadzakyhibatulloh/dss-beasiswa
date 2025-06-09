@extends('admin.layout')

@section('title', 'Laporan Mahasiswa')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">
    <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 gap-4">
        <h1 class="text-3xl font-extrabold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-4h2v4h3v-4h2l-4-4-4 4h2v4h1z" />
            </svg>
            Laporan Peringkat Mahasiswa
        </h1>
        <div class="flex flex-col md:flex-row gap-3 md:items-center">
            <form action="{{ route('admin.laporan') }}" method="GET" class="flex items-center gap-2">
                <input type="text" name="cari" placeholder="Cari nama..." value="{{ request('cari') }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400" />
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Cari
                </button>
            </form>

           <a href="{{ route('admin.laporan.pdf') }}" target="_blank"
                class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold shadow-sm transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 1.656-.672 3.156-1.757 4.243A6.001 6.001 0 0112 5v6zm-6 8a2 2 0 01-2-2v-3a2 2 0 012-2h.586a1 1 0 01.707.293l1.414 1.414A1 1 0 0010 15h4a1 1 0 00.707-.293l1.414-1.414A1 1 0 0117.414 13H18a2 2 0 012 2v3a2 2 0 01-2 2H6z" />
                </svg>
                Download PDF
            </a>

            <a href="{{ route('admin.laporan.excel') }}" class="flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-semibold shadow-sm transition duration-200">
                <!-- Icon Excel -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14a2 2 0 002 2h14c1.1 0 2-.9 2-2V5a2 2 0 00-2-2zM9.88 16.29L7.71 14l2.17-2.29-2.17-2.29 2.17-2.29 1.59 1.67-1.16 1.26 1.16 1.25-1.59 1.67zM15 16h-2v-1h1v-2h-1v-1h2v4z"/>
                </svg>
                Export Excel
            </a>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-md overflow-x-auto">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-md uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-4 text-center">Ranking</th>
                    <th class="px-6 py-4 text-left">Nama Mahasiswa</th>
                    <th class="px-6 py-4 text-center">Nilai Core Factor</th>
                    <th class="px-6 py-4 text-center">Nilai Secondary Factor</th>
                    <th class="px-6 py-4 text-center">Nilai Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($rankingData as $item)
                <tr class="hover:bg-gray-100 transition duration-150">
                    <td class="px-6 py-4 text-center">
                        <span class="inline-block bg-blue-100 text-blue-700 font-semibold rounded-full px-3 py-1 text-sm shadow">
                            {{ $item->ranking }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-semibold">{{ $item->nama_peserta }}</td>
                    <td class="px-6 py-4 text-center text-blue-700">{{ number_format($item->nilai_core_factor, 2) }}</td>
                    <td class="px-6 py-4 text-center text-indigo-700">{{ number_format($item->nilai_secondary_factor, 2) }}</td>
                    <td class="px-6 py-4 text-center font-bold text-green-600">{{ number_format($item->nilai_total, 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-6 text-center italic text-gray-500">Data tidak tersedia</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
