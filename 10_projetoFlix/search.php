<?php
   require_once("templates/header.php");

   require_once("dao/MovieDAO.php");

   //dao dos filmes 
   $movieDao = new MovieDAO($conn, $BASE_URL);

   //resgata busca do usuario
   $q = filter_input(INPUT_GET, "q");

   $movies = $movieDao->findByTitle($q);
?>
     
     <div id="main-container" class="container-fluid">
       <h2 class="section-title" id="search-title" >Voce pesquisou por: <span id="search-result"> <?= $q ?></span></h2>
        <p class="section-description">Resultados da busca:</p>
        <div class="movies-container">
         <?php foreach($movies as $movie): ?>
           <?php require("templates/movie_card.php"); ?>
         <?php endforeach; ?>
         <?php if(count($movies) === 0): ?>
          <p class="empty-list">Não há filmes para esta busca, <a class="back-link" href="<?= $BASE_URL ?>">Voltar</a></p>
         <?php endif; ?>
        </div>
     </div>

<?php
   require_once("templates/footer.php");
?>
