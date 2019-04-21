-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2018 at 01:52 PM
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
-- Table structure for table `tambalban`
--

CREATE TABLE `tambalban` (
  `id` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tambalban`
--

INSERT INTO `tambalban` (`id`, `nama`, `gambar`, `lat`, `lng`) VALUES
(1, 'Jaya Motor', '1.jpg', 0.509067, 101.462195),
(2, 'Racing Motor', '2.jpg', 0.50868, 101.461881),
(3, 'Ohai Tambal Ban', '3.jpg', 0.50876, 101.461441),
(4, 'Bhul Tambal Ban', '4.jpg', 0.509369, 101.462956),
(5, 'Qkule Tambal Ban', '5.jpg', 0.51025, 101.460869);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tambalban`
--
ALTER TABLE `tambalban`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tambalban`
--
ALTER TABLE `tambalban`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
