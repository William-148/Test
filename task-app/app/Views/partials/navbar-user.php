<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="/dashboard"><?= lang("NavbarUser.home") ?></a>
    <?= view('components/languageSelector') ?>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRight">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarRight">
      <ul class="navbar-nav">
        <?php if (session()->get('isLoggedIn')): ?>
          <li class="nav-item">
            <span class="nav-link"><?= lang("NavbarUser.welcome") ?>, <?= esc(session()->get('name')) ?></span>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="/sign-in"><?= lang("NavbarUser.profile") ?></a>
        </li>
        <?php if (session()->get('isLoggedIn') && session()->get('administrator')): ?>
          <li class="nav-item">
            <a class="nav-link" href="/sign-in"><?= lang("NavbarUser.users") ?></a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="/sign-in"><?= lang("NavbarUser.tasks") ?></a>
        </li>
        <li class="nav-item">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <?= lang("NavbarUser.logout") ?>
          </button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="logoutModalLabel"><?= lang("NavbarUser.logoutTitle") ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <?= lang("NavbarUser.logoutMessage") ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang("NavbarUser.logoutCancel") ?></button>
        <form action="/sign-out" method="post">
          <button type="submit" class="btn btn-danger"><?= lang("NavbarUser.logoutAccept") ?></button>
        </form>
      </div>
    </div>
  </div>
</div>

