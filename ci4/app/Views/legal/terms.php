<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Terms Header -->
<section class="bg-gradient-to-br from-blue-600 via-teal-500 to-green-500 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"><?= esc($title ?? 'Terms of Service') ?></h1>
    <p class="text-xl text-blue-100 max-w-2xl mx-auto">
      Please read these terms and conditions carefully before using Island Art Hawaiʻi.
    </p>
  </div>
</section>

<!-- Terms Content -->
<section class="py-16 bg-white">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="prose prose-lg prose-blue max-w-none">
      <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8">
        <p class="text-blue-800 font-medium">
          Last updated: <?= date('F j, Y') ?>
        </p>
      </div>

      <h2 class="text-2xl font-bold text-gray-900 mb-4">Agreement to Terms</h2>
      <p class="text-gray-700 mb-6">
        By accessing and using Island Art Hawaiʻi, you accept and agree to be bound by the terms and provision of this agreement.
      </p>

      <h2 class="text-2xl font-bold text-gray-900 mb-4">Use License</h2>
      <p class="text-gray-700 mb-4">
        Permission is granted to temporarily download one copy of the materials on Island Art Hawaiʻi for personal, non-commercial transitory viewing only.
      </p>

      <h2 class="text-2xl font-bold text-gray-900 mb-4">Content Disclaimer</h2>
      <p class="text-gray-700 mb-6">
        The information on this website is provided on an "as is" basis. To the fullest extent permitted by law, Island Art Hawaiʻi excludes all representations, warranties, conditions and terms.
      </p>

      <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mt-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Questions?</h3>
        <p class="text-gray-600">
          If you have any questions about these Terms of Service, please <a href="<?= route_to('contact') ?>" class="text-blue-600 hover:text-blue-700 underline">contact us</a>.
        </p>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
