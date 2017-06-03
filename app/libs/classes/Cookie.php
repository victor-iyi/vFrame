<?php

/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:52 PM
 * Copyright victor © 2017. All rights reserved.
 */
namespace App\Libs\Classes;


class Cookie
{

  const EXPIRE_ONE_WEEK = 10080;
  const EXPIRE_TWO_WEEKS = 20160;
  const EXPIRE_THREE_WEEKS = 30240;
  const EXPIRE_ONE_MONTH = 40320;
  const EXPIRE_TWO_MONTH = 80640;
  const EXPIRE_THREE_MONTH = 120960;

  public static function set($key, $value, $expire=self::EXPIRE_ONE_MONTH)
  {
    setcookie($key, $value, time()+$expire);
  }

  public static function get($key)
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : false;
  }

  public static function destroy($key)
  {
    if ( isset($_COOKIE[$key]) ) setcookie($key, "", time()-self::EXPIRE_ONE_WEEK);
  }

}