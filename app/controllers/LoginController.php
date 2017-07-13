<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 13 07, 2017 @ 6:52 PM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Controllers;


use App\Core\Controller;

class LoginController extends Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->view->title = "Login";
  }

  /**
   * Default method run by every controller.
   * @return mixed
   */
  public function index()
  {
    $this->view->render("login/index");
  }

}