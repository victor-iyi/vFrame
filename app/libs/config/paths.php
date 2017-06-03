<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 4:00 PM
 * Copyright victor © 2017. All rights reserved.
 */

#!- read config.ini
$ini = parse_ini_file(__DIR__ . '/../../config.ini');

# path config
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR);
define('PROJECT_PATH', $ini['project_path']);
define('APP_ROOT', __DIR__ . '/../../');
define('ASSET_PATH', PROJECT_PATH . 'assets/');
define('VIEW_PATH', APP_ROOT . 'views/');
define('LAYOUT_PATH', VIEW_PATH . '_layouts/');
define('VIEW_INCLUDE_PATH', VIEW_PATH . '_includes/');
