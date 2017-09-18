<?php

/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:45 PM
 * Copyright victor © 2017. All rights reserved.
 */
namespace App\Controllers;

use App\Core\Controller;

class _ErrorController extends Controller
{

  /**
   * _ErrorController constructor.
   */
  public function __construct()
  {
    parent::__construct();
    $this->view->title = "Error";
    $this->view->css = ["error-page"];
  }

  /**
   * Renders custom error view for a specified error type
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @param null $type
   * @param string $status
   * @return mixed|void
   */
  public function index($type = null, $status = "")
  {
    $this->view->notice = $status;
    switch ($type) {
      case 404:
        $this->view->render('_error/404');
        break;
      case 500:
        $this->view->render('_error/500');
        break;
      default:
        $this->view->render('_error/index');
    }
  }

}