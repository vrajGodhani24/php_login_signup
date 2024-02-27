<?php

    class Config{

        private $SERVERNAME = "127.0.0.1";
        private $USERNAME = "root";
        private $PASSWORD = "";
        private $DATABASE = "students";
        public $TABLE_NAME = "student_info";
        public $res;

        public function connect() {
            $this->res = mysqli_connect($this->SERVERNAME,$this->USERNAME,$this->PASSWORD,$this->DATABASE);
        }

        public function insertData($nameData,$age,$contact) {

            $this->connect();

            $quary = "INSERT INTO $this->TABLE_NAME (name,age,contact) VALUES ('$nameData',$age,'$contact');";

            $result = mysqli_query($this->res,$quary);

            return $result;
        }
        
        public function fetchedStudentData()  {
            $this->connect();

            $quary = "SELECT * FROM $this->TABLE_NAME";

            $result = mysqli_query($this->res,$quary);

           return $result;
        }

        public function deleteStudentRecord($id) {
            $this->connect();

            $quary = "DELETE FROM $this->TABLE_NAME WHERE id=$id";

            $result = mysqli_query($this->res,$quary);

            return $result;
        }

        public function fetchedSingleStudentData($id) {
            $this->connect();

            $quary = "SELECT * FROM $this->TABLE_NAME WHERE id=$id";

            $result = mysqli_query($this->res,$quary);

            $record = mysqli_fetch_array($result);

            return $record;
        }

        public function updateStudentData($update_name,$age,$contact,$id) {

            $this->connect();

            $quary = "UPDATE $this->TABLE_NAME SET name='$update_name', age=$age, contact='$contact' WHERE id=$id";

            $result = mysqli_query($this->res,$quary);

            return $result;
        }

    }

?>