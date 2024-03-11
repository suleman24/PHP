<?php
  include('../../db.php');
 
  $specialization = $_POST['specialization'];

  $sql = "SELECT * from doctor where specialization_id = (SELECT id from specialization where name = '$specialization')";
  $result = mysqli_query($conn,$sql);
 
  $out='';
  while($row = mysqli_fetch_assoc($result)) 
  {   
   $out .= '<option value="' . $row["id"] . '">' . "Dr. " . ucfirst($row["fname"]) . " " . ucfirst($row["lname"]) . " (" . $row["username"] . ")" . '</option>';
}
   echo $out;
?>