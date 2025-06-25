<?php
    

    require_once '../config/config.php';
    if(!isset($_SESSION['role']) || $_SESSION['role'] !=="admin"){
        header("refresh: 0;url=../auth/login.php");
        die("");
    }


    $product_id = $_GET['product_id'];

    $query = "DELETE FROM products WHERE product_id = :productid";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':productid' , $product_id);
    if($stmt->execute()){

        echo "Product has been successfully deleted";
        $checkIfNullQuery = "SELECT * FROM products";
        $checkIfNullStmt = $conn->prepare($checkIfNullQuery);
        $checkIfNullStmt->execute();
        if($checkIfNullStmt->rowCount() === 0){

            header("refresh: 2; url=addProducts.php");

        }

    }

    else{

        echo "Something went wrong";

    }


?>