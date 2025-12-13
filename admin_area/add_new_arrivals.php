<?php
include("connect.php");

// insert new arrivals
if (isset($_POST['add_new_arrival'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];

    // description
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);

    // multiple sizes
    if (!empty($_POST['product_sizes'])) {
        $product_sizes = implode(",", $_POST['product_sizes']);
    } else {
        $product_sizes = "";
    }

    // 3 images 
    $image1 = $_FILES['product_image1']['name'];
    $tmp1 = $_FILES['product_image1']['tmp_name'];

    $image2 = $_FILES['product_image2']['name'];
    $tmp2 = $_FILES['product_image2']['tmp_name'];

    $image3 = $_FILES['product_image3']['name'];
    $tmp3 = $_FILES['product_image3']['tmp_name'];

    // select category
    if ($product_category == "") {
        echo "<script>alert('Please select a category!')</script>";
        exit();
    }

    // upload images
    move_uploaded_file($tmp1, "../admin_area/uploads/$image1");
    move_uploaded_file($tmp2, "../admin_area/uploads/$image2");
    move_uploaded_file($tmp3, "../admin_area/uploads/$image3");

    // insert querry 
    $insert_query = "
        INSERT INTO new_arrivals
        (product_name, product_price, product_category, product_image1, product_image2, product_image3, product_description, product_sizes)
        VALUES 
        ('$product_name', '$product_price', '$product_category', '$image1', '$image2', '$image3', '$product_description', '$product_sizes')
    ";


    $result = mysqli_query($conn, $insert_query);
    if ($result) {
        echo "<script>alert('Product added successfully!')</script>";
        echo "<script>window.location.href='products.php'</script>";
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add New Arrivals</title>
    <link rel="stylesheet" href="admin_stylepage.css">
</head>

<body>

    <!-- sidebar -->
    <div class="sidebar">
        <h2 class="logo">ÉLORÉ</h2>

        <a href="admin_dashboard.php">Dashboard</a>
        <a href="#">Products</a>
        <a href="#">Orders</a>
        <a href="#">Users</a>
        <a href="insert_categories.php">Insert Categories</a>
        <a href="add_products.php">Add Product</a>
        <a class="active">Add New Arrivals</a>

    </div>
    <div class="content">
        <h1>Add New Arrivals</h1>

        <form action="" method="post" enctype="multipart/form-data" class="add-form">

            <!-- name + price -->
            <div class="form-row">
                <input type="text" name="product_name" placeholder="Product Name" required>
                <input type="text" name="product_price" placeholder="Price" required>
            </div>

            <!-- category -->
            <div class="form-row">
                <select name="product_category" required>
                    <option value="">Select Category</option>
                    <?php
                    $cat = mysqli_query($conn, "SELECT * FROM categories");
                    while ($c = mysqli_fetch_assoc($cat)) {
                        echo "<option value='{$c['category_id']}'>{$c['category_title']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- multiple sizes -->
            <div class="form-row">
                <select name="product_sizes[]" multiple size="5" style="height:120px;">
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="Free Size">Free Size</option>
                </select>
            </div>

            <!-- description -->
            <div class="desc-row">
                <textarea name="product_description" placeholder="Enter Product Description..." required></textarea>
            </div>

            <!-- 3 image uploads -->
            <div class="file-row">
                <label class="upload-btn">
                    <input type="file" name="product_image1" required>
                    Upload Main Image
                </label>

                <label class="upload-btn">
                    <input type="file" name="product_image2">
                    Upload Second Image
                </label>

                <label class="upload-btn">
                    <input type="file" name="product_image3">
                    Upload Third Image
                </label>
            </div>

            <!-- submit -->
            <button type="submit" name="add_new_arrival" class="submit-btn">
                Add New Arrival
            </button>

        </form>
    </div>

</body>

</html>