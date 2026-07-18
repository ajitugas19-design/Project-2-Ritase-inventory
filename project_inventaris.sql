-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 09:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `barang_nama` varchar(100) NOT NULL,
  `barang_lokasi` int(11) DEFAULT NULL,
  `barang_register` varchar(50) DEFAULT '',
  `barang_tanggal` date DEFAULT NULL,
  `barcode` varchar(100) DEFAULT '',
  `barang_jumlah` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `barang_nama`, `barang_lokasi`, `barang_register`, `barang_tanggal`, `barcode`, `barang_jumlah`) VALUES
(2, 'Roll PP Beige 120cm x 157gsm (HAMPARAN)', 5, '', '2026-03-10', '', 0),
(3, 'Roll PP Beige 180cm x 157gsm (12x12) (Hamparan)', 5, '', NULL, '', 0),
(4, 'Roll PP Beige Laminasi Uk 180cm x 185gsm', 5, '', NULL, '', 0),
(5, 'Roll PP Beige Uk 180cm x 185gsm', 5, '', NULL, '', 0),
(6, 'Roll PP Beige Uk 200cm x 185gsm', 5, '', NULL, '', 0),
(7, 'Roll PP Hitam 180cm x 157gsm (Hamparan)', 5, '', NULL, '', 0),
(8, 'Roll PP HItam 180cm x 157gsm (Laminasi Bening)', 5, '', NULL, '', 0),
(9, 'Roll PP Laminasi Moni Strip Biru 65Cm x 54Gsm', 5, '', NULL, '', 0),
(10, 'Roll PP Mix 180cm x 157gsm', 5, '', NULL, '', 0),
(11, 'Roll PP Mix 56cm x 57gsm', 5, '', NULL, '', 0),
(12, 'Roll PP Mony 120cm x 57gsm (10/10)', 5, '', NULL, '', 0),
(13, 'Roll PP Mony 40cm x 57gsm (10x10)', 5, '', NULL, '', 0),
(14, 'Roll PP Mony 45cm x 57gsm', 5, '', NULL, '', 0),
(15, 'Roll PP Mony 50cm x 57gsm (10x10)', 5, '', NULL, '', 0),
(16, 'Roll PP Mony 56cm x 44gsm', 5, '', NULL, '', 0),
(17, 'Roll PP Mony 56cm x 57gsm', 5, '', NULL, '', 0),
(18, 'Roll PP Mony 60cm x 57gsm', 5, '', NULL, '', 0),
(19, 'Roll PP Mony 65cm x 57gsm (10x10)', 5, '', NULL, '', 0),
(20, 'Roll PP Mony 70cm x 57gsm', 5, '', NULL, '', 0),
(21, 'Roll PP Mony 75cm x 57gsm', 5, '', NULL, '', 0),
(22, 'Roll PP Mony 90cm x 57gsm', 5, '', NULL, '', 0),
(23, 'Roll PP Mony Strip Biru 65cm x 54gsm', 5, '', NULL, '', 0),
(24, 'Roll PP Mony Strip Biru 65cm x 57gsm', 5, '', NULL, '', 0),
(25, 'Roll PP Mony Strip Biru Merah 70cm x 57gsm', 5, '', NULL, '', 0),
(26, 'Roll PP Mony Strip Biru Merah Biru 125cm x 57gsm', 5, '', NULL, '', 0),
(27, 'Roll PP Mony Strip Biru Uk 110cm x 57gsm', 5, '', NULL, '', 0),
(28, 'Roll PP Mony Strip MBMBMB 75cm x 57gsm', 5, '', NULL, '', 0),
(29, 'Roll PP Mony Uk 51cm x 57gsm', 5, '', NULL, '', 0),
(30, 'Roll PP Mony uk 52cm x 57gsm', 5, '', NULL, '', 0),
(31, 'Roll PP Putih 125cm x 70gsm', 5, '', NULL, '', 0),
(32, 'Roll PP Putih 40cm x 52,5gsm', 5, '', NULL, '', 0),
(33, 'Roll PP Putih 45cm x 52,5gsm', 5, '', NULL, '', 0),
(34, 'Roll PP Putih 50cm x 52,5gsm', 5, '', NULL, '', 0),
(35, 'Roll PP Putih 50cm x 70gsm', 5, '', NULL, '', 0),
(36, 'Roll PP Putih 56cm x 52,5gsm', 5, '', NULL, '', 0),
(37, 'Roll PP Putih 56cm x 70gsm', 5, '', NULL, '', 0),
(38, 'Roll PP Putih 56cm x 87gsm (11x11)', 5, '', NULL, '', 0),
(39, 'Roll PP Putih 60cm x 52,5gsm 10x10', 5, '', NULL, '', 0),
(40, 'Roll PP Putih 65cm x 52,5gsm', 5, '', NULL, '', 0),
(41, 'Roll PP Putih 65cm x 70gsm (10x10)', 5, '', NULL, '', 0),
(42, 'Roll PP Putih 70cm x 52,5gsm', 5, '', NULL, '', 0),
(43, 'Roll PP Putih 75cm x 52,5gsm', 5, '', NULL, '', 0),
(44, 'Roll PP Putih 90cm x 52,5gsm', 5, '', NULL, '', 0),
(45, 'Roll PP Putih Laminasi 2 sisi 60cm x 52,5gsm', 5, '', NULL, '', 0),
(46, 'Roll PP Putih Strip Biru 110cm x 52,5gsm', 5, '', NULL, '', 0),
(47, 'Roll PP Putih Strip Biru 45cm x 52,5gsm', 5, '', NULL, '', 0),
(48, 'Roll PP Putih Strip Biru 56cm x 52,5gsm', 5, '', NULL, '', 0),
(49, 'Roll PP Putih Strip Biru Merah 125cm x 52,5gsm', 5, '', NULL, '', 0),
(50, 'Roll PP Putih Strip Biru Merah Biru Uk 120cm x 52,5gsm', 5, '', NULL, '', 0),
(51, 'Roll PP Putih Strip Biru Uk 60cm x 52,5gsm', 5, '', NULL, '', 0),
(52, 'Roll PP Putih Strip MBMBMB 75cm x 52,5gsm', 5, '', NULL, '', 0),
(53, 'Roll PP Putih Strip Merah 45cm x 52,5gsm', 5, '', NULL, '', 0),
(54, 'Roll PP Putih Strip Merah 50cm x 52,5gsm', 5, '', NULL, '', 0),
(55, 'Roll PP Putih Strip Merah 90cm x 52,5gsm', 5, '', NULL, '', 0),
(56, 'Roll PP Putih Susu 200cm x 185gsm (Rf)', 5, '', NULL, '', 0),
(57, 'Roll PP Putih Susu Laminasi Uk 200cm x 185gsm', 5, '', NULL, '', 0),
(58, 'Roll PP Putih Susu Uk 180cm x 185gsm', 5, '', NULL, '', 0),
(59, 'Roll PP Putih Uk 100cm x 52,5gsm', 5, '', NULL, '', 0),
(60, 'Roll PP Salur Hijau Hitam 120cm x 157gsm (Hamparan)', 5, '', NULL, '', 0),
(61, 'Roll PP Salur Hitam Beige 180cm x 157gsm (Hamparan)', 5, '', NULL, '', 0),
(62, 'Roll PP Salur Hitam Hijau 120cm x 157gsm (Hamparan)', 5, '', NULL, '', 0),
(63, 'Roll PP Salur Hitam Hijau 180cm x 157gsm (Hamparan)', 5, '', NULL, '', 0),
(64, 'Roll PP Salur Kuning Hitam 45cm x 52,2gsm (Gusset 8cm) (Hamparan)', 5, '', NULL, '', 0),
(65, 'Roll PP Salur Kuning Hitam 56cm x 52,2gsm (Gusset 8cm) (Hamparan)', 5, '', NULL, '', 0),
(66, 'Roll PP Salur Putih Biru 45cm x 52,5gsm (Gusset 5cm)', 5, '', NULL, '', 0),
(67, 'Roll PP Salur Putih Biru 56cm x 52,5gsm (Gusset 8cm)', 5, '', NULL, '', 0),
(68, 'Roll PP Salur Putih Merah 45cm x 52,5gsm (Gusset 5cm)', 5, '', NULL, '', 0),
(69, 'Roll PP Salur Putih Merah 56cm x 52,5gsm (Gusset 8cm)', 5, '', NULL, '', 0),
(70, 'Roll PP Salur Putih Merah Biru 45cm x 52,5gsm (Gusset 5cm)', 5, '', NULL, '', 0),
(71, 'Roll PP Salur Putih Merah Biru 56cm x 52,5gsm (Gusset 8cm)', 5, '', NULL, '', 0),
(72, 'Roll PP Transparan Strip Biru 35cm x 57gsm (10x10)', 5, '', NULL, '', 0),
(73, 'Roll PP Transparan Strip Hijau 40cm x 57gsm', 5, '', NULL, '', 0),
(74, 'Roll Sheet PP Hitam 400cm x 150gsm (Geotex PP)', 5, '', NULL, '', 0),
(75, 'Roll Sheet PP Hitam 400cm x 200gsm (Geotex PP)', 5, '', NULL, '', 0),
(76, 'Roll Sheet PP Hitam 400cm x 250gsm (Geotex PP)', 5, '', NULL, '', 0),
(77, 'Roll Sheet PP Hitam 400cm x 250gsm (Geotex PP) (Mtr)', 5, '', NULL, '', 0),
(78, 'Roll Sheet PP Hitam 400cm x 250gsm (Geotex PP) (Mtr) - Internal', 5, '', NULL, '', 0),
(79, 'Roll Sheet PP Mix 150cm x 57gsm', 5, '', NULL, '', 0),
(80, 'Roll Sheet PP Mix 180cm', 5, '', NULL, '', 0),
(82, 'Roll Sheet PP Mony 120cm x 57gsm', NULL, '', NULL, '', 0),
(83, 'Roll Sheet PP Mony 120cm x 57gsm (M)', NULL, '', NULL, '', 0),
(84, 'Roll Sheet PP Mony 150cm x 57gsm', NULL, '', NULL, '', 0),
(85, 'Roll Sheet PP Mony 20cm x 57gsm', NULL, '', NULL, '', 0),
(86, 'Roll Sheet PP Mony 220cm x 57gsm', NULL, '', NULL, '', 0),
(87, 'Roll Sheet PP Mony 240cm x 57gsm (10/10)', NULL, '', NULL, '', 0),
(88, 'Roll Sheet PP Mony 75cm x 57gsm', NULL, '', NULL, '', 0),
(89, 'Roll Sheet PP Mony Strip Biru Merah Biru uk 120cm x 57gsm', NULL, '', NULL, '', 0),
(90, 'Roll Sheet PP Putih 125cm x 52,5gsm', NULL, '', NULL, '', 0),
(91, 'Roll Sheet PP Putih 150cm x 52,5gsm', NULL, '', NULL, '', 0),
(92, 'Roll Sheet PP Putih 200cm x 52,5gsm', NULL, '', NULL, '', 0),
(93, 'Roll Sheet PP Putih 200cm x 52,5gsm - Internal', NULL, '', NULL, '', 0),
(94, 'Roll Sheet PP Putih 200cm x 52,5gsm (Mtr)', NULL, '', NULL, '', 0),
(95, 'Roll Sheet PP Putih 210cm x 52,5gsm', NULL, '', NULL, '', 0),
(96, 'Roll Sheet PP Putih 210cm x 52,5gsm (Mtr)', NULL, '', NULL, '', 0),
(97, 'Roll Sheet PP Putih 250cm x 70gsm', NULL, '', NULL, '', 0),
(98, 'Roll Sheet PP Putih 25cm x 52,5gsm', NULL, '', NULL, '', 0),
(99, 'Roll Sheet PP Putih 75cm x 52,5gsm', NULL, '', NULL, '', 0),
(100, 'Roll Sheet PP Putih Strip Biru 220cm x 52,5gsm', NULL, '', NULL, '', 0),
(101, 'Roll Sheet PP Putih Strip Biru Merah Biru 120cm x 52,5gsm (Mtr)', NULL, '', NULL, '', 0),
(102, 'Roll Sheet PP Putih Strip Biru Merah Biru Uk 120cm x 52,5gsm', NULL, '', NULL, '', 0),
(103, 'Roll Sheet PP Putih Strip Biru Uk 120cm x 52,5gsm', NULL, '', NULL, '', 0),
(105, 'Mikrotik', 1, '', NULL, '4752224009616', 0),
(106, 'Roll PP - Trial', 1, '', '2026-03-11', '201561904455', 0);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `bk_id` int(11) NOT NULL,
  `bk_id_barang` int(11) NOT NULL,
  `bk_register` varchar(50) DEFAULT '',
  `bk_nama_barang` varchar(100) NOT NULL,
  `bk_tgl_keluar` date NOT NULL,
  `bk_jumlah_keluar` int(11) NOT NULL,
  `bk_berat` varchar(50) DEFAULT '',
  `bk_id_gudang` int(11) DEFAULT NULL,
  `bk_id_gudang2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`bk_id`, `bk_id_barang`, `bk_register`, `bk_nama_barang`, `bk_tgl_keluar`, `bk_jumlah_keluar`, `bk_berat`, `bk_id_gudang`, `bk_id_gudang2`) VALUES
(6, 2, '', 'Roll PP Beige 120cm x 157gsm (HAMPARAN)', '2026-03-11', 1, '', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `bm_id` int(11) NOT NULL,
  `bm_id_barang` int(11) NOT NULL,
  `bm_register` varchar(50) DEFAULT '',
  `bm_nama_barang` varchar(100) NOT NULL,
  `bm_tgl_masuk` date NOT NULL,
  `bm_jumlah` int(11) NOT NULL,
  `bm_berat` varchar(50) DEFAULT '',
  `bm_id_gudang` int(11) DEFAULT NULL,
  `bm_id_gudang2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`bm_id`, `bm_id_barang`, `bm_register`, `bm_nama_barang`, `bm_tgl_masuk`, `bm_jumlah`, `bm_berat`, `bm_id_gudang`, `bm_id_gudang2`) VALUES
