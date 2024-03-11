<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../index.php");
    exit;
} else {
    $username =  $_SESSION['username'];
}


if (isset($_POST["name"])) {
    $name = $_POST['specialization_name'];
   
 
 
       header("Location: edit.php?id=");
   
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
                            <h2>Specializations</h2>
                        </center>
                    </th>
                    <th style="width: 25%;"></th>
                </tr>


            </table>
            <button type="submit" class="btn btn-primary" style="margin-top: 30px; width: 15%"><a class="nav-link" href="add.php">Add Specialization</a>
                </button>
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
                        <th style="width: 20%;" scope="col">#</th>
                        <th style="width: 60%;" scope="col">Specialization</th>
                        <th style="width: 10%;" scope="col">Edit</th>
                        <th style="width: 10%;" scope="col">Delete</th>
                    </tr>
                </thead>

                <?php
                include '../db.php';
                $sql = "SELECT * from specialization";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        $i = $i+1;
                        echo "<tr>
        <td>" . $i . "</td>
        <td>" .  ucfirst($row["name"]) . "</td>
      
        <td style='width: 15%;'>
        <button name='edit' style='background-color: white; color: blue; width: 50%;' type='submit' class='btn btn-primary'>
            <a style= 'color:blue'href='doctors/specializations/edit.php?id=" . $row["id"] . "&name=" . $row["name"] . "' class='link-dark'>Edit
                <i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
            </a>
        </button>
    </td>
    <td style='width: 20%;'>
    <button name='delete' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
        <a style= 'color:white'href='doctors/specializations/delete.php?id=" . $row["id"] . "' class='link-dark'>Delete
            <i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
        </a>
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