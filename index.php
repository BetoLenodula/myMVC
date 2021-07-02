<?php

  require_once("Config/Globals.php");
  require_once("Core/Autoload.php");

  Core\Autoload::run();

  $data = Core\Route::get(function(){
    return "data";
  });

 ?>
