<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 01 06, 2017 @ 8:05 PM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Libs\Classes;


abstract class Cookie
{

  const EXPIRE_ONE_WEEK = 10080;
  const EXPIRE_TWO_WEEKS = 20160;
  const EXPIRE_THREE_WEEKS = 30240;
  const EXPIRE_ONE_MONTH = 40320;
  const EXPIRE_TWO_MONTH = 80640;
  const EXPIRE_THREE_MONTH = 120960;

  /**
   * Sets a cookie
   * @param $key
   * @param $value
   * @param int $expire
   */
  public static function set($key, $value, $expire=self::EXPIRE_ONE_MONTH)
  {
    setcookie($key, $value, time()+$expire);
  }

  /**
   * Retrieve a cookie
   * @param $key
   * @return bool
   */
  public static function get($key)
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : false;
  }

  /**
   * Removes a cookie
   * @param $key
   */
  public static function remove($key)
  {
    if ( isset($_COOKIE[$key]) ) setcookie($key, "", time()-self::EXPIRE_ONE_WEEK);
  }

  /**
   * Deletes all cookies
   */
  public static function destroy()
  {
    $_COOKIE = [];
  }

}