<?php

class Router{

	static $routes =  array();
	
	//parser l'url
	static function parse($url, $request){

		//parse notre URL.
		$url = trim($url, '/');
		$parameters = explode('/', $url);

		$request->controller = $parameters[0];
		$request->action = isset($parameters[1]) ? $parameters[1] : 'home';
		$request->parms =  array_slice($parameters, 2);
		return true;

	}  

	static function url($url){
		//retourner de créer les url.
		//BASE_URL
		return BASE_URL.'/'.$url;
	} 
}

?>