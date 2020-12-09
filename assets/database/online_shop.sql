
CREATE TABLE `admin_web` (
  `id_admin` int(3) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `jabatan` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE `categories` (
  `id_kategori` int(4) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE `daftar_order` (
  `kode_order` varchar(25) NOT NULL,
  `tanggal_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `orders_info` text NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `konfirmasi` (
  `kode_order` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `jumlah_transfer` varchar(50) NOT NULL,
  `alamat_kirim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  `author` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `kategori` text NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `pembeli` (
  `kode_order` varchar(25) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `email_pembeli` varchar(25) NOT NULL,
  `telepon_pembeli` varchar(25) NOT NULL,
  `alamat_pembeli` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `produk` (
  `id_produk` int(5) NOT NULL,
  `category` varchar(20) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` double NOT NULL,
  `stok` varchar(3) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `statistik` (
  `ip` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `admin_web`
  ADD PRIMARY KEY (`id_admin`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`);

ALTER TABLE `daftar_order`
  ADD KEY `kode_order` (`kode_order`);

ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`kode_order`);

ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`kode_order`);

ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);
