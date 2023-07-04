<?php

namespace app\core;
use PDO;

class Database 
{
  public PDO $pdo;

  public function __construct()
  {
    $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
    $this->pdo = new PDO($dsn, DBUSER, DBPASSWORD);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function createMigrationsTable()
  {
    $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations 
      (id INT AUTO_INCREMENT PRIMARY KEY,
      migration VARCHAR(255),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      ) ENGINE = INNODB;
    ");
  }

  public function applyMigrations()
  {
    $this->createMigrationsTable();
    $appliedMigrations = $this->getAppliedMigrations();

    $newMigrations = [];
    $files = scandir(ROOT . '/migrations');
    $toApplyMigrations = array_diff($files, $appliedMigrations);

    foreach($toApplyMigrations as $migration)
    {
      if($migration === '.' || $migration === '..')
      {
        continue;
      }
      require_once ROOT . "/migrations/$migration";
      $className = pathinfo($migration, PATHINFO_FILENAME);
      $instance = new $className;
      $this->message('Applying migration ' . $migration . PHP_EOL);
      $instance->up();
      $this->message('Applied migration ' . $migration . PHP_EOL);
      $newMigrations[] = $migration;
    }
    if(!empty($newMigrations))
    {
      $this->saveMigrations($newMigrations);
    } else 
    {
      $this->message('All migrations are applied');
    }
  }

  public function getAppliedMigrations()
  {
    $stmt = $this->pdo->prepare("SELECT migration FROM migrations");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
  }

  public function saveMigrations($migrations)
  {
    $str = implode(', ', array_map(fn($m) => "('$m')", $migrations));

    $stmt = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
                        $str");
    $stmt->execute();
  }

  protected function message($message)
  {
    echo '[' . date('d-m-Y H:i:s') . '] - ' . $message;
  }

}