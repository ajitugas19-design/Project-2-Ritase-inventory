# TODO: Fix Barcode - Replace Google Charts API with PHP Library

## Problem

- Barcode tidak muncul karena menggunakan Google Charts API yang sudah dihentikan sejak 2019

## Solution

- Ganti `admin/barcode_img.php` menggunakan pure PHP dengan GD library

## Files Edited

- [x] admin/barcode_img.php - Replace Google Charts API with pure PHP Code128 implementation

## Files that Reference barcode_img.php (No changes needed - already working)

- admin/barang.php - references barcode_img.php
- manajemen/barang.php - references barcode_img.php

## Summary

- Menggunakan pure PHP dengan GD library (Code128)
- Kompatibel dengan semua versi PHP
  -Tidak perlu library eksternal
- Barcode dihasilkan secara lokal tanpa依赖 internet
