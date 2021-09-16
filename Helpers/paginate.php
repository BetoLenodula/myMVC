<?php  
 namespace Helpers;

 trait paginate{
 	
 	public function page_range($page, $lim){
      if(! $page || $page < 0 || ! is_numeric($page)){
        $page= 1; 
      }

      $page--;
      $page *= $lim;

      return "{$page},{$lim}";
    }

 }