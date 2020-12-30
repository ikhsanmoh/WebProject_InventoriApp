-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Des 2020 pada 15.02
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p_DBinventori`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_item`
--

CREATE TABLE `tb_item` (
  `id_item` int(11) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `id_kat` int(11) DEFAULT NULL,
  `harga_beli` int(9) NOT NULL,
  `harga_jual` int(9) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_item`
--

INSERT INTO `tb_item` (`id_item`, `nama_supplier`, `nama_item`, `id_kat`, `harga_beli`, `harga_jual`, `stok`, `tanggal`) VALUES
(1, 'PT. Garuda', 'MSI 2PL', 1, 12000000, 12500000, 10, '2020-12-18'),
(3, 'PT. TechID', 'RAM Cursial DDR3 2GB', 2, 900000, 999000, 25, '2020-12-19'),
(5, 'PT. Newbie', 'Hardisk Toshiba 500GB', NULL, 55000, 60000, 6, '2020-12-21'),
(6, 'PT. Metalica', 'Mousepad Dota 2', 8, 50000, 85000, 10, '2020-12-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kat` int(11) NOT NULL,
  `nama_kat` varchar(30) NOT NULL,
  `deskripsi_kat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kat`, `nama_kat`, `deskripsi_kat`) VALUES
(1, 'Laptop', 'Kategori mencakup berbagai macam tipe seperti Notebook, Ultrabook, Gaming Laptop dll.'),
(2, 'Komponen PC', 'Kategori mencakup RAM, VGA Card, Fan dll.'),
(8, 'Aksesoris', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_permintaan_item`
--

CREATE TABLE `tb_permintaan_item` (
  `id_permintaan` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_permintaan_item`
--

INSERT INTO `tb_permintaan_item` (`id_permintaan`, `id_item`, `jumlah`, `keterangan`, `tanggal`) VALUES
(5, 6, 100, 'stok menipis', '2020-12-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `nama`, `username`, `pass`) VALUES
(1, 'adminnya', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_kat` (`id_kat`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indeks untuk tabel `tb_permintaan_item`
--
ALTER TABLE `tb_permintaan_item`
  ADD PRIMARY KEY (`id_permintaan`),
  ADD KEY `id_item` (`id_item`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_permintaan_item`
--
ALTER TABLE `tb_permintaan_item`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_item`
--
ALTER TABLE `tb_item`
  ADD CONSTRAINT `kategori_link` FOREIGN KEY (`id_kat`) REFERENCES `tb_kategori` (`id_kat`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_permintaan_item`
--
ALTER TABLE `tb_permintaan_item`
  ADD CONSTRAINT `tb_item_link` FOREIGN KEY (`id_item`) REFERENCES `tb_item` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
