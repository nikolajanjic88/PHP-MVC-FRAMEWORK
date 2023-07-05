<?php

namespace app\core;

class Response 
{
  public function setStatucCode(int $code = 404)
  {
    http_response_code($code);
  }

  public function redirect($url)
  {
    header('Location: ' . $url);
  }
}