<?php
 namespace Helpers;


 trait randpatterns{

 	public static function randname($length, $prefix = null){
 		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz"; 
		$name    = null;

		for($i = 0; $i <= $length; $i++) { 
			$name = $name.$pattern{rand(0, 35)}; 
		}

		if($prefix){
			$prefix = $prefix."_";
		}

		return $prefix.$name;
 	}

 }