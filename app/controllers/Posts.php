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

    $this->postModel = $this->model('Post');
  }

  public function index()
  {
    // get posts
    $posts = $this->postModel->getPosts();

    $data = [
      'title' => 'Posts',
      'posts' => $posts
    ];
    $this->view('posts/index', $data);
  }

  public function add()
  {
    $data = [
      'title' => '',
      'body' => ''
    ];
    $this->view('posts/add', $data);
  }
}
