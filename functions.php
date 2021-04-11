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
                    <form method='post' action='filmes.php'>
                        <button name='assistir' type='submit' class='btn btn-outline-primary btn-block' value='$value->cod_movie'>Assistir</button>
                    </form>
                </div>
            </div>
        ";
    }

    function geraCardFilmes($value){

        echo "
            <div class='card' id='cardFilmes'>
            <div class='card-body'>
                <h5 class='card-title'>$value[title]</h5>
                <div class='text-center'>
                <img id='cardImage' src='./image_movies/$value[image]' class='rounded' alt='...'>
                </div>
        ";

        for($i = 1; $i <= 5; $i++){
            if($i <= $value["rating"]){
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
                <p>Lançamento: $value[date_launch]</p>
                <p>Info: $value[info]</p>
                <form method='post' action='filmes.php'>
                
                    <button type='submit' class='btn btn-outline-primary btn-block' name='remover' value='$value[cod_rating]'>Remover da Lista</button>
                </form>
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
                <form method='post' action='assistir.php'>
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

    function avaliar($value, $cod_movie, $cod_user){

        $iniciar = curl_init('http://api-movies-110421.herokuapp.com/api/ratings');
        curl_setopt($iniciar, CURLOPT_CUSTOMREQUEST, "POST");

        $dados = array(
            "coduser" => $cod_user,
            "cod_movie" => $cod_movie,
            "rating" => $value
        );

        $dados = json_encode($dados);

        curl_setopt($iniciar, CURLOPT_POSTFIELDS, $dados);
        curl_setopt($iniciar, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($iniciar, CURLOPT_HTTPHEADER, array(

            'Content-Type: application/json',
        
            'Content-Length: ' . strlen($dados))
        
        );

        curl_exec($iniciar);
        curl_close($iniciar);
    }

    function deletarAvaliacao($cod_rating){

        $iniciar = curl_init('http://api-movies-110421.herokuapp.com/api/ratings');
        curl_setopt($iniciar, CURLOPT_CUSTOMREQUEST, "DELETE");

        $dados = array(
            "cod_rating" => $cod_rating
        );

        $dados = json_encode($dados);

        curl_setopt($iniciar, CURLOPT_POSTFIELDS, $dados);
        curl_setopt($iniciar, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($iniciar, CURLOPT_HTTPHEADER, array(

            'Content-Type: application/json',
        
            'Content-Length: ' . strlen($dados))
        
        );

        curl_exec($iniciar);
        curl_close($iniciar);
        
        header('locaion: filmes.php');
    }

?>