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

  /**
   * LoginController constructor.
   */
  public function __construct()
  {
    parent::__construct();  // this is necessary to be able to gain access to the View class
  }

  /**
   * Default method run by every controller.
   * @endpoint  /vFrame/login (or /vFrame/login/index)
   * @return mixed
   */
  public function index()
  {
    $this->view->title = "Login | Users"; // sets the page title
    $this->view->render("login/index"); // loads the login/index view
  }


  /**
   * admin login section
   * @endpoint /vFrame/login/admin
   * @credit: Victor I. Afolabi
   */
  public function admin()
  {
    $this->view->title = "Login | Admin"; // sets the page title
    $this->view->render("login/admin"); // loads in the login/admin view
  }


}