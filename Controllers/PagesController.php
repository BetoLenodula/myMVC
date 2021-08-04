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
              'nombre'   => 'regex: /^[0-9A-Za-z\s]*$/ | min:1 | max:15',
              'tipo'     => 'required'
             ], $_REQUEST);

      $dat = "Enviame";

      if($frm['return']){
        $page->set("nombre_pagina, tipo_pagina");
        $page->nombre_pagina = $_REQUEST['nombre'];
        $page->tipo_pagina   = $_REQUEST['tipo'];
        $res = $page->nuevo();

        if($res){
          $dat = "Registro guardado con éxito";
        }
      
      }

      $this->view($dat, $frm['old'], $frm['err']);

    }

  }
