<?php
  if ( !isset( $_SESSION) )
  {
    session_start();
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
  <script src="main.js"></script>
  <body id="fundoLogin">
    <nav is="navLogin" class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
          <a class="navbar-brand" href="#"><img id="imageApi" src="./img/api_01.png" alt="..." class="img-thumbnail"></a>
      </div>
    </nav>
    <div class="card" id="cardLogin">
        <div class="card-body">
            <h5 class="card-title">Faça seu Cadastro</h5>
            <?php
              if(isset($_SESSION['msgLog'])){
                echo "<p id='msgLog'>".$_SESSION['msgLog']."</p>";
                unset($_SESSION['msgLog']);
              }
            ?>
            <form action="class/UserRegisterController.class.php" method="post">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="name" aria-describedby="" placeholder="Digite seu nome" required="required">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Digite seu email" required="required">
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" class="form-control" name="password" placeholder="Digite sua senha" required="required">
            </div>
            <div class="mb-3">
                <label class="form-label">Repetir Senha</label>
                <input type="password" class="form-control" name="password_2" placeholder="Digite sua senha novamente" required="required">
            </div>
            <button type="submit" class="btn btn-outline-primary btn-block">Cadastrar</button>
            <a class="cadastrar" href="index.php">ou login</a>
            </form>
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