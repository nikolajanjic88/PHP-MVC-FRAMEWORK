<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\models\LoginForm;
use app\core\App;

class AuthController extends Controller
{
  public User $user;
  public LoginForm $loginForm;

  public function __construct()
  {
    $this->user = new User();
    $this->loginForm = new LoginForm();
  }

  public function registerView()
  {
    return $this->view('register', ['model' => $this->user]);
  }

  public function store(Request $request)
  {
    $this->user->loadData($request->getBody());

    if($this->user->validate() && $this->user->save())
    {
      App::$app->session->setFlash('success', 'You have registered successfully');
      App::$app->response->redirect('/login');
      die();
    }

    return $this->view('register', ['model' => $this->user]);
  }

  public function loginView()
  {
    return $this->view('login', ['model' => $this->loginForm]);
  }

  public function login(Request $request)
  {
    $this->loginForm->loadData($request->getBody());
    if($this->loginForm->validate() && $this->loginForm->login())
    {
      App::$app->session->setFlash('success', 'You have logged in successfully');
      App::$app->response->redirect('/');
      die();
    }
    return $this->view('login', ['model' => $this->loginForm]);
  }

  public function logout(Request $request)
  {
    App::$app->logout();
    App::$app->session->setFlash('success', 'You have logged out successfully');
    App::$app->response->redirect('/');
    die();
  }
  
}