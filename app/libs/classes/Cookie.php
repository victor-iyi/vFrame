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

  # !- 1 - 3 weeks
  const EXPIRE_ONE_WEEK = 10080;
  const EXPIRE_TWO_WEEKS = 20160;
  const EXPIRE_THREE_WEEKS = 30240;
  # !- 1 - 3 months
  const EXPIRE_ONE_MONTH = 40320;
  const EXPIRE_TWO_MONTH = 80640;
  const EXPIRE_THREE_MONTH = 120960;

  /**
   * Sets a cookie
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
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
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @param $key
   * @return bool
   */
  public static function get($key)
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : false;
  }

  /**
   * Removes a cookie
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @param $key
   */
  public static function remove($key)
  {
    if ( isset($_COOKIE[$key]) ) setcookie($key, "", time()-self::EXPIRE_ONE_WEEK);
  }

  /**
   * Deletes all cookies
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   */
  public static function destroy()
  {
    $_COOKIE = [];
  }

}