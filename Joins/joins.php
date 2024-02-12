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

echo " INNER JOIN <br><br>";
$sql = "SELECT Students.student_id,Students.student_name, Courses.course_name
FROM Students
INNER JOIN Courses ON Students.student_id = Courses.student_id";
$result = $conn->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo $row["student_id"]." " .$row["student_name"] ." ". $row["course_name"]. "<br>" ;
    }
}


echo "<br><br> LEFT JOIN <br><br>";

$sql = "SELECT Students.student_id,Students.student_name, Courses.course_name
FROM Students
LEFT JOIN Courses ON Students.student_id = Courses.student_id";
$result = $conn->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo $row["student_id"]." " .$row["student_name"] ." ". $row["course_name"]. "<br>" ;
    }
}


echo "<br><br> RIGHT JOIN <br><br>";

$sql = "SELECT Students.student_id,Students.student_name, Courses.course_name
FROM Students
RIGHT JOIN Courses ON Students.student_id = Courses.student_id";
$result = $conn->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo $row["student_id"]." " .$row["student_name"] ." ". $row["course_name"]. "<br>" ;
    }
}



$conn->close();



?>