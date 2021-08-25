<?php
  
  require_once("Config/Init.php");
  require_once("Config/Globals.php");
  require_once("Core/Autoload.php");

  Core\Autoload::run();

  Core\Route::get(function(){
    return "response";
  });



 
