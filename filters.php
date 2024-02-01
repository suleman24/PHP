<?php

$var = 99;

echo filter_var($var, FILTER_VALIDATE_INT)."<br>";
var_dump(filter_var($var, FILTER_VALIDATE_INT));

if(filter_var($var, FILTER_VALIDATE_INT)){
  echo "<br> $var is Integer.";
}else{
  echo "<br> $var is not an Integer.";
}

$int = 0;

if (filter_var($int, FILTER_VALIDATE_INT) === 0 || !filter_var($int, FILTER_VALIDATE_INT) === false) {
  echo("Integer is valid");
} else {
  echo("Integer is not valid");
}

$var1 = 50;
var_dump(filter_var($var1, FILTER_VALIDATE_INT));
if(filter_var($var1, FILTER_VALIDATE_INT, array("options" => array("min_range"=>20, "max_range"=>30)))){
  echo "<br> $var1 is Integer.<br>";
}else{
  echo "<br> $var1 is not an Integer.<br>";
} 

$var2 = "25.36";



 var_dump(filter_var($var2, FILTER_VALIDATE_FLOAT));
$options = array(
            "options" => array(
            "min_range"=>20, 
            "max_range"=>30
            )
          );
if(filter_var($var2, FILTER_VALIDATE_FLOAT,$options)){
  echo "<br> $var2 is FLOAT.<br>";
}else{
  echo "<br> $var2 is not an FLOAT.<br>";
} 


$var4 = true; //--- "on" / "yes" / 1 / "1"
var_dump(filter_var($var4, FILTER_VALIDATE_BOOLEAN));
if(filter_var($var4, FILTER_VALIDATE_BOOLEAN)){
  echo "<br> $var4 is Boolean.<br>";
}else{
  echo "<br> $var4 is not an  Boolean.<br>";
} 
 
$var5 = "wow";
var_dump(filter_var($var5, FILTER_VALIDATE_BOOLEAN,FILTER_NULL_ON_FAILURE ));
if(filter_var($var5, FILTER_VALIDATE_BOOLEAN)){
  echo "<br> $var5 is Boolean.<br>";
}else{
  echo "<br> $var5 is not an  Boolean.<br>";
}


 

$var6 = "hello@gmaill.com";

if(filter_var($var6, FILTER_VALIDATE_EMAIL)){
  echo "$var6 is valid Email.<br>";
}else{
  echo "$var6 is not an valid Email.<br>";
} 


$var7 = "https://www.google.com";
if(filter_var($var7, FILTER_VALIDATE_URL)){
  echo "$var7 is valid URL.<br>";
}else{
  echo "$var7 is not an valid URL.<br>";
}


$var10 = "192.168.1.1";
if(filter_var($var10, FILTER_VALIDATE_IP)){
  echo "$var10 is valid IP.<br>";
}else{
  echo "$var10 is not an valid IP.<br>";
}


$var11 = "FA-F9-DD-B2-5E-0D";
if(filter_var($var11, FILTER_VALIDATE_MAC)){
  echo "$var11 is valid MAC.<br>";
}else{
  echo "$var11 is not an valid MAC.<br>";
}






$var = "45.50abc";
$var = filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

if(filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT)){
  echo "<br>$var is valid Float.<br>";
}else{
  echo "<br>$var is not an valid Float.<br>";
}
?>