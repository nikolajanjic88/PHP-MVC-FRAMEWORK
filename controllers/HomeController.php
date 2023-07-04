<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class HomeController extends Controller
{
  public function index()
  {
    $params = ['name' => 'Nikola'];
    return $this->view('home', $params);
  }

}