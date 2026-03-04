-- Menambahkan kolom barang_tanggal ke tabel barang
ALTER TABLE barang ADD COLUMN barang_tanggal DATE NULL AFTER barang_register;

-- Atau jika ingin kolom ada di posisi tertentu:
-- ALTER TABLE barang ADD COLUMN barang_tanggal DATE NULL AFTER barang_lokasi;
