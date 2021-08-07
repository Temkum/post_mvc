<?php
class Post
{
  private $DB;

  public function __construct()
  {
    $this->DB = new Database;
  }

  public function getPosts()
  {
    $this->DB->query("SELECT * FROM posts");
    # code...

    $results = $this->DB->resultSet();

    return $results;
  }
}
