<?php //include le header.
require APP . '/views/template/header.php'; ?>
</head>
<body>
<?php //include le navbar
require APP . '/views/template/navbar.php'; ?>

<div class="container">

  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light my-5 ">
        <h2>Créer un compte</h2>
        <p>Pour vous inscrire, veuillez remplir ce formulaire </p>

        <!--
            les messages d'erreurs.
        -->
        <div class="text-center">
          <span class="" style="color: red ; font-size: 1.2em;"><?php if(!empty($msg_err_password)) echo $msg_err_password; ?></span>
          <span class="" style="color: red ; font-size: 1.2em;"><?php if(!empty($msg_err_confirm_password)) echo $msg_err_confirm_password; ?></span>
          <span class="" style="color: green ; font-size: 1.2em;"><?php if(!empty($signup_success)) echo $signup_success; ?></span>
          <span class="" style="color: red ; font-size: 1.2em;"><?php if(!empty($signup_failed)) echo $signup_failed; ?></span>
          <span class="" style="color: red ; font-size: 1.2em;"><?php if(!empty($msg_err_user_exist)) echo $msg_err_user_exist; ?></span>
        </div>

        <!-- le fourmulaire d'inscription.-->
        <form action="<?php echo Router::url('users/signupUser');?>" method="post">

          <div class="form-group">
            <label for="username">Login: <sup>*</sup></label>
            <input type="text" name="username" class="form-control form-control-lg"  required>
          </div>
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg"   required >
          </div>
          <div class="form-group">
            <label for="password">Mot de passe: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg" required>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirmez le mot de passe: <sup>*</sup></label>
            <input type="password" name="confirm_password" class="form-control form-control-lg" required>
          </div>

          <div class="row">
            <div class="col">
              <input type="submit" value="S'inscrire" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo Router::url('page/login');?>" class="btn btn-light btn-block">Vous avez déjà un compte? Connexion !</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<?php //include la page footer.
require APP . '/views/template/footer.php'; ?>
</body>
</html>


