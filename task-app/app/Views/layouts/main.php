<?= view('partials/header') ?>
<?= view('partials/navbar-user') ?>

<main class="container py-5">
   <?= $this->renderSection('content') ?>
</main>

<?= $this->renderSection('scripts') ?>
<?= view('partials/footer-scripts') ?>

