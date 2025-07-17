<?php

    require_once '../config/config.php';

    $query = "SELECT * FROM products WHERE type = 'bestsellingproducts'";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../display/css/bestSellingProducts.css">
</head>
<body>
    <div id="todays-header">
        <div id="todaysBox">
        
        </div>
        <div id="todays-text">
            This Month
        </div>
    </div>

    <div class="best-selling-products">
        <h2>Best Selling Products</h2>
    </div>
    
    <div class="product-box-container">
        <?php foreach ($products as $product): ?>
            <div class="product-box">
                <div class="product-photo-container">
                    <a href="../inc/product.php?product_id=<?= $product['product_id']?>">
                        <img class="grey-photo" src="../assets/photos/Untitled-1.png" alt="">
                        <img class="product-photo" src="../uploads/<?= $product['image_path'] ?>" alt="">
                    </a>
                </div>
                <h4><?= htmlspecialchars($product['name']) ?></h4>
                <p><?= htmlspecialchars($product['price']) ?></p>
            </div>
        <?php endforeach; ?>  
    </div>  


    <div class="jbl-add">
        <div class="jbl-image-add-div">
            <img src="../assets/photos/jblAdd.png" alt="">
        </div>
        <div class="jbl-button-add-div">
            <button>Buy Now!</button>
        </div>
    </div>

</body>
</html>
