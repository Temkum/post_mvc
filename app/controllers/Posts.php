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
    $this->userModel = $this->model('User');
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
          flash('post_message', 'Post added successfully');
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
      $this->view('posts/add', $data);
    }
  }

  public function edit($id)
  {
    // check if it's POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      # sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'id' => $id,
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
        # submit validated data
        if ($this->postModel->updatePost($data)) {
          # code...
          flash('post_message', 'Post updated!');
          redirect('posts');
        } else {

          exit('Something went wrong. Please try again.');
        }
      } else {
        // load views with errors
        $this->view('posts/edit', $data);
      }
    } else {
      // fetch exiting post from model
      $post = $this->postModel->getSinglePost($id);

      // check for post user
      if ($post->user_id != $_SESSION['user_id']) {
        redirect('posts');
      }

      $data = [
        'id' => $id,
        'title' => $post->title,
        'body' => $post->body
      ];
      $this->view('posts/edit', $data);
    }
  }

  public function show($id)
  {
    $post = $this->postModel->getSinglePost($id);

    $user = $this->userModel->getSingleUser($post->user_id);

    $data = [
      'post' => $post,
      'user' => $user,
      'title' => 'Post Details'
    ];

    $this->view('posts/show', $data);
  }
}
