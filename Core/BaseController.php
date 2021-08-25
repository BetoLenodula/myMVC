<?php
  namespace Core;


  class BaseController{

    use \Config\Helpers;

    protected function model($model){
      $route_model = ROOT."Models".DS.ucwords($model).".php";

      if(is_readable($route_model)){
        $instance = "Models\\".ucwords($model);
        return new $instance();
      }
      else{
        return "The Model Was Not Found!!";
      }

    }

    protected function view($data = null, $frmv = null, $err = null){
      Route::get(function(){
        return "view";
      }, $data, $frmv, $err);
    }

    protected function redirect($method = "index"){
        $controller = get_class($this);
        $controller = explode("\\", $controller);
        $controller = end($controller);
        $location = URL.strtolower(substr($controller, 0, -10))."/".$method;
        header("Location: {$location}");
    }


  }
