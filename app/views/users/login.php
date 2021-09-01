<?php require APP_ROOT . '/views/inc/header.php'; ?>

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <?php flash('register_success'); ?>

      <h2>Login</h2>
      <br>
      <form action="<?= ROOT; ?>/users/login" method="POST">
        <div class="form-group">
          <label for="email">Email: <sup>*</sup></label>
          <input type="email" name="email" id="" class="form-control form-control-md <?= (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['email']; ?>">
          <span class="invalid-feedback"><?= $data['email_err']; ?></span>
        </div>
        <div class="form-group">
          <label for="password">Password: <sup>*</sup></label>
          <input type="password" name="password" id="" class="form-control form-control-md <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['password']; ?>">
          <span class="invalid-feedback"><?= $data['password_err']; ?></span>
        </div>
        <div class="row">
          <div class="col">
            <input type="submit" value="Login" class="btn btn-success btn-block">
          </div>
          <div class="col">
            <a href="<?= ROOT; ?>/users/register" class="btn btn-light btn-block">Don't have an account? Register here</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>