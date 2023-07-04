<?php

namespace app\core;

class Controller 
{
  public function view($view, $params = [])
  {
    return App::$app->router->view($view, $params);
  }
}