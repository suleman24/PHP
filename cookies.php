<?php
echo "Cookies<br>";

$cookie_name = 'category';
$value = "Books";
setcookie($cookie_name, $value, time() + (86400 * 9), "/"); 
echo "The cookie is set<br>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

if(isset(($_COOKIE[$cookie_name]))){
     echo "Cookie '" . $cookie_name . "' is set!<br>";
  echo "Value is: " . $_COOKIE[$cookie_name];
}

echo '<br><br>';


//To delete a cookie, use the setcookie() function with an expiration date in the past

setcookie($cookie_name, "", time() - 3600);
echo "Cookie is deleted.";

echo '<br><br>';
//Check if Cookies are Enabled
if(COUNT($_COOKIE)>0)
{
    echo 'Enabled';
}
else
{
    echo 'Disabled';
}



?>


</body>
</html>