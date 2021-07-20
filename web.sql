-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2021 at 10:40 PM
-- Server version: 8.0.25-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id` int NOT NULL,
  `nama_hutang` varchar(30) NOT NULL,
  `jumlah_hutang` int NOT NULL,
  `tanggal_hutang` date NOT NULL,
  `tenggat_hutang` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`id`, `nama_hutang`, `jumlah_hutang`, `tanggal_hutang`, `tenggat_hutang`) VALUES
(33, 'hugo', 50000, '2021-07-11', '2021-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `detail_hutang`
--

CREATE TABLE `detail_hutang` (
  `id_detail_hutang` int NOT NULL,
  `id_hutang` int NOT NULL,
  `total_bayar` int NOT NULL,
  `tanggal_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesan`
--

CREATE TABLE `detail_pesan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pesan_id` int NOT NULL,
  `isi_balasan` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detail_pesan`
--

INSERT INTO `detail_pesan` (`id`, `user_id`, `pesan_id`, `isi_balasan`) VALUES
(1, 4, 1, 'wqdqdqwdqwdqwdqwd'),
(2, 4, 1, 'fdgergergergreg'),
(3, 4, 1, 'hrthrthtrhtrhtr'),
(4, 1, 1, 'wqdqwdwqdwq'),
(5, 1, 1, 'gergregegergg'),
(6, 1, 2, 'dasdsadsdsad'),
(7, 1, 2, 'wefesfgerg'),
(8, 1, 2, 'awdawdaw'),
(9, 1, 3, 'oke check\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id_hutang` int NOT NULL,
  `id_user` int NOT NULL,
  `nama_hutang` varchar(50) NOT NULL,
  `keterangan_hutang` varchar(256) NOT NULL,
  `jumlah_hutang` int NOT NULL,
  `tanggal_hutang` date NOT NULL,
  `tenggat_waktu_hutang` date NOT NULL,
  `status` enum('Lunas','Sedang dicicil','Belum lunas') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`id_hutang`, `id_user`, `nama_hutang`, `keterangan_hutang`, `jumlah_hutang`, `tanggal_hutang`, `tenggat_waktu_hutang`, `status`) VALUES
(2, 4, 'Bejir', 'Ngotank koh wkwkkw', 120000, '2021-07-13', '2021-07-19', 'Belum lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `isi_pesan` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `user_id`, `isi_pesan`, `status`) VALUES
(1, 4, 'dqwdqwdqdqwdqw', 'Selesai'),
(2, 4, 'tolol lu', 'Selesai'),
(3, 5, 'test ke admin', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role_id` int NOT NULL,
  `is_active` int NOT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Fikri Agiel', 'fiqriagil35@gmail.com', 'bendera_indo1.jpg', '$2y$10$Qh7IJ0vNv4VPXS0HNxm4eOphHG0nba66x2FfD2Ah9TIE.qR.eAep2', 1, 1, 1602912429),
(4, 'Alifadun Udin', 'udin123@gmail.com', 'Logo_Fikri.jpg', '$2y$10$yXoKEK8x3R6pLYTaHeR6iuap.enR.UhQCpM54yzaEVeJTNB7ov/VC', 2, 1, 1606903556),
(5, 'Jacobus Hans Gradiyanto', 'jack123@gmail.com', 'ig.png', '$2y$10$NX/BapnRFyTVCzK/UI1MsOoUtfie64J8WDhSuZu8CnMCwIvdexSNq', 2, 1, 1623252124);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_hutang`
--
ALTER TABLE `detail_hutang`
  ADD PRIMARY KEY (`id_detail_hutang`);

--
-- Indexes for table `detail_pesan`
--
ALTER TABLE `detail_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `detail_hutang`
--
ALTER TABLE `detail_hutang`
  MODIFY `id_detail_hutang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pesan`
--
ALTER TABLE `detail_pesan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id_hutang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
