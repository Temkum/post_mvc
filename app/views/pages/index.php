<?php require APP_ROOT . '/views/inc/header.php'; ?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-3"><?= $data['title']; ?></h1>
    <p class="lead"><?= $data['description']; ?></p>
    <hr class="my-2">
  </div>

  <ul>
    <?php
    foreach ($data['posts'] as $post) :  ?>
      <li><?= $post->title; ?> </li>
    <?php endforeach; ?>
  </ul>
</div>
<h2></h2>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>