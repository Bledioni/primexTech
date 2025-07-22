<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code Generator</title>
</head>
<body>

<form method="GET" action="">
  <input type="text" name="name" placeholder="Enter name">
  <button type="submit" name="generate">Generate QR Code</button>
</form>

<?php
if (isset($_GET['generate'])) {
    // Optional: use name from form
    $name = $_GET['name'] ?? '';

    // Generate random 10-digit number
    $randomNumber = '';
    for ($i = 0; $i < 10; $i++) {
        $randomNumber .= mt_rand(0, 9);
    }

    // You can combine name and number if needed
    $text = $randomNumber;

    // Generate QR code URL
    $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($text) . "&size=200x200";
    ?>

    <h2>QR Code for: <?= htmlspecialchars($text) ?></h2>
    <img src="<?= $qrUrl ?>" alt="QR Code">

<?php } ?>

</body>
</html>
