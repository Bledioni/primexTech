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
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/admin/adminDashboard.css">
    <link rel="stylesheet" href="../assets/admin/addProducts.css">
</head>
<body>

    <?php
    
         include_once '../inc/adminNavInc.php';

    ?>

<div class="main-container">

<?php

    include_once '../inc/adminInc.php';

?>

<a href="../admin/flashSales.php"><button>Flash Sales</button></a>
<a href="../admin/bestSellingProducts.php"><button>Best Selling Products</button></a>


</div>

</body>
</html>
