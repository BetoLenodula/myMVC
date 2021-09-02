<?php 
  namespace Helpers;


  trait files{

  	public static function upload($field, $route, $size, $type = null){
    		if($_FILES){
            echo $_FILES[$field]['size'];
        }
        else{
          return false;
        }
  	}

  }