<?php

namespace app\core;

abstract class DbModel extends Model 
{
  abstract public function tableName();

  abstract public function columns();

  public function save()
  {
    $tableName = $this->tableName();
    $columns = $this->columns();
    $params = array_map(fn($col) => ":$col", $columns);
    $stmt = $this->prepare("INSERT INTO $tableName (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $params) . ")");

    foreach($columns as $column)
    {
      $stmt->bindValue(":$column", $this->{$column});
    }

    $stmt->execute();
    return true;
  }

  public function prepare($sql)
  {
    return App::$app->db->pdo->prepare($sql);
  }
}