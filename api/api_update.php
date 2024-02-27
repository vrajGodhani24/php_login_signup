<?php

    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');

    include('api.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'PATCH') {

        $api = new API();

        parse_str(file_get_contents('php://input'),$_PATCH);

        $name = $_PATCH['name'];
        $age = $_PATCH['age'];
        $contact = $_PATCH['contact'];
        $id = $_PATCH['id'];
        
        $responce = $api->updateStudentData($name,$age,$contact,$id);

        if($responce) {
            $responce_array['msg'] = "Record Update Successfully...";
        }
        else {
            $responce_array['data'] = "Record Updation Failed...";
        }

        echo json_encode($responce_array);
    }
    else {
        $responce_array['msg'] = "Only PUT or PATCH methods are allowed...";

        echo json_encode($responce_array);
    }
?>