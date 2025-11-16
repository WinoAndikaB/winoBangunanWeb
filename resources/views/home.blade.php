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
<body x-data="winoApp()" :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'" class="min-h-screen font-sans antialiased">

<header :class="darkMode ? 'bg-gray-900 border-b border-gray-800' : 'bg-white border-b border-gray-200'" class="sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center gap-3">
        <button @click="toggleMobileMenu()" class="md:hidden p-2 rounded-md hover:bg-gray-100/50" :class="darkMode ? 'hover:bg-white/5' : ''">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <a href="#" class="flex items-center gap-3">
          <img src="{{ asset('images/lightmode-logo2.png') }}" class="max-h-14 sm:max-h-16 w-auto">
        </a>
      </div>

      <div class="flex-1 px-4">
        <div class="relative">
          <input type="search" x-model="search" placeholder="Cari produk, misal: semen, palu..." class="w-full rounded-full border shadow-sm py-2 pl-10 pr-4 text-sm" :class="darkMode ? 'bg-gray-800 border-gray-700 text-gray-100' : 'bg-white border-gray-200 text-gray-900'">
          <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
          </div>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <button @click="toggleDarkMode()" class="p-2 rounded-full hover:bg-gray-100/50" :class="darkMode ? 'hover:bg-white/5' : ''">
          <template x-if="darkMode">
  <!-- Modern Light Mode (Sun) Icon -->
  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
    <circle cx="12" cy="12" r="4" />
    <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
  </svg>
</template>
          <template x-if="!darkMode">
  <!-- Modern Dark Mode (Moon) Icon -->
  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
  </svg>
</template>
        </button>
      </div>
    </div>
  </div>

  <div x-show="mobileMenu" x-cloak class="md:hidden border-t" :class="darkMode ? 'border-gray-800 bg-gray-900' : 'border-gray-200 bg-white'">
    <div class="px-4 py-3 space-y-2">
      <template x-for="cat in categories" :key="cat.key">
        <button @click="handleCategoryNavigation(cat.key)" class="w-full text-left px-2 py-2 rounded-md hover:bg-gray-100/50" :class="darkMode ? 'hover:bg-white/5' : ''">
          <span x-text="cat.label"></span>
        </button>
      </template>
    </div>
  </div>
</header>

<nav class="hidden md:block sticky top-16 z-40" :class="darkMode ? 'bg-gray-900 border-b border-gray-800' : 'bg-white border-b border-gray-100'">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-center gap-6 overflow-x-auto py-3 scrollbar-hide text-sm">
      <template x-for="(cat, index) in categories" :key="cat.key">
        <div class="flex items-center gap-6">
          <template x-if="cat.key === 'partner'">
            <div class="h-5 w-[1.5px]" :class="darkMode ? 'bg-gray-700' : 'bg-gray-300'"></div>
          </template>

          <button @click="handleCategoryNavigation(cat.key)" class="whitespace-nowrap px-2 py-1 rounded-md" :class="page === cat.key ? 'text-green-600 border-b-2 border-green-600 pb-1' : 'hover:text-green-600'">
            <span x-text="cat.label"></span>
          </button>
        </div>
      </template>
    </div>
  </div>
</nav>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

