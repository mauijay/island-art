<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-600 via-teal-500 to-green-500 overflow-hidden">
  <div class="absolute inset-0 bg-black bg-opacity-20"></div>
  <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
    <div class="text-center">
      <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
        <span class="block">Island Art</span>
        <span class="block text-yellow-300">Hawaiʻi</span>
      </h1>
      
      <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto leading-relaxed">
        Celebrating the vibrant artistic spirit of the Pacific Islands. Discover local artists, galleries, and cultural events that shape our creative community.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="<?= route_to('galleries') ?>" 
           class="inline-flex items-center px-8 py-3 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-semibold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg">
          <span>Explore Galleries</span>
          <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
          </svg>
        </a>
        
        <a href="<?= route_to('artists') ?>" 
           class="inline-flex items-center px-8 py-3 bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 font-semibold rounded-full transition-all duration-300 transform hover:scale-105">
          <span>Meet Artists</span>
          <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Latest Art News -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Latest Art News</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">Stay updated with the newest exhibitions, artist features, and cultural events happening across the Hawaiian Islands.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- News Post 1 - Exhibition -->
      <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
          <span class="text-white font-medium">Gallery Opening</span>
        </div>
        <div class="p-6">
          <div class="flex items-center text-sm text-gray-500 mb-3">
            <span>October 5, 2025</span>
            <span class="mx-2">•</span>
            <span>Honolulu</span>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
            Contemporary Hawaiian Art Exhibition Opens
          </h3>
          <p class="text-gray-600 mb-4">
            Discover groundbreaking works by emerging local artists exploring themes of cultural identity and environmental stewardship.
          </p>
          <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
            Read more
            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </article>

      <!-- News Post 2 - Workshop -->
      <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="w-full h-48 bg-gradient-to-br from-green-400 to-teal-500 flex items-center justify-center">
          <span class="text-white font-medium">Workshop</span>
        </div>
        <div class="p-6">
          <div class="flex items-center text-sm text-gray-500 mb-3">
            <span>October 3, 2025</span>
            <span class="mx-2">•</span>
            <span>Maui</span>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
            Traditional Pottery Workshop with Keoni Nakamura
          </h3>
          <p class="text-gray-600 mb-4">
            Learn ancient Hawaiian pottery techniques in this hands-on workshop led by renowned artist and cultural educator.
          </p>
          <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
            Read more
            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </article>

      <!-- News Post 3 - Gallery Walk -->
      <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
        <div class="w-full h-48 bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center">
          <span class="text-white font-medium">Community Event</span>
        </div>
        <div class="p-6">
          <div class="flex items-center text-sm text-gray-500 mb-3">
            <span>September 28, 2025</span>
            <span class="mx-2">•</span>
            <span>Honolulu</span>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
            Art Walk Honolulu Showcases 25 Local Galleries
          </h3>
          <p class="text-gray-600 mb-4">
            Monthly art walk brings together the community to celebrate local creativity with special exhibitions and artist talks.
          </p>
          <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
            Read more
            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </article>
    </div>

    <div class="text-center mt-12">
      <a href="<?= route_to('calendar') ?>" 
         class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
        View All Events
        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
      </a>
    </div>
  </div>
</section>

<!-- Hawaiian Art Culture Information -->
<section class="py-16 bg-gradient-to-r from-teal-50 to-blue-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:grid lg:grid-cols-3 lg:gap-8">
      
      <!-- Main Content -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Discover Hawaiian Art Culture</h2>
          <div class="space-y-6">
            <div class="flex items-start space-x-4">
              <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Rich Cultural Heritage</h3>
                <p class="text-gray-600">
                  Explore the deep roots of Hawaiian artistic traditions, from ancient kapa making to contemporary interpretations of cultural themes.
                </p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Vibrant Community</h3>
                <p class="text-gray-600">
                  Connect with local artists, galleries, and fellow art enthusiasts who share a passion for Pacific Island creativity.
                </p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Events & Exhibitions</h3>
                <p class="text-gray-600">
                  Stay informed about gallery openings, cultural festivals, and educational workshops happening across the islands.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Artist Spotlight Sidebar -->
      <div class="lg:col-span-1">
        <div class="bg-gradient-to-br from-teal-50 to-blue-50 rounded-xl p-6 shadow-lg">
          <h3 class="text-xl font-bold text-gray-900 mb-4">Artist Spotlight</h3>
          
          <div class="text-center mb-6">
            <div class="w-20 h-20 bg-gradient-to-br from-orange-200 to-red-300 rounded-full mx-auto mb-4 flex items-center justify-center">
              <span class="text-white font-bold text-lg">KN</span>
            </div>
            <h4 class="text-lg font-semibold text-gray-900">Keoni Nakamura</h4>
            <p class="text-gray-600 text-sm">Master Potter & Cultural Educator</p>
          </div>

          <p class="text-gray-700 text-sm mb-4">
            This month, we feature master potter Keoni Nakamura, whose work bridges ancient Hawaiian traditions with contemporary ceramic art. His pieces reflect the spiritual connection between artist, clay, and island home.
          </p>

          <div class="space-y-2 mb-4">
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Location:</span>
              <span class="text-gray-900 font-medium">Big Island</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Specialization:</span>
              <span class="text-gray-900 font-medium">Traditional Pottery</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Experience:</span>
              <span class="text-gray-900 font-medium">25+ Years</span>
            </div>
          </div>

          <div class="text-center">
            <a href="<?= route_to('artists') ?>" 
               class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm">
              View full profile →
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>

