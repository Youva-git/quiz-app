<?php

//gerer la page d'accueil de site, login, l'inscription
class QuizController extends Controller
{
	//créer un quiz
	public function creatquiz(){

		//verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          // filter les données 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $this->setParams(array());

          	$data =[
            'title'       => trim($_POST['Add_Title_Quiz']),
            'description' => trim($_POST['Add_Desc_Quiz']),
            'public'      => trim($_POST['Add_PV_Quiz']),
            'user'        => trim($_POST['user_id'])
          ];
          
          	//récupere la session.  
          $_SESSION['user_id'] 		    = trim($_POST['user_id']);
	      	$_SESSION['user_username'] 	= trim($_POST['user_username']);
	      	$_SESSION['user_admin'] 	  = trim($_POST['user_admin']);

            //récupere le model de la table quiz.
            $model = $this->getModel('Quiz');

            
            

 

              if($model->addquiz($data)){
                  $quiz  = $model->db->getLastInserted();

              		$rowsQuestions =  "";
                  $Quiz  = $model->findById('quiz', $quiz);
 				 	        $this->setParams(array(
	                    'creat_success' => 'La création du quiz et bien fait veuillez le remplir',
	                    'Quiz'     => $Quiz, 
                	));			 

              } else {
                  $Quiz  = $model->findById('quiz', $quiz);
                  $this->setParams(array(
                    'creat_failed' => 'Il y a une problèmes avec la création de quiz'
                  ));
              }

              $this->render('user/listquestions'); 

      }else{
      	//redirection vers la page Home.
        $this->render('home/home');
      }		
	}

//-----------------------------------------------
	//supprimer un quiz 
	public function deletequiz(){

		//verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          // filter les données 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $this->setParams(array());

          // récuperer les données
          $idquiz = trim($_POST['id']);


          	//récupere la session.  
          $_SESSION['user_id'] 		= trim($_POST['user_id']);
	      	$_SESSION['user_username'] 	= trim($_POST['user_username']);
	      	$_SESSION['user_admin'] 	= trim($_POST['user_admin']);

            //récupere le model de la table quiz.
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

 				
 				       $rowsQuiz =  $modelquiz->listquiz($_SESSION['user_id']);

                $this->setParams(array(
                    'rowsQuiz'			=> $rowsQuiz,
                    'msg_succ_delete'	=> 'la suppression de quiz est bien fait'
                ));

            }else{
            	$this->setParams(array(
                    'msg_failed_delete'	=> 'Il y a une problèmes avec la suppression du quiz'
                ));
            }

            
            //redirection vers la page Home.
       		 $this->render('user/listquiz');

      }else{
      	//redirection vers la page Home.
        $this->render('home/home');
      }		
	}

	//création des questions
	public function listquiz(){

		//verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          // filter les données 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $this->setParams(array());

          	//récupere la session.  
            $_SESSION['user_id'] 		   = trim($_POST['user_id']);
	      	$_SESSION['user_username'] 	 = trim($_POST['user_username']);
	      	$_SESSION['user_admin'] 	   = trim($_POST['user_admin']);

            //récupere le model de la table quiz.
             $model     = $this->getModel('Quiz');
 				     $rowsQuiz =  $model->listquiz($_SESSION['user_id']);

                $this->setParams(array(
                    'rowsQuiz'			=> $rowsQuiz
                ));

                $this->render('user/listquiz'); 

      }else{
      	//redirection vers la page Home.
        $this->render('home/home');	
	  }
	}

	//création des questions
	public function creatQuest(){

		//verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          // filter les données 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $this->setParams(array());

          $quiz    = trim($_POST['quiz']);
          // récuperer les données
          $data =[
          	'question'		=> trim($_POST['NOM_Qest']),
            'quiz' 		=> $quiz
          ];

          //récupere la session.  
          $_SESSION['user_id'] 		    = trim($_POST['user_id']);
	      	$_SESSION['user_username'] 	= trim($_POST['user_username']);
	      	$_SESSION['user_admin'] 	  = trim($_POST['user_admin']);

            //récupere le model de la table quiz.
            $modelquest = $this->getModel('Questions');
            $modelquiz  = $this->getModel('Quiz');

            $Quiz       = $modelquiz->findById('quiz', $quiz);

              if($modelquest->addquest($data)){
 				
 				      // $rowsQuestions =  $model->getAllTable('questions');
               $rowsQuestions =  $modelquest->listeQuestion($quiz);

                $this->setParams(array(
                    'creat_quest_success' => 'La création de la question et bien fait, veuillez ajouter des reponses',
                    'rowsQuestions'			  => $rowsQuestions,
                    'Quiz'                => $Quiz
                ));

                $this->render('user/listquestions'); 

              } else {

                $this->setParams(array(
                    'creat_failed' => 'Il y a une problèmes avec la création de la question',
                    'Quiz'              => $Quiz
                  ));
              }

      }else{
      	//redirection vers la page Home.
        $this->render('home/home');	
	  }
	}

