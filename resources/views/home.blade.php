
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Wino Bangunan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- ===================== PRELOADER ===================== -->
<div id="preloader" class="fixed inset-0 z-[999999] flex items-center justify-center bg-white transition-opacity duration-500">
    <div class="flex flex-col items-center gap-4">
        
        <!-- Logo -->
        <img src="{{ asset('images/lightmode-logo2.png') }}"
             class="w-28 animate-pulse" 
             alt="Loading Logo">

        <!-- Loading spinner -->
        <div class="w-10 h-10 border-4 border-green-600 border-t-transparent rounded-full animate-spin"></div>
    </div>
</div>

  <style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
  </style>

<!-- ===================== MODAL PREVIEW — PREMIUM STYLE ===================== -->
<style>
/* ========= OVERLAY ========= */
.tp-overlay {
    background: rgba(0,0,0,.75);
    backdrop-filter: blur(6px);
    animation: fadeIn .25s ease;
}
@keyframes fadeIn { from{opacity:0} to{opacity:1} }

/* ========= MODAL WRAPPER ========= */
.tp-modal {
    width: 100%;
    max-width: 900px;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    animation: scaleIn .28s ease;
}
@keyframes scaleIn {
    from { transform: scale(.94); opacity:0 }
    to   { transform: scale(1); opacity:1 }
}

/* ========= LEFT IMAGE AREA ========= */
.tp-image-box{
    background: #f3f3f3;
    display:flex;
    align-items:center;
    justify-content:center;
    height:420px;
    position:relative;
}
.tp-image-box img{
    max-width:100%;
    max-height:100%;
    transition: transform .3s ease;
    cursor: grab;
}

/* ========= RIGHT INFO AREA ========= */
.tp-info {
    padding: 22px;
}
.tp-title {
    font-size: 22px;
    font-weight: 700;
}
.tp-price {
    font-size: 26px;
    font-weight: 700;
    color:#03ac0e;
    margin-top:6px;
}
.tp-info-list {
    margin-top:14px;
    font-size:14px;
}
.tp-info-row {
    display:flex;
    justify-content:space-between;
    padding:6px 0;
    border-bottom:1px solid #eee;
}

/* ========= THUMBNAIL BAR ========= */
.tp-thumbs img {
    transition: 
        transform .25s ease,
        opacity .25s ease,
        box-shadow .25s ease,
        border .25s ease;
}

.tp-thumbs img:hover {
    transform: scale(1.08) translateY(-2px);
}

.tp-thumbs img.active {
    transform: scale(1.12);
    border-color: #03ac0e !important;
    box-shadow: 
        0 0 0 2px rgba(3,172,14,0.3),
        0 8px 16px rgba(0,0,0,0.25);
    opacity: 1;
}

/* Animasi kecil saat aktif berpindah */
@keyframes thumbPop {
    0%   { transform: scale(1); }
    50%  { transform: scale(1.18); }
    100% { transform: scale(1.12); }
}

.tp-thumbs img.thumb-animate {
    animation: thumbPop .2s ease;
}


/* ========= NAV BUTTONS ========= */
.tp-nav-btn {
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    width:42px;
    height:42px;
    border-radius:50%;
    background:rgba(255,255,255,0.85);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:26px;
    cursor:pointer;
    box-shadow:0 2px 10px rgba(0,0,0,0.2);
    transition:.25s;
}
.tp-nav-btn:hover { background:white; }

.tp-prev { left:15px; }
.tp-next { right:15px; }

/* Close Btn */
.tp-close {
    position:absolute;
    top:15px;
    right:15px;
    width:40px;
    height:40px;
    background:white;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 2px 10px rgba(0,0,0,0.25);
    cursor:pointer;
    font-size:20px;
}

/* ===================== CLOSE BUTTON ANIMATION ===================== */

/* Soft idle pulse (tiap 4 detik) */
@keyframes softPulse {
    0%   { transform: scale(1); }
    50%  { transform: scale(1.06); }
    100% { transform: scale(1); }
}

.animate-close-btn {
    animation: softPulse 4s ease-in-out infinite;
}

/* Hover effect - smooth enlarge */
.animate-close-btn:hover {
    transform: scale(1.12);
}

/* Press effect - quick compress */
.animate-close-btn:active {
    transform: scale(0.88);
}

/* ===================== NAV BUTTON ANIMATION ===================== */

/* Soft idle pulse */
@keyframes navPulse {
    0%   { transform: translateY(-50%) scale(1); }
    50%  { transform: translateY(-50%) scale(1.06); }
    100% { transform: translateY(-50%) scale(1); }
}

.tp-nav-btn {
    animation: navPulse 4s ease-in-out infinite;
    transition: transform .15s ease, background .25s ease;
}

/* Hover - enlarge */
.tp-nav-btn:hover {
    transform: translateY(-50%) scale(1.15);
}

/* Click - compress */
.tp-nav-btn:active {
    transform: translateY(-50%) scale(0.85);
}

/* ===================== DARK MODE FIX ===================== */

/* BASIC BACKGROUND & TEXT */
body.bg-gray-900 {
    background: #0d0d0d !important;      /* ChatGPT black */
    color: #ececec !important;           /* ChatGPT soft white */
}

/* Universal border smoothing */
body.bg-gray-900 * {
    border-color: #2a2a2a !important;
    scroll-behavior: smooth;
}

/* ========================= HEADER ========================= */
body.bg-gray-900 header {
    background: #0d0d0d !important;
    border-bottom: 1px solid #2a2a2a !important;
}

body.bg-gray-900 header button:hover {
    background: #1c1c1c !important;
}

/* ========================= SEARCH ========================= */
body.bg-gray-900 input[type="search"] {
    background: #1a1a1a !important;
    color: #ececec !important;
    border-color: #2a2a2a !important;
}
body.bg-gray-900 input[type="search"]::placeholder {
    color: #777 !important;
}

/* ========================= NAVBAR ========================= */
body.bg-gray-900 nav {
    background: #0d0d0d !important;
    border-bottom: 1px solid #2a2a2a !important;
}

body.bg-gray-900 nav button {
    color: #dcdcdc !important;
}
body.bg-gray-900 nav button:hover {
    background: #1d1d1d !important;
    color: #00ff90 !important; /* ChatGPT green-ish accent */
}

