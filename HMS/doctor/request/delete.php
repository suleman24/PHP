<?php
include '../../db.php';
$id = $_GET["id"];
$sql = "UPDATE appointments SET status='deleted' WHERE appointment_id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: ../dashboard.php?msg=Deleted");
} else {
  echo "Failed: " . mysqli_error($conn);
}

?>