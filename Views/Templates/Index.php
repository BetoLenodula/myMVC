<?php
  namespace Views\Templates;

  use Views\Templates\BaseTemplates\Base\Head;

  class Index extends BaseTemplates\Base\Template{

      private static $me;

      public function __construct(){
          parent::open("html", "lang: es");
            $h = new Head();
            $h->set("meta", "charset: UTF-8", null);
            $h->set("meta", "name:viewport; content: width=device-width, initial-scale=1.0", null);
            $h->set("title", null, "My Title");
            $h->close();
            parent::open("body", null);
              parent::load("nav");

      }

      public function __destruct(){
            parent::close("body");
          parent::close("html");
      }

      public static function run(){
          self::$me = new self();
      }
  }

 ?>
