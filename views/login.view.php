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
    <h1>Login</h1>
    <form action="" method="post">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $model->email ?>">
        <?= "<div class='error'>" . $model->getFirstError('email') ?? false . "</div>" ?>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" class="form-control" name="password">
        <?= "<div class='error'>" . $model->getFirstError('password') ?? false . "</div>" ?>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
<?php include_once "inc/footer.php" ?>