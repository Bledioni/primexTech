
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
    <link rel="stylesheet" href="../assets/admin/adminDashboard.css">
    <link rel="stylesheet" href="../assets/admin/addProducts.css">
</head>
<body>

   

    
        <?php

            include_once '../inc/adminNavInc.php';
            include_once '../inc/adminInc.php';

        ?>

   
</body>
</html>