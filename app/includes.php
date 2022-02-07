<?php

	//include le fichier router.php
	require_once 'body/router.php';
	//le fichier de notre configuration base de donnée.
	//require 'config/config.php';
	//include notre base de donnée
	require_once 'body/database.php';
	//include le fichier controller.php
	require_once 'body/controller.php';
	//include le fichier request.php
	require_once 'body/request.php';
	
	//include le fichier model.php
	require_once 'body/model.php';
	//include le fichier dispatcher.php
	require_once 'body/dispatcher.php';
/*
	// Autoload dispatcher les url.
	spl_autoload_register(function($className){
	require_once 'body/' . $className . '.php';
	});
*/
