<?php
require_once '../config/config.php';


// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch all products in user's cart
$query = "
    SELECT 
        c.quantity,
        p.product_id,
        p.name,
        p.description,
        p.image_path,
        p.price
    FROM 
        cart_items c
    JOIN 
        products p ON c.product_id = p.product_id
    WHERE 
        c.user_id = :uid
";

$stmt = $conn->prepare($query);
$stmt->bindParam(':uid', $user_id);
$stmt->execute();
$cartProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../display/css/cart.css">
</head>
<body>

<?php require_once '../inc/dashBoradNavInc.php'; ?>

<?php
$total = 0;

if (empty($cartProducts)) {
    echo "<p>No Product Found. Redirecting...</p>";
    header("refresh: 2; url='../display/dashBoard.php'");
    exit;
} else {
?>

<form action="../inc/makeOrder.php" method="POST">
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartProducts as $cartProduct): ?>
                <?php
                    $subtotal = $cartProduct['price'] * $cartProduct['quantity'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td>
                        <div class="cart-photo-container">
                            <img src="../uploads/<?= htmlspecialchars($cartProduct['image_path']) ?>" width="50" alt="">
                            <?= htmlspecialchars($cartProduct['name']) ?>
                        </div>
                    </td>
                    <td>€<?= number_format($cartProduct['price'], 2) ?></td>
                    <td><?= (int)$cartProduct['quantity'] ?></td>
                    <td>€<?= number_format($subtotal, 2) ?></td>
                    <td>

                        <!-- the form is made to handle delete button or delete form properly if the empty form isnt made the productd wouldnt delete without filling the purchase form --><form action=""></form>

                        
                      <form action="../inc/deleteFromProductFromCart.php" method="POST">
                        <button type="submit" 
                                name="product_id" 
                                value="<?= (int)$cartProduct['product_id'] ?>" 
                                onclick="return confirm('Are you sure you want to delete this item?')">
                            Delete
                        </button>
                      </form>
                    </td>
                </tr>

                <input type="hidden" name="products[<?= (int)$cartProduct['product_id'] ?>][id]" value="<?= (int)$cartProduct['product_id'] ?>">
                <input type="hidden" name="products[<?= (int)$cartProduct['product_id'] ?>][quantity]" value="<?= (int)$cartProduct['quantity'] ?>">
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="cart-checkout-container">
        <h4>Total: €<?= number_format($total, 2) ?></h4>
        <input type="text" name="destination" placeholder="Destination" required>
        <button type="submit">Proceed to Checkout</button>
    </div>
</form>
<?php } ?>


</body>
</html>
