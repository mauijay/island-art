<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Events Header -->
<section class="bg-gradient-to-br from-blue-600 via-teal-500 to-green-500 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Art Events & Exhibitions</h1>
    <p class="text-xl text-blue-100 max-w-2xl mx-auto">
      Discover the vibrant cultural events happening across the Hawaiian Islands
    </p>
  </div>
</section>

<!-- Current Month Highlight -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <span class="inline-block px-4 py-2 bg-pink-100 text-pink-800 rounded-full text-sm font-medium mb-4">
        OCTOBER 2025 HIGHLIGHTS
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">This Month's Featured Events</h2>
      <p class="text-lg text-gray-600">Don't miss these exceptional art experiences happening now</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Featured Event 1 -->
      <div
        class="bg-gradient-to-br from-blue-50 to-teal-50 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group">
        <div class="p-6">
          <div class="flex items-center justify-between mb-4">
            <span class="inline-block px-3 py-1 bg-blue-500 text-white text-xs font-medium rounded-full">OʻAHU</span>
            <span class="text-blue-600 font-semibold text-sm">Oct 3 - Nov 1</span>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
            Hawaiʻi Craftsmen Annual Statewide Exhibition 2025
          </h3>
          <p class="text-gray-600 text-sm mb-4">Downtown Art Center, Honolulu</p>
          <div class="space-y-2 mb-4">
            <p class="text-xs text-gray-500">🎉 Opening Reception: Oct 3, 6–8pm</p>
            <p class="text-xs text-gray-500">🏆 Awards Ceremony: Oct 4, 6–8pm</p>
          </div>
          <a href="https://www.hawaiicraftsmen.org/ASE2025" target="_blank"
            class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm group">
            Learn More
            <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
          </a>
        </div>
      </div>

      <!-- Featured Event 2 -->
      <div
        class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group">
        <div class="p-6">
          <div class="flex items-center justify-between mb-4">
            <span class="inline-block px-3 py-1 bg-green-500 text-white text-xs font-medium rounded-full">BIG
              ISLAND</span>
            <span class="text-green-600 font-semibold text-sm">Through Sept 28</span>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors">
            Hawai'i Nei Invitational: Neʻe­kau
          </h3>
          <p class="text-gray-600 text-sm mb-4">Volcano Art Center Gallery</p>
          <p class="text-xs text-gray-500 mb-4">Migration/Move with the Seasons - A celebration of seasonal change and
            cultural movement</p>
          <a href="https://volcanoartcenter.org/home/events/" target="_blank"
            class="inline-flex items-center text-green-600 hover:text-green-700 font-medium text-sm group">
            Learn More
            <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
          </a>
        </div>
      </div>

      <!-- Featured Event 3 -->
      <div
        class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group">
        <div class="p-6">
          <div class="flex items-center justify-between mb-4">
            <span class="inline-block px-3 py-1 bg-purple-500 text-white text-xs font-medium rounded-full">OʻAHU</span>
            <span class="text-purple-600 font-semibold text-sm">Sept 26-27</span>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors">
            From the HEART: Celebrating Historic Downtown Honolulu
          </h3>
          <p class="text-gray-600 text-sm mb-4">Downtown Art Center</p>
          <p class="text-xs text-gray-500 mb-4">A community celebration honoring the rich cultural heritage of downtown
            Honolulu</p>
          <a href="https://www.downtownarthi.org/" target="_blank"
            class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium text-sm group">
            Learn More
            <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Events by Island -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Events by Island</h2>
      <p class="text-lg text-gray-600">Explore cultural events across all Hawaiian Islands</p>
    </div>

    <!-- Oahu Events -->
    <div class="mb-12">
      <div class="flex items-center mb-6">
        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mr-4">
          <span class="text-white font-bold text-lg">O</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">Oʻahu</h3>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
          <div class="flex items-start justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-900 pr-4">Shima To Shima – Tokyo's GYAGYAGYA Gallery</h4>
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full whitespace-nowrap">Sept
              23-27</span>
          </div>
          <p class="text-gray-600 text-sm mb-3">Downtown Art Center, Honolulu</p>
          <p class="text-gray-700 text-sm mb-4">An international collaboration showcasing contemporary art bridging
            Hawaiian and Japanese cultures.</p>
          <a href="https://www.downtownarthi.org/" target="_blank"
            class="text-blue-600 hover:text-blue-700 font-medium text-sm">
            View Details →
          </a>
        </div>

        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
          <div class="flex items-start justify-between mb-4">
            <h4 class="text-lg font-semibold text-gray-900 pr-4">From the HEART: Celebrating Historic Downtown Honolulu
            </h4>
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full whitespace-nowrap">Sept
              26-27</span>
          </div>
          <p class="text-gray-600 text-sm mb-3">Downtown Art Center</p>
          <p class="text-gray-700 text-sm mb-4">A community celebration featuring local artists and the historic
            significance of downtown Honolulu.</p>
          <a href="https://www.downtownarthi.org/" target="_blank"
            class="text-blue-600 hover:text-blue-700 font-medium text-sm">
            View Details →
          </a>
        </div>
      </div>
    </div>

    <!-- Big Island Events -->
    <div class="mb-12">
      <div class="flex items-center mb-6">
        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mr-4">
          <span class="text-white font-bold text-lg">H</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">Big Island (Hawaiʻi)</h3>
      </div>

      <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
        <div class="flex items-start justify-between mb-4">
          <h4 class="text-lg font-semibold text-gray-900 pr-4">Hawai'i Nei Invitational: Neʻe­kau (Migration/Move with
            the Seasons)</h4>
          <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full whitespace-nowrap">Through
            Sept 28</span>
        </div>
        <p class="text-gray-600 text-sm mb-3">Volcano Art Center Gallery, Hawai'i Volcanoes National Park</p>
        <p class="text-gray-700 text-sm mb-4">An invitational exhibition exploring themes of migration, seasonal change,
          and cultural adaptation through contemporary Hawaiian art.</p>
        <a href="https://volcanoartcenter.org/home/events/" target="_blank"
          class="text-green-600 hover:text-green-700 font-medium text-sm">
          View Details →
        </a>
      </div>
    </div>

    <!-- Maui Events -->
    <div class="mb-12">
      <div class="flex items-center mb-6">
        <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mr-4">
          <span class="text-white font-bold text-lg">M</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">Maui</h3>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <h4 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Events</h4>
        <p class="text-gray-700 mb-4">
          New fall exhibitions and events will be announced soon from these premier Maui cultural institutions:
        </p>
        <div class="flex flex-col sm:flex-row gap-4">
          <a href="https://huinoeau.com/exhibitions" target="_blank"
            class="inline-flex items-center px-4 py-2 bg-purple-100 hover:bg-purple-200 text-purple-700 rounded-lg transition-colors">
            <span class="mr-2">Hui Noʻeau Visual Arts Center</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
          </a>
          <a href="https://mauiarts.org/exhibits" target="_blank"
            class="inline-flex items-center px-4 py-2 bg-purple-100 hover:bg-purple-200 text-purple-700 rounded-lg transition-colors">
            <span class="mr-2">Maui Arts & Cultural Center</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Subscribe to Events CTA -->
<section class="py-16 bg-gradient-to-r from-teal-600 to-blue-600">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Never Miss an Event</h2>
    <p class="text-xl text-teal-100 mb-8 max-w-2xl mx-auto">
      Get notified about new exhibitions, gallery openings, and cultural events across the Hawaiian Islands.
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="#"
        class="inline-flex items-center px-8 py-3 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-semibold rounded-full transition-all duration-300 transform hover:scale-105">
        Subscribe to Calendar
        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
      </a>
      <a href="<?= route_to('contact') ?>"
        class="inline-flex items-center px-8 py-3 bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 font-semibold rounded-full transition-all duration-300">
        Submit Your Event
        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
      </a>
    </div>
  </div>
</section>

<?= $this->endSection() ?>

