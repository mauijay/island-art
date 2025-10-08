<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Gallery Header -->
<section class="bg-gradient-to-br from-blue-600 via-teal-500 to-green-500 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Art Galleries</h1>
    <p class="text-xl text-blue-100 max-w-2xl mx-auto">
      Explore the diverse world of Hawaiian art through our featured galleries and current exhibitions.
    </p>
  </div>
</section>

<!-- Featured Exhibition -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-4">
        CURRENT EXHIBITION
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Ocean Memories: Contemporary Hawaiian Ceramics</h2>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">
        A stunning collection featuring works by leading Hawaiian ceramic artists, exploring themes of ocean, land, and
        cultural heritage.
      </p>
    </div>

    <div class="lg:grid lg:grid-cols-2 lg:gap-16 lg:items-center">
      <div class="mb-8 lg:mb-0">
        <div class="relative">
          <div
            class="aspect-w-4 aspect-h-3 bg-gradient-to-br from-blue-200 via-teal-200 to-green-200 rounded-xl overflow-hidden shadow-xl">
            <div
              class="w-full h-96 bg-gradient-to-br from-blue-200 via-teal-200 to-green-200 flex items-center justify-center">
              <div class="text-center">
                <div
                  class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                  <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                  </svg>
                </div>
                <p class="text-white font-medium">Featured Exhibition Image</p>
              </div>
            </div>
          </div>
          <div class="absolute top-4 left-4 bg-yellow-400 text-gray-900 px-3 py-1 rounded-full text-sm font-semibold">
            NOW SHOWING
          </div>
        </div>
      </div>

      <div>
        <div class="space-y-6">
          <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Exhibition Details</h3>
            <ul class="space-y-2 text-gray-600">
              <li class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                October 15 - December 10, 2025
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                </svg>
                Downtown Art Center, Honolulu
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tuesday - Sunday, 10 AM - 6 PM
              </li>
            </ul>
          </div>

          <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Featured Artists</h3>
            <div class="flex flex-wrap gap-2">
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Keoni Nakamura</span>
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Leilani Santos</span>
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Koa Williams</span>
            </div>
          </div>

          <p class="text-gray-700">
            This groundbreaking exhibition showcases how contemporary Hawaiian ceramic artists are reinterpreting
            traditional forms while incorporating modern techniques and environmental consciousness.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Gallery Grid -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Gallery Collection</h2>
      <p class="text-lg text-gray-600">Discover artworks from our permanent collection and featured exhibitions</p>
    </div>

    <!-- Filter Tabs -->
    <div class="flex flex-wrap justify-center gap-4 mb-12">
      <button class="px-6 py-2 bg-blue-600 text-white rounded-full font-medium transition-colors">All</button>
      <button
        class="px-6 py-2 bg-white text-gray-700 hover:bg-gray-100 rounded-full font-medium transition-colors">Ceramics</button>
      <button
        class="px-6 py-2 bg-white text-gray-700 hover:bg-gray-100 rounded-full font-medium transition-colors">Paintings</button>
      <button
        class="px-6 py-2 bg-white text-gray-700 hover:bg-gray-100 rounded-full font-medium transition-colors">Sculptures</button>
      <button
        class="px-6 py-2 bg-white text-gray-700 hover:bg-gray-100 rounded-full font-medium transition-colors">Photography</button>
      <button
        class="px-6 py-2 bg-white text-gray-700 hover:bg-gray-100 rounded-full font-medium transition-colors">Traditional
        Crafts</button>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

      <!-- Artwork 1 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="aspect-w-1 aspect-h-1 bg-gradient-to-br from-orange-200 to-red-300">
          <div class="w-full h-64 bg-gradient-to-br from-orange-200 to-red-300 flex items-center justify-center">
            <span class="text-gray-700 font-medium">Ocean Bowl Series #3</span>
          </div>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Ocean Bowl Series #3</h3>
          <p class="text-sm text-gray-600 mt-1">Keoni Nakamura</p>
          <p class="text-xs text-gray-500 mt-1">Ceramic, 2025</p>
          <span class="inline-block mt-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Ceramics</span>
        </div>
      </div>

      <!-- Artwork 2 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="w-full h-64 bg-gradient-to-br from-green-200 to-teal-300 flex items-center justify-center">
          <span class="text-gray-700 font-medium">Tropical Sunrise</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Tropical Sunrise</h3>
          <p class="text-sm text-gray-600 mt-1">Leilani Santos</p>
          <p class="text-xs text-gray-500 mt-1">Acrylic on canvas, 2025</p>
          <span class="inline-block mt-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Paintings</span>
        </div>
      </div>

      <!-- Artwork 3 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="w-full h-64 bg-gradient-to-br from-purple-200 to-pink-300 flex items-center justify-center">
          <span class="text-gray-700 font-medium">Volcanic Flow</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Volcanic Flow</h3>
          <p class="text-sm text-gray-600 mt-1">Koa Williams</p>
          <p class="text-xs text-gray-500 mt-1">Bronze sculpture, 2024</p>
          <span class="inline-block mt-2 px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Sculptures</span>
        </div>
      </div>

      <!-- Artwork 4 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="w-full h-64 bg-gradient-to-br from-blue-200 to-indigo-300 flex items-center justify-center">
          <span class="text-gray-700 font-medium">Haleakalā Dawn</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Haleakalā Dawn</h3>
          <p class="text-sm text-gray-600 mt-1">Malia Patel</p>
          <p class="text-xs text-gray-500 mt-1">Digital photography, 2025</p>
          <span
            class="inline-block mt-2 px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Photography</span>
        </div>
      </div>

      <!-- Artwork 5 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="w-full h-64 bg-gradient-to-br from-yellow-200 to-orange-300 flex items-center justify-center">
          <span class="text-gray-700 font-medium">Traditional Kapa</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Traditional Kapa</h3>
          <p class="text-sm text-gray-600 mt-1">Tutu Kawelo</p>
          <p class="text-xs text-gray-500 mt-1">Bark cloth, 2025</p>
          <span class="inline-block mt-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Traditional
            Crafts</span>
        </div>
      </div>

      <!-- Artwork 6 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="w-full h-64 bg-gradient-to-br from-teal-200 to-blue-300 flex items-center justify-center">
          <span class="text-gray-700 font-medium">Island Dreams</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Island Dreams</h3>
          <p class="text-sm text-gray-600 mt-1">Kai Yamamoto</p>
          <p class="text-xs text-gray-500 mt-1">Mixed media, 2024</p>
          <span class="inline-block mt-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Paintings</span>
        </div>
      </div>

      <!-- Artwork 7 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="w-full h-64 bg-gradient-to-br from-red-200 to-pink-300 flex items-center justify-center">
          <span class="text-gray-700 font-medium">Coral Garden</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Coral Garden</h3>
          <p class="text-sm text-gray-600 mt-1">Emma Tanaka</p>
          <p class="text-xs text-gray-500 mt-1">Glass sculpture, 2025</p>
          <span class="inline-block mt-2 px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Sculptures</span>
        </div>
      </div>

      <!-- Artwork 8 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="w-full h-64 bg-gradient-to-br from-indigo-200 to-purple-300 flex items-center justify-center">
          <span class="text-gray-700 font-medium">Wave Forms</span>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Wave Forms</h3>
          <p class="text-sm text-gray-600 mt-1">Paulo Silva</p>
          <p class="text-xs text-gray-500 mt-1">Ceramic installation, 2024</p>
          <span class="inline-block mt-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Ceramics</span>
        </div>
      </div>

    </div>

    <!-- Load More Button -->
    <div class="text-center mt-12">
      <button
        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
        Load More Artworks
        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
    </div>
  </div>
