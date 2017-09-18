<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:50 PM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Core;


use App\Libs\Classes\Api\APIv1;

class Api
{

  private $version;

  /**
   * Api constructor.
   */
  public function __construct()
  {
    $url = $this->__parseURL();

    if (isset($url[0])) {
      $this->version = $url[0];
      unset($url[0]);
      if ( count($url) > 0 ) {
        $url = $url ?implode("/", $url) : "";
        switch ($this->version) {
          default:
            $api = new APIv1($url);
            break;
        }
        echo $api->execute();
      }
    }

  }

  /**
   * Sanitizes and splits up the URL into an array
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @return array
   */
  private function __parseURL()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
    return null;
  }

}