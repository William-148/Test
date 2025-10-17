<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">

      <div class="mb-3">
        <a href="javascript:history.back()" class="text-decoration-none text-primary">
          <i class="bi bi-arrow-left"></i> <?= lang('System.back') ?>
        </a>
        <h2 class="mb-4 text-center"><?= lang('Task.editTaskTitle') ?></h2>
      </div>

      <form action="/tasks/edit/<?= esc($task['id_task']) ?>" method="post">
        <div class="mb-3">
          <label for="description" class="form-label"><?= lang('Task.descriptionLabel') ?></label>
          <textarea name="description" id="description" class="form-control" rows="8" minlength="3" maxlength="255" required><?= esc($task['description']) ?></textarea>
          <div class="form-text"><?= lang('Task.descriptionHelp') ?></div>
        </div>

        <button type="submit" class="btn btn-primary"><?= lang('Task.saveButton') ?></button>
        <a href="javascript:history.back()" class="btn btn-secondary"><?= lang('Task.cancelButton') ?></a>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

