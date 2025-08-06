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
        <button name="submit" type="submit">Add</button>
    </form>
</body>
</html>

<?php

include_once '../config/config.php';
if(isset($_POST['submit'])){

    function generateRandomCode($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomCode = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomCode;
    }

    
        echo generateRandomCode(12) . "<br>":
    }

?>
