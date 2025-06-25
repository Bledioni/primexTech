<?php

    require_once '../config/config.php';
    if(!isset($_SESSION['role']) || $_SESSION['role'] !=="admin"){
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
</head>
<body>

     <div class="main-container">
        <table>
            <thead>
                <th>PRODUCT-ID</th>
                <th>PRODUCT-NAME</th>
                <th>PRODUCT-CATEGORY</th>
                <th>PRODUCT-DESCRIPTION</th>
                <th>PRODUCT-IMAGE</th>
                <th>PRODUCT-PRICE</th>
                <th>PRODUCT-STOCK</th>
                <th>PRODUCT-CREATED</th>
            </thead>

            <tbody>
                <?php foreach($products as $product){ ?>
                    <tr>
                        <td><?php echo $product["product_id"] ?></td>
                        <td><?= $product["name"] ?></td>
                        <td><?= $product["category"] ?></td>
                        <td><?= $product["description"] ?></td>
                        <td><img src="../uploads/<?= $product['image_path'] ?>"></td>
                        <td><?= $product["price"] ?></td>
                        <td><?= $product["stock"] ?></td>
                        <td><?= $product["created_at"] ?></td>
                        <td>
                            <button><a href="updateProduct.php?product_id=<?= $product["product_id"] ?>">Update</a></button>
                            <button name="delete" class="delete"><a href="deleteProduct.php?product_id=<?= $product["product_id"] ?>">Delete</a></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
