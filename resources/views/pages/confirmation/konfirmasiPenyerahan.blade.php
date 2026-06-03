<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Penyerahan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

@php
    $idTransaksi = $transaksi->id_transaksi ?? $transaksi->id;

    function rupiahPenyerahan($angka) {
        return 'Rp' . number_format($angka, 0, ',', '.');
    }
@endphp

<body class="bg-[#F5F7FA] text-[#1E1E1E] [font-family:'Plus_Jakarta_Sans',sans-serif]">

<main class="w-full max-w-[435px] sm:max-w-[920px] mx-auto px-[20px] sm:px-[48px] py-[32px]">

    <div class="flex items-center gap-[14px] mb-[24px]">
        <a href="{{ route('riwayat.transaksi.pemilik') }}"
           class="w-[36px] h-[36px] rounded-full border border-[#1E1E1E] flex items-center justify-center">
            <img src="{{ asset('assets/icons/icon-back.png') }}" class="w-[18px] h-[18px] object-contain" alt="Back">
        </a>

        <h1 class="text-[24px] font-bold">Konfirmasi Penyerahan</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-[330px_1fr] gap-[18px]">

        <section class="bg-white border border-[#D7E5FA] rounded-[10px] p-[18px] shadow-sm">
            <h2 class="text-[18px] font-bold mb-[16px]">Ringkasan Barang</h2>

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

            <div class="border-t border-[#DDE8F5] mt-[18px] pt-[14px] space-y-[12px] text-[13px]">
                <div class="flex justify-between gap-[18px]">
                    <span class="text-[#6B7280]">Periode Sewa</span>
                    <span class="font-semibold text-right">
                        {{ $transaksi->tanggal_mulai }} - {{ $transaksi->tanggal_selesai }}
                    </span>
                </div>

                <div class="flex justify-between gap-[18px]">
                    <span class="text-[#6B7280]">Total</span>
                    <span class="font-bold text-[#34699A]">
                        {{ rupiahPenyerahan($transaksi->total_harga) }}
                    </span>
                </div>
            </div>
        </section>

        <form action="{{ route('transaksi.simpanKonfirmasiPenyerahan', $idTransaksi) }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white border border-[#D7E5FA] rounded-[10px] p-[18px] shadow-sm">

            @csrf
            @method('PUT')

            <h2 class="text-[18px] font-bold mb-[8px]">Bukti Penyerahan</h2>

            <p class="text-[13px] text-[#6B7280] mb-[18px] leading-[20px]">
                Unggah dokumentasi barang saat diserahkan langsung kepada penyewa. Dokumentasi ini menjadi bukti bahwa barang sudah berpindah ke penyewa.
            </p>

            <label class="block text-[14px] font-semibold mb-[8px]">
                Catatan Penyerahan
            </label>

            <textarea
                name="catatan_penyerahan"
                rows="4"
                placeholder="Contoh: Barang diserahkan langsung kepada penyewa di lokasi yang disepakati."
                class="w-full rounded-[8px] border border-[#C3DAFE] px-[14px] py-[12px] text-[14px] outline-none focus:border-[#34699A] mb-[18px]"
            ></textarea>

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
                    Setelah dikonfirmasi, status transaksi berubah menjadi “Menunggu Penerimaan” sampai penyewa mengonfirmasi barang diterima.
                </p>
            </div>

            <div class="flex justify-end gap-[10px] mt-[20px]">
                <a href="{{ route('riwayat.transaksi.pemilik') }}"
                   class="h-[42px] px-[22px] rounded-[8px] border border-[#34699A] text-[#34699A] text-[13px] font-semibold flex items-center">
                    Batal
                </a>

                <button type="submit"
                        class="h-[42px] px-[22px] rounded-[8px] bg-[#34699A] text-white text-[13px] font-semibold">
                    Konfirmasi Penyerahan
                </button>
            </div>
        </form>

    </div>

</main>

</body>
</html>