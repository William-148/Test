<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-6">

    <h2><?= lang('EditProfile.title') ?></h2>

    <form id="edit-profile-form" action="/profile/edit" method="post" class="mt-4">
      <fieldset class="border p-3 mb-4">
        <legend class="float-none w-auto px-2"><?= lang('EditProfile.updateSection') ?></legend>

        <div class="mb-3">
          <label for="name" class="form-label"><?= lang('EditProfile.name') ?></label>
          <input type="text" name="name" id="name" class="form-control" value="<?= esc($user['name']) ?>" minlength="3" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label"><?= lang('EditProfile.email') ?></label>
          <input type="email" name="email" id="email" class="form-control" value="<?= esc($user['email']) ?>" required>
        </div>
      </fieldset>

      <fieldset class="border p-3 mb-4">
        <legend class="float-none w-auto px-2"><?= lang('EditProfile.securitySection') ?></legend>

        <div class="mb-3">
          <label for="current_password" class="form-label"><?= lang('EditProfile.currentPassword') ?></label>
          <input type="password" name="current_password" id="current_password" class="form-control" required>
          <div class="form-text"><?= lang('EditProfile.passwordNote') ?></div>
        </div>
      </fieldset>
      <div class="d-flex justify-content-start gap-2">
        <button type="submit" class="btn btn-primary"><?= lang('EditProfile.save') ?></button>
        <a href="/profile" class="btn btn-secondary"><?= lang('EditProfile.cancel') ?></a>
      </div>
    </form>
  </div>
</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script>
    document.getElementById('edit-profile-form').addEventListener('submit', function(e) {
      const nameInput = document.getElementById('name');
      const emailInput = document.getElementById('email');

      const originalName = '<?= esc($user['name']) ?>';
      const originalEmail = '<?= esc($user['email']) ?>';

      const currentName = nameInput.value.trim();
      const currentEmail = emailInput.value.trim();
      if (currentName === originalName && currentEmail === originalEmail) {
        e.preventDefault();
        alert("<?= lang('EditProfile.noChanges') ?>");
      }
    });

  </script>
<?= $this->endSection() ?>
