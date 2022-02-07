<?php 
require APP . '/views/template/header.php'; ?>
</head>
<body>
<?php require APP . '/views/template/navbar.php'; ?>

<div class="container ">

  <h2 class="text-center mb-10">Bonjour : <?php if(isset($_SESSION['user_username'])) echo $_SESSION['user_username'];?></h2>

  <div class="text-center">
      <a href="<?php echo Router::url('admin/listUsers') ?>?id=<?php echo $_SESSION['user_id'];?>&ok=<?php echo $_SESSION['user_admin'];?>&us=<?php echo $_SESSION['user_username']; ?>"><button type="button"> La liste des utilisateurs</button></a>
      <a href="<?php echo Router::url('admin/listAllquiz');?>?id=<?php echo $_SESSION['user_id'];?>&ok=<?php echo $_SESSION['user_admin'];?>&us=<?php echo $_SESSION['user_username']; ?>"><button type="button"> La liste des Quiz</button></a>
  </div>

</div>


<?php require APP . '/views/template/footer.php';?>
</body>
</html>