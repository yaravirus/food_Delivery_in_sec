<?php
session_start();
include("connection.php");
include("header.php");

$id = intval($_GET["id"]);

$food_name = $food_category = $food_description = $food_original_price = "";
$food_discount_price = $food_availibility = $food_veg_nonveg = $food_ingredients = "";
$food_image="";

$res = mysqli_query($link, "SELECT * FROM food WHERE id = $id");
if ($row = mysqli_fetch_assoc($res)) {
    $food_name          = $row["food_name"];
    $food_category      = $row["food_category"];
    $food_description   = $row["food_description"];
    $food_original_price= $row["food_original_price"];
    $food_discount_price= $row["food_discount_price"];
    $food_availibility  = $row["food_availibility"];
    $food_veg_nonveg    = $row["food_veg_nonveg"];
    $food_ingredients   = $row["food_ingredients"];
    $food_image=$row["food_image"];
}

$successMsg = "";
$errorMsg = "";

if (isset($_POST["submit1"])) {
    // Sanitize inputs
    $food_name           = trim($_POST['food_name']);
    $food_category       = trim($_POST['food_category']);
    $food_description    = trim($_POST['food_description']);
    $food_original_price = trim($_POST['food_original_price']);
    $food_discount_price = trim($_POST['food_discount_price']);
    $food_veg_nonveg     = trim($_POST['food_type']); // Veg or NonVeg
    $food_availibility   = trim($_POST['food_availability']);

    if (isset($_SESSION["image_name01"])) {
        $src  = 'temp_photo/' . $_SESSION["image_name01"];
        $dst1 = "images/" . $_SESSION["image_name01"];
    
        if (file_exists($src)) {
            copy($src, $dst1);
        }
    
        // Update image safely
        $stmtImg = $link->prepare("UPDATE food SET food_image = ? WHERE id = ?");
        $stmtImg->bind_param("si", $dst1, $id);
        $stmtImg->execute();
        $stmtImg->close();
    
        $food_image = $dst1; // update local variable so form shows new image
        unset($_SESSION["image_name01"]);
    }
    $ingredients         = isset($_POST['ingredients']) ? implode(", ", $_POST['ingredients']) : "";

    // Check if another food with same name exists
    $stmt = $link->prepare("SELECT id FROM food WHERE food_name = ? AND id != ?");
    $stmt->bind_param("si", $food_name, $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $errorMsg = "Duplicate Food Found!";
    } else {
        // Update food item
        $updateStmt = $link->prepare("
            UPDATE food SET
                food_name = ?,
                food_category = ?,
                food_description = ?,
                food_original_price = ?,
                food_discount_price = ?,
                food_availibility = ?,
                food_veg_nonveg = ?,
                food_ingredients = ?
            WHERE id = ?
        ");
        $updateStmt->bind_param(
            "ssssssssi",
            $food_name,
            $food_category,
            $food_description,
            $food_original_price,
            $food_discount_price,
            $food_availibility,
            $food_veg_nonveg,
            $ingredients,
            $id
        );

        if ($updateStmt->execute()) {
            $successMsg = "Food Updated Successfully!";
        } else {
            $errorMsg = "Error updating food.";
        }
        $updateStmt->close();
    }
    $stmt->close();
}
?>
<link rel="stylesheet" href="cropping_css/croppie.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Edit Food</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Edit Food</strong>
                </div>
                <div class="card-body">
                    <?php if ($successMsg): ?>
                        <div class="alert alert-success" id="success-alert"><?= $successMsg ?></div>
                        <script>
                                setTimeout(function() {
                                let alertBox = document.getElementById('success-alert');
                                if (alertBox) {
                                        alertBox.style.transition = "opacity 0.5s ease";
                                        alertBox.style.opacity = "0";
                                        setTimeout(() => {
                                        alertBox.remove();
                                        window.location.href = "display_food.php";
                                        }, 500); // Wait for fade-out before redirect
                                }
                                }, 2000); // Show success for 2 seconds
                        </script>
                        <?php endif; ?>

                    <?php if ($errorMsg): ?>
                        <div class="alert alert-danger" id="error-alert"><?= $errorMsg ?></div>
                        <script>
                            setTimeout(function() {
                                let alertBox = document.getElementById('error-alert');
                                if (alertBox) {
                                    alertBox.style.transition = "opacity 0.5s ease";
                                    alertBox.style.opacity = "0";
                                    setTimeout(() => alertBox.remove(), 500);
                                }
                            }, 1000);
                        </script>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="form-group">
                                <div id="uploaded_image" style="cursor: pointer"
                                    onclick="document.getElementById('upload_image').click();">
                                    <img src="<?php if($food_image!=""){echo $food_image;} else{?> admin.jpg <?php } ?>" id="image1" height="100" width="100">
                                </div>
                                <input type="file" name="upload_image" id="upload_image" style="display:none;" >
                        </div>
                        <div class="form-group">
                            <label>Food Name</label>
                            <input name="food_name" type="text" class="form-control" required value="<?= htmlspecialchars($food_name) ?>">
                        </div>

                        <div class="form-group">
                            <label>Food Category</label>
                            <select name="food_category" class="form-control">
                                <?php
                                $res = mysqli_query($link, "SELECT * FROM food_categories ORDER BY food_category ASC");
                                while ($cat = mysqli_fetch_assoc($res)) {
                                    $selected = ($food_category == $cat["food_category"]) ? 'selected' : '';
                                    echo '<option value="' . htmlspecialchars($cat["food_category"]) . '" ' . $selected . '>' . htmlspecialchars($cat["food_category"]) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Food Description</label>
                            <textarea name="food_description" class="form-control"><?= htmlspecialchars($food_description) ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Food Original Price</label>
                            <input name="food_original_price" type="number" step="0.01" class="form-control" required value="<?= htmlspecialchars($food_original_price) ?>">
                        </div>

                        <div class="form-group">
                            <label>Food Discount Price</label>
                            <input name="food_discount_price" type="number" step="0.01" class="form-control" required value="<?= htmlspecialchars($food_discount_price) ?>">
                        </div>

                        <div class="form-group">
                            <label>Food Veg / NonVeg</label>
                            <select name="food_type" class="form-control">
                                <option value="Veg" <?= ($food_veg_nonveg == "Veg") ? 'selected' : '' ?>>Veg</option>
                                <option value="NonVeg" <?= ($food_veg_nonveg == "NonVeg") ? 'selected' : '' ?>>NonVeg</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Availability</label>
                            <select name="food_availability" class="form-control">
                                <option value="Yes" <?= ($food_availibility == "Yes") ? 'selected' : '' ?>>Yes</option>
                                <option value="No" <?= ($food_availibility == "No") ? 'selected' : '' ?>>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ingredients</label>
                            <div class="row">
                                <?php
                                $selectedIngredients = array_map('trim', explode(',', $food_ingredients));
                                $res = mysqli_query($link, "SELECT * FROM food_ingredients ORDER BY food_ingredient ASC");
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $ingredient = $row["food_ingredient"];
                                    $isChecked = in_array($ingredient, $selectedIngredients) ? 'checked' : '';
                                    echo '<div class="col-lg-4">
                                            <label>
                                                <input type="checkbox" name="ingredients[]" value="' . htmlspecialchars($ingredient) . '" ' . $isChecked . '> ' . htmlspecialchars($ingredient) . '
                                            </label>
                                          </div>';
                                }
                                ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-lg btn-info btn-block" name="submit1">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog" style="width:auto">
        <div class="modal-content" style="width: 1000px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload & Crop Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" style="width:350px;"></div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-success crop_image">Crop & Upload Image</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $image_crop = $('#image_demo').croppie({
            enforceBoundary: false,
            enableOrientation: true,
            viewport: {
                width: 270,
                height: 230,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 250
            }
        });

        $('#upload_image').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function (event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "crop_and_upload01.php",
                    type: "POST",
                    data: {"image": response},
                    success: function (data) {
                        $('#uploadimageModal').modal('hide');
                        $('#uploaded_image').html(data);
                    }
                });
            })
        });
    });
</script>

<script src="cropping_js/bootstrap.min.js"></script>
<script src="cropping_js/croppie.js"></script>
<script src="cropping_js/exif.js"></script>

<?php include("footer.php"); ?>
