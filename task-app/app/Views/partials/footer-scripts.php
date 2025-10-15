  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<!-- MESSAGE ON LOGOUT-->
<?php if (isset($_GET['exit']) && $_GET['exit'] === 'true'): ?>
  <div class="toast-container position-fixed bottom-0 end-0 p-3 z-3">
    <div id="toastLogout" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <?= lang("System.exit") ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
      </div>
    </div>
  </div>

  <script>
    const toastEl = document.getElementById('toastLogout');
    const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
    toast.show();
  </script>
<?php endif; ?>

<!-- GLOBAL ALERT MESSAGE -->
<?php if ($alert = session()->getFlashdata('alert')): ?>
  <div class="toast-container position-fixed bottom-0 end-0 p-3 z-3">
    <div id="appToast" class="toast align-items-center text-bg-<?= esc($alert['type']) ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <?= esc($alert['message']) ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
      </div>
    </div>
  </div>

  <script>
    const toastEl = document.getElementById('appToast');
    const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
    toast.show();
  </script>
<?php endif; ?>
</body>
</html>
