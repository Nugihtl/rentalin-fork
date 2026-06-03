<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi Pemilik</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

@php
    function formatRupiahPemilik($angka) {
        return 'Rp' . number_format($angka, 0, ',', '.');
    }

    function labelStatusPemilik($status) {
        return match ($status) {
            'pesanan_masuk' => 'Pesanan Masuk',
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'pembayaran_berhasil' => 'Pembayaran Berhasil',
            'diproses' => 'Diproses',
            'dikirim' => 'Dikirim',
            'menunggu_penerimaan' => 'Menunggu Penerimaan',
            'disewa' => 'Disewa',
            'pengembalian' => 'Pengembalian',
            'belum_dikembalikan' => 'Belum Dikembalikan',
            'kerusakan' => 'Kerusakan',
            'dibatalkan' => 'Dibatalkan',
            'selesai' => 'Selesai',
            default => 'Diproses',
        };
    }

    function warnaStatusPemilik($status) {
        return match ($status) {
            'selesai' => 'bg-[#CFF3D9] text-[#348B55]',
            'pengembalian' => 'bg-[#FFF0C2] text-[#D38A00]',
            'dibatalkan', 'belum_dikembalikan', 'kerusakan' => 'bg-[#FFD6DE] text-[#E3455D]',
            default => 'bg-[#DDEBFF] text-[#2D85C4]',
        };
    }

    function pesanPemilik($status) {
        return match ($status) {
            'pesanan_masuk' => 'Pesanan baru masuk. Cek detail penyewa dan siapkan barang untuk proses serah terima.',
            'menunggu_pembayaran' => 'Pesanan menunggu pembayaran dari penyewa.',
            'pembayaran_berhasil' => 'Pembayaran telah berhasil. Siapkan barang dan lakukan konfirmasi pengiriman atau penyerahan.',
            'diproses' => 'Pesanan sedang diproses. Lakukan dokumentasi barang sebelum dikirim atau diserahkan.',
            'dikirim' => 'Barang telah dikirim. Tunggu penyewa melakukan konfirmasi penerimaan.',
            'menunggu_penerimaan' => 'Barang sedang menunggu konfirmasi penerimaan dari penyewa.',
            'disewa' => 'Barang sedang disewa oleh penyewa. Hubungi penyewa jika perlu koordinasi.',
            'pengembalian' => 'Barang telah dikembalikan oleh penyewa. Periksa kondisi barang lalu konfirmasi pengembalian.',
            'selesai' => 'Transaksi telah selesai. Anda dapat melihat detail transaksi dan penilaian dari penyewa.',
            'dibatalkan' => 'Pesanan dibatalkan. Cek detail transaksi untuk informasi pembatalan.',
            'belum_dikembalikan' => 'Masa sewa telah berakhir dan barang belum dikembalikan. Segera hubungi penyewa.',
            'kerusakan' => 'Klaim kerusakan sedang berlangsung. Lihat klaim untuk mengetahui detailnya.',
            default => 'Lihat detail transaksi untuk informasi lebih lengkap.',
        };
    }
@endphp

<body class="bg-[#F5F7FA] text-[#1E1E1E] [font-family:'Plus_Jakarta_Sans',sans-serif]">

<!-- NAVBAR DESKTOP -->
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
            <input type="text" placeholder="Search" class="w-[430px] h-[36px] rounded-full border border-[#D7DCE3] bg-white pl-10 pr-4 text-[12px] outline-none placeholder:text-[#9AA3AF]">
            <img src="{{ asset('assets/icons/icon-search.png') }}" class="absolute left-4 top-[10px] w-[15px] h-[15px] object-contain" alt="Search">
        </div>
    </div>

    <div class="flex items-center gap-[18px]">
        <img src="{{ asset('assets/icons/icon-bell.png') }}" class="w-[18px] h-[18px] object-contain" alt="Notif">
        <img src="{{ asset('assets/icons/icon-chat.png') }}" class="w-[18px] h-[18px] object-contain" alt="Chat">
        <img src="{{ asset('assets/icons/icon-cart.png') }}" class="w-[18px] h-[18px] object-contain" alt="Cart">

        <div class="w-px h-[28px] bg-[#D8DDE6]"></div>

        <span class="text-[13px] font-semibold">Pemilik</span>

        <img src="{{ asset('assets/profile/profile-toko.png') }}" class="w-[38px] h-[38px] rounded-[10px] object-cover" alt="Profile">
    </div>
