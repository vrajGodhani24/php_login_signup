<?php

    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');

    include('category.php');

    $responce_array = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $categoryName = $_POST['cat_name'];
        $categoryImage = $_FILES['cat_image'];

        $filename = $categoryImage['name'];
        $tmp_file = $categoryImage['tmp_name'];

        $path = "uploads/" . $filename;

        if(move_uploaded_file($tmp_file,$path)) {

            $category = new Category();

            $responce = $category->addCategory($categoryName,$filename);

            http_response_code(201);

            if($responce) {
                $responce_array['msg'] = "Category added successfully...";
            }
            else {
                $responce_array['msg'] = "Category insrtion failed...";
            }

            echo json_encode($responce_array);
        }
    }
    else {
        $responce_array['msg'] = "Only POST method are allowed...";

        echo json_encode($responce_array);
    }
?>