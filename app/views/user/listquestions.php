<?php 

if(isset($_GET['id'])) echo $_GET['id'];
 //include le header.
require APP . '/views/template/header.php'; ?>
</head>
<body >
<?php //include le navbar
require APP . '/views/template/navbar.php'; 

?>

<div class="container">

  <form action="<?php echo Router::url('quiz/listquiz');?>" method="post">
        <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id'] ?>"/>
        <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
        <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>
        <button type="submit"><i class="fa fa-arrow-left"></i></button>
    </form>

<div class="text-center mb-3">
<!-- boutton de nouvelle question --->
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal-add-quest"><b>Nouvelle Question</b></button>
         </div>
</div>
<div class="text-center mb-3">
         <span class="" style="color: green; font-size: 1.2em">
            <?php 
            if(!empty($creat_success)) echo $creat_success.'</br>';  
                if(!empty($creat_quest_success)) echo $creat_quest_success.'</br>';
                if(!empty($msg_succ_delete)) echo $msg_succ_delete.'</br>' 

                  
            ?>
          </span>

          <span class="" style="color: red; font-size: 1.2em">
            <?php if(!empty($msg_failed_delete)) echo $msg_failed_delete.'</br>';  
                if(!empty($ccreat_failed)) echo $creat_failed.'</br>';    
            ?>
          </span>
</div>
<h2 class="text-center mb-10"> 
  <?php  echo 'La liste des questions'.'<br>';
  if(isset($Quiz)) echo 'Nom du Quiz : '.strtoupper($Quiz->title).'<br>'; ?>

</h2>


<!-- la table des questions -->
<?php if(!empty($rowsQuestions)){ ?>
<table id="table_users" class=" text-center table  table-hover">
    <thead>
        <tr>              
            <th> ID</th>
            <th> Question</th>
            <th> Gérer Ses Reponses</th>
            <th> Supprimer</th>
        </tr>
    </thead>
    <tbody>
           
     <?php  
       foreach ($rowsQuestions as $value) {?>   
      <tr > 
          <td>
            <?php echo $value->id;?>
          </td>
          <td>
            <?php echo $value->question;?>
          </td>
          <td>
            <form action="<?php echo Router::url('quiz/listReponses');?>" method="post">
                <input  name="Quiz" type="hidden" value="<?php echo $Quiz->id ?>"/>
                <input  name="Question" type="hidden" value="<?php echo $value->id ?>"/>
                <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']  ?>"/>
                <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
                <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>
                <button type="submit"><i class='fas fa-copy' style='font-size:16px'></i></button>

            </form>
              
          </td>
          <td>
            <form action="<?php echo Router::url('quiz/deleteQuest');?>" method="post">
                <input  name="quiz" type="hidden" value="<?php echo $Quiz->id ?>"/>
                <input  name="id" type="hidden" value="<?php echo $value->id ?>"/>
                <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']  ?>"/>
                <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
                <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>
                <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cette question avec ses reponces?');"><i class='fas fa-trash-alt' style='font-size:16px'></i></button>
            </form>
              
          </td>
      </tr>
      <?php  }
    }else{

       ?>
      
    </tbody>
  </table>

  <h6 class="text-center mb-10"> <?php   echo 'Ce Quiz est Vide.'.'</n>'; }?></h6>


 <!-- Modal Nouvelle Question -->
<div class="modal fade" id="myModal-add-quest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Nouvelle Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <!-- formulaire de nouvelle qquesition-->
  <form action="<?php echo Router::url('quiz/creatQuest');?>" method="post" id="formulaire">

     <div class="row">
        <div class="col-3">
            <label class="" for="NOM_Qest">Question * :</label>
        </div>
        <div class="col-9 ">
            <input type="text"  class="col-12" id="" name="NOM_Qest" class="" required>
        </div>
    </div>
  <input  name="quiz" type="hidden" value="<?php echo $Quiz->id  ?>"/>
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
 <!-- Fin Modal Nouvelle Question -->

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
          <div class="col-sm-6">
              <label class="" for="Add_Title_Quiz">Titre du Quiz * :</label>
          </div>
          <div class="col-sm-6">
              <input type="text"   id="" name="Add_Title_Quiz" class="" required>
          </div>
      </div>

      <div class="row">
          <div class="col-sm-6">
              <label class="" for="Add_Desc_Quiz">Description du Quiz :
              </label>
          </div>
          <div class="col-sm-6">
              <input type="text" id="" name="Add_Desc_Quiz" class="" required>
          </div>
      </div>

      <div class="row">
          <div class="col-sm-6">
              <label class="nouvelle-facture" for="Add_PV_Quiz">Publique ou Privé * :</label>
          </div>

          <div class="col-sm-6">
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
 //include la page footer.
require APP . '/views/template/footer.php';
?>
</body>
</html>