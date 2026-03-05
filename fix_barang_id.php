<?php
// Fix barang_id AUTO_INCREMENT issue
// Run this file in browser: http://localhost/project_inventaris/fix_barang_id.php

include 'koneksi.php';

echo "<h2>Fixing barang_id AUTO_INCREMENT</h2>";

echo "<h3>Step 1: Current table structure</h3>";
$result = mysqli_query($koneksi, "DESCRIBE barang");
if ($result) {
    echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
        
        if ($row['Field'] == 'barang_id') {
            echo "<tr><td colspan='6'><strong>Current barang_id type: " . $row['Type'] . " - " . $row['Extra'] . "</strong></td></tr>";
        }
    }
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

echo "<h3>Step 2: Fixing barang_id column</h3>";
$fix1 = mysqli_query($koneksi, "ALTER TABLE barang MODIFY COLUMN barang_id INT UNSIGNED NOT NULL AUTO_INCREMENT");
if ($fix1) {
    echo "✓ Modified barang_id to INT UNSIGNED AUTO_INCREMENT<br>";
} else {
    echo "✗ Error: " . mysqli_error($koneksi) . "<br>";
}

echo "<h3>Step 3: Resetting AUTO_INCREMENT to 1</h3>";
$fix2 = mysqli_query($koneksi, "ALTER TABLE barang AUTO_INCREMENT = 1");
if ($fix2) {
    echo "✓ Reset AUTO_INCREMENT to 1<br>";
} else {
    echo "✗ Error: " . mysqli_error($koneksi) . "<br>";
}

echo "<h3>Step 4: Verify fix</h3>";
$result = mysqli_query($koneksi, "DESCRIBE barang WHERE Field = 'barang_id'");
$row = mysqli_fetch_assoc($result);
echo "Current barang_id: " . $row['Type'] . " - " . $row['Extra'] . "<br>";

echo "<h3>Step 5: Current max barang_id</h3>";
$result = mysqli_query($koneksi, "SELECT MAX(barang_id) as max_id FROM barang");
$row = mysqli_fetch_assoc($result);
echo "Max barang_id: " . ($row['max_id'] ? $row['max_id'] : '0 (no records)') . "<br>";

echo "<h2>Fix complete! Try adding a new item now.</h2>";
echo "<a href='admin/barang_tambah.php'>Go to Tambah Barang</a>";
?>

