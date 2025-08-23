<?php include "header.php";?>
<?php include("../connection.php");?>
		
<title>Register Page</title>
<div class="checkout-page">
            <div class="auto-container">

                <!--Default Links-->


                <!--Billing Details-->
                <div class="billing-details">
                    <div class="shop-form">
                        <form method="POST" action="" name="form1">
                            <div class="row clearfix">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6 col-md-12 col-sm-12" style="border-style: solid; border-width: 1px; border-radius:5px;border-color: #c62904; padding:20px;">

                                    <div class="sec-title">
                                        <h2>Registration Page</h2>
                                    </div>
                                    <div class="billing-inner">
                                        <div class="row clearfix">

                                            <!--Form Group-->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                 <div class="alert alert-success col-md-12" id="success" style="display:none;">
                                                        <strong>Success </strong><span style="color:green;">User Inserted Successfully.</span>
                                                 </div>   
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                 <div class="alert alert-danger col-md-12" id="errmsg" style="display:none;">
                                                        <strong>Invalid </strong><span style="color:red;">the username is already exist</span>
                                                 </div>   
                                            </div>

                                            <!--Form Group-->
                                
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">First Name</div>
                                                <input type="text" name="firstname" value=""
                                                    placeholder="First Name">
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Last Name</div>
                                                <input type="text" name="lastname" value=""
                                                    placeholder="last Name">
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">UserName</div>
                                                <input type="text" name="username" value=""
                                                    placeholder="User Name">
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Password</div>
                                                <input type="password" name="password" value=""
                                                    placeholder="Password">
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Email</div>
                                                <input type="text" name="email" value=""
                                                    placeholder="Email">
                                            </div>
                                           
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Contact Number</div>
                                                <input type="text" name="contact" value=""
                                                    placeholder="Contact Number">
                                            </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Address</div>
                                                <textarea name="address" placeholder="Address"></textarea>
                                            </div>


                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                <button type="submit" class="theme-btn btn-style-five" name="register"><span
                                                        class="txt">Register</span></button>
                                            </div>

                                        </div>
                                    </div>
                                    <ul class="default-links">
                                        <li>New User? <a href="login.php" data-toggle="modal" data-target="#schedule-box" onclick="window.location='login.php';">Click here to
                                           Login</a></li>
                                    </ul>
                                </div>


                            </div>
                        </form>

                    </div>

                </div>
                <!--End Billing Details-->
            </div>
        </div>
	

<?php
        if (isset($_POST["register"])) {
                $username = $_POST['username'];
                $res = mysqli_query($link,"SELECT * FROM user_registration WHERE username='$username'");
                $count = mysqli_num_rows($res);
            
                if ($count > 0) {
                    ?>
                    <script>
                        document.getElementById("errmsg").style.display = "block";
                    </script>
                    <?php
                } else {
                    mysqli_query($link, "INSERT INTO user_registration 
                        (firstname, lastname, username, password, email, contact, address) 
                        VALUES (
                            '{$_POST['firstname']}',
                            '{$_POST['lastname']}',
                            '{$_POST['username']}',
                            '{$_POST['password']}',
                            '{$_POST['email']}',
                            '{$_POST['contact']}',
                            '{$_POST['address']}'
                        )");
                    ?>
                    <script>
                        document.getElementById("success").style.display = "block";
                        setTimeout(function(){
                            window.location = "login.php";
                        }, 500);
                    </script>
                    <?php
                }
            }

?>
<?php 
include "delivery_section.php";
include "service_section.php";
include "footer.php";
?>

