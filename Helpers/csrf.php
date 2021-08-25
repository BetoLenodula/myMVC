<?php 
 namespace Helpers;

 trait csrf{

 	public function get_token(){

 		if(isset($_SESSION['tkn'])){
          unset($_SESSION['tkn']);
 		}

 		$_SESSION['tkn'] = md5(uniqid(mt_rand(), true));

 		return $_SESSION['tkn'];
 	}

 	public function token(){

 		if((isset($_REQUEST['tkn']) && isset($_SESSION['tkn'])) && ($_REQUEST['tkn'] == $_SESSION['tkn'] )){
 			return true;
 		}
 		else{
 			return false;
 		}

 	}

 }