<?php

//gerer la page d'accueil de site, login, l'inscription
class AdminController extends Controller
{
	//afficher la liste des utilisateur.
	public function listUsers(){

		$model = $this->getModel('User');

		$rowsTable = $model->getAllUsers();

		$this->setParams($rowsTable);

		$this->setParams(array(
                  'rowsTable' => $rowsTable));

		$this->render('admin/listUsers'); 
	}

	//supprimer un utilisateur avec ses quiz.
	public function deleteUser(){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$this->setParams(array());
			// Sanitize POST data
          	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          	$id 						= trim($_POST['id']);
          	$_SESSION['user_id'] 		= trim($_POST['user_id']);
	      	$_SESSION['user_username'] 	= trim($_POST['user_username']);
	      	$_SESSION['user_admin'] 	= trim($_POST['user_admin']);

	      	//récupere le model de la table quiz.
            $modelquiz = $this->getModel('Quiz');
            $modelquest = $this->getModel('Questions');
            $modelrep = $this->getModel('Reponses');

            $quiz = $modelquiz->findByAttr('quiz', 'user', $id);

            if(!empty($quiz)){
            	foreach ($quiz as $valueQZ) {
            		//récupere toutes les questions de quiz.
           	 		$quests = $modelquest->findByAttr('questions', 'quiz', $valueQZ->id);

		            if(!empty($quests)){
		            	foreach ($quests as $valueQ) {
		            		//suppression de toute les reponses.
		            		$reponses = $modelrep->findByAttr('reponses', 'question', $valueQ->id);
		            		foreach ($reponses as $valueR) {
		            			$modelrep->deleterep($valueR->id);
		            		}

							//supprimere les questions.
		            		$modelquest->deleteQuest($valueQ->id);
		            	}
		            }
		            //supprimere le quiz.
		            $modelquiz->deletequiz($valueQ->id);
            
		        }
		    }

			$model = $this->getModel('User');

			$delete = $model->deleteByID('users', $id);

			$rowsTable = $model->getAllUsers();
			
			$this->setParams($rowsTable);

			$this->setParams(array(
                  'rowsTable' => $rowsTable));

			if($delete){

				$this->setParams(array(
                  'msg_succ_delete' => "La suppression a été bien fait"));
			}else{
				$this->setParams(array(
                  'msg_failed_delete' => "Il y a un probleme lors de la suppression de l'utilisateur"));
			}

		}
			//redirection 
			$this->render('admin/listUsers'); 
	}


	//afficher tous les quiz de tous les utilisateur.
	public function listAllquiz(){

		$model = $this->getModel('Quiz');

	    $rowsTable = $model->getAllTable('quiz');

		$this->setParams($rowsTable);


		$this->setParams(array(
                  'rowsTable' => $rowsTable));

		$this->render('admin/listQuiz'); 
	}

	//supprimer un quiz avec ses questions
	public function deletequiz(){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$this->setParams(array());
			// Sanitize POST data
          	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          // récuperer les données
          	$idquiz = trim($_POST['id']);
          	$_SESSION['user_id'] 		= trim($_POST['user_id']);
	      	$_SESSION['user_username'] 	= trim($_POST['user_username']);
	      	$_SESSION['user_admin'] 	= trim($_POST['user_admin']);

			//récupere les models
            $modelquiz = $this->getModel('Quiz');
            $modelquest = $this->getModel('Questions');
            $modelrep = $this->getModel('Reponses');

            //récupere toutes les questions de quiz.
            $quests = $modelquest->findByAttr('questions', 'quiz', $idquiz);

            if(!empty($quests)){
            	foreach ($quests as $valueQ) {
            		//suppression de toute les reponses.
            		$reponses = $modelrep->findByAttr('reponses', 'question', $valueQ->id);
            		foreach ($reponses as $valueR) {
            			$modelrep->deleterep($valueR->id);
            		}

					//supprimere toutes les questions avec les réponse.
            		$modelquest->deleteQuest($valueQ->id);
            	}
            }
            
            if($modelquiz->deletequiz($idquiz)){

 				
 				$rowsTable = $modelquiz->getAllTable('quiz');

                $this->setParams(array(
                    'rowsTable'			=> $rowsTable,
                    'msg_succ_delete'	=> 'la suppression de quiz est bien fait'
                ));

            }else{
            	$this->setParams(array(
                    'msg_failed_delete'	=> 'Il y a une problèmes avec la suppression du quiz'
                ));
            }

            //redirection vers la page Home.
       		 $this->render('admin/listQuiz');

      }else{
      	//redirection vers la page Home.
        $this->render('home/home');
      }	
			
	}



/*
	public function listeQuiz(){

		$model = $this->getModel('User');

		$rowsTable = $model->getAllTable('users');

		$this->setParams($rowsTable);

		$this->render('user/listUsers'); 
	}

*/
}

?>