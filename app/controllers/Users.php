<?php

class Users extends Controller
{
  public function __construct()
  {
    // load model
    $this->userModel = $this->model('User');
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
      // sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // process form input
      $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'cpassword' => trim($_POST['cpassword']),
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'cpassword_err' => ''
      ];

      // validate name
      if (empty($data['name'])) {
        $data['name_err'] = 'Please enter name';
      }

      // validate email
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email';
      } else {
        // check email
        if ($this->userModel->findUserByEmail($data['email'])) {
          $data['email_err'] = 'Email is already taken';
        }
      }

      // validate password
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      } elseif (strlen($data['password']) < 5) {
        $data['password_err'] = 'Password must be at least 5 characters';
      }

      // validate confirm pwd
      if (empty($data['cpassword'])) {
        $data['cpassword_err'] = 'Please confirm password!';
      } else {
        if ($data['password'] != $data['cpassword']) {
          $data['cpassword_err'] = 'Passwords do not match!';
        }
      }

      // make sure errors are empty
      if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err'])) {
        // validate

        // hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register user
        if ($this->userModel->register($data)) {
          # redirect user to login page if registration was a success
          redirect('users/login');
        } else {

          exit('Something went wrong. Please try again!');
        }
      } else {
        // load views with errors
        $this->view('users/register', $data);
      }
    } else {
      // init data
      $data = [
        'title' => 'Register',
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

      // sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // process form input
      $data = [

        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => ''
      ];

      // validate email
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email';
      }

      // validate password
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      }

      // make sure errors are empty
      if (empty($data['email_err']) && empty($data['password_err'])) {
        // validate

        // exit('GREAT');
      } else {
        // load views with errors
        $this->view('users/register', $data);
      }
    } else {
      // init data
      $data = [
        'title' => 'Login',

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
