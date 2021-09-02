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

  public function addPost($data)
  {
    # prepare query
    $this->db->query("INSERT INTO posts (title, user_id, body) VALUES(:title, :user_id, :body)");

    // bind param values
    $this->db->bind(':title', $data['title']);
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':body', $data['body']);

    // execute
    if ($this->db->execute()) {
      # all went well

      return true;
    } else {

      return false;
    }
  }
}
