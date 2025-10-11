<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Events Header -->
<section class="bg-gradient-to-br from-blue-600 via-teal-500 to-green-500 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Art Events & Exhibitions</h1>
    <p class="text-xl text-blue-100 max-w-2xl mx-auto">
      Discover the vibrant cultural events happening across the Hawaiian Islands
    </p>
    <p class="text-sm text-blue-200 mt-4">Last updated: <?= $lastUpdated ?></p>
  </div>
</section>

<!-- Current Month Highlight -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <span class="inline-block px-4 py-2 bg-pink-100 text-pink-800 rounded-full text-sm font-medium mb-4">
        <?= strtoupper($currentMonth) ?> HIGHLIGHTS
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">This Month's Featured Events</h2>
      <p class="text-lg text-gray-600">Don't miss these exceptional art experiences happening now</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php if (!empty($featuredEvents)): ?>
        <?php foreach ($featuredEvents as $index => $event): ?>
          <?php
          $gradients   = [
            'from-blue-50 to-teal-50',
            'from-green-50 to-emerald-50',
            'from-purple-50 to-pink-50'
          ];
          $badgeColors = ['blue', 'green', 'purple'];
          $textColors  = ['blue', 'green', 'purple'];

          $colorIndex = $index % 3;
          $gradient   = $gradients[$colorIndex];
          $badgeColor = $badgeColors[$colorIndex];
          $textColor  = $textColors[$colorIndex];

          // Determine island badge
          $island = getEventIsland($event);
          ?>

          <!-- Featured Event <?= $index + 1 ?> -->
          <div
            class="bg-gradient-to-br <?= $gradient ?> rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group">
            <div class="p-6">
              <div class="flex items-center justify-between mb-4">
                <span class="inline-block px-3 py-1 bg-<?= $badgeColor ?>-500 text-white text-xs font-medium rounded-full">
                  <?= strtoupper($island) ?>
                </span>
                <span class="text-<?= $textColor ?>-600 font-semibold text-sm">
                  <?= formatEventDates($event) ?>
                </span>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-<?= $textColor ?>-600 transition-colors">
                <?= esc($event['title']) ?>
              </h3>
              <p class="text-gray-600 text-sm mb-4"><?= esc(formatEventLocation($event)) ?></p>
              <?php if (!empty($event['description'])): ?>
                <p class="text-xs text-gray-500 mb-4">
                  <?= esc(substr($event['description'], 0, 150)) ?>       <?= strlen($event['description']) > 150 ? '...' : '' ?>
                </p>
              <?php endif; ?>
              <?php if (!empty($event['website_url'])): ?>
                <a href="<?= esc($event['website_url']) ?>" target="_blank"
                  class="inline-flex items-center text-<?= $textColor ?>-600 hover:text-<?= $textColor ?>-700 font-medium text-sm group">
                  Learn More
                  <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                  </svg>
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- No featured events fallback -->
        <div class="col-span-3 text-center py-12">
          <p class="text-gray-600 text-lg">No featured events currently scheduled.</p>
          <p class="text-gray-500 text-sm mt-2">Check back soon for upcoming exhibitions and cultural events.</p>
        </div>
      <?php endif; ?>
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

      <?php if (!empty($oahuEvents)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <?php foreach (array_slice($oahuEvents, 0, 4) as $event): ?>
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
              <div class="flex items-start justify-between mb-4">
                <h4 class="text-lg font-semibold text-gray-900 pr-4"><?= esc($event['title']) ?></h4>
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full whitespace-nowrap">
                  <?= formatEventDates($event) ?>
                </span>
              </div>
              <p class="text-gray-600 text-sm mb-3"><?= esc(formatEventLocation($event)) ?></p>
              <?php if (!empty($event['description'])): ?>
                <p class="text-gray-700 text-sm mb-4">
                  <?= esc(substr($event['description'], 0, 120)) ?>       <?= strlen($event['description']) > 120 ? '...' : '' ?>
                </p>
              <?php endif; ?>
              <?php if (!empty($event['website_url'])): ?>
                <a href="<?= esc($event['website_url']) ?>" target="_blank"
                  class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                  View Details →
                </a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="bg-white rounded-lg shadow-md p-6">
          <p class="text-gray-600">No upcoming events scheduled for Oʻahu.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- Big Island Events -->
    <div class="mb-12">
      <div class="flex items-center mb-6">
        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mr-4">
          <span class="text-white font-bold text-lg">H</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">Big Island (Hawaiʻi)</h3>
      </div>

      <?php if (!empty($bigIslandEvents)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <?php foreach (array_slice($bigIslandEvents, 0, 4) as $event): ?>
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
              <div class="flex items-start justify-between mb-4">
                <h4 class="text-lg font-semibold text-gray-900 pr-4"><?= esc($event['title']) ?></h4>
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full whitespace-nowrap">
                  <?= formatEventDates($event) ?>
                </span>
              </div>
              <p class="text-gray-600 text-sm mb-3"><?= esc(formatEventLocation($event)) ?></p>
              <?php if (!empty($event['description'])): ?>
                <p class="text-gray-700 text-sm mb-4">
                  <?= esc(substr($event['description'], 0, 120)) ?>       <?= strlen($event['description']) > 120 ? '...' : '' ?>
                </p>
              <?php endif; ?>
              <?php if (!empty($event['website_url'])): ?>
                <a href="<?= esc($event['website_url']) ?>" target="_blank"
                  class="text-green-600 hover:text-green-700 font-medium text-sm">
                  View Details →
                </a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="bg-white rounded-lg shadow-md p-6">
          <p class="text-gray-600">No upcoming events scheduled for Big Island.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- Maui Events -->
    <div class="mb-12">
      <div class="flex items-center mb-6">
        <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mr-4">
          <span class="text-white font-bold text-lg">M</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">Maui</h3>
      </div>

      <?php if (!empty($mauiEvents)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <?php foreach (array_slice($mauiEvents, 0, 4) as $event): ?>
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
              <div class="flex items-start justify-between mb-4">
                <h4 class="text-lg font-semibold text-gray-900 pr-4"><?= esc($event['title']) ?></h4>
                <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded-full whitespace-nowrap">
                  <?= formatEventDates($event) ?>
                </span>
              </div>
              <p class="text-gray-600 text-sm mb-3"><?= esc(formatEventLocation($event)) ?></p>
              <?php if (!empty($event['description'])): ?>
                <p class="text-gray-700 text-sm mb-4">
                  <?= esc(substr($event['description'], 0, 120)) ?>       <?= strlen($event['description']) > 120 ? '...' : '' ?>
                </p>
              <?php endif; ?>
              <?php if (!empty($event['website_url'])): ?>
                <a href="<?= esc($event['website_url']) ?>" target="_blank"
                  class="text-purple-600 hover:text-purple-700 font-medium text-sm">
                  View Details →
                </a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
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
      <?php endif; ?>
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
            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
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

