<?php require APP_ROOT . '/views/inc/header.php'; ?>

<div class="row">
  <div class="col-md-6 mx-auto">
    <a href="<?= ROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
    <div class="card card-body bg-light mt-5">
      <h2>Add Post</h2>
      <br>
      <form action="<?= ROOT; ?>/posts/add" method="POST">
        <div class="form-group">
          <label for="title">Title: <sup>*</sup></label>
          <input type="text" name="title" id="" class="form-control form-control-md <?= (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['title']; ?>">
          <span class="invalid-feedback"><?= $data['title_err']; ?></span>
        </div>
        <div class="form-group">
          <label for="body">Post: <sup>*</sup></label>
          <textarea cols="30" rows="6" name="body" id="" class="form-control form-control-md <?= (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?= $data['body']; ?>
          </textarea>
          <span class="invalid-feedback"><?= $data['body_err']; ?></span>
        </div>
        <div class="row">
          <div class="col">
            <input type="submit" value="Post" class="btn btn-success btn-block">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>