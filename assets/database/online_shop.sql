-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2021 at 06:36 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_web`
--

CREATE TABLE `admin_web` (
  `id_admin` int(3) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `jabatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` int(4) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `nama`) VALUES
(1, 'Game'),
(2, 'Console Game'),
(3, 'Aksesoris Game'),
(4, 'Voucher Game');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_order`
--

CREATE TABLE `daftar_order` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `total` varchar(50) NOT NULL,
  `kurir` varchar(25) NOT NULL,
  `pembayaran` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `bukti` varchar(100) DEFAULT NULL,
  `resi` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_order`
--

INSERT INTO `daftar_order` (`id`, `id_order`, `id_user`, `id_penjual`, `nama`, `tanggal`, `alamat`, `no_telp`, `total`, `kurir`, `pembayaran`, `status`, `bukti`, `resi`) VALUES
(7, 1609835888, 2, 4, 'Rifan', '05/01/2021', 'Perumahan Sejahtera', '087755565562', '9025000', 'JNE', 'Merchant', 'Menunggu Pengiriman', '5ff8e28b18a1b.jpg', NULL),
(8, 1609835888, 2, 3, 'Rifan', '05/01/2021', 'Perumahan Sejahtera', '087755565562', '10925000', 'JNE', 'Merchant', 'Pesanan Selesai', 'gagak akatsuki.png', 2147483647),
(9, 1609867120, 2, 3, 'Rifan', '06/01/2021', 'Perumahan Sejahtera', '087755565562', '6030000', 'POS', 'Credit Card', 'Menunggu Pembayaran', '', NULL),
(10, 1609956806, 2, 3, 'Rifan', '07/01/2021', 'Perumahan Sejahtera', '087755565562', '5035000', 'TIKI', 'Credit Card', 'Pesanan Dibatalkan', '', NULL),
(11, 1609966704, 2, 3, 'Rifan', '07/01/2021', 'Perumahan Sejahtera', '087755565562', '8025000', 'JNE', 'Wallet', 'Pesanan Dibatalkan', 'wallet.png', NULL),
(12, 1610197334, 2, 4, 'Rifan', '09/01/2021', 'Perumahan Sejahtera', '087755565562', '9525000', 'JNE', 'Merchant', 'Menunggu Pembayaran', NULL, NULL),
(13, 1610197334, 2, 3, 'Rifan', '09/01/2021', 'Perumahan Sejahtera', '087755565562', '925000', 'JNE', 'Merchant', 'Menunggu Pembayaran', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_orderv`
--

CREATE TABLE `daftar_orderv` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_voucher` varchar(50) NOT NULL,
  `jenis_voucher` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `nominal` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `pembayaran` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `bukti` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_orderv`
--

INSERT INTO `daftar_orderv` (`id`, `id_order`, `id_user`, `id_voucher`, `jenis_voucher`, `nama`, `tanggal`, `alamat`, `no_telp`, `nominal`, `total`, `pembayaran`, `status`, `bukti`) VALUES
(1, 1610277768, 2, 'haluboy', 1, 'Rifan', '10/01/2021', 'Perumahan Sejahtera', '087755565562', 50000, 52500, 'Wallet', 'Pesanan Selesai', 'wallet.png'),
(2, 1610300422, 2, 'haluboy', 2, 'Rifan', '11/01/2021', 'Perumahan Sejahtera', '087755565562', 100000, 105000, 'Merchant (Indomart / Alfamart)', 'Pesanan Selesai', '5ffb4d39cebd8.png'),
(3, 1610335533, 6, 'haluboy@gmail.com', 5, 'haluboy', '11/01/2021', 'haluland', '0891234567810', 100000, 105000, 'Merchant (Indomart / Alfamart)', 'Pesanan Dibatalkan', NULL),
(4, 1610336568, 6, 'haluboy@gmail.com', 5, 'haluboy', '11/01/2021', 'haluland', '0891234567810', 500000, 525000, 'Merchant (Indomart / Alfamart)', 'Pesanan Selesai', '5ffbc9409d60a.png'),
(5, 1610336706, 6, 'haluboy@gmail.com', 5, 'haluboy', '11/01/2021', 'haluland', '0891234567810', 100000, 105000, 'Merchant (Indomart / Alfamart)', 'Pesanan Selesai', '5ffbce681facf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id_news` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  `author` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `kategori` text NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_detail` int(11) NOT NULL,
  `id_daftar` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_detail`, `id_daftar`, `id_order`, `id_barang`, `jumlah`, `harga`) VALUES
(8, 7, 1609835888, 5, 2, '4500000'),
(9, 8, 1609835888, 3, 1, '900000'),
(10, 8, 1609835888, 2, 2, '5000000'),
(11, 9, 1609835888, 1, 2, '3000000'),
(12, 10, 1609956806, 2, 1, '5000000'),
(13, 11, 1609966704, 2, 1, '5000000'),
(14, 11, 1609966704, 1, 1, '3000000'),
(15, 12, 1610197334, 5, 2, '4500000'),
(16, 12, 1610197334, 4, 1, '500000'),
(17, 13, 1610197334, 3, 1, '900000');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(5) NOT NULL,
  `id_kategori` int(4) NOT NULL,
  `penjual` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` double NOT NULL,
  `stok` int(3) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `penjual`, `nama_produk`, `deskripsi`, `harga`, `stok`, `gambar`) VALUES
