-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2021 at 08:41 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id_bank` int NOT NULL,
  `nama_bank` varchar(15) NOT NULL,
  `nama_pemilik_bank` varchar(25) NOT NULL,
  `rekening_bank` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id_bank`, `nama_bank`, `nama_pemilik_bank`, `rekening_bank`) VALUES
(1, 'BANK PANIN', 'Berug Kuvukiland', '232421');

-- --------------------------------------------------------

--
-- Table structure for table `bukti_pembayaran`
--

CREATE TABLE `bukti_pembayaran` (
  `id_pembayaran` int NOT NULL,
  `nama_pengirim` varchar(25) NOT NULL,
  `nomor_rekening` varchar(12) NOT NULL,
  `bank_pengirim` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_bank` int NOT NULL,
  `status_pembayaran` enum('Menunggu Verifikasi','Terverifikasi','Tidak Valid') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto_bukti_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bukti_pembayaran`
--

INSERT INTO `bukti_pembayaran` (`id_pembayaran`, `nama_pengirim`, `nomor_rekening`, `bank_pengirim`, `id_bank`, `status_pembayaran`, `foto_bukti_pembayaran`) VALUES
(1, 'Bejir berug', '123412', 'BANK MANDIRI', 1, 'Terverifikasi', 'fd929618e4853b29dad676e8d0f01c281.png'),
(2, 'Hadeh', '123121', 'BANK BRI', 1, 'Terverifikasi', 'aefb1745c6484b6704107d2e252a0ff1.png');

-- --------------------------------------------------------

--
-- Table structure for table `detail_hutang`
--

CREATE TABLE `detail_hutang` (
  `id_detail_hutang` int NOT NULL,
  `id_hutang` int NOT NULL,
  `id_pembayaran` int NOT NULL,
  `total_bayar_hutang` int NOT NULL,
  `tanggal_bayar_hutang` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detail_hutang`
--

INSERT INTO `detail_hutang` (`id_detail_hutang`, `id_hutang`, `id_pembayaran`, `total_bayar_hutang`, `tanggal_bayar_hutang`) VALUES
(1, 6, 1, 400, '2021-09-18'),
(2, 6, 2, 100, '2021-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesan`
--

CREATE TABLE `detail_pesan` (
  `id_detail_pesan` int NOT NULL,
  `id_user` int NOT NULL,
  `id_pesan` int NOT NULL,
  `balasan_pesan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_balasan_pesan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detail_pesan`
--

INSERT INTO `detail_pesan` (`id_detail_pesan`, `id_user`, `id_pesan`, `balasan_pesan`, `tanggal_balasan_pesan`) VALUES
(1, 4, 1, 'wqdqdqwdqwdqwdqwd', '2021-07-14 12:28:48'),
(2, 4, 1, 'fdgergergergreg', '2021-07-14 12:28:48'),
(3, 4, 1, 'hrthrthtrhtrhtr', '2021-07-14 12:28:48'),
(4, 1, 1, 'wqdqwdwqdwq', '2021-07-14 12:28:48'),
(5, 1, 1, 'gergregegergg', '2021-07-14 12:28:48'),
(6, 1, 2, 'dasdsadsdsad', '2021-07-14 12:28:48'),
(7, 1, 2, 'wefesfgerg', '2021-07-14 12:28:48'),
(8, 1, 2, 'awdawdaw', '2021-07-14 12:28:48'),
(9, 1, 3, 'oke check\r\n', '2021-07-14 12:28:48'),
(10, 1, 5, 'oi', '2021-07-20 05:30:50'),
(11, 1, 6, 'asdasda', '2021-07-20 05:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id_hutang` int NOT NULL,
  `id_user` int NOT NULL,
  `nama_hutang` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keterangan_hutang` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_hutang` int NOT NULL,
  `tanggal_hutang` date NOT NULL,
  `tenggat_waktu_hutang` date NOT NULL,
  `status_hutang` enum('Lunas','Sedang dicicil','Belum lunas') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`id_hutang`, `id_user`, `nama_hutang`, `keterangan_hutang`, `jumlah_hutang`, `tanggal_hutang`, `tenggat_waktu_hutang`, `status_hutang`) VALUES
(2, 4, 'Bejir', 'Ngotank koh wkwkkw', 120000, '2021-07-13', '2021-07-19', 'Lunas'),
(5, 4, 'Udin', 'Bayar plok', 10000, '2021-07-21', '2021-08-14', 'Lunas'),
(6, 4, 'udin', 'asdasd', 5000, '2021-07-20', '2021-08-13', 'Sedang dicicil');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int NOT NULL,
  `id_user` int NOT NULL,
  `isi_pesan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_pesan` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_pesan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_user`, `isi_pesan`, `status_pesan`, `tanggal_pesan`) VALUES
(1, 4, 'dqwdqwdqdqwdqw', 'Selesai', '2021-07-14 12:28:50'),
(2, 4, 'tolol lu', 'Selesai', '2021-07-14 12:28:50'),
(3, 5, 'test ke admin', 'Selesai', '2021-07-14 12:28:50'),
(4, 4, 'oi', 'Selesai', '2021-07-15 12:38:16'),
(5, 4, 'test ke admin', 'Open', '2021-07-20 05:28:43'),
(6, 5, 'admin testke', 'Selesai', '2021-07-20 05:29:54'),
(8, 5, 'Bjir Jek', 'Open', '2021-08-12 17:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `name_user` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_user` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_user` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_user` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role_id_user` int NOT NULL,
  `is_active_user` int NOT NULL,
  `date_created_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name_user`, `email_user`, `image_user`, `password_user`, `role_id_user`, `is_active_user`, `date_created_user`) VALUES
(1, 'Fikri Agiel', 'fiqriagil35@gmail.com', 'Quote-Pahlawan.jpg', '$2y$10$LA0SD04XHvwOnkLygvq6LOzL3Mpp/S75edGXxUzvqQMNg1/E3tbAS', 1, 1, 1602912429),
(4, 'Udin', 'udin123@gmail.com', 'hari-pahlawan-533x261.png', '$2y$10$yXoKEK8x3R6pLYTaHeR6iuap.enR.UhQCpM54yzaEVeJTNB7ov/VC', 2, 1, 1606903556),
(5, 'Jacobus Hans Gradiyantod', 'jack123@gmail.com', 'kepalan_2.png', '$2y$10$NX/BapnRFyTVCzK/UI1MsOoUtfie64J8WDhSuZu8CnMCwIvdexSNq', 2, 1, 1623252124);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `detail_hutang`
--
ALTER TABLE `detail_hutang`
  ADD PRIMARY KEY (`id_detail_hutang`);

--
-- Indexes for table `detail_pesan`
--
ALTER TABLE `detail_pesan`
  ADD PRIMARY KEY (`id_detail_pesan`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id_bank` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_hutang`
--
ALTER TABLE `detail_hutang`
  MODIFY `id_detail_hutang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pesan`
--
ALTER TABLE `detail_pesan`
  MODIFY `id_detail_pesan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id_hutang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
