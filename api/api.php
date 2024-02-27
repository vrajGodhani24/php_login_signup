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

        public function insertData($nameData,$age,$contact) {

            $quary = "INSERT INTO student_info(name,age,contact) VALUES('$nameData',$age,'$contact');";

            $result = mysqli_query($this->config->res,$quary);

            return $result;
        }

        public function fetchedAllData() {

            $quary = "SELECT * FROM student_info";

            $result = mysqli_query($this->config->res,$quary);

            $fetchedData = [];

            while($record = mysqli_fetch_array($result)) {

                array_push($fetchedData,$record);

            }
            return $fetchedData;
        }

        public function fetchedSingleData($id) {

            $quary = "SELECT * FROM student_info WHERE id=$id";

            $result = mysqli_query($this->config->res,$quary);

            $fetchedData = mysqli_fetch_array($result);
            
            return $fetchedData;
        }

        public function deleteData($id) {
            $quary = "DELETE FROM student_info WHERE id=$id";

            $result = mysqli_query($this->config->res,$quary);

            return $result;
        }

        public function updateStudentData($name,$age,$contact,$id) {

            $quary = "UPDATE student_info SET name='$name', age=$age, contact='$contact' WHERE id=$id";

            $result = mysqli_query($this->config->res,$quary);

            return $result;
        }
        
    }

?>