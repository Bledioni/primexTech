<?php

    require_once '../config/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../display/css/productCategory.css">
</head>
<body>

    <?php include_once './dashBoradNavInc.php'; ?>

<?php

require_once '../config/config.php';

$category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : null;

$products = [];

if ($category) {
    $query = "SELECT * FROM products WHERE category = :category";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<div class="product-box-container">
  <?php foreach ($products as $product): ?>
        <div class="product-box">
            <div class="product-photo-container">
                <a href="../inc/product.php?product_id=<?= $product['product_id'] ?>"><img class="product-photo" src="../uploads/<?= $product['image_path'] ?>" alt=""></a>
            </div>
        <h4><?= htmlspecialchars($product['name']) ?></h4>
        <p><?= htmlspecialchars($product['price']) ?></p>
    </div>
<!-- <?php endforeach; ?>  
</div>   -->

</body>
</html>