<?php

require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../display/css/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

    <?php require_once '../inc/dashBoradNavInc.php' ?>

    <p>Home/<strong>About</strong></p>

    <div class="our-story-main-container">
        <div class="our-story-container">
            <h3>Our Story</h3>
            <p>Launced in 2015, Exclusive is South Asia’s premier online shopping makterplace with an active presense in Bangladesh. Supported by wide range of tailored marketing, data and service solutions, Exclusive has 10,500 sallers and 300 brands and serves 3 millioons customers across the region. </p>
            <p>Exclusive has more than 1 Million products to offer, growing at a very fast. Exclusive offers a diverse assotment in categories ranging  from consumer.</p>
        </div>
        <div class="our-story-image-container">
            <img src="../assets/photos/portrait-two-african-females-holding-shopping-bags-while-reacting-something-their-smartphone.jpg" alt="">
        </div>
    </div>

    <div class="about-services-main-container">
        <div class="services-container">
            <img src="../assets/photos/activeUsers.png" alt="">
            <h4>10.5k</h4>
            <p>Sallers active our site</p>
        </div>
        <div class="services-container">
            <img src="../assets/photos/monthlyProductSale.png" alt="">
            <h4>10.5k</h4>
            <p>Sallers active our site</p>
        </div>
        <div class="services-container">
            <img src="../assets/photos/activeUsers.png" alt="">
            <h4>10.5k</h4>
            <p>Sallers active our site</p>
        </div>
        <div class="services-container">
            <img src="../assets/photos/annualGross.png" alt="">
            <h4>10.5k</h4>
            <p>Sallers active our site</p>
        </div>
    </div>
    <div class="staff-main-container">
        <div class="staff-details-container">
            <img src="../assets/photos/tomCruise.png" alt="">
            <h5>Tom Cruise</h5>
            <p>Founder & Chairman</p>
            <div class="soccial-media-container">
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin-in"></i>
            </div>
        </div>
        <div class="staff-details-container">
            <img src="../assets/photos/emmaWatson.png" alt="">
            <h5>Emma Watson</h5>
            <p>Managing Director</p>
            <div class="soccial-media-container">
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin-in"></i>
            </div>
        </div>
        <div class="staff-details-container">
            <img src="../assets/photos/willSmith.png" alt="">
            <h5>Will Smith</h5>
            <p>Product Designer</p>
            <div class="soccial-media-container">
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin-in"></i>
            </div>
        </div>
    </div>

</body>
</html>