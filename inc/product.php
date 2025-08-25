<?php
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
}

$product_id = $_GET['product_id'] ?? null;

if (!$product_id) {
    die("No product ID provided.");
}

$query = "SELECT * FROM products WHERE product_id = :productid";
$stmt = $conn->prepare($query);
$stmt->bindParam(':productid', $product_id);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}


$stmtCat = $conn->prepare("SELECT * FROM products");
$stmtCat->execute();
$categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = $_POST['quantity'] ?? 0;
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = :uid AND product_id = :pid");
        $stmt->execute([':uid' => $user_id, ':pid' => $product_id]);

        if ($stmt->rowCount() > 0) {
            $stmt = $conn->prepare("UPDATE cart_items SET quantity = quantity + :qty WHERE user_id = :uid AND product_id = :pid");
            $stmt->execute([':qty' => $quantity, ':uid' => $user_id, ':pid' => $product_id]);
        } else {
            $stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (:uid, :pid, :qty)");
            $stmt->execute([':uid' => $user_id, ':pid' => $product_id, ':qty' => $quantity]);
        }

        header("Location: ../display/dashBoard.php");
        exit;

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Product</title>
    <link rel="stylesheet" href="../display/css/product.css">
</head>
<body>
<?php require_once '../inc/dashBoradNavInc.php'; ?>

<div class="product-page-wrapper">

    <div class="product-main-container">
        <div class="product-container">
            <img class="product-main-image" src="../uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="">
            <div class="product-description">
                <h1><?= htmlspecialchars($product['name']) ?></h1>
                <p style="font-weight:600;"><?= htmlspecialchars($product['price']) ?>$</p>
                <p><?= htmlspecialchars($product['description']) ?></p>


                <div class="cart-wishlist-buttons">
                    <form action="" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <input type="number" name="quantity" min="1" required>
                    <button type="submit">Add to Cart</button>
                </form>

                <form action="./wishlistLogic.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <button type="submit" style="background:none; border:none;">
                        <i id="wishlist" class="fa-solid fa-heart"></i>
                    </button>
                </form>
                </div>

                <div class="futures">
                    <div class="delivery">
                        <i class="fa-solid fa-truck-fast"></i>
                        <div class="delivery-details">
                            <h4>Free Delivery</h4>
                            <p>Enter your postal code for Delivery Availability</p>
                        </div>
                    </div>
                    <div class="delivery">
                        <i class="fa-solid fa-repeat"></i>
                        <div class="delivery-details">
                            <h4>Return Delivery</h4>
                            <p>Free 30 Days Delivery Returns. Details</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="todays-header">
        <div id="todaysBox"></div>
        <div id="todays-text">Related Items</div>
    </div>

    <div class="related-products-container">
        <?php foreach ($categories as $category): ?>
            <?php if ($category['product_id'] !== $product['product_id'] && $category['category'] === $product['category']): ?>
                <a href="../inc/product.php?product_id=<?= $category['product_id'] ?>">
                    <div class="related-product">
                        <img src="../uploads/<?= htmlspecialchars($category['image_path']) ?>" alt="">
                        <p class="name"><?= htmlspecialchars($category['name']) ?></p>
                        <p class="price"><?= htmlspecialchars($category['price']) ?>$</p>
                    </div>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

</div> <!-- end wrapper -->

<?= include_once '../inc/footer.php' ?>
</body>
