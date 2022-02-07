<?php

	//constant vers le dossier web
	define('WEB', dirname(__FILE__));
	//constant vers le dossier de notre site
	define('ROOT', dirname(WEB));
	//constanr pour le separatuer 
	define('DS', DIRECTORY_SEPARATOR);
	//constant vers le dossier app
	define('APP', ROOT.DS.'app');
	
	//un constatnt pour le chemein de dossier body
	define('PATHBODY', APP.DS.'body');
	//constant pour le chemin de notre racine
	define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));

	define('NAME_SITE', 'WEBSITEQuiz');

	define('URLQUIZ', 'http://localhost/QUIZZ/');
	
	require_once '../app/includes.php';

	$init = new Dispatcher();
