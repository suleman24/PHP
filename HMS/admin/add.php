<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../index.php");
    exit;
} else {
    $username =  $_SESSION['username'];
}

include '../db.php';

if (isset($_POST["submit"])) {
    $name = $_POST['specialization_name'];
   
 
    $sql = "INSERT INTO `specialization`(`name`) VALUES ('$name')";
 
    $result = mysqli_query($conn, $sql);
 
    if ($result) {
       header("Location: specializations.php?msg=New record created successfully");
    } else {
       echo "Failed: " . mysqli_error($conn);
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

    <title>Doctors | Specializations </title>


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
                            <h2>Add Specialization</h2>
                        </center>
                    </th>
                    <th style="width: 25%;"></th>
                </tr>
            </table>

                <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Specialization Name:</label>
                  <input type="text" class="form-control" name="specialization_name">
               </div>

               
          

            <div style="margin-top: 30px; width: 40%">
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="specializations.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>






        </section>
    </main>



</body>

</html>