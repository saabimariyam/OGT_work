<?php
include("connect.php");

// insert categories
if (isset($_POST['insert_cat'])) {

    $category_title = $_POST['cat_title'];

    // check category already exit
    $select_query = "SELECT * FROM categories WHERE category_title = '$category_title'";
    $result_select = mysqli_query($conn, $select_query);

    if (mysqli_num_rows($result_select) > 0) {
        echo "<script>alert('Category already exists!')</script>";
    } else {

        // insert
        $insert_query = "INSERT INTO categories (category_title) VALUES ('$category_title')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            echo "<script>alert('Category added successfully!')</script>";
            echo "<script>window.location.href='insert_categories.php'</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Insert Categories</title>
    <link rel="stylesheet" href="admin_stylepage.css">
</head>

<body>

    <!-- sidebar -->
    <div class="sidebar">
        <h2 class="logo">ÉLORÉ</h2>

        <a href="admin_dashboard.php">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="orders.php">Orders</a>
        <a href="users.php">Users</a>
        <a class="active">Insert Categories</a>
        <a href="add_products.php">Add Product</a>
        <a href="add_new_arrivals.php">Add New Arrivals</a>

    </div>

    <!-- content -->
    <div class="content">

        <h1>Add New Category</h1>
        <form action="" method="post" class="category-form">

            <div class="input-box">
                <label>Category Name</label>
                <div class="input-field">
                    <input type="text" name="cat_title" placeholder="Enter category name" required>
                </div>
            </div>

            <button type="submit" name="insert_cat" class="submit-btn">
                Add Category
            </button>

        </form>
    </div>


</body>

</html>