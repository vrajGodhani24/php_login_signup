<?php

    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');

    include('api.php');

    $responce_array = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = $_POST['name'];
        $age = $_POST['age'];
        $contact = $_POST['contact'];

        $api = new API();
        
        $responce = $api->insertData($name,$age,$contact);

        http_response_code(201);

        if($responce) {
            $responce_array['msg'] = "Record inserted successfully...";
        }
        else {
            $responce_array['msg'] = "Record insertion failed...";
        }

        echo json_encode($responce_array);
    }
    else {
        $responce_array['msg'] = "Only POST method are allowed...";

        echo json_encode($responce_array);
    }
?>