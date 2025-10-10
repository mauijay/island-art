<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="p-6 max-w-4xl mx-auto">
  <header class="text-center mb-8">
    <h1 class="text-4xl font-bold text-blue-800 mb-2"><?= isset($title) ? esc($title) : 'Test Page' ?></h1>
    <?php if (isset($description)): ?>
      <p class="text-lg text-gray-600"><?= esc($description) ?></p>
    <?php endif; ?>
  </header>

  <main>
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
      <h2 class="text-2xl font-semibold mb-4">Welcome to Island Art News</h2>
      <p class="text-gray-700 mb-4">
        Discover the vibrant local art scene with the latest news, events, and stories from our creative community.
      </p>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 p-4 rounded-lg">
          <h3 class="font-semibold text-blue-800 mb-2">Latest Articles</h3>
          <p class="text-sm text-gray-600">Stay updated with the newest art exhibitions and cultural events.</p>
        </div>
        <div class="bg-green-50 p-4 rounded-lg">
          <h3 class="font-semibold text-green-800 mb-2">Artist Spotlight</h3>
          <p class="text-sm text-gray-600">Meet the talented artists shaping our local creative landscape.</p>
        </div>
      </div>
    </div>
  </main>
  <div class="mt-6 p-4 bg-blue-100 rounded-lg">
    <p class="text-blue-800 text-sm">Environment: <strong><?= ENVIRONMENT ?></strong> | Built with CodeIgniter 4 +
      Vite + Tailwind CSS v4</p>
  </div>
  <div class="mt-2 text-center">

    <p>Page rendered in {elapsed_time} seconds using {memory_usage} MB of memory.</p>

    <p>Environment: <?= ENVIRONMENT ?></p>

  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  console.log('Test script loaded.');
</script>

<?= $this->endSection() ?>

