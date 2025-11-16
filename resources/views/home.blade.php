<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Wino Bangunan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
  </style>
</head>

<body x-data="winoApp()" :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'" class="min-h-screen">

<!-- ========================================================= -->
<!--                      HEADER                               -->
<!-- ========================================================= -->
<header :class="darkMode ? 'bg-gray-900 border-b border-gray-800' : 'bg-white border-gray-200'"
        class="sticky top-0 z-50 border-b">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      <!-- Logo & Mobile Menu -->
      <div class="flex items-center gap-3">
        <button @click="toggleMobileMenu()"
                class="md:hidden p-2 rounded-md hover:bg-gray-100"
                :class="darkMode ? 'hover:bg-white/5' : ''">
          <svg class="w-6 h-6" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>

        <a href="#">
          <img src="{{ asset('images/lightmode-logo2.png') }}" class="max-h-14" alt="Logo">
        </a>
      </div>

      <!-- Search -->
      <div class="flex-1 px-4">
        <div class="relative">
          <input type="search" x-model="search"
                 placeholder="Cari produk..."
                 class="w-full rounded-full border shadow-sm py-2 pl-10 pr-4 text-sm"
                 :class="darkMode ? 'bg-gray-800 border-gray-700 text-gray-100' : 'bg-white'">

          <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
          </div>
        </div>
      </div>

      <!-- Theme Toggle -->
      <button @click="toggleDarkMode()" class="p-2 rounded-full hover:bg-gray-100"
              :class="darkMode ? 'hover:bg-white/5' : ''">
        <template x-if="darkMode">
          <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor">
            <circle cx="12" cy="12" r="4"/>
            <path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>
          </svg>
        </template>
        <template x-if="!darkMode">
          <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </template>
      </button>

    </div>
  </div>

  <!-- MOBILE MENU -->
  <div x-show="mobileMenu" x-cloak
      :class="darkMode ? 'bg-gray-900 border-gray-800' : 'bg-white border-gray-200'"
      class="md:hidden border-t px-4 py-3 space-y-2">

    <template x-for="(cat, i) in categories" :key="cat.key">
      <div>

        <!-- Item Menu -->
        <button @click="handleCategoryNavigation(cat.key)"
                class="w-full text-left px-2 py-2 rounded-md hover:bg-gray-100"
                :class="darkMode ? 'hover:bg-white/10' : ''">
          <span x-text="cat.label"></span>
        </button>

        <!-- GARIS 1 — Setelah Beranda -->
        <template x-if="i === 0">
          <div class="border-t my-3"
              :class="darkMode ? 'border-gray-700' : 'border-gray-300'"></div>
        </template>

        <!-- GARIS 2 — Setelah kategori ke-4 -->
        <template x-if="i === 4">
          <div class="border-t my-3"
              :class="darkMode ? 'border-gray-700' : 'border-gray-300'"></div>
        </template>

      </div>
    </template>

  </div>

</header>

<!-- ========================================================= -->
<!--                DESKTOP NAVBAR                             -->
<!-- ========================================================= -->
<!-- DESKTOP NAVBAR -->
<nav class="hidden md:block sticky top-16 z-40 border-b"
     :class="darkMode ? 'bg-gray-900 border-gray-800' : 'bg-white border-gray-100'">

  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-center gap-6 py-3 overflow-x-auto scrollbar-hide text-sm">

      <template x-for="(cat, i) in categories" :key="cat.key">
        <div class="flex items-center gap-6">

          <!-- Tombol Menu -->
          <button @click="handleCategoryNavigation(cat.key)"
                  class="px-2 py-1 whitespace-nowrap"
                  :class="page === cat.key ? 'border-b-2 border-green-600 text-green-600' : 'hover:text-green-600'">
            <span x-text="cat.label"></span>
          </button>

          <!-- PEMBATAS 1: Setelah Beranda -->
          <template x-if="i === 0">
            <div class="w-px h-5 mx-2"
                 :class="darkMode ? 'bg-gray-700' : 'bg-gray-300'"></div>
          </template>

          <!-- PEMBATAS 2: Setelah kategori ke-4 -->
          <template x-if="i === 4">
            <div class="w-px h-5 mx-2"
                 :class="darkMode ? 'bg-gray-700' : 'bg-gray-300'"></div>
          </template>

        </div>
      </template>

    </div>
  </div>
