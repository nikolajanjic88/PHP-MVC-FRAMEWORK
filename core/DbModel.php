<?php

namespace app\core;

abstract class DbModel extends Model 
{
  abstract public function tableName();

  abstract public function columns();

  abstract public function primaryKey();

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

  public function find($where)
  {
    $tableName = static::tableName();
    $attributes = array_keys($where);
    $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
    $stmt = self::prepare("SELECT * FROM $tableName WHERE $sql");
    foreach($where as $key => $value)
    {
      $stmt->bindValue(":$key", $value);
    }
    $stmt->execute();
    return $stmt->fetchObject(static::class);
  }

}