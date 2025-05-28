-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql_db
-- Generation Time: May 23, 2025 at 03:07 PM
-- Server version: 9.3.0
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `mesaje_contact`
--

CREATE TABLE `mesaje_contact` (
  `id` int NOT NULL,
  `nume` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `mesaj` text,
  `data_trimitere` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mesaje_contact`
--

INSERT INTO `mesaje_contact` (`id`, `nume`, `email`, `mesaj`, `data_trimitere`) VALUES
(1, 'nex', 'mininex2.0@gamil.com', 'bafta tatiii', '2025-05-23 12:41:42'),
(2, 'sad', 'novacmatteo008@gmail.com', 'dadaad', '2025-05-23 13:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `trufe`
--

CREATE TABLE `trufe` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `denumire` varchar(100) DEFAULT NULL,
  `fisier` varchar(255) DEFAULT NULL,
  `data_upload` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trufe`
--

INSERT INTO `trufe` (`id`, `user_id`, `denumire`, `fisier`, `data_upload`) VALUES
(1, 1, 'llk', 'mustang.jpeg', '2025-05-23 09:52:39'),
(2, 1, 'llk', 'sortimente.jpg', '2025-05-23 12:47:19'),
(3, 3, 'llk2', 'trufa_mare.jpg', '2025-05-23 14:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id`, `username`, `email`, `parola`, `is_admin`) VALUES
(1, 'ghita', 'ghitaghita@gmail.com', '$2y$12$uzyWsp18bgdIIxos.oel6OH/QFX3sx.fuG6Y05IZ7GKjkLdO5hjj2', 0),
(2, 'NovacM', 'mininex2.0@gamil.com', '$2y$12$yhPis/TmntAQZ6n19zJfSu4n3tzoxwsn0MEt2dgtoTmHTmWxd23hq', 0),
(3, 'admin', 'novacmatteo008@gmail.com', '$2y$12$o3WlQMctK33651xeDSxOAO8A.WECxynseBU3bBEcYngLZWkarNzfm', 1),
(4, 'MATTEO', 'novacmatteo008@gmail.com', '$2y$12$1qbV4dhbUJ.6n3gUBQModOayElQf4CMetc7ApfeE0PToX1kv7ruBu', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mesaje_contact`
--
ALTER TABLE `mesaje_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trufe`
--
ALTER TABLE `trufe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mesaje_contact`
--
ALTER TABLE `mesaje_contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trufe`
--
ALTER TABLE `trufe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
