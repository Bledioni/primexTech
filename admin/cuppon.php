<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php require_once '../admin/adminNav.php' ?>

    <form action="" method="POST">
        <h4>Add Cuppon Code</h4>
        <input name="discount" type="number" required placeholder="Discount">
        <button name="submit" type="submit">Add</button>
    </form>
</body>
</html>

<?php

include_once '../config/config.php';

if(isset($_POST['submit'])){

    $discount = $_POST['discount'];

    function generateRandomCode($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomCode = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomCode;
    }
        $cuppon_code = generateRandomCode(12);
        

        $query = "INSERT INTO cuppon (discount , cuppon_code) VALUES (:discount , :cuppon_code)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':discount' , $discount);
        $stmt->bindParam(':cuppon_code' , $cuppon_code);

        $stmt->execute();

    }

?>
