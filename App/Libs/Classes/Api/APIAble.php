<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:57 PM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Libs\Classes\Api;


abstract class APIAble
{

  /**
   * Tells if supplied method name exists
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @param $method_name
   * @return bool
   */
  public function hasMethod($method_name)
  {
    return method_exists($this, $method_name);
  }

}