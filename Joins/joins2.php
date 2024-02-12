<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "testtt";

$conn = new mysqli($servername,$username,$password,$database);
if($conn->connect_error)
{
    die("Connection Failed: ". $conn->connect_error);
}

echo " INNER JOIN <br><br>";
$sql = "SELECT products.product_name, order_details.order_detail_id
FROM products
INNER JOIN order_details ON products.product_id =  order_details.order_detail_id";
$result = $conn->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo $row["product_name"]." " . $row["order_detail_id"]. "<br>" ;
    }
}


echo "<br><br> LEFT JOIN <br><br>";

$sql = "SELECT products.product_name, order_details.order_detail_id
FROM products
LEFT JOIN order_details ON products.product_id =  order_details.order_detail_id";
$result = $conn->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo $row["product_name"]." " . $row["order_detail_id"]. "<br>" ;
    }
}



echo "<br><br> RIGHT JOIN <br><br>";

$sql = "SELECT products.product_name, order_details.order_detail_id
FROM products
RIGHT JOIN order_details ON products.product_id =  order_details.order_detail_id";
$result = $conn->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo $row["product_name"]." " . $row["order_detail_id"]. "<br>" ;
    }
}




$conn->close();



?>