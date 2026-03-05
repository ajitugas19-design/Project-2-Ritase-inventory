-- =====================================================
-- FIX: Out of range value for column 'barang_id'
-- =====================================================
-- Run this SQL in phpMyAdmin to fix the AUTO_INCREMENT issue

-- Step 1: Check current table structure
DESCRIBE barang;

-- Step 2: Fix the barang_id column to use INT (handles up to 2 billion)
ALTER TABLE barang MODIFY COLUMN barang_id INT UNSIGNED NOT NULL AUTO_INCREMENT;

-- Step 3: Reset AUTO_INCREMENT to continue from the highest existing ID
-- First, find the maximum current ID:
-- SELECT MAX(barang_id) FROM barang;
-- Then reset (change 100 to a number higher than your current max ID):
ALTER TABLE barang AUTO_INCREMENT = 1;

