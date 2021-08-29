<?php
 namespace Helpers;

 use Classes\Resize;


 trait resizing{

 	use randpatterns;

 	public function resize($source_file, $w, $h, $quality){
 		if(is_readable($source_file)){

 			$ext = explode(".",$source_file);
 			$ext = ".".end($ext);

			$img = new Resize($source_file);
			$img->resizeImage($w, $h, 'crop');  

			$route = explode(DS, $source_file);
			array_pop($route);
			$route = implode(DS, $route).DS;

			$img->saveImage($route.randpatterns::randname(16).$ext, $quality);

			return true;
		}
		else{
			return false;
		}

 	}


 }