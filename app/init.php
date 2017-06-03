<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:39 PM
 * Copyright victor © 2017. All rights reserved.
 */

/* Initialize Session here... */
use App\Libs\Classes\Session;

/* All required file to get you going are required_once here... */
require_once __DIR__ . '/../app/libs/config/paths.php';
require_once __DIR__ . '/../app/libs/config/database.php';
require_once __DIR__ . '/../app/libs/helpers/functions.php';
require_once __DIR__ . '/../app/libs/helpers/_autoloader.php';

Session::init();
