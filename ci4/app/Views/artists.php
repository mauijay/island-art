<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Artists Header -->
<section class="bg-gradient-to-br from-blue-600 via-teal-500 to-green-500 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Hawaiian Artists</h1>
    <p class="text-xl text-blue-100 max-w-2xl mx-auto">
      Meet the talented creators who bring the spirit and beauty of Hawaiʻi to life through their art.
    </p>
  </div>
</section>

<!-- Featured Artist of the Month -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium mb-4">
        ARTIST OF THE MONTH - OCTOBER 2025
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Keoni Nakamura</h2>
      <p class="text-xl text-gray-600 mt-2">Master Potter & Cultural Educator</p>
    </div>

    <div class="lg:grid lg:grid-cols-2 lg:gap-16 lg:items-center">
      <div class="mb-12 lg:mb-0">
        <div class="relative">
          <div
            class="aspect-w-4 aspect-h-5 bg-gradient-to-br from-orange-200 to-red-300 rounded-xl overflow-hidden shadow-2xl">
            <div class="w-full h-96 bg-gradient-to-br from-orange-200 to-red-300 flex items-center justify-center">
              <div class="text-center">
                <div
                  class="w-32 h-32 bg-white bg-opacity-30 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span class="text-3xl font-bold text-white">KN</span>
                </div>
                <p class="text-white font-medium">Keoni Nakamura</p>
                <p class="text-white text-sm opacity-75">Master Potter</p>
              </div>
            </div>
          </div>
          <div
            class="absolute -bottom-6 -right-6 w-24 h-24 bg-yellow-400 rounded-full flex items-center justify-center shadow-lg">
            <svg class="w-10 h-10 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
              </path>
            </svg>
          </div>
        </div>
      </div>

      <div>
        <div class="space-y-6">
          <div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">About the Artist</h3>
            <p class="text-lg text-gray-700 leading-relaxed">
              Keoni Nakamura is a third-generation potter whose work bridges ancient Hawaiian traditions with
              contemporary ceramic art. Born and raised on the Big Island, he learned traditional techniques from his
              grandmother while studying modern ceramic practices at the University of Hawaiʻi.
            </p>
          </div>

          <div>
            <h4 class="text-xl font-semibold text-gray-900 mb-3">Philosophy</h4>
            <blockquote class="text-gray-700 italic text-lg border-l-4 border-blue-500 pl-6">
              "Through clay, I connect with the earth and honor the traditions passed down by my ancestors. Each piece
              tells a story of our island home, our people, and our connection to the land and sea."
            </blockquote>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-blue-50 rounded-lg p-4">
              <h4 class="font-semibold text-blue-900 mb-2">Specializations</h4>
              <ul class="text-blue-800 text-sm space-y-1">
                <li>• Traditional Hawaiian pottery</li>
                <li>• Ocean-inspired ceramics</li>
                <li>• Cultural workshops</li>
                <li>• Installation art</li>
              </ul>
            </div>

            <div class="bg-green-50 rounded-lg p-4">
              <h4 class="font-semibold text-green-900 mb-2">Achievements</h4>
              <ul class="text-green-800 text-sm space-y-1">
                <li>• 2024 Hawaii State Arts Award</li>
                <li>• Featured in Pacific Art Review</li>
                <li>• 15+ solo exhibitions</li>
                <li>• Master Teaching Certification</li>
              </ul>
            </div>
          </div>

          <div class="flex flex-col sm:flex-row gap-4">
            <a href="#"
              class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
              View Portfolio
              <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                </path>
              </svg>
            </a>
            <a href="#"
              class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 hover:border-gray-400 text-gray-700 font-semibold rounded-lg transition-colors duration-300">
              Workshop Schedule
              <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Featured Works -->
    <div class="mt-16">
      <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Featured Works</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="group">
          <div
            class="aspect-w-1 aspect-h-1 bg-gradient-to-br from-blue-200 to-teal-300 rounded-xl overflow-hidden shadow-lg group-hover:shadow-xl transition-shadow duration-300">
            <div class="w-full h-64 bg-gradient-to-br from-blue-200 to-teal-300 flex items-center justify-center">
              <span class="text-gray-700 font-medium">"Ocean Memories #1"</span>
            </div>
          </div>
          <div class="mt-4">
            <h4 class="font-semibold text-gray-900">Ocean Memories #1</h4>
            <p class="text-sm text-gray-600">Ceramic bowl, 2025</p>
          </div>
        </div>

        <div class="group">
          <div
            class="w-full h-64 bg-gradient-to-br from-orange-200 to-red-300 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
            <span class="text-gray-700 font-medium">"Volcanic Earth"</span>
          </div>
          <div class="mt-4">
            <h4 class="font-semibold text-gray-900">Volcanic Earth</h4>
            <p class="text-sm text-gray-600">Raku vessel, 2024</p>
          </div>
        </div>

        <div class="group">
          <div
            class="w-full h-64 bg-gradient-to-br from-green-200 to-emerald-300 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
            <span class="text-gray-700 font-medium">"Island Rhythms"</span>
          </div>
          <div class="mt-4">
            <h4 class="font-semibold text-gray-900">Island Rhythms</h4>
            <p class="text-sm text-gray-600">Ceramic installation, 2025</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Other Local Artists Section -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Discover Local Artists</h2>
      <p class="text-lg text-gray-600">Meet other talented artists from across the Hawaiian Islands</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Artist 1 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="relative">
          <div class="w-full h-64 bg-gradient-to-br from-purple-200 to-pink-300 flex items-center justify-center">
            <div class="text-center">
              <div class="w-20 h-20 bg-white bg-opacity-30 rounded-full flex items-center justify-center mx-auto mb-3">
                <span class="text-xl font-bold text-white">LS</span>
              </div>
              <p class="text-white font-medium">Leilani Santos</p>
            </div>
          </div>
          <div class="absolute top-4 right-4 bg-purple-500 text-white px-2 py-1 rounded-full text-xs font-medium">
            Painter
          </div>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Leilani Santos</h3>
          <p class="text-gray-600 mb-4">
            Contemporary painter known for vibrant tropical landscapes and abstract interpretations of Hawaiian
            mythology.
          </p>
          <div class="flex items-center justify-between">
            <div class="flex items-center text-sm text-gray-500">
              <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              </svg>
              Maui
            </div>
            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
              View Profile →
            </a>
          </div>
        </div>
      </div>

      <!-- Artist 2 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="relative">
          <div class="w-full h-64 bg-gradient-to-br from-teal-200 to-blue-300 flex items-center justify-center">
            <div class="text-center">
              <div class="w-20 h-20 bg-white bg-opacity-30 rounded-full flex items-center justify-center mx-auto mb-3">
                <span class="text-xl font-bold text-white">KW</span>
              </div>
              <p class="text-white font-medium">Koa Williams</p>
            </div>
          </div>
          <div class="absolute top-4 right-4 bg-teal-500 text-white px-2 py-1 rounded-full text-xs font-medium">
            Sculptor
          </div>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Koa Williams</h3>
          <p class="text-gray-600 mb-4">
            Master wood carver and bronze sculptor whose works celebrate Hawaiian cultural heritage and natural beauty.
          </p>
          <div class="flex items-center justify-between">
            <div class="flex items-center text-sm text-gray-500">
              <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              </svg>
              Big Island
            </div>
            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
              View Profile →
            </a>
          </div>
        </div>
      </div>

      <!-- Artist 3 -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="relative">
          <div class="w-full h-64 bg-gradient-to-br from-yellow-200 to-orange-300 flex items-center justify-center">
            <div class="text-center">
              <div class="w-20 h-20 bg-white bg-opacity-30 rounded-full flex items-center justify-center mx-auto mb-3">
                <span class="text-xl font-bold text-white">MP</span>
              </div>
              <p class="text-white font-medium">Malia Patel</p>
            </div>
          </div>
          <div class="absolute top-4 right-4 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-medium">
            Photographer
          </div>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Malia Patel</h3>
          <p class="text-gray-600 mb-4">
            Documentary photographer capturing the changing landscape of modern Hawaii and its cultural preservation
            efforts.
          </p>
          <div class="flex items-center justify-between">
            <div class="flex items-center text-sm text-gray-500">
              <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              </svg>
              Oahu
            </div>
            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
              View Profile →
            </a>
          </div>
        </div>
      </div>

    </div>

    <!-- Browse More Artists -->
    <div class="text-center mt-12">
      <a href="#"
        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
        Browse All Artists
        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
      </a>
    </div>
  </div>
</section>

<!-- Artist Submissions CTA -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-teal-600">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Are You an Artist?</h2>
    <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
      Join our vibrant community of Hawaiian artists. Share your work, connect with fellow creators, and showcase your
      art to a wider audience.
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="<?= route_to('art.submit') ?>"
        class="inline-flex items-center px-8 py-3 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-semibold rounded-full transition-all duration-300 transform hover:scale-105">
        Submit Your Art
        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
        </svg>
      </a>
      <a href="<?= route_to('contact') ?>"
        class="inline-flex items-center px-8 py-3 bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 font-semibold rounded-full transition-all duration-300">
        Get in Touch
        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
          </path>
        </svg>
      </a>
    </div>
  </div>
</section>

<?= $this->endSection() ?>

