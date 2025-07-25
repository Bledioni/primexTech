<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../pannelInc/style/addProductQrCode.css">
  <link rel="stylesheet" href="../pannelInc/style/navBarInc.css">
</head>
<body>

  
<?php  

  require_once '../config/config.php';

  include_once '../pannelInc/navBarInc.php'

?>


  <div class="qr-code-reader">
    <div id="reader"></div>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
      function onScanSuccess(decodedText) {
        console.log("Scanned QR code:", decodedText);

        window.location.href = "process.php?qrCode=" + decodedText;

      }

      new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 })
        .render(onScanSuccess);
    </script>
  </div>
</body>
</html>

