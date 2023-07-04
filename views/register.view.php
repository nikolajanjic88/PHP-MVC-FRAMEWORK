<?php include_once "inc/header.php" ?>
  <div class="container">
    <h1>Register</h1>
    <form action="" method="post">
      <input type="text" name="name" value="<?= $model->name ?>">
      <br>
      <?= $model->getFirstError('name') ?? false ?>
      <br>
      <input type="email" name="email" value="<?= $model->email ?>">
      <br>
      <?= $model->getFirstError('email') ?? false ?>
      <br>
      <input type="password" name="password">
      <br>
      <?= $model->getFirstError('password') ?? false ?>
      <br>
      <button>Submit</button>
    </form>
  </div>
<?php include_once "inc/footer.php" ?>