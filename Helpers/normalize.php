<?php
 namespace Helpers;

 trait normalize{

 	public function normalize($string){
 		$original = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
		ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    	$modified = 'aaaaaaaceeeeiiiidnoooooouuuuy
		bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    	$string = utf8_decode($string);
    	$string = strtr($string, utf8_decode($original), $modified);
    	$string = strtolower($string);
    	$string = str_replace(" ", "_", $string);
    	return utf8_encode($string);
 	}

 	public function rmAccents($string){
 		$original = 'ÁáÉéÍíÓóÚú';
    	$modified = 'AaEeIiOoUu';
    	$string = utf8_decode($string);
    	$string = strtr($string, utf8_decode($original), $modified);
    	return utf8_encode($string);
 	}

 	public function normDate($date){
 		$date = explode("-", $date);
		$month = $date[1];

		switch($month){
			case '01':
				$return = "Ene"; break;
			case '02':
				$return = "Feb"; break;
			case '03':
				$return = "Mar"; break;
			case '04':
				$return = "Abr"; break;
			case '05':
				$return = "May"; break;
			case '06':
				$return = "Jun"; break;
			case '07':
				$return = "Jul"; break;
			case '08':
				$return = "Ago"; break;
			case '09':
				$return = "Sep"; break;
			case '10':
				$return = "Oct"; break;
			case '11':
				$return = "Nov"; break;
			case '12':
				$return = "Dic"; break;
			default :
				$return = "Err!"; break;
		}

		$return = $date[2]."/".$return."/".$date[0]; 
		return $return;
 	}

 }