<?php
include '../../db.php';
$id = $_GET["id"];
$sql = "UPDATE appointments SET status='accepted' WHERE appointment_id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: ../dashboard.php?msg=Accepted");
} else {
  echo "Failed: " . mysqli_error($conn);
}

?>