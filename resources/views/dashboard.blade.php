<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rentalin - Sewa Apa Saja</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F9FAFB] font-sans text-black min-h-screen flex flex-col">

  {{-- NAVBAR --}}
  <nav id="navbar" class="navbar sticky top-0 z-50 bg-white shadow-sm grid grid-cols-[1fr_minmax(200px,640px)_1fr] items-center px-12 py-2.5 min-h-[85px] gap-5 transition-shadow duration-300">

    <div class="nav-left flex justify-start items-center">
      <a href="{{ route('home') }}" class="flex items-center px-3 py-0.5 rounded-xl h-10 no-underline">
        <img src="{{ asset('assets/img/logo/logo 2.png') }}" alt="Rentalin Logo" class="h-8 w-auto object-contain">
      </a>
    </div>

    <div class="search-bar w-full h-8 bg-[#FEFFFF] shadow rounded-full px-4 flex items-center gap-2.5">
      <span class="search-icon w-[18px] h-[18px] bg-[url('../icons/search.png')] bg-contain bg-no-repeat bg-center text-transparent select-none">🔍</span>
      <input id="searchInput" type="text" placeholder="Search"
        class="border-none bg-transparent w-full font-sans text-[13px] text-[#696969] focus:outline-none">
    </div>

    <div class="nav-right flex justify-end items-center gap-6">

      <div class="icon-group flex items-center gap-2">
        <button class="icon-btn icon-bell w-12 h-8 rounded-lg bg-[url('../icons/bell.png')] bg-[length:20px] bg-no-repeat bg-center text-transparent">🔔</button>
        <button class="icon-btn icon-chat w-12 h-8 rounded-lg bg-[url('../icons/message-text.png')] bg-[length:20px] bg-no-repeat bg-center text-transparent"
          onclick="window.location.href='{{ url('chat') }}'">💬</button>
        <button class="icon-btn icon-cart w-12 h-8 rounded-lg bg-[url('../icons/cart.png')] bg-[length:20px] bg-no-repeat bg-center text-transparent"
          onclick="window.location.href='{{ url('riwayat-transaksi-penyewa') }}'">🛒</button>
      </div>

      <div class="nav-divider w-px h-8 bg-black/50"></div>

      <button class="toko-btn flex items-center bg-[#696969] rounded-lg h-[50px] py-1.5 pl-1.5 pr-4 gap-2.5"
        onclick="window.location.href='{{ url('toko') }}'">
        <div class="toko-icon-wrapper flex justify-center items-center bg-[#34699A] rounded-full w-10 h-10 bg-[url('../icons/shop.png')] bg-[length:20px] bg-no-repeat bg-center text-transparent">🏪</div>
        <span class="font-medium text-base text-white">Toko</span>
      </button>

      <div class="profile-group flex items-center gap-2.5 cursor-pointer"
        onclick="window.location.href='{{ url('profile') }}'">
        <img src="{{ asset('assets/img/profile/user-photo-profile.png') }}" alt="Profile"
          class="profile-img w-[42px] h-[42px] rounded-full object-cover">
        <span class="profile-name font-medium text-base">
          @if (Auth::check())
            {{ Auth::user()->name }}
          @else
            Guest
          @endif
        </span>
      </div>

    </div>
  </nav>

  <main class="flex-1">

    {{-- HERO --}}
    <section class="hero bg-[url('../img/hero/hero.png')] bg-cover bg-right bg-no-repeat w-full flex items-center"
      style="height: clamp(400px, 70vh, 814px);">
      <div class="container max-w-[1200px] mx-auto px-5 w-full">
        <div class="hero-content max-w-[480px]">
          <h1 class="hero-title font-bold text-black leading-[1.3] mb-3" style="font-size: clamp(32px, 5vw, 46px);">
            Sewa Apa Saja,<br>Kapan Saja
          </h1>
          <p class="hero-desc text-[#4a4a4a] leading-relaxed" style="font-size: clamp(14px, 2vw, 16px);">
            Temukan berbagai kebutuhan dalam<br>satu platform yang praktis dan aman.
          </p>
        </div>
      </div>
    </section>

    {{-- KATEGORI --}}
    <section class="kategori-section">
      <div class="container kategori-container max-w-[1000px] mx-auto flex justify-center flex-wrap px-5 py-[68px] gap-[clamp(20px,8vw,130px)]">

        <button data-kategori="gadget" class="kategori-btn kategori-item flex flex-col items-center text-center text-sm font-semibold gap-3 cursor-pointer bg-transparent border-none">
          <div class="icon-box flex items-center justify-center bg-white border border-[#e2e8f0] rounded-[20px] transition-all duration-200 hover:-translate-y-1 hover:border-[#cbd5e1] hover:shadow-md"
            style="width: clamp(55px,6vw,72px); height: clamp(55px,6vw,72px);">
            <img src="{{ asset('assets/img/kategori/icon-gadget@2x.png') }}" alt="Elektronik & Gadget"
              style="width: clamp(28px,3vw,36px);" class="h-auto">
          </div>
          <p>Elektronik &<br>Gadget</p>
        </button>

        <button data-kategori="fashion" class="kategori-btn kategori-item flex flex-col items-center text-center text-sm font-semibold gap-3 cursor-pointer bg-transparent border-none">
          <div class="icon-box flex items-center justify-center bg-white border border-[#e2e8f0] rounded-[20px] transition-all duration-200 hover:-translate-y-1 hover:border-[#cbd5e1] hover:shadow-md"
            style="width: clamp(55px,6vw,72px); height: clamp(55px,6vw,72px);">
            <img src="{{ asset('assets/img/kategori/icon-fashion@2x.png') }}" alt="Fashion & Aksesoris"
              style="width: clamp(28px,3vw,36px);" class="h-auto">
          </div>
          <p>Fashion &<br>Aksesoris</p>
        </button>

        <button data-kategori="event" class="kategori-btn kategori-item flex flex-col items-center text-center text-sm font-semibold gap-3 cursor-pointer bg-transparent border-none">
          <div class="icon-box flex items-center justify-center bg-white border border-[#e2e8f0] rounded-[20px] transition-all duration-200 hover:-translate-y-1 hover:border-[#cbd5e1] hover:shadow-md"
            style="width: clamp(55px,6vw,72px); height: clamp(55px,6vw,72px);">
            <img src="{{ asset('assets/img/kategori/icon-event@2x.png') }}" alt="Pesta & Event"
              style="width: clamp(28px,3vw,36px);" class="h-auto">
          </div>
          <p>Pesta &<br>Event</p>
        </button>

        <button data-kategori="rumah" class="kategori-btn kategori-item flex flex-col items-center text-center text-sm font-semibold gap-3 cursor-pointer bg-transparent border-none">
          <div class="icon-box flex items-center justify-center bg-white border border-[#e2e8f0] rounded-[20px] transition-all duration-200 hover:-translate-y-1 hover:border-[#cbd5e1] hover:shadow-md"
            style="width: clamp(55px,6vw,72px); height: clamp(55px,6vw,72px);">
            <img src="{{ asset('assets/img/kategori/icon-rumah-tangga@2x.png') }}" alt="Rumah Tangga"
              style="width: clamp(28px,3vw,36px);" class="h-auto">
          </div>
          <p>Rumah<br>Tangga</p>
        </button>

        <button data-kategori="hobby" class="kategori-btn kategori-item flex flex-col items-center text-center text-sm font-semibold gap-3 cursor-pointer bg-transparent border-none">
          <div class="icon-box flex items-center justify-center bg-white border border-[#e2e8f0] rounded-[20px] transition-all duration-200 hover:-translate-y-1 hover:border-[#cbd5e1] hover:shadow-md"
            style="width: clamp(55px,6vw,72px); height: clamp(55px,6vw,72px);">
            <img src="{{ asset('assets/img/kategori/icon-hobby@2x.png') }}" alt="Hobi & Olahraga"
              style="width: clamp(28px,3vw,36px);" class="h-auto">
          </div>
          <p>Hobi &<br>Olahraga</p>
        </button>

      </div>
    </section>

    {{-- PRODUK TERPOPULER --}}
    <section class="produk-section py-[60px] bg-[#F9FAFB] mb-10">
      <div class="container max-w-[1200px] mx-auto px-5">
        <h2 class="section-title text-[32px] font-bold mb-[35px]">Produk Terpopuler</h2>

        <div class="produk-grid grid gap-[25px]" style="grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));">

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer"
            data-kategori="gadget" data-nama="iphone 17 pro max">
            <img src="{{ asset('assets/img/produk/Rectangle-19@2x.png') }}" alt="Iphone 17 Pro Max"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Iphone 17 Pro Max</h3>
              <p class="text-base font-bold">Rp.100.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 215 penyewa</div>
                <div class="text-black/50 font-medium">Cibiru</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer"
            data-kategori="gadget" data-nama="dji osmo pocket">
            <img src="{{ asset('assets/img/produk/Rectangle-191@2x.png') }}" alt="Dji Osmo Pocket"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Dji Osmo pocket</h3>
              <p class="text-base font-bold">Rp.70.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 215 penyewa</div>
                <div class="text-black/50 font-medium">Majalaya</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer"
            data-kategori="hobby" data-nama="sepeda gunung oranye">
            <img src="{{ asset('assets/img/produk/Rectangle-192@2x.png') }}" alt="Sepeda gunung oranye"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Sepeda gunung oranye</h3>
              <p class="text-base font-bold">Rp.70.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 45 penyewa</div>
                <div class="text-black/50 font-medium">Cileunyi</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer"
            data-kategori="gadget" data-nama="ipad gen 100 blue">
            <img src="{{ asset('assets/img/produk/Rectangle-193@2x.png') }}" alt="Ipad gen 100 blue"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Ipad gen 100 blue</h3>
              <p class="text-base font-bold">Rp.50.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 175 penyewa</div>
                <div class="text-black/50 font-medium">Cibiru</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer"
            data-kategori="rumah" data-nama="air fryer meco">
            <img src="{{ asset('assets/img/produk/Rectangle-194@2x.png') }}" alt="Air fryer meco"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Air fryer meco</h3>
              <p class="text-base font-bold">Rp.30.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 79 penyewa</div>
                <div class="text-black/50 font-medium">Cicalengka</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer"
            data-kategori="event" data-nama="paket mesin kopi">
            <img src="{{ asset('assets/img/produk/keyboard.png') }}" alt="Paket mesin kopi"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Paket mesin kopi</h3>
              <p class="text-base font-bold">Rp.200.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 33 penyewa</div>
                <div class="text-black/50 font-medium">Bojongsoang</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer"
            data-kategori="hobby" data-nama="raket tennis keren">
            <img src="{{ asset('assets/img/produk/tent.png') }}" alt="Raket tennis keren"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Raket tennis keren</h3>
              <p class="text-base font-bold">Rp.20.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 27 penyewa</div>
                <div class="text-black/50 font-medium">Baleendah</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer"
            data-kategori="rumah" data-nama="kompor listrik portable">
            <img src="{{ asset('assets/img/produk/kompor.png') }}" alt="Kompor listrik portable"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Kompor listrik portable</h3>
              <p class="text-base font-bold">Rp.65.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 104 penyewa</div>
                <div class="text-black/50 font-medium">Cinunuk</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer"
            data-kategori="gadget" data-nama="iphone 16 promax 1tb">
            <img src="{{ asset('assets/img/produk/dslr.png') }}" alt="Iphone 16 Promax 1TB"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Iphone 16 Promax 1TB</h3>
              <p class="text-base font-bold">Rp.115.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 318 penyewa</div>
                <div class="text-black/50 font-medium">Cileunyi</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer"
            data-kategori="hobby" data-nama="gitar gacor">
            <img src="{{ asset('assets/img/produk/ps5.png') }}" alt="Gitar gacor"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Gitar gacor</h3>
              <p class="text-base font-bold">Rp.40.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 114 penyewa</div>
                <div class="text-black/50 font-medium">Gedebage</div>
              </div>
            </div>
          </article>

        </div>

        <p id="emptyMsg" class="hidden text-center text-black/50 py-10 text-sm">Tidak ada produk yang cocok.</p>
      </div>
    </section>

    {{-- REKOMENDASI --}}
    <section class="produk-section bg-subtle py-[60px] bg-[#F9FAFB] mb-10">
      <div class="container max-w-[1200px] mx-auto px-5">
        <h2 class="section-title text-[32px] font-bold mb-[35px]">Rekomendasi untuk Anda</h2>

        <div class="produk-grid-rekomendasi flex flex-nowrap overflow-x-auto gap-[25px] pb-5 scroll-snap-x-mandatory">

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer flex-[0_0_220px] scroll-snap-start"
            data-kategori="fashion" data-nama="set kebaya brukat">
            <img src="{{ asset('assets/img/produk/kebaya.png') }}" alt="Set Kebaya brukat"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Set Kebaya brukat</h3>
              <p class="text-base font-bold">Rp.100.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 25 penyewa</div>
                <div class="text-black/50 font-medium">Cibiru</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer flex-[0_0_220px] scroll-snap-start"
            data-kategori="event" data-nama="ht merk bagus">
            <img src="{{ asset('assets/img/produk/ht.png') }}" alt="HT merk bagus"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">HT merk bagus</h3>
              <p class="text-base font-bold">Rp.100.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 56 penyewa</div>
                <div class="text-black/50 font-medium">Cicalengka</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer flex-[0_0_220px] scroll-snap-start"
            data-kategori="event" data-nama="sound system lengkap">
            <img src="{{ asset('assets/img/produk/sound.png') }}" alt="Sound system lengkap"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Sound system lengkap</h3>
              <p class="text-base font-bold">Rp.100.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 21 penyewa</div>
                <div class="text-black/50 font-medium">Majalaya</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer flex-[0_0_220px] scroll-snap-start"
            data-kategori="gadget" data-nama="apple watch gen 2">
            <img src="{{ asset('assets/img/produk/apple-watch.png') }}" alt="Apple watch gen 2"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Apple watch gen 2</h3>
              <p class="text-base font-bold">Rp.100.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 12 penyewa</div>
                <div class="text-black/50 font-medium">Cileunyi</div>
              </div>
            </div>
          </article>

          <article class="card-produk bg-white rounded-2xl overflow-hidden shadow-sm hover:-translate-y-[5px] hover:shadow-md transition-all duration-200 flex flex-col cursor-pointer flex-[0_0_220px] scroll-snap-start"
            data-kategori="event" data-nama="tenda katering">
            <img src="{{ asset('assets/img/produk/tenda-katering.png') }}" alt="Tenda katering"
              class="w-full aspect-square h-auto object-contain bg-white" loading="lazy">
            <div class="card-body p-4 flex flex-col gap-2">
              <h3 class="text-base font-semibold whitespace-nowrap overflow-hidden text-ellipsis">Tenda katering</h3>
              <p class="text-base font-bold">Rp.100.000 /hari</p>
              <div class="flex flex-col text-xs text-black gap-1 mt-1">
                <div class="flex items-center gap-1 font-semibold">
                  <img src="{{ asset('assets/icons/star-rate-rounded.svg') }}" alt="Rating" class="w-3.5 h-auto"> 5.0
                </div>
                <div class="text-black/50 font-medium">• 150 penyewa</div>
                <div class="text-black/50 font-medium">Baleendah</div>
              </div>
            </div>
          </article>

        </div>
      </div>
    </section>

  </main>

  {{-- FOOTER --}}
  <footer class="site-footer bg-white border-t border-[#EDF2F7] pt-10 pb-5 mt-auto">
    <div class="footer-container max-w-[1200px] mx-auto px-12">

      <div class="footer-grid grid gap-10 mb-10" style="grid-template-columns: 2fr 1fr 1fr;">

        <div class="footer-brand">
          <a href="{{ route('home') }}" class="inline-flex mb-4 no-underline">
            <img src="{{ asset('assets/img/logo/logo 2.png') }}" alt="Rentalin Logo" class="h-8 w-auto object-contain">
          </a>
          <p class="text-sm text-black leading-relaxed max-w-[320px]">Platform sewa menyewa barang yang aman, mudah, dan terpercaya</p>
        </div>

        <div class="footer-links-col">
          <h4 class="font-semibold text-base text-black mb-5">Quick Links</h4>
          <ul class="list-none p-0 flex flex-col gap-3">
            <li><a href="{{ route('home') }}" class="no-underline text-[#696969] text-sm hover:text-[#34699A] transition-colors">Home</a></li>
            <li><a href="{{ url('riwayat-transaksi-pemilik') }}" class="no-underline text-[#696969] text-sm hover:text-[#34699A] transition-colors">Riwayat</a></li>
            <li><a href="#" class="no-underline text-[#696969] text-sm hover:text-[#34699A] transition-colors">Kontak</a></li>
          </ul>
        </div>

        <div class="footer-contact-col">
          <h4 class="font-semibold text-base text-black mb-5">Hubungi Kami</h4>
          <ul class="list-none p-0 flex flex-col gap-3">
            <li class="flex items-center gap-2.5 text-[#696969] text-sm">
              <span class="w-[18px] h-[18px] inline-block bg-[url('../icons/phone.png')] bg-contain bg-no-repeat bg-center text-transparent">📞</span>
              +62 123 456 987
            </li>
            <li class="flex items-center gap-2.5 text-[#696969] text-sm">
              <span class="w-[18px] h-[18px] inline-block bg-[url('../icons/email.png')] bg-contain bg-no-repeat bg-center text-transparent">✉️</span>
              support@rentalin.com
            </li>
            <li class="flex items-center gap-2.5 text-[#696969] text-sm">
              <span class="w-[18px] h-[18px] inline-block bg-[url('../icons/location.png')] bg-contain bg-no-repeat bg-center text-transparent">📍</span>
              Jl. Cibubur No. 123
            </li>
          </ul>
        </div>

      </div>

      <div class="footer-bottom border-t border-[#EDF2F7] pt-6 flex justify-between items-center">
        <p class="text-sm text-black">© 2026 Rentalin. All rights reserved</p>
        <div class="flex gap-4">
          <a href="#" class="w-6 h-6 inline-block bg-[url('../icons/instagram.png')] bg-contain bg-no-repeat bg-center text-transparent overflow-hidden">📷</a>
          <a href="#" class="w-6 h-6 inline-block bg-[url('../icons/whatsapp.png')] bg-contain bg-no-repeat bg-center text-transparent overflow-hidden">💬</a>
          <a href="#" class="w-6 h-6 inline-block bg-[url('../icons/facebook.png')] bg-contain bg-no-repeat bg-center text-transparent overflow-hidden">📘</a>
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
    const emptyMsg    = document.getElementById('emptyMsg');

    searchInput.addEventListener('input', () => {
      filterProduk(searchInput.value.toLowerCase().trim(), activeKategori);
    });

    // 3. Filter by kategori — klik icon kategori
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

    // 4. Fungsi filter gabungan (search + kategori)
    function filterProduk(query, kategori) {
      const semua = document.querySelectorAll('.card-produk');
      let adaYangTerlihat = false;

      semua.forEach(card => {
        const nama = card.dataset.nama;
        const kat  = card.dataset.kategori;

        const cocokQuery    = !query    || nama.includes(query);
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