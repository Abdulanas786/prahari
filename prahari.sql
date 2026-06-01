-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2026 at 12:17 PM
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
-- Database: `prahari`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prahari_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `Location` varchar(255) NOT NULL,
  `evidence_file` varchar(255) NOT NULL,
  `status` enum('Open','In Progress','Closed') NOT NULL DEFAULT 'Open',
  `violation_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `prahari_id`, `category_id`, `Location`, `evidence_file`, `status`, `violation_date`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 'Hazratganj Lucknow', 'evidence.jpg', 'In Progress', '2026-05-26 14:30:00', '2026-05-06 14:04:03', '2026-05-26 01:42:55'),
(3, 11, 4, 'Indira Nagar', 'evidence/a863dd07-694f-3dc8-8284-5bf3e9604015.jpg', 'In Progress', '2025-08-25 02:09:42', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(4, 10, 23, 'Indira Nagar', 'evidence/59f1e5c9-8099-3270-97a0-6838dd989b04.jpg', 'In Progress', '2025-12-08 12:37:22', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(5, 4, 22, 'Aliganj', 'evidence/39b5f347-705b-303a-8e8b-999119f61de2.jpg', 'Closed', '2025-08-16 12:03:56', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(6, 3, 25, 'Indira Nagar', 'evidence/1d5ad182-beb3-35e3-af66-210d59a15e23.jpg', 'In Progress', '2025-06-27 09:06:43', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(7, 7, 2, 'Aliganj', 'evidence/905425ac-4e10-35a9-a0ed-ac9a51b26b86.jpg', 'In Progress', '2026-04-17 07:22:20', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(8, 13, 7, 'Lucknow', 'evidence/4fe74be3-c5ed-3cd5-b544-2426f70a775a.jpg', 'In Progress', '2026-01-29 16:40:41', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(9, 9, 11, 'Ashiyana', 'evidence/f34dbd89-3111-3872-b411-9c62ae0931a2.jpg', 'Open', '2026-01-28 07:44:45', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(10, 5, 24, 'Indira Nagar', 'evidence/0eb64dc0-ad60-3e83-ac19-bed91987b1dd.jpg', 'Closed', '2026-03-03 01:11:19', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(11, 19, 11, 'Gokhale Marg', 'evidence/f009492a-3c46-3c71-8809-4a2acf0fce08.jpg', 'Open', '2025-11-01 07:54:07', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(12, 15, 6, 'Gokhale Marg', 'evidence/8993ba9b-755f-37a1-991a-196f161c549a.jpg', 'Open', '2026-04-24 20:25:52', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(13, 1, 12, 'Alambagh', 'evidence/2a00c42e-21f9-3179-b34c-0a4048653e30.jpg', 'Open', '2026-04-01 10:18:06', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(14, 18, 7, 'Ashiyana', 'evidence/73bd092f-148e-33ae-838e-bee01ed8ab68.jpg', 'In Progress', '2026-03-11 13:50:48', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(15, 22, 1, 'Sikkim', 'speed.jpg', 'Open', '2026-05-26 14:30:00', '2026-05-06 14:04:03', '2026-05-26 01:49:12'),
(16, 10, 20, 'Ashiyana', 'evidence/235fc12c-56cc-3425-8c64-8ed7f2cac82e.jpg', 'Open', '2025-12-26 12:13:58', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(17, 2, 7, 'Sitapur', 'evidence/5bdea2b5-c4a9-3787-a2e9-bd4d578291d7.jpg', 'In Progress', '2026-04-03 23:29:11', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(18, 21, 22, 'Aliganj', 'evidence/36de1de6-5eb6-3be9-8daa-dbece388261d.jpg', 'Open', '2025-08-09 17:16:55', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(19, 20, 23, 'Alambagh', 'evidence/466840ae-8101-397f-9e29-a9367decb67a.jpg', 'Closed', '2025-07-03 07:25:37', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(20, 11, 10, 'Ashiyana', 'evidence/d882d903-8c9b-3368-b08e-b7599aac4b1e.jpg', 'In Progress', '2025-08-28 16:49:02', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(21, 7, 11, 'Aminabad', 'evidence/179ac38c-344c-3d69-a82a-9d72ede70102.jpg', 'Open', '2025-08-29 03:33:42', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(22, 19, 10, 'Ashiyana', 'evidence/059aaacb-bb24-376f-9824-68d1ca6fd209.jpg', 'In Progress', '2025-12-24 14:33:27', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(23, 25, 14, 'Sitapur', 'evidence/39e8f6b9-c2de-32d2-a7ae-770f36776933.jpg', 'Open', '2025-08-28 06:55:01', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(24, 5, 10, 'Ashiyana', 'evidence/ec8c5aa0-b65a-3b04-b940-45db80e04760.jpg', 'In Progress', '2026-02-10 21:27:05', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(25, 11, 1, 'Hazratganj', 'evidence/f67a31f1-7179-324e-b872-8026a72f9b13.jpg', 'Closed', '2026-01-22 13:01:39', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(28, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:28', '2026-05-07 22:18:28'),
(29, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:28', '2026-05-07 22:18:28'),
(30, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:29', '2026-05-07 22:18:29'),
(31, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:29', '2026-05-07 22:18:29'),
(32, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:30', '2026-05-07 22:18:30'),
(33, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:30', '2026-05-07 22:18:30'),
(34, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:31', '2026-05-07 22:18:31'),
(35, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:31', '2026-05-07 22:18:31'),
(36, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:32', '2026-05-07 22:18:32'),
(37, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:32', '2026-05-07 22:18:32'),
(38, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:33', '2026-05-07 22:18:33'),
(39, 3, 2, 'Sitapur', 'No_helmet.png', 'Open', '2026-05-07 00:00:00', '2026-05-07 22:18:33', '2026-05-07 22:18:33'),
(43, 3, 1, 'kanpur', 'Parking.jpg', 'Open', '2026-05-05 00:00:00', '2026-05-13 00:44:33', '2026-05-13 00:44:33'),
(44, 4, 4, 'Sitapur', 'Speed.jpg', 'In Progress', '2026-01-14 00:00:00', '2026-05-22 00:11:27', '2026-05-22 00:11:27'),
(46, 25, 3, 'Sikkim', 'Parking.mp4', 'Open', '2026-01-01 00:00:00', '2026-05-22 05:57:04', '2026-05-22 05:57:04'),
(47, 26, 10, 'Gujrat', 'Wrong.png', 'In Progress', '2026-05-01 00:00:00', '2026-05-22 06:05:41', '2026-05-22 06:05:41'),
(48, 31, 1, 'Gujrat', 'Speed.jpg', 'In Progress', '2026-05-24 00:00:00', '2026-05-24 23:43:56', '2026-05-24 23:43:56'),
(49, 56, 15, 'America', 'License.jpeg', 'Open', '2026-05-24 00:00:00', '2026-05-25 08:18:37', '2026-05-25 08:18:37'),
(50, 11, 1, 'Mumbai', 'Speed.png', 'Closed', '2026-05-26 10:58:00', '2026-05-27 00:00:05', '2026-05-27 00:16:13'),
(51, 61, 13, 'California', 'image.jpeg', 'Open', '2026-06-01 00:00:00', '2026-05-27 01:04:47', '2026-06-01 01:00:18'),
(53, 61, 2, 'California', 'No_helmet.png', 'Open', '2026-06-01 00:00:00', '2026-06-01 00:41:57', '2026-06-01 00:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `Type`, `Amount`, `created_at`, `updated_at`) VALUES
(1, 'Speed Limit Violation', '1326', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(2, 'No Helmet', '732', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(3, 'Parking Violation', '1033', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(4, 'Speed Limit Violation', '616', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(5, 'No Helmet', '480', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(6, 'No Helmet', '804', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(7, 'Mobile Phone Usage', '1745', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(8, 'No License', '1810', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(9, 'Parking Violation', '348', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(10, 'Wrong Parking', '1288', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(11, 'Driving Without Seatbelt', '1321', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(12, 'No Helmet', '136', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(13, 'Traffic Violation', '501', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(14, 'Signal Jump', '734', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(15, 'No License', '664', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(16, 'Overloading', '896', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(17, 'Overloading', '484', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(18, 'Driving Without Seatbelt', '1851', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(19, 'Speed Limit Violation', '347', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(20, 'Speed Limit Violation', '529', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(21, 'Speed Limit Violation', '681', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(22, 'Driving Without Seatbelt', '1906', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(23, 'Traffic Violation', '597', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(24, 'Driving Without Seatbelt', '1652', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(25, 'Signal Jump', '1772', '2026-05-06 14:04:03', '2026-05-06 14:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `challans`
--

CREATE TABLE `challans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prahari_id` bigint(20) UNSIGNED NOT NULL,
  `case_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Paid','Pending','Cancelled') NOT NULL DEFAULT 'Pending',
  `Date` datetime NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `challans`
