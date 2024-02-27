<?php
            include 'config/config.php';

            $config = new Config();

            $students_data = $config->fetchedStudentData();

            $btn_submit = @$_POST['submit'];

            $inserted = null;

            if(isset($btn_submit)) {

                $name = $_POST['name'];
                $age = $_POST['age'];
                $contact = $_POST['contact'];

                $res = $config->insertData($name,$age,$contact);

                if($res) {
                    $inserted = true;
                } else {
                    $inserted = false;
                }
            }

            $delete_id = @$_REQUEST['dlt_id'];
            $result = null;

            if(isset($delete_id)) {

                $result = $config->deleteStudentRecord($delete_id);

            }

            $update_id = @$_REQUEST['update_id'];
            $update_submit = @$_REQUEST['update'];
            $single_record = null;
            $responce = null;

            if(isset($update_id)) {
                $single_record = $config->fetchedSingleStudentData($update_id);
            }
             
            if(isset($update_submit)) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $age = $_POST['age'];
                $contact = $_POST['contact'];

                $responce = $config->updateStudentData($name,$age,$contact,$id);
            }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">   
            
            <?php 
                if($inserted == null) {
                }
                else if($inserted) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success!</strong> Student Record Inserted Successfully...
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
                else {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Failed!</strong> Student Record Inserted Failed...
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
                }
            ?>

            <?php 
                if($result == null) {
                }
                else if($result == 1) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Delete!</strong> Student Record Deleted Successfully...
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
                else {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Failed!</strong> Student Record Deleted Failed...
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
                }
            ?>

            <?php 
                if($responce == null) {
                }
                else if($responce == 1) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Update!</strong> Student Record Update Successfully...
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
                else {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Failed!</strong> Student Record Update Failed...
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
                }
            ?>
    
        <div class="col col-6"> 
            <form action="index.php" method="POST">
                <input class="form-control" name="id" type="hidden" value="<?php if(isset($update_id)) {echo $single_record['id'];}?>"> <br>
                Name <input class="form-control" name="name" type="text" value="<?php if(isset($update_id)) {echo $single_record['name'];}?>"> <br>
                Age <input class="form-control" name="age" type="number" value="<?php if(isset($update_id)) {echo $single_record['age'];}?>" > <br>
                Contact <input class="form-control" name="contact" type="text" value="<?php if(isset($update_id)) {echo $single_record['contact'];}?>"> <br>
                <button class="<?php if(isset($update_id)) {echo "btn btn-warning";} else {echo "btn btn-primary";}?>" name="<?php if(isset($update_id)) {echo "update";} else {echo "submit";}?>"><?php if(isset($update_id)) {echo "Update";} else {echo "Submit";}?></button>
            </form>
           
        <br><br><br>

        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Contact</th>
                        <th colspan="2" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while($record = mysqli_fetch_array($students_data)) { ?>

                    <tr>
                        <th scope="row"> <?php echo $record['id'] ?> </th>
                        <td><?php echo $record['name'] ?></td>
                        <td><?php echo $record['age'] ?></td>
                        <td><?php echo $record['contact'] ?></td>
                        <td>
                            <a href="index.php?dlt_id=<?php echo $record['id'] ?>">
                                <Button class="btn btn-danger" type="submit">Delete</Button>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?update_id=<?php echo $record['id'] ?>">
                                <Button class="btn btn-primary" type="submit">Edit</Button>
                            </a>
                        </td>
    
                    </tr>

                    <?php } ?>

                </tbody>
            </table>
            </div>
         </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
