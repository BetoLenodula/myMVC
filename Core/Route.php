<?php
 namespace Core;

 use Config\Routes;

 class Route{

   private static $routes = [];
   private static $data_returned = null;
   private static $form_values   = null;
   private static $form_errors   = null;

   public static function get($callback, $data = null, $frmv = null, $err = null){

     $request = new Request();

     $controller = $request->get_controller();
     $method     = $request->get_method();
     $arguments  = $request->get_arguments();

     Routes::run();

     self::$data_returned = $data;
     self::$form_values   = $frmv;
     self::$form_errors   = $err;

     $function = $callback();

     if($function != "response" && $function != "view"){
        self::show($function, $data);
     }
     else{
        return self::$function($controller, $method, $arguments);
     }

   }

   public function show($return, $data = null){
      echo $return;
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

   public function response($controller, $method, $arguments = []){

     if(self::match_routes($controller, $method)){
       $controller_route = ROOT."Controllers".DS.ucwords($controller)."Controller.php";

       if(is_readable($controller_route)){
          require_once($controller_route);

          $instance = "Controllers\\".ucwords($controller)."Controller";
					$controller_i = new $instance();

          call_user_func_array(array($controller_i, $method), $arguments);

       }
       else{
         print "Controller Not Found!";
       }

     }
     else{
       print "404 Page Not Found!";
     }

   }

   public function view($controller, $method, $arguments = []){

       if(self::match_routes($controller, $method)){
         $view_route = ROOT."Views".DS.$controller.DS.$method.".php";

         $execute = "Controllers\\".ucwords($controller)."Controller";
         $execute = new $execute;

         if(is_readable($view_route)){
           $old      = self::$form_values;
           $err      = self::$form_errors;
           $response = self::$data_returned;

           $pag = (!isset($arguments[0]) ? 1 : $arguments[0]);
           $pagination = ['res' => $response, 'url' => "/{$controller}/{$method}/", 'pag' => $pag];
           
           require_once($view_route);
         }
         else{
           print "View Not Found!";
         }
      }
      else{
        print "404 Page Not Found";
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
