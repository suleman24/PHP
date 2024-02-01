<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

$servername= 'localhost';
$username = 'root';
$password = '';
$database = 'sul';


$con = mysqli_connect($servername,$username,$password);
if (!$con){
    die("failed: ". mysqli_connect_error());
}
else{
    echo 'Success';
}
$db = 'CREATE DATABASE sul';
mysqli_query($con,$db);







$con = mysqli_connect($servername,$username,$password,$database);



?>





    
</body>
</html>


