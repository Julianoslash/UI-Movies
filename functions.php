<?php

    function geraCardFilmesNaoVistos($value){
        echo "
            <div class='card' id='cardFilmes'>
                <div class='card-body'>
                    <h5 class='card-title'>$value->title</h5>
                    <div class='text-center'>
                        <img id='cardImage' src='./image_movies/$value->image' class='rounded' alt='...'>
                    </div>
                    <p>Lançamento: $value->date_launch</p>
                    <p>Info: $value->info</p>
                    <form method='post' action='./class/MoviesListController.class.php'>
                        <button name='assistir' type='submit' class='btn btn-outline-primary btn-block' value='$value->cod_movie'>Assistir</button>
                    </form>
                </div>
            </div>
        ";
    }

    function geraCardFilmes($value){
        $title = $value['title'];
        $image = $value['image'];
        $dateLaunch = $value['date_launch'];
        $info = $value['info'];
        $codRating = $value['cod_rating'];
        $rating = $value['rating'];

        echo "
            <div class='card' id='cardFilmes'>
            <div class='card-body'>
                <h5 class='card-title'>$title</h5>
                <div class='text-center'>
                <img id='cardImage' src='./image_movies/$image' class='rounded' alt='...'>
                </div>
        ";

        for($i = 1; $i <= 5; $i++){
            if($i <= $rating){
                echo"
                    <img id='cardImageAva' src='./img/estrela_02.png' class='rounded' alt='...'>
                ";
            }else{
                echo" 
                    <img id='cardImageAva' src='./img/estrela_01.png' class='rounded' alt='...'>
                ";
            }
        }

        echo"
                <p>Lançamento: $dateLaunch</p>
                <p>Info: $info</p>
                <div class='btn_cardview'>
                <form method='post' action='./class/RatingsController.class.php'>
                
                    <button type='submit' class='btn btn-outline-primary btn-block' name='delete' value='$codRating'>Remover da Lista</button>
                </form>
                </div>
            </div>
            </div>
        ";
    }

    function geraCardFilmeAssistir($value){
        
        echo "
            <div class='card' id='cardFilmes'>
            <div class='card-body'>
                <h5 class='card-title'>$value->title</h5>
                <div class='text-center'>
                <img id='cardImage' src='./image_movies/$value->image' class='rounded' alt='...'>
                </div>
        ";

        echo "<div class='d-grid gap-2 d-md-flex justify-content-md-init '>";
        for($i = 1; $i <= 5; $i++){
            echo"
                <form method='post' action='./class/RatingsController.class.php'>
                    <button class='btn btn-primary me-md-2 ava_btn' name='avaliacao' value='$i'>
                        <img class='cardAvaAssistir' src='./img/estrela_01.png' class='rounded' alt='...'>
                    </button>
                </form>
            ";
        }
        echo "</div>";

        echo"
                <p>Lançamento: $value->date_launch</p>
                <p>Info: $value->info</p>
                <form method='post' action='assistir.php'>
                
                <button type='submit' class='btn btn-outline-primary btn-block' name='play'>Play</button>
                </form>
            </div>
            </div>
        ";
    }

?>