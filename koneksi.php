<?php 

$koneksi = mysqli_connect("localhost", "root", "" ,"project_inventaris");

// Handle AJAX request untuk pencarian barcode
if(isset($_GET['aksi']) && $_GET['aksi'] == 'cari_barcode') {
    $kode = $_GET['kode'];
    
    // Search by barcode or barang_id for backwards compatibility
    $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id = '$kode' OR barcode = '$kode'");
    $data = mysqli_fetch_assoc($query);
    
    if($data) {
        // Get total masuk and keluar for this barang
        $masuk = mysqli_query($koneksi, "SELECT SUM(bm_jumlah) as total_masuk FROM barang_masuk WHERE bm_id_barang = '$kode'");
        $masuk_data = mysqli_fetch_assoc($masuk);
        $total_masuk = $masuk_data['total_masuk'] ? $masuk_data['total_masuk'] : 0;
        
        $keluar = mysqli_query($koneksi, "SELECT SUM(bk_jumlah_keluar) as total_keluar FROM barang_keluar WHERE bk_id_barang = '$kode'");
        $keluar_data = mysqli_fetch_assoc($keluar);
        $total_keluar = $keluar_data['total_keluar'] ? $keluar_data['total_keluar'] : 0;
        
        // Calculate displayed quantity
        $displayed_qty = $data['barang_jumlah'] + $total_masuk - $total_keluar;
        
        echo json_encode([
            'found' => true,
            'barang_id' => $data['barang_id'],
            'barang_nama' => $data['barang_nama'],
            'barang_tanggal' => isset($data['barang_tanggal']) ? $data['barang_tanggal'] : '',
            'barang_register' => isset($data['barang_register']) ? $data['barang_register'] : '',
            'barang_lokasi' => $data['barang_lokasi'],
            'barang_jumlah' => $data['barang_jumlah'],
            'barang_jumlah_tampilan' => $displayed_qty,
            'total_masuk' => $total_masuk,
            'total_keluar' => $total_keluar,
            'barcode' => isset($data['barcode']) ? $data['barcode'] : ''
        ]);
    } else {
        echo json_encode(['found' => false]);
    }
    exit;
}

// Handle AJAX request untuk get totals barang masuk/keluar
if(isset($_GET['aksi']) && $_GET['aksi'] == 'get_barang_totals') {
    $barang_id = $_GET['barang_id'];
    
    $masuk = mysqli_query($koneksi, "SELECT SUM(bm_jumlah) as total_masuk FROM barang_masuk WHERE bm_id_barang = '$barang_id'");
    $masuk_data = mysqli_fetch_assoc($masuk);
    $total_masuk = $masuk_data['total_masuk'] ? $masuk_data['total_masuk'] : 0;
    
    $keluar = mysqli_query($koneksi, "SELECT SUM(bk_jumlah_keluar) as total_keluar FROM barang_keluar WHERE bk_id_barang = '$barang_id'");
    $keluar_data = mysqli_fetch_assoc($keluar);
    $total_keluar = $keluar_data['total_keluar'] ? $keluar_data['total_keluar'] : 0;
    
    echo json_encode([
        'total_masuk' => $total_masuk,
        'total_keluar' => $total_keluar
    ]);
    exit;
}

// Handle AJAX request untuk get history barang masuk/keluar
if(isset($_GET['aksi']) && $_GET['aksi'] == 'get_barang_history') {
    $barang_id = $_GET['barang_id'];
    
    // Get all barang masuk records
    $masuk_query = mysqli_query($koneksi, "SELECT * FROM barang_masuk WHERE bm_id_barang = '$barang_id' ORDER BY bm_id DESC");
    $masuk_history = [];
    while($row = mysqli_fetch_assoc($masuk_query)) {
        $masuk_history[] = $row;
    }
    
    // Get all barang keluar records
    $keluar_query = mysqli_query($koneksi, "SELECT * FROM barang_keluar WHERE bk_id_barang = '$barang_id' ORDER BY bk_id DESC");
    $keluar_history = [];
    while($row = mysqli_fetch_assoc($keluar_query)) {
        $keluar_history[] = $row;
    }
    
    echo json_encode([
        'masuk' => $masuk_history,
        'keluar' => $keluar_history
    ]);
    exit;
}

?>
