<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
  public RegisterModel $registerModel;

  public function __construct()
  {
    $this->registerModel = new RegisterModel();
  }

  public function index()
  {
    return $this->view('register', ['model' => $this->registerModel]);
  }

  public function store(Request $request)
  {
    
    $this->registerModel->loadData($request->getBody());

    if($this->registerModel->validate() && $this->registerModel->register())
    {
      return 'SUCCESS';
    }

    return $this->view('register', ['model' => $this->registerModel]);
  }
}