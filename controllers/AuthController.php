<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\core\App;

class AuthController extends Controller
{
  public User $user;

  public function __construct()
  {
    $this->user = new User();
  }

  public function index()
  {
    return $this->view('register', ['model' => $this->user]);
  }

  public function store(Request $request)
  {
    
    $this->user->loadData($request->getBody());

    if($this->user->validate() && $this->user->save())
    {
      App::$app->session->setFlash('success', 'You have registered successfully');
      App::$app->response->redirect('/');
      die();
    }

    return $this->view('register', ['model' => $this->user]);
  }
}