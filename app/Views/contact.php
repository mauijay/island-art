<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Contact Header -->
<section class="bg-gradient-to-br from-blue-600 via-teal-500 to-green-500 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">IslandArtNews</h1>
    <p class="text-xl text-blue-100 max-w-2xl mb-3 mx-auto">
      Get in touch with the IslandArtNews team. We'd love to hear from you about exhibitions, submissions, or
      collaborations.
    </p>
    <p class="text-lg text-blue-100 max-w-3xl mx-auto">
      Your premier source for Hawaiian art culture, connecting artists, galleries, and art enthusiasts across the
      islands.
    </p>
  </div>
</section>

<!-- About Us Section -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Our Story -->
    <div class="bg-white rounded-2xl shadow-xl mb-16 p-8 md:p-12">
      <div class="text-center mb-8">
        <!-- Featured Logo -->
        <div class="flex justify-center mb-8">
          <div class="shadow-lg">
            <img src="<?= base_url('uploads/images/logo.png') ?>" alt="IslandArtNews Logo"
              class="h-96 w-auto mx-auto object-contain">
          </div>
        </div>
      </div>

      <div class="max-w-4xl mx-auto">
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
          Founded in 2020, IslandArtNews emerged from a passion for Hawaiian art and a recognition that the islands'
          incredible artistic community needed a dedicated platform for discovery and connection. What started as a
          small newsletter has grown into Hawaiʻi's premier art culture destination.
        </p>

        <p class="text-gray-700 leading-relaxed mb-6">
          Our team consists of art historians, cultural practitioners, photographers, and writers who share a deep love
          for Hawaiian culture and contemporary art. We work closely with artists, galleries, cultural institutions, and
          community organizations to ensure authentic representation and meaningful storytelling.
        </p>

        <p class="text-gray-700 leading-relaxed">
          Based in Honolulu but covering all the Hawaiian Islands, we're committed to being a responsible voice in the
          art community—one that honors tradition while embracing innovation, supports emerging artists while
          celebrating established masters, and creates space for all voices in Hawaiʻi's diverse artistic landscape.
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
      <div>
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Our Mission</h3>
        <div class="space-y-4 text-gray-700">
          <p class="text-lg leading-relaxed">
            IslandArtNews is dedicated to celebrating and preserving the rich artistic heritage of Hawaiʻi while
            fostering contemporary creative expression across the islands. We serve as a bridge between traditional
            Hawaiian art forms and modern artistic innovation.
          </p>
          <p>
            Our platform showcases the incredible diversity of Hawaiian artists, from master craftspeople preserving
            ancient techniques to contemporary creators pushing artistic boundaries. We believe art is a vital part of
            Hawaiian culture that deserves recognition, support, and celebration.
          </p>
          <p>
            Through exhibitions, artist spotlights, cultural events, and community engagement, we work to strengthen the
            artistic ecosystem that makes Hawaiʻi a unique and vibrant creative destination.
          </p>
        </div>
      </div>

      <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-lg p-6">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h4 class="text-lg font-semibold text-gray-900">Artist Advocacy</h4>
          </div>
          <p class="text-gray-600">Supporting local artists through exposure, education, and community connections.</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
              </svg>
            </div>
            <h4 class="text-lg font-semibold text-gray-900">Cultural Preservation</h4>
          </div>
          <p class="text-gray-600">Documenting and sharing traditional Hawaiian art forms for future generations.</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
              </svg>
            </div>
            <h4 class="text-lg font-semibold text-gray-900">Community Building</h4>
          </div>
          <p class="text-gray-600">Creating connections between artists, galleries, collectors, and art enthusiasts.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Contact Content -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:grid lg:grid-cols-2 lg:gap-16">

      <!-- Contact Form -->
      <div>
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Send us a message</h2>

        <form class="space-y-6" action="#" method="POST">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
              <input type="text" id="first_name" name="first_name" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
            </div>
            <div>
              <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
              <input type="text" id="last_name" name="last_name" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
            </div>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" name="email" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
          </div>

          <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
            <select id="subject" name="subject" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
              <option value="">Choose a subject</option>
              <option value="general">General Inquiry</option>
              <option value="artist_submission">Artist Submission</option>
              <option value="gallery_inquiry">Gallery Partnership</option>
              <option value="event_submission">Event Submission</option>
              <option value="press">Press & Media</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
            <textarea id="message" name="message" rows="6" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors resize-none"
              placeholder="Tell us about your inquiry, artwork, or how we can help..."></textarea>
          </div>

          <div class="flex items-start">
            <div class="flex items-center h-5">
              <input type="checkbox" id="newsletter" name="newsletter"
                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            </div>
            <div class="ml-3">
              <label for="newsletter" class="text-sm text-gray-700">
                I'd like to receive updates about upcoming exhibitions and events
              </label>
            </div>
          </div>

          <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-300 transform hover:scale-105">
            Send Message
          </button>
        </form>
      </div>

      <!-- Contact Information -->
      <div class="mt-12 lg:mt-0">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Get in touch</h2>

        <div class="space-y-8">
          <!-- Office Location -->
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Office Location</h3>
              <p class="text-gray-600 mt-1">
                IslandArtNews<br>
                909 Kapiolani Blvd<br>
                Honolulu, HI 96814
              </p>
            </div>
          </div>

          <!-- Phone -->
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                </path>
              </svg>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Phone</h3>
              <p class="text-gray-600 mt-1">(808) 600-7400</p>
            </div>
          </div>

          <!-- Email -->
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                </path>
              </svg>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Email</h3>
              <p class="text-gray-600 mt-1">
                info@islandartnews.com
              </p>
            </div>
          </div>

          <!-- Hours -->
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-900">Office Hours</h3>
              <div class="text-gray-600 mt-1">
                <p>Monday - Friday: 9:00 AM - 5:00 PM</p>
                <p>Saturday: 10:00 AM - 3:00 PM</p>
                <p>Sunday: Closed</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Social Media -->
        <div class="mt-12">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Follow Us</h3>
          <div class="flex space-x-4">
            <a href="#"
              class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center transition-colors">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M20 10C20 4.477 15.523 0 10 0S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z"
                  clip-rule="evenodd"></path>
              </svg>
            </a>
            <a href="#"
              class="w-10 h-10 bg-pink-600 hover:bg-pink-700 rounded-full flex items-center justify-center transition-colors">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z"
                  clip-rule="evenodd"></path>
              </svg>
            </a>
            <a href="#"
              class="w-10 h-10 bg-blue-400 hover:bg-blue-500 rounded-full flex items-center justify-center transition-colors">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84">
                </path>
              </svg>
            </a>
          </div>
        </div>

        <!-- Gallery Visit Info -->
        <div class="mt-12 bg-gradient-to-r from-teal-50 to-blue-50 rounded-xl p-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-3">Visit Our Gallery Space</h3>
          <p class="text-gray-700 mb-4">
            Our downtown gallery features rotating exhibitions of local Hawaiian artists. Stop by to see the latest
            works and meet fellow art enthusiasts.
          </p>
          <a href="<?= route_to('galleries') ?>"
            class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
            View current exhibitions
            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>

