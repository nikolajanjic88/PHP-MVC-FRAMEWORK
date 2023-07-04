<?php

namespace app\core;

class Request 
{
  public function getPath() 
  {
    $path = parse_url($_SERVER['REQUEST_URI'])['path'] ?? '/';
    return $path;
  }

  public function getMethod() 
  {
    $method = strtolower($_SERVER['REQUEST_METHOD']);
    return $method;
  }

  public function getBody()
  {
    $body = [];
    if($this->getMethod() === 'get')
    {
      foreach($_GET as $key => $value)
      {
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    if($this->getMethod() === 'post')
    {
      foreach($_POST as $key => $value)
      {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    return $body;
  }
}