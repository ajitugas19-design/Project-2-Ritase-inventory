-- SQL fix for barang_jumlah column
-- Run this in phpMyAdmin or MySQL

-- Add the missing column
ALTER TABLE barang ADD COLUMN barang_jumlah INT DEFAULT 0;

-- Verify the column was added
DESCRIBE barang;
