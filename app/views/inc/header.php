<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= SITE_NAME . ' | ' . $data['title']; ?></title>

  <!-- bootstrap -->
  <link rel="stylesheet" href="<?= ROOT; ?>/css/bootstrap4.3.1.min.css">

  <!-- font awesome -->
  <link rel="stylesheet" href="<?= ROOT; ?>/css/all.min.css">

  <link rel="stylesheet" href="<?= ROOT; ?>/css/main.css">
</head>

<body>
  <?php require APP_ROOT . '/views/inc/navbar.php'; ?>

  <!-- bootstrap container -->
  <div class="container">