<section x-show="page === 'beranda'" class="space-y-12">
  <div class="w-full rounded-2xl overflow-hidden shadow-md">
    <img :src="ads[currentAd]" class="w-full h-64 md:h-80 object-cover">
  </div>

  <template x-for="cat in allCategories" :key="cat.id">
    <section class="space-y-4">
      <div class="flex items-center justify-between">
        <h2 class="text-lg sm:text-2xl font-semibold text-green-600" x-text="cat.idLabel"></h2>
        <button @click="handleCategoryNavigation(cat.idLabel)" class="text-sm text-gray-500 hover:text-green-600">Lihat semua</button>
      </div>

      <div x-show="filteredCatalogByCategory(cat.id).length === 0" class="py-10 text-center text-gray-400 text-sm">Data Kosong</div>

      <div x-show="filteredCatalogByCategory(cat.id).length > 0" class="relative group">

        <button @click="scrollCarousel(cat.id, 'left')" class="absolute left-0 top-1/2 -translate-y-1/2 p-2 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition" :class="darkMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-700'">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 18l-6-6 6-6"/></svg>
        </button>

        <div :ref="'carousel-'+cat.id" class="flex gap-4 overflow-x-auto scroll-smooth px-2 py-2 scrollbar-hide snap-x snap-mandatory">
          <template x-for="(item, index) in filteredCatalogByCategory(cat.id)" :key="index">
            <article class="w-56 sm:w-60 md:w-64 snap-start flex-shrink-0 rounded-xl border shadow-sm" :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-100'">
              <div class="flex flex-col h-full">
                <div class="h-40 overflow-hidden rounded-t-xl">
                  <img :
                <img :src="item.image" :alt="item.name" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                <div class="p-3 flex flex-col gap-2">
                  <h3 class="text-sm font-medium truncate" x-text="item.name"></h3>
                  <div class="flex items-center justify-between">
                    <p class="text-green-600 font-semibold text-sm" x-text="item.price"></p>
                    <p class="text-xs text-gray-400">Stok: <span x-text="item.stock"></span></p>
                  </div>
                </div>
              </div>
            </article>
          </template>
        </div>

        <button @click="scrollCarousel(cat.id, 'right')" class="absolute right-0 top-1/2 -translate-y-1/2 p-2 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition" :class="darkMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-700'">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 18l6-6-6-6"/></svg>
        </button>

      </div>
    </section>
  </template>
</section>

<!-- Bagian berikutnya siap ditambahkan ketika Anda mengetik: LANJUT -->

<!-- =================== HALAMAN KATEGORI =================== -->
<template x-for="cat in allCategories" :key="cat.id">
  <section x-show="page === cat.idLabel" class="space-y-6">

    <div class="flex items-center justify-between">
      <h2 class="text-2xl font-semibold text-green-600" x-text="cat.idLabel"></h2>
      <button @click="handleBackToHome()" class="text-sm px-4 py-2 rounded-full border bg-white/0 hover:bg-green-50" :class="darkMode ? 'bg-gray-800 border-gray-700 hover:bg-gray-800/90' : ''">Kembali</button>
    </div>

    <div x-show="filteredCatalogByCategory(cat.id).length === 0" class="py-10 text-center text-gray-400 text-sm">Data Kosong</div>

    <div x-show="filteredCatalogByCategory(cat.id).length > 0" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

      <template x-for="(item, index) in filteredCatalogByCategory(cat.id)" :key="index">
        <article class="rounded-lg border p-3 hover:shadow-md transition" :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-100'">

          <img :src="item.image" :alt="item.name" class="w-full h-40 object-cover rounded-md mb-3">

          <h3 class="font-medium text-sm truncate" x-text="item.name"></h3>
          <p class="text-green-600 font-semibold mt-1" x-text="item.price"></p>
          <p class="text-xs text-gray-400 mt-1">Stok: <span x-text="item.stock"></span></p>

        </article>
      </template>

    </div>

  </section>
</template>

<!-- Bagian berikutnya siap ketika Anda mengetik: LANJUT -->

<!-- =================== PARTNER =================== -->
<section x-show="page === 'partner'" class="py-10" x-cloak>
  <h2 class="text-3xl font-bold text-green-600 text-center mb-6">Partner Kami</h2>
  <p class="text-center text-gray-500 max-w-2xl mx-auto mb-10">Kami bekerja sama dengan berbagai perusahaan bahan bangunan terkemuka.</p>

  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 max-w-6xl mx-auto px-4">

    <div class="p-5 rounded-xl shadow-sm border hover:shadow-md transition" :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'">
      <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Avian_Brands_Logo.png" class="w-full h-20 object-contain mb-3">
      <h3 class="text-center font-semibold">Avian</h3>
    </div>

    <div class="p-5 rounded-xl shadow-sm border hover:shadow-md transition" :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'">
      <img src="https://seeklogo.com/images/D/dulux-logo-0B31C5F4F3-seeklogo.com.png" class="w-full h-20 object-contain mb-3">
      <h3 class="text-center font-semibold">Dulux</h3>
    </div>

    <div class="p-5 rounded-xl shadow-sm border hover:shadow-md transition" :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'">
      <img src="https://upload.wikimedia.org/wikipedia/en/8/84/Nippon_Paint_logo.png" class="w-full h-20 object-contain mb-3">
      <h3 class="text-center font-semibold">Nippon Paint</h3>
    </div>

    <div class="p-5 rounded-xl shadow-sm border hover:shadow-md transition" :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'">
      <img src="https://upload.wikimedia.org/wikipedia/en/c/c3/Tiga_Roda.png" class="w-full h-20 object-contain mb-3">
      <h3 class="text-center font-semibold">Tiga Roda</h3>
    </div>

    <div class="p-5 rounded-xl shadow-sm border hover:shadow-md transition" :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'">
      <img src="https://upload.wikimedia.org/wikipedia/commons/e/e8/Holcim-logo.svg" class="w-full h-16 object-contain mb-3">
      <h3 class="text-center font-semibold">Holcim / Dynamix</h3>
    </div>

  </div>
