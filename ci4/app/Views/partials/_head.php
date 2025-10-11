<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= (esc($title) ?? 'Island Art Hawaiʻi') . ' | ' . (esc($keyword) ?? 'Hawaii') . ' | ' . site_title() ?>
  </title>
  <meta name="description" content="<?= $meta_description ?>" />
  <link rel="canonical" href="<?= current_url(); ?>">

  <!-- CSRF Token for AJAX requests -->
  <meta name="csrf-token" content="<?= csrf_hash() ?>">

  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="/favicon.ico" sizes="16x16">
  <link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">

  <!-- Smart asset loading - handles both CLI and Vite workflows -->
  <?= vite_dev_scripts() ?>

  <?php if (ENVIRONMENT === 'development'): ?>
    <?php $viteDevServer = vite_get_dev_server_url(); ?>
    <?php if ($viteDevServer): ?>
      <link rel="stylesheet" href="<?= $viteDevServer ?>/resources/css/app.css">
    <?php else: ?>
      <?php foreach (vite_css_assets('resources/js/app.js') as $cssAsset): ?>
        <link rel="stylesheet" href="<?= $cssAsset ?>">
      <?php endforeach; ?>
    <?php endif; ?>
  <?php else: ?>
    <!-- Production mode: Load CSS from manifest -->
    <?php foreach (vite_css_assets('resources/js/app.js') as $cssAsset): ?>
      <link rel="stylesheet" href="<?= $cssAsset ?>">
    <?php endforeach; ?>
  <?php endif; ?>

  <!-- Google Tag Manager -->
  <?= $this->include('partials/_gtm') ?>
</head>
