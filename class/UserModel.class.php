<?php
    class UserModel{
        private $userId;
        private $userName;
        private $userEmail;
        private $userPassword;
        private $userPassword_2;
        private $con;

        public function __construct($name = null,  $email = null, $password = null, $password_2 = null){
            $this->userName = $name;
            $this->userEmail = $email;
            $this->userPassword = $password;
            $this->userPassword_2 = $password_2;
            $this->con = "https://api-movies-110421.herokuapp.com/api/users";
        }

        public function setUserName($userName){
            $this->userName = $userName;
        }

        public function setUserEmail($userEmail){
            $this->userEmail = $userEmail;
        }

        public function setUserPassword($userPassword){
            $this->userPassword = $userPassword;
        }

        public function setCon($url){
            $this->con = $url;
        }

        public function getId(){
            return $this->userId;
        }

        public function getName(){
            return $this->userName;
        }

        public function getEmail(){
            return $this->userEmail;
        }

        public function getPassword(){
            return $this->userPassword;
        }

        public function doLogin($email, $password){
            $url = $this->con."/".$email;

            if(!empty(@file_get_contents($url))){
                $user = json_decode(file_get_contents($url));
                if($user->password == $password){
                    return $user;
                }else{
                    return -2;
                }
            }
            return -1;
        }

        public function userRegister(){
            //$url = $this->userEmail;
            $chekEmail = $this->doLogin($this->userEmail, null);

            if($chekEmail == -1){
                if($this->userPassword == $this->userPassword_2){
                    $init = curl_init($this->con);
                    curl_setopt($init, CURLOPT_CUSTOMREQUEST, "POST");
            
                    $strUser = array(
                        "name" => $this->userName,
                        "email" => $this->userEmail,
                        "password" => $this->userPassword
                    );
            
                    $strUser = json_encode($strUser);
            
                    curl_setopt($init, CURLOPT_POSTFIELDS, $strUser);
                    curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
            
                    curl_setopt($init, CURLOPT_HTTPHEADER, array(
            
                        'Content-Type: application/json',
                    
                        'Content-Length: ' . strlen($strUser))
                    
                    );
            
                    curl_exec($init);
                    curl_close($init);

                    $returnUser = $this->doLogin($this->userEmail, $this->userPassword);

                    return $returnUser;
                }else{
                    return -2;
                }
            }else{
                return -1;
            }
        }

    }
?>