<?php
    session_start();
    include('./functions.php');
    $cod_user = $_SESSION['id'];
    $filme = $_SESSION['filme'];

    if(isset($_POST['avaliacao'])){
        $value = $_POST['avaliacao'];
        avaliar($value, $filme->cod_movie, $cod_user);
        header('location: filmes.php');
    }

    if(isset($_POST['voltar'])){
        header('location:filmes.php');
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
                <button class="btn btn-primary me-md-2" type="submit" name='voltar'>Voltar</button>
                <button class="btn btn-primary me-md-2" type="submit" name='sair'>Sair</button>
              </form>
            </div>
        </div>
    </nav>

    <div id="bg">
      <h1 id='txt_1' class="bg_1">Assistindo!</h1>
      <div class="container-fluid d-flex flex-wrap grid">
          <?php
            geraCardFilmeAssistir($filme);
            if(isset($_POST['play'])){
                echo "<h5>Filme assistido com sucesso!</h5><br>";
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