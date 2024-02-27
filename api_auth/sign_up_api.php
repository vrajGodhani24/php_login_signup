<?php

    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');

    include('api_auth.php');

    $responce_array = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $api = new API();

        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        
        $responce = $api->signupUserData($email,$username,$hashed_password);

        http_response_code(201);

        if($responce) {
            $responce_array['msg'] = "User inserted successfully...";
        }
        else {
            $responce_array['msg'] = "User insertion failed...";
        }

        echo json_encode($responce_array);
    }
    else {
        $responce_array['msg'] = "Only POST method are allowed...";

        echo json_encode($responce_array);
    }
?>