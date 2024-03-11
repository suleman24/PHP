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
                            <h2>Medical Records</h2>
                        </center>
                    </th>
                    <th style="width: 25%;"></th>
                </tr>


            </table>
            <hr>

            <div class="container mt-4 text-center">
                <form style="margin-bottom: 2%;" action="medical_records.php" method="post">
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
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px; width: 10%">Search</button>
                </form>

                <?php
                include '../db.php';

        if (isset($_POST['doctor']) && $_POST['doctor'] != 'Select Option') {
            $doctor = $_POST['doctor'];

            $sql = "SELECT medical_record.id AS id, 
            medical_record.date AS date,
            medical_record.diagnosis AS diagnosis,
            medical_record.treatment AS treatment,
            medical_record.notes AS notes,
            medical_record.fee AS fee,
            medical_record.patient_id AS patient_id,
            patient.fname AS patient_fname,
            patient.lname AS patient_lname
            FROM medical_record
            INNER JOIN patient ON medical_record.patient_id = patient.id 
            INNER JOIN doctor ON medical_record.doctor_id = doctor.id
            WHERE doctor.id = $doctor";

                    $result = $conn->query($sql);
                    $i = 0;

                    if ($result->num_rows > 0) {
                ?>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Fee</th>
                                    <th scope="col">Diagnosis</th>
                                    <th scope="col">Treatment</th>
                                    <th scope="col">Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    $i++;
                                    $name = ucfirst($row["patient_fname"]) . " " . ucfirst($row["patient_lname"]);
                                    echo "<tr>
                        <td>$i</td>
                        <td>$name</td>
                        <td>{$row["date"]}</td>
                        <td style='width: 8%;'>{$row["fee"]}</td>
                        <td style='width: 24%;'>{$row["diagnosis"]}</td>
                        <td style='width: 24%;'>{$row["treatment"]}</td>
                        <td style='width: 14%;'>{$row["notes"]}</td>
                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                <?php
                    } else {
                        echo "0 results";
                    }

                    $conn->close();
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
            </script>



        </section>
    </main>



</body>

</html>