<?php
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['product_id'] ?? null;
$quantity = $_GET['quantity'] ?? 1; // default to 1 if not provided

// Validate input
if (!$product_id || !is_numeric($product_id) || !is_numeric($quantity) || $quantity < 1) {
    die("Invalid input.");
}

try {
    // Check if product already in cart
    $stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = :uid AND product_id = :pid");
    $stmt->execute([
        ':uid' => $user_id,
        ':pid' => $product_id
    ]);

    if ($stmt->rowCount() > 0) {
        // Update quantity
        $stmt = $conn->prepare("UPDATE cart_items SET quantity = quantity + :qty WHERE user_id = :uid AND product_id = :pid");
        $stmt->execute([
            ':qty' => $quantity,
            ':uid' => $user_id,
            ':pid' => $product_id
        ]);
        header('refresh: 0; url=../inc/viewAllProducts.php');
    } else {
        // Insert new cart item
        $stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (:uid, :pid, :qty)");
        $stmt->execute([
            ':uid' => $user_id,
            ':pid' => $product_id,
            ':qty' => $quantity
        ]);
        header('refresh: 0; url=../inc/viewAllProducts.php');
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
</html>