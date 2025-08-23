<?php
// Start session if needed
if(!isset($_SESSION)) { 
    session_start(); 
}

// Database configuration
$host = "sql109.infinityfree.com";   // Replace with your InfinityFree DB host
$user = "if0_39736894";         // Your DB username
$pass = "Iu1XlZBT9GS";         // Your DB password
$db   = "if0_39736894_XXX";         // Your database name

// Connect to MySQL
$link = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
