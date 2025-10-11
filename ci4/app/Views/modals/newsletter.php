<!-- Newsletter Subscription Modal -->
<div id="newsletterModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
  <!-- Background overlay -->
  <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" id="newsletterOverlay"></div>

  <!-- Modal container -->
  <div class="flex min-h-full items-center justify-center p-4">
    <div class="relative w-full max-w-md transform rounded-2xl bg-white p-6 shadow-xl transition-all dark:bg-gray-800">
      <!-- Modal header -->
      <div class="text-center mb-6">
        <div
          class="w-16 h-16 bg-gradient-to-br from-blue-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
            </path>
          </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Stay in the Loop</h3>
        <p class="text-gray-600 dark:text-gray-400">Get exclusive access to artist spotlights, exhibition openings, and
          cultural events across Hawaiʻi.</p>

        <button type="button" id="closeNewsletterBtn"
          class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none dark:hover:text-gray-300">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Newsletter form -->
      <form id="newsletterForm" class="space-y-4">
        <div>
          <label for="newsletter_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Your Name
          </label>
          <input type="text" id="newsletter_name" name="newsletter_name" required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Enter your full name">
        </div>

        <div>
          <label for="newsletter_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Email Address
          </label>
          <input type="email" id="newsletter_email" name="newsletter_email" required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="your.email@example.com">
        </div>

        <!-- Subscription preferences -->
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
            What interests you? (Optional)
          </label>
          <div class="space-y-2">
            <label class="flex items-center">
              <input type="checkbox" name="interests[]" value="exhibitions"
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Gallery exhibitions</span>
            </label>
            <label class="flex items-center">
              <input type="checkbox" name="interests[]" value="artists"
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Artist spotlights</span>
            </label>
            <label class="flex items-center">
              <input type="checkbox" name="interests[]" value="events"
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Cultural events</span>
            </label>
            <label class="flex items-center">
              <input type="checkbox" name="interests[]" value="news"
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Art news & updates</span>
            </label>
          </div>
        </div>

        <!-- Frequency preference -->
        <div>
          <label for="frequency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            How often would you like to hear from us?
          </label>
          <select id="frequency" name="frequency"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="weekly">Weekly digest</option>
            <option value="biweekly">Bi-weekly updates</option>
            <option value="monthly">Monthly newsletter</option>
            <option value="events">Event announcements only</option>
          </select>
        </div>

        <!-- Privacy notice -->
        <div class="text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
          <p>We respect your privacy. Your email will only be used to send you our newsletter and important updates. You
            can unsubscribe at any time.</p>
        </div>

        <!-- Modal footer -->
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
          <button type="button" id="cancelNewsletterBtn"
            class="flex-1 px-6 py-3 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
            Maybe Later
          </button>
          <button type="submit" id="subscribeBtn"
            class="flex-1 px-6 py-3 text-white bg-gradient-to-r from-blue-500 to-teal-500 rounded-lg hover:from-blue-600 hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-50 disabled:cursor-not-allowed transition-all transform hover:scale-105">
            <span id="subscribe-text">Subscribe Now</span>
            <span id="subscribe-loading" class="hidden">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
              </svg>
              Subscribing...
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
