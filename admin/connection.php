<?php
$host = getenv("DB_HOST") ?: "mysql-db";  // mysql-db = Render MySQL service name
$db   = getenv("DB_NAME") ?: "food_delivery";
$user = getenv("DB_USER") ?: "fooduser";
$pass = getenv("DB_PASS") ?: "foodpass123";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
