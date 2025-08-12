<?php
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $scannedData = $_GET['qrCode'] ?? '';
    $products = [];

    if (!empty($scannedData)) {
        $query = "SELECT * FROM products WHERE qrCode = :pid";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':pid', $scannedData);
        $stmt->execute();
        $products = $stmt->fetchAll();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Update</title>
  <link rel="stylesheet" href="../pannelInc/style/process.css">
</head>
<body>

<?php require_once '../pannelInc/navBarInc.php'; ?>

<div class="container">
<?php if (!empty($products)): ?>
  <?php foreach ($products as $product): ?>
    <div class="product">
      <h1><?= htmlspecialchars($product['name']) ?></h1>
      <img src="../uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="">
      
      <form method="POST">
        <label for="amount">Enter An Amount</label>
        <input type="number" name="amount" required>
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
        <button type="submit" name="submit">Submit</button>
      </form>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])) {
    $amount = $_POST['amount'];
    $product_id = $_POST['product_id'];

    $updateStockQuery = "UPDATE products SET stock = stock + :stc WHERE product_id = :pid";
    $updateStockStmt = $conn->prepare($updateStockQuery);
    $updateStockStmt->bindParam(':stc', $amount);
    $updateStockStmt->bindParam(':pid', $product_id);
    $updateStockStmt->execute();

    echo "<p class='success'>Stock updated for product ID: " . htmlspecialchars($product_id) . "</p>";
    header('refresh:2; url=./depoist.php');
}
?>

</body>
</html>
