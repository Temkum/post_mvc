<?php require APP_ROOT . '/views/inc/header.php'; ?>

<div class="card text-center">
  <div class="card-header">
    <?= $data['post']->title; ?>
  </div>
  <div class="card-body">
    <!-- <h5 class="card-title"><?= $data['post']->title; ?></h5> -->
    <p class="card-text"><?= $data['post']->body; ?></p>
    <a href="<?= ROOT; ?>/posts" class="btn btn-primary btn-sm">Back to Posts</a>
  </div>

  <?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>

    <div class="card-footer text-muted">
      <a href="<? ROOT; ?>/posts/edit/<?= $data['post']->id; ?>" class="btn btn-dark">Edit</a>
      <!-- delete req -->
      <form class="pull-right" action="<?= ROOT; ?>/posts/delete/<?= $data['post']->id; ?>">
        <input type="submit" value="Delete" class="btn btn-danger">
      </form>
    </div>
  <?php endif; ?>
</div>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>