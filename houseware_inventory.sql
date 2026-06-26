-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2026 at 12:55 PM
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
-- Database: `houseware_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `subject_type`, `subject_id`, `ip_address`, `user_agent`, `properties`, `created_at`) VALUES
(1, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.7462', NULL, '2026-06-23 07:17:53'),
(2, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 07:19:04'),
(3, 1, 'logout', 'Owner logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:10:32'),
(4, 2, 'login', 'Manager logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:11:06'),
(5, 2, 'logout', 'Manager logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:11:56'),
(6, 3, 'login', 'Cashier logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:12:06'),
(7, 3, 'sale', 'Completed sale INV-2606-0001 (₱212.88)', 'App\\Models\\Sale', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:13:37'),
(8, 3, 'sale', 'Completed sale INV-2606-0002 (₱221.88)', 'App\\Models\\Sale', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:14:27'),
(9, 3, 'logout', 'Cashier logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:15:14'),
(10, 4, 'login', 'Inventory Staff logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:15:23'),
(11, 4, 'update', 'Updated product: Plastic Storage Box', 'App\\Models\\Product', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:21:03'),
(12, 4, 'update', 'Updated product: Plastic Storage Box', 'App\\Models\\Product', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:26:41'),
(13, 4, 'update', 'Updated product: Plastic Storage Box', 'App\\Models\\Product', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:27:02'),
(14, 4, 'logout', 'Inventory Staff logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:30:12'),
(15, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-23 08:30:20'),
(16, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:30:11'),
(17, 1, 'logout', 'Owner logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:31:46'),
(18, 2, 'login', 'Manager logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:33:50'),
(19, 2, 'logout', 'Manager logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:35:30'),
(20, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:36:53'),
(21, 1, 'logout', 'Owner logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:37:29'),
(22, 2, 'login', 'Manager logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:37:33'),
(23, 2, 'logout', 'Manager logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:37:38'),
(24, 3, 'login', 'Cashier logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:37:42'),
(25, 3, 'logout', 'Cashier logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:37:58'),
(26, 4, 'login', 'Inventory Staff logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:38:04'),
(27, 4, 'logout', 'Inventory Staff logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:38:30'),
(28, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 09:39:01'),
(29, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2026-06-25 09:47:22'),
(30, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2026-06-25 11:16:55'),
(31, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2026-06-25 11:17:45'),
(32, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2026-06-25 11:38:30'),
(33, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2026-06-25 11:39:28'),
(34, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2026-06-25 11:51:25'),
(35, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2026-06-25 11:51:54'),
(36, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-25 11:59:34'),
(37, 4, 'stock_in', 'Recorded stock in SI-2606-0001', 'App\\Models\\StockIn', 1, '127.0.0.1', 'Seeder', NULL, '2026-06-11 01:15:00'),
(38, 4, 'stock_in', 'Recorded stock in SI-2606-0002', 'App\\Models\\StockIn', 2, '127.0.0.1', 'Seeder', NULL, '2026-06-18 02:30:00'),
(39, 2, 'sale', 'Completed sale INV-2606-0023 (₱1,547.06)', 'App\\Models\\Sale', 23, '127.0.0.1', 'Seeder', NULL, '2026-06-19 04:13:37'),
(40, 2, 'sale', 'Completed sale INV-2606-0024 (₱3,492.05)', 'App\\Models\\Sale', 24, '127.0.0.1', 'Seeder', NULL, '2026-06-19 04:20:13'),
(41, 2, 'sale', 'Completed sale INV-2606-0025 (₱1,340.64)', 'App\\Models\\Sale', 25, '127.0.0.1', 'Seeder', NULL, '2026-06-19 02:44:07'),
(42, 3, 'sale', 'Completed sale INV-2606-0026 (₱3,959.14)', 'App\\Models\\Sale', 26, '127.0.0.1', 'Seeder', NULL, '2026-06-19 04:58:26'),
(43, 3, 'sale', 'Completed sale INV-2606-0027 (₱891.52)', 'App\\Models\\Sale', 27, '127.0.0.1', 'Seeder', NULL, '2026-06-20 01:11:32'),
(44, 1, 'sale', 'Completed sale INV-2606-0028 (₱1,117.76)', 'App\\Models\\Sale', 28, '127.0.0.1', 'Seeder', NULL, '2026-06-20 09:15:13'),
(45, 2, 'sale', 'Completed sale INV-2606-0029 (₱245.28)', 'App\\Models\\Sale', 29, '127.0.0.1', 'Seeder', NULL, '2026-06-20 05:12:31'),
(46, 3, 'sale', 'Completed sale INV-2606-0030 (₱1,864.80)', 'App\\Models\\Sale', 30, '127.0.0.1', 'Seeder', NULL, '2026-06-20 08:29:57'),
(47, 2, 'sale', 'Completed sale INV-2606-0031 (₱3,521.28)', 'App\\Models\\Sale', 31, '127.0.0.1', 'Seeder', NULL, '2026-06-21 00:55:32'),
(48, 1, 'sale', 'Completed sale INV-2606-0032 (₱1,664.32)', 'App\\Models\\Sale', 32, '127.0.0.1', 'Seeder', NULL, '2026-06-21 08:27:48'),
(49, 3, 'sale', 'Completed sale INV-2606-0033 (₱534.24)', 'App\\Models\\Sale', 33, '127.0.0.1', 'Seeder', NULL, '2026-06-22 03:45:27'),
(50, 3, 'sale', 'Completed sale INV-2606-0034 (₱2,973.60)', 'App\\Models\\Sale', 34, '127.0.0.1', 'Seeder', NULL, '2026-06-22 05:04:11'),
(51, 1, 'sale', 'Completed sale INV-2606-0035 (₱446.88)', 'App\\Models\\Sale', 35, '127.0.0.1', 'Seeder', NULL, '2026-06-22 01:33:44'),
(52, 2, 'sale', 'Completed sale INV-2606-0036 (₱826.56)', 'App\\Models\\Sale', 36, '127.0.0.1', 'Seeder', NULL, '2026-06-23 03:41:52'),
(53, 1, 'sale', 'Completed sale INV-2606-0037 (₱3,058.72)', 'App\\Models\\Sale', 37, '127.0.0.1', 'Seeder', NULL, '2026-06-23 10:03:18'),
(54, 3, 'sale', 'Completed sale INV-2606-0038 (₱3,551.52)', 'App\\Models\\Sale', 38, '127.0.0.1', 'Seeder', NULL, '2026-06-23 06:39:01'),
(55, 3, 'sale', 'Completed sale INV-2606-0039 (₱2,200.80)', 'App\\Models\\Sale', 39, '127.0.0.1', 'Seeder', NULL, '2026-06-23 04:02:57'),
(56, 2, 'sale', 'Completed sale INV-2606-0040 (₱6,427.68)', 'App\\Models\\Sale', 40, '127.0.0.1', 'Seeder', NULL, '2026-06-23 00:46:40'),
(57, 2, 'sale', 'Completed sale INV-2606-0041 (₱2,038.62)', 'App\\Models\\Sale', 41, '127.0.0.1', 'Seeder', NULL, '2026-06-24 11:37:00'),
(58, 3, 'sale', 'Completed sale INV-2606-0042 (₱5,477.92)', 'App\\Models\\Sale', 42, '127.0.0.1', 'Seeder', NULL, '2026-06-24 07:04:04'),
(59, 3, 'sale', 'Completed sale INV-2606-0043 (₱1,294.72)', 'App\\Models\\Sale', 43, '127.0.0.1', 'Seeder', NULL, '2026-06-25 07:40:47'),
(60, 1, 'sale', 'Completed sale INV-2606-0044 (₱3,929.35)', 'App\\Models\\Sale', 44, '127.0.0.1', 'Seeder', NULL, '2026-06-25 03:52:41'),
(61, 1, 'sale', 'Completed sale INV-2606-0045 (₱3,130.40)', 'App\\Models\\Sale', 45, '127.0.0.1', 'Seeder', NULL, '2026-06-25 11:38:41'),
(62, 3, 'sale', 'Completed sale INV-2606-0046 (₱3,130.40)', 'App\\Models\\Sale', 46, '127.0.0.1', 'Seeder', NULL, '2026-06-25 07:02:53'),
(63, 2, 'sale', 'Completed sale INV-2606-0047 (₱7,468.16)', 'App\\Models\\Sale', 47, '127.0.0.1', 'Seeder', NULL, '2026-06-25 09:43:08'),
(64, 3, 'sale', 'Completed sale INV-2606-0048 (₱1,844.64)', 'App\\Models\\Sale', 48, '127.0.0.1', 'Seeder', NULL, '2026-06-25 07:46:36'),
(65, 2, 'sale', 'Completed sale INV-2606-0049 (₱1,787.52)', 'App\\Models\\Sale', 49, '127.0.0.1', 'Seeder', NULL, '2026-06-25 09:54:57'),
(66, 4, 'stock_out', 'Recorded stock out SO-2606-0001', 'App\\Models\\StockOut', 1, '127.0.0.1', 'Seeder', NULL, '2026-06-20 06:31:00'),
(67, 4, 'stock_out', 'Recorded stock out SO-2606-0002', 'App\\Models\\StockOut', 2, '127.0.0.1', 'Seeder', NULL, '2026-06-23 06:35:00'),
(68, 2, 'adjustment', 'Recorded adjustment ADJ-2606-0001', 'App\\Models\\Adjustment', 1, '127.0.0.1', 'Seeder', NULL, '2026-06-22 08:20:00'),
(69, 1, 'purchase_order', 'Created purchase order PO-2606-0001', 'App\\Models\\PurchaseOrder', 1, '127.0.0.1', 'Seeder', NULL, '2026-06-25 03:00:00'),
(70, 1, 'purchase_order', 'Created purchase order PO-2606-0002', 'App\\Models\\PurchaseOrder', 2, '127.0.0.1', 'Seeder', NULL, '2026-06-23 01:30:00'),
(71, 1, 'purchase_order', 'Created purchase order PO-2606-0003', 'App\\Models\\PurchaseOrder', 3, '127.0.0.1', 'Seeder', NULL, '2026-06-20 07:00:00'),
(72, 1, 'purchase_order', 'Created purchase order PO-2606-0004', 'App\\Models\\PurchaseOrder', 4, '127.0.0.1', 'Seeder', NULL, '2026-06-16 00:45:00'),
(73, 4, 'purchase_order', 'Received items for PO PO-2606-0004', 'App\\Models\\PurchaseOrder', 4, '127.0.0.1', 'Seeder', NULL, '2026-06-18 05:00:00'),
(74, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2026-06-25 12:54:07'),
(75, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2026-06-25 12:55:43'),
(76, 1, 'login', 'Owner logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-26 02:22:44'),
(77, 1, 'sale', 'Completed sale INV-2606-0050 (₱1,002.64)', 'App\\Models\\Sale', 50, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-26 02:23:58'),
(78, 1, 'logout', 'Owner logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-26 02:26:00'),
(79, 2, 'login', 'Manager logged in.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-26 02:26:05'),
(80, 2, 'update', 'Updated product: Non-Stick Frying Pan', 'App\\Models\\Product', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', NULL, '2026-06-26 02:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `adjustments`
--

CREATE TABLE `adjustments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adjustments`
--

INSERT INTO `adjustments` (`id`, `reference_no`, `type`, `reason`, `date`, `user_id`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'ADJ-2606-0001', 'correct', 'Monthly physical inventory count', '2026-06-22', 2, 'Reconciled system stock against counted quantities.', '2026-06-22 08:20:00', '2026-06-22 08:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `adjustment_items`
--

CREATE TABLE `adjustment_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adjustment_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `quantity_before` int(11) NOT NULL,
  `quantity_after` int(11) NOT NULL,
  `difference` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adjustment_items`
--

INSERT INTO `adjustment_items` (`id`, `adjustment_id`, `product_variant_id`, `quantity_before`, `quantity_after`, `difference`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 160, 0, -160, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(2, 1, 2, 120, 3, -117, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(3, 1, 7, 156, 5, -151, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(4, 1, 14, 97, 8, -89, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(5, 1, 17, 192, 6, -186, '2026-06-25 12:53:26', '2026-06-25 12:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `app_notifications`
--

CREATE TABLE `app_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'info',
  `url` varchar(255) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_notifications`
--

INSERT INTO `app_notifications` (`id`, `type`, `title`, `message`, `level`, `url`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'out_of_stock', 'Out of Stock', 'Plastic Storage Box — Small is out of stock.', 'danger', 'http://localhost:8000/variants/lookup?id=1', NULL, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(2, 'low_stock', 'Low Stock Alert', 'Plastic Storage Box — Medium is running low (3 left).', 'warning', 'http://localhost:8000/variants/lookup?id=2', NULL, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(3, 'low_stock', 'Low Stock Alert', 'Microfiber Cleaning Cloth — Pack of 3 is running low (5 left).', 'warning', 'http://localhost:8000/variants/lookup?id=7', NULL, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(4, 'low_stock', 'Low Stock Alert', 'Bathroom Organizer Rack — 2-Tier is running low (8 left).', 'warning', 'http://localhost:8000/variants/lookup?id=14', NULL, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(5, 'low_stock', 'Low Stock Alert', 'Decorative Wall Clock — Round 30cm is running low (6 left).', 'warning', 'http://localhost:8000/variants/lookup?id=17', NULL, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(6, 'out_of_stock', 'Out of Stock', 'Plastic Storage Box — Medium is out of stock.', 'danger', 'http://127.0.0.1:8000/variants/lookup?id=2', NULL, '2026-06-26 02:23:58', '2026-06-26 02:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lock & Lock', NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(2, 'Tupperware', NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(3, 'Orocan', NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(4, 'Home Basics', NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(5, 'Generic', NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('setting_address', 's:38:\"123 Market Street, Manila, Philippines\";', 2097559208),
('setting_currency', 's:3:\"₱\";', 2097559073),
('setting_email', 's:0:\"\";', 2097559208),
('setting_footer_note', 's:0:\"\";', 2097559208),
('setting_phone', 's:16:\"+63 900 000 0000\";', 2097559208),
('setting_shop_name', 's:14:\"Houseware Shop\";', 2097559073),
('setting_tax_rate', 's:2:\"12\";', 2097559074),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:16:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"view dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"manage products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"manage categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"manage brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:16:\"manage suppliers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:16:\"manage customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"manage stock_in\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:16:\"manage stock_out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:18:\"manage adjustments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:22:\"manage purchase_orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:13:\"process sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:12:\"view reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"manage users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:18:\"view activity_logs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"manage settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:14:\"manage backups\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:4:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"Owner\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"Manager\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"Cashier\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"Inventory Staff\";s:1:\"c\";s:3:\"web\";}}}', 1782466213);

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `parent_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kitchenware', 'kitchenware', NULL, NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(2, 'Bathroom', 'bathroom', NULL, NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(3, 'Cleaning Supplies', 'cleaning-supplies', NULL, NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(4, 'Plastic Products', 'plastic-products', NULL, NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(5, 'Storage Boxes', 'storage-boxes', NULL, NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(6, 'Home Decor', 'home-decor', NULL, NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(7, 'Furniture', 'furniture', NULL, NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(8, 'Lighting', 'lighting', NULL, NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(9, 'Appliances', 'appliances', NULL, NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(10, 'Hardware', 'hardware', NULL, NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Walk-in Customer', NULL, NULL, NULL, '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(2, 'Ana Lim', '+63 920 123 4567', NULL, 'Quezon City', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(3, 'Robert Tan', '+63 921 765 4321', NULL, 'Makati City', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL);

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
(4, '2026_06_23_141038_create_permission_tables', 1),
(5, '2026_06_23_141100_create_inventory_core_tables', 1),
(6, '2026_06_23_141200_create_inventory_transaction_tables', 1),
(7, '2026_06_23_141300_create_sales_and_log_tables', 1),
(8, '2026_06_23_141400_add_profile_fields_to_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view dashboard', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(2, 'manage products', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(3, 'manage categories', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(4, 'manage brands', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(5, 'manage suppliers', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(6, 'manage customers', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(7, 'manage stock_in', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(8, 'manage stock_out', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(9, 'manage adjustments', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(10, 'manage purchase_orders', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(11, 'process sales', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(12, 'view reports', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(13, 'manage users', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(14, 'view activity_logs', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(15, 'manage settings', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(16, 'manage backups', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cost_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `selling_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `has_variants` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `barcode`, `category_id`, `brand_id`, `supplier_id`, `unit_id`, `image`, `cost_price`, `selling_price`, `description`, `has_variants`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Plastic Storage Box', 'PRD-2B7FVQ', '9683899470575', 5, 3, 2, 1, 'products/QVozCraK1pY9tTN0zyUW3XgI5vNPRktM0TVygfGP.jpg', 120.00, 199.00, 'Quality Plastic Storage Box for everyday household use.', 1, 'active', '2026-06-23 07:16:51', '2026-06-23 08:27:02', NULL),
(2, 'Non-Stick Frying Pan', 'PRD-FS76ZB', '6585853116646', 1, 4, 1, 3, 'products/fnNKrxQy5Me8rx0HSqsBuKQ6KHxLZ8aUvLP0zDwX.jpg', 320.00, 549.00, 'Quality Non-Stick Frying Pan for everyday household use.', 1, 'active', '2026-06-23 07:16:51', '2026-06-26 02:27:53', NULL),
(3, 'Microfiber Cleaning Cloth', 'PRD-L3HD4D', '8485645213273', 3, 5, 2, 4, NULL, 60.00, 120.00, 'Quality Microfiber Cleaning Cloth for everyday household use.', 1, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(4, 'Airtight Food Container', 'PRD-1T3KPU', '5479340434912', 1, 1, 2, 3, NULL, 85.00, 159.00, 'Quality Airtight Food Container for everyday household use.', 1, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(5, 'LED Desk Lamp', 'PRD-M5XVP3', '7130348926127', 8, 4, 1, 1, NULL, 380.00, 649.00, 'Quality LED Desk Lamp for everyday household use.', 1, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(6, 'Bathroom Organizer Rack', 'PRD-0ZZ2ZY', '2747620579471', 2, 5, 3, 1, NULL, 290.00, 499.00, 'Quality Bathroom Organizer Rack for everyday household use.', 1, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(7, 'Stainless Steel Dish Rack', 'PRD-BU6QPK', '4010919242242', 1, 4, 3, 1, NULL, 450.00, 799.00, 'Quality Stainless Steel Dish Rack for everyday household use.', 0, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(8, 'Decorative Wall Clock', 'PRD-JWESKS', '5547036970476', 6, 5, 1, 1, NULL, 220.00, 399.00, 'Quality Decorative Wall Clock for everyday household use.', 1, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Default',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attributes`)),
  `cost_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `selling_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `reorder_level` int(11) NOT NULL DEFAULT 10,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `name`, `sku`, `barcode`, `attributes`, `cost_price`, `selling_price`, `stock_quantity`, `reorder_level`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Small', 'PRD-2B7FVQ-SMALL', '1809565421747', '{\"variant\":\"Small\"}', 120.00, 199.00, 0, 10, 1, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(2, 1, 'Medium', 'PRD-2B7FVQ-MEDIUM', '9668008088631', '{\"variant\":\"Medium\"}', 180.00, 299.00, 0, 10, 0, 'active', '2026-06-23 07:16:51', '2026-06-26 02:23:58'),
(3, 1, 'Large', 'PRD-2B7FVQ-LARGE', '7195931360545', '{\"variant\":\"Large\"}', 250.00, 399.00, 77, 10, 0, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:25'),
(4, 2, '24cm', 'PRD-FS76ZB-24CM', '6163426368666', '{\"variant\":\"24cm\"}', 320.00, 549.00, 113, 10, 1, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(5, 2, '28cm', 'PRD-FS76ZB-28CM', '5323133701975', '{\"variant\":\"28cm\"}', 420.00, 699.00, 106, 10, 0, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(6, 2, '32cm', 'PRD-FS76ZB-32CM', '2994159047241', '{\"variant\":\"32cm\"}', 520.00, 849.00, 143, 10, 0, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:25'),
(7, 3, 'Pack of 3', 'PRD-L3HD4D-PACKOF3', '5652744403483', '{\"variant\":\"Pack of 3\"}', 60.00, 120.00, 63, 10, 1, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(8, 3, 'Pack of 6', 'PRD-L3HD4D-PACKOF6', '8135903776631', '{\"variant\":\"Pack of 6\"}', 110.00, 220.00, 146, 10, 0, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:25'),
(9, 4, '500ml', 'PRD-1T3KPU-500ML', '4332922836726', '{\"variant\":\"500ml\"}', 85.00, 159.00, 112, 10, 1, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:25'),
(10, 4, '1L', 'PRD-1T3KPU-1L', '1479195699960', '{\"variant\":\"1L\"}', 120.00, 219.00, 164, 10, 0, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(11, 4, '2L', 'PRD-1T3KPU-2L', '9393304293953', '{\"variant\":\"2L\"}', 160.00, 289.00, 169, 10, 0, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(12, 5, 'White', 'PRD-M5XVP3-WHITE', '2386563046313', '{\"variant\":\"White\"}', 380.00, 649.00, 122, 10, 1, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(13, 5, 'Black', 'PRD-M5XVP3-BLACK', '3397742106599', '{\"variant\":\"Black\"}', 380.00, 649.00, 151, 10, 0, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(14, 6, '2-Tier', 'PRD-0ZZ2ZY-2TIER', '3479140691113', '{\"variant\":\"2-Tier\"}', 290.00, 499.00, 35, 10, 1, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(15, 6, '3-Tier', 'PRD-0ZZ2ZY-3TIER', '6887629927999', '{\"variant\":\"3-Tier\"}', 390.00, 649.00, 145, 10, 0, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(16, 7, 'Standard', 'PRD-BU6QPK-STANDARD', '3915844809990', '{\"variant\":\"Standard\"}', 450.00, 799.00, 135, 10, 1, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(17, 8, 'Round 30cm', 'PRD-JWESKS-ROUND30CM', '1319536871692', '{\"variant\":\"Round 30cm\"}', 220.00, 399.00, 6, 10, 1, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:26'),
(18, 8, 'Square 25cm', 'PRD-JWESKS-SQUARE25CM', '5537431289799', '{\"variant\":\"Square 25cm\"}', 200.00, 369.00, 121, 10, 0, 'active', '2026-06-23 07:16:51', '2026-06-25 12:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_date` date NOT NULL,
  `expected_date` date DEFAULT NULL,
  `subtotal` decimal(14,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(14,2) NOT NULL DEFAULT 0.00,
  `total` decimal(14,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `po_number`, `supplier_id`, `status`, `order_date`, `expected_date`, `subtotal`, `tax`, `total`, `notes`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, 'PO-2606-0001', 3, 'pending', '2026-06-25', '2026-07-02', 19100.00, 2292.00, 21392.00, 'Restock order.', 1, NULL, '2026-06-25 03:00:00', '2026-06-25 03:00:00'),
(2, 'PO-2606-0002', 1, 'approved', '2026-06-23', '2026-06-30', 40145.00, 4817.40, 44962.40, 'Restock order.', 1, 1, '2026-06-23 01:30:00', '2026-06-25 12:53:26'),
(3, 'PO-2606-0003', 3, 'ordered', '2026-06-20', '2026-06-27', 36910.00, 4429.20, 41339.20, 'Restock order.', 2, NULL, '2026-06-20 07:00:00', '2026-06-25 12:53:26'),
(4, 'PO-2606-0004', 3, 'completed', '2026-06-16', '2026-06-23', 16830.00, 2019.60, 18849.60, 'Restock order.', 2, NULL, '2026-06-16 00:45:00', '2026-06-25 12:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `received_quantity` int(11) NOT NULL DEFAULT 0,
  `unit_cost` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(14,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `purchase_order_id`, `product_variant_id`, `quantity`, `received_quantity`, `unit_cost`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 53, 0, 120.00, 6360.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(2, 1, 3, 26, 0, 250.00, 6500.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(3, 1, 11, 39, 0, 160.00, 6240.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(4, 2, 2, 20, 0, 180.00, 3600.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(5, 2, 5, 33, 0, 420.00, 13860.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(6, 2, 9, 21, 0, 85.00, 1785.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(7, 2, 13, 55, 0, 380.00, 20900.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(8, 3, 15, 45, 0, 390.00, 17550.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(9, 3, 17, 38, 0, 220.00, 8360.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(10, 3, 18, 55, 0, 200.00, 11000.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(11, 4, 7, 58, 58, 60.00, 3480.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(12, 4, 10, 46, 46, 120.00, 5520.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(13, 4, 14, 27, 27, 290.00, 7830.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Owner', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(2, 'Manager', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(3, 'Cashier', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50'),
(4, 'Inventory Staff', 'web', '2026-06-23 07:16:50', '2026-06-23 07:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 4),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 4),
(8, 1),
(8, 2),
(8, 4),
(9, 1),
(9, 2),
(9, 4),
(10, 1),
(10, 2),
(10, 4),
(11, 1),
(11, 2),
(11, 3),
(12, 1),
(12, 2),
(13, 1),
(14, 1),
(14, 2),
(15, 1),
(16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subtotal` decimal(14,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(14,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(14,2) NOT NULL DEFAULT 0.00,
  `total` decimal(14,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) NOT NULL DEFAULT 'cash',
  `amount_paid` decimal(14,2) NOT NULL DEFAULT 0.00,
  `change_due` decimal(14,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'completed',
  `cashier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `invoice_number`, `customer_id`, `subtotal`, `discount`, `tax`, `total`, `payment_method`, `amount_paid`, `change_due`, `status`, `cashier_id`, `sale_date`, `created_at`, `updated_at`) VALUES
(1, 'INV-2606-0001', NULL, 199.00, 10.00, 23.88, 212.88, 'cash', 212.88, 0.00, 'completed', 3, '2026-06-23 16:13:37', '2026-06-23 08:13:37', '2026-06-23 08:13:37'),
(2, 'INV-2606-0002', NULL, 199.00, 1.00, 23.88, 221.88, 'cash', 221.88, 0.00, 'completed', 3, '2026-06-23 16:14:27', '2026-06-23 08:14:27', '2026-06-23 08:14:27'),
(3, 'INV-2606-0003', NULL, 558.00, 0.00, 66.96, 624.96, 'card', 624.96, 0.00, 'completed', 3, '2026-06-12 15:13:27', '2026-06-12 07:13:27', '2026-06-12 07:13:27'),
(4, 'INV-2606-0004', 2, 880.00, 0.00, 105.60, 985.60, 'gcash', 985.60, 0.00, 'completed', 1, '2026-06-12 13:15:08', '2026-06-12 05:15:08', '2026-06-12 05:15:08'),
(5, 'INV-2606-0005', 3, 1902.00, 0.00, 228.24, 2130.24, 'card', 2130.24, 0.00, 'completed', 1, '2026-06-12 09:54:54', '2026-06-12 01:54:54', '2026-06-12 01:54:54'),
(6, 'INV-2606-0006', 2, 3163.00, 0.00, 379.56, 3542.56, 'card', 3542.56, 0.00, 'completed', 1, '2026-06-13 08:25:13', '2026-06-13 00:25:13', '2026-06-13 00:25:13'),
(7, 'INV-2606-0007', NULL, 868.00, 0.00, 104.16, 972.16, 'card', 972.16, 0.00, 'completed', 3, '2026-06-13 09:53:26', '2026-06-13 01:53:26', '2026-06-13 01:53:26'),
(8, 'INV-2606-0008', 2, 1996.00, 0.00, 239.52, 2235.52, 'card', 2235.52, 0.00, 'completed', 2, '2026-06-14 09:19:13', '2026-06-14 01:19:13', '2026-06-14 01:19:13'),
(9, 'INV-2606-0009', 1, 1098.00, 0.00, 131.76, 1229.76, 'cash', 1250.00, 20.24, 'completed', 3, '2026-06-14 18:35:52', '2026-06-14 10:35:52', '2026-06-14 10:35:52'),
(10, 'INV-2606-0010', 3, 360.00, 0.00, 43.20, 403.20, 'card', 403.20, 0.00, 'completed', 1, '2026-06-15 11:28:39', '2026-06-15 03:28:39', '2026-06-15 03:28:39'),
(11, 'INV-2606-0011', 1, 2056.00, 0.00, 246.72, 2302.72, 'cash', 2350.00, 47.28, 'completed', 2, '2026-06-15 13:18:43', '2026-06-15 05:18:43', '2026-06-15 05:18:43'),
(12, 'INV-2606-0012', NULL, 699.00, 0.00, 83.88, 782.88, 'cash', 800.00, 17.12, 'completed', 3, '2026-06-15 09:46:14', '2026-06-15 01:46:14', '2026-06-15 01:46:14'),
(13, 'INV-2606-0013', 2, 2356.00, 0.00, 282.72, 2638.72, 'cash', 2650.00, 11.28, 'completed', 3, '2026-06-16 14:31:11', '2026-06-16 06:31:11', '2026-06-16 06:31:11'),
(14, 'INV-2606-0014', NULL, 2296.00, 0.00, 275.52, 2571.52, 'gcash', 2571.52, 0.00, 'completed', 1, '2026-06-16 10:20:35', '2026-06-16 02:20:35', '2026-06-16 02:20:35'),
(15, 'INV-2606-0015', 3, 5841.00, 0.00, 700.92, 6541.92, 'cash', 6550.00, 8.08, 'completed', 1, '2026-06-17 08:20:39', '2026-06-17 00:20:39', '2026-06-17 00:20:39'),
(16, 'INV-2606-0016', NULL, 1156.00, 0.00, 138.72, 1294.72, 'card', 1294.72, 0.00, 'completed', 1, '2026-06-17 12:26:29', '2026-06-17 04:26:29', '2026-06-17 04:26:29'),
(17, 'INV-2606-0017', NULL, 1875.00, 0.00, 225.00, 2100.00, 'cash', 2100.00, 0.00, 'completed', 3, '2026-06-17 17:55:18', '2026-06-17 09:55:18', '2026-06-17 09:55:18'),
(18, 'INV-2606-0018', 3, 2894.00, 0.00, 347.28, 3241.28, 'cash', 3250.00, 8.72, 'completed', 2, '2026-06-17 13:16:48', '2026-06-17 05:16:48', '2026-06-17 05:16:48'),
(19, 'INV-2606-0019', 3, 1398.00, 0.00, 167.76, 1565.76, 'cash', 1600.00, 34.24, 'completed', 1, '2026-06-18 13:07:51', '2026-06-18 05:07:51', '2026-06-18 05:07:51'),
(20, 'INV-2606-0020', NULL, 399.00, 0.00, 47.88, 446.88, 'gcash', 446.88, 0.00, 'completed', 3, '2026-06-18 16:35:06', '2026-06-18 08:35:06', '2026-06-18 08:35:06'),
(21, 'INV-2606-0021', 3, 4462.00, 0.00, 535.44, 4997.44, 'card', 4997.44, 0.00, 'completed', 1, '2026-06-18 14:44:35', '2026-06-18 06:44:35', '2026-06-18 06:44:35'),
(22, 'INV-2606-0022', NULL, 3145.00, 0.00, 377.40, 3522.40, 'gcash', 3522.40, 0.00, 'completed', 1, '2026-06-18 14:56:50', '2026-06-18 06:56:50', '2026-06-18 06:56:50'),
(23, 'INV-2606-0023', NULL, 1454.00, 72.70, 165.76, 1547.06, 'cash', 1550.00, 2.94, 'completed', 2, '2026-06-19 12:13:37', '2026-06-19 04:13:37', '2026-06-19 04:13:37'),
(24, 'INV-2606-0024', 3, 3282.00, 164.10, 374.15, 3492.05, 'cash', 3500.00, 7.95, 'completed', 2, '2026-06-19 12:20:13', '2026-06-19 04:20:13', '2026-06-19 04:20:13'),
(25, 'INV-2606-0025', NULL, 1197.00, 0.00, 143.64, 1340.64, 'gcash', 1340.64, 0.00, 'completed', 2, '2026-06-19 10:44:07', '2026-06-19 02:44:07', '2026-06-19 02:44:07'),
(26, 'INV-2606-0026', 1, 3721.00, 186.05, 424.19, 3959.14, 'cash', 4000.00, 40.86, 'completed', 3, '2026-06-19 12:58:26', '2026-06-19 04:58:26', '2026-06-19 04:58:26'),
(27, 'INV-2606-0027', 2, 796.00, 0.00, 95.52, 891.52, 'cash', 900.00, 8.48, 'completed', 3, '2026-06-20 09:11:32', '2026-06-20 01:11:32', '2026-06-20 01:11:32'),
(28, 'INV-2606-0028', NULL, 998.00, 0.00, 119.76, 1117.76, 'cash', 1150.00, 32.24, 'completed', 1, '2026-06-20 17:15:13', '2026-06-20 09:15:13', '2026-06-20 09:15:13'),
(29, 'INV-2606-0029', NULL, 219.00, 0.00, 26.28, 245.28, 'gcash', 245.28, 0.00, 'completed', 2, '2026-06-20 13:12:31', '2026-06-20 05:12:31', '2026-06-20 05:12:31'),
(30, 'INV-2606-0030', 3, 1665.00, 0.00, 199.80, 1864.80, 'card', 1864.80, 0.00, 'completed', 3, '2026-06-20 16:29:57', '2026-06-20 08:29:57', '2026-06-20 08:29:57'),
(31, 'INV-2606-0031', NULL, 3144.00, 0.00, 377.28, 3521.28, 'cash', 3550.00, 28.72, 'completed', 2, '2026-06-21 08:55:32', '2026-06-21 00:55:32', '2026-06-21 00:55:32'),
(32, 'INV-2606-0032', NULL, 1486.00, 0.00, 178.32, 1664.32, 'card', 1664.32, 0.00, 'completed', 1, '2026-06-21 16:27:48', '2026-06-21 08:27:48', '2026-06-21 08:27:48'),
(33, 'INV-2606-0033', 3, 477.00, 0.00, 57.24, 534.24, 'gcash', 534.24, 0.00, 'completed', 3, '2026-06-22 11:45:27', '2026-06-22 03:45:27', '2026-06-22 03:45:27'),
(34, 'INV-2606-0034', NULL, 2655.00, 0.00, 318.60, 2973.60, 'gcash', 2973.60, 0.00, 'completed', 3, '2026-06-22 13:04:11', '2026-06-22 05:04:11', '2026-06-22 05:04:11'),
(35, 'INV-2606-0035', 3, 399.00, 0.00, 47.88, 446.88, 'cash', 450.00, 3.12, 'completed', 1, '2026-06-22 09:33:44', '2026-06-22 01:33:44', '2026-06-22 01:33:44'),
(36, 'INV-2606-0036', NULL, 738.00, 0.00, 88.56, 826.56, 'cash', 850.00, 23.44, 'completed', 2, '2026-06-23 11:41:52', '2026-06-23 03:41:52', '2026-06-23 03:41:52'),
(37, 'INV-2606-0037', 3, 2731.00, 0.00, 327.72, 3058.72, 'cash', 3100.00, 41.28, 'completed', 1, '2026-06-23 18:03:18', '2026-06-23 10:03:18', '2026-06-23 10:03:18'),
(38, 'INV-2606-0038', NULL, 3171.00, 0.00, 380.52, 3551.52, 'cash', 3600.00, 48.48, 'completed', 3, '2026-06-23 14:39:01', '2026-06-23 06:39:01', '2026-06-23 06:39:01'),
(39, 'INV-2606-0039', NULL, 1965.00, 0.00, 235.80, 2200.80, 'gcash', 2200.80, 0.00, 'completed', 3, '2026-06-23 12:02:57', '2026-06-23 04:02:57', '2026-06-23 04:02:57'),
(40, 'INV-2606-0040', NULL, 5739.00, 0.00, 688.68, 6427.68, 'gcash', 6427.68, 0.00, 'completed', 2, '2026-06-23 08:46:40', '2026-06-23 00:46:40', '2026-06-23 00:46:40'),
(41, 'INV-2606-0041', 3, 1916.00, 95.80, 218.42, 2038.62, 'card', 2038.62, 0.00, 'completed', 2, '2026-06-24 19:37:00', '2026-06-24 11:37:00', '2026-06-24 11:37:00'),
(42, 'INV-2606-0042', 1, 4891.00, 0.00, 586.92, 5477.92, 'gcash', 5477.92, 0.00, 'completed', 3, '2026-06-24 15:04:04', '2026-06-24 07:04:04', '2026-06-24 07:04:04'),
(43, 'INV-2606-0043', 3, 1156.00, 0.00, 138.72, 1294.72, 'gcash', 1294.72, 0.00, 'completed', 3, '2026-06-25 15:40:47', '2026-06-25 07:40:47', '2026-06-25 07:40:47'),
(44, 'INV-2606-0044', 3, 3693.00, 184.65, 421.00, 3929.35, 'cash', 3950.00, 20.65, 'completed', 1, '2026-06-25 11:52:41', '2026-06-25 03:52:41', '2026-06-25 03:52:41'),
(45, 'INV-2606-0045', 1, 2795.00, 0.00, 335.40, 3130.40, 'gcash', 3130.40, 0.00, 'completed', 1, '2026-06-25 19:38:41', '2026-06-25 11:38:41', '2026-06-25 11:38:41'),
(46, 'INV-2606-0046', NULL, 2795.00, 0.00, 335.40, 3130.40, 'card', 3130.40, 0.00, 'completed', 3, '2026-06-25 15:02:53', '2026-06-25 07:02:53', '2026-06-25 07:02:53'),
(47, 'INV-2606-0047', NULL, 6668.00, 0.00, 800.16, 7468.16, 'gcash', 7468.16, 0.00, 'completed', 2, '2026-06-25 17:43:08', '2026-06-25 09:43:08', '2026-06-25 09:43:08'),
(48, 'INV-2606-0048', 2, 1647.00, 0.00, 197.64, 1844.64, 'card', 1844.64, 0.00, 'completed', 3, '2026-06-25 15:46:36', '2026-06-25 07:46:36', '2026-06-25 07:46:36'),
(49, 'INV-2606-0049', NULL, 1596.00, 0.00, 191.52, 1787.52, 'gcash', 1787.52, 0.00, 'completed', 2, '2026-06-25 17:54:57', '2026-06-25 09:54:57', '2026-06-25 09:54:57'),
(50, 'INV-2606-0050', 2, 897.00, 2.00, 107.64, 1002.64, 'cash', 1002.64, 0.00, 'completed', 1, '2026-06-26 10:23:58', '2026-06-26 02:23:58', '2026-06-26 02:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `unit_cost` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(14,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_variant_id`, `quantity`, `unit_price`, `unit_cost`, `discount`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 199.00, 120.00, 0.00, 199.00, '2026-06-23 08:13:37', '2026-06-23 08:13:37'),
(2, 2, 1, 1, 199.00, 120.00, 0.00, 199.00, '2026-06-23 08:14:27', '2026-06-23 08:14:27'),
(3, 3, 7, 2, 120.00, 60.00, 0.00, 240.00, '2026-06-25 12:50:35', '2026-06-25 12:50:35'),
(4, 3, 9, 2, 159.00, 85.00, 0.00, 318.00, '2026-06-25 12:50:35', '2026-06-25 12:50:35'),
(5, 4, 8, 4, 220.00, 110.00, 0.00, 880.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(6, 5, 4, 1, 549.00, 320.00, 0.00, 549.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(7, 5, 9, 3, 159.00, 85.00, 0.00, 477.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(8, 5, 10, 4, 219.00, 120.00, 0.00, 876.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(9, 6, 1, 1, 199.00, 120.00, 0.00, 199.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(10, 6, 5, 3, 699.00, 420.00, 0.00, 2097.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(11, 6, 11, 3, 289.00, 160.00, 0.00, 867.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(12, 7, 10, 1, 219.00, 120.00, 0.00, 219.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(13, 7, 12, 1, 649.00, 380.00, 0.00, 649.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(14, 8, 14, 4, 499.00, 290.00, 0.00, 1996.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(15, 9, 4, 2, 549.00, 320.00, 0.00, 1098.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(16, 10, 7, 3, 120.00, 60.00, 0.00, 360.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(17, 11, 3, 3, 399.00, 250.00, 0.00, 1197.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(18, 11, 7, 3, 120.00, 60.00, 0.00, 360.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(19, 11, 14, 1, 499.00, 290.00, 0.00, 499.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(20, 12, 5, 1, 699.00, 420.00, 0.00, 699.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(21, 13, 8, 4, 220.00, 110.00, 0.00, 880.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(22, 13, 18, 4, 369.00, 200.00, 0.00, 1476.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(23, 14, 4, 2, 549.00, 320.00, 0.00, 1098.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(24, 14, 5, 1, 699.00, 420.00, 0.00, 699.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(25, 14, 14, 1, 499.00, 290.00, 0.00, 499.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(26, 15, 4, 4, 549.00, 320.00, 0.00, 2196.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(27, 15, 6, 2, 849.00, 520.00, 0.00, 1698.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(28, 15, 15, 3, 649.00, 390.00, 0.00, 1947.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(29, 16, 11, 4, 289.00, 160.00, 0.00, 1156.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(30, 17, 5, 1, 699.00, 420.00, 0.00, 699.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(31, 17, 10, 2, 219.00, 120.00, 0.00, 438.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(32, 17, 18, 2, 369.00, 200.00, 0.00, 738.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(33, 18, 3, 4, 399.00, 250.00, 0.00, 1596.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(34, 18, 15, 2, 649.00, 390.00, 0.00, 1298.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(35, 19, 5, 2, 699.00, 420.00, 0.00, 1398.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(36, 20, 3, 1, 399.00, 250.00, 0.00, 399.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(37, 21, 4, 3, 549.00, 320.00, 0.00, 1647.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(38, 21, 10, 1, 219.00, 120.00, 0.00, 219.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(39, 21, 13, 4, 649.00, 380.00, 0.00, 2596.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(40, 22, 4, 1, 549.00, 320.00, 0.00, 549.00, '2026-06-25 12:53:24', '2026-06-25 12:53:24'),
(41, 22, 12, 4, 649.00, 380.00, 0.00, 2596.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(42, 23, 7, 2, 120.00, 60.00, 0.00, 240.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(43, 23, 9, 4, 159.00, 85.00, 0.00, 636.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(44, 23, 11, 2, 289.00, 160.00, 0.00, 578.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(45, 24, 4, 3, 549.00, 320.00, 0.00, 1647.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(46, 24, 10, 2, 219.00, 120.00, 0.00, 438.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(47, 24, 17, 3, 399.00, 220.00, 0.00, 1197.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(48, 25, 3, 3, 399.00, 250.00, 0.00, 1197.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(49, 26, 2, 4, 299.00, 180.00, 0.00, 1196.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(50, 26, 11, 2, 289.00, 160.00, 0.00, 578.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(51, 26, 15, 3, 649.00, 390.00, 0.00, 1947.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(52, 27, 1, 4, 199.00, 120.00, 0.00, 796.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(53, 28, 14, 2, 499.00, 290.00, 0.00, 998.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(54, 29, 10, 1, 219.00, 120.00, 0.00, 219.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(55, 30, 3, 2, 399.00, 250.00, 0.00, 798.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(56, 30, 11, 3, 289.00, 160.00, 0.00, 867.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(57, 31, 1, 3, 199.00, 120.00, 0.00, 597.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(58, 31, 6, 3, 849.00, 520.00, 0.00, 2547.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(59, 32, 3, 3, 399.00, 250.00, 0.00, 1197.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(60, 32, 11, 1, 289.00, 160.00, 0.00, 289.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(61, 33, 9, 3, 159.00, 85.00, 0.00, 477.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(62, 34, 4, 4, 549.00, 320.00, 0.00, 2196.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(63, 34, 7, 2, 120.00, 60.00, 0.00, 240.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(64, 34, 10, 1, 219.00, 120.00, 0.00, 219.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(65, 35, 3, 1, 399.00, 250.00, 0.00, 399.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(66, 36, 18, 2, 369.00, 200.00, 0.00, 738.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(67, 37, 1, 4, 199.00, 120.00, 0.00, 796.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(68, 37, 3, 3, 399.00, 250.00, 0.00, 1197.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(69, 37, 18, 2, 369.00, 200.00, 0.00, 738.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(70, 38, 2, 4, 299.00, 180.00, 0.00, 1196.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(71, 38, 14, 1, 499.00, 290.00, 0.00, 499.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(72, 38, 18, 4, 369.00, 200.00, 0.00, 1476.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(73, 39, 17, 4, 399.00, 220.00, 0.00, 1596.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(74, 39, 18, 1, 369.00, 200.00, 0.00, 369.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(75, 40, 4, 4, 549.00, 320.00, 0.00, 2196.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(76, 40, 15, 3, 649.00, 390.00, 0.00, 1947.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(77, 40, 17, 4, 399.00, 220.00, 0.00, 1596.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(78, 41, 2, 3, 299.00, 180.00, 0.00, 897.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(79, 41, 8, 1, 220.00, 110.00, 0.00, 220.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(80, 41, 16, 1, 799.00, 450.00, 0.00, 799.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(81, 42, 2, 3, 299.00, 180.00, 0.00, 897.00, '2026-06-25 12:53:25', '2026-06-25 12:53:25'),
(82, 42, 5, 2, 699.00, 420.00, 0.00, 1398.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(83, 42, 15, 4, 649.00, 390.00, 0.00, 2596.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(84, 43, 11, 4, 289.00, 160.00, 0.00, 1156.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(85, 44, 2, 3, 299.00, 180.00, 0.00, 897.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(86, 44, 5, 4, 699.00, 420.00, 0.00, 2796.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(87, 45, 12, 2, 649.00, 380.00, 0.00, 1298.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(88, 45, 14, 3, 499.00, 290.00, 0.00, 1497.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(89, 46, 12, 2, 649.00, 380.00, 0.00, 1298.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(90, 46, 14, 3, 499.00, 290.00, 0.00, 1497.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(91, 47, 10, 4, 219.00, 120.00, 0.00, 876.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(92, 47, 13, 4, 649.00, 380.00, 0.00, 2596.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(93, 47, 16, 4, 799.00, 450.00, 0.00, 3196.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(94, 48, 4, 3, 549.00, 320.00, 0.00, 1647.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(95, 49, 17, 4, 399.00, 220.00, 0.00, 1596.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(96, 50, 2, 3, 299.00, 180.00, 0.00, 897.00, '2026-06-26 02:23:58', '2026-06-26 02:23:58');

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
(1, 'shop_name', 'Houseware Shop', '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(2, 'currency', '₱', '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(3, 'tax_rate', '12', '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(4, 'address', '123 Market Street, Manila, Philippines', '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(5, 'phone', '+63 900 000 0000', '2026-06-23 07:16:51', '2026-06-23 07:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `stock_ins`
--

CREATE TABLE `stock_ins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `received_date` date NOT NULL,
  `received_by` bigint(20) UNSIGNED DEFAULT NULL,
  `total_cost` decimal(14,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_ins`
--

INSERT INTO `stock_ins` (`id`, `reference_no`, `supplier_id`, `purchase_order_id`, `invoice_number`, `received_date`, `received_by`, `total_cost`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'SI-2606-0001', 1, NULL, 'SUP-INV-64685', '2026-06-11', 4, 539460.00, 'Opening stock — initial warehouse load.', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(2, 'SI-2606-0002', 2, NULL, 'SUP-INV-33705', '2026-06-18', 4, 63780.00, 'Mid-week replenishment.', '2026-06-18 02:30:00', '2026-06-18 02:30:00'),
(3, 'SI-2606-0003', 3, 4, NULL, '2026-06-18', 4, 16830.00, NULL, '2026-06-18 05:00:00', '2026-06-18 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_items`
--

CREATE TABLE `stock_in_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_in_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_cost` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(14,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_in_items`
--

INSERT INTO `stock_in_items` (`id`, `stock_in_id`, `product_variant_id`, `quantity`, `unit_cost`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 89, 120.00, 10680.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(2, 1, 2, 107, 180.00, 19260.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(3, 1, 3, 72, 250.00, 18000.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(4, 1, 4, 126, 320.00, 40320.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(5, 1, 5, 110, 420.00, 46200.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(6, 1, 6, 140, 520.00, 72800.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(7, 1, 7, 118, 60.00, 7080.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(8, 1, 8, 149, 110.00, 16390.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(9, 1, 9, 84, 85.00, 7140.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(10, 1, 10, 86, 120.00, 10320.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(11, 1, 11, 127, 160.00, 20320.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(12, 1, 12, 111, 380.00, 42180.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(13, 1, 13, 107, 380.00, 40660.00, '2026-06-25 12:50:33', '2026-06-25 12:50:33'),
(14, 1, 14, 98, 290.00, 28420.00, '2026-06-25 12:50:34', '2026-06-25 12:50:34'),
(15, 1, 15, 155, 390.00, 60450.00, '2026-06-25 12:50:34', '2026-06-25 12:50:34'),
(16, 1, 16, 94, 450.00, 42300.00, '2026-06-25 12:50:34', '2026-06-25 12:50:34'),
(17, 1, 17, 147, 220.00, 32340.00, '2026-06-25 12:50:34', '2026-06-25 12:50:34'),
(18, 1, 18, 123, 200.00, 24600.00, '2026-06-25 12:50:35', '2026-06-25 12:50:35'),
(19, 2, 1, 45, 120.00, 5400.00, '2026-06-25 12:50:35', '2026-06-25 12:50:35'),
(20, 2, 10, 48, 120.00, 5760.00, '2026-06-25 12:50:35', '2026-06-25 12:50:35'),
(21, 2, 11, 43, 160.00, 6880.00, '2026-06-25 12:50:35', '2026-06-25 12:50:35'),
(22, 2, 13, 43, 380.00, 16340.00, '2026-06-25 12:50:35', '2026-06-25 12:50:35'),
(23, 2, 16, 36, 450.00, 16200.00, '2026-06-25 12:50:35', '2026-06-25 12:50:35'),
(24, 2, 17, 60, 220.00, 13200.00, '2026-06-25 12:50:35', '2026-06-25 12:50:35'),
(25, 3, 7, 58, 60.00, 3480.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(26, 3, 10, 46, 120.00, 5520.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(27, 3, 14, 27, 290.00, 7830.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `direction` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `quantity_before` int(11) NOT NULL,
  `quantity_after` int(11) NOT NULL,
  `unit_cost` decimal(12,2) NOT NULL DEFAULT 0.00,
  `source_type` varchar(255) DEFAULT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `product_variant_id`, `type`, `direction`, `quantity`, `quantity_before`, `quantity_after`, `unit_cost`, `source_type`, `source_id`, `user_id`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'sale', 'out', 1, 40, 39, 120.00, 'App\\Models\\Sale', 1, 3, 'Sale INV-2606-0001', '2026-06-23 08:13:37', '2026-06-23 08:13:37'),
(2, 1, 'sale', 'out', 1, 39, 38, 120.00, 'App\\Models\\Sale', 2, 3, 'Sale INV-2606-0002', '2026-06-23 08:14:27', '2026-06-23 08:14:27'),
(3, 1, 'stock_in', 'in', 89, 38, 127, 120.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(4, 2, 'stock_in', 'in', 107, 30, 137, 180.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(5, 3, 'stock_in', 'in', 72, 25, 97, 250.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(6, 4, 'stock_in', 'in', 126, 15, 141, 320.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(7, 5, 'stock_in', 'in', 110, 12, 122, 420.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(8, 6, 'stock_in', 'in', 140, 8, 148, 520.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(9, 7, 'stock_in', 'in', 118, 50, 168, 60.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(10, 8, 'stock_in', 'in', 149, 6, 155, 110.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(11, 9, 'stock_in', 'in', 84, 40, 124, 85.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(12, 10, 'stock_in', 'in', 86, 0, 86, 120.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(13, 11, 'stock_in', 'in', 127, 18, 145, 160.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(14, 12, 'stock_in', 'in', 111, 20, 131, 380.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(15, 13, 'stock_in', 'in', 107, 9, 116, 380.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(16, 14, 'stock_in', 'in', 98, 14, 112, 290.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(17, 15, 'stock_in', 'in', 155, 7, 162, 390.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(18, 16, 'stock_in', 'in', 94, 11, 105, 450.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(19, 17, 'stock_in', 'in', 147, 0, 147, 220.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(20, 18, 'stock_in', 'in', 123, 13, 136, 200.00, 'App\\Models\\StockIn', 1, 4, 'Stock In SI-2606-0001', '2026-06-11 01:15:00', '2026-06-11 01:15:00'),
(21, 1, 'stock_in', 'in', 45, 127, 172, 120.00, 'App\\Models\\StockIn', 2, 4, 'Stock In SI-2606-0002', '2026-06-18 02:30:00', '2026-06-18 02:30:00'),
(22, 10, 'stock_in', 'in', 48, 86, 134, 120.00, 'App\\Models\\StockIn', 2, 4, 'Stock In SI-2606-0002', '2026-06-18 02:30:00', '2026-06-18 02:30:00'),
(23, 11, 'stock_in', 'in', 43, 145, 188, 160.00, 'App\\Models\\StockIn', 2, 4, 'Stock In SI-2606-0002', '2026-06-18 02:30:00', '2026-06-18 02:30:00'),
(24, 13, 'stock_in', 'in', 43, 116, 159, 380.00, 'App\\Models\\StockIn', 2, 4, 'Stock In SI-2606-0002', '2026-06-18 02:30:00', '2026-06-18 02:30:00'),
(25, 16, 'stock_in', 'in', 36, 105, 141, 450.00, 'App\\Models\\StockIn', 2, 4, 'Stock In SI-2606-0002', '2026-06-18 02:30:00', '2026-06-18 02:30:00'),
(26, 17, 'stock_in', 'in', 60, 147, 207, 220.00, 'App\\Models\\StockIn', 2, 4, 'Stock In SI-2606-0002', '2026-06-18 02:30:00', '2026-06-18 02:30:00'),
(27, 7, 'sale', 'out', 2, 168, 166, 60.00, 'App\\Models\\Sale', 3, 3, 'Sale INV-2606-0003', '2026-06-12 07:13:27', '2026-06-12 07:13:27'),
(28, 9, 'sale', 'out', 2, 124, 122, 85.00, 'App\\Models\\Sale', 3, 3, 'Sale INV-2606-0003', '2026-06-12 07:13:27', '2026-06-12 07:13:27'),
(29, 8, 'sale', 'out', 4, 155, 151, 110.00, 'App\\Models\\Sale', 4, 1, 'Sale INV-2606-0004', '2026-06-12 05:15:08', '2026-06-12 05:15:08'),
(30, 4, 'sale', 'out', 1, 141, 140, 320.00, 'App\\Models\\Sale', 5, 1, 'Sale INV-2606-0005', '2026-06-12 01:54:54', '2026-06-12 01:54:54'),
(31, 9, 'sale', 'out', 3, 122, 119, 85.00, 'App\\Models\\Sale', 5, 1, 'Sale INV-2606-0005', '2026-06-12 01:54:54', '2026-06-12 01:54:54'),
(32, 10, 'sale', 'out', 4, 134, 130, 120.00, 'App\\Models\\Sale', 5, 1, 'Sale INV-2606-0005', '2026-06-12 01:54:54', '2026-06-12 01:54:54'),
(33, 1, 'sale', 'out', 1, 172, 171, 120.00, 'App\\Models\\Sale', 6, 1, 'Sale INV-2606-0006', '2026-06-13 00:25:13', '2026-06-13 00:25:13'),
(34, 5, 'sale', 'out', 3, 122, 119, 420.00, 'App\\Models\\Sale', 6, 1, 'Sale INV-2606-0006', '2026-06-13 00:25:13', '2026-06-13 00:25:13'),
(35, 11, 'sale', 'out', 3, 188, 185, 160.00, 'App\\Models\\Sale', 6, 1, 'Sale INV-2606-0006', '2026-06-13 00:25:13', '2026-06-13 00:25:13'),
(36, 10, 'sale', 'out', 1, 130, 129, 120.00, 'App\\Models\\Sale', 7, 3, 'Sale INV-2606-0007', '2026-06-13 01:53:26', '2026-06-13 01:53:26'),
(37, 12, 'sale', 'out', 1, 131, 130, 380.00, 'App\\Models\\Sale', 7, 3, 'Sale INV-2606-0007', '2026-06-13 01:53:26', '2026-06-13 01:53:26'),
(38, 14, 'sale', 'out', 4, 112, 108, 290.00, 'App\\Models\\Sale', 8, 2, 'Sale INV-2606-0008', '2026-06-14 01:19:13', '2026-06-14 01:19:13'),
(39, 4, 'sale', 'out', 2, 140, 138, 320.00, 'App\\Models\\Sale', 9, 3, 'Sale INV-2606-0009', '2026-06-14 10:35:52', '2026-06-14 10:35:52'),
(40, 7, 'sale', 'out', 3, 166, 163, 60.00, 'App\\Models\\Sale', 10, 1, 'Sale INV-2606-0010', '2026-06-15 03:28:39', '2026-06-15 03:28:39'),
(41, 3, 'sale', 'out', 3, 97, 94, 250.00, 'App\\Models\\Sale', 11, 2, 'Sale INV-2606-0011', '2026-06-15 05:18:43', '2026-06-15 05:18:43'),
(42, 7, 'sale', 'out', 3, 163, 160, 60.00, 'App\\Models\\Sale', 11, 2, 'Sale INV-2606-0011', '2026-06-15 05:18:43', '2026-06-15 05:18:43'),
(43, 14, 'sale', 'out', 1, 108, 107, 290.00, 'App\\Models\\Sale', 11, 2, 'Sale INV-2606-0011', '2026-06-15 05:18:43', '2026-06-15 05:18:43'),
(44, 5, 'sale', 'out', 1, 119, 118, 420.00, 'App\\Models\\Sale', 12, 3, 'Sale INV-2606-0012', '2026-06-15 01:46:14', '2026-06-15 01:46:14'),
(45, 8, 'sale', 'out', 4, 151, 147, 110.00, 'App\\Models\\Sale', 13, 3, 'Sale INV-2606-0013', '2026-06-16 06:31:11', '2026-06-16 06:31:11'),
(46, 18, 'sale', 'out', 4, 136, 132, 200.00, 'App\\Models\\Sale', 13, 3, 'Sale INV-2606-0013', '2026-06-16 06:31:11', '2026-06-16 06:31:11'),
(47, 4, 'sale', 'out', 2, 138, 136, 320.00, 'App\\Models\\Sale', 14, 1, 'Sale INV-2606-0014', '2026-06-16 02:20:35', '2026-06-16 02:20:35'),
(48, 5, 'sale', 'out', 1, 118, 117, 420.00, 'App\\Models\\Sale', 14, 1, 'Sale INV-2606-0014', '2026-06-16 02:20:35', '2026-06-16 02:20:35'),
(49, 14, 'sale', 'out', 1, 107, 106, 290.00, 'App\\Models\\Sale', 14, 1, 'Sale INV-2606-0014', '2026-06-16 02:20:35', '2026-06-16 02:20:35'),
(50, 4, 'sale', 'out', 4, 136, 132, 320.00, 'App\\Models\\Sale', 15, 1, 'Sale INV-2606-0015', '2026-06-17 00:20:39', '2026-06-17 00:20:39'),
(51, 6, 'sale', 'out', 2, 148, 146, 520.00, 'App\\Models\\Sale', 15, 1, 'Sale INV-2606-0015', '2026-06-17 00:20:39', '2026-06-17 00:20:39'),
(52, 15, 'sale', 'out', 3, 162, 159, 390.00, 'App\\Models\\Sale', 15, 1, 'Sale INV-2606-0015', '2026-06-17 00:20:39', '2026-06-17 00:20:39'),
(53, 11, 'sale', 'out', 4, 185, 181, 160.00, 'App\\Models\\Sale', 16, 1, 'Sale INV-2606-0016', '2026-06-17 04:26:29', '2026-06-17 04:26:29'),
(54, 5, 'sale', 'out', 1, 117, 116, 420.00, 'App\\Models\\Sale', 17, 3, 'Sale INV-2606-0017', '2026-06-17 09:55:18', '2026-06-17 09:55:18'),
(55, 10, 'sale', 'out', 2, 129, 127, 120.00, 'App\\Models\\Sale', 17, 3, 'Sale INV-2606-0017', '2026-06-17 09:55:18', '2026-06-17 09:55:18'),
(56, 18, 'sale', 'out', 2, 132, 130, 200.00, 'App\\Models\\Sale', 17, 3, 'Sale INV-2606-0017', '2026-06-17 09:55:18', '2026-06-17 09:55:18'),
(57, 3, 'sale', 'out', 4, 94, 90, 250.00, 'App\\Models\\Sale', 18, 2, 'Sale INV-2606-0018', '2026-06-17 05:16:48', '2026-06-17 05:16:48'),
(58, 15, 'sale', 'out', 2, 159, 157, 390.00, 'App\\Models\\Sale', 18, 2, 'Sale INV-2606-0018', '2026-06-17 05:16:48', '2026-06-17 05:16:48'),
(59, 5, 'sale', 'out', 2, 116, 114, 420.00, 'App\\Models\\Sale', 19, 1, 'Sale INV-2606-0019', '2026-06-18 05:07:51', '2026-06-18 05:07:51'),
(60, 3, 'sale', 'out', 1, 90, 89, 250.00, 'App\\Models\\Sale', 20, 3, 'Sale INV-2606-0020', '2026-06-18 08:35:06', '2026-06-18 08:35:06'),
(61, 4, 'sale', 'out', 3, 132, 129, 320.00, 'App\\Models\\Sale', 21, 1, 'Sale INV-2606-0021', '2026-06-18 06:44:35', '2026-06-18 06:44:35'),
(62, 10, 'sale', 'out', 1, 127, 126, 120.00, 'App\\Models\\Sale', 21, 1, 'Sale INV-2606-0021', '2026-06-18 06:44:35', '2026-06-18 06:44:35'),
(63, 13, 'sale', 'out', 4, 159, 155, 380.00, 'App\\Models\\Sale', 21, 1, 'Sale INV-2606-0021', '2026-06-18 06:44:35', '2026-06-18 06:44:35'),
(64, 4, 'sale', 'out', 1, 129, 128, 320.00, 'App\\Models\\Sale', 22, 1, 'Sale INV-2606-0022', '2026-06-18 06:56:50', '2026-06-18 06:56:50'),
(65, 12, 'sale', 'out', 4, 130, 126, 380.00, 'App\\Models\\Sale', 22, 1, 'Sale INV-2606-0022', '2026-06-18 06:56:50', '2026-06-18 06:56:50'),
(66, 7, 'sale', 'out', 2, 160, 158, 60.00, 'App\\Models\\Sale', 23, 2, 'Sale INV-2606-0023', '2026-06-19 04:13:37', '2026-06-19 04:13:37'),
(67, 9, 'sale', 'out', 4, 119, 115, 85.00, 'App\\Models\\Sale', 23, 2, 'Sale INV-2606-0023', '2026-06-19 04:13:37', '2026-06-19 04:13:37'),
(68, 11, 'sale', 'out', 2, 181, 179, 160.00, 'App\\Models\\Sale', 23, 2, 'Sale INV-2606-0023', '2026-06-19 04:13:37', '2026-06-19 04:13:37'),
(69, 4, 'sale', 'out', 3, 128, 125, 320.00, 'App\\Models\\Sale', 24, 2, 'Sale INV-2606-0024', '2026-06-19 04:20:13', '2026-06-19 04:20:13'),
(70, 10, 'sale', 'out', 2, 126, 124, 120.00, 'App\\Models\\Sale', 24, 2, 'Sale INV-2606-0024', '2026-06-19 04:20:13', '2026-06-19 04:20:13'),
(71, 17, 'sale', 'out', 3, 207, 204, 220.00, 'App\\Models\\Sale', 24, 2, 'Sale INV-2606-0024', '2026-06-19 04:20:13', '2026-06-19 04:20:13'),
(72, 3, 'sale', 'out', 3, 89, 86, 250.00, 'App\\Models\\Sale', 25, 2, 'Sale INV-2606-0025', '2026-06-19 02:44:07', '2026-06-19 02:44:07'),
(73, 2, 'sale', 'out', 4, 137, 133, 180.00, 'App\\Models\\Sale', 26, 3, 'Sale INV-2606-0026', '2026-06-19 04:58:26', '2026-06-19 04:58:26'),
(74, 11, 'sale', 'out', 2, 179, 177, 160.00, 'App\\Models\\Sale', 26, 3, 'Sale INV-2606-0026', '2026-06-19 04:58:26', '2026-06-19 04:58:26'),
(75, 15, 'sale', 'out', 3, 157, 154, 390.00, 'App\\Models\\Sale', 26, 3, 'Sale INV-2606-0026', '2026-06-19 04:58:26', '2026-06-19 04:58:26'),
(76, 1, 'sale', 'out', 4, 171, 167, 120.00, 'App\\Models\\Sale', 27, 3, 'Sale INV-2606-0027', '2026-06-20 01:11:32', '2026-06-20 01:11:32'),
(77, 14, 'sale', 'out', 2, 106, 104, 290.00, 'App\\Models\\Sale', 28, 1, 'Sale INV-2606-0028', '2026-06-20 09:15:13', '2026-06-20 09:15:13'),
(78, 10, 'sale', 'out', 1, 124, 123, 120.00, 'App\\Models\\Sale', 29, 2, 'Sale INV-2606-0029', '2026-06-20 05:12:31', '2026-06-20 05:12:31'),
(79, 3, 'sale', 'out', 2, 86, 84, 250.00, 'App\\Models\\Sale', 30, 3, 'Sale INV-2606-0030', '2026-06-20 08:29:57', '2026-06-20 08:29:57'),
(80, 11, 'sale', 'out', 3, 177, 174, 160.00, 'App\\Models\\Sale', 30, 3, 'Sale INV-2606-0030', '2026-06-20 08:29:57', '2026-06-20 08:29:57'),
(81, 1, 'sale', 'out', 3, 167, 164, 120.00, 'App\\Models\\Sale', 31, 2, 'Sale INV-2606-0031', '2026-06-21 00:55:32', '2026-06-21 00:55:32'),
(82, 6, 'sale', 'out', 3, 146, 143, 520.00, 'App\\Models\\Sale', 31, 2, 'Sale INV-2606-0031', '2026-06-21 00:55:32', '2026-06-21 00:55:32'),
(83, 3, 'sale', 'out', 3, 84, 81, 250.00, 'App\\Models\\Sale', 32, 1, 'Sale INV-2606-0032', '2026-06-21 08:27:48', '2026-06-21 08:27:48'),
(84, 11, 'sale', 'out', 1, 174, 173, 160.00, 'App\\Models\\Sale', 32, 1, 'Sale INV-2606-0032', '2026-06-21 08:27:48', '2026-06-21 08:27:48'),
(85, 9, 'sale', 'out', 3, 115, 112, 85.00, 'App\\Models\\Sale', 33, 3, 'Sale INV-2606-0033', '2026-06-22 03:45:27', '2026-06-22 03:45:27'),
(86, 4, 'sale', 'out', 4, 125, 121, 320.00, 'App\\Models\\Sale', 34, 3, 'Sale INV-2606-0034', '2026-06-22 05:04:11', '2026-06-22 05:04:11'),
(87, 7, 'sale', 'out', 2, 158, 156, 60.00, 'App\\Models\\Sale', 34, 3, 'Sale INV-2606-0034', '2026-06-22 05:04:11', '2026-06-22 05:04:11'),
(88, 10, 'sale', 'out', 1, 123, 122, 120.00, 'App\\Models\\Sale', 34, 3, 'Sale INV-2606-0034', '2026-06-22 05:04:11', '2026-06-22 05:04:11'),
(89, 3, 'sale', 'out', 1, 81, 80, 250.00, 'App\\Models\\Sale', 35, 1, 'Sale INV-2606-0035', '2026-06-22 01:33:44', '2026-06-22 01:33:44'),
(90, 18, 'sale', 'out', 2, 130, 128, 200.00, 'App\\Models\\Sale', 36, 2, 'Sale INV-2606-0036', '2026-06-23 03:41:52', '2026-06-23 03:41:52'),
(91, 1, 'sale', 'out', 4, 164, 160, 120.00, 'App\\Models\\Sale', 37, 1, 'Sale INV-2606-0037', '2026-06-23 10:03:18', '2026-06-23 10:03:18'),
(92, 3, 'sale', 'out', 3, 80, 77, 250.00, 'App\\Models\\Sale', 37, 1, 'Sale INV-2606-0037', '2026-06-23 10:03:18', '2026-06-23 10:03:18'),
(93, 18, 'sale', 'out', 2, 128, 126, 200.00, 'App\\Models\\Sale', 37, 1, 'Sale INV-2606-0037', '2026-06-23 10:03:18', '2026-06-23 10:03:18'),
(94, 2, 'sale', 'out', 4, 133, 129, 180.00, 'App\\Models\\Sale', 38, 3, 'Sale INV-2606-0038', '2026-06-23 06:39:01', '2026-06-23 06:39:01'),
(95, 14, 'sale', 'out', 1, 104, 103, 290.00, 'App\\Models\\Sale', 38, 3, 'Sale INV-2606-0038', '2026-06-23 06:39:01', '2026-06-23 06:39:01'),
(96, 18, 'sale', 'out', 4, 126, 122, 200.00, 'App\\Models\\Sale', 38, 3, 'Sale INV-2606-0038', '2026-06-23 06:39:01', '2026-06-23 06:39:01'),
(97, 17, 'sale', 'out', 4, 204, 200, 220.00, 'App\\Models\\Sale', 39, 3, 'Sale INV-2606-0039', '2026-06-23 04:02:57', '2026-06-23 04:02:57'),
(98, 18, 'sale', 'out', 1, 122, 121, 200.00, 'App\\Models\\Sale', 39, 3, 'Sale INV-2606-0039', '2026-06-23 04:02:57', '2026-06-23 04:02:57'),
(99, 4, 'sale', 'out', 4, 121, 117, 320.00, 'App\\Models\\Sale', 40, 2, 'Sale INV-2606-0040', '2026-06-23 00:46:40', '2026-06-23 00:46:40'),
(100, 15, 'sale', 'out', 3, 154, 151, 390.00, 'App\\Models\\Sale', 40, 2, 'Sale INV-2606-0040', '2026-06-23 00:46:40', '2026-06-23 00:46:40'),
(101, 17, 'sale', 'out', 4, 200, 196, 220.00, 'App\\Models\\Sale', 40, 2, 'Sale INV-2606-0040', '2026-06-23 00:46:40', '2026-06-23 00:46:40'),
(102, 2, 'sale', 'out', 3, 129, 126, 180.00, 'App\\Models\\Sale', 41, 2, 'Sale INV-2606-0041', '2026-06-24 11:37:00', '2026-06-24 11:37:00'),
(103, 8, 'sale', 'out', 1, 147, 146, 110.00, 'App\\Models\\Sale', 41, 2, 'Sale INV-2606-0041', '2026-06-24 11:37:00', '2026-06-24 11:37:00'),
(104, 16, 'sale', 'out', 1, 141, 140, 450.00, 'App\\Models\\Sale', 41, 2, 'Sale INV-2606-0041', '2026-06-24 11:37:00', '2026-06-24 11:37:00'),
(105, 2, 'sale', 'out', 3, 126, 123, 180.00, 'App\\Models\\Sale', 42, 3, 'Sale INV-2606-0042', '2026-06-24 07:04:04', '2026-06-24 07:04:04'),
(106, 5, 'sale', 'out', 2, 114, 112, 420.00, 'App\\Models\\Sale', 42, 3, 'Sale INV-2606-0042', '2026-06-24 07:04:04', '2026-06-24 07:04:04'),
(107, 15, 'sale', 'out', 4, 151, 147, 390.00, 'App\\Models\\Sale', 42, 3, 'Sale INV-2606-0042', '2026-06-24 07:04:04', '2026-06-24 07:04:04'),
(108, 11, 'sale', 'out', 4, 173, 169, 160.00, 'App\\Models\\Sale', 43, 3, 'Sale INV-2606-0043', '2026-06-25 07:40:47', '2026-06-25 07:40:47'),
(109, 2, 'sale', 'out', 3, 123, 120, 180.00, 'App\\Models\\Sale', 44, 1, 'Sale INV-2606-0044', '2026-06-25 03:52:41', '2026-06-25 03:52:41'),
(110, 5, 'sale', 'out', 4, 112, 108, 420.00, 'App\\Models\\Sale', 44, 1, 'Sale INV-2606-0044', '2026-06-25 03:52:41', '2026-06-25 03:52:41'),
(111, 12, 'sale', 'out', 2, 126, 124, 380.00, 'App\\Models\\Sale', 45, 1, 'Sale INV-2606-0045', '2026-06-25 11:38:41', '2026-06-25 11:38:41'),
(112, 14, 'sale', 'out', 3, 103, 100, 290.00, 'App\\Models\\Sale', 45, 1, 'Sale INV-2606-0045', '2026-06-25 11:38:41', '2026-06-25 11:38:41'),
(113, 12, 'sale', 'out', 2, 124, 122, 380.00, 'App\\Models\\Sale', 46, 3, 'Sale INV-2606-0046', '2026-06-25 07:02:53', '2026-06-25 07:02:53'),
(114, 14, 'sale', 'out', 3, 100, 97, 290.00, 'App\\Models\\Sale', 46, 3, 'Sale INV-2606-0046', '2026-06-25 07:02:53', '2026-06-25 07:02:53'),
(115, 10, 'sale', 'out', 4, 122, 118, 120.00, 'App\\Models\\Sale', 47, 2, 'Sale INV-2606-0047', '2026-06-25 09:43:08', '2026-06-25 09:43:08'),
(116, 13, 'sale', 'out', 4, 155, 151, 380.00, 'App\\Models\\Sale', 47, 2, 'Sale INV-2606-0047', '2026-06-25 09:43:08', '2026-06-25 09:43:08'),
(117, 16, 'sale', 'out', 4, 140, 136, 450.00, 'App\\Models\\Sale', 47, 2, 'Sale INV-2606-0047', '2026-06-25 09:43:08', '2026-06-25 09:43:08'),
(118, 4, 'sale', 'out', 3, 117, 114, 320.00, 'App\\Models\\Sale', 48, 3, 'Sale INV-2606-0048', '2026-06-25 07:46:36', '2026-06-25 07:46:36'),
(119, 17, 'sale', 'out', 4, 196, 192, 220.00, 'App\\Models\\Sale', 49, 2, 'Sale INV-2606-0049', '2026-06-25 09:54:57', '2026-06-25 09:54:57'),
(120, 4, 'stock_out', 'out', 1, 114, 113, 320.00, 'App\\Models\\StockOut', 1, 4, 'Damaged Items — SO-2606-0001', '2026-06-20 06:31:00', '2026-06-20 06:31:00'),
(121, 5, 'stock_out', 'out', 2, 108, 106, 420.00, 'App\\Models\\StockOut', 1, 4, 'Damaged Items — SO-2606-0001', '2026-06-20 06:31:00', '2026-06-20 06:31:00'),
(122, 15, 'stock_out', 'out', 2, 147, 145, 390.00, 'App\\Models\\StockOut', 2, 4, 'Internal Usage — SO-2606-0002', '2026-06-23 06:35:00', '2026-06-23 06:35:00'),
(123, 16, 'stock_out', 'out', 1, 136, 135, 450.00, 'App\\Models\\StockOut', 2, 4, 'Internal Usage — SO-2606-0002', '2026-06-23 06:35:00', '2026-06-23 06:35:00'),
(124, 1, 'adjustment', 'out', 160, 160, 0, 120.00, 'App\\Models\\Adjustment', 1, 2, 'Adjustment (correct): Monthly physical inventory count', '2026-06-22 08:20:00', '2026-06-22 08:20:00'),
(125, 2, 'adjustment', 'out', 117, 120, 3, 180.00, 'App\\Models\\Adjustment', 1, 2, 'Adjustment (correct): Monthly physical inventory count', '2026-06-22 08:20:00', '2026-06-22 08:20:00'),
(126, 7, 'adjustment', 'out', 151, 156, 5, 60.00, 'App\\Models\\Adjustment', 1, 2, 'Adjustment (correct): Monthly physical inventory count', '2026-06-22 08:20:00', '2026-06-22 08:20:00'),
(127, 14, 'adjustment', 'out', 89, 97, 8, 290.00, 'App\\Models\\Adjustment', 1, 2, 'Adjustment (correct): Monthly physical inventory count', '2026-06-22 08:20:00', '2026-06-22 08:20:00'),
(128, 17, 'adjustment', 'out', 186, 192, 6, 220.00, 'App\\Models\\Adjustment', 1, 2, 'Adjustment (correct): Monthly physical inventory count', '2026-06-22 08:20:00', '2026-06-22 08:20:00'),
(129, 7, 'stock_in', 'in', 58, 5, 63, 60.00, 'App\\Models\\StockIn', 3, 4, 'Received against PO PO-2606-0004', '2026-06-18 05:00:00', '2026-06-18 05:00:00'),
(130, 10, 'stock_in', 'in', 46, 118, 164, 120.00, 'App\\Models\\StockIn', 3, 4, 'Received against PO PO-2606-0004', '2026-06-18 05:00:00', '2026-06-18 05:00:00'),
(131, 14, 'stock_in', 'in', 27, 8, 35, 290.00, 'App\\Models\\StockIn', 3, 4, 'Received against PO PO-2606-0004', '2026-06-18 05:00:00', '2026-06-18 05:00:00'),
(132, 2, 'sale', 'out', 3, 3, 0, 180.00, 'App\\Models\\Sale', 50, 1, 'Sale INV-2606-0050', '2026-06-26 02:23:58', '2026-06-26 02:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `stock_outs`
--

CREATE TABLE `stock_outs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `handled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_outs`
--

INSERT INTO `stock_outs` (`id`, `reference_no`, `reason`, `date`, `handled_by`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'SO-2606-0001', 'damaged', '2026-06-20', 4, 'Items damaged in storage', '2026-06-20 06:31:00', '2026-06-20 06:31:00'),
(2, 'SO-2606-0002', 'internal_usage', '2026-06-23', 4, 'Used for store display', '2026-06-23 06:35:00', '2026-06-23 06:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_items`
--

CREATE TABLE `stock_out_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_out_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_cost` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_out_items`
--

INSERT INTO `stock_out_items` (`id`, `stock_out_id`, `product_variant_id`, `quantity`, `unit_cost`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 320.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(2, 1, 5, 2, 420.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(3, 2, 15, 2, 390.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26'),
(4, 2, 16, 1, 450.00, '2026-06-25 12:53:26', '2026-06-25 12:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `notes`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Metro Wholesale Trading', 'Juan Dela Cruz', '+63 917 111 2222', 'sales@metrowholesale.test', 'Metro Manila', NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(2, 'Luzon Houseware Distributors', 'Maria Santos', '+63 918 333 4444', 'orders@luzonhouseware.test', 'Metro Manila', NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL),
(3, 'Pacific Plastics Inc.', 'Pedro Reyes', '+63 919 555 6666', 'info@pacificplastics.test', 'Metro Manila', NULL, 'active', '2026-06-23 07:16:51', '2026-06-23 07:16:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `abbreviation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'Piece', 'pc', '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(2, 'Box', 'box', '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(3, 'Set', 'set', '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(4, 'Pack', 'pack', '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(5, 'Dozen', 'dz', '2026-06-23 07:16:51', '2026-06-23 07:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `avatar`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Owner', 'owner@houseware.test', NULL, NULL, 'active', NULL, '$2y$12$6wSz1SZeGg1.l5RlfWxQC.sBET4u04pRcMsltdEsDJn9fx9JARiYe', NULL, '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(2, 'Manager', 'manager@houseware.test', NULL, NULL, 'active', NULL, '$2y$12$GXdQXvsr6pKcT67.ePn5ke6zfqdVwWJUeZ6K8x5kyusTmoN/heC8m', NULL, '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(3, 'Cashier', 'cashier@houseware.test', NULL, NULL, 'active', NULL, '$2y$12$RaLlHfIYDhg52VA3vZHMz.oPkmr0pWw8aLz8A7N3jEOrGw/rTXQmW', NULL, '2026-06-23 07:16:51', '2026-06-23 07:16:51'),
(4, 'Inventory Staff', 'inventory@houseware.test', NULL, NULL, 'active', NULL, '$2y$12$vM4LfIhvCjXk1fpTJeC4IOydTS9A6dXhhZ9fjcT1GAYdxOXl5Q0ci', NULL, '2026-06-23 07:16:51', '2026-06-23 07:16:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`),
  ADD KEY `activity_logs_subject_type_subject_id_index` (`subject_type`,`subject_id`);

--
-- Indexes for table `adjustments`
--
ALTER TABLE `adjustments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `adjustments_reference_no_unique` (`reference_no`),
  ADD KEY `adjustments_user_id_foreign` (`user_id`);

--
-- Indexes for table `adjustment_items`
--
ALTER TABLE `adjustment_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adjustment_items_adjustment_id_foreign` (`adjustment_id`),
  ADD KEY `adjustment_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `app_notifications`
--
ALTER TABLE `app_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`),
  ADD KEY `products_barcode_index` (`barcode`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variants_sku_unique` (`sku`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`),
  ADD KEY `product_variants_barcode_index` (`barcode`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_orders_po_number_unique` (`po_number`),
  ADD KEY `purchase_orders_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchase_orders_created_by_foreign` (`created_by`),
  ADD KEY `purchase_orders_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_items_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `purchase_order_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_invoice_number_unique` (`invoice_number`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_cashier_id_foreign` (`cashier_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_items_product_variant_id_foreign` (`product_variant_id`);

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
-- Indexes for table `stock_ins`
--
ALTER TABLE `stock_ins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_ins_reference_no_unique` (`reference_no`),
  ADD KEY `stock_ins_supplier_id_foreign` (`supplier_id`),
  ADD KEY `stock_ins_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `stock_ins_received_by_foreign` (`received_by`);

--
-- Indexes for table `stock_in_items`
--
ALTER TABLE `stock_in_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_in_items_stock_in_id_foreign` (`stock_in_id`),
  ADD KEY `stock_in_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_product_variant_id_foreign` (`product_variant_id`),
  ADD KEY `stock_movements_source_type_source_id_index` (`source_type`,`source_id`),
  ADD KEY `stock_movements_user_id_foreign` (`user_id`);

--
-- Indexes for table `stock_outs`
--
ALTER TABLE `stock_outs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_outs_reference_no_unique` (`reference_no`),
  ADD KEY `stock_outs_handled_by_foreign` (`handled_by`);

--
-- Indexes for table `stock_out_items`
--
ALTER TABLE `stock_out_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_out_items_stock_out_id_foreign` (`stock_out_id`),
  ADD KEY `stock_out_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `adjustments`
--
ALTER TABLE `adjustments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adjustment_items`
--
ALTER TABLE `adjustment_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_notifications`
--
ALTER TABLE `app_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_ins`
--
ALTER TABLE `stock_ins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_in_items`
--
ALTER TABLE `stock_in_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `stock_outs`
--
ALTER TABLE `stock_outs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_out_items`
--
ALTER TABLE `stock_out_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `adjustments`
--
ALTER TABLE `adjustments`
  ADD CONSTRAINT `adjustments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `adjustment_items`
--
ALTER TABLE `adjustment_items`
  ADD CONSTRAINT `adjustment_items_adjustment_id_foreign` FOREIGN KEY (`adjustment_id`) REFERENCES `adjustments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adjustment_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchase_orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchase_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD CONSTRAINT `purchase_order_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_cashier_id_foreign` FOREIGN KEY (`cashier_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_ins`
--
ALTER TABLE `stock_ins`
  ADD CONSTRAINT `stock_ins_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `stock_ins_received_by_foreign` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `stock_ins_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stock_in_items`
--
ALTER TABLE `stock_in_items`
  ADD CONSTRAINT `stock_in_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_in_items_stock_in_id_foreign` FOREIGN KEY (`stock_in_id`) REFERENCES `stock_ins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stock_outs`
--
ALTER TABLE `stock_outs`
  ADD CONSTRAINT `stock_outs_handled_by_foreign` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stock_out_items`
--
ALTER TABLE `stock_out_items`
  ADD CONSTRAINT `stock_out_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_out_items_stock_out_id_foreign` FOREIGN KEY (`stock_out_id`) REFERENCES `stock_outs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
