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

    <title>Admin | Inventory</title>


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
                            <h2>Inventory</h2>
                        </center>
                    </th>
                    <th style="width: 25%; align-items: end;"><button type="submit" class="btn btn-primary" style="margin-top: 30px; width: 40%"><a style="color: white;" href="add_inventory.php">Add Item</a></button></th>
                </tr>



            </table>

            <form action="inventory.php" method="get">

                <div class="header__search">
                    <input name="item" type="text" placeholder="Search" class="header__input">
                    <button class='btn btn-primary'>
                        Search
                    </button>
                </div>
            </form>

            <hr>

            <?php
             include '../db.php';

            $sql = "SELECT * FROM inventory WHERE quantity < 5";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    if ($row['quantity'] == 0) {
                        echo "<h6>" . $row['item'] . " is out of stock</h6>";
                    } else {
                        echo "<h6>" . $row['item'] . " is going out of stock. Only " . $row['quantity'] . " left. </h6>";
                    }
                    echo "<br>";
                }
            }
            ?>


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
                        <th scope="col">Item</th>
                        <th scope="col">Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price </th>
                        <th scope="col"></th>
                        <th scope="col"></th>


                    </tr>
                </thead>

                <?php

                if (isset($_GET['item'])) {
                    $item = $_GET['item'];
                    $sql = "SELECT * from inventory WHERE item LIKE '%$item%'";
                } else {
                    $sql = "SELECT * from inventory";
                }

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        $i = $i + 1;
                        echo "<tr>
                        <td><option id='id' value='" . $row["id"] . "'>" . $i . "</option></td>
        <td>" . $row["item"]  . "</td>
        <td>" . $row["description"] . "</td>
        <td>" . $row["quantity"]  . "</td>
        <td>" . $row["price"]  . "</td>
        
        <td >
        <button name='edit' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
        <a style= 'color:white'href='update_inventory.php?id=" . $row["id"] . "&item=" . $row["item"] .
        "&quantity=" . $row["quantity"] ."&price=" . $row["price"] .  "' class='link-dark'>Edit
            <i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
        </a>
    </button>
</td>
        <td>
    <button name='delete' style='background-color: white; color: red;' type='submit' class='btn btn-primary'>
        <a style= 'color:white'href='inventory/delete.php?id=" . $row["id"] . "' class='link-dark'>Delete
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