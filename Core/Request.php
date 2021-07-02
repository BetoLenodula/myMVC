<?php
  namespace Core;

  class Request{

    private $controller;
    private $method;
    private $arguments = [];
    private $json;

    public function __construct(){

        if(isset($_GET['url'])){
          $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
          $url = strtolower(rtrim(strip_tags($url)));
          $url = explode("/", $url);
          $url = array_filter($url);

          $this->controller = array_shift($url);
          $this->method = array_shift($url);

          if(! $this->method){
            $this->method = DEFAULT_METHOD;
          }

          $this->arguments = $url;
        }
        else{
          $this->controller = DEFAULT_CONTROLLER;
          $this->method = DEFAULT_METHOD;
        }

        if(isset($_REQUEST['json'])){
          $this->json = filter_var($_REQUEST['json'], FILTER_VALIDATE_BOOLEAN);
        }

    }

    public function get_controller(){
      return $this->controller;
    }

    public function get_method(){
      return $this->method;
    }

    public function get_arguments(){
      return $this->arguments;
    }

    public function get_json(){
      return $this->json;
    }


  }

 ?>
