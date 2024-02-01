<?php

$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
echo json_encode($age);
echo '<br>';
echo '<br>';

$cars = array("Volvo", "BMW", "Toyota");
echo json_encode($cars);
echo '<br>';
echo '<br>';

$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
var_dump(json_decode($jsonobj));
echo '<br>';
echo '<br>';


$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
$obj = json_decode($jsonobj);
foreach($obj as $key => $value) {
    echo $key . " => " . $value . "<br>";
}
echo '<br>';


$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
$arr = json_decode($jsonobj, true);
foreach($arr as $key => $value) {
  echo $key . " => " . $value . "<br>";
}
?>