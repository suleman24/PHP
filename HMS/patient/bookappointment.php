<?php
session_start();

include '../db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../index.php");
    exit;
} else {
    $username =  $_SESSION['username'];
}

$errors = 0;
$validate_specialization = false;
$validate_doctor = false;
$validate_date = false;
$validate_time = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor = $_POST['doctor'];

    if ($_POST['specialization'] == 'Select Option') {
        $errors = $errors + 1;
        $validate_specialization = true;
    }
    if ($_POST['doctor'] == 'Select Option') {
        $errors = $errors + 1;
        $validate_doctor = true;
    }
    if (empty($_POST['date'])) {
        $errors = $errors + 1;
        $validate_date = true;
    }
   if (empty($_POST['time'])) {
        $errors = $errors + 1;
        $validate_time = true;
    }
    else{
        $errors = 0;
    }

    if ($errors == 0) {
        $date = $_POST['date'];
        $time = $_POST['time'];
        $doctor_id = $_POST['doctor'];


        $sql = "SELECT id FROM patient WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($patient_id);
        $stmt->fetch();
        $stmt->close();

            $sql = "SELECT fee FROM doctor WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $doctor_id);
            $stmt->execute();
            $stmt->bind_result($fee);
            $stmt->fetch();
            $stmt->close();
            

            $sql = "INSERT INTO appointments (doctor_id, patient_id, appointment_date, appointment_time, status,fee,fee_status) VALUES (?, ?, ?, ?, ?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisssis", $doctor_id, $patient_id, $date, $time, $status, $fee, $fee_status);
            $status = 'request';
            $fee_status = 'unpaid';
            $stmt->execute();

            header("location: dashboard.php");

            $stmt->close();
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Book Appointment</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>


    <?php

    include 'include/sidebar.php';
    include '../db.php';

    ?>


    <main>
        <section>

            <table style="width: 100%;">
                <tr>
                    <th style="width: 25%;"></th>
                    <th style="width: 50%;">
                        <center>
                            <h2>Book an Appointment</h2>
                        </center>
                    </th>
                    <th style="width: 25%;"></th>
                </tr>


            </table>
            <hr>

            <div class="container mt-4 text-center">
                <form action="bookappointment.php" method="post">
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <h6>Doctor specialization</h6>
                            <select class="form-select" name="specialization" id="specialization">
                                <option>Select Option</option>
                                <?php
                                $sql = "SELECT * FROM specialization";
                                $result = mysqli_query($conn, $sql);
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?php echo $i ?>"><?php echo $row['name'] ?></option>
                                <?php } ?>
                            </select>

                            <?php
                            if ($validate_specialization == true)
                                echo '<div class="alert alert-warning" role="alert">Select Specialization </div>';
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <h6>Doctor</h6>
                            <select class="form-select" name="doctor" id="doctor">
                                <option>Select Option</option>
                            </select>
                            <?php
                            if ($validate_doctor == true)
                                echo '<div class="alert alert-warning" role="alert">Select Doctor </div>';
                            ?>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <label style="margin-top: 15%;" for="date">Date:</label>
                            <input type="date" id="date" name="date" class="form-control"><br><br>
                            <?php
                            if ($validate_date == true)
                                echo '<div class="alert alert-warning" role="alert">Select Date </div>';
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <label style="margin-top: 15%;" for="time">Time:</label>
                            <input type="time" id="time" name="time" class="form-control"><br><br>
                            <?php
                            if ($validate_time == true)
                                echo '<div class="alert alert-warning" role="alert">Select time </div>';
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <div style="margin-top: 5%;" id="fees" class="button">Check fee</div>
                            <select style="margin-top: 5%;" class="form-select" name="fee" id="fee">
                                <option>Fee</option>
                            </select>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px; width: 10%">Book</button>
                </form>
            </div>




            <script>
                $(document).ready(function() {
                        $('#specialization').change(function() {
                            var specialization = $(this).find("option:selected").text();
                            console.log(specialization);

                            $.ajax({
                                type: 'POST',
                                url: 'include/fetch.php',
                                data: {
                                    specialization: specialization
                                },
                                success: function(data) {
                                    console.log(data);
                                    $('#doctor').html(data);

                                }
                            });
                        });


                        $('#fees').click(function() {
                            var doctor = $('#doctor').find("option:selected").val();

                            console.log(doctor);

                            $.ajax({
                                type: 'POST',
                                url: 'include/fetch_fee.php',
                                data: {
                                    doctor: doctor 
                                },
                                success: function(data) {
                                    console.log(data);
                                    $('#fee').html(data);
                                }
                            });
                        });
                    }

                );
            </script>



        </section>
    </main>



</body>

</html>