</nav>



<!-- ========================================================= -->
<!--                        MAIN                               -->
<!-- ========================================================= -->
<main class="max-w-7xl mx-auto px-4 py-8">

<!-- ===================== BERANDA ===================== -->
<section x-show="page === 'beranda'" x-cloak class="space-y-12">

  <!-- Hero Slider -->
  <div class="rounded-2xl overflow-hidden shadow-md">
    <img :src="ads[currentAd]" class="w-full h-64 md:h-80 object-cover">
  </div>

  <!-- Category Sections + CAROUSEL -->
  <template x-for="cat in allCategories" :key="cat.id">
    <section class="space-y-4">

      <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold text-green-600" x-text="cat.idLabel"></h2>
        <button @click="handleCategoryNavigation(cat.idLabel)"
                class="text-sm text-gray-500 hover:text-green-600">Lihat semua</button>
      </div>

      <!-- Empty -->
      <div x-show="filteredCatalogByCategory(cat.id).length === 0"
           class="py-10 text-center text-gray-400">Data Kosong</div>

      <!-- Carousel -->
      <div x-show="filteredCatalogByCategory(cat.id).length > 0"
           class="relative group">

      <!-- Left Button -->
      <button @click="scrollCarousel(cat.id, 'left')"
              class="absolute left-0 top-1/2 -translate-y-1/2 p-2 rounded-full shadow 
                    opacity-0 group-hover:opacity-100 transition z-10 pointer-events-auto"
              :class="darkMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-700'">
          <svg class="w-5 h-5" fill="none" stroke="currentColor"><path d="M15 18l-6-6 6-6"/></svg>
        </button>

        <!-- The Scroll Container -->
        <div :id="'carousel-' + cat.id"
            class="flex gap-4 overflow-x-auto scroll-smooth px-2 py-2 scrollbar-hide snap-x snap-mandatory">

          <template x-for="item in filteredCatalogByCategory(cat.id)" :key="item.name">
            <article class="w-56 snap-start flex-shrink-0 rounded-xl border shadow-sm"
                     :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white'">

              <div class="h-40 overflow-hidden rounded-t-xl">
                <img :src="item.image" :alt="item.name"
                     class="w-full h-full object-cover transition hover:scale-105 duration-500">
              </div>

              <div class="p-3 space-y-1">
                <h3 class="text-sm font-medium truncate" x-text="item.name"></h3>
                <p class="text-green-600 font-semibold text-sm" x-text="item.price"></p>
                <p class="text-xs text-gray-400">Stok: <span x-text="item.stock"></span></p>
              </div>

            </article>
          </template>

        </div>

        <!-- Right Button -->
    <button @click="scrollCarousel(cat.id, 'right')"
            class="absolute right-0 top-1/2 -translate-y-1/2 p-2 rounded-full shadow 
                  opacity-0 group-hover:opacity-100 transition z-10 pointer-events-auto"
            :class="darkMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-700'">
          <svg class="w-5 h-5" fill="none" stroke="currentColor"><path d="M9 18l6-6-6-6"/></svg>
        </button>

      </div>

    </section>
  </template>
</section>


