<?= $this->extend('layouts/main') ?>

<?= $this->section('headers') ?>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid h-100 d-flex flex-column">
  <div class="d-flex justify-content-between align-items-center mt-1 mb-3">
    <h2><?= lang('UserList.title') ?></h2>
    <a href="<?= base_url('users/new') ?>" class="btn btn-success"><?= lang('UserList.newUser') ?></a>
  </div>

  <div class="table-responsive flex-grow-1 overflow-auto">
    <table id="userTable" class="table table-striped table-bordered">
      <thead >
        <tr>
          <th><?= lang('UserList.name') ?></th>
          <th><?= lang('UserList.email') ?></th>
          <th><?= lang('UserList.active') ?></th>
          <th><?= lang('UserList.admin') ?></th>
          <th><?= lang('UserList.created') ?></th>
          <th><?= lang('UserList.actions') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= esc($user['name']) ?></td>
            <td><?= esc($user['email']) ?></td>
            <td><?= $user['active'] ? lang('UserList.yes') : lang('UserList.no') ?></td>
            <td><?= $user['administrator'] ? lang('UserList.yes') : lang('UserList.no') ?></td>
            <?php
              $dt = new DateTime($user['created_at'], new DateTimeZone('America/Guatemala'));
            ?>
            <td><?= $dt->format('d/m/Y H:i') ?>
            <td>
              <a href="<?= base_url('users/' . $user['id_user']) ?>">
                <i class="bi bi-eye"></i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
    <div class="d-flex  gap-3 my-1">
      <button id="orderNewest" class="btn btn-dark"><?= lang('UserList.orderNew') ?></button>
      <button id="orderOldest" class="btn btn-dark"><?= lang('UserList.orderOld') ?></button>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

  <script>
    $(document).ready( function () {
      const table = $('#userTable').DataTable({
        // options
        responsive: {
          breakpoints: [
            {name: 'bigdesktop', width: Infinity},
            {name: 'meddesktop', width: 1480},
            {name: 'smalldesktop', width: 1280},
            {name: 'medium', width: 1188},
            {name: 'tabletl', width: 1024},
            {name: 'btwtabllandp', width: 848},
            {name: 'tabletp', width: 768},
            {name: 'mobilel', width: 480},
            {name: 'mobilep', width: 320}
          ]
        },
        pageLength: 10,
        order: [[4, 'desc']],
        columnDefs: [
          { orderable: false, targets: 5 }
        ],
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/<?= service("request")->getLocale() === "es" ? "es-ES" : "en-GB" ?>.json'
        }
      });
      $('#orderNewest').on('click', function () {
        table.order([4, 'desc']).draw();
      });

      $('#orderOldest').on('click', function () {
        table.order([4, 'asc']).draw();
      });
    });
  </script>
<?= $this->endSection() ?>
