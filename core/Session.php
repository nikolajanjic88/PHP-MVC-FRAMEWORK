<?php

namespace app\core;

class Session 
{
  protected const FLASH_MESSAGES_KEY = 'flash_messages';

  public function __construct()
  {
    session_start();
    $flashMessages = $_SESSION[self::FLASH_MESSAGES_KEY] ?? [];
    foreach($flashMessages as &$flashMessage)
    {
      $flashMessage['remove'] = true;
    }
    $_SESSION[self::FLASH_MESSAGES_KEY] = $flashMessages;
  }

  public function setFlash($key, $message)
  {
    $_SESSION[self::FLASH_MESSAGES_KEY][$key] = [
      'remove' => false,
      'value' => $message
    ];
  }

  public function getFlash($key)
  {
    return $_SESSION[self::FLASH_MESSAGES_KEY][$key]['value'] ?? false;
  }

  public function __destruct()
  {
    $flashMessages = $_SESSION[self::FLASH_MESSAGES_KEY] ?? [];
    foreach($flashMessages as $key => &$flashMessage)
    {
      if($flashMessage['remove'] === true)
      {
        unset($flashMessages[$key]);
      }
    }
    $_SESSION[self::FLASH_MESSAGES_KEY] = $flashMessages;
  }
}