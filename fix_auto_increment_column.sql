-- Jalankan ini di phpMyAdmin untuk memperbaiki AUTO_INCREMENT pada tabel barang

-- 1. Pertama, cek struktur tabel barang saat ini
DESCRIBE barang;

-- 2. Set AUTO_INCREMENT pada kolom barang_id
ALTER TABLE barang MODIFY COLUMN barang_id INT NOT NULL AUTO_INCREMENT;

-- 3. Jika masih bermasalah, bisa juga:
-- ALTER TABLE barang CHANGE COLUMN barang_id barang_id INT NOT NULL AUTO_INCREMENT;

-- 4. Reset AUTO_INCREMENT ke 1
ALTER TABLE barang AUTO_INCREMENT = 1;
