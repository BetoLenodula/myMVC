<?php 
 namespace Helpers;

 use Classes\Cache;

 trait caching{

 	  public function set_cache($time_expires){
      Cache::configure(array(
        'cache_path' => ROOT.'Core/Cache',
        'expires' => ($time_expires)
      ));
    }

    public function put_cache($args, $content){
      Cache::put($args, $content);
    }

    public function get_cache($args){
      return Cache::get($args);
    }

    public function del_cache($args){
      Cache::delete($args);
    }

 }