//--------------------------------------------------------
	public function deleteQuest(){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$msg_succ_delete = "";
			$msg_failed_delete = "";
      $this->setParams(array());

			// Sanitize POST data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $quiz                      = trim($_POST['quiz']);
          $id 						           = trim($_POST['id']);
          $_SESSION['user_id'] 		   = trim($_POST['user_id']);
	      	$_SESSION['user_username'] = trim($_POST['user_username']);
	      	$_SESSION['user_admin'] 	 = trim($_POST['user_admin']);

          $modelquiz  = $this->getModel('Quiz');
			    $modelquest  = $this->getModel('Questions');
          $modelrep = $this->getModel('Reponses');

          $reponses = $modelrep->findByAttr('reponses', 'question', $id);
            foreach ($reponses as $valueR) {
                  $modelrep->deleterep($valueR->id);
            }

            $delete = $modelquest->deleteQuest($id);

          $Quiz       = $modelquiz->findById('quiz', $quiz);
          $rowsQuestions =  $modelquest->listeQuestion($quiz);
			
			if($delete){

				$this->setParams(array(
				  'msg_succ_delete' => "La suppression a été bien fait",
          'rowsQuestions' => $rowsQuestions,
          'Quiz'              => $Quiz
        ));


			}else{
				$this->setParams(array(
            'msg_failed_delete' => "Il y a un probleme lors de la suppression de l'utilisateur",
            'Quiz'              => $Quiz
        ));
			}
			//redirection vers la page des question.
			$this->render('user/listquestions');

		}else{
			//redirection vers la page home
			$this->render('home/home');
		}	
	}


	//création des questions
	public function listquestion(){

		//verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          // filter les données 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $this->setParams(array());

          //récupere la session et le id de quiz
          $quiz                      = trim($_POST['Quiz']);
          $_SESSION['user_id'] 		   = trim($_POST['user_id']);
	      	$_SESSION['user_username'] = trim($_POST['user_username']);
	      	$_SESSION['user_admin'] 	 = trim($_POST['user_admin']);


          //récupere le model de la table question
          $modelquiz  = $this->getModel('Quiz');
          $model = $this->getModel('Questions');

 				  $rowsQuestions =  $model->listeQuestion($quiz);
          $Quiz          = $modelquiz->findById('quiz', $quiz);

                $this->setParams(array(
                    'rowsQuestions'	=> $rowsQuestions,
                    'Quiz'		=> $Quiz
                ));

                $this->render('user/listquestions'); 

      }else{
      	//redirection vers la page Home.
        $this->render('home/home');	
	  }
	}
  
  
    //création des questions
  public function listReponses(){

    //verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          // filter les données 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $this->setParams(array());

          //récupere la session et le id de quiz
          $quiz                      = trim($_POST['Quiz']);
          $question                  = trim($_POST['Question']);
          $_SESSION['user_id']       = trim($_POST['user_id']);
          $_SESSION['user_username'] = trim($_POST['user_username']);
          $_SESSION['user_admin']    = trim($_POST['user_admin']);

          //récupere le model de la table question
          $modelquiz  = $this->getModel('Quiz');
          $Quiz          = $modelquiz->findById('quiz', $quiz);
          //récupere le model de la table question
          $modelreponses  = $this->getModel('Reponses');
          $modelquestion = $this->getModel('Questions');

          $rowsReponses =  $modelreponses->listeReponses($question);
          $Question          = $modelquestion->findById('questions', $question);

                $this->setParams(array(
                    'rowsReponses'=> $rowsReponses,
                    'Question'    => $Question,
                    'Quiz'        => $Quiz
                ));

                $this->render('user/listreponses'); 

      }else{
        //redirection vers la page Home.
        $this->render('home/home'); 
    }
  }
  //remplir les réponse
  public function creatReponse(){

    //verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          // filter les données 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $this->setParams(array());

          $quiz       = trim($_POST['Quiz']);
          $question   = trim($_POST['Question']);
          // récuperer les données
          $data =[
            'reponse'     => trim($_POST['N_Rep']),
            'bonne'       => trim($_POST['N_Rep_Bonne']),
            'question'    => $question
          ];

          //récupere la session.  
          $_SESSION['user_id']        = trim($_POST['user_id']);
          $_SESSION['user_username']  = trim($_POST['user_username']);
          $_SESSION['user_admin']     = trim($_POST['user_admin']);

            //récupere le model de la table quiz.
            $modelquest = $this->getModel('Questions');
            $modelreponse  = $this->getModel('reponses');
            $modelquiz  = $this->getModel('Quiz');
            $Quiz          = $modelquiz->findById('quiz', $quiz);

            $Question       = $modelquiz->findById('Questions', $question);

              if($modelreponse->addreponse($data)){
        
              // $rowsQuestions =  $model->getAllTable('questions');
               $rowsReponses =  $modelreponse->listeReponses($question);

                $this->setParams(array(
                    'creat_quest_success' => 'La création de la reponse et bien fait',
                    'rowsReponses'        => $rowsReponses,
                    'Question'            => $Question,
                    'Quiz'                => $Quiz
                ));

                $this->render('user/listreponses'); 

              } else {

                $this->setParams(array(
                    'creat_failed' => 'Il y a une problèmes avec la création de la reponse',
                    'Question'     => $Question,
                    'Quiz'         => $Quiz
                  ));
              }

      }else{
        //redirection vers la page Home.
        $this->render('home/home'); 
    }
  }

    public function deleteReponse(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      $msg_succ_delete = "";
      $msg_failed_delete = "";
      $this->setParams(array());

      // Sanitize POST data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $quiz                      = trim($_POST['Quiz']);
          $question                  = trim($_POST['Question']);
          $reponse                   = trim($_POST['Rep']);
          $_SESSION['user_id']       = trim($_POST['user_id']);
          $_SESSION['user_username'] = trim($_POST['user_username']);
          $_SESSION['user_admin']    = trim($_POST['user_admin']);

          $modelquest = $this->getModel('Questions');
          $modelreponse  = $this->getModel('reponses');
          $modelquiz  = $this->getModel('Quiz');

          $delete = $modelreponse->deleterep($reponse);

          $Quiz          = $modelquiz->findById('quiz', $quiz);
          $Question       = $modelquiz->findById('Questions', $question);
          $rowsReponses =  $modelreponse->listeReponses($question);

      
      if($delete){

        $this->setParams(array(
          'msg_succ_delete' => "La suppression a été bien fait",
          'rowsReponses'        => $rowsReponses,
          'Question'            => $Question,
          'Quiz'                => $Quiz
        ));


      }else{
        $this->setParams(array(
            'msg_failed_delete' => "Il y a un probleme lors de la suppression de l'utilisateur",
            'Quiz'              => $Quiz
        ));
      }
      //redirection vers la page des question.
      $this->render('user/listreponses');

    }else{
      //redirection vers la page home
      $this->render('home/home');
    } 
  }


	//création des questions
	public function publicquiz(){

	  $this->setParams(array());
		//verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          // filter les données 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          //si l'utilisateur 
	          if(isset($_SESSION['user_id'])){
	          	//récupere la session.  
	            $_SESSION['user_id'] 		= trim($_POST['user_id']);
		      	  $_SESSION['user_username'] 	= trim($_POST['user_username']);
		      	  $_SESSION['user_admin'] 	= trim($_POST['user_admin']);
	          }
          
          }	

            //récupere le model de la table quiz.
            $model = $this->getModel('Quiz');
 				
 				$rowsQuiz =  $model->listquizpublic();

                $this->setParams(array(
                    'rowsQuiz'			=> $rowsQuiz
                ));

                $this->render('user/publiquequiz'); 
	  
	}

}
