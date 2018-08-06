-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 06, 2018 at 10:17 AM
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
-- Database: `vchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `accepted`, `created_at`, `updated_at`) VALUES
(6, 3, 3, 0, NULL, NULL),
(5, 3, 7, 1, NULL, NULL),
(8, 8, 7, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `likeable`
--

DROP TABLE IF EXISTS `likeable`;
CREATE TABLE IF NOT EXISTS `likeable` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `likeable_id` int(11) NOT NULL,
  `likeable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `likeable`
--

INSERT INTO `likeable` (`id`, `user_id`, `likeable_id`, `likeable_type`, `created_at`, `updated_at`) VALUES
(1, 7, 9, 'Vchat\\Models\\Status', '2018-04-05 13:23:14', '2018-04-05 13:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2018_02_10_132730_create_staff_table', 1),
('2018_02_10_163155_create_myusers_table', 1),
('2018_02_10_163359_create_people_table', 1),
('2018_02_10_165205_create_users_table', 1),
('2018_03_07_144443_create_friends_table', 2),
('2018_03_23_133350_create_statuses-table', 3),
('2018_03_27_144704_create_likeable_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `user_id`, `parent_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 7, NULL, 'Hi everyone', '2018-03-26 11:40:46', '2018-03-26 11:40:46'),
(2, 7, NULL, 'whats up dude', '2018-03-26 14:42:17', '2018-03-26 14:42:17'),
(3, 7, NULL, 'my um is good', '2018-03-26 14:50:11', '2018-03-26 14:50:11'),
(4, 7, 2, 'what are you doing', '2018-03-27 12:18:16', '2018-03-27 12:18:16'),
(5, 7, 1, 'what are you doing', '2018-03-27 12:20:01', '2018-03-27 12:20:01'),
(6, 7, 1, 'what are you eating', '2018-03-27 12:20:52', '2018-03-27 12:20:52'),
(8, 8, 2, 'i am reading', '2018-03-27 12:41:28', '2018-03-27 12:41:28'),
(9, 8, NULL, 'victor whatsup', '2018-03-27 12:42:13', '2018-03-27 12:42:13'),
(10, 7, 9, 'fine bro', '2018-03-27 12:42:38', '2018-03-27 12:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `first_name`, `last_name`, `location`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'victorblaze2010@yahoo.com', 'blaze', '$2y$10$73G4E9j2v12SGPGM38sy9eQHS8mK6iR2fjJBog5YoiXv45ZGKb57W', 'Chibuzor', 'Umezuruike', NULL, 'zP4kNPAsGkfxvftH8epyzkn3A9fkm1kUnAFllcbdwECmJGBe435N3jlfsyMQ', '2018-02-14 01:29:02', '2018-03-23 11:57:35'),
(7, 'victorblaze2010@gmail.com', 'victor', '$2y$10$8MT1qC9gZ25gmDlHbNPRfuXN1lZofXzoZxgE94d7cpnLmVGR7m5dS', 'Victory', 'Ibeh', 'Oshodi, lagos', 'K1gXz8kYmZM78ePAobrtIqNjxT7WgBkjNy5MaMtwafqE89v0SP7ZpWA232cS', '2018-02-24 12:15:51', '2018-03-12 13:39:17'),
(8, 'info.vteck@gmail.com', 'vteck', '$2y$10$4jOeRLpoFox1E7M9/9lnCu4tr9WDiGP3sE4.IwzEOw48wwsz4KJEC', 'Temple', 'Obinna', 'Lagos', 'WhGHs1EJKAWk7u31eiDpXQxU10MBH4vaiZRQckid3mpb3VH0tMMMd31gplDj', '2018-03-06 13:25:56', '2018-03-23 12:26:28');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
