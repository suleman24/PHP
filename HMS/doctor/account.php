<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../index.php");
    exit;
} else {
    $myusername = $_SESSION['username'];
}

include('../db.php');
$validate_username = false;
$validate_fname = false;
$validate_password = false;
$errors = 0;
$empty = false;
$validate_fee = false;


$sql = "SELECT id, fname, lname, age, password,fee FROM doctor WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $myusername);
$stmt->execute();
$stmt->bind_result($id, $fname, $lname, $age, $password,$fee);
$stmt->fetch();
$stmt->close();





if (isset($_POST["submit"])) {
    if (empty($_POST['fname']) or empty($_POST['lname'])) {
        $empty = true;
        $errors = $errors + 1;
    }
    
    if (strlen($_POST['fname']) < 3) {
        $validate_fname = true;
        $errors = $errors + 1;
    }

    

        
    if(empty( $_POST["fee"]))
    {
        $validate_fee = true;
        $errors = $errors + 1;
    }
    
    
  if($errors == 0)
  {
    $ufname = $_POST['fname'];
    $ulname = $_POST['lname'];
    $ufee = $_POST['fee'];

    if(empty($_POST['password']))
    {       
         $upassword = $password;

    }
    else
    {
        $upassword = $_POST['password'];

    }

    $uage = isset($_POST['age']) ? $_POST['age'] : $age; 


    $sql = "UPDATE doctor SET fname=?, lname=?, age=?, password=?, fee=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisii", $ufname, $ulname, $uage, $upassword,$ufee, $id);
    $result = $stmt->execute();
    $stmt->close();

    if ($result) {
        header("Location: account.php?msg=Updated successfully");
        exit;
    } else {
        echo "Failed to update: " . $conn->error;
    }
  }
  else{
    echo "Error";

  }
}

?>

<!doctype html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>My Account</title>

</head>

<body>

<?php

include 'include/sidebar.php';

?>

<main>
        <section>

        <div class="signup">
        <div class="container form-group col-md-6 my-4">
            <h1 class="text-center"> My Account </h1>
            <form action="account.php" method="post">
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" aria-describedby="fnameHelp" value="<?php echo $fname ?>">
                    <?php
                    if ($validate_fname)
                        echo '<div class="alert alert-warning" role="alert">First name should have at least 3 characters</div>';
                    ?>
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" aria-describedby="lnameHelp" value="<?php echo $lname ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php
                    if ($validate_password) {
                        echo '<div class="alert alert-warning" role="alert">Password should have at least 6 characters</div>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="fee" class="form-label">Fee</label>
                    <input type="number" class="form-control" id="fee" name="fee" aria-describedby="lnameHelp"  value="<?php echo $fee ?>">
                </div>
                <?php
                    if ($validate_fee == true)
                        echo '<div class="alert alert-warning" role="alert">Fee is necessary</div>';
                    ?>

                <select name="age">
                    <option value="<?php echo $age ?>">Select Age</option>
                    <?php
                    for ($i = 1; $i <= 100; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
                <div style="margin-top: 5%;"></div>
                <button type="submit" name="submit" class="btn btn-primary form-group center-align">Update</button>
            </form>
        </div>
    </div>



        </section>
    </main>


   
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>