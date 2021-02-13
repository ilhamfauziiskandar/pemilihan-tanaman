-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2020 at 02:19 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pemilihan_tanaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `iklim`
--

CREATE TABLE `iklim` (
  `id_iklim` int(3) NOT NULL,
  `date` date NOT NULL,
  `tekanan_udara` double NOT NULL,
  `kecepatan_angin` double NOT NULL,
  `kelembaban_udara` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iklim`
--

INSERT INTO `iklim` (`id_iklim`, `date`, `tekanan_udara`, `kecepatan_angin`, `kelembaban_udara`) VALUES
(1, '2020-01-01', 1012.9, 25, 83.88),
(2, '2020-02-01', 1013.6, 27.1, 87.43),
(3, '2020-03-01', 1012.9, 27.7, 85.65),
(4, '2020-04-01', 1013.4, 24.8, 86.24),
(5, '2020-05-01', 1013, 22.8, 85.47),
(6, '2020-06-01', 1013.2, 20.1, 81.72);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_parameter`
--

CREATE TABLE `nilai_parameter` (
  `id_nilai` int(3) NOT NULL,
  `tanggal` date NOT NULL,
  `suhu_param` double NOT NULL,
  `tekanan_param` double NOT NULL,
  `kecepatan_param` double NOT NULL,
  `curah_param` double NOT NULL,
  `ketinggian_param` double NOT NULL,
  `kelembaban_param` double NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_parameter`
--

INSERT INTO `nilai_parameter` (`id_nilai`, `tanggal`, `suhu_param`, `tekanan_param`, `kecepatan_param`, `curah_param`, `ketinggian_param`, `kelembaban_param`, `id_user`) VALUES
(1, '2020-07-26', 21, 21, 21, 21, 21, 21, 2),
(6, '2020-07-26', 21, 12, 12, 32, 31, 21, 2),
(7, '2020-07-26', 1, 1, 1, 1, 1, 1, 0),
(8, '2020-07-26', 24, 1011, 5, 68, 2000, 74, 0);

-- --------------------------------------------------------

--
-- Table structure for table `preferensi`
--

CREATE TABLE `preferensi` (
  `id_preferensi` int(2) NOT NULL,
  `peringkat` int(1) NOT NULL,
  `nilai_preferensi` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preferensi`
--

INSERT INTO `preferensi` (`id_preferensi`, `peringkat`, `nilai_preferensi`) VALUES
(1, 1, 100),
(2, 2, 80),
(3, 3, 60),
(4, 4, 40),
(5, 5, 20);

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(2) NOT NULL,
  `id_tnm` int(3) NOT NULL,
  `id_preferensi` int(2) NOT NULL,
  `hasil` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `id_tnm`, `id_preferensi`, `hasil`) VALUES
(1, 1, 1, 3265),
(2, 2, 3, 214),
(3, 3, 5, 108),
(4, 4, 4, 152),
(5, 5, 2, 366);

-- --------------------------------------------------------

--
-- Table structure for table `tanaman`
--

CREATE TABLE `tanaman` (
  `id_tnm` int(3) NOT NULL,
  `nm_tnm` varchar(50) NOT NULL,
  `suhu_tnm` double NOT NULL,
  `kelembaban_tnm` int(3) NOT NULL,
  `curah_tnm` double NOT NULL,
  `ketinggian_tnm` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tanaman`
--

INSERT INTO `tanaman` (`id_tnm`, `nm_tnm`, `suhu_tnm`, `kelembaban_tnm`, `curah_tnm`, `ketinggian_tnm`) VALUES
(1, 'Padi', 23, 75, 145.833, 1500),
(2, 'Jagung', 25, 75, 89.583, 1800),
(3, 'Kedelai', 24.5, 75, 56.25, 750),
(4, 'Ubi Jalar', 22.5, 80, 93.75, 1000),
(5, 'Ubi Kayu', 21, 80, 135.833, 800);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `level`) VALUES
(1, 'admin', 'admin', 'Admin', 1),
(2, 'risa', 'risa', 'Risa', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iklim`
--
ALTER TABLE `iklim`
  ADD PRIMARY KEY (`id_iklim`);

--
-- Indexes for table `nilai_parameter`
--
ALTER TABLE `nilai_parameter`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `preferensi`
--
ALTER TABLE `preferensi`
  ADD PRIMARY KEY (`id_preferensi`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`),
  ADD UNIQUE KEY `id_tnm` (`id_tnm`);

--
-- Indexes for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD PRIMARY KEY (`id_tnm`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iklim`
--
ALTER TABLE `iklim`
  MODIFY `id_iklim` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai_parameter`
--
ALTER TABLE `nilai_parameter`
  MODIFY `id_nilai` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `preferensi`
--
ALTER TABLE `preferensi`
  MODIFY `id_preferensi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tanaman`
--
ALTER TABLE `tanaman`
  MODIFY `id_tnm` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `produksi_ibfk_1` FOREIGN KEY (`id_tnm`) REFERENCES `tanaman` (`id_tnm`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
