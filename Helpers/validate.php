<?php
 namespace Helpers;

 trait validate{

    private static $filters = [
     'numeric' => FILTER_VALIDATE_INT,
     'email'   => FILTER_VALIDATE_EMAIL,
     'url'     => FILTER_VALIDATE_URL,
     'float'   => FILTER_VALIDATE_FLOAT,
     'bool'    => FILTER_VALIDATE_BOOLEAN,
     'ip'      => FILTER_VALIDATE_IP
    ];

    private static $errors = [
     'numeric'  => '* The dat is not a number',
     'email'    => '* The email format is wrong',
     'url'      => '* The URL format is wrong',
     'float'    => '* The float number is wrong',
     'bool'     => '* The bool value is wrong',
     'ip'       => '* The IP format is wrong',
     'max'      => '* The number of characters exceeded the limit',
     'min'      => '* Missing characters',
     'equals'   => '* The value does not match',
     'higher'   => '* The values is lower than expected',
     'lower'    => '* The value is higher than expected',
     'regex'    => '* The expresion is wrong',
     'required' => '* Tha value is required',
     'date'     => '* The Date format is not valid'
    ];


    private static $REQUEST = array();
    private static $ERROR   = array();

    public function validate($values, $request){
      $return = false;
      self::$REQUEST = $request;

      foreach($values as $key => $filter) {
        
        if(! isset($request[$key])){
          $value = "";
        }
        else{
          $value = $request[$key];
        }

        self::prepare_validator($key, $value, $filter);
      }

      if(! empty(self::$ERROR) && ! array_filter(self::$ERROR) && count($request) > 1){
        self::$REQUEST = array_replace(self::$REQUEST, self::$ERROR);
        $return = true;
      }

      return ['old' => self::$REQUEST, 'err' => self::$ERROR, 'return' => $return];

    }

    public static function prepare_validator($name, $value, $filter){
      
      $filter = explode("|", $filter);

      if(count($filter) > 1){

        foreach($filter as $key){
          if(! self::validator($key, $name, $value)){
            break;
          }
        }

      }
      else{
        
        self::validator(current($filter), $name, $value);
            
      }

      self::sanitized($name, $value);
    }


    public static function validator($key, $name, $value){

      if(array_key_exists(trim($key), self::$filters)){

        if(filter_var($value, self::$filters[trim($key)])){
          self::$ERROR[$name] = "";
          return true;
        }
        else{
          count($_REQUEST) > 1 ? self::$ERROR[$name] = self::$errors[trim($key)] : self::$ERROR[$name] = "";
          return false;
        }

      }
      else{

        $key      = explode(":", $key);
        $function = trim(current($key));
        $argument = trim(end($key));

        if($function === "text" || $function === "empty"){
          return true;
        }

        $res = self::$function($value, $argument);

        if(! $res){
          count($_REQUEST) > 1 ? self::$ERROR[$name] = self::$errors[$function] : self::$ERROR[$name] = "";
        }
        else{
          self::$ERROR[$name] = "";
          return $res;
        }

      }

    }

    public static function sanitized($name, $value){
      $value = trim(filter_var($value, FILTER_SANITIZE_STRING));
      $value = filter_var($value, FILTER_SANITIZE_MAGIC_QUOTES);

      self::$REQUEST[$name] = $value;
    }


    public static function max($value, $length){
        if(strlen($value) > $length){
          return false;
        }
        else{
          return true;
        }
    }


    public static function min($value, $length){
        if(strlen($value) < $length){
          return false;
        }
        else{
          return true;
        }
    }

    public static function required($value, $argument = null){
      if(empty($value)){
        return false;
      }
      else{
        return true;
      }
    }

    public static function date($value, $argument = null){
      if(preg_match("/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $value)){
        $date = explode("-", $value);

        if($date[1] > 0 && $date[1] < 13){
          if($date[2] > 0 && $date[2] < 32){
            return true;
          }
        }
      }
      else{
        return false;
      }
    }

    public static function equals($value, $argument){
      if($value == $argument){
        return true;
      }
      else{
        return false;
      }
    }

    public static function higher($value, $argument){
      if($value > $argument){
        return true;
      }
      else{
        return false;
      }
    }

    public static function lower($value, $argument){
      if($value < $argument){
        return true;
      }
      else{
        return false;
      }
    }

    public static function regex($value, $expr){
      if(preg_match($expr, $value)){
        return true;
      }
      else{
        return false;
      }
    }


 }
