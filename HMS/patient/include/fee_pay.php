<?php
include '../../db.php';
$id = $_GET["id"];
$sql = "UPDATE appointments SET fee_status='paid' WHERE appointment_id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: ../dashboard.php?msg=Notified");
} else {
  echo "Failed: " . mysqli_error($conn);
}

?>