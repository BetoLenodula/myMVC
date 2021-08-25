<?php
  namespace Core;

  class Connect{

    private $con;
    private $chs;

    public function __construct(){

      $dbc = require_once(ROOT."Config/Db.php");

      if(! empty($dbc)){

        $this->con = new \mysqli(
          $dbc['Host'],
          $dbc['User'],
          $dbc['Password'],
          $dbc['Database']
        );

        $this->chs = $dbc['Charset'];

        if(mysqli_connect_errno()){
  				die("Error of Connection to DataBase: ".mysqli_connect_error());
  			}

      }
      else{
        return "The Connection Data Was Not Provided!";
      }

    }

    public function return($sql){
      if($this->con->real_escape_string($sql)){
        $res = $this->con->query($sql);
        if(! $res){
          return $this->con->error." : \"".$sql."\"";
        }
        else{
          return $res;
        }
      }
      else{
        return "Error: real escape string invalid!";
      }
    }

    public function exec($sql){
      if($this->con->real_escape_string($sql)){

        if(!$this->con->query($sql)){
          return $this->con->error." : \"".$sql."\"";
        }

      }
      else{
        return "Error: real escape string invalid!";
      }
    }

    public function last_id(){
      return $this->con->insert_id;
    }

    public function affected_rows(){
      return $this->con->affected_rows;
    }


    public function set_charset(){
      $this->con->set_charset($this->chs);
    }


  }
