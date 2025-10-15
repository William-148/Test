<?= view('partials/header') ?>
<?= view('partials/navbar') ?>

<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <h2 class="mb-4 text-center"><?= lang('ResetPwd.title') ?></h2>

      <form id="reset-password-form" action="<?= '/reset-password/' . $token ?>" method="post">
        <div class="mb-3">
          <label for="password" class="form-label"><?= lang('ResetPwd.password') ?></label>
          <input type="password" class="form-control" name="password" id="password" minlength="6" required>
        </div>

        <div class="mb-3">
          <label for="repeatPassword" class="form-label"><?= lang('ResetPwd.repeatPassword') ?></label>
          <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" minlength="6" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary"><?= lang('ResetPwd.submit') ?></button>
        </div>
      </form>
    </div>
  </div>
  <div class="toast-container position-fixed bottom-0 end-0 p-3 z-3">
    <div id="formToast" class="toast text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <?= lang("ResetPwd.passwordMismatch") ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
      </div>
    </div>
  </div>

  <div id="loadingOverlay" class="d-none position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white bg-opacity-75" style="z-index: 1050;">
    <div class="spinner-border text-primary" role="status"></div>
  </div>

</main>

<script>
  document.getElementById('reset-password-form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('repeatPassword').value;

    if (password !== confirm) {
      e.preventDefault();
      const toastEl = document.getElementById('formToast');
      const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
      toast.show();
    }
    else {
      document.getElementById('loadingOverlay').classList.remove('d-none');
    }
  });
</script>

<?= view('partials/footer') ?>
<?= view('partials/footer-scripts') ?>
