<?php

namespace app\core;
use app\core\Request;

class Router 
{
  public Request $request;
  public Response $response;
  
  protected array $routes = [];

  public function __construct(Request $request, Response $response) 
  {
    $this->request = $request;
    $this->response = $response;
  }

  public function get($path, $callback) 
  {
    $this->routes['get'][$path] = $callback;
  }

  public function post($path, $callback) 
  {
    $this->routes['post'][$path] = $callback;
  }

  public function resolve()
  {
    $path = $this->request->getPath();
    $method = $this->request->getMethod();
    $callback = $this->routes[$method][$path] ?? false;

    if($callback === false)
    {
      $this->response->setStatucCode();
      return $this->view('404');
    }

    return call_user_func($callback, $this->request);
  }

  public function view($view, $params = []) 
  {
    foreach($params as $key => $value)
    {
      $$key = $value;
    }
    include_once ROOT . "/views/$view.view.php";
  }
}