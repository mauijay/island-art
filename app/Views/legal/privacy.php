<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Privacy Header -->
<section class="bg-gradient-to-br from-blue-600 via-teal-500 to-green-500 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"><?= esc($title ?? 'Privacy Policy') ?></h1>
    <p class="text-xl text-blue-100 max-w-2xl mx-auto">
      Your privacy is important to us. This policy explains how we collect, use, and protect your information.
    </p>
  </div>
</section>

<!-- Privacy Content -->
<section class="py-16 bg-white">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="prose prose-lg prose-blue max-w-none">
      <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8">
        <p class="text-blue-800 font-medium">
          Last updated: <?= date('F j, Y') ?>
        </p>
      </div>

      <h2 class="text-2xl font-bold text-gray-900 mb-4">Information We Collect</h2>
      <p class="text-gray-700 mb-6">
        We collect information you provide directly to us, such as when you contact us, subscribe to our newsletter, or submit artwork for consideration.
      </p>

      <h2 class="text-2xl font-bold text-gray-900 mb-4">How We Use Your Information</h2>
      <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
        <li>To provide and maintain our service</li>
        <li>To notify you about changes to our service</li>
        <li>To provide customer support</li>
        <li>To gather analysis or valuable information to improve our service</li>
      </ul>

      <h2 class="text-2xl font-bold text-gray-900 mb-4">Information Sharing</h2>
      <p class="text-gray-700 mb-6">
        We do not sell, trade, or otherwise transfer your personal information to outside parties except as described in this privacy policy.
      </p>

      <h2 class="text-2xl font-bold text-gray-900 mb-4">Cookies</h2>
      <p class="text-gray-700 mb-6">
        We use cookies to enhance your experience on our website. You can choose to disable cookies through your browser settings.
      </p>

      <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mt-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Contact Us</h3>
        <p class="text-gray-600">
          If you have any questions about this Privacy Policy, please <a href="<?= route_to('contact') ?>" class="text-blue-600 hover:text-blue-700 underline">contact us</a>.
        </p>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
