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

    <title>Admin | Dashboard</title>


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
                            <h2>Doctors</h2>
                        </center>
                    </th>
                    <th style="width: 25%; align-items: end;"><button type="submit" class="btn btn-primary" style="margin-top: 30px; width: 40%"><a style="color: white;" href="specializations.php">Specializations</a></button></th>
                </tr>


            </table>
            <hr>
            <table>
                <tr style="width: 100%; align-items: centre;">
                    <td style="width: 40%;"><button type="submit" class="btn btn-primary" style="margin-top: 30px; width: 100%"><a class="nav-link" href="doctors.php">Available Doctors</a></button>
                    </td>
                    <td style="width: 40%;">
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px; width: 100%"><a class="nav-link" href="pending.php">Pending Requests</a>
                </button>
                    </td>
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

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Username</th>
                        <th scope="col">Specialization</th>
                        <th scope="col">Status</th>

                    </tr>
                </thead>

                <?php
                include '../db.php';
                $sql = "SELECT doctor.id, doctor.age, doctor.username, doctor.fname AS doctor_fname, doctor.lname AS doctor_lname, specialization.name AS specialization_name 
FROM doctor
INNER JOIN specialization ON doctor.specialization_id = specialization.id WHERE doctor.status='1'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
        <td>" . $row["id"] . "</td>
        <td>" . "Dr. " .  ucfirst($row["doctor_fname"]) . " " . ucfirst($row["doctor_lname"]) . "</td>
        <td>" . $row["age"] . "</td>
        <td>" . $row["username"] . "</td>
        <td>" . $row["specialization_name"] . "</td>
        <td>
        <button name='delete' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
        <a style= 'color:white'href='request_pending.php?id=" . $row["id"] . "' class='link-dark'>Move to Pending
            <i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
        </a>
    </button></td>

        </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "0 results";
                }

                $conn->close();

                ?>



                </tbody>
            </table>





        </section>
    </main>



</body>

</html>