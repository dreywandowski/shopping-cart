-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 13, 2021 at 05:57 PM
-- Server version: 10.5.4-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING HASH
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `created_at`, `updated_at`, `name`, `price`, `type`, `file_path`) VALUES
(1, '2021-04-10 22:24:58', '2021-04-10 22:24:58', 'man_1', 3000, 'man', '/images/man_1.jpeg'),
(2, '2021-04-10 22:25:15', '2021-04-10 22:25:15', 'man_2', 6000, 'man', '/images/man_2.jpeg'),
(3, '2021-04-13 21:04:25', '2021-04-13 21:04:25', 'shoe', 2500, 'woman', '/images/woman_1.jpeg'),
(4, '2021-04-13 21:04:25', '2021-04-13 21:04:25', 'womann', 1900, 'woman', '/images/woman_2.jpeg'),
(5, '2021-04-13 21:08:37', '2021-04-13 21:08:37', 'children', 2300, 'child', '/images/child_1.jpeg'),
(6, '2021-04-13 21:08:37', '2021-04-13 21:08:37', 'cute', 980, 'child', '/images/child_2.jpeg'),
(7, '2021-04-13 21:08:37', '2021-04-13 21:08:37', 'cute_1', 980, 'child', '/images/child_3.jpeg'),
(8, '2021-04-10 22:25:15', '2021-04-10 22:25:15', 'man_3', 5000, 'man', '/images/man_3.jpeg'),
(9, '2021-04-10 22:25:15', '2021-04-10 22:25:15', 'man dashion', 5000, 'man', '/images/man_4.jpeg'),
(10, '2021-04-13 21:04:25', '2021-04-13 21:04:25', 'womannly', 2090, 'woman', '/images/woman_3.jpg'),
(11, '2021-04-13 21:04:25', '2021-04-13 21:04:25', 'womannl', 209, 'woman', '/images/woman_4.jpg'),
(12, '2021-04-13 21:08:37', '2021-04-13 21:08:37', 'cutie', 2980, 'child', '/images/child_4.jpeg'),
(13, '2021-04-13 22:12:58', '2021-04-13 22:12:58', 'shoes', 10000, 'man', '/images/shoe_1.jpg'),
(14, '2021-04-13 22:12:58', '2021-04-13 22:12:58', 'tank top', 1200, 'woman', '/images/cloth_1.jpg'),
(15, '2021-04-13 22:12:58', '2021-04-13 22:12:58', 'top', 5000, 'man', '/images/cloth_2.jpg'),
(16, '2021-04-13 22:12:58', '2021-04-13 22:12:58', 'cloth', 2000, 'man', '/images/cloth_3.jpg'),
(17, '2021-04-13 22:12:58', '2021-04-13 22:12:58', 'cloth item', 7000, 'man', '/images/man_5.jpeg'),
(18, '2021-04-13 22:12:58', '2021-04-13 22:12:58', 'item', 2000, 'woman', '/images/woman_5.jpeg'),
(19, '2021-04-13 22:12:58', '2021-04-13 22:12:58', 'cloth___', 2000, 'man', '/images/man_7.jpg'),
(20, '2021-04-13 22:12:58', '2021-04-13 22:12:58', 'hu', 2000, 'man', '/images/man_8.jpeg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