--

INSERT INTO `challans` (`id`, `prahari_id`, `case_id`, `category_id`, `status`, `Date`, `is_paid`, `created_at`, `updated_at`) VALUES
(2, 22, 2, 19, 'Paid', '2025-09-05 04:31:34', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(3, 15, 12, 6, 'Pending', '2025-11-24 01:29:11', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(4, 19, 22, 10, 'Paid', '2025-07-01 14:39:47', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(5, 11, 3, 4, 'Cancelled', '2025-10-15 21:48:00', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(6, 5, 10, 24, 'Pending', '2026-01-12 18:48:45', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(7, 20, 19, 23, 'Pending', '2025-10-21 18:24:43', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(8, 9, 9, 11, 'Pending', '2026-04-02 20:52:05', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(9, 3, 6, 25, 'Cancelled', '2026-01-10 00:10:43', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(10, 18, 14, 7, 'Cancelled', '2026-04-16 11:13:47', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(11, 22, 2, 19, 'Paid', '2026-03-25 19:54:05', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(12, 7, 21, 11, 'Cancelled', '2026-03-24 22:56:04', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(13, 1, 13, 12, 'Cancelled', '2025-08-14 00:52:40', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(14, 25, 23, 14, 'Paid', '2026-01-04 09:39:40', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(15, 11, 25, 1, 'Cancelled', '2026-01-20 02:23:53', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(16, 4, 5, 22, 'Cancelled', '2025-11-30 15:56:15', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(17, 22, 2, 19, 'Paid', '2025-06-03 11:28:05', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(18, 20, 19, 23, 'Paid', '2025-08-28 03:37:22', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(20, 9, 9, 11, 'Cancelled', '2025-10-09 15:23:14', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(21, 18, 14, 7, 'Paid', '2025-10-28 07:59:47', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(22, 18, 14, 7, 'Cancelled', '2026-01-12 11:25:44', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(23, 3, 6, 25, 'Paid', '2025-06-19 13:27:50', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(24, 11, 25, 1, 'Cancelled', '2026-01-14 13:19:01', 0, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(26, 11, 2, 8, 'Paid', '2026-05-07 00:00:00', 0, '2026-05-07 06:13:42', '2026-05-07 06:16:02'),
(27, 11, 2, 10, 'Pending', '2026-05-06 00:00:00', 0, '2026-05-07 06:15:35', '2026-05-07 06:15:35'),
(28, 3, 8, 14, 'Pending', '2026-05-06 00:00:00', 0, '2026-05-07 09:05:05', '2026-05-07 09:06:44'),
(32, 3, 3, 15, 'Pending', '2026-05-12 00:00:00', 0, '2026-05-13 00:47:00', '2026-05-13 00:47:00'),
(33, 29, 2, 13, 'Pending', '2026-05-01 00:00:00', 0, '2026-05-22 00:38:59', '2026-05-22 00:38:59'),
(34, 29, 2, 8, 'Pending', '2026-05-21 00:00:00', 0, '2026-05-22 04:42:14', '2026-05-22 04:42:14'),
(38, 30, 44, 7, 'Pending', '2026-05-20 00:00:00', 0, '2026-05-22 05:13:42', '2026-05-22 05:13:42'),
(39, 30, 44, 8, 'Pending', '2026-05-24 00:00:00', 0, '2026-05-24 22:45:48', '2026-05-24 22:45:48'),
(40, 31, 48, 1, 'Pending', '2026-05-24 00:00:00', 0, '2026-05-24 23:46:39', '2026-05-24 23:46:39'),
(41, 53, 46, 2, 'Pending', '2026-05-24 00:00:00', 0, '2026-05-25 04:06:42', '2026-05-25 04:06:42'),
(42, 53, 46, 3, 'Pending', '2026-05-24 00:00:00', 0, '2026-05-25 04:08:04', '2026-05-25 04:08:04'),
(43, 56, 49, 8, 'Paid', '2026-05-25 00:00:00', 0, '2026-05-26 02:01:37', '2026-05-27 00:30:35'),
(44, 15, 12, 6, 'Pending', '2026-05-24 10:30:05', 0, '2026-05-27 00:55:47', '2026-05-27 00:55:47'),
(47, 29, 51, 1, 'Pending', '2026-05-30 00:00:00', 0, '2026-05-31 10:41:22', '2026-05-31 10:41:22'),
(49, 61, 51, 1, 'Pending', '2026-05-31 00:00:00', 1, '2026-05-31 14:22:16', '2026-05-31 14:22:52'),
(50, 61, 51, 13, 'Pending', '2026-05-31 00:00:00', 1, '2026-05-31 14:24:49', '2026-05-31 14:25:22'),
(51, 61, 51, 3, 'Paid', '2026-05-31 00:00:00', 1, '2026-05-31 14:26:28', '2026-06-01 01:16:57'),
(52, 61, 51, 19, 'Pending', '2026-06-01 00:00:00', 1, '2026-06-01 01:11:06', '2026-06-01 02:18:14'),
(53, 61, 51, 20, 'Pending', '2026-06-01 00:00:00', 1, '2026-06-01 02:21:31', '2026-06-01 02:22:30'),
(54, 61, 51, 17, 'Pending', '2026-06-01 00:00:00', 1, '2026-06-01 02:47:22', '2026-06-01 02:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_04_081330_create_personal_access_tokens_table', 1),
(5, '2026_05_05_064441_create_praharis_table', 2),
(6, '2026_05_05_074515_create_categories_table', 3),
(7, '2026_05_05_111553_create_cases_table', 4),
(8, '2026_05_05_053649_create_challans_table', 5),
(9, '2026_05_05_063121_create_payments_table', 6),
(10, '2026_05_05_095531_add_column_in_users', 7),
(11, '2026_05_08_035810_add_permissions_to_users_table', 8),
(12, '2026_05_22_092916_remove_unique_from_bank_account_in_payments_table', 9),
(13, '2026_05_22_114831_create_settings_table', 10),
(14, '2026_05_31_190645_add_is_paid_to_challans_table', 11),
(15, '2026_06_01_085047_add_settings_columns_to_praharis_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prahari_id` bigint(20) UNSIGNED NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `prahari_id`, `bank_account`, `amount`, `status`, `date`, `created_at`, `updated_at`) VALUES
(3, 14, 'BANK7243162-0DMA', 14791.16, 'Approved', '2026-01-03 11:53:53', '2026-05-06 14:04:03', '2026-05-07 04:05:17'),
(4, 6, 'BANK7123599-S4H3', 12438.00, 'Approved', '2025-10-03 02:17:27', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(5, 18, 'BANK5990003-MXMH', 13846.48, 'Approved', '2026-04-09 15:01:59', '2026-05-06 14:04:03', '2026-05-07 06:25:37'),
(6, 1, 'BANK9635829-S7RV', 2682.40, 'Approved', '2026-01-21 17:12:37', '2026-05-06 14:04:03', '2026-05-07 06:26:08'),
(7, 16, 'BANK0053104-TWAX', 9150.93, 'Approved', '2026-01-10 17:11:38', '2026-05-06 14:04:03', '2026-05-07 10:42:24'),
(8, 25, 'BANK4422567-3ZWA', 4762.89, 'Approved', '2026-03-07 12:49:57', '2026-05-06 14:04:03', '2026-05-07 21:53:33'),
(9, 9, 'BANK8081470-CQON', 3964.89, 'Approved', '2025-11-26 07:16:34', '2026-05-06 14:04:03', '2026-05-22 05:49:35'),
(10, 8, 'BANK9616748-75T6', 14113.66, 'Approved', '2025-08-16 17:06:20', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(11, 5, 'BANK0201443-JPN7', 9543.43, 'Approved', '2025-12-02 13:16:13', '2026-05-06 14:04:03', '2026-05-22 06:06:57'),
(12, 5, 'BANK0201443-LA5A', 11689.98, 'Approved', '2026-05-04 19:52:58', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(13, 2, 'BANK5908037-VHKD', 6197.19, 'Approved', '2026-02-17 00:34:59', '2026-05-06 14:04:03', '2026-05-27 01:31:43'),
(14, 4, 'BANK0527889-DNAS', 9810.88, 'Approved', '2025-08-02 19:39:40', '2026-05-06 14:04:03', '2026-05-27 07:26:32'),
(15, 4, 'BANK0527889-LQBW', 18316.26, 'Approved', '2025-12-30 08:44:59', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(16, 9, 'BANK8081470-JLI5', 3489.44, 'Pending', '2026-01-09 08:46:07', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(17, 4, 'BANK0527889-NNXN', 1746.54, 'Rejected', '2025-08-02 14:52:01', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(18, 11, 'BANK5594092-YBLT', 3319.81, 'Rejected', '2025-06-06 01:10:34', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(19, 22, 'BANK5013326-SKRZ', 12758.84, 'Approved', '2026-01-23 05:39:08', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(20, 16, 'BANK0053104-9YKD', 16523.81, 'Rejected', '2026-02-11 23:12:26', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(21, 17, 'BANK3267254-IUSK', 18540.94, 'Pending', '2026-01-26 08:01:52', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(22, 14, 'BANK7243162-ZYOC', 10076.84, 'Pending', '2026-03-01 06:33:36', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(23, 19, 'BANK8326912-ARQ5', 13878.62, 'Approved', '2025-06-10 14:40:31', '2026-05-06 14:04:03', '2026-05-27 01:12:27'),
(24, 2, 'BANK5908037-QGN6', 18860.97, 'Approved', '2025-05-21 08:10:08', '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(25, 11, 'BANK5594092-VJPD', 3371.12, 'Approved', '2026-01-24 07:32:40', '2026-05-06 14:04:03', '2026-05-13 00:52:14'),
(28, 3, 'wehfabrkfhebrfi', 13999.90, 'Approved', '2026-05-07 00:00:00', '2026-05-07 06:31:52', '2026-05-07 06:32:10'),
(29, 1, 'hvkutvukyfukyg', 18000.00, 'Approved', '2026-05-06 00:00:00', '2026-05-07 09:08:15', '2026-05-07 09:12:16'),
(31, 3, 'hbmjgvgj,cvmghv', 5000.00, 'Approved', '2026-05-06 00:00:00', '2026-05-07 09:10:00', '2026-05-07 09:10:58'),
(32, 1, 'ghcmcmjvmjcjmg', 20000.00, 'Approved', '2026-05-07 00:00:00', '2026-05-08 09:33:28', '2026-05-08 09:33:42'),
(33, 3, 'hgjfkyfkyfjkytdjt', 18000.00, 'Approved', '2026-05-12 00:00:00', '2026-05-13 00:49:56', '2026-05-13 00:52:12'),
(34, 29, 'zxctfuyjvg54566', 5948.00, 'Approved', '2026-05-30 00:00:00', '2026-05-22 01:43:19', '2026-05-31 10:42:43'),
(37, 1, 'BANK9635829', 272.00, 'Pending', '2026-05-09 00:00:00', '2026-05-22 01:47:13', '2026-05-22 04:33:38'),
(41, 4, 'BANK0527889', 1234.00, 'Approved', '2026-05-19 00:00:00', '2026-05-22 03:13:42', '2026-05-26 02:00:41'),
(42, 30, '999780548009', 14025.00, 'Approved', '2026-05-24 00:00:00', '2026-05-22 04:47:28', '2026-05-24 22:49:04'),
(43, 53, 'BANK000018ACC', 1765.00, 'Approved', '2026-05-24 00:00:00', '2026-05-25 04:07:21', '2026-05-25 04:10:18'),
(44, 56, 'BANK754764786', 664.00, 'Approved', '2026-05-24 00:00:00', '2026-05-25 08:19:23', '2026-05-25 08:19:23'),
(47, 61, 'BANK0852963', 3592.00, 'Approved', '2026-06-01 00:00:00', '2026-05-31 14:22:52', '2026-06-01 02:08:42'),
(49, 61, 'BANK0852963', 484.00, 'Pending', '2026-06-01 08:17:48', '2026-06-01 02:47:48', '2026-06-01 02:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(8, 'App\\Models\\Prahari', 61, 'API TOKEN', '473f00e570da56523f830d5e6fefbdb4fd92e1fa2d97acd55f7ff461d65fbdac', '[\"*\"]', '2026-06-01 03:47:19', NULL, '2026-06-01 03:33:58', '2026-06-01 03:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `praharis`
--

CREATE TABLE `praharis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Prahari` varchar(255) NOT NULL,
  `Mobile` varchar(255) NOT NULL,
  `AadhaarStatus` enum('Verified','Pending','Rejected') NOT NULL DEFAULT 'Verified',
  `Bank_account_detail` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `language` varchar(255) NOT NULL DEFAULT 'English',
  `notifications_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `praharis`
--

INSERT INTO `praharis` (`id`, `Prahari`, `Mobile`, `AadhaarStatus`, `Bank_account_detail`, `status`, `language`, `notifications_enabled`, `created_at`, `updated_at`) VALUES
(1, 'Carolyn Gaylord', '9034947425', 'Pending', 'BANK9635829', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(2, 'Ceasar Altenwerth', '9793359968', 'Rejected', 'BANK5908037', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(3, 'Eusebio Hoppe', '9622226007', 'Pending', 'BANK9935809', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(4, 'Ms. Maddison Schuster', '9971437015', 'Rejected', 'BANK0527889', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(5, 'Dr. Alvina Terry', '9789288763', 'Pending', 'BANK0201443', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(6, 'Miss Gwendolyn Walsh III', '9665978609', 'Pending', 'BANK7123599', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(7, 'Hailie Sporer', '9994183510', 'Rejected', 'BANK0837076', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(8, 'Prof. Michel Dietrich I', '9220115925', 'Pending', 'BANK9616748', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(9, 'Dr. Laney Kunde', '9635993217', 'Rejected', 'BANK8081470', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(10, 'Estell Flatley DVM', '9432642589', 'Verified', 'BANK2326464', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(11, 'Nicola Streich I', '9251319157', 'Pending', 'BANK5594092', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(12, 'Genoveva Bednar', '9562690860', 'Rejected', 'BANK6329638', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(13, 'Prof. Isabel Lubowitz', '9611084197', 'Rejected', 'BANK0948818', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(14, 'Rozella Corkery', '9230280686', 'Pending', 'BANK7243162', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(15, 'Dr. Michaela Sporer', '9541643094', 'Pending', 'BANK6100618', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(16, 'Trever Jones', '9806651877', 'Pending', 'BANK0053104', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(17, 'Malinda Nicolas MD', '9873070774', 'Rejected', 'BANK3267254', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(18, 'Mr. Gus Kunde', '9575413813', 'Pending', 'BANK5990003', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(19, 'Fritz Wisozk', '9214722591', 'Pending', 'BANK8326912', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(20, 'Jairo Sanford', '9663912179', 'Verified', 'BANK6002943', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(21, 'Cleo Russel DVM', '9454600775', 'Verified', 'BANK5229328', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(22, 'Lenny Towne', '9137107406', 'Pending', 'BANK5013326', 'Inactive', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(23, 'Miss Sabina Brown DDS', '9912775660', 'Rejected', 'BANK9384919', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(24, 'Mayra Turner', '9031572824', 'Rejected', 'BANK3154611', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(25, 'Camille Hoeger', '9967000683', 'Verified', 'BANK4422567', 'Active', 'English', 1, '2026-05-06 14:04:03', '2026-05-06 14:04:03'),
(26, 'George', '5555555555', 'Rejected', 'ZXCVBN987654', 'Active', 'English', 1, '2026-05-07 01:20:50', '2026-05-07 01:20:50'),
(29, 'Harry Potter', '5858585858', 'Rejected', 'zxctfuyjvg54566', 'Active', 'English', 1, '2026-05-22 00:35:57', '2026-05-22 00:36:22'),
(30, 'Abdul Anas', '9999999999', 'Pending', '999780548009', 'Active', 'English', 1, '2026-05-22 04:44:59', '2026-05-22 04:44:59'),
(31, 'Rahul Sharma', '9876543210', 'Verified', 'SBIN000123456', 'Active', 'English', 1, '2026-05-22 06:51:52', '2026-05-22 06:51:52'),
(32, 'Aman Verma', '9123456780', 'Pending', 'HDFC000987654', 'Inactive', 'English', 1, '2026-05-22 06:51:53', '2026-05-22 06:51:53'),
(33, 'Suresh Yadav', '9988776655', 'Rejected', 'ICIC000456789', 'Active', 'English', 1, '2026-05-22 06:51:53', '2026-05-22 06:51:53'),
(34, 'Vikash Singh', '9012345678', 'Verified', 'PNB000741852', 'Active', 'English', 1, '2026-05-22 06:51:54', '2026-05-22 06:51:54'),
(35, 'Rohit Kumar', '9090909090', 'Pending', 'AXIS000369258', 'Inactive', 'English', 1, '2026-05-22 06:51:54', '2026-05-22 06:51:54'),
(36, 'Rahul Sharma', '9892012265', 'Pending', 'BANK000001ACC', 'Active', 'English', 1, '2026-05-25 04:04:04', '2026-05-25 04:04:04'),
(37, 'Aman Verma', '9389162219', 'Pending', 'BANK000002ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:05', '2026-05-25 04:04:05'),
(38, 'Suresh Yadav', '9509594840', 'Rejected', 'BANK000003ACC', 'Active', 'English', 1, '2026-05-25 04:04:06', '2026-05-25 04:04:06'),
(39, 'Vikash Singh', '9158990147', 'Pending', 'BANK000004ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:06', '2026-05-25 04:04:06'),
(40, 'Rohit Kumar', '9295665970', 'Rejected', 'BANK000005ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:07', '2026-05-25 04:04:07'),
(41, 'Ankit Mishra', '9541570375', 'Verified', 'BANK000006ACC', 'Active', 'English', 1, '2026-05-25 04:04:08', '2026-05-25 04:04:08'),
(42, 'Deepak Chauhan', '9320205228', 'Verified', 'BANK000007ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:09', '2026-05-25 04:04:09'),
(43, 'Karan Patel', '9220762499', 'Pending', 'BANK000008ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:09', '2026-05-25 04:04:09'),
(44, 'Mohit Saxena', '9261283882', 'Pending', 'BANK000009ACC', 'Active', 'English', 1, '2026-05-25 04:04:10', '2026-05-25 04:04:10'),
(45, 'Nitin Gupta', '9229451149', 'Verified', 'BANK000010ACC', 'Active', 'English', 1, '2026-05-25 04:04:11', '2026-05-25 04:04:11'),
(46, 'Ajay Tiwari', '9693270988', 'Rejected', 'BANK000011ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:12', '2026-05-25 04:04:12'),
(47, 'Ravi Maurya', '9733959983', 'Pending', 'BANK000012ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:12', '2026-05-25 04:04:12'),
(48, 'Harsh Pandey', '9602415215', 'Verified', 'BANK000013ACC', 'Active', 'English', 1, '2026-05-25 04:04:13', '2026-05-25 04:04:13'),
(49, 'Piyush Srivastava', '9578381532', 'Rejected', 'BANK000014ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:14', '2026-05-25 04:04:14'),
(50, 'Manoj Rawat', '9115457892', 'Verified', 'BANK000015ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:14', '2026-05-25 04:04:14'),
(51, 'Shivam Dubey', '9704673066', 'Verified', 'BANK000016ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:15', '2026-05-25 04:04:15'),
(52, 'Arjun Thakur', '9408979621', 'Pending', 'BANK000017ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:16', '2026-05-25 04:04:16'),
(53, 'Yash Mehta', '9224918285', 'Rejected', 'BANK000018ACC', 'Active', 'English', 1, '2026-05-25 04:04:17', '2026-05-25 04:04:17'),
(54, 'Aditya Jain', '9302184981', 'Rejected', 'BANK000019ACC', 'Inactive', 'English', 1, '2026-05-25 04:04:17', '2026-05-25 04:04:17'),
(55, 'Prateek Singh', '9414625623', 'Verified', 'BANK000020ACC', 'Active', 'English', 1, '2026-05-25 04:04:18', '2026-05-25 04:04:18'),
(56, 'butcher', '56216651651', 'Pending', 'BANK754764786', 'Active', 'English', 1, '2026-05-25 07:49:37', '2026-05-25 07:49:37'),
(57, 'ekjf', '6548654654', 'Pending', 'BANK3254654', 'Active', 'English', 1, '2026-05-25 08:35:52', '2026-05-25 08:35:52'),
(61, 'Logan', '8418949254', 'Verified', 'BANK0852963', 'Active', 'English', 1, '2026-05-26 23:02:57', '2026-06-01 03:46:07'),
(62, 'Dean', '3692581470', 'Verified', '1234567890', 'Active', 'English', 1, '2026-05-27 03:23:43', '2026-05-27 03:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FcA51B1d8VETurjZ64pirznhlOsSu832g7lZ6ckc', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNng1Tnh2TXMxclVMTWNXelJaV3hlV0gxQzhPYW5YNTF0eElWbDdRMCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FjY291bnQvY2FzZXMiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FjY291bnQvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjE0OiJkYXNoYm9hcmRBZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1780306672);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'module_dashboard', '1', '2026-05-22 06:22:24', '2026-05-25 04:14:33'),
(2, 'module_payments', '1', '2026-05-22 06:22:24', '2026-05-22 06:23:02'),
(3, 'module_reports', '1', '2026-05-22 06:22:24', '2026-05-22 06:22:24'),
(4, 'module_challans', '1', '2026-05-22 06:22:24', '2026-05-25 04:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','sub-admin','prahari') NOT NULL DEFAULT 'prahari',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `permissions`) VALUES
(1, 'SuperAdmin', 'superadmin@gmail.com', NULL, '$2y$12$gxrnsc898RDt/jm.bWGWpePQ7Rssayglk79gdyvLvMobO.9apTpQC', 'admin', 'y0cLqVd1qGsRbzcPilYdYTuSxwwAYFraFzXI8TGEoyCmF2eUpsge8lMV59kZ', '2026-05-06 05:05:35', '2026-05-06 05:05:35', NULL),
(2, 'Abdul Anas', 'anas@gmail.com', NULL, '$2y$12$ASOFcQxqcZW0DCUsPQ/xeeDvrgL5Mney5NNTsROTUQCtjKWhFBj1C', 'sub-admin', NULL, '2026-05-07 22:51:51', '2026-05-07 22:51:51', '[\"manage_cases\"]'),
(3, 'George', 'george@gmail.com', NULL, '$2y$12$sO4nNpRsqm7Ec.ltAj0kWuRo61qt0atdwbsCUshtRnl09P3/bAO7i', 'sub-admin', NULL, '2026-05-08 10:34:39', '2026-05-22 00:41:02', '[\"manage_cases\",\"manage_challans\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cases_prahari_id_foreign` (`prahari_id`),
  ADD KEY `cases_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challans`
--
ALTER TABLE `challans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `challans_prahari_id_foreign` (`prahari_id`),
  ADD KEY `challans_case_id_foreign` (`case_id`),
  ADD KEY `challans_category_id_foreign` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_prahari_id_foreign` (`prahari_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `praharis`
--
ALTER TABLE `praharis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `praharis_bank_account_detail_unique` (`Bank_account_detail`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `challans`
--
ALTER TABLE `challans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `praharis`
--
ALTER TABLE `praharis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `cases_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cases_prahari_id_foreign` FOREIGN KEY (`prahari_id`) REFERENCES `praharis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `challans`
--
ALTER TABLE `challans`
  ADD CONSTRAINT `challans_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `cases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `challans_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `challans_prahari_id_foreign` FOREIGN KEY (`prahari_id`) REFERENCES `praharis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_prahari_id_foreign` FOREIGN KEY (`prahari_id`) REFERENCES `praharis` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
