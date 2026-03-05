<?php 

$koneksi = mysqli_connect("localhost", "root", "" ,"project_inventaris");

// Handle AJAX request untuk pencarian barcode
if(isset($_GET['aksi']) && $_GET['aksi'] == 'cari_barcode') {
    $kode = $_GET['kode'];
    
    // Search by barcode or barang_id for backwards compatibility
    $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id = '$kode' OR barcode = '$kode'");
    $data = mysqli_fetch_assoc($query);
    
    if($data) {
        echo json_encode([
            'found' => true,
            'barang_id' => $data['barang_id'],
            'barang_nama' => $data['barang_nama'],
            'barang_lokasi' => $data['barang_lokasi'],
            'barang_jumlah' => $data['barang_jumlah'],
            'barcode' => isset($data['barcode']) ? $data['barcode'] : ''
        ]);
    } else {
        echo json_encode(['found' => false]);
    }
    exit;
}

?>
