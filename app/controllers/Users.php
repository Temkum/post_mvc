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
          flash('register_success', 'Registration successful! Please login.');

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

      // check if user/email exist
      if ($this->userModel->findUserByEmail($data['email'])) {
        // user found
      } else {
        // no user found
        $data['email_err'] = 'No user found!';
      }

      // make sure errors are empty
      if (empty($data['email_err']) && empty($data['password_err'])) {
        // validate

        // check and set logged in user
        $logged_in_user = $this->userModel->login($data['email'], $data['password']);

        if ($logged_in_user) {
          # create session
          $this->createUserSession($logged_in_user);
        } else {
          $data['password_err'] = 'Incorrect password';

          $this->view('users/login', $data);
        }
      } else {
        // load views with errors
        $this->view('users/login', $data);
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

  public function createUserSession($user)
  {
    # code...
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->name;

    redirect('pages/index');
  }

  public function logout()
  {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);

    session_destroy();
    redirect('users/login');
  }

  public function isLoggedIn()
  {
    /* 
    * This will be used for user access
    * to protect routes or pages which users can't access
    * Used to restrict user access 
    */

    if (isset($_SESSION['user_id'])) {
      # return true if user is logged in

      return true;
    } else {

      return false;
    }
  }
}
