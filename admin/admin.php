
<?php

    require_once '../config/config.php';
    if(!isset($_SESSION['role']) || $_SESSION['role'] !=="admin"){
        header("refresh: 0;url=../auth/login.php");
        die("");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php require_once '../admin/adminNav.php' ?>!

    <?php require_once '../admin/dashboard.php' ?>

</body>
</html>