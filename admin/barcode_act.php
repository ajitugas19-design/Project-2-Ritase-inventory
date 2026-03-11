<?php
include '../koneksi.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$barcode = isset($_POST['barcode']) ? $_POST['barcode'] : '';

if (empty($barcode)) {
    echo json_encode(['status' => 'error', 'message' => 'Barcode kosong']);
    exit;
}

// Escape barcode
$barcode_escape = mysqli_real_escape_string($koneksi, $barcode);

// Check if barcode exists
$query = "SELECT * FROM barang WHERE barcode = '$barcode_escape'";
$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    echo json_encode([
        'status' => 'exists',
        'barang_id' => $data['barang_id'],
        'barang_nama' => $data['barang_nama'],
        'barang_register' => $data['barang_register'],
        'barang_lokasi' => $data['barang_lokasi'],
        'barang_jumlah' => isset($data['barang_jumlah']) ? $data['barang_jumlah'] : 0,
        'barcode' => $data['barcode']
    ]);
} else {
    // Insert new barang
    $nama = 'Barang Baru';
    $register = '';
    $lokasi = '-';
    $jumlah = 1;
    
    // Cek dan tambahkan kolom barang_jumlah jika belum ada
    $cek_kolom = mysqli_query($koneksi, "SHOW COLUMNS FROM barang LIKE 'barang_jumlah'");
    if (mysqli_num_rows($cek_kolom) == 0) {
        mysqli_query($koneksi, "ALTER TABLE barang ADD COLUMN barang_jumlah INT DEFAULT 0");
    }
    
    $insert = "INSERT INTO barang (barang_nama, barang_register, barang_lokasi, barang_jumlah, barcode) 
               VALUES ('$nama', '$register', '$lokasi', $jumlah, '$barcode_escape')";
    
    if (mysqli_query($koneksi, $insert)) {
        $last_id = mysqli_insert_id($koneksi);
        echo json_encode([
            'status' => 'added',
            'barang_id' => $last_id,
            'barang_nama' => $nama,
            'barcode' => $barcode,
            'message' => 'Berhasil tambah barang'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => mysqli_error($koneksi)
        ]);
    }
}

