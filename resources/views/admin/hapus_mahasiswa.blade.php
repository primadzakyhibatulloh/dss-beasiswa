@extends('admin.layout')

@section('title', 'Hapus Data Mahasiswa')

@section('content')
<div 
    x-data="modalHandler()" 
    class="max-w-6xl mx-auto bg-gradient-to-r from-indigo-100 via-white to-indigo-100 p-10 rounded-3xl shadow-2xl"
>
    <h1 class="text-5xl font-extrabold mb-10 text-indigo-900 tracking-wider drop-shadow-md">Hapus Data Mahasiswa</h1>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div 
          x-data="{ show: true }" 
          x-show="show" 
          x-transition 
          class="mb-8 px-6 py-4 rounded-xl bg-green-100 border border-green-300 text-green-900 font-semibold shadow-md flex items-center justify-between"
        >
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="text-green-900 hover:text-green-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl shadow-lg border border-indigo-200">
        <table class="min-w-full bg-white rounded-xl">
            <thead class="bg-indigo-300">
                <tr>
                    <th class="text-left py-5 px-8 font-semibold text-indigo-900 tracking-wide rounded-tl-xl">Nama Mahasiswa</th>
                    <th class="py-5 px-8 font-semibold text-indigo-900 tracking-wide text-center rounded-tr-xl">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $mhs)
                <tr class="border-b border-indigo-100 hover:bg-indigo-50 transition duration-300">
                    <td class="py-5 px-8 font-medium text-indigo-800">{{ $mhs->nama_peserta }}</td>
                    <td class="py-5 px-8 text-center">
                        <button 
                            @click="openModal('{{ $mhs->nama_peserta }}')" 
                            class="inline-flex items-center gap-2 bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 text-white font-semibold px-6 py-2 rounded-xl shadow-lg transition duration-300"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="py-10 text-center italic text-indigo-400 font-semibold tracking-wide">Belum ada data mahasiswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div
      x-show="isOpen"
      class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-200"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      @keydown.escape.window="closeModal()"
      style="display: none;"
    >
      <div @click.away="closeModal()" class="bg-white rounded-3xl max-w-md w-full p-8 shadow-xl transform transition-all">
          <h2 class="text-2xl font-bold mb-6 text-red-700">Konfirmasi Hapus</h2>
          <p class="mb-6 text-gray-700">
            Apakah Anda yakin ingin menghapus data mahasiswa 
            <span class="font-semibold text-red-600" x-text="mahasiswa"></span>?
          </p>
          <form 
            x-ref="hapusForm"
            :action="`{{ url('admin/hapus_mahasiswa') }}/${mahasiswa}`" 
            method="POST" 
            @submit.prevent="submitForm"
          >
              @csrf
              @method('DELETE')

              <div class="flex justify-end gap-4">
                  <button type="button" @click="closeModal()" class="px-6 py-2 rounded-xl border border-gray-300 hover:bg-gray-100 transition font-semibold">Batal</button>
                  <button type="submit" class="px-6 py-2 rounded-xl bg-red-700 hover:bg-red-800 text-white font-semibold shadow-lg transition">Hapus</button>
              </div>
          </form>
      </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function modalHandler() {
        return {
            isOpen: false,
            mahasiswa: '',
            openModal(nama) {
                this.mahasiswa = nama;
                this.isOpen = true;
            },
            closeModal() {
                this.isOpen = false;
                this.mahasiswa = '';
            },
            submitForm() {
                // Gunakan Alpine x-ref untuk submit form
                this.$refs.hapusForm.submit();
            }
        }
    }
</script>
@endsection
