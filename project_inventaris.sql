-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, 0 */;


CREATE DATABASE IF NOT EXISTS `project_inventaris`
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE `project_inventaris`;

-- Dumping structure for table project_inventaris.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `barang_id` int NOT NULL AUTO_INCREMENT,
  `barang_nama` varchar(255) NOT NULL,
  `barang_register` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `barang_lokasi` varchar(255) DEFAULT NULL,
  `barang_kondisi` varchar(255) DEFAULT NULL,
  `barang_jumlah` int NOT NULL,
  `barang_sumber_dana` varchar(255) DEFAULT NULL,
  `barang_keterangan` text,
  `barang_jenis` varchar(10) NOT NULL,
  PRIMARY KEY (`barang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table project_inventaris.barang: ~4 rows (approximately)
INSERT INTO `barang` (`barang_id`, `barang_nama`, `barang_register`, `barang_lokasi`, `barang_kondisi`, `barang_jumlah`, `barang_sumber_dana`, `barang_keterangan`, `barang_jenis`) VALUES
	(1, 'ROLL PP HITAM 180CM X 157GSM', '878787', 'GUDANG A', 'KERING', 137, '', '', 'PET'),
	(2, 'ROLL PP SALUR HITAM HIJAU 180CM X 157GSM', '676767', 'GUDANG A', 'KERING', 17, '', '', 'PET'),
	(3, 'ROLL PP PUTIH 180CM X 193GSM', '888888', 'GUDANG B', 'KERING', 1, '', '', 'PET'),
	(4, 'ROLL PP BEIGE 180CM X 157GSM', '454545', 'GUDANG B', 'KERING', 1, '', '', 'PET');

-- Dumping structure for table project_inventaris.barang_keluar
CREATE TABLE IF NOT EXISTS `barang_keluar` (
  `bk_id` int NOT NULL AUTO_INCREMENT,
  `bk_id_barang` int NOT NULL DEFAULT '0',
  `bk_nama_barang` varchar(255) NOT NULL,
  `bk_tgl_keluar` date NOT NULL,
  `bk_jumlah_keluar` int NOT NULL,
  `bk_lokasi` varchar(255) DEFAULT NULL,
  `bk_penerima` varchar(255) DEFAULT NULL,
  `bk_keterangan` text,
  PRIMARY KEY (`bk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping structure for table project_inventaris.barang_masuk
CREATE TABLE IF NOT EXISTS `barang_masuk` (
  `bm_id` int NOT NULL AUTO_INCREMENT,
  `bm_id_barang` int NOT NULL,
  `bm_register` varchar(50) DEFAULT NULL,
  `bm_nama_barang` varchar(255) NOT NULL,
  `bm_tgl_masuk` date NOT NULL,
  `bm_jumlah` int NOT NULL,
  `bm_berat` int DEFAULT NULL,
  `bm_id_suplier` int DEFAULT NULL,
  `bm_lokasi_asal` varchar(255) DEFAULT NULL,
  `bm_lokasi_tujuan` varchar(255) DEFAULT NULL,
  `bm_keterangan` text,
  PRIMARY KEY (`bm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping structure for table project_inventaris.pinjam
CREATE TABLE IF NOT EXISTS `pinjam` (
  `pinjam_id` int NOT NULL AUTO_INCREMENT,
  `pinjam_peminjam` varchar(255) NOT NULL,
  `pinjam_barang` int NOT NULL,
  `pinjam_jumlah` int NOT NULL,
  `pinjam_tgl_pinjam` date NOT NULL,
  `pinjam_tgl_kembali` date NOT NULL,
  `pinjam_kondisi` varchar(255) DEFAULT NULL,
  `pinjam_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pinjam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table project_inventaris.pinjam: ~2 rows (approximately)
INSERT INTO `pinjam` (`pinjam_id`, `pinjam_peminjam`, `pinjam_barang`, `pinjam_jumlah`, `pinjam_tgl_pinjam`, `pinjam_tgl_kembali`, `pinjam_kondisi`, `pinjam_status`) VALUES
	(8, 'Natus sit unde fugi', 1, 21, '2019-04-19', '2019-04-27', 'Autem suscipit nesci', 'Dipinjam'),
	(9, 'SULAIMAN', 1, 1, '2019-08-03', '2019-08-05', 'BAGUS', 'Dikembalikan');

-- Dumping structure for table project_inventaris.suplier
CREATE TABLE IF NOT EXISTS `suplier` (
  `suplier_id` int NOT NULL AUTO_INCREMENT,
  `suplier_nama` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `suplier_alamat` varchar(255) NOT NULL,
  `suplier_telepon` varchar(255) NOT NULL,
  PRIMARY KEY (`suplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table project_inventaris.suplier: ~5 rows (approximately)
INSERT INTO `suplier` (`suplier_id`, `suplier_nama`, `suplier_alamat`, `suplier_telepon`) VALUES
	(7, 'LOOM', 'JL. MERPATI ALI NO.89', '09837373383'),
	(8, 'GUDANG A', 'JL. KELELAWAR NO.98', '08766373733'),
	(9, 'GUDANG B', 'JL. MERDEKA no. 898', '08737363734'),
	(10, 'GUDANG C', 'JL. MAWAR no.983', '08932345232'),
	(11, 'GUDANG D', 'Architecto et vel pe', '13');

-- Dumping structure for table project_inventaris.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL,
  `user_level` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table project_inventaris.user: ~3 rows (approximately)
INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `user_level`) VALUES
	(1, 'adit', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '705931782_mahasiswa961111255_VID-20180629-WA0001.jpg', 'administrator'),
	(6, 'Maimun', 'manajemen', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 'manajemen'),
	(7, 'ajir muhajir', 'ajir', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 'manajesiansi');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
