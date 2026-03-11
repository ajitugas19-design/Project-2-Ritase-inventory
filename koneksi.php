
<?php 

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "project_inventaris";

$koneksi = mysqli_connect($host, $user, $pass, $db_name);

// Cek koneksi
if (!$koneksi) {
    // Coba koneksi tanpa memilih database untuk membuat database jika belum ada
    $koneksi_no_db = mysqli_connect($host, $user, $pass);
    
    if (!$koneksi_no_db) {
        die("Koneksi ke MySQL gagal: " . mysqli_connect_error());
    }
    
    // Buat database jika belum ada
    mysqli_query($koneksi_no_db, "CREATE DATABASE IF NOT EXISTS $db_name");
    mysqli_close($koneksi_no_db);
    
    // Sambung lagi dengan memilih database
    $koneksi = mysqli_connect($host, $user, $pass, $db_name);
    
    if (!$koneksi) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }
}

// Buat tabel-tabel jika belum ada
// Tabel user
$cek_user = mysqli_query($koneksi, "SHOW TABLES LIKE 'user'");
if (mysqli_num_rows($cek_user) == 0) {
    mysqli_query($koneksi, "
        CREATE TABLE user (
            user_id INT PRIMARY KEY AUTO_INCREMENT,
            user_nama VARCHAR(100),
            user_username VARCHAR(50),
            user_password VARCHAR(255),
            user_level VARCHAR(20),
            user_foto VARCHAR(255)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    
    // Insert user default
    $pass_admin = md5('admin123');
    $pass_manajemen = md5('manajemen123');
    
    mysqli_query($koneksi, "INSERT INTO user VALUES (1, 'Administrator', 'admin', '$pass_admin', 'administrator', '')");
    mysqli_query($koneksi, "INSERT INTO user VALUES (2, 'Manajemen', 'manajemen', '$pass_manajemen', 'manajemen', '')");
}

// Tabel gudang
$cek_gudang = mysqli_query($koneksi, "SHOW TABLES LIKE 'gudang'");
if (mysqli_num_rows($cek_gudang) == 0) {
    mysqli_query($koneksi, "
        CREATE TABLE gudang (
            gudang_id INT PRIMARY KEY AUTO_INCREMENT,
            lokasi_asal VARCHAR(100)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    mysqli_query($koneksi, "INSERT INTO gudang (lokasi_asal) VALUES ('Gudang Utama'), ('Gudang A'), ('Gudang B')");
}

// Tabel gudang_2
$cek_gudang2 = mysqli_query($koneksi, "SHOW TABLES LIKE 'gudang_2'");
if (mysqli_num_rows($cek_gudang2) == 0) {
    mysqli_query($koneksi, "
        CREATE TABLE gudang_2 (
            gudang2_id INT PRIMARY KEY AUTO_INCREMENT,
            lokasi_tujuan VARCHAR(100)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    mysqli_query($koneksi, "INSERT INTO gudang_2 (lokasi_tujuan) VALUES ('Toko Pusat'), ('Toko Branch 1')");
}

// Tabel barang
$cek_barang = mysqli_query($koneksi, "SHOW TABLES LIKE 'barang'");
if (mysqli_num_rows($cek_barang) == 0) {
    mysqli_query($koneksi, "
        CREATE TABLE barang (
            barang_id INT PRIMARY KEY AUTO_INCREMENT,
            barang_nama VARCHAR(100),
            barang_lokasi INT,
            barang_jumlah INT DEFAULT 0,
            barang_register VARCHAR(50),
            barang_tanggal DATE DEFAULT NULL,
            barcode VARCHAR(100)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
}

// Tabel barang_masuk
$cek_bm = mysqli_query($koneksi, "SHOW TABLES LIKE 'barang_masuk'");
if (mysqli_num_rows($cek_bm) == 0) {
    mysqli_query($koneksi, "
        CREATE TABLE barang_masuk (
            bm_id INT PRIMARY KEY AUTO_INCREMENT,
            bm_id_barang INT,
            bm_register VARCHAR(50),
            bm_nama_barang VARCHAR(100),
            bm_tgl_masuk DATE,
            bm_jumlah INT,
            bm_berat VARCHAR(50),
            bm_id_gudang INT,
            bm_id_gudang2 INT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
}

// Tabel barang_keluar
$cek_bk = mysqli_query($koneksi, "SHOW TABLES LIKE 'barang_keluar'");
if (mysqli_num_rows($cek_bk) == 0) {
    mysqli_query($koneksi, "
        CREATE TABLE barang_keluar (
            bk_id INT PRIMARY KEY AUTO_INCREMENT,
            bk_id_barang INT,
            bk_register VARCHAR(50),
            bk_nama_barang VARCHAR(100),
            bk_tgl_keluar DATE,
            bk_jumlah_keluar INT,
            bk_berat VARCHAR(50),
            bk_id_gudang INT,
            bk_id_gudang2 INT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
}

// Tabel pinjam
$cek_pinjam = mysqli_query($koneksi, "SHOW TABLES LIKE 'pinjam'");
if (mysqli_num_rows($cek_pinjam) == 0) {
    mysqli_query($koneksi, "
        CREATE TABLE pinjam (
            pinjam_id INT PRIMARY KEY AUTO_INCREMENT,
            pinjam_peminjam VARCHAR(100),
            pinjam_barang INT,
            pinjam_jumlah INT,
            pinjam_tgl_pinjam DATE,
            pinjam_tgl_kembali DATE,
            pinjam_kondisi VARCHAR(50),
            pinjam_status VARCHAR(20)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
}

// Tabel suplier
$cek_suplier = mysqli_query($koneksi, "SHOW TABLES LIKE 'suplier'");
if (mysqli_num_rows($cek_suplier) == 0) {
    mysqli_query($koneksi, "
        CREATE TABLE suplier (
            suplier_id INT PRIMARY KEY AUTO_INCREMENT,
            suplier_nama VARCHAR(100),
            suplier_alamat TEXT,
            suplier_telepon VARCHAR(20)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
}

// Handle AJAX request untuk pencarian barcode
if(isset($_GET['aksi']) && $_GET['aksi'] == 'cari_barcode') {
    $kode = $_GET['kode'];
    
    // Search by barcode or barang_id for backwards compatibility
    $query = mysqli_query($koneksi, "SELECT b.*, g.lokasi_asal as nama_lokasi FROM barang b LEFT JOIN gudang g ON b.barang_lokasi = g.gudang_id WHERE b.barang_id = '$kode' OR b.barcode = '$kode'");
    $data = mysqli_fetch_assoc($query);
    
    if($data) {
        // Use barang_id from the result (not $kode which could be barcode)
        $barang_id = $data['barang_id'];
        
        // Get total masuk and keluar for this barang
        $masuk = mysqli_query($koneksi, "SELECT SUM(bm_jumlah) as total_masuk FROM barang_masuk WHERE bm_id_barang = '$barang_id'");
        $masuk_data = mysqli_fetch_assoc($masuk);
        $total_masuk = $masuk_data['total_masuk'] ? $masuk_data['total_masuk'] : 0;
        
        $keluar = mysqli_query($koneksi, "SELECT SUM(bk_jumlah_keluar) as total_keluar FROM barang_keluar WHERE bk_id_barang = '$barang_id'");
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
            'nama_lokasi' => isset($data['nama_lokasi']) ? $data['nama_lokasi'] : '',
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


