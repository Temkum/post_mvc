<?php

class User
{
  private $DB;

  public function __construct()
  {

    $this->DB = new Database;
  }

  // Register user
  public function register($data)
  {
    # prepare query
    $this->DB->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");

    // bind param values
    $this->DB->bind(':name', $data['name']);
    $this->DB->bind(':email', $data['email']);
    $this->DB->bind(':password', $data['password']);

    // execute
    if ($this->DB->execute()) {
      # all went well

      return true;
    } else {

      return false;
    }
  }

  public function login($email, $password)
  {
    # code...
    $this->DB->query("SELECT * FROM users WHERE email = :email");
    $this->DB->bind(':email', $email);

    $row = $this->DB->singleResult();

    $hashed_pwd = $row->password;
    if (password_verify($password, $hashed_pwd)) {
      # code...

      return $row;
    } else {

      return false;
    }
  }

  public function findUserByEmail($email)
  {
    # find user by email
    $this->DB->query("SELECT * FROM users WHERE email = :email");
    $this->DB->bind(':email', $email);

    // get single result
    $row = $this->DB->singleResult();

    // check row
    if ($this->DB->rowCount() > 0) {
      # if user exists with email

      return true;
    } else {

      return false;
    }
  }

  public function getSingleUser($id)
  {
    # find user by email
    $this->DB->query("SELECT * FROM users WHERE id = :id");
    $this->DB->bind(':id', $id);

    // get single result
    $row = $this->DB->singleResult();

    // check row
    if ($this->DB->rowCount() > 0) {

      return $row;
    }
  }
}
