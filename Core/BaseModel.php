<?php
  namespace Core;

  class BaseModel{

      protected $con;
      protected $orm;
      private   $set;

      public function __construct($table){
        $this->con = new Connect();
        $this->orm = new BaseORM($table);
      }

      public function __set($field, $value){
        $this->set[$field] = $value;
      }

      public function __get($field){
        return $this->set[$field];
      }

      public function set($fields){
        $this->set['fields_set'] = $fields;
      }

      public function add(){
        $this->orm->set_fields($this->set);
        $sql = $this->orm->save()->end();

        $res = $this->con->return($sql);

        if($res && $this->con->affected_rows() == 1){
          return true;
        }
        else{
          return false;
        }

        $this->con->close();
      }

      public function edit(){
        $this->orm->set_fields($this->set);
        $sql = $this->orm->update()->end();

        $res = $this->con->return($sql);

        if($res && $this->con->affected_rows() > 0){
          return true;
        }
        else{
          return false;
        }

        $this->con->close();
      }

      public function delete(){
        $this->orm->set_fields($this->set);
        $sql = $this->orm->delete()->end();

        $res = $this->con->return($sql);

        if($res && $this->con->affected_rows() > 0){
          return true;
        }
        else{
          return false;
        }

        $this->con->close();
      }

      public function findAll(){
        $this->orm->set_fields($this->set);
        $sql = $this->orm->find()->end();

        $res = $this->con->return($sql);

        if(!empty($res)){
          return $res;
        }
        else{
          return false;
        }

        $this->con->close();
      }

      public function findById(){
        $this->orm->set_fields($this->set);
        $sql = $this->orm->find_by_id()->end();

        $res = $this->con->return($sql);

        if(!empty($res)){
          return $res;
        }
        else{
          return false;
        }

        $this->con->close();
      }

      public function findBy(){
        $this->orm->set_fields($this->set);
        $sql = $this->orm->find_by()->end();

        $res = $this->con->return($sql);

        if(!empty($res)){
          return $res;
        }
        else{
          return false;
        }

        $this->con->close();
      }

      public function findLimited(){
        $this->orm->set_fields($this->set);
        $sql = $this->orm->find()->limit()->end();
        $res = $this->con->return($sql);

        if(!empty($res)){
          return $res;
        }
        else{
          return false;
        }

        $this->con->close();
      }

      public function paginate($num_items){
        $this->set['fields_set'] = "id";
        $this->orm->set_fields($this->set);
        $sql = $this->orm->find()->end();

        $rows = $this->con->return($sql);
      
        $rows = ceil(($rows->num_rows) / $num_items);  

        return $rows;

        $this->con->close();
      }


  }
