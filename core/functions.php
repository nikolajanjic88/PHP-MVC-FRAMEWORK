<?php

function dd($str) 
{
  echo '<pre>';
  var_dump($str);
  echo '</pre>';
  die();
}

function asset($filePath)
{
  return "/assets/$filePath";
}