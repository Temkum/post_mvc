<?php

class Posts extends Controller
{
  public function __construct()
  {
    # check if user is logged in
    if (!isLoggedIn()) {

      # redirect user to login if not signed in
      redirect('users/login');
    }
  }

  public function index()
  {
    $data = [];
    $this->view('posts/index', $data);
  }
}
