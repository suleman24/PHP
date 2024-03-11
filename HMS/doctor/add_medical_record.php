<?php

use LDAP\Result;

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../index.php");
    exit;
} else {
    $username =  $_SESSION['username'];
}

include '../db.php';

$appointment_id = $_GET["appointment_id"];
$doctor_id = $_GET["doctor_id"];
$patient_id = $_GET["patient_id"];
$patient_name = $_GET["patient_name"];
$fee= $_GET["fee"];

if (isset($_POST["submit"])) {
  

    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $notes = $_POST['notes'];
    $date = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO `medical_record` (`patient_id`, `doctor_id`, `date`, `diagnosis`, `treatment`, `notes`,`fee`) 
    VALUES (?, ?, ?, ?, ?, ?,?)");


      $stmt->bind_param("iissssi", $p_id, $d_id, $d, $diag, $treat, $n,$f);

      $p_id = $patient_id;
      $d_id = $doctor_id;
      $d = $date;
      $diag = $diagnosis;
      $treat = $treatment;
      $n = $notes;
      $f=$fee;

      
    $sql = "UPDATE `appointments` SET `status` = 'checked' WHERE `appointment_id` = $appointment_id";
 
    $result = mysqli_query($conn, $sql);

      if ($stmt->execute() && $result) {
        header("Location: dashboard.php?msg=Record Added");
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
                            <h2>Add Medical Record</h2>
                        </center>
                    </th>
                    <th style="width: 25%;"></th>
                </tr>
            </table>

                <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Pateint Name:</label>
                  <input  disabled type="text" class="form-control" name="specialization_name" value="<?php echo $patient_name ?>" >
               </div>
            </div>
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Diagnosis: </label>
                  <textarea  type="text" class="form-control" name="diagnosis"></textarea>
               </div>
            </div>
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Treatment: </label>
                  <textarea  type="text" class="form-control" name="treatment"></textarea>
               </div>
            </div>
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Any Notes: </label>
                  <textarea  type="text" class="form-control" name="notes"></textarea>
               </div>
            </div>
               
          

            <div style="margin-top: 30px; width: 40%">
               <button style="width: 30%;" type="submit" class="btn btn-success" name="submit">Add</button>
               <a href="dashboard.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>

        </section>
    </main>



</body>

</html>