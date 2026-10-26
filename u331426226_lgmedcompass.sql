-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 15, 2026 at 03:31 AM
-- Server version: 11.8.9-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u331426226_lgmedcompass`
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('lgmed-compass-cache-0a57cb53ba59c46fc4b692527a38a87c78d84028', 'i:1;', 1792028309),
('lgmed-compass-cache-0a57cb53ba59c46fc4b692527a38a87c78d84028:timer', 'i:1792028309;', 1792028309),
('lgmed-compass-cache-12c6fc06c99a462375eeb3f43dfd832b08ca9e17', 'i:1;', 1779237386),
('lgmed-compass-cache-12c6fc06c99a462375eeb3f43dfd832b08ca9e17:timer', 'i:1779237386;', 1779237386),
('lgmed-compass-cache-228f2a61e114b2f19d240816855b3c81d24c2c45', 'i:1;', 1780889334),
('lgmed-compass-cache-228f2a61e114b2f19d240816855b3c81d24c2c45:timer', 'i:1780889334;', 1780889334),
('lgmed-compass-cache-26d4d5704107fe2cd494a6cfb811a98a9f52dca5', 'i:1;', 1780889726),
('lgmed-compass-cache-26d4d5704107fe2cd494a6cfb811a98a9f52dca5:timer', 'i:1780889726;', 1780889726),
('lgmed-compass-cache-4d134bc072212ace2df385dae143139da74ec0ef', 'i:2;', 1780889278),
('lgmed-compass-cache-4d134bc072212ace2df385dae143139da74ec0ef:timer', 'i:1780889278;', 1780889278),
('lgmed-compass-cache-658d774b73c86e748e0c195f6788c3ed73c995dc', 'i:1;', 1792028334),
('lgmed-compass-cache-658d774b73c86e748e0c195f6788c3ed73c995dc:timer', 'i:1792028334;', 1792028334),
('lgmed-compass-cache-6a389909cca23cc999790d6d4ffbe5523a946e49', 'i:1;', 1778572558),
('lgmed-compass-cache-6a389909cca23cc999790d6d4ffbe5523a946e49:timer', 'i:1778572558;', 1778572558),
('lgmed-compass-cache-6bf02a8d8de2ad280b0604576159c11bb4bc0b40', 'i:1;', 1780490739),
('lgmed-compass-cache-6bf02a8d8de2ad280b0604576159c11bb4bc0b40:timer', 'i:1780490739;', 1780490739),
('lgmed-compass-cache-91032ad7bbcb6cf72875e8e8207dcfba80173f7c', 'i:1;', 1778571772),
('lgmed-compass-cache-91032ad7bbcb6cf72875e8e8207dcfba80173f7c:timer', 'i:1778571772;', 1778571772),
('lgmed-compass-cache-9e6a55b6b4563e652a23be9d623ca5055c356940', 'i:2;', 1778569877),
('lgmed-compass-cache-9e6a55b6b4563e652a23be9d623ca5055c356940:timer', 'i:1778569877;', 1778569877),
('lgmed-compass-cache-a8eaac0a943cfe2045f3d2f4e655a2c6ef92e927', 'i:1;', 1788912890),
('lgmed-compass-cache-a8eaac0a943cfe2045f3d2f4e655a2c6ef92e927:timer', 'i:1788912890;', 1788912890),
('lgmed-compass-cache-admin|152.32.126.51', 'i:5;', 1782384060),
('lgmed-compass-cache-admin|152.32.126.51:timer', 'i:1782384060;', 1782384060),
('lgmed-compass-cache-b3f0c7f6bb763af1be91d9e74eabfeb199dc1f1f', 'i:1;', 1778570169),
('lgmed-compass-cache-b3f0c7f6bb763af1be91d9e74eabfeb199dc1f1f:timer', 'i:1778570169;', 1778570169),
('lgmed-compass-cache-bableadnol|152.32.126.51', 'i:1;', 1779270459),
('lgmed-compass-cache-bableadnol|152.32.126.51:timer', 'i:1779270459;', 1779270459),
('lgmed-compass-cache-bableso620@gmail.com|152.32.126.51', 'i:1;', 1779270411),
('lgmed-compass-cache-bableso620@gmail.com|152.32.126.51:timer', 'i:1779270411;', 1779270411),
('lgmed-compass-cache-db192003@gmail.com|136.158.119.242', 'i:1;', 1789182211),
('lgmed-compass-cache-db192003@gmail.com|136.158.119.242:timer', 'i:1789182211;', 1789182211),
('lgmed-compass-cache-hddguyam|144.48.30.203', 'i:1;', 1778570220),
('lgmed-compass-cache-hddguyam|144.48.30.203:timer', 'i:1778570220;', 1778570220),
('lgmed-compass-cache-ianpacis|144.48.30.203', 'i:3;', 1778566031),
('lgmed-compass-cache-ianpacis|144.48.30.203:timer', 'i:1778566031;', 1778566031),
('lgmed-compass-cache-jedensanity@gmail.com|144.48.30.203', 'i:1;', 1786426153),
('lgmed-compass-cache-jedensanity@gmail.com|144.48.30.203:timer', 'i:1786426153;', 1786426153),
('lgmed-compass-cache-lgmedaccount|120.28.179.161', 'i:1;', 1780634501),
('lgmed-compass-cache-lgmedaccount|120.28.179.161:timer', 'i:1780634501;', 1780634501),
('lgmed-compass-cache-lgmedaccount|120.29.90.239', 'i:1;', 1788533100),
('lgmed-compass-cache-lgmedaccount|120.29.90.239:timer', 'i:1788533100;', 1788533100),
('lgmed-compass-cache-lgmedaccount|120.29.90.47', 'i:1;', 1780636013),
('lgmed-compass-cache-lgmedaccount|120.29.90.47:timer', 'i:1780636013;', 1780636013),
('lgmed-compass-cache-lgmedaccount|120.29.91.175', 'i:2;', 1782384355),
('lgmed-compass-cache-lgmedaccount|120.29.91.175:timer', 'i:1782384355;', 1782384355),
('lgmed-compass-cache-lgmedaccount|175.176.13.83', 'i:1;', 1779962038),
('lgmed-compass-cache-lgmedaccount|175.176.13.83:timer', 'i:1779962038;', 1779962038),
('lgmed-compass-cache-lgmedcompass@gmail.com|120.29.91.175', 'i:1;', 1782384512),
('lgmed-compass-cache-lgmedcompass@gmail.com|120.29.91.175:timer', 'i:1782384512;', 1782384512),
('lgmed-compass-cache-lgmedcompass@gmail.com|144.48.30.203', 'i:2;', 1782383799),
('lgmed-compass-cache-lgmedcompass@gmail.com|144.48.30.203:timer', 'i:1782383799;', 1782383799),
('lgmed-compass-cache-lgmedcompass@gmail.com|175.176.13.83', 'i:2;', 1779962208),
('lgmed-compass-cache-lgmedcompass@gmail.com|175.176.13.83:timer', 'i:1779962208;', 1779962208),
('lgmed-compass-cache-princejedenpascua0412@gmail.com|144.48.30.203', 'i:1;', 1784168545),
('lgmed-compass-cache-princejedenpascua0412@gmail.com|144.48.30.203:timer', 'i:1784168545;', 1784168545),
('lgmed-compass-cache-ysamendoza|152.32.126.51', 'i:1;', 1778745933),
('lgmed-compass-cache-ysamendoza|152.32.126.51:timer', 'i:1778745933;', 1778745933);

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
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'LGPCRDM', 'Local Government Relations & Policy Compliance Section', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(2, 'LGPMRAS', 'Local Government Performance Management, Recognition, and Awards Section', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(3, 'LGPOPS', 'Local Government Peace and Order and Public Safety Compliance and Monitoring', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(4, 'SSU', 'Support Services Unit', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(5, 'DSU', 'Database & Statistical Unit', '2026-05-04 13:13:47', '2026-05-04 13:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_title` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `recipient_name` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) NOT NULL,
  `focal_person` varchar(255) NOT NULL,
  `requesting_office` varchar(255) NOT NULL DEFAULT 'N/A',
  `reference` varchar(255) DEFAULT NULL,
  `mode_of_submission` varchar(255) DEFAULT NULL,
  `cy_link` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `deadlines` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`deadlines`)),
  `progress` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'To Do',
  `file_path` varchar(255) DEFAULT NULL,
  `document_link` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `assigned_to_id` bigint(20) UNSIGNED DEFAULT NULL,
  `workflow_status` varchar(255) NOT NULL DEFAULT 'Draft',
  `last_comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `subject_title`, `from`, `section`, `recipient_name`, `frequency`, `focal_person`, `requesting_office`, `reference`, `mode_of_submission`, `cy_link`, `remarks`, `deadlines`, `progress`, `status`, `file_path`, `document_link`, `created_at`, `updated_at`, `deleted_at`, `assigned_to_id`, `workflow_status`, `last_comment`) VALUES
(33, 1, '2026 POGO', 'RO-CO', '5', 'BLGS', 'monthly', 'LALA GERON', 'N/A', NULL, NULL, NULL, NULL, '[\"2026-07-16\",\"2026-08-17\",\"2026-09-15\",\"2026-10-15\",\"2026-11-16\",\"2026-12-15\"]', 43, 'In Progress', NULL, 'https://drive.google.com/drive/folders/1VuPmsBPgp_xo71ByVWotcSmPBxa7Jv9p', '2026-05-11 16:02:09', '2026-09-15 13:44:59', NULL, NULL, 'Draft', NULL),
(45, 18, 'RCSP MONITORING - CENTRAL OFFICE', 'RO-CO', '5', 'NBOO', 'monthly', 'Joanabeth Tamondong', 'N/A', NULL, NULL, NULL, NULL, '[\"2026-06-03\",\"2026-07-03\",\"2026-08-03\",\"2026-09-03\",\"2026-10-05\",\"2026-11-03\",\"2026-12-03\",\"2027-01-04\",\"2027-02-03\",\"2027-03-03\",\"2027-04-05\",\"2027-05-03\"]', 8, 'In Progress', NULL, 'https://docs.google.com/spreadsheets/d/1r2VOFdLmDKG0rbDqQoxBExzfjMATUPuKZ5ZNRy1fo_c/edit?fbclid=IwY2xjawPL98FleHRuA2FlbQIxMQBzcnRjBmFwcF9pZAEwAAEeVllCnbivSNFB3Rrgfl3xxdpYkMA9AUb03DshpfVzj4sBwaG7xnpzhKEXuWo_aem_J-eSu3LaSgYTAbk88iGgDQ&gid=1791113508#gid=1791113508', '2026-05-12 15:14:12', '2026-06-09 16:57:37', '2026-06-09 16:57:37', NULL, 'Draft', NULL),
(47, 15, 'LTIA Data Analysis', 'PO-RO', '7', 'LGCO', 'annual', 'Jan Mikhail Kimayong', 'N/A', NULL, NULL, NULL, NULL, '[\"2026-06-01\"]', 0, 'To Do', NULL, NULL, '2026-05-13 17:57:04', '2026-07-08 16:21:03', '2026-07-08 16:21:03', NULL, 'Draft', NULL),
(51, 1, 'BARKADA Monthly Reporting (2026)', 'RO-CO', '3', 'BLGS', 'monthly', 'Alex Ian Pacis, Jr.', 'N/A', NULL, NULL, NULL, NULL, '[\"2026-06-15\",\"2026-07-15\",\"2026-08-13\",\"2026-09-15\",\"2026-10-15\",\"2026-11-12\",\"2026-12-15\",\"2027-01-14\"]', 0, 'To Do', NULL, 'https://docs.google.com/spreadsheets/d/1etJZWwyCytuibcnZAYTQ0InF77F-zQupy1N3NnkDC0A/edit', '2026-05-20 07:50:07', '2026-05-20 07:52:16', NULL, NULL, 'Draft', NULL),
(52, 17, 'Barangay Road Clearing Operations (BaRCO)', 'RO-CO', '3', 'BLGS', 'monthly', 'Alex Ian Pacis, Jr.', 'N/A', NULL, NULL, NULL, NULL, '[\"2026-05-29\",\"2026-06-30\",\"2026-07-31\",\"2026-09-01\",\"2026-09-30\",\"2026-10-30\",\"2026-12-01\",\"2026-12-30\",\"2027-01-29\",\"N\\/A\",\"N\\/A\",\"N\\/A\"]', 0, 'To Do', NULL, 'https://docs.google.com/spreadsheets/d/11xMmnbWmJ80UBsqL3zBDv7xBjvsa2xxR/edit?gid=1647617794#gid=1647617794', '2026-05-20 08:34:10', '2026-08-27 17:44:03', '2026-08-27 17:44:03', NULL, 'Draft', NULL),
(53, 1, 'LCPC Data Analysis', 'RO-CO', '7', 'LGCO', 'annual', 'Jan Mikhail Kimayong', 'N/A', NULL, NULL, NULL, NULL, '[\"N\\/A\"]', 0, 'To Do', NULL, 'https://docs.google.com/spreadsheets/d/1bb5O68bc4npRaz-iptxs4f_EPfGiKJz90focRSPDdQo/edit?gid=1504205973#gid=1504205973', '2026-05-20 09:15:06', '2026-07-08 16:21:59', '2026-07-08 16:21:59', NULL, 'Draft', NULL),
(54, 15, 'LGU Profiling Report', 'PO-RO', '7', 'ORD', 'annual', 'Jan Mikhail Kimayong', 'N/A', NULL, NULL, NULL, NULL, '[\"2026-06-01\"]', 0, 'To Do', NULL, NULL, '2026-05-28 13:54:47', '2026-07-08 16:20:59', '2026-07-08 16:20:59', NULL, 'Draft', NULL),
(55, 15, 'POGO', 'RO-CO', '5', 'NBOO', 'annual', 'Jan Mikhail Kimayong', 'N/A', NULL, NULL, NULL, NULL, '[\"2026-08-05\"]', 0, 'To Do', NULL, NULL, '2026-08-03 12:01:30', '2026-08-05 12:34:01', '2026-08-05 12:34:01', NULL, 'Draft', NULL),
(56, 15, 'STAT', 'RO-CO', '7', 'NBOO', 'quarterly', 'Jan Mikhail Kimayong', 'N/A', NULL, NULL, NULL, NULL, '[\"2026-08-06\",\"2026-09-15\",\"2027-02-10\",\"2027-07-14\"]', 0, 'To Do', NULL, NULL, '2026-08-03 12:02:08', '2026-08-04 16:25:40', '2026-08-04 16:25:40', NULL, 'Draft', NULL),
(57, 23, 'ORGANIZATION OF THE LOCAL DRINKING WATER QUALITY MONITORING COMMITTEE (LDWQMC)', 'PO-RO', '4', 'DOH-CAR', 'annual', 'Allan Ocal', 'N/A', NULL, 'Google Sheet', NULL, NULL, '[\"2026-08-04\"]', 100, 'Done', '[\"documents\\/2026-07-21-012-MEMO re ORGANIZATION OF THE LOCAL DRINKING WATER QUALITY MONITORING COMMITTEE (LDWQMC).pdf\"]', 'https://bit.ly/MonitorLDWQMC-CAR', '2026-08-03 17:18:40', '2026-08-03 17:29:23', '2026-08-03 17:29:23', NULL, 'Draft', NULL),
(58, 23, 'REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED “STRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL”', 'PO-RO', '4', 'DOH-CAR', 'annual', 'Allan Ocal', 'N/A', NULL, 'Google Link', NULL, NULL, '[\"2026-08-27\"]', 0, 'To Do', '[\"documents\\/[Letter] Dir. Nuyda_Reiteration of DILG Policies_Dengue Prevention & Control.pdf\"]', 'https://bit.ly/CALGUDenguePrevention2026', '2026-08-03 17:25:01', '2026-08-03 17:25:01', NULL, NULL, 'Draft', NULL),
(59, 23, 'PAGHINGI NG MGA KOMENTO TUNGKOL SA DRAFT OMNIBUS GUIDELINES ON THE IMPLEMENTATION OF RA 10070 O PDAO LAW', 'CO-RO', '4', 'BLGD', 'annual', 'Allan Ocal', 'N/A', '2026-08-05-283', 'DMS/LGMED Email', NULL, NULL, '[\"2026-08-11\"]', 100, 'Done', '[\"documents\\/Memo_CPDs_Request for Comments re Draft MC Omnibus PDAO Law.pdf\"]', NULL, '2026-08-07 11:17:48', '2026-08-14 20:22:32', '2026-08-14 20:22:32', NULL, 'Draft', NULL),
(60, 23, 'REQUEST FOR INPUT ON THE DRAFT GUIDELINES  FOR THE IMPLEMENTATION OF THE 2026-2028 SEAL  OF GOOD LOCAL GOVERNANCE', 'RO-CO', '4', 'BLGS', 'annual', 'Allan Ocal', 'N/A', NULL, NULL, NULL, NULL, '[\"2026-08-27\"]', 0, 'To Do', '[\"documents\\/2026-08-24-009-URGENT MEMO re REQUEST FOR INPUT ON THE DRAFT GUIDELINES FOR THE IMPLEMENTATION OF THE 2026-2028 SGLG.pdf\"]', 'https://tinyurl.com/2026SGLGComment', '2026-08-24 18:30:46', '2026-08-24 18:30:46', NULL, NULL, 'Draft', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document_assignments`
--

CREATE TABLE `document_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_to_id` bigint(20) UNSIGNED DEFAULT NULL,
  `workflow_status` varchar(255) NOT NULL DEFAULT 'Draft',
  `last_comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_assignments`
--

INSERT INTO `document_assignments` (`id`, `document_id`, `assigned_to_id`, `workflow_status`, `last_comment`, `created_at`, `updated_at`) VALUES
(33, 33, 1, 'Draft', NULL, '2026-05-11 16:02:09', '2026-05-11 16:02:09'),
(45, 45, 18, 'Draft', NULL, '2026-05-12 15:14:12', '2026-05-12 15:14:12'),
(47, 47, 15, 'Draft', NULL, '2026-05-13 17:57:04', '2026-05-13 17:57:04'),
(51, 51, 1, 'Draft', NULL, '2026-05-20 07:50:07', '2026-05-20 07:50:07'),
(52, 52, 17, 'Draft', NULL, '2026-05-20 08:34:10', '2026-05-20 08:34:10'),
(53, 53, 1, 'Draft', NULL, '2026-05-20 09:15:06', '2026-05-20 09:15:06'),
(54, 54, 15, 'Draft', NULL, '2026-05-28 13:54:47', '2026-05-28 13:54:47'),
(55, 55, 15, 'Draft', NULL, '2026-08-03 12:01:30', '2026-08-03 12:01:30'),
(56, 56, 15, 'Draft', NULL, '2026-08-03 12:02:08', '2026-08-03 12:02:08'),
(57, 57, 23, 'Draft', NULL, '2026-08-03 17:18:40', '2026-08-03 17:18:40'),
(58, 58, 23, 'Draft', NULL, '2026-08-03 17:25:01', '2026-08-03 17:25:01'),
(59, 59, 23, 'Draft', NULL, '2026-08-07 11:17:48', '2026-08-07 11:17:48'),
(60, 60, 23, 'Draft', NULL, '2026-08-24 18:30:46', '2026-08-24 18:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `document_processes`
--

CREATE TABLE `document_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_title` varchar(255) NOT NULL,
  `focal_person` varchar(255) NOT NULL,
  `document_link` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `file_path` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`file_path`)),
  `assigned_to_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Draft',
  `last_comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_of_paper` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `delete_scheduled_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_processes`
--

INSERT INTO `document_processes` (`id`, `user_id`, `subject_title`, `focal_person`, `document_link`, `remarks`, `file_path`, `assigned_to_id`, `section`, `status`, `last_comment`, `created_at`, `updated_at`, `type_of_paper`, `deleted_at`, `delete_scheduled_at`) VALUES
(22, 18, 'RCSP', 'Joanabeth Tamondong', NULL, NULL, '[]', 18, 5, 'Draft', NULL, '2026-05-12 15:15:22', '2026-05-12 15:15:56', 'Memorandum', '2026-05-12 15:15:56', NULL),
(23, 18, 'PAR', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1HjlEhNzXaUY4dS3mlS41pIGtU-Hs8-9u/edit', NULL, '[]', NULL, 5, 'Complete', 'Ma\'am, already reviewed and made the necessary corrections. For your review and approval.', '2026-05-12 15:56:38', '2026-05-20 17:36:25', 'PAR', '2026-05-20 17:36:25', NULL),
(24, 10, 'PADS Action Plan (Continuing Funds)', 'Nikko May Gunday', 'https://docs.google.com/document/d/16XZKI3Zg53cFMnG9JWsQPZJ29fbIZ4zU/edit', NULL, '[]', 10, 5, 'Revision Required', 'ok then. Noted on this. Finalized all PADS action plan vis-a-vis sa fund.', '2026-05-12 16:22:33', '2026-05-13 07:33:14', 'Action Plan', '2026-05-13 07:33:14', NULL),
(25, 18, 'DILG LED ACCOMPLISHMENT FOR THE MONTH OF APRIL', 'Joanabeth Tamondong', 'https://docs.google.com/presentation/d/1OLsypnkOteYUT48eQK2cdY3yYxvSYyVQ/edit?slide=id.p1#slide=id.p1', NULL, '[]', NULL, 5, 'Complete', 'Reviewed Ma\'am.', '2026-05-13 07:27:33', '2026-05-20 17:35:17', 'Presentation', '2026-05-20 17:35:17', NULL),
(26, 10, 'Justification for a Face-to-Face Modality', 'Nikko May Gunday', 'https://docs.google.com/document/d/1D6k8a-ZFPDnKF-VOSKSVa8tdktOFa8UX/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', NULL, 5, 'Complete', 'please finalize. okay na', '2026-05-13 11:29:01', '2026-05-14 07:39:16', 'Justification', '2026-05-14 07:39:16', NULL),
(27, 15, 'OJT Certificates', 'Jan Mikhail Kimayong', NULL, 'For checking po maam', '[\"document_processes\\/7BmDojusrZ2o2TihuslnB5h49ung1I1obnGIpQPZ.pdf\"]', 13, 2, 'Pending Review', 'For checking', '2026-05-13 11:43:28', '2026-05-13 16:49:09', 'other', '2026-05-13 16:49:09', NULL),
(28, 18, 'Minutes of Meeting on DILG LED', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1hxxyfvCHTAtUAi-RgXBg108fCb32MBFt/edit?usp=sharing&ouid=102258889561619355428&rtpof=true&sd=true', 'For your checking po.', '[]', NULL, 5, 'Complete', 'reviewed Ma\'am, for your review and comment', '2026-05-13 13:43:30', '2026-05-20 17:36:34', 'Minutes of Meeting', '2026-05-20 17:36:34', NULL),
(29, 10, 'CBDRP Concept Note', 'Nikko May Gunday', 'https://docs.google.com/document/d/1l-rHyuB35P7O4Wgxf4MCe5EfXdUfvHQU/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', 11, 5, 'Pending Review', 'For review po Ma\'am Lala', '2026-05-14 08:46:05', '2026-05-19 16:28:05', 'Concept Note', '2026-05-19 16:28:05', NULL),
(30, 15, 'Transmittal POGO April 2026', 'Jan Mikhail Kimayong', 'https://docs.google.com/document/d/1HKIrTZBmGLHvfhoKpTM4M4YdBWzaVSCd/edit?usp=sharing&ouid=102258889561619355428&rtpof=true&sd=true', 'For review', '[]', 15, 5, 'Draft', NULL, '2026-05-14 10:20:04', '2026-05-20 08:25:35', 'Memorandum', '2026-05-20 08:25:35', NULL),
(31, 10, 'Follow-up Memo re: Request for Clarification of certain result of the 2025 ADAC Performance Audit concerning Baguio City, Abra and Mountain Province', 'Nikko May Gunday', 'https://docs.google.com/document/d/1kh_No_JkhlTXvxFQVGsWGjOQXHauZ8h8/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', 19, 5, 'Pending Review', 'sir eto po yung follow-up Memo natin kay BLGS, for your review po', '2026-05-14 15:01:04', '2026-05-14 17:00:19', 'Memorandum', '2026-05-14 17:00:19', NULL),
(36, 18, 'PROPOSAL RCSP SCHEDULE', 'Joanabeth Tamondong', 'https://canva.link/50kgs46sa8ac5t3', NULL, '[]', 18, 5, 'Revision Required', 'ganyan muna nakalagay DC/ADC...for June kc is we will be busy with Onsite activities for PRAISE...like for example sa June 2-4, we will be in Apayao...', '2026-05-19 09:57:15', '2026-05-20 17:58:01', 'CANVA', NULL, NULL),
(37, 10, 'Letter to PDEA re IPEYAS DFWP', 'Nikko May Gunday', 'https://docs.google.com/document/d/1SxWf-vjtRgwY4lejgAQe31eQBv4WRjQ0/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', 10, 5, 'Draft', NULL, '2026-05-19 16:28:51', '2026-05-20 17:38:47', 'Letter', '2026-05-20 17:38:47', NULL),
(38, 10, 'Follow-up Memo to DILG Benguet', 'Nikko May Gunday', 'https://docs.google.com/document/d/1-dHCKEXIrF5OGUtE7yAb4yF_3bw12S4T/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', 10, 5, 'Revision Required', 'please see revisions', '2026-05-20 08:58:01', '2026-05-26 10:13:34', 'Memorandum', '2026-05-26 10:13:34', NULL),
(39, 10, 'Follow-up Memo to DILG Apayao', 'Nikko May Gunday', 'https://docs.google.com/document/d/1iWDgboHSMIgvtEcBuA4IsqVoQHvLI2NL/edit#heading=h.c0en6460dh8t', NULL, '[]', NULL, 5, 'Complete', 'Ma\'am lala, here po yung Memo to DILG Apayao, for your comment', '2026-05-20 10:46:59', '2026-05-20 17:38:26', 'Memorandum', '2026-05-20 17:38:26', NULL),
(40, 20, 'POC - Change of Date', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1fV_aeC9ntHeYB6E1a9vuhPQ6EGuH_XaH/edit', 'For review po Ma\'am Lala', '[]', 20, 5, 'Revision Required', 'please change the sender to DC MaryJane', '2026-05-20 14:51:00', '2026-05-21 10:17:37', 'Memorandum', '2026-05-21 10:17:37', NULL),
(41, 11, 'Letter to POC RAC Members  for the conduct of POC Pre-Assessment', 'LALA GERON', 'https://drive.google.com/drive/folders/1A_QDFrUSpCSoLERmxQDrd_gAmoytxbzG?usp=drive_link', 'For your review Ma\'am', '[]', NULL, 2, 'Complete', 'Noted Ma\'am', '2026-05-20 16:40:38', '2026-10-08 08:55:02', 'letter', '2026-10-08 08:55:02', NULL),
(42, 18, 'APPROVAL AND ALLOCATION OF FUNDS FOR THE IMPLEMENTATION AND INSTALLATION OF THE OFFICE CUBICLES IN THE LGMED', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1jsC-0eFOvsE2N37axaYP9cZamAbb0r0B/edit', NULL, '[]', NULL, 2, 'Complete', 'this is okay', '2026-05-20 17:19:46', '2026-05-20 17:35:12', 'Memorandum', '2026-05-20 17:35:12', NULL),
(43, 18, 'REQUEST TO PROCAR RE ORIENTATION JRTF members regarding their respective functions', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1JO364AAMrRbavalLZPqAD91rhltqUmoG7Qa3nfSHYyE/edit?usp=sharing', NULL, '[]', 11, 5, 'Pending Review', NULL, '2026-05-21 08:23:08', '2026-05-21 14:56:02', 'LETTER', '2026-05-21 14:56:02', NULL),
(44, 18, 'REQUEST TO PROCAR RE ORIENTATION JRTF members regarding their respective functions', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1JO364AAMrRbavalLZPqAD91rhltqUmoG7Qa3nfSHYyE/edit?tab=t.0', NULL, '[]', 22, 5, 'Pending Review', NULL, '2026-05-21 08:25:36', '2026-05-21 14:56:06', 'LETTER', '2026-05-21 14:56:06', NULL),
(45, 11, 'Memo to FOUs re RAC activities', 'LALA GERON', 'https://docs.google.com/document/d/1-A8S30gecmGBfcHitPAMxZOMKgvGNCFw/edit?usp=sharing&ouid=108303696007455353545&rtpof=true&sd=true', NULL, '[]', NULL, 2, 'Complete', 'Done na po Ma\'am. Joanabeth fixed and printed na this.', '2026-05-21 16:36:09', '2026-10-08 08:55:13', 'Memorandum', '2026-10-08 08:55:13', NULL),
(46, 20, 'ECLIP CONFIRMATION LINK', 'Prince Jeden Pascua', 'https://docs.google.com/forms/d/14mC7VzM7SAmZ1OQO4ZKQI9dZ2KNj06ZlPvh2R8-_Zeg/edit', NULL, '[]', 20, 5, 'Revision Required', 'pls add another option: if representative, iinput nila kung sino nirerepresent nila', '2026-05-26 08:24:29', '2026-05-26 16:43:24', 'GOOGLE FORM', '2026-05-26 16:43:24', NULL),
(47, 20, 'RCSP TARPAULIN DESIGN', 'Prince Jeden Pascua', 'https://canva.link/4horhljsz30pghc', NULL, '[]', 11, 5, 'Pending Review', 'For review', '2026-05-26 08:51:42', '2026-05-26 09:10:30', 'Tarpaulin', '2026-05-26 09:10:30', NULL),
(48, 10, 'ECLIP MRM', 'Nikko May Gunday', 'https://docs.google.com/document/d/1ee7kwCd6Y_dd2qWqj8lU-GSoYjlV0qY1/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', 10, 5, 'Revision Required', 'please let Lala go over this MRM tnx', '2026-05-26 09:56:04', '2026-05-26 14:08:15', 'MRM', '2026-05-26 14:08:15', NULL),
(49, 10, 'NOM 2nd Q ICAD Advocacy Cluster Meeting', 'Nikko May Gunday', 'https://docs.google.com/document/d/1Ty9TfmzE-TSDPZUIw8skA-59A6xYRPlv/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', NULL, 5, 'Complete', 'okay na po ma\'am', '2026-05-26 10:29:51', '2026-06-09 17:28:52', 'Advisory', '2026-06-09 17:28:52', NULL),
(50, 10, 'RESO CRPOC SAC', 'Nikko May Gunday', 'https://docs.google.com/document/d/1ikF_LHxcFqkBrDj4Hcj33SKk9q1eFQPs/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', NULL, 2, 'Complete', 'i just changed ung date, from March 18 to March 17', '2026-05-26 11:12:02', '2026-05-26 22:01:58', 'Resolution', '2026-05-26 22:01:58', NULL),
(51, 20, 'RCSP TARPAULIN DESIGN', 'Prince Jeden Pascua', 'https://www.canva.com/design/DAHKoobMlL4/9ysJ4aWroWt4K0-V1VvTuQ/edit', NULL, '[]', 20, 5, 'Revision Required', 'change the color yellow font and add more graphics. sent you the design by villaviciosa, abra.. you can get an idea from it.', '2026-05-26 11:27:44', '2026-07-09 10:59:56', 'TARP', '2026-07-09 10:59:56', NULL),
(52, 20, 'CRPOC Confirmation Link', 'Prince Jeden Pascua', 'https://docs.google.com/forms/d/15mBHXsrcuLgZt22DyMYMJHTx8iEUDxid5tpu7nLJn6s/edi', NULL, '[]', 20, 5, 'Draft', NULL, '2026-05-26 11:55:53', '2026-05-26 11:56:35', 'google form', '2026-05-26 11:56:35', NULL),
(53, 20, 'CRPOC Confirmation Link', 'Prince Jeden Pascua', 'https://docs.google.com/forms/d/15mBHXsrcuLgZt22DyMYMJHTx8iEUDxid5tpu7nLJn6s/edit', NULL, '[]', 20, 5, 'Revision Required', 'ok na eto.. shortened link na ba eto? if not, pls make a customized shorten link for this', '2026-05-26 11:56:51', '2026-05-26 16:43:26', 'google form', '2026-05-26 16:43:26', NULL),
(54, 10, 'ECLIP Convergence Request for Change of Date', 'Nikko May Gunday', 'https://docs.google.com/document/d/1Q07Gg4zYfkVPgQ9CrQJLnJqB3q84wsz3/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', NULL, 5, 'Complete', 'oks na eto..', '2026-05-26 14:48:30', '2026-05-26 22:02:03', 'Memorandum', '2026-05-26 22:02:03', NULL),
(55, 18, 'CERTIFICATE OF PARTICIPATION', 'Joanabeth Tamondong', 'https://canva.link/i6v2qlgth71bqnh', 'Maam Lala, need pa ba natin ng ganito for Orientation sa June 11, 2026?', '[]', 18, 5, 'Revision Required', '1. Improve the KRTF font\r\n2. Know the title of the orientation conducted and have it as the content of the cert\r\n3.Put the place after the date of conduct. it is still feb 19\r\n4. improve design, it is very common with our previous certs.', '2026-05-26 15:17:19', '2026-05-26 15:48:05', 'canva', NULL, NULL),
(56, 10, 'ICAD 2nd Quarter Change of Date', 'Nikko May Gunday', 'https://docs.google.com/document/d/1JdtA1NIpj_XpZvqvKyNBqHV_CHO0LbqR/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', NULL, 5, 'Complete', 'approve', '2026-05-26 15:19:03', '2026-05-26 22:02:08', 'Memorandum', '2026-05-26 22:02:08', NULL),
(57, 18, 'DRAFT ADVSORY TO ORIENTATION ON DILG LED MEMBERS', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1ZxJ13jauEai6eJorfgocDT5dHReJtGHH/edit', NULL, '[]', 18, 5, 'Revision Required', 'access denied..pls unrestrict the link pls', '2026-05-26 15:33:10', '2026-05-26 15:58:55', 'Advisory', NULL, NULL),
(58, 18, 'RCSP SCHEDULE', 'Joanabeth Tamondong', 'https://docs.google.com/spreadsheets/d/1W81_vPHS-PSu2dL36CEE8BhGSDfdBHgCmneXLwTybYg/edit?gid=1920967261#gid=1920967261', NULL, '[]', 18, 5, 'Revision Required', 'noted', '2026-05-26 15:43:22', '2026-05-26 15:54:04', 'CANVA', NULL, NULL),
(59, 18, 'DRAFT PROGRAM FOR THE ORIENTATION', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1bsaCiO17qPijWL-zdiu9iZR2YFQ03TxuwG5A1Am34gw/edit?usp=sharing', NULL, '[]', 18, 5, 'Revision Required', 'see comments.. we have to present this muna during the meeting with them', '2026-05-26 15:51:05', '2026-06-20 20:43:37', 'PROGRAM', '2026-06-20 20:43:37', NULL),
(60, 18, 'MINUTES OF MEETING CRPOC', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1Km7VCTCGUjygQrjbk-fAG1NZEEEt7-Yo/edit', NULL, '[]', 18, 2, 'Revision Required', 'please input corrections and ready for printing na. salamats', '2026-05-26 16:43:56', '2026-06-20 20:43:33', 'MINUTES OF MEETING', '2026-06-20 20:43:33', NULL),
(61, 10, 'POC Program', 'Nikko May Gunday', 'https://docs.google.com/document/d/1XEtNKFRjevAdaI3M-s0u9VoDYhMcpoNC/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', NULL, 5, 'Complete', 'Ma\'am for your review po', '2026-05-26 22:03:22', '2026-06-09 17:28:40', 'Program', '2026-06-09 17:28:40', NULL),
(62, 10, 'PAR ICAD Rehabilitation and Reintegration Cluster', 'Nikko May Gunday', 'https://docs.google.com/document/d/1bAmFCBxigdyRubHolgsNC9DY8Y46CjIO/edit', NULL, '[]', 10, 5, 'Revision Required', 'see comment on the letter C', '2026-05-26 23:42:10', '2026-06-09 17:28:59', 'PAR', '2026-06-09 17:28:59', NULL),
(63, 20, 'Amendment to RO RCSP (JUNE 4)', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1D4tnmqmBdoKLmkb3Ck9LYOp6CCIfeoQC/edit', NULL, '[]', 20, 5, 'Revision Required', 'ok na eto', '2026-05-28 09:12:01', '2026-05-28 09:36:17', 'Regional Order', '2026-05-28 09:36:17', NULL),
(64, 11, 'Optimization of the ECLIP-IS', 'LALA GERON', 'https://docs.google.com/document/d/1-A8S30gecmGBfcHitPAMxZOMKgvGNCFw/edit', 'For your review and approval Ma\'am', '[]', NULL, 5, 'Complete', 'For your review and approval Ma\'am..', '2026-05-28 11:23:23', '2026-05-28 14:07:00', 'Memorandum', '2026-05-28 14:07:00', NULL),
(65, 15, '2025 BPOC Summary', 'Jan Mikhail Kimayong', NULL, NULL, '[\"document_processes\\/lg-peace-order-public-safety-compliance-and-monitoring\\/2025 Regional Summary of Results for the 2025 BPOC.pdf\"]', 15, 5, 'Revision Required', 'pls seperate baguio city from benguet. thank you', '2026-05-28 13:53:15', '2026-05-28 14:49:45', 'Report', '2026-05-28 14:49:45', NULL),
(66, 20, 'Amendment to RO RCSP (JUNE 4)', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1D4tnmqmBdoKLmkb3Ck9LYOp6CCIfeoQC/edit', NULL, '[]', 20, 5, 'Ready for Printing', '2 options for the amended travel order to Apayao this June 4', '2026-05-28 14:04:02', '2026-06-08 09:47:05', 'Regional Order', '2026-06-08 09:47:05', NULL),
(67, 11, 'POC Pre-Assessment Results Comm', 'LALA GERON', 'https://drive.google.com/drive/folders/1TsQ7weHXLDyxLSfDsSW4qcMR6OXh-7_S?usp=drive_link', NULL, '[]', NULL, 5, 'Complete', NULL, '2026-05-28 14:22:53', '2026-05-28 17:16:48', 'Memorandum', '2026-05-28 17:16:48', NULL),
(68, 18, 'FB CAPTION POC PRE-ASSESSMENT', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/184dS0Maqqq56egQgSlHK39Na5graJSb4FA0Re9eT7qA/edit?usp=sharing', NULL, '[]', 18, 5, 'Revision Required', 'is there a need to post this in FB since this is a Pre assessment pa lang? hindi ba Mas maganda pag ung assessment na mismo ang for FB posting? what do you think?', '2026-06-01 17:09:15', '2026-06-16 14:26:23', 'CAPTION', '2026-06-16 14:26:23', NULL),
(69, 18, 'FB CAPTION POC PRE-ASSESSMENT', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/184dS0Maqqq56egQgSlHK39Na5graJSb4FA0Re9eT7qA/edit?tab=t.0', NULL, '[]', 18, 2, 'Draft', NULL, '2026-06-01 17:47:19', '2026-06-16 14:26:21', 'CAPTION', '2026-06-16 14:26:21', NULL),
(70, 10, 'CRPOC Notice of Meeting', 'Nikko May Gunday', 'https://docs.google.com/document/d/113pWRdSm8heF6cjgyQ1Tulqa82whxCTh/edit', NULL, '[]', NULL, 5, 'Complete', 'Ma\'am for your review po', '2026-06-03 11:38:50', '2026-06-09 17:28:45', 'NOM', '2026-06-09 17:28:45', NULL),
(71, 20, 'RCSP RO (CONNER, APAYAO)', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1D4tnmqmBdoKLmkb3Ck9LYOp6CCIfeoQC/edit', NULL, '[]', 20, 5, 'Revision Required', 'see comment and revise. thank you', '2026-06-08 09:47:38', '2026-06-11 08:20:05', 'REGIONAL ORDER', '2026-06-11 08:20:05', NULL),
(72, 11, 'Letter for concerned Mayors', 'LALA GERON', 'https://drive.google.com/drive/folders/18hQ8t000ahgmQyivYzURtVoS1WGn6pmU', NULL, '[]', NULL, 5, 'Complete', 'revised na Ma\'am, for your review again. Thank you po', '2026-06-09 15:58:47', '2026-06-09 17:50:12', 'letter', '2026-06-09 17:50:12', NULL),
(73, 10, 'Invitation Letter to SILG', 'Nikko May Gunday', 'https://docs.google.com/document/d/1EEoCda5J9-orf2WrrTqqlTq9qCJ4DHl_/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', 11, 5, 'Pending Review', 'let us not proceed with this since it is not confirmed thanks', '2026-06-09 17:21:10', '2026-06-16 07:16:50', 'Letter', '2026-06-16 07:16:50', NULL),
(74, 10, '2026 IDADAIT  Celebration', 'Nikko May Gunday', 'https://docs.google.com/document/d/1h4YVXQuloAV-qUhyLXxxDSIyFYlHtRpd/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', 11, 5, 'Pending Review', 'Ma\'am for your comment and additional input po', '2026-06-15 13:44:11', '2026-06-16 10:26:06', 'Memorandum', '2026-06-16 10:26:06', NULL),
(75, 10, 'Letter to NAPOLCOM CAR', 'Nikko May Gunday', 'https://docs.google.com/document/d/10lOwxc3jqTkB8InvlursbcRCTaXEGdGE/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', NULL, 5, 'Complete', 'Ma\'am for your review po', '2026-06-16 08:51:01', '2026-07-29 11:16:29', 'letter', '2026-07-29 11:16:29', NULL),
(76, 20, 'FOLLOW-UP SUBMISSION ON THE 1ST CUCPD QUARTER CIR', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1d09WIume6K59ZKuB3gQ1_zhvOlbEtbl0/edit', NULL, '[]', 20, 5, 'Revision Required', 'goods na. lagyan mo lng ng due date', '2026-06-16 11:12:06', '2026-06-16 13:14:38', 'Memorandum', '2026-06-16 13:14:38', NULL),
(77, 18, 'POST ACTIVITY PRESENTATION (ORIENTATION ON DILG LED MEMBERS)', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1Hy7aaFkQMA-l2ERR3jBp7CaJHCPA5aKd/edit', 'For your review and checking ma\'am.', '[]', 22, 5, 'Pending Review', 'For your review and checking po.', '2026-06-16 14:25:26', '2026-06-16 14:25:48', 'PAR', NULL, NULL),
(78, 18, 'Post Activity Report on 2nd QCRPOC', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/19tAAjsEBfbbejdbyWckK172Afml_4dEo/edit?usp=sharing&ouid=102258889561619355428&rtpof=true&sd=true', NULL, '[]', NULL, 5, 'Complete', 'For your review and checking po maam (for liquidation)', '2026-06-20 20:43:24', '2026-08-25 15:13:15', 'POST ACTIVITY REPORT', '2026-08-25 15:13:15', NULL),
(79, 20, 'reply to NICA', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1KUdwkGt5XKmt6RHPkqPHK1UhN8je2v3G/edit?usp=sharing&ouid=102258889561619355428&rtpof=true&sd=true', NULL, '[]', NULL, 5, 'Complete', 'reviewed Ma\'am. For your approval po. Thank you', '2026-07-08 08:46:40', '2026-07-08 14:27:07', 'LETTER', '2026-07-08 14:27:07', NULL),
(80, 18, 'ECLIP - PAR (FOR LIQUIDATION)', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1IK_DNJ0zQfGw7fo8-zTBRI9wQvsEjaLn/edit?usp=sharing&ouid=102258889561619355428&rtpof=true&sd=true', NULL, '[]', 11, 5, 'Pending Review', NULL, '2026-07-09 13:18:29', '2026-07-09 16:15:27', 'PAR', '2026-07-09 16:15:27', NULL),
(81, 20, 'Submission of Annex A', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/10qtkLj9bnXKBMCz52rr7w3x8jKvxLh1g/edit', NULL, '[]', NULL, 5, 'Complete', 'for checking', '2026-07-09 15:54:48', '2026-07-09 16:29:58', 'Memorandum', '2026-07-09 16:29:58', NULL),
(82, 18, 'MOM -2ND QUARTER CRPOC MEETING', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1zRBFz96CsYSGHIzRpUjBupN_4E6j3DB8/edit?usp=sharing&ouid=102258889561619355428&rtpof=true&sd=true', NULL, '[]', 22, 5, 'Pending Review', NULL, '2026-07-09 16:11:09', '2026-07-09 16:11:27', 'MOM', NULL, NULL),
(83, 18, 'ECLIP - PAR (FOR LIQUIDATION)', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1IK_DNJ0zQfGw7fo8-zTBRI9wQvsEjaLn/edit', NULL, '[]', NULL, 5, 'Complete', 'For your approval Ma\'am', '2026-07-09 16:14:39', '2026-07-13 18:10:29', 'PAR', '2026-07-13 18:10:29', NULL),
(84, 18, 'MINUTES OF MEETING 2ND CRPOC', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1zRBFz96CsYSGHIzRpUjBupN_4E6j3DB8/edit', NULL, '[]', NULL, 5, 'Complete', 'ma\'am for your review', '2026-07-13 08:59:18', '2026-08-25 15:13:05', 'MINUTES OF MEETING', '2026-08-25 15:13:05', NULL),
(85, 20, 'RO re Serbisyo Caravan at Villaviciosa, Abra', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1MugCmCzyqDtNyHyu8Cw6Ffi8jO9vIWPT/edit', NULL, '[]', NULL, 5, 'Complete', 'For your approval Ma\'am', '2026-07-13 17:40:55', '2026-07-13 17:52:50', 'Regional Order', '2026-07-13 17:52:50', NULL),
(86, 20, 'RO re RCSP @ Kalinga', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1yC03e7oF_VKW_pugO_FUxtZaxL0FXZX4/edit', NULL, '[]', NULL, 5, 'Complete', NULL, '2026-07-14 08:27:15', '2026-07-14 14:18:19', 'Regional Order', '2026-07-14 14:18:19', NULL),
(87, 18, 'CRPOC 1ST SEM ACCOMPLISHMENT REPORT', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1UK2TNM5yfTGfgqMRhk8fiRF7Mf10QewRWNWYaufppdk/edit?usp=sharing', NULL, '[]', 18, 5, 'Revision Required', 'pls see comment', '2026-07-14 14:49:01', '2026-07-27 11:10:43', 'Narrative Report', NULL, NULL),
(88, 20, 'CUCPD Feedback Sheet', 'Prince Jeden Pascua', 'https://docs.google.com/spreadsheets/d/11xU_o-ITJyDIhNOThm9ByPWDwAP9GtPJBs_egtwllpQ/edit?gid=0#gid=0', NULL, '[]', 20, 5, 'Ready for Printing', 'reviewed and approved', '2026-07-14 15:39:54', '2026-08-11 08:43:25', 'Google Sheet', NULL, NULL),
(89, 18, 'LETTER TO CRFV', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1JO364AAMrRbavalLZPqAD91rhltqUmoG7Qa3nfSHYyE/edit?usp=sharing', NULL, '[]', 18, 5, 'Revision Required', 'Already edited Maam. Thank you.', '2026-07-14 16:23:35', '2026-07-16 08:46:12', 'LETTER', NULL, NULL),
(90, 18, 'CRPOC RESO NO. 4', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1B9Od7srXye4hYarMTxqdNYiHWbj2-FC1h8UZV6FpN14/edit?usp=sharing', NULL, '[]', NULL, 5, 'Complete', 'For maam Bable', '2026-07-16 08:08:21', '2026-08-25 15:13:20', 'RESOLUTION', '2026-08-25 15:13:20', NULL),
(91, 18, 'CRPOC RESO 4 -', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1B9Od7srXye4hYarMTxqdNYiHWbj2-FC1h8UZV6FpN14/edit?tab=t.0', NULL, '[]', NULL, 5, 'Complete', 'For your review Ma\'am', '2026-07-16 08:18:30', '2026-08-25 15:13:10', 'RESOLUTION', '2026-08-25 15:13:10', NULL),
(92, 18, 'CRPOC MOM 2ND QUARTER', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1zRBFz96CsYSGHIzRpUjBupN_4E6j3DB8/edit', 'maam, naakita na rin po ito ni maam Princes. Thanks po', '[]', NULL, 5, 'Complete', 'disregard this one Ma\'am. Thank you', '2026-07-24 06:31:44', '2026-08-25 15:13:24', 'MOM', '2026-08-25 15:13:24', NULL),
(93, 18, 'DRAFT RCSP CONVERGENCE', 'Joanabeth Tamondong', 'https://docs.google.com/spreadsheets/d/1l0DVZWre_vlAB3h0enTPDom7J8DevRcw/edit?gid=1737799094#gid=1737799094', NULL, '[]', 22, 5, 'Pending Review', 'For maam PAB, here po yung computation. Thanks po', '2026-07-27 09:29:37', '2026-07-27 09:30:32', 'AD', NULL, NULL),
(94, 18, 'MEMO re FASTRACKING OF RCSP SCHEDULE TO KALINGA AND MP', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1Pg7UHIlvv6j6V__aSpxyUr-8vgbVU8JV/edit?usp=sharing&ouid=102258889561619355428&rtpof=true&sd=true', NULL, '[]', 18, 5, 'Revision Required', 'Pls ensure and communicate with the concerned FOUs. Per convo with them last July 28, they already updated their schedule.', '2026-07-27 17:41:03', '2026-07-30 11:04:28', 'Memorandum', NULL, NULL),
(95, 18, '1ST SEM DILG LED - ACCOMPLISHMENT', 'Joanabeth Tamondong', 'https://docs.google.com/presentation/d/16JglaQPBKw3gWl4ZzyQltxx6cCry9uyh/edit?usp=sharing&ouid=110455734845522460908&rtpof=true&sd=true', NULL, '[]', 18, 5, 'Revision Required', 'pls provide narrative report on this just like our last report.', '2026-07-28 11:57:31', '2026-07-30 11:07:24', 'PRESENTATION', NULL, NULL),
(96, 18, '1ST SEM ACCPMPLISHMENT LOCAL TASK FORCE', 'Joanabeth Tamondong', 'https://docs.google.com/presentation/d/1HLYlo3j_v8reXiuQofsjtsmE_XPNiOfm/edit?slide=id.p1#slide=id.p1', NULL, '[]', 18, 5, 'Revision Required', 'pls include this in the narrative report as well..', '2026-07-28 11:58:41', '2026-07-30 11:00:11', 'PRESENTATION', NULL, NULL),
(97, 10, 'Request Guidance for SDEC Submission of Report', 'Nikko May Gunday', 'https://docs.google.com/document/d/15xtbHOC3DAQ3x0y4weFsmXXRCq4Nxcuu/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', 22, 5, 'Pending Review', 'Ma\'am Ces, for your comment and additional input po', '2026-07-29 11:19:53', '2026-08-05 11:00:23', 'Memorandum', '2026-08-05 11:00:23', NULL),
(98, 10, 'Post Audit Activity', 'Nikko May Gunday', 'https://docs.google.com/document/d/1sR3fzh7oR3izUIpshU-hLOYtshnPA_lb/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', 10, 5, 'Revision Required', 'Will you attach the indicative program? if yes, pls include that venue and indicative program will be sent in a seperate comm', '2026-07-29 11:24:41', '2026-08-05 11:00:20', 'Memorandum', '2026-08-05 11:00:20', NULL),
(99, 18, 'INVITATION TO THE LGA-REGIONAL OFFICE CONSULTATION ON FY 2027 PLANS AND PROGRAMS', 'Joanabeth Tamondong', NULL, NULL, '[\"document_processes\\/division-chief\\/document (9)-1.pdf\"]', NULL, 1, 'Complete', NULL, '2026-07-30 17:12:51', '2026-08-25 15:13:00', 'LETTER', '2026-08-25 15:13:00', NULL),
(100, 20, 'CUCPD AD', 'Prince Jeden Pascua', 'https://docs.google.com/spreadsheets/d/1nSGY8zcgIachuLfDxqJrKQ-YknRgmGAR/edit?gid=624265587#gid=624265587', NULL, '[]', 20, 5, 'Revision Required', 'hindi ba eto icu-cum sa RCSP Convergence? tapos pls check the dates.. i am looking at Sept 29-30 which is our initial agreement?', '2026-08-03 09:47:38', '2026-08-04 11:08:28', 'AD', '2026-08-04 11:08:28', NULL),
(101, 20, 'RO KALINGA BDP', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1yC03e7oF_VKW_pugO_FUxtZaxL0FXZX4/edit', NULL, '[]', NULL, 5, 'Complete', NULL, '2026-08-03 09:57:59', '2026-08-04 11:08:22', 'REGIONAL ORDER', '2026-08-04 11:08:22', NULL),
(102, 20, 'C4PEACE JULY ACCOMP. REPORT', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1VqyLSZFBcEnkLB7JKAkz5q3U9z_mTwQ48tDiNOeiqps/edit?usp=sharing', NULL, '[]', NULL, 5, 'Complete', 'already approved', '2026-08-04 11:08:54', '2026-08-11 15:59:58', 'ACCOMPLISHMENT REPORT', '2026-08-11 15:59:58', NULL),
(103, 20, '(CUCPD) Submission of Feedback on the PPAs of the 4 sectors', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1E_ug6huY8cPZPx8bmCV94hehUGxJ2Jim/edit', NULL, '[]', 20, 5, 'Revision Required', 'Pls see comment', '2026-08-04 11:33:22', '2026-08-04 15:50:54', 'Memorandum', NULL, NULL),
(104, 10, 'MEMO RE DDB POLICY ISSUANCE', 'Nikko May Gunday', 'https://docs.google.com/document/d/14VfpFMJniFRB3AHG85xWXE8UCZlkrC1X/edit?usp=sharing&ouid=102515627534100291081&rtpof=true&sd=true', NULL, '[]', 10, 5, 'Ready for Printing', 'Ma\'am for your review po', '2026-08-05 11:00:56', '2026-08-11 08:42:02', 'Memorandum', NULL, NULL),
(105, 18, 'DILG LED ACCOM FOR JULY', 'Joanabeth Tamondong', 'https://docs.google.com/document/d/1o61f_OGRpRirv6vhGgqYFNHQB2EKPAqG/edit', NULL, '[]', 18, 5, 'Revision Required', 'pakitingnan ang komenta. Salamat', '2026-08-10 20:38:34', '2026-08-11 08:01:56', 'LETTER AND REPORT', NULL, NULL),
(106, 20, 'PAR - EBDP PINUKPUK', 'Prince Jeden Pascua', NULL, NULL, '[\"document_processes\\/lg-peace-order-public-safety-compliance-and-monitoring\\/EBDP PINUKPUK.pdf\"]', 11, 5, 'Pending Review', NULL, '2026-08-11 16:01:50', '2026-08-24 10:06:12', 'PAR', '2026-08-24 10:06:12', NULL),
(107, 15, 'LGU Profiling Transmittal to MSAC', 'Jan Mikhail Kimayong', 'https://docs.google.com/document/d/1UJwkWxO1jgBo3q9wMqrDdrKpNmOz7oyV/edit', NULL, '[]', 15, 4, 'Revision Required', 'psl check comment', '2026-08-12 16:41:54', '2026-08-13 10:29:54', 'Advisory', '2026-08-13 10:29:54', NULL),
(108, 20, 'RO re PRONVICIAL CONVERGENCE @ MP', 'Prince Jeden Pascua', 'https://docs.google.com/document/d/1fHe4BisvpWyHDJjz8PlcuO69TzRmbuTB/edit', NULL, '[]', 20, 5, 'Ready for Printing', NULL, '2026-08-24 10:06:51', '2026-08-26 07:47:00', 'Regional Order', NULL, NULL),
(109, 18, 'RCSO CONVERGENCE', 'Joanabeth Tamondong', 'https://docs.google.com/spreadsheets/d/1l0DVZWre_vlAB3h0enTPDom7J8DevRcw/edit?gid=1737799094#gid=1737799094', NULL, '[]', 18, 5, 'Draft', NULL, '2026-08-25 15:12:04', '2026-08-25 15:12:19', 'AD', '2026-08-25 15:12:19', NULL),
(110, 18, 'RCSP CONVERGENCE', 'Joanabeth Tamondong', 'https://docs.google.com/spreadsheets/d/1l0DVZWre_vlAB3h0enTPDom7J8DevRcw/edit?gid=1737799094#gid=1737799094', NULL, '[]', 18, 5, 'Ready for Printing', NULL, '2026-08-25 15:12:37', '2026-09-28 11:08:45', 'AD', NULL, NULL),
(111, 20, 'CUCPD re AVP FOR LG MONTH', 'Prince Jeden Pascua', 'https://drive.google.com/drive/folders/1EVYoAi7Km7inja6En2hyY7ZO7uDr65fD', NULL, '[]', 20, 5, 'Ready for Printing', 'For Review po, please the 2 google docs in the drive.', '2026-09-03 16:43:37', '2026-09-28 11:10:20', 'Memorandum', NULL, NULL),
(112, 27, 'CSO', 'Matt Andrei Gallamos', 'https://docs.google.com/document/d/1Zha9uZJyytF7WSetc6tme4eL8Pf8a5Yd/edit', NULL, '[]', 14, 7, 'Approved by Reviewer', 'ashdashdlklasnd akjswdbasd', '2026-09-15 15:53:16', '2026-09-15 16:19:30', 'Memorandum', '2026-09-15 16:19:30', NULL),
(113, 27, 'Philippine National Action Plan on Women, Peace and Security', 'Matt Andrei Gallamos', 'https://docs.google.com/document/d/1Zha9uZJyytF7WSetc6tme4eL8Pf8a5Yd/edit', NULL, '[]', NULL, 5, 'Complete', NULL, '2026-09-15 16:08:05', '2026-09-29 13:42:14', 'Memorandum', '2026-09-29 13:42:14', NULL),
(114, 15, 'LTIA', 'Jan Mikhail Kimayong', 'https://docs.google.com/document/d/1BjVj4rJ39r36quu7QMgOxFpn6oiY4Edw/edit?rtpof=true', NULL, '[]', 15, 5, 'Revision Required', 'remove \"..for clarification.. thank you', '2026-09-24 14:19:09', '2026-10-08 07:55:33', 'Memorandum', '2026-10-08 07:55:33', NULL),
(115, 27, '2026 LG Month Confirmatory Slip', 'Matt Andrei Gallamos', 'https://docs.google.com/document/d/1B1RFia7ca4ULskmECFlDYbNZ1TYVAMNS/edit', NULL, '[]', 27, 5, 'Revision Required', 'pls see comment', '2026-09-28 07:55:43', '2026-09-28 09:55:22', 'Advisory', NULL, NULL),
(116, 27, '2026 LG Month Confirmatory Form', 'Matt Andrei Gallamos', 'https://docs.google.com/forms/d/1-2ftVc4vNhezF8HfQSMmSvPkbTtrKz_mw8GaRYB08RE/edit', NULL, '[]', 27, 5, 'Revision Required', 'Put the details we talked about', '2026-09-28 09:03:15', '2026-09-28 10:01:52', 'Memorandum', NULL, NULL),
(117, 27, '2026 LG Month Invitation Letter', 'Matt Andrei Gallamos', 'https://docs.google.com/document/d/1OveOORuHVEDaslSuVnVY6nhfU76qLraI/edit', 'w/ confirmatory link for confirmation slip', '[]', NULL, 5, 'Complete', 'Approved . For your review and approval Ma\'am', '2026-09-28 09:22:36', '2026-09-28 10:58:23', 'Memorandum', '2026-09-28 10:58:23', NULL),
(118, 27, 'For Dissemination: INVITATION TO THE 5TH E-LEARNING FOR LOCAL COUNCILS FOR THE PROTECTION OF CHILDREN (LCPCs) 2026 WEBINAR SERIES', 'Matt Andrei Gallamos', 'https://docs.google.com/document/d/1QvxFkfQHZyKVq4KLQGEmAOuoAO1ASfYr/edit', NULL, '[]', NULL, 5, 'Complete', NULL, '2026-09-29 09:08:30', '2026-09-29 13:48:30', 'Memorandum', '2026-09-29 13:48:30', NULL),
(119, 27, 'September 2026 Narrative Report and Other Letters for JRTF-ELCAC', 'Matt Andrei Gallamos', 'https://docs.google.com/document/d/1iP_TBp1je4dwokh7tNCfo3B6Jmr3p6A7Oab8ZxVgCSg/edit?usp=sharing', NULL, '[]', 27, 5, 'Revision Required', 'reviewed by me and noted by DC Jane', '2026-10-06 13:36:01', '2026-10-06 13:54:30', 'Memorandum', NULL, NULL),
(120, 15, 'PEO II TOR', 'Jan Mikhail Kimayong', 'https://docs.google.com/document/d/11PNVGdmuk4VzDToVdNXWwQ6_bBIh0fTu/edit', 'For Review', '[]', 11, 5, 'Pending Review', 'Comments are integrated', '2026-10-08 07:57:38', '2026-10-08 09:04:37', 'Memorandum', NULL, NULL),
(121, 15, 'Letter for Interviewer', 'Jan Mikhail Kimayong', 'https://docs.google.com/document/d/14cip1YZ2zEO-iHawmHi-PhWRw-aT_hpU/edit', 'For Review', '[]', 14, 5, 'Approved by Reviewer', NULL, '2026-10-08 07:58:12', '2026-10-08 08:54:52', 'Memorandum', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document_schedules`
--

CREATE TABLE `document_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('pending','completed','overdue') NOT NULL DEFAULT 'pending',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_schedules`
--

INSERT INTO `document_schedules` (`id`, `document_id`, `due_date`, `status`, `completed_at`, `created_at`, `updated_at`) VALUES
(240, 45, '2026-06-03', 'completed', '2026-06-09 16:57:19', '2026-05-12 15:14:12', '2026-06-09 16:57:19'),
(241, 45, '2026-07-03', 'overdue', NULL, '2026-05-12 15:14:12', '2026-07-08 09:13:01'),
(242, 45, '2026-08-03', 'overdue', NULL, '2026-05-12 15:14:12', '2026-08-04 14:25:10'),
(243, 45, '2026-09-03', 'overdue', NULL, '2026-05-12 15:14:12', '2026-09-04 22:44:28'),
(244, 45, '2026-10-05', 'overdue', NULL, '2026-05-12 15:14:12', '2026-10-06 13:30:44'),
(245, 45, '2026-11-03', 'pending', NULL, '2026-05-12 15:14:12', '2026-05-12 15:14:12'),
(246, 45, '2026-12-03', 'pending', NULL, '2026-05-12 15:14:12', '2026-05-12 15:14:12'),
(247, 45, '2027-01-04', 'pending', NULL, '2026-05-12 15:14:12', '2026-05-12 15:14:12'),
(248, 45, '2027-02-03', 'pending', NULL, '2026-05-12 15:14:12', '2026-05-12 15:14:12'),
(249, 45, '2027-03-03', 'pending', NULL, '2026-05-12 15:14:12', '2026-05-12 15:14:12'),
(250, 45, '2027-04-05', 'pending', NULL, '2026-05-12 15:14:12', '2026-05-12 15:14:12'),
(251, 45, '2027-05-03', 'pending', NULL, '2026-05-12 15:14:12', '2026-05-12 15:14:12'),
(253, 47, '2026-06-01', 'overdue', NULL, '2026-05-13 17:57:04', '2026-06-02 07:38:05'),
(268, 51, '2026-06-15', 'overdue', NULL, '2026-05-20 07:52:16', '2026-06-16 14:24:35'),
(269, 51, '2026-07-15', 'overdue', NULL, '2026-05-20 07:52:16', '2026-07-20 09:14:59'),
(270, 51, '2026-08-13', 'overdue', NULL, '2026-05-20 07:52:16', '2026-08-14 20:22:25'),
(271, 51, '2026-09-15', 'overdue', NULL, '2026-05-20 07:52:16', '2026-09-16 09:31:58'),
(272, 51, '2026-10-15', 'pending', NULL, '2026-05-20 07:52:16', '2026-05-20 07:52:16'),
(273, 51, '2026-11-12', 'pending', NULL, '2026-05-20 07:52:16', '2026-05-20 07:52:16'),
(274, 51, '2026-12-15', 'pending', NULL, '2026-05-20 07:52:16', '2026-05-20 07:52:16'),
(275, 51, '2027-01-14', 'pending', NULL, '2026-05-20 07:52:16', '2026-05-20 07:52:16'),
(276, 52, '2026-05-29', 'overdue', NULL, '2026-05-20 08:34:10', '2026-05-31 18:05:32'),
(277, 52, '2026-06-30', 'overdue', NULL, '2026-05-20 08:34:10', '2026-07-01 07:16:06'),
(278, 52, '2026-07-31', 'overdue', NULL, '2026-05-20 08:34:10', '2026-08-02 09:55:08'),
(279, 52, '2026-09-01', 'overdue', NULL, '2026-05-20 08:34:10', '2026-09-03 14:45:10'),
(280, 52, '2026-09-30', 'overdue', NULL, '2026-05-20 08:34:10', '2026-10-01 08:22:44'),
(281, 52, '2026-10-30', 'pending', NULL, '2026-05-20 08:34:10', '2026-05-20 08:34:10'),
(282, 52, '2026-12-01', 'pending', NULL, '2026-05-20 08:34:10', '2026-05-20 08:34:10'),
(283, 52, '2026-12-30', 'pending', NULL, '2026-05-20 08:34:10', '2026-05-20 08:34:10'),
(284, 52, '2027-01-29', 'pending', NULL, '2026-05-20 08:34:10', '2026-05-20 08:34:10'),
(292, 54, '2026-06-01', 'overdue', NULL, '2026-05-28 13:54:47', '2026-06-02 07:38:05'),
(293, 55, '2026-08-05', 'overdue', NULL, '2026-08-03 12:01:30', '2026-08-06 20:39:23'),
(294, 56, '2026-08-06', 'overdue', NULL, '2026-08-03 12:02:08', '2026-08-07 11:16:21'),
(295, 56, '2026-09-15', 'overdue', NULL, '2026-08-03 12:02:08', '2026-09-16 09:31:58'),
(296, 56, '2027-02-10', 'pending', NULL, '2026-08-03 12:02:08', '2026-08-03 12:02:08'),
(297, 56, '2027-07-14', 'pending', NULL, '2026-08-03 12:02:08', '2026-08-03 12:02:08'),
(298, 57, '2026-08-04', 'completed', '2026-08-03 17:29:23', '2026-08-03 17:18:40', '2026-08-03 17:29:23'),
(299, 58, '2026-08-27', 'overdue', NULL, '2026-08-03 17:25:01', '2026-08-31 23:53:10'),
(300, 59, '2026-08-11', 'completed', '2026-08-14 20:22:32', '2026-08-07 11:17:48', '2026-08-14 20:22:32'),
(301, 60, '2026-08-27', 'overdue', NULL, '2026-08-24 18:30:46', '2026-08-31 23:53:10'),
(302, 33, '2026-07-16', 'overdue', NULL, '2026-09-15 13:44:59', '2026-09-15 13:44:59'),
(303, 33, '2026-08-17', 'overdue', NULL, '2026-09-15 13:44:59', '2026-09-15 13:44:59'),
(304, 33, '2026-09-15', 'overdue', NULL, '2026-09-15 13:44:59', '2026-09-16 09:31:58'),
(305, 33, '2026-10-15', 'pending', NULL, '2026-09-15 13:44:59', '2026-09-15 13:44:59'),
(306, 33, '2026-11-16', 'pending', NULL, '2026-09-15 13:44:59', '2026-09-15 13:44:59'),
(307, 33, '2026-12-15', 'pending', NULL, '2026-09-15 13:44:59', '2026-09-15 13:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `document_workflow_logs`
--

CREATE TABLE `document_workflow_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `status_before` varchar(255) NOT NULL,
  `status_after` varchar(255) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `focal_person_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `visibility_type` enum('private','section','global') NOT NULL DEFAULT 'private',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `section_id`, `focal_person_id`, `title`, `link`, `type`, `location`, `notes`, `start_date`, `end_date`, `visibility_type`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'New Year\'s Day', NULL, 'holiday', NULL, 'New Year\'s Day on January 1 in the Gregorian calendar is a public holiday in the Philippines.', '2026-01-01 00:00:00', '2026-01-01 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(2, 1, NULL, NULL, 'Lailatul Isra Wal Mi Raj', NULL, 'holiday', NULL, 'Isra and Mi\'raj (Isra Me\'raj, Israa and Mi\'raaj, Laylat Al-Isra wa Al-Miraj, Lailat al Miraj, Night Journey and Ascension to Heaven) marks the night that the Prophet Mohammad traveled from Mecca to Jerusalem, ascended to heaven and returned.', '2026-01-16 00:00:00', '2026-01-16 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(3, 1, NULL, NULL, 'First Philippine Republic Day', NULL, 'holiday', NULL, 'First Philippine Republic Day is a special working day in Philippines', '2026-01-23 00:00:00', '2026-01-23 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(4, 1, NULL, NULL, 'Lunar New Year\'s Day', NULL, 'holiday', NULL, 'Lunar New Year is not considered an official holiday in the Philippines but it is widely celebrated, particularly in Chinese communities.', '2026-02-17 00:00:00', '2026-02-17 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(5, 1, NULL, NULL, 'Ramadan Start', NULL, 'holiday', NULL, 'Ramadan is a period of prayer, reflection and fasting for many Muslims worldwide. It is the ninth month in the Islamic calendar.', '2026-02-18 00:00:00', '2026-02-18 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(6, 1, NULL, NULL, 'People Power Anniversary', NULL, 'holiday', NULL, 'People Power Anniversary in the Philippines commemorates the successful non-violent demonstration in Manila in 1986 that saw a change of government for the nation.', '2026-02-25 00:00:00', '2026-02-25 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(7, 1, NULL, NULL, 'Eid al-Fitr', NULL, 'holiday', NULL, 'Eid al-Fitr is a holiday to mark the end of the Islamic month of Ramadan, during which Muslims fast during the hours of daylight.', '2026-03-20 00:00:00', '2026-03-20 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(8, 1, NULL, NULL, 'March Equinox', NULL, 'holiday', NULL, 'March Equinox in Philippines (Manila)', '2026-03-20 00:00:00', '2026-03-20 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(9, 1, NULL, NULL, 'Maundy Thursday', NULL, 'holiday', NULL, 'Maundy Thursday is part of the Holy Week tradition observed by most Filipinos.', '2026-04-02 00:00:00', '2026-04-02 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(10, 1, NULL, NULL, 'Good Friday', NULL, 'holiday', NULL, 'Good Friday is part of the Holy Week holiday in the Philippines.', '2026-04-03 00:00:00', '2026-04-03 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(11, 1, NULL, NULL, 'Black Saturday', NULL, 'holiday', NULL, 'Holy Saturday is the day before Easter Sunday.', '2026-04-04 00:00:00', '2026-04-04 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(12, 1, NULL, NULL, 'Easter Sunday', NULL, 'holiday', NULL, 'Easter Sunday commemorates Jesus Christ\'s resurrection, according to Christian belief.', '2026-04-05 00:00:00', '2026-04-05 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(13, 1, NULL, NULL, 'The Day of Valor', NULL, 'holiday', NULL, 'Araw ng Kagitingan, also known as the Day of Valor, annually falls on or around April 9 in the Philippines.', '2026-04-09 00:00:00', '2026-04-09 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(14, 1, NULL, NULL, 'Labor Day', NULL, 'holiday', NULL, 'Labor Day, International Workers\' Day, and May Day, is a day off for workers in many countries around the world.', '2026-05-01 00:00:00', '2026-05-01 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(15, 1, NULL, NULL, 'Eid al-Adha', NULL, 'holiday', NULL, 'Eid al-Adha (Id ul-Adha) is an Islamic festival falling on the 10th day of the month of Dhul Hijja (Thou al-Hijja) to commemorate the willingness of Ibrahim (Abraham) to sacrifice his son.', '2026-05-27 00:00:00', '2026-05-27 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(16, 1, NULL, NULL, 'Eid al-Adha Day 2', NULL, 'holiday', NULL, 'Eid al-Adha Day 2 is a Muslim holiday and common local holiday in Philippines', '2026-05-28 00:00:00', '2026-05-28 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(17, 1, NULL, NULL, 'Independence Day', NULL, 'holiday', NULL, 'The Philippine\'s Independence day is a large celebratory event held across the country on June 12 each year.', '2026-06-12 00:00:00', '2026-06-12 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(18, 1, NULL, NULL, 'Amun Jadid', NULL, 'holiday', NULL, 'Muharram is the first month of the Islamic calendar and a time of remembrance or mourning.', '2026-06-17 00:00:00', '2026-06-17 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(19, 1, NULL, NULL, 'June Solstice', NULL, 'holiday', NULL, 'June Solstice in Philippines (Manila)', '2026-06-21 00:00:00', '2026-06-21 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(20, 1, NULL, NULL, 'Founding Anniversary of Iglesia ni Cristo', NULL, 'holiday', NULL, 'Founding Anniversary of Iglesia ni Cristo is a special working day in Philippines', '2026-07-27 00:00:00', '2026-07-27 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(21, 1, NULL, NULL, 'Ninoy Aquino Day', NULL, 'holiday', NULL, 'Ninoy Aquino Day is a special non-working holiday in Philippines', '2026-08-21 00:00:00', '2026-08-21 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(22, 1, NULL, NULL, 'Maulid un-Nabi', NULL, 'holiday', NULL, 'Mawlid, or Milad, marks the birth of the Islamic prophet Muhammed, or Mohamed, in the year 570 of the Gregorian calendar.', '2026-08-26 00:00:00', '2026-08-26 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(23, 1, NULL, NULL, 'National Heroes Day', NULL, 'holiday', NULL, 'National Heroes Day is a regular holiday in Philippines', '2026-08-31 00:00:00', '2026-08-31 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(24, 1, NULL, NULL, 'Yamashita Surrender Day', NULL, 'holiday', NULL, 'Yamashita Surrender Day is a special working day in Philippines', '2026-09-03 00:00:00', '2026-09-03 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(25, 1, NULL, NULL, 'Feast of the Nativity of Mary', NULL, 'holiday', NULL, 'Feast of the Nativity of Mary is a special working day in Philippines', '2026-09-08 00:00:00', '2026-09-08 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(26, 1, NULL, NULL, 'September Equinox', NULL, 'holiday', NULL, 'September Equinox in Philippines (Manila)', '2026-09-23 00:00:00', '2026-09-23 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(27, 1, NULL, NULL, 'All Saints\' Day', NULL, 'holiday', NULL, 'Many churches honor all their saints on All Saints\' Day, also known as All Hallows\' Day.', '2026-11-01 00:00:00', '2026-11-01 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(28, 1, NULL, NULL, 'All Souls\' Day', NULL, 'holiday', NULL, 'All Souls\' Day falls on November 2 each year. It is a day of alms giving and prayers for the dead.', '2026-11-02 00:00:00', '2026-11-02 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(30, 1, NULL, NULL, 'Bonifacio Day', NULL, 'holiday', NULL, 'Bonifacio Day is a regular holiday in Philippines', '2026-11-30 00:00:00', '2026-11-30 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(31, 1, NULL, NULL, 'Feast of the Immaculate Conception', NULL, 'holiday', NULL, 'The Feast of the Immaculate Conception is a Christian observance on December 8 each year.', '2026-12-08 00:00:00', '2026-12-08 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(32, 1, NULL, NULL, 'December Solstice', NULL, 'holiday', NULL, 'December Solstice in Philippines (Manila)', '2026-12-22 00:00:00', '2026-12-22 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(33, 1, NULL, NULL, 'Christmas Eve', NULL, 'holiday', NULL, 'Christmas Eve is the day before Christmas Day and falls on December 24 in the Gregorian calendar.', '2026-12-24 00:00:00', '2026-12-24 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(34, 1, NULL, NULL, 'Christmas Day', NULL, 'holiday', NULL, 'Christmas Day is one of the biggest Christian celebrations and falls on December 25 in the Gregorian calendar.', '2026-12-25 00:00:00', '2026-12-25 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(35, 1, NULL, NULL, 'Rizal Day', NULL, 'holiday', NULL, 'Rizal Day is a regular holiday in Philippines', '2026-12-30 00:00:00', '2026-12-30 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(36, 1, NULL, NULL, 'New Year\'s Eve', NULL, 'holiday', NULL, 'New Year\'s Eve is the last day of the year, December 31, in the Gregorian calendar.', '2026-12-31 00:00:00', '2026-12-31 23:59:59', 'global', '2026-05-04 13:14:30', '2026-05-04 13:14:30'),
(41, 1, NULL, NULL, 'QMS', NULL, 'event', NULL, NULL, '2026-05-05 10:00:00', '2026-05-05 17:00:00', 'global', '2026-05-05 14:40:07', '2026-05-07 07:47:54'),
(44, 1, NULL, NULL, 'PRAISE TWG Meeting', NULL, 'event', NULL, NULL, '2026-05-07 08:00:00', '2026-05-07 22:00:00', 'global', '2026-05-05 14:43:20', '2026-05-07 07:52:37'),
(52, 13, NULL, NULL, 'Bable RSC Meeting', NULL, 'event', 'PROCAR Camp Dangwa', NULL, '2026-05-14 08:00:00', '2026-05-14 17:00:00', 'global', '2026-05-07 10:06:29', '2026-05-07 10:06:55'),
(53, 13, NULL, NULL, 'RMR', NULL, 'event', NULL, NULL, '2026-05-18 08:00:00', '2026-05-18 17:00:00', 'global', '2026-05-07 10:08:01', '2026-05-07 10:08:01'),
(54, 13, NULL, NULL, 'DC and ADC BAC Meeting', NULL, 'event', 'DILG-CAR Conference Hall', NULL, '2026-05-11 08:00:00', '2026-05-11 17:00:00', 'global', '2026-05-09 06:11:55', '2026-05-09 06:11:55'),
(61, 17, 3, 17, 'Regional Inter-Agency Committee (RIAC) Meeting', NULL, 'offsite', 'DSWD Training Center', 'Office Order No. 005.085.2026', '2026-05-14 08:00:00', '2026-05-14 17:00:00', 'section', '2026-05-12 10:48:13', '2026-05-12 18:10:36'),
(62, 20, 4, 19, 'MELPIPRO', NULL, 'offsite', 'Benguet', NULL, '2026-05-21 08:00:00', '2026-05-21 17:00:00', 'section', '2026-05-12 15:51:02', '2026-05-12 16:02:03'),
(63, 20, 5, 11, 'LALA 2nd Quarter ICAD Rehabilitation and Reintegration Cluster Meeting', NULL, 'offsite', 'Ritz Hotel', 'together with Nikko May Gunday', '2026-05-21 08:00:00', '2026-05-21 17:00:00', 'section', '2026-05-12 16:01:26', '2026-05-21 08:17:28'),
(66, 20, 4, 19, 'RCDA Meeting', NULL, 'offsite', 'Dontogan, Baguio City', NULL, '2026-05-13 08:00:00', '2026-05-13 17:00:00', 'section', '2026-05-12 16:05:54', '2026-05-12 16:05:54'),
(72, 20, 7, NULL, 'PSA Zoom Meeting', NULL, 'event', NULL, NULL, '2026-05-19 08:00:00', '2026-05-21 17:00:00', 'section', '2026-05-13 07:30:35', '2026-05-13 07:30:35'),
(74, 20, 3, 21, 'CIPC Meeting', NULL, 'offsite', 'Zoom Meeting', 'https://bit.ly/2QCIPC', '2026-05-21 08:00:00', '2026-05-21 17:00:00', 'section', '2026-05-13 09:12:44', '2026-05-20 17:44:20'),
(75, 6, NULL, NULL, 'OJT Turnover and Send  Off', NULL, 'event', NULL, NULL, '2026-05-14 13:00:00', '2026-05-14 18:00:00', 'global', '2026-05-13 09:38:02', '2026-05-13 09:55:05'),
(76, 20, 3, 21, '2ND QUARTER 2026 MEETINGS OF THE RSDC', NULL, 'offsite', 'CSITE, Military Cut-off, Baguio City', NULL, '2026-05-19 08:00:00', '2026-05-19 17:00:00', 'section', '2026-05-13 13:28:00', '2026-05-13 13:28:00'),
(78, 20, 4, 19, 'RETOOLING OF THE CURRENT CSIS FRAMEWORK AND THE NEW COMMUNITY GRANT FUND (CGF)', NULL, 'offsite', 'Zoom MeetingZ', NULL, '2026-05-20 08:00:00', '2026-05-21 17:00:00', 'section', '2026-05-13 17:28:24', '2026-05-13 17:28:24'),
(88, 17, 3, 17, 'IAN ASEAN Regional Consultation Program on Strengthening Alternative Family-Based Care Systems', NULL, 'offsite', 'Zoom Platform', 'Zoom Link:\r\nhttps://us06web.zoom.us/j/89621770314?pwd=5OMBCwzack4pl2LVDdpF0FSaWBHDRx.1\r\n\r\nMeeting ID: 896 2177 0314\r\nPasscode: 890820\r\n\r\n*Alex Ian A. Pacis, Jr. will also attend the activity.', '2026-05-26 08:00:00', '2026-05-26 17:00:00', 'section', '2026-05-14 16:53:00', '2026-05-25 17:01:52'),
(89, 20, NULL, NULL, 'PRAISE  Meeting', NULL, 'event', NULL, NULL, '2026-05-19 08:00:00', '2026-05-19 17:00:00', 'global', '2026-05-18 14:34:09', '2026-05-18 14:34:09'),
(90, 20, 3, 21, 'Regional Rabies Meeting', NULL, 'offsite', 'Hotel Tugos, Baguio City', NULL, '2026-06-03 08:00:00', '2026-06-03 17:00:00', 'section', '2026-05-18 18:08:32', '2026-05-18 18:08:32'),
(91, 20, 3, 21, '2nd RCACL Quarterly Meeting', NULL, 'offsite', 'To be Arranged', NULL, '2026-05-25 08:00:00', '2026-05-25 17:00:00', 'section', '2026-05-18 18:09:49', '2026-05-21 16:39:52'),
(92, 20, 3, 21, 'RSDC Meeting', NULL, 'offsite', 'Baguio City', NULL, '2026-05-19 08:00:00', '2026-05-19 17:00:00', 'section', '2026-05-18 18:10:59', '2026-05-18 18:11:06'),
(93, 20, 2, 13, 'Regional Oversight Committee on Barangay Drug Clearing Deliberation', NULL, 'offsite', 'PDEA-CAR', NULL, '2026-05-19 08:00:00', '2026-05-19 17:00:00', 'section', '2026-05-18 18:16:18', '2026-05-18 18:16:18'),
(94, 10, NULL, NULL, 'PSCP TWG Meeting (OPCEN) - Nikko', NULL, 'event', NULL, NULL, '2026-05-20 08:00:00', '2026-05-20 17:00:00', 'global', '2026-05-19 08:02:51', '2026-05-19 08:03:56'),
(95, 18, NULL, NULL, 'DILG LED CLUSTER MEETING', 'https://drive.google.com/drive/folders/1Nv3vuv4sZU2JIeVeQXGaToU4bkP_hsHP?usp=drive_link', 'event', NULL, NULL, '2026-05-07 08:00:00', '2026-05-07 17:00:00', 'global', '2026-05-19 15:55:28', '2026-05-19 15:55:28'),
(96, 20, 4, 19, 'HERALD JHOSHUA ATTENDANCE TO 2025 NDHS', NULL, 'offsite', 'Lafaayette Hotel', 'with Jhosua', '2026-05-26 08:00:00', '2026-05-26 17:00:00', 'section', '2026-05-20 08:07:20', '2026-05-25 17:01:34'),
(97, 20, 4, 19, 'HERALD - LCAT-VAWC on-site Assessment', NULL, 'offsite', 'Ifugao', NULL, '2026-06-08 08:00:00', '2026-06-08 17:00:00', 'section', '2026-05-20 08:08:24', '2026-05-26 10:09:24'),
(98, 20, 4, 19, 'LCAT-VAWC on-site Assessment', NULL, 'offsite', 'Mountain Province', NULL, '2026-06-09 08:00:00', '2026-06-09 17:00:00', 'section', '2026-05-20 08:09:05', '2026-05-20 08:09:05'),
(99, 20, 4, 19, 'HERALD - LCAT-VAWC on-site Assessment', NULL, 'offsite', 'Abra', NULL, '2026-06-11 08:00:00', '2026-06-11 17:00:00', 'section', '2026-05-20 08:09:20', '2026-05-26 10:09:30'),
(100, 20, 4, 19, 'HERALD - LCAT-VAWC on-site Assessment', NULL, 'offsite', 'Apayao', NULL, '2026-06-16 08:00:00', '2026-06-16 17:00:00', 'section', '2026-05-20 08:09:32', '2026-05-26 10:09:47'),
(101, 20, 4, 19, 'HERALD - LCAT-VAWC on-site Assessment', NULL, 'offsite', 'Kalinga', NULL, '2026-06-18 08:00:00', '2026-06-18 17:00:00', 'section', '2026-05-20 08:09:43', '2026-05-26 10:09:54'),
(102, 20, 4, 19, 'HERALD - LCAT-VAWC on-site Assessment', NULL, 'offsite', 'Baguio City', NULL, '2026-06-29 08:00:00', '2026-06-29 17:00:00', 'section', '2026-05-20 08:09:55', '2026-05-26 10:11:14'),
(103, 20, 4, 19, 'HERALD - LCAT-VAWC on-site Assessment', NULL, 'offsite', 'Benguet', NULL, '2026-06-30 08:00:00', '2026-06-30 17:00:00', 'section', '2026-05-20 08:10:07', '2026-05-26 10:10:38'),
(104, 17, 3, 17, '2026 2nd Quarter Regional Implementation and Coordination Team Meeting', NULL, 'offsite', 'Google Meet', 'Link: http://meet.google.com/hae-zogn-zee', '2026-05-21 13:30:00', '2026-05-21 17:00:00', 'section', '2026-05-20 08:28:06', '2026-05-20 08:28:06'),
(106, 20, 5, 22, 'PRINCES Agriculture Committee 2026 2nd Quarter Meeting', NULL, 'offsite', 'DA-RFO-CAR', NULL, '2026-05-26 08:00:00', '2026-05-26 17:00:00', 'section', '2026-05-20 14:56:27', '2026-05-25 17:03:11'),
(107, 13, 2, 13, 'BAC Pre Bid Conference', NULL, 'offsite', 'DILG CAR', 'Procurement of Security Services of DILG-CAR', '2026-05-22 08:00:00', '2026-05-22 17:00:00', 'section', '2026-05-20 15:41:35', '2026-05-20 15:41:35'),
(108, 13, 2, 13, 'BAC Opening of Bids', NULL, 'offsite', 'DILG CAR', 'Procurement of Security Services for DILG-CAR', '2026-06-03 09:00:00', '2026-06-03 17:00:00', 'section', '2026-05-20 15:43:38', '2026-05-20 15:43:38'),
(109, 13, 2, 13, 'BAC Bid Evaluation', NULL, 'offsite', 'DILG CAR', 'Procurement of Security Services', '2026-06-03 08:00:00', '2026-06-04 17:00:00', 'section', '2026-05-20 15:44:46', '2026-05-20 15:44:46'),
(110, 13, 8, 1, 'BABLE- PRAISE Onsite Apayao', NULL, 'offsite', 'Apayao', 'RO No. 207-2026', '2026-06-02 08:00:00', '2026-06-02 17:00:00', 'section', '2026-05-20 15:46:04', '2026-06-01 09:53:11'),
(115, 17, 3, 17, 'IAN - Wellness Leave', NULL, 'leave', NULL, NULL, '2026-06-04 08:00:00', '2026-06-04 17:00:00', 'section', '2026-05-20 16:02:38', '2026-06-02 15:03:13'),
(116, 17, 3, 17, 'IAN - Wellness Leave', NULL, 'leave', NULL, NULL, '2026-06-15 08:00:00', '2026-06-15 17:00:00', 'section', '2026-05-20 16:03:18', '2026-06-02 15:03:00'),
(122, 20, 3, 17, 'Ian 1st Semester PYDP RIAC Meeting', NULL, 'offsite', 'Benguet', NULL, '2026-06-11 08:00:00', '2026-06-11 17:00:00', 'section', '2026-05-20 17:53:07', '2026-05-21 08:06:58'),
(123, 20, 2, 13, 'BABLE PRESENTATION AND FINALIZATION OF THE DRAFT REVISED DILG-CAR PUBLIC SERVICE CONTINUITY PLAN', NULL, 'offsite', 'RO', NULL, '2026-05-26 08:00:00', '2026-05-26 17:00:00', 'section', '2026-05-20 17:54:36', '2026-05-25 17:03:40'),
(133, 20, NULL, NULL, 'JEM,LALA,HERALD - National Online Webinar on SCPF', NULL, 'event', 'Zoom Meeting', NULL, '2026-05-26 08:00:00', '2026-05-26 17:00:00', 'global', '2026-05-21 16:43:00', '2026-05-21 16:43:00'),
(140, 20, 7, 15, 'JM - PRAISE Onsite APAYAO', NULL, 'offsite', 'Apayao', NULL, '2026-06-02 08:00:00', '2026-06-04 17:00:00', 'section', '2026-05-25 08:58:25', '2026-05-25 08:58:25'),
(147, 13, 2, 13, 'BABLE:  QMSA COMM Zoom Mtng', NULL, 'offsite', 'RO', 'via ZOOM', '2026-06-02 09:00:00', '2026-06-02 17:00:00', 'section', '2026-05-25 13:56:29', '2026-05-25 13:56:29'),
(148, 7, 7, 7, 'Jhosua', NULL, 'leave', NULL, NULL, '2026-05-28 08:00:00', '2026-05-28 17:00:00', 'section', '2026-05-25 17:15:28', '2026-05-25 17:15:28'),
(149, 7, 5, 10, 'Nikko', NULL, 'leave', NULL, NULL, '2026-05-28 08:00:00', '2026-05-28 17:00:00', 'section', '2026-05-25 17:15:57', '2026-05-25 17:15:57'),
(150, 20, 5, 20, 'Prince Wellness Leave', NULL, 'leave', NULL, NULL, '2026-06-01 08:00:00', '2026-06-01 17:00:00', 'section', '2026-05-26 08:12:42', '2026-05-26 08:12:42'),
(151, 15, NULL, NULL, 'ALL LGOOs  KP Law Training', NULL, 'event', 'DILG CAR', 'with LGMED Available', '2026-06-09 08:00:00', '2026-06-10 17:00:00', 'global', '2026-05-26 08:12:47', '2026-05-26 17:33:36'),
(152, 20, 7, 7, 'JHOSUA - PRAISE APAYAO', NULL, 'offsite', 'Apayao', NULL, '2026-06-02 08:00:00', '2026-06-04 17:00:00', 'section', '2026-05-26 08:13:30', '2026-05-26 08:13:30'),
(157, 20, 7, 7, 'JHOSUA - PRAISE ABRA', NULL, 'offsite', 'ABRA', NULL, '2026-06-08 08:00:00', '2026-06-10 17:00:00', 'section', '2026-05-26 08:16:54', '2026-05-26 08:16:54'),
(158, 20, 7, 15, 'JM - PRAISE ABRA', NULL, 'offsite', 'ABRA', NULL, '2026-06-08 08:00:00', '2026-06-10 17:00:00', 'section', '2026-05-26 08:17:12', '2026-05-26 08:17:12'),
(159, 20, 2, 13, 'BABLE - PRAISE MP', NULL, 'offsite', 'Mountain Province', NULL, '2026-06-15 08:00:00', '2026-06-17 17:00:00', 'section', '2026-05-26 08:17:41', '2026-05-26 08:17:41'),
(160, 20, 7, 7, 'JHOSUA - PRAISE MP', NULL, 'offsite', 'Mountain Province', NULL, '2026-06-15 08:00:00', '2026-06-17 17:00:00', 'section', '2026-05-26 08:18:05', '2026-05-26 08:18:05'),
(161, 20, 7, 15, 'JM - PRAISE MP', NULL, 'offsite', 'Mountain Province', NULL, '2026-06-15 08:00:00', '2026-06-17 17:00:00', 'section', '2026-05-26 08:18:31', '2026-05-26 08:18:31'),
(163, 20, 7, 7, 'JHOSUA - PRAISE KALINGA', NULL, 'offsite', 'Kalinga', NULL, '2026-06-18 08:00:00', '2026-06-19 17:00:00', 'section', '2026-05-26 08:19:22', '2026-05-26 08:19:22'),
(164, 20, 7, 15, 'JM - PRAISE KALAINGA', NULL, 'offsite', 'Kalinga', NULL, '2026-06-18 08:00:00', '2026-06-19 17:00:00', 'section', '2026-05-26 08:19:46', '2026-05-26 08:19:46'),
(165, 20, 2, 13, 'BABLE - PRAISE BENGUET', NULL, 'offsite', 'Benguet', NULL, '2026-06-22 08:00:00', '2026-06-22 17:00:00', 'section', '2026-05-26 08:20:07', '2026-05-26 08:20:07'),
(166, 20, 7, 15, 'JM - PRAISE BENGUET', NULL, 'offsite', 'Benguet', NULL, '2026-06-22 08:00:00', '2026-06-22 17:00:00', 'section', '2026-05-26 08:20:31', '2026-05-26 08:20:31'),
(167, 13, 2, 13, 'DC & ADC BAC', NULL, 'offsite', 'RO', NULL, '2026-05-26 15:30:00', '2026-05-26 17:00:00', 'section', '2026-05-26 08:20:42', '2026-05-26 08:20:42'),
(168, 20, 2, 13, 'BABLE - PRAISE RO', NULL, 'offsite', 'RO', NULL, '2026-06-23 08:00:00', '2026-06-23 17:00:00', 'section', '2026-05-26 08:20:46', '2026-05-26 08:20:46'),
(169, 20, 7, 15, 'JM - PRAISE BAGUIO', NULL, 'offsite', 'Baguio City', NULL, '2026-06-24 08:00:00', '2026-06-24 17:00:00', 'section', '2026-05-26 08:21:16', '2026-05-26 08:21:16'),
(170, 20, 1, 14, 'DC - MSAC Meeting', NULL, 'offsite', 'RO', NULL, '2026-06-11 08:00:00', '2026-06-11 17:00:00', 'section', '2026-05-26 17:58:49', '2026-05-26 17:58:49'),
(171, 10, 5, 10, 'On leave', NULL, 'leave', NULL, NULL, '2026-06-01 08:00:00', '2026-06-01 17:00:00', 'section', '2026-05-27 06:44:19', '2026-05-27 06:44:19'),
(172, 11, 5, 11, 'Lala on leave', NULL, 'leave', NULL, NULL, '2026-05-19 08:00:00', '2026-05-19 17:00:00', 'section', '2026-05-28 07:47:44', '2026-05-28 07:47:44'),
(173, 11, 5, 11, 'Lala on Leave', NULL, 'leave', NULL, NULL, '2026-05-14 08:00:00', '2026-05-14 17:00:00', 'section', '2026-05-28 07:48:09', '2026-05-28 07:48:09'),
(174, 20, NULL, NULL, 'POC Audit', NULL, 'event', 'RO', NULL, '2026-06-22 08:00:00', '2026-06-24 17:00:00', 'global', '2026-05-28 07:58:21', '2026-05-28 07:58:21'),
(176, 20, NULL, NULL, '2ND QUARTER CRPOC MEETING', NULL, 'event', 'Newtown Plaza Hotel', NULL, '2026-06-18 08:00:00', '2026-06-18 17:00:00', 'global', '2026-05-28 07:59:41', '2026-06-11 08:18:15'),
(178, 20, NULL, NULL, 'KP LAW MEETING', NULL, 'event', NULL, NULL, '2026-06-09 08:00:00', '2026-06-10 17:00:00', 'global', '2026-05-28 08:00:44', '2026-05-28 08:00:44'),
(179, 20, NULL, NULL, 'ICAD 2ND QUARTER MEETING', NULL, 'event', NULL, NULL, '2026-06-29 08:00:00', '2026-06-29 17:00:00', 'global', '2026-05-28 08:01:05', '2026-05-28 08:01:05'),
(180, 20, NULL, NULL, 'ECLIP RIA', NULL, 'event', NULL, NULL, '2026-06-30 08:00:00', '2026-07-02 17:00:00', 'global', '2026-05-28 08:01:16', '2026-05-28 08:01:16'),
(181, 20, 3, 17, 'IAN - LCAT-VAWC', NULL, 'offsite', 'Pampanga', NULL, '2026-06-09 08:00:00', '2026-06-10 17:00:00', 'section', '2026-05-28 08:03:46', '2026-05-28 08:03:46'),
(182, 20, NULL, NULL, 'POC Pre-Assessment', NULL, 'event', NULL, NULL, '2026-06-01 08:00:00', '2026-06-03 17:00:00', 'global', '2026-05-28 08:06:15', '2026-05-28 08:06:15'),
(183, 13, 2, 13, 'BABLE SPL', NULL, 'leave', NULL, NULL, '2026-05-28 08:00:00', '2026-05-28 17:00:00', 'section', '2026-05-28 08:17:43', '2026-05-28 08:17:43'),
(184, 20, 1, 14, 'DC JANE - RSCWC,RJJWC,RCAT-VAWC  2ND QUARTER JOINT INTERAGENCY MEETING', NULL, 'offsite', 'Function Hall, National Telecommunications Commission (NTC)- CAR, Leornard Wood, Baguio City', NULL, '2026-06-24 08:00:00', '2026-06-24 17:00:00', 'section', '2026-05-28 09:35:32', '2026-05-28 09:35:32'),
(187, 20, NULL, NULL, 'TUON Training \"CollabWorks: Creating Inclusive and Connected Workplaces\"', NULL, 'event', NULL, NULL, '2026-06-03 08:00:00', '2026-06-03 17:00:00', 'global', '2026-05-28 13:41:29', '2026-05-28 13:41:29'),
(188, 20, 5, 22, 'PRINCES ON LEAVE', NULL, 'leave', NULL, NULL, '2026-06-01 08:00:00', '2026-06-01 17:00:00', 'section', '2026-05-28 17:59:52', '2026-05-28 17:59:52'),
(189, 13, 5, 10, 'NIKKO LEAVE', NULL, 'leave', NULL, NULL, '2026-06-01 08:00:00', '2026-06-01 17:00:00', 'section', '2026-06-01 07:34:35', '2026-06-01 07:34:35'),
(190, 14, 1, 14, 'force leave - DC Jane', NULL, 'leave', NULL, NULL, '2026-06-15 08:00:00', '2026-06-15 17:00:00', 'section', '2026-06-01 16:45:01', '2026-06-01 16:45:43'),
(191, 14, 1, 14, 'force leave DC Jane', NULL, 'leave', NULL, NULL, '2026-06-15 08:00:00', '2026-06-18 17:00:00', 'section', '2026-06-01 16:49:44', '2026-06-01 16:49:44'),
(192, 13, 2, 13, 'BABLE PRAISE IFUGAO/', NULL, 'offsite', 'Ifugao', NULL, '2026-06-08 08:00:00', '2026-06-08 17:00:00', 'section', '2026-06-08 09:07:55', '2026-06-08 09:07:55'),
(193, 13, 2, 13, 'BABLE PRAISE IFUGAO/', NULL, 'offsite', 'Ifugao', NULL, '2026-06-08 08:00:00', '2026-06-08 17:00:00', 'section', '2026-06-08 09:07:56', '2026-06-08 09:07:56'),
(194, 20, 3, 21, 'JEM 0 CPD WORKSHOP', NULL, 'offsite', 'New Rajah Soliman Hotel', NULL, '2026-06-09 08:00:00', '2026-06-11 17:00:00', 'section', '2026-06-08 10:26:48', '2026-06-08 10:26:48'),
(195, 20, 5, 20, 'PRINCE - CPD WORKSHOP', NULL, 'offsite', 'New Rajah Soliman Hotel', NULL, '2026-06-09 08:00:00', '2026-06-11 17:00:00', 'section', '2026-06-08 10:27:01', '2026-06-08 10:27:01'),
(196, 20, 5, 11, 'LALA - LGU PROFILING', NULL, 'offsite', 'NENE HALL', NULL, '2026-06-11 08:00:00', '2026-06-11 17:00:00', 'section', '2026-06-08 10:27:36', '2026-06-08 10:27:36'),
(197, 20, 3, 21, 'JEM - SEARCH FOR BEST PESO', NULL, 'offsite', 'Baguio City', 'From June 18 moved to June 23', '2026-06-23 08:00:00', '2026-06-23 17:00:00', 'section', '2026-06-08 10:28:16', '2026-06-11 09:03:32'),
(198, 20, 3, 17, 'IAN - 1ST BIAG PROJECT LAUNCH AND INTERAGENCY COORDINATION MEETING', NULL, 'offsite', 'DOH-CAR', 'Office Order No. 006.110.2026', '2026-06-18 08:00:00', '2026-06-18 17:00:00', 'section', '2026-06-08 10:28:40', '2026-06-16 18:52:36'),
(201, 20, 5, 20, 'PRINCE - RCSP APAYAO', NULL, 'offsite', 'CONNER, APAYAO', NULL, '2026-06-21 08:00:00', '2026-06-25 17:00:00', 'section', '2026-06-08 10:30:30', '2026-06-08 10:30:30'),
(202, 20, 3, 17, 'IAN - RCSP APAYAO', NULL, 'offsite', 'CONNER, APAYAO', NULL, '2026-06-21 08:00:00', '2026-06-25 17:00:00', 'section', '2026-06-08 10:31:35', '2026-06-08 10:31:35'),
(203, 20, 5, 18, 'JOANA - RCSP APAYAO', NULL, 'offsite', 'CONNER, APAYAO', NULL, '2026-06-21 08:00:00', '2026-06-25 17:00:00', 'section', '2026-06-08 10:31:55', '2026-06-08 10:31:55'),
(204, 14, 1, 14, 'Retooling Part II on Legal matters', NULL, 'offsite', 'Nene Pimentel Hall', NULL, '2026-06-24 08:00:00', '2026-06-25 17:00:00', 'section', '2026-06-08 14:57:00', '2026-06-08 14:57:00'),
(206, 7, NULL, NULL, 'Cordillera Day', NULL, 'holiday', NULL, NULL, '2026-07-15 08:00:00', '2026-07-15 17:00:00', 'global', '2026-06-11 08:32:40', '2026-06-11 08:32:40'),
(207, 20, NULL, NULL, 'IPEYAS - ANTI-DRUG', NULL, 'event', NULL, NULL, '2026-07-28 08:00:00', '2026-07-28 17:00:00', 'global', '2026-06-16 10:08:52', '2026-06-16 10:12:40'),
(208, 20, 4, 19, 'HERALD-CONSULTATION FOR THE 2025 IMPLEMENTATION OF THE CSIS', NULL, 'offsite', 'ZOOM', NULL, '2026-06-25 08:00:00', '2026-06-25 17:00:00', 'section', '2026-06-16 10:10:04', '2026-06-16 10:10:04'),
(209, 20, 4, 19, 'HERALD - INTERAGENCY MEETING EREIDS', NULL, 'offsite', 'DOH-CAR', NULL, '2026-06-25 08:00:00', '2026-06-25 17:00:00', 'section', '2026-06-16 10:12:21', '2026-06-16 10:12:21'),
(211, 22, NULL, NULL, 'CHR Multi-stakeholders dialogue', NULL, 'event', 'Baguio City', NULL, '2026-06-25 08:00:00', '2026-06-25 17:00:00', 'global', '2026-06-17 12:28:45', '2026-06-17 12:28:45'),
(212, 14, 1, 14, 'DC JANE - 12th RHRMSPB', NULL, 'offsite', 'Nene Pimentel Hall', NULL, '2026-06-22 08:00:00', '2026-06-23 17:00:00', 'section', '2026-06-23 08:31:04', '2026-06-23 08:31:04'),
(213, 14, 1, 14, 'DC-13 RHRMSPB', NULL, 'offsite', 'via Zoom', NULL, '2026-06-29 14:20:00', '2026-06-29 17:00:00', 'section', '2026-06-29 11:48:35', '2026-06-29 11:48:35'),
(214, 20, NULL, NULL, '2nd Goodyernong Talakayan: Sharing of Learning and Experiences via Zoom', NULL, 'event', 'Zoom Meeting', NULL, '2026-07-09 08:00:00', '2026-07-09 17:00:00', 'global', '2026-06-30 08:54:43', '2026-06-30 08:54:43'),
(215, 13, 2, 13, 'BABLE BFP-CAR RPSB Final Interview', NULL, 'offsite', 'BFP-CAR, La Chesa Road, Purok 4, Irisan, Baguio City', 'OO No. 006-128-2026', '2026-07-02 08:00:00', '2026-07-02 17:00:00', 'section', '2026-07-01 18:25:54', '2026-07-01 18:25:54'),
(216, 13, NULL, NULL, 'LALA & NIKKO Flag Raising and MonCon', NULL, 'event', NULL, NULL, '2026-07-06 08:00:00', '2026-07-06 17:00:00', 'global', '2026-07-01 18:26:58', '2026-07-01 18:26:58'),
(217, 13, NULL, NULL, 'PRINCES & JOSH Flag Raising and MonCon', NULL, 'event', NULL, NULL, '2026-07-13 08:00:00', '2026-07-13 17:00:00', 'global', '2026-07-01 18:27:55', '2026-07-01 18:27:55'),
(218, 13, NULL, NULL, 'JEM & IAN Flag Raising & MonCon', NULL, 'event', NULL, NULL, '2026-07-20 08:00:00', '2026-07-20 17:00:00', 'global', '2026-07-01 18:28:26', '2026-07-01 18:28:26'),
(219, 13, NULL, NULL, 'ALLAN & HERALD Flag Raising and MonCon', NULL, 'event', 'Big Hall, H100 Ecolodge, Magsaysay Avenue, Baguio City', NULL, '2026-07-27 08:00:00', '2026-07-27 17:00:00', 'global', '2026-07-01 18:28:56', '2026-07-23 18:17:59'),
(220, 13, 2, 13, 'PRAISE TWG MTNG', NULL, 'offsite', 'DILG CAR', '10:30AM\r\nHerald, Jhoshua, JM', '2026-07-02 08:00:00', '2026-07-02 17:00:00', 'section', '2026-07-01 18:31:45', '2026-07-01 18:31:45'),
(221, 20, NULL, NULL, 'Orientation on Breastfeeding and Re-Orientation on the DILG-CAR Policies on Breastfeeding/Lactation', NULL, 'event', 'Zoom', NULL, '2026-07-06 08:00:00', '2026-07-06 17:00:00', 'global', '2026-07-02 17:06:42', '2026-07-02 17:06:42'),
(222, 20, NULL, NULL, 'MEN\'S HEALTH AWARENESS ENTITLED \"KUMUSTA KA , PA?\" NURTURING THE MENTAL HEALTH OF PUBLIC SERVANT F', NULL, 'event', 'NENE HALL', NULL, '2026-07-07 08:00:00', '2026-07-07 17:00:00', 'global', '2026-07-06 09:52:07', '2026-07-06 09:52:32'),
(223, 20, 3, 17, 'IAN teleconferencing for the preparation of Corrective Action Report for QP2', NULL, 'offsite', 'ZOOM', NULL, '2026-07-07 08:00:00', '2026-07-07 17:00:00', 'section', '2026-07-06 10:21:56', '2026-07-06 10:21:56'),
(224, 20, 1, 14, 'DA Courtesy Call', NULL, 'offsite', 'DA-CAR', NULL, '2026-07-06 08:00:00', '2026-07-06 17:00:00', 'section', '2026-07-06 10:22:54', '2026-07-06 10:22:54'),
(225, 20, 1, 14, 'AFP Courtesy Call', NULL, 'offsite', 'RO', NULL, '2026-07-06 08:00:00', '2026-07-06 17:00:00', 'section', '2026-07-06 10:23:09', '2026-07-06 10:23:09'),
(226, 13, 2, 13, 'PRAISE Meeting', NULL, 'offsite', 'Nene Pimentel Hall', 'with jm and jhosua', '2026-07-13 09:30:00', '2026-07-13 17:00:00', 'section', '2026-07-07 11:10:01', '2026-07-08 15:24:36'),
(227, 13, NULL, NULL, 'CPD RD Wongs courtesy visit to RD', NULL, 'event', 'DILG RO', 'c/o Jem', '2026-07-20 08:00:00', '2026-07-20 17:00:00', 'global', '2026-07-07 16:08:01', '2026-07-07 16:08:01'),
(228, 13, 2, 13, 'Bable Cordillera Regional Mngt on Mental Health Meeting', NULL, 'offsite', 'Chateau De Maisons Suites', NULL, '2026-07-08 08:00:00', '2026-07-08 17:00:00', 'section', '2026-07-08 09:12:54', '2026-07-08 09:12:54'),
(229, 15, 7, 15, 'JM Leave', NULL, 'leave', NULL, NULL, '2026-07-16 08:00:00', '2026-07-16 17:00:00', 'section', '2026-07-09 16:38:28', '2026-07-09 16:38:28'),
(230, 20, 5, 20, 'PRINCE - MONITORING @ SABLAN', NULL, 'offsite', 'Sablan', 'w/ pdmu', '2026-07-14 08:00:00', '2026-07-14 17:00:00', 'section', '2026-07-13 14:49:01', '2026-07-13 16:11:30'),
(231, 20, 5, 11, 'LALA - LEAVE', NULL, 'leave', NULL, NULL, '2026-07-16 08:00:00', '2026-07-16 17:00:00', 'section', '2026-07-13 14:49:22', '2026-07-13 14:49:22'),
(232, 20, 3, 17, 'LALA -  RSDC-CAR TWG Meeting @ DSWD TRAINING CENTER', NULL, 'offsite', 'DSWD TRAINING CENTER', NULL, '2026-07-14 08:00:00', '2026-07-14 17:00:00', 'section', '2026-07-13 14:49:38', '2026-07-14 08:20:47'),
(233, 20, NULL, NULL, 'BBM Webinar 2PM', NULL, 'event', 'WEBINAR', NULL, '2026-07-14 08:00:00', '2026-07-14 17:00:00', 'global', '2026-07-13 17:31:34', '2026-07-13 17:31:34'),
(234, 13, 2, 13, 'BABLE SPL', NULL, 'leave', NULL, NULL, '2026-07-14 08:00:00', '2026-07-14 17:00:00', 'section', '2026-07-13 18:43:40', '2026-07-13 18:43:40'),
(235, 13, 2, 13, 'BABLE SPL', NULL, 'leave', NULL, NULL, '2026-07-16 08:00:00', '2026-07-16 17:00:00', 'section', '2026-07-13 18:44:00', '2026-07-13 18:44:00'),
(239, 23, 4, 23, '3rd Quarter Joint Inter-Committee Meeting RCAT-VAWC and RJJWC', NULL, 'offsite', 'Ecolodge Restaurant, Lower Magsaysay, Baguio City', NULL, '2026-07-30 08:00:00', '2026-07-30 17:00:00', 'section', '2026-07-14 17:42:41', '2026-07-14 17:42:41'),
(240, 23, 4, 23, '3rd Regional Council Against Child Labor Meeting', NULL, 'offsite', 'MH Properties Corporation (City Travel Hotel), Kisad Road, Burnham Legarda, Baguio City', '074 443 5338  (Ms. Letecia Reyes, FP CLPEP)', '2026-08-06 09:00:00', '2026-08-06 17:00:00', 'section', '2026-07-14 17:46:47', '2026-07-20 08:54:19'),
(241, 23, 4, 19, '3RD QUARTER RICT MEETING', NULL, 'offsite', 'Orchard Hotel, Baguio City', NULL, '2026-07-28 08:00:00', '2026-07-28 17:00:00', 'section', '2026-07-14 17:51:24', '2026-07-14 17:51:24'),
(242, 23, 4, 19, '3RD QUARTER RICT MEETING', NULL, 'offsite', 'Orchard Hotel, Baguio City', NULL, '2026-07-28 08:00:00', '2026-07-28 17:00:00', 'section', '2026-07-14 17:51:24', '2026-07-14 17:51:24'),
(243, 20, 1, 14, 'DC JANE - RCSP @ ABRA / MOA SIGNING @ APAYAO', NULL, 'offsite', 'ABRA,APAYAO', NULL, '2026-07-20 08:00:00', '2026-07-23 17:00:00', 'section', '2026-07-16 11:54:13', '2026-07-16 11:54:13'),
(244, 20, 5, 11, 'LALA - RCSP @ ABRA / MOA SIGNING @ APAYAO', NULL, 'offsite', 'ABRA,APAYAO', NULL, '2026-07-20 08:00:00', '2026-07-23 17:00:00', 'section', '2026-07-16 11:54:27', '2026-07-16 11:54:27'),
(245, 20, 5, 10, 'NIKKO - RCSP @ ABRA / MOA SIGNING @ APAYAO', NULL, 'offsite', 'ABRA,APAYAO', NULL, '2026-07-20 08:00:00', '2026-07-20 17:00:00', 'section', '2026-07-16 11:54:40', '2026-07-16 11:54:40'),
(247, 20, 5, 22, 'PRINCES- RCSP @ PINUKPUK, KALINGA', NULL, 'offsite', 'KALINGA', NULL, '2026-07-22 08:00:00', '2026-07-25 17:00:00', 'section', '2026-07-20 07:22:20', '2026-07-20 07:22:20'),
(248, 20, 5, 20, 'PRINCE- RCSP @ PINUKPUK, KALINGA', NULL, 'offsite', 'KALINGA', NULL, '2026-07-22 08:00:00', '2026-07-25 17:00:00', 'section', '2026-07-20 07:22:46', '2026-07-20 07:22:46'),
(249, 20, 5, 18, 'JOANA - RCSP @ PINUKPUK, KALINGA', NULL, 'offsite', 'KALINGA', NULL, '2026-07-22 08:00:00', '2026-07-25 17:00:00', 'section', '2026-07-20 07:23:03', '2026-07-20 07:23:03'),
(250, 20, 5, 20, 'PRINCE LEAVE', NULL, 'leave', NULL, NULL, '2026-07-27 08:00:00', '2026-07-29 17:00:00', 'section', '2026-07-20 07:23:24', '2026-07-20 07:23:24'),
(251, 23, 4, 23, 'LGU Profiling in Benguet', NULL, 'offsite', 'Benguet', NULL, '2026-08-05 08:00:00', '2026-08-05 17:00:00', 'section', '2026-07-20 11:21:16', '2026-07-20 11:21:16'),
(252, 23, 4, 23, 'BIMS Baguio', NULL, 'offsite', 'Nene Hall', NULL, '2026-07-22 08:00:00', '2026-07-23 17:00:00', 'section', '2026-07-20 13:22:44', '2026-07-20 13:22:44'),
(253, 23, 4, 23, 'RO 308-2026 RO LGU Profiling Ifugao', NULL, 'offsite', 'Ifugao', 'With STAT2 Josh', '2026-08-18 08:00:00', '2026-08-20 17:00:00', 'section', '2026-07-20 16:49:35', '2026-07-21 18:57:58'),
(254, 13, 2, 13, 'BFP Oath taking', NULL, 'offsite', 'Irisan, Baguio City', NULL, '2026-07-20 08:00:00', '2026-07-20 17:00:00', 'section', '2026-07-21 11:58:24', '2026-07-21 11:58:24'),
(255, 13, 2, 13, 'DILG-CAR Mid Year PRA DC ADC SCs', NULL, 'offsite', 'RO', NULL, '2026-07-28 08:00:00', '2026-07-30 17:00:00', 'section', '2026-07-21 12:00:58', '2026-07-21 12:00:58'),
(256, 13, NULL, NULL, 'Rise: 2026: Reinforcing Integrity, Safety and Excellence', 'https://tinyurl.com/DILG-RISE2026', 'event', 'DILG CAR', 'need to confirm b4 August 5', '2026-08-12 08:00:00', '2026-08-13 17:00:00', 'global', '2026-07-21 15:23:59', '2026-07-21 15:23:59'),
(257, 23, NULL, NULL, 'AFO TWG MEETING FOR THE ACTIVITIES RE: NCM, JJWC WEEK and 18-DAY CAMPAIGN TO END VAW', 'https://tinyurl.com/technicalWGM', 'event', 'via Zoom', 'Link: https://tinyurl.com/technicalWGM\r\nMeeting ID: 969 5245 1369\r\nPasscode: 169688', '2026-08-05 09:00:00', '2026-08-05 12:00:00', 'global', '2026-07-21 16:10:48', '2026-08-03 15:38:31'),
(258, 20, NULL, NULL, 'IPEYAS - SDEC', NULL, 'event', 'RO', NULL, '2026-08-18 08:00:00', '2026-08-18 17:00:00', 'global', '2026-07-21 16:31:49', '2026-07-21 16:31:49'),
(259, 20, NULL, NULL, 'IPEYAS - SSZ (SAFER SCHOOL ZONES)', NULL, 'event', 'RO', NULL, '2026-08-25 08:00:00', '2026-08-25 17:00:00', 'global', '2026-07-21 16:32:19', '2026-07-21 16:32:19'),
(263, 23, NULL, NULL, 'RO 321-2026 re TA on LGUSS 2026 Rollout and conduct of Preventive Maintenance', NULL, 'event', 'Calanasan,  Apayao', 'with ISR Angelique Kaye Romero and ISA I Elmer Besas', '2026-08-25 08:00:00', '2026-08-28 17:00:00', 'global', '2026-07-21 16:56:03', '2026-07-21 16:56:03'),
(264, 23, NULL, NULL, 'RO 321-2026 re TA on LGUSS 2026 Rollout and conduct of Preventive Maintenance', NULL, 'event', 'Natonin, Mountain Province', 'with ISA I Elmer T. Besas, Jr. and DA Anarie Joy G. Milo', '2026-09-08 08:00:00', '2026-09-11 17:00:00', 'global', '2026-07-21 16:58:31', '2026-08-03 17:32:11'),
(266, 7, NULL, NULL, 'Baguio Day', NULL, 'holiday', NULL, NULL, '2026-09-01 08:00:00', '2026-09-01 17:00:00', 'global', '2026-07-21 17:35:14', '2026-07-21 17:35:14'),
(267, 7, NULL, NULL, 'MP - LGU Profiling Exit Conference', NULL, 'event', NULL, NULL, '2026-07-28 08:00:00', '2026-07-30 17:00:00', 'global', '2026-07-21 17:36:39', '2026-07-21 17:36:39'),
(268, 13, 2, 13, 'PRAISE RAC', NULL, 'offsite', 'OPCEN', 'with JM', '2026-07-22 08:00:00', '2026-07-23 17:00:00', 'section', '2026-07-22 08:37:27', '2026-07-22 08:37:27'),
(269, 13, 2, 13, 'BABLE ROCDCP DELIBERATION', NULL, 'offsite', 'PDEA CAR', '1PM', '2026-07-27 08:00:00', '2026-07-27 17:00:00', 'section', '2026-07-26 01:02:49', '2026-07-26 01:04:24'),
(270, 13, 2, 13, 'DC ADC BAC Mtng', NULL, 'offsite', 'RO', NULL, '2026-07-28 09:00:00', '2026-07-28 17:00:00', 'section', '2026-07-27 09:47:55', '2026-07-27 09:47:55'),
(271, 13, 5, 22, 'Princes Joana Transformation Program', NULL, 'offsite', 'Travelite Hotel', 'TP of OPPAPRU', '2026-07-28 08:00:00', '2026-07-28 17:00:00', 'section', '2026-07-28 08:30:54', '2026-07-28 08:30:54'),
(272, 23, 4, 23, 'Post Qual on Procurement of Laptops and other ICT Equipment', NULL, 'offsite', 'Parañaque City, Manila', NULL, '2026-07-30 12:00:00', '2026-07-30 17:00:00', 'section', '2026-07-29 09:02:26', '2026-07-30 08:07:20'),
(273, 23, NULL, NULL, 'CONSULTATION MEETING FOR THE CSO/PPPP 2026 CATCH-UP PLAN AND 2027 PLANS AND ACTIVITIES', NULL, 'event', 'via Zoom', 'Meeting ID:964 6722 1168\r\nPassword:695536', '2026-07-30 10:00:00', '2026-07-30 12:00:00', 'global', '2026-07-29 10:57:03', '2026-07-29 10:57:03'),
(274, 23, NULL, NULL, 'CONSULTATION MEETING FOR THE CSO/PPPP 2026 CATCH-UP PLAN AND 2027 PLANS AND ACTIVITIES', NULL, 'event', 'via Zoom', 'Meeting ID:964 6722 1168\r\nPassword:695536', '2026-07-30 10:00:00', '2026-07-30 12:00:00', 'global', '2026-07-29 10:57:03', '2026-07-29 10:57:03'),
(275, 23, NULL, NULL, 'VALIDATION MEETING ON THE SUBMITTED ICT RESOURCE REQUIREMENTS ISSP FY 2028-2030', 'https://tinyurl.com/DILG-ISSP-2028-2030', 'event', 'via Zoom', 'Meeting ID: 876 8623 3475  \r\nPasscode: 277232  \r\nMeeting Link: https://tinyurl.com/DILG-ISSP-2028-2030', '2026-08-04 08:00:00', '2026-08-05 17:00:00', 'global', '2026-07-29 13:42:51', '2026-07-29 13:42:51'),
(276, 23, NULL, NULL, 'Orientation on Local Health Boards for Abra PLGU', NULL, 'event', 'via Zoom', NULL, '2026-08-04 08:00:00', '2026-08-04 17:00:00', 'global', '2026-07-30 07:50:37', '2026-07-30 07:50:37'),
(278, 20, 3, 21, 'JHEM - Standard First Aid Training', NULL, 'offsite', 'RO', NULL, '2026-08-03 08:00:00', '2026-08-05 17:00:00', 'section', '2026-08-03 08:22:09', '2026-08-03 08:22:09'),
(280, 20, 5, 11, 'lala - Standard First Aid Training', NULL, 'offsite', 'RO', NULL, '2026-08-03 08:00:00', '2026-08-05 17:00:00', 'section', '2026-08-03 08:22:48', '2026-08-03 08:22:48'),
(281, 20, 3, 17, 'IAN - PRESENTATION OF 1ST SEMESTER CY 2026 ACCOMP. REPORT JRTF', NULL, 'offsite', 'QC', NULL, '2026-08-04 08:00:00', '2026-08-06 17:00:00', 'section', '2026-08-03 08:24:07', '2026-08-03 08:24:07'),
(282, 13, NULL, NULL, 'Cordi Culminating', NULL, 'event', 'Wangal', 'RO 345 2026\r\nBable, Princess, Herald', '2026-07-31 08:00:00', '2026-07-31 17:00:00', 'global', '2026-08-03 09:08:15', '2026-08-03 09:08:15'),
(283, 20, NULL, NULL, 'LGA-REGIONAL OFFICE CONSULTATION  ON THE FY 2027 PLANS AND PROGRAMS', NULL, 'event', NULL, NULL, '2026-08-03 08:00:00', '2026-08-03 17:00:00', 'global', '2026-08-03 14:34:28', '2026-08-03 14:34:28'),
(284, 20, 1, 14, 'DC JANE - ROPMT MEETING', NULL, 'offsite', 'OPCEN', NULL, '2026-08-04 08:00:00', '2026-08-04 17:00:00', 'section', '2026-08-03 14:35:08', '2026-08-03 14:35:08'),
(285, 20, 1, 14, 'DC JANE - 3RD QUARTER 2026 MEETING OF THE REGIONAL SOCIAL DEVELOPMENT COMMITTEE (RSDC)', NULL, 'offsite', 'DSWD FIELD OFFICE CAR TRAINING CENTER', NULL, '2026-08-11 08:00:00', '2026-08-11 17:00:00', 'section', '2026-08-03 14:37:22', '2026-08-03 14:37:22'),
(286, 22, NULL, NULL, 'NTOT for SICAP BADAC', NULL, 'event', NULL, 'Via Zoom', '2026-08-11 08:00:00', '2026-08-13 17:00:00', 'global', '2026-08-03 14:56:27', '2026-08-03 14:57:38'),
(287, 13, 2, 13, 'Bable SPL', NULL, 'leave', NULL, NULL, '2026-08-04 08:00:00', '2026-08-04 17:00:00', 'section', '2026-08-03 18:15:15', '2026-08-03 18:15:15'),
(288, 15, NULL, NULL, 'LGU Profiling Benguet', NULL, 'event', 'PEO, Benguet Capitol', 'Allan & JM', '2026-08-25 08:00:00', '2026-08-25 17:00:00', 'global', '2026-08-04 16:23:01', '2026-08-10 13:18:00'),
(289, 15, NULL, NULL, 'LGU Profiling-Abra', NULL, 'event', 'DILG-Abra', 'Herald & JM', '2026-08-17 08:00:00', '2026-08-18 17:00:00', 'global', '2026-08-04 16:23:34', '2026-08-04 16:23:34'),
(290, 15, NULL, NULL, 'PRAISE TWG Meeting', NULL, 'event', NULL, 'Bable, Jhosua, JM', '2026-08-05 09:30:00', '2026-08-05 17:00:00', 'global', '2026-08-04 16:24:41', '2026-08-04 16:24:41'),
(291, 20, 5, 11, 'LALA & PRINCE - RCSP KALINGA', NULL, 'offsite', 'KALINGA', NULL, '2026-08-05 08:00:00', '2026-08-07 17:00:00', 'section', '2026-08-04 17:55:18', '2026-08-04 17:55:18'),
(292, 20, 1, 14, 'DC JANE - WORKSHOP (M&E) SYSTEM RA 11650', NULL, 'offsite', 'TEACHERS CAMP, BAGUIO CITY', NULL, '2026-08-04 08:00:00', '2026-08-06 17:00:00', 'section', '2026-08-04 17:56:34', '2026-08-04 17:56:34'),
(294, 23, NULL, NULL, 'AFO - ORYENTASYON SA  PANUNTUNAN SA PAGPAPATUPAD    NG CSO/PPPP    PMO COMMUNITY GRANT FUND (CGF)', 'https://bit.ly/CGFCY2026', 'event', 'via zoom', 'Meeting Link: https://bit.ly/CGFCY2026\r\nMeeting ID: 952 4843 4600\r\nPasscode: 269544', '2026-08-10 10:00:00', '2026-08-10 12:00:00', 'global', '2026-08-05 08:31:52', '2026-08-05 08:31:52'),
(295, 23, NULL, NULL, 'RICTT - ISSP TWG Meeting', NULL, 'event', 'OpCen', NULL, '2026-08-10 09:00:00', '2026-08-10 12:00:00', 'global', '2026-08-05 08:44:21', '2026-08-05 08:44:21'),
(296, 23, 4, 23, 'CSWDO-YDO and SK Pederasyon’s Project Pitching', NULL, 'offsite', '4th Floor, CDRRMO, GEFA Barangay, Baguio City', NULL, '2026-08-08 08:00:00', '2026-08-08 17:00:00', 'section', '2026-08-07 11:21:04', '2026-08-07 11:21:04'),
(297, 23, NULL, NULL, 'CSIS MOA Signing with BSU', NULL, 'event', '2F OpCen, DILG CAR RO', 'DC, AFO, Herald, Stat 1', '2026-08-24 08:00:00', '2026-08-24 12:00:00', 'global', '2026-08-10 13:18:38', '2026-08-10 13:18:38'),
(298, 23, NULL, NULL, 'AFO-Online CSIS Coordination Meeting with LGU, BSU and Team', 'https://bit.ly/CSISMeetAug12', 'event', 'via Zoom', '(Meeting ID: 370 337 2554; Passcode: 645969).', '2026-08-12 13:00:00', '2026-08-12 15:00:00', 'global', '2026-08-10 13:22:15', '2026-08-10 13:22:15'),
(300, 17, 3, NULL, 'Online Orientation on Inventory and Turnover of Barangay and SK Officials', NULL, 'event', NULL, NULL, '2026-08-17 09:00:00', '2026-08-17 12:00:00', 'section', '2026-08-11 11:12:12', '2026-08-11 11:12:12'),
(301, 20, NULL, NULL, '3rd Quarter CRPOC Meeting', NULL, 'event', 'Baguio City', NULL, '2026-09-17 08:00:00', '2026-09-17 17:00:00', 'global', '2026-08-11 13:37:05', '2026-08-11 13:37:05'),
(302, 13, 2, 13, 'BABLE RSC Final Interview', NULL, 'offsite', 'Camp Bado Dangwa, LTB', NULL, '2026-08-18 08:00:00', '2026-08-20 17:00:00', 'section', '2026-08-11 13:50:19', '2026-08-11 13:50:19'),
(303, 13, NULL, NULL, 'PRAISE AWARDING', NULL, 'event', NULL, NULL, '2026-09-21 08:00:00', '2026-09-23 17:00:00', 'global', '2026-08-11 15:56:45', '2026-09-07 16:58:43'),
(304, 20, NULL, NULL, 'RCSP KALINGA PROVINCIAL CONVERGENCE', NULL, 'event', 'KALINGA', NULL, '2026-09-15 08:00:00', '2026-09-15 17:00:00', 'global', '2026-08-11 18:13:11', '2026-08-11 18:13:11'),
(306, 20, NULL, NULL, 'FGD - BRIDGING THE GAP', NULL, 'event', 'Baguio City', NULL, '2026-08-18 08:00:00', '2026-08-20 17:00:00', 'global', '2026-08-12 09:23:28', '2026-08-12 09:23:28'),
(307, 20, 5, NULL, '3RD QUARTER ICAD CLUSTER MEETING', NULL, 'event', 'Baguio City', NULL, '2026-09-24 08:00:00', '2026-09-24 17:00:00', 'section', '2026-08-12 09:24:31', '2026-08-17 14:31:41'),
(312, 23, 4, 23, 'AFO - CY 2026 2ND SEMESTER SUB-COMMITTEE ON COMMUNICATIONS MEETING', NULL, 'offsite', 'DICT-CAR Training Center, Polo Field, St. Joseph Village, Baguio City', 'With Elmer', '2026-08-14 09:00:00', '2026-08-14 12:00:00', 'section', '2026-08-12 10:27:23', '2026-08-12 10:27:23'),
(313, 10, 5, NULL, 'Joint RICAD Meeting (R2 and CAR)', NULL, 'event', NULL, NULL, '2026-11-18 08:00:00', '2026-11-18 17:00:00', 'section', '2026-08-13 17:04:25', '2026-08-13 17:29:28'),
(315, 23, 4, 23, 'PAGSASAGAWA NG IKALAWANG YUGTO NG TEKNIKAL NA PAGSASANAY SA LGUSS', NULL, 'offsite', 'Region 3', 'Allan and Ian with RICT', '2026-09-28 08:00:00', '2026-10-01 17:00:00', 'section', '2026-08-13 19:18:07', '2026-08-13 19:18:07'),
(316, 23, NULL, NULL, 'RO 360-2026: CSIS LRI Training', NULL, 'event', 'DILG CAR RO', 'Allan, Herald, Joshua, JM', '2026-09-02 08:00:00', '2026-09-03 17:00:00', 'global', '2026-08-13 19:19:26', '2026-08-13 19:19:26'),
(317, 23, NULL, NULL, 'RO 360-2026: CSIS Utilization Conference', NULL, 'event', 'BSU, La Trinidad, Benguet', 'DC, AFO, Herald, Joshua, JM', '2026-11-25 08:00:00', '2026-11-26 17:00:00', 'global', '2026-08-13 19:20:23', '2026-08-13 19:20:23'),
(318, 23, NULL, NULL, 'RO 360-2026: CSIS Post Evaluation and Finalization of CPAP', NULL, 'event', 'DILG CAR RO', 'DC, AFO, Herald, JM, Joshua', '2026-12-11 08:00:00', '2026-12-11 17:00:00', 'global', '2026-08-13 19:21:08', '2026-08-13 19:21:08'),
(319, 10, NULL, NULL, 'LGMED Activity', NULL, 'event', NULL, NULL, '2026-09-10 08:00:00', '2026-09-11 17:00:00', 'global', '2026-08-17 14:34:12', '2026-08-17 14:38:05'),
(320, 13, NULL, NULL, '3RD QUARTER CGLG', NULL, 'event', 'RO', 'FOR PR /AFO', '2026-09-24 08:00:00', '2026-09-24 17:00:00', 'global', '2026-08-17 14:36:49', '2026-08-17 14:36:49'),
(321, 13, NULL, NULL, 'SGFH RIDS', NULL, 'event', NULL, 'Jem, Herald, Allan', '2026-10-14 08:00:00', '2026-10-15 17:00:00', 'global', '2026-08-17 14:39:20', '2026-09-03 17:37:13'),
(322, 17, 3, 17, 'IAN - Wellness Leave', NULL, 'leave', NULL, NULL, '2026-09-02 08:00:00', '2026-09-03 17:00:00', 'section', '2026-08-17 15:28:40', '2026-08-17 15:28:40'),
(323, 23, 8, 1, 'CSC Day', NULL, 'offsite', 'SM Baguio', 'All', '2026-09-09 08:00:00', '2026-09-09 17:00:00', 'section', '2026-08-20 17:02:26', '2026-08-20 17:02:26'),
(327, 20, NULL, NULL, 'CBDRP & BALAY SILANGAN & LTIA Workshop', NULL, 'event', NULL, NULL, '2026-11-04 08:00:00', '2026-11-04 17:00:00', 'global', '2026-08-24 12:03:07', '2026-10-06 10:04:55'),
(328, 20, NULL, NULL, 'BENGUET RCSP PROVINCIAL CONVERGENCE', NULL, 'event', 'BENGUET', NULL, '2026-09-16 08:00:00', '2026-09-16 17:00:00', 'global', '2026-08-24 12:03:31', '2026-08-24 12:03:31'),
(330, 20, NULL, NULL, 'RHRMSPB MEETING', NULL, 'event', NULL, NULL, '2026-08-25 08:00:00', '2026-08-25 17:00:00', 'global', '2026-08-24 13:15:39', '2026-08-24 13:15:39'),
(331, 23, NULL, NULL, 'PIA Workshop', NULL, 'event', NULL, '898 6823 2706 / 124 997', '2026-08-27 08:00:00', '2026-08-27 17:00:00', 'global', '2026-08-24 15:37:56', '2026-08-24 15:37:56'),
(332, 20, NULL, NULL, 'CRMCC MEETING/Cancelled', NULL, 'event', NULL, NULL, '2026-10-15 08:00:00', '2026-10-15 17:00:00', 'global', '2026-08-25 15:28:25', '2026-10-13 13:37:33'),
(333, 20, NULL, NULL, 'LG MONTH CELEBRATION', NULL, 'event', NULL, NULL, '2026-10-19 08:00:00', '2026-10-20 17:00:00', 'global', '2026-08-25 15:28:47', '2026-09-25 10:51:40'),
(335, 20, NULL, NULL, 'YEAR END EVALUATION', NULL, 'event', NULL, NULL, '2026-12-02 08:00:00', '2026-12-03 17:00:00', 'global', '2026-08-25 15:41:40', '2026-08-25 15:41:40'),
(336, 1, 7, 15, 'On-Leave', NULL, 'leave', NULL, NULL, '2026-08-27 08:00:00', '2026-08-27 17:00:00', 'section', '2026-08-25 15:48:58', '2026-08-25 15:48:58'),
(337, 17, 3, 17, '2nd Inter-Agency Coordination Meeting on Food Conservation Program', NULL, 'offsite', '456 Hotel, 59 Legarda Road, Baguio City', NULL, '2026-08-25 08:00:00', '2026-08-25 17:00:00', 'section', '2026-08-27 17:37:30', '2026-08-27 17:37:30'),
(338, 17, 3, 17, 'Agriculture Committee 2026 3rd Quarter Meeting', NULL, 'offsite', 'DA-RFO-CAR', NULL, '2026-08-26 08:00:00', '2026-08-26 17:00:00', 'section', '2026-08-27 17:38:28', '2026-08-27 17:38:28'),
(339, 17, 3, 17, 'Inter-Agency Coordination Meeting with MBLISTTA DA on Road Right of Way', NULL, 'offsite', 'Gestdan Centrum', 'Ian with Legal and PDMU', '2026-08-27 08:00:00', '2026-08-27 17:00:00', 'section', '2026-08-27 17:40:47', '2026-08-27 17:43:06'),
(340, 13, 3, 21, 'JEM RCACL', NULL, 'offsite', 'City Travel', NULL, '2026-09-02 08:00:00', '2026-09-02 17:00:00', 'section', '2026-09-02 10:55:27', '2026-09-02 10:55:27'),
(341, 13, 3, 21, 'JEM DAR CARFO', NULL, 'offsite', 'DAR', NULL, '2026-09-03 08:00:00', '2026-09-03 17:00:00', 'section', '2026-09-02 10:55:56', '2026-09-02 10:55:56'),
(343, 15, NULL, NULL, 'RSCWC 3rd Quarter Committee Meeting (Allan)', NULL, 'event', 'Health 100 Ecolodge, Baguio City', 'Allan', '2026-09-23 08:30:00', '2026-09-23 15:00:00', 'global', '2026-09-07 16:27:46', '2026-09-09 11:21:54');
INSERT INTO `events` (`id`, `user_id`, `section_id`, `focal_person_id`, `title`, `link`, `type`, `location`, `notes`, `start_date`, `end_date`, `visibility_type`, `created_at`, `updated_at`) VALUES
(344, 23, 4, 23, 'CAPDEV8 TRAINING OF TRAINERS (ALLAN)', NULL, 'offsite', 'Manila', 'Inclusive of Travel Dates', '2026-09-15 08:00:00', '2026-09-15 17:00:00', 'section', '2026-09-08 13:11:45', '2026-09-09 11:17:21'),
(345, 1, NULL, NULL, 'Elderly Filipino Week', NULL, 'event', 'CBAO, DPS Compound, Baguio City', 'JM', '2026-09-09 13:00:00', '2026-09-09 17:00:00', 'global', '2026-09-09 08:11:01', '2026-09-09 08:11:01'),
(346, 27, NULL, NULL, 'Amun Jadid', NULL, 'holiday', NULL, 'Muharram is the first month of the Islamic calendar and a time of remembrance or mourning.', '2026-06-16 00:00:00', '2026-06-16 23:59:59', 'global', '2026-09-09 08:13:19', '2026-09-09 08:13:19'),
(347, 27, NULL, NULL, 'Maulid un-Nabi (Regional and Muslim government holiday)', NULL, 'holiday', NULL, 'Legal Muslim holiday under PD 1083 in its Article 170 areas outside BARMM; eligible Muslim government employees elsewhere may be excused under Article 172. This is not a nationwide closure for all workers. BARMM separately declares 26 August 2026 a special working holiday.', '2026-08-26 00:00:00', '2026-08-26 23:59:59', 'global', '2026-09-09 08:13:19', '2026-09-09 08:13:19'),
(348, 27, NULL, NULL, 'Day of Arafah (BARMM)', NULL, 'holiday', NULL, 'Special non-working holiday in BARMM, covering the private sector, Bangsamoro government bodies and their offices outside the region, under Proclamation No. 0003 of 2026.', '2026-05-26 00:00:00', '2026-05-26 23:59:59', 'global', '2026-09-09 08:13:20', '2026-09-09 08:13:20'),
(349, 27, NULL, NULL, 'Maulid un-Nabi (BARMM special working day)', NULL, 'holiday', NULL, 'Proclamation 0006 of 2026 declares 26 August a special working holiday in BARMM. The regional working classification does not remove separate regional and Muslim-government observance rights elsewhere under PD 1083. This is not a general day off.', '2026-08-26 00:00:00', '2026-08-26 23:59:59', 'global', '2026-09-09 08:13:20', '2026-09-09 08:13:20'),
(350, 23, NULL, NULL, 'CBETT Orientation (Ma\'am Bable)', 'https://tinyurl.com/CBETTsept17', 'event', 'zoom', 'tinyurl.com/CBETTsept17\r\n\r\nZoom ID: 996 9223 9831\r\nPasscode: 913320', '2026-09-17 08:00:00', '2026-09-17 12:00:00', 'global', '2026-09-09 11:16:27', '2026-09-09 11:16:27'),
(351, 23, NULL, NULL, 'RCAT VAWC TWG Consultative Meeting (Ma\'am Bable)', NULL, 'event', 'H100 Ecolodge, Lower Magsaysay, Baguio City', 'This is to inform you that a meeting is scheduled for the Technical Working Group (TWG) ConsultativeMeeting on September 30, 2026, to be held at H100 Ecolodge, Lower Magsaysay, Baguio City. The activity willfocus on addressing concerns raised during the 3Q RCAT-VAWC Meeting, particularly the crafting of the menu forthe LCAT-VAWC Annual Work and Financial Plan (AWFP) and the development of a Training Needs Assessment(TNA) to', '2026-09-30 08:00:00', '2026-09-30 17:00:00', 'global', '2026-09-09 11:20:24', '2026-09-09 11:20:24'),
(352, 23, NULL, NULL, 'RIT Meeting (DOH) (no attendees)', NULL, 'event', 'Chalet Baguio', NULL, '2026-09-10 08:00:00', '2026-09-10 17:00:00', 'private', '2026-09-09 11:30:02', '2026-09-09 11:30:02'),
(353, 23, 4, 23, 'RO No. 465-2026: TA at Baguio City re Formulation of Brgy CapDev Agenda (Capstone) - Allan', NULL, 'offsite', 'CDRRMO, Baguio City', 'Allan', '2026-10-05 08:00:00', '2026-10-09 17:00:00', 'section', '2026-09-09 14:56:02', '2026-10-02 16:39:08'),
(354, 23, 4, 23, 'Palawan-Wellness Leave (AFO)', NULL, 'leave', NULL, NULL, '2026-10-12 08:00:00', '2026-10-13 17:00:00', 'section', '2026-09-09 14:56:30', '2026-10-08 16:49:04'),
(355, 23, NULL, NULL, 'LHB ACTION LAB: SETTING UP LOCAL HEALTH BOARD SYSTEMS AND STRUCTURE - OCT. 7, 2026 1 MESSAGE', NULL, 'event', 'Clark, Pampanga', 'Lecture Day: Oct. 7, 2026 (ARD Rupert, DC Kliene, and Herald)', '2026-10-06 08:00:00', '2026-10-06 17:00:00', 'global', '2026-09-14 17:12:51', '2026-09-25 10:45:33'),
(356, 13, NULL, NULL, 'inspection of Equipment', NULL, 'event', NULL, NULL, '2026-11-04 08:00:00', '2026-11-04 17:00:00', 'global', '2026-09-15 08:40:13', '2026-09-15 08:40:13'),
(357, 17, 3, 17, 'ROLLOUT OF LGUSS IN THE PROVINCE OF KALINGA', NULL, 'offsite', 'Tabuk City, Kalinga', 'Regional Order No. 429-2026', '2026-09-15 08:00:00', '2026-09-18 17:00:00', 'section', '2026-09-18 09:24:04', '2026-09-18 09:24:04'),
(358, 13, 2, 13, 'NNC Regional Summit for a Healthier Cordillera: Addressing Overweight and Obesity', NULL, 'offsite', 'Citylight Hotel, Baguio City', NULL, '2026-09-24 08:00:00', '2026-09-24 17:00:00', 'section', '2026-09-24 08:23:05', '2026-09-24 08:23:05'),
(359, 13, 2, 13, 'ROCBDC', NULL, 'offsite', 'PDEA CAR', NULL, '2026-10-01 08:00:00', '2026-10-01 17:00:00', 'section', '2026-09-24 08:25:46', '2026-09-24 08:25:46'),
(360, 13, 2, 13, 'Q3 Cord Regl Council for Mental Health', NULL, 'offsite', 'Chateau De Maisons Suites', 'RO No. 460 2026', '2026-09-29 08:00:00', '2026-09-29 17:00:00', 'section', '2026-09-24 10:53:18', '2026-09-24 10:53:18'),
(361, 13, 2, 13, 'RCAT VAWC TWG Mtng', NULL, 'offsite', 'Health 101 Ecolodge', 'RO 460-2026', '2026-09-30 08:00:00', '2026-09-30 17:00:00', 'section', '2026-09-24 10:55:22', '2026-09-24 10:55:22'),
(362, 7, 7, 7, 'Regional Bantay Asin Task Force Monitoring Meeting', NULL, 'offsite', 'La Trinidad, Benguet', NULL, '2026-09-30 08:00:00', '2026-09-30 17:00:00', 'section', '2026-09-24 17:43:15', '2026-09-24 17:46:07'),
(363, 7, 7, 7, 'SPL', NULL, 'leave', NULL, NULL, '2026-10-01 08:00:00', '2026-10-01 17:00:00', 'section', '2026-09-24 17:43:48', '2026-09-24 17:43:48'),
(364, 7, 7, 7, 'SPL', NULL, 'leave', NULL, NULL, '2026-10-05 08:00:00', '2026-10-05 17:00:00', 'section', '2026-09-24 17:44:06', '2026-09-24 17:44:06'),
(365, 23, 4, 23, 'AFO: Meeting with Partner Agencies re MOA Signing on the Creation of the CCGLG for SGLG', NULL, 'offsite', 'via Zoom', 'https://us06web.zoom.us/j/88604373203?pwd=v98sVI7iUNrsLWgzXnhtlMT5LHTVcX.1\r\n\r\nMeeting ID: 886 0437 3203\r\nPasscode: 823196', '2026-10-14 08:00:00', '2026-10-14 17:00:00', 'section', '2026-09-25 12:04:21', '2026-10-02 12:39:45'),
(366, 23, NULL, NULL, 'Virtual Advocacy Foum (World Mental Health Federation)', 'https://tinyurl.com/WMHD2026', 'event', 'zoom', NULL, '2026-09-09 13:00:00', '2026-09-09 17:00:00', 'global', '2026-09-26 14:28:31', '2026-09-26 14:28:31'),
(367, 7, 7, 7, 'Force Leave', NULL, 'leave', NULL, NULL, '2026-10-26 08:00:00', '2026-10-29 17:00:00', 'section', '2026-09-28 11:11:58', '2026-10-08 16:46:44'),
(368, 27, 5, 27, 'CivicAdemy Photoshoot', NULL, 'offsite', 'Benguet State University', 'Along with Sir Rene, Ma\'am Glai, and Ma\'am Yna', '2026-10-03 08:00:00', '2026-10-03 17:00:00', 'section', '2026-09-28 11:37:56', '2026-09-28 11:37:56'),
(369, 17, 3, 17, 'Provision of Technical Assistance in the Establishment of the DMS4LGUs in La Trinidad, Benguet', NULL, 'offsite', 'Municipal Hall, La Trinidad, Benguet', 'Regional Order No. 476-2026', '2026-10-08 08:00:00', '2026-10-08 17:00:00', 'section', '2026-09-30 15:03:53', '2026-09-30 15:03:53'),
(370, 11, 5, NULL, 'National ECLIP Convergence - Lala', NULL, 'event', NULL, NULL, '2026-10-27 08:00:00', '2026-10-29 17:00:00', 'section', '2026-10-01 14:35:00', '2026-10-01 14:38:12'),
(371, 11, 5, NULL, 'Abra Provincial Convergence', NULL, 'event', NULL, 'Lala, JM, Matt', '2026-10-13 08:00:00', '2026-10-14 17:00:00', 'section', '2026-10-01 14:40:31', '2026-10-08 10:21:31'),
(372, 11, 5, NULL, 'IPEYAS: SDEC', NULL, 'event', NULL, NULL, '2026-10-22 14:00:00', '2026-10-22 17:00:00', 'section', '2026-10-01 15:00:17', '2026-10-01 15:01:04'),
(373, 27, 5, 27, 'Ifugao Documentation', NULL, 'offsite', 'Ifugao', 'With Ma\'am Yna\'s Division', '2026-10-07 08:00:00', '2026-10-08 17:00:00', 'section', '2026-10-05 16:49:17', '2026-10-05 16:49:17'),
(374, 27, 5, 27, 'Baguio City Parade Documentation', NULL, 'offsite', 'Baguio City', NULL, '2026-10-17 08:00:00', '2026-10-17 12:00:00', 'section', '2026-10-05 16:53:10', '2026-10-05 16:53:10'),
(375, 17, 3, 17, 'Provision of TA in the Establishment of DMS4LGUs and LGUSS-BIMS in Abra', NULL, 'offsite', 'Abra', NULL, '2026-10-12 08:00:00', '2026-10-16 17:00:00', 'section', '2026-10-05 18:10:29', '2026-10-05 18:10:29'),
(377, 15, 1, 14, 'PSCP Training', NULL, 'offsite', 'DILG', 'DC Jane, Jhem, Lala, Nikko, Jhosua', '2026-10-21 08:00:00', '2026-10-23 17:00:00', 'section', '2026-10-06 09:55:48', '2026-10-06 09:55:48'),
(378, 15, 2, 13, 'PCCP Training', NULL, 'offsite', 'DILG', 'ADC Bable, Sigfred, JM', '2026-10-26 08:00:00', '2026-10-29 17:00:00', 'section', '2026-10-06 09:56:48', '2026-10-06 09:56:55'),
(379, 15, NULL, NULL, 'RSDC', NULL, 'event', NULL, 'ADC Bable', '2026-10-08 08:00:00', '2026-10-08 17:00:00', 'global', '2026-10-06 09:58:42', '2026-10-06 09:58:42'),
(380, 15, NULL, NULL, 'Initial Meeting w/ AFF re CAR-SSIPS', NULL, 'event', NULL, 'Nikko', '2026-10-21 08:00:00', '2026-10-23 17:00:00', 'global', '2026-10-06 10:02:40', '2026-10-06 10:02:40'),
(381, 15, NULL, NULL, 'CRPOC 4th Quarter', NULL, 'event', NULL, NULL, '2026-11-19 08:00:00', '2026-11-19 17:00:00', 'global', '2026-10-06 10:03:37', '2026-10-06 10:03:37'),
(382, 15, NULL, NULL, 'RCSP Reg\'l Convergence & Bridging the Gap pt. 2', NULL, 'event', NULL, NULL, '2026-11-24 08:00:00', '2026-11-26 17:00:00', 'global', '2026-10-06 10:04:14', '2026-10-06 10:04:32'),
(383, 15, NULL, NULL, 'CMIMC/BIMS Abra', NULL, 'event', NULL, NULL, '2026-11-09 08:00:00', '2026-11-13 17:00:00', 'global', '2026-10-06 10:06:27', '2026-10-06 10:06:27'),
(384, 13, 2, 13, 'PRE MARRIAGE ORIENTATION', NULL, 'offsite', 'ORCHARD HOTEL', NULL, '2026-10-13 08:00:00', '2026-10-15 17:00:00', 'section', '2026-10-08 09:04:54', '2026-10-08 09:04:54'),
(385, 1, NULL, NULL, 'Presentation of BST OJTs', NULL, 'event', NULL, 'JM', '2026-10-08 08:00:00', '2026-10-08 17:00:00', 'global', '2026-10-08 10:22:14', '2026-10-08 10:22:14'),
(387, 23, 4, 23, 'Innovation Framework for the 2026-2028 SGLG (AFO)', NULL, 'offsite', 'within Manila', NULL, '2026-10-14 08:00:00', '2026-10-16 17:00:00', 'section', '2026-10-09 13:47:54', '2026-10-09 13:47:54'),
(388, 28, NULL, NULL, 'Ramadan Start (Provisional)', NULL, 'holiday', NULL, 'Ramadan is a period of prayer, reflection and fasting for many Muslims worldwide. It is the ninth month in the Islamic calendar. Provisional date: official confirmation has not been recorded for this occurrence. The date or holiday arrangements may change.', '2026-02-18 00:00:00', '2026-02-18 23:59:59', 'global', '2026-10-15 09:37:22', '2026-10-15 09:37:22'),
(389, 28, NULL, NULL, 'Eid al-Fitr (Provisional)', NULL, 'holiday', NULL, 'Eid al-Fitr is a holiday to mark the end of the Islamic month of Ramadan, during which Muslims fast during the hours of daylight. Provisional date: official confirmation has not been recorded for this occurrence. The date or holiday arrangements may change.', '2026-03-20 00:00:00', '2026-03-20 23:59:59', 'global', '2026-10-15 09:37:22', '2026-10-15 09:37:22'),
(390, 28, NULL, NULL, 'Eid al-Adha (Provisional)', NULL, 'holiday', NULL, 'Eid al-Adha (Id ul-Adha) is an Islamic festival falling on the 10th day of the month of Dhul Hijja (Thou al-Hijja) to commemorate the willingness of Ibrahim (Abraham) to sacrifice his son. Provisional date: official confirmation has not been recorded for this occurrence. The date or holiday arrangements may change.', '2026-05-27 00:00:00', '2026-05-27 23:59:59', 'global', '2026-10-15 09:37:22', '2026-10-15 09:37:22'),
(391, 28, NULL, NULL, 'Amun Jadid (Provisional)', NULL, 'holiday', NULL, 'Muharram is the first month of the Islamic calendar and a time of remembrance or mourning. Provisional date: official confirmation has not been recorded for this occurrence. The date or holiday arrangements may change.', '2026-06-16 00:00:00', '2026-06-16 23:59:59', 'global', '2026-10-15 09:37:22', '2026-10-15 09:37:22'),
(392, 28, NULL, NULL, 'Sheikh Karim\'ul Makhdum Day', NULL, 'holiday', NULL, 'Sheikh Karim\'ul Makhdum Day is a special working day in Philippines', '2026-11-07 00:00:00', '2026-11-07 23:59:59', 'global', '2026-10-15 09:37:22', '2026-10-15 09:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `divisions_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000000_create_sections_table', 1),
(2, '0001_01_01_000001_create_users_table', 1),
(3, '0001_01_01_000002_create_cache_table', 1),
(4, '2026_02_16_080844_create_documents_table', 1),
(5, '2026_02_25_020113_create_events_table', 1),
(6, '2026_03_03_202912_create_document_schedules_table', 1),
(7, '2026_03_04_110036_create_role_requests_table', 1),
(8, '2026_03_05_134835_add_workflow_fields_to_documents_table', 1),
(9, '2026_03_05_141521_create_document_assignments_table', 1),
(10, '2026_03_05_141529_create_document_workflow_logs_table', 1),
(11, '2026_03_05_153158_create_document_processes_table', 1),
(12, '2026_03_06_105053_add_type_of_paper_to_document_processes_table', 1),
(13, '2026_03_06_143637_add_deleted_at_to_document_processes_table', 1),
(14, '2026_03_09_114016_add_delete_scheduled_to_document_processes', 1),
(15, '2026_03_11_084227_create_notifications_table', 1),
(16, '2026_03_12_172306_add_soft_deletes_to_users_table', 1),
(17, '2026_03_12_174832_update_users_email_unique_constraint', 1),
(18, '2026_03_12_175821_add_is_approved_to_users_table', 1),
(19, '2026_03_13_095540_create_divisions_table', 1),
(20, '2026_03_14_213318_create_section_files_table', 1),
(21, '2026_03_17_095608_create_folders_table', 1),
(22, '2026_03_17_095644_create_section_folder_table', 1),
(23, '2026_03_19_095851_add_indexes_to_documents_tables', 1),
(24, '2026_03_21_225902_create_resource_categories_table', 1),
(25, '2026_03_21_225920_create_resource_folders_table', 1),
(26, '2026_03_21_225936_create_resource_files_table', 1),
(27, '2026_04_11_174731_add_user_id_to_resource_files_table', 1),
(28, '2026_04_18_101914_add_section_to_document_processes_table', 1),
(29, '2026_04_30_120138_alter_documents_change_document_link_to_text', 1),
(30, '2026_05_05_074159_add_deadlines_column_to_documents_table', 2),
(31, '2026_05_11_170126_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('015c5167-17e3-4651-8ddf-7fa338c5bd90', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 10, '{\"document_id\":13,\"title\":\"SDEC Annual Report\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-27 06:44:51', '2026-05-07 10:11:16', '2026-05-27 06:44:51'),
('01fa2950-1980-4196-b6ca-f6e52dc1a2ce', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":110,\"title\":\"RCSP CONVERGENCE\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-25 15:12:50', '2026-08-25 15:12:50'),
('036a14c2-ce8c-481d-86bf-b1865e8c20ba', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":72,\"title\":\"Letter for concerned Mayors\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:50:12', '2026-06-09 17:25:16', '2026-06-09 17:25:16'),
('05c774e2-715f-4a87-8b6a-a5003db79e33', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 27, '{\"document_id\":116,\"title\":\"2026 LG Month Confirmatory Form\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-28 10:01:52', '2026-09-28 10:01:52'),
('06e47915-92af-4e34-b415-740a49c84f6f', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":98,\"title\":\"Post Audit Activity\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-30 11:02:47', '2026-07-30 11:02:47'),
('077f7959-d4f9-43b4-8bee-67883e2621c5', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":41,\"title\":\"Letter to POC RAC Members  for the conduct of POC Pre-Assessment\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:02', '2026-05-20 16:41:01', '2026-05-20 16:41:01'),
('08b17249-ff1d-46a4-8228-f73acd751bb9', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":54,\"title\":\"ECLIP Convergence Request for Change of Date\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 22:02:03', '2026-05-26 17:14:00', '2026-05-26 17:14:00'),
('0b4d950b-d816-4997-9579-7a7526d44b4c', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":28,\"title\":\"Minutes of Meeting on DILG LED\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:34', '2026-05-13 13:43:44', '2026-05-13 13:43:44'),
('0b51fe65-8096-4c75-86eb-2828350a463e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":112,\"title\":\"CSO\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-15 15:55:59', '2026-09-15 15:55:59'),
('0c1e09e8-7d79-40ac-a5fa-963e0669ebe6', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":41,\"title\":\"Letter to POC RAC Members  for the conduct of POC Pre-Assessment\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:02', '2026-05-21 08:13:00', '2026-05-21 11:25:13'),
('0c807bf0-b0a9-46bc-aa9d-742719588c82', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-20 13:21:10', '2026-05-20 08:25:22', '2026-05-20 13:21:10'),
('0d63b9d1-f0b4-4a58-b36d-21fc59175260', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":102,\"title\":\"C4PEACE JULY ACCOMP. REPORT\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-11 15:59:58', '2026-08-11 07:59:11', '2026-08-11 07:59:11'),
('0d8cdf3e-1725-4fb5-a4d5-5d378184ae7a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":50,\"title\":\"RESO CRPOC SAC\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 22:01:58', '2026-05-26 14:24:27', '2026-05-26 14:24:27'),
('0dce8fbb-79fa-406b-99d5-3ca1e0ad5a20', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":49,\"title\":\"NOM 2nd Q ICAD Advocacy Cluster Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:52', '2026-05-28 13:34:45', '2026-05-28 13:34:45'),
('0e0695d4-8d6c-4c04-a43b-251da1ce9864', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":59,\"title\":\"PAGHINGI NG MGA KOMENTO TUNGKOL SA DRAFT OMNIBUS GUIDELINES ON THE IMPLEMENTATION OF RA 10070 O PDAO LAW\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-14 20:22:25', '2026-08-14 20:22:25'),
('0ed655e0-0823-488f-a49b-f3842b575636', 'App\\Notifications\\FocalPersonAssigned', 'App\\Models\\User', 11, '{\"title\":\"Document Assignment\",\"message\":\"You have been assigned as the focal person for: 2026 POGO\",\"document_id\":33,\"assigned_by\":\"LGMED Compass\",\"previous_focal_person\":\"Princes Baisa\",\"assignment_step\":\"Focal Person Assignment\",\"due_date\":\"2026-05-11T08:02:09.000000Z\",\"status\":\"In Progress\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-09-15 13:44:59', '2026-09-15 13:44:59'),
('0f830d91-a312-42d0-a2b8-4b6fd110d7d9', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-13 11:52:29', '2026-06-08 07:47:04', '2026-06-13 11:52:29'),
('0fdb709e-1bd9-49f7-8058-5133ae2bf799', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":83,\"title\":\"ECLIP - PAR (FOR LIQUIDATION)\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 18:10:29', '2026-07-13 14:48:10', '2026-07-13 14:48:10'),
('102829ff-1664-4b9a-a94a-c6dfa20fd93d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":85,\"title\":\"RO re Serbisyo Caravan at Villaviciosa, Abra\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 17:52:50', '2026-07-13 17:47:14', '2026-07-13 17:47:14'),
('11964754-68b8-45a7-a5c5-5f447156902b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":39,\"title\":\"Follow-up Memo to DILG Apayao\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:38:26', '2026-05-20 10:47:34', '2026-05-20 10:47:34'),
('11cc9f5a-1f98-4425-a78c-d0c017932682', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":49,\"title\":\"NOM 2nd Q ICAD Advocacy Cluster Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:52', '2026-05-26 10:30:15', '2026-06-09 16:25:15'),
('11df53b3-a21b-4f12-98db-bf1bff68650f', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":64,\"title\":\"Optimization of the ECLIP-IS\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-28 14:07:00', '2026-05-28 13:31:17', '2026-05-28 13:31:17'),
('124109a7-59b3-405f-b33e-1fc573bdeb42', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":73,\"title\":\"Invitation Letter to SILG\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-06-09 17:49:53', '2026-06-09 17:49:53'),
('13113d52-4f2a-4741-83a6-4b31341752ec', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":59,\"title\":\"PAGHINGI NG MGA KOMENTO TUNGKOL SA DRAFT OMNIBUS GUIDELINES ON THE IMPLEMENTATION OF RA 10070 O PDAO LAW\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-07 11:17:48', '2026-08-07 11:17:48'),
('14bfa6a4-a537-41ab-9e24-76d0a5668a60', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":41,\"title\":\"Letter to POC RAC Members  for the conduct of POC Pre-Assessment\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:02', '2026-05-26 08:51:39', '2026-05-26 08:51:39'),
('15095dd0-df9a-41d2-a35d-734dcdbb1c33', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":61,\"title\":\"POC Program\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:40', '2026-05-28 09:05:41', '2026-05-28 09:05:41'),
('158c881f-f1c3-4619-b488-2a5ac46378cc', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":26,\"title\":\"Justification for a Face-to-Face Modality\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-14 07:39:16', '2026-05-13 11:29:36', '2026-05-13 11:29:36'),
('17f1b3d8-38d7-4758-88ba-d140627776aa', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":22,\"title\":\"dwad\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 13:19:00', '2026-05-11 11:20:13', '2026-05-11 13:19:00'),
('187e8723-7556-4e03-843f-c6de2f3cce15', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":79,\"title\":\"reply to NICA\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-08 14:27:07', '2026-07-08 08:46:48', '2026-07-08 08:46:48'),
('18d991b4-f84c-4be2-a641-7a3e1a391d3c', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 3, '{\"document_id\":32,\"title\":\"New task\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-14 16:10:34', '2026-05-11 15:59:25', '2026-05-11 15:59:28'),
('19baf2b5-e92f-4f94-8a91-c9090104a6e6', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":24,\"title\":\"feafwaf\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 13:19:04', '2026-05-11 11:29:56', '2026-05-11 13:19:04'),
('1a48f4bf-f697-4ad3-85a3-33adbb0e0f64', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":23,\"title\":\"PAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:25', '2026-05-13 07:18:17', '2026-05-13 07:18:17'),
('1a76e2b4-6d23-4237-8050-073211d0ca5a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":78,\"title\":\"Post Activity Report on 2nd QCRPOC\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:15', '2026-08-11 14:01:17', '2026-08-11 14:01:17'),
('1afa4826-40b6-40bc-a0da-10010a68754f', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":55,\"title\":\"CERTIFICATE OF PARTICIPATION\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 10:18:10', '2026-05-26 15:48:05', '2026-07-13 10:18:10'),
('1b1cba62-3bec-46ea-8fb6-8151ff97472b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 19, '{\"document_id\":31,\"title\":\"Follow-up Memo re: Request for Clarification of certain result of the 2025 ADAC Performance Audit concerning Baguio City, Abra and Mountain Province\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-05-14 15:02:29', '2026-05-14 15:02:29'),
('1b84296d-b703-4181-a4ca-e8aebfc6d242', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 18, '{\"document_id\":45,\"title\":\"RCSP MONITORING - CENTRAL OFFICE\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-10-08 08:55:13', '2026-06-03 17:35:20', '2026-07-13 10:18:10'),
('1bdcbea5-6552-477b-8656-47441fdca1ca', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":118,\"title\":\"For Dissemination: INVITATION TO THE 5TH E-LEARNING FOR LOCAL COUNCILS FOR THE PROTECTION OF CHILDREN (LCPCs) 2026 WEBINAR SERIES\",\"message\":\"A document was assigned to you for review.\"}', '2026-09-29 13:48:30', '2026-09-29 09:08:42', '2026-09-29 09:08:42'),
('1c604ae5-f6e2-44d2-bdf9-b8ac8015ff3d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 1, '{\"document_id\":33,\"title\":\"feafwaf\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-14 17:24:34', '2026-05-14 17:24:25', '2026-05-14 17:24:25'),
('1cbad11f-a186-4f01-9fd7-d89491063d65', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":17,\"title\":\"CERT\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 13:19:12', '2026-05-11 07:54:16', '2026-05-11 13:19:12'),
('1e387a97-c529-4b97-a21d-e11065bc1217', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-07-08 16:20:55', '2026-07-08 16:20:55'),
('1e413c35-df45-4c40-8720-bbbd13da010c', 'App\\Notifications\\FocalPersonAssigned', 'App\\Models\\User', 3, '{\"title\":\"Document Assignment\",\"message\":\"You have been assigned as the focal person for: Cert\",\"document_id\":43,\"assigned_by\":\"Ysabel Dominique Mendoza\",\"previous_focal_person\":\"Ysabel Dominique Mendoza\",\"assignment_step\":\"Focal Person Assignment\",\"due_date\":\"2026-05-12T01:23:56.000000Z\",\"status\":\"To Do\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-13 08:44:18', '2026-05-12 09:24:12', '2026-05-13 08:44:18'),
('1e731384-b522-4599-a399-3c8939dfe010', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":76,\"title\":\"FOLLOW-UP SUBMISSION ON THE 1ST CUCPD QUARTER CIR\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-06-16 11:12:17', '2026-06-16 11:12:17'),
('1e98f810-926b-4a50-a420-14634badb68a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":70,\"title\":\"CRPOC Notice of Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:45', '2026-06-03 11:39:06', '2026-06-09 16:25:15'),
('1fb5163d-d401-4ad2-bc30-5a438a616469', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":75,\"title\":\"Letter to NAPOLCOM CAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-29 11:16:29', '2026-06-16 11:29:59', '2026-06-16 11:29:59'),
('20badc5d-cd9e-4ecf-a179-9ffd83538499', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 22, '{\"document_id\":82,\"title\":\"MOM -2ND QUARTER CRPOC MEETING\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-09 16:13:43', '2026-07-09 16:11:27', '2026-07-09 16:13:43'),
('2157c0c9-8572-4c4b-960a-2941d9599e7b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":91,\"title\":\"CRPOC RESO 4 -\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:10', '2026-07-27 11:18:57', '2026-07-27 11:18:57'),
('22785a2d-7111-42a6-8785-18656c13e089', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":36,\"title\":\"PROPOSAL RCSP SCHEDULE\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 10:18:10', '2026-05-20 17:58:01', '2026-07-13 10:18:10'),
('2279e125-5c1a-4c53-b0f9-c4edbba50d69', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":23,\"title\":\"PAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:25', '2026-05-12 16:59:12', '2026-05-13 07:15:01'),
('229652f6-d80d-4a3f-8509-656edd6f9b26', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":41,\"title\":\"Letter to POC RAC Members  for the conduct of POC Pre-Assessment\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:02', '2026-05-20 17:06:05', '2026-06-09 16:25:15'),
('22e54ed4-d6c6-4794-802c-12c56870b5c3', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":89,\"title\":\"LETTER TO CRFV\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-16 08:46:12', '2026-07-16 08:46:12'),
('249ce5bf-c4bc-475e-a948-388acfc06675', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":49,\"title\":\"NOM 2nd Q ICAD Advocacy Cluster Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:52', '2026-05-28 09:06:41', '2026-05-28 09:06:41'),
('249de530-7695-4a0e-a50c-fc3b1177544d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":25,\"title\":\"DILG LED ACCOMPLISHMENT FOR THE MONTH OF APRIL\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:35:17', '2026-05-13 07:27:47', '2026-05-13 07:27:47'),
('24c0aced-194c-4827-9049-27a808cbaf8e', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":54,\"title\":\"LGU Profiling Report\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-13 11:52:29', '2026-05-28 13:54:47', '2026-06-13 11:52:29'),
('24e07846-853d-4014-92fd-1bd56d61e15b', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":39,\"title\":\"nsjshs\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-20 17:38:26', '2026-05-11 17:33:15', '2026-05-11 17:33:18'),
('254c024d-63c4-4399-880a-f26675246467', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 11, '{\"document_id\":15,\"title\":\"Monthly POGO Monitoring Report\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-09 16:25:15', '2026-05-07 10:13:22', '2026-06-09 16:25:15'),
('255ee481-82b2-4660-9dfd-475f43cc58f9', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":95,\"title\":\"1ST SEM DILG LED - ACCOMPLISHMENT\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-28 11:57:57', '2026-07-28 11:57:57'),
('257c6fe6-9996-427f-b861-e10e986a88e3', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":4,\"title\":\"Message\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-07 09:58:12', '2026-05-07 09:54:36', '2026-05-07 09:54:36'),
('25f653cb-7b0c-4752-b3d5-b06710348efc', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":71,\"title\":\"RCSP RO (CONNER, APAYAO)\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-09 11:00:08', '2026-06-08 17:25:22', '2026-07-09 11:00:08'),
('26077b72-973f-409a-b009-dbddd3771cd0', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":83,\"title\":\"ECLIP - PAR (FOR LIQUIDATION)\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 18:10:29', '2026-07-09 16:15:01', '2026-07-09 16:15:01'),
('26620a66-668d-42b7-a5b5-d446ac8cf059', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":51,\"title\":\"BARKADA Monthly Reporting (2026)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-09-18 09:17:38', '2026-09-18 09:17:38'),
('26823a1e-a543-46c9-88f4-c4a66b932b22', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 2, '{\"document_id\":1,\"title\":\"Test\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-04 13:46:20', '2026-05-04 13:40:06', '2026-05-04 13:40:06'),
('268e16fd-8f85-48ce-b256-48bc815f0bd8', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":79,\"title\":\"reply to NICA\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-08 14:27:07', '2026-07-08 14:25:27', '2026-07-08 14:25:27'),
('26b0a874-984f-48a4-950d-5c63c090a605', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":25,\"title\":\"DILG LED ACCOMPLISHMENT FOR THE MONTH OF APRIL\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:35:17', '2026-05-20 09:22:44', '2026-05-20 09:22:44'),
('28177af6-9d3f-4f43-b43e-78104286e042', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":36,\"title\":\"PROPOSAL RCSP SCHEDULE\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-05-20 17:36:07', '2026-05-20 17:36:07'),
('29602e1b-022a-460f-810a-2ad5f7015d72', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":4,\"title\":\"Message\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-07 09:58:12', '2026-05-07 09:56:23', '2026-05-07 09:56:23'),
('296168df-91dc-4c04-82bc-6a2f574e5c8e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":26,\"title\":\"Justification for a Face-to-Face Modality\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-14 07:39:16', '2026-05-13 13:28:07', '2026-05-13 13:28:07'),
('29d061ac-d155-432d-80d8-2ca3f2e6072a', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-13 11:52:29', '2026-06-05 12:43:43', '2026-06-13 11:52:29'),
('2a5131d8-5b3c-434e-aa65-79cea6b4afe1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 22, '{\"document_id\":97,\"title\":\"Request Guidance for SDEC Submission of Report\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-29 11:20:29', '2026-07-29 11:20:29'),
('2ab09955-ba42-4a4f-90c1-a590571aacb3', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 23, '{\"document_id\":107,\"title\":\"LGU Profiling Transmittal to MSAC\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-13 09:58:59', '2026-08-12 16:42:10', '2026-08-13 09:58:59'),
('2b4a85a4-2c03-4e1c-8fcd-a824df5ea7a3', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":53,\"title\":\"CRPOC Confirmation Link\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 15:35:18', '2026-05-26 13:51:49', '2026-05-26 15:35:18'),
('2c3e2916-825e-4f0b-bbc7-5106b6d20f10', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":40,\"title\":\"POC - Change of Date\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-05-20 17:42:47', '2026-05-20 17:42:47'),
('2caa1829-96f0-4dcd-b275-9eb5683d861b', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 1, '{\"document_id\":49,\"title\":\"test\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-09 17:28:52', '2026-05-14 16:00:19', '2026-05-20 07:50:58'),
('2ea33034-05f0-4e45-ac90-01b6d9a54ce4', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 3, '{\"document_id\":4,\"title\":\"Test\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-07 09:58:12', '2026-05-04 13:53:58', '2026-05-07 07:12:56'),
('2ea6c1e8-6e0e-4d06-91c9-459951af1bbc', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":101,\"title\":\"RO KALINGA BDP\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-04 11:08:22', '2026-08-03 09:58:10', '2026-08-03 09:58:10'),
('2ec4d29f-110d-4a9b-8e21-1da2517425bf', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":57,\"title\":\"DRAFT ADVSORY TO ORIENTATION ON DILG LED MEMBERS\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 15:33:20', '2026-06-09 16:25:15'),
('2f0c3ff9-47a0-48c6-959a-dd013942f62e', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 1, '{\"document_id\":25,\"title\":\"Sample\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-20 17:35:17', '2026-05-11 13:17:38', '2026-05-11 13:17:43'),
('2f24fafe-0994-4b5f-a912-21ac420dd8c6', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 3, '{\"document_id\":1,\"title\":\"Test\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-04 13:46:20', '2026-05-04 13:39:54', '2026-05-04 13:39:54'),
('2f3b6f89-f869-4eaf-8cdc-33552d4c9ff1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":59,\"title\":\"DRAFT PROGRAM FOR THE ORIENTATION\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 15:51:14', '2026-06-09 16:25:15'),
('2f666e8c-ece7-491e-8bca-84e650bd078c', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":58,\"title\":\"REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED \\u201cSTRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL\\u201d\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-07 11:16:21', '2026-08-07 11:16:21'),
('2fd2bcdc-714b-41e6-be1b-afbd009892ec', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":68,\"title\":\"FB CAPTION POC PRE-ASSESSMENT\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-06-01 17:09:24', '2026-06-09 16:25:15'),
('325a02d0-7bfc-4f2c-b9ee-f56e09d5070a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":100,\"title\":\"CUCPD AD\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-03 09:47:59', '2026-08-03 09:47:59'),
('32867499-ae31-4d25-8df5-a15b0232fb81', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":62,\"title\":\"PAR ICAD Rehabilitation and Reintegration Cluster\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-31 09:34:24', '2026-06-09 16:25:15'),
('3465a034-6f7d-4ac2-9f1a-a85f84289673', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":105,\"title\":\"DILG LED ACCOM FOR JULY\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-10 20:38:52', '2026-08-10 20:38:52'),
('353c27bf-95ba-4f7e-8e8d-327156c97383', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 1, '{\"document_id\":19,\"title\":\"POGO\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-11 15:45:09', '2026-05-11 14:42:49', '2026-05-11 15:45:09'),
('35a538d4-ad63-4220-b0cf-ec18405339e0', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 27, '{\"document_id\":118,\"title\":\"For Dissemination: INVITATION TO THE 5TH E-LEARNING FOR LOCAL COUNCILS FOR THE PROTECTION OF CHILDREN (LCPCs) 2026 WEBINAR SERIES\",\"message\":\"A document was assigned to you for review.\"}', '2026-09-29 13:48:30', '2026-09-29 13:48:17', '2026-09-29 13:48:17'),
('36b93470-e9d1-48a8-85c2-0738cb07413f', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":86,\"title\":\"RO re RCSP @ Kalinga\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-14 14:18:19', '2026-07-14 11:51:24', '2026-07-14 11:51:24'),
('36c4486d-d627-4bfb-95b1-91b0ca4da5f0', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 22, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-03 14:58:26', '2026-08-03 14:58:26'),
('36de721c-539b-47d5-902b-c72363410a5e', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-14 10:22:50', '2026-05-13 17:57:05', '2026-05-14 10:22:50'),
('36f4bb2b-9121-40a3-bb1b-0852f29ab100', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 27, '{\"document_id\":117,\"title\":\"2026 LG Month Invitation Letter\",\"message\":\"A document was assigned to you for review.\"}', '2026-09-28 10:58:23', '2026-09-28 10:58:09', '2026-09-28 10:58:09'),
('37726b23-8167-47fc-bbee-e286facacf13', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":4,\"title\":\"Message\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-07 09:58:12', '2026-05-07 09:55:49', '2026-05-07 09:55:49'),
('388dbeac-547b-457c-972e-b0307fc0718d', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 22, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-06-17 12:29:03', '2026-06-17 12:29:03'),
('3972351b-45d3-4e57-8701-8da13df1c2aa', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":108,\"title\":\"RO re PRONVICIAL CONVERGENCE @ MP\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-24 10:07:06', '2026-08-24 10:07:06'),
('3a3ef160-c9ff-41c6-b620-0fecb496976b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":100,\"title\":\"CUCPD AD\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-12 11:37:04', '2026-08-03 14:38:28', '2026-08-12 11:37:04'),
('3aa2c375-affb-44c4-9477-fd3b43b69845', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 1, '{\"document_id\":5,\"title\":\"ee56j\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-04 14:28:37', '2026-05-04 13:54:31', '2026-05-04 14:28:37'),
('3bd96b97-6c29-4aa7-94b8-02a28e5d91f3', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 1, '{\"document_id\":2,\"title\":\"IT\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-04 14:28:37', '2026-05-04 13:52:53', '2026-05-04 14:28:37'),
('3c9f84b9-cefd-4543-8650-925363802422', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":114,\"title\":\"LTIA\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-24 14:19:17', '2026-09-24 14:19:17'),
('3d579297-0f22-4274-962b-f1ce77263faf', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":34,\"title\":\"Resume\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-15 15:17:55', '2026-05-11 17:32:29', '2026-05-11 17:32:31'),
('3d71a461-062b-45b9-985b-c20ee08ce167', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":88,\"title\":\"CUCPD Feedback Sheet\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-12 11:37:04', '2026-08-11 08:43:25', '2026-08-12 11:37:04'),
('3d874738-5507-46ec-81cd-512f35095136', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":106,\"title\":\"PAR - EBDP PINUKPUK\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-11 16:02:05', '2026-08-11 16:02:05'),
('3f4fbd4c-bc33-4fe3-b750-d7a20530e742', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-13 11:52:29', '2026-06-13 11:52:06', '2026-06-13 11:52:29'),
('416800c3-04f3-4b7f-a66a-627e575797f1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 27, '{\"document_id\":112,\"title\":\"CSO\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-15 15:55:09', '2026-09-15 15:55:09'),
('41c87c41-25cc-4739-8859-65cee6ea8e73', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 18, '{\"document_id\":45,\"title\":\"RCSP MONITORING - CENTRAL OFFICE\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-10-08 08:55:13', '2026-05-12 15:14:13', '2026-07-13 10:18:10'),
('4272ee4f-143a-4e40-ba22-364b00cd64e1', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 4, '{\"document_id\":11,\"title\":\"POGO\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-05-06 07:23:46', '2026-05-06 07:23:46'),
('42ca5ed9-f996-4e46-ac56-227aeed9727f', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 18, '{\"document_id\":45,\"title\":\"RCSP MONITORING - CENTRAL OFFICE\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-10-08 08:55:13', '2026-05-19 15:54:15', '2026-07-13 10:18:10'),
('4311b30a-db9a-4482-b5a5-aa3d14a01648', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 11, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-10-08 08:47:25', '2026-10-08 08:47:25'),
('431f3183-aff8-4d8e-ba59-0016f27883fa', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 1, '{\"document_id\":6,\"title\":\"file only\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-11 13:34:50', '2026-05-11 13:23:20', '2026-05-11 13:34:50'),
('43d24a21-d75a-4fe5-a023-254916e0163b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":86,\"title\":\"RO re RCSP @ Kalinga\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-14 14:18:19', '2026-07-14 08:27:25', '2026-07-14 08:27:25'),
('445ba7f8-f903-4ec2-98c3-9a7f01163ed7', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":99,\"title\":\"INVITATION TO THE LGA-REGIONAL OFFICE CONSULTATION ON FY 2027 PLANS AND PROGRAMS\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:00', '2026-07-30 17:13:09', '2026-07-30 17:13:09'),
('44ff09f7-c816-4d43-8374-3ad132ecf033', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":24,\"title\":\"PADS Action Plan (Continuing Funds)\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-27 06:44:51', '2026-05-13 07:19:50', '2026-05-27 06:44:51'),
('45607bcc-7792-4c07-ba59-ceca733ca660', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":98,\"title\":\"Post Audit Activity\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-29 11:25:06', '2026-07-29 11:25:06'),
('45b9920a-4a25-47a6-a9ac-63710ab31ad9', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":54,\"title\":\"ECLIP Convergence Request for Change of Date\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 22:02:03', '2026-05-26 14:48:45', '2026-05-26 14:48:45'),
('4715d050-5b22-4019-83bc-77701ea5b422', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 15, '{\"document_id\":65,\"title\":\"2025 BPOC Summary\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-13 11:52:29', '2026-05-28 14:12:55', '2026-06-13 11:52:29'),
('47d36899-10d4-4093-91c8-edaa15e9a7c9', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 22, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-27 16:24:25', '2026-08-27 16:24:25'),
('484de135-2bad-47df-868a-48316efac0e5', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":110,\"title\":\"RCSP CONVERGENCE\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-15 16:22:43', '2026-09-15 16:22:43'),
('48a6d385-0433-41a7-bbb6-49ba4945b24e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 1, '{\"document_id\":2,\"title\":\"MEMo for hjawbdkja\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-05 13:32:05', '2026-05-05 13:24:33', '2026-05-05 13:32:05'),
('48fe9830-adf6-4fd3-abe9-a60ccb177ba7', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":24,\"title\":\"PADS Action Plan (Continuing Funds)\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-12 16:22:57', '2026-06-09 16:25:15'),
('490d8c57-1ca8-40bf-ae3e-6a571706b930', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":108,\"title\":\"RO re PRONVICIAL CONVERGENCE @ MP\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-26 07:47:00', '2026-08-26 07:47:00'),
('49469ebb-6d7c-48dc-9aea-74cfc435ffbe', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":41,\"title\":\"Letter to POC RAC Members  for the conduct of POC Pre-Assessment\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:02', '2026-05-20 17:09:35', '2026-05-20 17:09:35'),
('4bb5bece-68b6-4e9d-8c71-7990c5435065', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":71,\"title\":\"RCSP RO (CONNER, APAYAO)\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-06-08 09:48:44', '2026-06-09 16:25:15'),
('4bd11775-271b-4756-ad81-925acaeac554', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":58,\"title\":\"REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED \\u201cSTRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL\\u201d\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-21 22:15:49', '2026-08-21 22:15:49'),
('4bd8f2e4-92aa-4456-8990-91d8655f8d21', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":78,\"title\":\"Post Activity Report on 2nd QCRPOC\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:15', '2026-06-20 20:45:03', '2026-06-20 20:45:03'),
('4c309bee-31a0-4f72-8548-db6e26d783f2', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":102,\"title\":\"C4PEACE JULY ACCOMP. REPORT\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-11 15:59:58', '2026-08-04 11:09:02', '2026-08-04 11:09:02'),
('4cf09a3b-6f2a-4e2f-a7a2-2bf6c74f92e5', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 3, '{\"document_id\":6,\"title\":\"Test\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-07 07:12:56', '2026-05-04 13:55:08', '2026-05-07 07:12:56'),
('4d62d5d4-450d-4026-9ae2-a0bb6cfadc0a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 15, '{\"document_id\":112,\"title\":\"CSO\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-15 15:53:33', '2026-09-15 15:53:33'),
('4d8efa45-5404-4e9e-a492-51bb35e74c53', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":67,\"title\":\"POC Pre-Assessment Results Comm\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-28 17:16:48', '2026-05-28 15:35:04', '2026-05-28 15:35:04'),
('4de5bcc7-8819-44d9-b21b-4a95cbb7d421', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 10, '{\"document_id\":16,\"title\":\"CBDRP\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-07 10:32:27', '2026-05-07 10:17:20', '2026-05-07 10:32:27'),
('4e5b7e77-f6f5-430b-8fef-ca6cfd1f6da1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":87,\"title\":\"CRPOC 1ST SEM ACCOMPLISHMENT REPORT\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-27 11:10:43', '2026-07-27 11:10:43'),
('4e7ba809-67ae-4692-b13b-cd98e2246da4', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":49,\"title\":\"NOM 2nd Q ICAD Advocacy Cluster Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:52', '2026-05-26 15:34:32', '2026-05-27 06:44:51'),
('4ea9e471-dad0-4aaf-bdb2-4d01049ef8ed', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 18, '{\"document_id\":45,\"title\":\"RCSP MONITORING - CENTRAL OFFICE\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-10-08 08:55:13', '2026-05-21 08:15:00', '2026-07-13 10:18:10'),
('50763957-5a34-44e9-b8b7-374bf2327b14', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-07-01 07:16:06', '2026-07-01 07:16:06'),
('50fa280d-ee2c-4f17-935c-9fcd0895eddc', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 12, '{\"document_id\":14,\"title\":\"Sample PPA\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-07 22:26:25', '2026-05-07 22:25:50', '2026-05-07 22:26:25'),
('5110bf77-96d6-46d0-a270-ea1b2b58ea87', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 3, '{\"document_id\":34,\"title\":\"Testing\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-15 15:17:55', '2026-05-15 15:17:05', '2026-05-15 15:17:05'),
('517c943d-1a1b-4490-b8d5-665de923b682', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":43,\"title\":\"REQUEST TO PROCAR RE ORIENTATION JRTF members regarding their respective functions\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-21 08:23:23', '2026-06-09 16:25:15'),
('52da7af9-2572-4c3e-94b7-00bc0605e57d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":75,\"title\":\"Letter to NAPOLCOM CAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-29 11:16:29', '2026-06-23 08:20:56', '2026-06-23 08:20:56'),
('54bc4ba4-6be7-4e31-9270-1eb0e836b708', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":46,\"title\":\"ECLIP CONFIRMATION LINK\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 15:35:18', '2026-05-26 13:58:58', '2026-05-26 15:35:18'),
('55083e91-8c53-47e9-bc1e-733fdc799ae8', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":42,\"title\":\"APPROVAL AND ALLOCATION OF FUNDS FOR THE IMPLEMENTATION AND INSTALLATION OF THE OFFICE CUBICLES IN THE LGMED\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:35:12', '2026-05-20 17:19:56', '2026-05-20 17:19:56'),
('55847207-dd96-4887-8212-9106e4ef7f8f', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 3, '{\"document_id\":20,\"title\":\"New task\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 15:58:58', '2026-05-11 11:07:26', '2026-05-11 15:58:58'),
('5600dcc0-e873-4466-8f2c-cafeef84b115', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":66,\"title\":\"Amendment to RO RCSP (JUNE 4)\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-28 14:06:20', '2026-06-09 16:25:15'),
('561494ab-2015-4f12-9a1a-3955e5af83d2', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":72,\"title\":\"Letter for concerned Mayors\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:50:12', '2026-06-09 17:14:52', '2026-06-09 17:14:52'),
('571d9697-14d4-4db4-8fe0-8d30ab849c5e', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":51,\"title\":\"BARKADA Monthly Reporting (2026)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-09-18 09:17:27', '2026-08-27 17:43:51', '2026-09-18 09:17:27'),
('582a6278-1a49-400c-8393-908e3019a7ba', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":25,\"title\":\"DILG LED ACCOMPLISHMENT FOR THE MONTH OF APRIL\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:35:17', '2026-05-13 09:03:34', '2026-05-13 09:03:34'),
('58b2c0b7-0dc7-4bf4-b006-f13ce0f9c97b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":47,\"title\":\"RCSP TARPAULIN DESIGN\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 08:51:56', '2026-06-09 16:25:15'),
('59792625-1e5e-455a-ad1c-814e83017f19', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":52,\"title\":\"Barangay Road Clearing Operations (BaRCO)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-27 17:43:51', '2026-08-27 17:43:51'),
('59d304a7-4adc-4c8e-bf4c-c26ab22dbf2b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":23,\"title\":\"PAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:25', '2026-05-13 07:17:08', '2026-05-13 07:17:08'),
('5a86a668-2713-4240-ad5c-7e84ae16b477', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 15, '{\"document_id\":107,\"title\":\"LGU Profiling Transmittal to MSAC\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-12 17:24:57', '2026-08-12 17:24:57'),
('5aab099b-2e4b-46c9-ab14-caf38a21912b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":63,\"title\":\"Amendment to RO RCSP (JUNE 4)\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-28 13:30:43', '2026-05-28 09:18:31', '2026-05-28 13:30:43'),
('5b75623f-ffbb-4983-bdd4-6455ef6b2d2b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":102,\"title\":\"C4PEACE JULY ACCOMP. REPORT\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-11 15:59:58', '2026-08-04 15:55:18', '2026-08-04 15:55:18'),
('5c46ac6b-0078-444a-ade9-ceadeef55e48', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":91,\"title\":\"CRPOC RESO 4 -\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:10', '2026-07-16 08:18:39', '2026-07-16 08:18:39'),
('5cfd1673-b9ce-4b57-8d87-04dff7b0256b', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":51,\"title\":\"BARKADA Monthly Reporting (2026)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-09-30 15:10:20', '2026-09-30 15:10:20'),
('5d801ab0-641f-4003-a840-43b92b043c44', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 1, '{\"document_id\":35,\"title\":\"Testing\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-15 19:01:19', '2026-05-15 19:01:10', '2026-05-15 19:01:10'),
('5e06bf60-5fed-4329-9234-c36981df2460', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":88,\"title\":\"CUCPD Feedback Sheet\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-04 11:30:46', '2026-08-04 11:30:46');
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('5f3f2d27-08db-43e1-be15-82aaabfa05f2', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":86,\"title\":\"RO re RCSP @ Kalinga\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-14 14:18:19', '2026-07-14 10:13:27', '2026-07-14 10:13:27'),
('5fe51e8b-c3a6-44c1-b736-6d16e71b156f', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":29,\"title\":\"dwad\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 16:53:04', '2026-05-11 14:58:39', '2026-05-11 16:53:04'),
('603530e1-a70d-4be8-ae83-cc4a48d0dd69', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":23,\"title\":\"PAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:25', '2026-05-13 07:21:59', '2026-05-13 07:21:59'),
('6036088c-250c-4c55-afc4-476d89dccd31', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 22, '{\"document_id\":89,\"title\":\"LETTER TO CRFV\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-16 08:22:31', '2026-07-14 16:23:56', '2026-07-16 08:22:31'),
('604b5cf1-2dc3-41bf-99e5-fa5a9b9db6b1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":88,\"title\":\"CUCPD Feedback Sheet\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-14 15:40:43', '2026-07-14 15:40:43'),
('612af733-0b4b-45ab-a6ad-d3852518b503', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":80,\"title\":\"ECLIP - PAR (FOR LIQUIDATION)\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-09 13:18:57', '2026-07-09 13:18:57'),
('61615b5e-5abe-4c28-a5d5-dabb74330645', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":51,\"title\":\"RCSP TARPAULIN DESIGN\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 11:27:58', '2026-06-09 16:25:15'),
('6168daf8-5a2e-4d3c-9152-a3e503760c14', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":25,\"title\":\"DILG LED ACCOMPLISHMENT FOR THE MONTH OF APRIL\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:35:17', '2026-05-13 07:48:28', '2026-05-13 07:48:28'),
('618ad31e-1200-4b74-bf6e-c5c8cec9eaec', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 27, '{\"document_id\":115,\"title\":\"2026 LG Month Confirmatory Slip\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-28 09:55:22', '2026-09-28 09:55:22'),
('6198807d-c932-48a7-9c54-7f62dbbf047c', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 4, '{\"document_id\":11,\"title\":\"POGO\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-05 14:59:30', '2026-05-05 14:49:14', '2026-05-05 14:59:30'),
('61e6b9fd-817c-4e1a-be96-b5d4536fccaa', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":87,\"title\":\"CRPOC 1ST SEM ACCOMPLISHMENT REPORT\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-14 18:07:43', '2026-07-14 18:07:43'),
('6363d97a-e471-4004-9d22-97ff908930ec', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":51,\"title\":\"BARKADA Monthly Reporting (2026)\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-02 15:05:04', '2026-05-21 08:24:38', '2026-06-02 15:05:04'),
('6374167d-e969-43a8-8ede-d752e3d8ff59', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 11, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-10-06 13:30:44', '2026-10-06 13:30:44'),
('6412d9f1-f76b-48fa-9dd2-ee124fe45563', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 12, '{\"document_id\":16,\"title\":\"Sample\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-11 13:53:04', '2026-05-11 13:19:26', '2026-05-11 13:53:04'),
('65099caa-2418-4064-a0fe-b849b5c80b74', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":121,\"title\":\"Letter for Interviewer\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-10-08 08:54:52', '2026-10-08 08:54:52'),
('6594673f-9e82-48c4-8ece-87eee7f7bec1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":29,\"title\":\"CBDRP Concept Note\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-14 10:17:09', '2026-06-09 16:25:15'),
('66af8661-769e-41a5-923c-e0944ddf2893', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":94,\"title\":\"MEMO re FASTRACKING OF RCSP SCHEDULE TO KALINGA AND MP\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-30 11:04:28', '2026-07-30 11:04:28'),
('66ec0f15-4eae-415a-9dee-c76c425a378e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":49,\"title\":\"NOM 2nd Q ICAD Advocacy Cluster Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:52', '2026-05-26 16:08:52', '2026-06-09 16:25:15'),
('670c6a3e-4ee1-4fa6-b982-a080afb41b4e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":68,\"title\":\"FB CAPTION POC PRE-ASSESSMENT\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 10:18:10', '2026-06-03 11:47:34', '2026-07-13 10:18:10'),
('676a3566-64c9-413f-a9b3-7aabe6c1b663', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":87,\"title\":\"CRPOC 1ST SEM ACCOMPLISHMENT REPORT\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-14 15:48:36', '2026-07-14 15:48:36'),
('68063878-a28f-41e7-a165-0277d8d96e8e', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":56,\"title\":\"STAT\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-03 12:02:09', '2026-08-03 12:02:09'),
('6848d125-785e-4fce-8271-058f7f2414ff', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":46,\"title\":\"ECLIP CONFIRMATION LINK\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 08:24:46', '2026-06-09 16:25:15'),
('691d0324-bc3f-4234-9a8d-0c492f78baa5', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":81,\"title\":\"Submission of Annex A\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-09 16:29:58', '2026-07-09 15:55:08', '2026-07-09 15:55:08'),
('6b6bf80f-bc51-4a4a-8d08-eead470c0af4', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 11, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-09 16:25:15', '2026-05-20 09:10:23', '2026-06-09 16:25:15'),
('6c30be1d-2296-4594-83b0-22fe127828af', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":94,\"title\":\"MEMO re FASTRACKING OF RCSP SCHEDULE TO KALINGA AND MP\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-27 17:42:10', '2026-07-27 17:42:10'),
('6cd938bc-3f51-46ee-8377-639254494a6d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":50,\"title\":\"RESO CRPOC SAC\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 22:01:58', '2026-05-26 11:12:22', '2026-05-26 11:12:22'),
('6cf273db-f5b6-49ae-84a1-0b38f48b40ee', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":104,\"title\":\"MEMO RE DDB POLICY ISSUANCE\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-05 11:01:18', '2026-08-05 11:01:18'),
('6df251be-48ef-4f37-be6f-13a7b6e72356', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":45,\"title\":\"Memo to FOUs re RAC activities\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:13', '2026-05-21 16:50:38', '2026-06-09 16:25:15'),
('6e299834-af8f-4dc8-a4eb-5e57ee34a948', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":62,\"title\":\"PAR ICAD Rehabilitation and Reintegration Cluster\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-10 08:35:12', '2026-05-28 09:12:45', '2026-06-10 08:35:12'),
('6f1dc64e-3147-4111-a494-372f9946e16c', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 7, '{\"document_id\":2,\"title\":\"MEMo for hjawbdkja\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-05-05 13:23:34', '2026-05-05 13:23:34'),
('6f6069e5-863a-449c-a465-2dbbcc4c6e9d', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 3, '{\"document_id\":8,\"title\":\"Test\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-07 07:12:56', '2026-05-04 13:55:51', '2026-05-07 07:12:56'),
('6fe0b366-88be-4d25-9eb7-b8b38b929117', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 2, '{\"document_id\":7,\"title\":\"dwad\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-04 13:57:57', '2026-05-04 13:55:21', '2026-05-04 13:57:57'),
('6fe236f6-a3d5-438b-b51a-0330c4caf1dc', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":4,\"title\":\"Message\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-07 09:58:12', '2026-05-07 09:52:12', '2026-05-07 09:52:12'),
('71962e0a-808a-4c6e-860f-c25e539aabcb', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":28,\"title\":\"Certi\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-20 17:36:34', '2026-05-11 14:58:04', '2026-05-11 16:53:04'),
('71a937e8-ef90-4797-8644-060bf3accd89', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 15, '{\"document_id\":120,\"title\":\"PEO II TOR\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-10-08 08:53:31', '2026-10-08 08:53:31'),
('71ea1baa-2ab8-46ec-b45b-7bc9f1081aad', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":62,\"title\":\"PAR ICAD Rehabilitation and Reintegration Cluster\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-10 08:35:12', '2026-06-01 17:48:40', '2026-06-10 08:35:12'),
('729474cc-04ce-42d0-b3dd-301cc79e8d88', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 22, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-18 13:41:38', '2026-08-18 13:41:38'),
('72b9a7c1-233c-45d5-9431-a523637703a0', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":21,\"title\":\"CERT\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 13:19:07', '2026-05-11 11:07:28', '2026-05-11 13:19:07'),
('7334ce53-92c6-48eb-a646-45c171af8f13', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":110,\"title\":\"RCSP CONVERGENCE\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-28 11:08:45', '2026-09-28 11:08:45'),
('747aebcc-879d-4f5e-a1b9-9fd1c8d0142e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":74,\"title\":\"2026 IDADAIT  Celebration\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-06-15 13:44:48', '2026-06-15 13:44:48'),
('74fd5169-8e3a-412e-8853-46d706725e7f', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":45,\"title\":\"Memo to FOUs re RAC activities\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:13', '2026-08-11 14:01:58', '2026-08-11 14:01:58'),
('7526a7f4-6224-423b-b23c-a1c5eb9baffc', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":121,\"title\":\"Letter for Interviewer\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-10-08 08:09:36', '2026-10-08 08:09:36'),
('7624e503-7aca-4897-8c64-3a45af9ca6d2', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":78,\"title\":\"Post Activity Report on 2nd QCRPOC\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:15', '2026-06-25 15:55:20', '2026-06-25 15:55:20'),
('777c29f7-257a-4fe2-b741-7f81e610547c', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":108,\"title\":\"RO re PRONVICIAL CONVERGENCE @ MP\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-24 12:00:03', '2026-08-24 12:00:03'),
('78a9112b-2dd7-43fa-a5cf-4d8bccc007ab', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 3, '{\"document_id\":40,\"title\":\"New task\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 17:35:05', '2026-05-11 17:35:02', '2026-05-11 17:35:05'),
('79751d32-f235-46f6-8b89-35a3f59c055f', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":65,\"title\":\"2025 BPOC Summary\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-28 13:53:35', '2026-06-09 16:25:15'),
('7a26d5d4-72a6-48a5-a613-da523f33cb68', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":38,\"title\":\"Follow-up Memo to DILG Benguet\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-27 06:44:51', '2026-05-20 09:19:33', '2026-05-27 06:44:51'),
('7b667156-02ee-4eca-ba8b-818585a41a31', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":52,\"title\":\"Barangay Road Clearing Operations (BaRCO)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-08-12 09:01:19', '2026-06-29 09:25:58', '2026-08-12 09:01:19'),
('7bc8bd7c-2fe1-42df-9603-d675757d1894', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":35,\"title\":\"Annex\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-15 19:01:19', '2026-05-11 17:32:29', '2026-05-11 17:32:31'),
('7bd99c34-7ac9-41bc-acaf-6045348eb8f5', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":118,\"title\":\"For Dissemination: INVITATION TO THE 5TH E-LEARNING FOR LOCAL COUNCILS FOR THE PROTECTION OF CHILDREN (LCPCs) 2026 WEBINAR SERIES\",\"message\":\"A document was assigned to you for review.\"}', '2026-09-29 13:48:30', '2026-09-29 13:41:12', '2026-09-29 13:41:12'),
('7c583c90-f261-40d2-8c88-db8fe8d695a8', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":38,\"title\":\"Follow-up Memo to DILG Benguet\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 09:12:41', '2026-05-20 08:58:25', '2026-05-20 09:12:41'),
('7ce0cce4-e5fa-4aa3-a86f-dbb5a5722935', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":54,\"title\":\"LGU Profiling Report\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-07-01 07:16:06', '2026-07-01 07:16:06'),
('7da3d2ce-6a6c-4a96-b3e3-559e75790f07', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":87,\"title\":\"CRPOC 1ST SEM ACCOMPLISHMENT REPORT\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-14 14:49:19', '2026-07-14 14:49:19'),
('7dbf9707-7bb2-41ad-85ec-e3e46a083c6c', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":111,\"title\":\"CUCPD re AVP FOR LG MONTH\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-28 11:10:20', '2026-09-28 11:10:20'),
('7e2965c7-5064-4f5e-a142-d598cc581c50', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 3, '{\"document_id\":11,\"title\":\"POGO\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 17:41:47', '2026-05-07 07:13:09', '2026-05-11 17:41:47'),
('7ed97ce5-c71e-4fb8-8464-f4c4ca2811d9', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":54,\"title\":\"LGU Profiling Report\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-13 11:52:29', '2026-06-08 07:47:04', '2026-06-13 11:52:29'),
('7fc75278-e4de-4bfa-ab6b-e27bf8abda7f', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":58,\"title\":\"REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED \\u201cSTRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL\\u201d\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-06 20:39:23', '2026-08-06 20:39:23'),
('800c5796-8eda-47af-9027-263f57b7ff55', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 1, '{\"document_id\":14,\"title\":\"Sample PPA\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 09:53:42', '2026-05-07 10:12:25', '2026-05-11 09:53:42'),
('812d59be-b547-4275-be03-1018bb693f91', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 3, '{\"document_id\":10,\"title\":\"Test\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-07 07:12:56', '2026-05-04 15:54:32', '2026-05-07 07:12:56'),
('81975eae-bd30-4b41-86ed-49faba006429', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":48,\"title\":\"dwaddaw\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-14 14:09:15', '2026-05-14 09:47:32', '2026-05-14 14:09:15'),
('823f40fe-9191-47c8-9516-88862699b6b9', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":92,\"title\":\"CRPOC MOM 2ND QUARTER\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:24', '2026-07-24 06:33:00', '2026-07-24 06:33:00'),
('8278e1dd-c2f0-4855-82bc-3d4eb7bd06ca', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 15, '{\"document_id\":114,\"title\":\"LTIA\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-24 14:24:12', '2026-09-24 14:24:12'),
('83fe79f9-41a1-4398-8df3-6ca05388ad8a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":92,\"title\":\"CRPOC MOM 2ND QUARTER\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:24', '2026-08-11 14:00:34', '2026-08-11 14:00:34'),
('852a86dd-88b3-466c-9f52-6e469f914e7d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":56,\"title\":\"ICAD 2nd Quarter Change of Date\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 22:02:08', '2026-05-26 15:49:47', '2026-05-26 15:49:47'),
('85fa9120-9b01-4b80-a31b-34a10e055b4a', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 18, '{\"document_id\":45,\"title\":\"RCSP MONITORING - CENTRAL OFFICE\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-10-08 08:55:13', '2026-05-20 17:19:14', '2026-07-13 10:18:10'),
('85fd46bf-2209-4be4-971e-2116d4560d6d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":46,\"title\":\"ECLIP CONFIRMATION LINK\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 15:35:18', '2026-05-26 09:21:17', '2026-05-26 15:35:18'),
('871f94f0-b28b-4b1b-ac1b-54b7590ed25e', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 22, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-07-14 15:50:04', '2026-06-23 08:59:02', '2026-07-14 15:50:04'),
('87d82b03-7e74-426e-9740-e78e0b0925e1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":104,\"title\":\"MEMO RE DDB POLICY ISSUANCE\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-11 07:58:41', '2026-08-11 07:58:41'),
('88551c65-15aa-4c16-bdb2-6a3fae790bc6', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":45,\"title\":\"Memo to FOUs re RAC activities\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:13', '2026-05-26 08:50:59', '2026-05-26 08:50:59'),
('88ac2be5-caa8-4888-a608-4076711d455c', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":56,\"title\":\"ICAD 2nd Quarter Change of Date\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 22:02:08', '2026-05-26 17:13:29', '2026-05-26 17:13:29'),
('88cf01f9-6294-4c5a-b0fc-0f59d69d17a4', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":88,\"title\":\"CUCPD Feedback Sheet\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-04 15:52:07', '2026-08-04 15:52:07'),
('8a33755a-ce26-45cd-bc23-606c2133a764', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":24,\"title\":\"PADS Action Plan (Continuing Funds)\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-12 17:19:54', '2026-06-09 16:25:15'),
('8c3ac6be-a977-4aec-8955-72696987b1ea', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":59,\"title\":\"DRAFT PROGRAM FOR THE ORIENTATION\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 10:18:10', '2026-05-26 16:09:34', '2026-07-13 10:18:10'),
('8c61e6e8-fc17-46cc-aed0-4c592c6105e4', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":64,\"title\":\"Optimization of the ECLIP-IS\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-28 14:07:00', '2026-05-28 11:23:58', '2026-05-28 11:23:58'),
('8c63fec2-2265-4d68-9d2c-1b044f85bb67', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 27, '{\"document_id\":116,\"title\":\"2026 LG Month Confirmatory Form\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-28 09:08:44', '2026-09-28 09:08:44'),
('8f66ba60-b70a-430f-812b-e719605ebef9', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":103,\"title\":\"(CUCPD) Submission of Feedback on the PPAs of the 4 sectors\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-04 11:33:42', '2026-08-04 11:33:42'),
('90bd310e-9e9e-44a5-9454-ee89c9e70485', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":48,\"title\":\"ECLIP MRM\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-05-26 10:16:30', '2026-05-26 10:16:30'),
('91385b68-c309-4781-aeaa-6ed4e733fa0d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":101,\"title\":\"RO KALINGA BDP\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-04 11:08:22', '2026-08-03 18:15:34', '2026-08-03 18:15:34'),
('91f7d301-2174-4b08-aeae-3dc03fe309f5', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-14 10:22:50', '2026-05-14 10:17:37', '2026-05-14 10:22:50'),
('931531cc-48e3-4cad-9e1d-2bf480e36052', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":68,\"title\":\"FB CAPTION POC PRE-ASSESSMENT\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-03 11:46:01', '2026-06-01 17:50:04', '2026-06-03 11:46:01'),
('93f06186-5af3-4d44-8040-03f00585e9bb', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":58,\"title\":\"REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED \\u201cSTRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL\\u201d\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-14 20:22:25', '2026-08-14 20:22:25'),
('9515c567-84f5-458d-bd4e-dbbb0634719b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":39,\"title\":\"Follow-up Memo to DILG Apayao\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:38:26', '2026-05-20 17:10:35', '2026-05-20 17:10:35'),
('959d977d-a0d3-4481-964e-7dfa30e19dd6', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":72,\"title\":\"Letter for concerned Mayors\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:50:12', '2026-06-09 15:59:22', '2026-06-09 15:59:22'),
('95e34133-3829-43d3-b576-760d87c6d163', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":41,\"title\":\"Letter to POC RAC Members  for the conduct of POC Pre-Assessment\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:02', '2026-05-21 08:30:34', '2026-06-09 16:25:15'),
('95f05962-3e81-4434-9581-5d156163de7a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":45,\"title\":\"Memo to FOUs re RAC activities\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:13', '2026-05-21 16:36:48', '2026-05-21 16:36:48'),
('96510204-13e0-43c9-9e73-15b2989ff1b6', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 2, '{\"document_id\":9,\"title\":\"dwad\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-04 13:57:57', '2026-05-04 13:55:59', '2026-05-04 13:57:57'),
('9697f3ab-d4fc-48e5-80a2-35a5e7f13132', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":60,\"title\":\"REQUEST FOR INPUT ON THE DRAFT GUIDELINES  FOR THE IMPLEMENTATION OF THE 2026-2028 SEAL  OF GOOD LOCAL GOVERNANCE\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-24 18:30:46', '2026-08-24 18:30:46'),
('97813285-2d65-49b2-ae82-994deade4650', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":88,\"title\":\"CUCPD Feedback Sheet\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-16 08:23:39', '2026-07-14 15:55:38', '2026-07-16 08:23:39'),
('97f2b313-9ce3-4ba5-99a7-159373d060ef', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-06-25 18:34:16', '2026-06-25 18:34:16'),
('98975f94-d400-49ef-bf98-814c356dfe73', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":105,\"title\":\"DILG LED ACCOM FOR JULY\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-11 08:01:56', '2026-08-11 08:01:56'),
('98ba43e9-2537-4a62-aae5-1698d0e6e32d', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":52,\"title\":\"Barangay Road Clearing Operations (BaRCO)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-02 15:04:21', '2026-06-02 15:00:41', '2026-06-02 15:04:21'),
('98be3db6-742f-40a7-ba13-4d42fa5bb616', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 1, '{\"document_id\":32,\"title\":\"Cert\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-14 16:10:34', '2026-05-14 16:10:01', '2026-05-14 16:10:01'),
('98f4b554-2f78-4c47-98a3-67dd8c3043f4', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":62,\"title\":\"PAR ICAD Rehabilitation and Reintegration Cluster\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 23:42:31', '2026-06-09 16:25:15'),
('994968e3-1024-49f8-afa6-1a7911dfbdaf', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":23,\"title\":\"PAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:25', '2026-05-12 16:42:34', '2026-05-12 16:45:42'),
('9970e264-4769-45a2-87c1-22105d073589', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":39,\"title\":\"Follow-up Memo to DILG Apayao\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:38:26', '2026-05-20 13:25:03', '2026-05-20 13:25:03'),
('99e5d873-4319-4bdb-9e5a-7fb57fc7570f', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":58,\"title\":\"REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED \\u201cSTRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL\\u201d\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-08-03 17:29:13', '2026-08-03 17:25:02', '2026-08-03 17:29:13'),
('9ac1bb25-3557-4ad4-9858-7d433761fe81', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":58,\"title\":\"REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED \\u201cSTRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL\\u201d\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-12 17:19:43', '2026-08-12 17:19:43'),
('9b1086a5-6c5c-4c9b-83ed-047d95bb7d7d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 2, '{\"document_id\":1,\"title\":\"Test\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-04 13:46:20', '2026-05-04 13:39:08', '2026-05-04 13:39:23'),
('9b368179-e06f-434f-86fe-674aa6b52189', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":60,\"title\":\"REQUEST FOR INPUT ON THE DRAFT GUIDELINES  FOR THE IMPLEMENTATION OF THE 2026-2028 SEAL  OF GOOD LOCAL GOVERNANCE\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-31 23:53:10', '2026-08-31 23:53:10'),
('9b41da36-890b-42ed-8e75-24a4a2d54752', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":58,\"title\":\"RCSP SCHEDULE\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 15:43:38', '2026-06-09 16:25:15'),
('9bbcc41a-5ac1-41c7-b534-6cc557ee5181', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":66,\"title\":\"Amendment to RO RCSP (JUNE 4)\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-05-28 14:08:59', '2026-05-28 14:08:59'),
('9c3d4c51-5de7-4164-a7a2-f8d3aeb86f73', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":52,\"title\":\"Barangay Road Clearing Operations (BaRCO)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-08-12 09:01:19', '2026-08-12 09:00:38', '2026-08-12 09:01:19'),
('9e5e4f36-7d0f-45f7-9000-b01cbf01901b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 1, '{\"document_id\":1,\"title\":\"Test\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-04 13:46:20', '2026-05-04 13:40:52', '2026-05-04 13:41:12'),
('9e9044d5-7e6a-4857-817e-987ecde7cddf', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":46,\"title\":\"ECLIP CONFIRMATION LINK\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 11:25:42', '2026-06-09 16:25:15'),
('9fe9a525-c8d9-4436-a5b0-8121cd51b1a1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":23,\"title\":\"PAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:25', '2026-05-12 17:07:14', '2026-05-13 07:16:56'),
('a01333cf-59c8-47a0-ad0d-8ed007417bcf', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 3, '{\"document_id\":35,\"title\":\"Testing\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-15 19:01:19', '2026-05-15 19:01:02', '2026-05-15 19:01:02'),
('a0f438ae-0c1c-469f-90ed-a3e3f123891c', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":58,\"title\":\"REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED \\u201cSTRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL\\u201d\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-04 14:25:10', '2026-08-04 14:25:10'),
('a1793556-e4ad-4d4f-bd35-b8200240c911', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":51,\"title\":\"BARKADA Monthly Reporting (2026)\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-02 15:05:04', '2026-06-02 15:00:41', '2026-06-02 15:05:04'),
('a2478231-7412-4590-9ff6-551ec95d49e2', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":58,\"title\":\"REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED \\u201cSTRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL\\u201d\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-24 18:29:43', '2026-08-24 18:29:43'),
('a25339e5-2f73-4e1a-8821-5adf7a940d0b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":23,\"title\":\"PAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:25', '2026-05-12 16:34:49', '2026-05-12 16:34:49'),
('a2fd4943-b8de-4388-8b50-804568f84964', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":61,\"title\":\"POC Program\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:40', '2026-05-26 22:03:39', '2026-06-09 16:25:15'),
('a328b702-6833-469f-8ce1-5fe1920c7642', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":4,\"title\":\"Message\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-07 09:58:12', '2026-05-07 09:53:05', '2026-05-07 09:53:05'),
('a4ba49ae-6e2e-44a8-89e3-a865052e7b94', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 3, '{\"document_id\":32,\"title\":\"Cert\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-14 16:10:34', '2026-05-14 16:09:49', '2026-05-14 16:09:49'),
('a62a5c4a-56f0-4b4e-8e41-7623709b4f46', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":27,\"title\":\"POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 16:53:04', '2026-05-11 14:07:12', '2026-05-11 16:53:04'),
('a679ed79-4d1b-4409-9929-b30f8aef300a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":28,\"title\":\"Minutes of Meeting on DILG LED\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:34', '2026-05-13 16:20:40', '2026-05-13 16:20:40'),
('a7d1aa45-556b-4acb-9ad3-bf7b86d465f6', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":23,\"title\":\"PAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:25', '2026-05-20 17:14:07', '2026-05-20 17:14:07'),
('a80422df-07fc-44b9-8dd9-af40681e4bbd', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":75,\"title\":\"Letter to NAPOLCOM CAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-29 11:16:29', '2026-06-16 09:20:23', '2026-06-16 09:20:23'),
('a9eca900-7e40-408c-9c48-eb16f5109569', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":58,\"title\":\"REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED \\u201cSTRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL\\u201d\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-31 23:53:10', '2026-08-31 23:53:10'),
('aa2d6203-017b-4b84-9a0d-70bf9fef0d17', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":113,\"title\":\"Philippine National Action Plan on Women, Peace and Security\",\"message\":\"A document was assigned to you for review.\"}', '2026-09-29 13:42:14', '2026-09-15 16:51:20', '2026-09-15 16:51:20'),
('aa47791b-cf27-485f-9d9e-ef50af286a49', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":99,\"title\":\"INVITATION TO THE LGA-REGIONAL OFFICE CONSULTATION ON FY 2027 PLANS AND PROGRAMS\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:00', '2026-08-11 14:02:12', '2026-08-11 14:02:12'),
('aae765a1-0a28-4244-90cb-32f67985b951', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":73,\"title\":\"Invitation Letter to SILG\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-06-15 13:45:16', '2026-06-15 13:45:16'),
('aaed9a26-37d3-4992-b8bb-e5ea32d6a0c2', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":55,\"title\":\"CERTIFICATE OF PARTICIPATION\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 15:17:32', '2026-06-09 16:25:15'),
('abe8cc35-e4c2-424d-9179-c54b2a1862c3', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 22, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-07-20 09:14:59', '2026-07-20 09:14:59'),
('ace538c7-6a1e-4fd9-b51f-69e645eb748e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":84,\"title\":\"MINUTES OF MEETING 2ND CRPOC\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:05', '2026-08-11 14:01:37', '2026-08-11 14:01:37'),
('ad139565-fabe-48bd-8f5d-7e3047f74b70', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 7, '{\"document_id\":11,\"title\":\"POGO\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-05-05 13:30:09', '2026-05-05 13:30:09'),
('ad4d46b5-3d74-466f-943a-40451d3c97f7', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":91,\"title\":\"CRPOC RESO 4 -\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:10', '2026-08-11 14:01:28', '2026-08-11 14:01:28'),
('ae91e5cb-8a1b-4760-b9bd-f2899ccf1238', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":3,\"title\":\"Letter to JVOFI\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-07 09:49:44', '2026-06-09 16:25:15'),
('aec0f91b-f040-4a3a-89b4-aa55d61bfd1d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":84,\"title\":\"MINUTES OF MEETING 2ND CRPOC\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:05', '2026-07-13 10:17:58', '2026-07-13 10:17:58'),
('af409f35-86c7-416b-81a8-ae5ae3b5853c', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 7, '{\"document_id\":2,\"title\":\"MEMo for hjawbdkja\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-05-05 13:24:53', '2026-05-05 13:24:53'),
('b03108f9-ed03-40be-a1e1-bbdf11a5904f', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":46,\"title\":\"Cert\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-13 08:21:42', '2026-05-13 07:46:17', '2026-05-13 08:21:42'),
('b1247956-5af3-4134-bb7e-baa40009bfca', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":40,\"title\":\"POC - Change of Date\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-21 10:18:01', '2026-05-20 17:48:31', '2026-05-21 10:18:01'),
('b160a927-39df-4615-93e8-f78f97884ac3', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":42,\"title\":\"APPROVAL AND ALLOCATION OF FUNDS FOR THE IMPLEMENTATION AND INSTALLATION OF THE OFFICE CUBICLES IN THE LGMED\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:35:12', '2026-05-20 17:30:40', '2026-05-20 17:30:40'),
('b17442f8-2ccf-4191-9236-d2def8c7d190', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":4,\"title\":\"Message\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-07 09:58:12', '2026-05-07 09:57:49', '2026-05-07 09:57:49'),
('b1ca1700-0a08-43a9-9a8d-46fdec518394', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":48,\"title\":\"ECLIP MRM\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 09:56:17', '2026-06-09 16:25:15'),
('b227856e-3f3d-439d-9703-ea89f120607c', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":26,\"title\":\"POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-14 07:39:16', '2026-05-11 13:26:15', '2026-05-11 13:26:19'),
('b29a591c-b757-4f10-9327-0757b9aa3459', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-13 11:52:29', '2026-05-28 10:51:11', '2026-06-13 11:52:29'),
('b2ab267d-5ac1-4d26-83bd-717f94722a7d', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":47,\"title\":\"LTIA Data Analysis\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-13 11:52:29', '2026-05-26 07:42:41', '2026-06-13 11:52:29'),
('b30a95a0-5040-4a47-be4b-7310a92ac1a1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":85,\"title\":\"RO re Serbisyo Caravan at Villaviciosa, Abra\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 17:52:50', '2026-07-13 17:41:06', '2026-07-13 17:41:06'),
('b3237003-8881-4ab8-a3c1-06cc57934f78', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 3, '{\"document_id\":19,\"title\":\"New task\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 15:58:58', '2026-05-11 11:04:45', '2026-05-11 15:58:58'),
('b3d48fd6-ffb5-4955-af52-1f1a95886a51', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":49,\"title\":\"NOM 2nd Q ICAD Advocacy Cluster Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:52', '2026-05-26 16:15:05', '2026-06-09 16:25:15'),
('b3d80d78-8659-4ce0-88b5-82f65863a7fc', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":73,\"title\":\"Invitation Letter to SILG\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-06-09 17:21:33', '2026-06-09 17:21:33'),
('b5d25643-eeff-47f6-a0d7-4715e6aa2ade', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":25,\"title\":\"DILG LED ACCOMPLISHMENT FOR THE MONTH OF APRIL\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:35:17', '2026-05-20 17:14:38', '2026-05-20 17:14:38'),
('b6386a74-b860-4fda-860a-50414ef20c82', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":27,\"title\":\"OJT Certificates\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-05-13 11:43:50', '2026-05-13 11:43:50'),
('b67ca9a9-24bf-44a5-9706-d84837a47bcf', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":104,\"title\":\"MEMO RE DDB POLICY ISSUANCE\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-08-11 08:42:02', '2026-08-11 08:42:02'),
('b69af2b3-bb3c-483b-b95f-cade6fc2bcb5', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":102,\"title\":\"C4PEACE JULY ACCOMP. REPORT\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-11 15:59:58', '2026-08-11 08:40:33', '2026-08-11 08:40:33'),
('b7b176a8-c343-47fa-861f-67deb061776b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":90,\"title\":\"CRPOC RESO NO. 4\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:20', '2026-07-16 08:09:07', '2026-07-16 08:09:07'),
('b7c3f477-cc5d-459f-a0d9-230c833e0223', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":116,\"title\":\"2026 LG Month Confirmatory Form\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-28 09:15:07', '2026-09-28 09:15:07'),
('b8e6c6ee-9f66-473d-94b7-274640dcda9b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 3, '{\"document_id\":33,\"title\":\"feafwaf\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-14 17:24:34', '2026-05-14 17:24:11', '2026-05-14 17:24:11'),
('b95a8121-ae5d-4995-b70b-a443646a56d9', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":95,\"title\":\"1ST SEM DILG LED - ACCOMPLISHMENT\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-30 11:07:24', '2026-07-30 11:07:24'),
('b9a6c048-76ec-4efb-a4e7-fc8e1c58fc62', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":41,\"title\":\"Letter to POC RAC Members  for the conduct of POC Pre-Assessment\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:02', '2026-08-11 14:01:49', '2026-08-11 14:01:49'),
('ba265815-2008-4d10-8377-ebab266b87e4', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 27, '{\"document_id\":113,\"title\":\"Philippine National Action Plan on Women, Peace and Security\",\"message\":\"A document was assigned to you for review.\"}', '2026-09-29 13:42:14', '2026-09-28 11:01:55', '2026-09-29 09:09:01');
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('bae595c5-afd1-4ae7-bf0e-8d9066168b4f', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":49,\"title\":\"NOM 2nd Q ICAD Advocacy Cluster Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:52', '2026-05-26 14:07:58', '2026-06-09 16:25:15'),
('bbd3d9dd-9d4e-4a21-857a-3402d9a00dc0', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":119,\"title\":\"September 2026 Narrative Report and Other Letters for JRTF-ELCAC\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-10-06 13:36:12', '2026-10-06 13:36:12'),
('bc12947f-7cf3-4591-abdc-549b81329448', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":83,\"title\":\"ECLIP - PAR (FOR LIQUIDATION)\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 18:10:29', '2026-07-13 11:08:50', '2026-07-13 11:08:50'),
('bcdf9e6b-5790-4bea-b5ad-651c128823fd', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":83,\"title\":\"ECLIP - PAR (FOR LIQUIDATION)\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 18:10:29', '2026-07-13 17:49:52', '2026-07-13 17:49:52'),
('bd7338fb-bd74-4817-bbd2-5b0fb5df02ac', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":51,\"title\":\"BARKADA Monthly Reporting (2026)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-08-12 09:01:19', '2026-06-29 09:25:58', '2026-08-12 09:01:19'),
('bd80a8fb-b880-4adf-afdb-02f49cab12c1', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":38,\"title\":\"hshe\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 17:32:31', '2026-05-11 17:32:29', '2026-05-11 17:32:31'),
('bdad90fc-0ce9-41eb-adfe-180eece04f93', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":81,\"title\":\"Submission of Annex A\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-09 16:29:58', '2026-07-09 16:16:46', '2026-07-09 16:16:46'),
('be1e30c3-22d4-4f8b-a20b-94b99e7943a5', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":102,\"title\":\"C4PEACE JULY ACCOMP. REPORT\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-11 15:59:58', '2026-08-05 08:02:15', '2026-08-05 08:02:15'),
('be64625e-3284-45a1-a45d-601bed220e02', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 18, '{\"document_id\":45,\"title\":\"RCSP MONITORING - CENTRAL OFFICE\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-10-08 08:55:13', '2026-05-13 07:15:55', '2026-07-13 10:18:10'),
('bf407908-ef64-46ac-b17f-1ce773dd92cc', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 3, '{\"document_id\":42,\"title\":\"POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-20 17:35:12', '2026-05-11 17:40:59', '2026-05-11 17:41:03'),
('bf9d8bdb-69a5-4147-869a-f50a706b4a73', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":79,\"title\":\"reply to NICA\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-08 14:27:07', '2026-07-08 09:00:05', '2026-07-08 09:00:05'),
('c0a902e9-265e-4c2f-b7d3-554824769579', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":120,\"title\":\"PEO II TOR\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-10-08 09:04:37', '2026-10-08 09:04:37'),
('c0a9e784-d6c0-4112-a9c7-2bcccc8e6f58', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":57,\"title\":\"DRAFT ADVSORY TO ORIENTATION ON DILG LED MEMBERS\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 10:18:10', '2026-05-26 15:58:55', '2026-07-13 10:18:10'),
('c2f31c12-e15a-4797-a79e-8762d6ed7678', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":90,\"title\":\"CRPOC RESO NO. 4\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:20', '2026-08-11 14:00:51', '2026-08-11 14:00:51'),
('c389d824-6d47-4c11-a7c0-84e9af25bf8b', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":54,\"title\":\"LGU Profiling Report\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-13 11:52:29', '2026-06-05 12:43:43', '2026-06-13 11:52:29'),
('c3957bdd-ec08-4caa-afca-84b5e47aa4ef', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 18, '{\"document_id\":45,\"title\":\"RCSP MONITORING - CENTRAL OFFICE\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-10-08 08:55:13', '2026-05-26 15:11:54', '2026-07-13 10:18:10'),
('c3a48954-f193-4e4d-975e-4a85faee854e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":111,\"title\":\"CUCPD re AVP FOR LG MONTH\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-15 16:22:30', '2026-09-15 16:22:30'),
('c45bce95-4348-41eb-979a-ccfa673e82af', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":51,\"title\":\"RCSP TARPAULIN DESIGN\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 15:35:18', '2026-05-26 13:54:28', '2026-05-26 15:35:18'),
('c613474b-a215-4266-a740-9dce07add444', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":51,\"title\":\"BARKADA Monthly Reporting (2026)\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-02 15:05:04', '2026-05-20 08:29:23', '2026-06-02 15:05:04'),
('c617e01d-114b-45d6-b23d-d12fe8c302c8', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":56,\"title\":\"ICAD 2nd Quarter Change of Date\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 22:02:08', '2026-05-26 15:19:26', '2026-05-26 15:19:26'),
('c62ce54d-5d26-4f54-9fe5-b50b818b67a3', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":94,\"title\":\"MEMO re FASTRACKING OF RCSP SCHEDULE TO KALINGA AND MP\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-28 17:19:53', '2026-07-28 17:19:53'),
('c6810f69-5a14-4606-b430-2254d120b427', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 3, '{\"document_id\":1,\"title\":\"Test\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-04 13:46:20', '2026-05-04 13:46:07', '2026-05-04 13:46:07'),
('c6f257e2-a978-4425-8780-bd889470e452', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 22, '{\"document_id\":44,\"title\":\"REQUEST TO PROCAR RE ORIENTATION JRTF members regarding their respective functions\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-23 08:59:37', '2026-05-21 08:25:45', '2026-06-23 08:59:37'),
('c86c2289-8b27-464a-89f0-ae9bd207ace4', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 6, '{\"document_id\":19,\"title\":\"POGO\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-11 16:53:04', '2026-05-11 14:43:27', '2026-05-11 16:53:04'),
('c88d7d77-f1fc-4b48-ae8d-f8bf58ab1ba8', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":43,\"title\":\"Cert\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-12 16:07:54', '2026-05-12 09:23:56', '2026-05-12 16:07:54'),
('c8c09050-7e65-447b-8716-5400a7922dd2', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":73,\"title\":\"Invitation Letter to SILG\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-06-10 14:05:15', '2026-06-10 14:05:15'),
('c908a62d-ef92-4724-b3e8-ee03684164c4', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 1, '{\"document_id\":34,\"title\":\"Testing\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-15 15:17:55', '2026-05-15 15:17:30', '2026-05-15 15:17:30'),
('c97eafb2-bb12-423a-b1ae-cefa94e57626', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":54,\"title\":\"LGU Profiling Report\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-13 11:52:29', '2026-06-13 11:52:06', '2026-06-13 11:52:29'),
('ca13c61f-9edc-4074-bad4-6949ce67ec6e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":72,\"title\":\"Letter for concerned Mayors\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:50:12', '2026-06-09 17:04:57', '2026-06-09 17:04:57'),
('ca4652d1-f313-447a-8fbd-b4f696ff0ed4', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":12,\"title\":\"Cert\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-07 08:17:36', '2026-05-07 07:29:27', '2026-05-07 08:17:36'),
('ca696c27-6700-485e-a5ea-1216a2c2a880', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":24,\"title\":\"PADS Action Plan (Continuing Funds)\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-27 06:44:51', '2026-05-12 16:38:50', '2026-05-27 06:44:51'),
('cacbf156-63d7-4db5-9602-1f48a879e813', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 15, '{\"document_id\":112,\"title\":\"CSO\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-15 15:55:40', '2026-09-15 15:55:40'),
('cc4f9f4b-cfea-46a6-bd7d-2aceaf85a60c', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 22, '{\"document_id\":77,\"title\":\"POST ACTIVITY PRESENTATION (ORIENTATION ON DILG LED MEMBERS)\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-17 13:12:37', '2026-06-16 14:25:48', '2026-06-17 13:12:37'),
('cd3811be-82d0-4782-ab87-4b4d7fa79e37', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":49,\"title\":\"NOM 2nd Q ICAD Advocacy Cluster Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:52', '2026-05-26 16:10:55', '2026-05-27 06:44:51'),
('cd9ba460-0910-43e1-a128-d4dff90948cd', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":41,\"title\":\"Letter to POC RAC Members  for the conduct of POC Pre-Assessment\",\"message\":\"A document was assigned to you for review.\"}', '2026-10-08 08:55:02', '2026-05-20 17:10:06', '2026-06-09 16:25:15'),
('ce2a6698-df42-45e4-817f-9144a37bb19f', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 1, '{\"document_id\":50,\"title\":\"Testing\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-26 22:01:58', '2026-05-15 18:59:29', '2026-05-20 07:50:58'),
('ce54e90c-a960-485e-aba3-f33cb8701c4b', 'App\\Notifications\\FocalPersonAssigned', 'App\\Models\\User', 22, '{\"title\":\"Document Assignment\",\"message\":\"You have been assigned as the focal person for: 2026 POGO\",\"document_id\":33,\"assigned_by\":\"LGMED Compass\",\"previous_focal_person\":\"LALA GERON\",\"assignment_step\":\"Focal Person Assignment\",\"due_date\":\"2026-05-11T08:02:09.000000Z\",\"status\":\"To Do\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-05-20 09:11:07', '2026-05-20 09:11:07'),
('ce7e6624-0389-4ac5-902c-b97e4fa7849d', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":49,\"title\":\"NOM 2nd Q ICAD Advocacy Cluster Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:52', '2026-05-26 11:11:24', '2026-05-27 06:44:51'),
('cf55ccbb-23bb-43be-aaaa-16a7a813f58b', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 22, '{\"document_id\":93,\"title\":\"DRAFT RCSP CONVERGENCE\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-27 09:30:32', '2026-07-27 09:30:32'),
('d287343b-86cc-4fac-a0be-d624837d5f37', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":57,\"title\":\"ORGANIZATION OF THE LOCAL DRINKING WATER QUALITY MONITORING COMMITTEE (LDWQMC)\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-03 17:18:40', '2026-08-03 17:18:40'),
('d2f116a5-ab94-4ca1-9540-af8788db57eb', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 11, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-14 17:24:34', '2026-05-12 17:02:02', '2026-05-12 17:02:02'),
('d3c6a209-2785-4461-936d-47f1c1f7ff5b', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":52,\"title\":\"Barangay Road Clearing Operations (BaRCO)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-17 15:26:54', '2026-08-17 15:26:54'),
('d40ce438-823d-407f-8f9d-73886656ff58', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":83,\"title\":\"ECLIP - PAR (FOR LIQUIDATION)\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 18:10:29', '2026-07-13 17:08:08', '2026-07-13 17:08:08'),
('d49e00d6-0207-4fdd-bb9e-a1bfc7d42f2e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":103,\"title\":\"(CUCPD) Submission of Feedback on the PPAs of the 4 sectors\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-12 11:37:04', '2026-08-04 15:50:54', '2026-08-12 11:37:04'),
('d54a38b0-d89e-43d4-81be-338ffee75265', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":96,\"title\":\"1ST SEM ACCPMPLISHMENT LOCAL TASK FORCE\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-28 11:59:17', '2026-07-28 11:59:17'),
('d5a810c9-34dc-4c42-bc0a-c52db3c5b111', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":116,\"title\":\"2026 LG Month Confirmatory Form\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-28 09:03:26', '2026-09-28 09:03:26'),
('d5caa8e8-0658-47aa-a74a-7f80e57e0f47', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":85,\"title\":\"RO re Serbisyo Caravan at Villaviciosa, Abra\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 17:52:50', '2026-07-13 17:48:40', '2026-07-13 17:48:40'),
('d6e65616-aa1b-4146-9fa8-e712c5bda665', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":51,\"title\":\"BARKADA Monthly Reporting (2026)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-17 15:26:54', '2026-08-17 15:26:54'),
('d7088bac-e7dc-4c70-8c76-4a2e87f920ff', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":60,\"title\":\"MINUTES OF MEETING CRPOC\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 10:18:10', '2026-06-01 13:28:06', '2026-07-13 10:18:10'),
('d74222fa-2dd9-421a-8d03-ad97a4965f53', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":26,\"title\":\"Justification for a Face-to-Face Modality\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-14 07:39:16', '2026-05-13 16:47:30', '2026-05-13 16:47:30'),
('d7b71969-8144-450c-9740-46c74382fcd1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":84,\"title\":\"MINUTES OF MEETING 2ND CRPOC\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:05', '2026-07-27 11:04:45', '2026-07-27 11:04:45'),
('d8599ddb-204b-4eeb-b4b9-ebdaf976045a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":70,\"title\":\"CRPOC Notice of Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:45', '2026-06-08 17:27:12', '2026-06-08 17:27:12'),
('d91ab895-6f7d-4a8f-b08f-63bf5382d4d2', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":58,\"title\":\"REITERATION ON THE DILG MEMORANDUM CIRCULAR NO. 2025-011 TITLED \\u201cSTRENGTHENING LOCAL GOVERNMENT ACTIONS FOR DENGUE PREVENTION AND CONTROL\\u201d\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-27 10:23:32', '2026-08-27 10:23:32'),
('d960e2a5-d8f7-4846-bb58-718f879e3d83', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":51,\"title\":\"BARKADA Monthly Reporting (2026)\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-08-12 09:01:19', '2026-08-12 09:00:38', '2026-08-12 09:01:19'),
('da163dbd-aba1-4825-9389-c71df7acd51f', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":52,\"title\":\"Barangay Road Clearing Operations (BaRCO)\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-02 15:05:04', '2026-05-20 08:34:10', '2026-06-02 15:05:04'),
('da754071-e5c0-4832-b45d-fd805090b1cd', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":54,\"title\":\"LGU Profiling Report\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-06-25 18:34:16', '2026-06-25 18:34:16'),
('da7f1ad7-b519-47a0-9374-7ed9dcd05f29', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":40,\"title\":\"POC - Change of Date\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-05-20 15:07:13', '2026-05-20 15:07:13'),
('db0bc372-2af7-4007-b1f4-ac06dfd654f1', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":4,\"title\":\"Message\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-07 09:58:12', '2026-05-07 09:53:49', '2026-05-07 09:53:49'),
('db2fb4bc-31fc-494b-a9a3-e798b0fbff8a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 27, '{\"document_id\":119,\"title\":\"September 2026 Narrative Report and Other Letters for JRTF-ELCAC\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-10-06 13:54:30', '2026-10-06 13:54:30'),
('db7f3cb4-856d-4968-a5b2-2fb7b6baf261', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":81,\"title\":\"Submission of Annex A\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-09 16:29:58', '2026-07-09 16:14:43', '2026-07-09 16:14:43'),
('dc66a08e-6145-4b2f-a787-c498c301a8a0', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 1, '{\"document_id\":11,\"title\":\"POGO\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-05 13:32:05', '2026-05-05 13:28:43', '2026-05-05 13:32:05'),
('dce247f6-4a11-41d8-a3ec-ae2c8487c833', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":75,\"title\":\"Letter to NAPOLCOM CAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-29 11:16:29', '2026-06-16 10:25:57', '2026-06-16 10:25:57'),
('dd4ba096-f863-4fd4-bbe1-36930839e26e', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":75,\"title\":\"Letter to NAPOLCOM CAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-29 11:16:29', '2026-06-16 08:51:28', '2026-06-16 08:51:28'),
('ddab9b99-dc29-45b3-a0f4-e485975b196d', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 1, '{\"document_id\":30,\"title\":\"Sample\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-11 15:55:43', '2026-05-11 15:55:41', '2026-05-11 15:55:43'),
('df994e9a-4fb8-49c9-bca5-44a0cd3aade7', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":96,\"title\":\"1ST SEM ACCPMPLISHMENT LOCAL TASK FORCE\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-30 11:00:11', '2026-07-30 11:00:11'),
('dfc612bf-c887-4eca-920e-b9c9781fa7ab', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":60,\"title\":\"MINUTES OF MEETING CRPOC\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-06-01 09:33:13', '2026-06-01 09:33:13'),
('e05b9e87-5d34-44fc-b1ad-b6eac3906575', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":59,\"title\":\"PAGHINGI NG MGA KOMENTO TUNGKOL SA DRAFT OMNIBUS GUIDELINES ON THE IMPLEMENTATION OF RA 10070 O PDAO LAW\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-12 17:19:43', '2026-08-12 17:19:43'),
('e3dfb99f-cfdb-4195-81e3-5786eb581a2f', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":40,\"title\":\"POC - Change of Date\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-20 14:51:45', '2026-06-09 16:25:15'),
('e4d1ab7d-a618-48af-bfd0-b543068f1fc3', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":38,\"title\":\"Follow-up Memo to DILG Benguet\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-27 06:44:51', '2026-05-20 10:14:25', '2026-05-27 06:44:51'),
('e507f0f3-f1cb-45fb-bfae-6e95f978cbb2', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 6, '{\"document_id\":11,\"title\":\"POGO\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-07 08:17:36', '2026-05-07 07:15:02', '2026-05-07 08:17:36'),
('e52beb9c-8024-432a-83f8-d93b842da733', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":111,\"title\":\"CUCPD re AVP FOR LG MONTH\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-03 16:44:16', '2026-09-03 16:44:16'),
('e56c3a54-40b7-430a-8014-7a02df98acea', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":79,\"title\":\"reply to NICA\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-08 14:27:07', '2026-07-08 09:05:22', '2026-07-08 09:05:22'),
('e6984281-4387-4bcd-95e9-57e278ef12a5', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 17, '{\"document_id\":52,\"title\":\"Barangay Road Clearing Operations (BaRCO)\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-06-02 15:05:04', '2026-05-21 08:24:38', '2026-06-02 15:05:04'),
('e7ad5af0-b774-4dc5-8389-54abc086d040', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 15, '{\"document_id\":54,\"title\":\"LGU Profiling Report\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-07-08 16:20:55', '2026-07-08 16:20:55'),
('e9623bbb-145c-4c2f-8ab8-839d4a716f2f', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":120,\"title\":\"PEO II TOR\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-10-08 07:59:40', '2026-10-08 07:59:40'),
('e9dbc081-c458-4c1b-a308-cdbf855d1c03', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":28,\"title\":\"Minutes of Meeting on DILG LED\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:34', '2026-05-20 17:14:48', '2026-05-20 17:14:48'),
('ea665476-f999-495d-8c1e-8e7a2f7f3d3f', 'App\\Notifications\\FocalPersonAssigned', 'App\\Models\\User', 11, '{\"title\":\"Document Assignment\",\"message\":\"You have been assigned as the focal person for: 2026 POGO\",\"document_id\":33,\"assigned_by\":\"LGMED Compass\",\"previous_focal_person\":\"Jan Mikhail Kimayong\",\"assignment_step\":\"Focal Person Assignment\",\"due_date\":\"2026-05-11T08:02:09.000000Z\",\"status\":\"To Do\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-14 17:24:34', '2026-05-11 16:06:43', '2026-05-11 16:06:43'),
('ec9a9ac2-cb6e-4386-84ad-c1a6155213e3', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":40,\"title\":\"POC - Change of Date\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:43:02', '2026-05-20 17:04:47', '2026-05-20 17:43:02'),
('ecbabc96-22ff-449b-b03d-ba1ec564f85c', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":79,\"title\":\"reply to NICA\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-08 14:27:07', '2026-07-08 08:54:16', '2026-07-08 08:54:16'),
('ecf6a5ed-81fb-4f62-bef7-58f5bc6c33fc', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":67,\"title\":\"POC Pre-Assessment Results Comm\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-28 17:16:48', '2026-05-28 14:23:16', '2026-05-28 14:23:16'),
('ed134570-f0e1-4c10-83ff-6c47bcfcec8a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":50,\"title\":\"RESO CRPOC SAC\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 22:01:58', '2026-05-26 11:58:39', '2026-05-26 11:58:39'),
('ed37da25-d54d-4b76-8b96-1fb06878edf0', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":38,\"title\":\"Follow-up Memo to DILG Benguet\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-20 09:39:52', '2026-06-09 16:25:15'),
('ed8b0b93-359f-4b63-9377-2a825eac31fe', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":94,\"title\":\"MEMO re FASTRACKING OF RCSP SCHEDULE TO KALINGA AND MP\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-07-28 17:12:18', '2026-07-28 17:12:18'),
('edf94962-ffd3-432a-a1d2-378a01e64983', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":61,\"title\":\"POC Program\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:40', '2026-05-28 13:36:09', '2026-05-28 13:36:09'),
('f00deacb-edb0-498e-9d7c-ffe5e43f5479', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":76,\"title\":\"FOLLOW-UP SUBMISSION ON THE 1ST CUCPD QUARTER CIR\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-09 11:00:08', '2026-06-16 11:29:43', '2026-07-09 11:00:08'),
('f0af7a44-f715-427a-a51c-a53f525f5c11', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":117,\"title\":\"2026 LG Month Invitation Letter\",\"message\":\"A document was assigned to you for review.\"}', '2026-09-28 10:58:23', '2026-09-28 10:03:44', '2026-09-28 10:03:44'),
('f0be1da7-0f36-4d6e-b03f-455260e245a7', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":117,\"title\":\"2026 LG Month Invitation Letter\",\"message\":\"A document was assigned to you for review.\"}', '2026-09-28 10:58:23', '2026-09-28 09:23:08', '2026-09-28 09:23:08'),
('f0fe9b30-a5d5-412f-980a-7588d6f2dc09', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":63,\"title\":\"Amendment to RO RCSP (JUNE 4)\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-28 09:12:12', '2026-06-09 16:25:15'),
('f15b759b-8d6e-4542-b66e-9b81885f7340', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":53,\"title\":\"CRPOC Confirmation Link\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 16:25:15', '2026-05-26 11:57:06', '2026-06-09 16:25:15'),
('f187d17e-3dfa-4709-b02a-cd7aafc8e64a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 20, '{\"document_id\":66,\"title\":\"Amendment to RO RCSP (JUNE 4)\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-08 10:38:36', '2026-05-28 15:37:09', '2026-06-08 10:38:36'),
('f1f065bb-5b4d-4b27-8ebd-5d103369f90f', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":28,\"title\":\"Minutes of Meeting on DILG LED\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:34', '2026-05-13 15:40:11', '2026-05-19 08:43:05'),
('f1f58405-8036-4837-9135-180f7ed7faf1', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 18, '{\"document_id\":45,\"title\":\"RCSP MONITORING - CENTRAL OFFICE\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-10-08 08:55:13', '2026-06-09 16:57:11', '2026-07-13 10:18:10'),
('f219d038-682d-4cb8-b301-87d8d3e729ee', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 1, '{\"document_id\":15,\"title\":\"feafwaf\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-11 13:12:35', '2026-05-11 12:00:30', '2026-05-11 13:12:35'),
('f34032de-a0d6-42b5-bd58-1dcfda6d7be4', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 23, '{\"document_id\":60,\"title\":\"REQUEST FOR INPUT ON THE DRAFT GUIDELINES  FOR THE IMPLEMENTATION OF THE 2026-2028 SEAL  OF GOOD LOCAL GOVERNANCE\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-08-27 10:23:32', '2026-08-27 10:23:32'),
('f45189d0-5f72-42c1-8d6e-62ba4615ab07', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":92,\"title\":\"CRPOC MOM 2ND QUARTER\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-25 15:13:24', '2026-07-27 11:21:57', '2026-07-27 11:21:57'),
('f460b238-b9ec-41b0-ac54-78592e46dd06', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":115,\"title\":\"2026 LG Month Confirmatory Slip\",\"message\":\"A document was assigned to you for review.\"}', NULL, '2026-09-28 07:56:07', '2026-09-28 07:56:07'),
('f4c4cbec-0377-4e83-bffe-c3f370954bf8', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 18, '{\"document_id\":58,\"title\":\"RCSP SCHEDULE\",\"message\":\"A document was assigned to you for review.\"}', '2026-07-13 10:18:10', '2026-05-26 15:54:04', '2026-07-13 10:18:10'),
('f59e88f5-8b55-44d3-916c-4112e331ec23', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":4,\"title\":\"Message\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-07 09:58:12', '2026-05-07 09:56:59', '2026-05-07 09:56:59'),
('f63474c6-a322-449c-a47f-bfe0c63cb159', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 14, '{\"document_id\":101,\"title\":\"RO KALINGA BDP\",\"message\":\"A document was assigned to you for review.\"}', '2026-08-04 11:08:22', '2026-08-03 14:35:41', '2026-08-03 14:35:41'),
('f7e47024-d1cd-4698-8e9a-1a599ec7a667', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 1, '{\"document_id\":19,\"title\":\"POGO\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-11 15:45:09', '2026-05-11 14:43:38', '2026-05-11 15:45:09'),
('f81154b3-b039-475a-9c2a-b750fe5d8bb5', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 1, '{\"document_id\":3,\"title\":\"PBB\",\"message\":\"Deadline is approaching.\",\"type\":\"soon\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', '2026-05-04 14:28:37', '2026-05-04 13:53:42', '2026-05-04 14:28:37'),
('f90c70e7-3f28-4865-8e50-e7f2b41fe58a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":113,\"title\":\"Philippine National Action Plan on Women, Peace and Security\",\"message\":\"A document was assigned to you for review.\"}', '2026-09-29 13:42:14', '2026-09-15 16:15:22', '2026-09-15 16:15:22'),
('fb98453a-f52b-40c2-b7a3-e7ec81ceb757', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":70,\"title\":\"CRPOC Notice of Meeting\",\"message\":\"A document was assigned to you for review.\"}', '2026-06-09 17:28:45', '2026-06-09 08:11:09', '2026-06-09 08:11:09'),
('fc3758b7-2080-4625-bbba-dc7569da001f', 'App\\Notifications\\DeadlineReminderNotification', 'App\\Models\\User', 22, '{\"document_id\":33,\"title\":\"2026 POGO\",\"message\":\"This document is overdue.\",\"type\":\"overdue\",\"url\":\"https:\\/\\/lgmedcompass.ksmahub.com\\/documents\"}', NULL, '2026-07-14 15:50:04', '2026-07-14 15:50:04'),
('fccbb886-0778-4db3-8cd4-520d6f4eee42', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":54,\"title\":\"ECLIP Convergence Request for Change of Date\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 22:02:03', '2026-05-26 15:18:58', '2026-05-26 15:18:58'),
('fe4a2665-78a7-46d3-a76e-a3d1e5bafce4', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 11, '{\"document_id\":23,\"title\":\"PAR\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:25', '2026-05-12 15:56:49', '2026-05-12 15:57:55'),
('ff13360a-2a16-468d-901c-4f25e4dd1883', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":50,\"title\":\"RESO CRPOC SAC\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-26 22:01:58', '2026-05-26 17:29:06', '2026-05-26 17:29:06'),
('ff1c9e9b-d6d8-4d92-9963-1ef2370b2b5a', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 10, '{\"document_id\":48,\"title\":\"ECLIP MRM\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-27 06:44:51', '2026-05-26 12:01:03', '2026-05-27 06:44:51'),
('ffa478b9-d6a1-4f68-83c9-6fbc760242bc', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 13, '{\"document_id\":28,\"title\":\"Minutes of Meeting on DILG LED\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-20 17:36:34', '2026-05-20 09:20:11', '2026-05-20 09:20:11'),
('ffd480e3-f313-490c-97ab-8ea4ac9d3f76', 'App\\Notifications\\DocumentAssignedNotification', 'App\\Models\\User', 3, '{\"document_id\":12,\"title\":\"dwad\",\"message\":\"A document was assigned to you for review.\"}', '2026-05-11 15:58:58', '2026-05-11 14:41:30', '2026-05-11 15:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('bables0620@gmail.com', '$2y$12$siWCmBK.4G9ltBcm0HmxzOfUTjTMoA7isUwcgY8enrY7kU38b/lye', '2026-06-11 08:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `resource_categories`
--

CREATE TABLE `resource_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resource_categories`
--

INSERT INTO `resource_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Division Chief', 'chief', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(2, 'Assistant Division Chief', 'assistant-chief', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(3, 'LG Relations & Policy Compliance Section', 'lgrpcs', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(4, 'LG Performance Management, Recognition, and Awards Section', 'lgpmras', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(5, 'LG Peace, Order & Public Safety Compliance Monitoring', 'lgpopscm', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(6, 'Support Services Unit', 'ssu', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(7, 'Database & Statistical Unit', 'dsu', '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(8, 'QMS', 'qms', '2026-05-04 13:13:47', '2026-05-04 13:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `resource_files`
--

CREATE TABLE `resource_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folder_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('FILE','LINK') NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resource_files`
--

INSERT INTO `resource_files` (`id`, `folder_id`, `user_id`, `name`, `type`, `path`, `url`, `created_at`, `updated_at`) VALUES
(3, 17, 16, 'G Drive 2026 OUTGOING COMMS', 'LINK', NULL, 'https://drive.google.com/drive/folders/1i0MKzZbEa68IrW8harLXLe_Z88VBFbiS?usp=sharing', '2026-05-12 09:57:07', '2026-05-12 09:57:07'),
(7, 19, 16, 'DPCR_ABANCE,Mary Jane S.pdf', 'FILE', 'resources/ssu/SCRj6HOX4g3iXnxjz0kP9ODinBEux9fM7rssXonT.pdf', NULL, '2026-05-12 10:52:27', '2026-05-12 10:52:27'),
(8, 19, 16, 'IPCR_ADNOL, Bable G.pdf', 'FILE', 'resources/ssu/HNlasxibz7kMziDmoFiTmxc6MZf9DN2msnSdtA6b.pdf', NULL, '2026-05-12 10:52:27', '2026-05-12 10:52:27'),
(9, 19, 16, 'IPCR_BAISA, Princes A.pdf', 'FILE', 'resources/ssu/rqAGtAliOLf4ByKq4O78GAfUxYYaTdaFFbqSUtlB.pdf', NULL, '2026-05-12 10:52:27', '2026-05-12 10:52:27'),
(10, 19, 16, 'IPCR_CANULLAS, Mary Jheama Rachine E.pdf', 'FILE', 'resources/ssu/mlPNyI77kJh3RxeT4k07ibnheJUdvCm4wbLDpgee.pdf', NULL, '2026-05-12 10:52:27', '2026-05-12 10:52:27'),
(11, 19, 16, 'IPCR_DAGUYAM, Herald D.pdf', 'FILE', 'resources/ssu/XUlXpWm8eTosl31Cf9B5Dh6TsticgOkFcqVQ1BgO.pdf', NULL, '2026-05-12 10:52:27', '2026-05-12 10:52:27'),
(12, 19, 16, 'IPCR_GERON, Lala G.pdf', 'FILE', 'resources/ssu/yiCsvfLsmi4mOvIWFWixOJBzhg9081vvy54QoWOW.pdf', NULL, '2026-05-12 10:52:27', '2026-05-12 10:52:27'),
(13, 19, 16, 'IPCR_GONZALES, Marlene C.pdf', 'FILE', 'resources/ssu/kFJ6mNuvMrVl7mYovlDvU8qzKI8UQae6Nu4zDXg8.pdf', NULL, '2026-05-12 10:52:27', '2026-05-12 10:52:27'),
(14, 19, 16, 'IPCR_GUNDAY, Nikko May L.pdf', 'FILE', 'resources/ssu/BUX61IJsBOOYPHGhWXGghti7nSQgjpcFudkQWfkB.pdf', NULL, '2026-05-12 10:52:27', '2026-05-12 10:52:27'),
(15, 19, 16, 'IPCR_KIMAYONG, Jan Mikhail P.pdf', 'FILE', 'resources/ssu/7cro3yP6A9GLMHG0LsRr0VKiUgnoE3RUkUdBNNaI.pdf', NULL, '2026-05-12 10:52:27', '2026-05-12 10:52:27'),
(16, 19, 16, 'IPCR_OCAL, Allan F.pdf', 'FILE', 'resources/ssu/nkpdNsGYWQXntqb5XvvrHuPlhQqVxWlD4Uq8daJq.pdf', NULL, '2026-05-12 10:52:28', '2026-05-12 10:52:28'),
(17, 19, 16, 'IPCR_PALARUAN, Jhosua Philip A.pdf', 'FILE', 'resources/ssu/oNHeDkpGchye1JA2BSvNRoocQVgsENxLMmW5fA1x.pdf', NULL, '2026-05-12 10:52:28', '2026-05-12 10:52:28'),
(18, 19, 16, 'IPCR_PASCUA Prince Jeden A.pdf', 'FILE', 'resources/ssu/x0EYH1QGHslBXdDMRTYlrXwOdkFH69UZoTJ2p7qd.pdf', NULL, '2026-05-12 10:52:28', '2026-05-12 10:52:28'),
(19, 19, 16, 'IPCR_TAMONDONG, Joanabeth P 2026.pdf', 'FILE', 'resources/ssu/mzT6YyFtIBWqSOof5QjQbRCKp0JKI56aCxdQRjhH.pdf', NULL, '2026-05-12 10:52:28', '2026-05-12 10:52:28'),
(20, 19, 16, 'JANUARY-JUNE 2026 FORM 9.pdf', 'FILE', 'resources/ssu/ZvpESk0vXdc3alMB9sK1kKjQvXNkF8M7U6rqTMdF.pdf', NULL, '2026-05-12 10:52:28', '2026-05-12 10:52:28'),
(21, 19, 16, 'JANUARY-JUNE 2026 PERFORMANCE COMMITMENT-TRANSMITTAL.pdf', 'FILE', 'resources/ssu/cHBtAPpBXPfNcs5YQfMwhqkKJhGS0dNSfKYFud2k.pdf', NULL, '2026-05-12 10:52:28', '2026-05-12 10:52:28'),
(30, 31, 20, 'PAR - RCSP VILLAVICIOSA RCSP.pdf', 'FILE', 'resources/ssu/bqc6k5fdB1z4CcCAGnJ86hApSgN2UyJKzfs3ZmYT.pdf', NULL, '2026-05-28 14:28:16', '2026-05-28 14:28:16'),
(31, 31, 20, 'PAR- ONLINE RCSP ORIENTATION.pdf', 'FILE', 'resources/ssu/ofXYU3sOMFqQzqSzJCkUH723HqzbNxqquRS1kHtv.pdf', NULL, '2026-05-28 14:28:16', '2026-05-28 14:28:16'),
(32, 34, 13, 'Order as Rep.pdf', 'FILE', 'resources/assistant-chief/sZ6U1kAIQZkSu7XGxV1bRBy6M8aUilRamQIyyBM0.pdf', NULL, '2026-06-01 16:47:13', '2026-06-01 16:47:13'),
(33, 32, 13, 'Order as Rep.pdf', 'FILE', 'resources/assistant-chief/za9gm5STk9EwUjgpLjV7Yld7vz1a0s6cUWXZmFO6.pdf', NULL, '2026-06-01 16:47:53', '2026-06-01 16:47:53'),
(34, 33, 13, 'Order as Rep.pdf', 'FILE', 'resources/assistant-chief/kWp0tm02bZDQaJkYTjbBkLGkyXFlir0Nd3QMukZF.pdf', NULL, '2026-06-01 16:48:05', '2026-06-01 16:48:05'),
(35, 32, 13, 'PAR RSC 1st Mtng 2026.pdf', 'FILE', 'resources/assistant-chief/HQwYiteG8VxhX7rwndxrFhJkwhuJQ4GQrNRQWaGx.pdf', NULL, '2026-06-01 16:48:47', '2026-06-01 16:48:47'),
(36, 33, 13, 'List of Deliberated Brgys.xlsx', 'FILE', 'resources/assistant-chief/HFKjUGdtJ303p3gqgBttfsXwLLieHYk8anc4xIz6.xlsx', NULL, '2026-06-01 16:49:24', '2026-06-01 16:49:24'),
(37, 33, 13, '1.jpg', 'FILE', 'resources/assistant-chief/bTYWtnYV6fzLbKZaA8dqflgmsKBJZNuDevdREI8D.jpg', NULL, '2026-06-01 16:49:24', '2026-06-01 16:49:24'),
(38, 33, 13, '2.jpg', 'FILE', 'resources/assistant-chief/gPtlzM93ZLtRchd7u2BErEwqjFwvknJP0CcHkuy1.jpg', NULL, '2026-06-01 16:49:24', '2026-06-01 16:49:24'),
(39, 33, 13, '3.jpg', 'FILE', 'resources/assistant-chief/lvKOL2CZt4hjwmEO1HzcNXiA14pHSNbqYMqu6EoD.jpg', NULL, '2026-06-01 16:49:24', '2026-06-01 16:49:24'),
(40, 33, 13, '4.jpg', 'FILE', 'resources/assistant-chief/aihytRTgttuSXgRuVG9D4hkYVsArRYIcwEHFeFdg.jpg', NULL, '2026-06-01 16:49:24', '2026-06-01 16:49:24'),
(41, 33, 13, '5.jpg', 'FILE', 'resources/assistant-chief/aZjVE7m2jujp9YYAI3nDG6oAVYUzvQz7zSTqyywL.jpg', NULL, '2026-06-01 16:49:24', '2026-06-01 16:49:24'),
(42, 33, 13, '6.jpg', 'FILE', 'resources/assistant-chief/zsFH2BrcYnmStzIYGxedtw1Vcpgh9pvzFu4Xy7su.jpg', NULL, '2026-06-01 16:49:24', '2026-06-01 16:49:24'),
(43, 35, 13, 'DO 2025 - 1159 Recon of the Depts Quality Mngt systems Assessment Comm for 2026 Assessment Pd.pdf', 'FILE', 'resources/assistant-chief/68X2nJh5YpphTogpZC6xQnny6p7tMYCSeXEp4Rw8.pdf', NULL, '2026-06-01 16:52:45', '2026-06-01 16:52:45'),
(44, 35, 13, 'Conduct of QMS Audit 2026.pdf', 'FILE', 'resources/assistant-chief/QaD8KM39ghwe5u3hTHoY926qu23bSTnAm94EwXJG.pdf', NULL, '2026-06-01 16:53:07', '2026-06-01 16:53:07'),
(45, 35, 13, 'QMSA Exec Summary 2025.pdf', 'FILE', 'resources/assistant-chief/1K65THKnuNYCgVCN5pRqPEkXrSctU5pUcePuz5NG.pdf', NULL, '2026-06-01 16:53:40', '2026-06-01 16:53:40'),
(46, 35, 13, 'Executive Summary Special Assessment 2025.pdf', 'FILE', 'resources/assistant-chief/So7YxLpPlMt3zZl90bkU0vgi0P8l4X5C61BHrtIh.pdf', NULL, '2026-06-01 16:54:08', '2026-06-01 16:54:08'),
(47, 35, 13, '2026 MR Organizational Level.pptx', 'FILE', 'resources/assistant-chief/fTG94xydZdEGCZ2zcafIgYZJL5jqRJFyKjoAxs66.pptx', NULL, '2026-06-01 16:54:54', '2026-06-01 16:54:54'),
(48, 36, 13, 'Advisory 2026.pdf', 'FILE', 'resources/assistant-chief/e3eu7svl9NNzH76zwZxjGeSHuOIg54ZwPU5joghV.pdf', NULL, '2026-06-01 17:01:21', '2026-06-01 17:01:21'),
(49, 35, 13, 'OFIR Monitoring Matrix 2026.pdf', 'FILE', 'resources/assistant-chief/9fRTJaTOE4nbTQSoMEuYXtoySax0wpTs7fVX3rRf.pdf', NULL, '2026-06-01 17:02:09', '2026-06-01 17:02:09'),
(50, 37, 13, 'RO 220 2026.pdf', 'FILE', 'resources/assistant-chief/g9BQbiFo0TfI2FzS2ss3Be6qvbRUZkzjWxZIzGFT.pdf', NULL, '2026-06-01 17:09:28', '2026-06-01 17:09:28'),
(51, 37, 13, 'RO 566 2026 Reconstitution of BAC.pdf', 'FILE', 'resources/assistant-chief/gnFBs3A5zWZTtnGwUinj2k8fmyt4v0odGiTuZTbY.pdf', NULL, '2026-06-01 17:09:40', '2026-06-01 17:09:40'),
(52, 38, 18, 'FIRE PREVENTION MONTH PAR.pdf', 'FILE', 'resources/ssu/bvC5e41UJZvfP8j8tfM6H4LlVF53SAshEs2RsuFH.pdf', NULL, '2026-06-03 17:37:38', '2026-06-03 18:17:53'),
(53, 39, 18, 'PAR_JRTF-ELCAC CAR (1).pdf', 'FILE', 'resources/ssu/bLDTnILx5qvvPhpnuHSTrKKjLtsKYwsX884nPK8m.pdf', NULL, '2026-06-03 17:41:26', '2026-06-03 17:41:26'),
(54, 39, 18, 'POST ACTIVITY REPORT.pdf', 'FILE', 'resources/ssu/nUFFVMT4jY1c2mbEL9voOB7BTRqoafjktgle3gJF.pdf', NULL, '2026-06-03 17:44:52', '2026-06-03 17:44:52'),
(55, 41, 18, '1ST Q CRPOC 2026 .pdf', 'FILE', 'resources/ssu/b5rTa5hnHFJx9Z76qXQp7DcWGQAnlJKttLqa3Xhu.pdf', NULL, '2026-06-03 17:46:26', '2026-06-03 18:01:34'),
(56, 39, 18, 'CAR-LGMED-2026-03-12-007 (1).pdf', 'FILE', 'resources/ssu/bm6W14hSpu24ozELEruBUtOBWOfWoyrFodCMSUBT.pdf', NULL, '2026-06-03 17:47:12', '2026-06-03 17:47:12'),
(57, 39, 18, 'POST ACTIVITY REPORT - JRTF ELCAC TWG (1).pdf', 'FILE', 'resources/ssu/AaeoI6KewYs48hnC6vMampRv456gc82ynzMh4xM2.pdf', NULL, '2026-06-03 17:48:40', '2026-06-03 17:48:40'),
(58, 39, 18, 'CAR-LGMED-2026-02-20-004 (1).pdf', 'FILE', 'resources/ssu/K8lmOwXF2neAkw044qW91DKjSn9kaKOUU0HvoDId.pdf', NULL, '2026-06-03 17:51:51', '2026-06-03 17:51:51'),
(59, 39, 18, '2026-02-13-001-PAR re FY 2026 CO AND RO CONSULTATION LOCALIZATION OF EO70 PMO C4PEACE I MEALGU-SBDP-BY JOANA (1).pdf', 'FILE', 'resources/ssu/uAMPHZfopHheD0XfRgammXxibvOdQn90CgACkQUS.pdf', NULL, '2026-06-03 17:52:05', '2026-06-03 17:52:05'),
(60, 39, 18, 'POST ACTIVITY REPORT - JRTF CAR.pdf', 'FILE', 'resources/ssu/WEtbn6zFfkoHMOxBmJuYULB6vhJRPRC5WlcFQwxT.pdf', NULL, '2026-06-03 17:55:44', '2026-06-03 17:55:44'),
(61, 41, 18, '4TH QUARTER CRPOC PAR 2025', 'FILE', 'resources/ssu/4zKZF133jh8QvUpqb1H59a14z28r0Czboz3t0bAw.pdf', NULL, '2026-06-03 17:59:39', '2026-06-03 18:00:08'),
(62, 42, 18, 'POST ACTIVITY REPORT - YOUTH\'S CHOICE.pdf', 'FILE', 'resources/ssu/xJPocGlYt76N4GUZJSNvm8w91Ftt7tOL19ffEeKc.pdf', NULL, '2026-06-03 18:03:03', '2026-06-03 18:03:03'),
(63, 29, NULL, 'PAR LTIA 2026 Orientation.pdf', 'FILE', 'resources/chief/STJCKecBwJ4lcJG6EJeFncGbnMTvVKUcyQMqMqS3.pdf', NULL, '2026-06-08 11:40:31', '2026-06-08 11:40:31'),
(64, 29, NULL, 'SP12-PAR re LCPC LEVELLING OFF MEETING Feb 20 2026.pdf', 'FILE', 'resources/chief/UeU9sPAVf1h8gA6pSrD1gbCH8JCFx5muH4DCS2KG.pdf', NULL, '2026-06-08 11:40:31', '2026-06-08 11:41:28'),
(65, 29, NULL, 'SP12-PAR - RIMTF LCPC PREPARATORY Feb 19.pdf', 'FILE', 'resources/chief/oak4noB3q8Zh95E2nj4nIRwOqjF4UwPmaREQiUZc.pdf', NULL, '2026-06-08 11:40:31', '2026-06-08 11:41:38'),
(66, 29, NULL, 'CAR-LGMED-2026-03-12-007 (1).pdf', 'FILE', 'resources/chief/ZaQjJYGLIGRaoSOyZsEzZE04vGiPxjLzB8tcYKYm.pdf', NULL, '2026-06-08 11:40:31', '2026-06-08 11:40:31'),
(67, 29, NULL, 'CAR-LGMED-2026-02-20-004 (1).pdf', 'FILE', 'resources/chief/oSgVfWMQgLR3X1wIrY6ysix8NfBZVWvmLe0WkV5S.pdf', NULL, '2026-06-08 11:40:31', '2026-06-08 11:40:31'),
(68, 29, NULL, 'CAR-LGMED-2026-02-20-004 (1).pdf', 'FILE', 'resources/chief/A6KH5MokpQtdCevOum9BTTJHPMZUMgO2LDFA64NU.pdf', NULL, '2026-06-08 11:41:53', '2026-06-08 11:41:53'),
(69, 29, NULL, 'Post Activity- PRESENTATIONS OF ACCOMPLISHMENT OF 1ST QUARTER JRTF-CAR pdf (1).pdf', 'FILE', 'resources/chief/rmOfeWY4xSsOPuZfscKPGUeAEJVSZIjkvM667VkQ.pdf', NULL, '2026-06-08 11:43:56', '2026-06-08 11:43:56'),
(70, 29, NULL, 'Scan2026-04-27_164032 (PAR-RCSPSerbisiyoCaravan).pdf', 'FILE', 'resources/chief/JyJro6tXVRUSfrVxqJXUKwqeEiibkgCQQfvTz3sx.pdf', NULL, '2026-06-08 11:43:56', '2026-06-08 11:43:56'),
(71, 29, NULL, 'POST ACTIVITY REPORT.pdf', 'FILE', 'resources/chief/ittAuFfSM0LtixhiSvO2TKTGFastZ3ZZ6oSfxyf9.pdf', NULL, '2026-06-08 11:43:56', '2026-06-08 11:43:56'),
(72, 29, NULL, 'Post Activity- PRESENTATIONS OF ACCOMPLISHMENT OF 1ST QUARTER JRTF-CAR pdf (1).pdf', 'FILE', 'resources/chief/6TzndKZF8SgsFuz27vWAcu3eTt8IpPJwvbK2EWFt.pdf', NULL, '2026-06-08 11:44:06', '2026-06-08 11:44:06'),
(73, 29, NULL, 'POST ACTIVITY REPORT_LGPOPS.pdf', 'FILE', 'resources/chief/4etpNOzdDrh7lMGQoqWkTd8ta5Ns2eXu5hUjV08O.pdf', NULL, '2026-06-08 11:44:07', '2026-06-08 11:44:07'),
(74, 29, NULL, 'POST ACTIVITY REPORT - JRTF ELCAC TWG (1).pdf', 'FILE', 'resources/chief/GIzVCJtdMRlUoWqzHYC01xNViMQ5Gj09SKP1HrJq.pdf', NULL, '2026-06-08 11:44:07', '2026-06-08 11:44:07'),
(75, 29, NULL, 'CAR-LGMED-2026-03-12-007 (1).pdf', 'FILE', 'resources/chief/0ZIaETYX5Zid4nGoHSWybMVIXLvB6se4SU2WGtoX.pdf', NULL, '2026-06-08 11:44:07', '2026-06-08 11:44:07'),
(76, 29, NULL, 'CAR-LGMED-2026-02-20-004 (1).pdf', 'FILE', 'resources/chief/GyprLpcMSx5J4s37q25LpZsHtayU1zSMeXt5i7Kq.pdf', NULL, '2026-06-08 11:44:07', '2026-06-08 11:44:07'),
(77, 43, 23, '2026-06-01-001-PAR OF LGOO V OCAL re MIDDLE MANAGERS CLASS (MMC) BATCFH 37.pdf', 'FILE', 'resources/lgpmras/977CDR5pGbYlvi70LOe42ad6xdKYwXP40nRlpmtm.pdf', NULL, '2026-06-08 15:05:17', '2026-06-08 15:05:17'),
(78, 43, 23, 'PAR - LGOO V OCAL - Attendance to Various Module Classes and Sessions of LGOO V Allan F. Ocal on the Conduct of Middle Managers Class (MMC) Batch 37.pdf', 'FILE', 'resources/lgpmras/vqXE09ANRXkCYkUmALQ8dG5gnXGoUHfmhZIP4PAz.pdf', NULL, '2026-06-08 15:05:17', '2026-06-08 15:05:17'),
(79, 44, 23, '2026-06-01-001-PAR OF LGOO V OCAL re MIDDLE MANAGERS CLASS (MMC) BATCFH 37.pdf', 'FILE', 'resources/ssu/BJSxUH459kwmukrL88pjNyyQWHi4iBCyR9VvU4do.pdf', NULL, '2026-06-08 15:08:54', '2026-06-08 15:08:54'),
(80, 44, 23, 'PAR - LGOO V OCAL - Attendance to Various Module Classes and Sessions of LGOO V Allan F. Ocal on the Conduct of Middle Managers Class (MMC) Batch 37.pdf', 'FILE', 'resources/ssu/VklTLLqZ1twwmoz8mLqSBj0KeCACtld2sdK4nGLI.pdf', NULL, '2026-06-08 15:08:54', '2026-06-08 15:08:54'),
(81, 45, 18, 'Post-Activity Report on the Attendance to the 3Ms - A Course on the DILG\'s Culture of Service.pdf', 'FILE', 'resources/ssu/QcBuvkPMPDRJXaNeCSufqNIgcNp9Y5fzyuXVpiIS.pdf', NULL, '2026-06-08 17:03:34', '2026-06-08 17:03:34'),
(82, 46, 18, 'PAR_CRPOC-SAC Meeting.pdf', 'FILE', 'resources/ssu/PZgk05MgkDSXsXjRBg1F8gYJLHsQOOTTXPpSgwII.pdf', NULL, '2026-06-08 17:49:39', '2026-06-08 17:49:39'),
(83, 40, 18, 'TN-05-05-019 PAR RE ATTENDANCE TO THE INAGURATION (1).pdf', 'FILE', 'resources/ssu/QsGQwmu7kOnTeAROqtRttfOi5vSFjn8iwSAqz0xg.pdf', NULL, '2026-06-08 17:50:54', '2026-06-08 17:50:54'),
(84, 41, 18, 'UPDATED PAR .pdf', 'FILE', 'resources/ssu/x0nDf7KRTOBu9pY7okDA6IUq4C8H1DhhWiPRmUIh.pdf', NULL, '2026-06-08 17:53:02', '2026-06-08 17:53:02'),
(85, 47, 10, 'Minutes of the Meeting 2nd Quarter Meeting of the ICAD-R&R Cluster (1).pdf', 'FILE', 'resources/lgpopscm/y7PVYfnWcuhtyG2V610lCGHX5dWEBVUxu5i1b8ho.pdf', NULL, '2026-06-15 17:44:07', '2026-06-15 17:44:07'),
(86, 47, 10, 'PAR re ICAD REAHBILITATION AND REINTEGRATION CLUSTER MEETING (1).pdf', 'FILE', 'resources/lgpopscm/o0V28bD5RIOXxbwLK1NnyveOz7ydCspLshnomGHJ.pdf', NULL, '2026-06-15 17:44:07', '2026-06-15 17:44:07'),
(87, 31, 20, 'PAR- ONLINE ORIENTATION ON STRENGTHENING RCSP.pdf', 'FILE', 'resources/ssu/RpfmCwcidyx8wWzq4aIRstIuEh1m9LZbbC3EScEv.pdf', NULL, '2026-07-08 14:45:00', '2026-07-08 14:45:00'),
(88, 48, 20, 'PAR - COORDINATION MEETING ON THE IMPLEMENTATION PROGRAM AND PROVISION OF ASSISTANCE TO OPAPRU.pdf', 'FILE', 'resources/ssu/yFYuSHOzOM0zzNdnZFxbenZF4GkpSL2o3u4H1Z73.pdf', NULL, '2026-07-08 14:45:49', '2026-07-08 14:45:49'),
(89, 49, 20, '2026-04-27-004-PAR re CY 2026 LTIA REGIONAL ASSESSMENT, APRIL 14-15, 2026- BY PRINCE.pdf', 'FILE', 'resources/ssu/oWtmM5mZ9l0ngKkox0NMRnPmn5k7SIZEzy4xCsDH.pdf', NULL, '2026-07-16 10:22:28', '2026-07-16 10:22:28'),
(90, 31, 20, '2026-04-27-003-PAR re SERBISIYO CARAVAN AS PART OF THE RCSP IMPLEMENTATION, 21 APR 2026-BY PRINCE.pdf', 'FILE', 'resources/ssu/wXYV2Pkrr6z35gJ7daFqhp2p6RyfbskrAz4giB0K.pdf', NULL, '2026-07-16 10:23:18', '2026-07-16 10:23:18'),
(91, 50, 20, '2026-03-25-001-PAR re NATIONAL TUBERCULOSIS CONTROL PROG REGL COORDINATING COMM MTG-BY PRINCE.pdf', 'FILE', 'resources/ssu/FCdCWXQKkg2PbFCitVKLNXqcmmFLJMekG7bjqTP5.pdf', NULL, '2026-07-16 10:24:13', '2026-07-16 10:24:13'),
(92, 51, 23, 'DILG CSIS Primer.pdf', 'FILE', 'resources/lgpmras/xFKe6ct3iL6UeSLPzsUEMthQSfNTPmnPK2bTp2QV.pdf', NULL, '2026-08-25 09:59:32', '2026-08-25 09:59:32'),
(93, 52, 15, 'May 2026 QP6.pdf', 'FILE', 'resources/qms/XgHZ7fJoIXSzA7szdtdc25IRyGsuqau8y1QdvYU7.pdf', NULL, '2026-08-26 16:28:49', '2026-08-26 16:28:49'),
(94, 52, 15, 'April 2026 QP6.pdf', 'FILE', 'resources/qms/oTbnB4OXnQjrJmzV2KsSSwa7ZdsLVC2HF7rM2bK8.pdf', NULL, '2026-08-26 16:29:16', '2026-08-26 16:29:16'),
(95, 52, 15, 'June 2026 QP6(1).pdf', 'FILE', 'resources/qms/78ROO8FddSkcajhyW5WnJpENvrtBp8wJgAf7DxsM.pdf', NULL, '2026-08-26 16:29:42', '2026-08-26 16:29:42'),
(96, 53, 15, 'April 2026 QP7.pdf', 'FILE', 'resources/qms/JXgoxOBr4JhNvgl8LGi6TU1G8H8TmQNeYlBwWrVK.pdf', NULL, '2026-08-26 16:30:49', '2026-08-26 16:30:49'),
(97, 53, 15, 'May 2026 QP7.pdf', 'FILE', 'resources/qms/O9gjRnpch7bosiIos7BAqPzhZXR8toAHkriSNcb5.pdf', NULL, '2026-08-26 16:31:16', '2026-08-26 16:31:16'),
(98, 53, 15, 'June 2026 QP7.pdf', 'FILE', 'resources/qms/dqkFsohuf7ChI1gtGrHNzTB0eQ16VPvrw72vrfQQ.pdf', NULL, '2026-08-26 16:31:43', '2026-08-26 16:31:43'),
(99, 54, 22, 'SP 12 - PAR', 'LINK', NULL, 'https://drive.google.com/drive/folders/1SiJ_cpzyRLRd8HDH9Ci5HLIV-QoTOdJ7', '2026-08-27 17:02:00', '2026-08-27 17:02:00'),
(100, 55, 22, 'QMS REPORTS', 'LINK', NULL, 'https://drive.google.com/drive/folders/12wEl0SnKcPtvVcKyMg0OhlZEPjVwHOkz', '2026-08-27 17:02:55', '2026-08-27 17:02:55'),
(101, 59, 17, 'PAR - NTF-ELCAC 1ST SEM CY 2026 JTRFs ACCOMPLISHMENT REPORT.pdf', 'FILE', 'resources/lgrpcs/fVusOzrgL1ROqNTNMTyqaO7nTi3jzBRNeSNYJggW.pdf', NULL, '2026-09-18 09:15:06', '2026-09-18 09:15:06'),
(102, 60, 13, 'PAR RSC August 18-20, 2026.pdf', 'FILE', 'resources/assistant-chief/kvj1oM16iYDs18B6KZbhs5DzPcH5sHlHEPFUZE0z.pdf', NULL, '2026-10-01 20:27:22', '2026-10-01 20:27:22'),
(103, 60, 13, 'PAR BJMP Interview Promotion.pdf', 'FILE', 'resources/assistant-chief/d9j49ngb7Rx4DRh5cuk58eqqSKGCFCEmkCakcAv5.pdf', NULL, '2026-10-01 20:27:40', '2026-10-01 20:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `resource_folders`
--

CREATE TABLE `resource_folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resource_folders`
--

INSERT INTO `resource_folders` (`id`, `category_id`, `parent_id`, `name`, `created_at`, `updated_at`) VALUES
(2, 8, NULL, 'QP1', '2026-05-05 13:17:26', '2026-05-05 13:17:26'),
(4, 8, NULL, 'QP2', '2026-05-05 13:17:47', '2026-05-05 13:17:47'),
(5, 8, NULL, 'QP3', '2026-05-05 13:18:09', '2026-05-05 13:18:09'),
(6, 8, NULL, 'QP4', '2026-05-05 13:18:20', '2026-05-05 13:18:20'),
(7, 8, NULL, 'QP5', '2026-05-05 13:18:27', '2026-05-05 13:18:27'),
(8, 8, NULL, 'QP6', '2026-05-05 13:18:33', '2026-05-05 13:18:33'),
(9, 8, NULL, 'QP7', '2026-05-05 13:18:38', '2026-05-05 13:18:38'),
(10, 8, NULL, 'QP43', '2026-05-05 13:18:44', '2026-05-05 13:18:44'),
(11, 8, NULL, 'QP44', '2026-05-05 13:18:50', '2026-05-05 13:18:50'),
(12, 8, 2, '2026 Monthly Report', '2026-05-05 13:20:35', '2026-05-05 13:20:35'),
(13, 7, NULL, 'LGU Profiling', '2026-05-05 16:34:23', '2026-05-05 16:34:23'),
(15, 5, NULL, '2025 POC Performance Audit', '2026-05-07 10:25:42', '2026-05-07 10:25:42'),
(17, 6, NULL, '2026 OUTGOING COMMS', '2026-05-12 09:54:53', '2026-05-12 09:54:53'),
(18, 6, NULL, '2026 IPCR', '2026-05-12 10:00:01', '2026-05-12 10:00:01'),
(19, 6, 18, '2026 1ST SEM TARGET', '2026-05-12 10:01:22', '2026-05-12 10:01:22'),
(23, 5, NULL, 'C4PEACE', '2026-05-12 15:16:42', '2026-05-12 15:16:42'),
(24, 5, NULL, 'JRTF-ELCAC', '2026-05-12 15:16:48', '2026-05-12 15:16:48'),
(25, 5, NULL, 'PADS', '2026-05-12 16:43:06', '2026-05-12 16:43:06'),
(26, 7, NULL, 'Audit Results', '2026-05-20 08:42:28', '2026-05-20 08:42:28'),
(27, 7, NULL, 'Data Analytics', '2026-05-20 08:42:40', '2026-05-20 08:42:40'),
(28, 2, NULL, 'PPAs', '2026-05-26 18:11:39', '2026-06-01 17:01:02'),
(29, 1, NULL, 'PAR', '2026-05-28 14:00:32', '2026-05-28 14:00:32'),
(30, 6, NULL, 'PAR', '2026-05-28 14:01:28', '2026-05-28 14:01:28'),
(31, 6, 30, 'RCSP', '2026-05-28 14:27:33', '2026-05-28 14:27:33'),
(32, 2, 28, 'Regional Screening Committee (PROCAR)', '2026-06-01 16:45:18', '2026-06-01 16:45:18'),
(33, 2, 28, 'Regional Oversight Committee on Drug Clearing Program (PDEA)', '2026-06-01 16:45:54', '2026-06-01 16:45:54'),
(34, 2, 28, 'RHRMPSB (BJMP) and (BFP)', '2026-06-01 16:46:40', '2026-06-01 16:46:40'),
(35, 2, NULL, 'NIQA/QMS', '2026-06-01 16:50:29', '2026-06-01 16:50:29'),
(36, 2, NULL, 'PRAISE', '2026-06-01 17:01:09', '2026-06-01 17:01:09'),
(37, 2, NULL, 'BAC', '2026-06-01 17:09:05', '2026-06-01 17:09:05'),
(38, 6, 30, 'POST ACTIVITY REPORT ON THE CULMINATING ACTIVITY OF THE FIRE PREVENTION MONTH KICK-OFF PROGRAM', '2026-06-03 17:37:18', '2026-06-03 17:37:18'),
(39, 6, 30, 'JRTF-ELCAC', '2026-06-03 17:39:14', '2026-06-03 17:39:14'),
(40, 6, 30, 'C4PEACE', '2026-06-03 17:39:14', '2026-06-03 17:39:53'),
(41, 6, 30, 'RPOC', '2026-06-03 17:46:04', '2026-06-03 17:46:04'),
(42, 6, 30, 'ADAC', '2026-06-03 18:02:19', '2026-06-03 18:02:19'),
(43, 4, NULL, 'PMDP-MMC', '2026-06-08 15:04:45', '2026-06-08 15:04:45'),
(44, 6, 30, 'MMC - PMDP', '2026-06-08 15:08:09', '2026-06-08 15:08:09'),
(45, 6, 30, 'Post-Activity Report on the Attendance to the 3Ms - A Course on the DILG\'s Culture of Service.pdf', '2026-06-08 17:03:20', '2026-06-08 17:03:20'),
(46, 6, 30, 'POST ACTIVITY REPORT GAD RAPE', '2026-06-08 17:49:01', '2026-06-08 17:49:01'),
(47, 5, 25, 'ICAD', '2026-06-15 17:43:32', '2026-06-15 17:43:32'),
(48, 6, 30, 'PAR- COORDINATION MEETING WITH OPAPRU', '2026-07-08 14:45:33', '2026-07-08 14:45:33'),
(49, 6, 30, 'LTIA', '2026-07-16 10:22:17', '2026-07-16 10:22:17'),
(50, 6, 30, 'NTP', '2026-07-16 10:24:05', '2026-07-16 10:24:05'),
(51, 4, NULL, 'CSIS', '2026-08-25 09:59:17', '2026-08-25 09:59:17'),
(52, 8, 8, '2026 Monthly Report', '2026-08-26 16:28:09', '2026-08-26 16:28:09'),
(53, 8, 9, '2026 Monthly Report', '2026-08-26 16:30:04', '2026-08-26 16:30:16'),
(54, 8, NULL, 'SP 12 - PAR', '2026-08-27 16:24:55', '2026-08-27 16:24:55'),
(55, 8, 54, 'QMS REPORTS', '2026-08-27 17:02:24', '2026-08-27 17:02:24'),
(56, 5, 15, '2026 CRPOC MOVs', '2026-09-02 08:04:53', '2026-09-02 08:04:53'),
(57, 5, 25, 'CBDRP', '2026-09-10 17:49:11', '2026-09-10 17:49:11'),
(58, 5, 25, 'SDEC', '2026-09-10 17:49:23', '2026-09-10 17:49:23'),
(59, 3, NULL, 'Post-Activity Reports', '2026-09-18 09:13:38', '2026-09-18 09:13:38'),
(60, 2, NULL, 'PARs', '2026-09-24 12:52:18', '2026-09-24 12:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_requests`
--

CREATE TABLE `role_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#000000',
  `is_protected` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `color`, `is_protected`, `created_at`, `updated_at`) VALUES
(1, 'Division Chief', '#3dae6c', 1, '2026-05-04 13:13:47', '2026-05-06 22:48:57'),
(2, 'Assistant Division Chief', '#9B5DE5', 1, '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(3, 'LG-Relations and Policy Compliance Section', '#FF6B6B', 1, '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(4, 'LG-Performance Management, Recognition, and Awards Section', '#4ECDC4', 1, '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(5, 'LG-Peace & Order, Public Safety Compliance and Monitoring', '#1A73E8', 1, '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(6, 'Support Services Unit', '#F4A261', 1, '2026-05-04 13:13:47', '2026-05-04 13:13:47'),
(7, 'Database and Statistical Unit', '#36b5a6', 1, '2026-05-04 13:13:47', '2026-05-11 13:12:27'),
(8, 'IT', '#c02bd4', 0, '2026-05-04 13:33:18', '2026-05-12 10:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `section_files`
--

CREATE TABLE `section_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('file','link','folder') NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_files`
--

INSERT INTO `section_files` (`id`, `division_id`, `name`, `type`, `file_path`, `url`, `parent_id`, `user_id`, `created_at`, `updated_at`) VALUES
(10, 3, 'PADS', 'folder', NULL, NULL, NULL, 10, '2026-05-07 10:20:29', '2026-05-07 10:20:29'),
(11, 3, 'POGO', 'folder', NULL, NULL, NULL, 11, '2026-05-07 10:22:13', '2026-05-07 10:22:13'),
(12, 3, '2026', 'folder', NULL, NULL, 11, 11, '2026-05-07 10:22:25', '2026-05-07 10:22:25'),
(14, 3, 'POGO Monitoring Report', 'link', NULL, 'https://docs.google.com/spreadsheets/d/1IZH9fyXkbalqobWaw7Q-5jWDxVLhTpSTZ6yFIyJGj8U/edit?gid=0#gid=0', 12, 11, '2026-05-07 10:22:49', '2026-05-07 10:22:49'),
(29, 3, 'LLA', 'folder', NULL, NULL, NULL, 13, '2026-05-12 11:35:25', '2026-05-12 11:35:25'),
(30, 3, 'CRPOC', 'folder', NULL, NULL, NULL, 13, '2026-05-12 11:38:27', '2026-05-12 11:38:27'),
(31, 3, 'LTIA Forms', 'folder', NULL, NULL, 48, 13, '2026-05-12 11:38:34', '2026-05-12 11:55:06'),
(32, 3, 'KP', 'folder', NULL, NULL, NULL, 13, '2026-05-12 11:38:41', '2026-05-12 11:38:41'),
(33, 3, 'RO 417-2025.pdf', 'file', 'ppa/lgpopscm/aXMFjsBxhCnjvrwjEIypbXWT7c4A8kGMWfmDmGp7.pdf', NULL, 29, 13, '2026-05-12 11:39:38', '2026-05-12 11:39:38'),
(34, 3, 'List of Regional Nominees.docx', 'file', 'ppa/lgpopscm/eb6pMIkr7btzUmG53hinVcm0jP0QbhniCTBCmo5w.docx', NULL, 29, 13, '2026-05-12 11:41:07', '2026-05-12 11:41:07'),
(35, 3, 'Endorsement to BLGS.docx', 'file', 'ppa/lgpopscm/ZGnl0NbLulzZM6aMsDg4inJJO0VzS9wQLIszDomh.docx', NULL, 29, 13, '2026-05-12 11:41:48', '2026-05-12 11:41:48'),
(36, 3, 'RAC-Reconstitution-LLA.docx', 'file', 'ppa/lgpopscm/516T7ambfZXcfAKfkB3Px27G7IUiD9QjolEB50NI.docx', NULL, 29, 13, '2026-05-12 11:42:34', '2026-05-12 11:42:34'),
(37, 3, 'KP CY2025 Report.pdf', 'file', 'ppa/lgpopscm/We440Eo8kTmvbQXaDmE1Nc0wlagbc4vjH1AaajWJ.pdf', NULL, 32, 13, '2026-05-12 11:46:03', '2026-05-12 11:46:03'),
(38, 3, '2025-KP-COMPLIANCE-LUPON-ORG-3c.xlsx', 'file', 'ppa/lgpopscm/bdZMQziVTsDj6TkOZImEAOXKh2E07Wemg88TSRMe.xlsx', NULL, 32, 13, '2026-05-12 11:47:08', '2026-05-12 11:47:08'),
(46, 3, 'Form 7DE. Performance Highlight, Area, Facility and Support.docx', 'file', 'ppa/lgpopscm/khddjF57qc2Q8xo3wJfovp2NAxIaqoeIDk3PMbJc.docx', NULL, 31, 13, '2026-05-12 11:52:35', '2026-05-12 11:52:35'),
(47, 3, 'Form 8. KP Record and Settlement Log.docx', 'file', 'ppa/lgpopscm/0EmhKtflgyoAClQ5DwsIrWERpknEENCljP1BUsQ2.docx', NULL, 31, 13, '2026-05-12 11:52:36', '2026-05-12 11:52:36'),
(48, 3, 'LTIA', 'folder', NULL, NULL, NULL, 13, '2026-05-12 11:54:47', '2026-05-12 11:54:47'),
(49, 3, 'Form 1. Performance Evaluation Form.docx', 'file', 'ppa/lgpopscm/cOyXETRzdtrUiRoBX7Gus4Ta4PnmHk9QNUdzpGF4.docx', NULL, 31, 13, '2026-05-12 11:57:11', '2026-05-12 11:57:11'),
(50, 3, 'Form 2. Consolidated Performance Evaluation Form.docx', 'file', 'ppa/lgpopscm/2EwO9k5APABoAysjAZh7TbEaeYsAmcrYal7pGtsY.docx', NULL, 31, 13, '2026-05-12 11:57:11', '2026-05-12 11:57:11'),
(51, 3, 'Form 3. Comparative Performance Evaluation Form (CMs).docx', 'file', 'ppa/lgpopscm/EBDAEUF8mknwmMZZAGI15BgrizCjSy6k4QXCkO9x.docx', NULL, 31, 13, '2026-05-12 11:57:12', '2026-05-12 11:57:12'),
(52, 3, 'Form 3. Comparative Performance Evaluation Form (Provincess).docx', 'file', 'ppa/lgpopscm/iKu6ClolkD92USd63t1MVWRIXze3m9RX7oC0kbgT.docx', NULL, 31, 13, '2026-05-12 11:57:12', '2026-05-12 11:57:12'),
(53, 3, 'Form 3. Comparative Performance Evaluation Form (Regions).docx', 'file', 'ppa/lgpopscm/WtHEOutXJ4LEJTc0z2fFha0qIGYKT0e9Lwj1ohLg.docx', NULL, 31, 13, '2026-05-12 11:57:12', '2026-05-12 11:57:12'),
(54, 3, 'Form 4a. Non-Qualification.docx', 'file', 'ppa/lgpopscm/YparzDpGsWjlqt7q4gWbwI7VbXFFxNumcWLGzR6V.docx', NULL, 31, 13, '2026-05-12 11:57:32', '2026-05-12 11:57:32'),
(55, 3, 'Form 4. Official Entry Form.docx', 'file', 'ppa/lgpopscm/HBu3MJlHxgigqgYBRJf9955EwkU1dl0cGUQJBL1T.docx', NULL, 31, 13, '2026-05-12 11:57:33', '2026-05-12 11:57:33'),
(56, 3, 'Form 6. Summary of Cases.docx', 'file', 'ppa/lgpopscm/7BGkMXHxPuH8CuqZjfj65PXXZJTgd2eLMR58vSDh.docx', NULL, 31, 13, '2026-05-12 11:58:04', '2026-05-12 11:58:04'),
(57, 3, 'Form 5. Barangay Submission.docx', 'file', 'ppa/lgpopscm/P4G9SzCqGMVmxN7VgoDdUhupOIqgbZBNuDHbF6yj.docx', NULL, 31, 13, '2026-05-12 11:58:04', '2026-05-12 11:58:04'),
(58, 3, 'Form 7C. Performance Highlight, Creativity and Resourcefulness.docx', 'file', 'ppa/lgpopscm/OjA9M3WpKh3DzZPDi8l1OPzWoKSoMWbdoYUVkj4H.docx', NULL, 31, 13, '2026-05-12 11:58:32', '2026-05-12 11:58:32'),
(59, 3, 'Form 7A. Performance Highlight, Efficiency in Operations.docx', 'file', 'ppa/lgpopscm/FLuaueC0Ay3vEBa2x5H0FjXDKjMFzkqRFEyf02Iv.docx', NULL, 31, 13, '2026-05-12 11:58:32', '2026-05-12 11:58:32'),
(60, 3, 'Form 7B. Performance Highlight, Settlement Objective.docx', 'file', 'ppa/lgpopscm/oeZHYIlbtk7K0h56TpPtdWX5wkZwmTghKcAfWMMA.docx', NULL, 31, 13, '2026-05-12 11:58:33', '2026-05-12 11:58:33'),
(61, 3, 'Form 9. Lupong Tagapamayapa Profile.docx', 'file', 'ppa/lgpopscm/FeJOxWRDeDiED77BwtIpVAhSxsibCDsRia9ukUa5.docx', NULL, 31, 13, '2026-05-12 11:58:50', '2026-05-12 11:58:50'),
(62, 3, 'Form 9. Lupong Tagapamayapa Profile(1).docx', 'file', 'ppa/lgpopscm/mR98tmFwQ4F1sscTnAptqIiNpJQQhCiY1pbroRlx.docx', NULL, 31, 13, '2026-05-12 11:58:50', '2026-05-12 11:58:50'),
(63, 3, 'Technical Notes', 'folder', NULL, NULL, 48, 13, '2026-05-12 11:59:31', '2026-05-12 11:59:31'),
(64, 3, 'WORD FILE- Technical Notes 0114.docx', 'file', 'ppa/lgpopscm/E1951TNc3bCtRT0KaJO4DuytMOj3f4a1tsiHmJSm.docx', NULL, 63, 13, '2026-05-12 11:59:45', '2026-05-12 11:59:45'),
(65, 3, 'PAR', 'folder', NULL, NULL, 48, 13, '2026-05-12 12:00:44', '2026-05-12 12:00:44'),
(66, 3, 'PAR LTIA Orientation Feb 3, 2026.pdf', 'file', 'ppa/lgpopscm/zf5ryJxUoF5l6ryC2F6lnmDsMBCI3BTHCGdhLqBY.pdf', NULL, 65, 13, '2026-05-12 12:00:54', '2026-05-12 12:00:54'),
(100, 3, 'C4PEACE', 'folder', NULL, NULL, NULL, 18, '2026-05-12 15:16:17', '2026-05-12 15:16:17'),
(101, 3, 'JRTF-ELCAC OPLAN 2026', 'link', NULL, 'https://docs.google.com/presentation/d/1_WULDAZHyzIbxr83cFfyP8ousNDoIPDR/edit?slide=id.p23#slide=id.p23', 100, 18, '2026-05-12 16:14:16', '2026-05-12 16:14:16'),
(102, 3, 'CBDRP', 'folder', NULL, NULL, 10, 10, '2026-05-12 16:27:47', '2026-05-12 16:27:47'),
(103, 3, 'SDEC', 'folder', NULL, NULL, 10, 10, '2026-05-12 16:27:52', '2026-05-12 16:27:52'),
(104, 3, 'ICAD Advocacy Cluster', 'folder', NULL, NULL, 10, 10, '2026-05-12 16:28:04', '2026-05-12 16:28:04'),
(105, 3, 'Anti-Drug Abuse Council (ADAC)', 'folder', NULL, NULL, 10, 10, '2026-05-12 16:28:28', '2026-05-12 16:28:28'),
(106, 3, 'IDADAIT', 'folder', NULL, NULL, 10, 10, '2026-05-12 16:28:53', '2026-05-12 16:28:53'),
(107, 3, 'DAPC', 'folder', NULL, NULL, 10, 10, '2026-05-12 16:28:59', '2026-05-12 16:28:59'),
(108, 3, '1st Quarter CBDRP Report.pdf', 'file', 'ppa/lgpopscm/QihWIvfJylmIW1YUuSI6AvlIflMhsDm9XgSlyNY9.pdf', NULL, 102, 10, '2026-05-12 16:32:48', '2026-05-12 16:32:48'),
(109, 3, 'SDEC Annual Report.pdf', 'file', 'ppa/lgpopscm/YoIZjFu9lzeuQxV3pXWhWxNtXn4YeQRlpCWRh7Y9.pdf', NULL, 103, 10, '2026-05-12 16:33:20', '2026-05-12 16:33:20'),
(110, 3, 'ICAD Advocacy Cluster_1Q Meeting', 'link', NULL, 'https://drive.google.com/file/d/1TYPzxwtpH83C9huyYZUf9Er7KAIngkFi/view?usp=drive_link', 104, 10, '2026-05-12 16:36:26', '2026-05-12 16:36:26'),
(111, 3, 'CY 2026 ADAC Performance Audit PAR', 'link', NULL, 'https://drive.google.com/file/d/1SFDMVpN1RYjoFJMiED45CB_tRCn_pFYq/view?usp=drive_link', 105, 10, '2026-05-13 13:28:08', '2026-05-13 13:28:08'),
(112, 3, 'DILG LED CLUSTER DIRECTORY', 'link', NULL, 'https://docs.google.com/spreadsheets/d/1RZcfyAbzG2vsf723gqCvNsOWOlCmdjK-knt8vZL1d8M/edit?gid=0#gid=0', 100, 18, '2026-05-19 08:44:10', '2026-05-19 08:44:10'),
(113, 3, 'JRTF-ELCAC DILG LED CLUSTER MONTHLY ACCOM', 'link', NULL, 'https://tinyurl.com/JRTF-DILG-LED-MONTHLY', 100, 18, '2026-05-19 08:44:30', '2026-05-19 08:44:30'),
(114, 3, 'RCSP', 'folder', NULL, NULL, 100, 18, '2026-05-19 08:44:53', '2026-05-19 08:44:53'),
(115, 3, 'CO- 2026 CAR - RCSP Assessment Monitoring', 'link', NULL, 'https://tinyurl.com/CARRCSPMonitoring26', 114, 18, '2026-05-19 08:45:40', '2026-05-19 08:45:40'),
(116, 3, 'RO- 2026 CAR - RCSP Assessment Monitoring', 'link', NULL, 'https://tinyurl.com/RO-Monitoring-2026', 114, 18, '2026-05-19 08:45:57', '2026-05-19 08:45:57'),
(117, 3, 'C4PEACE MONTHLY SUBMISSION TO CO', 'link', NULL, 'https://tinyurl.com/C4PEACE-TO-CO', 114, 18, '2026-05-19 08:46:14', '2026-05-19 08:46:14'),
(118, 3, 'Submitted AD MRMS of the 5 provinces for the 2026 RCSP', 'link', NULL, 'https://drive.google.com/drive/u/1/folders/1y3YJ2gvzQ4bfTP-2tOgsQi00RAs3iQW3', 114, 18, '2026-05-19 08:46:49', '2026-05-19 08:46:49'),
(119, 3, 'Resolutions', 'folder', NULL, NULL, 30, 13, '2026-05-20 13:48:09', '2026-05-20 13:48:09'),
(120, 3, '1 2025 Reso 1 Enjoining all LGUs to Intensify Prevention n Addressinbg VAWC & All Other Forms of Gender-Based Violence.pdf', 'file', 'ppa/lgpopscm/bom2n6nm4CJeIYg8YkduG1dqUeEAT0iXv70AIUZq.pdf', NULL, 119, 13, '2026-05-20 13:48:52', '2026-05-20 13:48:52'),
(121, 3, '12 Support and Approval to Northern Shiel.pdf', 'file', 'ppa/lgpopscm/bHlHz81c3eVDZhfZAmXM9SPiwjKuiaWLMX635HiF.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(122, 3, '2 2025 Reso 2 ELCAC SBDP.pdf', 'file', 'ppa/lgpopscm/UoXhQMmWdLr0OD6kJMvV8xLTAT3Odyv1hrhh4Pj6.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(123, 3, '3 2025 Reso 3 RBIM CPD.pdf', 'file', 'ppa/lgpopscm/WaL5FTHKRbeAOxFMxIi6vaVxKtmuU9m6yMI6i4Bx.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(124, 3, '4ARESO~1.PDF', 'file', 'ppa/lgpopscm/uyLdV5gXSqhiMAGgSqVZdQr2K4XH42pqKCk0jjJk.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(125, 3, '5 A Reso Strongly Endorsing the Benguet PPOC Resolution.pdf', 'file', 'ppa/lgpopscm/4thic9XffZkMAd2filJEWT0w98PF64bWCC2zzJCP.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(126, 3, '6 A Resolution Strongly Enjoining All LGUs to Strengthen Boarder Security in their Areas of Responsibility.pdf', 'file', 'ppa/lgpopscm/LOHiz8a2jjXJDG3H9evxdWkFjEr9GNpQ10JQGCFn.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(127, 3, '7 2025 Reso 7 CRPOC TWG on Gender Based Violence.pdf', 'file', 'ppa/lgpopscm/PQ0AWNrpf6UpiOf4eMDWLKJZ9AYU5GKSdubJm11L.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(128, 3, '8 Desist from settling rape cases.pdf', 'file', 'ppa/lgpopscm/vSxe0aJD9Ds0RaWZJnLF03rPaJuHcMNWR4lZhWIZ.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(129, 3, '9 CRPOC Reorganization .pdf', 'file', 'ppa/lgpopscm/8nFUEJZ7BFAoeDJ44uPiQoid1qqg8JPT0sCDRYm5.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(130, 3, '10 TWG Contingency Planning for Natural and Human Induced Calamities.pdf', 'file', 'ppa/lgpopscm/AxO2PSppWzwTpElSmOQMRGmGhBw57nnhOEWpTH4n.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(131, 3, '11 Support to Battalion Size PNP in prep for transition.pdf', 'file', 'ppa/lgpopscm/BkR0c5wU3DG79JV1IiBTOu6Ih5lZ2URUYqMTG6e1.pdf', NULL, 119, 13, '2026-05-20 13:49:08', '2026-05-20 13:49:08'),
(132, 3, '2019', 'folder', NULL, NULL, 119, 13, '2026-05-20 13:49:41', '2026-05-20 13:49:41'),
(133, 3, 'RDC RPOC Res 37.pdf', 'file', 'ppa/lgpopscm/21vreObjNY7gzlhSVi1OvFHpUjywKFT3qOsjKsHE.pdf', NULL, 132, 13, '2026-05-20 13:49:55', '2026-05-20 13:49:55'),
(134, 3, 'RDC RPOC Res 32 s 2019.pdf', 'file', 'ppa/lgpopscm/CQ5e0OFvbBJb2aEYx0QFNCxj29vheR8Gl7Gqnoi2.pdf', NULL, 132, 13, '2026-05-20 13:49:55', '2026-05-20 13:49:55'),
(135, 3, '2020', 'folder', NULL, NULL, 119, 13, '2026-05-20 13:50:10', '2026-05-20 13:50:10'),
(136, 3, 'Res 4 Persona non Grata MJ Cultivators.pdf', 'file', 'ppa/lgpopscm/hLehbo1mjobKERrRYx8lR4pqm0gq9VsPjXOhKIl5.pdf', NULL, 135, 13, '2026-05-20 13:50:22', '2026-05-20 13:50:22'),
(137, 3, 'Res 1, s.2020 re Anti-Terrorism Bill.pdf', 'file', 'ppa/lgpopscm/Q7avN16cUJGGT1O8XWBgp6d0UzlARI5QtPfZdOri.pdf', NULL, 135, 13, '2026-05-20 13:50:22', '2026-05-20 13:50:22'),
(138, 3, 'Res 2 Panata.pdf', 'file', 'ppa/lgpopscm/YMdzXL14PbvKnzyNbfhKU7SqKI8qucwWSQHaQoPC.pdf', NULL, 135, 13, '2026-05-20 13:50:22', '2026-05-20 13:50:22'),
(139, 3, 'Res 3, s.2020 Dishonor support to CPP NPA NDF.pdf', 'file', 'ppa/lgpopscm/YIxO6ujCW7Ge2eA2mWMaHaYxtxLIO5xXmqiLukck.pdf', NULL, 135, 13, '2026-05-20 13:50:22', '2026-05-20 13:50:22'),
(140, 3, '2021', 'folder', NULL, NULL, 119, 13, '2026-05-20 13:50:43', '2026-05-20 13:50:43'),
(141, 3, 'Reso 8 2021 Endorsing Sadanga MPOC Reso 3.pdf', 'file', 'ppa/lgpopscm/XHsmalf7pW56jYm3wnqNk2mp7radHhd5NLFdEtPN.pdf', NULL, 140, 13, '2026-05-20 13:51:01', '2026-05-20 13:51:01'),
(142, 3, 'Res 3 2021 Dumanun Makitungtung.pdf', 'file', 'ppa/lgpopscm/QGeGYLZEaUoWAGpQblKbHJh36TnztivZn5fBjcBk.pdf', NULL, 140, 13, '2026-05-20 13:51:01', '2026-05-20 13:51:01'),
(143, 3, 'Reso 4 2021 Adopting NCIP Reso 8.pdf', 'file', 'ppa/lgpopscm/EQIAP8a0YYVvnv754qsshytXOsb6VkArwgjUJspc.pdf', NULL, 140, 13, '2026-05-20 13:51:01', '2026-05-20 13:51:01'),
(144, 3, 'Reso 5 2021 Adopting NCIP Reso 8-72.pdf', 'file', 'ppa/lgpopscm/b2OQNpFAZKyl8TDW11128iHbQWzKa66iTVYvuGGI.pdf', NULL, 140, 13, '2026-05-20 13:51:01', '2026-05-20 13:51:01'),
(145, 3, 'Reso 6 2021 Adopting Reso 8-73.pdf', 'file', 'ppa/lgpopscm/MWC8KOdtqr9cZyP2q8xwg4H0VIGgLJ80jsZssFh5.pdf', NULL, 140, 13, '2026-05-20 13:51:01', '2026-05-20 13:51:01'),
(146, 3, 'Reso 7 2021 Adopting NCIP Reso 8-74.pdf', 'file', 'ppa/lgpopscm/6pMAtyiUwPv6WukZxEmOcOP1N6xiBNfBdJGCA1Bn.pdf', NULL, 140, 13, '2026-05-20 13:51:01', '2026-05-20 13:51:01'),
(147, 3, '2022', 'folder', NULL, NULL, 119, 13, '2026-05-20 13:51:29', '2026-05-20 13:51:29'),
(148, 3, 'CRPOC CY 2022 Resolutions 1-8 FINAL.pdf', 'file', 'ppa/lgpopscm/sxDOXMMRqdZUnX3J9lQBhRvCRTkxHv60J34502sI.pdf', NULL, 147, 13, '2026-05-20 13:51:42', '2026-05-20 13:51:42'),
(149, 3, '2023', 'folder', NULL, NULL, 119, 13, '2026-05-20 13:51:55', '2026-05-20 13:51:55'),
(150, 3, 'Reso 10 Forest Laws.pdf', 'file', 'ppa/lgpopscm/7lXqisgn8gHVAjgyVhsabJrOkFza0UnnhpvicyI6.pdf', NULL, 149, 13, '2026-05-20 13:52:20', '2026-05-20 13:52:20'),
(151, 3, 'Reso 11 Support the continuance of NTF ELCAC.pdf', 'file', 'ppa/lgpopscm/3xSmwqfX8Hcm968LFw918Rx4vathHgGZ1GtgMA4c.pdf', NULL, 149, 13, '2026-05-20 13:52:20', '2026-05-20 13:52:20'),
(152, 3, 'Reso 12 Urging LCEs of SBDPs to Adhere to Natl Standards.pdf', 'file', 'ppa/lgpopscm/BFtwyJnFoKu2Yck32M8IU9U7QHH8iyyA4eIoX6EO.pdf', NULL, 149, 13, '2026-05-20 13:52:20', '2026-05-20 13:52:20'),
(153, 3, 'Reso 13 Request to DBM.pdf', 'file', 'ppa/lgpopscm/S43cKd9dxrUyMbIAJkUGcYbHVwFy22Kpw93m69zg.pdf', NULL, 149, 13, '2026-05-20 13:52:20', '2026-05-20 13:52:20'),
(154, 3, 'Reso 14 Request DDB to Fund FMR.pdf', 'file', 'ppa/lgpopscm/9gssD0ut6QjBiNjv90CyTLvEvseIbV8VjK2eGpt5.pdf', NULL, 149, 13, '2026-05-20 13:52:20', '2026-05-20 13:52:20'),
(155, 3, 'Reso 15 Commending PLEDS.pdf', 'file', 'ppa/lgpopscm/b73ErEfOKJxXhOQky8mKzyziRtwjf9nqy02qkHNq.pdf', NULL, 149, 13, '2026-05-20 13:52:20', '2026-05-20 13:52:20'),
(156, 3, 'Reso 16 Reinforce Anti Rape Campaigns.pdf', 'file', 'ppa/lgpopscm/ZL3VJXpg2REYkBaOCpgGfLWsFW1g4nEJlIvbQu7T.pdf', NULL, 149, 13, '2026-05-20 13:52:20', '2026-05-20 13:52:20'),
(157, 3, 'Reso 17 Report to PNP Suspicious Individuals.pdf', 'file', 'ppa/lgpopscm/Q8LnDXDicWiZpXZDef1pp4iEQZo5tTLtyMdafKEP.pdf', NULL, 149, 13, '2026-05-20 13:52:20', '2026-05-20 13:52:20'),
(158, 3, 'Reso 18 Support Implementation of CSP to BC.pdf', 'file', 'ppa/lgpopscm/juPmIPJX01Y76yPRy77xpMvF7Xk42dRfFBijo8gR.pdf', NULL, 149, 13, '2026-05-20 13:52:20', '2026-05-20 13:52:20'),
(159, 3, 'CRPOC Resolution No. 1 series of 2023.pdf', 'file', 'ppa/lgpopscm/1NURf6cQVhAsXKzWWmPYlr7AtXZ5pqMMncrn6bmJ.pdf', NULL, 149, 13, '2026-05-20 13:52:21', '2026-05-20 13:52:21'),
(160, 3, 'Reso 1 Support to Mayor Magalong.pdf', 'file', 'ppa/lgpopscm/E4IQNRf8E2szi8HJ7Z3NJUAB275PDdnO8XuVWqt1.pdf', NULL, 149, 13, '2026-05-20 13:52:22', '2026-05-20 13:52:22'),
(161, 3, 'Reso 2 CRPOCReorganization.pdf', 'file', 'ppa/lgpopscm/1Yn3Y9BfkVC5RN6Vrv8UkmnK4yRVWBYUVGd88nYZ.pdf', NULL, 149, 13, '2026-05-20 13:52:22', '2026-05-20 13:52:22'),
(162, 3, 'Reso 3 Creating SACs.pdf', 'file', 'ppa/lgpopscm/LxpqH8jvWBEb5gsbFVZ6ftz3leazckWJcWNWpYEG.pdf', NULL, 149, 13, '2026-05-20 13:52:22', '2026-05-20 13:52:22'),
(163, 3, 'Reso 4 TWG 4 Rape Incidences.pdf', 'file', 'ppa/lgpopscm/wJcY0zE73C3xBT0oMOX1mrbSoaR141bML9MM44k4.pdf', NULL, 149, 13, '2026-05-20 13:52:22', '2026-05-20 13:52:22'),
(164, 3, 'Reso 5 Unis to Allow IECs.pdf', 'file', 'ppa/lgpopscm/sf7WdSGRxlzAOBTDMpASHP5E6tj793nLB1vVaBtd.pdf', NULL, 149, 13, '2026-05-20 13:52:22', '2026-05-20 13:52:22'),
(165, 3, 'Reso 6 Destruction Facility.pdf', 'file', 'ppa/lgpopscm/gfqZxcAoWfGpspvP678uukxxStyfAjrHqTpvzyGD.pdf', NULL, 149, 13, '2026-05-20 13:52:22', '2026-05-20 13:52:22'),
(166, 3, 'Reso 7 VTAs.pdf', 'file', 'ppa/lgpopscm/cDxJBdvDQCT2UxMnjFijxH2FJUR7Brxh5Z50YHDh.pdf', NULL, 149, 13, '2026-05-20 13:52:22', '2026-05-20 13:52:22'),
(167, 3, 'Reso 8 Support to BIDA.pdf', 'file', 'ppa/lgpopscm/fRcnU2S0M6NedtNFoDOiXfxpwec5Lm69zi0UNSPr.pdf', NULL, 149, 13, '2026-05-20 13:52:22', '2026-05-20 13:52:22'),
(168, 3, 'Reso 9 Attendance ot LCEs to CRPOC.pdf', 'file', 'ppa/lgpopscm/einBCnqsCEFT7cWbvKsdIvAMNh347fDfhw293Dri.pdf', NULL, 149, 13, '2026-05-20 13:52:22', '2026-05-20 13:52:22'),
(169, 3, '2024', 'folder', NULL, NULL, 119, 13, '2026-05-20 13:52:37', '2026-05-20 13:52:37'),
(170, 3, '4 CRPOC Reso 4 2025.pdf', 'file', 'ppa/lgpopscm/T0S9tCVKYmmX1XfsRcny7QlJHi6LOp06WooMkqjv.pdf', NULL, 169, 13, '2026-05-20 13:53:00', '2026-05-20 13:53:00'),
(171, 3, '4 CRPOC-Reso No. 4 2024 Enjoining all LGUs in CAR to enact an Ordinance Regulating Alcohol Use.pdf', 'file', 'ppa/lgpopscm/9cECjB8uSvgNnYzsGMunpmBwuhXeGWvmNhfhPP3w.pdf', NULL, 169, 13, '2026-05-20 13:53:00', '2026-05-20 13:53:00'),
(172, 3, '5 CRPOC Reso No 5 2024 Shifting the Flagship Program from Reduction of Rape Cases to the Reduction of all Gender Based Violence.pdf', 'file', 'ppa/lgpopscm/fTCI53TsIg1BBvSvKOaezwlFmxXo11eC4VI9RGvM.pdf', NULL, 169, 13, '2026-05-20 13:53:00', '2026-05-20 13:53:00'),
(173, 3, '5 CRPOC Reso No. 5.pdf', 'file', 'ppa/lgpopscm/oYejHgIWmn5mnQ1tEEvU5uP5IwEaIDzzj0VV5f5o.pdf', NULL, 169, 13, '2026-05-20 13:53:00', '2026-05-20 13:53:00'),
(174, 3, '1 CRPOC-RESO No. 01 s. 2024 - SBDP Fund Augmentation.pdf', 'file', 'ppa/lgpopscm/eWAwNeEUodbJRF1hJwVSGasAnNacnNqWVSAoVoKP.pdf', NULL, 169, 13, '2026-05-20 13:53:00', '2026-05-20 13:53:00'),
(175, 3, '2 CRPOC-Resolution-No.-2-s.-2024-re-Proposing-Amendments-to-the-Proposed-Ordinance-0026-23-aka-HRD-Protection-Ordinance.pdf', 'file', 'ppa/lgpopscm/XvzmRzsu7aY54pi4BHUXU3njKLIEMiRjo85RKswr.pdf', NULL, 169, 13, '2026-05-20 13:53:00', '2026-05-20 13:53:00'),
(176, 3, '3 CRPOC-Reso No. 3 2024 Support Effort re WPS.pdf', 'file', 'ppa/lgpopscm/Yo3EA0Mijj97zPdJH5rYvfRKINfQDoCcGQIHcggc.pdf', NULL, 169, 13, '2026-05-20 13:53:00', '2026-05-20 13:53:00'),
(177, 3, '2025', 'folder', NULL, NULL, 119, 13, '2026-05-20 13:53:54', '2026-05-20 13:53:54'),
(178, 3, 'Minutes of Meetings', 'folder', NULL, NULL, 30, 13, '2026-05-20 13:55:23', '2026-05-20 13:55:23'),
(179, 3, 'CY2025', 'folder', NULL, NULL, 178, 13, '2026-05-20 13:55:35', '2026-05-20 13:55:35'),
(180, 3, 'CY2024', 'folder', NULL, NULL, 178, 13, '2026-05-20 13:56:27', '2026-05-20 13:56:27'),
(181, 3, 'Minutes of Mtng sgnfying the attendance and active participation of CSOs.pdf', 'file', 'ppa/lgpopscm/wfZo3jQ3bJQH3WHAIbQLOM7uGhHUJnyRg2GalUK2.pdf', NULL, 180, 13, '2026-05-20 13:56:53', '2026-05-20 13:56:53'),
(182, 3, '1 Attendance March 14, 2024.pdf', 'file', 'ppa/lgpopscm/T5ECLBhbXEe7dKvQbc7aZwBy6pYnnbbAnBAg3UGu.pdf', NULL, 180, 13, '2026-05-20 13:56:53', '2026-05-20 13:56:53'),
(183, 3, '1 MOM March 14, 2024.pdf', 'file', 'ppa/lgpopscm/EVYB0C6LUhnYDmryK7tMvblGK2xbdk2BKhhtxPBj.pdf', NULL, 180, 13, '2026-05-20 13:56:53', '2026-05-20 13:56:53'),
(184, 3, '1 Notice Acknowledgement.pdf', 'file', 'ppa/lgpopscm/VUDTfGwSZ8Liv8X7n7hNXGPYgvK8mOKyqJ9fcyd8.pdf', NULL, 180, 13, '2026-05-20 13:56:53', '2026-05-20 13:56:53'),
(185, 3, '2 Notice Acknowledgment June 24, 2024.pdf', 'file', 'ppa/lgpopscm/ARA6wwxpi6MkXGEzGdzEN5xIgumccKhBQLMEclz5.pdf', NULL, 180, 13, '2026-05-20 13:57:07', '2026-05-20 13:57:07'),
(186, 3, '2 Attendance June 24, 2024.pdf', 'file', 'ppa/lgpopscm/T4cFZrnfPtlWFKEUlQCAVTtpWFvlrHdaNU33PRsu.pdf', NULL, 180, 13, '2026-05-20 13:57:07', '2026-05-20 13:57:07'),
(187, 3, '2 MOM June 24, 2024.pdf', 'file', 'ppa/lgpopscm/p6qyqhpP9pyNW7XPz1Jjadgpjzg5GfTEho6NWIeR.pdf', NULL, 180, 13, '2026-05-20 13:57:07', '2026-05-20 13:57:07'),
(188, 3, '3 Notice Acknowledgment.pdf', 'file', 'ppa/lgpopscm/7pRjHZ6IQYhbov97iTjPD9STyzV2HMBEtpW06fnE.pdf', NULL, 180, 13, '2026-05-20 13:57:18', '2026-05-20 13:57:18'),
(189, 3, '3 Attendance Sept 20, 2024.pdf', 'file', 'ppa/lgpopscm/lHNMUL52bnjv5s1DsGmXmg0xmegDTJnWfcaMOpVT.pdf', NULL, 180, 13, '2026-05-20 13:57:18', '2026-05-20 13:57:18'),
(190, 3, '3 MOM Sept 20, 2024.pdf', 'file', 'ppa/lgpopscm/hiVX7UV96CWbW2QXHGZ6vTArHcRO9mp78xBnNX1k.pdf', NULL, 180, 13, '2026-05-20 13:57:18', '2026-05-20 13:57:18'),
(191, 3, '4 Notice Acknowledgement.pdf', 'file', 'ppa/lgpopscm/zgyjIyBJPKogy7hSDzvcDV9eul5gk4mEfVcFjuQ0.pdf', NULL, 180, 13, '2026-05-20 13:57:32', '2026-05-20 13:57:32'),
(192, 3, '4 Attendance Dec 4, 2024.pdf', 'file', 'ppa/lgpopscm/kVogl84dQceGJThQRCC2uaDSzEJHiiww3SfqpCV9.pdf', NULL, 180, 13, '2026-05-20 13:57:32', '2026-05-20 13:57:32'),
(193, 3, '4 MOM Dec 4, 2025.pdf', 'file', 'ppa/lgpopscm/dQ06FPIansJ2MsHoQJEVkhYKnPIf13u7koimhWpQ.pdf', NULL, 180, 13, '2026-05-20 13:57:32', '2026-05-20 13:57:32'),
(194, 3, 'CY2023', 'folder', NULL, NULL, 178, 13, '2026-05-20 14:01:32', '2026-05-20 14:01:32'),
(195, 3, 'CY2023 Q4 MOM.pdf', 'file', 'ppa/lgpopscm/fb8PR34294WB4Wh1syoYOIpKY4tLj7Objae5ni1D.pdf', NULL, 194, 13, '2026-05-20 14:01:47', '2026-05-20 14:01:47'),
(196, 3, 'CY 2023 Q1 MOM.pdf', 'file', 'ppa/lgpopscm/n2i3ZUEKb2bpTnwXdrEh6gNB0kb44R30H5e7iUoR.pdf', NULL, 194, 13, '2026-05-20 14:01:47', '2026-05-20 14:01:47'),
(197, 3, 'CY 2023 Q2 MOM.pdf', 'file', 'ppa/lgpopscm/qd517IuLcIalJf5HBJXhxPKllLyrXRf9qnEc5gqA.pdf', NULL, 194, 13, '2026-05-20 14:01:47', '2026-05-20 14:01:47'),
(198, 3, 'CY 2023 Q3 MOM.pdf', 'file', 'ppa/lgpopscm/YMEILeazQclOJFHFNBAJCpBdpOmKSd1o0MqvQ7uw.pdf', NULL, 194, 13, '2026-05-20 14:01:47', '2026-05-20 14:01:47'),
(199, 3, 'POC Audit', 'folder', NULL, NULL, 30, 20, '2026-05-20 14:35:23', '2026-05-20 14:35:23'),
(200, 3, 'POC - Change of date', 'link', NULL, 'https://docs.google.com/document/d/1fV_aeC9ntHeYB6E1a9vuhPQ6EGuH_XaH/edit?usp=sharing&ouid=107855101280759335838&rtpof=true&sd=true', 199, 20, '2026-05-20 14:35:40', '2026-05-20 14:35:40'),
(201, 3, 'Annual Reports', 'folder', NULL, NULL, 30, 13, '2026-05-20 16:28:37', '2026-05-20 16:28:37'),
(202, 3, 'References', 'folder', NULL, NULL, 30, 13, '2026-05-20 16:31:04', '2026-05-20 16:31:04'),
(203, 3, 'DirDebieTorres_CY 2022 CRPOC NARRATIVE REPORT.pdf', 'file', 'ppa/lgpopscm/NOghG7Ss9HqqCBY50au7hBDU28JteWTa1qY6QAMW.pdf', NULL, 201, 13, '2026-05-20 16:33:24', '2026-05-20 16:33:24'),
(204, 3, 'CY2025 Narrative Report.pdf', 'file', 'ppa/lgpopscm/ryRtinFtdrfHxSwMzsiJhM2nmSCO1aAS8TggrotC.pdf', NULL, 201, 13, '2026-05-20 16:33:51', '2026-05-20 16:33:51'),
(205, 3, 'Q1 CRPOC MOM.pdf', 'file', 'ppa/lgpopscm/R9Hd7z1rgzxpgozon3LlzoW0l2gIXBUcsoegPS3D.pdf', NULL, 179, 13, '2026-05-20 16:37:23', '2026-05-20 16:37:23'),
(206, 3, 'Q2 CRPOC MOM.pdf', 'file', 'ppa/lgpopscm/Bh2GmmQ8vDL697smYjJeApm2w7rHtGO5YG25KHni.pdf', NULL, 179, 13, '2026-05-20 16:37:34', '2026-05-20 16:37:34'),
(207, 3, 'Q3 CRPOC MOM.pdf', 'file', 'ppa/lgpopscm/yI1AXXdo6kwTt1YEfNSsnJZDaKBlbhqbrohRux5N.pdf', NULL, 179, 13, '2026-05-20 16:37:55', '2026-05-20 16:37:55'),
(208, 3, 'Q4 CRPOC MOM.pdf', 'file', 'ppa/lgpopscm/dMR9q1ZkIqKohLqlh5Z1bZ7pYuMXPmhmSOpVSF3d.pdf', NULL, 179, 13, '2026-05-20 16:38:07', '2026-05-20 16:38:07'),
(209, 3, 'Audit Results', 'folder', NULL, NULL, 30, 13, '2026-05-20 16:39:24', '2026-05-20 16:39:24'),
(210, 3, 'CY 2023', 'folder', NULL, NULL, 209, 13, '2026-05-20 16:39:37', '2026-05-20 16:39:37'),
(211, 3, 'RPOCCAR_2023POCPerformanceAuditProfile.pdf', 'file', 'ppa/lgpopscm/316KrhCLxBkYZseUuKT32mEhVwmQarvTSy3idWKA.pdf', NULL, 210, 13, '2026-05-20 16:39:51', '2026-05-20 16:39:51'),
(212, 3, 'CAR_2023ListOfLPOCsWithPOCAuditRatings.pdf', 'file', 'ppa/lgpopscm/VgHsbWmeTlI0YiMqKSFoRwCAc4dTUDLV6WYKyJN6.pdf', NULL, 210, 13, '2026-05-20 16:40:01', '2026-05-20 16:40:01'),
(213, 3, 'Certificates of Appointment', 'folder', NULL, NULL, 30, 13, '2026-05-20 16:40:51', '2026-05-20 16:40:51'),
(214, 3, '2025-2028 CERTS OF APPOINTMENT OF THE RPOC CHAIRPERSON AND VICE CHAIRPERSONS.pdf', 'file', 'ppa/lgpopscm/Rmb8TvdORZ3lF3DIY0gdTRHkuLQZj8mH2286VpdY.pdf', NULL, 213, 13, '2026-05-20 16:42:59', '2026-05-20 16:42:59'),
(215, 3, 'Notices', 'folder', NULL, NULL, 30, 13, '2026-05-20 16:45:22', '2026-05-20 16:45:22'),
(216, 3, 'Notice-of-Meeting-All-CRPOC-Members.docx', 'file', 'ppa/lgpopscm/gWcki0y8aGu1fwqo5lRg2gb2IwTTNI2RoYi1F1AA.docx', NULL, 215, 13, '2026-05-20 16:45:42', '2026-05-20 16:45:42'),
(217, 3, 'Memo to FOUs.docx', 'file', 'ppa/lgpopscm/YjNWedW0Y0iSPmf1ZCMef7PaWcM3nu2NQf9cTzDc.docx', NULL, 215, 13, '2026-05-20 16:45:49', '2026-05-20 16:45:49'),
(218, 3, 'Letter to Mayor Magalong.docx', 'file', 'ppa/lgpopscm/P7ub5VqekAiptoYEXoNI5iw7uG6Cz3FBPNjJfnIf.docx', NULL, 215, 13, '2026-05-20 16:45:56', '2026-05-20 16:45:56'),
(219, 3, '5. FF Matters Arising from Q4 December 17, 2025.docx', 'file', 'ppa/lgpopscm/XaLPqTbJCtMlTxa5RvZpSmznP3U1zqxhh4BCtIRN.docx', NULL, 215, 13, '2026-05-20 16:46:25', '2026-05-20 16:46:25'),
(220, 3, '2. Content.docx', 'file', 'ppa/lgpopscm/iL51Di2BXxHm4lgqekDHoaFALjw4L7tpMVef9Red.docx', NULL, 215, 13, '2026-05-20 16:46:25', '2026-05-20 16:46:25'),
(221, 3, '3. FF PROGRAM mARCH 18, 2026.docx', 'file', 'ppa/lgpopscm/IeLGCxjh8e7YVr1AoUPFbG5pEmjoJGGabFKhCgGL.docx', NULL, 215, 13, '2026-05-20 16:46:25', '2026-05-20 16:46:25'),
(222, 3, '4. FF Agenda.docx', 'file', 'ppa/lgpopscm/Wj4ux5gaz52PfzPCFg603DuCkeGAr4zk4uBh5eMt.docx', NULL, 215, 13, '2026-05-20 16:46:25', '2026-05-20 16:46:25'),
(223, 3, 'RCSP SCHEDULE  MONITORING', 'link', NULL, 'https://docs.google.com/spreadsheets/d/1W81_vPHS-PSu2dL36CEE8BhGSDfdBHgCmneXLwTybYg/edit?gid=1920967261#gid=1920967261', 114, 18, '2026-05-21 15:47:33', '2026-05-21 15:47:33'),
(224, 3, 'Chair\'s BRIEFER Q3 2025.docx', 'file', 'ppa/lgpopscm/sQmEg0DiDZ89VFMK1mkktyuWIQEXsigbvpI6hNZF.docx', NULL, 215, 13, '2026-05-26 12:06:41', '2026-05-26 12:06:41'),
(225, 3, 'Letter to PROCAR PDEA 5ID DSWD.docx', 'file', 'ppa/lgpopscm/2GGf0OxIceODF5KTZSnfjFkGWd5IIqW4QgWr7nSf.docx', NULL, 215, 13, '2026-05-26 12:07:46', '2026-05-26 12:07:46'),
(226, 3, 'References', 'folder', NULL, NULL, 48, 13, '2026-05-26 18:07:07', '2026-05-26 18:07:07'),
(227, 3, '0129 Slide Deck - Onboarding with LTIA Focals.pptx', 'file', 'ppa/lgpopscm/2ZoTsIkPxObClcWFhbMGsAw8EEAEFuKD3FbPqlob.pptx', NULL, 226, 13, '2026-05-26 18:07:18', '2026-05-26 18:07:18'),
(228, 3, 'Queries Raised during the LTIA Onboarding.xlsx', 'file', 'ppa/lgpopscm/EVnyW4pF3nwstaLRfuu9iSKZLvCPByCJcIiCQqSB.xlsx', NULL, 226, 13, '2026-05-26 18:07:40', '2026-05-26 18:07:40'),
(229, 5, 'Audit Results (2022-2025)', 'folder', NULL, NULL, NULL, 11, '2026-06-08 12:34:42', '2026-06-08 12:34:42'),
(230, 5, 'AUDIT RESULTS 2022 ONWARDS', 'link', NULL, 'https://drive.google.com/drive/folders/1X5aKT0ZzYx6re4CDfjqi3TgxS76ykkD8', 229, 11, '2026-06-08 12:58:07', '2026-06-08 12:58:07'),
(231, 2, 'Citizen Satisfaction Index System (CSIS)', 'folder', NULL, NULL, NULL, 23, '2026-06-08 15:12:12', '2026-06-08 15:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `section_folder`
--

CREATE TABLE `section_folder` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `divisions_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('FILE','LINK') NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('2025NdhOxGDMRuX41MGpf90krnDatfUDMe0cDop9', 27, '152.32.126.28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'ZXlKcGRpSTZJbm96ZGxWWU1YZFBiV00zVkRrM2FXbFJha1ZZYm1jOVBTSXNJblpoYkhWbElqb2lVbVZ2VW05SGIwZHZjV1Y2T0ZaYVYxUlBZV1JOVlV4dmNtMU1kM2x5Ym1aTFRuTnZjalZ3WTNSU1JTOVNXa3BZTm1VM1MxTlVVekl3V2xkUVkxWkZORkZNVGtkalkwSktSMGhNYVdKRk5XNXhNRmxyYWs4MWVXcHRPVE13V1dRNFUwZEdVMGRqUmtFM1pYTnFRVFpHTUd4WFNuUldaemg1UjFJMldsQmpPWFpPWlN0V2RWa3hXalZIWVVKSFMyRlJWRTR5VkRkU1pXSTVWMHB3UVU1aGFFMWFPVGc1TmpOR2JXbG9XRGhYV1RkVmVscDVTSFF6YWxwWFpqWnVNVW9yVUhZeVkyaDRNMU5EVDJaRVUwdDFZVVpYWmxsclJYbGFaR2xOY25Kc0sxWjFkWGw1UjBwelVFZzNUbmt6YWpaNlEyaDVWRms0TlVad2VIaHRSRzUxVDJ4WU4yUXdRVEp5UlRjd2JWSlVjVTAzVEV0NGVtbzNXRk5rTHpFM00wNWhaWFpPZGxWSWFXOHdSM2N2WkRkclltZHRVRXA0U2xkYVVsSklia0paZGt4cE1ERnlka2ROTlRWNVVVbzRhbGMwWjJscFdHeGpRMlJGYlZKVWVVMXliQzl1TUdVd1pITklSWGhvYkhkMVVqSlVZVzVpWVZwdVNuaHBNVzUzS3pGbGJqRjVRVXhEZDFBNFUzUjZReXN2TURrNVZYWk1SbGh1Ym1sME9VcEJPRklyU2xsNFZtdGFUWE5oWXowaUxDSnRZV01pT2lJelpUQTNZV1prTnpGak5qTmxObVkxWkROaVltUXlPRGMwTmpGa05qQmlORFExWTJVell6RmxPRGMzWmpGa1pEZzFaRE5pWXpjMk1EVXdaVGMyT1RZM0lpd2lkR0ZuSWpvaUluMD0=', 1792028477),
('CaX46BaQrnaDnAfc5Mnfbodmx3j9T6RzIR8jnCLn', NULL, '152.32.126.28', 'Mozilla/5.0 (Linux; Android 16; SM-A366B Build/BP4A.251205.006; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/154.0.8037.107 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/583.0.0.29.95;]', 'ZXlKcGRpSTZJamx1VkhwQ2N5dFhhV1oyTDNoVmRteEJVMFoxT0ZFOVBTSXNJblpoYkhWbElqb2lUbFZQZWpkMWVVVmxTVmxJVnk5bGIyRlRVamhrWVhsbU16WXZkMGhtVFRsellYaGlUbGwxZEROU2RtWXZNMjVEV0VrMldUSkVSM2x3T1cxSVZVTnFNWEZJVG5oaFZqbFlhMHhCV2poU2VtODJkVnBCTVdwWlNUTkJORFpOY1ZwMlp6Qm1VV00yVUd4Q1VXdzBSV2RJT1V0WVV5OUlWSEJRVEhsUWJXbHJaMG8yV1docFNUVXhVazFXVjBaMEwxSk5jMFZ0V1daTldHTXdNMG8wYVRSWGRVWjVOV3BoYzNJM1RXazBQU0lzSW0xaFl5STZJakZpWmpnMk1XTTBNelkyT0RGaE1qRTNOV0l3WWpFNU1qRTFZakJsTVRGa01EUTBOV1l6TldJNVptUmlOV1l4TlRCbVptSXpPVE0yTmpObE9HVmlZekFpTENKMFlXY2lPaUlpZlE9PQ==', 1792030391),
('HZReTvSBA3uMTaTVgmeaYaA5mEPrOPoVCiYnc7Qz', 1, '144.48.30.203', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'ZXlKcGRpSTZJa0ZTTkdWWmFHWklWalZISzNJd00xaENVMDgxYkZFOVBTSXNJblpoYkhWbElqb2lTa2RtWmpKRGFVNTZha1kxVDJoUWNVRXlNMUZMT1ZFMk0zTXZkbUUzVTNoalYweEJSRnBPVmxsWlVrTXdaMGxOUjFwclMxbFhiRzQwU0ZsM1dGaEJibFp6Wm5vNWF6aEhUSGhLZFM5cFoydDZaaXNyZWtoT2RUZDZaalIxWjBJMGFYZG5LMmhCTTJ4aVdEQndSbkV6WjNCRU5VNVZUVkpTZEd4RlRESkpRemhtZUdWdlVuSldPVXBCYkV0RU9WTlVlamRMUXl0MldIWkdWV2hzWkdkVlVVRlZTalJKVTFCbFEyRkhRek5pTWtoblMxbFBaRzF4VW5WVVNreHZTR3hSWmxveFNrZHpXbUl2VEhkNGFHWk9WRmxTY1VSdU5sUnNRbWx0U0hwdlpXUmlRa2RUVEU1T1dGQkVVRlJHZUhweldVRkxXamxvUTBZMVZUUjZjRk0zYXpoWGVHeEVUbGhtVVdkYWRtZFVZM3BaY2pCVGQzRjRNblJxTVVabmFEbExjSGN3WVRKVVFYTjBkMGxUU1dWblp6Rm1ValpTV2xKeWJURmlibk5NVjB0UFlrbGtOMUI0TjNKRmREWTRRVk5ZT0V0NFZVWXpkVzVaVjJaeVp6aGFRelJNZUVWVk9WSmliWGxzWlhZMWMyUmhOR3RLVEZKcE5WRnhVR3hRVFM5dVVGVkVZMVZJVkZWVmNFMDNaMHhuVEhSWVUweFRWekEyTWt3eWJqY3pNMUZZWW5oclNXWnlORTl3UlQwaUxDSnRZV01pT2lKbFlXVTFZakpoT0Rka1l6UXpObU0xWmpGa1ptUTFNVGt3TkRFeU5UYzJaalJoWkRkbFl6VTVNelJrWVRjNU1qY3pZalE1WmpRMk1tRTJORGxrTkRaa0lpd2lkR0ZuSWpvaUluMD0=', 1792030968),
('NfFqu9QX0XDPfEGO34bnUxQ5RYt9dTZ6LX5fxypT', NULL, '152.32.126.28', 'Mozilla/5.0 (Linux; Android 16; SM-A366B Build/BP4A.251205.006; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/154.0.8037.107 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/583.0.0.29.95;]', 'ZXlKcGRpSTZJblU0VjNFMFlVaDRibWxyU1V4SVRUUjVlR2hNTkdjOVBTSXNJblpoYkhWbElqb2lNMk5JVmtrMFlUWk5la0l4THpGUVdtWXphRmhyT0cxbWMxWlpjM2RUTTFkNVdEZFhXVm81ZWpCd1VURm1kMWxDTW1aWFNVaGxhVkV2V2tNNE5GbFpPRVp2YjNSWE5WSktiR1pHYW1oamFrNXNaRVZ6TUhjemREaHJkV1JQVlVZMmRrRllVV0oyTkVWdFZVWjJOMmRoYzBsMFVrMHJNVGRMUjNwQlNWaFRNRlJ6UmswMVZGTk1PSEU0YmtKMlFrZzRXR2xVZEVWamNVa3dkMjkxVVVGcEx6UXJXa2xhUTI0dkszSjVWWEk1Y200NVVtaG5NbGgyU2tzMk15OXNjM2tyS3lzdmFtcFpXbTVpUlM5TWFtaHJPRkU1WTBkQ2NqTjJhMGRWWW5oME16Qm5hVmhrT0dGelQyNW5ZWGhZVWs5dlRrMTZkbWRaY2s4eWNHZHpka0V3U1RZNFprVXJSbUV6WlM5NWVraDJXVUZHTkU1YVpUVlFPVGh0SzAxV01rNDVTVVozVm10eE5TOHdaMEkxY1RWSlVHcFhkMjVCTUZSYWR6SmxaVlpTWlUwaUxDSnRZV01pT2lJd056azJaRGc1T1dRNE1qQmlOVFkzWXpWaE9EZGlNRGMyTm1Jd1kyRTVNREE0WmpabE1qTTRZekl4WXpnME1EVmxOREpqWW1NMlpERTBZalV5WVdNM0lpd2lkR0ZuSWpvaUluMD0=', 1792032211),
('sy84ktWtzXatPg9Uev31uTzqCzsHcxhJ83BCuHWE', NULL, '2a02:4780:3:1::3', 'Go-http-client/2.0', 'ZXlKcGRpSTZJbTEyU0hSMVREVjZWVUZ5ZFZRemJ6ZFRhRzVhY1hjOVBTSXNJblpoYkhWbElqb2lVVTA0WW5FeGJYUk5iRmswUm5OTVpHSnFaMVZvUWl0ck1EWnBSRmhwYWtGMFdFeGxXbkJJU0daVFFVRnhNM2xNTUcwM01URlhhMHRZVW1welltdEZheTlESzA1Nk1rcEVLekk1TTBkU2VsSktRVlJrSzJaT1MwdEdVa3BNWlVSblJVUlRjRGd5ZHpGTldIWTFVemxGU0ROWFpFVm5SWFJ0WTNKaWFVd3pUaXRNVTJKQ2IySm9kV1oxVUdGdGVVeE9WVTF0SzAxb1ptcFhNWE5pTTNCWGFEQm9iR2RQYmtFNWFVZEdSMjVNVDJkd1MyVlNMekl3TkdsVU9XbFFZeTlCZEVoRVIzbEhWVGRXV25WeFJuaHZURU5YVjFab1FrdExZbXR3YTNkSE5ITktUVmwxVmxOVlJFOVliMU56VGxaMWFVVlRhMk0zZHpGeUt6ZFdTVVY2UzNCc04ySjFjVXRMZGxsVlprWjBSMmxXU1N0U2NYQkphVVJUUm14eFduWnJVRlppT0ZaSlZrOUNWeTl2Y0ZGNVdraFFOM2t2ZUROd1JFcFZNRmxEZEdRaUxDSnRZV01pT2lJMk5XUm1aVFEyWWpaak9HWXhOVEptTVdaalpHUXhNREZoWlRReU9EZzBNV0ZtTUdSa01qa3pOak01T1dVNE9HVTBOVE13T0RrMU56ZzJaalppWlRVd0lpd2lkR0ZuSWpvaUluMD0=', 1792029154),
('xMk1euigg8uftbCFjTmXAJrfDdWLgsKmofR1ZDcs', 28, '144.48.30.203', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 OPR/137.0.0.0', 'ZXlKcGRpSTZJa05LV0N0SVNXTTJjVFI0V21OQ1drVXZLMGxvVFhjOVBTSXNJblpoYkhWbElqb2lUakZZWjBkR1kwUTNjV05RYlRGMWNVVmFOV1JhVUhWbWRWTnVkRWhwVW1ad1drdFBkMjE2YnpBNFIzQndhekJ1WkRaeGMyczRjM3B2U25KSU5tc3dNbUYzYzI5V2QxUkNlVlJvUzJ4YVJXVmpNWEZrVG1aT2VGTXhjWEpYVEVScVRtRkRORmxqSzBKQmJuY3ZOMFJXTVhoeWRraEtOWFl5Y0M5WFNXbFhNVGhCV210aFNrSmlPRGxSYzNOaEszZzBiak5GUTA5UGNESmpha1I0ZWtaelNIWjFSVnBTYlRaT2MxVnBhMFZuVkhZNFJsSkpPVUpXTXlzeFZHcExTeTgxZWpGVWFuVm5ibU5MY2xCbVJqaGpZM1ZGUkU1RlVWZHlXRzVFVmxSbE5GWkJVVFo0UVhRNFExaHdaVkJ2UkcxNk1WbG9ZVUZwYUhRNGEzSktNemt5Y1VSNVkxWXZPRXBDTlZONlFqZERZbGNyU0ZaSlJWTjRjVGxuYUZwUFYxVjVhV2xoYlhSM0swSjZSM2xxVEVGRmJrOVVZMnBPZW1kc2RFaFROR2xrV0RaelJESmpSbEpxTDNBNVJFRTNPSE5tWlc1WFNtNXNja3htT1dwaEwzZEdaamhTVm1ncldIWTFTVTgxUmtSU2RrWmlVRk12TkM4ck1uRjVkR1ptTDJsSFFYVnJWSE4wWjNoeE5qbGtia05STVc1dlpUWTFMMWhWTnpkWFRXTnRTbUo0WkcxWU5VdGxWMlZaU1QwaUxDSnRZV01pT2lJMFpUSTNNR1ppTnpJd01XVTVPRFprWkRkaU9HUTNOekU0WXpabE1ESm1ORGM1TVRkak1ETm1NV1pqTldFMlpqazJOVFl4T0dFMlpHWTRaVFk1T1dJMUlpd2lkR0ZuSWpvaUluMD0=', 1792033325);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Pending',
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `birthdate` date DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `active_email` varchar(255) GENERATED ALWAYS AS (if(`deleted_at` is null,`email`,NULL)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `email_verified_at`, `section_id`, `role`, `is_approved`, `birthdate`, `position`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LGMED', 'Compass', 'admin', 'lgmedcompass@gmail.com', '2026-05-04 13:15:00', 8, 'Admin', 0, NULL, 'LGOO', '$2y$12$eECf579Y6jV6c3N57CxmSe/ss/yphjsiByCKiFQ8r82cCn5pbGftm', 'tlyLHpF7oz1vNkZguvAh03vUTyzHSJrhDxiV6FacwDqCZS34ZYwVoNaBUhYe', '2026-05-04 13:14:29', '2026-07-01 15:52:22', NULL),
(2, 'Ysabel Dominique', 'Mendoza', 'YsaMendoza', '20180472@s.ubaguio.edu', '2026-05-04 13:28:11', 6, 'Employee', 0, '2002-05-25', 'AA 1', '$2y$12$xVEQgwjCteTZUE7hu.wt9O/0Po/OPhu/rTLlCwZDMOmhqOeDedoVm', 'jSDcIvG7aH9yVBKvOvutrWsrd95muKdsjsdBCr4TwxY91xOSsk2VRtM3eeKU', '2026-05-04 13:27:53', '2026-05-04 14:28:49', '2026-05-04 14:28:49'),
(3, 'Ebram', 'Barlam', 'EbramBarlam', 'ebsrambarlam31@gmail.com', '2026-05-04 13:28:41', 8, 'Employee', 0, '2003-05-19', 'Intern', '$2y$12$EBRDini7orfTDgkgkbrhSeXOaqfF5pdoEOSWh.2VL5q52oWHUk3v6', 'UaccKEa6qUfmwvkNw7PLYMJbuuxq40hSHRhSeukAPTkrJkbyq7DtGmgfupl5', '2026-05-04 13:28:14', '2026-09-12 11:03:30', NULL),
(6, 'Ysabel Dominique', 'Mendoza', 'Dominique', '20180472@s.ubaguio.edu', '2026-05-04 14:30:47', 8, 'Employee', 0, NULL, 'OJT', '$2y$12$Jb5gJHhvFdmK6WtfsaMXkeAfQLQM5ORIz5l1L4twXYasQ7lJ8kT4C', '100r7z6OUowfOj0K4oduZUOmKrDhsX7xI6HsDFNueUajB036VDbvPXpABGzI', '2026-05-04 14:30:12', '2026-05-11 08:49:43', NULL),
(7, 'jhosuaphilip', 'palaruan', 'jppalaruan', 'jhosuaphilippalaruan@gmail.com', '2026-05-05 13:15:37', 7, 'Employee', 0, NULL, 'Statistician II', '$2y$12$fA4XtJlPGAKLnTe7m26NieVMO6FBoC/cvsKH.oD05LpP/kmohkaEu', 'qe9wPjYwdOoqHOgSBWjXonS1jArMTeyX7kwsQ4LxOthnDX3bZXJrfU1t47Uk', '2026-05-05 13:15:11', '2026-06-11 08:22:20', NULL),
(10, 'Nikko May', 'Gunday', 'NMGunday', 'nmgunday0897@gmail.com', '2026-05-07 09:38:09', 5, 'Employee', 0, NULL, 'ADAC-RTA', '$2y$12$.XUzBvpv9Mx5JYzHRBYdoeYNaV6uJuEwMxAaGqCX1QawI/eocbLRe', '1Qe6EExoVS1RpwO47sV777eUSel1eWGxQoLfwUMnGM4X2156SFloRNG53Uuw', '2026-05-07 09:37:46', '2026-05-07 09:42:33', NULL),
(11, 'LALA', 'GERON', 'lggeron1', 'lggeron@dilg.gov.ph', '2026-05-07 09:38:23', 5, 'Employee', 0, NULL, 'LGOO V', '$2y$12$SSJoCaqrqQDwnmOmGg.nrOShKrM00pZ28zm7KMjvrUesOMq/Ny4GC', 'T9YTOASVRFQsjqkFtDDO0IDLWj18jef2TnRsjoKLP3pUCXVWyZcMmmM31DeL', '2026-05-07 09:37:57', '2026-05-07 09:42:26', NULL),
(12, 'Valleree', 'Joseph', 'Valleree', 'vallereejoseph@gmail.com', '2026-05-07 09:41:26', 8, 'Technical Inspector', 0, NULL, 'Intern', '$2y$12$EVfztK8.lkMe24btGIr6ZOg6D4gygMj2Bvrwqq7IGoeSnV5rGf1zK', NULL, '2026-05-07 09:40:09', '2026-05-11 13:52:17', NULL),
(13, 'Bable', 'Adnol', 'bables0620', 'bables0620@gmail.com', '2026-05-07 09:41:41', 2, 'Employee', 0, NULL, 'LGOO VI', '$2y$12$TugbK.JJC9xD2CWbxKIKXe4jFcVd6UtF9KKN58QNbxzBDejAMn2fC', 'CCrdhCY5ru5yp6346J4klu2gQwtVUo2vICGqbcEefChb0erAUXrqKodtiYiA', '2026-05-07 09:40:46', '2026-05-09 06:06:02', NULL),
(14, 'Mary Jane', 'Abance', 'msabance', 'mjsabance@gmail.com', '2026-05-07 09:56:02', 1, 'Employee', 0, NULL, 'LGOO VII', '$2y$12$TqsIXL4HViCi9jnK1jA7z.sfX7vOwg1HY2X.58/uQgnM6w5tit/HO', '1YbG9ZMkVSk3KYSEz0axGJN6Zs542zZpUgLAU0Uu8RDncKUhF2L31hrx97si', '2026-05-07 09:47:13', '2026-06-29 07:51:07', NULL),
(15, 'Jan Mikhail', 'Kimayong', 'jpkimayong', 'janmikhailkimayong@gmail.com', '2026-05-11 15:37:10', 7, 'Employee', 0, NULL, 'Statistician I', '$2y$12$N8mggwDrqPnVFv1PvOWUi.WzcK2OxLBdpzfaUU9PQ2MUaXeid0Jm2', 'n6D8rBqyqPpBimRm8oUeVzvVE8h5NXHrzxvAP3iQzq1iUOP56QyLItVyulNH', '2026-05-11 15:36:56', '2026-05-11 15:38:10', NULL),
(16, 'Marlene', 'Gonzales', 'MarleneG', 'quotits.25@gmail.com', '2026-05-12 09:44:05', 6, 'Employee', 0, NULL, 'ADA VI', '$2y$12$A6c44E9hb4p1AxKJSP8gkecBKYqoqwIipvLGoHLDYYpa0QwJqskRC', 'hlvBK31Rn3P7U99BeZSFdJqAY2wbJtF6cGZ76tWOvyEkNURnAYsQmQjrghYe', '2026-05-12 09:33:38', '2026-05-12 09:44:13', NULL),
(17, 'Alex Ian', 'Pacis, Jr.', 'ianpacis', 'aapacisjr@dilg.gov.ph', '2026-05-12 10:43:15', 3, 'Employee', 0, NULL, 'LGOO IV', '$2y$12$xbWtx4ZoSKKQQqFc7vQ7I.saagoiusniCejFZQwnP7dS0K3512Q2W', 'FEGxlbBkMmIDYfRi5tShl4KmNAiuO1GtnH63H9ah2m2LkMHcv5W4kyQYRiTd', '2026-05-12 10:42:47', '2026-05-19 08:33:14', NULL),
(18, 'Joanabeth', 'Tamondong', 'jujuanabeat', 'joanabethtamondong@gmail.com', '2026-05-12 15:10:30', 5, 'Employee', 0, NULL, 'Project Evaluation Officer II', '$2y$12$NBk3nPLGr3vDHYzKEeGW9ulrIqH8lfy9GmXnNAgP98tLSmn6OpZuu', '4kNebmFYS8Z5GbI4RO5qjhT1AY5dMPoPWIEMHC4hRlxSp28xBCDAvVd99W2C', '2026-05-12 15:10:08', '2026-05-12 15:10:37', NULL),
(19, 'HERALD', 'DAGUYAM', 'HDDAGUYAM', 'hdaguyam@gmail.com', '2026-05-12 15:15:09', 4, 'Employee', 0, NULL, 'LGOO IV', '$2y$12$hOKOpNXAYmqsbemeMqGnxuN1.wXSXztHRdTKWuSwyGpvNTRYhWHxO', NULL, '2026-05-12 15:13:13', '2026-05-12 15:15:45', NULL),
(20, 'Prince Jeden', 'Pascua', 'princejeden', 'jedensanity@gmail.com', '2026-05-12 15:41:52', 5, 'Employee', 0, NULL, 'PEO I', '$2y$12$AWRgrSblLmbzkpIO4fx3bOg2ak.VLmYEYsv2NGjYpVSADE700pZBa', 'Q8ogEhXkrdCqcODgsnc093sW7oMss2LRS7QyF3oh8xxe3uqnNbFr0YcWxbcc', '2026-05-12 15:41:35', '2026-05-12 15:42:00', NULL),
(21, 'Mary Jheama Rachine', 'Canullas', 'jemcanullas', 'mecanullas@dilg.gov.ph', '2026-05-12 15:54:58', 3, 'Employee', 0, NULL, 'LGOO V', '$2y$12$zKS0RCUHw4BC/Hl5dmQlt.N/KiUo0ONF7GwmXLANWz2fjMIU907iu', 'PxmM7SXuTzyIqcniCcTxXDDf4so5zd7qalZNgss79vdOxapvMTdSd8jHRc97', '2026-05-12 15:54:32', '2026-05-12 15:55:03', NULL),
(22, 'Princes', 'Baisa', 'pbaisa102019', 'pab.dilg19@gmail.com', '2026-05-20 08:35:26', 5, 'Employee', 0, NULL, 'LGOO IV', '$2y$12$/RCjmnpw0k69UF.IxW77qO1.wq2XOOv8Ee5Lvfd1LKmQHz8ZtGUs2', 'JNFKax2HfNj8ZZ1ExFtAnmA9AQR3XyVqIwU0GtzGBvUpT63YHQVQjNoFdB44', '2026-05-20 08:34:53', '2026-05-20 08:35:43', NULL),
(23, 'Allan', 'Ocal', 'afocal22', 'afocal@dilg.gov.ph', '2026-06-03 20:44:39', 4, 'Employee', 0, NULL, 'Local Government Operations Officer V', '$2y$12$LNsC5SLJSF0Mpf2Pv/5pPeqiiOYofjep8NDo7WU2qJ4J7SpnQkneS', '60PVN3oikHTsS8b7SlXIXxOEOGnZeDyh6ryHtQ092u0bJSTgwYH7tknCr1e5', '2026-06-03 20:43:58', '2026-06-05 12:56:00', NULL),
(27, 'Matt Andrei', 'Gallamos', 'Matt_Andrei', 'gallamos0414@gmail.com', '2026-09-09 08:13:50', 5, 'Employee', 0, NULL, 'Project Evaluation Officer I', '$2y$12$m0cS/Rt/..KGWiuluyIgUOGZjhFVxrWrdns6cWNvskPLlrpJvcVlO', 'Jjd6e4iTP7WPMxyD9a5FnI9EiEI7k9WYKhCnvz1kf0S6hZJ6sernwUJo9OVl', '2026-09-09 08:13:19', '2026-09-09 08:25:36', NULL),
(28, 'Ian Lhoyd', 'Villaro', 'Lgmedian123', 'ianvill311@gmail.com', '2026-10-15 09:37:54', 8, 'Employee', 0, NULL, 'Intern', '$2y$12$X69XYm3hls.j3wnDRJn3M.2wzdxiPfLgBpbjaeSszkPSphRjpjrnS', '16OfvIlZz3u3jSAtG3G74GEF5Ns7MusxJgNvIYSQ2JdhCfsIl44xfY8Exj8F', '2026-10-15 09:37:21', '2026-10-15 09:39:02', NULL);

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
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_user_id_foreign` (`user_id`),
  ADD KEY `documents_assigned_to_id_foreign` (`assigned_to_id`),
  ADD KEY `documents_section_index` (`section`),
  ADD KEY `documents_frequency_index` (`frequency`),
  ADD KEY `documents_focal_person_index` (`focal_person`),
  ADD KEY `documents_status_index` (`status`),
  ADD KEY `documents_created_at_index` (`created_at`),
  ADD KEY `documents_deleted_at_index` (`deleted_at`);

--
-- Indexes for table `document_assignments`
--
ALTER TABLE `document_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `document_assignments_document_id_unique` (`document_id`),
  ADD KEY `document_assignments_assigned_to_id_foreign` (`assigned_to_id`);

--
-- Indexes for table `document_processes`
--
ALTER TABLE `document_processes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_processes_user_id_foreign` (`user_id`),
  ADD KEY `document_processes_assigned_to_id_foreign` (`assigned_to_id`),
  ADD KEY `document_processes_section_foreign` (`section`);

--
-- Indexes for table `document_schedules`
--
ALTER TABLE `document_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_schedules_document_id_foreign` (`document_id`),
  ADD KEY `document_schedules_due_date_index` (`due_date`),
  ADD KEY `document_schedules_status_index` (`status`);

--
-- Indexes for table `document_workflow_logs`
--
ALTER TABLE `document_workflow_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_workflow_logs_document_id_foreign` (`document_id`),
  ADD KEY `document_workflow_logs_from_user_id_foreign` (`from_user_id`),
  ADD KEY `document_workflow_logs_to_user_id_foreign` (`to_user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`),
  ADD KEY `events_section_id_foreign` (`section_id`),
  ADD KEY `events_focal_person_id_foreign` (`focal_person_id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folders_divisions_id_foreign` (`divisions_id`),
  ADD KEY `folders_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `resource_categories`
--
ALTER TABLE `resource_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resource_categories_slug_unique` (`slug`);

--
-- Indexes for table `resource_files`
--
ALTER TABLE `resource_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_files_folder_id_foreign` (`folder_id`),
  ADD KEY `resource_files_user_id_foreign` (`user_id`);

--
-- Indexes for table `resource_folders`
--
ALTER TABLE `resource_folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_folders_category_id_foreign` (`category_id`),
  ADD KEY `resource_folders_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `role_requests`
--
ALTER TABLE `role_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_files`
--
ALTER TABLE `section_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_files_division_id_foreign` (`division_id`),
  ADD KEY `section_files_parent_id_foreign` (`parent_id`),
  ADD KEY `section_files_user_id_foreign` (`user_id`);

--
-- Indexes for table `section_folder`
--
ALTER TABLE `section_folder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_folder_divisions_id_foreign` (`divisions_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_active_email_unique` (`active_email`),
  ADD KEY `users_section_id_foreign` (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `document_assignments`
--
ALTER TABLE `document_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `document_processes`
--
ALTER TABLE `document_processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `document_schedules`
--
ALTER TABLE `document_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `document_workflow_logs`
--
ALTER TABLE `document_workflow_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `resource_categories`
--
ALTER TABLE `resource_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resource_files`
--
ALTER TABLE `resource_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `resource_folders`
--
ALTER TABLE `resource_folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `role_requests`
--
ALTER TABLE `role_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `section_files`
--
ALTER TABLE `section_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `section_folder`
--
ALTER TABLE `section_folder`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_assigned_to_id_foreign` FOREIGN KEY (`assigned_to_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_assignments`
--
ALTER TABLE `document_assignments`
  ADD CONSTRAINT `document_assignments_assigned_to_id_foreign` FOREIGN KEY (`assigned_to_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `document_assignments_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_processes`
--
ALTER TABLE `document_processes`
  ADD CONSTRAINT `document_processes_assigned_to_id_foreign` FOREIGN KEY (`assigned_to_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `document_processes_section_foreign` FOREIGN KEY (`section`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `document_processes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_schedules`
--
ALTER TABLE `document_schedules`
  ADD CONSTRAINT `document_schedules_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_workflow_logs`
--
ALTER TABLE `document_workflow_logs`
  ADD CONSTRAINT `document_workflow_logs_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `document_workflow_logs_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `document_workflow_logs_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_focal_person_id_foreign` FOREIGN KEY (`focal_person_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `events_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_divisions_id_foreign` FOREIGN KEY (`divisions_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `folders_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resource_files`
--
ALTER TABLE `resource_files`
  ADD CONSTRAINT `resource_files_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `resource_folders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resource_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `resource_folders`
--
ALTER TABLE `resource_folders`
  ADD CONSTRAINT `resource_folders_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `resource_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resource_folders_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `resource_folders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_requests`
--
ALTER TABLE `role_requests`
  ADD CONSTRAINT `role_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `section_files`
--
ALTER TABLE `section_files`
  ADD CONSTRAINT `section_files_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `section_files_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `section_files` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `section_folder`
--
ALTER TABLE `section_folder`
  ADD CONSTRAINT `section_folder_divisions_id_foreign` FOREIGN KEY (`divisions_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