</section>

<!-- Gallery Information -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:grid lg:grid-cols-2 lg:gap-16">
      <div>
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Visit Our Galleries</h2>
        <p class="text-lg text-gray-700 mb-6">
          Our gallery spaces are located throughout Honolulu, each showcasing different aspects of Hawaiian art and
          culture. From traditional crafts to contemporary installations, there's always something new to discover.
        </p>

        <div class="space-y-4">
          <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
              <h3 class="font-semibold text-gray-900">Free Admission</h3>
              <p class="text-gray-600">All gallery exhibitions are free and open to the public</p>
            </div>
          </div>

          <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
              <h3 class="font-semibold text-gray-900">Guided Tours</h3>
              <p class="text-gray-600">Weekly artist-led tours every Saturday at 2 PM</p>
            </div>
          </div>

          <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
              <h3 class="font-semibold text-gray-900">Educational Programs</h3>
              <p class="text-gray-600">Workshops and classes for all skill levels</p>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-12 lg:mt-0">
        <div class="bg-gradient-to-br from-teal-50 to-blue-50 rounded-xl p-8">
          <h3 class="text-xl font-bold text-gray-900 mb-4">Upcoming Exhibitions</h3>

          <div class="space-y-6">
            <div class="border-l-4 border-blue-500 pl-4">
              <h4 class="font-semibold text-gray-900">Contemporary Lei: Art as Adornment</h4>
              <p class="text-sm text-gray-600 mt-1">December 2025 - February 2026</p>
              <p class="text-gray-700 mt-2">Modern interpretations of traditional Hawaiian lei making using
                unconventional materials.</p>
            </div>

            <div class="border-l-4 border-green-500 pl-4">
              <h4 class="font-semibold text-gray-900">Young Artists Showcase</h4>
              <p class="text-sm text-gray-600 mt-1">January 2026</p>
              <p class="text-gray-700 mt-2">Annual exhibition featuring emerging Hawaiian artists under 30.</p>
            </div>

            <div class="border-l-4 border-purple-500 pl-4">
              <h4 class="font-semibold text-gray-900">Ocean Conservation Through Art</h4>
              <p class="text-sm text-gray-600 mt-1">March 2026</p>
              <p class="text-gray-700 mt-2">Artists address marine conservation and climate change through their work.
              </p>
            </div>
          </div>

          <div class="mt-6 pt-6 border-t border-gray-200">
            <a href="<?= route_to('calendar') ?>" class="text-blue-600 hover:text-blue-700 font-medium">
              View full calendar →
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>

