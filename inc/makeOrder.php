<?php



require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}



if (!isset($_SESSION['user_id']) || !isset($_POST['products'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];
$products = $_POST['products'];
$destination = $_POST['destination']; 
$coupon_code = trim($_POST['coupon_code'] ?? '');

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$street_address = $_POST['street_address'];
$apartment = $_POST['apartment'];
$phone = $_POST['phone'];
$email = $_POST['email'];

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

    $discountPercent = 0;

    // Check coupon code validity
    if ($coupon_code !== '') {
        $couponStmt = $conn->prepare("SELECT discount FROM cuppon WHERE  = :code LIMIT 1");
        $couponStmt->execute([':code' => $coupon_code]);
        $couponData = $couponStmt->fetch(PDO::FETCH_ASSOC);

        if ($couponData) {
            $discountPercent = (float)$couponData['discount']; // Assuming discount is percentage (e.g., 10 for 10%)
        }
    }

    // Apply discount if any
    if ($discountPercent > 0) {
        $discountAmount = ($totalAmount * $discountPercent) / 100;
        $totalAmount -= $discountAmount;
    }

    // Insert into orders table
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
            INSERT INTO order_items 
            (order_id, product_id, quantity, price, first_name, last_name, street_address, apartment, phone, email, destination)
            VALUES (:order_id, :product_id, :quantity, :price, :fname, :lname, :saddress, :apt, :phone, :email, :dest)
            ");
            $itemStmt->execute([
                ':order_id' => $order_id,
                ':product_id' => $pid,
                ':quantity' => $qty,
                ':price' => $price,
                ':fname' => $first_name,
                ':lname' => $last_name,
                ':saddress' => $street_address,
                ':apt' => $apartment,
                ':phone' => $phone,
                ':email' => $email,
                ':dest' => $destination
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


?>