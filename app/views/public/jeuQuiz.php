<?php 
 //include le header.
require APP . '/views/template/header.php'; ?>
</head>
<body >
<?php //include le navbar
require APP . '/views/template/navbar.php';  
?>
<div class="container">
  <button type="button" value="Go" onClick='window.history.go(-1)'><i class="fa fa-arrow-left"></i></button>
 	<div class="text-center mb-3">

		  <span class="" style="  font-weight: bold; font-size: 2.2em">
	      <?php if(!empty($quiz)) echo 'Nom du Quiz : '.strtoupper($quiz->title). '</br>'; ?>
	    </span>

	  
	</div>
</div>

<!-- la table des questions -->
<?php if( isset($quest)) print_r($quest);
  if(!isset($nbr_rep)){
 
    if(!empty($quests)){
     if(isset($i)){ ?>
    

    <form action="<?php echo Router::url('start/verifQuiz');?>" method="post">

    <div class="container">
      <?php
      $index = 1;
      for ($j = 0; $j < $i; $j++) {
      ?>
        <span class="" style="  font-weight: bold; font-size: 2.2em">

            <?php $quest = "questions_$j";
            
            if(!empty($$quest)) echo 'Question '. $index; echo " : "; echo ($$quest->question). '</br>'; ?>
        </span>
        <?php $rep = "reponses_$j";
        if(!empty($$rep))
        foreach ($$rep as $value) {?>
        <div class=".row">
          <input  name="<?php echo $value->id; ?>" type="hidden" value="<?php echo $i ?>"/>
          <input type="radio" class="col-md-1" name="rep_<?php echo $$quest->id; ?>" value="<?php echo $value->reponse;?>"> <label for="huey"><?php echo $value->reponse;?></label></br>

        </div>
       <?php }
       $index++;
       }
     }
       ?>
    </div>

    <div class="text-center mb-3">
       <input  name="nbrqest" type="hidden" value="<?php echo $i ?>"/>
       <input  name="idquiz" type="hidden" value="<?php echo $quiz->id ?>"/>
       <button type="submit" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal-add-quest"><b>Envoyer</b></button>
     </div>

    </form>
  <?php
  }else?>
    <h6 class="text-center mb-10"> <?php echo 'Vous n\'avez pas des questions'.'</n>'; ?></h6>
<?php
  }else{

    if($nbr_rep > $nbrqest/2){


?>
  
<div class="container">
  <h4 class="text-center mb-3" style="color: green">
    <?php if(isset($nbr_rep)) echo $nbr_rep; ?> bonnes réponses sur <?php if(isset($nbrqest)) echo $nbrqest; ?> questions.
  </h4>
 <div>
<?php 
}
?>


<?php 
}

 //include la page footer.
require APP . '/views/template/footer.php';
?>
</body>
</html>