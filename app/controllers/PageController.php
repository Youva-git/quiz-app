<?php

//gerer la page d'accueil de site, login, l'inscription
class PageController extends Controller
{	
	//la page d'accueil
	function home()
	{
		//appele à la fonction pour récuperer le model.
		$model = $this->getModel('User');
		//print_r($model->db);

		$this->render('home/home');
	}

	//la page pour loger
	function login()
	{	
		$this->setParams(array(
			'kaka' => 'jaja'));
		
		$this->render('home/login');
	}

	//la page pour l'inscription
	function signup()
	{
		$this->render('home/signup');
	}

	
}