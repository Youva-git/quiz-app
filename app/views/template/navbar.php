<!--navbar de site -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">

      <a class="navbar-brand" href="<?php echo Router::url('page/home'); ?>"><?php echo NAME_SITE; ?>
          <!--icon -->
         <i style='font-size:24px' class='fas'>&#xf036;</i>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">

        <?php if(isset($_SESSION['user_id'])) :?>
          <?php if(isset($_SESSION['user_admin']) && ($_SESSION['user_admin'] == 0)) :?>
<!---
             <li class="nav-item">
              <a class="nav-link" href="<?php echo Router::url('quiz/listQuiz'); ?>">Mes Quiz</a>
            </li>
-->
           <li class="nav-item">
              <a class="nav-link" href="<?php echo Router::url('quiz/addquiz'); ?>" data-toggle="modal" data-target="#myModal-add-quiz">Ajouter Quiz</a>
            </li>

          <?php endif; ?>
            
         <?php else : ?>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo Router::url('quiz/publicquiz'); ?>">Quiz Publique</a>
          </li>

          <?php endif; ?>

          </ul>
        <ul class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_id'])) :?>
              <li class="nav-item dropdown ">
              <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo ucfirst ( $_SESSION['user_username']);?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item " href="<?php echo Router::url('users/logoutUser'); ?>">Déconnecter</a>
              </div>
            </li>
      
          <?php else : ?>
            
            <li class="nav-item">
              <a class="nav-link" href="<?php echo Router::url('page/signup'); ?>">Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo Router::url('page/login'); ?>">Connexion</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  

