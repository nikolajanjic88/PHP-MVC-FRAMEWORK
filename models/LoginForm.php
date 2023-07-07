<?php

namespace app\models;
use app\core\Model;
use app\core\App;
use app\core\Session;

class LoginForm extends Model
{
  public $email = '';
  public $password = '';
  public Session $session;
  public User $user;

  public function __construct()
  {
    $this->session = new Session();
    $this->user = new User();
  }

  public function rules()
  {
    return [
      'email' => ['required', 'email'],
      'password' => ['required']
    ];
  }

  public function login()
  {
    $user = $this->user->find(['email' => $this->email]);
    if(!$user) 
    {
      $this->addError('email', 'User does not exist');
      return false;
    }

    if(!password_verify($this->password, $user->password))
    {
      $this->addError('password', 'Password is incorrect');
      return false;
    }
    
    return App::$app->login($user);
  }

  public function logout()
  {
    $this->user = null;
    $this->session->remove('user');
  }
}
