<?php
  namespace Config;

  use Core\Route;

  class Routes{

    public static function run(){

      Route::put("/pages");

      Route::put("/pages/nuevo");

      Route::put("/pages/pagina");

    }

  }
