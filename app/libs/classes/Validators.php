<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 31 05, 2017 @ 5:00 PM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Libs\Classes;


class Validators
{

  /**
   * Checks for a valid email (e.g example@email.com)
   * @param $email
   * @return bool
   */
  public static function validateEmail($email)
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  /**
   * Password Validator ensures password is at least 4 characters long
   * @param $password
   * @param int $length
   * @return bool
   */
  public static function validatePassword($password, $length = 3)
  {
    return strlen($password) > $length;
  }

}