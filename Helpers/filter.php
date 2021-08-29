<?php
 namespace Helpers;

 use Classes\InputFilter;

 trait filter{

 	public static function filter($text){

 		$filter = new InputFilter(array('br','a','img','p','span','div','audio','figure','iframe','b','i','u','h1','blockquote','ul','ol','li','table','tbody','tr','td','font','label','input','textarea','select','option','fieldset', 'video'), array('id','class','align','src','href','color','face','contenteditable','width','height','style','allowfullscreen','frameborder','controls','download','type','value'));
              $text = filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES);

		$text = $filter->process($text);

		return htmlentities($text);

 	}


 }