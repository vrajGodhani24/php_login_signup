<?php

    include('../config/config.php');

    class Category 
    {
        public $config;

        public function __construct()
        {
            $this->config = new Config();

            $this->config->connect();
        }

        public function addCategory($categoryName,$categoryImage) {

            $quary = "INSERT INTO category(cat_name,cat_image) VALUES('$categoryName','$categoryImage');";

            $result = mysqli_query($this->config->res,$quary);

            return $result;
        }

        public function deleteCategory($id) {

            $quary = "DELETE FROM category WHERE cat_id=$id";

            $result = mysqli_query($this->config->res,$quary);

            return $result;
        }

        public function fetchSingleRecord($id) {
            $quary = "SELECT * FROM category WHERE cat_id=$id";

            $result = mysqli_query($this->config->res,$quary);

            $record = mysqli_fetch_array($result);

            return $record;
        }
    }

?>