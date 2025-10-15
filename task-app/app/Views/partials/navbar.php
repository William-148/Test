<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="/"><?= lang("Navbar.home") ?></a>
    <?= view('components/languageSelector') ?>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRight">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarRight">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/sign-up"><?= lang("Navbar.signUp") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/sign-in"><?= lang("Navbar.signIn") ?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

