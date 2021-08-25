<?php  
 namespace Helpers;

 trait paginate{
 	
 	public function page($page, $lim){
      if(! $page || $page < 0){
        $page= 1; 
      }

      $page--;
      $page *= $lim;

      return "{$page},{$lim}";
    }

 }