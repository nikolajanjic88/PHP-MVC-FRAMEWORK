<?php include_once "inc/header.php" ?>
  <div class="container">
    <?php
      use app\core\App;
      if(App::$app->session->getFlash('success')):
    ?>
    <div class="alert alert-success">
        <?= App::$app->session->getFlash('success') ?>
    </div>
    <?php endif ?>
    <h1>Home Page</h1>
    <h3>Hello, <?= $name ?></h3>
  </div>
<?php include_once "inc/footer.php" ?>