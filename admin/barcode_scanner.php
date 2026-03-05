<?php
// Barcode Scanner Page - Uses html5-qrcode library
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scan Barcode</title>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 20px;
    }
    .scanner-container {
      max-width: 600px;
      margin: 0 auto;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    #reader {
      width: 100%;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .result-container {
      margin-top: 20px;
      padding: 15px;
      background: #e8f5e9;
      border: 1px solid #4caf50;
      border-radius: 4px;
      display: none;
    }
    .result-container.show {
      display: block;
    }
    .result-container h3 {
      margin: 0 0 10px 0;
      color: #2e7d32;
    }
    .result-container input {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 10px;
    }
    .btn-group {
      display: flex;
      gap: 10px;
    }
    .btn {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
      text-align: center;
    }
    .btn-primary {
      background: #337ab7;
      color: white;
    }
    .btn-danger {
      background: #d9534f;
      color: white;
    }
    .btn:hover {
      opacity: 0.9;
    }
    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 24px;
      cursor: pointer;
      color: #666;
    }
  </style>
</head>
<body>
  <div class="scanner-container">
    <h2 style="text-align: center;">Scan Barcode</h2>
    <div id="reader"></div>
    
    <div class="result-container" id="resultContainer">
      <h3>Hasil Scan:</h3>
      <input type="text" id="scanResult" readonly>
      <div class="btn-group">
        <button class="btn btn-primary" onclick="useResult()">Gunakan</button>
        <button class="btn btn-danger" onclick="closeScanner()">Tutup</button>
      </div>
    </div>
  </div>

  <script>
    let html5QrcodeScanner;
    
    function onScanSuccess(decodedText, decodedResult) {
      // Stop scanning
      html5QrcodeScanner.clear();
      
      // Show result
      document.getElementById('scanResult').value = decodedText;
      document.getElementById('resultContainer').classList.add('show');
    }
    
    function onScanFailure(error) {
      // Handle scan failure, usually better to ignore and keep scanning
    }
    
    // Initialize scanner
    html5QrcodeScanner = new Html5QrcodeScanner(
      "reader",
      { fps: 10, qrbox: {width: 250, height: 250} },
      /* verbose= */ false
    );
    
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    
    function useResult() {
      const result = document.getElementById('scanResult').value;
      // Send to parent window
      if (window.opener) {
        window.opener.postMessage({type: 'barcodeScan', barcode: result}, '*');
      }
      window.close();
    }
    
    function closeScanner() {
      window.close();
    }
  </script>
</body>
</html>

