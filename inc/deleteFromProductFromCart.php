<?php
require_once '../config/config.php';

$query = "DELETE FROM `cart_items` WHERE product_id = :pid";

$pid = $_POST['product_id'];

$stmt = $conn->prepare($query);
$stmt->bindParam(':pid', $pid);
$stmt->execute();

header("refresh: 0; url=../inc/cart.php");    

?>
