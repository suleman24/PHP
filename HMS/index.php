<?php

include 'db.php';
session_start();


if(isset($_SESSION['loggedin']) ){
    $username =  $_SESSION['username'];
    $user = $_SESSION['user'];

    if($user=='patient')
    {
        header("location: patient/dashboard.php");
    }
    else if($user=='doctor')
    {
        header("location: doctor/dashboard.php");
    }
    else if($user=='admin')
    {
        header("location: admin/dashboard.php");
    }


}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
        }
        .hms {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            padding-right: 100px;
            padding-left: 100px;
            border-radius: 10px;
            margin-right: 20%;

        }
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 300px;
            height: 300px;
            position: relative;
        }
        .button {
            position: absolute;
            width: 60px;
            height: 40px;
            border-radius: 10%;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s, color 0.3s;
        }
        .button:hover {
            background-color: #007bff;
            color: #fff;
        }
        .admin {
            top: 8%;
            left: 50%;
            transform: translateX(-50%);
        }
        .doctor {
            bottom: 25%;
            right: 80%;
            transform-origin: bottom right;
            transform: rotate(45deg);
        }
        .patient {
            bottom: 25%;
            left: 80%;
            transform-origin: bottom left;
            transform: rotate(-45deg);
        }

    </style>
</head>
<body>
<div class="hms">
    <h1>HMS</h1>
    
    </div>

<div class="container">
    <h1>Login</h1>
        <a href="admin/login.php" class="button admin">Admin</a>
        <a href="doctor/signup.php" class="button doctor">Doctor</a>
        <a href="patient/signup.php" class="button patient">Patient</a>
    </div>


</body>
</html>