</nav>

<!-- NAVBAR MOBILE -->
<nav class="sm:hidden bg-white border-b border-[#E7EAF0] px-[20px] pt-[18px] pb-[14px]">
    <div class="flex items-center justify-between mb-[14px]">
        <span class="text-[18px] font-semibold">9:41</span>
        <span class="text-[18px]">▮▮▮ ⌁ ▰</span>
    </div>

    <div class="relative">
        <input type="text" placeholder="Search" class="w-full h-[38px] rounded-full border border-[#1E1E1E] pl-[38px] pr-[18px] text-[13px] outline-none">
        <img src="{{ asset('assets/icons/icon-search.png') }}" class="absolute left-[14px] top-[11px] w-[16px] h-[16px] object-contain" alt="Search">
    </div>
</nav>

<!-- CONTENT -->
<main class="w-full max-w-[435px] sm:max-w-[940px] lg:max-w-[1220px] mx-auto px-[20px] sm:px-[44px] lg:px-[66px] pt-[28px] pb-[70px]">

    <h1 class="text-[22px] sm:text-[24px] font-bold mb-[20px]">
        Riwayat Transaksi
    </h1>

    @if(session('success'))
        <div class="mb-[18px] bg-[#E8F8EF] border border-[#B7E8C8] text-[#118642] px-[14px] py-[12px] rounded-[8px] text-[13px] font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-[22px]">
        <span class="inline-flex items-center h-[30px] px-[14px] rounded-[8px] bg-[#DDEBFF] text-[#34699A] text-[13px] font-semibold">
            <img src="{{ asset('assets/icons/icon-store-blue.png') }}" class="w-[16px] h-[16px] object-contain mr-[6px]" alt="Pemilik">
            Pemilik
        </span>
    </div>

    <!-- FILTER -->
    <div class="flex items-center gap-[14px] sm:justify-between overflow-x-auto pb-[8px] mb-[16px]">
        @foreach($filters as $key => $label)
            <a href="{{ route('riwayat.transaksi.pemilik', ['status' => $key]) }}"
               class="shrink-0 min-w-[108px] h-[38px] px-[18px] rounded-full border border-[#7BAFE3] text-[13px] font-medium flex items-center justify-center
               {{ $statusAktif === $key ? 'bg-[#34699A] text-white border-[#34699A]' : 'bg-white text-[#2F6EA5]' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <!-- PANDUAN -->
    <a href="#" class="w-full bg-[#DDEBFF] border border-[#BFD7FF] rounded-[10px] px-[18px] py-[16px] mb-[16px] flex items-center justify-between">
        <div class="flex items-center gap-[14px]">
            <img src="{{ asset('assets/icons/icon-guide.png') }}" class="w-[28px] h-[28px] object-contain" alt="Panduan">

            <div>
                <h2 class="text-[15px] font-bold">Panduan Proses Transaksi</h2>
                <p class="text-[12px] text-[#6B7280] mt-[4px]">
                    Lihat cara transaksi dari awal hingga selesai.
                </p>
            </div>
        </div>

        <img src="{{ asset('assets/icons/icon-arrow-right.png') }}" class="w-[18px] h-[18px] object-contain" alt="Arrow">
    </a>

    <!-- LIST CARD -->
    <div class="space-y-[14px]">
        @forelse($transaksis as $transaksi)
            @php
                $status = $transaksi->status;
                $isDanger = in_array($status, ['dibatalkan', 'belum_dikembalikan', 'kerusakan']);
            @endphp

            <div class="bg-white border border-[#D7E5FA] rounded-[10px] px-[12px] sm:px-[18px] py-[14px] shadow-[0px_2px_8px_rgba(15,23,42,0.06)]">

                <!-- HEADER CARD -->
                <div class="flex items-center justify-between border-b border-[#C3DAFE] pb-[12px] gap-[12px]">
                    <div class="flex items-center gap-[8px] min-w-0">
                        <img src="{{ asset('assets/profile/' . $transaksi->foto_penyewa) }}" class="w-[24px] h-[24px] rounded-full object-cover flex-shrink-0" alt="Penyewa">

                        <p class="text-[13px] font-semibold truncate">
                            <span class="font-bold">Penyewa:</span> {{ $transaksi->nama_penyewa }}
                        </p>
                    </div>

                    <span class="h-[28px] px-[15px] rounded-full text-[12px] font-semibold flex items-center justify-center shrink-0 {{ warnaStatusPemilik($status) }}">
                        {{ labelStatusPemilik($status) }}
                    </span>
                </div>

                <!-- BODY CARD -->
                <div class="flex items-center justify-between gap-[14px] py-[14px]">
                    <div class="flex gap-[12px] min-w-0">
                        <img src="{{ asset('assets/products/' . $transaksi->foto_produk) }}" class="w-[74px] h-[74px] sm:w-[82px] sm:h-[82px] rounded-[7px] object-cover flex-shrink-0" alt="{{ $transaksi->nama_produk }}">

                        <div class="min-w-0">
                            <h3 class="text-[14px] sm:text-[15px] font-bold leading-[21px] line-clamp-2">
                                {{ $transaksi->nama_produk }}
                            </h3>

                            <div class="flex flex-wrap gap-[6px] mt-[5px]">
                                @if($transaksi->varian)
                                    <span class="text-[10px] text-[#8A8A8A] border border-[#D7DCE3] rounded-[4px] px-[6px] py-[2px]">
                                        Varian: {{ $transaksi->varian }}
                                    </span>
                                @endif

                                <span class="text-[10px] text-[#8A8A8A] border border-[#D7DCE3] rounded-[4px] px-[6px] py-[2px]">
                                    Jumlah: {{ $transaksi->jumlah }}
                                </span>
                            </div>

                            <p class="text-[10px] text-[#8A8A8A] border border-[#D7DCE3] rounded-[4px] px-[6px] py-[2px] inline-block mt-[5px]">
                                ID Transaksi: {{ $transaksi->kode_transaksi }}
                            </p>

                            <p class="text-[11px] text-[#6B7280] mt-[6px]">
                                {{ $transaksi->tanggal_mulai }} - {{ $transaksi->tanggal_selesai }}
                                • {{ $transaksi->durasi }} hari
                            </p>
                        </div>
                    </div>

                    <div class="text-right shrink-0">
                        <p class="text-[12px] text-[#6B7280]">Total Pesanan</p>
                        <p class="text-[16px] sm:text-[17px] font-bold text-[#34699A] mt-[4px]">
                            {{ formatRupiahPemilik($transaksi->total_harga) }}
                        </p>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="border-t border-[#C3DAFE] pt-[12px] flex flex-wrap justify-end gap-[8px]">

                    @if(in_array($status, ['pesanan_masuk', 'pembayaran_berhasil', 'diproses']))
                        <a href="{{ route('transaksi.formKonfirmasiPengiriman', $transaksi->id_transaksi) }}" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-[#34699A] text-white text-[12px] sm:text-[13px] font-semibold flex items-center">
                            Konfirmasi Pengiriman
                        </a>

                        <a href="{{ route('transaksi.detail', $transaksi->id_transaksi) }}" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-white text-[#34699A] border border-[#34699A] text-[12px] sm:text-[13px] font-semibold flex items-center">
                            Detail Transaksi
                        </a>

                        <button type="button" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-white text-[#34699A] border border-[#34699A] text-[12px] sm:text-[13px] font-semibold">
                            Hubungi Penyewa
                        </button>
                    @endif

                    @if(in_array($status, ['dikirim', 'menunggu_penerimaan', 'disewa']))
                        <a href="{{ route('transaksi.detail', $transaksi->id_transaksi) }}" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-[#34699A] text-white text-[12px] sm:text-[13px] font-semibold flex items-center">
                            Detail Transaksi
                        </a>

                        <button type="button" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-white text-[#34699A] border border-[#34699A] text-[12px] sm:text-[13px] font-semibold">
                            Hubungi Penyewa
                        </button>
                    @endif

                    @if($status === 'pengembalian')
                        <a href="{{ route('transaksi.formKonfirmasiPengembalian', $transaksi->id_transaksi) }}" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-[#34699A] text-white text-[12px] sm:text-[13px] font-semibold flex items-center">
                            Konfirmasi Pengembalian
                        </a>

                        <a href="{{ route('transaksi.formPengajuanKerusakan', $transaksi->id_transaksi) }}" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-white text-[#E3455D] border border-[#E3455D] text-[12px] sm:text-[13px] font-semibold flex items-center">
                            Ajukan Kerusakan
                        </a>

                        <a href="{{ route('transaksi.detail', $transaksi->id_transaksi) }}" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-white text-[#34699A] border border-[#34699A] text-[12px] sm:text-[13px] font-semibold flex items-center">
                            Detail Transaksi
                        </a>
                    @endif

                    @if($status === 'kerusakan')
                        <a href="{{ route('transaksi.lihatKlaim', $transaksi->id_transaksi) }}" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-[#34699A] text-white text-[12px] sm:text-[13px] font-semibold flex items-center">
                            Lihat Klaim
                        </a>

                        <a href="{{ route('transaksi.detail', $transaksi->id_transaksi) }}" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-white text-[#34699A] border border-[#34699A] text-[12px] sm:text-[13px] font-semibold flex items-center">
                            Detail Transaksi
                        </a>
                    @endif

                    @if(in_array($status, ['selesai', 'dibatalkan', 'belum_dikembalikan']))
                        <a href="{{ route('transaksi.detail', $transaksi->id_transaksi) }}" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-[#34699A] text-white text-[12px] sm:text-[13px] font-semibold flex items-center">
                            Detail Transaksi
                        </a>

                        <button type="button" class="h-[36px] px-[13px] sm:px-[16px] rounded-[7px] bg-white text-[#34699A] border border-[#34699A] text-[12px] sm:text-[13px] font-semibold">
                            Hubungi Penyewa
                        </button>
                    @endif

                </div>

                <!-- MESSAGE INFO -->
                <div class="mt-[12px] rounded-[8px] px-[12px] py-[10px] flex items-start gap-[8px] {{ $isDanger ? 'bg-[#FFECEF] text-[#E3455D]' : 'bg-[#EAF3FF] text-[#34699A]' }}">
                    <img src="{{ asset($isDanger ? 'assets/icons/icon-warning-red.png' : 'assets/icons/icon-info-blue.png') }}" class="w-[18px] h-[18px] object-contain mt-[1px] flex-shrink-0" alt="Info">

                    <p class="text-[12px] leading-[20px] font-medium">
                        {{ pesanPemilik($status) }}
                    </p>
                </div>

            </div>
        @empty
            <div class="bg-white border border-[#D7E5FA] rounded-[10px] px-[18px] py-[28px] text-center">
                <p class="text-[14px] text-[#6B7280]">
                    Belum ada transaksi pada status ini.
                </p>
            </div>
        @endforelse
    </div>

    <div class="mt-[36px]">
        {{ $transaksis->links() }}
    </div>

</main>

</body>
</html>