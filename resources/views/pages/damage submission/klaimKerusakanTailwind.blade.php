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

<body class="bg-[#F5F7FA] text-[#1E1E1E] [font-family:'Plus_Jakarta_Sans',sans-serif]">

<!-- ================= NAVBAR ================= -->
<nav class="hidden sm:flex w-full h-[58px] bg-white border-b border-[#E7EAF0] px-[18px] items-center justify-between">

    <div class="flex items-center gap-8">

        <div class="flex items-center leading-none">
            <div class="bg-[#34699A] text-white text-[19px] font-extrabold px-[12px] py-[6px] rounded-[10px] tracking-[0.3px]">
                Rental
            </div>

            <div class="text-[#F2C94C] text-[19px] font-extrabold ml-[2px]">
                in
            </div>
        </div>

        <div class="relative hidden lg:block">
            <input
                type="text"
                placeholder="Search"
                class="w-[430px] h-[36px] rounded-full border border-[#D7DCE3] bg-white pl-10 pr-4 text-[12px] outline-none placeholder:text-[#9AA3AF]"
            >

            <img
                src="{{ asset('assets/icons/icon-search.png') }}"
                class="absolute left-4 top-[10px] w-[15px] h-[15px] object-contain"
                alt="Search"
            >
        </div>

    </div>

    <div class="flex items-center gap-[18px]">
        <img src="{{ asset('assets/icons/icon-bell.png') }}" class="w-[18px] h-[18px] object-contain" alt="Notif">
        <img src="{{ asset('assets/icons/icon-chat.png') }}" class="w-[18px] h-[18px] object-contain" alt="Chat">
        <img src="{{ asset('assets/icons/icon-cart.png') }}" class="w-[18px] h-[18px] object-contain" alt="Cart">

        <div class="w-px h-[28px] bg-[#D8DDE6]"></div>

        <span class="text-[13px] font-semibold">
            Penyewa
        </span>

        <img
            src="{{ asset('assets/profile/profile-toko.png') }}"
            class="w-[38px] h-[38px] rounded-[10px] object-cover"
            alt="Profile"
        >
    </div>

</nav>

<!-- ================= NAVBAR MOBILE ================= -->
<nav class="sm:hidden bg-white border-b border-[#E7EAF0] px-[20px] pt-[18px] pb-[14px]">
    <div class="flex items-center justify-between mb-[14px]">
        <span class="text-[18px] font-semibold">9:41</span>
        <span class="text-[18px]">▮▮▮ ⌁ ▰</span>
    </div>
</nav>

