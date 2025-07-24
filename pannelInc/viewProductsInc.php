<?php

    require_once '../config/config.php';
    if(!isset($_SESSION['role']) || ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "depoist")){
        header("refresh: 0;url=../auth/login.php");
        die("");
    }

    $query = "SELECT * FROM products";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $products = [];

    if($stmt->rowCount() > 0){
        $products = $stmt->fetchAll();
    } else {
        echo "No products found";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../pannelInc/style/allProducts.css">
</head>
<body>

    <?php
    
        include_once '../pannelInc/navBarInc.php';

    ?>

    

    <?php
    
        include_once '../pannelInc/depoistMenuInc.php'

    ?>

     <div class="main-container">

     <div  class="products-nav">
        <div class="all-products">
            <h2>All Products</h2>
            <p>Home > All Products</p>
        </div>
        <div class="buttons">
            <button>Set Up Product</button>
            <button>Add Product</button>
        </div>
    </div>

       <div class="products-main-container">
         <?php foreach($products as $product){ ?>
            
            <div class="product-container">
                <div class="product-line-1">
                    <img width="100px" src="../uploads/<?= $product['image_path'] ?>" alt="">
                    <div class="product-info">
                        <h5><?= $product['name'] ?></h5>
                        <p><?= $product['price'] ?></p>
                    </div>
                </div>
                <div class="product-line-2">
                    <h5>Summary</h5>
                    <p>
                        <?= implode(' ', array_slice(explode(' ', $product['description']), 0, 10)) ?>
                    </p>

                </div>
                <div class="product-line-3">
                    <p>Remaining Products</p>
                    <?= $product['stock'] ?>
                </div>
                <div class="product-buttons">
                    <button>Delete</button>
                    <button>Update</button>
                </div>
            </div>
            
        <?php } ?>
       </div>
    
    </div>

</body>
</html>
