<!-- index.html -->
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
