<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:56 PM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Libs\Classes\Api;


class User extends APIAble
{

  /**
   * This endpoint needs  GET request
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @endpoint /user/get
   * @method GET
   * @args
   * @param null|API $api
   * @internal param $args
   * @return array
   */
  function get($api = null)
  {
    if ($api->method !== "GET") return [
      "status" => false,
      "response" => [
        "msg" => "Uses: Invalid invocation",
        "status" => 401,
        "payload" => null
      ]
    ];
    return [
      "status" => true,
      "response" => [
        "msg" => "Uses: This is a GET example",
        "status" => 200,
        "payload" => [
          "data" => [
            "name" => "John Doe",
            "email" => "john@doe.com",
            "password" => _hash("john")
          ],
        ]
      ]
    ];
  }

  /**
   * This endpoint needs a POST request
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @endpoint /user/verify
   * @method POST
   * @args $email, password
   * @param null|API $api
   * @return array
   */
  function verify($api = null)
  {
    if ($api->method !== "POST") return [
      "status" => false,
      "response" => [
        "msg" => "Uses: Invalid invocation",
        "status" => 400
      ]
    ];
    extract($_POST);
    # Check up the posted args.
    if (isset($email) && isset($password)) {
      # Call some model to verify user
      # If success: return  success message
      return [
        "status" => true,
        "response" => [
          "msg" => "Uses: This is a valid user",
          "status" => 200,
        ]
      ];
      # if error: return error msg
      /*
      return [
        "status" => false,
        "response" => [
          "msg" => "Uses: Not a valid user",
          "status" => 403,
        ]
      ];
      */
    }
    return [
      "status" => false,
      "response" => [
        "msg" => "Uses: Unexpected argument",
        "status" => 401
      ]
    ];
  }

}