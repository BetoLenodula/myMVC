<?php
  namespace Views\Templates;

  class Index{

      private static $me;

      public function __construct(){
  ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
  </head>
  <body>

  <?php
      }

      public function __destruct(){
  ?>

  </body>
</html>
  <?php
      }

      public static function run(){
        self::$me = new self();
      }
  }

 ?>
