<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Kerusakan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

@php
    $idTransaksi = $transaksi->id_transaksi ?? $transaksi->id;
@endphp

<body class="bg-[#F5F7FA] text-[#1E1E1E] [font-family:'Plus_Jakarta_Sans',sans-serif]">

<main class="w-full max-w-[435px] sm:max-w-[980px] mx-auto px-[20px] sm:px-[48px] py-[32px]">

    <div class="flex items-center gap-[14px] mb-[24px]">
        <a href="{{ route('riwayat.transaksi.pemilik') }}"
           class="w-[36px] h-[36px] rounded-full border border-[#1E1E1E] flex items-center justify-center">
            <img src="{{ asset('assets/icons/icon-back.png') }}" class="w-[18px] h-[18px] object-contain" alt="Back">
        </a>

        <h1 class="text-[24px] font-bold">Pengajuan Kerusakan</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-[330px_1fr] gap-[18px]">

        <section class="bg-white border border-[#D7E5FA] rounded-[10px] p-[18px] shadow-sm">
            <h2 class="text-[18px] font-bold mb-[16px]">Informasi Barang</h2>

            <div class="flex gap-[12px]">
                <img src="{{ asset('assets/products/' . $transaksi->foto_produk) }}"
                     class="w-[86px] h-[86px] rounded-[8px] object-cover"
                     alt="{{ $transaksi->nama_produk }}">

                <div>
                    <h3 class="text-[16px] font-bold leading-[22px]">
                        {{ $transaksi->nama_produk }}
                    </h3>

                    <p class="text-[12px] text-[#6B7280] mt-[6px]">
                        {{ $transaksi->kode_transaksi }}
                    </p>

                    <p class="text-[12px] text-[#6B7280] mt-[4px]">
                        Penyewa: {{ $transaksi->nama_penyewa }}
                    </p>
                </div>
            </div>

            <div class="mt-[18px] bg-[#FFECEF] text-[#E3455D] rounded-[8px] px-[14px] py-[12px] flex gap-[10px]">
                <img src="{{ asset('assets/icons/icon-warning-red.png') }}" class="w-[18px] h-[18px] object-contain mt-[2px]" alt="Warning">

                <p class="text-[12px] font-medium leading-[20px]">
                    Pastikan bukti kerusakan jelas agar penyewa dapat meninjau klaim dengan mudah.
                </p>
            </div>
        </section>

        <form action="{{ route('transaksi.simpanPengajuanKerusakan', $idTransaksi) }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white border border-[#D7E5FA] rounded-[10px] p-[18px] shadow-sm">

            @csrf
            @method('PUT')

            <h2 class="text-[18px] font-bold mb-[8px]">Form Klaim Kerusakan</h2>

            <p class="text-[13px] text-[#6B7280] mb-[18px] leading-[20px]">
                Isi detail kerusakan barang beserta estimasi biaya perbaikan.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-[14px] mb-[14px]">

                <div>
                    <label class="block text-[14px] font-semibold mb-[8px]">
                        Jenis Kerusakan
                    </label>

                    <input
                        type="text"
                        name="jenis_kerusakan"
                        value="{{ old('jenis_kerusakan') }}"
                        placeholder="Contoh: Kerusakan fisik"
                        class="w-full h-[44px] rounded-[8px] border border-[#C3DAFE] px-[14px] text-[14px] outline-none focus:border-[#34699A]"
                        required
                    >

                    @error('jenis_kerusakan')
                        <p class="text-[12px] text-[#E3455D] mt-[5px]">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-[14px] font-semibold mb-[8px]">
                        Bagian Rusak
                    </label>

                    <input
                        type="text"
                        name="bagian_rusak"
                        value="{{ old('bagian_rusak') }}"
                        placeholder="Contoh: Body / layar / kabel"
                        class="w-full h-[44px] rounded-[8px] border border-[#C3DAFE] px-[14px] text-[14px] outline-none focus:border-[#34699A]"
                        required
                    >

                    @error('bagian_rusak')
                        <p class="text-[12px] text-[#E3455D] mt-[5px]">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mb-[14px]">
                <label class="block text-[14px] font-semibold mb-[8px]">
                    Biaya Perbaikan
                </label>

                <input
                    type="number"
                    name="biaya_perbaikan"
                    value="{{ old('biaya_perbaikan') }}"
                    placeholder="Contoh: 70000"
                    class="w-full h-[44px] rounded-[8px] border border-[#C3DAFE] px-[14px] text-[14px] outline-none focus:border-[#34699A]"
                    required
                >

                @error('biaya_perbaikan')
                    <p class="text-[12px] text-[#E3455D] mt-[5px]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-[18px]">
                <label class="block text-[14px] font-semibold mb-[8px]">
                    Deskripsi Kerusakan
                </label>

                <textarea
                    name="deskripsi"
                    rows="4"
                    placeholder="Jelaskan kondisi barang dan kronologi kerusakan secara singkat."
                    class="w-full rounded-[8px] border border-[#C3DAFE] px-[14px] py-[12px] text-[14px] outline-none focus:border-[#34699A]"
                    required
                >{{ old('deskripsi') }}</textarea>

                @error('deskripsi')
                    <p class="text-[12px] text-[#E3455D] mt-[5px]">{{ $message }}</p>
                @enderror
            </div>

            <label class="w-full max-w-[460px] h-[180px] mx-auto border-2 border-dashed border-[#34699A] rounded-[8px] bg-[#D9D9D9] flex flex-col items-center justify-center cursor-pointer">
                <img src="{{ asset('assets/icons/icon-upload-image.png') }}" class="w-[34px] h-[34px] object-contain mb-[12px]" alt="Upload">

                <p class="text-[16px] font-semibold text-[#000000] leading-none">
                    Upload Foto Bukti
                </p>

                <p class="text-[12px] text-[#8A8A8A] italic mt-[7px]">
                    JPEG, PNG, or PDF (Max 10MB)
                </p>

                <input type="file" name="foto_bukti[]" class="hidden" multiple>
            </label>

            <div class="mt-[18px] bg-[#EAF3FF] text-[#34699A] rounded-[8px] px-[14px] py-[12px] flex gap-[10px]">
                <img src="{{ asset('assets/icons/icon-info-blue.png') }}" class="w-[18px] h-[18px] object-contain mt-[2px]" alt="Info">

                <p class="text-[12px] font-medium leading-[20px]">
                    Setelah klaim dikirim, status transaksi tetap “Kerusakan” dan menunggu tanggapan penyewa.
                </p>
            </div>

            <div class="flex justify-end gap-[10px] mt-[20px]">
                <a href="{{ route('riwayat.transaksi.pemilik') }}"
                   class="h-[42px] px-[22px] rounded-[8px] border border-[#34699A] text-[#34699A] text-[13px] font-semibold flex items-center">
                    Batal
                </a>

                <button type="submit"
                        class="h-[42px] px-[22px] rounded-[8px] bg-[#34699A] text-white text-[13px] font-semibold">
                    Ajukan Kerusakan
                </button>
            </div>
        </form>

    </div>

</main>

</body>
</html>