<?php
include '../db.php';
$id = $_GET["id"];
$sql = "UPDATE `doctor` SET `status` = '0' WHERE `id` = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: pending.php?msg=Moved to Pending");
} else {
  echo "Failed: " . mysqli_error($conn);
}

?>