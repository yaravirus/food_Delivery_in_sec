<?php
if(!isset($_SESSION)){
        session_start();
}

?>

<?php include "header.php";?>
<?php include "../admin/connection.php";
$id = $_GET["id"];

$full_name = "";
$contact_number = "";
$order_date = "";
$email = "";
$order_type = "";
$order_status = "";
$order_number = "";
$address = "";

// run query
$res = mysqli_query($link, "SELECT * FROM order_main WHERE id='$id'");

// since ID is unique, no need for while loop, use if
if ($row = mysqli_fetch_array($res)) {
    $full_name = $row["user_firstname"] . " " . $row["user_lastname"];
    $contact_number = $row["user_contact"];
    $order_date = $row["order_date"] . " " . $row["order_time"];
    $email = $row["user_email"];
    $order_type = $row["order_type"];
    $order_status = $row["order_status"];
    $order_number = $row["order_number"];
    $address = $row["order_address"]; // make sure column name matches DB
}

?>
		

<section class="products-section">
    <div class="auto-container">

        <div class="sec-title centered">
            <h2>Order Details</h2>
        </div>
                <div class="row" style="margin-top: 10px">
        <div class="col-lg-6">
                Customer Name: <?php echo $full_name; ?><br>
                Contact No: <?php echo $contact_number; ?><br>
                Order Date: <?php echo $order_date; ?><br>
                Email: <?php echo $email; ?><br>
                Address: <?php echo $address; ?>
        </div>

        <div class="col-lg-6" style="text-align: right">
                Order Number: <?php echo $order_number; ?><br>
                Order Type: <?php echo $order_type; ?><br>
                Order Status: <?php echo $order_status; ?>
        </div>
        </div>
        <div class="billing-inner" style="margin-top: 10px;">
        <table class="table table-bordered" style="margin-top: 50px">
                        <tr style="background-color:#a41a13;color:white;">
                                <th>Sr No.</th>
                                <th>Image</th>
                                <th>Food Name</th>
                                <th>Food Category</th>
                                <th>Food Description</th>
                                <th>Food Ingredients</th>
                                <th>Food Price</th>
                                <th>Food Qty</th>
                                <th>Veg/Non Veg</th>
                        </tr>

                        <?php
                        $srno = 0;
                        $tot = 0;

                        $res = mysqli_query($link, "select * from order_details where order_id=$id");
                        while ($row = mysqli_fetch_array($res)) {
                        $srno = $srno + 1;
                        echo "<tr>";
                        echo "<td>" . $srno . "</td>";
                        echo "<td><img src='../admin/" . $row["food_image"] . "' height='100' width='100'></td>";
                        echo "<td>" . $row["food_name"] . "</td>";
                        echo "<td>" . $row["food_category"] . "</td>";
                        echo "<td>" . $row["food_description"] . "</td>";
                        echo "<td>" . $row["food_ingredients"] . "</td>";
                        echo "<td>$" . $row["food_discount_price"] . "</td>";
                        echo "<td>" . $row["food_qty"] . "</td>";
                        echo "<td>" . $row["food_veg_nonveg"] . "</td>";
                        echo "</tr>";

                        $tot = $tot + ($row["food_discount_price"] * $row["food_qty"]);
                        }

                        ?>
                </table>

                <div style="float:right;">
                        Total:$<?php echo $tot; ?>
                </div>

        </div>
       
    </div>
</section>
	
<?php 
include "delivery_section.php";
include "service_section.php";
include "footer.php";
?>