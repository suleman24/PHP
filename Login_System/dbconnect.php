<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "Task1";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("Something went wrong;");
}

?>