<?php

    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');

    include('api_auth.php');

    $responce_array = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $api = new API();

        $responce = $api->loginUserData($username,$password);

        http_response_code(201);

        if($responce) {
            $responce_array['msg'] = "Login successfully...";
        }
        else {
            $responce_array['msg'] = "Login failed...";
        }

        echo json_encode($responce_array);
    }
    else {
        $responce_array['msg'] = "Only POST method are allowed...";

        echo json_encode($responce_array);
    }
?>