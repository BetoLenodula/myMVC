<?php
  namespace Controllers;

  use Core;

  class PagesController extends Core\BaseController{

    public function __construct(){
      $this->set_cache(60 * 5);
    }

    public function index(){
      $page = $this->model("Page");
      $page->id = 1;
      $res = $page->findById();

      $dats = array();
      
      while($r = $res->fetch_object()) {
        $dats[] = $r;
      }

      $h = ['title' => 'Mi pagina especial', 'link' => 'Views/assets/css/pages.css'];

      $arr = ['d' => $dats, 'h' => $h];

      $this->view($arr);
    }


    public function nuevo(){
      $page = $this->model("Page");

      $frm = $this->validate([
              'nombre'   => 'required | email | max:30',
              'tipo'     => 'required'
             ], $_REQUEST);

      $dat['msg'] = "Enviame";


      if($frm['return'] && $this->token()){
        $page->set("nombre_pagina, tipo_pagina");
        $page->nombre_pagina = $_REQUEST['nombre'];
        $page->tipo_pagina   = $_REQUEST['tipo'];
        $res = $page->nuevo();


        if($res){
          $dat['msg'] = "Registro guardado con éxito";
        }
      
      }
      //echo $this->upload('foto', ROOT."Var".DS."Resources", null, null);

      $this->view($dat, $frm['old'], $frm['err']);

    }

    public function pagina($pg = 1){
       $page = $this->model("Page");
       $arr['pages'] = $page->paginate(3);
       $page->set("id, nombre_pagina");
       $page->limit = $this->page($pg, 3);
       $res = $page->findLimited();


        $dats = array();
      
        while($r = $res->fetch_object()) {
          $dats[] = $r;
        }

      $arr['d'] = $dats;
      $this->view($arr);
    }


  }
