<?php

/**
 * permet de récupere les urls et de savoir de quoi faire
 */
class Dispatcher{

	//variable d'instance
	public $request;
	
	function __construct()
	{
		//récuperer l'url
		$req =  new Request();

		//parser l'url
		Router::parse($req->url, $req);
//print_r($req);
		//récuperer le chemien de controlleur.
		$pathC = $this->isController($req);


		//verifier l'existence de controller.
		if(file_exists($pathC)){
			
			$this->request = $req;

			//appel au controlleur correspandant pour avoir une instance de notre controlleur.
			$controller = $this->myController();

			//on élimine les fonctions de la class pere
			if(!in_array($this->request->action, array_diff(get_class_methods($controller), get_class_methods('Controller')))|| (is_null($this->request->action))){

			//affichier la page d'erreur.
				$controller->render('error');

			}else{

			//appele au controlleur et la méthode avec les parametre. 
			call_user_func_array(array($controller, $this->request->action), $this->request->parms);

			//auto render.
			}
		
		}else{

			//affichier la page home
			$controllerHome = new Controller();
			$controllerHome->render('home/home');

		}
	}

	function isController($req){
		$nameController = ucfirst($req->controller).'Controller';
		//chemin de controlleur
		$pathController = APP.DS.'controllers'.DS.$nameController.'.php';

		return $pathController;
	}

	//recuperer le controller
	function myController(){

		$nameController = ucfirst($this->request->controller).'Controller';
		//chemin de controlleur
		$pathController = APP.DS.'controllers'.DS.$nameController.'.php';

		//include le fichier de controlleur
		require $pathController;

		//création une objet de controlleur.
		$cntr = new $nameController();

		//return le controlleur.
		return $cntr;
	}

}