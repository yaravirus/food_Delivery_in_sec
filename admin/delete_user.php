<?php
include("../connection.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($link, "DELETE FROM user_registration WHERE id = $id");
    header("Location: index.php"); // redirect back to your users page
    exit;
}
?>
