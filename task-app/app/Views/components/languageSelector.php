<form action="/set-language" method="post" class="d-inline">
  <select name="lang" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
    <option value="es" <?= session('lang') === 'es' ? 'selected' : '' ?>><?= lang('Languaje.spanish') ?></option>
    <option value="en" <?= session('lang') === 'en' ? 'selected' : '' ?>><?= lang('Languaje.english') ?></option>
  </select>
</form>

