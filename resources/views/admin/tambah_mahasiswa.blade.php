@extends('admin.layout')

@section('title', 'Tambah Data Mahasiswa')

@section('content')
<div class="max-w-4xl mx-auto bg-white/80 backdrop-blur-md p-10 rounded-3xl shadow-2xl mt-10 ring-1 ring-gray-200">
    <h1 class="text-4xl font-black mb-10 text-indigo-900 border-b-4 border-indigo-700 pb-4 tracking-tight">
        Tambah Data Mahasiswa
    </h1>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.simpan_mahasiswa') }}" method="POST" class="space-y-10">
        @csrf

        <!-- Nama Peserta -->
        <div>
            <label for="nama_peserta" class="block mb-2 text-lg font-semibold text-gray-700">Nama Peserta</label>
            <input type="text" name="nama_peserta" id="nama_peserta" required
                class="w-full rounded-xl border border-gray-300 px-5 py-3 text-gray-900 placeholder-gray-400 bg-white shadow-sm focus:outline-none focus:ring-4 focus:ring-indigo-300 focus:border-indigo-600 transition-all duration-300"
                placeholder="Masukkan nama peserta" />
        </div>

        <!-- Kriteria dan Subkriteria -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ($kriterias as $kriteria)
                <div>
                    <label for="kriteria_{{ $kriteria->id }}" class="flex items-center gap-3 mb-3 text-gray-800 text-md font-semibold">
                        <x-icon-kriteria :nama="$kriteria->nama" />
                        <span>{{ $kriteria->nama }}</span>
                    </label>
                    <select name="kriteria_{{ $kriteria->id }}" id="kriteria_{{ $kriteria->id }}" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-700 bg-white shadow-sm focus:outline-none focus:ring-4 focus:ring-indigo-300 focus:border-indigo-600 transition-all duration-300">
                        <option value="" disabled selected>Pilih nilai</option>
                        @foreach ($kriteria->sub_kriteria as $sub)
                            <option value="{{ $sub->nilai }}">{{ $sub->deskripsi }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>

        <!-- Tombol Simpan -->
        <div>
            <button type="submit"
                class="w-full py-4 rounded-xl text-lg font-bold text-white bg-gradient-to-r from-indigo-700 to-purple-600 hover:from-indigo-800 hover:to-purple-700 shadow-lg hover:shadow-xl transition-all duration-300">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection
