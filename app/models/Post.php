<?php

class Post
{
  private $db;

  public function __construct()
  {
    # instantiate the db class and attach to db property
    $this->db = new Database;
  }

  public function getPosts()
  {
    # code...
    $this->db->query("SELECT * FROM posts");

    return $this->db->resultSet();
  }
}
