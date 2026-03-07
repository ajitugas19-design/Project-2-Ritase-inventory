# TODO: Implement Direct Quantity Update for Barang Masuk/Keluar

## Plan:

1. [x] Read and understand current implementation
2. [x] Edit admin/barang_masuk_act.php - Add quantity increase to barang table
3. [x] Edit admin/barang_keluar_act.php - Add quantity decrease with validation
4. [x] Edit manajemen/barang_masuk_act.php - Add quantity increase to barang table
5. [x] Edit manajemen/barang_keluar_act.php - Add quantity decrease with validation

## Implementation Details:

- **Barang Masuk**: Increase `barang_jumlah` by the input quantity
- **Barang Keluar**: Decrease `barang_jumlah` by the input quantity (with validation to ensure sufficient stock)

## Status: COMPLETED

## Summary:

1. **Barang Masuk Langsung Menambah**: admin/barang_masuk_act.php & manajemen/barang_masuk_act.php - Menambahkan jumlah ke tabel barang
2. **Barang Keluar Langsung Mengurangi**: admin/barang_keluar_act.php & manajemen/barang_keluar_act.php - Mengurangi jumlah dengan validasi stok
3. **Total Jumlah di Tampilan**: admin/barang_masuk.php, admin/barang_keluar.php, manajemen/barang_masuk.php, manajemen/barang_keluar.php
