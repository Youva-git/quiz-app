<?php
//gerer connexion, inscription et la deconnexion d'un utilisateur.
class UsersController extends Controller{
		
  //gerer l'enregestrement d'un utilisateur
	public function signupUser(){

      //verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          // filter les données 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $this->setParams(array());

          // récuperer les données
          $data =[
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
          ];

          // verifie le password
          if(strlen($data['password']) < 8){
            $this->setParams(array(
                  'msg_err_password' => 'Le mot de passe doit être au moins de 8 caractères'));
          }else{

            //confirmer le password
            if($data['password'] != $data['confirm_password']){
              $this->setParams(array(
                  'msg_err_confirm_password' => 'Les mots de passe ne correspondent pas'));
            }
          }
          
          // verification si la table des paramaters est vide
          if($this->isParmsNull()) {
            
            // hachage de password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //récupere le model de la table users.
            $model = $this->getModel('User');

            //verification si l'username et l'email sont déja existés.
            if((!$model->findByUsername($data['username'])) && (!$model->findByEmail($data['email']))){

              if($model->signup($data)){

                $this->setParams(array(
                    'signup_success' => 'Vous êtes inscrit et pouvez vous connecter'));

                $this->render('home/signup');

              } else {

                $this->setParams(array(
                    'signup_failed' => 'Il y a une problèmes avec l\'inscription'));
              }
            }else{

              $this->setParams(array(
                  'msg_err_user_exist' => 'L\'utilisateur existe déjà'));

              // redirection vers la page de l'inscription.
              $this->render('home/signup');

              }

          } else{

            // redirection vers la page de l'inscription.
            $this->render('home/signup');
          }

      } else {

        //redirection vers la page Home.
        $this->render('home/home');
      }
    }

    //permet un utilisateur de se connecterr
    function loginUser(){
    	
        // verification de la table  POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          //vider l'attribut de paramaters.
          $this->setParams(array());

          //filitrer les données.
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          //récuperer les données de $_POST
          $data =[
            'username' => trim($_POST['username']),
            'password' => trim($_POST['password']),      
          ];

          // vérifier l'utilisateur par login et passowrd
          $model = $this->getModel('User');

          if($model->findByUsername($data['username'])){
              
             $user =  $model->connect($data['username'], $data['password']); 

             if(!empty($user)){

                //creation de la session
                $this->createUserSession($user);

                if($model->isAdmin($data['username'], $data['password'])){
                    
                    //redirection vers la page de l'admin.
                    $this->render('admin/admin');

                  }else{
                    //récuperer la liste des quiz
                    $model = $this->getModel('Quiz');

                    $rowsQuiz = $model->findById('quiz', $user->id);

                    $this->setParams(array(
                    'rowsQuiz' => $rowsQuiz));
                    //redirection vers la page de l'utilisateur.
                    $this->render('user/user');
                  }
             }else{

                //redirection vers la page login avec le message d'erreur
                $this->setParams(array(
                  'msg_err' => 'Les identifiants sont incorrects.'));

                $this->render('home/login');
             }

          }else{
            //redirection vers la page login avec le message d'erreur
            $this->setParams(array(
              'msg_err' => 'Les identifiants sont incorrects.'));

            $this->render('home/login');
          }

          
      }else 
        //redirection vers la page Home.
        $this->render('home/home');
    }

	//permet un utilisateur de se deconnecter
	function logoutUser(){

    //verification si l'utilisateur est connecté 
    if($this->isConnect()){
      //destroy la session.
      $this->logoutSession();
    }
      //return vers la page d'accuiel.
	   $this->render('home/home');
	}

  //retourner vers la page accuiel de l'utilisateur.
  public function userHome(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      $this->setParams(array());
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $_SESSION['user_id']    = trim($_POST['user_id']);
          $_SESSION['user_username']  = trim($_POST['user_username']);
          $_SESSION['user_admin']   = trim($_POST['user_admin']);

      $this->render('user/user');

    }else 
        //redirection vers la page Home.
        $this->render('home/home');
    }
}