/* ========================= CARDS / PANELS ========================= */
body.bg-gray-900 .rounded-xl,
body.bg-gray-900 .rounded-lg,
body.bg-gray-900 .rounded-2xl,
body.bg-gray-900 .shadow,
body.bg-gray-900 .shadow-md {
    background: #1a1a1a !important;      /* ChatGPT panel */
    border-color: #2a2a2a !important;
    color: #ececec !important;
}

body.bg-gray-900 .rounded-xl:hover,
body.bg-gray-900 .rounded-lg:hover {
    background: #222 !important;          /* smooth hover */
}

/* ========================= PRODUCT CARDS ========================= */
body.bg-gray-900 article {
    background: #1a1a1a !important;
    border-color: #2a2a2a !important;
    color: #ececec !important;
}

body.bg-gray-900 article:hover {
    background: #232323 !important;
}

body.bg-gray-900 article p {
    color: #a8a8a8 !important;
}

/* ========================= KONTAK, PARTNER, TENTANG ========================= */
body.bg-gray-900 .bg-gray-50,
body.bg-gray-900 .contact-box,
body.bg-gray-900 .partner-card {
    background: #1a1a1a !important;
    color: #ececec !important;
}

/* ========================= FOOTER ========================= */
body.bg-gray-900 footer {
    background: #0d0d0d !important;
    color: #dcdcdc !important;
}

body.bg-gray-900 footer .border-t {
    border-color: #2a2a2a !important;
}

body.bg-gray-900 footer a:hover {
    color: #2df59d !important; /* ChatGPT-style glow green */
}

/* ========================= BUTTONS ========================= */
body.bg-gray-900 button {
    background: #1a1a1a !important;
    color: #ececec !important;
    border-color: #2a2a2a !important;
}
body.bg-gray-900 button:hover {
    background: #262626 !important;
}

/* Green CTA tetap */
body.bg-gray-900 .bg-green-600 {
    background: #01a56b !important; /* ChatGPT green */
}
body.bg-gray-900 .bg-green-600:hover {
    background: #00c47f !important;
}

/* ========================= MODAL (PREVIEW) ========================= */
body.bg-gray-900 .tp-modal {
    background: #1a1a1a !important;
    color: #ececec !important;
}

body.bg-gray-900 .tp-image-box {
    background: #161616 !important;
}

body.bg-gray-900 .tp-info {
    background: #1a1a1a !important;
}

body.bg-gray-900 .tp-thumbs {
    border-color: #2a2a2a !important;
}

body.bg-gray-900 .tp-close {
    background: #1f1f1f !important;
    color: #ececec !important;
}
body.bg-gray-900 .tp-close:hover {
    background: #2b2b2b !important;
}

body.bg-gray-900 .tp-nav-btn {
    background: rgba(255,255,255,0.1) !important;
    color: #fff !important;
}
body.bg-gray-900 .tp-nav-btn:hover {
    background: rgba(255,255,255,0.18) !important;
}

/* ========================= SCROLLBAR LIKE CHATGPT ========================= */
body.bg-gray-900 ::-webkit-scrollbar {
    width: 8px;
}
body.bg-gray-900 ::-webkit-scrollbar-track {
    background: #111;
}
body.bg-gray-900 ::-webkit-scrollbar-thumb {
    background: #333;
    border-radius: 4px;
}
body.bg-gray-900 ::-webkit-scrollbar-thumb:hover {
    background: #444;
}

.tp-image-box img {
    transition: transform 0.15s ease, transform-origin 0.1s ease;
    cursor: zoom-in;
}
.tp-image-box.zoom-active img {
    cursor: zoom-out;
}

/* MAGNIFIER LENS */
.magnifier-lens {
    position: absolute;
    width: 160px;
    height: 160px;
    border-radius: 50%;
    pointer-events: none;
    border: 2px solid rgba(0,0,0,.2);
    box-shadow: 0 8px 25px rgba(0,0,0,.25);
    background-repeat: no-repeat;
    display: none;
    z-index: 20;
}

/* Animasi gambar utama */
.tp-main-image {
    transition: transform .25s ease, opacity .25s ease;
}

.tp-main-image.fade-out-left {
    transform: translateX(-40px) scale(0.95);
    opacity: 0;
}

.tp-main-image.fade-out-right {
    transform: translateX(40px) scale(0.95);
    opacity: 0;
}

.tp-main-image.fade-in {
    transform: translateX(0) scale(1);
    opacity: 1;
}


</style>
</head>

<body x-data="winoApp()" :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

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

          <!-- Input -->
          <input 
            type="search" 
            x-model="search"
            placeholder="Cari produk..."
            class="w-full rounded-full border shadow-sm py-2.5 pl-12 pr-4 text-sm transition
                  focus:ring-2 focus:ring-green-500/40 focus:border-green-500
                  dark:focus:ring-green-400/30"
            :class="darkMode 
              ? 'bg-gray-800 border-gray-700 text-gray-100 placeholder-gray-400' 
              : 'bg-white placeholder-gray-400 border-gray-300'"
          >

          <!-- Icon -->
          <div 
            class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none
                  transition-all"
            :class="darkMode ? 'text-gray-400' : 'text-gray-500'">
            <svg 
              class="w-5 h-5"
              fill="none" 
              stroke="currentColor" 
              stroke-width="2"
            >
              <circle cx="11" cy="11" r="7" />
              <line x1="17" y1="17" x2="21" y2="21" stroke-linecap="round" />
            </svg>
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
        class="w-full text-left px-3 py-2 rounded-lg transition-all"
        :class="page === cat.key
            ? 'bg-orange-500 text-white shadow-md scale-[1.02]' 
            : (darkMode ? 'hover:bg-white/10' : 'hover:bg-orange-50')"
          <span x-text="cat.label"></span>
        </button>

        <!-- PEMBATAS -->
        <template x-if="i === 0 || i === 1 || i === 5">
          <div class="border-t my-3" :class="darkMode ? 'border-gray-700' : 'border-gray-300'"></div>
        </template>

      </div>
    </template>

  </div>

</header>

