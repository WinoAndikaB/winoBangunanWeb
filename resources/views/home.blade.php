<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Wino Bangunan</title>

  <!-- Tailwind via CDN (fast prototyping) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    /* small helpers */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
  </style>
</head>
<body x-data="winoApp()" :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'" class="min-h-screen font-sans antialiased">

  <!-- NAVBAR: Minimalist Shop style (compact) -->
  <header :class="darkMode ? 'bg-gray-900 border-b border-gray-800' : 'bg-white border-b border-gray-200'" class="sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Left: Logo + optional menu on small screens -->
        <div class="flex items-center gap-3">
          <button @click="toggleMobileMenu()" class="md:hidden p-2 rounded-md hover:bg-gray-100/50" :class="darkMode ? 'hover:bg-white/5' : ''" aria-label="Buka menu">
            <!-- simple hamburger -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
          </button>

        <a href="#" class="flex items-center gap-3">
            <img 
             src="{{ asset('images/lightmode-logo2.png') }}" 
                alt="Wino Bangunan" 
                class="max-h-14 sm:max-h-16 w-auto object-contain"
            >
        </a>
        </div>

        <!-- Center: Search (prominent on mobile) -->
        <div class="flex-1 px-4">
          <div class="relative">
            <input type="search" x-model="search" :placeholder="language === 'id' ? 'Cari produk, misal: semen, palu...' : 'Search products e.g. cement, hammer...'"
                   class="w-full rounded-full border shadow-sm py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-green-500/40 transition"
                   :class="darkMode ? 'bg-gray-800 border-gray-700 placeholder-gray-400 text-gray-100' : 'bg-white border-gray-200 placeholder-gray-500 text-gray-900'" aria-label="Cari produk">

            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
            </div>
          </div>
        </div>

        <!-- Right: actions -->
        <div class="flex items-center gap-3">
          <button @click="toggleLanguage()" class="px-2 py-1 rounded-full text-sm border hover:bg-green-600 hover:text-white transition" aria-label="Ganti bahasa">
            <span x-text="language === 'id' ? 'EN' : 'ID'"></span>
          </button>

          <button @click="toggleDarkMode()" class="p-2 rounded-full hover:bg-gray-100/50" :class="darkMode ? 'hover:bg-white/5' : ''" aria-label="Toggle dark mode">
            <template x-if="darkMode">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
            </template>
            <template x-if="!darkMode">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
            </template>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu (slide down) -->
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

  <!-- CATEGORY BAR (desktop compact) -->
  <nav class="hidden md:block sticky top-16 z-40" 
    :class="darkMode ? 'bg-gray-900 border-b border-gray-800' : 'bg-white border-b border-gray-100'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-center gap-6 overflow-x-auto py-3 scrollbar-hide text-sm">
        <template x-for="(cat, index) in categories" :key="cat.key">
          <div class="flex items-center gap-6">
            <!-- Divider sebelum PARTNER -->
            <template x-if="cat.key === 'partner'">
              <div class="h-5 w-[1.5px]" :class="darkMode ? 'bg-gray-700' : 'bg-gray-300'"></div>
            </template>
            <!-- Tombol kategori -->
            <button 
              @click="handleCategoryNavigation(cat.key)" 
              class="whitespace-nowrap px-2 py-1 rounded-md" 
              :class="page === cat.key ? 'text-green-600 border-b-2 border-green-600 pb-1' : 'hover:text-green-600'"
            >
              <span x-text="cat.label"></span>
            </button>
          </div>
        </template>
      </div>
    </div>
  </nav>



  <!-- MAIN CONTENT -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

  <!-- BERANDA -->
  <section x-show="page === 'beranda'" class="space-y-12" aria-label="Beranda">

    <!-- Hero / Promo banner -->
    <div class="w-full rounded-2xl overflow-hidden shadow-md">
      <img :src="ads[currentAd]" alt="Banner promosi" class="w-full h-64 md:h-80 object-cover transition-transform duration-700 hover:scale-105">
    </div>

    <!-- Category carousels -->
    <template x-for="cat in allCategories" :key="cat.id">
      <section class="space-y-4">

        <div class="flex items-center justify-between">
          <h2 class="text-lg sm:text-2xl font-semibold text-green-600" x-text="t(cat.idLabel, cat.enLabel)"></h2>
          <button @click="handleCategoryNavigation(cat.idLabel)" class="text-sm text-gray-500 hover:text-green-600">Lihat semua</button>
        </div>

        <!-- ======= DATA KOSONG ======= -->
        <div
          x-show="filteredCatalogByCategory(cat.id).length === 0"
          class="w-full py-10 text-center text-gray-400 text-sm">
          Data Kosong
        </div>

        <!-- ======= DATA ADA ======= -->
        <div x-show="filteredCatalogByCategory(cat.id).length > 0" class="relative group">

          <!-- left control -->
          <button @click="scrollCarousel(cat.id, 'left')"
            class="absolute left-0 top-1/2 -translate-y-1/2 p-2 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition"
            :class="darkMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-700'"
            aria-label="Geser kiri">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M15 18l-6-6 6-6"/></svg>
          </button>

          <!-- carousel -->
          <div :ref="'carousel-'+cat.id" class="flex gap-4 overflow-x-auto scroll-smooth px-2 py-2 scrollbar-hide snap-x snap-mandatory">
            <template x-for="(item, index) in filteredCatalogByCategory(cat.id)" :key="index">
              <article class="w-56 sm:w-60 md:w-64 snap-start flex-shrink-0 rounded-xl border shadow-sm hover:shadow-md transition transform hover:-translate-y-1"
                :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-100'">

                <div class="flex flex-col h-full">
                  <div class="h-40 overflow-hidden rounded-t-xl">
                    <img :src="item.image" :alt="item.name" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                  </div>

                  <div class="p-3 flex flex-col gap-2">
                    <h3 class="text-sm font-medium truncate" x-text="item.name"></h3>
                    <div class="flex items-center justify-between">
                      <p class="text-green-600 font-semibold text-sm" x-text="item.price"></p>
                      <p class="text-xs text-gray-400" x-text="(language === 'id' ? 'Stok' : 'Stock') + ': ' + item.stock"></p>
                    </div>
                  </div>
                </div>

              </article>
            </template>
          </div>

          <!-- right control -->
          <button @click="scrollCarousel(cat.id, 'right')"
            class="absolute right-0 top-1/2 -translate-y-1/2 p-2 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition"
            :class="darkMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-700'"
            aria-label="Geser kanan">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 18l6-6-6-6"/></svg>
          </button>

        </div>

      </section>
    </template>

  </section>


    <!-- CATEGORY / LIST PAGES -->
    <template x-for="cat in allCategories" :key="cat.id">
      <section x-show="page === cat.idLabel" class="space-y-6" aria-label="Kategori">

        <div class="flex items-center justify-between">
          <h2 class="text-2xl font-semibold text-green-600" x-text="t(cat.idLabel, cat.enLabel)"></h2>
          <button @click="handleBackToHome()"
            class="text-sm px-4 py-2 rounded-full border bg-white/0 hover:bg-green-50"
            :class="darkMode ? 'bg-gray-800 border-gray-700 hover:bg-gray-800/90' : ''">
            Kembali
          </button>
        </div>

        <!-- ======= DATA KOSONG ======= -->
        <div
          x-show="filteredCatalogByCategory(cat.id).length === 0"
          class="w-full py-10 text-center text-gray-400 text-sm">
          Data Kosong
        </div>

        <!-- ======= DATA ADA ======= -->
        <div
          x-show="filteredCatalogByCategory(cat.id).length > 0"
          class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

          <template x-for="(item, index) in filteredCatalogByCategory(cat.id)" :key="index">
            <article class="rounded-lg border p-3 hover:shadow-md transition"
              :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-100'">

              <img :src="item.image" :alt="item.name"
                class="w-full h-40 object-cover rounded-md mb-3">

              <h3 class="font-medium text-sm truncate" x-text="item.name"></h3>

              <p class="text-green-600 font-semibold mt-1" x-text="item.price"></p>

              <p class="text-xs text-gray-400 mt-1"
                x-text="(language === 'id' ? 'Stok' : 'Stock') + ': ' + item.stock">
              </p>

            </article>
          </template>

        </div>

      </section>
    </template>


    <!-- Partner, kontak, tentang sections simplified -->
    <section 
      x-show="page === 'partner'" 
      class="py-10"
      x-cloak
    >
      <h2 class="text-3xl font-bold text-green-600 text-center mb-6">
        <span x-text="language === 'id' ? 'Partner Kami' : 'Our Partners'"></span>
      </h2>

      <p class="text-center text-gray-500 max-w-2xl mx-auto mb-10">
        <span x-text="language === 'id' 
          ? 'Kami bekerja sama dengan berbagai perusahaan bahan bangunan terkemuka.' 
          : 'We collaborate with leading construction material brands.'"></span>
      </p>

      <!-- GRID PARTNER -->
      <div 
        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 max-w-6xl mx-auto px-4"
      >

        <!-- Card Avian -->
        <div 
          class="p-5 rounded-xl shadow-sm border hover:shadow-md transition bg-white"
          :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'"
        >
          <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Avian_Brands_Logo.png" 
              alt="Avian" 
              class="w-full h-20 object-contain mb-3">
          <h3 class="text-center font-semibold">Avian</h3>
        </div>

        <!-- Card Dulux -->
        <div 
          class="p-5 rounded-xl shadow-sm border hover:shadow-md transition"
          :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'"
        >
          <img src="https://seeklogo.com/images/D/dulux-logo-0B31C5F4F3-seeklogo.com.png" 
              alt="Dulux" 
              class="w-full h-20 object-contain mb-3">
          <h3 class="text-center font-semibold">Dulux</h3>
        </div>

        <!-- Card Nippon Paint -->
        <div 
          class="p-5 rounded-xl shadow-sm border hover:shadow-md transition"
          :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'"
        >
          <img src="https://upload.wikimedia.org/wikipedia/en/8/84/Nippon_Paint_logo.png" 
              alt="Nippon Paint" 
              class="w-full h-20 object-contain mb-3">
          <h3 class="text-center font-semibold">Nippon Paint</h3>
        </div>

        <!-- Card Tiga Roda -->
        <div 
          class="p-5 rounded-xl shadow-sm border hover:shadow-md transition"
          :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'"
        >
          <img src="https://upload.wikimedia.org/wikipedia/en/c/c3/Tiga_Roda.png" 
              alt="Tiga Roda" 
              class="w-full h-20 object-contain mb-3">
          <h3 class="text-center font-semibold">Tiga Roda</h3>
        </div>

        <!-- Card Holcim / Dynamix -->
        <div 
          class="p-5 rounded-xl shadow-sm border hover:shadow-md transition"
          :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'"
        >
          <img src="https://upload.wikimedia.org/wikipedia/commons/e/e8/Holcim-logo.svg" 
              alt="Holcim" 
              class="w-full h-16 object-contain mb-3">
          <h3 class="text-center font-semibold">Holcim / Dynamix</h3>
        </div>

      </div>
    </section>


    <section 
      x-show="page === 'kontak'" 
      x-cloak
      class="py-14 px-4"
    >
      <div class="max-w-5xl mx-auto">

        <!-- Title -->
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold text-green-600 mb-3">
            <span x-text="language === 'id' ? 'Kontak Kami' : 'Contact Us'"></span>
          </h2>
          <p class="text-gray-500 max-w-xl mx-auto">
            <span x-text="language === 'id' 
              ? 'Hubungi kami untuk pertanyaan, pemesanan, atau informasi lebih lanjut.' 
              : 'Contact us for inquiries, orders, or more information.'">
            </span>
          </p>
        </div>

        <!-- Contact Box -->
        <div
          class="grid grid-cols-1 md:grid-cols-2 rounded-3xl shadow-xl overflow-hidden"
          :class="darkMode ? 'bg-gray-800 text-gray-100' : 'bg-white'"
        >

          <!-- LEFT SIDE (Info) -->
          <div 
            class="p-10 bg-gradient-to-br from-green-600 to-green-500 text-white"
          >
            <h3 class="text-2xl font-semibold mb-6">Wino Bangunan</h3>

            <div class="space-y-6">

              <!-- Address -->
              <div class="flex items-start gap-4">
                <svg class="w-7 h-7" fill="none" stroke="white" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-6-4.35-6-10a6 6 0 1112 0c0 5.65-6 10-6 10z" />
                </svg>
                <p>
                  <span x-text="language==='id' 
                    ? 'Jl. Veteran No.33, Langkae Araya, Towuti, Luwu Timur, Sulawesi Selatan'
                    : 'Jl. Veteran No.33, Langkae Araya, Towuti District, East Luwu, South Sulawesi'"></span>
                </p>
              </div>

              <!-- Phone -->
              <div class="flex items-start gap-4">
                <svg class="w-7 h-7" fill="none" stroke="white" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M3 5a2 2 0 012-2h1.28c.45 0 .86.27 1.03.68l1.2 3a1 1 0 01-.27 1.12l-1.4 1.4a14 14 0 006.2 6.2l1.4-1.4a1 1 0 011.12-.27l3 1.2c.41.17.68.58.68 1.03V19a2 2 0 01-2 2h-1C8.82 21 3 15.18 3 8V7a2 2 0 012-2z" />
                </svg>
                <p>
                  <span x-text="language==='id' ? 'Telepon: (021) 555-6789' : 'Phone: (021) 555-6789'"></span>
                </p>
              </div>

              <!-- Email -->
              <div class="flex items-start gap-4">
                <svg class="w-7 h-7" fill="none" stroke="white" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <p>info@winobangunan.com</p>
              </div>

            </div>

          </div>

          <!-- RIGHT SIDE (Button + extras) -->
          <div 
            class="p-10 flex flex-col justify-center"
            :class="darkMode ? 'bg-gray-900' : 'bg-gray-50'"
          >
            <h3 class="text-xl font-semibold mb-4"
                :class="darkMode ? 'text-white' : 'text-gray-800'">
              <span x-text="language==='id' ? 'Lokasi Kami' : 'Our Location'"></span>
            </h3>

            <p class="mb-6 text-gray-500"
              :class="darkMode ? 'text-gray-300' : 'text-gray-600'">
              <span x-text="language==='id'
                ? 'Klik tombol di bawah untuk melihat lokasi kami di Google Maps.'
                : 'Click the button below to view our location on Google Maps.'"></span>
            </p>

            <button 
              @click="openMap()"
              class="px-6 py-3 bg-green-600 text-white rounded-full shadow hover:bg-green-700 transition text-lg w-fit"
            >
              <span x-text="language==='id' ? 'Lihat di Google Maps' : 'Open Google Maps'"></span>
            </button>
          </div>

        </div>
      </div>
    </section>


   <section 
  x-show="page === 'tentang kami'" 
  x-cloak
  class="py-16 px-4"
