<?php 
  namespace Helpers;


  trait files{

    use randpatterns;

  	public static function upload($path){
    		if($_FILES){
          $file = array_key_first($_FILES);
          
          if(self::try_open_path(ROOT.$path)){
            
            $ext  = explode(".", $_FILES[$file]['name']);
            $ext  = end($ext);
            $name = randpatterns::randname(16).".".$ext;

            if(move_uploaded_file($_FILES[$file]['tmp_name'], ROOT.$path.$name)){
              return $name;
            }
          }
        }
  	}

    public static function parse_type($type = null){
      $file = array_key_first($_FILES);

      if(in_array($_FILES[$file]['type'], $type)){
        return true;
      }

    }

    public static function parse_size($size){
      $file = array_key_first($_FILES);

      $size = $size * 1048576;

      if($_FILES[$file]['size'] <= $size){
        return true;
      }
    
    }

    public static function try_open_path($path){
      if(opendir($path)){
        return true;
      }
    }


  }