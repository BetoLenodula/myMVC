<?php
 namespace Core;

 use Config\Routes;

 class Route{

   private static $routes = [];
   private static $data_returned;

   public static function get($callback){

     $request = new Request();

     $controller = $request->get_controller();
     $method     = $request->get_method();
     $arguments  = $request->get_arguments();
     $json       = $request->get_json();

     Routes::run();

     $function = $callback();
     return self::$function($controller, $method, $arguments, $json);

   }

   public static function put($route){

     if(preg_match("/^\/([A-Za-z0-9\_\-\/]+)$/", $route)){
       $router = explode("/", $route);

       if(count($router) < 3){
         $route .= "/".DEFAULT_METHOD;
       }

       array_push(self::$routes, $route);

     }
     else{
       print "Wrong GET URL Format: "."(".$route.")";
     }

   }

   public function data($controller, $method, $arguments = [], $json = null){

     if(self::match_routes($controller, $method)){
       $controller_route = ROOT."Controllers".DS.$controller."Controller.php";

       if(is_readable($controller_route)){
          require_once($controller_route);

          $instance = "Controllers\\".$controller."Controller";
					$controller_i = new $instance();

          self::$data_returned = call_user_func(array($controller_i, $method), $arguments);


					if(! $json){
						return self::view($controller, $method, $arguments);
					}
					else{
						return self::$data_returned;
					}
       }
       else{
         return "Controller Not Found!";
       }

     }
     else{
       return "404 Page Not Found!";
     }

   }

   public function view($controller, $method, $arguments = [], $json = null){

       if(self::match_routes($controller, $method)){
         $view_route = ROOT."Views".DS.$controller.DS.$method.".php";

         if(is_readable($view_route)){
           $data_response = self::$data_returned;
           require_once($view_route);
         }
         else{
           return "View Not Found!";
         }
      }
      else{
        return "404 Page Not Found";
      }

   }

   public function match_routes($controller, $method){

     $got_route = "/{$controller}/{$method}";
     $default_route = "/".DEFAULT_CONTROLLER."/".DEFAULT_METHOD;

     if(in_array($got_route, self::$routes)){
       return true;
     }
     if($default_route == $got_route){
       return true;
     }

   }

 }

 ?>
