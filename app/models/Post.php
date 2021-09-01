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
    $this->db->query("SELECT *,
                      posts.id as postId,
                      users.id as userId,
                      posts.created_at as postCreated,
                      users.created_at as userCreated
                      FROM posts
                      INNER JOIN users
                      ON posts.user_id = users.id
                      ORDER BY posts.created_at DESC");

    $results = $this->db->resultSet();

    return $results;
  }
}
