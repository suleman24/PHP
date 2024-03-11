<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../index.php");
    exit;
} else {
    $username =  $_SESSION['username'];
}

include '../db.php';


$id = $_GET["id"];
$item = $_GET["item"];
$quantity = $_GET["quantity"];
$price = $_GET["price"];

$empty = false;
$validate_name = false;
$validate_quantity = false;
$validate_price = false;



if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $errors = 0;


    if (empty($name) or empty($quantity) or empty($price)) {
        $empty = true;
        $errors = $errors + 1;
    }
    if (strlen($name) < 3) {
        $validate_name = true;
        $errors = $errors + 1;
    }
    if (empty($quantity)) {
        $validate_quantity = true;
        $errors = $errors + 1;
    }
    if (empty($price)) {
        $validate_price = true;
        $errors = $errors + 1;
    }

    if ($errors == 0) {
        $sql = "UPDATE `inventory`SET `quantity` = '$quantity', `price`='$price' WHERE `id` = $id";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: inventory.php?msg=Updated successfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
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

    <title>Add Item</title>


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
                            <h2>Add Item</h2>
                        </center>
                    </th>
                    <th style="width: 25%;"></th>
                </tr>
            </table>

            <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                    <div class="row mb-3">
                        <div>
                            <label class="form-label">Item Name:</label>
                            <input value=<?php echo $item ?> type="text" class="form-control" name="name">
                            <?php
                            if ($validate_name == true)
                                echo '<div class="alert alert-warning" role="alert">First name is necessary and should have atleast 3 characters</div>';
                            ?>
                        </div>
                        <div>
                            <label class="form-label">Quantity:</label>
                            <input value=<?php echo $quantity ?> type="number" class="form-control" name="quantity">
                            <?php
                            if ($validate_quantity == true)
                                echo '<div class="alert alert-warning" role="alert">Quantity is necessary</div>';
                            ?>
                        </div>
                        <div>
                            <label class="form-label">Price:</label>
                            <input value=<?php echo $price ?> type="number" class="form-control" name="price">
                            <?php
                            if ($validate_price == true)
                                echo '<div class="alert alert-warning" role="alert">Price is necessary</div>';
                            ?>
                        </div>



                        <div style="margin-top: 30px; width: 40%">
                            <button type="submit" class="btn btn-success" name="submit">Update</button>
                            <a href="inventory.php" class="btn btn-danger">Cancel</a>
                        </div>
                </form>
            </div>






        </section>
    </main>



</body>

</html>