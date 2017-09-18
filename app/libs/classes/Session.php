<?php

/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 28 05, 2017 @ 7:56 PM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Libs\Classes;


abstract class Session
{

  /**
   * Starts a session
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   */
  public static function init()
  {
    session_start();
  }

  /**
   * Sets a session given a key
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @param $key
   * @param $value
   */
  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  /**
   * Retrieve a session by key
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @param $key
   * @return bool
   */
  public static function get($key)
  {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
  }

  /**
   * Removes a session key from $_SESSION
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @param $key
   */
  public static function remove($key)
  {
    if (isset($_SESSION[$key]))
      unset($_SESSION[$key]);
  }

  /**
   * Destroy all sessions
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   */
  public static function destroy()
  {
    session_destroy();
    $_SESSION = [];
  }

}