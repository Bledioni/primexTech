<?php

    require_once '../config/config.php';

    $product = $_GET['product_id'];
    if(isset($_GET['submit'])){

        $query = "DELETE FROM products WHERE product_id = :pid";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':pid' , $product);

        $stmt->execute();

        header("refresh:0;url=./viewProductsInc.php");

    }

?>