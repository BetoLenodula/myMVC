<?php
 namespace Helpers;

 trait validate{

    use filter;

    private static $filters = [
     'numeric' => FILTER_VALIDATE_INT,
     'email'   => FILTER_VALIDATE_EMAIL,
     'url'     => FILTER_VALIDATE_URL,
     'float'   => FILTER_VALIDATE_FLOAT,
     'bool'    => FILTER_VALIDATE_BOOLEAN,
     'ip'      => FILTER_VALIDATE_IP
    ];

    private static $errors = [
     'numeric'  => '* The field is not a number',
     'email'    => '* The email field format is wrong',
     'url'      => '* The URL field format is wrong',
     'float'    => '* The float number field is wrong',
     'bool'     => '* The bool field is wrong',
     'ip'       => '* The IP format field is wrong',
     'max'      => '* The number of characters exceeded the limit in field',
     'min'      => '* Missing characters in field',
     'equals'   => '* The field does not match expected value',
     'unequal'  => '* The field must be different from the one received',
     'higher'   => '* The field is lower than expected',
     'lower'    => '* The field is higher than expected',
     'regex'    => '* The field is wrong, may contain some characters not allowed',
     'required' => '* The field is required',
     'date'     => '* The Date format field is not valid',
     'richtxt'  => null,
     'void'     => null
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
        $_REQUEST      = array_replace($_REQUEST, self::$REQUEST);
        self::$REQUEST = array_replace(self::$REQUEST, self::$ERROR);
        $return = true;
      }

      return ['old' => self::$REQUEST, 'err' => self::$ERROR, 'return' => $return];

    }

    public static function prepare_validator($name, $value, $filter){

      $fil = null;
      
      $filter = explode("|", $filter);

      if(count($filter) > 1){

        foreach($filter as $key){
          $fil = $key;

          if(! self::validator($key, $name, $value)){
            break;
          }
        }

      }
      else{

          $fil = current($filter);

          self::validator(current($filter), $name, $value);
            
      }

      self::sanitized($name, $value, trim($fil));
    }


    public static function validator($key, $name, $value){  

      if(array_key_exists(trim($key), self::$filters)){

        if(filter_var($value, self::$filters[trim($key)])){
          self::$ERROR[$name] = "";
          return true;
        }
        else{
          count($_REQUEST) > 1 ? self::$ERROR[$name] = str_replace("field", $name, self::$errors[trim($key)]) : self::$ERROR[$name] = "";
          return false;
        }

      }
      else{

        $key      = explode(":", $key);
        $function = trim(current($key));
        $argument = trim(end($key));

        $res = self::$function($value, $argument);

        if(! $res){
          count($_REQUEST) > 1 ? self::$ERROR[$name] = str_replace("field", $name, self::$errors[$function]) : self::$ERROR[$name] = "";
        }
        else{
          self::$ERROR[$name] = "";
          return $res;
        }

      }

    }


    public static function sanitized($name, $value, $filter){
      if($filter === "richtxt"){
        $value = filter::filter($value);
      }
      else{
        $value = trim(filter_var($value, FILTER_SANITIZE_STRING));
        $value = filter_var($value, FILTER_SANITIZE_MAGIC_QUOTES);
      }

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

    public static function unequal($value, $argument){
      if($value != $argument){
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

    public static function richtxt($value = null, $argument = null){
      return true;
    }


    public static function void($value = null, $argument = null){
      return true;
    }


 }