(1, 2, 3, 'Playstation 4', 'Playstation 4', 3000000, 20, 'produk1.png'),
(2, 2, 3, 'Nintendo Switch', 'Nintendo Switch', 5000000, 13, 'produk2.png'),
(3, 3, 3, 'Controller Nintendo Switch', 'Controller Nintendo Switch', 900000, 15, 'produk3.png'),
(4, 1, 4, 'Zelda BOTW Nintendo Switch', 'Zelda BOTW Nintendo Switch', 500000, 9, 'produk4.png'),
(5, 1, 4, 'Zelda Breath of the Wild Nintendo Switch (Baru)', 'Zelda BOTW Nintendo Switch', 4500000, 1, 'produk4.png');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `id_order`, `id_user`, `id_barang`, `rating`) VALUES
(1, 1609835888, 2, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE `statistik` (
  `ip` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email_user` varchar(25) NOT NULL,
  `pass_user` varchar(255) NOT NULL,
  `telepon_user` varchar(25) DEFAULT NULL,
  `alamat_user` text DEFAULT NULL,
  `foto_user` varchar(50) DEFAULT NULL,
  `wallet` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email_user`, `pass_user`, `telepon_user`, `alamat_user`, `foto_user`, `wallet`) VALUES
(2, 'Rifan', 'rifan@gmail.com', '$2y$10$WrsIP90rBde.0Hgp4PHKFuxaW1OmFkQDfWJEF2ixhaeQyPaS4HvkK', '087755565562', 'Perumahan Sejahtera', '5ff8151a950c1.jpg', '20995000'),
(3, 'Shop G', 'shopg@gmail.com', '$2y$10$UWRQWn4/EPE9VUw9aO7b6OD12U3PeBl50rU.cN2bnmAZjeBPNT.dK', '087755565561', NULL, NULL, NULL),
(4, 'X-Shop', 'xshop@gmail.com', '$2y$10$wyZFLQZjqbGPYssq7EQIzejRsYMsRWTY7P9L0zp9HQgJXgbHPofXS', NULL, NULL, NULL, NULL),
(6, 'haluboy', 'haluboy@gmail.com', '$2y$10$nJhjjxl2w.iwMZqU9eZ5XOqkNLA/FOK6OfKNRuxcq.rNZwBPvsTSG', '0891234567810', 'haluland', '5ffbc52015ba7.png', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int(11) NOT NULL,
  `jenis_voucher` varchar(20) NOT NULL,
  `gambar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `jenis_voucher`, `gambar`) VALUES
(1, 'Playstation Plus', 'playstation1.png'),
(2, 'Xbox Live', 'xbox1.png'),
(3, 'Google Play', 'googleplay1.png'),
(4, 'Steam', 'steam1.png'),
(5, 'My Shop', 'wallet.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_web`
--
ALTER TABLE `admin_web`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `daftar_order`
--
ALTER TABLE `daftar_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resi` (`resi`),
  ADD KEY `fk_user_user` (`id_user`),
  ADD KEY `fk_user_penjual` (`id_penjual`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `daftar_orderv`
--
ALTER TABLE `daftar_orderv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_news`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_barang_produk` (`id_barang`),
  ADD KEY `id_daftar` (`id_daftar`),
  ADD KEY `fk_id_order` (`id_order`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `penjual` (`penjual`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email_pembeli` (`email_user`),
  ADD UNIQUE KEY `telepon_user` (`telepon_user`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_web`
--
ALTER TABLE `admin_web`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `daftar_order`
--
ALTER TABLE `daftar_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `daftar_orderv`
--
ALTER TABLE `daftar_orderv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_order`
--
ALTER TABLE `daftar_order`
  ADD CONSTRAINT `fk_user_penjual` FOREIGN KEY (`id_penjual`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_barang_produk` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_daftar` FOREIGN KEY (`id_daftar`) REFERENCES `daftar_order` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_order` FOREIGN KEY (`id_order`) REFERENCES `daftar_order` (`id_order`) ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id_kategori`),
  ADD CONSTRAINT `fk_penjual` FOREIGN KEY (`penjual`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
