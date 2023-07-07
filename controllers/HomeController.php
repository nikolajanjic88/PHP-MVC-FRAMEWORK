<?php

namespace app\controllers;
use app\core\Controller;

class HomeController extends Controller
{
  public function index()
  {
    $params = [];
    return $this->view('home', $params);
  }

}