<!-- ========================================================= -->
<!--                DESKTOP NAVBAR                             -->
<!-- ========================================================= -->
<nav class="hidden md:block sticky top-16 z-40 border-b"
     :class="darkMode ? 'bg-gray-900 border-gray-800' : 'bg-white border-gray-100'">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="flex justify-center py-3">
      <div id="navbar-kategori"
        class="flex items-center gap-6 overflow-x-auto scrollbar-hide text-sm cursor-grab select-none whitespace-nowrap">

        <template x-for="(cat, i) in categories" :key="cat.key">
          <div class="flex items-center gap-6">

            <button 
              @click="handleCategoryNavigation(cat.key)"
              class="pb-1 transition-all duration-200 border-b-2"
              :class="page === cat.key 
                ? (darkMode 
                    ? 'text-orange-400 border-orange-400' 
                    : 'text-orange-600 border-orange-500')
                : (darkMode
                    ? 'text-gray-300 border-transparent hover:text-orange-300 hover:border-orange-300'
                    : 'text-gray-700 border-transparent hover:text-orange-500 hover:border-orange-400')
              ">
              <span x-text="cat.label"></span>
            </button>

            <!-- Garis pembatas -->
            <template x-if="i === 0 || i === 1 || i === 5">
              <div class="w-px h-5 mx-2"
                   :class="darkMode ? 'bg-gray-700' : 'bg-gray-300'"></div>
            </template>

          </div>
        </template>

      </div>
    </div>

  </div>
</nav>


<!-- ========================================================= -->
<!--                        MAIN                               -->
<!-- ========================================================= -->
<main class="w-full flex justify-center">
  <div class="max-w-7xl w-full px-4 sm:px-6 lg:px-8 py-8">

    <!-- ===================== BERANDA ===================== -->
    <section x-show="page === 'beranda'" x-cloak class="space-y-12">

