<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Admin')</title>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Custom scrollbar for sidebar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #334155; /* slate-700 */
            border-radius: 3px;
        }
    </style>

    @stack('head')
</head>
<body class="bg-slate-100 text-slate-900 font-sans flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-indigo-900 via-indigo-800 to-indigo-700 text-white shadow-lg overflow-y-auto">
        <div class="p-6 flex flex-col h-full">
            <h1 class="text-3xl font-extrabold mb-8 tracking-wide select-none">
                DSS Beasiswa
            </h1>

            <nav class="flex flex-col space-y-3 flex-grow">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" /></svg>
                    Dashboard
                </a>

            <a href="{{ route('admin.tambah_mahasiswa') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path d="M12 6v6l4 2"/></svg>
                    Tambah Data Mahasiswa
                </a>


               <a href="{{ route('admin.edit_mahasiswa') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/></svg>
                    Edit Data Mahasiswa
                </a>

               <a href="{{ route('admin.hapus_mahasiswa') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        viewBox="0 0 24 24"><path d="M19 7L5 21M5 7l14 14"/></svg>
                    Hapus Data Mahasiswa
                </a>


                <a href="{{ route('admin.perhitungan') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         viewBox="0 0 24 24"><path d="M9 17v-6a3 3 0 016 0v6" /><path d="M5 17h14"/></svg>
                    Proses Perhitungan
                </a>

                <a href="{{ route('admin.hasil_perhitungan') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        viewBox="0 0 24 24"><path d="M11 11h2v2h-2z"/><path d="M3 3h18v18H3V3z"/></svg>
                    Hasil Perhitungan
                </a>
                
                <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        viewBox="0 0 24 24"><path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7" /><path d="M16 3h-8v4h8V3z"/></svg>
                    Laporan
                </a>


                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path d="M15 9l-6 6M9 9l6 6"/></svg>
                        Logout
                    </button>
                </form>


            </nav>

            <div class="mt-auto pt-6 text-center text-indigo-300 text-xs select-none">
                &copy; 2025 DSS Beasiswa. All rights reserved.
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-auto">
        <!-- Topbar -->
        <header class="flex items-center justify-between bg-white shadow px-6 py-4 sticky top-0 z-20">
            <h2 class="text-xl font-semibold text-indigo-900">@yield('title', 'Dashboard Admin')</h2>
            <div>
                <span class="text-indigo-700 font-semibold">Hai, Admin</span>
            </div>
        </header>

        <!-- Page content -->
        <main class="p-6 bg-slate-100 flex-grow">
            @yield('content')
        </main>
    </div>

    @yield('scripts')

</body>
</html>
