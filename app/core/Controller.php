<?php
/**
 * @author
 * Created by victor.
 * A.I. engineer & Software developer
 * javafolabi@gmail.com
 * On 03 06, 2017 @ 3:46 PM
 * Copyright victor © 2017. All rights reserved.
 */

namespace App\Core;

/**
 * @property string layout
 */
abstract class Controller
{

  protected $args;
  protected $view;

  /**
   * Controller constructor.
   */
  public function __construct()
  {
    $this->view = new View;
  }

  /**
   * Performs operation based on supplied arguments
   */
  protected function _ops()
  {
    if (method_exists($this, $this->args[0]))
      call_user_func_array([$this, $this->args[0]], array_slice($this->args, 1));
  }

  /**
   * Default method run by every controller.
   * @return mixed
   */
  abstract public function index();

}
