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
    $this->getUrl();
  }

  public function getUrl()
  {
    echo $_GET['url'];
  }
}
