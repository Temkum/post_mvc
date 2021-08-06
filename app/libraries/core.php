<?php

/* App Core class
* Creates URL & loads core controller
* URL format - /controller/method/params
*/

class Core
{
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct()
  {
    # code...
    // print_r($this->getUrl());

    $url = $this->getUrl();

    // look in controllers for first value
    if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      // it exists, then set as current controller
      $this->currentController = ucwords($url[0]);

      //unset 0 index
      unset($url[0]);
    }

    // require the controller
    require_once '../app/controllers/' . $this->currentController . '.php';

    // instantiate controller class
    $this->currentController = new $this->currentController;

    // check for second part of url - method
    if (isset($url[1])) {
      // check if method exists in controller
      if (method_exists($this->currentController, $url[1])) {
        # code...
        $this->currentMethod = $url[1];

        //unset 1 index
        unset($url[1]);
      }
    }

    // get params
    $this->params = $url ? array_values($url) : '';

    // call a callback with array of params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getUrl()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/'); //remove the end slash
      $url = filter_var($url, FILTER_SANITIZE_URL); //remove unwanted chars
      $url = explode('/', $url); // convert to an array

      return $url;
    }
  }
}
