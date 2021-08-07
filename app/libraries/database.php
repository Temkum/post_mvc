<?php

/* 
* PDO class
* connect to db
* create prepared statements
* bind values
* return rows and results
*/

class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $db_pwd = DB_PWD;
  private $db_name = DB_NAME;

  private $db_handler; //used during prepared stmt
  private $stmt;
  private $error;

  public function __construct()
  {
    # set DSN
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
    $options = [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    // create PDO instance
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->db_pwd, $options);
    } catch (PDOException $e) {
      //throw $th;
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  // prepare stmt with query
  public function query($sql)
  {
    $this->stmt = $this->db_handler->prepare($sql);
  }

  // bind values 
  public function bind($param, $value, $type = null)
  {
    # if type is not passed in then run switch
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;

          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;

          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;

          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }

    // run bind value
    $this->stmt->bindValue($param, $value, $type);
  }

  // execute prepared stmt
  public function execute()
  {
    # code...
    return $this->stmt->execute();
  }

  // get results set as array of objects
  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // get result as obj
  public function singleResult()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  // get row count
  public function rowCount()
  {
    return $this->stmt->rowCount();
  }
}
