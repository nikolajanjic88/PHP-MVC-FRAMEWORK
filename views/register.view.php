<?php include_once "inc/header.php" ?>
  <div class="container">
    <h1>Register</h1>
    <form action="" method="post">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $model->name ?>">
        <?= "<div class='error'>" . $model->getFirstError('name') ?? false . "</div>" ?>
      </div>
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