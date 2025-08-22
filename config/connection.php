<?php
$host = "localhost";  
$user = "root";  
$pass = "";           // or your root password  
$db   = "food_ordering_system";

$link = mysqli_connect($host, $user, $pass, $db);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
