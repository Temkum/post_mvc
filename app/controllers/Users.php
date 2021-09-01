<?php

class Users extends Controller
{
  public function __construct()
  {
  }

  public function index()
  {
    $data = [
      'title' => 'Softech Posts',
      'description' => 'Simple social network build on PHP MVC framework'
    ];

    $this->view('pages/index', $data);
  }

  public function register()
  {
    # check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // process form input
    } else {
      // init data
      $data = [
        'name' => '',
        'email' => '',
        'password' => '',
        'cpassword' => '',
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'cpassword_err' => ''
      ];

      // load view
      $this->view('users/register', $data);
    }
  }

  public function login()
  {
    # check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // process form input
    } else {
      // init data
      $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => ''
      ];

      // load view
      $this->view('users/login', $data);
    }
  }
}
