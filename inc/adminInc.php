<?php

require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>


        <div class="side-bar">
        
            <a href="admin.php"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="../admin/addProducts.php"><i class="fa-solid fa-plus"></i> Add Products</a>
            <a href="../admin/viewProducts.php"><i class="fa-solid fa-clipboard-list"></i> View Products</a>
            <a href="../admin/addEmployee.php"><i class="fa-solid fa-user-plus"></i> Add An Employee</a>
            <a href="../auth/logout.php"><i class="fa-solid fa-circle-user"></i> Logout</a>
        </div>


</body>
</html>