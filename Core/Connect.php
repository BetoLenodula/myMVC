<?php
  namespace Core;

  class Connect{

    private $con;

    public function __construct(){

      $dbc = require_once(ROOT."Config/Db.php");

      $this->con = new \mysqli(
        $dbc['Host'],
        $dbc['User'],
        $dbc['Password'],
        $dbc['Database']
      );

      if(mysqli_connect_errno()){
				die("Error of Connection to DataBase: ".mysqli_connect_error());
			}

    }

    public function query_return($sql){
      return $this->con->query($sql);
    }

    public function charset_utf8(){
      $this->con->set_charset("utf8");
    }

    public function charset_utf8mb4(){
      $this->con->set_charset("utf8mb4");
    }

  }

 ?>
