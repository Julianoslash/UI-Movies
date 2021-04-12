<?php
    session_start();
    include('./functions.php');
    $cod_user = $_SESSION['id'];

    $urlFilmes = "https://api-movies-110421.herokuapp.com/api/movies";
    $filmes = json_decode(file_get_contents($urlFilmes));
    
    $urlAvaliacoes = "https://api-movies-110421.herokuapp.com/api/ratings/$cod_user";
    $avaliacoes = json_decode(file_get_contents($urlAvaliacoes));

    foreach($filmes as $value){
      $todosFilmes[] = $value->cod_movie;
    }

    if(isset($avaliacoes)){
      foreach($avaliacoes as $value){
        $vistos[] = $value->cod_movie;
        foreach($filmes as $filme){
          if($value->cod_movie == $filme->cod_movie){
            $filmesVistos[] = array(
              "cod_movie" => $value->cod_movie,
              "title" => $filme->title,
              "date_launch" => $filme->date_launch,
              "info" => $filme->info,
              "image" => $filme->image,
              "cod_rating" => $value->cod_rating,
              "rating" => $value->rating
            );
          }
        }
      }
    }

    for($i = 0; $i < sizeof($todosFilmes); $i++){
      if(isset($vistos)){
        for($j = 0; $j < sizeof($vistos); $j++){
          if($todosFilmes[$i] == $vistos[$j]){
              $todosFilmes[$i] = -1;
          }
        }
      }
    }

    if(isset($_POST['assistir'])){
      $cod_filme = $_POST['assistir'];
      $urlFilme = "https://api-movies-110421.herokuapp.com/api/movies/$cod_filme";
      $filme = json_decode(file_get_contents($urlFilme));

      $_SESSION['filme'] = $filme;
      header('location:assistir.php');
    }

    if(isset($_POST['remover'])){
      $cod = $_POST['remover'];
      deletarAvaliacao($cod);
      atualiza();
    }

    if(isset($_POST['sair'])){
      header('location:index.php');
    }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>API-Filmes Login</title>
  </head>
  <body id="fundo">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="filmes.html"><img id="imageApi" src="./img/api_01.png" alt="..." class="img-thumbnail"></a>
            <h3 id='usuario'><?php echo "Seja bem vindo(a) ".$_SESSION['user']; ?></h3>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <form action="filmes.php" method="post">
                <button class="btn btn-primary me-md-2" type="submit" name='sair'>Sair</button>
              </form>
            </div>
        </div>
    </nav>

    <div id="bg">
      <h1 id='txt_1' class="bg_1">Filmes Assistidos!</h1>
      <div class="container-fluid d-flex flex-wrap grid">
          <?php
            if(isset($filmesVistos)){
              foreach($filmesVistos as $value){
                geraCardFilmes($value);
              }
            }else{
              echo "<h4 class='txt_msg_1'>Não assistiu nenhum filme ainda!!!</h4>";
            }
          ?>
      </div>
    </div>

    <div id="bg">
      <h1 id='txt_1' class="bg_2">Filmes para Assistir!</h1>
      <div class="container-fluid d-flex flex-wrap grid">
          <?php
            $validar = 0;
            for($i = 0; $i < sizeof($todosFilmes); $i++){
              if($todosFilmes[$i] != -1){
                $validar++;
                geraCardFilmesNaoVistos($filmes[$i]);
              }
            }
            if($validar == 0){
              echo "<h4 class='txt_msg_1'>Ja assistiu a todos os filmes!!! em breve adicionaremos mais</h4>";
            }
          ?>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>