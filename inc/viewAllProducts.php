<?php

    require_once '../config/config.php';

    $query = "SELECT * FROM products";

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
    <link rel="stylesheet" href="../display/css/viewAllProducts.css">
</head>
<body>

     <?php include_once './dashBoradNavInc.php'; ?>

    <div class="product-box-container">
        <?php foreach ($products as $product): ?>
            <div class="product-box">
                <div class="product-photo-container">
                    <a href="../inc/product.php?product_id=<?= $product['product_id']?>">
                        <img class="product-photo" src="../uploads/<?= $product['image_path'] ?>" alt="">
                    </a>
                </div>
                <h4><?= htmlspecialchars($product['name']) ?></h4>
                <p><?= htmlspecialchars($product['price']) ?>$</p>
            </div>
        <?php endforeach; ?>  
    </div>  

</body>
</html>