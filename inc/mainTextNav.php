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
</head>
<body>
        <div class="nav-explore-produtcs">
            <h2>Elevate Your Tech Game Today</h2>
            <h5>Discover cutting-edge gadgets, unbeatable prices, and fast delivery — all in one place. Shop smart. Shop the future.</h5>
            <h4>Free shipping on orders over €50 | Limited-time deals daily</h4>
        </div>
</body>
</html>