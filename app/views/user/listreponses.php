<?php  
//récuperation header de la page.
require APP . '/views/template/header.php'; ?>
</head>
<body>
<!--//récupération de navbar-->
<?php require APP . '/views/template/navbar.php'; ?>

<div class="container ">

  <h2 class="text-center mb-10"> <?php  echo 'Les Reponses Pour Cette Question'.'</n>'; ?></h2>
<?php

if(isset($rowsReponses) && sizeof($rowsReponses) < 4){
?>

  <form action="<?php echo Router::url('quiz/listquestion');?>" method="post">
      <input  name="Quiz" type="hidden" value="<?php echo $Quiz->id ?>"/>
      <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']  ?>"/>
      <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
      <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>
      <button type="submit"><i class="fa fa-arrow-left"></i></button>
  </form>
  


<div class="text-center mb-3">
<!-- boutton de nouvelle question --->
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal-reponses"><b>Nouvelle Reponse</b></button>
         </div>
</div>

<?php  
}
if(!empty($rowsReponses)){ 
  ?>
  <table id="table_users" class=" text-center table  table-hover">
    <thead>
        <tr>              
            <th> ID</th>
            <th> Reponse</th>
            <th> Bonne</th>
            <th> Supprimer</th>
        </tr>
    </thead>
    <tbody>
           
     <?php
       foreach ($rowsReponses as $value) {?>   
      <tr > 
          <td>
            <?php echo $value->id;?>
          </td>
          <td>
            <?php echo $value->reponse;?>
          </td>
          <td>
            <?php if($value->bonne == 0) echo 'Non'; else echo 'Oui' ?>
          </td>
          <td>
            <form action="<?php echo Router::url('quiz/deleteReponse');?>" method="post">
                <input  name="Question" type="hidden" value="<?php echo $Question->id  ?>"/>
                <input  name="Quiz" type="hidden" value="<?php echo $Quiz->id  ?>"/>
                <input  name="Rep" type="hidden" value="<?php echo $value->id ?>"/>
                <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']  ?>"/>
                <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
                <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>
                <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cette reponse ?');"><i class='fas fa-trash-alt' style='font-size:16px'></i></button>
            </form>
              
          </td>
      </tr>
     <?php }?>
      
    </tbody>
  </table>
 <?php  }else{
    ?>
  <h6 class="text-center mb-10"> <?php echo 'Vous n\'avez pas des reponses'.'</n>'; ?></h6>
  <?php }?>

</div>

 <!-- Modal Nouvelle quiz -->
<div class="modal fade" id="myModal-add-quiz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Nouvelle Quiz</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

  <!-- formulaire de nouvelle quiz-->
  <form action="<?php echo Router::url('quiz/creatquiz');?>" method="post" id="formulaire">

       <div class="row">
          <div class="col-sm-5">
              <label class="" for="Add_Title_Quiz">Titre du Quiz * :</label>
          </div>
          <div class="col-sm-7">
              <input type="text"   id="" name="Add_Title_Quiz" class="col-12" required>
          </div>
      </div>

      <div class="row">
          <div class="col-sm-5">
              <label class="" for="Add_Desc_Quiz">Description du Quiz *:
              </label>
          </div>
          <div class="col-sm-7">
              <input type="text" id="" name="Add_Desc_Quiz" class="col-12" required>
          </div>
      </div>

      <div class="row">
          <div class="col-sm-5">
              <label class="nouvelle-facture" for="Add_PV_Quiz">Publique ou Privé * :</label>
          </div>

          <div class="col-sm-7">
              <SELECT name="Add_PV_Quiz" id="" size="1" required>
                  <option value="0">privé</option>
                  <option value="1">publique</option>
              </SELECT>
          </div>
      </div>

      <input  name="id" type="hidden" value="<?php ?>"/>
      <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']  ?>"/>
      <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
      <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Envoyer</button>
       </div>
  </form>
     
      </div>
    </div>
  </div>
</div>
<!-- fin Modal Nouvelle Quiz -->

 <!-- Modal Reponses  -->
<div class="modal fade" id="myModal-reponses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Les Reponses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <!-- formulaire de nouvelle qquesition-->

  <form action="<?php echo Router::url('quiz/creatReponse');?>" method="post" id="formulaire">

         <div class="row">
            <div class="col-4">
                <label class="" for="N_Rep">Reponse * :</label>
            </div>
            <div class="col-8 ">
                <input type="text"  class="col-12" id="" name="N_Rep" class="" required>
            </div>
        </div>

         <div class="row">
          <div class="col-sm-4">
              <label class="nouvelle-facture" for="N_Rep_Bonne">Bonne Reponse * :</label>
          </div>
          <div class="col-sm-8">
              <SELECT name="N_Rep_Bonne" id="" size="1">
                  <option  value="<?php if(sizeof($rowsReponses) == 0) { ?> 1 <?php }else{ ?> 0 <?php }?>"><?php if(sizeof($rowsReponses) == 0){ echo 'Oui'; }else{ echo 'Non'; }?>
                  </option>
              </SELECT>
          </div>
      </div>

  <input  name="Question" type="hidden" value="<?php echo $Question->id  ?>"/>
  <input  name="Quiz" type="hidden" value="<?php echo $Quiz->id  ?>"/>
  <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']  ?>"/>
  <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
  <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>

<div class="modal-footer">
  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </div>
</form>
    </div>
    </div>
  </div>
</div>
 <!-- Fin Modal Reponses -->
<?php 
//récuperation le footer de la page.-->
require APP . '/views/template/footer.php';?>
</body>
</html>