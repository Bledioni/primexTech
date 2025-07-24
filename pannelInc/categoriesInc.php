<?php

require_once '../config/config.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $query = "SELECT * FROM products WHERE category = :category";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();

    $products = $stmt->fetchAll();

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

    <?php
    
        include_once '../pannelInc/depoistMenuInc.php'

    ?>

    <?php foreach($products as $product) { ?>

        <h1><?= $product['name'] ?></h1>

    <?php } ?>    


</body>
</html>
