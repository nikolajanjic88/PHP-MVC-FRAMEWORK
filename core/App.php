<?php

namespace app\core;

class App 
{
  public Router $router;
  public Request $request;
  public Response $response;
  public Database $db;
  public static App $app;

  public function __construct()
  {
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
    $this->db = new Database();
  }

  public function run()
  {
    echo $this->router->resolve();
  }
}