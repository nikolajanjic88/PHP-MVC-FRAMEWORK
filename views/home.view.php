<?php include_once "inc/header.php" ?>
  <div class="container">
  <?php include_once "inc/navbar.php" ?>
    <?php
      use app\core\App;
      if(App::$app->session->getFlash('success')):
    ?>
    <div class="alert alert-success">
        <?= App::$app->session->getFlash('success') ?>
    </div>
    <?php endif ?>
    <h1>Home Page</h1>
  </div>
<?php include_once "inc/footer.php" ?>