</section>


<!-- =================== KONTAK =================== -->
<section x-show="page === 'kontak'" x-cloak class="py-14 px-4">
  <div class="max-w-5xl mx-auto">

    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold text-green-600 mb-3">Kontak Kami</h2>
      <p class="text-gray-500 max-w-xl mx-auto">Hubungi kami untuk pertanyaan, pemesanan, atau informasi lebih lanjut.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 rounded-3xl shadow-xl overflow-hidden" :class="darkMode ? 'bg-gray-800 text-gray-100' : 'bg-white'">

      <div class="p-10 bg-gradient-to-br from-green-600 to-green-500 text-white">
        <h3 class="text-2xl font-semibold mb-6">Wino Bangunan</h3>
        <div class="space-y-6">

          <div class="flex items-start gap-4">
            <svg class="w-7 h-7" fill="none" stroke="white" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-6-4.35-6-10a6 6 0 1112 0c0 5.65-6 10-6 10z"/></svg>
            <p>Jl. Veteran No.33, Langkae Araya, Towuti, Luwu Timur, Sulawesi Selatan</p>
          </div>

          <div class="flex items-start gap-4">
            <svg class="w-7 h-7" fill="none" stroke="white" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h1.28c.45 0 .86.27 1.03.68l1.2 3a1 1 0 01-.27 1.12l-1.4 1.4a14 14 0 006.2 6.2l1.4-1.4a1 1 0 011.12-.27l3 1.2c.41.17.68.58.68 1.03V19a2 2 0 01-2 2h-1C8.82 21 3 15.18 3 8V7a2 2 0 012-2z"/></svg>
            <p>Telepon: (021) 555-6789</p>
          </div>

          <div class="flex items-start gap-4">
            <svg class="w-7 h-7" fill="none" stroke="white" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <p>info@winobangunan.com</p>
          </div>

        </div>
      </div>

      <div class="p-10 flex flex-col justify-center" :class="darkMode ? 'bg-gray-900' : 'bg-gray-50'">
        <h3 class="text-xl font-semibold mb-4" :class="darkMode ? 'text-white' : 'text-gray-800'">Lokasi Kami</h3>
        <p class="mb-6 text-gray-500" :class="darkMode ? 'text-gray-300' : 'text-gray-600'">Klik tombol di bawah untuk melihat lokasi kami di Google Maps.</p>
        <button @click="openMap()" class="px-6 py-3 bg-green-600 text-white rounded-full shadow hover:bg-green-700 transition text-lg w-fit">Lihat di Google Maps</button>
      </div>

    </div>
  </div>
</section>


