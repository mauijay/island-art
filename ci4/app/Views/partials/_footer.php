<footer class="bg-white dark:bg-gray-900">
  <div class="container mx-auto px-6 py-16">
    <!-- Artistic CTA Section -->
    <div
      class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 via-teal-500 to-green-500 p-8 md:p-12">
      <!-- Decorative background elements -->
      <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent"></div>
      <div class="absolute -top-4 -right-4 w-32 h-32 bg-yellow-400/20 rounded-full blur-xl"></div>
      <div class="absolute -bottom-6 -left-6 w-40 h-40 bg-pink-400/20 rounded-full blur-xl"></div>

      <div class="relative md:flex md:items-center md:justify-between">
        <div class="md:max-w-2xl">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-yellow-400 rounded-xl flex items-center justify-center mr-4 shadow-lg">
              <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                </path>
              </svg>
            </div>
            <span
              class="inline-block px-3 py-1 bg-white/20 text-white rounded-full text-sm font-medium backdrop-blur-sm">
              Join Our Community
            </span>
          </div>
          <h3 class="text-3xl md:text-4xl xl:text-5xl font-bold text-white mb-4 leading-tight">
            Stay connected with
            <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
              Hawaiʻi's vibrant
            </span>
            art scene
          </h3>
          <p class="text-blue-100 text-lg mb-6 md:mb-0 max-w-lg">
            Get exclusive access to artist spotlights, exhibition openings, and cultural events across the islands.
          </p>
        </div>

        <div class="mt-8 md:mt-0 md:ml-8 flex-shrink-0">
          <a href="#"
            class="group inline-flex items-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-900 font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
            <span class="mr-3">Subscribe Now</span>
            <div class="relative">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                stroke="currentColor" class="w-6 h-6 group-hover:translate-x-1 transition-transform duration-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
              </svg>
            </div>
          </a>

          <!-- Additional visual elements -->
          <div class="mt-4 flex items-center justify-center md:justify-start space-x-4">
            <div class="flex -space-x-2">
              <div class="w-8 h-8 bg-yellow-400 rounded-full border-2 border-white flex items-center justify-center">
                <span class="text-xs font-bold text-gray-900">🎨</span>
              </div>
              <div class="w-8 h-8 bg-pink-400 rounded-full border-2 border-white flex items-center justify-center">
                <span class="text-xs font-bold text-white">🌺</span>
              </div>
              <div class="w-8 h-8 bg-green-400 rounded-full border-2 border-white flex items-center justify-center">
                <span class="text-xs font-bold text-gray-900">🏝️</span>
              </div>
            </div>
            <span class="text-white/80 text-sm font-medium">Join 2,000+ art lovers</span>
          </div>
        </div>
      </div>
    </div>
    <hr class="my-6 border-gray-200 dark:border-gray-700 md:my-10" />
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <div>
        <p class="font-semibold text-gray-800 dark:text-white">Quick Links</p>
        <div class="mt-5 flex flex-col items-start space-y-2">
          <a href="/"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">Home</a>
          <a href="/calendar"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">Events
            Calendar</a>
          <a href="<?= url_to('terms') ?>"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">Terms
            of Service</a>
          <a href="<?= url_to('privacy') ?>"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">Privacy
            Policy</a>
        </div>
      </div>
      <div>
        <p class="font-semibold text-gray-800 dark:text-white">Art Community</p>
        <div class="mt-5 flex flex-col items-start space-y-2">
          <a href="/artists"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">Featured
            Artists</a>
          <a href="/galleries"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">Local
            Galleries</a>
          <a href="/exhibitions"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">Current
            Exhibitions</a>
        </div>
      </div>
      <div>
        <p class="font-semibold text-gray-800 dark:text-white">Resources</p>
        <div class="mt-5 flex flex-col items-start space-y-2">
          <a href="<?= route_to('art.submit') ?>"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">Submit
            Artwork</a>
          <a href="<?= route_to('news') ?>"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">Latest
            News</a>
          <a href="<?= route_to('contact') ?>"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">Contact
            Us</a>
        </div>
      </div>
      <div>
        <p class="font-semibold text-gray-800 dark:text-white">Contact Us</p>
        <div class="mt-5 flex flex-col items-start space-y-2">
          <a href="tel:808-600-7400"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">
            808-600-7400</a>
          <a href="mailto:info@islandartnews.com"
            class="text-gray-600 transition-colors duration-300 hover:text-blue-500 hover:underline dark:text-gray-300 dark:hover:text-blue-400">info@islandartnews.com</a>
        </div>
      </div>
    </div>
    <hr class="my-6 border-gray-200 dark:border-gray-700 md:my-10" />
    <div class="flex flex-col items-center justify-between sm:flex-row">
      <div class="flex items-center">
        <img src="/uploads/images/logo.png"
          alt="round logo image of palm tree, beach and sunset for <?= config('App')->siteName ?>"
          class="h-48 w-auto mr-3">
      </div>
      <div
        class="flex flex-col md:flex-row items-center justify-between mt-4 text-sm text-gray-500 dark:text-gray-300 sm:mt-0 gap-4">
        <?php if (!empty(config('App')->copyrightHolder)): ?>
          <div class="flex-1 text-xs md:text-sm p-3 sm:p-2 lg:p-1 md:pl-6">Copyright &copy;
            <?= date("Y") . '~' . date("Y") + 1; ?>
            <?= env('app.name', '808biz, Inc.') ?> - v<?= app_version() ?> - All Rights Reserved | <a
              href="https://www.facebook.com/808biz" target="_blank" rel="noopener">@808businessSolutions</a> | <a
              href="https://808.biz/?utm_source=808bs&utm_medium=footer&utm_campaign=website-redesign&utm_term=calendar%20scheduling%20tools&utm_content=salary-alert-1-allsalaries"
              target="_blank" rel="noopener">808biz</a>
            <p class="m-0">Developed and Maintained by <a href="https://808businesssolutions.com/" target="_blank"
                title="Hawaii Business Development"><?= config('App')->copyrightHolder ?></a></p>
          </div>
        <?php endif ?>
        <div class="flex-1 md:text-right text-xs md:text-sm p-3 sm:p-2 lg:p-1">
          <a href="<?= url_to('privacy') ?>">Privacy Policy</a>
          &middot;
          <a href="<?= url_to('terms') ?>">Terms &amp; Conditions</a>
        </div>
      </div>
    </div>
  </div>
</footer>
