<?php
session_start();

include '../db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../index.php");
    exit;
} else {
    $username =  $_SESSION['username'];
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

    <title>Doctor's Earnings</title>
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
        .shaded-div {
            background-color: rgb(255, 192, 203);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(255, 192, 203);
            width: 25%;
            margin: auto;
            display: flex;
            justify-content: center;
            display: flex;
            flex-direction: column;
        
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

    <?php 
                    $sql = "SELECT fee from medical_record"; 
                    $result = $conn->query($sql);
                    $j = 0;
                    $tearning = 0;
                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_assoc()) {
                            $j = $j+1;
                            $tearning = $row['fee'] + $tearning;
                        }
                    }
                    $tearning = $tearning - $tearning * 0.9;

                    echo '<div class="shaded-div">' .
                    '<span style="font-size: 12px; margin-left: 20px;">Total Number of Patients: ' . $j . '</span>' .
                    '<span style="font-size: 16px; margin-left: 20px;">Total Hospital`s Earning: Rs ' . $tearning . '</span>' .
                    '</div>';

    ?>
            <hr>


    <main>
        <section>

            <table style="width: 100%;">
                <tr>
                    <th style="width: 25%;"></th>
                    <th style="width: 50%;">
                        <center>
                            <h2>Doctor's Earnings</h2>
                        </center>
                    </th>
                    <th style="width: 25%;"></th>
                </tr>


            </table>
            <hr>

            <div class="container mt-4 text-center">
                <form style="margin-bottom: 2%;" action="earning.php" method="post">
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


                        </div>
                        <div class="col-sm-4">
                            <h6>Doctor</h6>
                            <select class="form-select" name="doctor" id="doctor">
                                <option>Select Option</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-bottom: 2%;margin-top:2%; display: flex; justify-content: center;">
                    <div style="margin-right:5%;">
                        <input  type="date" name="d1" id="d1" class="form-control">
                    </div>
                    <div style="margin-left:5%;"  >
                        <input type="date" name="d2" id="d2" class="form-control">
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px; width: 10%">Search</button>
                </form>

                <?php
                include '../db.php';

        if (isset($_POST['doctor']) && $_POST['doctor'] != 'Select Option') {
            $doctor = $_POST['doctor'];

            if (isset($_POST['d1']) && $_POST['d1'] != '' && isset($_POST['d2']) && $_POST['d2'] != '') {
                $d1 = $_POST['d1'];
                $d2 = $_POST['d2'];


                $sql = "SELECT medical_record.id, 
                medical_record.date, 
                medical_record.fee,
                medical_record.patient_id AS patient_id,
                patient.fname AS patient_fname,
                patient.lname AS patient_lname
         FROM medical_record
         INNER JOIN patient ON medical_record.patient_id = patient.id 
         INNER JOIN doctor ON medical_record.doctor_id = doctor.id
         WHERE doctor.id = $doctor AND `date` BETWEEN '$d1' AND '$d2'";

         echo '..........';
            }else{
                $sql = "SELECT medical_record.id, 
                medical_record.date, 
                medical_record.fee,
                medical_record.patient_id AS patient_id,
                patient.fname AS patient_fname,
                patient.lname AS patient_lname
         FROM medical_record
         INNER JOIN patient ON medical_record.patient_id = patient.id 
         INNER JOIN doctor ON medical_record.doctor_id = doctor.id
         WHERE doctor.id = $doctor";
            }



                    $result = $conn->query($sql);
                    $i = 0;
                    $earning = 0;
                    if ($result->num_rows > 0) {
                ?>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Date</th>
                                <th scope="col">Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    $i = $i + 1;
                                    $earning = $row['fee'] + $earning;
    
                                    $name = ucfirst($row["patient_fname"]) . " " . ucfirst($row["patient_lname"]);
                                    echo "<tr>
                <td>" . $i . "</td>
                <td>" .  ucfirst($row["patient_fname"]) . " " . ucfirst($row["patient_lname"]) . "</td>
                <td>" . $row["date"] . "</td>
                <td style='width: 8%;'> " . $row["fee"] . "</td>
                ";
    
                                    echo "</tr>";
                                }
    
                                $earning = $earning - $earning * 0.1;
    
                                echo "</table>";
                            } else {
                                echo "0 results";
                            }

                    $conn->close();

                    echo '<div class="shaded-div" style="margin-bottom:3%">' .
    '<span style="font-size: 18px; margin-left: 20px;">Number of Patients: ' . $i . '</span>' .
    '<span style="font-size: 24px; margin-left: 20px;">Earnings: Rs ' . $earning . '</span>' .
    '</div>';
                }
                ?>



                </tbody>
                </table>
            


            </div>




            <script>
                $(document).ready(function() {
                        $('#specialization').change(function() {
                            var specialization = $(this).find("option:selected").text();
                            console.log(specialization);

                            $.ajax({
                                type: 'POST',
                                url: 'doctors/fetch.php',
                                data: {
                                    specialization: specialization
                                },
                                success: function(data) {
                                    console.log(data);
                                    $('#doctor').html(data);

                                }
                            });
                        });


                    }


                );

                document.getElementById('d1').addEventListener('change', function() {
            var d1 = new Date(this.value);
            var d2 = new Date(document.getElementById('d2').value);
            if (d2 < d1) {
                alert('End date must be greater than or equal to start date.');
                this.value = '';
            }
        });

        document.getElementById('d2').addEventListener('change', function() {
            var d1 = new Date(document.getElementById('d1').value);
            var d2 = new Date(this.value);
            if (d2 < d1) {
                alert('End date must be greater than or equal to start date.');
                this.value = '';
            }
        });
            </script>



        </section>
    </main>



</body>

</html>