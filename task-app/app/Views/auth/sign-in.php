<?= view('partials/header') ?>
<?= view('partials/navbar') ?>

<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <h2 class="mb-4 text-center"><?= lang('SignIn.title') ?></h2>

      <form action="/sign-in" method="post">
        <div class="mb-3">
          <label for="email" class="form-label"><?= lang('SignIn.email') ?></label>
          <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label"><?= lang('SignIn.password') ?></label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" name="remember" id="remember">
          <label class="form-check-label" for="remember"><?= lang('SignIn.rememberMe') ?></label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
          <button type="submit" class="btn btn-primary"><?= lang('SignIn.submit') ?></button>
          <a href="/forgot-password" class="text-decoration-none"><?= lang('SignIn.forgotPassword') ?></a>
        </div>
      </form>
    </div>
  </div>
</main>

<?= view('partials/footer') ?>
<?= view('partials/footer-scripts') ?>
