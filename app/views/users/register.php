<?php require APP_ROOT . '/views/inc/header.php'; ?>

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Create an account</h2>
      <p>Please fill out this form to register with us</p>

      <form action="<?= ROOT; ?>/users/register" method="POST">
        <div class="form-group">
          <label for="name">Name: <sup>*</sup></label>
          <input type="text" name="name" id="" class="form-control form-control-md <?= (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['name']; ?>">
          <span class="invalid-feedback"><?= $data['name_err']; ?></span>
        </div>
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
        <div class="form-group">
          <label for="password">Confirm Password: <sup>*</sup></label>
          <input type="password" name="cpassword" id="" class="form-control form-control-md <?= (!empty($data['cpassword_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['cpassword']; ?>">
          <span class="invalid-feedback"><?= $data['cpassword_err']; ?></span>
        </div>
        <div class="row">
          <div class="col">
            <input type="submit" value="Register" class="btn btn-success btn-block">
          </div>
          <div class="col">
            <a href="<?= ROOT; ?>/users/login" class="btn btn-light btn-block">Already have an account? Login here</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>