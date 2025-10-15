<?= view('partials/header') ?>
<?= view('partials/navbar') ?>

<main class="container py-5">
  <div class="row justify-content-center"> <div class="col-md-6 col-lg-5">
      <h2 class="mb-4 text-center"><?= lang('ForgotPwd.title') ?></h2>

      <form id="forgot-password-form" action="/forgot-password" method="post">
        <div class="mb-3">
          <label for="email" class="form-label"><?= lang('ForgotPwd.email') ?></label>
          <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary"><?= lang('ForgotPwd.submit') ?></button>
          <a href="/" class="btn btn-secondary"><?= lang('ForgotPwd.cancel') ?></a>
        </div>
      </form>
    </div>
  </div>

  <div id="loadingOverlay" class="d-none position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white bg-opacity-75" style="z-index: 1050;">
    <div class="spinner-border text-primary" role="status"></div>
  </div>

</main>


<script>
  document.getElementById('forgot-password-form').addEventListener('submit', function(e) {
    document.getElementById('loadingOverlay').classList.remove('d-none');
  });
</script>

<?= view('partials/footer') ?>
<?= view('partials/footer-scripts') ?>