>
  <div class="max-w-6xl mx-auto">

    <!-- HERO TOP -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16">

      <!-- LEFT: Text -->
      <div>
        <h2 class="text-4xl font-extrabold text-green-600 mb-4 leading-tight">
          <span x-text="language === 'id' ? 'Tentang Wino Bangunan' : 'About Wino Bangunan'"></span>
        </h2>
        <p class="text-gray-500 text-lg max-w-md"
           :class="darkMode ? 'text-gray-300' : 'text-gray-600'">
          <span x-text="language==='id'
            ? 'Lebih dari sekadar toko bangunan — kami adalah mitra Anda dalam setiap proyek.'
            : 'More than just a building store — we are your partner in every project.'"></span>
        </p>
      </div>

      <!-- RIGHT: Hero Image -->
      <div class="rounded-3xl overflow-hidden shadow-lg">
        <img src="https://source.unsplash.com/800x600/?construction,store" 
             alt="Construction Store" 
             class="w-full h-72 object-cover">
      </div>
    </div>


    <!-- ABOUT CONTENT CARD -->
    <div 
      class="rounded-3xl p-10 shadow-xl mb-16"
      :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-700'"
    >

      <div class="space-y-6 text-lg leading-relaxed">

        <!-- PARAGRAPH 1 -->
        <p x-show="language==='id'">
          Wino Bangunan adalah toko bangunan terpercaya yang menyediakan material dasar, perkakas, perlengkapan listrik, dan produk finishing untuk berbagai jenis proyek konstruksi. Kami selalu menjaga kualitas dan harga terbaik untuk pelanggan.
        </p>
        <p x-show="language==='en'">
          Wino Bangunan is a trusted construction materials store offering essentials, tools, electrical supplies, and finishing products. We consistently provide the best quality and pricing for our customers.
        </p>

        <!-- PARAGRAPH 2 -->
        <p x-show="language==='id'">
          Kami mengikuti perkembangan teknologi dan bekerja sama dengan merek ternama untuk memastikan produk yang kami sediakan memenuhi standar industri.
        </p>
        <p x-show="language==='en'">
          We follow technological developments and collaborate with well-known brands to ensure every product meets industry standards.
        </p>

        <!-- PARAGRAPH 3 -->
        <p x-show="language==='id'">
          Pelayanan adalah prioritas utama kami. Tim kami selalu siap membantu dalam memilih produk, memberikan rekomendasi, dan memastikan Anda mendapatkan solusi terbaik.
        </p>
        <p x-show="language==='en'">
          Service is our top priority. Our team is always ready to help with product selection, recommendations, and ensuring you get the best solutions.
        </p>

        <!-- PARAGRAPH 4 -->
        <p x-show="language==='id'">
          Dengan pengalaman bertahun-tahun, kami terus berkembang agar dapat menjadi mitra terpercaya dalam membangun dan memperbaiki hunian atau proyek Anda.
        </p>
        <p x-show="language==='en'">
          With years of experience, we continue to grow and aim to be your trusted partner for building or improving your property.
        </p>

      </div>
    </div>


    <!-- HIGHLIGHT FEATURES -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Feature 1 -->
      <div 
        class="p-8 rounded-2xl shadow-lg text-center"
        :class="darkMode ? 'bg-gray-900 border border-gray-700' : 'bg-green-50 border border-green-200'"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M3 3h18M3 9h18M3 15h18M3 21h18" />
        </svg>
        <h3 class="text-xl font-semibold mb-2">Produk Lengkap</h3>
        <p class="text-gray-600" :class="darkMode ? 'text-gray-300' : ''">
          Material dasar, listrik, finishing, dan perkakas.
        </p>
      </div>

      <!-- Feature 2 -->
      <div 
        class="p-8 rounded-2xl shadow-lg text-center"
        :class="darkMode ? 'bg-gray-900 border border-gray-700' : 'bg-green-50 border border-green-200'"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v6l4 2m-4-14a10 10 0 100 20 10 10 0 000-20z" />
        </svg>
        <h3 class="text-xl font-semibold mb-2">Pelayanan Cepat</h3>
        <p class="text-gray-600" :class="darkMode ? 'text-gray-300' : ''">
          Respons cepat & ramah untuk semua kebutuhan Anda.
        </p>
      </div>

      <!-- Feature 3 -->
      <div 
        class="p-8 rounded-2xl shadow-lg text-center"
        :class="darkMode ? 'bg-gray-900 border border-gray-700' : 'bg-green-50 border border-green-200'"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                d="M3 12l2-2 4 4 8-8 2 2-10 10L3 12z" />
        </svg>
        <h3 class="text-xl font-semibold mb-2">Kualitas Terjamin</h3>
        <p class="text-gray-600" :class="darkMode ? 'text-gray-300' : ''">
          Bekerja sama dengan brand terpercaya di Indonesia.
        </p>
      </div>

    </div>

  </div>