<!-- =================== TENTANG KAMI =================== -->
<section x-show="page === 'tentang kami'" x-cloak class="py-16 px-4">
  <div class="max-w-6xl mx-auto">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16">
      <div>
        <h2 class="text-4xl font-extrabold text-green-600 mb-4 leading-tight">Tentang Wino Bangunan</h2>
        <p class="text-gray-500 text-lg max-w-md" :class="darkMode ? 'text-gray-300' : 'text-gray-600'">Lebih dari sekadar toko bangunan — kami adalah mitra Anda dalam setiap proyek.</p>
      </div>

      <div class="rounded-3xl overflow-hidden shadow-lg">
        <img src="https://source.unsplash.com/800x600/?construction,store" class="w-full h-72 object-cover">
      </div>
    </div>

    <div class="rounded-3xl p-10 shadow-xl mb-16" :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-700'">
      <div class="space-y-6 text-lg leading-relaxed">
        <p>Wino Bangunan adalah toko bangunan terpercaya yang menyediakan material dasar, perkakas, perlengkapan listrik, dan produk finishing untuk berbagai jenis proyek konstruksi.</p>
        <p>Kami mengikuti perkembangan teknologi dan bekerja sama dengan merek ternama untuk memastikan produk yang kami sediakan memenuhi standar industri.</p>

        <p>Pelayanan adalah prioritas utama kami. Tim kami selalu siap membantu dalam memilih produk, memberikan rekomendasi, dan memastikan Anda mendapatkan solusi terbaik.</p>
        <p>Dengan pengalaman bertahun-tahun, kami terus berkembang agar dapat menjadi mitra terpercaya dalam membangun dan memperbaiki hunian atau proyek Anda.</p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

      <div class="p-8 rounded-2xl shadow-lg text-center" :class="darkMode ? 'bg-gray-900 border border-gray-700' : 'bg-green-50 border border-green-200'">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h18M3 9h18M3 15h18M3 21h18"/></svg>
        <h3 class="text-xl font-semibold mb-2">Produk Lengkap</h3>
        <p class="text-gray-600" :class="darkMode ? 'text-gray-300' : ''">Material dasar, listrik, finishing, dan perkakas.</p>
      </div>

      <div class="p-8 rounded-2xl shadow-lg text-center" :class="darkMode ? 'bg-gray-900 border border-gray-700' : 'bg-green-50 border border-green-200'">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6l4 2m-4-14a10 10 0 100 20 10 10 0 000-20z"/></svg>
        <h3 class="text-xl font-semibold mb-2">Pelayanan Cepat</h3>
        <p class="text-gray-600" :class="darkMode ? 'text-gray-300' : ''">Respons cepat & ramah untuk semua kebutuhan Anda.</p>
      </div>

      <div class="p-8 rounded-2xl shadow-lg text-center" :class="darkMode ? 'bg-gray-900 border border-gray-700' : 'bg-green-50 border border-green-200'">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2 4 4 8-8 2 2-10 10L3 12z"/></svg>
        <h3 class="text-xl font-semibold mb-2">Kualitas Terjamin</h3>
        <p class="text-gray-600" :class="darkMode ? 'text-gray-300' : ''">Bekerja sama dengan brand terpercaya di Indonesia.</p>
      </div>

    </div>

  </div>
</section>


<!-- =================== FOOTER (MODERNIZED) =================== -->
<footer :class="darkMode ? 'bg-gray-900 text-gray-300' : 'bg-white text-gray-700'" class="mt-20 border-t pt-14 shadow-inner">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-12">

    <!-- BRAND -->
    <div>
      <h3 class="text-2xl font-bold text-green-600 mb-4">Wino Bangunan</h3>
      <p class="text-sm leading-relaxed opacity-80">Toko bahan bangunan lengkap untuk segala kebutuhan material, perkakas, listrik, dan finishing.</p>
      <p class="text-xs mt-3 opacity-50">Sejak 2008 — Melayani dengan kualitas terbaik.</p>
    </div>

    <!-- MENU -->
    <div>
      <h4 class="text-lg font-semibold mb-4">Menu</h4>
      <ul class="space-y-2 text-sm opacity-90">
        <li><button @click="page='beranda'" class="hover:text-green-600 transition">Beranda</button></li>
        <li><button @click="page='partner'" class="hover:text-green-600 transition">Partner</button></li>
        <li><button @click="page='kontak'" class="hover:text-green-600 transition">Kontak</button></li>
        <li><button @click="page='tentang kami'" class="hover:text-green-600 transition">Tentang Kami</button></li>
      </ul>
    </div>

    <!-- KONTAK -->
    <div>
      <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
      <p class="text-sm opacity-90">Jl. Veteran No.33, Luwu Timur</p>
      <p class="text-sm opacity-90 mt-1">Telepon: (021) 555-6789</p>
      <p class="text-sm opacity-90 mt-1">Email: info@winobangunan.com</p>
      <button @click="openMap()" class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-600 text-white hover:bg-green-700 transition text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 12m0 0l4.243-4.243M13.414 12H3"/></svg>
        Lihat Lokasi
      </button>
    </div>

    <!-- SOSIAL MEDIA -->
    <div>
      <h4 class="text-lg font-semibold mb-4">Ikuti Kami</h4>
      <div class="flex items-center gap-5">
        <a href="#" class="hover:text-green-600 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.3l-.4 3h-1.9v7A10 10 0 0 0 22 12z"/></svg>
        </a>
        <a href="#" class="hover:text-green-600 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor"><path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h10zm-5 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10z"/></svg>
        </a>
        <a href="#" class="hover:text-green-600 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2z"/></svg>
        </a>
      </div>
    </div>

  </div>

  <div class="border-t mt-12 py-5 text-center text-sm opacity-70" :class="darkMode ? 'border-gray-700' : 'border-gray-300'">
    © 2025 Wino Bangunan — Hak Cipta Dilindungi.
  </div>
