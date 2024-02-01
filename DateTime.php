<?php


echo "Date is: ". date('d/m/y') . "<br>";
echo "Date is: ". date('d-m-y') . "<br>";
echo "Date is: ". date('D/M/Y') . "<br>";

date_default_timezone_set("Asia/Karachi");
echo "Time is: ". date('h:i:s a') . "<br><br>";


$a = mktime(8,12,12,1,22,2024);
echo "Date is: ". date('d-m-y h:i:s a', $a) . "<br><br>";


$s=strtotime("10:30 pm April 15 2024");
echo "Date is: ". date('d-m-y h:i:s a', $s) . "<br><br>";



$t=strtotime("yesterday");
echo "Date is: ". date('d-m-y h:i:s a', $t) . "<br><br>";

$n=strtotime("next Friday");
echo "Date is: ". date('d-m-y h:i:s a', $n) . "<br><br>";

$m=strtotime("+5 Months");
echo "Date is: ". date('d-m-y h:i:s a', $m) . "<br><br>";



$b = strtotime("9 feb 2024");
$r = ceil(($b-time())/60/60/24);
echo "Remaining Days: ". $r . "<br><br>";





//To be used in other file for Include and Require

$req = 'Hello World';
$time = date('h:i:s a');




?>