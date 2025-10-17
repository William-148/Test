<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="mb-3">
      <a href="javascript:history.back()" class="text-decoration-none text-primary">
        <i class="bi bi-arrow-left"></i> <?= lang('System.back') ?>
      </a>
      <h2 class="mb-4 text-center"><?= lang('SignUp.titleEdit') ?></h2>
    </div>

    <form id="edit-form" action="<?= '/users/edit/' . $user['id_user'] ?>" method="post">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label for="name" class="form-label"><?= lang('SignUp.name') ?></label>
        <input type="text" class="form-control" name="name" id="name" minlength="3" required
          value="<?= old('name', $user['name'] ?? '') ?>">
      </div>

      <div class="mb-3">
        <label for="email" class="form-label"><?= lang('SignUp.email') ?></label>
        <input type="email" class="form-control" name="email" id="email" required
          value="<?= old('email', $user['email'] ?? '') ?>">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label"><?= lang('SignUp.password') ?></label>
        <input type="password" class="form-control" name="password" id="password" minlength="6"
          <?= isset($user) ? '' : 'required' ?>>
      </div>

      <div class="mb-3">
        <label for="repeatPassword" class="form-label"><?= lang('SignUp.repeatPassword') ?></label>
        <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" minlength="6"
          <?= isset($user) ? '' : 'required' ?>>
      </div>

      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" name="active" id="active"
          <?= old('active', $user['active'] ?? false) ? 'checked' : '' ?>>
        <label class="form-check-label" for="active"><?= lang('SignUp.active') ?></label>
      </div>

      <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" name="administrator" id="administrator"
          <?= old('administrator', $user['administrator'] ?? false) ? 'checked' : '' ?>>
        <label class="form-check-label" for="administrator"><?= lang('SignUp.administrator') ?></label>
      </div>

      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary"><?= lang('SignUp.submitEdit') ?></button>
        <a href="javascript:history.back()" class="btn btn-secondary"><?= lang('SignUp.cancel') ?></a>
      </div>
    </form>
  </div>
</div>

<!-- Toast de error -->
<div class="toast-container position-fixed bottom-0 end-0 p-3 z-3">
  <div id="formToast" class="toast text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        <?= lang("SignUp.passwordMismatch") ?>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
    </div>
  </div>
</div>

<!-- Overlay de carga -->
<div id="loadingOverlay" class="d-none position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white bg-opacity-75" style="z-index: 1050;">
  <div class="spinner-border text-primary" role="status"></div>
</div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
  document.getElementById('edit-form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('repeatPassword').value;

    if (password !== confirm) {
      e.preventDefault();
      const toastEl = document.getElementById('formToast');
      const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
      toast.show();
    } else {
      document.getElementById('loadingOverlay').classList.remove('d-none');
    }
  });
</script>
<?= $this->endSection() ?>

