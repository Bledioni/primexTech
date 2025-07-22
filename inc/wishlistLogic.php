<?php

require_once '../config/config.php'; 

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = (int) $_POST['product_id'];

 
    $check = $conn->prepare("SELECT * FROM wishlist WHERE user_id = :user_id AND product_id = :product_id");
    $check->execute([
        ':user_id' => $user_id,
        ':product_id' => $product_id
    ]);

    if ($check->rowCount() > 0) {
        echo "Product already in wishlist.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (:user_id, :product_id)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':product_id', $product_id);

    if ($stmt->execute()) {     
        echo "Added to wishlist.";
    } else {
        echo "Failed to add to wishlist.";
    }
} else {
    echo "Invalid request.";
}
?>
