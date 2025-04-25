<?php

$servername="localhost";
$dbname = "burhanst_earningmaster";
$username = "burhanst_earningmaster";
$password = "gBQFX9pMZi9f";

$link=mysqli_connect($servername,$username, $password,$dbname);

if(!$link)
{
    echo "error";
}

 
$conn=mysqli_connect($servername,$username,$password,$dbname);

?>

