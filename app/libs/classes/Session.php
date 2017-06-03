<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:53 PM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Libs\Classes;


class Session
{
  /**
   * Starts a session.
   */
  public static function init()
  {
    session_start();
  }

  /**
   * Sets a $_SESSION given a key
   * @param $key
   * @param $value
   */
  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  /**
   * Retrieve a $_SESSION
   * @param $key
   * @return bool
   */
  public static function get($key)
  {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
  }

  /**
   * Destroys a $_SESSION
   */
  public static function destroy()
  {
    session_destroy();
    $_SESSION = [];
  }

}