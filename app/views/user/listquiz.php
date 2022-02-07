<?php  
//récuperation header de la page.
require APP . '/views/template/header.php'; ?>
</head>
<body>
<!--//récupération de navbar-->
<?php require APP . '/views/template/navbar.php'; ?>

<div class="container ">
 <!-- <button type="button" value="Go" onClick='window.history.back()'><i class="fa fa-arrow-left"></i></button>
-->
  <form action="<?php echo Router::url('users/userHome');?>" method="post">
      <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']  ?>"/>
      <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
      <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>
      <button type="submit"><i class="fa fa-arrow-left"></i></button>
  </form>
  <h2 class="text-center mb-10"> <?php  echo 'Liste Des Quiz '.'</n>'; ?></h2>

<?php  if(!empty($rowsQuiz)){ 
  ?>
  <table id="table_users" class=" text-center table  table-hover">
    <thead>
        <tr>              
            <th> ID</th>
            <th> title</th>
            <th> description</th>
            <th> Editer</th>
            <th> Supprimer</th>
        </tr>
    </thead>
    <tbody>
           
     <?php
       foreach ($rowsQuiz as $value) {?>   
      <tr > 
          <td>
            <?php echo $value->id;?>
          </td>
          <td>
            <?php echo $value->title;?>
          </td>
          <td>
            <?php echo $value->description;?>
          </td>
          <td>
            <form action="<?php echo Router::url('quiz/listquestion');?>" method="post">
                <input  name="Quiz" type="hidden" value="<?php echo $value->id ?>"/>
                <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']  ?>"/>
                <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
                <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>
                <button type="submit"><i class='fas fa-edit' style='font-size:16px'></i></button>
            </form>
              
          </td>
          <td>
            <form action="<?php echo Router::url('quiz/deletequiz');?>" method="post">
                <input  name="id" type="hidden" value="<?php echo $value->id ?>"/>
                <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']  ?>"/>
                <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
                <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>
                <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce quiz?');"><i class='fas fa-trash-alt' style='font-size:16px'></i></button>
            </form>
              
          </td>
      </tr>
     <?php }?>
      
    </tbody>
  </table>
 <?php  }else{
    ?>
  <h6 class="text-center mb-10"> <?php echo 'Vous n\'avez pas des quiz'.'</n>'; ?></h6>
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
<?php 
//récuperation le footer de la page.-->
require APP . '/views/template/footer.php';?>
</body>
</html>