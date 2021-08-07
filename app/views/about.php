<?php require APP_ROOT . '/views/inc/header.php'; ?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h2 class="display-3"><?= $data['title']; ?></h2>
    <p class="lead"><?= $data['description']; ?></p>
    <hr class="my-2">
    <p>Version: <strong><?= APP_VERSION ?></strong></p>
  </div>
</div>
<h2></h2>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>