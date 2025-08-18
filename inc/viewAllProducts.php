<?php
require_once '../config/config.php';

$limit = 12; // products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

// Get total number of products
$totalStmt = $conn->query("SELECT COUNT(*) FROM products");
$totalProducts = $totalStmt->fetchColumn();
$totalPages = ceil($totalProducts / $limit);

// Get products for current page
$stmt = $conn->prepare("SELECT * FROM products ORDER BY product_id DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Products</title>
    <link rel="stylesheet" href="../display/css/viewAllProducts.css" />
</head>
<body>

    <?php include_once './dashBoradNavInc.php'; ?>

    <div class="product-box-container">
        <?php foreach ($products as $product): ?>
            <div class="product-box">
                <div class="product-photo-container">
                    <a href="../inc/product.php?product_id=<?= $product['product_id'] ?>">
                        <img class="product-photo" src="../uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
                    </a>
                </div>
                <h4><?= htmlspecialchars($product['name']) ?></h4>
                <p><?= htmlspecialchars($product['price']) ?>$</p>
                <div class="heart-shop-now">
                    <form action="./wishlistLogic.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                        <button type="Submit">
                            <i id="wishlist" class="fa-solid fa-heart"></i>
                        </button>
                    </form>
                        <form action="../inc/addToCart.php?product_id=<?= $product['product_id'] ?>" method="POST">
                        <button type="submit"><i class="fa-solid fa-cart-shopping"></i></button>
                    </form>
                </div>
                <form action="../inc/product.php?product_id=<?=$product['product_id']?>" method="POST">
                        <input type="hidden" name="quantity" value="1">

                    <button>Buy Now</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>

</body>
</html>
