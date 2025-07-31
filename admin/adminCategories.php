<?php

require_once '../config/config.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $query = "SELECT * FROM products WHERE category = :category";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();

    $products = $stmt->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        .products-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            padding: 30px;
        }

        .product-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            transition: 0.3s ease-in-out;
            background-color: #f9f9f9;
        }

        .product-card:hover {
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-title {
            font-size: 1.1rem;
            margin: 10px 0 5px;
        }

        .product-price {
            font-size: 1rem;
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>

<?php include_once '../admin/adminNav.php' ?>

<div class="products-container">
    <?php foreach($products as $product) { ?>
        <div class="product-card">
            <img src="../uploads/<?= $product['image_path'] ?>" alt="<?= $product['name'] ?>">
            <div class="product-title"><?= htmlspecialchars($product['name']) ?></div>
            <div class="product-price">€<?= htmlspecialchars($product['price']) ?></div>
        </div>
    <?php } ?>
</div>

</body>
</html>
