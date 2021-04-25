-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 23, 2021 at 05:58 PM
-- Server version: 10.5.4-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping-cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING HASH
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_07_175708_create_orders_table', 1),
(5, '2021_04_10_220001_create_items_table', 1),
(6, '2021_04_22_194146_create_sessions_table', 2),
(8, '2021_04_23_165637_add_username_to_users_table', 3),
(9, '2021_04_23_170425_add_items_to_orders_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('adura@gmail.com', '$2y$10$xJ3NtMakiW2PuGl9lYWOqugbXMAssZJzCGBnVq5xcW8fu.hpV27Ze', '2021-04-12 20:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`) VALUES
(1, 'emmaneul tester', 'adura@gmail.com', NULL, '$2y$10$nV4SZXSGMwdaf9z3Maqcpev47Xljcsc7dxq3f.34hcO1VmLp1JwFy', NULL, '2021-04-12 20:26:49', '2021-04-12 20:26:49', ''),
(2, 'lola', 'lola@test.com', NULL, '$2y$10$NxjxwyPZuiV7eiyoqrTqt.7dK8RYX5meA7xe0CfIQHqhmAcRUcM5K', NULL, '2021-04-12 20:34:13', '2021-04-12 20:34:13', ''),
(3, 'lol', 'LOL@tes.com', NULL, '$2y$10$Tlc7jZYRX.TeiWJ60z7LQ.398BrsYvLvgBXCCFUesXBio.VVMXT8S', NULL, '2021-04-12 20:35:38', '2021-04-12 20:35:38', ''),
(4, 'Gabi', 'Martinelli@arena.com', NULL, '$2y$10$03F9nhJtfm9DCfo0B270O.JoKvuzxXvFIRZlVHzYXWOzKk43wkpnK', NULL, '2021-04-12 20:37:18', '2021-04-12 20:37:18', ''),
(5, 'Faith Ugochi', 'faith@test.com', NULL, '$2y$10$ObZXdZp/GP9syfOo3NGXTObbqftJ7FBSRAtCDA0RiUpKmXxkBhIgG', NULL, '2021-04-12 22:00:47', '2021-04-12 22:00:47', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
