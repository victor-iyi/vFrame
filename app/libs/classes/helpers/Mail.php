<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 07 06, 2017 @ 11:37 AM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Libs\Classes\Helpers;


class Mail
{

  /**
   * Sends an email
   * @param $to -> who you are sending the e-mail to
   * @param $title -> title of the mail
   * @param $message -> actual message you want to send
   * @param null $headers
   * @return bool
   */
  public function send($to, $title, $message, $headers=null)
  {
    $headers = $headers ? $headers : "From: {$to}";
    if ( !Validators::validateEmail($to) ) return false;
    return mail($to, $title, $message, $headers);
  }

}