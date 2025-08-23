<?php
include("../connection.php");
$id=$_GET["id"];
mysqli_query($link,"DELETE FROM food_categories WHERE id=$id");

?>
<script type="text/javascript">
 window.location = "food_category.php";                   
</script>