<!-- Hero Slider -->
<div class="relative w-full overflow-hidden rounded-2xl shadow-md">
    <img 
        src="{{ asset('images/banners.png') }}"
        class="w-full object-cover max-h-[45vh] md:max-h-[55vh] lg:max-h-[60vh]"
        alt="Hero Banner"
    >
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
                         @click="openPreview(item.image)"
                         class="w-full h-full object-cover transition hover:scale-105 duration-500 cursor-pointer">
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

    <!-- ===================== HALAMAN KATEGORI ===================== -->
    <section x-show="page === 'kategori'" x-cloak class="space-y-10">

      <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-green-600">Semua Kategori</h2>
        <button @click="handleBackToHome()"
                class="text-sm px-4 py-2 border rounded-full hover:bg-green-50"
                :class="darkMode ? 'bg-gray-800 border-gray-700 hover:bg-gray-700' : ''">
          Kembali
        </button>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        <template x-for="cat in allCategories" :key="cat.id">
          <div @click="handleCategoryNavigation(cat.idLabel)"
               class="p-6 border rounded-2xl shadow cursor-pointer transition-all duration-200"
              :class="page === cat.idLabel
                  ? 'bg-orange-500 text-white shadow-lg scale-[1.03]'
                  : (darkMode ? 'bg-gray-800 border-gray-700 hover:bg-gray-700' : 'bg-white hover:bg-green-50')"

            
            <h3 class="text-lg font-semibold text-green-600" x-text="cat.idLabel"></h3>
            <p class="text-sm text-gray-500 mt-1">Klik untuk melihat produk</p>

          </div>
        </template>

      </div>

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

              <img :src="item.image" :alt="item.name"
                   @click="openPreview(item.image)"
                   class="w-full h-40 object-cover rounded-md cursor-pointer" draggable="false">

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
          {name:'Avian', src:'https://upload.wikimedia.org/wikipedia/id/9/9b/Avian_Brands_logo.svg'},
          {name:'Dulux', src:'https://down-id.img.susercontent.com/file/id-11134216-7r98r-lnb4lxxjkia13f'},
          {name:'Nippon Paint', src:'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0KyAqRytRc0T_v7d6AQD_6xBD0I5OlQ6dRA&s'}
        ]" :key="logo.name">
          <div class="p-5 border rounded-xl shadow-sm hover:shadow-md transition"
               :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white'">
            <img :src="logo.src" class="w-full h-20 object-contain" draggable="false">
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

      <div
        class="grid md:grid-cols-2 rounded-3xl shadow-xl overflow-hidden"
        :class="darkMode ? 'bg-gray-800 text-gray-100' : 'bg-white'"
      >
        <!-- INFO KONTAK -->
        <div class="p-10 bg-gradient-to-br from-green-600 to-green-500 text-white">
          <h3 class="text-2xl font-semibold mb-6">Wino Bangunan</h3>

          <div class="space-y-6">
            <!-- Alamat -->
            <div class="flex gap-4">
              <svg class="w-7 h-7" fill="none" stroke="white">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1.5"
                  d="M12 21s-6-4.35-6-10a6 6 0 1112 0c0 5.65-6 10-6 10z"
                />
              </svg>
              <p>Jl. Veteran No.33, Langkae Araya, Kec. Towuti, Kabupaten Luwu Timur, Sulawesi Selatan 92982</p>
            </div>

            <!-- Telepon -->
            <div class="flex gap-4">
              <svg class="w-7 h-7" fill="none" stroke="white">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1.5"
                  d="M3 5a2 2 0 012-2h1.3c.4 0 .8.26 1 .66l1.2 3-.3 1.1-1.4 1.4a14 14 0 006.2 6.2l1.4-1.4 1.1-.3 3 1.2c.4.2.7.6.7 1V19a2 2 0 01-2 2H17C9 21 3 15 3 7V7a2 2 0 012-2z"
                />
              </svg>
              <p>Telepon: (021) 555-6789</p>
            </div>

            <!-- Email -->
            <div class="flex gap-4">
              <svg class="w-7 h-7" fill="none" stroke="white">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1.5"
                  d="M3 8l7.9 5.3a2 2 0 002.2 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                />
              </svg>
              <p>info@winobangunan.com</p>
            </div>

            <!-- SOSIAL MEDIA -->
            <div class="pt-6">
              <h4 class="text-lg font-semibold mb-3 text-white">Sosial Media</h4>

              <div class="flex items-center gap-4">
                <!-- Instagram -->
                <a
                  href="https://instagram.com/"
                  target="_blank"
                  class="p-3 rounded-full bg-white/20 hover:bg-white/30 transition"
                >
                  <svg
                    class="w-6 h-6 text-white"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24"
                  >
                    <path d="M7 3h10a4 4 0 014 4v10a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4z" />
                    <circle cx="12" cy="12" r="3.3" />
                    <circle cx="17" cy="7" r="1" />
                  </svg>
                </a>

                <!-- WhatsApp -->
                <a
                  href="https://wa.me/6281234567890"
                  target="_blank"
                  class="p-3 rounded-full bg-white/20 hover:bg-white/30 transition"
                >
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path
                      d="M12 2A10 10 0 0 0 2 12a9.93 9.93 0 0 0 1.47 5.25L2 22l4.88-1.43A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.25-1.23l-.3-.17-2.9.85.88-2.82-.18-.29A8 8 0 1 1 12 20zm4.2-5.7c-.23-.12-1.35-.67-1.56-.75s-.36-.12-.51.12-.59.75-.73.9-.27.18-.49.06a6.52 6.52 0 0 1-1.9-1.17 7.1 7.1 0 0 1-1.31-1.64c-.14-.24 0-.37.1-.49.1-.1.24-.27.37-.41s.16-.24.25-.41a.44.44 0 0 0 0-.43c-.07-.12-.51-1.26-.7-1.72-.19-.45-.38-.39-.51-.39h-.44a.86.86 0 0 0-.62.29A2.58 2.58 0 0 0 6 9.4 4.49 4.49 0 0 0 6.9 12a10 10 0 0 0 3.69 3.53 11.83 11.83 0 0 0 1.71.63 4.1 4.1 0 0 0 1.88.12 3.08 3.08 0 0 0 2.08-1.48 2.51 2.51 0 0 0 .17-1.48c-.05-.07-.2-.12-.43-.24"
                    />
                  </svg>
                </a>

                <!-- Facebook -->
                <a
                  href="https://facebook.com/"
                  target="_blank"
                  class="p-3 rounded-full bg-white/20 hover:bg-white/30 transition"
                >
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path
                      d="M22 12.07C22 6.48 17.52 2 11.93 2S1.86 6.48 1.86 12.07c0 4.99 3.66 9.13 8.44 9.93v-7.03H7.9v-2.9h2.4V9.41c0-2.38 1.42-3.7 3.6-3.7 1.04 0 2.12.18 2.12.18v2.33h-1.2c-1.18 0-1.55.74-1.55 1.49v1.78h2.64l-.42 2.9h-2.22v7.03c4.78-.8 8.44-4.94 8.44-9.93z"
                    />
                  </svg>
                </a>

                <!-- TikTok -->
                <a
                  href="https://tiktok.com/"
                  target="_blank"
                  class="p-3 rounded-full bg-white/20 hover:bg-white/30 transition"
                >
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path
                      d="M12.7 2h2.4a5.9 5.9 0 0 0 5.9 5.9v2.4a8.3 8.3 0 0 1-4.7-1.5v7.6A5.6 5.6 0 1 1 10 10a5.5 5.5 0 0 1 2.7.7v2.8a2.8 2.8 0 1 0 1.7 2.5V2z"
                    />
                  </svg>
                </a>
              </div>
            </div>
          </div>

        </div>

        <!-- MAPS -->
        <div
          class="p-10 flex flex-col justify-center"
          :class="darkMode ? 'bg-gray-900' : 'bg-gray-50'"
        >
          <h3 class="text-xl font-semibold mb-4">Lokasi Kami</h3>
          <p class="text-gray-500 mb-6">Klik tombol untuk melihat lokasi kami di Google Maps.</p>

          <button
            @click="openMap()"
            class="px-6 py-3 rounded-full bg-green-600 text-white hover:bg-green-700"
          >
            Lihat di Google Maps
          </button>
        </div>
      </div>
    </section>

    <!-- ===================== TENTANG KAMI ===================== -->
    <section x-show="page === 'tentang kami'" x-cloak class="py-20">
      <!-- HEADER -->
      <div class="text-center mb-16 space-y-3">
        <h2
          class="text-4xl font-extrabold"
          :class="darkMode ? 'text-green-400' : 'text-green-600'"
        >
          Tentang Kami
        </h2>
        <p :class="darkMode ? 'text-gray-300' : 'text-gray-600'">
          Wino Bangunan selalu berkomitmen menyediakan bahan bangunan berkualitas.
        </p>
      </div>

      <!-- GRID INTRO -->
      <div class="grid md:grid-cols-2 gap-14 items-center mb-16">
        <div class="space-y-5">
          <h3
            class="text-3xl font-bold"
            :class="darkMode ? 'text-gray-100' : 'text-gray-900'"
          >
            Siapa Kami?
          </h3>

          <p :class="darkMode ? 'text-gray-300' : 'text-gray-600'">
            Dengan pengalaman lebih dari 15 tahun, Wino Bangunan terus berkembang mengikuti kebutuhan pelanggan.
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
        <div
          class="p-8 rounded-3xl shadow-md transition hover:shadow-lg"
          :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-700'"
        >
          <h4
            class="font-bold text-xl mb-2"
            :class="darkMode ? 'text-green-400' : 'text-green-600'"
          >
            Produk Terlengkap
          </h4>
          <p>Kami menyediakan berbagai pilihan bahan bangunan untuk segala kebutuhan proyek.</p>
        </div>

        <div
          class="p-8 rounded-3xl shadow-md transition hover:shadow-lg"
          :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-700'"
        >
          <h4
            class="font-bold text-xl mb-2"
            :class="darkMode ? 'text-green-400' : 'text-green-600'"
          >
            Pelayanan Cepat
          </h4>
          <p>Didukung tim berpengalaman untuk memastikan pelanggan mendapat layanan terbaik.</p>
        </div>

        <div
          class="p-8 rounded-3xl shadow-md transition hover:shadow-lg"
          :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-700'"
        >
          <h4
            class="font-bold text-xl mb-2"
            :class="darkMode ? 'text-green-400' : 'text-green-600'"
          >
            Harga Kompetitif
          </h4>
          <p>Harga yang transparan dan sesuai untuk kebutuhan semua pelanggan.</p>
        </div>
      </div>
    </section>

  </div> <!-- END container -->
</main>

<!-- ===================== FOOTER ===================== -->
<footer
    class="mt-20 border-t pt-14 shadow-inner"
    :class="darkMode ? 'bg-gray-900 text-gray-300' : 'bg-white text-gray-700'"
