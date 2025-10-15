<?= view('partials/header') ?>

<?= view('partials/navbar-user') ?>
<main class="container py-5">
  <div class="row align-items-center">
    <div class="col-lg-7 mb-4 mb-lg-0">
      <h1 class="display-5 fw-bold text-success">¡Hola Usuario!</h1>
      <p class="lead mt-3">Bienvenido de nuevo a <strong>TaskApp</strong>. Aquí puedes gestionar tus tareas, revisar tu progreso y mantenerte organizado.</p>
      <ul class="list-group list-group-flush mt-4">
        <li class="list-group-item">📝 Crear nuevas tareas</li>
        <li class="list-group-item">📋 Ver tus tareas pendientes</li>
        <li class="list-group-item">✅ Marcar tareas como completadas</li>
        <li class="list-group-item">📊 Ver estadísticas de productividad</li>
      </ul>
    </div>
    <div class="col-lg-5 text-center">
      <img src="https://cdn-icons-png.flaticon.com/512/7792/7792148.png" alt="Tareas" class="img-fluid" style="max-height: 280px;">
    </div>
  </div>
</main>

<?= view('partials/footer-scripts') ?>
