<?php

    require_once '../config/config.php';

    $user_id = $_SESSION['user_id'];

    $query = "
    SELECT 
    products.product_id,
    products.name,
    products.image_path,
    wishlist.created_at
FROM 
    wishlist
JOIN 
    products ON wishlist.product_id = products.product_id
WHERE 
    wishlist.user_id = :user;
 ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user' , $user_id);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        $product_count = 0;

        foreach($products as $product){

            $product_count++;

        }

    ?>

    <p>Wishlist(<p><?= $product_count ?></p>)</p>

    <?php foreach($products as $product){ ?>


        <form action="../inc/wishListDelete.php" method="POST">
                <h1><?= $product['name']; ?></h1>
                <a href="../inc/product.php?product_id=<?= $product['product_id'] ?>"><img src="../uploads/<?= $product['image_path'] ?>" alt=""></a>
                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                <button type="submit">Remove</button>
        </form>

    <?php } ?>


</body>
</html>
