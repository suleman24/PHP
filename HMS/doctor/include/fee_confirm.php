<?php
include '../../db.php';
$id = $_GET["appointment_id"];
$sql = "UPDATE appointments SET fee_status='confirmed' WHERE appointment_id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: ../dashboard.php?msg=Confirmed");
} else {
  echo "Failed: " . mysqli_error($conn);
}

?>