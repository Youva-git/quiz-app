<?php //include le header.
require APP . '/views/template/header.php'; ?>
</head>
<body>
<?php //include le navbar
require APP . '/views/template/navbar.php'; ?>

<div class="container">

  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">

        <h2>Connexion</h2>
        <p>Veuillez saisir vos identifiants pour vous connecter</p>

        <!-- le fourmulaire de connexion.-->
        <form action="<?php echo Router::url('users/loginUser');?>" method="post">

          <!-- le message d'erreur-->
          <span class="" style="color: red"><?php if(!empty($msg_err)) echo $msg_err; ?></span>

          <div class="form-group">
            <label for="username">Login: <sup>*</sup></label>
            <input type="text" name="username" class="form-control form-control-lg <?php ?>" required  >
          </div>
          <div class="form-group">
            <label for="password">Mot de passe: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php ?>" required >
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Connexion" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo Router::url('page/signup'); ?>" class="btn btn-light btn-block">Pas de compte? s'inscrire</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
require //include la page footer.
APP . '/views/template/footer.php';?>
</body>
</html>