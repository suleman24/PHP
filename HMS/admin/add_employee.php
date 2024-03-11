<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../index.php");
    exit;
} else {
    $username =  $_SESSION['username'];
}

include '../db.php';

$empty = false;
$validate_fname = false;
$validate_position = false;
$validate_number= false;



if (isset($_POST["submit"])) {
    $fname = $_POST["fname"];
$lname = $_POST["lname"];
$number = $_POST["number"];
$date = $_POST["date"];
$position = $_POST["position"];
$errors = 0;

echo $number;

    if (empty($fname) or empty($position)) {
        $empty = true;
        $errors = $errors + 1;
    }
    if (strlen($fname) < 3) {
        $validate_fname = true;
        $errors = $errors + 1;
    }
    if (strlen($position) < 3) {
        $validate_position = true;
        $errors = $errors + 1;
    }
    if (strlen($number) > 11) {
        $validate_number= true;
        $errors = $errors + 1;
    }

    if($errors==0)
    {
        $sql = "INSERT INTO `employee` (`fname`, `lname`, `number`, `hire_date`, `position`) VALUES ('$fname', '$lname', '$number', '$date', '$position')";
 
        $result = mysqli_query($conn, $sql);
     
        if ($result) {
           header("Location: employee.php?msg=New record created successfully");
        } else {
           echo "Failed: " . mysqli_error($conn);
        }
    }

   
 

 }
 
 ?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Add Employee</title>


</head>

<body>


    <?php

    include 'include/sidebar.php';

    ?>


    <main>
        <section>

            <table style="width: 100%;">
                <tr>
                    <th style="width: 25%;"></th>
                    <th style="width: 50%;">
                        <center>
                            <h2>Add Employee</h2>
                        </center>
                    </th>
                    <th style="width: 25%;"></th>
                </tr>
            </table>

                <div class="container d-flex justify-content-center">
         <form action="add_employee.php" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div>
                  <label class="form-label">First Name:</label>
                  <input type="text" class="form-control" name="fname">
                  <?php
                    if ($validate_fname == true)
                        echo '<div class="alert alert-warning" role="alert">First name is necessary and should have atleast 3 characters</div>';
                    ?>
               </div>
               <div>
                  <label class="form-label">Last Name:</label>
                  <input type="text" class="form-control" name="lname">
               </div>
               <div>
                  <label class="form-label">Position:</label>
                  <input type="text" class="form-control" name="position">
                  <?php
                    if ($validate_position == true)
                        echo '<div class="alert alert-warning" role="alert">Position is necessary and should have atleast 3 characters</div>';
                    ?>
               </div>
               <div >
                  <label class="form-label">Phone Number:</label>
                  <input type="number" class="form-control" name="number">
                  <?php
                    if ($validate_number == true)
                        echo '<div class="alert alert-warning" role="alert">Phone number should have 11 digits</div>';
                    ?>
               </div>
               <div >
               <label class="form-label">Hire Date:</label>
                        <input  type="date" name="date" id="date" class="form-control">
                    </div>
               
               

               
          

            <div style="margin-top: 30px; width: 40%">
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="employee.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>






        </section>
    </main>



</body>

</html>