(27, 2, '', 'Roll PP Beige 120cm x 157gsm (HAMPARAN)', '2026-03-11', 1, '', 1, 3),
(28, 2, '', 'Roll PP Beige 120cm x 157gsm (HAMPARAN)', '2026-03-11', 1, '', 2, 3),
(29, 3, '', 'Roll PP Beige 180cm x 157gsm (12x12) (Hamparan)', '2026-03-11', 1, '', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `gudang_id` int(11) NOT NULL,
  `lokasi_asal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`gudang_id`, `lokasi_asal`) VALUES
(1, 'Gudang A'),
(2, 'Gudang B'),
(3, 'Gudang C'),
(4, 'Loom'),
(5, '');

-- --------------------------------------------------------

--
-- Table structure for table `gudang_2`
--

CREATE TABLE `gudang_2` (
  `gudang2_id` int(11) NOT NULL,
  `lokasi_tujuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gudang_2`
--

INSERT INTO `gudang_2` (`gudang2_id`, `lokasi_tujuan`) VALUES
(1, 'Gudang A'),
(2, 'Gudang B'),
(3, 'Gudang C'),
(4, 'Loom');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `pinjam_id` int(11) NOT NULL,
  `pinjam_peminjam` varchar(100) NOT NULL,
  `pinjam_barang` int(11) NOT NULL,
  `pinjam_jumlah` int(11) NOT NULL,
  `pinjam_tgl_pinjam` date NOT NULL,
  `pinjam_tgl_kembali` date DEFAULT NULL,
  `pinjam_kondisi` varchar(50) DEFAULT '',
  `pinjam_status` varchar(20) DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `suplier_id` int(11) NOT NULL,
  `suplier_nama` varchar(100) NOT NULL,
  `suplier_alamat` text DEFAULT '',
  `suplier_telepon` varchar(20) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) DEFAULT NULL,
  `user_username` varchar(50) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_level` varchar(20) DEFAULT NULL,
  `user_foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_level`, `user_foto`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'administrator', ''),
