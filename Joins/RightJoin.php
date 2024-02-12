<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "sul";

$conn = new mysqli($servername,$username,$password,$database);
if($conn->connect_error)
{
    die("Connection Failed: ". $conn->connect_error);
}

$sql = "SELECT *
FROM Students
RIGHT JOIN Courses ON Students.student_id = Courses.student_id";
$result = $conn->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo $row["student_id"] . "<br>";
    }
}



$conn->close();



?>