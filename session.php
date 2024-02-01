<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php

$_SESSION["email"] = "hello@gmail.com";
$_SESSION["password"] = "world123";
echo "Session variables are set. <br>";

if(isset($_SESSION))
{
    echo "Email is " . $_SESSION["email"] . ".<br>";


    session_unset();
    session_destroy();

    echo 'Session Destroyed';
}



?>

</body>
</html>
