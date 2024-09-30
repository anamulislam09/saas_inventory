-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 02:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saas_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `nid_no` varchar(200) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `is_client` tinyint(11) NOT NULL DEFAULT 1,
  `package_id` tinyint(4) DEFAULT NULL,
  `package_start_date` varchar(255) DEFAULT NULL,
  `customer_balance` double(20,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `client_id`, `type`, `mobile`, `email`, `password`, `image`, `address`, `nid_no`, `status`, `is_client`, `package_id`, `package_start_date`, `customer_balance`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'SuperAdmin', NULL, 1, '01847309892', 'admin@gmail.com', '$2y$10$WojC0.qlK9xkqd28lxeBvec4mziiScAgvjo7Q3fnaqe37Z.Tj2Uz2', '', NULL, NULL, 1, 0, NULL, NULL, 0.00, NULL, NULL, 'pW0QpEWEulddMa1FqtGqqlDPfenvvwFHTAUYLDA98aPIi7kIqjQS7P2HYffa'),
(4, 'Anam', 0, 1, '01847309892', 'anam@gmail.com', '$2y$10$8x5O6fi2d96l14WflMUexuD/mnjG7/SGTUwhVyLQ99i.SfqsO63KC', '', 'Madubpur', '6464654', 1, 1, 1, '2024-09-04', 10000.00, '2024-08-18 11:15:10', '2024-09-04 12:22:36', NULL),
(5, 'Kamal', 4, 5, '0123456789', 'kamal@gmail.com', '$2y$10$HfM1TpVDlvcM0lDG437xcu84mFvRSWSjqiGdsDp2HP3SZiSLJLrpW', '', NULL, NULL, 1, 1, NULL, NULL, 0.00, '2024-08-18 11:21:23', '2024-09-07 11:21:09', NULL),
(6, 'Noman', 0, 1, '01714229830', 'noman@gmail.com', '$2y$10$kdNP0yIHWC4IIwQrCu1uV.8uCDmjEEsTsGaEn6kis8GCg5Jzt82PC', '', 'Noakhali', '6546545', 1, 1, NULL, NULL, 0.00, '2024-08-18 11:33:38', '2024-09-04 11:24:11', NULL),
(7, 'X', 6, 2, '01241242', 'x@gmail.com', '$2y$10$obnONAStiW5tBc1gmXnqV.LfsbO/fX6607baw6kC/kl0g97q2HfH6', '', NULL, NULL, 1, 1, NULL, NULL, 0.00, '2024-08-18 11:37:48', '2024-08-18 11:37:48', NULL),
(8, 'noman', 0, 1, '01847309892', 'nsanobab@gmail.com', '$2y$10$mZaeuHUE0NDNSc.zV2QBweXqr49IygtmrMsEw.EMYZf4J7bRXJsiy', '', 'Noakhali, Bangladesh', '786978', 1, 1, NULL, NULL, 0.00, '2024-09-04 05:24:35', '2024-09-04 05:24:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `in_at` datetime NOT NULL,
  `out_at` datetime DEFAULT NULL,
  `worked_hour` double(10,2) DEFAULT NULL,
  `over_time_hour` double(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_processes`
--

CREATE TABLE `attendance_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `total_working_days` int(11) NOT NULL,
  `total_working_hours` double(10,2) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_process_details`
--

CREATE TABLE `attendance_process_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attendance_process_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `absent_days` int(11) NOT NULL,
  `late_to_absent_days` int(11) NOT NULL,
  `net_absent_days` int(11) NOT NULL,
  `present_days` int(11) NOT NULL,
  `leave_days` int(11) NOT NULL,
  `net_present_days` int(11) NOT NULL,
  `regular_hours_worked` double(10,2) NOT NULL DEFAULT 0.00,
  `overtime_hours` double(10,2) NOT NULL DEFAULT 0.00,
  `total_hours_worked` double(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basic_infos`
--

CREATE TABLE `basic_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `moto` varchar(500) DEFAULT NULL COMMENT 'footer-text',
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `logo` varchar(30) NOT NULL,
  `favIcon` varchar(30) DEFAULT NULL,
  `currency_code` varchar(30) NOT NULL,
  `currency_symbol` varchar(30) NOT NULL,
  `acceptPaymentType` varchar(30) DEFAULT NULL,
  `copyRightName` varchar(500) NOT NULL,
  `copyRightLink` varchar(255) DEFAULT '#',
  `mapLink` text DEFAULT NULL,
  `facebook` varchar(255) NOT NULL DEFAULT '#',
  `instagram` varchar(255) NOT NULL DEFAULT '#',
  `twitter` varchar(255) NOT NULL DEFAULT '#',
  `pinterest` varchar(255) NOT NULL DEFAULT '#',
  `linkedIn` varchar(255) NOT NULL DEFAULT '#',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_infos`
--

INSERT INTO `basic_infos` (`id`, `client_id`, `title`, `moto`, `phone1`, `phone2`, `email`, `address`, `logo`, `favIcon`, `currency_code`, `currency_symbol`, `acceptPaymentType`, `copyRightName`, `copyRightLink`, `mapLink`, `facebook`, `instagram`, `twitter`, `pinterest`, `linkedIn`, `created_at`, `updated_at`) VALUES
(1, 4, 'SAAS-INVENTORY', 'Namkand sodales vel online best prices Amazon Check out ethnic wear, formal wear western wear Blood Pressure Rate Monito.', '458-965-3224', '458-965-3224', 'Support@info.Com', 'W898 RTower Stat, Suite 56 Brockland, CA 9622 United States.', 'logo-1710927898.jpg', 'favIcon-1710927898.jpg', 'BDT', '৳', 'apt-1702371011.png', '<strong class=\"justify-content-center\">Copyright © 2024-2025 <a href=\"https://sysdevltd.com/\" target=\"_blank\">SYS DEV LTD.</a></strong><a href=\"https://sysdevltd.com/\" target=\"_blank\">&nbsp;</a> All rights reserved.', 'https://www.youtube.com/', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.096340089998!2d90.41232931081352!3d23.74394367858587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b889a0e3b047%3A0x35d210fbb5e92f48!2z4Ka44Ka_4Ka4IOCmoeCnh-CmrSDgprLgpr_gpq7gpr_gpp_gp4fgpqE!5e0!3m2!1sen!2sbd!4v1702803916155!5m2!1sen!2sbd\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'https://www.youtube.com/', 'https://www.youtube.com/', 'https://www.youtube.com/', 'https://www.youtube.com/', 'https://www.youtube.com/', '2023-12-12 09:09:15', '2024-08-21 09:21:57'),
(3, 6, 'Noman Interprise', NULL, '01847309892', NULL, 'noman@gmail.com', 'Noakhali', 'logo-1725103166.png', 'favIcon-1725103285.jfif', 'USD', '$', NULL, '<p><span class=\"justify-content-center\" style=\"font-weight: bolder;\">Copyright © 2024-2025 <a href=\"#\" target=\"_blank\">Noman Enterprise</a><a href=\"https://sysdevltd.com/\" target=\"_blank\">.</a></span><a href=\"https://sysdevltd.com/\" target=\"_blank\" style=\"background-color: rgb(255, 255, 255);\">&nbsp;</a>&nbsp;All rights reserved.<br></p>', NULL, 'https://maps.app.goo.gl/YdCLeEL6SyATJ3bTA', 'https://www.facebook.com/', '#', '#', '#', '#', '2024-08-31 11:19:26', '2024-09-03 10:10:40'),
(4, 8, 'Inventory', 'test', '01847309892', NULL, 'ns@gmail.com', 'Noakhali', 'logo-1725429159.png', NULL, 'BDT', '৳', NULL, '<p>fsdgtfddg</p>', NULL, NULL, '#', '#', '#', '#', '#', '2024-09-04 05:52:39', '2024-09-04 05:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `accrual_date` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `parent_cat_id` bigint(20) DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `client_id`, `parent_cat_id`, `title`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 0, 'Laptop', NULL, 1, '2024-08-19 06:43:09', '2024-08-21 07:10:01'),
(2, 4, 0, 'Computer', NULL, 1, '2024-08-19 06:45:37', '2024-08-19 06:45:37'),
(3, 4, 0, 'Mobile', NULL, 1, '2024-08-19 06:45:46', '2024-08-19 06:45:46'),
(5, 4, 1, 'HP Laptop', 'cat-1724051956.jpg', 1, '2024-08-19 07:19:16', '2024-08-19 07:19:16'),
(6, 4, 1, 'Dell Laptop', 'cat-1724051985.jpg', 1, '2024-08-19 07:19:45', '2024-08-19 07:19:45'),
(7, 4, 3, 'Apple Mobile', 'cat-1724052070.jpg', 1, '2024-08-19 07:21:10', '2024-08-19 07:21:10'),
(8, 6, 0, 'Electronics', NULL, 1, '2024-08-21 07:00:39', '2024-08-21 07:00:39'),
(9, 6, 0, 'Hardware', NULL, 1, '2024-08-21 07:03:02', '2024-08-21 07:03:26'),
(10, 6, 8, 'Iron', 'cat-1724225148.jpg', 1, '2024-08-21 07:08:20', '2024-08-21 07:25:48'),
(11, 6, 8, 'Mobile', 'cat-1725358546.jpg', 1, '2024-09-03 10:14:55', '2024-09-03 10:15:46'),
(12, 8, 0, 'Drinks', NULL, 1, '2024-09-04 05:53:14', '2024-09-04 05:53:14'),
(13, 8, 12, 'Pepsi', 'cat-1725429226.jpg', 1, '2024-09-04 05:53:46', '2024-09-04 05:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `category_types`
--

CREATE TABLE `category_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `collection_method_id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `amount` double(20,2) NOT NULL DEFAULT 0.00,
  `discount` double(20,2) DEFAULT NULL,
  `vat` double(20,2) DEFAULT NULL,
  `total_collection_amount` double(20,2) NOT NULL DEFAULT 0.00,
  `total_collection` double(20,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `client_id`, `vendor_id`, `collection_method_id`, `sales_id`, `date`, `amount`, `discount`, `vat`, `total_collection_amount`, `total_collection`, `note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 1, 1, '2024-09-07', 0.00, NULL, NULL, 0.00, 300000.00, 'Sales to Customer', 1, 4, NULL, '2024-09-07 08:42:18', '2024-09-07 08:42:18'),
(2, 4, 6, 1, 2, '2024-09-07', 0.00, NULL, NULL, 0.00, 593750.00, 'Sales', 1, 4, NULL, '2024-09-07 09:27:25', '2024-09-07 09:27:25'),
(3, 4, NULL, 3, 1, '2024-09-07', 26500.00, NULL, NULL, 0.00, 0.00, NULL, 1, 4, NULL, '2024-09-07 12:55:14', '2024-09-07 12:55:14'),
(4, 4, NULL, 3, 1, '2024-09-07', 26500.00, NULL, NULL, 0.00, 0.00, NULL, 1, 4, NULL, '2024-09-07 12:58:04', '2024-09-07 12:58:04'),
(5, 4, 7, 1, 3, '2024-09-29', 0.00, NULL, NULL, 0.00, 57000.00, 'Sales to Jamal', 1, 4, NULL, '2024-09-29 12:12:13', '2024-09-29 12:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'AL', 'Albania', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'DZ', 'Algeria', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'AS', 'American Samoa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'AD', 'Andorra', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'AO', 'Angola', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'AI', 'Anguilla', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'AQ', 'Antarctica', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'AG', 'Antigua and Barbuda', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'AR', 'Argentina', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'AM', 'Armenia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'AW', 'Aruba', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'AU', 'Australia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'AT', 'Austria', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'AZ', 'Azerbaijan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'BS', 'Bahamas', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'BH', 'Bahrain', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'BD', 'Bangladesh', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'BB', 'Barbados', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'BY', 'Belarus', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'BE', 'Belgium', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'BZ', 'Belize', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'BJ', 'Benin', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'BM', 'Bermuda', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'BT', 'Bhutan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'BO', 'Bolivia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'BA', 'Bosnia and Herzegovina', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'BW', 'Botswana', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'BV', 'Bouvet Island', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'BR', 'Brazil', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'IO', 'British Indian Ocean Territory', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'BN', 'Brunei Darussalam', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'BG', 'Bulgaria', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'BF', 'Burkina Faso', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'BI', 'Burundi', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'KH', 'Cambodia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'CM', 'Cameroon', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'CA', 'Canada', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'CV', 'Cape Verde', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'KY', 'Cayman Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'CF', 'Central African Republic', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'TD', 'Chad', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'CL', 'Chile', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'CN', 'China', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'CX', 'Christmas Island', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'CC', 'Cocos (Keeling) Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'CO', 'Colombia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'KM', 'Comoros', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'CD', 'Democratic Republic of the Congo', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'CG', 'Republic of Congo', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'CK', 'Cook Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'CR', 'Costa Rica', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'HR', 'Croatia (Hrvatska)', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'CU', 'Cuba', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'CY', 'Cyprus', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'CZ', 'Czech Republic', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'DK', 'Denmark', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'DJ', 'Djibouti', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'DM', 'Dominica', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'DO', 'Dominican Republic', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'TL', 'East Timor', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'EC', 'Ecuador', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'EG', 'Egypt', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'SV', 'El Salvador', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'GQ', 'Equatorial Guinea', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'ER', 'Eritrea', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'EE', 'Estonia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'ET', 'Ethiopia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'FK', 'Falkland Islands (Malvinas)', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'FO', 'Faroe Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'FJ', 'Fiji', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'FI', 'Finland', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'FR', 'France', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'FX', 'France, Metropolitan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'GF', 'French Guiana', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'PF', 'French Polynesia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'TF', 'French Southern Territories', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'GA', 'Gabon', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'GM', 'Gambia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'GE', 'Georgia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'DE', 'Germany', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'GH', 'Ghana', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'GI', 'Gibraltar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'GG', 'Guernsey', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'GR', 'Greece', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'GL', 'Greenland', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'GD', 'Grenada', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'GP', 'Guadeloupe', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'GU', 'Guam', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'GT', 'Guatemala', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'GN', 'Guinea', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'GW', 'Guinea-Bissau', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'GY', 'Guyana', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'HT', 'Haiti', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'HM', 'Heard and Mc Donald Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'HN', 'Honduras', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'HK', 'Hong Kong', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'HU', 'Hungary', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'IS', 'Iceland', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'IN', 'India', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'IM', 'Isle of Man', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'ID', 'Indonesia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'IR', 'Iran (Islamic Republic of)', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'IQ', 'Iraq', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'IE', 'Ireland', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'IL', 'Israel', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'IT', 'Italy', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'CI', 'Ivory Coast', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'JE', 'Jersey', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'JM', 'Jamaica', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'JP', 'Japan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'JO', 'Jordan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'KZ', 'Kazakhstan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'KE', 'Kenya', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'KI', 'Kiribati', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'KP', 'Korea, Democratic People\'s Republic of', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'KR', 'Korea, Republic of', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'XK', 'Kosovo', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'KW', 'Kuwait', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'KG', 'Kyrgyzstan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'LA', 'Lao People\'s Democratic Republic', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'LV', 'Latvia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'LB', 'Lebanon', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'LS', 'Lesotho', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'LR', 'Liberia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'LY', 'Libyan Arab Jamahiriya', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'LI', 'Liechtenstein', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'LT', 'Lithuania', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'LU', 'Luxembourg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'MO', 'Macau', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'MK', 'North Macedonia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'MG', 'Madagascar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'MW', 'Malawi', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'MY', 'Malaysia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'MV', 'Maldives', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'ML', 'Mali', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'MT', 'Malta', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'MH', 'Marshall Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'MQ', 'Martinique', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'MR', 'Mauritania', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'MU', 'Mauritius', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'YT', 'Mayotte', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'MX', 'Mexico', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'FM', 'Micronesia, Federated States of', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'MD', 'Moldova, Republic of', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'MC', 'Monaco', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'MN', 'Mongolia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'ME', 'Montenegro', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'MS', 'Montserrat', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'MA', 'Morocco', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'MZ', 'Mozambique', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'MM', 'Myanmar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'NA', 'Namibia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'NR', 'Nauru', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'NP', 'Nepal', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'NL', 'Netherlands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'AN', 'Netherlands Antilles', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'NC', 'New Caledonia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'NZ', 'New Zealand', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'NI', 'Nicaragua', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'NE', 'Niger', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'NG', 'Nigeria', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'NU', 'Niue', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'NF', 'Norfolk Island', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'MP', 'Northern Mariana Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'NO', 'Norway', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'OM', 'Oman', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'PK', 'Pakistan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'PW', 'Palau', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'PS', 'Palestine', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'PA', 'Panama', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'PG', 'Papua New Guinea', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'PY', 'Paraguay', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'PE', 'Peru', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'PH', 'Philippines', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'PN', 'Pitcairn', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'PL', 'Poland', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'PT', 'Portugal', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'PR', 'Puerto Rico', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'QA', 'Qatar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'RE', 'Reunion', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'RO', 'Romania', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'RU', 'Russian Federation', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'RW', 'Rwanda', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'KN', 'Saint Kitts and Nevis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'LC', 'Saint Lucia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'VC', 'Saint Vincent and the Grenadines', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'WS', 'Samoa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'SM', 'San Marino', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'ST', 'Sao Tome and Principe', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'SA', 'Saudi Arabia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'SN', 'Senegal', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'RS', 'Serbia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'SC', 'Seychelles', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'SL', 'Sierra Leone', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'SG', 'Singapore', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'SK', 'Slovakia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'SI', 'Slovenia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'SB', 'Solomon Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'SO', 'Somalia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'ZA', 'South Africa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'GS', 'South Georgia South Sandwich Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'SS', 'South Sudan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'ES', 'Spain', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'LK', 'Sri Lanka', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'SH', 'St. Helena', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'PM', 'St. Pierre and Miquelon', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'SD', 'Sudan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'SR', 'Suriname', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'SZ', 'Eswatini', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'SE', 'Sweden', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'CH', 'Switzerland', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'SY', 'Syrian Arab Republic', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'TW', 'Taiwan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'TJ', 'Tajikistan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'TZ', 'Tanzania, United Republic of', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'TH', 'Thailand', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'TG', 'Togo', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'TK', 'Tokelau', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'TO', 'Tonga', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'TT', 'Trinidad and Tobago', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'TN', 'Tunisia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'TR', 'Turkey', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'TM', 'Turkmenistan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'TC', 'Turks and Caicos Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'TV', 'Tuvalu', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'UG', 'Uganda', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'UA', 'Ukraine', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'AE', 'United Arab Emirates', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'GB', 'United Kingdom', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'US', 'United States', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'UM', 'United States minor outlying islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'UY', 'Uruguay', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'UZ', 'Uzbekistan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'VU', 'Vanuatu', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'VA', 'Vatican City State', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'VE', 'Venezuela', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'VN', 'Vietnam', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 'VG', 'Virgin Islands (British)', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 'VI', 'Virgin Islands (U.S.)', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 'WF', 'Wallis and Futuna Islands', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 'EH', 'Western Sahara', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 'YE', 'Yemen', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 'ZM', 'Zambia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 'ZW', 'Zimbabwe', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `currency_symbols`
--

CREATE TABLE `currency_symbols` (
  `id` int(11) NOT NULL,
  `country` varchar(36) NOT NULL,
  `currency` varchar(39) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency_symbols`
--

INSERT INTO `currency_symbols` (`id`, `country`, `currency`, `code`, `symbol`) VALUES
(1, 'Afghanistan', 'Afghan afghani', 'AFN', '؋'),
(2, 'Akrotiri and Dhekelia (UK)', 'European euro', 'EUR', '€'),
(3, 'Aland Islands (Finland)', 'European euro', 'EUR', '€'),
(4, 'Albania', 'Albanian lek', 'ALL', 'Lek'),
(5, 'Algeria', 'Algerian dinar', 'DZD', 'DA'),
(6, 'American Samoa (USA)', 'United States dollar', 'USD', '$'),
(7, 'Andorra', 'European euro', 'EUR', '€'),
(8, 'Angola', 'Angolan kwanza', 'AOA', 'Kz'),
(9, 'Anguilla (UK)', 'East Caribbean dollar', 'XCD', '$'),
(10, 'Antigua and Barbuda', 'East Caribbean dollar', 'XCD', '$'),
(11, 'Argentina', 'Argentine peso', 'ARS', '$'),
(12, 'Armenia', 'Armenian dram', 'AMD', '֏'),
(13, 'Aruba (Netherlands)', 'Aruban florin', 'AWG', 'ƒ'),
(14, 'Ascension Island (UK)', 'Saint Helena pound', 'SHP', '£'),
(15, 'Australia', 'Australian dollar', 'USD', '$'),
(16, 'Austria', 'European euro', 'EUR', '€'),
(17, 'Azerbaijan', 'Azerbaijan manat', 'AZN', 'ман'),
(18, 'Bahamas', 'Bahamian dollar', 'BSD', '$'),
(19, 'Bahrain', 'Bahraini dinar', 'BHD', 'BD'),
(20, 'Bangladesh', 'Bangladeshi taka', 'BDT', '৳'),
(21, 'Barbados', 'Barbadian dollar', 'BBD', '$'),
(23, 'Belgium', 'European euro', 'EUR', '€'),
(24, 'Belize', 'Belize dollar', 'BZD', 'BZ$'),
(25, 'Benin', 'West African CFA franc', 'XOF', 'CFA'),
(26, 'Bermuda (UK)', 'Bermudian dollar', 'BMD', '$'),
(28, 'Bolivia', 'Bolivian boliviano', 'BOB', '$b'),
(29, 'Bonaire (Netherlands)', 'United States dollar', 'USD', '$'),
(30, 'Bosnia and Herzegovina', 'Bosnia and Herzegovina convertible mark', 'BAM', 'KM'),
(31, 'Botswana', 'Botswana pula', 'BWP', 'P'),
(32, 'Brazil', 'Brazilian real', 'BRL', 'R$'),
(33, 'British Indian Ocean Territory (UK)', 'United States dollar', 'USD', '$'),
(34, 'British Virgin Islands (UK)', 'United States dollar', 'USD', '$'),
(35, 'Brunei', 'Brunei dollar', 'BND', '$'),
(36, 'Bulgaria', 'Bulgarian lev', 'BGN', 'лв'),
(37, 'Burkina Faso', 'West African CFA franc', 'XOF', 'CFA'),
(38, 'Burundi', 'Burundi franc', 'BIF', 'FBu'),
(39, 'Cabo Verde', 'Cape Verdean escudo', 'CVE', 'Esc'),
(40, 'Cambodia', 'Cambodian riel', 'KHR', '៛'),
(41, 'Cameroon', 'Central African CFA franc', 'XAF', 'FCFA'),
(42, 'Canada', 'Canadian dollar', 'CAD', '$'),
(43, 'Caribbean Netherlands (Netherlands)', 'United States dollar', 'USD', '$'),
(44, 'Cayman Islands (UK)', 'Cayman Islands dollar', 'KYD', '$'),
(45, 'Central African Republic', 'Central African CFA franc', 'XAF', 'FCFA'),
(46, 'Chad', 'Central African CFA franc', 'XAF', 'FCFA'),
(47, 'Chatham Islands (New Zealand)', 'New Zealand dollar', 'NZD', '$'),
(48, 'Chile', 'Chilean peso', 'CLP', '$'),
(49, 'China', 'Chinese Yuan Renminbi', 'CNY', '¥'),
(50, 'Christmas Island (Australia)', 'Australian dollar', 'USD', '$'),
(51, 'Cocos (Keeling) Islands (Australia)', 'Australian dollar', 'USD', '$'),
(52, 'Colombia', 'Colombian peso', 'COP', '$'),
(53, 'Comoros', 'Comorian franc', 'KMF', 'CF'),
(54, 'Congo, Democratic Republic of the', 'Congolese franc', 'CDF', 'CDF'),
(55, 'Congo, Republic of the', 'Central African CFA franc', 'XAF', 'FCFA'),
(57, 'Costa Rica', 'Costa Rican colon', 'CRC', '₡'),
(58, 'Cote d\'Ivoire', 'West African CFA franc', 'XOF', 'CFA'),
(59, 'Croatia', 'Croatian kuna', 'HRK', 'kn'),
(60, 'Cuba', 'Cuban peso', 'CUP', '₱'),
(61, 'Curacao (Netherlands)', 'Netherlands Antillean guilder', 'ANG', 'ƒ'),
(62, 'Cyprus', 'European euro', 'EUR', '€'),
(63, 'Czechia', 'Czech koruna', 'CZK', 'Kč'),
(64, 'Denmark', 'Danish krone', 'DKK', 'kr'),
(65, 'Djibouti', 'Djiboutian franc', 'DJF', 'Fdj'),
(66, 'Dominica', 'East Caribbean dollar', 'XCD', '$'),
(67, 'Dominican Republic', 'Dominican peso', 'DOP', 'RD$'),
(68, 'Ecuador', 'United States dollar', 'USD', '$'),
(69, 'Egypt', 'Egyptian pound', 'EGP', '£'),
(70, 'El Salvador', 'United States dollar', 'USD', '$'),
(71, 'Equatorial Guinea', 'Central African CFA franc', 'XAF', 'FCFA'),
(72, 'Eritrea', 'Eritrean nakfa', 'ERN', 'Nkf'),
(73, 'Estonia', 'European euro', 'EUR', '€'),
(74, 'Eswatini (formerly Swaziland)', 'Swazi lilangeni', 'SZL', 'L'),
(75, 'Ethiopia', 'Ethiopian birr', 'ETB', 'Br'),
(76, 'Falkland Islands (UK)', 'Falkland Islands pound', 'FKP', '£'),
(77, 'Faroe Islands (Denmark)', 'Faroese krona', 'FK', '$'),
(78, 'Fiji', 'Fijian dollar', 'FJD', '$'),
(79, 'Finland', 'European euro', 'EUR', '€'),
(80, 'France', 'European euro', 'EUR', '€'),
(81, 'French Guiana (France)', 'European euro', 'EUR', '€'),
(82, 'French Polynesia (France)', 'CFP franc', 'XPF', '₣'),
(83, 'Gabon', 'Central African CFA franc', 'XAF', 'FCFA'),
(84, 'Gambia', 'Gambian dalasi', 'GMD', 'D'),
(85, 'Georgia', 'Georgian lari', 'GEL', 'ლ'),
(86, 'Germany', 'European euro', 'EUR', '€'),
(87, 'Ghana', 'Ghanaian cedi', 'GHS', 'GH₵'),
(88, 'Gibraltar (UK)', 'Gibraltar pound', 'GIP', '£'),
(89, 'Greece', 'European euro', 'EUR', '€'),
(90, 'Greenland (Denmark)', 'Danish krone', 'DKK', 'kr'),
(91, 'Grenada', 'East Caribbean dollar', 'XCD', '$'),
(92, 'Guadeloupe (France)', 'European euro', 'EUR', '€'),
(93, 'Guam (USA)', 'United States dollar', 'USD', '$'),
(94, 'Guatemala', 'Guatemalan quetzal', 'GTQ', 'Q'),
(95, 'Guernsey (UK)', 'Guernsey Pound', 'GGP', '£'),
(96, 'Guinea', 'Guinean franc', 'GNF', 'FG'),
(97, 'Guinea-Bissau', 'West African CFA franc', 'XOF', 'CFA'),
(98, 'Guyana', 'Guyanese dollar', 'GYD', '$'),
(100, 'Honduras', 'Honduran lempira', 'HNL', 'L'),
(101, 'Hong Kong (China)', 'Hong Kong dollar', 'HKD', '$'),
(102, 'Hungary', 'Hungarian forint', 'HUF', 'Ft'),
(103, 'Iceland', 'Icelandic krona', 'ISK', 'kr'),
(104, 'India', 'Indian rupee', 'INR', '₹'),
(105, 'Indonesia', 'Indonesian rupiah', 'IDR', 'Rp'),
(107, 'Iran', 'Iranian rial', 'IRR', '﷼'),
(108, 'Iraq', 'Iraqi dinar', 'IQD', 'ع.د'),
(109, 'Ireland', 'European euro', 'EUR', '€'),
(110, 'Isle of Man (UK)', 'Manx pound', 'IMP', '£'),
(111, 'Israel', 'Israeli new shekel', 'ILS', '₪'),
(112, 'Italy', 'European euro', 'EUR', '€'),
(113, 'Jamaica', 'Jamaican dollar', 'JMD', 'J$'),
(114, 'Japan', 'Japanese yen', 'JPY', '¥'),
(115, 'Jersey (UK)', 'Jersey pound', 'JEP', '£'),
(116, 'Jordan', 'Jordanian dinar', 'JOD', 'د.ا'),
(117, 'Kazakhstan', 'Kazakhstani tenge', 'KZT', 'лв'),
(118, 'Kenya', 'Kenyan shilling', 'KES', 'Ksh'),
(119, 'Kiribati', 'Australian dollar', 'USD', '$'),
(120, 'Kosovo', 'European euro', 'EUR', '€'),
(121, 'Kuwait', 'Kuwaiti dinar', 'KWD', 'د.ك'),
(122, 'Kyrgyzstan', 'Kyrgyzstani som', 'KGS', 'лв'),
(123, 'Laos', 'Lao kip', 'LAK', '₭'),
(124, 'Latvia', 'European euro', 'EUR', '€'),
(125, 'Lebanon', 'Lebanese pound', 'LBP', '£'),
(127, 'Liberia', 'Liberian dollar', 'LRD', '$'),
(128, 'Libya', 'Libyan dinar', 'LYD', 'ل.د'),
(129, 'Liechtenstein', 'Swiss franc', 'CHF', 'CHF'),
(130, 'Lithuania', 'European euro', 'EUR', '€'),
(131, 'Luxembourg', 'European euro', 'EUR', '€'),
(132, 'Macau (China)', 'Macanese pataca', 'MOP', 'MOP$'),
(133, 'Madagascar', 'Malagasy ariary', 'MGA', 'Ar'),
(134, 'Malawi', 'Malawian kwacha', 'MWK', 'MK'),
(135, 'Malaysia', 'Malaysian ringgit', 'MYR', 'RM'),
(136, 'Maldives', 'Maldivian rufiyaa', 'MVR', 'Rf'),
(137, 'Mali', 'West African CFA franc', 'XOF', 'CFA'),
(138, 'Malta', 'European euro', 'EUR', '€'),
(139, 'Marshall Islands', 'United States dollar', 'USD', '$'),
(140, 'Martinique (France)', 'European euro', 'EUR', '€'),
(142, 'Mauritius', 'Mauritian rupee', 'MUR', '₨'),
(143, 'Mayotte (France)', 'European euro', 'EUR', '€'),
(144, 'Mexico', 'Mexican peso', 'MXN', '$'),
(145, 'Micronesia', 'United States dollar', 'USD', '$'),
(146, 'Moldova', 'Moldovan leu', 'MDL', 'L'),
(147, 'Monaco', 'European euro', 'EUR', '€'),
(148, 'Mongolia', 'Mongolian tugrik', 'MNT', '₮'),
(149, 'Montenegro', 'European euro', 'EUR', '€'),
(150, 'Montserrat (UK)', 'East Caribbean dollar', 'XCD', '$'),
(151, 'Morocco', 'Moroccan dirham', 'MAD', 'MAD'),
(152, 'Mozambique', 'Mozambican metical', 'MZN', 'MT'),
(153, 'Myanmar (formerly Burma)', 'Myanmar kyat', 'MMK', 'K'),
(154, 'Namibia', 'Namibian dollar', 'NAD', '$'),
(155, 'Nauru', 'Australian dollar', 'USD', '$'),
(156, 'Nepal', 'Nepalese rupee', 'NPR', '₨'),
(157, 'Netherlands', 'European euro', 'EUR', '€'),
(158, 'New Caledonia (France)', 'CFP franc', 'XPF', '₣'),
(159, 'New Zealand', 'New Zealand dollar', 'NZD', '$'),
(160, 'Nicaragua', 'Nicaraguan cordoba', 'NIO', 'C$'),
(161, 'Niger', 'West African CFA franc', 'XOF', 'CFA'),
(162, 'Nigeria', 'Nigerian naira', 'NGN', '₦'),
(163, 'Niue (New Zealand)', 'New Zealand dollar', 'NZD', '$'),
(164, 'Norfolk Island (Australia)', 'Australian dollar', 'USD', '$'),
(165, 'Northern Mariana Islands (USA)', 'United States dollar', 'USD', '$'),
(166, 'North Korea', 'North Korean won', 'KPW', '₩'),
(167, 'North Macedonia (formerly Macedonia)', 'Macedonian denar', 'MKD', 'ден'),
(168, 'Norway', 'Norwegian krone', 'NOK', 'kr'),
(169, 'Oman', 'Omani rial', 'OMR', '﷼'),
(170, 'Pakistan', 'Pakistani rupee', 'PKR', '₨'),
(171, 'Palau', 'United States dollar', 'USD', '$'),
(172, 'Palestine', 'Israeli new shekel', 'ILS', '₪'),
(173, 'Panama', 'United States dollar', 'USD', '$'),
(174, 'Papua New Guinea', 'Papua New Guinean kina', 'PGK', 'K'),
(175, 'Paraguay', 'Paraguayan guarani', 'PYG', 'Gs'),
(176, 'Peru', 'Peruvian sol', 'PEN', 'S/.'),
(177, 'Philippines', 'Philippine peso', 'PHP', 'Php'),
(178, 'Pitcairn Islands (UK)', 'New Zealand dollar', 'NZD', '$'),
(179, 'Poland', 'Polish zloty', 'PLN', 'zł'),
(180, 'Portugal', 'European euro', 'EUR', '€'),
(181, 'Puerto Rico (USA)', 'United States dollar', 'USD', '$'),
(182, 'Qatar', 'Qatari riyal', 'QAR', '﷼'),
(183, 'Reunion (France)', 'European euro', 'EUR', '€'),
(184, 'Romania', 'Romanian leu', 'RON', 'lei'),
(185, 'Russia', 'Russian ruble', 'RUB', 'руб'),
(186, 'Rwanda', 'Rwandan franc', 'RWF', 'R₣'),
(187, 'Saba (Netherlands)', 'United States dollar', 'USD', '$'),
(188, 'Saint Barthelemy (France)', 'European euro', 'EUR', '€'),
(189, 'Saint Helena (UK)', 'Saint Helena pound', 'SHP', '£'),
(190, 'Saint Kitts and Nevis', 'East Caribbean dollar', 'XCD', '$'),
(191, 'Saint Lucia', 'East Caribbean dollar', 'XCD', '$'),
(192, 'Saint Martin (France)', 'European euro', 'EUR', '€'),
(193, 'Saint Pierre and Miquelon (France)', 'European euro', 'EUR', '€'),
(194, 'Saint Vincent and the Grenadines', 'East Caribbean dollar', 'XCD', '$'),
(195, 'Samoa', 'Samoan tala', 'WST', 'WS$'),
(196, 'San Marino', 'European euro', 'EUR', '€'),
(198, 'Saudi Arabia', 'Saudi Arabian riyal', 'SAR', '﷼'),
(199, 'Senegal', 'West African CFA franc', 'XOF', 'CFA'),
(200, 'Serbia', 'Serbian dinar', 'RSD', 'Дин.'),
(201, 'Seychelles', 'Seychellois rupee', 'SCR', '₨'),
(202, 'Sierra Leone', 'Sierra Leonean leone', 'SLL', 'Le'),
(203, 'Singapore', 'Singapore dollar', 'SGD', '$'),
(204, 'Sint Eustatius (Netherlands)', 'United States dollar', 'USD', '$'),
(205, 'Sint Maarten (Netherlands)', 'Netherlands Antillean guilder', 'ANG', 'ƒ'),
(206, 'Slovakia', 'European euro', 'EUR', '€'),
(207, 'Slovenia', 'European euro', 'EUR', '€'),
(208, 'Solomon Islands', 'Solomon Islands dollar', 'SBD', '$'),
(209, 'Somalia', 'Somali shilling', 'SOS', 'S'),
(210, 'South Africa', 'South African rand', 'ZAR', 'R'),
(211, 'South Georgia Island (UK)', 'Pound sterling', 'GBP', '£'),
(212, 'South Korea', 'South Korean won', 'KRW', '₩'),
(213, 'South Sudan', 'South Sudanese pound', 'SSP', '£'),
(214, 'Spain', 'European euro', 'EUR', '€'),
(215, 'Sri Lanka', 'Sri Lankan rupee', 'LKR', '₨'),
(216, 'Sudan', 'Sudanese pound', 'SDG', 'ج.س'),
(217, 'Suriname', 'Surinamese dollar', 'SRD', '$'),
(218, 'Svalbard and Jan Mayen (Norway)', 'Norwegian krone', 'NOK', 'kr'),
(219, 'Sweden', 'Swedish krona', 'SEK', 'kr'),
(220, 'Switzerland', 'Swiss franc', 'CHF', 'CHF'),
(221, 'Syria', 'Syrian pound', 'SYP', '£'),
(222, 'Taiwan', 'New Taiwan dollar', 'TWD', 'NT$'),
(223, 'Tajikistan', 'Tajikistani somoni', 'TJS', 'SM'),
(224, 'Tanzania', 'Tanzanian shilling', 'TZS', 'TSh'),
(225, 'Thailand', 'Thai baht', 'THB', '฿'),
(226, 'Timor-Leste', 'United States dollar', 'USD', '$'),
(227, 'Togo', 'West African CFA franc', 'XOF', 'CFA'),
(228, 'Tokelau (New Zealand)', 'New Zealand dollar', 'NZD', '$'),
(229, 'Tonga', 'Tongan pa’anga', 'TOP', 'T$'),
(230, 'Trinidad and Tobago', 'Trinidad and Tobago dollar', 'TTD', 'TT$'),
(231, 'Tristan da Cunha (UK)', 'Pound sterling', 'GBP', '£'),
(232, 'Tunisia', 'Tunisian dinar', 'TND', 'DT'),
(233, 'Turkey', 'Turkish lira', 'TRY', '₺'),
(234, 'Turkmenistan', 'Turkmen manat', 'TMT', 'T'),
(235, 'Turks and Caicos Islands (UK)', 'United States dollar', 'USD', '$'),
(236, 'Tuvalu', 'Australian dollar', 'USD', '$'),
(237, 'Uganda', 'Ugandan shilling', 'UGX', 'USh'),
(238, 'Ukraine', 'Ukrainian hryvnia', 'UAH', '₴'),
(239, 'United Arab Emirates', 'UAE dirham', 'AED', 'د.إ'),
(240, 'United Kingdom', 'Pound sterling', 'GBP', '£'),
(241, 'United States of America', 'United States dollar', 'USD', '$'),
(242, 'Uruguay', 'Uruguayan peso', 'UYU', '$U'),
(243, 'US Virgin Islands (USA)', 'United States dollar', 'USD', '$'),
(244, 'Uzbekistan', 'Uzbekistani som', 'UZS', 'лв'),
(246, 'Vatican City (Holy See)', 'European euro', 'EUR', '€'),
(248, 'Vietnam', 'Vietnamese dong', 'VND', '₫'),
(249, 'Wake Island (USA)', 'United States dollar', 'USD', '$'),
(250, 'Wallis and Futuna (France)', 'CFP franc', 'XPF', '₣'),
(251, 'Yemen', 'Yemeni rial', 'YER', '﷼'),
(252, 'Zambia', 'Zambian kwacha', 'ZMW', 'ZK'),
(253, 'Zimbabwe', 'United States dollar', 'USD', '$');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `division_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `duty_type` varchar(255) NOT NULL,
  `hire_date` date NOT NULL,
  `original_hire_date` date NOT NULL,
  `termination_date` date DEFAULT NULL,
  `termination_reason` text DEFAULT NULL,
  `termination_voluntary` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `rehire_date` date DEFAULT NULL,
  `rate_type` enum('Hourly','Salary') NOT NULL,
  `rate` double(20,2) NOT NULL,
  `bonus` double(20,2) NOT NULL DEFAULT 0.00,
  `pay_frequency` varchar(255) NOT NULL,
  `pay_frequency_desc` text DEFAULT NULL,
  `allocate_leave` int(11) NOT NULL,
  `remaining_leave` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `ethnic_group` varchar(255) DEFAULT NULL,
  `eeo_class` varchar(255) DEFAULT NULL,
  `ssn` varchar(255) DEFAULT NULL,
  `work_in_state` enum('Yes','No') DEFAULT NULL,
  `live_in_state` enum('Yes','No') DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `home_email` varchar(255) DEFAULT NULL,
  `home_phone` varchar(255) NOT NULL,
  `cell_phone` varchar(255) NOT NULL,
  `business_email` varchar(255) DEFAULT NULL,
  `business_phone` varchar(255) DEFAULT NULL,
  `emerg_cont` varchar(255) NOT NULL,
  `emerg_cont_alt` varchar(255) DEFAULT NULL,
  `emerg_home_cont` varchar(255) NOT NULL,
  `emerg_cont_home_alt` varchar(255) DEFAULT NULL,
  `emerg_work_cont` varchar(255) NOT NULL,
  `emerg_cont_work_alt` varchar(255) DEFAULT NULL,
  `emerg_cont_relations` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `expense_no` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `expense_note` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `client_id`, `expense_no`, `date`, `total_amount`, `expense_note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, '0000001', '2024-08-27', 600.00, 'Expense', 1, 4, NULL, '2024-08-27 06:01:57', '2024-08-27 06:01:57'),
(2, 4, '0000002', '2024-08-27', 1250.00, 'Repair Fan , Motor and Purchase fan', 1, 4, NULL, '2024-08-27 06:08:56', '2024-08-27 06:08:56'),
(3, 6, '0000003', '2024-09-03', 15500.00, 'Expense', 1, 6, 6, '2024-09-03 12:37:47', '2024-09-03 12:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `client_id`, `cat_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Stationary', 1, '2024-08-27 05:19:16', '2024-08-27 05:19:35'),
(2, 4, 'Salary', 1, '2024-08-27 05:20:22', '2024-08-27 05:20:22'),
(3, 4, 'Electricity', 1, '2024-08-27 05:54:35', '2024-08-27 05:54:35'),
(4, 6, 'Salary', 1, '2024-09-03 12:32:21', '2024-09-03 12:32:36'),
(5, 6, 'Electrycity', 1, '2024-09-03 12:33:39', '2024-09-03 12:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `expense_details`
--

CREATE TABLE `expense_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `expense_cat_id` int(11) NOT NULL,
  `expense_head_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `quantity` double(10,2) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_details`
--

INSERT INTO `expense_details` (`id`, `client_id`, `expense_id`, `expense_cat_id`, `expense_head_id`, `amount`, `quantity`, `note`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 3, 1, 50.00, 2.00, 'Purchase Lite', '2024-08-27 06:01:57', '2024-08-27 06:01:57'),
(2, 4, 1, 3, 5, 500.00, 1.00, 'Purchase Motor', '2024-08-27 06:01:57', '2024-08-27 06:01:57'),
(3, 0, 2, 3, 5, 100.00, 1.00, 'Motor Repair', '2024-08-27 06:08:56', '2024-08-27 06:08:56'),
(4, 0, 2, 3, 2, 150.00, 1.00, 'Fan Repair', '2024-08-27 06:08:56', '2024-08-27 06:08:56'),
(5, 0, 2, 3, 2, 1000.00, 1.00, 'Purchase Fan', '2024-08-27 06:08:56', '2024-08-27 06:08:56'),
(12, 0, 3, 5, 6, 5000.00, 1.00, 'Generator Repair', '2024-09-03 12:48:02', '2024-09-03 12:48:02'),
(13, 0, 3, 5, 7, 1500.00, 7.00, 'Purchase Fan', '2024-09-03 12:48:02', '2024-09-03 12:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `expense_heads`
--

CREATE TABLE `expense_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_heads`
--

INSERT INTO `expense_heads` (`id`, `client_id`, `title`, `code`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'Light', NULL, 1, 4, NULL, '2024-08-27 05:54:45', '2024-08-27 05:54:45'),
(2, 4, 'Fan', NULL, 1, 4, NULL, '2024-08-27 05:54:51', '2024-08-27 05:54:51'),
(3, 4, 'Ac', NULL, 1, 4, NULL, '2024-08-27 05:54:56', '2024-08-27 05:54:56'),
(5, 4, 'Motor', NULL, 1, 4, 4, '2024-08-27 06:00:10', '2024-08-27 06:06:54'),
(6, 6, 'Generator', NULL, 1, 6, 6, '2024-09-03 12:33:25', '2024-09-03 12:36:33'),
(7, 6, 'Fan', NULL, 1, 6, 6, '2024-09-03 12:36:05', '2024-09-03 12:36:21'),
(8, 6, 'light', NULL, 1, 6, NULL, '2024-09-03 12:36:15', '2024-09-03 12:36:15');

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
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `occasion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `h_r_settings`
--

CREATE TABLE `h_r_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_start_at` time NOT NULL DEFAULT '10:00:00',
  `office_end_at` time NOT NULL DEFAULT '18:00:00',
  `daily_work_hour` int(11) NOT NULL DEFAULT 8,
  `overtime_rate` double(10,3) NOT NULL DEFAULT 1.000,
  `equivalent_absences` tinyint(4) NOT NULL DEFAULT 3,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_items`
--

CREATE TABLE `issue_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(4) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `total_price` double(20,2) NOT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_item_details`
--

CREATE TABLE `issue_item_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` double(20,2) NOT NULL,
  `unit_price` double(20,2) NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_type_id` tinyint(4) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cost` double(20,2) DEFAULT 0.00,
  `price` double(20,2) DEFAULT 0.00,
  `vat` double(5,2) NOT NULL DEFAULT 0.00,
  `sold_qty` double(20,2) NOT NULL DEFAULT 0.00,
  `opening_stock` double(20,2) DEFAULT 0.00,
  `current_stock` double(20,2) DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_taken_by_id` int(11) NOT NULL,
  `handover_to_id` int(11) NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `approved_by_id` int(11) DEFAULT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `application_start_date` date NOT NULL,
  `application_end_date` date NOT NULL,
  `approved_start_date` date NOT NULL,
  `approved_end_date` date NOT NULL,
  `application_days` int(11) NOT NULL,
  `approved_days` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `leave_days` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `approved_by_id` int(11) DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `loan_details` text NOT NULL,
  `application_date` date NOT NULL,
  `approved_date` date NOT NULL,
  `repayment_from` date NOT NULL,
  `amount` double(20,2) NOT NULL,
  `interest_percent` int(11) NOT NULL,
  `installment_period` int(11) NOT NULL,
  `repayment_total` double(20,2) NOT NULL,
  `installment` double(20,2) NOT NULL,
  `paid_amount` double(20,2) NOT NULL,
  `payment_status` tinyint(4) NOT NULL COMMENT '0 = Not Paid, 1 = Paid',
  `approve_status` tinyint(4) NOT NULL COMMENT '0 = Pending, 1 = Approved, -1 = Cancelled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_installments`
--

CREATE TABLE `loan_installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `year_month` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `menu_name` varchar(255) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `menu_name`, `route`, `created_at`, `updated_at`) VALUES
(1, 159, 'Manager Dashboard', 'manager-dashboard', '2024-07-03 14:21:36', '2024-07-14 12:05:37'),
(2, 1, 'Category', NULL, '2024-07-03 14:45:49', '2024-07-03 14:45:49'),
(3, 1, 'SubCategory', NULL, '2024-07-03 15:17:08', '2024-07-03 15:17:08'),
(4, 1, 'Products', NULL, '2024-07-03 15:17:19', '2024-07-03 15:17:19'),
(6, 1, 'Customers', NULL, '2024-07-03 15:17:55', '2024-07-03 15:17:55'),
(7, 1, 'Suppliers', NULL, '2024-07-03 15:18:09', '2024-07-03 15:18:09'),
(8, 1, 'Purchase', NULL, '2024-07-03 15:18:18', '2024-07-03 15:18:18'),
(9, 1, 'Purchase Return', NULL, '2024-07-03 15:18:34', '2024-07-03 15:18:34'),
(10, 1, 'Total Collections', NULL, '2024-07-03 15:18:49', '2024-07-03 15:18:49'),
(11, 160, 'Basic Info', 'basic-infos.index', '2024-07-03 15:20:25', '2024-07-14 07:54:25'),
(14, 160, 'Roles', 'roles.index', '2024-07-04 06:20:12', '2024-07-14 08:15:15'),
(15, 160, 'Admins', 'admins.index', '2024-07-04 06:23:03', '2024-07-14 08:14:25'),
(16, 14, 'Add', 'roles.create', '2024-07-04 06:56:52', '2024-07-04 06:56:52'),
(17, 14, 'Edit', 'roles.destroy', '2024-07-04 06:58:06', '2024-07-04 06:58:06'),
(18, 15, 'Add', 'admins.create', '2024-07-04 08:28:48', '2024-07-04 08:28:48'),
(19, 15, 'Edit', 'admins.edit', '2024-07-04 08:29:27', '2024-07-04 08:29:27'),
(20, 15, 'Delete', 'admins.destroy', '2024-07-04 08:29:57', '2024-07-04 08:29:57'),
(22, 160, 'My Profile', 'profile.update-details', '2024-07-04 10:43:01', '2024-07-14 08:20:14'),
(23, 160, 'Update Password', 'admin.password.update', '2024-07-04 10:44:19', '2024-07-14 08:20:31'),
(24, 0, 'Products', NULL, '2024-07-04 10:47:18', '2024-07-04 10:47:18'),
(25, 24, 'Category', 'categories.index', '2024-07-04 10:48:46', '2024-07-04 10:48:46'),
(26, 25, 'Add', 'categories.create', '2024-07-04 10:49:19', '2024-07-04 10:49:19'),
(27, 25, 'Edit', 'categories.edit', '2024-07-04 10:49:46', '2024-07-04 10:49:46'),
(28, 25, 'Delete', 'categories.destroy', '2024-07-04 10:50:14', '2024-07-04 10:50:14'),
(29, 24, 'Sub Category', 'sub-categories.index', '2024-07-04 10:51:15', '2024-07-04 10:51:15'),
(30, 29, 'Add', 'sub-categories.create', '2024-07-04 10:52:03', '2024-07-04 10:52:03'),
(31, 29, 'Edit', 'sub-categories.edit', '2024-07-04 10:52:18', '2024-07-04 10:52:18'),
(32, 29, 'Delete', 'sub-categories.destroy', '2024-07-04 10:52:35', '2024-07-04 10:52:35'),
(33, 24, 'Product', 'products.index', '2024-07-04 10:53:55', '2024-07-04 10:53:55'),
(34, 33, 'Add', 'products.create', '2024-07-04 10:54:22', '2024-07-04 10:54:22'),
(35, 33, 'Edit', 'products.edit', '2024-07-04 10:54:47', '2024-07-04 10:54:47'),
(36, 33, 'Delete', 'products.destroy', '2024-07-04 10:55:50', '2024-07-04 10:55:50'),
(37, 160, 'Units', 'units.index', '2024-07-04 10:58:07', '2024-07-25 09:14:54'),
(38, 37, 'Add', 'units.create', '2024-07-04 10:59:06', '2024-07-04 10:59:06'),
(39, 37, 'Edit', 'units.edit', '2024-07-04 10:59:44', '2024-07-04 10:59:44'),
(40, 37, 'Delete', 'units.destroy', '2024-07-04 11:00:01', '2024-07-04 11:00:01'),
(41, 0, 'Purchase', 'purchases.index', '2024-07-04 11:03:00', '2024-07-14 12:04:03'),
(42, 41, 'Add', 'purchases.create', '2024-07-04 11:03:10', '2024-07-04 11:03:10'),
(43, 41, 'Purchase Return', 'purchases.edit', '2024-07-04 11:03:19', '2024-07-04 11:03:19'),
(45, 41, 'Print', 'purchases.vouchar', '2024-07-04 11:04:32', '2024-07-04 11:04:32'),
(46, 41, 'Add Payment', 'purchases.vouchar.print', '2024-07-04 11:06:17', '2024-07-04 11:06:17'),
(47, 0, 'Sales', 'purchases.payment.store', '2024-07-04 11:07:20', '2024-07-04 11:07:20'),
(49, 47, 'Sales Return', 'sales.index', '2024-07-04 11:21:49', '2024-07-14 12:02:23'),
(50, 47, 'Add', 'sales.create', '2024-07-04 11:22:59', '2024-07-04 11:22:59'),
(51, 47, 'Add Collection', 'sales.invoice', '2024-07-04 11:23:24', '2024-07-04 11:23:24'),
(52, 47, 'Print', 'sales.invoice.print', '2024-07-04 11:23:43', '2024-07-04 11:23:43'),
(70, 0, 'Payments', 'payments.index', '2024-07-04 11:41:33', '2024-07-14 12:03:42'),
(71, 70, 'Add', 'payments.create', '2024-07-04 11:42:59', '2024-07-04 11:42:59'),
(77, 0, 'Expense', NULL, '2024-07-04 11:56:36', '2024-07-04 11:56:36'),
(78, 77, 'Expense Category', 'expense-categories.index', '2024-07-04 11:57:09', '2024-07-04 11:57:09'),
(79, 77, 'Expense Head', 'expense-heads.index', '2024-07-04 11:57:45', '2024-07-04 11:57:45'),
(80, 77, 'Expense Manage', 'expenses.index', '2024-07-04 11:58:18', '2024-07-04 11:58:18'),
(81, 77, 'Reports', 'reports.index', '2024-07-04 11:58:59', '2024-07-04 11:58:59'),
(82, 80, 'Add', 'expenses.create', '2024-07-04 12:01:25', '2024-07-04 12:01:25'),
(83, 80, 'Edit', 'expenses.edit', '2024-07-04 12:01:39', '2024-07-04 12:01:39'),
(84, 80, 'Delete', 'expenses.destroy', '2024-07-04 12:01:54', '2024-07-04 12:01:54'),
(85, 79, 'Add', 'expense-heads.index', '2024-07-04 12:36:40', '2024-07-04 12:36:53'),
(86, 79, 'Edit', 'expenses.edit', '2024-07-04 12:37:32', '2024-07-04 12:37:32'),
(91, 79, 'Delete', 'expense-heads.destroy', '2024-07-04 12:45:23', '2024-07-04 12:45:23'),
(92, 78, 'Add', 'expense-categories.create', '2024-07-04 12:46:00', '2024-07-04 12:46:00'),
(93, 78, 'Edit', 'expense-categories.edit', '2024-07-04 12:46:18', '2024-07-04 12:46:18'),
(94, 78, 'Delete', 'expense-categories.destroy', '2024-07-04 12:46:32', '2024-07-04 12:46:32'),
(95, 160, 'Service Table', 'tables.index', '2024-07-04 12:47:31', '2024-07-14 07:54:55'),
(96, 95, 'Add', 'tables.create', '2024-07-04 12:49:29', '2024-07-04 12:49:29'),
(97, 95, 'Edit', 'tables.edit', '2024-07-04 12:49:38', '2024-07-04 12:49:38'),
(98, 95, 'Delete', 'tables.destroy', '2024-07-04 12:49:48', '2024-07-04 12:49:48'),
(99, 162, 'Payment Methods', 'payment-methods.index', '2024-07-04 12:51:22', '2024-07-14 10:24:02'),
(100, 99, 'Add', 'payment-methods.create', '2024-07-04 12:51:42', '2024-07-04 12:51:51'),
(101, 99, 'Edit', 'payment-methods.edit', '2024-07-04 12:52:19', '2024-07-04 12:52:19'),
(102, 99, 'Delete', 'payment-methods.destroy', '2024-07-04 12:52:35', '2024-07-04 12:52:35'),
(103, 162, 'Suppliers', 'suppliers.index', '2024-07-04 12:53:52', '2024-07-14 11:53:35'),
(104, 103, 'Add', 'suppliers.create', '2024-07-04 12:54:18', '2024-07-04 12:54:18'),
(105, 103, 'Edit', 'suppliers.edit', '2024-07-04 12:54:35', '2024-07-04 12:54:35'),
(106, 103, 'Delete', 'suppliers.destroy', '2024-07-04 12:55:07', '2024-07-04 12:55:07'),
(107, 0, 'Reports', NULL, '2024-07-04 12:55:42', '2024-07-04 12:55:42'),
(108, 107, 'Customer Ledgers', 'reports.supplier-ledgers', '2024-07-04 12:56:13', '2024-07-04 12:57:02'),
(109, 107, 'Stock Reports', 'reports.stocks', '2024-07-04 12:57:49', '2024-07-04 12:57:49'),
(110, 107, 'Collections Report', 'reports.collections', '2024-07-04 12:58:38', '2024-07-04 12:58:38'),
(118, 117, 'Salary', 'salaries.index', '2024-07-04 13:02:45', '2024-07-04 13:04:57'),
(119, 117, 'Salary Process', 'salary-processes.index', '2024-07-04 13:05:28', '2024-07-04 13:05:28'),
(120, 116, 'Loan Process', 'loan-processes.index', '2024-07-04 13:06:34', '2024-07-04 13:06:34'),
(121, 116, 'Loan', 'loans.index', '2024-07-04 13:08:31', '2024-07-04 13:08:31'),
(122, 121, 'Add', 'loans.create', '2024-07-04 13:08:44', '2024-07-04 13:08:44'),
(123, 121, 'Edit', 'loans.edit', '2024-07-04 13:18:41', '2024-07-04 13:18:41'),
(124, 121, 'Delete', 'loans.destroy', '2024-07-04 13:18:56', '2024-07-04 13:18:56'),
(125, 113, 'Weekly Holiday', 'weekly-holidays.index', '2024-07-04 13:20:04', '2024-07-14 12:48:31'),
(126, 113, 'Holiday', 'holidays.index', '2024-07-04 13:20:48', '2024-07-14 12:49:01'),
(127, 113, 'Leave Type', 'leave-types.index', '2024-07-04 13:23:12', '2024-07-14 12:49:31'),
(128, 115, 'Leave Report', 'leaves.reports', '2024-07-04 13:23:57', '2024-07-04 13:23:57'),
(129, 127, 'Add', 'leave-types.create', '2024-07-04 13:25:54', '2024-07-04 13:25:54'),
(130, 127, 'Edit', 'leave-types.edit', '2024-07-04 13:26:08', '2024-07-04 13:26:08'),
(131, 127, 'Delete', 'leave-types.destroy', '2024-07-04 13:26:25', '2024-07-04 13:26:25'),
(132, 115, 'Leave', 'leaves.index', '2024-07-04 13:28:05', '2024-07-04 13:28:05'),
(133, 132, 'Add', 'leaves.create', '2024-07-04 13:28:39', '2024-07-04 13:28:39'),
(134, 132, 'Edit', 'leaves.edit', '2024-07-04 13:28:55', '2024-07-04 13:28:55'),
(135, 132, 'Delete', 'leaves.delete', '2024-07-04 13:29:19', '2024-07-04 13:29:19'),
(136, 126, 'Add', 'holidays.create', '2024-07-04 13:30:14', '2024-07-04 13:30:14'),
(137, 126, 'Delete', 'holidays.destroy', '2024-07-04 13:30:51', '2024-07-04 13:30:51'),
(138, 114, 'Attendance', 'attendances.index', '2024-07-04 13:32:10', '2024-07-04 13:32:10'),
(139, 114, 'Attendance Process', 'attendance-processes.index', '2024-07-04 13:33:07', '2024-07-04 13:33:07'),
(140, 114, 'Attendance Report', 'attendances-reports.index', '2024-07-04 13:34:16', '2024-07-04 13:34:16'),
(141, 113, 'Departments', 'departments.index', '2024-07-04 13:35:30', '2024-07-04 13:35:30'),
(142, 113, 'Divisions', 'divisions.index', '2024-07-04 13:36:09', '2024-07-04 13:36:09'),
(143, 142, 'Add', 'divisions.create', '2024-07-04 13:36:39', '2024-07-04 13:36:39'),
(144, 142, 'Edit', 'divisions.edit', '2024-07-04 13:36:51', '2024-07-04 13:36:51'),
(145, 142, 'Delete', 'divisions.destroy', '2024-07-04 13:37:04', '2024-07-04 13:37:04'),
(146, 141, 'Add', 'departments.create', '2024-07-04 13:37:35', '2024-07-04 13:37:35'),
(147, 141, 'Edit', 'departments.edit', '2024-07-04 13:38:05', '2024-07-04 13:38:05'),
(148, 141, 'Delete', 'departments.delete', '2024-07-04 13:42:58', '2024-07-04 13:42:58'),
(149, 113, 'Settings', 'hrsettings.index', '2024-07-04 14:12:56', '2024-07-14 12:46:02'),
(150, 111, 'Designation', 'designations.index', '2024-07-04 14:13:36', '2024-07-04 14:13:36'),
(151, 113, 'Designation', 'designations.index', '2024-07-04 14:14:51', '2024-07-14 12:47:16'),
(152, 113, 'Employee', 'employees.index', '2024-07-04 14:16:06', '2024-07-14 12:47:45'),
(153, 152, 'Add', 'employees.create', '2024-07-04 14:16:32', '2024-07-04 14:16:32'),
(154, 152, 'Edit', 'employees.edit', '2024-07-04 14:16:46', '2024-07-04 14:16:56'),
(155, 152, 'Delete', 'employees.destroy', '2024-07-04 14:17:54', '2024-07-04 14:17:54'),
(156, 151, 'Add', 'designations.create', '2024-07-04 14:18:47', '2024-07-04 14:18:47'),
(157, 151, 'Edit', 'designations.edit', '2024-07-04 14:19:02', '2024-07-04 14:19:02'),
(158, 151, 'Delete', 'designations.destroy', '2024-07-04 14:19:24', '2024-07-04 14:19:24'),
(159, 0, 'Dashboard', NULL, '2024-07-14 07:39:40', '2024-07-14 07:39:40'),
(160, 0, 'Basic Setup', NULL, '2024-07-14 07:53:59', '2024-07-14 07:53:59'),
(162, 0, 'Setup', NULL, '2024-07-14 10:23:52', '2024-07-14 10:23:52'),
(168, 161, 'Production Plan', 'production-plans.index', '2024-07-14 11:55:11', '2024-07-14 11:55:11'),
(169, 168, 'Add', 'production-plans.create', '2024-07-14 11:55:31', '2024-07-14 11:55:31'),
(170, 168, 'Edit', 'production-plans.edit', '2024-07-14 11:55:49', '2024-07-14 11:55:49'),
(171, 168, 'Delete', 'production-plans.destroy', '2024-07-14 11:56:04', '2024-07-14 11:56:04'),
(172, 161, 'Purchase Requision', 'purchase-requisitions.index', '2024-07-14 11:59:31', '2024-07-14 11:59:31'),
(173, 172, 'Add', 'purchase-requisitions.create', '2024-07-14 11:59:47', '2024-07-14 11:59:47'),
(174, 172, 'Edit', 'purchase-requisitions.edit', '2024-07-14 12:00:02', '2024-07-14 12:00:02'),
(175, 172, 'Delete', 'purchase-requisitions.destroy', '2024-07-14 12:00:18', '2024-07-14 12:00:18'),
(176, 107, 'Purchase Report', 'reports.purchase', '2024-07-14 12:11:05', '2024-07-14 12:11:05'),
(177, 107, 'Sales Report', 'reports.sales', '2024-07-14 12:11:53', '2024-07-14 12:11:53'),
(179, 162, 'Customers', 'customers.index', '2024-07-25 09:17:03', '2024-07-25 09:17:03'),
(180, 179, 'Add', 'customers.create', '2024-07-25 09:17:54', '2024-07-25 09:17:54'),
(181, 179, 'Edit', 'customers.edit', '2024-07-25 09:18:13', '2024-07-25 09:18:13'),
(182, 179, 'Delete', 'customers.destroy', '2024-07-25 09:18:38', '2024-07-25 09:18:38');

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(35, '2023_10_21_001204_create_basic_infos_table', 2),
(44, '2023_12_26_114309_create_admins_table', 9),
(48, '2014_10_12_000000_create_users_table', 71),
(81, '2024_01_30_123321_create_roles_table', 32),
(82, '2024_01_30_123933_create_privileges_table', 33),
(83, '2024_01_30_140322_create_menus_table', 33),
(84, '2023_12_13_144516_create_categories_table', 34),
(85, '2023_12_26_170202_create_items_table', 35),
(86, '2024_03_21_152244_create_tables_table', 36),
(87, '2024_03_23_104607_create_payment_methods_table', 37),
(97, '2024_04_21_135934_create_units_table', 40),
(104, '2024_04_21_174416_create_purchases_table', 42),
(105, '2024_04_21_190732_create_purchase_details_table', 42),
(106, '2024_04_22_164354_create_category_types_table', 43),
(112, '2024_04_28_130402_create_issue_items_table', 45),
(113, '2024_04_28_130413_create_issue_item_details_table', 45),
(116, '2024_05_06_120259_create_designations_table', 47),
(118, '2024_05_06_145650_create_departments_table', 48),
(119, '2024_05_06_151632_create_divisions_table', 49),
(124, '2024_05_06_143612_create_employees_table', 50),
(126, '2024_05_06_171323_create_benefits_table', 51),
(128, '2024_05_13_141259_create_attendances_table', 52),
(131, '2024_05_14_150331_create_leave_types_table', 54),
(132, '2024_05_14_141508_create_leaves_table', 55),
(134, '2024_05_25_135112_create_holidays_table', 56),
(136, '2024_05_26_151237_create_h_r_settings_table', 57),
(137, '2024_02_25_120043_create_expense_heads_table', 58),
(138, '2024_02_25_122743_create_expenses_table', 58),
(142, '2024_05_28_183705_create_loans_table', 59),
(144, '2024_06_01_125524_create_weekly_holidays_table', 60),
(155, '2024_06_10_180908_create_attendance_processes_table', 61),
(156, '2024_06_10_183027_create_attendance_process_details_table', 61),
(157, '2024_06_13_172339_create_loan_installments_table', 62),
(158, '2024_06_22_145712_create_salary_processes_table', 63),
(159, '2024_06_22_145722_create_salary_process_temps_table', 63),
(161, '2024_06_25_122016_create_expense_categories_table', 64),
(162, '2024_02_25_123102_create_expense_details_table', 65),
(163, '2024_01_03_115653_create_orders_table', 66),
(164, '2024_01_03_115957_create_order_details_table', 66),
(167, '2024_04_27_130014_create_stock_histories_table', 67),
(177, '2024_07_08_155705_create_recipes_table', 68),
(178, '2024_07_08_155722_create_recipe_details_table', 68),
(188, '2024_07_08_155814_create_production_plans_table', 69),
(189, '2024_07_08_155914_create_pp_details_table', 69),
(190, '2024_07_08_155954_create_ppd_raw_materials_table', 69),
(197, '2024_07_10_181438_create_purchase_requisitions_table', 70),
(198, '2024_07_10_181446_create_purchase_requisition_details_table', 70),
(200, '2024_08_19_153108_create_products_table', 72),
(201, '2024_08_20_182538_create_vendors_table', 73),
(202, '2024_08_21_143719_create_vendor_ledgers_table', 74),
(203, '2024_08_21_170050_create_stocks_table', 75),
(204, '2024_04_28_171201_create_payments_table', 76),
(205, '2024_08_25_125201_create_purchase_returns_table', 77),
(206, '2024_08_25_144451_create_purchase_return_details_table', 77),
(207, '2024_08_28_122709_create_sales_table', 78),
(208, '2024_08_28_125546_create_sales__details_table', 78),
(209, '2024_04_21_154700_create_suppliers_table', 79),
(210, '2024_04_28_171225_create_supplier_ledgers_table', 79),
(211, '2024_03_31_125724_create_collections_table', 80),
(214, '2024_09_02_150458_create_sales_returns_table', 81),
(215, '2024_09_02_150509_create_sales_return_details_table', 81),
(216, '2024_09_04_160630_create_packages_table', 82);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` int(11) NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `trade_price` double(20,2) NOT NULL DEFAULT 0.00,
  `mrp` double(20,2) NOT NULL DEFAULT 0.00,
  `discount` double(20,2) NOT NULL DEFAULT 0.00,
  `vat` double(20,2) NOT NULL DEFAULT 0.00,
  `net_bill` double(20,2) NOT NULL DEFAULT 0.00,
  `paid_amount` double(20,2) NOT NULL DEFAULT 0.00,
  `profit` double(20,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT 1,
  `order_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending,1=Approved,2=Cancelled,3=Processing,4=Processed,5=Completed',
  `order_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Dine-In,1=Takeaway,2=Online',
  `created_by_id` int(11) NOT NULL,
  `approved_by_id` int(11) DEFAULT NULL,
  `received_by_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `approved_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `kitchen_alert` tinyint(4) NOT NULL DEFAULT 0,
  `collection_alert` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double(20,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=ready',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `amount` double(20,2) NOT NULL DEFAULT 0.00,
  `duration` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`, `amount`, `duration`, `created_at`, `updated_at`) VALUES
(1, 'Package 1', 10000.00, '365', '2024-09-04 10:40:46', '2024-09-04 10:40:46'),
(2, 'Package 2', 6000.00, '400', '2024-09-04 10:41:55', '2024-09-04 11:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `client_id` tinyint(4) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `amount` double(20,2) NOT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `client_id`, `supplier_id`, `payment_method_id`, `purchase_id`, `sales_id`, `date`, `amount`, `note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, 1, NULL, '2024-09-07', 1400000.00, 'Purchase from Jaman', 1, 4, NULL, '2024-09-07 05:28:13', '2024-09-07 05:28:13'),
(3, 4, 2, 3, 1, NULL, '2024-09-07', 40000.00, NULL, 1, 4, NULL, '2024-09-07 05:30:21', '2024-09-07 05:30:21'),
(4, 4, 3, 1, 2, NULL, '2024-09-07', 800000.00, 'Purchase from MS Traders', 1, 4, NULL, '2024-09-07 05:37:17', '2024-09-07 05:37:17'),
(5, 4, 3, 1, 2, NULL, '2024-09-07', 50000.00, 'payment to MS Traders', 1, 4, NULL, '2024-09-07 05:37:59', '2024-09-07 05:37:59'),
(6, 4, 3, 1, 2, NULL, '2024-09-07', 30000.00, 'payment to MS Traders', 1, 4, NULL, '2024-09-07 05:38:23', '2024-09-07 05:38:23'),
(7, 4, 2, 1, 1, NULL, '2024-09-08', 10000.00, 'Add Payment', 1, 4, NULL, '2024-09-08 08:16:06', '2024-09-08 08:16:06'),
(8, 4, 2, 1, 1, NULL, '2024-09-10', 8000.00, 'Paid to MS Traders', 1, 4, NULL, '2024-09-10 10:10:17', '2024-09-10 10:10:17'),
(9, 4, 3, 3, 3, NULL, '2024-09-29', 99000.00, 'Purchase from MS Traders', 1, 4, NULL, '2024-09-29 12:14:29', '2024-09-29 12:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `client_id`, `title`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 4, 'Cash', 0, '2024-08-22 08:40:18', '2024-08-22 11:55:01'),
(2, 6, 'Nagod', 0, '2024-08-22 08:41:42', '2024-08-22 08:41:42'),
(3, 4, 'Bank', 0, '2024-08-22 10:00:15', '2024-08-22 10:01:40'),
(5, 6, 'Cash', 0, '2024-09-03 10:11:21', '2024-09-03 10:11:21'),
(6, 8, 'Cash', 0, '2024-09-04 06:00:00', '2024-09-04 06:00:00'),
(7, 8, 'Bank', 0, '2024-09-04 06:00:08', '2024-09-04 06:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppd_raw_materials`
--

CREATE TABLE `ppd_raw_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pp_id` bigint(20) UNSIGNED NOT NULL,
  `raw_material_id` int(11) NOT NULL,
  `quantity` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pp_details`
--

CREATE TABLE `pp_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pp_id` bigint(20) UNSIGNED NOT NULL,
  `recipe_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(116, 3, 1, '2024-07-06 12:37:34', '2024-07-06 12:37:34'),
(117, 3, 53, '2024-07-06 12:37:34', '2024-07-06 12:37:34'),
(118, 3, 54, '2024-07-06 12:37:34', '2024-07-06 12:37:34'),
(119, 3, 61, '2024-07-06 12:37:34', '2024-07-06 12:37:34'),
(120, 3, 62, '2024-07-06 12:37:34', '2024-07-06 12:37:34'),
(121, 3, 63, '2024-07-06 12:37:34', '2024-07-06 12:37:34'),
(122, 3, 64, '2024-07-06 12:37:34', '2024-07-06 12:37:34'),
(3407, 5, 24, '2024-09-29 07:18:22', '2024-09-29 07:18:22'),
(3408, 5, 159, '2024-09-29 07:18:22', '2024-09-29 07:18:22'),
(3409, 5, 1, '2024-09-29 07:18:22', '2024-09-29 07:18:22'),
(3410, 5, 2, '2024-09-29 07:18:22', '2024-09-29 07:18:22'),
(3411, 5, 3, '2024-09-29 07:18:22', '2024-09-29 07:18:22'),
(3412, 5, 4, '2024-09-29 07:18:22', '2024-09-29 07:18:22'),
(3413, 5, 6, '2024-09-29 07:18:22', '2024-09-29 07:18:22'),
(3414, 5, 7, '2024-09-29 07:18:22', '2024-09-29 07:18:22'),
(3415, 5, 8, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3416, 5, 9, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3417, 5, 10, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3418, 5, 160, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3419, 5, 11, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3420, 5, 14, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3421, 5, 16, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3422, 5, 17, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3423, 5, 15, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3424, 5, 18, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3425, 5, 19, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3426, 5, 20, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3427, 5, 22, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3428, 5, 23, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3429, 5, 37, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3430, 5, 38, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3431, 5, 39, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3432, 5, 40, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3433, 5, 95, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3434, 5, 96, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3435, 5, 97, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3436, 5, 98, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3437, 5, 162, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3438, 5, 99, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3439, 5, 100, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3440, 5, 101, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3441, 5, 102, '2024-09-29 07:18:23', '2024-09-29 07:18:23'),
(3442, 5, 103, '2024-09-29 07:18:24', '2024-09-29 07:18:24'),
(3443, 5, 104, '2024-09-29 07:18:24', '2024-09-29 07:18:24'),
(3444, 5, 105, '2024-09-29 07:18:24', '2024-09-29 07:18:24'),
(3445, 5, 106, '2024-09-29 07:18:24', '2024-09-29 07:18:24'),
(3446, 5, 179, '2024-09-29 07:18:24', '2024-09-29 07:18:24'),
(3447, 5, 180, '2024-09-29 07:18:24', '2024-09-29 07:18:24'),
(3448, 5, 181, '2024-09-29 07:18:24', '2024-09-29 07:18:24'),
(3449, 5, 182, '2024-09-29 07:18:24', '2024-09-29 07:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `production_plans`
--

CREATE TABLE `production_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `updated_by_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `purchase_price` double(20,2) NOT NULL DEFAULT 0.00,
  `selling_price` double(20,2) NOT NULL DEFAULT 0.00,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `client_id`, `cat_id`, `sub_cat_id`, `unit_id`, `product_name`, `purchase_price`, `selling_price`, `description`, `image`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 5, 1, 'HP Elitebook', 60000.00, 65000.00, 'HP Elitebook', 'item-1724239747.jpg', 1, 4, '2024-08-21 11:29:07', '2024-09-07 06:40:29'),
(2, 4, 1, 6, 1, 'Dell Pro Laptop', 55000.00, 6000.00, 'Dell Pro Laptop', 'item-1724486298.jpg', 1, 4, '2024-08-24 07:58:18', '2024-09-29 12:14:29'),
(3, 4, 3, 7, 1, 'Iphone X', 85000.00, 100000.00, 'Iphone X', 'item-1724486358.jpg', 1, 4, '2024-08-24 07:59:18', '2024-09-07 06:40:52'),
(4, 4, 3, 7, 1, 'Iphone 13 Pro Max', 80000.00, 100000.00, 'Iphone 13 Pro Max', 'item-1724486397.jpg', 1, 4, '2024-08-24 07:59:57', '2024-09-07 06:41:01'),
(5, 6, 8, 10, 1, 'Walton Iron', 0.00, 0.00, 'Walton Iron', 'item-1725358465.jpg', 1, 6, '2024-09-03 10:14:25', '2024-09-03 10:14:25'),
(6, 6, 8, 11, 1, 'Walton Mobile', 0.00, 0.00, 'Walton Smart phone', 'item-1725358777.jpg', 1, 6, '2024-09-03 10:19:37', '2024-09-03 10:19:37'),
(7, 8, 12, 13, 1, 'Pepsi big', 0.00, 0.00, 'Pepsi', 'item-1725429321.jpg', 1, 8, '2024-09-04 05:55:21', '2024-09-04 05:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `vouchar_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `total_price` double(20,2) NOT NULL,
  `vat_tax` double(20,2) NOT NULL,
  `discount` double(20,2) NOT NULL,
  `total_payable` double(20,2) NOT NULL,
  `paid_amount` double(20,2) NOT NULL,
  `note` text DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `client_id`, `supplier_id`, `vouchar_no`, `date`, `total_price`, `vat_tax`, `discount`, `total_payable`, `paid_amount`, `note`, `payment_status`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, '0000001', '2024-09-07', 1620000.00, 0.00, 162000.00, 1458000.00, 1458000.00, 'Purchase from Jaman', '1', '1', 4, NULL, '2024-09-07 05:28:13', '2024-09-10 10:10:17'),
(2, 4, 3, '0000002', '2024-09-07', 932500.00, 0.00, 46625.00, 885875.00, 880000.00, 'Purchase from MS Traders', '0', '1', 4, NULL, '2024-09-07 05:37:17', '2024-09-07 05:38:23'),
(3, 4, 3, '0000003', '2024-09-29', 110000.00, 0.00, 11000.00, 99000.00, 99000.00, 'Purchase from MS Traders', '1', '1', 4, NULL, '2024-09-29 12:14:29', '2024-09-29 12:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` double(20,2) NOT NULL,
  `unit_price` double(20,2) NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `quantity`, `unit_price`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 8.00, 50000.00, 500000.00, '2024-09-07 05:28:13', '2024-09-08 08:14:41'),
(2, 1, 1, 7.00, 60000.00, 720000.00, '2024-09-07 05:28:13', '2024-09-08 08:14:42'),
(3, 1, 4, 5.00, 80000.00, 400000.00, '2024-09-07 05:28:13', '2024-09-07 05:28:13'),
(4, 2, 3, 10.00, 85000.00, 850000.00, '2024-09-07 05:37:17', '2024-09-07 05:37:17'),
(5, 2, 2, 15.00, 5500.00, 82500.00, '2024-09-07 05:37:17', '2024-09-07 05:37:17'),
(6, 3, 2, 2.00, 55000.00, 110000.00, '2024-09-29 12:14:29', '2024-09-29 12:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisitions`
--

CREATE TABLE `purchase_requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vouchar_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `total_price` double(20,2) NOT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisition_details`
--

CREATE TABLE `purchase_requisition_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_requisition_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `quantity` double(20,2) NOT NULL,
  `unit_price` double(20,2) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `vouchar_no` varchar(255) NOT NULL,
  `purchase_id` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `total_return_amount` double(20,2) NOT NULL,
  `refund_amount` double(20,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `return_status` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_returns`
--

INSERT INTO `purchase_returns` (`id`, `client_id`, `supplier_id`, `vouchar_no`, `purchase_id`, `date`, `total_return_amount`, `refund_amount`, `note`, `return_status`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, '0000001', 1, '2024-09-08', 400000.00, 400000.00, 'Purchase Return', '1', '1', 4, NULL, '2024-09-08 08:14:41', '2024-09-08 08:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_details`
--

CREATE TABLE `purchase_return_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `purchase_return_id` tinyint(4) NOT NULL,
  `product_id` tinyint(4) NOT NULL,
  `quantity_returned` double(20,2) NOT NULL,
  `return_reason` text DEFAULT NULL,
  `unit_price` double(20,2) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_return_details`
--

INSERT INTO `purchase_return_details` (`id`, `client_id`, `purchase_return_id`, `product_id`, `quantity_returned`, `return_reason`, `unit_price`, `amount`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 2, 2.00, NULL, 50000.00, 100000.00, 4, NULL, '2024-09-08 08:14:41', '2024-09-08 08:14:41'),
(2, 4, 1, 1, 5.00, NULL, 60000.00, 300000.00, 4, NULL, '2024-09-08 08:14:41', '2024-09-08 08:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `total_cost` double NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `recipe_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipe_details`
--

CREATE TABLE `recipe_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recipe_id` bigint(20) UNSIGNED NOT NULL,
  `raw_material_id` int(11) NOT NULL,
  `sub_quantity` double(10,3) NOT NULL,
  `sub_unit_price` double(10,2) NOT NULL,
  `sub_unit_id` int(11) NOT NULL,
  `main_unit_id` int(11) NOT NULL,
  `main_quantity` double(10,3) NOT NULL,
  `main_unit_price` double(10,2) NOT NULL,
  `cost` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_superadmin` tinyint(4) DEFAULT 0,
  `role` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `is_superadmin`, `role`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'Super Admin', 1, NULL, NULL),
(3, 0, 'Sales Representative', 1, '2024-07-06 12:37:01', '2024-07-06 12:37:01'),
(5, 0, 'Manager', 4, '2024-07-29 09:27:08', '2024-08-18 11:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `salary_processes`
--

CREATE TABLE `salary_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `basic_salary` double(20,2) NOT NULL,
  `bonus` double(20,2) NOT NULL DEFAULT 0.00,
  `overtime` double(20,2) NOT NULL DEFAULT 0.00,
  `others` double(20,2) NOT NULL DEFAULT 0.00,
  `absent` double(20,2) NOT NULL DEFAULT 0.00,
  `late` double(20,2) NOT NULL DEFAULT 0.00,
  `loan` double(20,2) NOT NULL DEFAULT 0.00,
  `net_payable` double(20,2) NOT NULL DEFAULT 0.00,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_process_temps`
--

CREATE TABLE `salary_process_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `basic_salary` double(20,2) NOT NULL,
  `bonus` double(20,2) NOT NULL DEFAULT 0.00,
  `overtime` double(20,2) NOT NULL DEFAULT 0.00,
  `others` double(20,2) NOT NULL DEFAULT 0.00,
  `absent` double(20,2) NOT NULL DEFAULT 0.00,
  `late` double(20,2) NOT NULL DEFAULT 0.00,
  `loan` double(20,2) NOT NULL DEFAULT 0.00,
  `net_payable` double(20,2) NOT NULL DEFAULT 0.00,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `sales_price` double(20,2) NOT NULL DEFAULT 0.00,
  `discount_method` tinyint(4) DEFAULT NULL,
  `discount_rate` int(11) DEFAULT NULL,
  `discount` double(20,2) NOT NULL DEFAULT 0.00,
  `vat_tax` double(20,2) NOT NULL DEFAULT 0.00,
  `receiveable_amount` double(20,2) NOT NULL DEFAULT 0.00,
  `receive_amount` double(20,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `client_id`, `vendor_id`, `invoice_no`, `date`, `sales_price`, `discount_method`, `discount_rate`, `discount`, `vat_tax`, `receiveable_amount`, `receive_amount`, `note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, '0000001', '2024-09-07', 385000.00, 1, 10, 38500.00, 0.00, 346500.00, 326500.00, 'Sales to Customer', '0', 4, NULL, '2024-09-07 08:42:17', '2024-09-07 12:58:04'),
(2, 4, 7, '0000002', '2024-09-07', 625000.00, 1, 5, 31250.00, 0.00, 593750.00, 593750.00, 'Sales', '1', 4, NULL, '2024-09-07 09:27:25', '2024-09-07 09:27:25'),
(3, 4, 7, '0000003', '2024-09-29', 60000.00, 1, 5, 3000.00, 0.00, 57000.00, 57000.00, 'Sales to Jamal', '1', 4, NULL, '2024-09-29 12:12:13', '2024-09-29 12:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `sales_returns`
--

CREATE TABLE `sales_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `sales_id` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `refund_amount` double(20,2) NOT NULL,
  `note` text DEFAULT NULL,
  `return_status` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_returns`
--

INSERT INTO `sales_returns` (`id`, `client_id`, `vendor_id`, `invoice_no`, `sales_id`, `date`, `total_amount`, `refund_amount`, `note`, `return_status`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, '0000001', 1, '2024-09-07', 225000.00, 225000.00, NULL, '1', '1', 4, NULL, '2024-09-07 09:03:04', '2024-09-07 09:03:04'),
(2, 4, 7, '0000002', 2, '2024-09-07', 395000.00, 395000.00, 'Sales Return', '1', '1', 4, NULL, '2024-09-07 09:27:57', '2024-09-07 09:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_details`
--

CREATE TABLE `sales_return_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `sales_return_id` tinyint(4) NOT NULL,
  `product_id` tinyint(4) NOT NULL,
  `quantity_returned` double(20,2) NOT NULL,
  `return_reason` text DEFAULT NULL,
  `unit_price` double(20,2) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_return_details`
--

INSERT INTO `sales_return_details` (`id`, `client_id`, `sales_return_id`, `product_id`, `quantity_returned`, `return_reason`, `unit_price`, `amount`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 2, 5.00, NULL, 6000.00, 30000.00, 4, NULL, '2024-09-07 09:03:04', '2024-09-07 09:03:04'),
(2, 4, 1, 1, 3.00, NULL, 65000.00, 195000.00, 4, NULL, '2024-09-07 09:03:05', '2024-09-07 09:03:05'),
(3, 4, 2, 1, 3.00, NULL, 65000.00, 195000.00, 4, NULL, '2024-09-07 09:27:57', '2024-09-07 09:27:57'),
(4, 4, 2, 4, 2.00, NULL, 100000.00, 200000.00, 4, NULL, '2024-09-07 09:27:57', '2024-09-07 09:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `sales__details`
--

CREATE TABLE `sales__details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` double(20,2) NOT NULL,
  `unit_price` double(20,2) NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales__details`
--

INSERT INTO `sales__details` (`id`, `sales_id`, `product_id`, `quantity`, `unit_price`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5.00, 6000.00, 60000.00, '2024-09-07 08:42:18', '2024-09-07 09:03:05'),
(2, 1, 1, 2.00, 65000.00, 325000.00, '2024-09-07 08:42:18', '2024-09-07 09:03:05'),
(3, 2, 1, 2.00, 65000.00, 325000.00, '2024-09-07 09:27:25', '2024-09-07 09:27:57'),
(4, 2, 4, 1.00, 100000.00, 300000.00, '2024-09-07 09:27:25', '2024-09-07 09:27:57'),
(5, 3, 2, 10.00, 6000.00, 60000.00, '2024-09-29 12:12:13', '2024-09-29 12:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `stock_quantity` double(20,2) NOT NULL DEFAULT 0.00,
  `created_by_id` int(11) NOT NULL,
  `updated_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `client_id`, `product_id`, `date`, `stock_quantity`, `created_by_id`, `updated_date`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2024-08-21', 3.00, 4, '2024-09-07', '2024-08-21 11:29:07', '2024-09-08 08:14:42'),
(2, 4, 2, '2024-08-24', 10.00, 4, '2024-09-29', '2024-08-24 07:58:18', '2024-09-29 12:14:29'),
(3, 4, 3, '2024-08-24', 0.00, 4, '2024-09-07', '2024-08-24 07:59:18', '2024-09-07 05:37:17'),
(4, 4, 4, '2024-08-24', 4.00, 4, '2024-09-07', '2024-08-24 07:59:57', '2024-09-07 09:27:57'),
(5, 6, 5, '2024-09-03', 0.00, 6, '2024-09-03', '2024-09-03 10:14:25', '2024-09-03 11:23:11'),
(6, 6, 6, '2024-09-03', 0.00, 6, '2024-09-03', '2024-09-03 10:19:37', '2024-09-03 11:23:11'),
(7, 8, 7, '2024-09-04', 0.00, 8, '2024-09-04', '2024-09-04 05:55:21', '2024-09-04 13:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `stock_histories`
--

CREATE TABLE `stock_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `particular` varchar(255) DEFAULT NULL,
  `stock_in_qty` double(20,2) NOT NULL DEFAULT 0.00,
  `stock_out_qty` double(20,2) NOT NULL DEFAULT 0.00,
  `rate` double(20,2) NOT NULL DEFAULT 0.00,
  `current_stock` double(20,2) NOT NULL DEFAULT 0.00,
  `created_by_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `opening_payable` double(20,2) NOT NULL DEFAULT 0.00,
  `opening_receivable` double(20,2) NOT NULL DEFAULT 0.00,
  `current_balance` double(20,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `client_id`, `name`, `email`, `phone`, `address`, `organization`, `opening_payable`, `opening_receivable`, `current_balance`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'SM Enterprise', 'sm@gmail.com', '01847309892', 'Narayangonj', 'Gazi LTD', 0.00, 0.00, 0.00, '1', NULL, 4, '2024-08-31 05:29:30', '2024-08-31 05:31:15'),
(2, 4, 'Jaman Enterprise', 'jaman@gmail.com', '0123456', 'Gazipur', 'PRAN-RFL LTD', 0.00, 0.00, 0.00, '1', NULL, NULL, '2024-08-31 05:59:13', '2024-09-10 10:10:17'),
(3, 4, 'MS Traders', 'ms@gmail.com', '54641654165', 'Mirpur', 'MS LTD', 0.00, 0.00, 5875.00, '1', NULL, NULL, '2024-08-31 05:59:44', '2024-09-07 05:38:23'),
(4, 6, 'Muntaqim', 'muntaqim@gmail.com', '324324', 'Mirpur, Dhaka', 'Hosaf Group', 0.00, 0.00, 0.00, '1', NULL, NULL, '2024-09-03 10:22:10', '2024-09-03 11:00:00'),
(5, 6, 'Chabed Abdullah', 'chabed@gmail.com', '75332856', 'Mirpur, Dhaka', 'Green it', 0.00, 0.00, 0.00, '1', NULL, NULL, '2024-09-03 10:22:54', '2024-09-03 10:22:54'),
(6, 8, 'Kamal', 'Kamal@gmail.com', '55555', 'Chttrogram', 'Kamal Enterprise', 0.00, 0.00, 0.00, '1', NULL, NULL, '2024-09-04 05:57:14', '2024-09-04 06:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_ledgers`
--

CREATE TABLE `supplier_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `particular` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `debit_amount` double(20,2) NOT NULL DEFAULT 0.00,
  `credit_amount` double(20,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_ledgers`
--

INSERT INTO `supplier_ledgers` (`id`, `client_id`, `supplier_id`, `purchase_id`, `sales_id`, `payment_id`, `particular`, `date`, `debit_amount`, `credit_amount`, `note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, NULL, NULL, 'Purchase', '2024-09-07', 0.00, 1458000.00, 'Purchase from Jaman', 1, 4, NULL, '2024-09-07 05:28:13', '2024-09-07 05:28:13'),
(2, 0, 2, NULL, NULL, 1, 'Paid To Vendor', '2024-09-07', 1400000.00, 0.00, 'Purchase from Jaman', 1, 4, NULL, '2024-09-07 05:28:13', '2024-09-07 05:28:13'),
(4, 0, 2, NULL, NULL, 3, 'Paid To Vendor', '2024-09-07', 40000.00, 0.00, NULL, 1, 4, NULL, '2024-09-07 05:30:21', '2024-09-07 05:30:21'),
(5, 4, 3, 2, NULL, NULL, 'Purchase', '2024-09-07', 0.00, 885875.00, 'Purchase from MS Traders', 1, 4, NULL, '2024-09-07 05:37:17', '2024-09-07 05:37:17'),
(6, 0, 3, NULL, NULL, 4, 'Paid To Vendor', '2024-09-07', 800000.00, 0.00, 'Purchase from MS Traders', 1, 4, NULL, '2024-09-07 05:37:18', '2024-09-07 05:37:18'),
(7, 0, 3, NULL, NULL, 5, 'Paid To Vendor', '2024-09-07', 50000.00, 0.00, 'payment to MS Traders', 1, 4, NULL, '2024-09-07 05:37:59', '2024-09-07 05:37:59'),
(8, 0, 3, NULL, NULL, 6, 'Paid To Vendor', '2024-09-07', 30000.00, 0.00, 'payment to MS Traders', 1, 4, NULL, '2024-09-07 05:38:23', '2024-09-07 05:38:23'),
(9, 0, 2, NULL, NULL, 7, 'Paid To Vendor', '2024-09-08', 10000.00, 0.00, 'Add Payment', 1, 4, NULL, '2024-09-08 08:16:06', '2024-09-08 08:16:06'),
(10, 0, 2, NULL, NULL, 8, 'Paid To Vendor', '2024-09-10', 8000.00, 0.00, 'Paid to MS Traders', 1, 4, NULL, '2024-09-10 10:10:17', '2024-09-10 10:10:17'),
(11, 4, 3, 3, NULL, NULL, 'Purchase', '2024-09-29', 0.00, 99000.00, 'Purchase from MS Traders', 1, 4, NULL, '2024-09-29 12:14:29', '2024-09-29 12:14:29'),
(12, 0, 3, NULL, NULL, 9, 'Paid To Vendor', '2024-09-29', 99000.00, 0.00, 'Purchase from MS Traders', 1, 4, NULL, '2024-09-29 12:14:29', '2024-09-29 12:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_default` tinyint(4) DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `total_seat` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `is_available` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_default` tinyint(4) DEFAULT NULL,
  `unit_type` char(10) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `is_default`, `unit_type`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'pcs', 1, '2024-08-19 11:03:35', '2024-08-21 09:17:33'),
(2, NULL, NULL, 'ml', 1, '2024-08-19 11:03:49', '2024-08-19 11:03:49'),
(3, NULL, NULL, 'kg', 1, '2024-08-19 11:03:57', '2024-08-19 11:03:57'),
(4, NULL, NULL, 'gm', 1, '2024-08-19 11:04:03', '2024-08-19 11:04:03'),
(5, NULL, NULL, 'ltr', 1, '2024-08-19 11:04:15', '2024-08-19 11:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `default_address` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `opening_payable` double(20,2) NOT NULL DEFAULT 0.00,
  `opening_receivable` double(20,2) NOT NULL DEFAULT 0.00,
  `current_balance` double(20,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `client_id`, `name`, `email`, `phone`, `address`, `organization`, `opening_payable`, `opening_receivable`, `current_balance`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'Rahim', 'rahim@gmail.com', '694664', 'Mirpur, Dhaka', 'Rahim Enterprise', 0.00, 0.00, 0.00, '1', 4, 4, '2024-09-03 07:58:56', '2024-09-09 07:15:38'),
(2, 4, 'Karim', 'karim@gmail.com', '6546546', 'Gazipur, Dhaka', 'Karim Enterprise', 0.00, 0.00, 0.00, '1', 4, 4, '2024-09-03 07:59:42', '2024-09-09 07:17:19'),
(3, 4, 'Jabbar', 'jabbar@gmail.com', '55555', 'Savar, Dhaka', 'Jabbar Traders', 0.00, 0.00, 0.00, '1', 4, NULL, '2024-09-03 08:02:11', '2024-09-03 09:19:25'),
(4, 6, 'Kabul', 'kabul@gmail.com', '5255', 'Gazipur, Bangladesh', 'Walton', 0.00, 0.00, 0.00, '1', 6, NULL, '2024-09-03 10:20:35', '2024-09-03 11:24:36'),
(5, 6, 'Shakib', 'shakib@gmail.com', '546546546', 'Norshindi', 'Pran-RFL ltd', 0.00, 0.00, 0.00, '1', 6, NULL, '2024-09-03 10:21:29', '2024-09-03 10:21:29'),
(6, 8, 'Tuhin', 'tuhin@gmail.com', '55555', 'Malibag, Dhaka', 'tuhin enterprise', 0.00, 0.00, 0.00, '1', 8, NULL, '2024-09-04 06:36:11', '2024-09-04 06:41:35'),
(7, 4, 'Jamal', 'jamal@gmail.com', '1234567890', 'Khulna', NULL, 0.00, 0.00, 0.00, '1', 4, 4, '2024-09-05 13:27:13', '2024-09-09 07:17:45'),
(8, 4, 'Kamal', 'Kamal@gmail.com', '6465416364', 'Pabna', NULL, 0.00, 0.00, 0.00, '1', 4, NULL, '2024-09-05 13:29:25', '2024-09-05 13:29:25'),
(9, 4, 'Anam', 'anam@gmail.com', '01847309892', 'Madubpur', NULL, 0.00, 0.00, 0.00, '1', 4, NULL, '2024-09-05 13:29:59', '2024-09-05 13:29:59'),
(10, 4, 'Muntaqim', NULL, '0124578', 'Mirpur', NULL, 0.00, 0.00, 0.00, '1', 4, NULL, '2024-09-09 09:54:42', '2024-09-09 09:54:42');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_ledgers`
--

CREATE TABLE `vendor_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` tinyint(4) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `collection_id` int(11) DEFAULT NULL,
  `particular` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `debit_amount` double(20,2) NOT NULL DEFAULT 0.00,
  `credit_amount` double(20,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by_id` int(11) DEFAULT NULL,
  `updated_by_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_ledgers`
--

INSERT INTO `vendor_ledgers` (`id`, `client_id`, `vendor_id`, `purchase_id`, `sales_id`, `collection_id`, `particular`, `date`, `debit_amount`, `credit_amount`, `note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, NULL, 1, NULL, 'Sales', '2024-09-07', 0.00, 346500.00, 'Sales to Customer', 1, 4, NULL, '2024-09-07 08:42:18', '2024-09-07 08:42:18'),
(2, 4, NULL, NULL, NULL, 1, 'Receive From Vendor', '2024-09-07', 300000.00, 0.00, 'Sales to Customer', 1, 4, NULL, '2024-09-07 08:42:18', '2024-09-07 08:42:18'),
(3, 4, 7, NULL, 2, NULL, 'Sales', '2024-09-07', 0.00, 593750.00, 'Sales', 1, 4, NULL, '2024-09-07 09:27:25', '2024-09-07 09:27:25'),
(4, 4, 7, NULL, NULL, 2, 'Receive From Vendor', '2024-09-07', 593750.00, 0.00, 'Sales', 1, 4, NULL, '2024-09-07 09:27:26', '2024-09-07 09:27:26'),
(5, 4, NULL, NULL, NULL, 3, 'Receive From Vendor', '2024-09-07', 26500.00, 0.00, NULL, 1, 4, NULL, '2024-09-07 12:55:14', '2024-09-07 12:55:14'),
(6, 4, NULL, NULL, NULL, 4, 'Receive From Vendor', '2024-09-07', 26500.00, 0.00, NULL, 1, 4, NULL, '2024-09-07 12:58:04', '2024-09-07 12:58:04'),
(7, 4, 7, NULL, 3, NULL, 'Sales', '2024-09-29', 0.00, 57000.00, 'Sales to Jamal', 1, 4, NULL, '2024-09-29 12:12:13', '2024-09-29 12:12:13'),
(8, 4, 7, NULL, NULL, 5, 'Receive From Vendor', '2024-09-29', 57000.00, 0.00, 'Sales to Jamal', 1, 4, NULL, '2024-09-29 12:12:13', '2024-09-29 12:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_holidays`
--

CREATE TABLE `weekly_holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `saturday` tinyint(4) NOT NULL DEFAULT 0,
  `sunday` tinyint(4) NOT NULL DEFAULT 0,
  `monday` tinyint(4) NOT NULL DEFAULT 0,
  `tuesday` tinyint(4) NOT NULL DEFAULT 0,
  `wednesday` tinyint(4) NOT NULL DEFAULT 0,
  `thursday` tinyint(4) NOT NULL DEFAULT 0,
  `friday` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_processes`
--
ALTER TABLE `attendance_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_process_details`
--
ALTER TABLE `attendance_process_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_infos`
--
ALTER TABLE `basic_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_types`
--
ALTER TABLE `category_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_symbols`
--
ALTER TABLE `currency_symbols`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_details`
--
ALTER TABLE `expense_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_heads`
--
ALTER TABLE `expense_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `h_r_settings`
--
ALTER TABLE `h_r_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_items`
--
ALTER TABLE `issue_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_item_details`
--
ALTER TABLE `issue_item_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_installments`
--
ALTER TABLE `loan_installments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ppd_raw_materials`
--
ALTER TABLE `ppd_raw_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ppd_raw_materials_pp_id_foreign` (`pp_id`);

--
-- Indexes for table `pp_details`
--
ALTER TABLE `pp_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pp_details_pp_id_foreign` (`pp_id`),
  ADD KEY `pp_details_recipe_id_foreign` (`recipe_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_plans`
--
ALTER TABLE `production_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_requisitions`
--
ALTER TABLE `purchase_requisitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_requisition_details`
--
ALTER TABLE `purchase_requisition_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_requisition_details_purchase_requisition_id_foreign` (`purchase_requisition_id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe_details`
--
ALTER TABLE `recipe_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_details_recipe_id_foreign` (`recipe_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_processes`
--
ALTER TABLE `salary_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_process_temps`
--
ALTER TABLE `salary_process_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_returns`
--
ALTER TABLE `sales_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales__details`
--
ALTER TABLE `sales__details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_histories`
--
ALTER TABLE `stock_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_ledgers`
--
ALTER TABLE `supplier_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
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
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_ledgers`
--
ALTER TABLE `vendor_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_holidays`
--
ALTER TABLE `weekly_holidays`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_processes`
--
ALTER TABLE `attendance_processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_process_details`
--
ALTER TABLE `attendance_process_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basic_infos`
--
ALTER TABLE `basic_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category_types`
--
ALTER TABLE `category_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expense_details`
--
ALTER TABLE `expense_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `expense_heads`
--
ALTER TABLE `expense_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `h_r_settings`
--
ALTER TABLE `h_r_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_items`
--
ALTER TABLE `issue_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_item_details`
--
ALTER TABLE `issue_item_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_installments`
--
ALTER TABLE `loan_installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppd_raw_materials`
--
ALTER TABLE `ppd_raw_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pp_details`
--
ALTER TABLE `pp_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3450;

--
-- AUTO_INCREMENT for table `production_plans`
--
ALTER TABLE `production_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_requisitions`
--
ALTER TABLE `purchase_requisitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_requisition_details`
--
ALTER TABLE `purchase_requisition_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipe_details`
--
ALTER TABLE `recipe_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salary_processes`
--
ALTER TABLE `salary_processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_process_temps`
--
ALTER TABLE `salary_process_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_returns`
--
ALTER TABLE `sales_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales__details`
--
ALTER TABLE `sales__details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_histories`
--
ALTER TABLE `stock_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier_ledgers`
--
ALTER TABLE `supplier_ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendor_ledgers`
--
ALTER TABLE `vendor_ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `weekly_holidays`
--
ALTER TABLE `weekly_holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ppd_raw_materials`
--
ALTER TABLE `ppd_raw_materials`
  ADD CONSTRAINT `ppd_raw_materials_pp_id_foreign` FOREIGN KEY (`pp_id`) REFERENCES `production_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pp_details`
--
ALTER TABLE `pp_details`
  ADD CONSTRAINT `pp_details_pp_id_foreign` FOREIGN KEY (`pp_id`) REFERENCES `production_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pp_details_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_requisition_details`
--
ALTER TABLE `purchase_requisition_details`
  ADD CONSTRAINT `purchase_requisition_details_purchase_requisition_id_foreign` FOREIGN KEY (`purchase_requisition_id`) REFERENCES `purchase_requisitions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_details`
--
ALTER TABLE `recipe_details`
  ADD CONSTRAINT `recipe_details_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
