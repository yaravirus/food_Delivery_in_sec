<?php
session_start();
include("../connection.php");
include("header.php");

$successMsg = "";
$errorMsg   = "";

if (isset($_POST["submit1"])) {
    // Sanitize inputs
    $food_name           = trim($_POST['food_name']);
    $food_category       = trim($_POST['food_category']);
    $food_description    = trim($_POST['food_description']);
    $food_original_price = trim($_POST['food_original_price']);
    $food_discount_price = trim($_POST['food_discount_price']);
    $food_type           = trim($_POST['food_type']); // Veg or NonVeg
    $food_availibility   = trim($_POST['food_availability']);

    // Handle image (check if session is set)
    if (!empty($_SESSION["image_name01"])) {
        $src  = 'temp_photo/' . $_SESSION["image_name01"];
        $dst1 = 'images/' . $_SESSION["image_name01"];

        if (file_exists($src)) {
            copy($src, $dst1);
        }
    } else {
        $dst1 = ""; // fallback empty or default image path
    }

    // Ingredients
    $ingredients = isset($_POST['ingredients']) ? implode(", ", $_POST['ingredients']) : "";

    // Check if food already exists
    $stmt = $link->prepare("SELECT id FROM food WHERE food_name = ?");
    $stmt->bind_param("s", $food_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $errorMsg = "Duplicate Food Found!";
    } else {
        // Insert new food item
        $insertStmt = $link->prepare("
            INSERT INTO food (
                food_name,
                food_category,
                food_description,
                food_original_price,
                food_discount_price,
                food_availibility,
                food_veg_nonveg,
                food_ingredients,
                food_image
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        // 9 placeholders → 9 "s"
        $insertStmt->bind_param(
            "sssssssss",
            $food_name,
            $food_category,
            $food_description,
            $food_original_price,
            $food_discount_price,
            $food_availibility,
            $food_type,
            $ingredients,
            $dst1
        );

        if ($insertStmt->execute()) {
            $successMsg = "Food Inserted Successfully!";
        } else {
            $errorMsg = "Error inserting food: " . $insertStmt->error;
        }
        $insertStmt->close();
    }
    $stmt->close();

    // Clear image session
    unset($_SESSION["image_name01"]);
}
?>
<link rel="stylesheet" href="cropping_css/croppie.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Add New Food</h1>
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
                    <strong class="card-title">Add New Food</strong>
                </div>
                <div class="card-body">
                    <?php if ($successMsg): ?>
                        <div class="alert alert-success"><?= $successMsg ?></div>
                    <?php endif; ?>
                    <?php if ($errorMsg): ?>
                        <div class="alert alert-danger"><?= $errorMsg ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="form-group">
                            <div id="uploaded_image" style="cursor: pointer"
                                onclick="document.getElementById('upload_image').click();">
                                <img src="camera.jpg" id="image1" height="100" width="100">
                            </div>
                            <input type="file" name="upload_image" id="upload_image" style="display:none;" required>
                        </div>

                        <div class="form-group">
                            <label>Food Name</label>
                            <input name="food_name" type="text" class="form-control" placeholder="Enter Food Name" required>
                        </div>

                        <div class="form-group">
                            <label>Food Category</label>
                            <select name="food_category" class="form-control">
                                <?php
                                $res = mysqli_query($link, "SELECT * FROM food_categories ORDER BY food_category ASC");
                                while ($row = mysqli_fetch_assoc($res)) {
                                    echo "<option>" . htmlspecialchars($row['food_category']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Food Description</label>
                            <textarea name="food_description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Food Original Price</label>
                            <input name="food_original_price" type="number" step="0.01" class="form-control" placeholder="Enter Food Original Price" required>
                        </div>

                        <div class="form-group">
                            <label>Food Discount Price</label>
                            <input name="food_discount_price" type="number" step="0.01" class="form-control" placeholder="Enter Food Discount Price" required>
                        </div>

                        <div class="form-group">
                            <label>Food Veg / NonVeg</label>
                            <select name="food_type" class="form-control">
                                <option value="Veg">Veg</option>
                                <option value="NonVeg">NonVeg</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Availability</label>
                            <select name="food_availability" class="form-control">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ingredients</label>
                            <div class="row">
                                <?php
                                $res = mysqli_query($link, "SELECT * FROM food_ingredients ORDER BY food_ingredient ASC");
                                while ($row = mysqli_fetch_assoc($res)) {
                                    echo '<div class="col-lg-4">
                                        <label><input type="checkbox" name="ingredients[]" value="' . htmlspecialchars($row["food_ingredient"]) . '"> ' . htmlspecialchars($row["food_ingredient"]) . '</label>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-lg btn-info btn-block" name="submit1">
                            Submit
                        </button>
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
