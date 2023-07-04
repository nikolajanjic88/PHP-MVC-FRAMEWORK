<?php

use app\core\App;

class m002_add_column_password
{
  public function up()
  {
    $db = App::$app->db;
    $sql = "ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL;";
    $db->pdo->exec($sql);
  }

  public function down()
  {
    $db = App::$app->db;
    $sql = "ALTER TABLE users DROP COLUMN password;";
    $db->pdo->exec($sql);
  }
}