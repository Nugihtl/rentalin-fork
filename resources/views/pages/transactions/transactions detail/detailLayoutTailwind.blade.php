<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F5F7FA] text-[#1E1E1E] [font-family:'Plus_Jakarta_Sans',sans-serif]">

<!-- ================= NAVBAR ================= -->
<nav class="w-full h-[58px] bg-white border-b border-[#E7EAF0] px-[18px] flex items-center justify-between">

    <div class="flex items-center gap-8">

        <div class="flex items-center leading-none">
            <div class="bg-[#34699A] text-white text-[19px] font-extrabold px-[12px] py-[6px] rounded-[10px] tracking-[0.3px]">
                Rental
            </div>

            <div class="text-[#F2C94C] text-[19px] font-extrabold ml-[2px]">
                in
            </div>
        </div>

        <div class="relative hidden md:block">
            <input
                type="text"
                placeholder="Search"
                class="w-[260px] lg:w-[430px] h-[36px] rounded-full border border-[#D7DCE3] bg-white pl-10 pr-4 text-[12px] outline-none placeholder:text-[#9AA3AF]"
            >

            <img
                src="{{ asset('assets/icons/icon-search.png') }}"
                class="absolute left-4 top-[10px] w-[15px] h-[15px] object-contain"
                alt="Search"
            >
        </div>

    </div>

    <div class="hidden sm:flex items-center gap-[18px]">
        <img src="{{ asset('assets/icons/icon-bell.png') }}" class="w-[18px] h-[18px] object-contain" alt="Notifikasi">
        <img src="{{ asset('assets/icons/icon-chat.png') }}" class="w-[18px] h-[18px] object-contain" alt="Chat">
        <img src="{{ asset('assets/icons/icon-cart.png') }}" class="w-[18px] h-[18px] object-contain" alt="Keranjang">

        <div class="w-px h-[28px] bg-[#D8DDE6]"></div>

        <div class="flex items-center gap-2">
            <div class="w-[34px] h-[34px] rounded-full bg-[#34699A] flex items-center justify-center">
                <img src="{{ asset('assets/icons/icon-store.png') }}" class="w-[18px] h-[18px] object-contain" alt="Toko">
            </div>

            <span class="text-[13px] font-semibold">
                Toko
            </span>
        </div>

        <img
            src="{{ asset('assets/profile/profile-toko.png') }}"
            class="w-[38px] h-[38px] rounded-[10px] object-cover"
            alt="Profile"
        >
    </div>

</nav>

<!-- ================= CONTENT ================= -->
<main class="w-full max-w-[435px] sm:max-w-[940px] lg:max-w-[1220px] mx-auto px-[20px] sm:px-[44px] lg:px-[66px] pt-[28px] pb-[80px]">

    <!-- TITLE -->
    <div class="flex items-center gap-[14px] mb-[28px]">
        <button class="w-[34px] h-[34px] rounded-full border border-[#1E1E1E] flex items-center justify-center flex-shrink-0">
            <img src="{{ asset('assets/icons/icon-back.png') }}" class="w-[16px] h-[16px] object-contain" alt="Back">
        </button>

        <h1 class="text-[24px] sm:text-[26px] font-bold">
            Detail Transaksi
        </h1>
    </div>

    <!-- TOP STATUS MESSAGE -->
    <section class="border rounded-[10px] px-[20px] sm:px-[32px] py-[22px] mb-[24px] flex flex-col sm:flex-row sm:items-center justify-between gap-[18px] {{ $topBoxClass }}">

        <div class="flex items-center gap-[18px]">
            <div class="w-[54px] h-[54px] rounded-full flex items-center justify-center flex-shrink-0 {{ $topIconClass }}">
                <img src="{{ asset('assets/icons/' . $topIcon) }}" class="w-[28px] h-[28px] object-contain" alt="Status">
            </div>

            <div>
                <h2 class="text-[20px] sm:text-[22px] font-bold {{ $topTitleClass }}">
                    {{ $topTitle }}
                </h2>

                <p class="text-[13px] sm:text-[14px] text-[#4B5563] mt-[6px] leading-[22px]">
                    {{ $topDesc }}
                </p>
            </div>
        </div>

        @if(!empty($topButton))
            <button class="h-[40px] px-[18px] rounded-[6px] border border-[#34699A] bg-white text-[#34699A] text-[13px] font-semibold whitespace-nowrap">
                {{ $topButton }}
            </button>
        @endif

    </section>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[14px] sm:gap-[16px]">

        <!-- INFORMASI BARANG -->
        <section class="bg-white border border-[#D7E5FA] rounded-[10px] px-[20px] py-[18px] shadow-[0px_2px_6px_rgba(0,0,0,0.08)]">

            <h2 class="text-[18px] font-bold mb-[18px]">
                Informasi Barang
            </h2>

            <div class="flex gap-[16px] mb-[18px]">
                <img
                    src="{{ asset('assets/products/kompor-listrik.png') }}"
                    class="w-[96px] h-[86px] rounded-[8px] object-cover flex-shrink-0"
                    alt="Kompor Listrik"
                >

                <div class="min-w-0 flex-1">
                    <h3 class="text-[17px] font-bold leading-[24px]">
                        Kompor Listrik Portable
                    </h3>

                    <div class="flex items-center gap-[8px] mt-[8px] text-[13px]">
                        <img src="{{ asset('assets/icons/icon-store-small.png') }}" class="w-[16px] h-[16px] object-contain" alt="Store">
                        <span class="text-[#4B5563]">
                            Vynelle Market
                        </span>
                    </div>

                    <span class="inline-flex mt-[10px] h-[24px] px-[12px] rounded-full text-[12px] font-semibold items-center {{ $badgeClass }}">
                        {{ $badgeText }}
                    </span>
                </div>
            </div>

            <div class="border-t border-[#DDE8F5] pt-[16px] grid grid-cols-1 md:grid-cols-2 gap-[16px]">

                <div class="flex items-start gap-[10px]">
                    <img src="{{ asset('assets/icons/icon-transaction.png') }}" class="w-[18px] h-[18px] object-contain mt-[2px]" alt="ID">
                    <div>
                        <p class="text-[12px] text-[#6B7280]">ID Transaksi</p>
                        <p class="text-[13px] font-bold mt-[3px]">TRX-2026-08-00123</p>
                    </div>
                </div>

                <div class="flex items-start gap-[10px]">
                    <img src="{{ asset('assets/icons/icon-calendar.png') }}" class="w-[18px] h-[18px] object-contain mt-[2px]" alt="Tanggal">
                    <div>
                        <p class="text-[12px] text-[#6B7280]">Tanggal Pesanan</p>
                        <p class="text-[13px] font-bold mt-[3px]">6 Mei 2026</p>
                    </div>
                </div>

                <div class="flex items-start gap-[10px]">
                    <img src="{{ asset('assets/icons/icon-calendar.png') }}" class="w-[18px] h-[18px] object-contain mt-[2px]" alt="Jadwal">
                    <div>
                        <p class="text-[12px] text-[#6B7280]">Jadwal Penyewaan</p>
                        <p class="text-[13px] font-bold mt-[3px]">8 Mei 2026 - 13 Mei 2026</p>
                    </div>
                </div>

                <div class="flex items-start gap-[10px]">
                    <img src="{{ asset('assets/icons/icon-calendar-return.png') }}" class="w-[18px] h-[18px] object-contain mt-[2px]" alt="Pengembalian">
                    <div>
                        <p class="text-[12px] text-[#6B7280]">Tanggal Pengembalian Terbaru</p>
                        <p class="text-[13px] font-bold mt-[3px]">{{ $tanggalPengembalian }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-[10px]">
                    <img src="{{ asset('assets/icons/icon-duration.png') }}" class="w-[18px] h-[18px] object-contain mt-[2px]" alt="Durasi">
                    <div>
                        <p class="text-[12px] text-[#6B7280]">Durasi Sewa</p>
                        <p class="text-[13px] font-bold mt-[3px]">6 hari</p>
                    </div>
                </div>

                <div class="flex items-start gap-[10px]">
                    <img src="{{ asset('assets/icons/icon-clock.png') }}" class="w-[18px] h-[18px] object-contain mt-[2px]" alt="Sisa">
                    <div>
                        <p class="text-[12px] text-[#6B7280]">Sisa Waktu Sewa</p>
                        <p class="text-[13px] font-bold mt-[3px] {{ $sisaWaktuClass }}">
                            {{ $sisaWaktu }}
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- TIMELINE -->
        <section class="bg-white border border-[#D7E5FA] rounded-[10px] px-[20px] py-[18px] shadow-[0px_2px_6px_rgba(0,0,0,0.08)]">

            <h2 class="text-[18px] font-bold mb-[18px]">
                Timeline Transaksi
            </h2>

            <div>
                @foreach($timeline as $item)
                    <div class="grid grid-cols-[30px_1fr_auto] gap-[12px] min-h-[40px]">

                        <div class="flex flex-col items-center">
                            <div class="w-[24px] h-[24px] rounded-full flex items-center justify-center text-[11px] font-bold z-10 {{ $item['circleClass'] }}">
                                {{ $item['icon'] }}
                            </div>

                            @if(!$loop->last)
                                <div class="w-px flex-1 min-h-[18px] {{ $item['lineClass'] }}"></div>
                            @endif
                        </div>

                        <div class="pb-[12px]">
                            <p class="text-[13px] font-semibold {{ $item['textClass'] }}">
                                {{ $item['title'] }}
                            </p>

                            <p class="text-[11px] text-[#6B7280] mt-[3px]">
                                {{ $item['desc'] }}
                            </p>
                        </div>

                        <div class="hidden md:block text-[12px] text-right pb-[12px] {{ $item['dateClass'] }}">
                            {{ $item['date'] }}
                        </div>

                    </div>
                @endforeach
            </div>

        </section>

        <!-- INFO PENGIRIMAN -->
        <section class="bg-white border border-[#D7E5FA] rounded-[10px] px-[20px] py-[18px] shadow-[0px_2px_6px_rgba(0,0,0,0.08)]">

            <h2 class="text-[18px] font-bold mb-[18px]">
                Info Pengiriman
            </h2>

            <div class="space-y-[14px] text-[13px]">
                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">Metode Pengiriman</span>
                    <span class="font-semibold text-right">Delivery</span>
                </div>

                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">Ekspedisi</span>
                    <span class="font-semibold text-right">{{ $ekspedisi }}</span>
                </div>

                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">No. Resi</span>
                    <span class="font-semibold text-right">{{ $resi }}</span>
                </div>

                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">Alamat Pengiriman</span>
                    <span class="font-semibold text-right leading-[20px]">
                        Budi Santoso (+62 812-3383-0935), Jl. Braga,<br>
                        Kecamatan Sumur Bandung, Kota Bandung,<br>
                        Jawa Barat 40111
                    </span>
                </div>
            </div>

        </section>

        <!-- RINCIAN PEMBAYARAN -->
        <section class="bg-white border border-[#D7E5FA] rounded-[10px] px-[20px] py-[18px] shadow-[0px_2px_6px_rgba(0,0,0,0.08)]">

            <h2 class="text-[18px] font-bold mb-[18px]">
                Rincian Pembayaran
            </h2>

            <div class="space-y-[14px] text-[13px]">

                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">Metode Pembayaran</span>
                    <span class="font-semibold">COD</span>
                </div>

                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">Harga Sewa</span>
                    <span class="font-semibold">Rp65.000/hari</span>
                </div>

                <div class="flex justify-between gap-[20px]">
                    <span class="text-[#6B7280]">Deposit</span>
                    <span class="font-semibold">Rp50.000</span>
                </div>

                @foreach($paymentRows as $row)
                    <div class="flex justify-between gap-[20px]">
                        <span class="text-[#6B7280]">{{ $row['label'] }}</span>
                        <span class="font-semibold {{ $row['class'] ?? '' }}">{{ $row['value'] }}</span>
                    </div>
                @endforeach

            </div>

            <div class="border-t border-[#DDE8F5] mt-[18px] pt-[16px] flex justify-between items-center">
                <span class="text-[15px] font-bold">
                    {{ $totalLabel }}
                </span>

                <span class="text-[20px] font-bold text-[#34699A]">
                    {{ $totalValue }}
                </span>
            </div>

        </section>

    </div>

    <!-- DOKUMENTASI -->
    <section class="bg-white border border-[#D7E5FA] rounded-[10px] px-[20px] py-[18px] mt-[16px] shadow-[0px_2px_6px_rgba(0,0,0,0.08)]">

        <h2 class="text-[18px] font-bold mb-[16px]">
            Dokumentasi Berdasarkan Proses
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 {{ $showKerusakan ? 'lg:grid-cols-4' : '' }} gap-[14px]">

            @foreach($docs as $doc)
                @if($doc['key'] === 'kerusakan' && !$showKerusakan)
                    @continue
                @endif

                <div class="border border-[#C3DAFE] rounded-[8px] p-[12px]">

                    <h3 class="text-[13px] font-bold">
                        {{ $doc['title'] }}
                    </h3>

                    <p class="text-[11px] text-[#6B7280] mt-[3px] mb-[10px]">
                        {{ $doc['desc'] }}
                    </p>

                    <div class="grid grid-cols-3 gap-[8px] mb-[12px]">
                        @if($doc['available'])
                            @foreach($doc['images'] as $image)
                                <img
                                    src="{{ asset('assets/docs/' . $image) }}"
                                    class="w-full h-[64px] rounded-[6px] object-cover"
                                    alt="Dokumentasi"
                                >
                            @endforeach
                        @else
                            @for($i = 0; $i < 3; $i++)
                                <div class="w-full h-[64px] rounded-[6px] bg-[#E5E7EB] flex items-center justify-center">
                                    <img src="{{ asset('assets/icons/icon-image-placeholder.png') }}" class="w-[22px] h-[22px] object-contain opacity-60" alt="Placeholder">
                                </div>
                            @endfor
                        @endif
                    </div>

                    <button
                        class="w-full h-[32px] rounded-[6px] border text-[12px] font-semibold
                        {{ $doc['available'] ? 'border-[#34699A] text-[#34699A] bg-white' : 'border-[#D1D5DB] text-[#9CA3AF] bg-[#F3F4F6]' }}"
                        {{ $doc['available'] ? '' : 'disabled' }}
                    >
                        {{ $doc['available'] ? 'Lihat Semua' : 'Belum tersedia' }}
                    </button>

                </div>
            @endforeach

        </div>

        <div class="mt-[14px] bg-[#EAF3FF] text-[#34699A] rounded-[8px] px-[14px] py-[10px] flex items-start gap-[10px]">
            <img src="{{ asset('assets/icons/icon-info-blue.png') }}" class="w-[18px] h-[18px] object-contain mt-[1px]" alt="Info">

            <p class="text-[12px] font-semibold leading-[20px]">
                Dokumentasi digunakan sebagai bukti kondisi barang di setiap tahap proses.
            </p>
        </div>

    </section>

    <!-- STATUS & AKSI -->
    <section class="bg-white border border-[#C3DAFE] rounded-[10px] px-[20px] py-[18px] mt-[18px] shadow-[0px_2px_6px_rgba(0,0,0,0.06)]">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-[18px]">

            <div class="flex items-start gap-[14px]">
                <div class="w-[42px] h-[42px] rounded-full border border-[#34699A] flex items-center justify-center flex-shrink-0">
                    <img src="{{ asset('assets/icons/icon-info-blue.png') }}" class="w-[22px] h-[22px] object-contain" alt="Info">
                </div>

                <div>
                    <div class="flex items-center gap-[10px] mb-[8px] flex-wrap">
                        <h2 class="text-[18px] font-bold text-[#34699A]">
                            Status & Aksi
                        </h2>

                        <span class="h-[24px] px-[12px] rounded-full text-[12px] font-semibold flex items-center {{ $badgeClass }}">
                            {{ $badgeText }}
                        </span>
                    </div>

                    <p class="text-[13px] text-[#374151] leading-[21px]">
                        {{ $bottomDesc }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-[10px] lg:justify-end">
                @foreach($buttons as $button)
                    <button class="h-[40px] px-[24px] rounded-[6px] text-[13px] font-semibold {{ $button['class'] }}">
                        {{ $button['label'] }}
                    </button>
                @endforeach
            </div>

        </div>

        <div class="mt-[16px] bg-[#EAF3FF] text-[#34699A] rounded-[8px] px-[14px] py-[10px] flex items-start gap-[10px]">
            <img src="{{ asset('assets/icons/icon-info-blue.png') }}" class="w-[18px] h-[18px] object-contain mt-[1px]" alt="Info">

            <p class="text-[12px] font-semibold leading-[20px]">
                {{ $infoMessage }}
            </p>
        </div>

    </section>

</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-white border-t border-[#E5EAF0]">

    <div class="max-w-[1220px] mx-auto px-[22px] sm:px-[44px] lg:px-[66px] py-[36px]">

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-[30px]">

            <div>
                <div class="flex items-center leading-none mb-[14px]">
                    <div class="bg-[#34699A] text-white text-[19px] font-extrabold px-[12px] py-[6px] rounded-[10px]">
                        Rental
                    </div>

                    <div class="text-[#F2C94C] text-[19px] font-extrabold ml-[2px]">
                        in
                    </div>
                </div>

                <p class="text-[13px] leading-[24px] text-[#444] max-w-[260px]">
                    Platform sewa menyewa barang yang aman, mudah, dan terpercaya
                </p>
            </div>

            <div>
                <h3 class="text-[15px] font-semibold mb-[14px]">
                    Quick Links
                </h3>

                <div class="space-y-[8px] text-[13px] text-[#7B8491]">
                    <p>Home</p>
                    <p>Riwayat</p>
                    <p>Kontak</p>
                </div>
            </div>

            <div>
                <h3 class="text-[15px] font-semibold mb-[14px]">
                    Hubungi Kami
                </h3>

                <div class="space-y-[8px] text-[13px] text-[#7B8491]">
                    <p>+62 123 456 987</p>
                    <p>support@rentalin.com</p>
                    <p>Jl. Cibubur No. 123</p>
                </div>
            </div>

        </div>

        <div class="border-t border-[#D7DCE3] mt-[32px] pt-[18px] flex items-center justify-between">
            <p class="text-[13px]">
                © 2026 Rentalin. All rights reserved
            </p>

            <div class="flex items-center gap-[14px]">
                <img src="{{ asset('assets/icons/icon-instagram.png') }}" class="w-[18px] h-[18px] object-contain" alt="Instagram">
                <img src="{{ asset('assets/icons/icon-whatsapp.png') }}" class="w-[18px] h-[18px] object-contain" alt="WhatsApp">
                <img src="{{ asset('assets/icons/icon-facebook.png') }}" class="w-[18px] h-[18px] object-contain" alt="Facebook">
            </div>
        </div>

    </div>

</footer>

</body>
</html>