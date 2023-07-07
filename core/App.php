<?php

namespace app\core;
use app\models\User;

class App 
{
  public Router $router;
  public Request $request;
  public Response $response;
  public Database $db;
  public Session $session;
  public ?DbModel $user;
  public User $userClass;
  public static App $app;

  public function __construct()
  {
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->session = new Session();
    $this->router = new Router($this->request, $this->response);
    $this->db = new Database();
    $this->userClass = new User();

    
    $value = $this->session->get('user');
    if($value)
    {
      $primaryKey = $this->userClass->primaryKey();
      $this->user = $this->userClass->find([$primaryKey => $value]);
    } else {
      $this->user = null;
    }
    
  }

  public function run()
  {
    echo $this->router->resolve();
  }

  public function login(DbModel $user)
  {
    $this->user = $user;
    $primaryKey = $user->primaryKey();
    $primaryValue = $user->{$primaryKey};
    $this->session->set('user', $primaryValue);
    return true;
  }

  public function logout()
  {
    $this->user = null;
    return $this->session->remove('user');
  }
}