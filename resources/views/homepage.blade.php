<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Homepage - Profile Matching</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <style>
    html { scroll-behavior: smooth; }
    .fade-in {
      animation: fadeInUp 1s ease-out both;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="bg-gradient-to-br from-indigo-900 via-purple-900 to-gray-900 text-white">

  <div class="space-y-32 px-6 md:px-24 py-16">

    <!-- Section 1: Pengenalan -->
    <section class="bg-gradient-to-r from-purple-800 to-indigo-800 p-10 rounded-3xl shadow-2xl fade-in">
      <div class="flex items-start gap-4 mb-6">
        <i data-lucide="info" class="text-purple-300 w-8 h-8"></i>
        <h2 class="text-5xl font-extrabold tracking-tight text-white drop-shadow-md">Apa Itu Profile Matching?</h2>
      </div>
      <p class="text-lg leading-relaxed text-purple-100 max-w-4xl">
        <strong>Profile Matching</strong> adalah metode seleksi yang membandingkan profil pelamar dengan standar ideal. Cocok digunakan dalam seleksi beasiswa yang objektif dan efisien.
      </p>
      <p class="text-lg mt-4 text-purple-100 max-w-4xl">
        Dengan pendekatan berbasis <span class="italic font-semibold">selisih nilai (GAP)</span>, sistem ini mampu menyaring pelamar berdasarkan kriteria terukur dan terstruktur.
      </p>
    </section>

    <!-- Section 2: Kriteria Penilaian -->
    <section class="px-6 md:px-24">
      <h2 class="text-3xl font-bold text-white drop-shadow-md mb-8">Kriteria Penilaian Seleksi</h2>
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
          $kriteria = [
            'IPK' => '<svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.042 12.042 0 01.84 6.123A11.94 11.94 0 0112 20a11.94 11.94 0 01-7-3.299 12.042 12.042 0 01.84-6.123L12 14z"/></svg>',
            'Penghasilan Orang Tua' => '<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 1.343-3 3 0 1.5 1 2.5 2.25 2.9M12 16v1m0 4h.01M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>',
            'Motivation Letter' => '<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4V4zm4 4h8M8 12h8M8 16h5"/></svg>',
            'Sertifikat Prestasi' => '<svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6l3.09 6.26L22 13l-5 4.87L18.18 22 12 18.77 5.82 22 7 17.87 2 13l6.91-1.74L12 6z"/></svg>',
            'Status Tempat Tinggal' => '<svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10l9-7 9 7v11a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-5H9v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V10z"/></svg>',
            'Keaktifan Volunteer' => '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2a10 10 0 00-3.55 19.45L12 22l3.55-0.55A10 10 0 0012 2z"/></svg>',
            'Keaktifan Organisasi' => '<svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 14a4 4 0 01-8 0M12 2a10 10 0 00-9.95 9.05M12 22a10 10 0 009.95-9.05"/></svg>',
            'Jumlah Tanggungan Orang Tua' => '<svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 20h14a2 2 0 002-2v-5a2 2 0 00-2-2h-5V8h1a3 3 0 000-6h-4a3 3 0 000 6h1v3H5a2 2 0 00-2 2v5a2 2 0 002 2z"/></svg>',
            'Skor TOEFL' => '<svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 4h18M3 8h18M3 12h18M3 16h18M3 20h18"/></svg>',
            'Kelengkapan Dokumen' => '<svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4V4z"/></svg>',
          ];
        @endphp

        @foreach ($kriteria as $nama => $icon)
          <div class="bg-white border border-purple-100 shadow-md rounded-xl p-5 flex items-center gap-4 hover:shadow-xl hover:scale-[1.03] transition-all duration-300">
            <div class="bg-purple-100 rounded-full p-2">
              {!! $icon !!}
            </div>
            <div>
              <p class="font-semibold text-gray-800 text-base">{{ $nama }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    <!-- Section 3: Cara Kerja -->
    <section class="bg-gradient-to-r from-gray-800 to-purple-900 p-10 rounded-3xl shadow-2xl fade-in">
      <div class="flex items-center gap-4 mb-6">
        <i data-lucide="settings" class="text-purple-300 w-7 h-7"></i>
        <h2 class="text-4xl font-bold text-white drop-shadow">Cara Kerja Profile Matching</h2>
      </div>
      <ol class="list-decimal list-inside space-y-2 text-purple-100 text-lg">
        <li>Penentuan bobot kriteria</li>
        <li>Penilaian profil pelamar</li>
        <li>Hitung GAP terhadap standar ideal</li>
        <li>Konversi nilai GAP ke bobot</li>
        <li>Pemisahan Core dan Secondary Factor</li>
        <li>Hitung total: <code class="bg-purple-700 px-2 py-1 rounded text-sm">(CF * 60%) + (SF * 40%)</code></li>
        <li>Pemeringkatan akhir</li>
      </ol>
    </section>

    <!-- Section 4: Keuntungan -->
    <section class="fade-in">
      <h2 class="text-4xl font-bold mb-10 text-center text-white drop-shadow-md">Mengapa Menggunakan Profile Matching?</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-indigo-800 p-6 rounded-2xl text-center shadow-lg hover:shadow-2xl hover:scale-105 transition duration-300">
          <i data-lucide="scale" class="mx-auto w-10 h-10 text-purple-200 mb-4"></i>
          <h3 class="font-semibold text-xl mb-2">Objektif</h3>
          <p class="text-purple-100">Sistem mengurangi bias karena semua kandidat dinilai berdasarkan standar yang sama.</p>
        </div>
        <div class="bg-indigo-800 p-6 rounded-2xl text-center shadow-lg hover:shadow-2xl hover:scale-105 transition duration-300">
          <i data-lucide="zap" class="mx-auto w-10 h-10 text-purple-200 mb-4"></i>
          <h3 class="font-semibold text-xl mb-2">Cepat & Efisien</h3>
          <p class="text-purple-100">Mengurangi waktu evaluasi manual dengan perhitungan otomatis.</p>
        </div>
        <div class="bg-indigo-800 p-6 rounded-2xl text-center shadow-lg hover:shadow-2xl hover:scale-105 transition duration-300">
          <i data-lucide="check-circle-2" class="mx-auto w-10 h-10 text-purple-200 mb-4"></i>
          <h3 class="font-semibold text-xl mb-2">Akurat</h3>
          <p class="text-purple-100">Data dibandingkan langsung terhadap indikator-indikator ideal.</p>
        </div>
      </div>
    </section>

    <!-- Section 5: Tim Pengembang -->
   <section class="fade-in">
  <h2 class="text-4xl font-bold mb-12 text-center text-white drop-shadow-md">Tim Pengembang</h2>
  <div class="grid md:grid-cols-3 gap-10">
    @foreach ([
      ['nama' => 'Tansah Jumeneng P', 'nim' => 'H1D023090', 'peran' => 'Rancangan Perhitungan', 'foto' => 'tansah.png'],
      ['nama' => 'Raditya Yusuf', 'nim' => 'H1D023056', 'peran' => 'Pengelola Laporan & Referensi', 'foto' => 'radit.jpg'],
      ['nama' => 'Prima Dzaky Hibatulloh', 'nim' => 'H1D023040', 'peran' => 'Fullstack Aplikasi', 'foto' => 'prima.jpg'],
    ] as $person)
      <div class="relative bg-purple-900 p-8 rounded-3xl
                  shadow-lg border-4 border-transparent
                  hover:border-purple-400 hover:shadow-xl hover:scale-105
                  transition duration-300 ease-in-out text-center">
        <div class="relative inline-block mx-auto mb-6">
          <div class="absolute inset-0 bg-gradient-to-tr from-purple-600 to-purple-900 rounded-full blur-2xl opacity-50"></div>
          <img src="{{ asset('images/' . $person['foto']) }}" alt="Foto {{ $person['nama'] }}"
               class="relative rounded-full w-36 h-36 object-cover shadow-xl border-4 border-purple-500 transition-transform duration-300 hover:scale-110">
        </div>
        <h3 class="text-2xl font-semibold text-white mb-2">{{ $person['nama'] }}</h3>
        <p class="inline-block bg-purple-700 text-white text-xs font-semibold uppercase px-4 py-1 rounded-full tracking-wider shadow-md">
          {{ $person['nim'] }}
        </p>
        <p class="mt-3 text-purple-300 text-base">{{ $person['peran'] }}</p>
      </div>
    @endforeach
  </div>
</section>



    <!-- Section 6: CTA -->
    <section class="text-center py-20 bg-gradient-to-tr from-purple-800 via-indigo-700 to-purple-800 rounded-3xl shadow-xl fade-in">
      <h2 class="text-4xl font-extrabold mb-4 text-white drop-shadow-md">Siap Memulai Seleksi?</h2>
      <p class="text-purple-100 text-lg mb-6">Gunakan sistem kami untuk proses seleksi beasiswa yang efisien dan terpercaya.</p>
      <a href="{{ route('login') }}"
         class="inline-block bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-4 rounded-full text-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
        Mulai Seleksi Sekarang
      </a>
    </section>
  </div>

<footer class="bg-purple-900 py-6 mt-16 text-center text-purple-300 text-sm select-none">
  <div class="flex items-center justify-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="currentColor" viewBox="0 0 24 24">
      <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8
        8 3.59 8 8-3.59 8-8 8zm-1-13h2a3 3 0 110 6h-2v-6z" />
    </svg>
    <p>© 2025 Hak Cipta Pengelola <span class="font-semibold text-white">Kelompok 9</span></p>
  </div>
</footer>



  <script>
    lucide.createIcons();
  </script>
</body>
</html>
