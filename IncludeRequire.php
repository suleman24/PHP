<?php

include 'DateTime.php';
echo $time.'<br><br>' ;
echo $req.'<br><br>';

//shows warning but echo executes
include 'dummy.php';
echo $req.'<br><br>';

//shows werror and echo does not execute
require 'dummy.php';
echo $req.'<br><br>';

?>