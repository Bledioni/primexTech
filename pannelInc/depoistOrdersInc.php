<?php
require_once '../config/config.php';

$query = "
    SELECT
        order_items.destinacion,
        order_items.quantity,
        orders.total_amount,
        orders.order_id,
        orders.status,
        orders.created_at,
        products.image_path, 
        products.name AS title
    FROM order_items
    INNER JOIN products ON order_items.product_id = products.product_id
    INNER JOIN orders ON order_items.order_id = orders.order_id
    WHERE orders.status = 'pending';
";

$stmt = $conn->prepare($query);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<body>

    <?php
    
        include_once '../pannelInc/depoistMenuInc.php'

    ?>

<?php foreach ($products as $product): ?>
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
        <img style="width:100px;" src="<?= htmlspecialchars($product['image_path']) ?>" alt="">
        <h2><?= htmlspecialchars($product['title']) ?></h2>
        <p>Destination: <?= htmlspecialchars($product['destinacion']) ?></p>
        <p>Quantity: <?= htmlspecialchars($product['quantity']) ?></p>
        <p>Total: <?= htmlspecialchars($product['total_amount']) ?></p>
        <p>Date: <?= htmlspecialchars($product['created_at']) ?></p>
        <p>Order ID: <?= htmlspecialchars($product['order_id']) ?></p>

        <form action="../pannelInc/changeStatusInc.php" method="POST">
            <input type="hidden" name="order_id" value="<?= htmlspecialchars($product['order_id']) ?>" />
            <button type="submit" name="shipp">Confirm</button>
        </form>
    </div>
<?php endforeach; ?>

</body>
</html>
