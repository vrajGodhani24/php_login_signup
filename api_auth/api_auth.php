<?php

    include('../config/config.php');

    class API 
    {
        public $config;

        public function __construct()
        {
            $this->config = new Config();

            $this->config->connect();
        }

        public function signupUserData($email,$username,$password) {

            $quary = "INSERT INTO users(email,username,password) VALUES('$email','$username','$password');";

            $result = mysqli_query($this->config->res,$quary);

            return $result;
        }
        
        public function loginUserData($username,$password) {

            $quary = "SELECT * FROM users WHERE username='$username';";
 
            $result = mysqli_query($this->config->res,$quary);

            $record = mysqli_fetch_array($result);

            if($record) {
                $hashed_password = $record['password'];

                $res = password_verify($password, $hashed_password);
                    
                return $res;
    
            } else {
                return false;
            }

            
        }
    }

?>