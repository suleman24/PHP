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

$sql = "CREATE TABLE Students (
    student_id INT PRIMARY KEY,
    student_name VARCHAR(50),
    age INT,
    gender VARCHAR(10)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Students created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO Students (student_id, student_name, age, gender)
VALUES
    (1, 'John', 20, 'Male'),
    (2, 'Alice', 22, 'Female'),
    (3, 'Bob', 21, 'Male'),
    (4, 'Emma', 20, 'Female'),
    (5, 'Michael', 23, 'Male')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. ";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }



$sql = "CREATE TABLE Courses (
    course_id INT PRIMARY KEY,
    course_name VARCHAR(50),
    student_id INT,
    FOREIGN KEY (student_id) REFERENCES Students(student_id)
)";

if ($conn->query($sql) === TRUE) {
echo "Table Students created successfully";
} else {
echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO Courses (course_id, course_name, student_id)
VALUES
    (101, 'Mathematics', 1),
    (102, 'Physics', 2),
    (103, 'Chemistry', 3),
    (104, 'Biology', 1),
    (105, 'Computer Science', 4),
    (106, 'English', 5)";

if ($conn->query($sql) === TRUE) {
echo "New record created successfully. ";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}


echo "<br><br><br><br>";



$conn->close();



?>