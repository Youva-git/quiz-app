<?php

/**
 * le controlleur principale
 */

class Controller
{
	public $request;
	public $model;
	private $parms 		= array();
    protected $renderd  = false;

	function __consrtruct($request){

		$this->request = $request;
		
	}

	//rendre une vue
	public function render($myView){
		
		if($this->renderd){ return false;}
	
		//on extracte nos données passées en paramatres.
		extract($this->parms);
		//récuperer notre view .	
		$myView = APP.DS.'views'.DS.$myView.'.php';

		require_once $myView;
		//die($myView);
		$this->renderd = true;
	}


	//ajouter les paramaters
	public function setParams($arg, $value = null){

		if(is_array($arg)){

			$this->parms += $arg;
		}else{

			$this->parms[$arg] = $value;
		}
	}

	//charger un model
	function getModel($nameMode){

		$pathModel = APP.DS.'models'.DS.$nameMode.'.php';
		//print_r(BASE_URL.'/');
		//print_r($pathModel);
		require_once($pathModel);
		//if(!isset($this->model)){
			$this->model = new $nameMode();
			
			return $this->model;
		//}
	}

	//création un session pour un utilisateur donné
	public function createUserSession($user){

	      $_SESSION['user_id'] = $user->id;
	      $_SESSION['user_email'] = $user->email;
	      $_SESSION['user_username'] = $user->username;
	      $_SESSION['user_admin'] = $user->admin;

    }

    //déconnection
    public function logoutSession(){


	     if(isset($_SESSION['user_id'])) unset($_SESSION['user_id']);
	     if(isset($_SESSION['user_email'])) unset($_SESSION['user_email']);
	     if(isset($_SESSION['user_name'])) unset($_SESSION['user_name']);
	     if(isset($_SESSION['user_admin'])) unset($_SESSION['user_admin']);

	     $this->session = array();
		 session_destroy();
	      
    }


    //return si l'utilisateur est connecté ou non..
    public function isConnect(){

	      if(isset($_SESSION['user_id'])){

	        return true;

	      } else {
	      	
	        return false;
	      }
    }

    //verifé si la tabele des paramaters est vide.
    function isParmsNull(){
    	return ($this->parms == array());
    }

}
?>