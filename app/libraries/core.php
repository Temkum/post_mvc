<?php

/* 
* App Core class
* Creates URL & loads core controller
* URL format - /controller/method/params
*/

class Core
{
    protected $current_controller = 'Pages';
    protected $current_method = 'index';
    protected $params = [];

    public function __construct()
    {
          // print_r($this->getUrl());
        $url = $this->getUrl();

        // look in controllers for first value
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // if it exists, then set as current controller
            $this->current_controller = ucwords($url[0]);

            //unset 0 index
            unset($url[0]);
        }

        // require the controller
        require_once '../app/controllers/' . $this->current_controller . '.php';

        // instantiate controller class
        $this->current_controller = new $this->current_controller;

        // check for second part of url -> method
        if (isset($url[1])) {

            // check if method exists in controller
            if (method_exists($this->current_controller, $url[1])) {
                $this->current_method = $url[1];

                //unset 1 index
                unset($url[1]);
            }
        }

        // get params
        $this->params = $url ? array_values($url) : [];

        // call a callback with array of params
        call_user_func_array([$this->current_controller, $this->current_method], $this->params);
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
