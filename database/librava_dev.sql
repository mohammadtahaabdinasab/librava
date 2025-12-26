-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 26, 2025 at 10:35 AM
-- Server version: 9.1.0
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librava_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `author` varchar(150) NOT NULL,
  `published_year` int DEFAULT NULL,
  `cover_path` varchar(255) DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `published_year`, `cover_path`, `available`, `created_at`) VALUES
(1, 'شازده کوچولو', 'آنتوان دو سنت‌اگزوپری', 1943, NULL, 0, '2025-12-24 12:38:27'),
(2, 'سمفونی مردگان', 'عباس معروفی', 1989, NULL, 1, '2025-12-24 12:38:27'),
(3, 'چشم‌هایش', 'بزرگ علوی', 1952, NULL, 1, '2025-12-24 12:38:27'),
(4, 'بوف کور', 'صادق هدایت', 1937, NULL, 1, '2025-12-24 12:38:27'),
(5, 'کلیدر', 'محمود دولت‌آبادی', 1978, NULL, 0, '2025-12-24 12:38:27'),
(6, 'سووشون', 'سیمین دانشور', 1969, NULL, 0, '2025-12-24 12:38:27'),
(7, 'ملت عشق', 'الیف شافاک', 2010, NULL, 1, '2025-12-24 12:38:27'),
(8, 'مدیر مدرسه', 'جلال آل‌احمد', 1958, NULL, 1, '2025-12-24 12:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

DROP TABLE IF EXISTS `borrows`;
CREATE TABLE IF NOT EXISTS `borrows` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `book_id` int UNSIGNED NOT NULL,
  `borrowed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_at` datetime DEFAULT NULL,
  `returned_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_borrows_user_id` (`user_id`),
  KEY `idx_borrows_book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`id`, `user_id`, `book_id`, `borrowed_at`, `due_at`, `returned_at`) VALUES
(1, 2, 1, '2025-12-21 16:08:27', '2026-01-11 16:08:27', NULL),
(2, 3, 2, '2025-12-04 16:08:27', '2025-12-18 16:08:27', '2025-12-24 16:27:06'),
(3, 4, 3, '2025-12-09 16:08:27', '2025-12-23 16:08:27', '2025-12-22 16:08:27'),
(5, 1, 5, '2025-12-24 16:15:14', '2026-01-07 16:15:14', NULL),
(6, 2, 6, '2025-12-24 16:24:36', '2026-01-07 16:24:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'محمد طاها عبدی نصب', 'taha@librava.local', 'TEST_HASH', 'admin', '2025-12-24 12:38:27'),
(2, 'زهرا حسینی', 'zahra@librava.local', 'TEST_HASH', 'user', '2025-12-24 12:38:27'),
(3, 'علی رضایی', 'ali@librava.local', 'TEST_HASH', 'user', '2025-12-24 12:38:27'),
(4, 'مریم احمدی', 'maryam@librava.local', 'TEST_HASH', 'user', '2025-12-24 12:38:27'),
(5, 'حسین کریمی', 'hossein@librava.local', 'TEST_HASH', 'user', '2025-12-24 12:38:27');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `fk_borrows_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_borrows_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
