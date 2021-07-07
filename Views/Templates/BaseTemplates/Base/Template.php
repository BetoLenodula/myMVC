<?php
  namespace Views\Templates\BaseTemplates\Base;

  class Template{

    private static $wrap;

    public function __construct(){}

    public static function open($html_tag, $arguments = null){
      self::$wrap = $html_tag;
      $args = self::parse_arguments($arguments);
      include("begin_block.php");
    }

    public static function close($html_tag){
         self::$wrap = $html_tag;
         include("end_block.php");
    }

    public static function load($html_block){
        include(ROOT."Views/Templates/BaseTemplates/public_html/".$html_block.".php");
    }


    protected function parse_arguments($arguments){
        if($arguments){
            $args = "";
            $arguments = explode(";", $arguments);

            foreach ($arguments as $value) {
              $value = explode(":", $value);
              $value = str_replace(" ", "", $value);
              $args .= " ".$value[0]."=\"".end($value)."\"";
            }

            return $args;
        }
        else{
            return null;
        }
    }


  }

 ?>
