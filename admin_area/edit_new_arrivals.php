<?php
include("connect.php");

// fetch new arrival
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $fetch = mysqli_query($conn, "SELECT * FROM new_arrivals WHERE product_id = $id");
    $row = mysqli_fetch_assoc($fetch);

    if (!$row) {
        die("New Arrival not found!");
    }

    // store old images
    $old1 = $row['product_image1'];
    $old2 = $row['product_image2'];
    $old3 = $row['product_image3'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit New Arrival</title>
    <link rel="stylesheet" href="admin_stylepage.css">
</head>

<body>

    <div class="content">

        <div class="edit-container">

            <h2>Edit New Arrival</h2>

            <form action="" method="post" enctype="multipart/form-data">

                <!-- name + price -->
                <div class="edit-row">
                    <input type="text" name="product_name" value="<?= $row['product_name']; ?>" required>
                    <input type="text" name="product_price" value="<?= $row['product_price']; ?>" required>
                </div>

                <!-- category -->
                <div class="edit-row">
                    <select name="product_category" required>
                        <option value="">Select Category</option>
                        <?php
                        $cat = mysqli_query($conn, "SELECT * FROM categories");
                        while ($c = mysqli_fetch_assoc($cat)) {
                            $sel = ($row['product_category'] == $c['category_id']) ? "selected" : "";
                            echo "<option value='{$c['category_id']}' $sel>{$c['category_title']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- sizes -->
                <div class="edit-row">
                    <?php $sizes = explode(",", $row['product_sizes']); ?>
                    <select name="product_sizes[]" multiple size="5">
                        <?php
                        $all_sizes = ["S", "M", "L", "XL", "Free Size"];
                        foreach ($all_sizes as $s) {
                            $sel = in_array($s, $sizes) ? "selected" : "";
                            echo "<option value='$s' $sel>$s</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- description -->
                <textarea name="product_description"><?= $row['product_description']; ?></textarea>

                <!-- current images -->
                <h3>Current Images</h3>
                <div class="edit-images">
                    <img src="../admin_area/uploads/<?= $old1 ?>">
                    <img src="../admin_area/uploads/<?= $old2 ?>">
                    <img src="../admin_area/uploads/<?= $old3 ?>">
                </div>

                <!-- NEW IMAGE UPLOADS -->
                <h3>Upload New Images (optional)</h3>
                <div class="file-upload">
                    <label>Image 1<input type="file" name="product_image1"></label>
                    <label>Image 2<input type="file" name="product_image2"></label>
                    <label>Image 3<input type="file" name="product_image3"></label>
                </div>

                <button type="submit" name="update" class="update-btn">Update New Arrival</button>

                <a href="products.php" class="cancel-btn">Cancel</a>

            </form>

        </div>

    </div>
</body>

</html>


<?php
// update new arrival
if (isset($_POST['update'])) {

    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $category = $_POST['product_category'];
    $desc = mysqli_real_escape_string($conn, $_POST['product_description']);

    $sizes = implode(",", $_POST['product_sizes']);

    // new images
    $img1 = $_FILES['product_image1']['name'];
    $img2 = $_FILES['product_image2']['name'];
    $img3 = $_FILES['product_image3']['name'];

    // if empty keep old images
    if ($img1 == "") $img1 = $old1;
    else move_uploaded_file($_FILES['product_image1']['tmp_name'], "../admin_area/uploads/$img1");

    if ($img2 == "") $img2 = $old2;
    else move_uploaded_file($_FILES['product_image2']['tmp_name'], "../admin_area/uploads/$img2");

    if ($img3 == "") $img3 = $old3;
    else move_uploaded_file($_FILES['product_image3']['tmp_name'], "../admin_area/uploads/$img3");

    // update query
    $update = mysqli_query($conn, "
        UPDATE new_arrivals SET
            product_name='$name',
            product_price='$price',
            product_category='$category',
            product_description='$desc',
            product_sizes='$sizes',
            product_image1='$img1',
            product_image2='$img2',
            product_image3='$img3'
        WHERE product_id=$id
    ");

    if ($update) {
        echo "<script>alert('New Arrival Updated Successfully!');</script>";
        echo "<script>window.location.href='products.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>