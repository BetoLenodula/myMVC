<?php
  namespace Core;

  class Autoload{

    public static function run(){

        spl_autoload_register(function($class){
            $file = ROOT.str_replace("\\", DS, $class).".php";

            if(is_readable($file)){
                require_once($file);
            }
            else{
                print "The Class Requested Was Not Found in: ".$file;
            }

        });

    }

  }

 
