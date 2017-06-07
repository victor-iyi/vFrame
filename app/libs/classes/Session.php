<?php

/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/28/17
 * Time: 7:56 PM
 */

namespace App\Libs\Classes;


abstract class Session
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
   * Removes a session key from the $_SESSION
   * @param $key
   */
  public static function remove($key)
  {
    if (isset($_SESSION[$key]))
      unset($_SESSION[$key]);
  }

  /**
   * Destroys all sessions
   */
  public static function destroy()
  {
    session_destroy();
    $_SESSION = [];
  }

}