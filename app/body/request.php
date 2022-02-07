<?php

/**
 * récuperer les urls
 */

class Request{

	//url saisé par l'utilisateur
	public $url;

	function __construct()
	{
		if(isset($_GET['url'])){
			//récuperer l'url.
			$this->url= $_GET['url'];
		}

	}
}