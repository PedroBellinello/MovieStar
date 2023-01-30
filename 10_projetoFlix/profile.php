<?php
   require_once("templates/header.php");

   // verifica se o usuario  esta logado
   require_once("models/User.php");
   require_once("dao/UserDAO.php");
   require_once("dao/MovieDAO.php");

   $user = new User();
   $userDao = new UserDAO($conn, $BASE_URL);
   $movieDao = new MovieDAO($conn, $BASE_URL);


   //receber id do usuario
   $id = filter_input(INPUT_GET, "id");

   if(empty($id)) {
   
    if(!empty($userData)) {

        $id = $userData->id;
  
      } else {
  
        $message->setMessage("Usuário não encontrado!", "error", "index.php");
  
      }

   } else {

    $userData = $userDao->findById($id);

    //se não encontrar usuario
    if(!$userData) {
       $message->setMessage("Usuário não encontrado", "error", "index.php");
    }

   }

   //pegar filmes do usuario 
   $userMovies = $movieDao->getMoviesByUserId($id);

  // receber nome e imagem do usuario
   $fullName = $user->getFullName($userData);

   if($userData->image == "") {
     $userData->image = "user.png";
   }
 

?> 



<div id="main-container" class="container-fluid">
  <div class="col-md-8 offset-md-2">
    <div class="row profile-container">
        <div class="col-md-12 about-container">
            <h1 class="page-title"><?= $fullName ?></h1>
            <div id="profile-image-container" class="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
            <h3 class="about-title">Sobre:</h3>
            <?php if(!empty($userData->bio)) : ?>
            <p class="profile-description"><?= $userData->bio ?></p>
            <?php else : ?>
            <p class="profile-description">Usuário ainda não escreveu nada aqui...</p>
            <?php endif;  ?>    
        </div>
        <div class="col-md-12 added-movies-container">
            <h3>Filmes que o usuário adicionou</h3>
            <div class="movies-container">
               <?php foreach($userMovies as $movie) : ?>
                <?php require("templates/movie_card.php"); ?>
               <?php endforeach; ?>
               <?php if(count($userMovies) === 0): ?>
                <p class="emptylist">O usuário ainda não cadastrou nenhum filme</p>  
               <?php endif; ?>
            </div>
        </div>
    </div>
  </div>

</div>

<?php
   require_once("templates/footer.php");
?>