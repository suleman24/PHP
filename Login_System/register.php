<?php
$showAlert = false;
$showError = false;
$empty=false;
$validate_email = false;
$p_length = false;
$p_match= false;
$exists = false;
$errors = 0;


if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $empty=false;
    $validate_email = false;
    $p_length = false;
    $p_match= false;
    $exists = false;
  


    if (empty($email) OR empty($password) OR empty($cpassword)) {
      $empty=true;
      $errors=$errors+1;
    }
   
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $validate_email = true;
      $errors=$errors+1;

    }
    
     if (strlen($password)<8) {
      $p_length = true;
      $errors=$errors+1;

    }
   
     if ($password!==$cpassword) {
      $p_match= true;
      $errors=$errors+1;

    }
  
     $sql = "SELECT * FROM users WHERE email = '$email'";
     $result = mysqli_query($conn, $sql);
     $rowCount = mysqli_num_rows($result);
     if ($rowCount>0) {
            $exists = true;
            $errors=$errors+1;

     }
   
     

     if($errors == 0)
     {
      $sql = "INSERT INTO `users` ( `email`, `password`, `date`) VALUES ('$email', '$password', current_timestamp())";
      $result = mysqli_query($conn, $sql);
      if ($result){
          $showAlert = true;
     }
        
  
    else{
        $showError = true;
    }


    }
    
}
    
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
<?php require 'nav.php'  ?>
<?php 
if($showAlert == true)
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Registered</strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

if($exists == true)
echo '<div class="alert alert-warning" role="alert">Email already exists</div>';


?>





<div class="container form-group col-md-6 my-4">
  <h1 class = "text-center"> Register </h1>
  <form action="register.php" method="post">
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    <?php 
if($validate_email == true)
echo '<div class="alert alert-warning" role="alert">Invalid Email</div>';
?>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    <?php 
    if($p_length == true)
    {
      echo '<div class="alert alert-warning" role="alert">Password should have at least 8 characters</div>';
    }
?>
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
    <?php 
  if($p_match == true)
  echo '<div class="alert alert-warning" role="alert">Password does not match </div>';
  ?>
  </div>

  <button type="submit" class="btn btn-primary form-group col-md-3 center-align">Register</button>
</form>

</div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>