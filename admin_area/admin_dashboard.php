<?php
include ("connect.php");

// total products
$products = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));

// new arrivals
$new_arrivals = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM new_arrivals"));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_stylepage.css">
</head>

<body>

    <!-- sidebar -->
    <div class="sidebar">
        <h2 class="logo">ÉLORÉ</h2>

        <a class="active">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="#">Orders</a>
        <a href="#">Users</a>
        <a href="insert_categories.php">Insert Categories</a>
        <a href="add_products.php">Add Product</a>
        <a href="add_new_arrivals.php">Add New Arrivals</a>

    </div>

    <!-- content -->
    <div class="main">
        <h1>Dashboard Overview</h1>

        <div class="cards">

            <div class="card">
                <h3>Total Products</h3>
                <p><?php echo $products ?></p>
            </div>

            <div class="card">
                <h3>New Arrivals</h3>
                <p><?php echo $new_arrivals ?></p>
            </div>

            <div class="card">
                <h3>Total Orders</h3>

            </div>

            <div class="card">
                <h3>Total Users</h3>
            </div>

        </div>
    </div>

</body>
</html>