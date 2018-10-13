-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2018 at 10:46 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt_novi`
--

-- --------------------------------------------------------

--
-- Table structure for table `narudzbe`
--

CREATE TABLE `narudzbe` (
  `id` int(11) NOT NULL,
  `kolicina` varchar(30) NOT NULL,
  `id_user_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `proizvodac`
--

CREATE TABLE `proizvodac` (
  `id` int(11) NOT NULL,
  `naziv_proizvodaca` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proizvodac`
--

INSERT INTO `proizvodac` (`id`, `naziv_proizvodaca`) VALUES
(1, 'amd '),
(2, 'intel '),
(3, 'kingston'),
(4, 'western digital'),
(5, 'toshiba'),
(6, 'asus'),
(7, 'msi'),
(8, 'zotac'),
(9, 'gigabyte');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(11) NOT NULL,
  `ddr_type` varchar(30) DEFAULT NULL,
  `socket` varchar(30) DEFAULT NULL,
  `chipset` varchar(30) DEFAULT NULL,
  `id_proizvodac_fk` int(11) NOT NULL,
  `komponenta_tip_fk` int(11) NOT NULL,
  `velicina` varchar(30) DEFAULT NULL,
  `watt` varchar(30) DEFAULT NULL,
  `cijena` varchar(30) NOT NULL,
  `naziv_proizvoda` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `ddr_type`, `socket`, `chipset`, `id_proizvodac_fk`, `komponenta_tip_fk`, `velicina`, `watt`, `cijena`, `naziv_proizvoda`) VALUES
(3, 'DDR3', '', '', 3, 4, '4gb', '', '250.00', 'Kingston DDR3 ram stick 4gb');

-- --------------------------------------------------------

--
-- Table structure for table `tipovi_komponenti`
--

CREATE TABLE `tipovi_komponenti` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipovi_komponenti`
--

INSERT INTO `tipovi_komponenti` (`id`, `naziv`) VALUES
(1, 'cpu'),
(2, 'maticna_ploca'),
(3, 'napajanje'),
(4, 'memorija'),
(5, 'graficka_kartica'),
(6, 'hdd'),
(7, 'ssd');

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`id`, `status`) VALUES
(1, 'admin'),
(2, 'zaposlenik'),
(3, 'kupac');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `mjesto` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_status_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `prezime`, `mjesto`, `email`, `username`, `password`, `id_status_fk`) VALUES
(7, 'Ivan', 'Pedić', 'Vinkovci', 'pedic96@net.hr', 'getinthevan', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(8, 'Zdravko', 'Petričušić', 'Ivankovo', 'Zdrava53@gmail.com', 'zdrava', 'c9a43a39d6155531602c670e54b2a93b', 2),
(10, 'kupac', 'kupić', 'ghana', 'hasfdkh@gmail.com', 'kupusić', '827ccb0eea8a706c4c34a16891f84e7b', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `narudzbe`
--
ALTER TABLE `narudzbe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_fk` (`id_user_fk`);

--
-- Indexes for table `proizvodac`
--
ALTER TABLE `proizvodac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komponenta_tip_fk` (`komponenta_tip_fk`),
  ADD KEY `id_proizvodac_fk` (`id_proizvodac_fk`);

--
-- Indexes for table `tipovi_komponenti`
--
ALTER TABLE `tipovi_komponenti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_status_fk` (`id_status_fk`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `narudzbe`
--
ALTER TABLE `narudzbe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proizvodac`
--
ALTER TABLE `proizvodac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipovi_komponenti`
--
ALTER TABLE `tipovi_komponenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `narudzbe`
--
ALTER TABLE `narudzbe`
  ADD CONSTRAINT `narudzbe_ibfk_1` FOREIGN KEY (`id_user_fk`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_2` FOREIGN KEY (`komponenta_tip_fk`) REFERENCES `tipovi_komponenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proizvodi_ibfk_3` FOREIGN KEY (`id_proizvodac_fk`) REFERENCES `proizvodac` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_status_fk`) REFERENCES `uloge` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
