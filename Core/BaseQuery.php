<?php
  namespace Core;

  class BaseQuery{

    private $table;
    private $sql;

    public function __construct($table){
      $this->table = $table;
    }

    protected function save($fields){
      $fields = explode(",", $fields);
      $fls = null;

      foreach ($fields as $value) {
        $fls .= "'".$value."', ";
      }

      $fls = trim($fls, ", ");

      $this->sql = "INSERT INTO {$this->table} VALUES({$fls})";
      return $this;
    }

    protected function delete($field, $value){
      $this->sql .= "DELETE FROM {$this->table} WHERE {$field} = {$value}";
      return $this;
    }

    protected function get_all(){
      $this->sql .= "SELECT * FROM {$this->table} ORDER BY id DESC";
    }

    protected function get_by_id($id){
      $this->sql .= "SELECT * FROM {$this->table} WHERE id = '{$id}'";
      return $this;
    }

    protected function get_by($field, $value){
      $this->sql .= "SELECT * FROM {$this->table} WHERE {$field} = '{$value}'";
      return $this;
    }

    protected function and(){
      $this->sql .= " AND ";
      return $this;
    }

    protected function or(){
      $this->sql .= " OR ";
      return $this;
    }

    protected function not(){
      $this->sql .= " NOT ";
      return $this;
    }

    protected function equal($field, $value){
      $this->sql .= " {$field} = '{$value}' ";
      return $this;
    }


    protected function unequal($field, $value){
      $this->sql .= " {$field} <> '{$value}' ";
      return $this;
    }

    protected function like($field, $value){
      $this->sql .= " {$field} LIKE '%{$value}%' ";
      return $this;
    }

    protected function end(){
      $this->sql .= ";";
      return $this->sql;
    }



  }


 ?>
