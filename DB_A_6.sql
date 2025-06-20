-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 03:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baratie_resto3`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `nama_pelanggan`, `telepon`, `email`, `password`, `gambar`) VALUES
(1, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Alice', '081234567890', 'alicia@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user1.jpg'),
(2, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Mas El', '081234567891', 'masell@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user2.jpg'),
(3, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'King Dylan', '081234567892', 'kingdylan@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user3.jpg'),
(4, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Kaysar', '081234567893', 'Kaysar@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user4.jpg'),
(5, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Layla', '081234567894', 'Layla@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user5.jpg'),
(6, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Olivia', '081234567895', 'olivia@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user6.jpg'),
(7, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'James', '081234567896', 'james@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user7.jpg'),
(8, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Sophia', '081234567897', 'sophia@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user8.jpg'),
(9, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Benjamin', '081234567898', 'benjamin@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user9.jpg'),
(10, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Charlotte', '081234567899', 'charlotte@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user10.jpg'),
(11, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Alexander', '081234567800', 'alexander@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user11.jpg'),
(12, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Amelia', '081234567801', 'amelia@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user12.jpg'),
(13, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Daniel', '081234567802', 'daniel@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user13.jpg'),
(14, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Ella', '081234567803', 'ella@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user14.jpg'),
(15, '2024-12-16 23:10:22', '2024-12-16 23:10:22', 'Matthew', '081234567804', 'matthew@example.com', 'ffc4d8bb1b8e496377b33e287e33b3dc', 'public/images/user15.jpg'),
(16, '2024-12-17 02:28:48', '2024-12-17 02:28:48', 'gerry kontol 33', '12345678955', 'kaisar33@gmail.com', '$2y$12$iq8zkrdbuZFXeiUPitbTEOmRgIB8cjVsz304.cGY5P06PO7VTPiha', 'public/images/1734427728_WhatsApp Image 2024-09-12 at 07.20.35_5b69cbd6.jpg'),
(18, '2024-12-17 10:59:51', '2024-12-17 12:03:57', 'ariel', '12345678977', 'ariel@gmail', '$2y$12$gZCqa4l1sPEZgbtt9wIFkOqw1mwOBA/4GaDfSpNnz.6dTr7uuYOFW', 'public/images/1734462237_1734203066_DSC02354.JPG'),
(19, '2024-12-17 12:41:53', '2024-12-17 12:47:08', 'gus1', '08876757635675', 'gus@gmail.com', '$2y$12$HVABJYUakNyhqu0KXaFHV.muNzA4sFMILyu.G07FkXnDclGzrpway', 'public/images/1734464513_1734203066_DSC02354.JPG'),
(20, '2024-12-17 12:57:44', '2024-12-17 12:57:44', 'dylan', '0839379137937', 'dylan@gmail.com', '$2y$12$AIv6V4hamcbtFjv32QoqM.QMXWp/RYRiJ/0LTiYbROnb6SOJtBEB.', 'public/images/dJamcVxX0o8OYVhTEwidk1c9iLKfFY3psX8KVQPN.jpg'),
(23, '2024-12-17 16:37:12', '2024-12-17 16:37:12', 'admin', '1234567890', 'admin@gmail.com', '$2y$12$VPazZvYj29MDqm8Cgm0T/.ExBhxioyuUykolZpxJunLIMu8bQmWDa', 'public/images/cA1K84DQih24yxMrZaqIbfyJTuEA2dxT0d3jWyYX.jpg'),
(24, '2024-12-17 16:46:04', '2024-12-17 16:51:40', 'Elkaakaa', '12345678998', 'el@gmail.com', '$2y$12$SBbYNcZeGZgVBHDeaoaD8usKOuFNnsleMq/L6fT3PTLJpIJepDHQK', 'public/images/iWBraWzIHL0ePD2iclA7IMhMQmbVFTnS299Mupab.jpg'),
(25, '2024-12-17 17:56:49', '2024-12-17 17:56:49', 'aa', '09876567876575', 'aa@gmail.com', '$2y$12$dcYvc79uXi0WakyjlCGaneVaRQAbmY0Sxkif.7ggsuuphfnRf7Pui', 'public/images/Om9kyoKA2nJJ1ktEzOBqgARjHEFaeGkXgBZSAuXk.jpg'),
(26, '2024-12-17 19:14:51', '2024-12-17 19:14:51', 'userpw', '12345678978', 'userpw@gmail.com', '$2y$12$2.oiYL1EZtNPOQlKfMWmr.E/Zw.ylQnmEay/A6pLMcW2dcAbNr/vy', 'public/images/nUh37WcmopBDQ6fNOESB5QCPMK1D5a5kzhPKadZm.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nama_pelanggan_unique` (`nama_pelanggan`),
  ADD UNIQUE KEY `users_telepon_unique` (`telepon`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
