<?php
    if ( !isset( $_SESSION) )
    {
       session_start();
    }
    include_once 'Autoload.class.php';
    require 'UserModel.class.php';

    class UserRegisterController {


    }

    if(!empty($_POST['name']) && !empty($_POST['email']) 
            && !empty($_POST['password']) && !empty($_POST['password_2'])){

        echo "Entrou aqui!!!";

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_2 = $_POST['password_2'];

        $user = new UserModel($name, $email, $password, $password_2);

        $userRegister = $user->userRegister();

        print_r($userRegister);

        if($userRegister == -1){
            $_SESSION['msgLog'] = "Email ja existe!!!";
            header('location:../cadastro.php');
        }else if($userRegister == -2){
            $_SESSION['msgLog'] = "Senhas não conferem!!!";
            header('location:../cadastro.php');
        }else{
            $_SESSION['id'] = $userRegister->cod_user;
            $_SESSION['user'] = $userRegister->name;
            header('location:../filmes.php');
        }

    }

?>