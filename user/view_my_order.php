<?php
if(!isset($_SESSION)){
        session_start();
}

?>
<?php 
include "../admin/connection.php";
include "header.php";
?>
<title>My Order</title>


<section class="products-section">
        <div class="auto-container">

                <div class="sec-title centered">
                        <h2>My Order</h2>
                </div>
                <table class="table table-bordered">
                        <tr style="background-color:#a41a13;color:white;">
                                <th>Sr No.</th>
                                <th>Order Number</th>
                                <th>Order Date</th>
                                <th>Order Time</th>
                                <th>Order Address</th>
                                <th>Order Type</th>
                                <th>Order Status</th>
                                <th>Order Details</th>
                        </tr>

                        <?php
                        // initialize counter
                        $srno = 0;

                        // fetch orders for logged-in user
                        $res = mysqli_query(
                                $link,
                                "SELECT * FROM order_main 
                                WHERE order_username='" . $_SESSION['user_username'] . "' 
                                ORDER BY id DESC"
                        );
                        // $srno=mysqli_num_rows($res);
                        // loop through all orders
                        while ($row = mysqli_fetch_assoc($res)) {
                                $srno++;
                                echo "<tr>";
                                echo "<td>" . $srno . "</td>";
                                echo "<td>" . $row['order_number'] . "</td>";
                                echo "<td>" . $row['order_date'] . "</td>";
                                echo "<td>" . $row['order_time'] . "</td>";
                                echo "<td>" . $row['order_address'] . "</td>";
                                echo "<td>" . $row['order_type'] . "</td>";
                                echo "<td>" . $row['order_status'] . "</td>";
                                echo "<td><a href='order_detail.php?id=" . $row['id'] . "'>Order Details</a></td>";
                                echo "</tr>";
                        }
                        ?>
                </table>

</section>

<?php 
include "delivery_section.php";
include "service_section.php";
include "footer.php";
?>