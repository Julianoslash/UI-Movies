<?php
    if ( !isset( $_SESSION) )
    {
       session_start();
    }
    include_once 'Autoload.class.php';
    require 'UserModel.class.php';

    class UserLoginController {


    }

    if(!empty($_POST['login']) && !empty($_POST['password'])){
        $email = $_POST['login'];
        $password = $_POST['password'];
        $user = new UserModel();

        $userLoged = $user->doLogin($email, $password);

        if($userLoged == -1){
            $_SESSION['msgLog'] = "Email não cadastrado!!!";
            header('location: ../index.php');
        }else if($userLoged == -2){
            $_SESSION['msgLog'] = "Senha errada!!!!";
            header('location: ../index.php');
        }else{
            $_SESSION['id'] = $userLoged->cod_user;
            $_SESSION['user'] = $userLoged->name;
            header('location: ../filmes.php');
        }
    }

?>