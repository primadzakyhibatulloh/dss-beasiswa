@php
    $icons = [
        'IPK' => '<svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.042 12.042 0 01.84 6.123A11.94 11.94 0 0112 20a11.94 11.94 0 01-7-3.299 12.042 12.042 0 01.84-6.123L12 14z"/></svg>',
        'Penghasilan Orang Tua' => '<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 1.343-3 3 0 1.5 1 2.5 2.25 2.9M12 16v1m0 4h.01M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>',
        'Motivation Letter' => '<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4V4zm4 4h8M8 12h8M8 16h5"/></svg>',
        'Sertifikat Prestasi' => '<svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6l3.09 6.26L22 13l-5 4.87L18.18 22 12 18.77 5.82 22 7 17.87 2 13l6.91-1.74L12 6z"/></svg>',
        'Status Tempat Tinggal' => '<svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10l9-7 9 7v11a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-5H9v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V10z"/></svg>',
        'Keaktifan Volunteer' => '<svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2a10 10 0 00-3.55 19.45L12 22l3.55-0.55A10 10 0 0012 2z"/></svg>',
        'Keaktifan Organisasi' => '<svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 14a4 4 0 01-8 0M12 2a10 10 0 00-9.95 9.05M12 22a10 10 0 009.95-9.05"/></svg>',
        'Jumlah Tanggungan Orang Tua' => '<svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 20h14a2 2 0 002-2v-5a2 2 0 00-2-2h-5V8h1a3 3 0 000-6h-4a3 3 0 000 6h1v3H5a2 2 0 00-2 2v5a2 2 0 002 2z"/></svg>',
        'Skor TOEFL' => '<svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 4h18M3 8h18M3 12h18M3 16h18M3 20h18"/></svg>',
        'Kelengkapan Dokumen' => '<svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4V4z"/></svg>',
    ];
@endphp

{!! $icons[$nama] ?? '<svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>' !!}