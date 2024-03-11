<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "hms";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("Something went wrong;");
}

?>