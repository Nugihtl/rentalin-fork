<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rentalin - Verifikasi Wajah</title>
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="bg-[#F8FAFC] m-0 font-sans">

  <!-- Header -->
  <header class="border-b-4 border-[#E2E8F0] bg-white py-5">
    <div class="container flex items-center gap-4">
      <a href="kyc-step1.html" class="no-underline text-black text-2xl border border-black rounded-full w-8 h-8 flex items-center justify-center">←</a>
      <h1 class="m-0 text-2xl font-bold">Verifikasi Identitas</h1>
    </div>
  </header>

  <main class="container max-w-[900px] pt-10">

    <!-- Stepper (Langkah 1 & 2 Aktif) -->
    <div class="flex items-center justify-center mb-20">

      <!-- Step 1 -->
      <div class="flex flex-col items-center relative">
        <div class="w-16 h-16 rounded-full bg-[#34699A] text-white flex items-center justify-center text-2xl font-bold z-[2]">1</div>
        <span class="text-[#34699A] font-bold text-xl absolute top-[75px] whitespace-nowrap">Kartu Identitas</span>
      </div>

      <!-- Garis dashed -->
      <div class="w-[250px] h-0 border-t-2 border-dashed border-black mx-[15px] -translate-y-2"></div>

      <!-- Step 2 -->
      <div class="flex flex-col items-center relative">
        <div class="w-16 h-16 rounded-full bg-[#34699A] text-white flex items-center justify-center text-2xl font-bold z-[2]">2</div>
        <span class="text-[#34699A] font-bold text-xl absolute top-[75px] whitespace-nowrap">Pemindaian Wajah</span>
      </div>

    </div>

    <!-- Card Verifikasi -->
    <section class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] p-10 mb-15">
      <h2 class="text-[32px] font-bold mt-0 mb-3">Unggah Foto Selfie Anda</h2>
      <p class="text-base text-black mb-8 font-medium">Pastikan kartu identitas Anda valid dan detailnya terbaca dengan jelas.</p>

      <div class="grid grid-cols-[1.3fr_1fr] gap-[50px]">

        <!-- Kiri: Upload Box -->
        <div
          id="upload-area"
          onclick="document.getElementById('file-upload-2').click();"
          class="bg-[#E2E8F0] border-2 border-dashed border-[#34699A] rounded-lg px-5 py-[60px] flex flex-col items-center justify-center cursor-pointer min-h-[220px] text-center transition-colors duration-200 hover:bg-[#d4dce8]"
        >
          <input
            type="file"
            id="file-upload-2"
            class="hidden"
            accept="image/*"
            capture="user"
          >

          <!-- Tampilan default (sebelum upload) -->
          <div id="upload-placeholder" class="flex flex-col items-center">
            <img src="assets/icons/image-add.png" alt="Add" class="w-10 mb-4">
            <p class="text-lg font-bold text-black m-0 mb-2">Ambil Foto atau Unggah Foto Anda</p>
            <span class="text-[13px] text-[#64748B] italic">JPEG, PNG, or PDF (Max 10MB)</span>
          </div>

          <!-- Tampilan preview (setelah upload) -->
          <div id="upload-preview" class="hidden flex-col items-center w-full">
            <img id="preview-img" src="" alt="Preview" class="max-h-[180px] max-w-full rounded-lg object-contain mb-3">
            <span id="preview-filename" class="text-[13px] text-[#64748B] italic break-all"></span>
          </div>
        </div>

        <!-- Kanan: Persyaratan & Tombol -->
        <div class="flex flex-col justify-between">
          <div>
            <h3 class="text-[22px] font-bold mt-0 mb-6">Daftar Persyaratan</h3>
            <ul class="list-none p-0 m-0 flex flex-col gap-4">
              <li class="flex items-start gap-3 text-[15px] text-black font-medium leading-relaxed">
                <div class="min-w-[22px] h-[22px] bg-[#34699A] rounded-full text-white flex justify-center items-center text-xs font-bold mt-[2px]">✔</div>
                Pastikan pencahayaan bagus
              </li>
              <li class="flex items-start gap-3 text-[15px] text-black font-medium leading-relaxed">
                <div class="min-w-[22px] h-[22px] bg-[#34699A] rounded-full text-white flex justify-center items-center text-xs font-bold mt-[2px]">✔</div>
                Lepaskan kacamata/topi
              </li>
              <li class="flex items-start gap-3 text-[15px] text-black font-medium leading-relaxed">
                <div class="min-w-[22px] h-[22px] bg-[#34699A] rounded-full text-white flex justify-center items-center text-xs font-bold mt-[2px]">✔</div>
                Foto selfie sesuai dengan dokumen identitas Anda
              </li>
            </ul>
          </div>

          <div class="text-right mt-10">
            <button
              id="konfirmasi-btn"
              onclick="handleKonfirmasi()"
              class="bg-[#34699A] text-white border-none py-3 px-8 text-base font-semibold rounded-lg cursor-not-allowed transition-all duration-200 opacity-50"
              disabled
            >
              Konfirmasi
            </button>
          </div>
        </div>

      </div>
    </section>
  </main>

  <script>
    const fileInput     = document.getElementById('file-upload-2');
    const placeholder   = document.getElementById('upload-placeholder');
    const preview       = document.getElementById('upload-preview');
    const previewImg    = document.getElementById('preview-img');
    const previewName   = document.getElementById('preview-filename');
    const konfirmasiBtn = document.getElementById('konfirmasi-btn');

    const MAX_SIZE_MB   = 10;
    const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'application/pdf'];

    fileInput.addEventListener('change', function () {
      const file = fileInput.files[0];
      if (!file) return;

      // Validasi tipe file
      if (!ALLOWED_TYPES.includes(file.type)) {
        alert('Format file tidak didukung. Gunakan JPEG, PNG, atau PDF.');
        fileInput.value = '';
        return;
      }

      // Validasi ukuran file (max 10MB)
      if (file.size > MAX_SIZE_MB * 1024 * 1024) {
        alert('Ukuran file melebihi 10MB. Silakan pilih file yang lebih kecil.');
        fileInput.value = '';
        return;
      }

      // Tampilkan preview untuk gambar
      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewImg.src = e.target.result;
          previewImg.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      } else {
        // PDF: sembunyikan img, tampilkan hanya nama file
        previewImg.classList.add('hidden');
      }

      previewName.textContent = file.name;
      placeholder.classList.add('hidden');
      preview.classList.remove('hidden');
      preview.classList.add('flex');

      // Aktifkan tombol Konfirmasi
      konfirmasiBtn.disabled = false;
      konfirmasiBtn.classList.remove('opacity-50', 'cursor-not-allowed');
      konfirmasiBtn.classList.add('cursor-pointer', 'hover:bg-[#2a5580]');
    });

    function handleKonfirmasi() {
      if (!fileInput.files[0]) return;
      window.location.href = 'profile.html';
    }
  </script>

</body>
</html>