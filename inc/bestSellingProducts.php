<?php
require_once '../config/config.php'; // Include database connection and session config


if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

// Prepare SQL query to fetch products where type is 'bestsellingproducts'
$query = "SELECT * FROM products WHERE type = 'bestsellingproducts'";
$stmt = $conn->prepare($query);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all matching products
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive settings -->
    <title>Document</title>
    <link rel="stylesheet" href="../display/css/bestSellingProducts.css"> <!-- External CSS -->
</head>
<body>

    <!-- Header for the "This Month" section -->
    <div id="todays-header">
        <div id="todaysBox">
            <!-- Empty box for possible design or future content -->
        </div>
        <div id="todays-text">
            This Month
        </div>
    </div>

    <!-- Section heading -->
    <div class="best-selling-products">
        <h2>Best Selling Products</h2>
    </div>
    
    <!-- Container for all product boxes -->
    <div class="product-box-container">
        <?php foreach ($products as $product): ?>
            <div class="product-box">
                <!-- Product Image Section -->
                <div class="product-photo-container">
                    <a href="../inc/product.php?product_id=<?= $product['product_id']?>"> <!-- Link to product detail page -->
                        <!-- Grey background image (maybe for hover effect or placeholder) -->
                        <img class="grey-photo" src="../assets/photos/Untitled-1.png" alt="">
                        <!-- Actual product image -->
                        <img class="product-photo" src="../uploads/<?= $product['image_path'] ?>" alt="">
                    </a>
                </div>
                <!-- Product name and price -->
                <h4><?= htmlspecialchars($product['name']) ?></h4>
                <p><?= htmlspecialchars($product['price']) ?></p>
            </div>
        <?php endforeach; ?>  
    </div>  

    <!-- Promotional JBL banner at the bottom -->
    <div class="jbl-add">
        <div class="jbl-image-add-div">
            <img src="../assets/photos/jblAdd.png" alt=""> <!-- JBL promo image -->
        </div>
        <div class="jbl-button-add-div">
            <button>Buy Now!</button> <!-- CTA button -->
        </div>
    </div>

</body>
</html>
