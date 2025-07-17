<?php

    require_once '../config/config.php';
    if(!isset($_SESSION['role']) || $_SESSION['role'] !=="admin"){
        header("refresh: 0;url=../auth/login.php");
        die("");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/admin/adminDashboard.css">
    <link rel="stylesheet" href="../assets/admin/addProducts.css">
</head>
<body>

    <?php
    
         include_once '../inc/adminNavInc.php';

    ?>

<div class="main-container">

<?php

    include_once '../inc/adminInc.php';

?>

<form action="./bestSellingProducts.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product Name" required>
    <select name="category" id="category">
        <option value="Computer">Computer</option>
        <option value="Gaming">Gaming</option>
        <option value="Camera">Camera</option>
        <option value="HeadPhones">HeadPhones</option>
        <option value="Phones">Phones</option>
        <option value="SmartWatch">SmartWatch</option>
    </select>
    <input type="text" name="description" placeholder="Product Description" required>
    <input type="file" name="image" accept="image/*" required>  
    <input type="number" name="price" placeholder="Product Price" required>
    <input type="number" name="stock" id="stock" required placeholder="Stock">
    <button name="submit">Submit</button>
</form>



</div>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']) && isset($_POST['name'])) {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $type = 'bestsellingproducts';
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];

    $uploadDir = '../uploads/';
    $targetPath = $uploadDir . basename($imageName);

    if (move_uploaded_file($tmpName, $targetPath)) {
        $stmt = $conn->prepare("INSERT INTO products (name, category, type, description, price, image_path , stock)
                                VALUES (:name, :category, :type ,:description, :price, :image_path ,:stock)");

        $stmt->execute([
            ':name' => $name,
            ':category' => $category,
            ':type' => $type,
            ':description' => $description,
            ':price' => $price,
            ':stock' => $stock,
            ':image_path' => $targetPath
        ]);


        echo "Product saved!";
    } else {
        echo "Failed to upload file.";
    }
}
?>
