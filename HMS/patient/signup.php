<?php
$showAlert = false;
$showError = false;
$empty = false;
$validate_username = false;
$validate_fname = false;
$p_length = false;
$p_match = false;
$exists = false;
$errors = 0;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../db.php';
    $username = $_POST["username"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $age = $_POST["age"];
    $empty = false;
    $validate_username = false;
    $validate_fname = false;

    $p_length = false;
    $p_match = false;
    $exists = false;






    if (empty($username) or empty($password) or empty($cpassword)) {
        $empty = true;
        $errors = $errors + 1;
    }

    if (strlen($username) < 5) {
        $validate_username = true;
        $errors = $errors + 1;
    }


    if (strlen($password) < 6) {
        $p_length = true;
        $errors = $errors + 1;
    }

    if ($password !== $cpassword) {
        $p_match = true;
        $errors = $errors + 1;
    }
    if (strlen($fname) < 3) {
        $validate_fname = true;
        $errors = $errors + 1;
    }


    try {
        $sql = "SELECT * FROM patient WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {
            $exists = true;
            $errors = $errors + 1;
        }
    } catch (Exception $e) {
    }





    if ($errors == 0) {

        $showAlert = true;

        $stmt = $conn->prepare("INSERT INTO `patient` (`fname`, `lname`, `age`, `username`, `password`,`status`) 
          VALUES (?, ?, ?, ?, ?,?)");

        if (!$stmt) {
            die("Error: " . $conn->error); 
        }

        $stmt->bind_param("ssissi", $fname, $lname, $age, $username, $password,$status);

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $age = $_POST["age"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $status = 1;

        if ($stmt->execute()) {
            $showAlert = true; 
        } else {
            $showError = true;
            echo "Error: " . $stmt->error; 
        }

        $stmt->close();
    } else {
        $showError = true;
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../images/background.jpg');
            background-size: cover;
            background-position: center;
        }

        .signup {
            text-align: center;
            width: 40%;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            padding-right: 10px;
            padding-left: 10px;
            border-radius: 10px;

        }
    </style>
</head>

<body>


    <div class="signup">
    <?php
    if ($showAlert == true)
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Registered</strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

    if ($exists == true)
        echo '<div class="alert alert-warning" role="alert">username already exists</div>';
    ?>
        <div class="container form-group col-md-6 my-4">

            
            <h1 class="text-center"> Register </h1>

            <form action="signup.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="username" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
                    <?php
                    if ($validate_username == true)
                        echo '<div class="alert alert-warning" role="alert">Username should have at least 5 characters</div>';
                    ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php
                    if ($p_length == true) {
                        echo '<div class="alert alert-warning" role="alert">Password should have at least 6 characters</div>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword">
                    <?php
                    if ($p_match == true)
                        echo '<div class="alert alert-warning" role="alert">Password does not match </div>';
                    ?>
                </div>
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="fname" class="form-control" id="fname" name="fname" aria-describedby="fnameHelp">
                    <?php
                    if ($validate_fname == true)
                        echo '<div class="alert alert-warning" role="alert">First name is necessary</div>';
                    ?>
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="lname" class="form-control" id="lname" name="lname" aria-describedby="lnameHelp">
                </div>

                <select name="age">
                    <option value="">Select Age</option>
                    <?php
                    for ($i = 1; $i <= 100; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>

                <div style="margin-top: 5%;"></div>



                <button type="submit" class="btn btn-primary form-group center-align">Sign up</button>
            </form>

            Already have an account? <a href="login.php">Login</a>

        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>