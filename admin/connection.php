<?php
$host = getenv('DB_HOST');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

$link = new mysqli($host, $user, $pass, $db, (int)$port);

if ($link->connect_error) {
    die("DB Connection failed: " . $link->connect_error);
}
echo "✅ Connected to Clever Cloud MySQL!";
?>
