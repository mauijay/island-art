<nav class="container mx-auto p-6 lg:flex lg:items-center lg:justify-between">
  <div class="flex items-center justify-between">
    <div class="flex items-center">
      <a class="flex items-center hover:opacity-80 transition-opacity duration-300" href="/">
        <img src="/uploads/images/logo1.png" alt="<?= site_title() ?>" class="h-8 w-auto mr-3 lg:h-10">
        <span
          class="text-xl font-bold text-gray-800 hover:text-gray-700 dark:text-white dark:hover:text-gray-300 lg:text-2xl">
          <?= site_title() ?>
        </span>
      </a>
    </div>
    <!-- Mobile menu button -->
    <div class="flex lg:hidden">
      <button id="mobile-menu-button" type="button"
        class="text-gray-500 hover:text-gray-600 focus:text-gray-600 focus:outline-hidden dark:text-gray-200 dark:hover:text-gray-400 dark:focus:text-gray-400"
        aria-label="toggle menu">
        <svg id="menu-open-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
        </svg>
        <svg id="menu-close-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>
  <!-- Mobile Menu -->
  <div id="mobile-menu"
    class="absolute inset-x-0 z-20 w-full bg-white px-6 py-4 shadow-md transition-all duration-300 ease-in-out dark:bg-gray-900 lg:relative lg:top-0 lg:mt-0 lg:flex lg:w-auto lg:translate-x-0 lg:items-center lg:bg-transparent lg:p-0 lg:opacity-100 lg:shadow-none lg:dark:bg-transparent opacity-0 -translate-x-full lg:opacity-100 lg:translate-x-0">
    <div class="lg:-px-8 flex flex-col space-y-4 lg:mt-0 lg:flex-row lg:space-y-0">
      <a class="transform text-gray-700 transition-colors duration-300 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-400 lg:mx-8"
        href="<?= route_to('home') ?>">Home</a>
      <a class="transform text-gray-700 transition-colors duration-300 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-400 lg:mx-8"
        href="<?= route_to('calendar') ?>">Events</a>
      <a class="transform text-gray-700 transition-colors duration-300 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-400 lg:mx-8"
        href="<?= route_to('artists') ?>">Artists</a>
      <a class="transform text-gray-700 transition-colors duration-300 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-400 lg:mx-8"
        href="<?= route_to('galleries') ?>">Galleries</a>
      <a class="transform text-gray-700 transition-colors duration-300 hover:text-blue-500 dark:text-gray-200 dark:hover:text-blue-400 lg:mx-8"
        href="<?= route_to('contact') ?>">Contact</a>
    </div>
    <button type="button" id="submitArtBtn"
      class="mt-4 block rounded-lg bg-blue-600 px-6 py-2.5 text-center font-medium capitalize leading-5 text-white hover:bg-blue-500 lg:mt-0 lg:w-auto cursor-pointer transition-all transform hover:scale-105">
      Submit Art
    </button>
  </div>
</nav>