(2, 'Manajemen', 'manajemen', '7839a6a91b6a99d4c29852a0beaa18c8', 'manajemen', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `barang_lokasi` (`barang_lokasi`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`bk_id`),
  ADD KEY `bk_id_barang` (`bk_id_barang`),
  ADD KEY `bk_id_gudang` (`bk_id_gudang`),
  ADD KEY `bk_id_gudang2` (`bk_id_gudang2`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`bm_id`),
  ADD KEY `bm_id_barang` (`bm_id_barang`),
  ADD KEY `bm_id_gudang` (`bm_id_gudang`),
  ADD KEY `bm_id_gudang2` (`bm_id_gudang2`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`gudang_id`);

--
-- Indexes for table `gudang_2`
--
ALTER TABLE `gudang_2`
  ADD PRIMARY KEY (`gudang2_id`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`pinjam_id`),
  ADD KEY `pinjam_barang` (`pinjam_barang`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `bk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `gudang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gudang_2`
--
ALTER TABLE `gudang_2`
  MODIFY `gudang2_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `pinjam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`barang_lokasi`) REFERENCES `gudang` (`gudang_id`) ON DELETE SET NULL;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`bk_id_barang`) REFERENCES `barang` (`barang_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`bk_id_gudang`) REFERENCES `gudang` (`gudang_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `barang_keluar_ibfk_3` FOREIGN KEY (`bk_id_gudang2`) REFERENCES `gudang_2` (`gudang2_id`) ON DELETE SET NULL;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`bm_id_barang`) REFERENCES `barang` (`barang_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`bm_id_gudang`) REFERENCES `gudang` (`gudang_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`bm_id_gudang2`) REFERENCES `gudang_2` (`gudang2_id`) ON DELETE SET NULL;

--
-- Constraints for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pinjam_ibfk_1` FOREIGN KEY (`pinjam_barang`) REFERENCES `barang` (`barang_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
