document.addEventListener('DOMContentLoaded', () => {
  const icons = {
    'ipk': `
      <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
      </svg>`,
    'penghasilan orang tua': `
      <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M12 8c-2 0-4 2-4 4s2 4 4 4 4-2 4-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.364-7.364l-1.414 1.414M6.05 17.95l-1.414 1.414m0-13.828l1.414 1.414m12.728 12.728l1.414 1.414" />
      </svg>`,
    'motivation letter': `
      <svg class="h-5 w-5 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M12 20h9" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
        <path d="M12 4h9M4 12h16M4 4h4v16H4z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
      </svg>`,
    'sertifikat prestasi': `
      <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M12 2l3 7h7l-5.5 4.5 2 7L12 17l-6.5 3.5 2-7L2 9h7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>`,
    'status tempat tinggal': `
      <svg class="h-5 w-5 text-orange-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M3 10l9-7 9 7v10a2 2 0 0 1-2 2h-3v-6H8v6H5a2 2 0 0 1-2-2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>`,
    'keaktifan volunteer': `
      <svg class="h-5 w-5 text-rose-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M5 13l4 4L19 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>`,
    'keaktifan organisasi': `
      <svg class="h-5 w-5 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <circle cx="12" cy="12" r="10" stroke-width="2"/>
        <path d="M8 12l2 2 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
      </svg>`,
    'jumlah tanggungan orang tua': `
      <svg class="h-5 w-5 text-lime-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M17 20h5v-2a3 3 0 0 0-5.356-1.857M9 20H4v-2a3 3 0 0 1 5.356-1.857M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>`,
    'skor toefl': `
      <svg class="h-5 w-5 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M9 17v-2a4 4 0 0 1 4-4h1a4 4 0 0 1 4 4v2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="12" cy="7" r="4" stroke-width="2"/>
      </svg>`,
    'kelengkapan dokumen': `
      <svg class="h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M9 12l2 2 4-4M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>`,
  };

  document.querySelectorAll('label[for^="kriteria_"]').forEach(label => {
    const span = label.querySelector('span');
    if (!span) return;

    const text = span.textContent.trim().toLowerCase();

    for (const [key, svg] of Object.entries(icons)) {
      if (text.includes(key)) {
        label.insertAdjacentHTML('afterbegin', svg);
        break;
      }
    }
  });
});
