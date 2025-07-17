
<?php

    require_once '../config/config.php';
    
    $uid = $_SESSION['user_id'];

                    $query = "SELECT * FROM cart_items WHERE user_id = :uid";
                    $stmt = $conn->prepare($query);

                    $stmt->bindParam(':uid' , $uid);

                    $stmt->execute();

                    $cartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../display/css/dashBoardNavInc.css">
</head>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const bars = document.getElementById("bars");
    const sidebar = document.getElementById("sidebar");

    bars.addEventListener("click", function () {
        sidebar.classList.toggle("active");

        // Smoothly switch between hamburger and X
        bars.classList.toggle("rotate");

        if (bars.classList.contains("fa-bars")) {
            bars.classList.remove("fa-bars");
            bars.classList.add("fa-xmark");
        } else {
            bars.classList.remove("fa-xmark");
            bars.classList.add("fa-bars");
        }
    });
});
</script>

<body>

    <!-- navbar per dashboard  -->
    <div class="main-container-nav">

        <h3>PrimexTech</h3>
        <div class="links">
            <a href="../display/dashBoard.php"><h3>Home</h3></a>
            <h3>Contact</h3>
            <h3>About</h3>
        </div>
        <div class="right-container">

            <div id="account-cart">

            <?php $cartItemCounter = 0; ?>

            <?php foreach ($cartData as $cart) { ?> 

                <?php 

                    $cartItemCounter += $cart['quantity']; 
                ?>

            <?php } ?>


                    <a href="../inc/cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    <div class="cartItemsCounter">
                        <p><?php echo $cartItemCounter; ?></p>
                    </div>


                <i id="account-cart-user" class="fa-solid fa-user"></i>
                
            </div>
            <i id="bars" class="fa-solid fa-bars"></i>


        </div>
    </div>

    <div id="search-bar">
        <form action="" method="GET">
            <input id="search" type="search" name="query" placeholder="Search...">
            <button id="submit" type="submit">Search</button>
        </form>
    </div>

    <div class="sidebar" id="sidebar">
  <div class="links">
      <a href="../display/dashBoard.php"><h3>Home</h3></a>
      <h3>Contact</h3>
      <h3>About</h3>
  </div>
  <div id="account-cart">
      <i class="fa-solid fa-cart-shopping"></i>
      <i class="fa-solid fa-user"></i>
      
  </div>
</div>


</body>
</html>