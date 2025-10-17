<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="row mb-3">
        <a href="/tasks" class="text-decoration-none text-primary mb-3">
          <i class="bi bi-arrow-left"></i> <?= lang('System.back') ?>
        </a>
        <div class="col-12 col-md-6">
          <h2 class="mb-2 mb-md-0"><?= lang('Task.taskDetailsTitle') ?></h2>
        </div>
        <div class="col-12 col-md-6 text-md-end">
          <a href="<?= base_url('tasks/edit/' . $task['id_task']) ?>" class="btn btn-outline-primary me-2 mb-2 mb-md-0">
            <i class="bi bi-pencil-square me-1"></i> <?= lang('Task.editButton') ?>
          </a>
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
            <i class="bi bi-trash me-1"></i> <?= lang('Task.deleteButton') ?>
          </button>
        </div>
      </div>

      <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
          <strong><?= lang('Task.descriptionLabel') ?>:</strong>
        </div>
        <div class="card-body">
          <p class="fs-5 mb-0"><?= esc($task['description']) ?></p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between">
            <span><strong>ID:</strong></span>
            <span><?= esc($task['id_task']) ?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span><strong><?= lang('Task.createdAtHeader') ?>:</strong></span>
            <span><?= date('d M Y H:i:s', strtotime($task['created_at'])) ?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span><strong><?= lang('Task.updatedAtHeader') ?>:</strong></span>
            <span><?= date('d M Y H:i:s', strtotime($task['updated_at'])) ?></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="post" action="<?= base_url('tasks/delete/' . $task['id_task']) ?>" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel"><?= lang('Task.confirmDeleteTitle') ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= lang('Task.cancelButton') ?>"></button>
      </div>
      <div class="modal-body">
        <?= lang('Task.confirmDeleteMessage') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <?= lang('Task.cancelButton') ?>
        </button>
        <button type="submit" class="btn btn-danger">
          <?= lang('Task.confirmDeleteButton') ?>
        </button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>