>
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
        
        <div class="grid md:grid-cols-4 gap-12 py-10">
            
            <!-- BRAND -->
            <div>
                <h3 class="text-2xl font-bold text-green-600 mb-4">Wino Bangunan</h3>
                <p class="opacity-80">Toko bahan bangunan lengkap.</p>
                <p class="text-xs opacity-50 mt-3">Sejak 2008 — Layanan terbaik.</p>
            </div>

            <!-- MENU -->
            <div>
                <h4 class="font-semibold text-lg mb-4">Menu</h4>
                <ul class="space-y-2">
                    <li><button @click="page='beranda'">Beranda</button></li>
                    <li><button @click="page='partner'">Partner</button></li>
                    <li><button @click="page='kontak'">Kontak</button></li>
                    <li><button @click="page='tentang kami'">Tentang Kami</button></li>
                </ul>
            </div>

            <!-- KONTAK -->
            <div>
                <h4 class="font-semibold text-lg mb-4">Kontak</h4>
                <p><b>Alamat:</b> Jl. Veteran No.33, Langkae Araya, Kec. Towuti, Kabupaten Luwu Timur, Sulawesi Selatan 92982</p>
                <p><b>Telepon:</b>  (021) 555-6789</p>
                <p><b>Email:</b>  info@winobangunan.com</p>
            </div>

            <!-- SOSIAL MEDIA -->
            <div>
                <h4 class="font-semibold text-lg mb-4">Sosial Media</h4>
                <div class="flex items-center gap-4">

                    <!-- Facebook -->
                    <a
                        href="https://facebook.com/"
                        target="_blank"
                        class="p-3 rounded-full border transition hover:scale-110"
                        :class="darkMode ? 'border-gray-700 hover:bg-gray-800' : 'border-gray-300 hover:bg-gray-100'"
                    >
                        <svg class="w-6 h-6" :class="darkMode ? 'text-white' : 'text-gray-700'" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12.07C22 6.48 17.52 2 11.93 2S1.86 6.48 1.86 12.07c0 4.99 3.66 9.13 8.44 9.93v-7.03H7.9v-2.9h2.4V9.41c0-2.38 1.42-3.7 3.6-3.7 1.04 0 2.12.18 2.12.18v2.33h-1.2c-1.18 0-1.55.74-1.55 1.49v1.78h2.64l-.42 2.9h-2.22v7.03c4.78-.8 8.44-4.94 8.44-9.93z"/></svg>
                    </a>

                    <!-- Instagram -->
                    <a
                        href="https://instagram.com/"
                        target="_blank"
                        class="p-3 rounded-full border transition hover:scale-110"
                        :class="darkMode ? 'border-gray-700 hover:bg-gray-800' : 'border-gray-300 hover:bg-gray-100'"
                    >
                        <svg class="w-6 h-6" :class="darkMode ? 'text-white' : 'text-gray-700'" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M7 3h10a4 4 0 014 4v10a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4z"/><circle cx="12" cy="12" r="3.3"/><circle cx="17" cy="7" r="1"/></svg>
                    </a>

                    <!-- WhatsApp -->
                    <a
                        href="https://wa.me/6281234567890"
                        target="_blank"
                        class="p-3 rounded-full border transition hover:scale-110"
                        :class="darkMode ? 'border-gray-700 hover:bg-gray-800' : 'border-gray-300 hover:bg-gray-100'"
                    >
                        <svg class="w-6 h-6" :class="darkMode ? 'text-white' : 'text-gray-700'" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2A10 10 0 0 0 2 12a9.93 9.93 0 0 0 1.47 5.25L2 22l4.88-1.43A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.25-1.23l-.3-.17-2.9.85.88-2.82-.18-.29A8 8 0 1 1 12 20zm4.2-5.7c-.23-.12-1.35-.67-1.56-.75s-.36-.12-.51.12-.59.75-.73.9-.27.18-.49.06a6.52 6.52 0 0 1-1.9-1.17 7.1 7.1 0 0 1-1.31-1.64c-.14-.24 0-.37.1-.49.1-.1.24-.27.37-.41s.16-.24.25-.41a.44.44 0 0 0 0-.43c-.07-.12-.51-1.26-.7-1.72-.19-.45-.38-.39-.51-.39h-.44a.86.86 0 0 0-.62.29A2.58 2.58 0 0 0 6 9.4 4.49 4.49 0 0 0 6.9 12a10 10 0 0 0 3.69 3.53 11.83 11.83 0 0 0 1.71.63 4.1 4.1 0 0 0 1.88.12 3.08 3.08 0 0 0 2.08-1.48 2.51 2.51 0 0 0 .17-1.48c-.05-.07-.2-.12-.43-.24"/></svg>
                    </a>

                    <!-- TikTok -->
                    <a
                        href="https://tiktok.com/"
                        target="_blank"
                        class="p-3 rounded-full border transition hover:scale-110"
                        :class="darkMode ? 'border-gray-700 hover:bg-gray-800' : 'border-gray-300 hover:bg-gray-100'"
                    >
                        <svg class="w-6 h-6" :class="darkMode ? 'text-white' : 'text-gray-700'" fill="currentColor" viewBox="0 0 24 24"><path d="M12.7 2h2.4a5.9 5.9 0 0 0 5.9 5.9v2.4a8.3 8.3 0 0 1-4.7-1.5v7.6A5.6 5.6 0 1 1 10 10a5.5 5.5 0 0 1 2.7.7v2.8a2.8 2.8 0 1 0 1.7 2.5V2z"/></svg>
                    </a>

                </div>
            </div>
        </div>

        <div
            class="text-center py-6 border-t opacity-70 mt-6"
            :class="darkMode ? 'border-gray-700' : 'border-gray-300'">
            © 2025 Wino Bangunan — All Rights Reserved.
        </div>

    </div>
</footer>

        <!-- ===================== MODAL PREVIEW ===================== -->
