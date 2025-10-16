<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <h2><?= lang('Profile.title') ?></h2>

  <div class="card mt-4 p-4">
    <div class="row align-items-center">
      <div class="col-md-3 text-center">
        <img src="<?= $user['profile_image'] ?? base_url('images/default-profile.jpg') ?>" alt="Profile Image" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
        <form action="<?= base_url('profile/delete-image') ?>" method="post">
          <button type="submit" class="btn btn-danger btn-sm"><?= lang('Profile.deleteImage') ?></button>
        </form>
      </div>

      <div class="col-md-9">
        <p><strong><?= lang('Profile.name') ?>:</strong> <?= esc($user['name']) ?></p>
        <p><strong><?= lang('Profile.email') ?>:</strong> <?= esc($user['email']) ?></p>

        <div class="mt-3">
          <a href="<?= base_url('profile/edit') ?>" class="btn btn-primary me-2"><?= lang('Profile.edit') ?></a>
          <a href="<?= base_url('profile/change-password') ?>" class="btn btn-secondary me-2"><?= lang('Profile.changePassword') ?></a>
          <a href="<?= base_url('profile/change-image') ?>" class="btn btn-info"><?= lang('Profile.changeImage') ?></a>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
