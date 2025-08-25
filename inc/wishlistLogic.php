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
        header('refresh: 0; url=../inc/viewAllProducts.php');
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (:user_id, :product_id)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':product_id', $product_id);

    if ($stmt->execute()) {     
        header('refresh: 0; url=../inc/viewAllProducts.php');        
    } else {
        echo "Failed to add to wishlist.";
    }
} else {
    echo "Invalid request.";
}
?>
