<?php
require_once '../config/config.php'; // Include database connection and start session

// Redirect user to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

$user_id = $_SESSION['user_id']; // Get user ID from session

// Prepare SQL query to get cart items joined with product data
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
$stmt->bindParam(':uid', $user_id); // Bind user ID to prevent SQL injection
$stmt->execute();
$cartProducts = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all cart items

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../display/css/cart.css"> <!-- Link to external CSS -->
</head>
<body>

<?php require_once '../inc/dashBoradNavInc.php'; ?> <!-- Include navigation/dashboard -->

<?php
$total = 0; // Initialize total price

// If cart is empty, show message and redirect
if (empty($cartProducts)) {
    echo "<p>No Product Found. Redirecting...</p>";
    header("refresh: 2; url='../display/dashBoard.php'");
    exit;
} else {
?>

<!-- Start of Order Form -->
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
                    $subtotal = $cartProduct['price'] * $cartProduct['quantity']; // Calculate subtotal

                    $CupponQuery = "SELECT * FROM cuppon";

                    $CupponStmt = $conn->prepare($CupponQuery);
                    $CupponStmt->execute();

                    $cuppon = $CupponStmt->fetch();

                    if($CupponStmt->rowCount() > 0){

                        $subtotal -= $cuppon['discount'];

                    }

                    ($total += $subtotal); // Add to total

                ?>
                <tr>
                    <td>
                        <div class="cart-photo-container">
                            <img src="../uploads/<?= htmlspecialchars($cartProduct['image_path']) ?>" width="50" alt="">
                            <?= htmlspecialchars($cartProduct['name']) ?> <!-- Display product name -->
                        </div>
                    </td>
                    <td>€<?= number_format($cartProduct['price'], 2) ?></td> <!-- Product price -->
                    <td><?= (int)$cartProduct['quantity'] ?></td> <!-- Quantity -->
                    <td>€<?= number_format($subtotal, 2) ?></td> <!-- Subtotal -->

                    <td>
                        <!-- Empty form for separation (sometimes needed for layout/form bug fixes) -->
                        <form action=""></form>

                        <!-- Form to handle delete action -->
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

                <!-- Hidden inputs to send product info for order -->
                <input type="hidden" name="products[<?= (int)$cartProduct['product_id'] ?>][id]" value="<?= (int)$cartProduct['product_id'] ?>">
                <input type="hidden" name="products[<?= (int)$cartProduct['product_id'] ?>][quantity]" value="<?= (int)$cartProduct['quantity'] ?>">
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Checkout Section -->
    <div class="cart-checkout-container">
        <h4>Total: €<?= number_format($total, 2) ?></h4> <!-- Display total price -->

        <!-- Dropdown for selecting shipping destination -->
        <select name="destination" class="form-select" aria-label="Default select example">
            <option selected>Select A City</option>
            <option value="Prishtine">Prishtine</option>
            <option value="Gjakove">Gjakove</option>
            <option value="Peje">Peje</option>
            <option value="Mitrovice">Mitrovice</option>
            <option value="Prizren">Prizren</option>
            <option value="Ferizaj">Ferizaj</option>
            <option value="Gjilan">Gjilan</option>
            <option value="Podujeve">Podujeve</option>
            <option value="Vushtrri">Vushtrri</option>
            <option value="Malisheve">Malisheve</option>
            <option value="Rahovec">Rahovec</option>
            <option value="Suhareke">Suhareke</option>
            <option value="Drenas">Drenas</option>
            <option value="Kamenice">Kamenice</option>
            <option value="Viti">Viti</option>
            <option value="Dragash">Dragash</option>
            <option value="Skenderaj">Skenderaj</option>
            <option value="Kline">Kline</option>
            <option value="Deçan">Deçan</option>
            <option value="Istog">Istog</option>
            <option value="Leposaviq">Leposaviq</option>
            <option value="Zubin Potok">Zubin Potok</option>
            <option value="Zvecan">Zvecan</option>
            <option value="Shterpce">Shterpce</option>
            <option value="Novoberde">Novoberde</option>
            <option value="Obiliq">Obiliq</option>
            <option value="Hani i Elezit">Hani i Elezit</option>
            <option value="Junik">Junik</option>
            <option value="Mamushe">Mamushe</option>
            <option value="Partesh">Partesh</option>
            <option value="Ranillug">Ranillug</option>
        </select>

        <!-- Submit order -->
        <button type="submit">Proceed to Checkout</button>
    </div>
</form>

<form action="">
    <input type="text" placeholder="Enter Cuppon Code">
    <button type="submit" name="cuppon_submit">Submit</button>
</form>


<?php } ?>

</body>
</html>
