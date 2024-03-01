<?php

    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');

    include('category.php');

    $responce_array = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $id = $_POST['cat_id'];
        $category = new Category();

        $fetchedRecord = $category->fetchSingleRecord($id);

        $categoryImage = $fetchedRecord['cat_image'];

        $path = "uploads/" . $categoryImage;

        if(unlink($path)) {
            $responce = $category->deleteCategory($id);

            if($responce) {
                $responce_array['msg'] = "Category delete successfully...";
            }
            else {
                $responce_array['msg'] = "Category deletation failed...";
            }

            echo json_encode($responce_array);
        }
    }
    else {
        $responce_array['msg'] = "Only POST method are allowed...";

        echo json_encode($responce_array);
    }
?>