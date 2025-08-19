<?php
session_start();
include "../admin/connection.php";  // adjust path to your DB connection

if (isset($_GET['id']) && isset($_GET['qty'])) {
    $id  = intval($_GET['id']);
    $qty = intval($_GET['qty']);

    // Fetch product from food table
    $res = mysqli_query($link, "SELECT * FROM food WHERE id=$id");
    if ($row = mysqli_fetch_assoc($res)) {
        $food_name        = $row["food_name"];
        $food_category    = $row["food_category"];
        $food_description = $row["food_description"];
        $food_price       = $row["food_discount_price"];
        $food_ingredients = $row["food_ingredients"];
        $food_image       = $row["food_image"];

        // user id (if logged in, otherwise 0)
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        // Insert into cart table
        $sql = "INSERT INTO user_cart 
                (user_id, food_name, food_category, food_description, food_price, food_ingredients, food_image, quantity)
                VALUES 
                ('$user_id', '$food_name', '$food_category', '$food_description', '$food_price', '$food_ingredients', '$food_image', '$qty')";

        if (mysqli_query($link, $sql)) {
            echo "Item added to cart!";
        } else {
            echo "Error: " . mysqli_error($link);
        }
    } else {
        echo "Food not found!";
    }
} else {
    echo "Invalid request!";
}
?>
