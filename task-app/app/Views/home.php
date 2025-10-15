<?= view('partials/header') ?>
<?= view('partials/navbar') ?>
<main class="container py-5">
  <div class="row align-items-center">
    <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
    <h1 class="display-4 fw-bold text-primary"><?= lang('Home.title') ?> TaskApp</h1>
      <p class="lead mt-3"><?= lang("Home.description") ?></p>
      <p><?= lang("Home.message") ?></p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-start">
        <a href="/sign-up" class="btn btn-success btn-lg px-4 me-sm-3"><?= lang("Home.startNow") ?></a>
        <a href="/sign-in" class="btn btn-outline-primary btn-lg px-4"><?= lang("Home.haveAnAccount") ?></a>
      </div>
    </div>
    <div class="col-lg-6 text-center">
      <img src="https://cdn-icons-png.flaticon.com/512/6818/6818257.png" alt="TaskApp Illustration" class="img-fluid" style="max-height: 300px;">
    </div>
  </div>
</main>

<?= view('partials/footer') ?>
<?= view('partials/footer-scripts') ?>

