<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../connection.php");

// Get parameters
$id = intval($_GET["id"]);
$qty_get = intval($_GET["qty"]);

$food_name = $_GET["food_name"] ?? '';
$food_category = $_GET["food_category"] ?? '';
$food_description = $_GET["food_description"] ?? '';
$food_img = $_GET["food_image"] ?? '';
$food_price = $_GET["food_price"] ?? '';
$food_ingredients = $_GET["food_ingredients"] ?? '';

// If not all details sent → fetch from DB
if ($food_name == '' || $food_price == '') {
    $res3 = mysqli_query($link, "SELECT * FROM food WHERE id='$id'");
    $row3 = mysqli_fetch_array($res3);
    if (!$row3) {
        echo "Invalid product!";
        exit;
    }
    $food_img = $row3["food_image"];
    $food_name = $row3["food_name"];
    $food_category = $row3["food_category"];
    $food_description = $row3["food_description"];
    $food_price = $row3["food_discount_price"];
    $food_ingredients = $row3["food_ingredients"];
}
$tb_id = $id;

// ----------------- SESSION CART LOGIC -----------------
$check_available = check_duplicate_product_single($tb_id);

if ($check_available == 0) { // if not in cart
    if (isset($_SESSION['cart'])) {
        $b = array(
            "img1" => $food_img,
            "nm" => $food_name,
            "price" => $food_price,
            "qty_total" => $qty_get,
            "tb_id" => $tb_id
        );
        array_push($_SESSION['cart'], $b);
        echo "Product Successfully Added To Cart (Session)\n";
    } else {
        $_SESSION['cart'] = array(array(
            "img1" => $food_img,
            "nm" => $food_name,
            "price" => $food_price,
            "qty_total" => $qty_get,
            "tb_id" => $tb_id
        ));
        echo "Product Successfully Added To Cart (Session)\n";
    }
} else { // if already in cart → update quantity
    $qty_exist_in_cart_for_this_product = check_the_qty_single($tb_id);
    $qty_get = $qty_get + $qty_exist_in_cart_for_this_product;

    if (isset($_SESSION['cart'])) {
        $check_product_no_session = check_product_no_session_single($tb_id);
        $b = array(
            "img1" => $food_img,
            "nm" => $food_name,
            "price" => $food_price,
            "qty_total" => $qty_get,
            "tb_id" => $tb_id
        );
        $_SESSION['cart'][$check_product_no_session] = $b;
        echo "Product Quantity Updated in Cart (Session)\n";
    }
}

// ----------------- DATABASE CART LOGIC -----------------
if (isset($_SESSION['id'])) { // only if user logged in
    $user_id = $_SESSION['id'];

    $check = mysqli_query($link, "SELECT * FROM user_cart WHERE user_id='$user_id' AND food_name='$food_name'");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($link, "UPDATE user_cart 
        SET qty = qty + $qty_get 
        WHERE user_id='$user_id' AND food_name='$food_name'");
        echo "Quantity updated in Database Cart!\n";
    } else {
        mysqli_query($link, "INSERT INTO user_cart 
        (user_id, food_name, food_category, food_description, food_price, food_ingredients, food_image, qty) 
        VALUES 
        ('$user_id', '$food_name', '$food_category', '$food_description', '$food_price', '$food_ingredients', '$food_img', '$qty_get')");
        echo "Item added to Database Cart!\n";
    }
}

// ----------------- HELPER FUNCTIONS -----------------
function check_duplicate_product_single($tb_id) {
    $found = 0;
    $max = isset($_SESSION['cart']) ? sizeof($_SESSION['cart']) : 0;
    for ($i = 0; $i < $max; $i++) {
        if (isset($_SESSION['cart'][$i]["tb_id"]) && $_SESSION['cart'][$i]["tb_id"] == $tb_id) {
            $found++;
        }
    }
    return $found;
}

function check_the_qty_single($tb_id) {
    $qty_found = 0;
    if (!isset($_SESSION['cart'])) return 0;
    $max = sizeof($_SESSION['cart']);
    for ($i = 0; $i < $max; $i++) {
        if (isset($_SESSION['cart'][$i]["tb_id"]) && $_SESSION['cart'][$i]["tb_id"] == $tb_id) {
            $qty_found = $_SESSION['cart'][$i]["qty_total"];
        }
    }
    return $qty_found;
}

function check_product_no_session_single($tb_id) {
    $recordno = 0;
    if (!isset($_SESSION['cart'])) return 0;
    $max = sizeof($_SESSION['cart']);
    for ($i = 0; $i < $max; $i++) {
        if (isset($_SESSION['cart'][$i]["tb_id"]) && $_SESSION['cart'][$i]["tb_id"] == $tb_id) {
            $recordno = $i;
        }
    }
    return $recordno;
}
?>
