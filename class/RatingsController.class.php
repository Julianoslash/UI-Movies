<?php
    if ( !isset( $_SESSION) )
    {
       session_start();
    }
    
    include_once 'Autoload.class.php';
    require 'MovieModel.class.php';
    $movieModel = new MovieModel();

    if(isset($_POST['delete'])){
        $cod = $_POST['delete'];
        $movieModel = new MovieModel();
        $movieModel->deleteRating($cod);
        header('location:../filmes.php');
    }

    if(isset($_POST['avaliacao'])){
        $rating = $_POST['avaliacao'];
        $userId = $_SESSION['id'];
        $movie = $_SESSION['filme'];
        $movieModel = new MovieModel();
        $movieModel->putRating($userId, $movie->cod_movie, $rating);
        header('location: ../filmes.php');
    }

?>