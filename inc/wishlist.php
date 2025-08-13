<?php
require_once '../config/config.php';

$user_id = $_SESSION['user_id'];

$query = "
SELECT 
    products.product_id,
    products.name,
    products.image_path,
    wishlist.created_at
FROM 
    wishlist
JOIN 
    products ON wishlist.product_id = products.product_id
WHERE 
    wishlist.user_id = :user;
";

$stmt = $conn->prepare($query);
$stmt->bindParam(':user', $user_id);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Wishlist</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        margin-inline: 6rem;
        color: #333;
    }

    h2 {
        margin-bottom: 1rem;
    }

    .wishlist-count {
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }

    .wishlist-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .wishlist-item {
        background: white;
        border-radius: 8px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        padding: 1rem;
        width: 220px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .wishlist-item img {
        width: 10rem;
        height:10rem;
        height: auto;
        border-radius: 6px;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .wishlist-item img:hover {
        transform: scale(1.05);
    }

    .wishlist-item h3 {
        font-size: 1.1rem;
        margin: 0 0 1rem 0;
        color: #222;
    }

    .wishlist-item form {
        width: 100%;
    }

    .wishlist-item button {
        width: 100%;
        background-color: #DB4444;
        border: none;
        color: white;
        padding: 0.6rem 0;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .wishlist-item button:hover {
        background-color: #b93b3b;
    }
</style>
</head>
<body>


    <?php include_once './dashBoradNavInc.php'; ?>

<h2>Wishlist (<?= count($products) ?>)</h2>

<div class="wishlist-container">
    <?php foreach ($products as $product) { ?>
        <div class="wishlist-item">
            <a href="../inc/product.php?product_id=<?= htmlspecialchars($product['product_id']) ?>">
                <img src="../uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
            </a>
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <form action="../inc/wishListDelete.php" method="POST">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>" />
                <button type="submit">Remove</button>
            </form>
        </div>
    <?php } ?>
</div>

</body>
</html>
