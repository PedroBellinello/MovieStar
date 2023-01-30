<?php
   require_once("templates/header.php");

   require_once("dao/MovieDAO.php");

   //dao dos filmes 
   $movieDao = new MovieDAO($conn, $BASE_URL);

   $latestMovies = $movieDao->getLatestMovies();

   $actionMovies = $movieDao->getMoviesByCategory("Ação");

   $comedyMovies = $movieDao->getMoviesByCategory("comédia");

   $fantasyMovies = $movieDao->getMoviesByCategory("Fantasia / Ficção");

   $terrorMovies = $movieDao->getMoviesByCategory("Terror");



?>
     
     <div id="main-container" class="container-fluid">
       <h2 class="section-title">Novos filmes:</h2>
        <p class="section-description">Veja as crititas dos útilmos filmes adicionados</p>
        <div class="movies-container">
         <?php foreach($latestMovies as $movie): ?>
           <?php require("templates/movie_card.php"); ?>
         <?php endforeach; ?>
         <?php if(count($latestMovies) === 0): ?>
          <p class="empty-list">Ainda não há filmes cadastrados</p>
         <?php endif; ?>
        </div>
        <h2 class="section-title">Ação:</h2>
        <p class="section-description">Veja os melhores filmes de ação</p>
        <div class="movies-container">
           <?php foreach($actionMovies as $movie): ?>
              <?php require("templates/movie_card.php"); ?>
            <?php endforeach; ?>
              <?php if(count($actionMovies) === 0): ?>
               <p class="empty-list">Ainda não há filmes de ação cadastrados</p>
              <?php endif; ?>
        </div>
        <h2 class="section-title">Comédia:</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container">
            <?php foreach($comedyMovies as $movie): ?>
               <?php require("templates/movie_card.php"); ?>
             <?php endforeach; ?>
              <?php if(count($comedyMovies) === 0): ?>
               <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
              <?php endif; ?>
        </div>
        <!--extra-->
        <h2 class="section-title">Ficção / Fantasia:</h2>
        <p class="section-description">Veja os melhores filmes de Ficção / Fantasia</p>
        <div class="movies-container">
            <?php foreach($fantasyMovies as $movie): ?>
               <?php require("templates/movie_card.php"); ?>
             <?php endforeach; ?>    
               <?php if(count($fantasyMovies) === 0): ?>
                <p class="empty-list">Ainda não há filmes de Ficção / Fantasia cadastrados</p>
               <?php endif; ?>
         </div>
         <h2 class="section-title">Terror:</h2>
        <p class="section-description">Veja os melhores filmes de Ficção / Fantasia</p>
        <div class="movies-container">
            <?php foreach($terrorMovies as $movie): ?>
               <?php require("templates/movie_card.php"); ?>
             <?php endforeach; ?>    
               <?php if(count($terrorMovies) === 0): ?>
                <p class="empty-list">Ainda não há filmes de terror cadastrados</p>
               <?php endif; ?>
         </div>
     </div>

<?php
   require_once("templates/footer.php");
?>
