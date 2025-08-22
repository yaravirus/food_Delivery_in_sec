<?php
$host = "localhost";   // MySQL is running locally
$user = "root";        // default XAMPP user
$pass = "";            // default XAMPP password is empty (change if you set one)
$db   = "food_ordering_system"; // your database name

// Create connection
$link = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$link) {
    die("❌ Connection failed: " . mysqli_connect_error());
} else {
    echo "✅ Connected successfully to database: " . $db;
}
?>