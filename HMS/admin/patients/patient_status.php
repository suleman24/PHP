<?php
include '../../db.php';
$id = $_GET["id"];
$status = $_GET["status"];

if($status==0)
{
    $sql = "UPDATE patient SET status=1 where id = '$id'";
}
else{
    $sql = "UPDATE patient SET status=0 where id = '$id'";
}
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: ../patients.php?msg=Done");
} else {
  echo "Failed: " . mysqli_error($conn);
}

?>