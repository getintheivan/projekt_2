-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2018 at 08:12 PM
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
-- Table structure for table `mjesto`
--

CREATE TABLE `mjesto` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) NOT NULL,
  `pbr` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mjesto`
--

INSERT INTO `mjesto` (`id`, `naziv`, `pbr`) VALUES
(1, 'Vinkovci', '32100'),
(2, 'Zagreb', '10000'),
(5, 'konjevci', '11111'),
(6, 'Ivankovo', '32281'),
(7, 'Tovarnik', '55132');

-- --------------------------------------------------------

--
-- Table structure for table `narudzbe`
--

CREATE TABLE `narudzbe` (
  `id` int(11) NOT NULL,
  `id_naruceni_proizvodi_fk` varchar(255) NOT NULL,
  `id_user_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `narudzbe`
--

INSERT INTO `narudzbe` (`id`, `id_naruceni_proizvodi_fk`, `id_user_fk`) VALUES
(1, '8,9,10,15', 10),
(3, '19,20', 10);

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
(9, 'gigabyte'),
(10, 'corsair'),
(11, 'ms');

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
  `cijena` double NOT NULL,
  `naziv_proizvoda` varchar(255) NOT NULL,
  `url` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `ddr_type`, `socket`, `chipset`, `id_proizvodac_fk`, `komponenta_tip_fk`, `velicina`, `watt`, `cijena`, `naziv_proizvoda`, `url`) VALUES
(8, '', 'FCLGA1151', 'sdfs', 2, 1, '', '', 2200, 'core i5 8600k', 'https://www.hgshop.hr/articleImages/59075-878.jpg?preset=product-view'),
(9, '', 'FCLGA1151', '', 2, 1, '', '', 3100, 'core i7 8700k', 'https://www.hgshop.hr/articleImages/59074-878.jpg?preset=product'),
(10, '', 'LGA 2066', '', 2, 1, '', '', 16000, 'Core i9 7980XE', 'https://www.hgshop.hr/articleImages/57426-878.jpg?preset=product'),
(11, '', 'PGA AM4', '', 1, 1, '', '', 1000, 'Ryzen 3 1300X', 'https://www.hgshop.hr/articleImages/54314-878.jpg?preset=product'),
(12, '', 'PGA AM4', '', 1, 1, '', '', 1400, 'Ryzen 5 1400', 'https://www.hgshop.hr/articleImages/49074-878.jpg?preset=product'),
(13, '', 'PGA AM4', '', 1, 1, '', '', 1850, 'AMD Ryzen 5 2600X', 'https://www.hgshop.hr/articleImages/68309-878.jpg?preset=product'),
(14, '', 'PGA AM4', '', 1, 1, '', '', 2400, 'Ryzen 7 1700X', 'https://www.hgshop.hr/articleImages/48286-878.jpg?preset=product'),
(15, '', 'PGA AM4', '', 1, 1, '', '', 2500, 'Ryzen 7 1800X', 'https://www.hgshop.hr/articleImages/48287-878.jpg?preset=product'),
(16, '', 'PGA TR4', '', 1, 1, '', '', 7500, 'Ryzen ThreadRipper 1950X', 'https://www.hgshop.hr/articleImages/54945-878.jpg?preset=product'),
(17, 'DDR4', '', '', 3, 4, '4GB', '', 410, 'Kingston DDR4 ram stick 4gb', 'https://www.hgshop.hr/articleImages/35816-878.jpg?preset=product'),
(18, 'DDR4', '', '', 3, 4, '8GB', '', 550, 'Kingston DDR4 ram stick 8gb', 'https://www.hgshop.hr/articleImages/20762-878.jpg?preset=product'),
(19, '', '', 'Z170-A', 6, 2, '', '', 1050, 'ASUS Z170-A LGA1151 DDR4 HDMI ', 'https://www.asus.com/media/global/products/WljMlCHYYVrETxeq/P_setting_fff_1_90_end_500.png'),
(20, '', '', '', 10, 3, '', '450W', 320, 'Napajanje CORSAIR VS450, 450W,', 'https://www.hgshop.hr/articleImages/68537-878.jpg?preset=product'),
(21, 'GDDR5', '', '', 9, 5, '2GB', '', 2000, 'GIGABYTE nVidia GeForce GTX1050', 'https://www.hgshop.hr/articleImages/45284-878.jpg?preset=product'),
(22, '', '', '', 5, 6, '500Gb', '', 300, 'TOSHIBA P300, 3.5&quot;, 7200', 'https://www.hgshop.hr/articleImages/39802-878.jpg?preset=product'),
(23, '', '', '', 3, 7, '120Gb', '', 240, 'KINGSTON A400, 2.5&quot;, SATA', 'https://www.hgshop.hr/articleImages/50061-878.jpg?preset=product'),
(26, '', 'FCLGA1151', 'Z170-A', 2, 1, '', '', 2200, 'INTEL Core i7 5820k', 'https://i.ebayimg.com/images/g/YUoAAOSwbF1aKP1n/s-l300.jpg');

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
  `id_mjesto_fk` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_status_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `prezime`, `id_mjesto_fk`, `email`, `username`, `password`, `id_status_fk`) VALUES
