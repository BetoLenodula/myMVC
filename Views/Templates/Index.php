<?php
  namespace Views\Templates;

  use Views\Templates\BaseTemplates\Base\Head;

  class Index extends BaseTemplates\Base\Template{

      public function __construct($arg = null){

          self::open("html", "lang: es");
            $h = new Head();
            $h->set("title", null, "My Title");
            $h->set("meta", "charset: UTF-8");
            $h->set("meta", "name: viewport; content: width=device-width, initial-scale=1.0");
            $h->set("link", "rel: stylesheet; href: /Views/assets/bootstrap/css/bootstrap.min.css");
            $h->close();
            self::open("body");

      }

      public function __destruct(){
              self::open("script", "src: /Views/assets/bootstrap/js/bootstrap.bundle.min.js");self::close("script");
            self::close("body");
          self::close("html");
      }

      public static function run($arg = null){
        self::$me = new self($arg);
      }

  }
