<?php
    class MoviesListModel{
        private $conMovies;
        private $conRatings;
        private $watchedMovies;
        private $moviesToWatch;

        public function __construct(){
            $this->conMovies = "https://api-movies-110421.herokuapp.com/api/movies";
            $this->conRatings = "https://api-movies-110421.herokuapp.com/api/ratings/";
            $this->moviesToWatch = null;
            $this->watchedMovies = null;
        }

        function getWatchedMovies(){
            return $this->watchedMovies;
        }

        function getMoviesToWatch(){
            return $this->moviesToWatch;
        }

        function returnMoviesList(){
            $moviesList = json_decode(file_get_contents($this->conMovies));
            return $moviesList;
        }

        function returnRatingsList($userId){
            $url = $this->conRatings."".$userId;
            $ratingsList = json_decode(file_get_contents($url));

            return $ratingsList;

        }

        function moviesListByUsers($userId){
            $moviesList = $this->returnMoviesList();
            $ratingsList = $this->returnRatingsList($userId);

            foreach($moviesList as $movie){
                $var = 0;
                foreach($ratingsList as $rating){
                    if($movie->cod_movie == $rating->cod_movie){
                        $arrayMovie = get_object_vars($movie);
                        $arrayMovie["rating"] = $rating->rating;
                        $arrayMovie["cod_rating"] = $rating->cod_rating;

                        $this->watchedMovies[] = $arrayMovie;
                        $var = 1;
                        break;
                    }
                }
                if($var == 0){
                    $this->moviesToWatch[] = $movie;
                }
            }
        }

        function getMovieById($movieId){
            $url = $this->conMovies."/".$movieId;
            $movie = json_decode(file_get_contents($url));

            return $movie;
        }
    }

?>