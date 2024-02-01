

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $password = $_POST['pass'];

    echo $email. ' & ' .$password;
}


?>


<form action="index.php" method = "POST">

<label for="email">Enter Email</label>
<input type="email" id="email" name ="email">
<label for="pass">Enter Password</label>
<input type="password" id="pass" name ="pass">

<input type="submit">


</form>





    
</body>
</html>


