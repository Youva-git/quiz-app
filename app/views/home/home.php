<?php //include le header.
require APP . '/views/template/header.php'; ?>
</head>
<?php //include le navbar
require APP . '/views/template/navbar.php'; ?>

<div class="container">
 <div class="text-center mb-3">
	<!--<img src="<?php echo URLQUIZ; ?>/image/Quiz.jpg" class="center-block " alt="créer votre quiz">-->

	<p>
	Créez un quiz en ligne sur n'importe quel sujet</br>
Réalisez des évaluations simples et rapides avec la notation automatique
	</p>
</div>

	<div class="row">
	    <div class="col-12 text-center">
	    <!-- chemin vers le page d'inscription.-->
		    <a href="<?php echo Router::url('page/signup');?>">Inscrivez-vous !</a>
		    <a href="<?php echo Router::url('quiz/publicquiz'); ?>">Quiz publique</a>
	    </div>
	</div>

 	<br>
    <br>
    <div class="col-12 text-center">
		<img src="<?php echo URLQUIZ; ?>/image/Home_quiz.jpg" style="width: 50%; height: 50%">

	</div>
<?php //include la page footer.
require APP . '/views/template/footer.php';?>
</body>
</html>