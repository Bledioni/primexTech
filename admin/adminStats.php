<?php

    require_once '../config/config.php';

    //users

    $query = "SELECT * FROM users";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $users = $stmt->fetchAll();

    //orders

    $orderQuery = "SELECT * FROM order_items";

    $orderStmt = $conn->prepare($orderQuery);
    $orderStmt->execute();

    $orders = $orderStmt->fetchAll();

    //products

    $productsQuery = "SELECT * FROM products";

    $productStmt = $conn->prepare($productsQuery);
    $productStmt->execute();

    $products = $productStmt->fetchAll();

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
    

        //total users

        $total_users = 0;

        foreach($users as $user){

            $total_users++;

        }

        //total orders

        $total_orders = 0;

        foreach($orders as $order){

            $total_orders++;

        }

        //total products

        $total_produts = 0;

        foreach($products as $product){

            $total_produts++;

        }
    ?>

    <h1>Active users: <?= $total_users ?></h1>
    <h1>Orders: <?= $total_orders ?></h1>
    <h1>Products: <?= $total_produts ?></h1>

</body>
</html>