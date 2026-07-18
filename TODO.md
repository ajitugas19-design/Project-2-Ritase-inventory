# TODO - Perbaikan Hak Akses Manajemen

## Target
- Role **administrator**: hak penuh (add/edit/delete)
- Role **manajemen**: **tidak boleh edit & hapus** dan **tidak boleh tambah user**

## Langkah
- [ ] Tambahkan guard authorization (session level) pada semua endpoint `*_update.php` dan `*_hapus*.php` di folder `manajemen/` (tolak selain administrator).
- [ ] Tambahkan guard pada endpoint tambah user: `manajemen/user_tambah.php` dan action add user (`manajemen/user_act.php` jika ada) agar menolak selain administrator.
- [ ] Sembunyikan tombol Edit/Hapus di halaman list untuk semua modul (barang, barang masuk, barang keluar, suplier, peminjaman, user) jika role bukan administrator.
- [ ] Test:
  - Login manajemen: coba akses paksa URL update/hapus -> harus ditolak.
  - Login manajemen: tambah user -> harus ditolak.
  - Login manajemen: tambah modul selain user (barang/barang masuk/barang keluar/suplier/peminjaman) sesuai requirement -> tidak ditolak.
  - Login administrator: semuanya berjalan.

