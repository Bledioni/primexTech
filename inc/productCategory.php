<?php
require_once '../config/config.php';

$category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : null;
$min_price = isset($_GET['min_price']) && is_numeric($_GET['min_price']) ? (float)$_GET['min_price'] : null;
$max_price = isset($_GET['max_price']) && is_numeric($_GET['max_price']) ? (float)$_GET['max_price'] : null;

$products = [];

if ($category) {
    $query = "SELECT * FROM products WHERE category = :category";

    if ($min_price !== null) {
        $query .= " AND price >= :min_price";
    }
    if ($max_price !== null) {
        $query .= " AND price <= :max_price";
    }

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':category', $category);

    if ($min_price !== null) {
        $stmt->bindParam(':min_price', $min_price);
    }
    if ($max_price !== null) {
        $stmt->bindParam(':max_price', $max_price);
    }

    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products by Category</title>
    <link rel="stylesheet" href="../display/css/productCategory.css">
</head>
<body>

<?php include_once './dashBoradNavInc.php'; ?>

<!-- Price Range Filter -->
<!-- Price Range Filter with Slider -->
<form method="GET" class="price-filter-form">
    <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">

    <label for="min_price">Min Price:</label>
    <input type="range" id="min_price" name="min_price" 
           min="0" max="1000" step="1" 
           value="<?= $min_price !== null ? $min_price : 0 ?>"
           oninput="document.getElementById('minPriceValue').textContent = this.value">

    <span id="minPriceValue"><?= $min_price !== null ? $min_price : 0 ?></span>€

    <br>

    <label for="max_price">Max Price:</label>
    <input type="range" id="max_price" name="max_price" 
           min="0" max="1000" step="1" 
           value="<?= $max_price !== null ? $max_price : 1000 ?>"
           oninput="document.getElementById('maxPriceValue').textContent = this.value">

    <span id="maxPriceValue"><?= $max_price !== null ? $max_price : 1000 ?></span>€

    <br>
    <button type="submit">Filter</button>
</form>


<div class="product-box-container">
    <?php foreach ($products as $product): ?>
        <div class="product-box">
            <div class="product-photo-container">
                <a href="../inc/product.php?product_id=<?= $product['product_id'] ?>">
                    <img class="product-photo" src="../uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="">
                </a>
            </div>
            <h4><?= htmlspecialchars($product['name']) ?></h4>
            <p>€<?= htmlspecialchars(number_format($product['price'], 2)) ?></p>
        </div>
    <?php endforeach; ?>  
</div>

</body>
</html>
