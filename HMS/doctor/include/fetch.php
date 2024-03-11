<?php
  include('../../db.php');
 
  $specialization = $_POST['specialization'];

  echo '..........';
  echo $specialization;
  echo '..........';

  $sql = "SELECT * from doctor where specialization_id = (SELECT id from specialization where name = '$specialization')";
  $result = mysqli_query($conn,$sql);
 
  $out='';
  while($row = mysqli_fetch_assoc($result)) 
  {   
   $out .= '<option>' . "Dr. " . ucfirst($row["fname"]) . " " . ucfirst($row["lname"]) . " (" . $row["username"] . ")" . '</option>';
}
   echo $out;
?>