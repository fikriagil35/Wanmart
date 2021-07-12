-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jul 2021 pada 11.39
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `catatan`
--

CREATE TABLE `catatan` (
  `id` int(11) NOT NULL,
  `nama_hutang` varchar(30) NOT NULL,
  `jumlah_hutang` int(11) NOT NULL,
  `tanggal_hutang` date NOT NULL,
  `tenggat_hutang` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `catatan`
--

INSERT INTO `catatan` (`id`, `nama_hutang`, `jumlah_hutang`, `tanggal_hutang`, `tenggat_hutang`) VALUES
(33, 'hugo', 50000, '2021-07-11', '2021-07-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesan`
--

CREATE TABLE `detail_pesan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pesan_id` int(11) NOT NULL,
  `isi_balasan` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pesan`
--

INSERT INTO `detail_pesan` (`id`, `user_id`, `pesan_id`, `isi_balasan`, `tanggal`) VALUES
(1, 4, 1, 'wqdqdqwdqwdqwdqwd', '2021-06-12 04:23:36'),
(2, 4, 1, 'fdgergergergreg', '2021-06-12 04:23:39'),
(3, 4, 1, 'hrthrthtrhtrhtr', '2021-06-12 04:23:43'),
(4, 1, 1, 'wqdqwdwqdwq', '2021-06-12 04:24:00'),
(5, 1, 1, 'gergregegergg', '2021-06-12 04:24:04'),
(6, 1, 2, 'dasdsadsdsad', '2021-06-15 01:36:02'),
(7, 1, 2, 'wefesfgerg', '2021-06-15 01:36:07'),
(8, 1, 2, 'awdawdaw', '2021-06-15 01:36:10'),
(9, 1, 3, 'oke check\r\n', '2021-07-11 10:03:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_pesan` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id`, `user_id`, `isi_pesan`, `status`, `tanggal`) VALUES
(1, 4, 'dqwdqwdqdqwdqw', 'Selesai', '2021-06-12 09:24:08'),
(2, 4, 'tolol lu', 'Selesai', '2021-06-15 06:36:14'),
(3, 5, 'test ke admin', 'Selesai', '2021-07-11 15:03:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Fikri Agiel', 'fiqriagil35@gmail.com', 'bendera_indo1.jpg', '$2y$10$Qh7IJ0vNv4VPXS0HNxm4eOphHG0nba66x2FfD2Ah9TIE.qR.eAep2', 1, 1, 1602912429),
(4, 'Alifadun Udin', 'udin123@gmail.com', 'Logo_Fikri.jpg', '$2y$10$yXoKEK8x3R6pLYTaHeR6iuap.enR.UhQCpM54yzaEVeJTNB7ov/VC', 2, 1, 1606903556),
(5, 'Jacobus Hans Gradiyanto', 'jack123@gmail.com', 'ig.png', '$2y$10$NX/BapnRFyTVCzK/UI1MsOoUtfie64J8WDhSuZu8CnMCwIvdexSNq', 2, 1, 1623252124);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_pesan`
--
ALTER TABLE `detail_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `detail_pesan`
--
ALTER TABLE `detail_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
