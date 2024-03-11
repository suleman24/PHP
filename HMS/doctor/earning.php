<?php
session_start();

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

    <link rel="stylesheet" href="assets/css/styles.css">

    <style>
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
    </style>

    <title>Medical Records</title>


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
                            <h2>Total Earnings</h2>
                        </center>
                    </th>
                    <th style="width: 25%; align-items: end;"></th>
                </tr>


            </table>
            <hr>

            <?php
            if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
            }
            ?>

            <form action="earning.php">


                <div style="margin-bottom: 2%;  display: flex; justify-content: center;">
                    <div style="width: 15%;">
                        <input type="date" name="d1" id="d1" class="form-control">
                    </div>
                    <button class="btn btn-primary" style="margin-left: 5%;margin-right: 5%;">Calculate in between range</button>
                    <div style="width: 15%;">
                        <input type="date" name="d2" id="d2" class="form-control">
                    </div>
                </div>

                <div style="display: flex;">
                    <table style="width: 50%;" class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Date</th>
                                <th scope="col">Fee</th>




                            </tr>
                        </thead>

                        <?php
                        include '../db.php';

                        $username = $_SESSION['username'];
                        $user_id = 0;
                        $sql = "Select * from doctor where username='$username'";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);
                        if ($num == 1) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $user_id = $row['id'];
                            }
                        }


                        if (isset($_GET['d1']) && $_GET['d1'] != '' && isset($_GET['d2']) && $_GET['d2'] != '') {
                            $d1 = $_GET['d1'];
                            $d2 = $_GET['d2'];

                            $sql = "SELECT medical_record.id, 
                                   medical_record.date, 
                                   medical_record.fee,
                                   medical_record.patient_id AS patient_id,
                                   patient.fname AS patient_fname,
                                   patient.lname AS patient_lname
                            FROM medical_record
                            INNER JOIN patient ON medical_record.patient_id = patient.id 
                            INNER JOIN doctor ON medical_record.doctor_id = doctor.id
                            WHERE doctor.id = $user_id AND `date` BETWEEN '$d1' AND '$d2'";
                        } else {
                            $sql = "SELECT medical_record.id, 
                                   medical_record.date, 
                                   medical_record.fee,
                                   medical_record.patient_id AS patient_id,
                                   patient.fname AS patient_fname,
                                   patient.lname AS patient_lname
                            FROM medical_record
                            INNER JOIN patient ON medical_record.patient_id = patient.id 
                            INNER JOIN doctor ON medical_record.doctor_id = doctor.id
                            WHERE doctor.id = $user_id";
                        }



                        $result = $conn->query($sql);
                        $i = 0;
                        $earning = 0;
                        if ($result->num_rows > 0) {
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

                        ?>



                        </tbody>
                    </table>

                    <div class="shaded-div">
                        <?php echo '<span style="color: white; font-size: 18px;margin-left: 20px; ">Number of Patients: ' . $i . '</span>'; ?>
                        <?php echo '<span style="font-size: 24px; margin-left: 20px;">Earnings: Rs ' . $earning . '</span>'; ?>
                    </div>


                </div>




            </form>




        </section>
    </main>

    <script>
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

</body>

</html>