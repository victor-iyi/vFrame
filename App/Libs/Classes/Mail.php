<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 07 06, 2017 @ 11:37 AM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Libs\Classes;


abstract class Mail
{

  /**
   * Sends an email
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @param $to -> who you are sending the e-mail to
   * @param $title -> title of the mail
   * @param $message -> actual message you want to send
   * @param null $headers
   * @return bool
   */
  public static function send($to, $title, $message, $headers=null)
  {
    $headers = $headers ? $headers : "From: {$to}";
    return ( !Validators::validateEmail($to) )  ? false : mail($to, $title, $message, $headers);
  }

}