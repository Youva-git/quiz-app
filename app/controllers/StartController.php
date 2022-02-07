<?php

//gerer la page d'accueil de site, login, l'inscription
class StartController extends Controller
{
	//afficher la liste des utilisateur.
	public function startGame(){

	//verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          // filter les données 
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $this->setParams(array());

          // récuperer les données
          $idquiz = trim($_POST['id']);

            //récupere le model de la table quiz.
            $modelquiz = $this->getModel('Quiz');
            $modelquest = $this->getModel('Questions');
            $modelrep = $this->getModel('Reponses');

            //récuperation quiz
            $quiz = $modelquiz->findByAttr('quiz', 'id', $idquiz);

            $this->setParams(array(
          	'quiz' => $quiz[0],
          	
          	));

            //récupere toutes les questions et les réponses de quiz
            $quests = $modelquest->findByAttr('questions', 'quiz', $idquiz);
            $i =0;
            if(!empty($quests)){
            	foreach ($quests as $valueQ) {
            		

            		//suppression de toute les reponses.
            		$reponses = $modelrep->findByAttr('reponses', 'question', $valueQ->id);

            		$this->setParams(array(
                  	'questions'.'_'.$i => $valueQ,
                  	'reponses'.'_'.$i  => $reponses,
                    'quests'           => $quests
                  	));
            	$i++;
            	}
            }
            //le nombre des reponses existe dans ce quiz

            $this->setParams(array(
                  	'i' => $i
            ));

            //return vers la page d'accuiel.
	   		$this->render('public/jeuQuiz');
             
		}else{
			//return vers la page d'accuiel.
	   		$this->render('home/home');

		}

	}

	//verifier le resultat de quiz.
	public function verifQuiz(){

		//verification si le tableau $_POST existe.
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

      	 	// filter les données 
          	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      		// récuperer les données
          	$idquiz = trim($_POST['idquiz']);
          	$nbrqest = trim($_POST['nbrqest']);

            //récupere le model de la table quiz.
            $modelquiz = $this->getModel('Quiz');
            $modelquest = $this->getModel('Questions');
            $modelrep = $this->getModel('Reponses');

            //récuperation quiz
            $quiz = $modelquiz->findByAttr('quiz', 'id', $idquiz);

            $nbr_rep = 0;

            $data = array_keys($_POST);
            for ($j = 0; $j < sizeof($data); $j++) {
            $idrep = explode('_', $data[$j]);
           		if(sizeof($idrep) > 1 ){
           			$index = $data[$j];
           			if($modelrep->bonnerep($idrep[1], $_POST[$index])){
           				$nbr_rep++;
           			}
           		}
			}


			$this->setParams(array(
                  	'nbrqest' => $nbrqest,
                  	'nbr_rep'      => $nbr_rep,
                  	'quiz'       => $quiz[0]
                  	));

			$this->render('public/jeuQuiz');

      }else{
			//return vers la page d'accuiel.
	   		$this->render('home/home');

	  }

	}
}