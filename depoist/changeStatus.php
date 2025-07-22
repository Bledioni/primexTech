

<?php

    require_once '../config/config.php';

    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shipp'])){
        
        $order_id = $_POST['order_id'];

        $query= "UPDATE `orders` SET`status`='shipping' WHERE order_id = :oid";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':oid' , $order_id);
        $stmt->execute();

        header("refresh: 0;url=./depoist.php?order_id=$order_id");

        

    }
?>