<?php
    class MovieModel{
        private $movieId;
        private $title;
        private $dateLaunch;
        private $image;
        private $info;
        private $userId;
        private $ratingId;
        private $rating;
        private $con;

        public function __construct($movieId = null, $title = null, $dateLaunch = null, $info =null, 
                $image = null, $userId = null, $ratingId = null, $rating = null){
            $this->movieId = $movieId;
            $this->title = $title;
            $this->dateLaunch = $dateLaunch;
            $this->info = $info;
            $this->image = $image;
            $this->userId = $userId;
            $this->ratingId = $ratingId;
            $this->rating = $rating;
            $this->con = "http://api-movies-110421.herokuapp.com/api/ratings";
        }

        function getMovieId(){
            return $this->movieId;
        }

        function getTitle(){
            return $this->title;
        }

        function getDateLaunch(){
            return $this->dateLaunch;
        }

        function getInfo(){
            return $this->info;
        }

        function getImage(){
            return $this->image;
        }

        function getUserId(){
            return $this->userId;
        }

        function getRatingId(){
            return $this->ratingId;
        }

        function getRating(){
            return $this->rating;
        }

        function putRating($userId, $movieId, $rating){
            $init = curl_init($this->con);
            curl_setopt($init, CURLOPT_CUSTOMREQUEST, "POST");

            $data = array(
                "coduser" => $userId,
                "cod_movie" => $movieId,
                "rating" => $rating
            );

            $data = json_encode($data);

            curl_setopt($init, CURLOPT_POSTFIELDS, $data);
            curl_setopt($init, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($init, CURLOPT_HTTPHEADER, array(

                'Content-Type: application/json',
            
                'Content-Length: ' . strlen($data))
            
            );

            curl_exec($init);
            curl_close($init);
        }

        function deleteRating($codRating){
            $init = curl_init($this->con);
            curl_setopt($init, CURLOPT_CUSTOMREQUEST, "DELETE");

            $data = array(
                "cod_rating" => $codRating
            );

            $data = json_encode($data);

            curl_setopt($init, CURLOPT_POSTFIELDS, $data);
            curl_setopt($init, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($init, CURLOPT_HTTPHEADER, array(

                'Content-Type: application/json',
            
                'Content-Length: ' . strlen($data))
            );

            curl_exec($init);
            curl_close($init);
        }
    }

?>