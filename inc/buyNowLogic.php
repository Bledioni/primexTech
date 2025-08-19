<?php
require_once '../config/config.php';

$product_id = $_POST['product_id'];
$user_id = $_SESSION['user_id'];
$quantity = $_POST['quantity'];

$query = "INSERT INTO cart_items (user_id, product_id, quantity)
          VALUES (:uid, :pid, :qty)";

$stmt = $conn->prepare($query);
$stmt->execute([
    ':uid' => $user_id,
    ':pid' => $product_id,
    ':qty' => $quantity
]);

header('Location: ../inc/cart.php');
exit;
?>
