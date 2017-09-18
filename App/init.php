<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:39 PM
 * Copyright victor © 2017. All rights reserved.
 */

use App\Libs\Classes\Session;

/* All required file to get you going are required_once here... */
require_once __DIR__ . '/../App/Libs/config/paths.php';
require_once __DIR__ . '/../App/Libs/config/database.php';
require_once __DIR__ . '/../App/Libs/config/consts.php';
require_once __DIR__ . '/../App/Libs/helpers/functions.php';
require_once __DIR__ . '/../App/Libs/helpers/_autoloader.php';

/* Initialize Session here... */
Session::init();