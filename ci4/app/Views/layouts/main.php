<!DOCTYPE html>
<html lang="en-US" data-theme="light">
<?= $this->include('partials/_head') ?>

<body class="relative min-h-screen flex flex-col bg-slate-200">
  <?= $this->include('partials/_gtag_js') ?>
  <!--  Navbar  -->
  <?= $this->include('partials/_navbar') ?>
  <!--  Page Header and Content  -->
  <?= $this->renderSection('content') ?>
  <?= $this->include('partials/_footer') ?>
  <?= $this->renderSection('modals') ?>
  <?= $this->include('modals/logout') ?>
  <?= $this->include('modals/submit_art') ?>
  <?= $this->include('modals/newsletter') ?>
  <?= $this->include('partials/_js') ?>
  <?= $this->renderSection('scripts') ?>
  <?= $this->include('partials/_notifications.php') ?>
</body>

</html>
