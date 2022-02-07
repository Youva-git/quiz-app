<?php 
//récuperation header de la page.
require APP . '/views/template/header.php'; ?>
</head>
<body>
<?php 
//récupération de navbar-->
require APP . '/views/template/navbar.php'; 
?>
<div class="container">
 	<div class="text-center mb-3">
	<p>
		Bonjour <b><?php if(isset($_SESSION['user_username'])) echo $_SESSION['user_username']; ?></b><br>
		Nous sommes heureux de vous avoir avec nous.<br>
		Vous pouvez créer de nombreuses quiz et les partager avec d'autres.<br><br>

		<div>
		<div>
			<form action="<?php echo Router::url('quiz/listquiz');?>" method="post">
                <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id'] ?>"/>
                <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
                <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>
                <button type="submit" style="color: red">Mes Quiz</button>
            </form>
        </div>
        <br> 
        <div>

			<img src="<?php echo URLQUIZ; ?>/image/Quiz.jpg" style="width: 50%; height: 50%">

		</div>
		</div>
	</p>
 </div>
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