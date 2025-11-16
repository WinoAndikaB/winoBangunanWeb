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

    <template x-for="cat in categories" :key="cat.key">
      <button @click="handleCategoryNavigation(cat.key)"
              class="w-full text-left px-2 py-2 rounded-md hover:bg-gray-100"
              :class="darkMode ? 'hover:bg-white/10' : ''">
        <span x-text="cat.label"></span>
      </button>
    </template>

  </div>
</header>

<!-- ========================================================= -->
<!--                DESKTOP NAVBAR                             -->
<!-- ========================================================= -->
<nav class="hidden md:block sticky top-16 z-40 border-b"
     :class="darkMode ? 'bg-gray-900 border-gray-800' : 'bg-white border-gray-100'">

  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-center gap-6 py-3 overflow-x-auto scrollbar-hide text-sm">

      <template x-for="cat in categories" :key="cat.key">
        <button @click="handleCategoryNavigation(cat.key)"
                class="px-2 py-1 whitespace-nowrap"
                :class="page === cat.key ? 'border-b-2 border-green-600 text-green-600' : 'hover:text-green-600'">
          <span x-text="cat.label"></span>
        </button>
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
<section x-show="page === 'tentang kami'" x-cloak class="py-16">

  <div class="grid md:grid-cols-2 gap-10 items-center mb-16">
    <div>
      <h2 class="text-4xl font-extrabold text-green-600 mb-4">Tentang Wino Bangunan</h2>
      <p class="text-gray-500 text-lg">Lebih dari sekadar toko bangunan — kami mitra proyek Anda.</p>
    </div>
    <img src="https://source.unsplash.com/800x600/?construction,store"
         class="rounded-3xl shadow-lg object-cover h-72">
  </div>

  <div class="rounded-3xl p-10 shadow-xl mb-16"
       :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-700'">

    <div class="space-y-6 text-lg leading-relaxed">
      <p>Wino Bangunan adalah toko bangunan terpercaya...</p>
      <p>Kami mengikuti perkembangan teknologi...</p>
      <p>Pelayanan adalah prioritas utama kami...</p>
      <p>Dengan pengalaman bertahun-tahun...</p>
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