<!-- ================= CONTENT ================= -->
<main class="w-full max-w-[435px] sm:max-w-[940px] lg:max-w-[1220px] mx-auto px-[20px] sm:px-[44px] lg:px-[66px] pt-[28px] pb-[70px]">

    <!-- TITLE -->
    <div class="flex items-center gap-[14px] mb-[28px]">

        <a
            href="{{ url()->previous() }}"
            class="w-[34px] h-[34px] rounded-full border border-[#1E1E1E] flex items-center justify-center text-[24px] leading-none flex-shrink-0"
        >
            ‹
        </a>

        <h1 class="text-[24px] sm:text-[26px] font-bold">
            Klaim Kerusakan
        </h1>

    </div>

    <!-- STATUS MESSAGE -->
    <section class="bg-[#FFF4E8] border border-[#F7C892] rounded-[10px] px-[18px] sm:px-[24px] py-[18px] mb-[18px] flex items-start gap-[14px]">

        <div class="w-[42px] h-[42px] rounded-full bg-[#F26A1B] flex items-center justify-center flex-shrink-0">
            <span class="text-white text-[22px] font-bold">!</span>
        </div>

        <div>
            <h2 class="text-[18px] font-bold text-[#F26A1B]">
                Klaim Kerusakan Sedang Ditinjau
            </h2>

            <p class="text-[13px] text-[#4B5563] mt-[6px] leading-[21px]">
                Pemilik telah mengajukan klaim kerusakan untuk transaksi ini. Silakan tinjau bukti dan rincian biaya sebelum memberikan tanggapan.
            </p>
        </div>

    </section>

    <!-- GRID CONTENT -->
    <div class="grid grid-cols-1 sm:grid-cols-[360px_1fr] lg:grid-cols-[410px_1fr] gap-[18px] items-start">

        <!-- RINGKASAN BARANG -->
        <section class="bg-white border border-[#D7E5FA] rounded-[10px] px-[18px] py-[18px] shadow-[0px_2px_6px_rgba(0,0,0,0.08)]">

            <h2 class="text-[18px] font-bold mb-[18px]">
                Ringkasan Barang
            </h2>

            <div class="flex items-center gap-[14px] mb-[18px]">

                <img
                    src="{{ asset('assets/products/' . $transaksi->foto_produk) }}"
                    class="w-[86px] h-[78px] rounded-[8px] object-cover flex-shrink-0"
                    alt="{{ $transaksi->nama_produk }}"
                >

                <div class="min-w-0">
                    <h3 class="text-[17px] font-bold leading-[23px]">
                        {{ $transaksi->nama_produk }}
                    </h3>

                    <p class="text-[12px] text-[#6B7280] mt-[6px]">
                        ID Transaksi:
                    </p>

                    <p class="text-[12px] font-semibold mt-[2px]">
                        {{ $transaksi->kode_transaksi }}
                    </p>
                </div>

            </div>

            <div class="border-t border-[#DDE8F5] pt-[16px] space-y-[14px] text-[13px]">

                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">Status</span>
                    <span class="font-semibold text-[#E3455D]">Kerusakan</span>
                </div>

                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">Periode Sewa</span>
                    <span class="font-semibold text-right">
                        {{ $transaksi->tanggal_mulai }} - {{ $transaksi->tanggal_selesai }}
                    </span>
                </div>

                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">Durasi</span>
                    <span class="font-semibold">
                        {{ $transaksi->durasi }} hari
                    </span>
                </div>

                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">Total Pesanan</span>
                    <span class="font-semibold text-[#34699A]">
                        Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </span>
                </div>

            </div>

        </section>

        <!-- DETAIL KLAIM -->
        <section class="bg-white border border-[#D7E5FA] rounded-[10px] px-[18px] sm:px-[24px] py-[18px] shadow-[0px_2px_6px_rgba(0,0,0,0.08)]">

            <h2 class="text-[18px] font-bold mb-[18px]">
                Detail Klaim Kerusakan
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-[14px] mb-[18px]">

                <div class="border border-[#D7E5FA] rounded-[8px] px-[14px] py-[12px]">
                    <p class="text-[12px] text-[#6B7280]">
                        Jenis Kerusakan
                    </p>

                    <p class="text-[14px] font-bold mt-[5px]">
                        Kerusakan Fisik
                    </p>
                </div>

                <div class="border border-[#D7E5FA] rounded-[8px] px-[14px] py-[12px]">
                    <p class="text-[12px] text-[#6B7280]">
                        Bagian Rusak
                    </p>

                    <p class="text-[14px] font-bold mt-[5px]">
                        Permukaan / body barang
                    </p>
                </div>

                <div class="border border-[#D7E5FA] rounded-[8px] px-[14px] py-[12px]">
                    <p class="text-[12px] text-[#6B7280]">
                        Biaya Perbaikan
                    </p>

                    <p class="text-[14px] font-bold text-[#E3455D] mt-[5px]">
                        Rp70.000
                    </p>
                </div>

                <div class="border border-[#D7E5FA] rounded-[8px] px-[14px] py-[12px]">
                    <p class="text-[12px] text-[#6B7280]">
                        Status Tanggapan
                    </p>

                    <p class="text-[14px] font-bold text-[#D38A00] mt-[5px]">
                        Menunggu Respon
                    </p>
                </div>

            </div>

            <!-- DESKRIPSI -->
            <div class="border-t border-[#DDE8F5] pt-[16px]">

                <h3 class="text-[15px] font-bold mb-[8px]">
                    Deskripsi Kerusakan
                </h3>

                <p class="text-[13px] text-[#4B5563] leading-[22px]">
                    Terdapat goresan dan bekas penggunaan yang cukup terlihat pada bagian luar barang. Pemilik mengajukan biaya perbaikan sesuai kondisi barang setelah dikembalikan.
                </p>

            </div>

            <!-- BUKTI FOTO -->
            <div class="border-t border-[#DDE8F5] mt-[18px] pt-[16px]">

                <div class="flex items-center justify-between gap-[14px] mb-[12px]">
                    <h3 class="text-[15px] font-bold">
                        Bukti Kerusakan
                    </h3>

                    <button class="text-[12px] font-semibold text-[#34699A]">
                        Lihat Semua
                    </button>
                </div>

                <div class="grid grid-cols-3 gap-[10px]">
                    <img
                        src="{{ asset('assets/docs/damage-1.png') }}"
                        class="w-full h-[82px] sm:h-[96px] rounded-[8px] object-cover"
                        alt="Bukti Kerusakan"
                    >

                    <img
                        src="{{ asset('assets/docs/damage-2.png') }}"
                        class="w-full h-[82px] sm:h-[96px] rounded-[8px] object-cover"
                        alt="Bukti Kerusakan"
                    >

                    <img
                        src="{{ asset('assets/docs/damage-3.png') }}"
                        class="w-full h-[82px] sm:h-[96px] rounded-[8px] object-cover"
                        alt="Bukti Kerusakan"
                    >
                </div>

            </div>

            <!-- INFO MESSAGE -->
            <div class="mt-[18px] bg-[#EAF3FF] text-[#34699A] rounded-[8px] px-[14px] py-[11px] flex items-start gap-[10px]">
                <span class="text-[16px] mt-[1px]">ℹ️</span>

                <p class="text-[12px] font-semibold leading-[20px]">
                    Jika Anda menyetujui klaim, biaya kerusakan akan dipotong dari deposit. Jika tidak setuju, Anda dapat mengajukan banding.
                </p>
            </div>

            <!-- BUTTON -->
            <div class="flex flex-col sm:flex-row justify-end gap-[10px] mt-[18px]">

                <button class="h-[40px] px-[20px] rounded-[7px] border border-[#E3455D] bg-white text-[#E3455D] text-[13px] font-semibold">
                    Tidak Setuju
                </button>

                <button class="h-[40px] px-[20px] rounded-[7px] bg-[#34699A] text-white text-[13px] font-semibold">
                    Setujui Klaim
                </button>

            </div>

        </section>

    </div>

</main>

</body>
</html>