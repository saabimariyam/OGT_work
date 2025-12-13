<?php
include("connect.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>All Products</title>
    <link rel="stylesheet" href="admin_stylepage.css">
</head>

<body>
    <!-- sidebar -->
    <div class="sidebar">
        <h2 class="logo">ÉLORÉ</h2>

        <a href="admin_dashboard.php">Dashboard</a>
        <a class="active">Products</a>
        <a href="#">Orders</a>
        <a href="#">Users</a>
        <a href="insert_categories.php">Insert Categories</a>
        <a href="add_products.php">Add Product</a>
        <a href="add_new_arrivals.php">Add New Arrivals</a>

    </div>

    <!-- content -->
    <div class="content">
        <h1>All Products</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Images</th>
                <th>Category</th>
                <th>Name</th>
                <th>Description</th>
                <th>Sizes</th>
                <th>Price</th>
                <th>Type</th>
                <th style="width:160px;">Actions</th>
            </tr>

            <!-- shop products -->
            <?php
            $products = mysqli_query($conn, "
        SELECT products.*, categories.category_title 
        FROM products
        LEFT JOIN categories
        ON products.product_category = categories.category_id
    ");

            while ($p = mysqli_fetch_assoc($products)) {
                echo "
        <tr>
            <td>{$p['product_id']}</td>

            <td>
                <img src='../admin_area/uploads/{$p['product_image1']}' width='55' style='margin-right:5px; border-radius:6px;'>
                " . (!empty($p['product_image2']) ? "<img src='../admin_area/uploads/{$p['product_image2']}' width='55' style='margin-right:5px; border-radius:6px;'>" : "") . "
                " . (!empty($p['product_image3']) ? "<img src='../admin_area/uploads/{$p['product_image3']}' width='55' style='border-radius:6px;'>" : "") . "
            </td>

            <td>{$p['category_title']}</td>
            <td>{$p['product_name']}</td>

            <td>{$p['product_description']}</td>
            <td>{$p['product_sizes']}</td>

            <td>₹{$p['product_price']}</td>
            <td>Shop Product</td>

            <td>
                <a href='edit_products.php?id={$p['product_id']}' class='edit-btn'>Edit</a>
                <a href='delete_products.php?id={$p['product_id']}' class='delete-btn'
                onclick=\"return confirm('Delete this product?');\">Delete</a>
            </td>
        </tr>";
            }
            ?>

            <!-- new arrivals -->
            <?php
            $new_arrivals = mysqli_query($conn, "
        SELECT new_arrivals.*, categories.category_title 
        FROM new_arrivals
        LEFT JOIN categories
        ON new_arrivals.product_category = categories.category_id
    ");

            while ($n = mysqli_fetch_assoc($new_arrivals)) {

                echo "
    <tr style='background:#f2f2f9'>
        <td>{$n['product_id']}</td>

        <td>
            <img src='../admin_area/uploads/{$n['product_image1']}' width='55' style='margin-right:5px; border-radius:6px;'>
            " . (!empty($n['product_image2']) ? "<img src='../admin_area/uploads/{$n['product_image2']}' width='55' style='margin-right:5px; border-radius:6px;'>" : "") . "
            " . (!empty($n['product_image3']) ? "<img src='../admin_area/uploads/{$n['product_image3']}' width='55' style='border-radius:6px;'>" : "") . "
        </td>

        <td>{$n['category_title']}</td>
        <td>{$n['product_name']}</td>
        <td>{$n['product_description']}</td>
        <td>{$n['product_sizes']}</td>

        <td>₹{$n['product_price']}</td>

        <td style='font-weight:500'>New Arrival</td>

        <td>
            <a href='edit_new_arrivals.php?id={$n['product_id']}' class='edit-btn'>Edit</a>
            <a href='delete_new_arrivals.php?id={$n['product_id']}' class='delete-btn'
            onclick=\"return confirm('Delete this New Arrival item?');\">Delete</a>
        </td>
    </tr>";
            }

            ?>
        </table>

    </div>

</body>

</html>