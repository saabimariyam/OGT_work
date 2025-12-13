<?php
include("admin_area/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ÉLORÉ — Shop</title>

    <!-- css -->
    <link rel="stylesheet" href="stylepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- Hamburger Icon -->
    <div class="menu-icon" id="menuBtn">
        <i class="fa-solid fa-bars" id="menuIcon"></i>
    </div>

    <!-- logo and navbar -->
    <header class="navbar">
        <a href="index.php" class="logo">ÉLORÉ</a>

        <nav class="navSec" id="navMenu">
            <a href="index.php">Home</a>
            <a class="active" href="shop.php">Shop</a>
            <a href="#">Wishlist</a>
            <a href="#">Cart<sup>0</sup></a>
        </nav>
    </header>

    <!-- shop header -->
    <section class="shop-header">
        <h1>Shop All Products</h1>
        <p>Soft, minimal and aesthetic fashion curated just for you.</p>
        <div class="filters">
            <button class="filter active" data-filter="all">All</button>
            <button class="filter" data-filter="Men">Men</button>
            <button class="filter" data-filter="Women">Women</button>
        </div>

    </section>

    <!-- products -->
    <section class="shop-products">
        <div class="product-grid">

            <?php
            $products = mysqli_query($conn, "
            SELECT products.*, categories.category_title 
            FROM products
            JOIN categories 
            ON products.product_category = categories.category_id
        ");

            while ($p = mysqli_fetch_assoc($products)) {
                echo "
            <div class='product' data-category='{$p['category_title']}'>
                <img src='admin_area/uploads/{$p['product_image1']}'>
                <p>{$p['product_name']}</p>
                <span>₹{$p['product_price']}</span>
            </div>
            ";
            }
            ?>

        </div>
    </section>


    <!-- footer -->
    <footer class="footer">

        <div class="footer-container">
            <div class="about">
                <h1>ÉLORÉ</h1>
                <p>
                    ÉLORÉ is crafted for those who love minimal, premium, and timeless fashion. <br>
                    Our pieces blend Korean aesthetics with modern street style for an effortless look.
                </p>
            </div>

            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="#">Cart</a></li>
                    <li><a href="#">Wishlist</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>My Account</h3>
                <ul>
                    <li><a href="#">My Profile</a></li>
                    <li><a href="#">View Address</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Contact</h3>
                <p><strong>Address :</strong> Kasaragod, Kerala</p>
                <p><strong>Phone :</strong>
                    <a href=""> +91 8891240283</a>
                </p>
                <p><strong>Email :</strong>
                    <a href="#"> eloreclothes@gmail.com</a>
                </p>
            </div>
        </div>

        <div class="social">
            <a href="#"><i class="fa-brands fa-instagram"></i></i></a>
            <a href="#"><i class="fa-brands fa-whatsapp"></i></i></a>
        </div>

        <div class="footer-bottom">
            <p>© 2025 <span class="brand">ÉLORÉ</span> — All Rights Reserved.</p>
            <p class="design">Designed by Sabira</p>
        </div>

    </footer>

    <script>
            const filters = document.querySelectorAll(".filter");
const products = document.querySelectorAll(".product");

filters.forEach(btn => {
    btn.addEventListener("click", () => {

        // remove active from all
        filters.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        const filterValue = btn.dataset.filter;

        products.forEach(product => {
            const category = product.dataset.category;

            if (filterValue === "all" || category === filterValue) {
                product.style.display = "block";
            } else {
                product.style.display = "none";
            }
        });
    });
});

    </script>

    <script src="script.js"></script>

</body>

</html>