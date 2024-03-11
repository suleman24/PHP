<?php
  include('../../db.php');
 
  $doctor = $_POST['doctor'];


  $sql = "SELECT * from doctor where id = '$doctor'";
  $result = mysqli_query($conn,$sql);

  $out='';
 
  while($row = mysqli_fetch_assoc($result)) 
  {   
    $out .= '<option>' . $row['fee']. '</option>';
}
   echo $out;
?>