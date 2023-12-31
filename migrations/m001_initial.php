<?php

use app\core\App;

class m001_initial 
{
  public function up()
  {
    $db = App::$app->db;
    $sql = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;";
    $db->pdo->exec($sql);
  }

  public function down()
  {
    $db = App::$app->db;
    $sql = "DROP TABLE users;";
    $db->pdo->exec($sql);
  }
}