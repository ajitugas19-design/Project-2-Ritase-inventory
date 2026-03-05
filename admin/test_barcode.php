<?php
include '../koneksi.php';

header('Content-Type: text/plain');

$barcode = isset($_GET['barcode']) ? $_GET['barcode'] : '';

if (empty($barcode)) {
    echo "Error: No barcode provided. Use: test_barcode.php?barcode=YOURCODE";
    exit;
}

echo "Testing barcode: $barcode\n\n";

// Escape barcode
$barcode_escape = mysqli_real_escape_string($koneksi, $barcode);

// Check if barcode exists
$query = "SELECT * FROM barang WHERE barcode = '$barcode_escape'";
$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    echo "Status: EXISTS\n";
    echo "barang_id: " . $data['barang_id'] . "\n";
    echo "barang_nama: " . $data['barang_nama'] . "\n";
    echo "barcode: " . $data['barcode'] . "\n";
} else {
    echo "Status: NOT FOUND (will be added)\n";
    
    // Insert new barang
    $nama = 'Barang Baru';
    $register = '';
    $lokasi = '-';
    $jumlah = 1;
    
    $insert = "INSERT INTO barang (barang_nama, barang_register, barang_lokasi, barang_jumlah, barcode) 
               VALUES ('$nama', '$register', '$lokasi', $jumlah, '$barcode_escape')";
    
    if (mysqli_query($koneksi, $insert)) {
        $last_id = mysqli_insert_id($koneksi);
        echo "Insert: SUCCESS (barang_id: $last_id)\n";
    } else {
        echo "Insert: FAILED - " . mysqli_error($koneksi) . "\n";
    }
}

