<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klaim Kerusakan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

@php
    $roleKembali = $transaksi->role === 'pemilik'
        ? 'riwayat.transaksi.pemilik'
        : 'riwayat.transaksi.penyewa';

    function rupiahKlaim($angka) {
        return 'Rp' . number_format($angka, 0, ',', '.');
    }
@endphp

<body class="bg-[#F5F7FA] text-[#1E1E1E] [font-family:'Plus_Jakarta_Sans',sans-serif]">

<main class="w-full max-w-[435px] sm:max-w-[980px] mx-auto px-[20px] sm:px-[48px] py-[32px]">

    <div class="flex items-center gap-[14px] mb-[24px]">
        <a href="{{ route($roleKembali) }}"
           class="w-[36px] h-[36px] rounded-full border border-[#1E1E1E] flex items-center justify-center">
            <img src="{{ asset('assets/icons/icon-back.png') }}" class="w-[18px] h-[18px] object-contain" alt="Back">
        </a>

        <h1 class="text-[24px] font-bold">Klaim Kerusakan</h1>
    </div>

    <section class="bg-[#FFF4E8] border border-[#F7C892] rounded-[10px] px-[18px] py-[16px] mb-[18px] flex gap-[12px]">
        <img src="{{ asset('assets/icons/icon-warning-orange.png') }}" class="w-[28px] h-[28px] object-contain mt-[2px]" alt="Warning">

        <div>
            <h2 class="text-[17px] font-bold text-[#F26A1B]">
                Klaim Kerusakan Sedang Ditinjau
            </h2>

            <p class="text-[13px] text-[#4B5563] mt-[6px] leading-[20px]">
                Klaim kerusakan dibuat saat pemilik menemukan kerusakan pada barang setelah dikembalikan.
            </p>
        </div>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-[330px_1fr] gap-[18px]">

        <section class="bg-white border border-[#D7E5FA] rounded-[10px] p-[18px] shadow-sm">
            <h2 class="text-[18px] font-bold mb-[16px]">Ringkasan Transaksi</h2>

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
                        Status: Kerusakan
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
                    <span class="text-[#6B7280]">Total Pesanan</span>
                    <span class="font-bold text-[#34699A]">
                        {{ rupiahKlaim($transaksi->total_harga) }}
                    </span>
                </div>
            </div>
        </section>

        <section class="bg-white border border-[#D7E5FA] rounded-[10px] p-[18px] shadow-sm">
            <h2 class="text-[18px] font-bold mb-[16px]">Detail Klaim</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-[12px] mb-[16px]">

                <div class="border border-[#D7E5FA] rounded-[8px] px-[14px] py-[12px]">
                    <p class="text-[12px] text-[#6B7280]">Jenis Kerusakan</p>
                    <p class="text-[14px] font-bold mt-[5px]">Kerusakan Fisik</p>
                </div>

                <div class="border border-[#D7E5FA] rounded-[8px] px-[14px] py-[12px]">
                    <p class="text-[12px] text-[#6B7280]">Bagian Rusak</p>
                    <p class="text-[14px] font-bold mt-[5px]">Body Barang</p>
                </div>

                <div class="border border-[#D7E5FA] rounded-[8px] px-[14px] py-[12px]">
                    <p class="text-[12px] text-[#6B7280]">Biaya Perbaikan</p>
                    <p class="text-[14px] font-bold text-[#E3455D] mt-[5px]">Rp70.000</p>
                </div>

                <div class="border border-[#D7E5FA] rounded-[8px] px-[14px] py-[12px]">
                    <p class="text-[12px] text-[#6B7280]">Status Tanggapan</p>
                    <p class="text-[14px] font-bold text-[#D38A00] mt-[5px]">Menunggu Respon</p>
                </div>

            </div>

            <div class="border-t border-[#DDE8F5] pt-[16px]">
                <h3 class="text-[15px] font-bold mb-[8px]">Deskripsi Kerusakan</h3>

                <p class="text-[13px] text-[#4B5563] leading-[22px]">
                    Terdapat kerusakan pada bagian luar barang setelah dikembalikan. Detail ini masih data sementara sampai tabel klaim kerusakan dibuat.
                </p>
            </div>

            <div class="border-t border-[#DDE8F5] mt-[18px] pt-[16px]">
                <div class="flex items-center justify-between gap-[12px] mb-[12px]">
                    <h3 class="text-[15px] font-bold">Bukti Kerusakan</h3>

                    <button type="button" class="text-[12px] font-semibold text-[#34699A]">
                        Lihat Semua
                    </button>
                </div>

                <div class="grid grid-cols-3 gap-[10px]">
                    <img src="{{ asset('assets/docs/damage-1.png') }}" class="w-full h-[80px] sm:h-[96px] rounded-[8px] object-cover" alt="Bukti Kerusakan">
                    <img src="{{ asset('assets/docs/damage-2.png') }}" class="w-full h-[80px] sm:h-[96px] rounded-[8px] object-cover" alt="Bukti Kerusakan">
                    <img src="{{ asset('assets/docs/damage-3.png') }}" class="w-full h-[80px] sm:h-[96px] rounded-[8px] object-cover" alt="Bukti Kerusakan">
                </div>
            </div>

            <div class="mt-[18px] bg-[#EAF3FF] text-[#34699A] rounded-[8px] px-[14px] py-[12px] flex gap-[10px]">
                <img src="{{ asset('assets/icons/icon-info-blue.png') }}" class="w-[18px] h-[18px] object-contain mt-[2px]" alt="Info">

                <p class="text-[12px] font-medium leading-[20px]">
                    Jika penyewa menyetujui klaim, biaya kerusakan akan diproses sesuai deposit atau tagihan tambahan.
                </p>
            </div>

            @if($transaksi->role === 'penyewa')
                <div class="flex justify-end gap-[10px] mt-[20px]">
                    <button type="button"
                            class="h-[42px] px-[22px] rounded-[8px] border border-[#E3455D] text-[#E3455D] text-[13px] font-semibold">
                        Tidak Setuju
                    </button>

                    <button type="button"
                            class="h-[42px] px-[22px] rounded-[8px] bg-[#34699A] text-white text-[13px] font-semibold">
                        Setujui Klaim
                    </button>
                </div>
            @endif
        </section>

    </div>

</main>

</body>
</html>