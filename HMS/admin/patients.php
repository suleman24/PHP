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

    <title>Admin | Patients</title>


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
                            <h2>Patients</h2>
                        </center>
                    </th>
                    <th style="width: 25%;"></th>
                </tr>



            </table>

            <form action="patients.php" method="get">

                <div class="header__search">
                    <input name="search" type="text" placeholder="Search" class="header__input">
                    <button class='btn btn-primary'>
                        Search
                    </button>
                </div>
            </form>


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
                        <th scope="col">Username</th>
                        <th scope="col">Age</th>
                        <th scope="col">Status </th>
                    </tr>
                </thead>

                <?php

                include '../db.php';

                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $sql = "SELECT * from patient WHERE username LIKE '%$search%' OR fname LIKE '%$search%' OR lname LIKE '%$search%' order by fname";
                } else {
                    $sql = "SELECT * from patient order by fname";
                }

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        $i = $i + 1;
                        echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . ucfirst($row["fname"]) . " " . ucfirst($row["lname"]) . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["age"] . "</td>
                        <td>
                        <button name='status' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
                        <a style='color:white' href='patients/patient_status.php?id=" . $row["id"] . "&status=" . $row["status"] . "' class='link-dark'>";
        
            if ($row['status'] == 0) {
                echo "Activate";
            } else {
                echo "Deactivate <i class='fa-solid fa-pen-to-square fs-5 me-3'></i>";
            }
        
            echo "</a>
                        </button>
                    </td>
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