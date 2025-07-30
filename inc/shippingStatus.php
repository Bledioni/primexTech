<?php

    require_once '../config/config.php';

    $user = $_SESSION['user_id'];

    $query = "
    SELECT 
    oi.quantity,
    p.product_id,
    p.name,
    p.image_path,
    p.price,
    o.order_id,
    o.status AS order_status
FROM 
    order_items oi
JOIN 
    products p ON oi.product_id = p.product_id
JOIN 
    orders o ON oi.order_id = o.order_id
WHERE 
    o.client_id = :uid
    AND o.status IN ('shipping', 'pending');
";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':uid' , $user);

    $stmt->execute();

    $products = $stmt->fetchAll();

?>

<?php

    foreach($products as $product) {

        $product_quantity = $product['quantity'];
        $product_id = $product['product_id'];

    }

    $queryStockUpdate = "UPDATE products SET stock=stock - :quantity WHERE product_id = :pid";

    $stmtStockUpdate = $conn->prepare($queryStockUpdate);
    $stmtStockUpdate->bindParam(':quantity' , $product_quantity);
    $stmtStockUpdate->bindParam(':pid' , $product_id);

    $stmtStockUpdate->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../display/css/shippingStatus.css">
</head>
<body>

    <?php include_once '../inc/dashBoradNavInc.php'; ?>

    <?php foreach($products as $product) { ?>
    <div class="product-card">
        <img src="../uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
        <div class="product-info">
            <h1><?= htmlspecialchars($product['name']) ?></h1>
            <div class="status"><?= htmlspecialchars($product['order_status']) ?></div>
            <div class="quantity">Quantity: <?= (int)$product['quantity'] ?></div>
        </div>
        <form action="./shipingDetailsLogic.php" method="post">
            <input type="hidden" name="order_id" value="<?= htmlspecialchars($product['order_id']) ?>" />
            <button type="submit" name="arrive">Arrived</button>
        </form>
    </div>
<?php } ?>


</body>
</html>