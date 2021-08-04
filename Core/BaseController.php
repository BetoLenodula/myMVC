<?php
  namespace Core;

  use Classes\Cache;

  class BaseController{

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

    protected function validate($array, $request){
      return Validate::request($array, $request);
    }

    protected function set_cache($time_expires){
      Cache::configure(array(
        'cache_path' => ROOT.'Core/Cache',
        'expires' => ($time_expires)
      ));
    }

    protected function put_cache($args, $content){
      Cache::put($args, $content);
    }

    protected function get_cache($args){
      return Cache::get($args);
    }

    protected function del_cache($args){
      Cache::delete($args);
    }

  }
