-- Script untuk menambahkan user Manajemen
-- Anda bisa menjalankan ini di phpMyAdmin atau melalui command line MySQL

-- Contoh menambahkan user manajemen:
INSERT INTO user (user_id, user_nama, user_username, user_password, user_level, user_foto) 
VALUES (2, 'Manajemen', 'manajemen', MD5('manajemen123'), 'manajemen', '');

-- Atau jika Anda ingin menambahkan dengan nama lain:
-- INSERT INTO user (user_nama, user_username, user_password, user_level, user_foto) 
-- VALUES ('Nama Anda', 'username_anda', MD5('password_anda'), 'manajemen', '');

-- Catatan:
-- Username: manajemen
-- Password: manajemen123