<div 
    x-show="showPreview"
    class="fixed inset-0 z-[9999] flex items-center justify-center p-4 tp-overlay"
    :class="darkMode ? 'bg-black/70' : 'bg-black/40'"
    @click.self="closePreview()"
    x-cloak>

    <!-- MODAL WRAPPER -->
    <div 
        class="tp-modal relative grid grid-cols-1 md:grid-cols-2"
        :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-white text-gray-900'"
    >

    <!-- ✅ LOGO MODAL -->
    <div 
        class="hidden md:flex absolute bottom-4 right-4 z-40 
              bg-white/80 backdrop-blur px-3 py-1.5 
              rounded-lg shadow-md"
        :class="darkMode ? 'bg-black/40' : 'bg-white/80'"
    >
        <img 
            src="{{ asset('images/lightmode-logo2.png') }}"
            alt="Logo"
            class="h-7 md:h-9 select-none"
            draggable="false"
        >
    </div>

        <!-- CLOSE BUTTON -->
        <button 
            @click="closePreview()"
            class="absolute top-3 right-3 z-30 w-10 h-10 rounded-full shadow-md 
                   flex items-center justify-center text-xl font-bold transition animate-close-btn"
            :class="darkMode 
                ? 'bg-gray-800 text-white hover:bg-gray-700' 
                : 'bg-white text-black hover:bg-gray-200'"
        >
            ✕
        </button>

        <!-- LEFT SIDE -->
        <div class="flex flex-col items-center p-3 w-full">

            <!-- IMAGE BOX -->
            <div 
                class="tp-image-box w-full relative overflow-hidden rounded-xl"
                :class="darkMode ? 'bg-gray-800' : 'bg-gray-100'"
            >

                <!-- LOGO MOBILE (pojok kiri atas dalam gambar) -->
                <div class="absolute top-3 left-3 z-30 md:hidden">
                    <img 
                        src="{{ asset('images/lightmode-logo2.png') }}"
                        alt="Logo"
                        class="h-7 drop-shadow-md select-none"
                        draggable="false"
                    >
                </div>

                <!-- GAMBAR PRODUK -->
                <img 
                  :src="previewImage"
                  class="select-none tp-main-image"
                  draggable="false"
                  @mouseenter="startHoverZoom($event)"
                  @mousemove="handleMouseMove($event)"
                  @mouseleave="stopHoverZoom()"
                  :style="`
                      transform: translate(${panX}px, ${panY}px) scale(${zoom});
                      transform-origin: ${originX}% ${originY}%;
                      transition: transform 0.15s ease;
                  `"
                />

                <div 
                  class="magnifier-lens"
                  x-ref="magnifier"
                ></div>

                <!-- PREV BUTTON -->
                <div 
                    class="tp-nav-btn tp-prev"
                    @click="showPrevImage()"
                    :class="darkMode 
                        ? 'bg-white/10 text-white' 
                        : 'bg-white text-gray-800'"
                >‹</div>

                <!-- NEXT BUTTON -->
                <div 
                    class="tp-nav-btn tp-next"
                    @click="showNextImage()"
                    :class="darkMode 
                        ? 'bg-white/10 text-white' 
                        : 'bg-white text-gray-800'"
                >›</div>

            </div>


            <!-- THUMB STRIP -->
            <div 
                class="tp-thumbs w-full flex gap-3 overflow-x-auto scrollbar-hide py-3 mt-3 border-t"
                :class="darkMode ? 'border-gray-700' : 'border-gray-300'"
            >
                <template x-for="(it, i) in previewItems" :key="i">
                    <img 
                        :src="it.image"
                        @click="jumpToImage(i)"
                        class="w-16 h-16 object-cover rounded-md cursor-pointer border select-none"
                        :class="currentIndex === i 
                            ? 'border-green-500 shadow-md' 
                            : 'border-gray-400 opacity-70 hover:opacity-100'"
                    >
                </template>
            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div 
            class="tp-info overflow-y-auto max-h-[420px]"
            :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-white text-gray-900'"
        >
            <h3 class="tp-kategori text-green-600 font-semibold" x-text="previewCategory"></h3>
            <h2 class="tp-title" x-text="previewName"></h2>
            <div class="tp-price" x-text="previewPrice"></div>

            <div class="tp-info-list">
                <div class="tp-info-row">
                    <span>ID Produk</span><span x-text="previewId"></span>
                </div>
                <div class="tp-info-row">
                    <span>Stok</span><span x-text="previewStock"></span>
                </div>
                <div class="tp-info-row">
                    <span>Tanggal Upload</span><span x-text="previewDate"></span>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- ================= PREVIEW WRAPPER (ZOOM AREA) ================= -->
<div 
    class="preview-wrapper"
    :class="darkMode ? 'bg-white/5 border-white/10' : 'bg-black/5 border-black/20'"
>
    <img 
        :src="previewImage"
        class="preview-img"
        draggable="false"
        :style="`
            transform: translate(${panX}px, ${panY}px) scale(${zoom});
        `"
    >
</div>

<!-- NAV DESKTOP -->
<button 
    @click="showPrevImage()"
    class="hidden md:flex modal-nav-btn absolute left-8 top-1/2 -translate-y-1/2 rounded-full items-center justify-center shadow-md"
    :class="darkMode 
        ? 'bg-white/10 border-white/20 text-white' 
        : 'bg-black/10 border-black/20 text-black'"
>
    ‹
</button>

<button 
    @click="showNextImage()"
    class="hidden md:flex modal-nav-btn absolute right-8 top-1/2 -translate-y-1/2 rounded-full items-center justify-center shadow-md"
    :class="darkMode 
        ? 'bg-white/10 border-white/20 text-white' 
        : 'bg-black/10 border-black/20 text-black'"
>
    ›
</button>

<!-- MOBILE NAV -->
<div class="md:hidden flex justify-between items-center w-full mt-4 px-3">
    <button 
        @click="showPrevImage()" 
        class="modal-nav-btn rounded-full"
        :class="darkMode ? 'bg-white/20 text-white' : 'bg-black/20 text-black'"
    >‹</button>

    <div 
        class="modal-title-mobile px-4 py-1 rounded-full backdrop-blur-xl"
        :class="darkMode ? 'bg-white/10 text-white' : 'bg-black/40 text-white'"
    >
        <span x-text="previewName"></span>
    </div>

    <button 
        @click="showNextImage()" 
        class="modal-nav-btn rounded-full"
        :class="darkMode ? 'bg-white/20 text-white' : 'bg-black/20 text-black'"
    >›</button>
</div>

<!-- BOTTOM THUMBS -->
<div 
    class="preview-thumbs flex gap-3 mt-5 overflow-x-auto px-3 pb-3 scrollbar-hide whitespace-nowrap"
>
    <template x-for="(it, i) in previewItems" :key="i">
        <img 
            :src="it.image"
            @click="jumpToImage(i)"
            class="w-16 h-16 object-cover cursor-pointer select-none rounded-md border"
            :class="currentIndex === i 
                ? 'border-green-500 shadow-md' 
                : (darkMode ? 'border-gray-600' : 'border-gray-300')"
        >
    </template>
</div>

<!-- ===================== ALPINE JS APP (lengkap) ===================== -->
<script>
function winoApp(){
  return {
    page: 'beranda',
    search: '',
    darkMode: false,
    mobileMenu: false,
    currentAd: 0,

    // preview / lightbox state
    showPreview: false,
    previewItems: [], // array of product objects for the preview (same shape as catalog elements)
    currentIndex: 0,
    previewImage: null,
    previewCategory: "",
    previewName: "",
    previewPrice: "",
    previewStock: "",
    previewId: "",
    previewDate: "",

    // zoom & pan
    zoom: 1,
    isPanning: false,
    panX: 0,
    panY: 0,
    startX: 0,
    startY: 0,

    originX: 50,
    originY: 50,
    hoverZoom: false,
    targetOriginX: 50,
    targetOriginY: 50,
    smoothSpeed: 0.12,
    frameRunning: false,


    ads: [
      "https://source.unsplash.com/1200x400/?construction",
      "https://source.unsplash.com/1200x400/?building,materials",
      "https://source.unsplash.com/1200x400/?hardware,tools"
    ],

    allCategories: [],
    catalog: [],

    init(){
      // map categories (from $categories)
      this.allCategories = (window.categoriesFromDB || []).map(cat => ({
        id: cat.toLowerCase().replace(/\s+/g, "-"),
        idLabel: cat
      }));

      // map products (from $products)
      this.catalog = (window.productsFromDB || []).map(p => ({
          id: p.id,
          name: p.name,
          category: p.category,
          price: "Rp " + Number(p.price).toLocaleString("id-ID"),
          stock: p.stock,
          date: p.created_at ? new Date(p.created_at).toLocaleDateString("id-ID") : "-",
          image: p.image ? (p.image.startsWith('/') ? p.image : '/' + p.image) : "https://via.placeholder.com/400"
      }));

      // autoplay ads if desired
      setInterval(() => {
        this.currentAd = (this.currentAd + 1) % this.ads.length;
      }, 8000);

      // close mobile menu on page change
      this.$watch("page", () => this.mobileMenu = false);

      // keyboard navigation for preview
      window.addEventListener('keydown', (e) => {
        if (!this.showPreview) return;
        if (e.key === 'Escape') this.closePreview();
        if (e.key === 'ArrowRight') this.showNextImage();
        if (e.key === 'ArrowLeft') this.showPrevImage();
      });
    },

    get categories(){
      const base = [
        { key: 'beranda', label: 'Beranda' },
        { key: 'kategori', label: 'Kategori' }
      ];

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

    // filter catalog per category id (used in homepage carousel)
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

        if (direction === "left" && el.scrollLeft <= 0) {
            el.scrollLeft = 1;
        }

        el.scrollBy({
            left: direction === "right" ? amount : -amount,
            behavior: "smooth"
        });
    },

    /* -------------------
       PREVIEW / LIGHTBOX
       ------------------- */

    // Open preview by image URL:
openPreview(img){
    const clicked = this.catalog.find(p => p.image === img);

    if (!clicked) {
        this.previewItems = [{ name: 'Gambar', image: img, price: '-', stock: '-', id: '-', date: '-' }];
        this.currentIndex = 0;
    } else {
        this.previewItems = this.catalog.filter(p => p.category === clicked.category);
        this.currentIndex = this.previewItems.findIndex(p => p.image === img);
        if (this.currentIndex === -1) this.currentIndex = 0;
    }

    const item = this.previewItems[this.currentIndex];

    this.previewImage = item.image;
    this.previewCategory = item.category;
    this.previewName  = item.name || "";
    this.previewPrice = item.price || "-";
    this.previewStock = item.stock || "-";
    this.previewId    = item.id || "-";
    this.previewDate  = item.date || "-";

    this.showPreview = true;

    this.resetZoomPan();

    document.documentElement.style.overflow = 'hidden';
    document.body.style.overflow = 'hidden';

    this.$nextTick(() => {
        this.attachZoomEvents();
        this.scrollThumbnailIntoView();  // ⬅️ Tambahkan ini
    });
},



    /* =============================
   SCROLL ZOOM (DESKTOP)
   PINCH ZOOM (MOBILE)
============================= */

attachZoomEvents() {
    const wrapper = document.querySelector(".preview-wrapper");

    if (!wrapper) return;

    /* ------ DESKTOP: SCROLL TO ZOOM ------ */
    wrapper.onwheel = (e) => {
        e.preventDefault();

        const zoomIntensity = 0.1;
        if (e.deltaY < 0) {
            this.zoom = Math.min(this.zoom + zoomIntensity, 5);
        } else {
            this.zoom = Math.max(this.zoom - zoomIntensity, 1);
        }
    };

    /* ------ MOBILE: PINCH TO ZOOM ------ */
    let initialDistance = null;
    let initialZoom = 1;

    wrapper.addEventListener("touchstart", (e) => {
        if (e.touches.length === 2) {
            initialDistance = Math.hypot(
                e.touches[0].clientX - e.touches[1].clientX,
                e.touches[0].clientY - e.touches[1].clientY
            );
            initialZoom = this.zoom;
        }
    });

    wrapper.addEventListener("touchmove", (e) => {
        if (e.touches.length === 2) {
            e.preventDefault();

            const newDistance = Math.hypot(
                e.touches[0].clientX - e.touches[1].clientX,
                e.touches[0].clientY - e.touches[1].clientY
            );

            const scale = newDistance / initialDistance;
            this.zoom = Math.min(Math.max(initialZoom * scale, 1), 5);
        }
    });
},

// Aktif saat cursor masuk gambar utama
startHoverZoom(e) {
    this.hoverZoom = true;
    this.zoom = 2;

    const box = e.target.closest(".tp-image-box");
    if (box) box.classList.add("zoom-active");
},

// Saat mouse bergerak di gambar utama
handleMouseMove(e) {
    if (!this.hoverZoom) return;

    const rect = e.target.getBoundingClientRect();

    const x = ((e.clientX - rect.left) / rect.width) * 100;
    const y = ((e.clientY - rect.top) / rect.height) * 100;

    this.targetOriginX = Math.min(100, Math.max(0, x));
    this.targetOriginY = Math.min(100, Math.max(0, y));

    if (!this.frameRunning) {
        this.frameRunning = true;
        this.animateZoom();
    }
},

animateZoom() {
    this.originX += (this.targetOriginX - this.originX) * 0.06;
    this.originY += (this.targetOriginY - this.originY) * 0.06;

    if (
        Math.abs(this.originX - this.targetOriginX) < 0.05 &&
        Math.abs(this.originY - this.targetOriginY) < 0.05
    ) {
        this.frameRunning = false;
        return;
    }

    requestAnimationFrame(() => this.animateZoom());
},

// Saat cursor keluar gambar utama
stopHoverZoom() {
    this.hoverZoom = false;
    this.zoom = 1;

    this.targetOriginX = 50;
    this.targetOriginY = 50;

    if (!this.frameRunning) {
        this.frameRunning = true;
        this.animateZoom();
    }

    const box = document.querySelector(".tp-image-box");
    if (box) box.classList.remove("zoom-active");
},

    closePreview(){
      this.showPreview = false;
      this.previewImage = null;
      this.previewName = "";
      this.previewItems = [];
      this.currentIndex = 0;
      this.resetZoomPan();

      // unlock scroll
      document.documentElement.style.overflow = '';
      document.body.style.overflow = '';
    },

    showNextImage(){
        const img = document.querySelector(".tp-main-image");
        if (img) img.classList.add("fade-out-left");

        setTimeout(() => {
            this.currentIndex = (this.currentIndex + 1) % this.previewItems.length;
            const item = this.previewItems[this.currentIndex];

            this.previewImage = item.image;
            this.previewName = item.name || "";
            this.previewPrice = item.price || "-";
            this.previewStock = item.stock || "-";
            this.previewId = item.id || "-";
            this.previewDate = item.date || "-";
            this.previewCategory = item.category || "-";

            if (img) {
                img.classList.remove("fade-out-left");
                img.classList.add("fade-in");
                setTimeout(() => img.classList.remove("fade-in"), 200);
            }

            this.resetZoomPan();
            this.$nextTick(() => this.scrollThumbnailIntoView());
        }, 150);
    },


    showPrevImage(){
        const img = document.querySelector(".tp-main-image");
        if (img) img.classList.add("fade-out-right");

        setTimeout(() => {
            this.currentIndex = (this.currentIndex - 1 + this.previewItems.length) % this.previewItems.length;
            const item = this.previewItems[this.currentIndex];

            this.previewImage = item.image;
            this.previewName = item.name || "";
            this.previewPrice = item.price || "-";
            this.previewStock = item.stock || "-";
            this.previewId = item.id || "-";
            this.previewDate = item.date || "-";
            this.previewCategory = item.category || "-";

            if (img) {
                img.classList.remove("fade-out-right");
                img.classList.add("fade-in");
                setTimeout(() => img.classList.remove("fade-in"), 200);
            }

            this.resetZoomPan();
            this.$nextTick(() => this.scrollThumbnailIntoView());
        }, 150);
    },

    jumpToImage(i){
        if (!this.previewItems.length) return;

        this.currentIndex = i;

        const item = this.previewItems[i];

        this.previewImage  = item.image;
        this.previewName   = item.name || "";
        this.previewPrice  = item.price || "-";
        this.previewStock  = item.stock || "-";
        this.previewId     = item.id || "-";
        this.previewDate   = item.date || "-";
        this.previewCategory = item.category || "-";

        this.resetZoomPan();
        this.$nextTick(() => this.scrollThumbnailIntoView()); 
    },

    resetZoomPan(){
        this.zoom = 1;
        this.panX = 0;
        this.panY = 0;
        this.isPanning = false;
        this.startX = 0;
        this.startY = 0;
    },

    // =============================
    // AUTO SCROLL THUMBNAIL ACTIVE
    // =============================
    scrollThumbnailIntoView() {
        const container = document.querySelector(".tp-thumbs");
        if (!container) return;

        const thumbs = container.querySelectorAll("img");
        const activeThumb = thumbs[this.currentIndex];
        if (!activeThumb) return;

        thumbs.forEach(t => t.classList.remove("thumb-animate"));

        activeThumb.classList.add("thumb-animate");

        const containerRect = container.getBoundingClientRect();
        const thumbRect = activeThumb.getBoundingClientRect();

        const offset =
            thumbRect.left -
            (containerRect.left + containerRect.width / 2 - thumbRect.width / 2);

        container.scrollBy({
            left: offset,
            behavior: "smooth"
        });

        setTimeout(() => {
            activeThumb.classList.remove("thumb-animate");
        }, 200);
    },

  }
}
</script>

<!-- Laravel Blade Data -->
<script>
window.productsFromDB = @json($products);
window.categoriesFromDB = @json($categories);
</script>


<!-- ===================== DRAG SCROLL SCRIPT ===================== -->
<script>
document.addEventListener("DOMContentLoaded", () => {

    /* =====================================================
       SMOOTH DRAG + MOMENTUM
    ===================================================== */
    function enableSmoothDragScroll(element) {
        if (!element) return;

        let isDown = false;
        let startX = 0;
        let scrollStart = 0;
        let velocity = 0;
        let lastX = 0;
        let frame;
        
        function momentum() {
            element.scrollLeft += velocity;
            velocity *= 0.95; // gesekan

            if (Math.abs(velocity) > 0.5) {
                frame = requestAnimationFrame(momentum);
            }
        }

        element.addEventListener("mousedown", (e) => {
            isDown = true;
            startX = e.pageX;
            scrollStart = element.scrollLeft;
            lastX = e.pageX;

            cancelAnimationFrame(frame);
        });

        element.addEventListener("mousemove", (e) => {
            if (!isDown) return;
            e.preventDefault();

            const dx = e.pageX - lastX;
            velocity = dx; // simpan kecepatan terakhir

            const movement = startX - e.pageX;
            element.scrollLeft = scrollStart + movement;

            lastX = e.pageX;
        });

        element.addEventListener("mouseleave", () => {
            if (isDown) momentum();
            isDown = false;
        });

        element.addEventListener("mouseup", () => {
            isDown = false;
            momentum(); // jalankan inertia
        });
    }

    /* =====================================================
       AKTIFKAN UNTUK SETIAP AREA
    ===================================================== */

    // Navbar kategori
    enableSmoothDragScroll(document.getElementById("navbar-kategori"));

    // Thumbnail atas modal
    enableSmoothDragScroll(document.querySelector(".tp-thumbs"));

    // Thumbnail bawah modal
    enableSmoothDragScroll(document.querySelector(".preview-thumbs"));

});
</script>



<!-- Preload Refresh Loading -->
<script>
window.addEventListener("load", () => {
    const preloader = document.getElementById("preloader");
    setTimeout(() => {
        preloader.style.opacity = 0;
        preloader.style.pointerEvents = "none";

        setTimeout(() => preloader.remove(), 500);
    }, 300);
});
</script>


</body>
</html>
