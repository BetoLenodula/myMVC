<?php
  namespace Views\Templates\BaseTemplates\Base;

  class Head extends Template{

    private static $wrap;

    public function __construct($arguments = null){
        self::$wrap = "head";
        $args = $this->parse_arguments($arguments);
        include("begin_block.php");
    }

    public function set($tag, $arguments = null, $content = null){
      $args = $this->parse_arguments($arguments);
      include(ROOT."Views/Templates/BaseTemplates/".self::$wrap."/{$tag}.php");
    }

    public static function close($html_tag = 0){
      include("end_block.php");
    }

  }
