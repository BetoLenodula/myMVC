<?php
  namespace Models;

  use Core;

  class Page extends Core\BaseModel{


    public function __construct(){
      parent::__construct("pages");
    }

    public function getAll(){
      
    }

    public function nuevo(){
      return $this->add();
    }


  }

 
