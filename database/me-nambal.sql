-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2019 at 02:21 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `me-nambal`
--

-- --------------------------------------------------------

--
-- Table structure for table `bensineceran`
--

CREATE TABLE `bensineceran` (
  `id_b` int(15) NOT NULL,
  `nama_b` varchar(50) NOT NULL,
  `jenis_usaha_b` varchar(25) NOT NULL,
  `alamat_b` varchar(50) NOT NULL,
  `jam_operasional_b` varchar(25) NOT NULL,
  `harga_b` varchar(15) NOT NULL,
  `no_hp_b` varchar(15) NOT NULL,
  `gambar_b` varchar(200) NOT NULL,
  `deskripsi_b` text NOT NULL,
  `lat_b` double NOT NULL,
  `lng_b` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bensineceran`
--

INSERT INTO `bensineceran` (`id_b`, `nama_b`, `jenis_usaha_b`, `alamat_b`, `jam_operasional_b`, `harga_b`, `no_hp_b`, `gambar_b`, `deskripsi_b`, `lat_b`, `lng_b`) VALUES
(3, 'Bensin Jie', 'Bensin Eceran', 'Jl. Harapan Raya Ujung', '07.00 - 23.00 WIB', 'Rp.10.000', '080923456789', '3.jpg', 'jangan lupa disini adalah tempat deskripsi dari lokasi bensin ecerannya, contoh :  bensin eceran ini berada di dekat pohon besar di samping warnet xxxx.net. dll :P', 0.501234, 101.464321),
(4, 'Bensin Tuyip', 'Bensin Eceran', 'Jl. Abdul Muis No 44.A', '06.00 - 22.00 WIB', 'Rp.10.000', '085271352013', '4.jpg', 'jangan lupa disini adalah tempat deskripsi dari lokasi bensin ecerannya, contoh :  bensin eceran ini berada di dekat pohon besar di samping warnet xxxx.net. dll :P', 0.504321, 101.468876),
(5, 'Bensin Eceran Haji Artos', 'Bensin Eceran', 'Jl. Lembaga Permasyarakatan Ujung', '09.00 - 23.00 WIB', 'Rp.10.000', '080912345678', '5.jpg', 'jangan lupa disini adalah tempat deskripsi dari lokasi bensin ecerannya, contoh :  bensin eceran ini berada di dekat pohon besar di samping warnet xxxx.net. dll :P', 0.523456, 101.768943);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bensineceran`
--

CREATE TABLE `laporan_bensineceran` (
  `id_laporan_bns` int(15) NOT NULL,
  `id_b` int(15) NOT NULL,
  `nama_b` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `jenis_usaha_b` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `alamat_b` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gambar_b` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nama_pelapor_bns` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isi_laporan_b` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `laporan_bensineceran`
--

INSERT INTO `laporan_bensineceran` (`id_laporan_bns`, `id_b`, `nama_b`, `jenis_usaha_b`, `alamat_b`, `gambar_b`, `nama_pelapor_bns`, `isi_laporan_b`) VALUES
(3, 3, 'Bensin Jie', 'Bensin Eceran', 'Jl. Harapan Raya Ujung', '5.jpg', 'asdas', 'asdasdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_tambalban`
--

CREATE TABLE `laporan_tambalban` (
  `id_laporan_tmb` int(15) NOT NULL,
  `id` int(15) NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `jenis_usaha` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nama_pelapor_tmb` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isi_laporan` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `laporan_tambalban`
--

INSERT INTO `laporan_tambalban` (`id_laporan_tmb`, `id`, `nama`, `jenis_usaha`, `alamat`, `gambar`, `nama_pelapor_tmb`, `isi_laporan`) VALUES
(1, 56, 'Testing', 'Tambal Ban', 'Testing', 'tambalban2018-12-19-20-05-11.png', 'Tuyip', 'ga valid nih bang lokasi, mohon di update ya aplikasin ya :)\r\n\r\n#2019pakaiaplikasimenambal');

-- --------------------------------------------------------

--
-- Table structure for table `tambalban`
--

CREATE TABLE `tambalban` (
  `id` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_usaha` varchar(25) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `jam_operasional` varchar(25) NOT NULL,
  `harga` varchar(15) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tambalban`
--

INSERT INTO `tambalban` (`id`, `nama`, `jenis_usaha`, `alamat`, `jam_operasional`, `harga`, `no_hp`, `gambar`, `deskripsi`, `lat`, `lng`) VALUES
(1, 'Jaya Motor', 'Tambal Ban', 'Jl.Abdul Muis', '06.00 - 22.00 WIB', 'Rp.10.000', '081212345612', '1.jpg', 'Disini berisikan mengenai detail dari lokasi tambal ban, berupa alamat pasti contoh : tambal ban nya dekat pohon besar dll sebagainya. atau dsini banyak geng motor hatihatiyaaa :p', 0.509067, 101.462195),
(2, 'Racing Motor', 'Tambal Ban', 'Jl.Pattimura', '07.00 - 20.00 WIB', 'Rp.10.000', '081212345612', '2.jpg', 'Disini berisikan mengenai detail dari lokasi tambal ban, berupa alamat pasti contoh : tambal ban nya dekat pohon besar dll sebagainya. atau dsini banyak geng motor hatihatiyaaa :p', 0.50868, 101.461881),
(4, 'Bhul Tambal Ban', 'Tambal Ban', 'Jl. Soekarno Hatta', '09.00 - 20.00 WIB', 'Rp.12.000', '081212345612', '4.jpg', 'Disini berisikan mengenai detail dari lokasi tambal ban, berupa alamat pasti contoh : tambal ban nya dekat pohon besar dll sebagainya. atau dsini banyak geng motor hatihatiyaaa :p', 0.509369, 101.462956),
(5, 'Qkule Tambal Ban', 'Tambal Ban', 'Jl.Lembaga Permasyarakatan', '10.00 - 16.00 WIB', 'Rp.11.000', '081212345612', '5.jpg', 'Disini berisikan mengenai detail dari lokasi tambal ban, berupa alamat pasti contoh : tambal ban nya dekat pohon besar dll sebagainya. atau dsini banyak geng motor hatihatiyaaa :p', 0.51025, 101.460869),
(56, 'Testing', 'Tambal Ban', 'Testing						  ', 'Testing', 'Rp. 10.000', '080900000000', 'tambalban2018-12-19-20-05-11.png', 'testing doang ini mah						  ', 0.49070079999999994, 101.4390784),
(57, 'Tambal Ban Kak Baya', 'Tambal Ban', 'Jl. Abdul Muis no xx						  ', '10.00 - 12.00 WIB', 'Rp. 10.000', '080900000000', 'tambalban2018-12-20-07-55-14.jpg', 'eh ternyata bukan tambalban tapi amperaa ! .....						  ', 0.5093769683210377, 101.46041393280031);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hak_akses` enum('admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `username`, `password`, `hak_akses`) VALUES
(1, 'Admin Me-Nambal', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bensineceran`
--
ALTER TABLE `bensineceran`
  ADD PRIMARY KEY (`id_b`);

--
-- Indexes for table `laporan_bensineceran`
--
ALTER TABLE `laporan_bensineceran`
  ADD PRIMARY KEY (`id_laporan_bns`),
  ADD KEY `id_b` (`id_b`);

--
-- Indexes for table `laporan_tambalban`
--
ALTER TABLE `laporan_tambalban`
  ADD PRIMARY KEY (`id_laporan_tmb`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tambalban`
--
ALTER TABLE `tambalban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bensineceran`
--
ALTER TABLE `bensineceran`
  MODIFY `id_b` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `laporan_bensineceran`
--
ALTER TABLE `laporan_bensineceran`
  MODIFY `id_laporan_bns` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `laporan_tambalban`
--
ALTER TABLE `laporan_tambalban`
  MODIFY `id_laporan_tmb` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tambalban`
--
ALTER TABLE `tambalban`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_bensineceran`
--
ALTER TABLE `laporan_bensineceran`
  ADD CONSTRAINT `laporan_bensineceran_ibfk_1` FOREIGN KEY (`id_b`) REFERENCES `bensineceran` (`id_b`);

--
-- Constraints for table `laporan_tambalban`
--
ALTER TABLE `laporan_tambalban`
  ADD CONSTRAINT `laporan_tambalban_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tambalban` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
