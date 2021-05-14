<?php
    if ( !isset( $_SESSION) )
    {
       session_start();
    }
    
    include_once 'Autoload.class.php';

    if(isset($_POST['voltar'])){
        header('location:../filmes.php');
    }

    if(isset($_POST['sair'])){
        header('location:../index.php');
    }
?>