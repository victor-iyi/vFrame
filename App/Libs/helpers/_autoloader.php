<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 4:01 PM
 * Copyright victor © 2017. All rights reserved.
 */

spl_autoload_register(function($className){
  $className = preg_replace('/\\\/', DIRECTORY_SEPARATOR, $className);
  require_once __DIR__ . '/../../../' . strtolower($className) . '.php';
});