</section>


  </main>

  <!-- FOOTER -->
  <footer 
    :class="darkMode ? 'bg-gray-900 text-gray-300' : 'bg-gray-100 text-gray-700'"
    class="mt-16 border-t border-gray-200 pt-12"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">

      <!-- Brand -->
      <div>
        <h3 class="text-2xl font-bold text-green-600 mb-3">Wino Bangunan</h3>
        <p class="text-sm leading-relaxed">
          Toko bahan bangunan lengkap untuk semua kebutuhan konstruksi, renovasi, dan perkakas.
        </p>
      </div>

      <!-- Menu -->
      <div>
        <h4 class="text-lg font-semibold mb-3">Menu</h4>
        <ul class="space-y-2 text-sm">
          <li><button @click="page='beranda'" class="hover:text-green-600">Beranda</button></li>
          <li><button @click="page='partner'" class="hover:text-green-600">Partner</button></li>
          <li><button @click="page='kontak'" class="hover:text-green-600">Kontak</button></li>
          <li><button @click="page='tentang kami'" class="hover:text-green-600">Tentang Kami</button></li>
        </ul>
      </div>

      <!-- Kontak -->
      <div>
        <h4 class="text-lg font-semibold mb-3">Kontak</h4>
        <p class="text-sm">Jl. Veteran No.33, Luwu Timur</p>
        <p class="text-sm mt-1">Telepon: (021) 555-6789</p>
        <p class="text-sm mt-1">Email: info@winobangunan.com</p>
        <button 
          @click="openMap()" 
          class="mt-3 inline-block px-4 py-2 rounded-full bg-green-600 text-white hover:bg-green-700 transition text-sm">
          Lihat di Google Maps
        </button>
      </div>

      <!-- Social Media -->
      <div>
        <h4 class="text-lg font-semibold mb-3">Ikuti Kami</h4>
        <div class="flex items-center gap-4">

          <!-- Facebook -->
          <a href="#" class="hover:text-green-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1 .9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.3l-.4 3h-1.9v7A10 10 0 0 0 22 12z"/>
            </svg>
          </a>

          <!-- Instagram -->
          <a href="#" class="hover:text-green-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h10zm-5 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6zm4.8-.9a1.1 1.1 0 1 0 0-2.2 1.1 1.1 0 0 0 0 2.2z"/>
            </svg>
          </a>

          <!-- WhatsApp -->
          <a href="#" class="hover:text-green-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2zm0 2a8 8 0 1 1-4.2 14.7l-.3-.2-3.1.8.8-3-.2-.3A8 8 0 0 1 12 4zm-4 6c.1 2.6 2.3 4.8 4.9 4.9.4 0 .7-.3.8-.6l.6-1.3c.2-.4 0-.7-.3-.9l-1-.5c-.3-.1-.6 0-.8.2l-.2.3c-.2.1-.4.2-.7 0-.7-.4-1.3-1-1.7-1.7-.1-.3-.1-.5.1-.7l.3-.2c.2-.2.3-.5.2-.8l-.5-1c-.2-.3-.5-.5-.9-.3L8.6 8c-.4.1-.6.4-.6.8z"/>
            </svg>
          </a>

        </div>
      </div>

    </div>

    <!-- Bottom -->
    <div 
      class="border-t border-gray-300 mt-10 py-5 text-center text-sm"
      :class="darkMode ? 'border-gray-700' : ''"
    >
      © 2025 Wino Bangunan — 
      <span x-text="language === 'id' ? 'Hak Cipta Dilindungi.' : 'All Rights Reserved.'"></span>
    </div>
  </footer>




    <script>
        window.productsFromDB = @json($products);
    </script>
    
  <!-- Alpine App -->
  <script>
    function winoApp(){
      return {
        page: 'beranda',
        search: '',
        darkMode: false,
        language: 'id',
        mobileMenu: false,
        currentAd: 0,
        ads: [
          'https://source.unsplash.com/1200x400/?construction',
          'https://source.unsplash.com/1200x400/?building,materials',
          'https://source.unsplash.com/1200x400/?hardware,tools'
        ],
        allCategories: [
          { id: 'material', idLabel: 'Material Dasar', enLabel: 'Basic Materials' },
          { id: 'perkakas', idLabel: 'Perkakas', enLabel: 'Tools' },
          { id: 'listrik', idLabel: 'Listrik', enLabel: 'Electrical' },
          { id: 'finishing', idLabel: 'Finishing', enLabel: 'Finishing' }
        ],
        catalog: [],

        init() {
            // KONVERSI DATA DATABASE KE CATALOG
            this.catalog = window.productsFromDB.map(p => {
                // Cocokkan nama kategori database dengan kategori Alpine
                let categoryName = '';
                switch (p.category.toLowerCase()) {
                    case 'material dasar':
                    case 'material':
                        categoryName = this.t('Material Dasar', 'Basic Materials');
                        break;

                    case 'perkakas':
                        categoryName = this.t('Perkakas', 'Tools');
                        break;

                    case 'listrik':
                        categoryName = this.t('Listrik', 'Electrical');
                        break;

                    case 'finishing':
                        categoryName = this.t('Finishing', 'Finishing');
                        break;

                    default:
                        categoryName = p.category;
                }

                return {
                    name: p.name,
                    category: categoryName,
                    price: 'Rp ' + Number(p.price).toLocaleString('id-ID'),
                    stock: p.stock,
                    image: p.image ? '/' + p.image : 'https://via.placeholder.com/400'
                };
            });

            // ROTASI IKLAN
            setInterval(() => {
                this.currentAd = (this.currentAd + 1) % this.ads.length;
            }, 8000);

            // Tutup menu setelah pindah halaman
            this.$watch('page', () => {
                this.mobileMenu = false;
            });
        },


        t(id, en){ return this.language === 'id' ? id : en },

        get categories(){
          const cats = [{ key: 'beranda', label: this.t('Beranda', 'Home') }];
          this.allCategories.forEach(c => cats.push({ key: c.idLabel, label: this.t(c.idLabel, c.enLabel) }));
          cats.push({ key: 'partner', label: this.t('Partner', 'Partner') });
          cats.push({ key: 'kontak', label: this.t('Kontak', 'Contact') });
          cats.push({ key: 'tentang kami', label: this.t('Tentang Kami', 'About Us') });
          return cats;
        },

        toggleDarkMode(){ this.darkMode = !this.darkMode },
        toggleLanguage(){ this.language = this.language === 'id' ? 'en' : 'id' },
        toggleMobileMenu(){ this.mobileMenu = !this.mobileMenu },

        handleCategoryNavigation(catKey){ this.page = catKey; window.scrollTo({ top: 0, behavior: 'smooth' }) },
        handleBackToHome(){ this.page = 'beranda'; window.scrollTo({ top: 0, behavior: 'smooth' }) },

        openMap(){ window.open('https://maps.app.goo.gl/r3GUAqkB2N5X8xw47', '_blank') },

        filteredCatalog(){ const q = this.search.toLowerCase(); return this.catalog.filter(item => item.name.toLowerCase().includes(q)) },

        filteredCatalogByCategory(catId){
          const catObj = this.allCategories.find(c => c.id === catId);
          if(!catObj) return [];
          const catName = this.t(catObj.idLabel, catObj.enLabel);
          const q = this.search.toLowerCase();
          return this.catalog.filter(item => item.category === catName && item.name.toLowerCase().includes(q));
        },

        scrollCarousel(catId, direction){
          const ref = 'carousel-' + catId;
          const node = document.querySelector(`[x-ref=\"${ref}\"]`) || document.querySelector(`[ref=\"carousel-${catId}\"]`) || document.querySelector(`[ref='carousel-${catId}']`);
          // fallback: query by attribute that we set (also check dynamic refs)
          let container = null;
          // search possible containers
          const candidates = Array.from(document.querySelectorAll('[class*="snap-start"]').map(x => x.closest('[class*="snap-x"]'))).filter(Boolean);
          container = candidates.find(c => c && c.querySelector && c.querySelector(`[x-text]`));

          // more reliable: select by scroll container using attribute presence
          const scrollContainers = Array.from(document.querySelectorAll('[class*="snap-x"]'));
          const matched = scrollContainers.find(sc => sc.contains(document.querySelector(`[x-ref='carousel-'+catId]`))); // try to match

          const nodeFinal = scrollContainers.length ? scrollContainers[0] : node;
          if(!nodeFinal) return;
          const amount = Math.round(nodeFinal.offsetWidth * 0.8);
          nodeFinal.scrollBy({ left: direction === 'right' ? amount : -amount, behavior: 'smooth' });
        }
      }
    }
  </script>

</body>
</html>
