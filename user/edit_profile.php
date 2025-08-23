<?php
session_start();
?>

<?php include "header.php";
include("../connection.php");
?>
<?php
        $firstname="";
        $lastname="";
        $username="";
        $email="";
        $password="";
        $contact="";
        $address="";
        
      
        $res=mysqli_query($link,"select * from user_registration where username='$_SESSION[user_username]'");
        while($row=mysqli_fetch_array($res))
        {
            $firstname=$row["firstname"];
            $lastname=$row["lastname"];
            $username=$row["username"];
            $email=$row["email"];
            $password=$row["password"];
            $contact=$row["contact"];
            $address=$row["address"];
        }
?>
<title>Edit Profile Page</title>
<section class="products-section">
        <div class="auto-container">

                <div class="sec-title centered">
                        <h2>Edit Profile</h2>
                </div>
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
                                                                <div class="col-lg-6 col-md-12 col-sm-12"
                                                                        style="border-style: solid; border-width: 1px; border-radius:5px;border-color: #c62904; padding:20px;">

                                                                        <div class="sec-title">
                                                                                <h2>Edit Profile Page</h2>
                                                                        </div>
                                                                        <div class="billing-inner">
                                                                                <div class="row clearfix">

                                                                                        <!--Form Group-->
                                                                                        <div
                                                                                                class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                                                <div class="alert alert-success col-md-12"
                                                                                                        id="success"
                                                                                                        style="display:none;">
                                                                                                        <strong>Success
                                                                                                        </strong><span
                                                                                                                style="color:green;">User
                                                                                                                Inserted
                                                                                                                Successfully.</span>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div
                                                                                                class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                                                <div class="alert alert-danger col-md-12"
                                                                                                        id="errmsg"
                                                                                                        style="display:none;">
                                                                                                        <strong>Invalid
                                                                                                        </strong><span
                                                                                                                style="color:red;">the
                                                                                                                username
                                                                                                                is
                                                                                                                already
                                                                                                                exist</span>
                                                                                                </div>
                                                                                        </div>

                                                                                        <!--Form Group-->

                                                                                        <div
                                                                                                class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                                                <div
                                                                                                        class="field-label">
                                                                                                        First Name</div>
                                                                                                <input type="text"
                                                                                                        name="firstname"
                                                                                                        value="<?php echo $firstname ?>"
                                                                                                        placeholder="First Name">
                                                                                        </div>
                                                                                        <div
                                                                                                class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                                                <div
                                                                                                        class="field-label">
                                                                                                        Last Name</div>
                                                                                                <input type="text"
                                                                                                        name="lastname"
                                                                                                        value="<?php echo $lastname ?>"
                                                                                                        placeholder="last Name">
                                                                                        </div>
                                                                                        <div
                                                                                                class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                                                <div
                                                                                                        class="field-label">
                                                                                                        UserName</div>
                                                                                                <input type="text"
                                                                                                        name="username"
                                                                                                        value="<?php echo $username ?>"
                                                                                                        placeholder="User Name">
                                                                                        </div>
                                                                                        <div
                                                                                                class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                                                <div
                                                                                                        class="field-label">
                                                                                                        Password</div>
                                                                                                <input type="text"
                                                                                                        name="password"
                                                                                                        value="<?php echo $password ?>"
                                                                                                        placeholder="Password">
                                                                                        </div>
                                                                                        <div
                                                                                                class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                                                <div
                                                                                                        class="field-label">
                                                                                                        Email</div>
                                                                                                <input type="text"
                                                                                                        name="email"
                                                                                                        value="<?php echo $email ?>"
                                                                                                        placeholder="Email">
                                                                                        </div>

                                                                                        <div
                                                                                                class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                                                <div
                                                                                                        class="field-label">
                                                                                                        Contact Number
                                                                                                </div>
                                                                                                <input type="text"
                                                                                                        name="contact"
                                                                                                        value="<?php echo $contact ?>"
                                                                                                        placeholder="Contact Number">
                                                                                        </div>

                                                                                        <!--Form Group-->
                                                                                        <div
                                                                                                class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                                                <div
                                                                                                        class="field-label">
                                                                                                        Address</div>
                                                                                                <textarea name="address"
                                                                                                        placeholder="Address"><?php echo $address ?></textarea>
                                                                                        </div>


                                                                                        <div
                                                                                                class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                                <button type="submit"
                                                                                                        class="theme-btn btn-style-five"
                                                                                                        name="update"><span
                                                                                                                class="txt">Update</span></button>
                                                                                        </div>

                                                                                </div>
                                                                        </div>
                                                                      
                                                                </div>


                                                        </div>
                                                </form>

                                        </div>

                                </div>
                                <!--End Billing Details-->
                        </div>
                </div>



        </div>
</section>

<?php

    if (isset($_POST["update"])) {
        $firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
        $lastname  = mysqli_real_escape_string($link, $_POST["lastname"]);
        $username  = mysqli_real_escape_string($link, $_POST["username"]);
        $password  = mysqli_real_escape_string($link, $_POST["password"]);
        $email     = mysqli_real_escape_string($link, $_POST["email"]);
        $contact   = mysqli_real_escape_string($link, $_POST["contact"]);
        $address   = mysqli_real_escape_string($link, $_POST["address"]);
    
        // Update query
        $update_query = "UPDATE user_registration 
                            SET firstname='$firstname',
                                lastname='$lastname',
                                username='$username',
                                password='$password',
                                email='$email',
                                contact='$contact',
                                address='$address'
                          WHERE username='$_SESSION[user_username]'";
    
        if (mysqli_query($link, $update_query)) {
            // Update session username if changed
            $_SESSION["user_username"] = $username;
    
            echo "<script>
                    alert('Profile updated successfully!');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error updating profile: " . mysqli_error($link) . "');
                  </script>";
        }
    }


?>
<?php 
include "delivery_section.php";
include "service_section.php";
include "footer.php";
?>