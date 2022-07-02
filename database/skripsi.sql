-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2022 at 11:49 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bapb`
--

CREATE TABLE `bapb` (
  `id` int(11) NOT NULL,
  `inv_bapb` varchar(200) NOT NULL,
  `inv_po` varchar(200) NOT NULL,
  `tglbapb` date NOT NULL,
  `id_ikan` int(11) NOT NULL,
  `jmlbapb` int(11) NOT NULL,
  `stok_in` int(11) NOT NULL,
  `pemasok` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bapb`
--

INSERT INTO `bapb` (`id`, `inv_bapb`, `inv_po`, `tglbapb`, `id_ikan`, `jmlbapb`, `stok_in`, `pemasok`, `user`) VALUES
(56, 'SISMON-BAPB-000001', 'SISMON-PO-000002', '2022-06-30', 2, 100000, 99900, 'PT. Facebook', 'admin'),
(57, 'SISMON-BAPB-000002', 'SISMON-PO-000001', '2022-06-30', 1, 100000, 99900, 'PT. Segar Food', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ikan`
--

CREATE TABLE `ikan` (
  `id` int(11) NOT NULL,
  `jenis_ikan` varchar(200) NOT NULL,
  `ukuran_ikan` int(11) NOT NULL,
  `hargabl_ikan` int(11) NOT NULL,
  `hargajl_ikan` int(11) NOT NULL,
  `stok_ikan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ikan`
--

INSERT INTO `ikan` (`id`, `jenis_ikan`, `ukuran_ikan`, `hargabl_ikan`, `hargajl_ikan`, `stok_ikan`) VALUES
(1, 'Bibit Ikan Lele C', 9, 170, 300, 99890),
(2, 'Bibit Ikan Lele B', 6, 100, 150, 99850),
(4, 'Bibit Ikan Lele A', 4, 70, 110, 0),
(5, 'Ikan Nila Konsumsi', 15, 4000, 6000, 0),
(13, 'Bibit Ikan Nila C', 7, 150, 300, 0),
(14, 'Bibit Ikan Nila B', 5, 100, 150, 0),
(15, 'Bibit Ikan Nila A', 2, 50, 80, 0),
(16, 'Ikan Lele Konsumsi', 18, 3000, 5000, 0),
(17, 'Bibit Ikan Gurame A', 3, 200, 300, 0),
(18, 'Bibit Ikan Gurame B', 5, 500, 700, 0),
(19, 'Bibit Ikan Gurame C', 9, 1000, 1500, 0),
(20, 'Ikan Gurame Konsumsi', 20, 6000, 8000, 0),
(21, 'Ikan Mas Konsumsi', 19, 5000, 6500, 0),
(22, 'Bibit Karper (Ikan Mas) C', 9, 300, 400, 0),
(23, 'Bibit Karper (Ikan Mas) B', 6, 150, 280, 0),
(24, 'Bibit Karper (Ikan Mas) A', 4, 80, 110, 0);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `penjual` varchar(200) NOT NULL,
  `jenis_ikan` varchar(200) NOT NULL,
  `ukuran_ikan` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_ikan` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang2`
--

CREATE TABLE `keranjang2` (
  `id` int(11) NOT NULL,
  `inv_penjualan` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL,
  `pelanggan` varchar(200) NOT NULL,
  `jenis_ikan` varchar(200) NOT NULL,
  `harga_ikan` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `tgl_jual` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang2`
--

INSERT INTO `keranjang2` (`id`, `inv_penjualan`, `user`, `pelanggan`, `jenis_ikan`, `harga_ikan`, `qty`, `diskon`, `tgl_jual`) VALUES
(1, 'asdasd', 'admin', 'kostumer umum', 'bibit lele', 10000, 10, 500, '2022-06-04'),
(2, 'qwe', 'qwe', 'qwe', 'qwe', 100000, 5, 5000, '2022-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `inv_penjualan` varchar(100) NOT NULL,
  `user` varchar(200) NOT NULL,
  `pelanggan` varchar(200) NOT NULL,
  `jenis_ikan` varchar(200) NOT NULL,
  `harga_ikan` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `tgl_jual` date NOT NULL,
  `sub_total` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `inv_pembelian` varchar(200) NOT NULL,
  `tgl_beli` date NOT NULL DEFAULT current_timestamp(),
  `jenis_ikan` varchar(200) NOT NULL,
  `harga_ikan` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `pembeli` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `inv_pembelian`, `tgl_beli`, `jenis_ikan`, `harga_ikan`, `qty`, `sub_total`, `status`, `pembeli`) VALUES
(7, 'SP-300622-000001', '2022-06-30', 'Bibit Ikan Lele C', 300, 10, 3000, 1, 'ahmad'),
(8, 'SP-300622-000001', '2022-06-30', 'Bibit Ikan Lele B', 150, 10, 1500, 0, 'ahmad'),
(9, 'SP-300622-000002', '2022-06-30', 'Bibit Ikan Lele B', 150, 50, 7500, 2, 'shali');

-- --------------------------------------------------------

--
-- Table structure for table `pajak`
--

CREATE TABLE `pajak` (
  `id` int(11) NOT NULL,
  `nama_pajak` varchar(200) NOT NULL,
  `persentase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pajak`
--

INSERT INTO `pajak` (`id`, `nama_pajak`, `persentase`) VALUES
(1, 'PPN', 5);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_data`
--

CREATE TABLE `penjualan_data` (
  `id` int(11) NOT NULL,
  `inv_penjualan` varchar(200) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `pajak` int(11) NOT NULL,
  `sub_diskon` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_data`
--

INSERT INTO `penjualan_data` (`id`, `inv_penjualan`, `sub_total`, `pajak`, `sub_diskon`, `total`, `pembayaran`, `kembalian`) VALUES
(39, 'ST-300622-000001', 45000, 2250, 0, 47250, 50000, 2750);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `inv_penjualan` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL,
  `pelanggan` varchar(200) NOT NULL,
  `jenis_ikan` varchar(200) NOT NULL,
  `harga_ikan` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `tgl_jual` date NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `inv_penjualan`, `user`, `pelanggan`, `jenis_ikan`, `harga_ikan`, `qty`, `diskon`, `tgl_jual`, `sub_total`) VALUES
(46, 'ST-300622-000001', 'admin', 'kostumer umum', 'Bibit Ikan Lele C', 300, 100, 0, '2022-06-30', 30000),
(47, 'ST-300622-000001', 'admin', 'kostumer umum', 'Bibit Ikan Lele B', 150, 100, 0, '2022-06-30', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `id` int(11) NOT NULL,
  `inv_po` varchar(200) NOT NULL,
  `id_ikan` int(11) NOT NULL,
  `tglpo` date NOT NULL,
  `jmlpo` int(11) NOT NULL,
  `terkirim` int(11) NOT NULL,
  `tersisa` int(11) NOT NULL,
  `retur` int(11) NOT NULL,
  `pemasok` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`id`, `inv_po`, `id_ikan`, `tglpo`, `jmlpo`, `terkirim`, `tersisa`, `retur`, `pemasok`, `user`, `subtotal`, `diskon`, `ppn`, `total`, `status`) VALUES
(37, 'SISMON-PO-000001', 1, '2022-06-30', 100000, 100000, 0, 0, 'PT. Segar Food', 'admin', 17000000, 350000, 850000, 17500000, 0),
(38, 'SISMON-PO-000002', 2, '2022-06-30', 100000, 100000, 0, 0, 'PT. Facebook', 'admin', 10000000, 0, 500000, 10500000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Pemasok'),
(3, 'Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `on_off` int(1) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `alamat`, `no_hp`, `on_off`, `id_role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Ponggok', '123', 0, 1),
(2, 'pemasok', 'c791ae5f7a631d97c10c1cda730ac61c', 'PT. Segar Food', 'Megelang', '123', 0, 2),
(3, 'kostumer', 'f7a222442b5e54ee3d1b192920fcebee', 'kostumer umum', 'umum', '123', 0, 3),
(10, 'zakia', '9784ea3da268563469df99b2e6593564', 'zakia', 'Kajoran', '123', 0, 3),
(14, 'indri', 'e24f6e3ce19ee0728ff1c443e4ff488d', 'indri', 'Magelang', '00001', 0, 3),
(18, 'mark', 'ea82410c7a9991816b5eeeebe195e20a', 'PT. Facebook', 'Magelang Kota', '999', 0, 2),
(20, 'rumahwp', 'ca2d8dd24c76aa641ee9ca7f683d931a', 'PT. Rumah WP', 'Muntilan', '9696', 0, 2),
(21, 'shali', '5e8607e54e817635b727ca3400561f90', 'Shali', 'Temanggung', '7766', 1, 3),
(22, 'ahmad', '61243c7b9a4022cb3f8dc3106767ed12', 'ahmad', 'Mungkid', '020598', 0, 3),
(23, 'instagram', 'ffe8560492ef96f860b965341d0c9698', 'PT. Instagram', 'Temanggung', '0011', 0, 2),
(24, 'zahra', 'eed83905a260b31bc5d254701999ee94', 'zahra', 'Borobudur', '0022', 0, 3),
(34, 'laut', '589866a4961da4ed2e7354026a936f4e', 'PT. LAUT SENJAYA', 'Yogyakarta', '001100', 0, 2),
(37, 'mega', '91805ec00ad20b85226bec0bacf843d3', 'mega', 'Mungkid', '6785', 0, 1),
(38, 'wirani', 'a2b709254388e32b3088d1662e0d2895', 'wirani', 'Mungkid', '56789', 0, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bapb`
--
ALTER TABLE `bapb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ikan`
--
ALTER TABLE `ikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang2`
--
ALTER TABLE `keranjang2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pajak`
--
ALTER TABLE `pajak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_data`
--
ALTER TABLE `penjualan_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
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
-- AUTO_INCREMENT for table `bapb`
--
ALTER TABLE `bapb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `ikan`
--
ALTER TABLE `ikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang2`
--
ALTER TABLE `keranjang2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pajak`
--
ALTER TABLE `pajak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penjualan_data`
--
ALTER TABLE `penjualan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
