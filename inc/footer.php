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
    <link rel="stylesheet" href="../display/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
    <div class="main-footer-container">
        <div class="footer-container">
        <div class="footer-top-container">
            <div class="footer-left-container">
                <div class="primex-container">
                <h3>Primex Store</h3>
                <h4 >Subscribe</h4>
                <p>Get 10% off your first order</p>
                <input type="text" placeholder="Enter Your Email">
            </div>
            <div class="support-container">
                <h3>Support</h3>
                <h4>111 Bijoy sarani, Dhaka,  DH 1515, Bangladesh.</h4>
                <p>primex@gmail.com</p>
                <p>+88015-88888-9999</p>
            </div>
            </div>

            <div class="footer-right-container">
                <div class="account-container">
                <h3>My Account</h3>
                <h4>Login / Register</h4>
                <h4>Cart</h4>
                <h4>Wishlist</h4>
                <h4>Shop</h4>
            </div>
            <div class="quick-learn-container">
                <h3>Quick Link</h3>
                <h4>Privacy Policy</h4>
                <h4>Terms Of Use</h4>
                <h4>FAQ</h4>
                <h4>Contact</h4>
            </div>
            <div class="download-app">
                <h3>Download App</h3>
                <p>Save $3 with App New User Only</p>
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin-in"></i>
            </div>
            </div>
        </div>
        <div class="footer-bottom-container">
            <p>Copyright PrimexStore 2025. All right reserved</p>
        </div>
    </div>
    </div>
</body>
</html>