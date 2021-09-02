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

    // init
    $data = [
      'title' => 'Posts',
      'posts' => $posts,
    ];

    $this->view('posts/index', $data);
  }

  public function add()
  {
    // check if it's POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      # sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'body_err' => '',
      ];

      // validate data
      if (empty($data['title'])) {
        $data['title_err'] = 'Please enter title';
      }
      if (empty($data['body'])) {
        $data['body_err'] = 'Please enter body';
      }

      // verify for no errors
      if (empty($data['title_err']) && empty($data['body_err'])) {
        # 'submit validated data
        if ($this->postModel->addPost($data)) {
          # code...
          flash('post_message', 'Posted added successfully');
          redirect('posts');
        } else {

          exit('Something went wrong. Please try again.');
        }
      } else {
        // load views with errors
        $this->view('posts/add', $data);
      }
    } else {
      $data = [
        'title' => '',
        'body' => ''
      ];
    }

    $this->view('posts/add', $data);
  }
}
