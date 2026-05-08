<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rentalin - Sewa Apa Saja</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800">

  {{-- NAVBAR --}}
  <nav id="navbar" class="navbar sticky top-0 z-50 bg-white flex items-center justify-between px-6 py-3 border-b border-gray-100 transition-shadow duration-300">
    <div class="nav-left flex items-center">
      {{-- Mengarah ke Homepage --}}
      <a href="{{ route('home') }}" class="logo" style="text-decoration: none;">
        <img src="{{ asset('assets/img/logo/logo 2.png') }}" alt="Rentalin Logo" class="logo-img h-8">
      </a>
    </div>

    <div class="search-bar flex items-center gap-2 bg-gray-100 rounded-full px-4 py-2 flex-1 max-w-sm mx-6">
      <span class="search-icon text-gray-400 text-sm">🔍</span>
      <input id="searchInput" type="text" placeholder="Search"
        class="bg-transparent text-sm outline-none w-full text-gray-700 placeholder-gray-400">
    </div>

    <div class="nav-right flex items-center gap-3">
      <div class="icon-group flex items-center gap-2">
        <button class="icon-btn icon-bell text-gray-500 hover:text-brand transition-colors text-lg">🔔</button>
        {{-- Mengarah ke Chat --}}
        <button class="icon-btn icon-chat text-gray-500 hover:text-brand transition-colors text-lg"
          onclick="window.location.href='{{ url('chat') }}'">💬</button>
        {{-- Mengarah ke Riwayat Penyewa --}}
        <button class="icon-btn icon-cart text-gray-500 hover:text-brand transition-colors text-lg"
          onclick="window.location.href='{{ url('riwayat-transaksi-penyewa') }}'">🛒</button>
      </div>
      <div class="nav-divider w-px h-6 bg-gray-200 mx-1"></div>
      {{-- Mengarah ke Toko --}}
      <button class="toko-btn flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700"
        onclick="window.location.href='{{ url('toko') }}'">
        <div class="toko-icon-wrapper text-base">🏪</div>
        <span>Toko</span>
      </button>
      {{-- Mengarah ke Profile --}}
      <div class="profile-group flex items-center gap-2 cursor-pointer hover:opacity-80 transition-opacity"
        onclick="window.location.href='{{ url('profile') }}'">
        <img src="{{ asset('assets/img/profile/user-photo-profile.png') }}" alt="Profile"
          class="profile-img w-8 h-8 rounded-full object-cover">
        <span class="profile-name text-sm font-medium text-gray-700">Nugra Hasahatan</span>
      </div>
    </div>
  </nav>

  <main>

    {{-- HERO --}}
    <section class="hero">
      <div class="container">
        <div class="hero-content">
          <h1 class="hero-title">Sewa Apa Saja,<br>Kapan Saja</h1>
          <p class="hero-desc">Temukan berbagai kebutuhan dalam<br>satu platform yang praktis dan aman.</p>
        </div>
      </div>
    </section>

    {{-- KATEGORI --}}
    <section class="kategori-section bg-white py-8 border-b border-gray-100">
      <div class="container kategori-container flex justify-around gap-4 max-w-5xl mx-auto px-6">

        <button data-kategori="gadget" class="kategori-btn kategori-item flex flex-col items-center gap-2 cursor-pointer bg-transparent border-none">
          <div class="icon-box w-14 h-14 flex items-center justify-center rounded-xl border border-gray-200 hover:border-brand transition-colors">
            <img src="{{ asset('assets/img/kategori/icon-gadget@2x.png') }}" alt="Elektronik & Gadget" class="w-8 h-8">
          </div>
          <p class="text-xs text-gray-500 text-center leading-snug">Elektronik &<br>Gadget</p>
        </button>

        <button data-kategori="fashion" class="kategori-btn kategori-item flex flex-col items-center gap-2 cursor-pointer bg-transparent border-none">
          <div class="icon-box w-14 h-14 flex items-center justify-center rounded-xl border border-gray-200 hover:border-brand transition-colors">
            <img src="{{ asset('assets/img/kategori/icon-fashion@2x.png') }}" alt="Fashion & Aksesoris" class="w-8 h-8">
          </div>
          <p class="text-xs text-gray-500 text-center leading-snug">Fashion &<br>Aksesoris</p>
        </button>

        <button data-kategori="event" class="kategori-btn kategori-item flex flex-col items-center gap-2 cursor-pointer bg-transparent border-none">
          <div class="icon-box w-14 h-14 flex items-center justify-center rounded-xl border border-gray-200 hover:border-brand transition-colors">
            <img src="{{ asset('assets/img/kategori/icon-event@2x.png') }}" alt="Pesta & Event" class="w-8 h-8">
          </div>
          <p class="text-xs text-gray-500 text-center leading-snug">Pesta &<br>Event</p>
        </button>

        <button data-kategori="rumah" class="kategori-btn kategori-item flex flex-col items-center gap-2 cursor-pointer bg-transparent border-none">
          <div class="icon-box w-14 h-14 flex items-center justify-center rounded-xl border border-gray-200 hover:border-brand transition-colors">
            <img src="{{ asset('assets/img/kategori/icon-rumah-tangga@2x.png') }}" alt="Rumah Tangga" class="w-8 h-8">
          </div>
          <p class="text-xs text-gray-500 text-center leading-snug">Rumah<br>Tangga</p>
        </button>

        <button data-kategori="hobby" class="kategori-btn kategori-item flex flex-col items-center gap-2 cursor-pointer bg-transparent border-none">
          <div class="icon-box w-14 h-14 flex items-center justify-center rounded-xl border border-gray-200 hover:border-brand transition-colors">
            <img src="{{ asset('assets/img/kategori/icon-hobby@2x.png') }}" alt="Hobi & Olahraga" class="w-8 h-8">
          </div>
          <p class="text-xs text-gray-500 text-center leading-snug">Hobi &<br>Olahraga</p>
        </button>

      </div>
    </section>

    {{-- PRODUK TERPOPULER --}}
    <section class="produk-section py-10 px-6">
      <div class="container max-w-5xl mx-auto">
        <h2 class="section-title text-2xl font-semibold mb-6">Produk Terpopuler</h2>

        <div class="produk-grid grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="gadget" data-nama="iphone 17 pro max">
            <img src="{{ asset('assets/img/produk/Rectangle-19@2x.png') }}" alt="Iphone 17 Pro Max" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Iphone 17 Pro Max</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.100.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 215 penyewa</div>
                <div class="card-location ml-auto">Cibiru</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="gadget" data-nama="dji osmo pocket">
            <img src="{{ asset('assets/img/produk/Rectangle-191@2x.png') }}" alt="Dji Osmo Pocket" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Dji Osmo pocket</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.70.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 215 penyewa</div>
                <div class="card-location ml-auto">Majalaya</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="hobby" data-nama="sepeda gunung oranye">
            <img src="{{ asset('assets/img/produk/Rectangle-192@2x.png') }}" alt="Sepeda gunung oranye" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Sepeda gunung oranye</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.70.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 45 penyewa</div>
                <div class="card-location ml-auto">Cileunyi</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="gadget" data-nama="ipad gen 100 blue">
            <img src="{{ asset('assets/img/produk/Rectangle-193@2x.png') }}" alt="Ipad gen 100 blue" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Ipad gen 100 blue</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.50.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 175 penyewa</div>
                <div class="card-location ml-auto">Cibiru</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="rumah" data-nama="air fryer meco">
            <img src="{{ asset('assets/img/produk/Rectangle-194@2x.png') }}" alt="Air fryer meco" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Air fryer meco</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.30.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 79 penyewa</div>
                <div class="card-location ml-auto">Cicalengka</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="event" data-nama="paket mesin kopi">
            <img src="{{ asset('assets/img/produk/Rectangle-195@2x.png') }}" alt="Paket mesin kopi" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Paket mesin kopi</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.200.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 33 penyewa</div>
                <div class="card-location ml-auto">Bojongsoang</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="hobby" data-nama="raket tennis keren">
            <img src="{{ asset('assets/img/produk/Rectangle-196@2x.png') }}" alt="Raket tennis keren" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Raket tennis keren</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.20.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 27 penyewa</div>
                <div class="card-location ml-auto">Baleendah</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="rumah" data-nama="kompor listrik portable">
            <img src="{{ asset('assets/img/produk/Rectangle-197@2x.png') }}" alt="Kompor listrik portable" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Kompor listrik portable</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.65.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 104 penyewa</div>
                <div class="card-location ml-auto">Cinunuk</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="gadget" data-nama="iphone 16 promax 1tb">
            <img src="{{ asset('assets/img/produk/Rectangle-198@2x.png') }}" alt="Iphone 16 Promax 1TB" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Iphone 16 Promax 1TB</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.115.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 318 penyewa</div>
                <div class="card-location ml-auto">Cileunyi</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="hobby" data-nama="gitar gacor">
            <img src="{{ asset('assets/img/produk/Rectangle-199@2x.png') }}" alt="Gitar gacor" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Gitar gacor</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.40.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 114 penyewa</div>
                <div class="card-location ml-auto">Gedebage</div>
              </div>
            </div>
          </article>

        </div>

        <p id="emptyMsg" class="hidden text-center text-gray-400 py-10 text-sm">Tidak ada produk yang cocok.</p>
      </div>
    </section>

    {{-- REKOMENDASI --}}
    <section class="produk-section bg-subtle py-10 px-6 bg-gray-50">
      <div class="container max-w-5xl mx-auto">
        <h2 class="section-title text-2xl font-semibold mb-6">Rekomendasi untuk Anda</h2>

        <div class="produk-grid grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="fashion" data-nama="set kebaya brukat">
            <img src="{{ asset('assets/img/produk/Rectangle-1910@2x.png') }}" alt="Set Kebaya brukat" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Set Kebaya brukat</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.100.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 25 penyewa</div>
                <div class="card-location ml-auto">Cibiru</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="event" data-nama="ht merk bagus">
            <img src="{{ asset('assets/img/produk/Rectangle-1911@2x.png') }}" alt="HT merk bagus" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">HT merk bagus</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.100.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 56 penyewa</div>
                <div class="card-location ml-auto">Cicalengka</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="event" data-nama="sound system lengkap">
            <img src="{{ asset('assets/img/produk/Rectangle-1912@2x.png') }}" alt="Sound system lengkap" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Sound system lengkap</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.100.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 21 penyewa</div>
                <div class="card-location ml-auto">Majalaya</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="gadget" data-nama="apple watch gen 2">
            <img src="{{ asset('assets/img/produk/Rectangle-1913@2x.png') }}" alt="Apple watch gen 2" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Apple watch gen 2</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.100.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 12 penyewa</div>
                <div class="card-location ml-auto">Cileunyi</div>
              </div>
            </div>
          </article>

          <article class="card-produk card bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow cursor-pointer" data-kategori="event" data-nama="tenda katering">
            <img src="{{ asset('assets/img/produk/Rectangle-1914@2x.png') }}" alt="Tenda katering" class="card-img w-full h-36 object-cover" loading="lazy">
            <div class="card-body p-3">
              <h3 class="card-title text-sm font-medium mb-1">Tenda katering</h3>
              <p class="card-price text-[#34699A] text-sm font-semibold mb-2">Rp.100.000 /hari</p>
              <div class="card-meta flex items-center gap-1 text-xs text-gray-400 flex-wrap">
                <div class="card-rating flex items-center gap-0.5">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3 h-3"> 5.0
                </div>
                <div class="card-renters">• 150 penyewa</div>
                <div class="card-location ml-auto">Baleendah</div>
              </div>
            </div>
          </article>

        </div>
      </div>
    </section>

  </main>

  {{-- FOOTER --}}
  <footer class="site-footer bg-white border-t border-gray-100 px-6 py-10">
    <div class="footer-container max-w-5xl mx-auto">
      <div class="footer-grid grid grid-cols-1 sm:grid-cols-3 gap-8 mb-8">

        <div class="footer-brand">
          {{-- Mengarah ke Homepage --}}
          <a href="{{ route('home') }}" class="logo" style="text-decoration: none;">
            <img src="{{ asset('assets/img/logo/logo 2.png') }}" alt="Rentalin Logo" class="logo-img h-8 mb-3">
          </a>
          <p class="footer-desc text-sm text-gray-500 leading-relaxed">Platform sewa menyewa barang yang aman, mudah, dan terpercaya</p>
        </div>

        <div class="footer-links-col">
          <h4 class="footer-title font-semibold text-gray-700 mb-3">Quick Links</h4>
          <ul class="footer-list space-y-2 text-sm text-gray-500">
            {{-- Mengarah ke Homepage --}}
            <li><a href="{{ route('home') }}" class="hover:text-[#34699A] transition-colors">Home</a></li>
            {{-- Mengarah ke Riwayat Pemilik --}}
            <li><a href="{{ url('riwayat-transaksi-pemilik') }}" class="hover:text-[#34699A] transition-colors">Riwayat</a></li>
            {{-- Tautan kosong/placeholder --}}
            <li><a href="#" class="hover:text-[#34699A] transition-colors">Kontak</a></li>
          </ul>
        </div>

        <div class="footer-contact-col">
          <h4 class="footer-title font-semibold text-gray-700 mb-3">Hubungi Kami</h4>
          <ul class="footer-list contact-list space-y-2 text-sm text-gray-500">
            <li><span class="contact-icon icon-phone">📞</span> +62 123 456 987</li>
            <li><span class="contact-icon icon-email">✉️</span> support@rentalin.com</li>
            <li><span class="contact-icon icon-location">📍</span> Jl. Cibubur No. 123</li>
          </ul>
        </div>

      </div>

      <div class="footer-bottom border-t border-gray-100 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-gray-400">
        <p>© 2026 Rentalin. All rights reserved</p>
        <div class="social-icons flex gap-4">
          <a href="#" class="icon-ig hover:text-[#34699A] transition-colors">📷</a>
          <a href="#" class="icon-wa hover:text-[#34699A] transition-colors">💬</a>
          <a href="#" class="icon-fb hover:text-[#34699A] transition-colors">📘</a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // 1. Navbar shadow saat scroll
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('shadow-md', window.scrollY > 10);
    });

    // 2. Search realtime — filter semua card-produk
    const searchInput = document.getElementById('searchInput');
    const emptyMsg = document.getElementById('emptyMsg');

    searchInput.addEventListener('input', () => {
      filterProduk(searchInput.value.toLowerCase().trim(), activeKategori);
    });

    // 3. Filter by kategori
    let activeKategori = null;
    const kategoriBtns = document.querySelectorAll('.kategori-btn');

    kategoriBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const kat = btn.dataset.kategori;

        if (activeKategori === kat) {
          // Toggle off jika diklik lagi
          activeKategori = null;
          kategoriBtns.forEach(b => {
            b.querySelector('.icon-box').classList.remove('border-[#34699A]', 'bg-blue-50');
          });
        } else {
          activeKategori = kat;
          kategoriBtns.forEach(b => {
            b.querySelector('.icon-box').classList.remove('border-[#34699A]', 'bg-blue-50');
          });
          btn.querySelector('.icon-box').classList.add('border-[#34699A]', 'bg-blue-50');
        }

        filterProduk(searchInput.value.toLowerCase().trim(), activeKategori);
      });
    });

    function filterProduk(query, kategori) {
      const semua = document.querySelectorAll('.card-produk');
      let adaYangTerlihat = false;

      semua.forEach(card => {
        const nama = card.dataset.nama;
        const kat = card.dataset.kategori;

        const cocokQuery = !query || nama.includes(query);
        const cocokKategori = !kategori || kat === kategori;

        if (cocokQuery && cocokKategori) {
          card.classList.remove('hidden');
          adaYangTerlihat = true;
        } else {
          card.classList.add('hidden');
        }
      });

      emptyMsg.classList.toggle('hidden', adaYangTerlihat);
    }
  </script>

</body>
</html>