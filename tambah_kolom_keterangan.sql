-- Menambahkan kolom bm_keterangan ke tabel barang_masuk jika belum ada
ALTER TABLE barang_masuk ADD COLUMN bm_keterangan TEXT AFTER bm_lokasi_tujuan;