(7, 'Ivan', 'Pedić', 1, 'pedic96@net.hr', 'getinthevan', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(8, 'Zdravko', 'Petričušić', 1, 'Zdrava53@gmail.com', 'zdrava', 'c9a43a39d6155531602c670e54b2a93b', 2),
(10, 'kupac', 'kupić', 1, 'hasfdkh@gmail.com', 'kupusić', '827ccb0eea8a706c4c34a16891f84e7b', 3),
(12, 'mario', 'maric', 2, 'mario@gmial.com', 'mateo-vk@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3),
(14, 'marido', 'marisc', 2, 'pedic96s@net.hr', 'mateo-vk@hoail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3),
(24, 'mario', 'marisc', 1, 'mario2@gmial.com', 'kupusić2', '81dc9bdb52d04dc20036dbd8313ed055', 3),
(36, 'ime', 'prezime', 2, 'email@gmail.com', 'username', 'password', 3),
(39, '$ime', '$prezime', 5, '$email', '$username', '$password', 3),
(41, 'test', 'tes', 5, 'test@gmail.com23', 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', 3),
(42, 'test', 'tes', 5, 'test@gmail.com3', 'tes', '098f6bcd4621d373cade4e832627b4f6', 3),
(43, 'poj', 'poj', 1, 'poj@mail.com', 'poj', 'fb7e2fcfe22f843b233fcd71eeb35a38', 3),
(44, 'pojph', 'pjpoj', 1, 'awdadsad@mail.com', 'phpoh', '7c70936ed7f280fa3a100fd2ba9708ae', 2),
(46, 'xdsqa', 'awdasd', 7, 'pedo_3luka@windowslive.com', 'testpassuser', '81dc9bdb52d04dc20036dbd8313ed055', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mjesto`
--
ALTER TABLE `mjesto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naziv` (`naziv`),
  ADD UNIQUE KEY `pbr` (`pbr`);

--
-- Indexes for table `narudzbe`
--
ALTER TABLE `narudzbe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_fk` (`id_user_fk`),
  ADD KEY `id_naruceni_proizvodi_fk` (`id_naruceni_proizvodi_fk`);

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
  ADD KEY `username` (`username`),
  ADD KEY `id_mjesto_fk` (`id_mjesto_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mjesto`
--
ALTER TABLE `mjesto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `narudzbe`
--
ALTER TABLE `narudzbe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `proizvodac`
--
ALTER TABLE `proizvodac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_status_fk`) REFERENCES `uloge` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_mjesto_fk`) REFERENCES `mjesto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
