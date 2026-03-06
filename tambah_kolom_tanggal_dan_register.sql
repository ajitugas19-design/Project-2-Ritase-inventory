-- Menambahkan kolom barang_register dan barang_tanggal ke tabel barang

-- Menambahkan kolom barang_register
ALTER TABLE barang ADD COLUMN barang_register VARCHAR(100) NULL AFTER barang_jumlah;

-- Menambahkan kolom barang_tanggal
ALTER TABLE barang ADD COLUMN barang_tanggal DATE NULL AFTER barang_register;

