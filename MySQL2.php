<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sul";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_insert = "INSERT INTO users (id, uname, uaddress) VALUES ('1', 'suleman', 'vehari')";
if ($conn->query($sql_insert) === TRUE) {
    echo "New record inserted successfully";
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

$sql_select = "SELECT * FROM users";
$result = $conn->query($sql_select);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - name: " . $row["uname"]. " - address: " . $row["uaddress"]. "<br>";
    }
} else {
    echo "0 results";
}

$sql_update = "UPDATE users SET id='2' WHERE uname='suleman'";
if ($conn->query($sql_update) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$sql_delete = "DELETE FROM users WHERE name='suleman'";
if ($conn->query($sql_delete) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
