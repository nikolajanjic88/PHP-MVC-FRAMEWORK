<?php

namespace app\models;
use app\core\DbModel;

class User extends DbModel
{
  public $name;
  public $email;
  public $password;

  public function tableName()
  {
    return 'users';
  }

  public function columns()
  {
    return ['name', 'email', 'password'];
  }

  public function save()
  {
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::save();
  }

  public function rules()
  {
    return [
      'name' => ['required'],
      'email' => ['required', 'email', ['unique', 'class' => self::class]],
      'password' => ['required', 'min']
    ];
  }

  public function primaryKey()
  {
    return 'id';
  }
}