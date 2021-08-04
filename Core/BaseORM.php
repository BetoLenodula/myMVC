<?php
  namespace Core;

  class BaseORM{

    private   $sql;
    private   $table;
    private   $set;

    public function __construct($table){
      $this->table = $table;
    }

    public function set_fields($set){
      $this->set = $set;
    }

    public function save(){
      $fields = "";

      foreach($this->set as $field => $value){
        if($field != "fields_set"){
          if($field != "id" && !is_numeric($field)){
            $fields .= "'".$value."', ";
          }
        }
      }

      if(isset($this->set['fields_set'])){
        $this->set['fields_set'] = str_replace(" ", "", $this->set['fields_set']);
        $this->set['fields_set'] = " (".$this->set['fields_set'].")";
      }
      else{
        $this->set['fields_set'] = "";
      }

      $fields = trim($fields, ", ");
      $this->sql = "INSERT INTO {$this->table}{$this->set['fields_set']} VALUES({$fields})";

      return $this;
    }

    public function update(){
      $fields = "";

      foreach($this->set as $field => $value){
        if($field != "id" && !is_numeric($field)){
          $fields .= $field."='".$value."', ";
        }
      }

      $fields = trim($fields, ", ");

      if(isset($this->set['id'])){
        $this->sql .= "UPDATE {$this->table} SET {$fields} WHERE id='{$this->set['id']}'";
      }
      else{
        $this->sql = "The Id Field is Missing!";
      }

      return $this;
    }

    public function delete(){
      if(isset($this->set['id'])){
        $this->sql .= "DELETE FROM {$this->table} WHERE id='{$this->set['id']}'";
      }
      else{
        $this->sql = "The Id Field is Missing!";
      }
      return $this;
    }

    public function find(){
      if(isset($this->set['fields_set'])){
        $this->set['fields_set'] = str_replace(" ", "", $this->set['fields_set']);
      }
      else{
        $this->set['fields_set'] = "*";
      }

      $this->sql .= "SELECT {$this->set['fields_set']} FROM {$this->table}";
      return $this;
    }

    public function find_by_id(){
      if(isset($this->set['fields_set'])){
        $this->set['fields_set'] = str_replace(" ", "", $this->set['fields_set']);
      }
      else{
        $this->set['fields_set'] = "*";
      }

      if(isset($this->set['id'])){
        $this->sql .= "SELECT {$this->set['fields_set']} FROM {$this->table} WHERE id='{$this->set['id']}'";
      }
      else{
        $this->sql = "The Id Field is Missing!";
      }
      return $this;
    }

    public function find_by(){

      if(isset($this->set['fields_set'])){
        $this->set['fields_set'] = str_replace(" ", "", $this->set['fields_set']);
      }
      else{
        $this->set['fields_set'] = "*";
      }

      $cond = "";

      foreach($this->set as $field => $value){
        if($field != "fields_set" && !is_numeric($field)){
          $cond = $field."='".$value."'";
        }
      }

      $this->sql .= "SELECT {$this->set['fields_set']} FROM {$this->table} WHERE {$cond}";
      return $this;
    }

    public function min(){
      if(isset($this->set['min'])){
        $this->sql .= "SELECT MIN({$this->set['min']}) FROM {$this->table}";
      }
      else{
        $this->sql = "The MIN Field is Missing!";
      }
      return $this;
    }

    public function max(){
      if(isset($this->set['max'])){
        $this->sql .= "SELECT MAX({$this->set['max']}) FROM {$this->table}";
      }
      else{
        $this->sql = "The MAX Field is Missing!";
      }
      return $this;
    }

    public function avg(){
      if(isset($this->set['avg'])){
        $this->sql .= "SELECT AVG({$this->set['avg']}) FROM {$this->table}";
      }
      else{
        $this->sql = "The AVG Field is Missing!";
      }
      return $this;
    }

    public function sum(){
      if(isset($this->set['sum'])){
        $this->sql .= "SELECT SUM({$this->set['sum']}) FROM {$this->table}";
      }
      else{
        $this->sql = "The SUM Field is Missing!";
      }
      return $this;
    }

    public function count(){
      if(isset($this->set['count'])){
        $this->sql .= "SELECT COUNT({$this->set['count']}) FROM {$this->table}";
      }
      else{
        $this->sql = "The COUNT Field is Missing!";
      }
      return $this;
    }

    public function join($join_table, $fieldt1, $fieldt2){
      $this->sql .= " INNER JOIN {$join_table} ON {$this->table}.{$fieldt1}={$join_table}.{$fieldt2}";
      return $this;
    }

    public function limit(){
      if(isset($this->set['limit'])){
        $this->sql .= " LIMIT {$this->set['limit']}";
      }
      else{
        $this->sql = "The Limit Argument is Missing!!";
      }
      return $this;
    }

    public function order($field){
      $this->sql .= " ORDER BY {$field} ASC";
      return $this;
    }
    public function order_r($field){
      $this->sql .= " ORDER BY {$field} DESC";
      return $this;
    }

    public function if(){
      $this->sql .= " WHERE";
      return $this;
    }

    public function and(){
      $this->sql .= " AND";
      return $this;
    }

    public function or(){
      $this->sql .= " OR";
      return $this;
    }

    public function not(){
      $this->sql .= " NOT";
      return $this;
    }

    public function in(){
      $this->sql .= " IN";
      return $this;
    }

    public function eq($field, $value){
      $this->sql .= " {$field}='{$value}'";
      return $this;
    }


    public function neq($field, $value){
      $this->sql .= " {$field}<>'{$value}'";
      return $this;
    }

    public function high($expr, $value){
      $this->sql .= " {$expr}>'{$value}'";
      return $this;
    }

    public function low($expr, $value){
      $this->sql .= " {$expr}< '{$value}'";
      return $this;
    }

    public function like($field, $value){
      $this->sql .= " {$field} LIKE '%{$value}%'";
      return $this;
    }

    public function range($val1, $val2){
      if(isset($this->set['range_field'])){
        $this->sql .= " {$this->set['range_field']} BETWEEN '{$val1}' AND '{$val2}'";
      }
      else{
        $this->sql = "The Range Field is Missing!";
      }

      return $this;
    }

    public function end(){
      $this->sql .= ";";
      return $this->sql;
    }



  }


 
