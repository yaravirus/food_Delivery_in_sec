<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$db   = getenv('DB_DATABASE');
$port = getenv('DB_PORT');

$link = mysqli_connect($host, $user, $pass, $db, $port);

if (!$link) {
    die("DB Connection failed: " . mysqli_connect_error());
}
?>