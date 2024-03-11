<?php
include '../db.php';
$id = $_GET["id"];
$sql = "UPDATE `doctor` SET `status` = '1' WHERE `id` = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: doctors.php?msg=Accepted");
} else {
  echo "Failed: " . mysqli_error($conn);
}

?>