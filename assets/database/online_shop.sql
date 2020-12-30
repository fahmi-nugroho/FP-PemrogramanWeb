-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2020 at 12:43 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

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
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `total` varchar(50) NOT NULL,
  `kurir` varchar(25) NOT NULL,
  `pembayaran` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_order`
--

INSERT INTO `daftar_order` (`id_order`, `id_user`, `nama`, `tanggal`, `alamat`, `no_telp`, `total`, `kurir`, `pembayaran`, `status`) VALUES
(1609156090, 2, 'rifan', '28/12/2020', 'Perumahan Sejahtera', '087755565562', '525000', 'JNE', 'Merchant', 'Menunggu Pembayaran');

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
  `id_order` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_detail`, `id_order`, `id_barang`, `jumlah`, `harga`) VALUES
(1, 1609156090, 4, 1, '500000');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(5) NOT NULL,
  `id_kategori` int(4) NOT NULL,
  `penjual` varchar(50) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` double NOT NULL,
  `stok` int(3) NOT NULL,
  `stars` int(10) NOT NULL,
  `gambar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `penjual`, `nama_produk`, `deskripsi`, `harga`, `stok`, `stars`, `gambar`) VALUES
(1, 2, 'YP', 'Playstation 4', 'Playstation 4', 3000000, 20, 7, 'produk1.png'),
(2, 2, 'G Shop', 'Nintendo Switch', 'Nintendo Switch', 5000000, 10, 6, 'produk2.png'),
(3, 3, 'G Shop', 'Controller Nintendo Switch', 'Controller Nintendo Switch', 900000, 15, 9, 'produk3.png'),
(4, 1, 'G Shop', 'Zelda BOTW Nintendo Switch', 'Zelda BOTW Nintendo Switch', 500000, 0, 8, 'produk4.png'),
(5, 1, 'KentuckyFans', 'Zelda Breath of the Wild Nintendo Switch (Baru)', 'Zelda BOTW Nintendo Switch', 4500000, 5, 10, 'produk4.png');

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
  `alamat_user` text,
  `foto_user` varchar(50) DEFAULT NULL,
  `wallet` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email_user`, `pass_user`, `telepon_user`, `alamat_user`, `foto_user`, `wallet`) VALUES
(1, 'a', 'a@a.a', 'a', '1', 'a', 'a', '0'),
(2, 'rifan', 'rifan@gmail.com', '$2y$10$WrsIP90rBde.0Hgp4PHKFuxaW1OmFkQDfWJEF2ixhaeQyPaS4HvkK', '087755565562', 'Perumahan Sejahtera', NULL, '0');

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
(4, 'Steam', 'steam1.png');

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
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_user_user` (`id_user`);

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
  ADD KEY `fk_order_order` (`id_order`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

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
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_order`
--
ALTER TABLE `daftar_order`
  ADD CONSTRAINT `fk_user_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_barang_produk` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `fk_order_order` FOREIGN KEY (`id_order`) REFERENCES `daftar_order` (`id_order`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
