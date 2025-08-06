<?php


require_once '../config/config.php';

// Access control check
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "depoist")) {
    header("refresh: 0;url=../auth/login.php");
    die("");
}

// Pagination setup
$perPage = 6;  // products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $perPage;

// Get total number of products
$totalStmt = $conn->query("SELECT COUNT(*) FROM products");
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $perPage);

// Fetch products for current page only
$query = "SELECT * FROM products LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($query);
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$products = [];
if ($stmt->rowCount() > 0) {
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // No products message will be handled in HTML below
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All Products</title>
    <link rel="stylesheet" href="../pannelInc/style/allProducts.css" />
</head>
<body>

    <?php include_once '../pannelInc/navBarInc.php'; ?>

     <div class="products-main-container-nav">
        <div class="products-nav">
            <div class="all-products">
                <h2>All Products</h2>
                <p>Home > All Products</p>
            </div>
            <div class="buttons">
                <a href="../depoist/setUpProduct.php"><button>Set Up Product</button></a>
                <a href="../depoist/addProductQrCode.php"><button>Add Product</button></a>
            </div>
        </div>
     </div>

    <div class="main-container">
        <div class="products-main-container">
            <?php if (count($products) === 0): ?>
                <p>No products found.</p>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-container">
                        <div class="product-line-1">
                            <img width="100px" src="../uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="Product Image" />
                            <div class="product-info">
                                <h5><?= htmlspecialchars($product['name']) ?></h5>
                                <p><?= htmlspecialchars($product['price']) ?></p>
                            </div>
                        </div>
                        <div class="product-line-2">
                            <h5>Summary</h5>
                            <p>
                                <?= htmlspecialchars(implode(' ', array_slice(explode(' ', $product['description']), 0, 10))) ?>
                            </p>
                        </div>
                        <div class="product-line-3">
                            <p>Remaining Products</p>
                            <?= htmlspecialchars($product['stock']) ?>
                        </div>
                        <div class="product-buttons">
                            <form action="../pannelInc/deleteProduct.php">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id'])?>" name="">
                                <button name="submit" >Delete</button>
                            </form>
                            <form action="../depoist/addProductQrCode.php"><button name="submit" >Update</button></form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Pagination navigation -->
        </div>

         <?php if ($totalPages > 1): ?>
            <div class="pagination" style="text-align:center; margin: 20px 0;">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" style="margin-right: 10px;">&laquo; Prev</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == $page): ?>
                        <strong style="margin: 0 5px;"><?= $i ?></strong>
                    <?php else: ?>
                        <a href="?page=<?= $i ?>" style="margin: 0 5px;"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>" style="margin-left: 10px;">Next &raquo;</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        

    </div>

</body>
</html>
