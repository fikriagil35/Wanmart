-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jul 2021 pada 12.37
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
-- Struktur dari tabel `detail_hutang`
--

CREATE TABLE `detail_hutang` (
  `id_detail_hutang` int(3) NOT NULL,
  `id_hutang` int(3) NOT NULL,
  `total_bayar_hutang` int(11) NOT NULL,
  `tanggal_bayar_hutang` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `detail_hutang`
--

INSERT INTO `detail_hutang` (`id_detail_hutang`, `id_hutang`, `total_bayar_hutang`, `tanggal_bayar_hutang`) VALUES
(3, 2, 120000, '2021-07-19'),
(4, 3, 5000, '2021-07-20'),
(5, 5, 10000, '2021-07-21'),
(6, 6, 5000, '2021-07-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesan`
--

CREATE TABLE `detail_pesan` (
  `id_detail_pesan` int(3) NOT NULL,
  `id_user` int(3) NOT NULL,
  `id_pesan` int(3) NOT NULL,
  `balasan_pesan` text COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_balasan_pesan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `detail_pesan`
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
-- Struktur dari tabel `hutang`
--

CREATE TABLE `hutang` (
  `id_hutang` int(3) NOT NULL,
  `id_user` int(3) NOT NULL,
  `nama_hutang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan_hutang` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_hutang` int(11) NOT NULL,
  `tanggal_hutang` date NOT NULL,
  `tenggat_waktu_hutang` date NOT NULL,
  `status_hutang` enum('Lunas','Sedang dicicil','Belum lunas') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `hutang`
--

INSERT INTO `hutang` (`id_hutang`, `id_user`, `nama_hutang`, `keterangan_hutang`, `jumlah_hutang`, `tanggal_hutang`, `tenggat_waktu_hutang`, `status_hutang`) VALUES
(2, 4, 'Bejir', 'Ngotank koh wkwkkw', 120000, '2021-07-13', '2021-07-19', 'Lunas'),
(5, 4, 'Udin', 'Bayar plok', 10000, '2021-07-21', '2021-07-30', 'Lunas'),
(6, 4, 'udin', 'asdasd', 5000, '2021-07-20', '2021-07-28', 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(3) NOT NULL,
  `id_user` int(3) NOT NULL,
  `isi_pesan` text COLLATE utf8_unicode_ci NOT NULL,
  `status_pesan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_pesan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_user`, `isi_pesan`, `status_pesan`, `tanggal_pesan`) VALUES
(1, 4, 'dqwdqwdqdqwdqw', 'Selesai', '2021-07-14 12:28:50'),
(2, 4, 'tolol lu', 'Selesai', '2021-07-14 12:28:50'),
(3, 5, 'test ke admin', 'Selesai', '2021-07-14 12:28:50'),
(4, 4, 'oi', 'Selesai', '2021-07-15 12:38:16'),
(5, 4, 'test ke admin', 'Open', '2021-07-20 05:28:43'),
(6, 5, 'admin testke', 'Selesai', '2021-07-20 05:29:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(3) NOT NULL,
  `name_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `image_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password_user` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role_id_user` int(3) NOT NULL,
  `is_active_user` int(3) NOT NULL,
  `date_created_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name_user`, `email_user`, `image_user`, `password_user`, `role_id_user`, `is_active_user`, `date_created_user`) VALUES
(1, 'Fikri Agiel', 'fiqriagil35@gmail.com', 'Quote-Pahlawan.jpg', '$2y$10$LA0SD04XHvwOnkLygvq6LOzL3Mpp/S75edGXxUzvqQMNg1/E3tbAS', 1, 1, 1602912429),
(4, 'Udin', 'udin123@gmail.com', 'hari-pahlawan-533x261.png', '$2y$10$yXoKEK8x3R6pLYTaHeR6iuap.enR.UhQCpM54yzaEVeJTNB7ov/VC', 2, 1, 1606903556),
(5, 'Jacobus Hans Gradiyantod', 'jack123@gmail.com', 'kepalan_2.png', '$2y$10$NX/BapnRFyTVCzK/UI1MsOoUtfie64J8WDhSuZu8CnMCwIvdexSNq', 2, 1, 1623252124);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_hutang`
--
ALTER TABLE `detail_hutang`
  ADD PRIMARY KEY (`id_detail_hutang`);

--
-- Indeks untuk tabel `detail_pesan`
--
ALTER TABLE `detail_pesan`
  ADD PRIMARY KEY (`id_detail_pesan`);

--
-- Indeks untuk tabel `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_hutang`
--
ALTER TABLE `detail_hutang`
  MODIFY `id_detail_hutang` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detail_pesan`
--
ALTER TABLE `detail_pesan`
  MODIFY `id_detail_pesan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id_hutang` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
