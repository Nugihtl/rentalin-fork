<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rentalin - Verifikasi Identitas</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] m-0 font-sans">

  {{-- Header --}}
  <header class="border-b-4 border-[#E2E8F0] bg-white py-5">
    <div class="container max-w-[900px] mx-auto px-5 flex items-center gap-4">
      <a href="{{ url('profile') }}" class="no-underline text-black text-2xl border border-black rounded-full w-8 h-8 flex items-center justify-center">←</a>
      <h1 class="m-0 text-2xl font-bold">Verifikasi Identitas</h1>
    </div>
  </header>

  <main class="container max-w-[900px] mx-auto px-5 pt-10">

    {{-- Stepper --}}
    <div class="flex items-center justify-center mb-20">

      <div class="flex flex-col items-center relative">
        <div class="w-16 h-16 rounded-full bg-[#34699A] text-white flex items-center justify-center text-2xl font-bold z-[2]">1</div>
        <span class="text-[#34699A] font-bold text-xl absolute top-[75px] w-max">Kartu Identitas</span>
      </div>

      <div class="w-[250px] h-0 border-t-2 border-dashed border-black mx-[15px] -translate-y-2"></div>

      <div class="flex flex-col items-center relative">
        <div class="w-16 h-16 rounded-full bg-[#A0AABF] text-white flex items-center justify-center text-2xl font-bold z-[2]">2</div>
        <span class="text-[#A0AABF] font-bold text-xl absolute top-[75px] w-max">Pemindaian Wajah</span>
      </div>

    </div>

    {{-- Card Verifikasi --}}
    <section class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] p-10 mb-[60px]">
      <h2 class="text-[32px] font-bold mt-0 mb-3">Unggah Identitas Anda</h2>
      <p class="text-base text-black mb-8 font-medium">Pastikan kartu identitas Anda valid dan detailnya terbaca dengan jelas.</p>

      <div class="grid gap-[50px]" style="grid-template-columns: 1.3fr 1fr;">

        {{-- Kiri: Upload Box --}}
        <div id="uploadBox" class="bg-[#E2E8F0] border-2 border-dashed border-[#34699A] rounded-lg px-5 py-[60px] flex flex-col items-center justify-center cursor-pointer min-h-[220px] text-center">
          <input type="file" id="file-upload-1" class="hidden" accept=".jpg,.jpeg,.png,.pdf">
          <img id="uploadIcon" src="{{ asset('assets/icons/image-add.png') }}" alt="Add" class="w-10 mb-4">
          <p id="uploadLabel" class="text-lg font-bold text-black m-0 mb-2">Ambil Foto atau Unggah Kartu Identitas</p>
          <span class="text-[13px] text-[#64748B] italic">JPEG, PNG, or PDF (Max 10MB)</span>
        </div>

        {{-- Kanan: Persyaratan & Tombol --}}
        <div class="flex flex-col justify-between">
          <div>
            <h3 class="text-[22px] font-bold mt-0 mb-6">Daftar Persyaratan</h3>
            <ul class="list-none p-0 m-0 flex flex-col gap-4">
              <li class="flex items-start gap-3 text-[15px] text-black font-medium leading-relaxed">
                <div class="min-w-[22px] h-[22px] bg-[#34699A] rounded-full text-white flex justify-center items-center text-xs font-bold mt-0.5">✔</div>
                Foto jernih dengan semua teks terbaca jelas
              </li>
              <li class="flex items-start gap-3 text-[15px] text-black font-medium leading-relaxed">
                <div class="min-w-[22px] h-[22px] bg-[#34699A] rounded-full text-white flex justify-center items-center text-xs font-bold mt-0.5">✔</div>
                Keempat sudut kartu terlihat
              </li>
              <li class="flex items-start gap-3 text-[15px] text-black font-medium leading-relaxed">
                <div class="min-w-[22px] h-[22px] bg-[#34699A] rounded-full text-white flex justify-center items-center text-xs font-bold mt-0.5">✔</div>
                Tidak ada pantulan cahaya atau bayangan
              </li>
            </ul>
          </div>

          <div class="text-right mt-10">
            <button id="konfirmasiBtn" class="bg-[#34699A] text-white border-none px-8 py-3 text-base font-semibold rounded-lg cursor-pointer transition-opacity duration-200 opacity-50 pointer-events-none"
              onclick="window.location.href='{{ url('kyc/step2') }}';">Konfirmasi</button>
          </div>
        </div>

      </div>
    </section>
  </main>

  <script>
    const uploadBox   = document.getElementById('uploadBox');
    const fileInput   = document.getElementById('file-upload-1');
    const uploadLabel = document.getElementById('uploadLabel');
    const uploadIcon  = document.getElementById('uploadIcon');
    const konfirmasiBtn = document.getElementById('konfirmasiBtn');

    // Klik area upload → trigger file input
    uploadBox.addEventListener('click', () => fileInput.click());

    // Saat file dipilih
    fileInput.addEventListener('change', () => {
      const file = fileInput.files[0];
      if (!file) return;

      // Tampilkan nama file di label
      uploadLabel.textContent = file.name;

      // Jika gambar, tampilkan preview menggantikan icon
      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
          uploadIcon.src = e.target.result;
          uploadIcon.classList.remove('w-10');
          uploadIcon.classList.add('w-full', 'max-h-40', 'object-contain', 'rounded');
        };
        reader.readAsDataURL(file);
      }

      // Aktifkan tombol Konfirmasi
      konfirmasiBtn.classList.remove('opacity-50', 'pointer-events-none');
    });
  </script>

</body>
</html>