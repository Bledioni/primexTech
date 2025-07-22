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
</head>
<body>
    <?php foreach($products as $product) { ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
            <img style="width:100px;" src="../uploads/<?= $product['image_path'] ?>" alt="">
            <h1><?= $product['name'] ?></h1>
            <h1><?= $product['order_status'] ?></h1>
            <h1><?= $product['quantity'] ?></h1>
            <form action="./shipingDetailsLogic.php" method="post">
                <input type="hidden" name="order_id" value="<?= htmlspecialchars($product['order_id']) ?>" />
                <button type="submit" name="arrive">Arrived</button>
            </form>
        </div>
    <?php } ?>     

</body>
</html>