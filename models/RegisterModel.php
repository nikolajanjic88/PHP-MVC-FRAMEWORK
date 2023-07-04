<?php

namespace app\models;
use app\core\Model;

class RegisterModel extends Model
{
  public $name;
  public $email;
  public $password;

  public function register()
  {

  }

  public function rules()
  {
    return [
      'name' => ['required'],
      'email' => ['required', 'email'],
      'password' => ['required', 'min']
    ];
  }
}