<!-- ===================== KATEGORI DETAIL ===================== -->
<template x-for="cat in allCategories" :key="cat.id">
  <section x-show="page === cat.idLabel" x-cloak class="space-y-6">

    <div class="flex justify-between items-center">
      <h2 class="text-2xl font-semibold text-green-600" x-text="cat.idLabel"></h2>

      <button @click="handleBackToHome()"
              class="text-sm px-4 py-2 border rounded-full hover:bg-green-50"
              :class="darkMode ? 'bg-gray-800 border-gray-700 hover:bg-gray-700' : ''">
        Kembali
      </button>
    </div>

    <div x-show="filteredCatalogByCategory(cat.id).length === 0"
         class="py-10 text-center text-gray-400">Data Kosong</div>

    <div x-show="filteredCatalogByCategory(cat.id).length > 0"
         class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

      <template x-for="item in filteredCatalogByCategory(cat.id)" :key="item.name">
        <article class="border rounded-lg p-3 hover:shadow-md transition"
                 :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white'">

          <img :src="item.image" class="w-full h-40 object-cover rounded-md">

          <h3 class="text-sm font-medium truncate mt-3" x-text="item.name"></h3>
          <p class="text-green-600 font-semibold" x-text="item.price"></p>
          <p class="text-xs text-gray-400">Stok: <span x-text="item.stock"></span></p>

        </article>
      </template>

    </div>
  </section>
</template>


<!-- ===================== PARTNER ===================== -->
<section x-show="page === 'partner'" x-cloak class="py-10 text-center">
  <h2 class="text-3xl font-bold text-green-600 mb-6">Partner Kami</h2>
  <p class="text-gray-500 max-w-xl mx-auto mb-10">Kami bekerja sama dengan berbagai perusahaan bahan bangunan terkemuka.</p>

  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

    <template x-for="logo in [
      {name:'Avian', src:'https://upload.wikimedia.org/wikipedia/commons/6/6e/Avian_Brands_Logo.png'},
      {name:'Dulux', src:'https://seeklogo.com/images/D/dulux-logo-0B31C5F4F3-seeklogo.com.png'},
      {name:'Nippon Paint', src:'https://upload.wikimedia.org/wikipedia/en/8/84/Nippon_Paint_logo.png'},
      {name:'Tiga Roda', src:'https://upload.wikimedia.org/wikipedia/en/c/c3/Tiga_Roda.png'},
      {name:'Holcim', src:'https://upload.wikimedia.org/wikipedia/commons/e/e8/Holcim-logo.svg'}
    ]" :key="logo.name">

      <div class="p-5 border rounded-xl shadow-sm hover:shadow-md transition"
           :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white'">
        <img :src="logo.src" class="w-full h-20 object-contain">
        <h3 class="mt-3 font-semibold" x-text="logo.name"></h3>
      </div>

    </template>

  </div>
</section>


