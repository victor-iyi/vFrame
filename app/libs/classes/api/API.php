<?php

/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:54 PM
 * Copyright victor © 2017. All rights reserved.
 */
namespace App\Libs\Classes\Api;


abstract class API
{

  public $args;
  public $file;
  public $method;
  public $request;

  protected $entity;
  protected $endpoint;

  protected $class_tree = [
    'user' => User::class
  ];

  /**
   * API constructor.
   * @param $request
   * @throws \Exception
   */
  public function __construct($request)
  {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-Type: application/json");

    #!- fetch the args
    $this->args = explode('/', $request);
    $this->_dieTest();

    #!- fetch the entity (class)
    $this->entity = array_shift($this->args);
    $this->_dieTest();

    #!- fetch the endpoint (method)
    $this->endpoint = array_shift($this->args);

    #!- figure out the HTTP request method
    $this->method = $_SERVER['REQUEST_METHOD'];
    if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
      switch ($_SERVER['HTTP_X_HTTP_METHOD']) {
        case 'PUT':
          $this->method = 'PUT';
          break;
        case 'DELETE':
          $this->method = 'DELETE';
          break;
        case 'PATCH':
          $this->method = 'PATCH';
          break;
        default:
          throw new \Exception("Invalid request method");
          break;
      }
    }

    switch ($this->method) {
      case "DELETE":
      case "PATCH":
      case "POST":
        $this->request = $this->_sanitize($_POST);
        break;
      case "GET":
        $this->request = $this->_sanitize($_GET);
        break;
      case "PUT":
        $this->request = $this->_sanitize($_GET);
        $this->file = file('php://input');
        break;
    }
  }

  /**
   * Performs the API operation
   * @return string
   */
  public function execute()
  {
    $class = $this->_getClass($this->entity);

    if ($class->hasMethod($this->endpoint)) {
      return $this->_response($class->{$this->endpoint}($this));
    }
    return $this->_response("No Endpoint: $this->endpoint", 404);
  }

  /**
   * Tests if an exception must be thrown, based on args length
   */
  private function _dieTest()
  {
    if (count($this->args) == 0) throw new \Exception("Invalid API request");
  }

  /**
   * Recursively cleans an array input
   * @param $data
   * @return array|string
   */
  private function _sanitize($data)
  {
    $clean_input = Array();
    if (is_array($data)) {
      foreach ($data as $k => $v) {
        $clean_input[$k] = $this->_sanitize($v);
      }
    } else {
      $clean_input = trim(strip_tags($data));
    }
    return $clean_input;
  }

  /**
   * Error disambiguation
   * @param $code
   * @return mixed
   */
  private function _statusCode($code)
  {
    $status = [
      200 => 'OK',
      404 => 'Not Found',
      405 => 'Method Not Allowed',
      500 => 'Internal Server Error'
    ];
    return ($status[$code]) ? $status[$code] : $status[500];
  }

  /**
   * Process data, and output appropriate header
   * @param $data
   * @param int $status
   * @return string
   */
  private function _response($data, $status = 200)
  {
    header("HTTP/1.1 " . $status . " " . $this->_statusCode($status));
    return json_encode($data);
  }

  /**
   * @param $className
   * @return APIAble
   * @throws \Exception
   */
  private function _getClass($className)
  {
    $className = strtolower($className);
    if (!array_key_exists($className, $this->class_tree)) throw new \Exception('API Invalid entity call');
    return new $this->class_tree[$className];
  }

}