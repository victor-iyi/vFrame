<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 04 07, 2017 @ 11:02 AM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Controllers;


use App\Core\Controller;

class AboutController extends Controller
{

  /**
   * AboutController constructor.
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Default method run by every controller.
   * @return mixed
   */
  public function index()
  {
    $this->view->render("about/index");
  }
}