<!-- ===================== KONTAK ===================== -->
<section x-show="page === 'kontak'" x-cloak class="py-14">

  <div class="text-center mb-12">
    <h2 class="text-4xl font-bold text-green-600 mb-3">Kontak Kami</h2>
    <p class="text-gray-500">Hubungi kami untuk pertanyaan & pemesanan.</p>
  </div>

  <div class="grid md:grid-cols-2 rounded-3xl shadow-xl overflow-hidden"
       :class="darkMode ? 'bg-gray-800 text-gray-100' : 'bg-white'">

    <div class="p-10 bg-gradient-to-br from-green-600 to-green-500 text-white">
      <h3 class="text-2xl font-semibold mb-6">Wino Bangunan</h3>

      <div class="space-y-6">
        <div class="flex gap-4">
          <svg class="w-7 h-7" fill="none" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21s-6-4.35-6-10a6 6 0 1112 0c0 5.65-6 10-6 10z"/></svg>
          <p>Jl. Veteran No.33, Towuti, Luwu Timur</p>
        </div>

        <div class="flex gap-4">
          <svg class="w-7 h-7" fill="none" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h1.3c.4 0 .8.26 1 .66l1.2 3-.3 1.1-1.4 1.4a14 14 0 006.2 6.2l1.4-1.4 1.1-.3 3 1.2c.4.2.7.6.7 1V19a2 2 0 01-2 2H17C9 21 3 15 3 7V7a2 2 0 012-2z"/></svg>
          <p>Telepon: (021) 555-6789</p>
        </div>

        <div class="flex gap-4">
          <svg class="w-7 h-7" fill="none" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.9 5.3a2 2 0 002.2 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          <p>info@winobangunan.com</p>
        </div>

        <!-- SOSIAL MEDIA -->
        <div class="pt-6">
          <h4 class="text-lg font-semibold mb-3 text-white">Sosial Media</h4>

          <div class="flex items-center gap-4">

            <!-- Instagram -->
            <a href="https://instagram.com/" target="_blank"
              class="p-3 rounded-full bg-white/20 hover:bg-white/30 transition">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5"
                  viewBox="0 0 24 24">
                <path d="M7 3h10a4 4 0 014 4v10a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4z" />
                <circle cx="12" cy="12" r="3.3" />
                <circle cx="17" cy="7" r="1" />
              </svg>
            </a>

            <!-- WhatsApp -->
            <a href="https://wa.me/6281234567890" target="_blank"
              class="p-3 rounded-full bg-white/20 hover:bg-white/30 transition">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 2A10 10 0 0 0 2 12a9.93 9.93 0 0 0 1.47 5.25L2 22l4.88-1.43A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.25-1.23l-.3-.17-2.9.85.88-2.82-.18-.29A8 8 0 1 1 12 20zm4.2-5.7c-.23-.12-1.35-.67-1.56-.75s-.36-.12-.51.12-.59.75-.73.9-.27.18-.49.06a6.52 6.52 0 0 1-1.9-1.17 7.1 7.1 0 0 1-1.31-1.64c-.14-.24 0-.37.1-.49.1-.1.24-.27.37-.41s.16-.24.25-.41a.44.44 0 0 0 0-.43c-.07-.12-.51-1.26-.7-1.72-.19-.45-.38-.39-.51-.39h-.44a.86.86 0 0 0-.62.29A2.58 2.58 0 0 0 6 9.4 4.49 4.49 0 0 0 6.9 12a10 10 0 0 0 3.69 3.53 11.83 11.83 0 0 0 1.71.63 4.1 4.1 0 0 0 1.88.12 3.08 3.08 0 0 0 2.08-1.48 2.51 2.51 0 0 0 .17-1.48c-.05-.07-.2-.12-.43-.24" />
              </svg>
            </a>

            <!-- Facebook -->
            <a href="https://facebook.com/" target="_blank"
              class="p-3 rounded-full bg-white/20 hover:bg-white/30 transition">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M22 12.07C22 6.48 17.52 2 11.93 2S1.86 6.48 1.86 12.07c0 4.99 3.66 9.13 8.44 9.93v-7.03H7.9v-2.9h2.4V9.41c0-2.38 1.42-3.7 3.6-3.7 1.04 0 2.12.18 2.12.18v2.33h-1.2c-1.18 0-1.55.74-1.55 1.49v1.78h2.64l-.42 2.9h-2.22v7.03c4.78-.8 8.44-4.94 8.44-9.93z" />
              </svg>
            </a>

            <!-- TikTok -->
            <a href="https://tiktok.com/" target="_blank"
              class="p-3 rounded-full bg-white/20 hover:bg-white/30 transition">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12.7 2h2.4a5.9 5.9 0 0 0 5.9 5.9v2.4a8.3 8.3 0 0 1-4.7-1.5v7.6A5.6 5.6 0 1 1 10 10a5.5 5.5 0 0 1 2.7.7v2.8a2.8 2.8 0 1 0 1.7 2.5V2z" />
              </svg>
            </a>

          </div>
        </div>

      </div>
    </div>

    <div class="p-10 flex flex-col justify-center"
         :class="darkMode ? 'bg-gray-900' : 'bg-gray-50'">

      <h3 class="text-xl font-semibold mb-4">Lokasi Kami</h3>
      <p class="text-gray-500 mb-6">Klik tombol untuk melihat lokasi kami di Google Maps.</p>

      <button @click="openMap()"
              class="px-6 py-3 rounded-full bg-green-600 text-white hover:bg-green-700">
        Lihat di Google Maps
      </button>

    </div>
  </div>

