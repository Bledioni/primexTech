<?php

    require_once '../config/config.php';

    $product_id = $_POST['product_id'];

    $query = "DELETE FROM `wishlist` WHERE product_id = :pid";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':pid' , $product_id);
    $stmt->execute();

    header("refresh: 0; url=../inc/wishlist.php");


?>