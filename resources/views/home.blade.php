
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Wino Bangunan</title>

  {{-- Tailwind CSS (pastikan Anda sudah compile atau gunakan CDN untuk cepat) --}}
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  {{-- Alpine.js untuk state/interaktivitas (ringan) --}}
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    /* sembunyikan scrollbar horizontal di carousel jika perlu */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
  </style>
</head>
<body x-data="winoApp()" :class="darkMode ? 'bg-[#202123] text-white' : 'bg-gray-50 text-gray-900'" class="min-h-screen flex flex-col font-sans transition-all duration-500">

  {{-- NAV --}}
  <nav :class="darkMode ? 'bg-[#343541] border-[#3e3f4b]' : 'bg-white border-gray-200'" class="sticky top-0 z-50 shadow-sm py-4 px-6 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <img src="{{ asset('images/wino-logo.png') }}" alt="Wino Bangunan Logo" class="w-32 h-auto">
    </div>

    <div class="flex-1 mx-6 hidden md:block">
      <input type="search" x-model="search" :placeholder="language === 'id' ? 'Cari produk berdasarkan judul...' : 'Search products by title...'"
             class="w-full border-gray-300 shadow-sm rounded-full px-4 py-2"
             :class="darkMode ? 'text-white placeholder-gray-400 bg-[#40414f] border-gray-600' : 'text-gray-900 placeholder-gray-500 bg-white'">
    </div>

    <div class="flex items-center space-x-4">
      <button @click="toggleLanguage()" class="flex items-center space-x-1 px-2 py-1 border rounded-full hover:bg-green-600 hover:text-white transition">
        {{-- globe icon (simple) --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path d="M2 12h20M12 2c2 4 2 8 2 10s0 6-2 10"/></svg>
        <span x-text="language === 'id' ? 'EN' : 'ID'"></span>
      </button>

      <button @click="toggleDarkMode()" class="ml-4 p-2 rounded-full hover:bg-green-600 transition">
        <template x-if="darkMode">
          {{-- Sun icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
        </template>
        <template x-if="!darkMode">
          {{-- Moon icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
        </template>
      </button>
    </div>
  </nav>

  {{-- CATEGORY BAR --}}
  <div :class="darkMode ? 'bg-[#343541] text-[#ececf1] border-[#3e3f4b]' : 'bg-white text-gray-700 border-gray-200'"
       class="border-b py-3 px-6 flex justify-center space-x-8 text-sm font-medium overflow-x-auto">
    <template x-for="cat in categories" :key="cat.key">
      <span class="flex items-center">
        <button @click="handleCategoryNavigation(cat.key)" :class="page === cat.key ? 'text-green-600 border-b-2 border-green-600 pb-1' : 'hover:text-green-600'">
          <span x-text="cat.label"></span>
        </button>
      </span>
    </template>
  </div>

  {{-- MAIN --}}
  <main class="flex-grow px-8 py-10 space-y-12">
    {{-- BERANDA --}}
    <section x-show="page === 'beranda'">
      <div class="relative w-full h-80 mb-12 overflow-hidden rounded-2xl shadow-lg">
        <img :src="ads[currentAd]" alt="Ad Banner" class="w-full h-full object-cover transition-all duration-1000">
      </div>

      <template x-for="cat in allCategories" :key="cat.id">
        <div class="mb-12">
          <h2 class="text-2xl font-bold mb-4 text-green-600" x-text="t(cat.idLabel, cat.enLabel)"></h2>

          {{-- Carousel --}}
          <div class="relative group">
            <button @click="scrollCarousel(cat.id, 'left')" :class="darkMode ? 'bg-[#40414f] text-white' : 'bg-white text-gray-700'"
                    class="absolute left-0 top-1/2 -translate-y-1/2 p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all z-10">
              <!-- left -->
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M15 18l-6-6 6-6"/></svg>
            </button>

            <div :ref="'carousel-'+cat.id" class="flex space-x-6 overflow-x-auto scroll-smooth px-2 scrollbar-hide snap-x snap-mandatory justify-center">
              <template x-for="(item, index) in filteredCatalogByCategory(cat.id)" :key="index">
                <div class="w-[260px] h-[380px] snap-start rounded-2xl shadow-md hover:shadow-xl transition-transform transform hover:-translate-y-1 border flex-shrink-0"
                     :class="darkMode ? 'border-[#3e3f4b] bg-[#343541] text-white' : 'border-gray-100 bg-white text-gray-900'">
                  <div class="p-0 flex flex-col h-full">
                    <div class="relative overflow-hidden rounded-t-2xl flex-shrink-0">
                      <img :src="item.image" :alt="item.name" class="w-full h-52 object-cover transition-transform duration-500">
                    </div>
                    <div class="p-4 flex-grow flex flex-col justify-between text-center">
                      <div>
                        <h3 class="font-semibold text-base truncate" x-text="item.name"></h3>
                        <p class="text-green-600 font-bold mt-1" x-text="item.price"></p>
                      </div>
                      <p class="text-sm mt-1" x-text="(language === 'id' ? 'Stok' : 'Stock') + ': ' + item.stock"></p>
                    </div>
                  </div>
                </div>
              </template>
            </div>

            <button @click="scrollCarousel(cat.id, 'right')" :class="darkMode ? 'bg-[#40414f] text-white' : 'bg-white text-gray-700'"
                    class="absolute right-0 top-1/2 -translate-y-1/2 p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all z-10">
              <!-- right -->
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 18l6-6-6-6"/></svg>
            </button>
          </div>
        </div>
      </template>
    </section>

    {{-- CATEGORY PAGES --}}
    <template x-for="cat in allCategories" :key="cat.id">
      <section x-show="page === cat.idLabel">
        <h2 class="text-3xl font-semibold mb-6 text-green-600" x-text="t(cat.idLabel, cat.enLabel)"></h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <template x-for="(item, index) in filteredCatalogByCategory(cat.id)" :key="index">
            <div class="rounded-xl border shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1"
                 :class="darkMode ? 'border-[#3e3f4b] bg-[#343541] text-white' : 'border-gray-200 bg-white text-gray-900'">
              <div class="p-4">
                <img :src="item.image" :alt="item.name" class="w-full h-48 object-cover rounded-lg mb-4">
                <h3 class="font-semibold text-lg mb-1" x-text="item.name"></h3>
                <p class="text-green-600 font-bold mb-2" x-text="item.price"></p>
                <p class="text-sm" x-text="(language === 'id' ? 'Stok' : 'Stock') + ': ' + item.stock"></p>
              </div>
            </div>
          </template>
        </div>
        <button @click="handleBackToHome()" class="mt-6 px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition"> <span x-text="language === 'id' ? 'Kembali' : 'Back'"></span> </button>
      </section>
    </template>

    {{-- PARTNER --}}
    <section x-show="page === 'partner'" class="text-center">
      <h2 class="text-3xl font-semibold mb-6 text-green-600" x-text="language === 'id' ? 'Partner Kami' : 'Our Partners'"></h2>
      <p x-text="language === 'id' ? 'Kami bekerja sama dengan berbagai merek terpercaya dalam bidang bahan bangunan dan perkakas.' : 'We collaborate with various trusted brands in construction materials and tools.'"></p>
    </section>

    {{-- KONTAK --}}
    <section x-show="page === 'kontak'" class="text-center">
      <h2 class="text-3xl font-semibold mb-6 text-green-600" x-text="language === 'id' ? 'Kontak Kami' : 'Contact Us'"></h2>
      <p x-text="language === 'id' ? 'Alamat: Jl. Pembangunan No. 45, Jakarta, Indonesia' : 'Address: Jl. Pembangunan No. 45, Jakarta, Indonesia'"></p>
      <p x-text="language === 'id' ? 'Telepon: (021) 555-6789' : 'Phone: (021) 555-6789'"></p>
      <p>Email: info@winobangunan.com</p>
      <button @click="openMap()" class="mt-4 px-5 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition" x-text="language === 'id' ? 'Lihat di Google Maps' : 'View on Google Maps'"></button>
    </section>

    {{-- TENTANG KAMI --}}
    <section x-show="page === 'tentang kami'" class="text-center">
      <h2 class="text-3xl font-semibold mb-6 text-green-600" x-text="language === 'id' ? 'Tentang Wino Bangunan' : 'About Wino Bangunan'"></h2>
      <p x-text="language === 'id' ? 'Wino Bangunan adalah toko bangunan terpercaya yang menyediakan berbagai kebutuhan material dasar, perkakas, perlengkapan listrik, dan finishing untuk segala jenis proyek konstruksi.' : 'Wino Bangunan is a trusted building store that provides various basic materials, tools, electrical supplies, and finishing products for all types of construction projects.'"></p>
      <p class="mt-3" x-text="language === 'id' ? 'Kami berkomitmen untuk memberikan produk berkualitas tinggi dengan harga terjangkau serta pelayanan terbaik untuk pelanggan kami.' : 'We are committed to providing high-quality products at affordable prices and the best service for our customers.'"></p>
    </section>

  </main>

  {{-- FOOTER --}}
  <footer :class="darkMode ? 'bg-[#343541] text-[#ececf1]' : 'bg-white text-gray-700'" class="border-t py-10 px-8 text-center">
    <h3 class="text-2xl font-semibold text-green-600 mb-4">Wino Bangunan</h3>
    <p x-text="language === 'id' ? 'Alamat: Jl. Pembangunan No. 45, Jakarta, Indonesia' : 'Address: Jl. Pembangunan No. 45, Jakarta, Indonesia'"></p>
    <p x-text="language === 'id' ? 'Telepon: (021) 555-6789' : 'Phone: (021) 555-6789'"></p>
    <p>Email: info@winobangunan.com</p>
    <button @click="openMap()" class="mt-4 px-5 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition" x-text="language === 'id' ? 'Lihat di Google Maps' : 'View on Google Maps'"></button>
    <p class="mt-6 text-sm">© 2025 Wino Bangunan. <span x-text="language === 'id' ? 'Hak Cipta Dilindungi.' : 'All Rights Reserved.'"></span></p>
  </footer>

  {{-- SCRIPT: App state & logic menggunakan Alpine --}}
  <script>
    function winoApp() {
      return {
        page: 'beranda',
        search: '',
        selectedCategory: null,
        darkMode: false,
        language: 'id',
        currentAd: 0,
        ads: [
          'https://source.unsplash.com/1200x400/?construction',
          'https://source.unsplash.com/1200x400/?building,materials',
          'https://source.unsplash.com/1200x400/?hardware,tools',
        ],
        allCategories: [
          { id: 'material', idLabel: 'Material Dasar', enLabel: 'Basic Materials' },
          { id: 'perkakas', idLabel: 'Perkakas', enLabel: 'Tools' },
          { id: 'listrik', idLabel: 'Listrik', enLabel: 'Electrical' },
          { id: 'finishing', idLabel: 'Finishing', enLabel: 'Finishing' }
        ],
        catalog: [],
        init() {
          // buat katalog sampel (sama seperti di JSX asal)
          this.catalog = Array.from({ length: 30 }, (_, i) => {
            const categoryObj = this.allCategories[i % this.allCategories.length];
            const categoryName = this.t(categoryObj.idLabel, categoryObj.enLabel);
            return {
              name: `${this.t('Produk', 'Product')} ${i + 1} ${categoryName}`,
              category: categoryName,
              price: `Rp ${Math.floor(Math.random() * 100000 + 10000).toLocaleString('id-ID')}`,
              stock: Math.floor(Math.random() * 500) + 50,
              image:
                categoryObj.id === 'material'
                  ? `https://source.unsplash.com/400x400/?cement,building,${i}`
                  : categoryObj.id === 'perkakas'
                  ? `https://source.unsplash.com/400x400/?handtools,hammer,${i}`
                  : categoryObj.id === 'listrik'
                  ? `https://source.unsplash.com/400x400/?electrical,wires,${i}`
                  : `https://source.unsplash.com/400x400/?paint,construction,${i}`,
            };
          });

          // auto rotate ads
          setInterval(() => {
            this.currentAd = (this.currentAd + 1) % this.ads.length;
          }, 10000);
        },

        // helper translate
        t(id, en) {
          return this.language === 'id' ? id : en;
        },

        get categories() {
          // categories untuk bar atas (gabungan)
          const cats = [{ key: 'beranda', label: this.t('Beranda', 'Home') }];
          this.allCategories.forEach(c => cats.push({ key: c.idLabel, label: this.t(c.idLabel, c.enLabel) }));
          cats.push({ key: 'partner', label: this.t('Partner', 'Partner') });
          cats.push({ key: 'kontak', label: this.t('Kontak', 'Contact') });
          cats.push({ key: 'tentang kami', label: this.t('Tentang Kami', 'About Us') });
          return cats;
        },

        toggleDarkMode() { this.darkMode = !this.darkMode },
        toggleLanguage() { this.language = this.language === 'id' ? 'en' : 'id' },

        handleCategoryNavigation(catKey) {
          this.page = catKey;
          this.selectedCategory = catKey === 'beranda' ? null : catKey;
          window.scrollTo({ top: 0, behavior: 'smooth' });
        },

        handleBackToHome() {
          this.selectedCategory = null;
          this.page = 'beranda';
          window.scrollTo({ top: 0, behavior: 'smooth' });
        },

        openMap() {
          window.open('https://www.google.com/maps?q=C6n6kRr05CSvAxGI5', '_blank');
        },

        filteredCatalog() {
          const q = this.search.toLowerCase();
          return this.catalog.filter(item => item.name.toLowerCase().includes(q));
        },

        filteredCatalogByCategory(catId) {
          // catId adalah 'material' | 'perkakas' | 'listrik' | 'finishing'
          const catObj = this.allCategories.find(c => c.id === catId);
          if (!catObj) return [];
          const catName = this.t(catObj.idLabel, catObj.enLabel);
          const q = this.search.toLowerCase();
          return this.catalog.filter(item => item.category === catName && item.name.toLowerCase().includes(q));
        },

        // scroll helper for each carousel
        scrollCarousel(catId, direction) {
          const refName = 'carousel-' + catId;
          const node = this.$root.querySelector(`[x-ref="${refName}"]`) || this.$root.querySelector(`[ref='carousel-${catId}']`);
          if (!node) return;
          const scrollAmount = (direction === 'right' ? node.offsetWidth * 0.8 : -node.offsetWidth * 0.8);
          node.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
      }
    }
  </script>
</body>
</html>