</section>


<!-- ===================== TENTANG KAMI ===================== -->
<section x-show="page === 'tentang kami'" x-cloak class="py-20">

  <!-- HEADER -->
  <div class="text-center mb-16 space-y-3">
    <h2 class="text-4xl font-extrabold"
        :class="darkMode ? 'text-green-400' : 'text-green-600'">
      Tentang Kami
    </h2>
    <p :class="darkMode ? 'text-gray-300' : 'text-gray-600'">
      Wino Bangunan selalu berkomitmen menyediakan bahan bangunan berkualitas.
    </p>
  </div>

  <!-- GRID INTRO -->
  <div class="grid md:grid-cols-2 gap-14 items-center mb-16">
    
    <div class="space-y-5">
      <h3 class="text-3xl font-bold"
          :class="darkMode ? 'text-gray-100' : 'text-gray-900'">
        Siapa Kami?
      </h3>
      <p :class="darkMode ? 'text-gray-300' : 'text-gray-600'">
        Dengan pengalaman lebih dari 15 tahun, Wino Bangunan terus berkembang
        mengikuti kebutuhan pelanggan.
      </p>
      <p :class="darkMode ? 'text-gray-300' : 'text-gray-600'">
        Fokus utama kami adalah menghadirkan solusi cepat, tepat, dan terjangkau.
      </p>
    </div>

    <img 
        src="{{ asset('images/tokowino.png') }}" 
        alt="Tokowino"
        class="rounded-3xl shadow-xl object-cover h-80"
    />
  </div>

  <!-- CARD FEATURES -->
  <div class="grid md:grid-cols-3 gap-8">

    <div class="p-8 rounded-3xl shadow-md transition hover:shadow-lg"
         :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-700'">
      <h4 class="font-bold text-xl mb-2"
          :class="darkMode ? 'text-green-400' : 'text-green-600'">
        Produk Terlengkap
      </h4>
      <p>Kami menyediakan berbagai pilihan bahan bangunan untuk segala kebutuhan proyek.</p>
    </div>

    <div class="p-8 rounded-3xl shadow-md transition hover:shadow-lg"
         :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-700'">
      <h4 class="font-bold text-xl mb-2"
          :class="darkMode ? 'text-green-400' : 'text-green-600'">
        Pelayanan Cepat
      </h4>
      <p>Didukung tim berpengalaman untuk memastikan pelanggan mendapat layanan terbaik.</p>
    </div>

    <div class="p-8 rounded-3xl shadow-md transition hover:shadow-lg"
         :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-700'">
      <h4 class="font-bold text-xl mb-2"
          :class="darkMode ? 'text-green-400' : 'text-green-600'">
        Harga Kompetitif
      </h4>
      <p>Harga yang transparan dan sesuai untuk kebutuhan semua pelanggan.</p>
    </div>

  </div>

</section>


</main>


