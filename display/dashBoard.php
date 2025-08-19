<?php

    require_once '../config/config.php';
    if(!isset($_SESSION['role']) || $_SESSION['role'] !=="user"){
        header("refresh: 0;url=../auth/login.php");
        die("");
    }

    $products = [];

    $query = "SELECT * FROM products WHERE type = 'flashsales'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if($stmt->rowCount() > 0){

        $products = $stmt->fetchAll();

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/dashBoard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"></link>

</head>
<body>

<?php
    
        include_once '../inc/dashBoradNavInc.php';

    ?>
    
    <?php
    
        include_once '../inc/mainTextNav.php';

    ?>

    <?php
    
        include_once '../inc/adDashBoardInc.php';

    ?>

<!-- Scrollable product row -->

<!-- Scroll buttons -->
<div id="todays">
    
    <div id="todays-header">
        <div id="todaysBox">
        
        </div>
        <div id="todays-text">
            Today’s
        </div>
    </div>

    <div id="todays-header-main">
        <h3>Flash Sales</h3>
        <div id="countdown-div">
            <div id="countdown-days">
                <p>Days</p>
                <p>Hours</p>
                <p>Minutes</p>
                <p>Seconds</p>
            </div>
            <div id="countdown"></div>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <button class="button" onclick="scrollLeft()"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="button" onclick="scrollRight()"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>
   
<div class="products-scroll" id="productContainer">
    <?php foreach($products as $product){ ?>
        <div class="products-secondary">

        <div>
            <a href="../inc/product.php?product_id=<?= $product['product_id'] ?>">
                <img class="product-photos" src="../uploads/<?= $product['image_path'] ?>" alt="">
            </a>
        </div>
            <div class="product-description">
                <h3><?= $product['name'] ?></h3>
                <p><?= $product['price'] ?>$</p>
             </div>
             <form action="../inc/product.php?product_id=<?=$product['product_id']?>" method="POST">
                        <input type="hidden" name="quantity" value="1">
                </form>
                <form action="../inc/cart.php">
                    <button class="wishlist-buy-now-button">Buy Now</button>
                </form>

        </div>
    <?php } ?>
</div>
</div>

<?php

    include_once '../inc/categories.php';

?>

<?php

    include_once '../inc/bestSellingProducts.php';

?>

<?php

    include_once '../inc/exploreOurProducts.php';

?>

<?php

    include_once '../inc/newArrival.php';

?>

<?php

    include_once '../inc/footer.php';

?>

</body>
</html>
<script src="../assets/js/imageSlider.js"></script>
<script src="../assets/js/countDown.js"></script>