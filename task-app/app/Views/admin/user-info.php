<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2><?= lang('UserInfo.title') ?></h2>
    <a href="javascript:history.back()" class="text-decoration-none text-primary">
      <i class="bi bi-arrow-left"></i> <?= lang('System.back') ?>
    </a>
  </div>

  <div class="card">
    <div class="card-body">
      <dl class="row">
        <dt class="col-sm-3"><?= lang('UserInfo.name') ?></dt>
        <dd class="col-sm-9"><?= esc($user['name']) ?></dd>

        <dt class="col-sm-3"><?= lang('UserInfo.email') ?></dt>
        <dd class="col-sm-9"><?= esc($user['email']) ?></dd>

        <dt class="col-sm-3"><?= lang('UserInfo.active') ?></dt>
        <dd class="col-sm-9"><?= $user['active'] ? lang('UserInfo.yes') : lang('UserInfo.no') ?></dd>

        <dt class="col-sm-3"><?= lang('UserInfo.administrator') ?></dt>
        <dd class="col-sm-9"><?= $user['administrator'] ? lang('UserInfo.yes') : lang('UserInfo.no') ?></dd>

        <dt class="col-sm-3"><?= lang('UserInfo.createdAt') ?></dt>
        <dd class="col-sm-9"><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></dd>

        <dt class="col-sm-3"><?= lang('UserInfo.updatedAt') ?></dt>
        <dd class="col-sm-9"><?= date('d/m/Y H:i', strtotime($user['updated_at'])) ?></dd>
      </dl>

      <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="<?= base_url('users/edit/' . $user['id_user']) ?>" class="btn btn-outline-primary">
          <?= lang('UserInfo.edit') ?>
        </a>
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
          <?= lang('UserInfo.delete') ?>
        </button>
      </div>
    </div>
  </div>
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= '/users/delete/' . $user['id_user'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel"><?= lang('UserInfo.confirmDeleteTitle') ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= lang('UserInfo.confirmDelete') ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang('UserInfo.cancel') ?></button>
          <button type="submit" class="btn btn-danger"><?= lang('UserInfo.confirm') ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

