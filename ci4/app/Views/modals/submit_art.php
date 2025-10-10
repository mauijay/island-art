<!-- Submit Art Modal -->
<div id="submitArtModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
  <!-- Background overlay -->
  <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" id="modalOverlay"></div>
  
  <!-- Modal container -->
  <div class="flex min-h-full items-center justify-center p-4">
    <div class="relative w-full max-w-2xl transform rounded-2xl bg-white p-6 shadow-xl transition-all dark:bg-gray-800">
      <!-- Modal header -->
      <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
          <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-teal-500 rounded-xl flex items-center justify-center mr-3">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Submit Your Artwork</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Share your art with Hawaiʻi's creative community</p>
          </div>
        </div>
        <button type="button" id="closeModalBtn" class="text-gray-400 hover:text-gray-600 focus:outline-none dark:hover:text-gray-300">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal content -->
      <form id="submitArtForm" enctype="multipart/form-data" class="space-y-6">
        <!-- Artist Information Section -->
        <div class="space-y-4">
          <h4 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Artist Information
          </h4>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="artist_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Artist Name *
              </label>
              <input type="text" id="artist_name" name="artist_name" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="Your full name">
            </div>
            
            <div>
              <label for="artist_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Email Address *
              </label>
              <input type="email" id="artist_email" name="artist_email" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="artist@example.com">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="artist_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Phone Number
              </label>
              <input type="tel" id="artist_phone" name="artist_phone"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="(808) 123-4567">
            </div>
            
            <div>
              <label for="artist_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Location
              </label>
              <select id="artist_location" name="artist_location"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Select Island</option>
                <option value="Oahu">Oʻahu</option>
                <option value="Maui">Maui</option>
                <option value="Hawaii">Hawaiʻi (Big Island)</option>
                <option value="Kauai">Kauaʻi</option>
                <option value="Molokai">Molokaʻi</option>
                <option value="Lanai">Lānaʻi</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>

          <div>
            <label for="artist_bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Artist Bio
            </label>
            <textarea id="artist_bio" name="artist_bio" rows="3"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              placeholder="Tell us about yourself and your artistic journey..."></textarea>
          </div>
        </div>

        <!-- Artwork Information Section -->
        <div class="space-y-4">
          <h4 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
            <svg class="w-5 h-5 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Artwork Details
          </h4>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="artwork_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Artwork Title *
              </label>
              <input type="text" id="artwork_title" name="artwork_title" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="Title of your artwork">
            </div>
            
            <div>
              <label for="artwork_medium" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Medium *
              </label>
              <select id="artwork_medium" name="artwork_medium" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Select Medium</option>
                <option value="Painting">Painting</option>
                <option value="Drawing">Drawing</option>
                <option value="Photography">Photography</option>
                <option value="Sculpture">Sculpture</option>
                <option value="Digital Art">Digital Art</option>
                <option value="Mixed Media">Mixed Media</option>
                <option value="Printmaking">Printmaking</option>
                <option value="Textile Art">Textile Art</option>
                <option value="Ceramics">Ceramics</option>
                <option value="Wood Working">Wood Working</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label for="artwork_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Year Created
              </label>
              <input type="number" id="artwork_year" name="artwork_year" min="1900" max="<?= date('Y') ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="<?= date('Y') ?>">
            </div>
            
            <div>
              <label for="artwork_width" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Width (inches)
              </label>
              <input type="number" id="artwork_width" name="artwork_width" step="0.1"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="12.0">
            </div>
            
            <div>
              <label for="artwork_height" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Height (inches)
              </label>
              <input type="number" id="artwork_height" name="artwork_height" step="0.1"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="16.0">
            </div>
          </div>

          <div>
            <label for="artwork_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Artwork Description *
            </label>
            <textarea id="artwork_description" name="artwork_description" rows="3" required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              placeholder="Describe your artwork, inspiration, technique, or story behind it..."></textarea>
          </div>
        </div>

        <!-- Image Upload Section -->
        <div class="space-y-4">
          <h4 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
            </svg>
            Upload Artwork Image
          </h4>
          
          <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
            <input type="file" id="artwork_image" name="artwork_image" accept="image/*" required class="hidden">
            <div id="upload-area" class="cursor-pointer">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                <span class="font-medium text-blue-600">Click to upload</span> or drag and drop
              </p>
              <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG up to 10MB</p>
            </div>
            <div id="image-preview" class="hidden mt-4">
              <img id="preview-img" src="" alt="Preview" class="mx-auto max-w-full h-48 object-contain rounded-lg">
              <p id="file-name" class="mt-2 text-sm text-gray-600 dark:text-gray-400"></p>
            </div>
          </div>
        </div>

        <!-- Additional Options -->
        <div class="space-y-4">
          <div class="flex items-center">
            <input type="checkbox" id="artwork_for_sale" name="artwork_for_sale" value="1"
              class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="artwork_for_sale" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
              This artwork is available for sale
            </label>
          </div>
          
          <div id="price-section" class="hidden">
            <label for="artwork_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Price (USD)
            </label>
            <div class="relative">
              <span class="absolute left-3 top-2 text-gray-500">$</span>
              <input type="number" id="artwork_price" name="artwork_price" step="0.01"
                class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="0.00">
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-600">
          <button type="button" id="cancelBtn"
            class="flex-1 px-6 py-3 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
            Cancel
          </button>
          <button type="submit" id="submitBtn"
            class="flex-1 px-6 py-3 text-white bg-gradient-to-r from-blue-500 to-teal-500 rounded-lg hover:from-blue-600 hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-50 disabled:cursor-not-allowed transition-all transform hover:scale-105">
            <span id="submit-text">Submit Artwork</span>
            <span id="submit-loading" class="hidden">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              Submitting...
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>