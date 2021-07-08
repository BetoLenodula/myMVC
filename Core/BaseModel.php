<?php
  namespace Core;

  class BaseModel extends BaseQuery{
      private $table;
      private $con;

      public function __construct($table){
        $this->table = $table;
        $this->con = new Connect();
      }


  }

?>
