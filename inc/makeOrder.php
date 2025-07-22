<?php
require_once '../config/config.php';


if (!isset($_SESSION['user_id']) || !isset($_POST['products'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];
$products = $_POST['products'];
$destination = $_POST['destination']; 

$totalAmount = 0;

// Start transaction
$conn->beginTransaction();

try {
    // Calculate total price
    foreach ($products as $product) {
        $pid = (int)$product['id'];
        $qty = (int)$product['quantity'];

        $stmt = $conn->prepare("SELECT price FROM products WHERE product_id = :pid");
        $stmt->bindParam(':pid', $pid);
        $stmt->execute();
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($productData) {
            $totalAmount += $productData['price'] * $qty;
        }
    }

    // Insert into `orders` table
    $orderStmt = $conn->prepare("
        INSERT INTO orders (client_id, total_amount, status, created_at)
        VALUES (:uid, :total, 'pending', NOW())
    ");
    $orderStmt->execute([
        ':uid' => $user_id,
        ':total' => $totalAmount
    ]);

    $order_id = $conn->lastInsertId();

    foreach ($products as $product) {
        $pid = (int)$product['id'];
        $qty = (int)$product['quantity'];

        $stmt = $conn->prepare("SELECT price FROM products WHERE product_id = :pid");
        $stmt->bindParam(':pid', $pid);
        $stmt->execute();
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($productData) {
            $price = $productData['price'];

            $itemStmt = $conn->prepare("
                INSERT INTO order_items (order_id, product_id, destinacion, quantity, price)
                VALUES (:order_id, :product_id, :dest, :quantity, :price)
            ");
            $itemStmt->execute([
                ':order_id' => $order_id,
                ':product_id' => $pid,
                ':dest' => $destination,
                ':quantity' => $qty,
                ':price' => $price
            ]);
        }
    }

    // Clear the cart
    $deleteStmt = $conn->prepare("DELETE FROM cart_items WHERE user_id = :uid");
    $deleteStmt->bindParam(':uid', $user_id);
    $deleteStmt->execute();

    $conn->commit();

    header("Location: ../display/dashboard.php");
    exit;

} catch (Exception $e) {
    $conn->rollBack();
    die("Order failed: " . $e->getMessage());
}
