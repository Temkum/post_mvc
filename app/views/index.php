<?php require APP_ROOT . '/views/inc/header.php'; ?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-3"><?= $data['title']; ?></h1>
    <p class="lead"><?= $data['description']; ?></p>
    <hr class="my-2">
    <p>More info</p>
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Jumbo action name</a>
    </p>
  </div>
</div>
<h2></h2>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>