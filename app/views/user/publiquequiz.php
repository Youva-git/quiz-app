<?php  
require APP . '/views/template/header.php'; ?>
</head>
<body>
<?php require APP . '/views/template/navbar.php'; ?>

<div class="container ">

  <h2 class="text-center mb-10"> <?php  echo 'Listes Des Quiz Publique'.'</n>'; ?></h2>
<?php  if(!empty($rowsQuiz)){ 
  ?>
  <table id="table_users" class=" text-center table  table-hover">
    <thead>
        <tr>              
            <th> title</th>
            <th> description</th>
            
        </tr>
    </thead>
    <tbody>
           
     <?php
       foreach ($rowsQuiz as $value) {?>   
      <tr > 
          <td>
            <?php echo $value->title;?>
          </td>
          <td>
            <?php echo $value->description;?>
          </td>
          <td>
            <form action="<?php echo Router::url('start/startGame');?>" method="post">
                <input  name="id" type="hidden" value="<?php echo $value->id ?>"/>
                <button type="submit">commencer</button>
            </form>
              
          </td>
      </tr>
     <?php }?>
      
    </tbody>
  </table>
 <?php  }else{
    ?>
  <h2 class="text-center mb-10"> <?php   echo 'Aucun quiz'.'</n>'; ?></h2>
  <div class="row">
    <div class="col-12 text-center">
      <a class="text-center mb-10" href="<?php echo Router::url('page/signup');?>">Inscrivez-vous !</a> et créer vos quiz.
    </div>
  </div>
  <?php }?>

</div>

<?php 
require APP . '/views/template/footer.php';?>
</body>
</html>