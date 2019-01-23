-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 14, 2018 at 04:39 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `technoftp`
--

-- --------------------------------------------------------

--
-- Table structure for table `backgrounds`
--

DROP TABLE IF EXISTS `backgrounds`;
CREATE TABLE IF NOT EXISTS `backgrounds` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backgrounds`
--

INSERT INTO `backgrounds` (`id`, `image`, `sort`, `created_at`, `updated_at`) VALUES
(2, 'public/uploads/background/image/background-image-55089D1D40.jpg', 1, '2018-01-11 06:45:20', '2018-01-13 12:03:48'),
(3, 'public/uploads/background/image/background-image-783F8D2FFE.jpg', 1, '2018-01-11 06:50:58', '2018-01-13 12:03:36'),
(4, 'public/uploads/background/image/background-image-4AB2317DE6.jpg', 1, '2018-01-13 12:03:58', '2018-01-13 12:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `type`, `parent_id`, `icon`, `sort`, `created_at`, `updated_at`) VALUES
(4, 'Video', 'video', 'video', 0, 'fa fa-anchor', 1, '2018-01-03 11:05:47', '2018-01-03 11:05:47'),
(3, 'Movie', 'movie', 'movie', 0, 'fa fa-trophy', 1, '2018-01-03 09:30:46', '2018-01-03 09:30:46'),
(5, 'Natok', 'natok', 'natok', 0, 'fa fa-video-camera', 1, '2018-01-03 11:08:42', '2018-01-03 11:08:42'),
(6, 'Songs', 'songs', 'songs', 0, 'fa fa-paper-plane-o', 1, '2018-01-03 11:09:28', '2018-01-03 11:09:28'),
(7, 'Entertainment', 'entertainment', 'entertainment', 0, 'fa fa-film', 1, '2018-01-03 11:10:37', '2018-01-03 11:10:37'),
(8, 'Software', 'software', 'software', 0, 'fa fa-codepen', 1, '2018-01-03 11:11:23', '2018-01-03 11:11:23'),
(11, 'Bangla Movie', 'bangla-movie', 'bangla-movie', 0, 'fa fa-trophy', 1, '2018-01-03 11:45:29', '2018-01-11 00:26:16'),
(10, 'Books', 'books', 'books', 0, 'fa fa-book', 1, '2018-01-03 11:12:45', '2018-01-03 11:12:45'),
(12, 'test name', 'test-name', 'movie', 4, 'fa fa-book', 1, '2018-01-11 00:24:10', '2018-01-11 00:58:18'),
(13, 'new movie', 'new-movie', 'video', 3, 'fa fa-book', 1, '2018-01-11 01:04:33', '2018-01-11 01:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

DROP TABLE IF EXISTS `channels`;
CREATE TABLE IF NOT EXISTS `channels` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `name`, `thumbnail`, `url`, `sort`, `created_at`, `updated_at`) VALUES
(2, 'tv 1', 'public/uploads/tv/thumbnail/tv-1-35352328B3.png', 'bluedreambd.com', 2, '2018-01-11 02:17:20', '2018-01-11 02:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `total_view` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `slug`, `category_id`, `parent_id`, `thumbnail`, `tags`, `language`, `origin`, `type`, `total_view`, `file`, `created_at`, `updated_at`) VALUES
(13, 'new movie', 'new-movie', 13, 3, 'public/uploads/thumbnail/movie/new-movie/new-movie627C949743.png', 'description', 'english', 'America', 1, '22', 'public/uploads/videos/movie/new-movie/new-movie056BA49FFF.png', '2018-01-11 01:05:09', '2018-01-13 12:16:01'),
(14, 'na na na song', 'na-na-na-song', 12, 4, 'public/uploads/thumbnail/video/test-name/na-na-na-song6806D58F3C.jpg', 'nice song', 'english', 'America', 3, '9', 'public/uploads/videos/video/test-name/na-na-na-songC277296671.mp3', '2018-01-13 08:34:52', '2018-01-13 08:47:07'),
(12, 'nngh fgfg fgf', 'nngh-fgfg-fgf', 12, 4, 'public/uploads/thumbnail/video/test-name/nngh-fgfg-fgf12852FF7E7.png', 'description', 'english', 'America', 1, '14', 'public/uploads/videos/video/test-name/nngh-fgfg-fgfA293619863.png', '2018-01-11 01:01:17', '2018-01-13 12:10:35'),
(11, 'Bangla Movie', 'bangla-movie', 11, 3, 'public/uploads/thumbnail/bangla-movie612209A16A.jpg', 'movie', 'english', 'America', 1, '10', 'public/uploads/videos/bangla-movie9A857276CB.mp4', '2018-01-04 23:40:26', '2018-01-13 11:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2018_01_04_071107_create_files_table', 4),
(12, '2018_01_03_095815_create_categories_table', 1),
(13, '2018_01_03_100040_create_channels_table', 5),
(14, '2018_01_03_100105_create_backgrounds_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'FreeMediaBD', 'admin@admin.com', '$2y$10$kvAjlZ3I8lUNTit55MIoxOun/IJL2.3f0R7v/mkszDNbsFg489QJK', 'ugHRb97T3QeIQKQVntTeeOiS3BKFWXMvpUet4ZSx002uMn7SDMvehaEPtxJM', '2018-01-01 01:38:50', '2018-01-01 01:38:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
