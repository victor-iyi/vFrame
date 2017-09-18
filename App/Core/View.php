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
 * @property string title
 * @property array js
 * @property array css
 * @property string sidebar
 */
class View
{

  protected $header;
  protected $footer;
  public $js = [];
  public $css = [];

  /**
   * View constructor.
   */
  public function __construct()
  {
    $this->isErrorPage = App::$hasError;
  }

  /**
   * Loads in a view file with the option of using a defined layout.
   * Note: properties of this current class is available in the loaded view file.
   *
   * @credits Victor I. Afolabi <javafolabi@gmail.com>
   * @param $view
   * @param string $layout
   */
  public function render($view, $layout = '_plain-layout')
  {
    $viewFile = 'app/views/' . $view . '.php';
    $layoutFile = 'app/views/_layouts/' . $layout . '.php';

    $this->header = VIEW_INCLUDE_PATH . $layout . '-header.php';
    $this->footer = VIEW_INCLUDE_PATH . $layout . '-footer.php';

    if ( file_exists($layoutFile) && file_exists($viewFile) )
      require_once $layoutFile;
  }

}