<?php  session_start();
//recréation de la session. 
if(isset($_GET['id'])) $_SESSION['user_id'] = $_GET['id'];
if(isset($_GET['us'])) $_SESSION['user_username'] = $_GET['us'];
if(isset($_GET['ok'])) $_SESSION['user_admin'] = $_GET['ok'];
//récuperation header de la page.
require APP . '/views/template/header.php'; ?>
</head>
<body>
  <!--récupération de navbar-->
<?php require APP . '/views/template/navbar.php'; ?>

<div class="container ">
<button type="button" value="Go" onClick='window.history.go(-1)'><i class="fa fa-arrow-left"></i></button>
  <h2 class="text-center mb-10"> <?php  echo 'La liste des utilisateurs '.'</n>'; ?></h2>
  <!-- le message d'erreur-->
  <div class="text-center">

    <span class="" style="color: green; font-size: 1.2em"><?php if(!empty($msg_succ_delete)) echo $msg_succ_delete; ?></span>
    <span class="" style="color: red; font-size: 1.2em"><?php if(!empty($msg_failed_delete)) echo $msg_failed_delete; ?></span>
  </div>

  <table id="table_users" class=" text-center table  table-hover">
    <thead>
        <tr>              
            <th> ID</th>
            <th> UserName</th>
            <th> Email</th>
            <th> Supprimer</th>
        </tr>
    </thead>
    <tbody>
           
     <?php  if(!empty($rowsTable)){   
       foreach ($rowsTable as $value) {?>   
      <tr > 
          <td>
            <?php echo $value->id;?>
          </td>
          <td>
            <?php echo $value->username;?>
          </td>
          <td>
            <?php echo $value->email;?>
          </td>
          <td>
            <form action="<?php echo Router::url('admin/deleteUser');?>" method="post">
                <input  name="id" type="hidden" value="<?php echo $value->id ?>"/>
                <input  name="user_id" type="hidden" value="<?php echo $_SESSION['user_id']  ?>"/>
                <input  name="user_username" type="hidden" value="<?php echo $_SESSION['user_username'] ?>"/>
                <input  name="user_admin" type="hidden" value="<?php echo $_SESSION['user_admin']  ?>"/>
                <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce utilisateur?');"><i class='fas fa-trash-alt' style='font-size:16px'></i></button>
            </form>
              
          </td>
      </tr>
      <?php  }
    }else{

       ?>
      
    </tbody>
  </table>

  <h6 class="text-center mb-10"> <?php   echo 'Liste Vide.'.'</n>'; }?></h6>
</div>
<!--récuperation le footer de la page.-->
<?php require APP . '/views/template/footer.php';?>
</body>
</html>