<!-- ===================== FOOTER ===================== -->
<footer class="mt-20 border-t pt-14 shadow-inner"
        :class="darkMode ? 'bg-gray-900 text-gray-300' : 'bg-white text-gray-700'">

  <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-4 gap-12">

    <div>
      <h3 class="text-2xl font-bold text-green-600 mb-4">Wino Bangunan</h3>
      <p class="opacity-80">Toko bahan bangunan lengkap.</p>
      <p class="text-xs opacity-50 mt-3">Sejak 2008 — Layanan terbaik.</p>
    </div>

    <div>
      <h4 class="font-semibold text-lg mb-4">Menu</h4>
      <ul class="space-y-2">
        <li><button @click="page='beranda'">Beranda</button></li>
        <li><button @click="page='partner'">Partner</button></li>
        <li><button @click="page='kontak'">Kontak</button></li>
        <li><button @click="page='tentang kami'">Tentang Kami</button></li>
      </ul>
    </div>

    <div>
      <h4 class="font-semibold text-lg mb-4">Kontak</h4>
      <p>Jl. Veteran No.33</p>
      <p>Telepon: (021) 555-6789</p>
      <p>Email: info@winobangunan.com</p>
    </div>

    <!-- SOSIAL MEDIA -->
    <div>
      <h4 class="font-semibold text-lg mb-4">Sosial Media</h4>

      <div class="flex items-center gap-4">

        <!-- Facebook -->
        <a href="https://facebook.com/" target="_blank"
          class="p-3 rounded-full border transition hover:scale-110"
          :class="darkMode ? 'border-gray-700 hover:bg-gray-800' : 'border-gray-300 hover:bg-gray-100'">
          <svg class="w-6 h-6"
              :class="darkMode ? 'text-white' : 'text-gray-700'"
              fill="currentColor" viewBox="0 0 24 24">
            <path
              d="M22 12.07C22 6.48 17.52 2 11.93 2S1.86 6.48 1.86 12.07c0 4.99 3.66 9.13 8.44 9.93v-7.03H7.9v-2.9h2.4V9.41c0-2.38 1.42-3.7 3.6-3.7 1.04 0 2.12.18 2.12.18v2.33h-1.2c-1.18 0-1.55.74-1.55 1.49v1.78h2.64l-.42 2.9h-2.22v7.03c4.78-.8 8.44-4.94 8.44-9.93z" />
          </svg>
        </a>

        <!-- Instagram -->
        <a href="https://instagram.com/" target="_blank"
          class="p-3 rounded-full border transition hover:scale-110"
          :class="darkMode ? 'border-gray-700 hover:bg-gray-800' : 'border-gray-300 hover:bg-gray-100'">
          <svg class="w-6 h-6"
              :class="darkMode ? 'text-white' : 'text-gray-700'"
              fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
            <path d="M7 3h10a4 4 0 014 4v10a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4z" />
            <circle cx="12" cy="12" r="3.3" />
            <circle cx="17" cy="7" r="1" />
          </svg>
        </a>

        <!-- WhatsApp -->
        <a href="https://wa.me/6281234567890" target="_blank"
          class="p-3 rounded-full border transition hover:scale-110"
          :class="darkMode ? 'border-gray-700 hover:bg-gray-800' : 'border-gray-300 hover:bg-gray-100'">
          <svg class="w-6 h-6"
              :class="darkMode ? 'text-white' : 'text-gray-700'"
              fill="currentColor" viewBox="0 0 24 24">
            <path
              d="M12 2A10 10 0 0 0 2 12a9.93 9.93 0 0 0 1.47 5.25L2 22l4.88-1.43A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.25-1.23l-.3-.17-2.9.85.88-2.82-.18-.29A8 8 0 1 1 12 20zm4.2-5.7c-.23-.12-1.35-.67-1.56-.75s-.36-.12-.51.12-.59.75-.73.9-.27.18-.49.06a6.52 6.52 0 0 1-1.9-1.17 7.1 7.1 0 0 1-1.31-1.64c-.14-.24 0-.37.1-.49.1-.1.24-.27.37-.41s.16-.24.25-.41a.44.44 0 0 0 0-.43c-.07-.12-.51-1.26-.7-1.72-.19-.45-.38-.39-.51-.39h-.44a.86.86 0 0 0-.62.29A2.58 2.58 0 0 0 6 9.4 4.49 4.49 0 0 0 6.9 12a10 10 0 0 0 3.69 3.53 11.83 11.83 0 0 0 1.71.63 4.1 4.1 0 0 0 1.88.12 3.08 3.08 0 0 0 2.08-1.48 2.51 2.51 0 0 0 .17-1.48c-.05-.07-.2-.12-.43-.24" />
          </svg>
        </a>

        <!-- TikTok -->
        <a href="https://tiktok.com/" target="_blank"
          class="p-3 rounded-full border transition hover:scale-110"
          :class="darkMode ? 'border-gray-700 hover:bg-gray-800' : 'border-gray-300 hover:bg-gray-100'">
          <svg class="w-6 h-6"
              :class="darkMode ? 'text-white' : 'text-gray-700'"
              fill="currentColor" viewBox="0 0 24 24">
            <path
              d="M12.7 2h2.4a5.9 5.9 0 0 0 5.9 5.9v2.4a8.3 8.3 0 0 1-4.7-1.5v7.6A5.6 5.6 0 1 1 10 10a5.5 5.5 0 0 1 2.7.7v2.8a2.8 2.8 0 1 0 1.7 2.5V2z" />
          </svg>
        </a>
      </div>
    </div>

  </div>

  <div class="text-center py-6 border-t opacity-70 mt-10"
       :class="darkMode ? 'border-gray-700' : 'border-gray-300'">
    © 2025 Wino Bangunan — All Rights Reserved.
  </div>

