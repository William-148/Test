<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
  <h2><?= lang('ChangePassword.title') ?></h2>

  <form id="changePasswordForm" action="/profile/change-password" method="post" class="mt-4">
    <div class="mb-3">
      <label for="current_password" class="form-label"><?= lang('ChangePassword.current') ?></label>
      <input type="password" name="current_password" id="current_password" class="form-control" minlength=6 required>
    </div>

    <div class="mb-3">
      <label for="new_password" class="form-label"><?= lang('ChangePassword.new') ?></label>
      <input type="password" name="new_password" id="new_password" class="form-control" minlength=6 required>
    </div>

    <div class="mb-3">
      <label for="confirm_password" class="form-label"><?= lang('ChangePassword.confirm') ?></label>
      <input type="password" name="confirm_password" id="confirm_password" class="form-control" minlength=6 required>
    </div>

    <div class="d-flex justify-content-start gap-2">
      <button type="submit" class="btn btn-primary"><?= lang('ChangePassword.save') ?></button>
      <a href="/profile" class="btn btn-secondary"><?= lang('ChangePassword.cancel') ?></a>
    </div>
  </form>
</div>
</div>

<!-- Snackbar -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3 z-3">
    <div id="snackbar" class="toast text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <?= lang("ChangePassword.mismatch") ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
      </div>
    </div>
  </div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script>
  document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
    const newPass = document.getElementById('new_password').value.trim();
    const confirmPass = document.getElementById('confirm_password').value.trim();

    if (newPass !== confirmPass) {
      e.preventDefault();
      const toastEl = document.getElementById('snackbar');
      const toast = new bootstrap.Toast(toastEl, { delay: 8000 });
      toast.show();
    }
  });
</script>
<?= $this->endSection() ?>

