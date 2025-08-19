<?php
$link = mysqli_connect("localhost", "root", "");
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_select_db($link, "food_ordering_system") or die("Database not found");

?>