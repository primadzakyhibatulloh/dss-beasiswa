@extends('admin.layout')

@section('title', 'Edit Data Mahasiswa')

@section('content')
<div class="max-w-4xl mx-auto bg-white/80 backdrop-blur-md p-10 rounded-3xl shadow-2xl mt-10 ring-1 ring-gray-200">
    <h1 class="text-4xl font-black mb-10 text-indigo-900 border-b-4 border-indigo-700 pb-4 tracking-tight">
        Edit Data Mahasiswa
    </h1>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('admin.edit_mahasiswa') }}" class="mb-10">
        <label for="peserta" class="block mb-2 text-lg font-semibold text-gray-700">Pilih Peserta</label>
        <select name="peserta" id="peserta" onchange="this.form.submit()">
            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-700 bg-white shadow-sm focus:outline-none focus:ring-4 focus:ring-indigo-300 focus:border-indigo-600 transition-all duration-300">
            <option value="" disabled {{ empty($peserta) ? 'selected' : '' }}>-- Pilih Peserta --</option>
            @foreach ($daftar_peserta as $nama)
                <option value="{{ $nama }}" {{ (isset($peserta) && $peserta == $nama) ? 'selected' : '' }}>
                    {{ $nama }}
                </option>
            @endforeach
        </select>
    </form>

    @if(isset($peserta))
    <form action="{{ route('admin.update_mahasiswa') }}" method="POST" class="space-y-10">
        @csrf

        <input type="hidden" name="peserta" value="{{ $peserta }}">

        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-indigo-900">Edit nilai kriteria untuk: <span class="font-bold">{{ $peserta }}</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ($kriterias as $kriteria)
                <div>
                    <label for="kriteria_{{ $kriteria->id }}" class="flex items-center gap-3 mb-3 text-gray-800 text-md font-semibold">
                        <x-icon-kriteria :nama="$kriteria->nama" />
                        <span>{{ $kriteria->nama }}</span>
                    </label>
                    <select name="kriteria_{{ $kriteria->id }}" id="kriteria_{{ $kriteria->id }}" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-700 bg-white shadow-sm focus:outline-none focus:ring-4 focus:ring-indigo-300 focus:border-indigo-600 transition-all duration-300">
                        <option value="" disabled>Pilih nilai</option>
                        @foreach ($kriteria->sub_kriteria as $sub)
                            <option value="{{ $sub->nilai }}"
                                {{ (isset($dataNilai[$kriteria->id]) && $dataNilai[$kriteria->id] == $sub->nilai) ? 'selected' : '' }}>
                                {{ $sub->deskripsi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>

        <div>
            <button type="submit"
                class="w-full py-4 rounded-xl text-lg font-bold text-white bg-gradient-to-r from-indigo-700 to-purple-600 hover:from-indigo-800 hover:to-purple-700 shadow-lg hover:shadow-xl transition-all duration-300">
                Update Data
            </button>
        </div>
    </form>
    @endif
</div>
@endsection
