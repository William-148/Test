<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-sm border-0">
        <div class="row g-0 align-items-center">
          <div class="col-md-7 p-4">
            <h1 class="fw-bold text-success"><?= lang('Dashboard.greetingTitle') ?></h1>
            <p class="lead mt-3"><?= lang('Dashboard.welcomeMessage') ?></p>

            <div class="mt-4">
              <h5 class="mb-3"><?= lang('Dashboard.featuresTitle') ?></h5>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><?= lang('Dashboard.featureCreate') ?></li>
                <li class="list-group-item"><?= lang('Dashboard.featureView') ?></li>
                <li class="list-group-item"><?= lang('Dashboard.featureComplete') ?></li>
                <li class="list-group-item"><?= lang('Dashboard.featureStats') ?></li>
              </ul>
            </div>
          </div>
          <div class="col-md-5 text-center p-4">
            <img src="https://cdn-icons-png.flaticon.com/512/7792/7792148.png" alt="Tareas" class="img-fluid" style="max-height: 240px;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