</footer>

<script>
  window.productsFromDB = @json($products);
</script>

<script>
    window.productsFromDB = @json($products);
    window.categoriesFromDB = @json($categories);
</script>


<script>
function winoApp(){
  return {
    page: 'beranda',
    search: '',
    darkMode: false,
    mobileMenu: false,
    currentAd: 0,

    ads: [
      'https://source.unsplash.com/1200x400/?construction',
      'https://source.unsplash.com/1200x400/?building,materials',
      'https://source.unsplash.com/1200x400/?hardware,tools'
    ],

    allCategories: [],   // <- otomatis dari database

    catalog: [],

    init(){
      // LOAD CATEGORY DARI DATABASE
      this.allCategories = window.categoriesFromDB.map(cat => {
        return {
          id: cat.toLowerCase().replace(/\s+/g, '-'), // contoh: Material Dasar → material-dasar
          idLabel: cat
        };
      });

      // LOAD PRODUK DARI DATABASE
      this.catalog = window.productsFromDB.map(p => {
        return {
          name: p.name,
          category: p.category,                               // kategori asli dari DB
          price: 'Rp ' + Number(p.price).toLocaleString('id-ID'),
          stock: p.stock,
          image: p.image ? '/' + p.image : 'https://via.placeholder.com/400'
        };
      });

      // SLIDER IKLAN
      setInterval(() => {
        this.currentAd = (this.currentAd + 1) % this.ads.length;
      }, 8000);

      this.$watch('page', () => this.mobileMenu = false);
    },

    // NAVIGASI MENU ATAS
    get categories(){
      const cats = [{ key: 'beranda', label: 'Beranda' }];

      // SHUFFLE kategori
      let shuffled = [...this.allCategories]
        .sort(() => Math.random() - 0.5);

      // AMBIL 3–4 KATEGORI RANDOM
      let randomCategories = shuffled.slice(0, 4);

      randomCategories.forEach(c => {
        cats.push({ key: c.idLabel, label: c.idLabel });
      });

      // Menu lainnya tetap
      cats.push({ key: 'partner', label: 'Partner' });
      cats.push({ key: 'kontak', label: 'Kontak' });
      cats.push({ key: 'tentang kami', label: 'Tentang Kami' });

      return cats;
    },

    toggleDarkMode(){ this.darkMode = !this.darkMode },
    toggleMobileMenu(){ this.mobileMenu = !this.mobileMenu },

    handleCategoryNavigation(catKey){
      this.page = catKey;
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    handleBackToHome(){
      this.page = 'beranda';
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    openMap(){ window.open('https://maps.app.goo.gl/r3GUAqkB2N5X8xw47', '_blank') },

    filteredCatalog(){
      const q = this.search.toLowerCase();
      return this.catalog.filter(item =>
        item.name.toLowerCase().includes(q)
      );
    },

    filteredCatalogByCategory(catId){
      const catObj = this.allCategories.find(c => c.id === catId);
      if (!catObj) return [];

      const q = this.search.toLowerCase();

      return this.catalog.filter(item =>
        item.category === catObj.idLabel &&
        item.name.toLowerCase().includes(q)
      );
    },

    scrollCarousel(catId, direction){
      const container = document.querySelector(`[x-ref='carousel-${catId}']`);
      if (!container) return;

      const amount = Math.round(container.offsetWidth * 0.8);
      container.scrollBy({
        left: direction === 'right' ? amount : -amount,
        behavior: 'smooth'
      });
    }

  }
}
</script>


</body>
</html>
