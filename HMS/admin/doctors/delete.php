<?php
include '../../db.php';
$id = $_GET["id"];
$sql = "DELETE FROM `doctor` WHERE `doctor`.`id` = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: ../pending.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}

?>