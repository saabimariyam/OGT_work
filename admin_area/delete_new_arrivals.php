<?php
include("connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // First get images (to delete from folder)
    $get = mysqli_query($conn, "SELECT product_image1, product_image2, product_image3 FROM new_arrivals WHERE product_id = $id");
    $row = mysqli_fetch_assoc($get);

    $img1 = $row['product_image1'];
    $img2 = $row['product_image2'];
    $img3 = $row['product_image3'];

    // Delete images from uploads folder
    if (file_exists("../admin_area/uploads/$img1")) unlink("../admin_area/uploads/$img1");
    if (file_exists("../admin_area/uploads/$img2")) unlink("../admin_area/uploads/$img2");
    if (file_exists("../admin_area/uploads/$img3")) unlink("../admin_area/uploads/$img3");

    // Delete product record
    $delete = mysqli_query($conn, "DELETE FROM new_arrivals WHERE product_id = $id");

    if ($delete) {
        echo "<script>alert('New Arrival Deleted Successfully!');</script>";
        echo "<script>window.location.href='products.php'</script>";
    } else {
        echo "<script>alert('Error deleting product');</script>";
    }
}
