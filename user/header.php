<?php
if (!isset($_SESSION)) {
    session_start();
}

// Define base URL once
if (!defined("BASE_URL")) {
    // Change "/food_ordering_system/" to match your folder name in localhost
    define("BASE_URL", "/food_ordering_system/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <!-- Stylesheets -->
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/vendors/flat-icon/flaticon.css" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Rev slider css -->
    <link href="<?php echo BASE_URL; ?>assets/vendors/revolution/css/settings.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/vendors/revolution/css/layers.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/vendors/revolution/css/navigation.css" rel="stylesheet">

    <link href="<?php echo BASE_URL; ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/logo-02.png" type="image/x-icon">
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/images/logo-02.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&amp;family=Open+Sans:wght@400;600;700;800&amp;family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body>
    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader"></div>

        <header class="main-header">
            <!--Header Top-->
            <div class="header-top" style="background-color:#f2e39c; color:black">
                <div class="auto-container clearfix">
                    <div class="top-left">
                        <ul class="info-list">
                            <li>
                                <a href="mailto:info@abc.co.in" style="color: black">
                                    <b>InSecond</b>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="top-right clearfix">
                        <ul class="social-box" style="display: flex; align-items: center; gap: 15px; list-style: none; margin: 0; padding: 0;">
                            <li>
                                <a href="#" style="color: black; font-weight: bold;">
                                    <span class="fa fa-user-alt"></span> Hii' 
                                    <?php echo isset($_SESSION["user_username"]) ? $_SESSION["user_username"] : "User"; ?>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo BASE_URL; ?>user/view_cart.php" class="icon flaticon-shopping-cart" style="color: black; position: relative;">
                                    <span class="total-cart" 
                                        style="background-color: #a40301; color:white; border-radius: 50%; padding: 2px 6px; font-size: 12px; position: absolute; top: -8px; right: -10px;">
                                        <?php echo load_cart_data2(); ?>
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo BASE_URL; ?>admin/" 
                                    style="color: black; font-weight: bold; text-decoration: none; padding: 5px 10px; border: 1px solid #a40301; border-radius: 5px; transition: 0.3s;">
                                    Admin
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Header Top -->

			<!-- Header Upper -->
			<div class="header-upper">
				<div class="inner-container">
					<div class="auto-container clearfix">
						<!--Info-->
						<div class="logo-outer">
							<div class="logo" style="margin-top: -20px;"><a href="index-2.html"><img src="assets/images/logo-02.png" alt=""
										title=""></a></div>
						</div>

						<!--Nav Box-->
						<div class="nav-outer clearfix">
							<!-- Main Menu -->
							<nav class="main-menu navbar-expand-md navbar-light">
								<div class="navbar-header">
									<!-- Togg le Button -->
									<button class="navbar-toggler" type="button" data-toggle="collapse"
										data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
										aria-expanded="false" aria-label="Toggle navigation">
										<span class="icon flaticon-menu"></span>
									</button>
								</div>

								<div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
								<ul class="navigation clearfix">
									<li><a href="index.php">Home</a></li>
									<li><a href="gallery.php">Gallery</a></li>
									<li><a href="contact.php">Contact</a></li>

									<li class="current dropdown"><a href="#">User</a>
										<ul>
										<?php if (!isset($_SESSION["user_username"])) { ?>
											<li><a href="Login.php">Login</a></li>
											<li><a href="Register.php">Register</a></li>
										<?php } else { ?>
											<li><a href="edit_profile.php">Edit Profile</a></li>
											<li><a href="view_my_order.php">View Order</a></li>
											<li><a href="logout.php">Logout</a></li>
										<?php } ?>
										</ul>
									</li>
								</ul>
								</div>
							</nav>
							<!-- Main Menu End-->

							<div class="outer-box">
								<div class="order">
									Order Now
									<span><a href="tel:1800-123-4567">1800 123 4567</a></span>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<!--End Header Upper-->

			<!--Sticky Header-->
			<div class="sticky-header">
				<div class="auto-container clearfix">
					<!--Logo-->
					<div class="logo pull-left">
						<a href="index-2.html" class="img-responsive"><img src="assets/images/logo-02.png" alt=""
								title="" height="90" width="90" style="margin-top: -10px;"></a>
					</div>

					<!--Right Col-->
					<div class="right-col pull-right">
						<!-- Main Menu -->
						<nav class="main-menu navbar-expand-md">
							<button class="navbar-toggler" type="button" data-toggle="collapse"
								data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
								aria-expanded="false" aria-label="Toggle navigation">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

							<div class="navbar-collapse collapse clearfix" id="navbarSupportedContent1">
								<ul class="navigation clearfix">
									<li class="current dropdown"><a href="index.php">Home</a>
										
									</li>


									<li><a href="gallery.php">Gallery</a></li>

									<li class="dropdown"><a href="#">User</a>
										<ul>
										<?php if (!isset($_SESSION["user_username"])) { ?>
											<li><a href="Login.php">Login</a></li>
											<li><a href="Register.php">Register</a></li>
										<?php } else { ?>
											<li><a href="edit_profile.php">Edit Profile</a></li>
											<li><a href="view_my_order.php">View Order</a></li>
											<li><a href="logout.php">Logout</a></li>
										<?php } ?>
										</ul>
									</li>
									
									<li><a href="contact.html">Contact</a></li>
								</ul>
							</div>
						</nav><!-- Main Menu End-->
					</div>

				</div>
			</div>
			<!--End Sticky Header-->

		</header>

<?php		
function load_cart_data2()
{
    $count = 0;
    $max = 0;
    if (isset($_SESSION['cart'])) {
        $max = sizeof($_SESSION['cart']);
    }
    for ($i = 0; $i < $max; $i++) {
        if (isset($_SESSION['cart'][$i])) {
            $img1_session = "";
            foreach ($_SESSION['cart'][$i] as $key => $val) {
                if ($key == "img1") {
                    $img1_session = $val;
                }
            }
            if ($img1_session != "" && $img1_session != null) {
                $count = $count + 1;
            }
        }
    }
    return $count;
}
?>
 