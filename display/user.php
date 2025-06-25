<?php

    require_once '../config/config.php';
    if(!isset($_SESSION['role']) || $_SESSION['role'] !=="user"){
        header("refresh: 0;url=../auth/login.php");
        die("");
    }

    $products = [];

    $query = "SELECT * FROM products";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if($stmt->rowCount() > 0){

        $products = $stmt->fetchAll();

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/user.css">
</head>
<body>

    

        <div class="products">

        <?php
        
            foreach($products as $product){ ?>

        <div class="product">
            <img src="../uploads/<?=$product['image_path']?>" alt="">
            <h3><?= $product['name']?></h3>
            <p><?= $product['price']?></p>

        </div>

        <?php } ?>

    </div>

</body>
</html>