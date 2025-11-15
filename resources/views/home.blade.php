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
    <section x-show="page === 'partner'" class="prose prose-lg mx-auto text-center" x-cloak>
    <h2 class="text-2xl font-semibold text-green-600">
        <span x-text="language === 'id' ? 'Partner Kami' : 'Our Partners'"></span>
    </h2>
    <p x-text="language === 'id' ? 
        'Kami bekerja sama dengan berbagai merek terpercaya dalam bidang bahan bangunan dan perkakas.' : 
        'We collaborate with trusted brands in construction materials and tools.'
    "></p>
    </section>

    <section x-show="page === 'kontak'" class="prose prose-lg mx-auto text-center" x-cloak>
      <h2 class="text-2xl font-semibold text-green-600"> <span x-text="language === 'id' ? 'Kontak Kami' : 'Contact Us'"></span></h2>
      <p> <span x-text="language === 'id' ? 'Alamat: Jl. Veteran No.33, Langkae Araya, Kec. Towuti, Kabupaten Luwu Timur, Sulawesi Selatan 92982' : 'Address: Jl. Veteran No.33, Langkae Araya, Kec. Towuti, Kabupaten Luwu Timur, Sulawesi Selatan 92982'"></span></p>
      <p> <span x-text="language === 'id' ? 'Telepon: (021) 555-6789' : 'Phone: (021) 555-6789'"></span></p>
      <p>Email: info@winobangunan.com</p>
      <button @click="openMap()" class="mt-3 px-4 py-2 rounded-full bg-green-600 text-white">Lihat di Google Maps</button>
    </section>

    <section x-show="page === 'tentang kami'" class="prose prose-lg mx-auto text-center" x-cloak>
      <h2 class="text-2xl font-semibold text-green-600"> <span x-text="language === 'id' ? 'Tentang Wino Bangunan' : 'About Wino Bangunan'"></span></h2>
   <div>
    <!-- Paragraf 1 -->
    <p x-show="language === 'id'">
        Wino Bangunan adalah toko bangunan terpercaya yang menyediakan berbagai kebutuhan material dasar, perkakas, perlengkapan listrik, dan finishing untuk segala jenis proyek konstruksi. Sejak berdiri, Wino Bangunan berkomitmen untuk menghadirkan produk berkualitas tinggi dengan harga yang kompetitif, sehingga pelanggan dapat menyelesaikan proyek mereka dengan hasil terbaik.
    </p>
    <p x-show="language === 'en'">
        Wino Bangunan is a trusted building supply store that provides a wide range of essential materials, tools, electrical equipment, and finishing products for all types of construction projects. Since its establishment, Wino Bangunan has been committed to offering high-quality products at competitive prices, ensuring that customers can complete their projects with the best possible results.
    </p>

    <!-- Paragraf 2 -->
    <p x-show="language === 'id'">
        Selain menyediakan berbagai jenis material bangunan, Wino Bangunan juga terus mengikuti perkembangan teknologi dan inovasi terbaru di industri konstruksi. Kami bekerja sama dengan merek-merek ternama dan pemasok terpercaya untuk memastikan setiap produk yang tersedia memiliki standar kualitas yang tinggi dan memenuhi kebutuhan pelanggan, baik untuk proyek kecil maupun besar.
    </p>
    <p x-show="language === 'en'">
        In addition to offering various construction materials, Wino Bangunan continuously follows the latest technological developments and innovations in the construction industry. We collaborate with well-known brands and reliable suppliers to ensure that every product available meets high quality standards and fulfills customer needs, whether for small or large-scale projects.
    </p>

    <!-- Paragraf 3 -->
    <p x-show="language === 'id'">
        Kami percaya bahwa pelayanan adalah kunci dalam membangun kepercayaan. Karena itu, tim kami selalu siap memberikan konsultasi dan rekomendasi terbaik sesuai kebutuhan pelanggan. Mulai dari pemilihan material, perhitungan jumlah kebutuhan, hingga tips penggunaan, semua kami sediakan untuk membantu pelanggan membuat keputusan yang tepat dan efisien.
    </p>
    <p x-show="language === 'en'">
        We believe that excellent service is the key to building trust. That is why our team is always ready to provide the best consultation and recommendations based on customer needs. From choosing the right materials, calculating required quantities, to usage tips, we offer comprehensive support to help customers make accurate and efficient decisions.
    </p>

    <!-- Paragraf 4 -->
    <p x-show="language === 'id'">
        Dengan pengalaman bertahun-tahun dalam melayani masyarakat, Wino Bangunan terus berkembang dan memperluas layanan agar dapat menjangkau lebih banyak pelanggan di berbagai daerah. Visi kami adalah menjadi mitra terpercaya bagi setiap orang yang ingin membangun, merenovasi, atau memperbaiki hunian dan bangunan mereka, dengan memberikan solusi lengkap, cepat, dan terpercaya.
    </p>
    <p x-show="language === 'en'">
        With years of experience serving the community, Wino Bangunan continues to grow and expand its services to reach more customers in various regions. Our vision is to become a trusted partner for anyone looking to build, renovate, or improve their home or building by providing complete, fast, and reliable solutions.
    </p>
    </div>
    </section>

  </main>

<!-- FOOTER -->
<footer 
  :class="darkMode ? 'bg-gray-900 text-gray-300' : 'bg-white text-gray-700'"
  class="border-t border-gray-200 mt-auto"
>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 text-center">
    <h3 class="text-xl font-semibold text-green-600">Wino Bangunan</h3>
    <p class="mt-2">Alamat: Jl. Veteran No.33, Langkae Araya, Kec. Towuti, Kabupaten Luwu Timur, Sulawesi Selatan 92982</p>
    <button @click="openMap()" class="mt-3 px-4 py-2 rounded-full bg-green-600 text-white">Lihat di Google Maps</button>
    <p class="mt-1">Telepon: (021) 555-6789</p>
    <p class="mt-1">Email: info@winobangunan.com</p>
    <p class="mt-6 text-sm">© 2025 Wino Bangunan. 
      <span x-text="language === 'id' ? 'Hak Cipta Dilindungi.' : 'All Rights Reserved.'"></span>
    </p>
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
