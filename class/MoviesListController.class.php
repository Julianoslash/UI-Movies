<?php
    if ( !isset( $_SESSION) )
    {
       session_start();
    }
    
    include_once 'Autoload.class.php';
    require 'MoviesListModel.class.php';

    class MoviesListController{
        private $userId;

        function __construct($userId = null){
            $this->userId = $userId;
        }

        function moviesWatched(){
            $movies = new MoviesListModel();
    
            $movies->moviesListByUsers($this->userId);
            return $movies->getWatchedMovies();
        }
    
        function moviesToWatch(){
            $movies = new MoviesListModel();
    
            $movies->moviesListByUsers($this->userId);
            return $movies->getMoviesToWatch();
        }
        
    }

    if(isset($_POST['assistir'])){
        $codMovie = $_POST['assistir'];
        $movies = new MoviesListModel();
        $getMovie = $movies->getMovieById($codMovie);
        $_SESSION['filme'] = $getMovie;
        header('location:../assistir.php');
    }

    /* 
    $userId = $_SESSION['id'];
    $movies = new MoviesModel();
    
    echo json_encode($movies->returnMoviesList());
    echo json_encode($movies->returnRatingsList($userId));
    $movies->moviesListByUsers($userId);
    echo json_encode($movies->getWatchedMovies());
    echo json_encode($movies->getMoviesToWatch());
    */

?>