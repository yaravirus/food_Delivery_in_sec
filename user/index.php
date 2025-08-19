<?php 
include "header.php";
include "slider.php";
include "../admin/connection.php"; 
?>
<title>Home Page</title>

<section class="products-section">
    <div class="auto-container">

        <div class="sec-title centered">
            <h2>Our Products</h2>
        </div>

        <div class="mixitup-gallery">

            <!-- Filter -->
            <div class="filters clearfix">
                <ul class="filter-tabs filter-btns clearfix">
                    <li class="active filter" data-role="button" data-filter="all">All</li>
                    <?php
                    $res = mysqli_query($link,"SELECT * FROM food_categories");  
                    while($row = mysqli_fetch_assoc($res)){
                        $data_filter = ".".$row["food_category"];
                        echo '<li class="filter" data-role="button" data-filter="'.$data_filter.'">'.$row["food_category"].'</li>';
                    } 
                    ?>
                </ul>
            </div>
            
            <div class="filter-list row clearfix">
                <?php
                $res = mysqli_query($link,"SELECT * FROM food");
                while($row = mysqli_fetch_assoc($res)){
                    ?>
                    <div class="product-block all mix <?php echo $row["food_category"];?> col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="../admin/<?php echo $row["food_image"]; ?>" alt="">
                            </figure>
                            <div class="lower-content">
                                <h4><a href="food_description.php?id=<?php echo $row["id"];?>"><?php echo $row["food_name"]; ?></a></h4>
                                <div class="text"><?php echo $row["food_description"];?></div>
                                <div class="price">₹<?php echo $row["food_discount_price"];?></div>
                                <div class="lower-box">
                                    <a href="food_description.php?id=<?php echo $row["id"];?>" class="theme-btn btn-style-five">
                                        <span class="txt">Order Now</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>         
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php 
include "delivery_section.php";
include "service_section.php";
include "footer.php";
?>
