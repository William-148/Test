<?= $this->extend('layouts/main') ?>

<?= $this->section('headers') ?>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid h-100 d-flex flex-column col-md-8">
    <div class="d-flex justify-content-between align-items-center mt-1 mb-1">
      <h2><?= lang('Task.taskListTitle') ?></h2>
      <a href="tasks/new" class="btn btn-success"><?= lang('Task.newTaskButton') ?></a>
    </div>

    <div class="table-responsive flex-grow-1 overflow-auto">
        <table id="taskTable" class="table table-striped table-borderless" >
          <thead >
            <tr>
              <th><?= lang('Task.descriptionHeader') ?></th>
              <th><?= lang('Task.createdAtHeader') ?></th>
              <th><?= lang('Task.actionsHeader') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tasks as $task): ?>
            <tr>
              <td><?= esc($task['description']) ?></td>
              <td><?= date('d M Y H:i:s', strtotime($task['created_at'])) ?></td>
              <td>
                <a href="<?= '/tasks/'. $task['id_task'] ?>" class="btn btn-primary">
                  <i class="bi bi-eye"></i>
                </a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <div class="d-flex gap-3 my-1">
          <button id="orderNewest" class="btn btn-dark"><?= lang('Task.orderNewest') ?></button>
          <button id="orderOldest" class="btn btn-dark"><?= lang('Task.orderOldest') ?></button>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

  <script>
    $(document).ready( function () {
      const table = $('#taskTable').DataTable({
        // options
        layout: {
          topStart: 'search',
          topEnd: 'pageLength'
        },
        columns: [
          { title: "" },
          { title: "" },
          { title: "" }
        ],
        responsive: true,
        paging: false,
        info: false,
        order: [[1, 'desc']],
        scrollY: '60vh',
        scrollCollapse: true,
        columnDefs: [
          { targets: 0, width: '100%' },
          {
            targets: 1,
            visible: false,
            searchable: false
          },
          { orderable: false, targets: [0,2] }
        ],
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/<?= service("request")->getLocale() === "es" ? "es-ES" : "en-GB" ?>.json'
        }
      });
      $('#orderNewest').on('click', function () {
        table.order([1, 'desc']).draw();
      });

      $('#orderOldest').on('click', function () {
        table.order([1, 'asc']).draw();
      });
    });
  </script>
<?= $this->endSection() ?>