</footer>


<!-- ===================== ALPINE JS APP ===================== -->
<script>
function winoApp(){
  return {
    page: 'beranda',
    search: '',
    darkMode: false,
    mobileMenu: false,
    currentAd: 0,

    ads: [
      "https://source.unsplash.com/1200x400/?construction",
      "https://source.unsplash.com/1200x400/?building,materials",
      "https://source.unsplash.com/1200x400/?hardware,tools"
    ],

    allCategories: [],
    catalog: [],

    init(){

      this.allCategories = window.categoriesFromDB.map(cat => ({
        id: cat.toLowerCase().replace(/\s+/g, "-"),
        idLabel: cat
      }));

      this.catalog = window.productsFromDB.map(p => ({
        name: p.name,
        category: p.category,
        price: "Rp " + Number(p.price).toLocaleString("id-ID"),
        stock: p.stock,
        image: p.image ? "/" + p.image : "https://via.placeholder.com/400"
      }));

      setInterval(() => {
        this.currentAd = (this.currentAd + 1) % this.ads.length;
      }, 8000);

      this.$watch("page", () => this.mobileMenu = false);
    },

    get categories(){
      const base = [{ key: 'beranda', label: 'Beranda' }];

      const shuffled = [...this.allCategories].sort(() => Math.random() - 0.5);
      const randomCats = shuffled.slice(0, 4);
      randomCats.forEach(c => base.push({ key: c.idLabel, label: c.idLabel }));

      base.push({ key: "partner", label: "Partner" });
      base.push({ key: "kontak", label: "Kontak" });
      base.push({ key: "tentang kami", label: "Tentang Kami" });

      return base;
    },

    toggleDarkMode(){ this.darkMode = !this.darkMode },
    toggleMobileMenu(){ this.mobileMenu = !this.mobileMenu },

    handleCategoryNavigation(catKey){
      this.page = catKey;
      window.scrollTo({ top: 0, behavior: "smooth" });
    },

    handleBackToHome(){
      this.page = "beranda";
      window.scrollTo({ top: 0, behavior: "smooth" });
    },

    openMap(){
      window.open("https://maps.app.goo.gl/r3GUAqkB2N5X8xw47", "_blank");
    },

    filteredCatalogByCategory(catId){
      const cat = this.allCategories.find(c => c.id === catId);
      if (!cat) return [];

      const q = this.search.toLowerCase();

      return this.catalog.filter(i =>
        i.category === cat.idLabel &&
        i.name.toLowerCase().includes(q)
      );
    },

    scrollCarousel(catId, direction) {
        const id = "carousel-" + catId;
        const el = document.getElementById(id);
        if (!el) return;

        const amount = Math.round(el.offsetWidth * 0.8);

        // Fix: Set posisi scroll sedikit ke dalam agar bisa geser ke kiri
        if (direction === "left" && el.scrollLeft <= 0) {
            el.scrollLeft = 1; 
        }

        el.scrollBy({
            left: direction === "right" ? amount : -amount,
            behavior: "smooth"
        });
    }
  }
}
</script>

<!-- Laravel Blade Data -->
<script>
window.productsFromDB = @json($products);
window.categoriesFromDB = @json($categories);
</script>

</body>
</html>
