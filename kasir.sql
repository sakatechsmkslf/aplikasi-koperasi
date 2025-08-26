-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2025 at 09:38 AM
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
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) UNSIGNED NOT NULL,
  `nama` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `nama`) VALUES
(1, 'Le'),
(2, 'Alat Tulis1'),
(5, 'tes1'),
(6, 'oke1'),
(7, 'tes1'),
(8, 'gorengan'),
(9, 'uuyuy'),
(10, '0'),
(11, 'Makanan Rin'),
(12, 'Makanan Rin'),
(13, 'Makanan Rin');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(110) NOT NULL,
  `id_transaksi` int(110) NOT NULL,
  `id_barang` int(110) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `jumlah` int(111) NOT NULL,
  `subtotal` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_barang`, `nama_barang`, `jumlah`, `subtotal`) VALUES
(1, 1, 37, 'Lampu', 1, 12000),
(3, 2, 24, 'sukun', 2, 0),
(4, 2, 39, 'buku fiksi', 2, 40000),
(5, 3, 39, 'buku fiksi', 7, 140000),
(6, 4, 37, 'Lampu', 1, 12000),
(7, 5, 37, 'Lampu', 1, 12000),
(8, 6, 37, 'Lampu', 1, 12000),
(9, 7, 24, 'sukun', 1, 0),
(10, 8, 41, 'mikako', 2, 2000),
(11, 9, 45, 'Stella', 2, 22000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_tbl_barang` int(11) NOT NULL,
  `input_scanner` varchar(110) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `id_category` int(11) UNSIGNED NOT NULL,
  `harga` int(250) NOT NULL,
  `harga_jual` int(121) NOT NULL,
  `quantity` int(11) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_tbl_barang`, `input_scanner`, `nama_barang`, `id_category`, `harga`, `harga_jual`, `quantity`, `tanggal_input`) VALUES
(24, '8998127912363', 'sukun', 1, 30000, 0, 7, '0000-00-00 00:00:00'),
(37, '8885016193791', 'Lampu', 2, 10000, 12000, 0, '2025-02-06 04:22:24'),
(39, '22335R6009878', 'buku fiksi', 2, 100000, 20000, 100, '2025-02-23 01:41:03'),
(40, '8992761139018', 'aedes', 5, 90000, 100000, 67, '2025-07-26 05:42:52'),
(41, '8997033730023', 'mikako', 7, 900, 1000, 38, '2025-07-26 06:18:21'),
(42, '8995077605314', 'Usagi', 12, 900, 1000, 17, '2025-07-26 06:25:58'),
(43, '8993172000522', 'Choco Chips', 13, 1800, 2000, 2, '2025-07-26 06:43:56'),
(44, '8992775110171', 'Kacang Kulit Garuda', 12, 900, 1000, 11, '2025-07-26 06:47:40'),
(45, '8992779073304', 'Stella', 7, 10000, 11000, 18, '2025-08-14 06:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biaya`
--

CREATE TABLE `tbl_biaya` (
  `id_biaya` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_biaya` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendapatan`
--

CREATE TABLE `tbl_pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pendapatan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(110) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_harga` int(110) NOT NULL,
  `jumlah_uang` int(110) NOT NULL,
  `kembalian` int(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `tanggal_transaksi`, `total_harga`, `jumlah_uang`, `kembalian`) VALUES
(1, '2025-02-06', 16500, 20000, 3500),
(2, '2025-02-23', 40000, 50000, 10000),
(3, '2025-02-23', 140000, 150000, 10000),
(4, '2025-03-03', 12000, 13000, 1000),
(5, '2025-03-03', 12000, 20000, 8000),
(6, '2025-03-04', 12000, 20000, 8000),
(7, '2025-06-15', 0, 10000, 10000),
(8, '2025-07-26', 2000, 5000, 3000),
(9, '2025-08-14', 22000, 25000, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(210) NOT NULL,
  `user_nama` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_email`, `user_password`, `user_dibuat`) VALUES
(1, 'hanif', 'hanifdzikron@gmail.com', '202cb962ac59075b964b07152d234b70', '2025-01-13 14:27:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_tbl_barang`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `tbl_biaya`
--
ALTER TABLE `tbl_biaya`
  ADD PRIMARY KEY (`id_biaya`);

--
-- Indexes for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_tbl_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_biaya`
--
ALTER TABLE `tbl_biaya`
  MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pendapatan`
--
ALTER TABLE `tbl_pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(210) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `tbl_barang_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
