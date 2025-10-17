<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
  <h2><?= lang('Profile.title') ?></h2>

  <div class="card mt-4 p-4">
    <div class="row align-items-center">
      <div class="col-md-3 text-center">
        <img src="<?= !empty($user['profile_image']) ? base_url('uploads/profiles/' . $user['profile_image']) : base_url('images/default-profile.jpg') ?>" alt="Profile Image" class="img-thumbnail  mb-3" style="width: 250px; height: 250px; object-fit: cover;">
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteProfileImageModal">
          <?= lang('Profile.deleteImage') ?>
        </button>
      </div>

      <div class="col-md-9">
        <p><strong><?= lang('Profile.name') ?>:</strong> <?= esc($user['name']) ?></p>
        <p><strong><?= lang('Profile.email') ?>:</strong> <?= esc($user['email']) ?></p>

        <div class="mt-3">
          <a href="<?= base_url('profile/edit') ?>" class="btn btn-outline-primary me-2"><?= lang('Profile.edit') ?></a>
          <a href="<?= base_url('profile/change-password') ?>" class="btn btn-outline-secondary me-2"><?= lang('Profile.changePassword') ?></a>
          <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileImageModal">
            <?= lang('Profile.editImageTitle') ?>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Update Profile Image Modal -->
<div class="modal fade" id="editProfileImageModal" tabindex="-1" aria-labelledby="editProfileImageLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="<?= '/profile/upload-image/' . $user['id_user'] ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileImageLabel"><?= lang('Profile.editImageTitle') ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= lang('Profile.cancel') ?>"></button>
        </div>
        <div class="modal-body">
          <!-- Current imagen  -->
          <div class="text-center mb-3">
            <img id="previewImage" src="<?= !empty($user['profile_image']) ? base_url('uploads/profiles/' . $user['profile_image']) : base_url('images/default-profile.jpg') ?>" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
          </div>

          <!-- Input image -->
          <div class="mb-3">
            <label for="profile_image" class="form-label"><?= lang('Profile.selectImage') ?></label>
            <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/*" required>
            <div class="form-text"><?= lang('Profile.maxSize') ?></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><?= lang('Profile.save') ?></button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang('Profile.cancel') ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Image Modal -->
<div class="modal fade" id="deleteProfileImageModal" tabindex="-1" aria-labelledby="deleteProfileImageLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="<?= base_url('profile/delete-image/' . $user['id_user']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal-header">
          <h5 class="modal-title" id="deleteProfileImageLabel"><?= lang('Profile.confirmDeleteTitle') ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= lang('Profile.cancel') ?>"></button>
        </div>
        <div class="modal-body">
          <p><?= lang('Profile.confirmDeleteText') ?></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger"><?= lang('Profile.confirmDeleteButton') ?></button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang('Profile.cancel') ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  document.getElementById('profile_image').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById('previewImage');

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>
<?= $this->endSection() ?>

