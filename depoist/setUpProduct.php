<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code Generator</title>
  <link rel="stylesheet" href="../pannelInc/style/setUpProduct.css">
  <link rel="stylesheet" href="../pannelInc/style/navBarInc.css">
</head>
<body>

<?php 

    require_once '../config/config.php';

    include_once '../pannelInc/navBarInc.php'; 

?>

<div class="setUp-Product">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        
        <select name="category" id="category" required>
            <option value="Computer">Computer</option>
            <option value="Gaming">Gaming</option>
            <option value="Camera">Camera</option>
            <option value="HeadPhones">HeadPhones</option>
            <option value="Phones">Phones</option>
            <option value="SmartWatch">SmartWatch</option>
        </select>
        
        <input type="text" name="description" placeholder="Product Description" required>
        <input type="file" name="image" accept="image/*" required>  
        <input type="number" name="price" placeholder="Product Price" step="0.01" required>
        <input type="number" name="stock" placeholder="Stock" required>
        
        <button type="submit" name="generate">Submit</button>
    </form>
</div>

<?php

require_once '../config/config.php'; // <-- Update with your connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate'])) {

    // Generate 10-digit random number for QR code
    $randomNumber = '';
    for ($i = 0; $i < 10; $i++) {
        $randomNumber .= mt_rand(0, 9);
    }

    // Get form values
    $name = $_POST['name'];
    $category = $_POST['category'];
    $type = 'flashsales';
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Handle file upload
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];

    $uploadDir = '../uploads/';
    $targetPath = $uploadDir . basename($imageName);

    if (move_uploaded_file($tmpName, $targetPath)) {
        
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO products (name, category, type, description, price, image_path, qrCode, stock)
                                VALUES (:name, :category, :type, :description, :price, :image_path, :qrCode, :stock)");

        $stmt->execute([
            ':name' => $name,
            ':category' => $category,
            ':type' => $type,
            ':description' => $description,
            ':price' => $price,
            ':image_path' => $targetPath,
            ':qrCode' => $randomNumber,
            ':stock' => $stock,
        ]);

        // Show QR Code only
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($randomNumber) . "&size=200x200";

        echo "<h2>QR Code for Product:</h2>";
        echo "<img src='" . $qrUrl . "' alt='QR Code'>";
        
    } else {
        echo "Failed to upload image.";
    }
}
?>

</body>
</html>
