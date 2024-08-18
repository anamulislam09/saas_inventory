-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2024 at 05:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms_production`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `mobile`, `email`, `password`, `image`, `status`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Super Admin', 1, '01839317038', 'admin@gmail.com', '$2y$10$R2qagwHg3rLOrENQWxNPz.IXS3C1zRj35ucjbwy9NXDUQdqxYrf4O', 'admin-1719821099.jpeg', 1, '2023-12-26 12:52:57', '2024-07-14 08:37:45', 'aQQwHvort1fbTWSlzaMOOSLmCWd8ah4ZPie9ftRIuejmOjd4K6qa2lrqpx1e'),
(9, 'Nowab Shorif', 2, '01839317038', 'nowabshorif@gmail.com', '$2y$10$7evJlIyc9E8iiO2kbr2dGusQ8GtuGRvqyuVUkdJwEbI2kpZkBqZ8.', '', 1, '2024-04-17 13:20:43', '2024-07-03 08:09:43', '17Hb3jLUsQrfHoRruFQoH5GmqyNzizGQU6eXnKlmQfTi6er2Q6wj5KFnzVaf'),
(10, 'Malek Azad', 2, '01839317038', 'malekazad1980@gmail.com', '$2y$10$7evJlIyc9E8iiO2kbr2dGusQ8GtuGRvqyuVUkdJwEbI2kpZkBqZ8.', '', 1, '2024-05-11 05:36:24', '2024-07-03 08:09:49', 'hJ5HbX6CB6kDOnlYV6b1yp95PydRcA9aOY05xMcldu3pmjYHXB8CiSVx3Bvc'),
(12, 'Jamalia Webster', 2, '01839317038', 'hatezut@mailinator.com', '$2y$10$7evJlIyc9E8iiO2kbr2dGusQ8GtuGRvqyuVUkdJwEbI2kpZkBqZ8.', '', 1, '2024-07-03 08:09:27', '2024-07-03 13:40:27', NULL),
(13, 'Shorif', 4, '298375923', 'shorif@gmail.com', '$2y$10$L2u09HWmwvwB1pzeSeHr5.2Aq8lhf0uq1.ATPSev1qMKQAW700c5a', '', 1, '2024-07-13 11:25:46', '2024-07-13 11:25:46', 'XsL1QKd2Ydh3irPFqHuVaDEb3u6sWhPlGANwjxZid4bfp0dkMsX7VrMz5PBF'),
(14, 'Chef', 5, '76', 'hocil@mailinator.com', '$2y$10$Y0xYwHgkigZQf11.PLTy8ONWnVP8X/wRaX.fIwFC.NGjAGyuZJx0q', '', 1, '2024-07-29 09:27:41', '2024-07-29 09:27:41', 'cpRLZVvgAl88C5AtSl1cuhJCHAJnTGXGAz0LXMeoUjBi9xtizPUPo2dohwjT');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `created_by_id` int NOT NULL,
  `date` date NOT NULL,
  `in_at` datetime NOT NULL,
  `out_at` datetime DEFAULT NULL,
  `worked_hour` double(10,2) DEFAULT NULL,
  `over_time_hour` double(10,2) DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `created_by_id`, `date`, `in_at`, `out_at`, `worked_hour`, `over_time_hour`, `note`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2024-07-01', '2024-07-01 11:00:00', '2024-07-01 21:00:00', 8.00, 2.00, NULL, '2024-07-01 10:58:28', '2024-07-01 11:48:51'),
(2, 4, 1, '2024-07-01', '2024-07-01 10:00:00', '2024-07-01 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:28', '2024-07-01 11:48:51'),
(3, 7, 1, '2024-07-01', '2024-07-01 10:00:00', '2024-07-01 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:28', '2024-07-01 11:48:51'),
(4, 8, 1, '2024-07-01', '2024-07-01 10:00:00', '2024-07-01 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:28', '2024-07-01 11:48:51'),
(5, 1, 1, '2024-07-01', '2024-07-01 10:00:00', '2024-07-01 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:28', '2024-07-01 11:48:51'),
(6, 2, 1, '2024-07-01', '2024-07-01 10:00:00', '2024-07-01 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:28', '2024-07-01 11:48:51'),
(7, 6, 1, '2024-07-01', '2024-07-01 10:00:00', '2024-07-01 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:28', '2024-07-01 11:48:51'),
(8, 3, 1, '2024-07-01', '2024-07-01 10:00:00', '2024-07-01 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:28', '2024-07-01 11:48:51'),
(9, 9, 1, '2024-07-01', '2024-07-01 10:00:00', '2024-07-01 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:28', '2024-07-01 11:48:51'),
(10, 5, 1, '2024-07-02', '2024-07-02 10:00:00', '2024-07-02 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:39', '2024-07-01 10:58:39'),
(11, 4, 1, '2024-07-02', '2024-07-02 10:00:00', '2024-07-02 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:39', '2024-07-01 10:58:39'),
(12, 7, 1, '2024-07-02', '2024-07-02 10:00:00', '2024-07-02 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:39', '2024-07-01 10:58:39'),
(13, 8, 1, '2024-07-02', '2024-07-02 10:00:00', '2024-07-02 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:39', '2024-07-01 10:58:39'),
(14, 1, 1, '2024-07-02', '2024-07-02 10:00:00', '2024-07-02 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:39', '2024-07-01 10:58:39'),
(15, 2, 1, '2024-07-02', '2024-07-02 10:00:00', '2024-07-02 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:39', '2024-07-01 10:58:39'),
(16, 6, 1, '2024-07-02', '2024-07-02 10:00:00', '2024-07-02 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:39', '2024-07-01 10:58:39'),
(17, 3, 1, '2024-07-02', '2024-07-02 10:00:00', '2024-07-02 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:39', '2024-07-01 10:58:39'),
(18, 9, 1, '2024-07-02', '2024-07-02 10:00:00', '2024-07-02 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:58:39', '2024-07-01 10:58:39'),
(19, 5, 1, '2024-07-03', '2024-07-03 11:00:00', '2024-07-03 18:00:00', 7.00, 0.00, NULL, '2024-07-01 10:59:50', '2024-07-01 10:59:50'),
(20, 4, 1, '2024-07-03', '2024-07-03 10:00:00', '2024-07-03 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:59:50', '2024-07-01 10:59:50'),
(21, 7, 1, '2024-07-03', '2024-07-03 10:00:00', '2024-07-03 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:59:50', '2024-07-01 10:59:50'),
(22, 8, 1, '2024-07-03', '2024-07-03 10:00:00', '2024-07-03 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:59:50', '2024-07-01 10:59:50'),
(23, 1, 1, '2024-07-03', '2024-07-03 10:00:00', '2024-07-03 17:00:00', 7.00, 0.00, NULL, '2024-07-01 10:59:50', '2024-07-01 10:59:50'),
(24, 2, 1, '2024-07-03', '2024-07-03 10:00:00', '2024-07-03 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:59:50', '2024-07-01 10:59:50'),
(25, 6, 1, '2024-07-03', '2024-07-03 10:00:00', '2024-07-03 17:00:00', 7.00, 0.00, NULL, '2024-07-01 10:59:50', '2024-07-01 10:59:50'),
(26, 3, 1, '2024-07-03', '2024-07-03 10:00:00', '2024-07-03 15:00:00', 5.00, 0.00, NULL, '2024-07-01 10:59:50', '2024-07-01 10:59:50'),
(27, 9, 1, '2024-07-03', '2024-07-03 10:00:00', '2024-07-03 18:00:00', 8.00, 0.00, NULL, '2024-07-01 10:59:50', '2024-07-01 10:59:50'),
(28, 5, 1, '2024-07-04', '2024-07-04 10:00:00', '2024-07-04 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:21', '2024-07-01 11:32:21'),
(29, 4, 1, '2024-07-04', '2024-07-04 10:00:00', '2024-07-04 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:21', '2024-07-01 11:32:21'),
(30, 7, 1, '2024-07-04', '2024-07-04 10:00:00', '2024-07-04 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:21', '2024-07-01 11:32:21'),
(31, 8, 1, '2024-07-04', '2024-07-04 10:00:00', '2024-07-04 16:00:00', 6.00, 0.00, NULL, '2024-07-01 11:32:21', '2024-07-01 11:32:21'),
(32, 1, 1, '2024-07-04', '2024-07-04 10:00:00', '2024-07-04 16:00:00', 6.00, 0.00, NULL, '2024-07-01 11:32:21', '2024-07-01 11:32:21'),
(33, 2, 1, '2024-07-04', '2024-07-04 10:00:00', '2024-07-04 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:21', '2024-07-01 11:32:21'),
(34, 6, 1, '2024-07-04', '2024-07-04 10:00:00', '2024-07-04 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:21', '2024-07-01 11:32:21'),
(35, 3, 1, '2024-07-04', '2024-07-04 10:00:00', '2024-07-04 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:21', '2024-07-01 11:32:21'),
(36, 9, 1, '2024-07-04', '2024-07-04 10:00:00', '2024-07-04 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:21', '2024-07-01 11:32:21'),
(37, 5, 1, '2024-07-07', '2024-07-07 10:00:00', '2024-07-07 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:40', '2024-07-01 11:32:40'),
(38, 4, 1, '2024-07-07', '2024-07-07 10:00:00', '2024-07-07 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:40', '2024-07-01 11:32:40'),
(39, 7, 1, '2024-07-07', '2024-07-07 10:00:00', '2024-07-07 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:40', '2024-07-01 11:32:40'),
(40, 8, 1, '2024-07-07', '2024-07-07 10:00:00', '2024-07-07 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:40', '2024-07-01 11:32:40'),
(41, 1, 1, '2024-07-07', '2024-07-07 10:00:00', '2024-07-07 16:00:00', 6.00, 0.00, NULL, '2024-07-01 11:32:40', '2024-07-01 11:32:40'),
(42, 2, 1, '2024-07-07', '2024-07-07 10:00:00', '2024-07-07 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:40', '2024-07-01 11:32:40'),
(43, 6, 1, '2024-07-07', '2024-07-07 10:00:00', '2024-07-07 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:40', '2024-07-01 11:32:40'),
(44, 3, 1, '2024-07-07', '2024-07-07 10:00:00', '2024-07-07 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:40', '2024-07-01 11:32:40'),
(45, 9, 1, '2024-07-07', '2024-07-07 10:00:00', '2024-07-07 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:40', '2024-07-01 11:32:40'),
(46, 5, 1, '2024-07-08', '2024-07-08 10:00:00', '2024-07-08 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:55', '2024-07-01 11:32:55'),
(47, 4, 1, '2024-07-08', '2024-07-08 10:00:00', '2024-07-08 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:55', '2024-07-01 11:32:55'),
(48, 7, 1, '2024-07-08', '2024-07-08 10:00:00', '2024-07-08 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:55', '2024-07-01 11:32:55'),
(49, 8, 1, '2024-07-08', '2024-07-08 10:00:00', '2024-07-08 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:55', '2024-07-01 11:32:55'),
(50, 1, 1, '2024-07-08', '2024-07-08 10:00:00', '2024-07-08 17:00:00', 7.00, 0.00, NULL, '2024-07-01 11:32:55', '2024-07-01 11:32:55'),
(51, 2, 1, '2024-07-08', '2024-07-08 10:00:00', '2024-07-08 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:55', '2024-07-01 11:32:55'),
(52, 6, 1, '2024-07-08', '2024-07-08 10:00:00', '2024-07-08 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:55', '2024-07-01 11:32:55'),
(53, 3, 1, '2024-07-08', '2024-07-08 10:00:00', '2024-07-08 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:55', '2024-07-01 11:32:55'),
(54, 9, 1, '2024-07-08', '2024-07-08 10:00:00', '2024-07-08 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:32:55', '2024-07-01 11:32:55'),
(55, 5, 1, '2024-07-09', '2024-07-09 10:00:00', '2024-07-09 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:06', '2024-07-01 11:46:06'),
(56, 4, 1, '2024-07-09', '2024-07-09 10:00:00', '2024-07-09 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:06', '2024-07-01 11:46:06'),
(57, 7, 1, '2024-07-09', '2024-07-09 10:00:00', '2024-07-09 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:06', '2024-07-01 11:46:06'),
(58, 8, 1, '2024-07-09', '2024-07-09 10:00:00', '2024-07-09 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:06', '2024-07-01 11:46:06'),
(59, 1, 1, '2024-07-09', '2024-07-09 11:00:00', '2024-07-09 18:00:00', 7.00, 0.00, NULL, '2024-07-01 11:46:06', '2024-07-01 11:46:06'),
(60, 2, 1, '2024-07-09', '2024-07-09 10:00:00', '2024-07-09 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:06', '2024-07-01 11:46:06'),
(61, 6, 1, '2024-07-09', '2024-07-09 10:00:00', '2024-07-09 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:06', '2024-07-01 11:46:06'),
(62, 3, 1, '2024-07-09', '2024-07-09 10:00:00', '2024-07-09 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:06', '2024-07-01 11:46:06'),
(63, 9, 1, '2024-07-09', '2024-07-09 10:00:00', '2024-07-09 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:06', '2024-07-01 11:46:06'),
(64, 5, 1, '2024-07-10', '2024-07-10 10:00:00', '2024-07-10 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:30', '2024-07-01 11:47:05'),
(65, 4, 1, '2024-07-10', '2024-07-10 10:00:00', '2024-07-10 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:30', '2024-07-01 11:47:05'),
(66, 7, 1, '2024-07-10', '2024-07-10 10:00:00', '2024-07-10 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:30', '2024-07-01 11:47:05'),
(67, 8, 1, '2024-07-10', '2024-07-10 10:00:00', '2024-07-10 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:30', '2024-07-01 11:47:05'),
(68, 1, 1, '2024-07-10', '2024-07-11 10:00:00', '2024-07-10 17:00:00', -17.00, 0.00, NULL, '2024-07-01 11:46:30', '2024-07-01 11:47:05'),
(69, 2, 1, '2024-07-10', '2024-07-10 10:00:00', '2024-07-10 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:30', '2024-07-01 11:47:05'),
(70, 6, 1, '2024-07-10', '2024-07-10 10:00:00', '2024-07-10 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:30', '2024-07-01 11:47:05'),
(71, 3, 1, '2024-07-10', '2024-07-10 10:00:00', '2024-07-10 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:30', '2024-07-01 11:47:05'),
(72, 9, 1, '2024-07-10', '2024-07-10 10:00:00', '2024-07-10 18:00:00', 8.00, 0.00, NULL, '2024-07-01 11:46:30', '2024-07-01 11:47:05'),
(73, 1, 1, '2024-07-25', '2024-07-25 12:03:00', '2024-07-25 15:03:00', 3.00, 0.00, NULL, '2024-07-25 09:03:39', '2024-07-25 09:04:54'),
(74, 5, 1, '2024-07-25', '2024-07-25 10:00:00', '2024-07-25 18:00:00', 8.00, 0.00, NULL, '2024-07-25 09:04:54', '2024-07-25 09:04:54'),
(75, 4, 1, '2024-07-25', '2024-07-25 10:00:00', '2024-07-25 18:00:00', 8.00, 0.00, NULL, '2024-07-25 09:04:54', '2024-07-25 09:04:54'),
(76, 7, 1, '2024-07-25', '2024-07-25 10:00:00', '2024-07-25 18:00:00', 8.00, 0.00, NULL, '2024-07-25 09:04:54', '2024-07-25 09:04:54'),
(77, 8, 1, '2024-07-25', '2024-07-25 10:00:00', '2024-07-25 18:00:00', 8.00, 0.00, NULL, '2024-07-25 09:04:54', '2024-07-25 09:04:54'),
(78, 2, 1, '2024-07-25', '2024-07-25 10:00:00', '2024-07-25 18:00:00', 8.00, 0.00, NULL, '2024-07-25 09:04:54', '2024-07-25 09:04:54'),
(79, 6, 1, '2024-07-25', '2024-07-25 10:00:00', '2024-07-25 18:00:00', 8.00, 0.00, NULL, '2024-07-25 09:04:54', '2024-07-25 09:04:54'),
(80, 3, 1, '2024-07-25', '2024-07-25 10:00:00', '2024-07-25 18:00:00', 8.00, 0.00, NULL, '2024-07-25 09:04:54', '2024-07-25 09:04:54'),
(81, 9, 1, '2024-07-25', '2024-07-25 10:00:00', '2024-07-25 18:00:00', 8.00, 0.00, NULL, '2024-07-25 09:04:54', '2024-07-25 09:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_processes`
--

CREATE TABLE `attendance_processes` (
  `id` bigint UNSIGNED NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `month` tinyint NOT NULL,
  `total_working_days` int NOT NULL,
  `total_working_hours` double(10,2) NOT NULL,
  `created_by_id` int NOT NULL,
  `updated_by_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_processes`
--

INSERT INTO `attendance_processes` (`id`, `date`, `year`, `month`, `total_working_days`, `total_working_hours`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, '2024-07', 2024, 7, 20, 160.00, 1, 1, '2024-07-01 11:31:18', '2024-07-25 09:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_process_details`
--

CREATE TABLE `attendance_process_details` (
  `id` bigint UNSIGNED NOT NULL,
  `attendance_process_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `absent_days` int NOT NULL,
  `late_to_absent_days` int NOT NULL,
  `net_absent_days` int NOT NULL,
  `present_days` int NOT NULL,
  `leave_days` int NOT NULL,
  `net_present_days` int NOT NULL,
  `regular_hours_worked` double(10,2) NOT NULL DEFAULT '0.00',
  `overtime_hours` double(10,2) NOT NULL DEFAULT '0.00',
  `total_hours_worked` double(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_process_details`
--

INSERT INTO `attendance_process_details` (`id`, `attendance_process_id`, `employee_id`, `absent_days`, `late_to_absent_days`, `net_absent_days`, `present_days`, `leave_days`, `net_present_days`, `regular_hours_worked`, `overtime_hours`, `total_hours_worked`, `created_at`, `updated_at`) VALUES
(37, 1, 1, 11, 2, 13, 9, 0, 9, 35.00, 0.00, 35.00, '2024-07-25 09:09:37', '2024-07-25 09:09:37'),
(38, 1, 2, 11, 0, 11, 9, 0, 9, 72.00, 0.00, 72.00, '2024-07-25 09:09:37', '2024-07-25 09:09:37'),
(39, 1, 3, 11, 0, 11, 9, 0, 9, 69.00, 0.00, 69.00, '2024-07-25 09:09:37', '2024-07-25 09:09:37'),
(40, 1, 4, 11, 0, 11, 9, 0, 9, 72.00, 0.00, 72.00, '2024-07-25 09:09:37', '2024-07-25 09:09:37'),
(41, 1, 5, 11, 0, 11, 9, 0, 9, 71.00, 2.00, 73.00, '2024-07-25 09:09:37', '2024-07-25 09:09:37'),
(42, 1, 6, 11, 0, 11, 9, 0, 9, 71.00, 0.00, 71.00, '2024-07-25 09:09:37', '2024-07-25 09:09:37'),
(43, 1, 7, 11, 0, 11, 9, 0, 9, 72.00, 0.00, 72.00, '2024-07-25 09:09:37', '2024-07-25 09:09:37'),
(44, 1, 8, 11, 0, 11, 9, 0, 9, 70.00, 0.00, 70.00, '2024-07-25 09:09:37', '2024-07-25 09:09:37'),
(45, 1, 9, 11, 0, 11, 9, 0, 9, 72.00, 0.00, 72.00, '2024-07-25 09:09:37', '2024-07-25 09:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `basic_infos`
--

CREATE TABLE `basic_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `moto` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'footer-text',
  `phone1` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `favIcon` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_symbol` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `acceptPaymentType` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyRightName` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyRightLink` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '#',
  `mapLink` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `pinterest` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `linkedIn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_infos`
--

INSERT INTO `basic_infos` (`id`, `title`, `moto`, `phone1`, `phone2`, `email`, `address`, `logo`, `favIcon`, `currency_code`, `currency_symbol`, `acceptPaymentType`, `copyRightName`, `copyRightLink`, `mapLink`, `facebook`, `instagram`, `twitter`, `pinterest`, `linkedIn`, `created_at`, `updated_at`) VALUES
(1, 'RMS', 'Namkand sodales vel online best prices Amazon Check out ethnic wear, formal wear western wear Blood Pressure Rate Monito.', '458-965-3224', '458-965-3224', 'Support@info.Com', 'W898 RTower Stat, Suite 56 Brockland, CA 9622 United States.', 'logo-1710927898.jpg', 'favIcon-1710927898.jpg', 'EUR', '€', 'apt-1702371011.png', '<strong class=\"justify-content-center\">Copyright © 2024-2025 <a href=\"https://sysdevltd.com/\" target=\"_blank\">SYS DEV LTD.</a></strong><a href=\"https://sysdevltd.com/\" target=\"_blank\">&nbsp;</a> All rights reserved.', 'https://www.youtube.com/', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.096340089998!2d90.41232931081352!3d23.74394367858587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b889a0e3b047%3A0x35d210fbb5e92f48!2z4Ka44Ka_4Ka4IOCmoeCnh-CmrSDgprLgpr_gpq7gpr_gpp_gp4fgpqE!5e0!3m2!1sen!2sbd!4v1702803916155!5m2!1sen!2sbd\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'https://www.youtube.com/', 'https://www.youtube.com/', 'https://www.youtube.com/', 'https://www.youtube.com/', 'https://www.youtube.com/', '2023-12-12 09:09:15', '2024-07-03 12:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `accrual_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `benefits`
--

INSERT INTO `benefits` (`id`, `employee_id`, `code`, `description`, `accrual_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '10001', 'Tempor impedit qui', '1992-10-27', 1, '2024-05-12 12:59:33', '2024-05-13 06:58:51'),
(2, 1, '10001', 'Unde duis dolores pr', '2023-07-17', 0, '2024-05-12 12:59:33', '2024-05-13 06:58:51'),
(3, 1, '10001', 'Sunt omnis unde eum', '2003-10-13', 0, '2024-05-12 12:59:33', '2024-05-13 06:58:51'),
(4, 1, '10001', 'Fugiat fuga Dolores', '1972-01-19', 0, '2024-05-13 06:57:58', '2024-05-13 06:58:51'),
(5, 1, '10001', 'Sit rerum voluptate', '1991-01-21', 1, '2024-05-13 06:57:58', '2024-05-13 06:58:51'),
(6, 1, '10001', 'Enim enim culpa rep', '1972-11-05', 0, '2024-05-13 06:57:58', '2024-05-13 06:58:51'),
(7, 2, 'Iure a repellendus', 'Qui elit laudantium', '1981-02-06', 0, '2024-05-13 10:06:51', '2024-05-13 10:06:51'),
(8, 3, 'Ea dolore quia ab no', 'Illum consequatur', '2020-09-20', 0, '2024-05-13 10:07:07', '2024-05-13 10:07:07'),
(9, 4, 'Error nulla iusto cu', 'Aut animi quia repr', '2016-07-05', 0, '2024-05-13 10:07:25', '2024-05-13 10:07:25'),
(10, 5, 'Irure velit itaque i', 'Ipsum occaecat volu', '2004-02-19', 1, '2024-05-13 10:07:44', '2024-05-13 10:07:44'),
(11, 6, 'Non libero ea molest', 'Et aute rem quia mod', '1979-11-10', 1, '2024-05-13 12:18:28', '2024-05-13 12:18:28'),
(12, 7, 'Tempora placeat sit', 'Obcaecati velit impe', '2015-06-28', 0, '2024-05-16 07:09:24', '2024-05-16 07:09:24'),
(13, 8, 'Quis quidem ut moles', 'Assumenda odio cumqu', '2023-03-26', 1, '2024-05-16 07:13:08', '2024-05-16 07:13:08'),
(14, 8, 'Quasi aspernatur sae', 'Accusamus amet simi', '1988-12-10', 0, '2024-05-16 07:13:08', '2024-05-16 07:13:08'),
(15, 8, 'Non modi aperiam qua', 'Porro id molestiae', '2005-02-07', 1, '2024-05-16 07:13:08', '2024-05-16 07:13:08'),
(16, 9, 'Culpa velit quod dol', 'Nisi voluptate ad qu', '2008-08-31', 1, '2024-05-16 10:53:08', '2024-06-10 11:27:14'),
(17, 9, 'Consequatur Ex nobi', 'Quia harum voluptas', '2012-12-11', 0, '2024-05-16 10:53:08', '2024-05-16 10:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_cat_id` bigint DEFAULT '0',
  `cat_type_id` tinyint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_cat_id`, `cat_type_id`, `title`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 0, 2, 'Sandwiches', 'cat-1711001156.jpg', 1, '2024-03-21 06:05:56', '2024-03-21 06:05:56'),
(3, 0, 2, 'Burgers', 'cat-1711001247.jpg', 1, '2024-03-21 06:07:27', '2024-03-21 06:07:27'),
(5, 35, 2, 'Thai Soup', 'cat-1713619818.jpg', 1, '2024-03-21 06:07:53', '2024-06-26 13:21:56'),
(6, 0, 2, 'Pizzas', 'cat-1711001286.jpg', 1, '2024-03-21 06:08:06', '2024-03-21 06:08:06'),
(7, 0, 2, 'Pasta', 'cat-1711001299.jpg', 1, '2024-03-21 06:08:19', '2024-03-21 06:08:19'),
(9, 0, 2, 'Steaks', 'cat-1711001418.jpg', 1, '2024-03-21 06:10:18', '2024-03-21 06:10:18'),
(26, 0, 3, 'Fats and Oils', NULL, 1, '2024-04-22 11:18:36', '2024-07-07 13:44:59'),
(27, 0, 3, 'Grains', NULL, 1, '2024-04-22 11:19:21', '2024-07-07 13:45:29'),
(28, 0, 3, 'Other', NULL, 1, '2024-04-28 08:34:09', '2024-07-07 13:46:11'),
(35, 0, 2, 'Soup', NULL, 1, '2024-06-26 13:20:59', '2024-06-26 13:20:59'),
(36, 35, 2, 'Chinese Soup', NULL, 1, '2024-06-26 13:22:20', '2024-06-26 13:22:20'),
(37, 35, 2, 'Tomato soup', NULL, 1, '2024-06-26 13:23:23', '2024-06-26 13:23:23'),
(38, 35, 2, 'French onion soup', NULL, 1, '2024-06-26 13:25:06', '2024-06-26 13:25:06'),
(39, 0, 3, 'Meat', NULL, 1, '2024-07-07 13:21:22', '2024-07-07 13:33:48'),
(40, 0, 3, 'Vegetables', NULL, 1, '2024-07-07 13:23:48', '2024-07-07 13:38:16'),
(41, 39, 3, 'Chicken', NULL, 1, '2024-07-07 13:34:09', '2024-07-07 13:34:09'),
(42, 39, 3, 'Beef', NULL, 1, '2024-07-07 13:35:57', '2024-07-07 13:35:57'),
(43, 0, 3, 'Dairy Products', NULL, 1, '2024-07-07 13:42:44', '2024-07-07 13:42:44'),
(44, 27, 3, 'Rice', NULL, 1, '2024-07-07 13:46:42', '2024-07-07 13:46:42'),
(45, 27, 3, 'Flour', NULL, 1, '2024-07-07 13:46:55', '2024-07-07 13:46:55'),
(46, 0, 3, 'Bread and Bakery', NULL, 1, '2024-07-07 13:52:25', '2024-07-07 13:52:25'),
(47, 0, 3, 'Oil', NULL, 1, '2024-07-09 06:58:23', '2024-07-09 06:58:23'),
(48, 0, 2, 'Biriyani', NULL, 1, '2024-07-13 09:08:32', '2024-07-13 09:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `category_types`
--

CREATE TABLE `category_types` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_types`
--

INSERT INTO `category_types` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Trading', NULL, NULL),
(2, 'Production', NULL, NULL),
(3, 'Raw Material', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` int NOT NULL,
  `order_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_id` int DEFAULT NULL,
  `payment_method_id` int NOT NULL,
  `total_amount` double(20,2) DEFAULT NULL,
  `discount` double(20,2) DEFAULT NULL,
  `vat` double(20,2) DEFAULT NULL,
  `total_payable` double(20,2) NOT NULL DEFAULT '0.00',
  `paid_amount` double(20,2) NOT NULL DEFAULT '0.00',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payment_status` tinyint NOT NULL DEFAULT '1',
  `created_by_id` int NOT NULL,
  `approved_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `order_id`, `order_no`, `table_id`, `payment_method_id`, `total_amount`, `discount`, `vat`, `total_payable`, `paid_amount`, `note`, `payment_status`, `created_by_id`, `approved_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, '000001', 6, 1, 900.00, 0.00, NULL, 900.00, 900.00, NULL, 1, 1, 1, '2024-07-01 10:04:23', '2024-07-01 10:04:23'),
(2, 2, '000002', 6, 1, 600.00, 0.00, NULL, 600.00, 600.00, NULL, 1, 1, 1, '2024-07-02 12:53:33', '2024-07-01 12:53:33'),
(3, 3, '000003', 6, 1, 129.60, 0.00, NULL, 142.56, 142.56, NULL, 1, 1, 1, '2024-08-03 12:54:43', '2024-07-01 12:54:43'),
(4, 4, '000004', 6, 1, 300.00, 0.00, NULL, 300.00, 300.00, NULL, 1, 1, 1, '2024-07-05 12:55:29', '2024-07-01 12:55:29'),
(5, 5, '000005', 6, 1, 1800.00, 0.00, NULL, 1800.00, 1800.00, NULL, 1, 10, 10, '2024-07-01 15:04:35', '2024-07-01 15:04:35'),
(6, 8, '000008', 3, 1, 99.60, 0.00, NULL, 118.56, 118.56, NULL, 1, 1, 1, '2024-07-04 11:44:35', '2024-07-04 11:44:35'),
(7, 1, '000001', NULL, 2, 4760.00, NULL, NULL, 4998.00, 4998.00, NULL, 1, 1, 1, '2024-07-13 11:14:01', '2024-07-13 11:14:01'),
(8, 3, '000003', 6, 1, 1550.00, 0.00, NULL, 1627.50, 1627.50, NULL, 1, 1, 1, '2024-07-13 11:15:37', '2024-07-13 11:15:37'),
(9, 2, '000002', NULL, 1, 3500.00, NULL, NULL, 3675.00, 3675.00, NULL, 1, 1, 1, '2024-07-13 14:40:54', '2024-07-13 14:40:54'),
(10, 5, '000005', 6, 1, 750.00, 0.00, NULL, 787.50, 787.50, NULL, 1, 1, 1, '2024-07-14 10:07:20', '2024-07-14 10:07:20'),
(11, 12, '000012', 6, 1, 750.00, 37.50, NULL, 750.00, 750.00, NULL, 1, 1, 1, '2024-07-16 09:35:38', '2024-07-16 09:35:38'),
(12, 13, '000013', 6, 1, 750.00, 0.00, NULL, 787.50, 787.50, NULL, 1, 1, 1, '2024-07-16 09:38:23', '2024-07-16 09:38:23'),
(13, 14, '000014', 6, 1, 650.00, 0.00, NULL, 682.50, 682.50, NULL, 1, 1, 1, '2024-07-16 09:41:47', '2024-07-16 09:41:47'),
(14, 2, '000002', NULL, 1, 3500.00, NULL, NULL, 3675.00, 3675.00, NULL, 1, 1, 1, '2024-07-25 06:41:48', '2024-07-25 06:41:48'),
(15, 1, '000001', NULL, 1, 4760.00, NULL, NULL, 4998.00, 4998.00, NULL, 1, 1, 1, '2024-07-25 08:17:45', '2024-07-25 08:17:45'),
(16, 7, '000007', NULL, 1, 930.00, NULL, NULL, 976.50, 976.50, NULL, 1, 1, 1, '2024-07-25 08:18:25', '2024-07-25 08:18:25'),
(17, 16, '000016', 12, 1, 1280.00, 39.00, 64.00, 1305.00, 1305.00, NULL, 1, 1, 1, '2024-07-25 08:20:05', '2024-07-25 08:21:06'),
(18, 20, '000020', 6, 1, 3900.00, 5.00, NULL, 4090.00, 4090.00, NULL, 1, 1, 1, '2024-07-27 10:42:25', '2024-07-27 10:42:25'),
(19, 11, '000011', NULL, 1, 680.00, NULL, NULL, 714.00, 714.00, NULL, 1, 1, 1, '2024-07-28 07:07:58', '2024-07-28 07:07:58'),
(20, 10, '000010', NULL, 1, 930.00, NULL, NULL, 976.50, 976.50, NULL, 1, 1, 1, '2024-07-28 07:08:12', '2024-07-28 07:08:12'),
(21, 17, '000017', NULL, 1, 930.00, NULL, NULL, 976.50, 976.50, NULL, 1, 1, 1, '2024-07-28 09:47:21', '2024-07-28 09:47:21'),
(22, 41, '000041', 6, 3, 700.00, 0.00, NULL, 735.00, 735.00, NULL, 1, 1, 1, '2024-07-30 06:01:43', '2024-07-30 06:01:43'),
(23, 37, '000037', NULL, 1, 330.00, NULL, NULL, 346.50, 346.50, NULL, 1, 1, 1, '2024-07-31 08:20:48', '2024-07-31 08:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

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
  `id` int NOT NULL,
  `country` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(39) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
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
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Human Resource', NULL, '2024-05-06 09:59:00', '2024-05-06 09:59:00'),
(3, 'Delivery department', NULL, '2024-05-06 09:59:12', '2024-05-06 09:59:12'),
(4, 'Bartender', NULL, '2024-05-06 09:59:35', '2024-05-06 10:01:15'),
(5, 'Accounts', NULL, '2024-05-06 10:00:07', '2024-05-06 10:00:07'),
(6, 'Chef', NULL, '2024-05-06 10:01:25', '2024-05-06 10:01:25'),
(7, 'Server', NULL, '2024-05-06 10:01:35', '2024-05-06 10:01:35'),
(8, 'Food and Beverage Manager', NULL, '2024-05-06 10:01:47', '2024-05-06 10:01:47'),
(9, 'Dishwasher', NULL, '2024-05-06 10:02:11', '2024-05-06 10:02:11'),
(10, 'Cashier', NULL, '2024-05-06 10:02:22', '2024-05-06 10:02:22'),
(12, 'Manager', NULL, '2024-05-06 10:02:52', '2024-05-06 10:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Waiter', '[null]', '2024-05-06 07:51:18', '2024-05-12 11:02:35'),
(6, 'Sales Man', NULL, '2024-05-12 10:57:50', '2024-05-12 10:57:50'),
(7, 'Manager', NULL, '2024-05-12 10:58:22', '2024-05-12 10:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `title`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'General Manager', 12, '2024-05-06 10:04:29', '2024-05-06 10:04:29'),
(2, 'Restaurant Manager', 12, '2024-05-06 10:04:49', '2024-05-06 10:04:49'),
(3, 'Bar Manager', 12, '2024-05-06 10:05:30', '2024-05-06 10:05:30'),
(4, 'Kitchen Manager', 12, '2024-05-06 10:05:52', '2024-05-06 10:05:52'),
(5, 'Delivery', 3, '2024-05-06 10:09:05', '2024-05-06 10:09:05'),
(6, 'Accountant', 5, '2024-05-06 10:09:18', '2024-05-06 10:09:18'),
(7, 'Chef', 6, '2024-05-06 10:09:43', '2024-05-06 10:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int NOT NULL,
  `designation_id` int NOT NULL,
  `duty_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hire_date` date NOT NULL,
  `original_hire_date` date NOT NULL,
  `termination_date` date DEFAULT NULL,
  `termination_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `termination_voluntary` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `rehire_date` date DEFAULT NULL,
  `rate_type` enum('Hourly','Salary') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double(20,2) NOT NULL,
  `bonus` double(20,2) NOT NULL DEFAULT '0.00',
  `pay_frequency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_frequency_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `allocate_leave` int NOT NULL,
  `remaining_leave` int NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ethnic_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eeo_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ssn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_in_state` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `live_in_state` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cell_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emerg_cont` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `emerg_cont_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emerg_home_cont` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `emerg_cont_home_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emerg_work_cont` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `emerg_cont_work_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emerg_cont_relations` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `contact`, `country_id`, `state`, `city`, `zip`, `division_id`, `designation_id`, `duty_type`, `hire_date`, `original_hire_date`, `termination_date`, `termination_reason`, `termination_voluntary`, `rehire_date`, `rate_type`, `rate`, `bonus`, `pay_frequency`, `pay_frequency_desc`, `allocate_leave`, `remaining_leave`, `date_of_birth`, `gender`, `marital_status`, `ethnic_group`, `eeo_class`, `ssn`, `work_in_state`, `live_in_state`, `image`, `home_email`, `home_phone`, `cell_phone`, `business_email`, `business_phone`, `emerg_cont`, `emerg_cont_alt`, `emerg_home_cont`, `emerg_cont_home_alt`, `emerg_work_cont`, `emerg_cont_work_alt`, `emerg_cont_relations`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nowab Shorif', 'zaqu@mailinator.com', '17', '206', 'Sit aut fugit cupi', 'Sit aut ratione rati', '16789', 4, 3, 'Full Time', '2016-11-27', '2006-10-29', '2009-05-10', 'Provident esse cons', 'Yes', '1978-10-22', 'Hourly', 20000.00, 10000.00, 'Biweekly', 'Laborum quidem praes', 20, 10, '1988-02-21', 'Female', 'Other', 'Commodi hic aliqua', 'Eos odit sit aut ut', 'Nulla earum doloremq', 'Yes', 'Yes', 'emp-1715519149.jpg', 'lahit@mailinator.com', '37', '64', 'kenimaq@mailinator.com', '25', '44', '61', '40', '28', '87', '14', 'Id autem ab unde in', 1, '2024-05-12 12:59:33', '2024-06-23 05:50:13'),
(2, 'Price Rogers', 'widad@mailinator.com', '10', '159', 'Beatae aperiam id m', 'Porro aute est natu', '39056', 5, 6, 'Full Time', '1983-02-01', '1998-04-22', '2012-12-10', 'Qui eaque est sapie', 'No', '2005-05-04', 'Salary', 40000.00, 5500.00, 'Biweekly', 'Amet doloribus ut l', 15, 13, '1997-04-30', 'Male', 'Married', 'Laudantium soluta a', 'Est itaque molestia', 'Magni aperiam fugiat', 'Yes', 'Yes', NULL, 'casarerugu@mailinator.com', '44', '92', 'dovyramo@mailinator.com', '10', '4', '42', '11', '87', '71', '64', 'In fuga Doloribus c', 1, '2024-05-13 10:06:51', '2024-06-23 07:12:54'),
(3, 'Scarlet Hart', 'dyxowi@mailinator.com', '84', '108', 'Consectetur deserunt', 'Neque dolore do sed', '16841', 1, 6, 'Full Time', '1981-03-11', '1995-05-03', '2003-12-23', 'Quis praesentium ver', 'Yes', '1985-09-28', 'Salary', 50000.00, 2000.00, 'Weekly', 'Facere tenetur molli', 15, 15, '2000-08-14', 'Female', 'Single', 'Ex nemo optio volup', 'Adipisci repellendus', 'Ut beatae labore con', 'Yes', 'Yes', NULL, 'wupyhejib@mailinator.com', '12', '64', 'vylumymu@mailinator.com', '77', '45', '40', '17', '39', '14', '79', 'Temporibus voluptate', 1, '2024-05-13 10:07:07', '2024-06-23 07:16:42'),
(4, 'Brenna Alford', 'cujiqocyzi@mailinator.com', '100', '139', 'Alias magni id vero', 'Doloremque beatae cu', '43256', 6, 3, 'Full Time', '1983-06-13', '1977-09-20', '2008-11-14', 'Et ipsam quidem fuga', 'Yes', '2014-06-03', 'Salary', 35000.00, 3500.00, 'Weekly', 'Cillum necessitatibu', 15, 15, '2003-08-13', 'Male', 'Other', 'Dolorem odio dolore', 'Quis qui do est dolo', 'Tenetur illo fugit', 'Yes', 'Yes', NULL, 'wykacuwo@mailinator.com', '88', '91', 'xexefulaq@mailinator.com', '85', '72', '55', '19', '9', '63', '22', 'Reprehenderit enim n', 1, '2024-05-13 10:07:25', '2024-06-23 07:17:04'),
(5, 'Anamul Islam', 'mugyr@mailinator.com', '2', '100', 'Amet voluptatem Re', 'Delectus do hic vel', '51870', 3, 3, 'Full Time', '2023-02-21', '2000-01-26', '1987-07-29', 'Nulla voluptate in m', 'No', '2001-10-18', 'Salary', 15000.00, 7500.00, 'Monthly', 'In commodo proident', 15, 11, '1983-12-06', 'Male', 'Married', 'Aliqua Sint corpor', 'Aut eiusmod consecte', 'In magna nulla et do', 'Yes', 'Yes', NULL, 'munidaq@mailinator.com', '43', '18', 'kixo@mailinator.com', '7', '56', '33', '89', '49', '27', '50', 'Minim eum in tempor', 1, '2024-05-13 10:07:44', '2024-06-23 11:06:34'),
(6, 'Rashed Hossain', 'qosarez@mailinator.com', '01898734932', '6', 'Officiis rerum aperi', 'Earum dignissimos vo', '31759', 7, 7, 'Full Time', '2017-07-02', '1971-08-15', '2006-08-10', 'Repellendus Non ea', 'Yes', '1990-05-01', 'Salary', 35000.00, 8000.00, 'Biweekly', 'Voluptatum nihil dol', 30, 14, '1997-07-07', 'Male', 'Single', 'Distinctio Et animi', 'Nam quas illo sint', 'Irure nesciunt susc', 'Yes', 'Yes', NULL, 'rohyfydim@mailinator.com', '53', '20', 'tegewety@mailinator.com', '50', '56', '85', '71', '48', '85', '42', 'Cum mollitia maiores', 1, '2024-05-13 12:18:28', '2024-06-23 07:17:38'),
(7, 'Bruno Farrell', 'nicunori@mailinator.com', '33', '34', 'Voluptatem aspernat', 'Aperiam assumenda at', '55761', 6, 6, 'Full Time', '1996-12-03', '1990-08-20', '1991-02-11', 'Sunt aliquam est und', 'No', '1987-09-24', 'Salary', 50000.00, 2000.00, 'Annually', 'In facere culpa veli', 25, 24, '1999-10-21', 'Female', 'Widowed', 'Quia ab nemo facere', 'Dolor sed eaque mini', 'Qui earum quaerat do', 'Yes', 'Yes', NULL, 'zizadi@mailinator.com', '91', '58', 'xotyluw@mailinator.com', '30', '12', '23', '91', '53', '17', '98', 'Rem assumenda quia i', 1, '2024-05-16 07:09:24', '2024-06-23 07:17:50'),
(8, 'Karleigh Munoz', 'hyhojeroro@mailinator.com', '16', '74', 'Reprehenderit omnis', 'Maxime id qui quas c', '68246', 3, 7, 'Full Time', '1970-12-25', '2022-05-19', '1978-12-01', 'Autem expedita ut co', 'Yes', '2005-03-12', 'Salary', 50000.00, 7000.00, 'Monthly', 'Qui temporibus commo', 30, 26, '2005-10-30', 'Male', 'Other', 'Perspiciatis volupt', 'Do voluptatum illum', 'Anim dignissimos id', 'Yes', 'Yes', NULL, 'gajusiv@mailinator.com', '58', '65', 'sodyxihal@mailinator.com', '71', '28', '63', '40', '31', '77', '29', 'Ipsum quam deserunt', 1, '2024-05-16 07:13:08', '2024-06-23 07:18:01'),
(9, 'Sloane Bates', 'hyrehaner@mailinator.com', '38', '167', 'Quia libero do duis', 'Voluptate dolorum au', '27123', 7, 6, 'Full Time', '2005-01-30', '1970-12-18', '1980-05-16', 'Omnis magna est nece', 'Yes', '1998-09-16', 'Salary', 50000.00, 6000.00, 'Biweekly', 'Officia commodo qui', 12, 12, '1970-09-03', 'Male', 'Other', 'Possimus dolore dui', 'Reiciendis vero aliq', 'Nisi inventore volup', 'Yes', 'Yes', NULL, 'cicyb@mailinator.com', '92', '17', 'lutunetiv@mailinator.com', '9', '12', '82', '96', '95', '63', '23', 'Deleniti illum ipsa', 1, '2024-05-16 10:53:08', '2024-06-23 09:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `expense_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `expense_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_no`, `date`, `total_amount`, `expense_note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, '0000001', '2024-07-04', 20000.00, NULL, 1, 1, NULL, '2024-07-04 11:59:55', '2024-07-04 11:59:55'),
(2, '0000002', '2024-07-25', 45699.00, NULL, 1, 1, NULL, '2024-07-25 09:00:45', '2024-07-25 09:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `cat_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `cat_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Salary', 1, '2024-07-04 11:59:22', '2024-07-04 11:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `expense_details`
--

CREATE TABLE `expense_details` (
  `id` bigint UNSIGNED NOT NULL,
  `expense_id` int NOT NULL,
  `expense_cat_id` int NOT NULL,
  `expense_head_id` int NOT NULL,
  `amount` double(20,2) NOT NULL,
  `quantity` double(10,2) NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_details`
--

INSERT INTO `expense_details` (`id`, `expense_id`, `expense_cat_id`, `expense_head_id`, `amount`, `quantity`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 20000.00, 1.00, 'Cash', '2024-07-04 11:59:55', '2024-07-04 11:59:55'),
(2, 2, 1, 1, 45654.00, 1.00, NULL, '2024-07-25 09:00:45', '2024-07-25 09:00:45'),
(3, 2, 1, 1, 45.00, 1.00, NULL, '2024-07-25 09:00:45', '2024-07-25 09:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `expense_heads`
--

CREATE TABLE `expense_heads` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_heads`
--

INSERT INTO `expense_heads` (`id`, `title`, `code`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 'Noman', '222', 1, 1, NULL, '2024-07-04 11:59:34', '2024-07-04 11:59:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `occasion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `date`, `occasion`, `created_at`, `updated_at`) VALUES
(6, '2024-05-22', 'Budda Purnima', '2024-05-25 09:22:58', '2024-05-25 09:22:58'),
(7, '2024-05-01', 'May Day', '2024-05-25 09:22:58', '2024-05-25 09:22:58'),
(9, '2024-04-05', 'weekend getaway', '2024-05-25 10:35:08', '2024-05-25 10:35:08'),
(10, '2024-04-12', 'weekend getaway', '2024-05-25 10:35:08', '2024-05-25 10:35:08'),
(11, '2024-04-19', 'weekend getaway', '2024-05-25 10:35:08', '2024-05-25 10:35:08'),
(12, '2024-04-26', 'weekend getaway', '2024-05-25 10:35:08', '2024-05-25 10:35:08'),
(18, '2024-06-17', 'Eid Ul Adha', '2024-06-01 06:45:13', '2024-06-01 06:45:13'),
(20, '2024-06-18', 'Eid Ul Adha', '2024-06-01 06:45:13', '2024-06-01 06:45:13'),
(21, '2024-07-23', 'fghfgh', '2024-07-25 09:03:13', '2024-07-25 09:03:13'),
(22, '2024-07-24', 'fghdg', '2024-07-25 09:03:13', '2024-07-25 09:03:13'),
(23, '2024-07-25', 'fhdffd', '2024-07-25 09:03:13', '2024-07-25 09:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `h_r_settings`
--

CREATE TABLE `h_r_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `office_start_at` time NOT NULL DEFAULT '10:00:00',
  `office_end_at` time NOT NULL DEFAULT '18:00:00',
  `daily_work_hour` int NOT NULL DEFAULT '8',
  `overtime_rate` double(10,3) NOT NULL DEFAULT '1.000',
  `equivalent_absences` tinyint NOT NULL DEFAULT '3',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `h_r_settings`
--

INSERT INTO `h_r_settings` (`id`, `office_start_at`, `office_end_at`, `daily_work_hour`, `overtime_rate`, `equivalent_absences`, `created_at`, `updated_at`) VALUES
(1, '10:00:00', '18:00:00', 8, 1.500, 3, NULL, '2024-06-23 11:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `issue_items`
--

CREATE TABLE `issue_items` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `total_price` double(20,2) NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_items`
--

INSERT INTO `issue_items` (`id`, `invoice_no`, `date`, `total_price`, `note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, '0000001', '2024-07-25', 900.00, NULL, '1', 1, NULL, '2024-07-25 08:54:27', '2024-07-25 08:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `issue_item_details`
--

CREATE TABLE `issue_item_details` (
  `id` bigint UNSIGNED NOT NULL,
  `issue_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` double(20,2) NOT NULL,
  `unit_price` double(20,2) NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_item_details`
--

INSERT INTO `issue_item_details` (`id`, `issue_id`, `item_id`, `quantity`, `unit_price`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1.00, 766.00, 766.00, '2024-07-25 08:54:27', '2024-07-25 08:54:27'),
(2, 1, 6, 1.00, 67.00, 67.00, '2024-07-25 08:54:27', '2024-07-25 08:54:27'),
(3, 1, 1, 1.00, 67.00, 67.00, '2024-07-25 08:54:27', '2024-07-25 08:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `cat_type_id` tinyint NOT NULL,
  `cat_id` int NOT NULL,
  `sub_cat_id` int DEFAULT NULL,
  `unit_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` double(20,2) DEFAULT '0.00',
  `price` double(20,2) DEFAULT '0.00',
  `vat` double(5,2) NOT NULL DEFAULT '0.00',
  `sold_qty` double(20,2) NOT NULL DEFAULT '0.00',
  `opening_stock` double(20,2) DEFAULT '0.00',
  `current_stock` double(20,2) DEFAULT '0.00',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `cat_type_id`, `cat_id`, `sub_cat_id`, `unit_id`, `title`, `description`, `image`, `cost`, `price`, `vat`, `sold_qty`, `opening_stock`, `current_stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 39, 41, 1, 'Chicken Kima', NULL, NULL, 400.00, NULL, 0.00, 0.00, 10.00, 79.00, 1, '2024-07-07 13:22:29', '2024-07-25 08:55:16'),
(2, 3, 40, NULL, 1, 'Onion', NULL, NULL, 100.00, NULL, 0.00, 0.00, 10.00, 38.30, 1, '2024-07-07 13:24:43', '2024-07-25 08:55:02'),
(3, 3, 40, NULL, 1, 'Tomato', NULL, NULL, 100.00, NULL, 0.00, 0.00, 10.00, 38.50, 1, '2024-07-07 13:37:10', '2024-07-25 08:55:02'),
(4, 3, 40, NULL, 1, 'Lettuce', NULL, NULL, 100.00, NULL, 0.00, 0.00, 10.00, 34.00, 1, '2024-07-07 13:37:58', '2024-07-25 08:37:06'),
(5, 3, 40, NULL, 1, 'Pepper', NULL, NULL, 100.00, NULL, 0.00, 0.00, 5.00, 58.00, 1, '2024-07-07 13:39:13', '2024-07-25 08:55:16'),
(6, 3, 43, NULL, 1, 'Cheese', NULL, NULL, 1000.00, NULL, 0.00, 0.00, 5.00, 34.00, 1, '2024-07-07 13:44:14', '2024-07-25 08:54:27'),
(7, 3, 39, 42, 1, 'Beef', NULL, NULL, 1000.00, NULL, 0.00, 0.00, 5.00, 74.00, 1, '2024-07-07 13:51:00', '2024-07-25 08:55:02'),
(8, 3, 46, NULL, 7, 'Burger Buns', NULL, NULL, 20.00, NULL, 0.00, 0.00, 100.00, 271.00, 1, '2024-07-07 13:53:59', '2024-07-25 08:37:06'),
(9, 2, 3, NULL, 7, 'Chicken Burger', NULL, NULL, 60.00, 250.00, 5.00, 0.00, NULL, NULL, 1, '2024-07-08 11:37:40', '2024-07-16 07:10:47'),
(10, 2, 3, NULL, 7, 'Beef Burger', NULL, NULL, 80.00, 250.00, 5.00, 0.00, NULL, NULL, 1, '2024-07-08 11:38:28', '2024-07-16 07:10:56'),
(11, 2, 6, NULL, 7, 'Beef Pizza', NULL, NULL, 210.00, 350.00, 5.00, 0.00, NULL, NULL, 1, '2024-07-08 11:39:22', '2024-07-16 07:10:52'),
(12, 3, 47, NULL, 3, 'Soa bin Oil', NULL, NULL, 200.00, NULL, 0.00, 0.00, 10.00, 12.00, 1, '2024-07-09 06:59:04', '2024-07-25 08:55:16'),
(13, 2, 48, NULL, 7, 'Beef Tehari', NULL, NULL, 114.10, 150.00, 5.00, 0.00, NULL, NULL, 1, '2024-07-13 09:09:19', '2024-07-16 07:10:22'),
(14, 3, 27, 44, 1, 'Polau Rice', NULL, NULL, 120.00, NULL, 0.00, 0.00, 0.00, 50.00, 1, '2024-07-13 09:11:00', '2024-07-25 08:34:48'),
(15, 2, 48, NULL, 7, 'Chicken Polau', NULL, NULL, 56.00, 180.00, 5.00, 0.00, NULL, NULL, 1, '2024-07-13 09:14:04', '2024-07-16 07:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint UNSIGNED NOT NULL,
  `leave_taken_by_id` int NOT NULL,
  `handover_to_id` int NOT NULL,
  `created_by_id` int DEFAULT NULL,
  `approved_by_id` int DEFAULT NULL,
  `leave_type_id` int DEFAULT NULL,
  `application_start_date` date NOT NULL,
  `application_end_date` date NOT NULL,
  `approved_start_date` date NOT NULL,
  `approved_end_date` date NOT NULL,
  `application_days` int NOT NULL,
  `approved_days` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_days` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `leave_days`, `created_at`, `updated_at`) VALUES
(3, 'Casual Leave', 18, '2024-05-14 10:43:46', '2024-05-14 10:54:40'),
(4, 'Sick', 15, '2024-05-14 10:47:36', '2024-05-14 10:53:33'),
(5, 'Medical', 12, '2024-05-14 10:54:56', '2024-05-14 10:54:56'),
(6, 'Emergency Leave', 10, '2024-05-18 12:30:39', '2024-05-18 12:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `approved_by_id` int DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `loan_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_date` date NOT NULL,
  `approved_date` date NOT NULL,
  `repayment_from` date NOT NULL,
  `amount` double(20,2) NOT NULL,
  `interest_percent` int NOT NULL,
  `installment_period` int NOT NULL,
  `repayment_total` double(20,2) NOT NULL,
  `installment` double(20,2) NOT NULL,
  `paid_amount` double(20,2) NOT NULL,
  `payment_status` tinyint NOT NULL COMMENT '0 = Not Paid, 1 = Paid',
  `approve_status` tinyint NOT NULL COMMENT '0 = Pending, 1 = Approved, -1 = Cancelled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `employee_id`, `approved_by_id`, `created_by_id`, `updated_by_id`, `loan_details`, `application_date`, `approved_date`, `repayment_from`, `amount`, `interest_percent`, `installment_period`, `repayment_total`, `installment`, `paid_amount`, `payment_status`, `approve_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, '34', '2024-07-04', '2024-07-12', '2024-08-01', 10000.00, 10, 5, 11000.00, 2200.00, 2200.00, 0, 0, '2024-07-04 13:07:45', '2024-07-25 09:09:04'),
(2, 1, 1, 1, NULL, 'ryrt', '2024-07-24', '2024-07-26', '2024-08-01', 50000.00, 5, 5, 52500.00, 10500.00, 10500.00, 0, 0, '2024-07-25 09:08:27', '2024-07-25 09:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `loan_installments`
--

CREATE TABLE `loan_installments` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` int NOT NULL,
  `amount` double(20,2) NOT NULL,
  `year_month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` date NOT NULL,
  `payment_status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_installments`
--

INSERT INTO `loan_installments` (`id`, `loan_id`, `amount`, `year_month`, `payment_date`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2200.00, '2024-08', '2024-08-01', 1, '2024-07-04 13:07:45', '2024-07-25 09:09:04'),
(2, 1, 2200.00, '2024-09', '2024-09-01', 0, '2024-07-04 13:07:45', '2024-07-04 13:07:45'),
(3, 1, 2200.00, '2024-10', '2024-10-01', 0, '2024-07-04 13:07:45', '2024-07-04 13:07:45'),
(4, 1, 2200.00, '2024-11', '2024-11-01', 0, '2024-07-04 13:07:45', '2024-07-04 13:07:45'),
(5, 1, 2200.00, '2024-12', '2024-12-01', 0, '2024-07-04 13:07:45', '2024-07-04 13:07:45'),
(6, 2, 10500.00, '2024-08', '2024-08-01', 1, '2024-07-25 09:08:27', '2024-07-25 09:09:04'),
(7, 2, 10500.00, '2024-09', '2024-09-01', 0, '2024-07-25 09:08:27', '2024-07-25 09:08:27'),
(8, 2, 10500.00, '2024-10', '2024-10-01', 0, '2024-07-25 09:08:27', '2024-07-25 09:08:27'),
(9, 2, 10500.00, '2024-11', '2024-11-01', 0, '2024-07-25 09:08:27', '2024-07-25 09:08:27'),
(10, 2, 10500.00, '2024-12', '2024-12-01', 0, '2024-07-25 09:08:27', '2024-07-25 09:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `menu_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `menu_name`, `route`, `created_at`, `updated_at`) VALUES
(1, 159, 'Manager Dashboard', 'manager-dashboard', '2024-07-03 14:21:36', '2024-07-14 12:05:37'),
(2, 1, 'My Today\'s Orders', NULL, '2024-07-03 14:45:49', '2024-07-03 14:45:49'),
(3, 1, 'Pending Orders', NULL, '2024-07-03 15:17:08', '2024-07-03 15:17:08'),
(4, 1, 'Pending Collections', NULL, '2024-07-03 15:17:19', '2024-07-03 15:17:19'),
(5, 1, 'Pending In Kitchen', NULL, '2024-07-03 15:17:32', '2024-07-03 15:17:32'),
(6, 1, 'Today\'s Orders', NULL, '2024-07-03 15:17:55', '2024-07-03 15:17:55'),
(7, 1, 'Today\'s Collections', NULL, '2024-07-03 15:18:09', '2024-07-03 15:18:09'),
(8, 1, 'Weekly Collections', NULL, '2024-07-03 15:18:18', '2024-07-03 15:18:18'),
(9, 1, 'Monthly Collections', NULL, '2024-07-03 15:18:34', '2024-07-03 15:18:34'),
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
(24, 0, 'Foods', NULL, '2024-07-04 10:47:18', '2024-07-04 10:47:18'),
(25, 24, 'Category', 'categories.index', '2024-07-04 10:48:46', '2024-07-04 10:48:46'),
(26, 25, 'Add', 'categories.create', '2024-07-04 10:49:19', '2024-07-04 10:49:19'),
(27, 25, 'Edit', 'categories.edit', '2024-07-04 10:49:46', '2024-07-04 10:49:46'),
(28, 25, 'Delete', 'categories.destroy', '2024-07-04 10:50:14', '2024-07-04 10:50:14'),
(29, 24, 'Sub Category', 'sub-categories.index', '2024-07-04 10:51:15', '2024-07-04 10:51:15'),
(30, 29, 'Add', 'sub-categories.create', '2024-07-04 10:52:03', '2024-07-04 10:52:03'),
(31, 29, 'Edit', 'sub-categories.edit', '2024-07-04 10:52:18', '2024-07-04 10:52:18'),
(32, 29, 'Delete', 'sub-categories.destroy', '2024-07-04 10:52:35', '2024-07-04 10:52:35'),
(33, 24, 'Items', 'items.index', '2024-07-04 10:53:55', '2024-07-04 10:53:55'),
(34, 33, 'Add', 'items.create', '2024-07-04 10:54:22', '2024-07-04 10:54:22'),
(35, 33, 'Edit', 'items.edit', '2024-07-04 10:54:47', '2024-07-04 10:54:47'),
(36, 33, 'Delete', 'items.destroy', '2024-07-04 10:55:50', '2024-07-04 10:55:50'),
(37, 160, 'Units', 'units.index', '2024-07-04 10:58:07', '2024-07-25 09:14:54'),
(38, 37, 'Add', 'units.create', '2024-07-04 10:59:06', '2024-07-04 10:59:06'),
(39, 37, 'Edit', 'units.edit', '2024-07-04 10:59:44', '2024-07-04 10:59:44'),
(40, 37, 'Delete', 'units.destroy', '2024-07-04 11:00:01', '2024-07-04 11:00:01'),
(41, 161, 'Purchase', 'purchases.index', '2024-07-04 11:03:00', '2024-07-14 12:04:03'),
(42, 41, 'Add', 'purchases.create', '2024-07-04 11:03:10', '2024-07-04 11:03:10'),
(43, 41, 'Edit', 'purchases.edit', '2024-07-04 11:03:19', '2024-07-04 11:03:19'),
(45, 41, 'View', 'purchases.vouchar', '2024-07-04 11:04:32', '2024-07-04 11:04:32'),
(46, 41, 'Print', 'purchases.vouchar.print', '2024-07-04 11:06:17', '2024-07-04 11:06:17'),
(47, 41, 'Add Payment', 'purchases.payment.store', '2024-07-04 11:07:20', '2024-07-04 11:07:20'),
(48, 45, 'Delete Payment', 'purchases.payment.destroy', '2024-07-04 11:12:18', '2024-07-04 11:12:18'),
(49, 161, 'Issue Items', 'issue-items.index', '2024-07-04 11:21:49', '2024-07-14 12:02:23'),
(50, 49, 'Add', 'issue-items.create', '2024-07-04 11:22:59', '2024-07-04 11:22:59'),
(51, 49, 'View', 'issue-items.invoice', '2024-07-04 11:23:24', '2024-07-04 11:23:24'),
(52, 49, 'Print', 'issue-items.invoice.print', '2024-07-04 11:23:43', '2024-07-04 11:23:43'),
(53, 0, 'POS', NULL, '2024-07-04 11:24:41', '2024-07-14 09:30:02'),
(54, 53, 'Orders', 'orders.index', '2024-07-04 11:25:08', '2024-07-04 11:25:08'),
(55, 53, 'Pending Orders', 'orders.pending', '2024-07-04 11:26:36', '2024-07-04 11:26:36'),
(56, 53, 'Cancelled Orders', 'orders.cancelled', '2024-07-04 11:27:21', '2024-07-04 11:27:21'),
(57, 56, 'Delete', 'orders.destroy', '2024-07-04 11:28:13', '2024-07-04 11:28:13'),
(58, 56, 'Resume', 'orders.resume', '2024-07-04 11:28:30', '2024-07-04 11:28:30'),
(59, 55, 'Approve', 'orders.approve', '2024-07-04 11:29:17', '2024-07-04 11:29:17'),
(60, 55, 'Cancel', 'orders.cancel', '2024-07-04 11:29:45', '2024-07-04 11:29:45'),
(61, 54, 'Add', 'orders.create', '2024-07-04 11:31:44', '2024-07-04 11:31:44'),
(62, 54, 'Edit', 'orders.edit', '2024-07-04 11:32:03', '2024-07-04 11:32:03'),
(63, 54, 'View', 'orders.invoice', '2024-07-04 11:32:24', '2024-07-04 11:32:24'),
(64, 54, 'Print', 'orders.print', '2024-07-04 11:32:40', '2024-07-04 11:32:40'),
(65, 159, 'Kitchen Dashboard', 'kitchen.index', '2024-07-04 11:37:33', '2024-07-31 10:08:47'),
(66, 65, 'Control Order', 'kitchen.update.status', '2024-07-04 11:38:26', '2024-07-04 11:38:26'),
(67, 53, 'Collections', 'collections.index', '2024-07-04 11:39:58', '2024-07-14 09:32:10'),
(68, 67, 'Save Payment', 'collections.store', '2024-07-04 11:40:44', '2024-07-04 11:40:44'),
(69, 67, 'Cancel Order', 'collections.orders.cancel', '2024-07-04 11:41:06', '2024-07-04 11:41:06'),
(70, 161, 'Payments', 'payments.index', '2024-07-04 11:41:33', '2024-07-14 12:03:42'),
(71, 70, 'Add', 'payments.create', '2024-07-04 11:42:59', '2024-07-04 11:42:59'),
(72, 53, 'Manual Bills', 'manual-bills.index', '2024-07-04 11:44:14', '2024-07-14 09:39:41'),
(73, 72, 'Add', 'manual-bills.create', '2024-07-04 11:52:21', '2024-07-04 11:52:21'),
(74, 72, 'Edit', 'manual-bills.edit', '2024-07-04 11:52:43', '2024-07-04 11:52:43'),
(76, 72, 'Complete Order', 'manual-bills.complete', '2024-07-04 11:55:50', '2024-07-04 11:55:50'),
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
(108, 107, 'Supplier Ledgers', 'reports.supplier-ledgers', '2024-07-04 12:56:13', '2024-07-04 12:57:02'),
(109, 107, 'Stock Reports', 'reports.stocks', '2024-07-04 12:57:49', '2024-07-04 12:57:49'),
(110, 107, 'Collections Report', 'reports.collections', '2024-07-04 12:58:38', '2024-07-04 12:58:38'),
(111, 0, 'Human Resource', NULL, '2024-07-04 12:59:47', '2024-07-04 12:59:47'),
(113, 111, 'Setup', NULL, '2024-07-04 13:00:20', '2024-07-14 12:43:47'),
(114, 111, 'Attendance', NULL, '2024-07-04 13:00:49', '2024-07-04 13:00:56'),
(115, 111, 'Leave', NULL, '2024-07-04 13:01:32', '2024-07-04 13:01:32'),
(116, 111, 'Loan', NULL, '2024-07-04 13:01:55', '2024-07-04 13:01:55'),
(117, 111, 'Payrolls', NULL, '2024-07-04 13:02:11', '2024-07-04 13:02:11'),
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
(161, 0, 'Inventory', NULL, '2024-07-14 10:23:02', '2024-07-14 10:23:02'),
(162, 161, 'Setup', NULL, '2024-07-14 10:23:52', '2024-07-14 10:23:52'),
(163, 162, 'Recipe Manage', 'recipes.index', '2024-07-14 11:50:27', '2024-07-14 11:50:27'),
(164, 163, 'Add', 'recipes.create', '2024-07-14 11:50:46', '2024-07-14 11:50:58'),
(165, 163, 'Edit', 'recipes.edit', '2024-07-14 11:51:10', '2024-07-14 11:51:10'),
(166, 163, 'Delete', 'recipes.destroy', '2024-07-14 11:51:25', '2024-07-14 11:51:25'),
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
(178, 0, 'Delivery Manage', NULL, '2024-07-25 09:16:43', '2024-07-25 09:16:43'),
(179, 178, 'Customers', 'customers.index', '2024-07-25 09:17:03', '2024-07-25 09:17:03'),
(180, 179, 'Add', 'customers.create', '2024-07-25 09:17:54', '2024-07-25 09:17:54'),
(181, 179, 'Edit', 'customers.edit', '2024-07-25 09:18:13', '2024-07-25 09:18:13'),
(182, 179, 'Delete', 'customers.destroy', '2024-07-25 09:18:38', '2024-07-25 09:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(99, '2024_04_21_154700_create_suppliers_table', 41),
(104, '2024_04_21_174416_create_purchases_table', 42),
(105, '2024_04_21_190732_create_purchase_details_table', 42),
(106, '2024_04_22_164354_create_category_types_table', 43),
(112, '2024_04_28_130402_create_issue_items_table', 45),
(113, '2024_04_28_130413_create_issue_item_details_table', 45),
(114, '2024_04_28_171201_create_payments_table', 46),
(115, '2024_04_28_171225_create_supplier_ledgers_table', 46),
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
(165, '2024_03_31_125724_create_collections_table', 66),
(167, '2024_04_27_130014_create_stock_histories_table', 67),
(177, '2024_07_08_155705_create_recipes_table', 68),
(178, '2024_07_08_155722_create_recipe_details_table', 68),
(188, '2024_07_08_155814_create_production_plans_table', 69),
(189, '2024_07_08_155914_create_pp_details_table', 69),
(190, '2024_07_08_155954_create_ppd_raw_materials_table', 69),
(197, '2024_07_10_181438_create_purchase_requisitions_table', 70),
(198, '2024_07_10_181446_create_purchase_requisition_details_table', 70);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `table_id` int NOT NULL,
  `order_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trade_price` double(20,2) NOT NULL DEFAULT '0.00',
  `mrp` double(20,2) NOT NULL DEFAULT '0.00',
  `discount` double(20,2) NOT NULL DEFAULT '0.00',
  `vat` double(20,2) NOT NULL DEFAULT '0.00',
  `net_bill` double(20,2) NOT NULL DEFAULT '0.00',
  `paid_amount` double(20,2) NOT NULL DEFAULT '0.00',
  `profit` double(20,2) NOT NULL DEFAULT '0.00',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payment_status` tinyint NOT NULL DEFAULT '1',
  `order_status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending,1=Approved,2=Cancelled,3=Processing,4=Processed,5=Completed',
  `order_type` tinyint NOT NULL DEFAULT '0' COMMENT '0=Dine-In,1=Takeaway,2=Online',
  `created_by_id` int NOT NULL,
  `approved_by_id` int DEFAULT NULL,
  `received_by_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `approved_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `kitchen_alert` tinyint NOT NULL DEFAULT '0',
  `collection_alert` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `table_id`, `order_no`, `trade_price`, `mrp`, `discount`, `vat`, `net_bill`, `paid_amount`, `profit`, `note`, `payment_status`, `order_status`, `order_type`, `created_by_id`, `approved_by_id`, `received_by_id`, `created_at`, `approved_at`, `processed_at`, `completed_at`, `kitchen_alert`, `collection_alert`) VALUES
(1, 14, '000001', 1560.00, 4760.00, 0.00, 238.00, 4998.00, 4998.00, 3200.00, NULL, 1, 5, 0, 1, 1, 1, '2024-07-13 05:10:40', '2024-07-13 05:11:13', '2024-07-13 05:12:42', '2024-07-25 02:17:45', 1, 0),
(2, 13, '000002', 1500.00, 3500.00, 0.00, 175.00, 3675.00, 3675.00, 2000.00, NULL, 1, 5, 0, 1, 1, 1, '2024-07-13 05:11:44', '2024-07-13 05:11:49', '2024-07-13 05:32:44', '2024-07-25 12:41:48', 1, 0),
(3, 6, '000003', 600.00, 1550.00, 0.00, 77.50, 1627.50, 1627.50, 950.00, NULL, 0, 5, 1, 1, 1, 1, '2024-07-13 05:15:37', '2024-07-13 05:15:37', '2024-07-13 05:15:51', NULL, 1, 0),
(4, 14, '000004', 350.00, 850.00, 0.00, 42.50, 892.50, 0.00, 0.00, NULL, 0, 5, 1, 1, 1, 1, '2024-07-14 02:35:12', '2024-07-14 02:36:49', '2024-07-14 03:33:26', NULL, 1, 0),
(5, 6, '000005', 320.00, 750.00, 0.00, 37.50, 787.50, 787.50, 430.00, NULL, 0, 4, 2, 1, 1, 1, '2024-07-14 04:07:20', '2024-07-14 04:07:20', '2024-07-14 07:01:04', NULL, 1, 0),
(6, 13, '000006', 100.00, 610.00, 0.00, 30.50, 640.50, 0.00, 0.00, NULL, 0, 4, 2, 1, 1, NULL, '2024-07-14 06:59:11', '2024-07-14 07:03:02', NULL, NULL, 1, 0),
(7, 12, '000007', 440.10, 930.00, 0.00, 46.50, 976.50, 976.50, 489.90, NULL, 1, 5, 0, 1, 1, 1, '2024-07-16 01:52:22', '2024-07-16 02:08:26', '2024-07-24 02:46:17', '2024-07-25 02:18:25', 1, 0),
(10, 6, '000010', 440.10, 930.00, 0.00, 46.50, 976.50, 976.50, 489.90, NULL, 1, 5, 0, 13, 1, 1, '2024-07-16 02:37:54', '2024-07-25 02:18:56', '2024-07-25 02:19:15', '2024-07-28 01:08:12', 1, 0),
(11, 6, '000011', 380.10, 680.00, 0.00, 34.00, 714.00, 714.00, 299.90, NULL, 1, 5, 0, 13, 1, 1, '2024-07-16 02:38:27', '2024-07-24 03:23:06', '2024-07-25 02:17:24', '2024-07-28 01:07:58', 1, 0),
(12, 6, '000012', 384.10, 750.00, 37.50, 37.50, 750.00, 750.00, 328.40, NULL, 1, 4, 1, 1, 1, 1, '2024-07-16 03:35:38', '2024-07-16 03:35:38', '2024-07-16 03:36:55', NULL, 1, 0),
(13, 6, '000013', 404.10, 750.00, 0.00, 37.50, 787.50, 787.50, 345.90, NULL, 1, 5, 1, 1, 1, 1, '2024-07-16 03:38:23', '2024-07-16 03:38:23', '2024-07-16 03:38:41', NULL, 1, 0),
(14, 6, '000014', 254.10, 650.00, 0.00, 32.50, 682.50, 682.50, 395.90, 'Note', 1, 4, 1, 1, 1, 1, '2024-07-16 03:41:47', '2024-07-16 03:41:47', '2024-07-24 02:45:29', NULL, 1, 0),
(15, 15, '000015', 230.10, 580.00, 0.00, 29.00, 609.00, 0.00, 0.00, NULL, 0, 1, 0, 1, 1, 1, '2024-07-25 02:16:32', '2024-07-31 03:33:58', '2024-07-31 03:30:02', NULL, 1, 0),
(16, 12, '000016', 650.10, 1280.00, 39.00, 64.00, 1305.00, 1305.00, 590.90, NULL, 1, 5, 1, 1, 1, 1, '2024-07-25 02:20:05', '2024-07-25 02:20:05', '2024-07-25 02:21:16', NULL, 1, 0),
(17, 12, '000017', 440.10, 930.00, 0.00, 46.50, 976.50, 976.50, 489.90, NULL, 1, 5, 0, 1, 1, 1, '2024-07-27 01:55:52', '2024-07-27 01:56:01', '2024-07-27 02:39:28', '2024-07-28 03:47:21', 1, 0),
(18, 6, '000018', 196.00, 680.00, 0.00, 34.00, 714.00, 0.00, 0.00, NULL, 0, 1, 0, 1, 1, 1, '2024-07-27 01:56:18', '2024-07-31 03:33:56', '2024-07-31 03:32:14', NULL, 1, 0),
(19, 6, '000019', 170.10, 330.00, 0.00, 16.50, 346.50, 0.00, 0.00, 'Emp sal', 0, 4, 0, 1, 1, 1, '2024-07-27 02:38:50', '2024-07-31 03:33:58', '2024-07-31 03:35:46', NULL, 1, 1),
(20, 6, '000020', 1540.00, 3900.00, 5.00, 195.00, 4090.00, 4090.00, 2355.00, NULL, 1, 4, 1, 1, 1, 1, '2024-07-27 04:42:25', '2024-07-27 04:42:25', '2024-07-28 01:07:51', NULL, 1, 0),
(21, 6, '000021', 250.10, 580.00, 0.00, 29.00, 609.00, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-28 12:59:57', '2024-07-31 03:33:55', '2024-07-31 03:35:34', NULL, 1, 1),
(22, 6, '000022', 480.00, 950.00, 0.00, 47.50, 997.50, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-28 02:15:36', '2024-07-31 03:33:55', '2024-07-31 03:35:32', NULL, 1, 1),
(23, 6, '000023', 230.10, 580.00, 0.00, 29.00, 609.00, 0.00, 0.00, NULL, 0, 1, 0, 1, 1, 1, '2024-07-28 02:16:11', '2024-07-31 03:33:53', '2024-07-31 03:29:22', NULL, 1, 0),
(24, 6, '000024', 116.00, 430.00, 0.00, 21.50, 451.50, 0.00, 0.00, NULL, 0, 1, 0, 1, 1, 1, '2024-07-28 03:12:40', '2024-07-31 03:33:51', '2024-07-31 03:17:18', NULL, 1, 0),
(25, 6, '000025', 230.10, 580.00, 0.00, 29.00, 609.00, 0.00, 0.00, NULL, 0, 1, 0, 1, 1, 1, '2024-07-28 03:13:59', '2024-07-31 03:33:50', '2024-07-31 03:00:39', NULL, 1, 0),
(26, 6, '000026', 380.10, 680.00, 0.00, 34.00, 714.00, 0.00, 0.00, NULL, 0, 1, 0, 1, 1, 1, '2024-07-28 03:15:13', '2024-07-31 03:33:49', '2024-07-31 03:00:32', NULL, 1, 0),
(27, 6, '000027', 254.10, 650.00, 0.00, 32.50, 682.50, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-28 03:33:33', '2024-07-31 03:33:47', '2024-07-31 03:42:30', NULL, 1, 1),
(28, 6, '000028', 228.20, 300.00, 0.00, 15.00, 315.00, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-28 03:34:13', '2024-07-31 03:33:44', '2024-07-31 03:42:26', NULL, 1, 1),
(29, 6, '000029', 174.10, 400.00, 0.00, 20.00, 420.00, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-28 03:35:57', '2024-07-31 03:33:43', '2024-07-31 03:42:17', NULL, 1, 1),
(30, 6, '000030', 252.00, 860.00, 0.00, 43.00, 903.00, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-29 01:11:00', '2024-07-31 03:33:41', '2024-07-31 03:41:54', NULL, 1, 1),
(31, 6, '000031', 80.00, 250.00, 0.00, 12.50, 262.50, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-29 01:51:24', '2024-07-31 03:33:40', '2024-07-31 03:40:21', NULL, 1, 1),
(32, 6, '000032', 176.00, 680.00, 0.00, 34.00, 714.00, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-29 02:20:26', '2024-07-31 03:33:39', '2024-07-31 03:41:36', NULL, 1, 1),
(33, 6, '000033', 176.00, 680.00, 0.00, 34.00, 714.00, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-29 02:20:27', '2024-07-31 03:33:38', '2024-07-31 03:36:31', NULL, 1, 1),
(34, 6, '000034', 140.00, 500.00, 0.00, 25.00, 525.00, 0.00, 0.00, NULL, 0, 1, 0, 1, 1, 14, '2024-07-29 03:13:11', '2024-07-31 03:33:37', '2024-07-30 12:49:40', NULL, 1, 0),
(35, 6, '000035', 140.00, 500.00, 0.00, 25.00, 525.00, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-29 03:13:11', '2024-07-31 03:33:35', '2024-07-31 03:35:23', NULL, 1, 1),
(36, 6, '000036', 136.00, 430.00, 0.00, 21.50, 451.50, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-29 03:13:39', '2024-07-31 03:33:34', '2024-07-31 03:35:56', NULL, 1, 1),
(37, 6, '000037', 170.10, 330.00, 0.00, 16.50, 346.50, 346.50, 159.90, NULL, 1, 5, 0, 1, 1, 14, '2024-07-29 03:13:48', '2024-07-29 03:13:58', '2024-07-30 11:54:41', '2024-07-31 02:20:48', 1, 0),
(38, 6, '000038', 520.10, 1180.00, 0.00, 59.00, 1239.00, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-29 03:15:10', '2024-07-31 03:33:33', '2024-07-31 03:36:16', NULL, 1, 1),
(39, 6, '000039', 436.10, 860.00, 0.00, 43.00, 903.00, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-30 11:57:53', '2024-07-31 03:33:32', '2024-07-31 03:35:12', NULL, 1, 1),
(40, 6, '000040', 324.10, 500.00, 0.00, 25.00, 525.00, 0.00, 0.00, NULL, 0, 4, 0, 1, 1, 1, '2024-07-30 11:58:23', '2024-07-31 03:34:42', '2024-07-31 03:35:01', NULL, 1, 1),
(41, 6, '000041', 420.00, 700.00, 0.00, 35.00, 735.00, 735.00, 280.00, NULL, 1, 4, 1, 1, 1, 1, '2024-07-30 12:01:43', '2024-07-30 12:01:43', '2024-07-31 02:16:04', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` double(20,2) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '1=ready',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `item_id`, `quantity`, `unit_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 8, 250.00, 1, '2024-07-13 11:10:40', '2024-07-13 11:12:21'),
(2, 1, 9, 6, 250.00, 1, '2024-07-13 11:10:40', '2024-07-13 11:12:25'),
(3, 1, 15, 7, 180.00, 1, '2024-07-13 11:10:40', '2024-07-13 11:12:42'),
(4, 2, 10, 5, 250.00, 1, '2024-07-13 11:11:44', '2024-07-13 11:32:43'),
(5, 2, 9, 9, 250.00, 1, '2024-07-13 11:11:44', '2024-07-13 11:32:44'),
(6, 3, 10, 5, 250.00, 1, '2024-07-13 11:15:37', '2024-07-13 11:15:51'),
(7, 3, 13, 2, 150.00, 1, '2024-07-13 11:15:37', '2024-07-13 11:15:51'),
(8, 4, 11, 1, 350.00, 1, '2024-07-14 08:35:12', '2024-07-14 09:33:26'),
(9, 4, 9, 1, 250.00, 1, '2024-07-14 08:35:12', '2024-07-14 09:33:26'),
(10, 4, 9, 1, 250.00, 1, '2024-07-14 08:35:12', '2024-07-14 09:33:26'),
(11, 5, 10, 1, 250.00, 1, '2024-07-14 10:07:20', '2024-07-14 13:01:03'),
(12, 5, 9, 1, 250.00, 1, '2024-07-14 10:07:20', '2024-07-14 13:01:02'),
(13, 5, 9, 1, 250.00, 1, '2024-07-14 10:07:20', '2024-07-14 13:01:04'),
(14, 6, 9, 1, 250.00, 0, '2024-07-14 12:59:11', '2024-07-14 12:59:11'),
(15, 6, 15, 1, 180.00, 0, '2024-07-14 12:59:11', '2024-07-14 12:59:11'),
(16, 6, 15, 1, 180.00, 0, '2024-07-14 12:59:12', '2024-07-14 12:59:12'),
(17, 7, 11, 1, 350.00, 1, '2024-07-16 07:52:22', '2024-07-24 08:46:17'),
(18, 7, 9, 1, 250.00, 1, '2024-07-16 07:52:22', '2024-07-24 08:46:17'),
(19, 7, 15, 1, 180.00, 1, '2024-07-16 07:52:22', '2024-07-24 08:46:17'),
(20, 7, 13, 1, 150.00, 1, '2024-07-16 07:52:22', '2024-07-24 08:46:17'),
(26, 10, 11, 1, 350.00, 1, '2024-07-16 08:37:54', '2024-07-25 06:41:11'),
(27, 10, 13, 1, 150.00, 1, '2024-07-16 08:37:54', '2024-07-25 06:41:12'),
(28, 10, 9, 1, 250.00, 1, '2024-07-16 08:37:54', '2024-07-25 06:41:23'),
(29, 10, 15, 1, 180.00, 1, '2024-07-16 08:37:54', '2024-07-25 06:41:23'),
(30, 11, 11, 1, 350.00, 1, '2024-07-16 08:38:27', '2024-07-25 06:40:31'),
(31, 11, 15, 1, 180.00, 1, '2024-07-16 08:38:27', '2024-07-25 06:40:33'),
(32, 11, 13, 1, 150.00, 1, '2024-07-16 08:38:27', '2024-07-25 08:17:24'),
(33, 12, 11, 1, 350.00, 1, '2024-07-16 09:35:38', '2024-07-16 09:36:55'),
(34, 12, 9, 1, 250.00, 1, '2024-07-16 09:35:38', '2024-07-16 09:36:55'),
(35, 12, 13, 1, 150.00, 1, '2024-07-16 09:35:38', '2024-07-16 09:36:55'),
(36, 13, 10, 1, 250.00, 1, '2024-07-16 09:38:23', '2024-07-16 09:38:41'),
(37, 13, 11, 1, 350.00, 1, '2024-07-16 09:38:23', '2024-07-16 09:38:41'),
(38, 13, 13, 1, 150.00, 1, '2024-07-16 09:38:23', '2024-07-16 09:38:41'),
(39, 14, 10, 1, 250.00, 1, '2024-07-16 09:41:47', '2024-07-24 08:45:29'),
(40, 14, 13, 1, 150.00, 1, '2024-07-16 09:41:47', '2024-07-24 08:45:29'),
(41, 14, 9, 1, 250.00, 1, '2024-07-16 09:41:47', '2024-07-24 08:45:29'),
(42, 15, 13, 1, 150.00, 1, '2024-07-25 08:16:32', '2024-07-25 08:16:53'),
(43, 15, 9, 1, 250.00, 1, '2024-07-25 08:16:32', '2024-07-25 08:16:55'),
(44, 15, 15, 1, 180.00, 1, '2024-07-25 08:16:32', '2024-07-25 08:17:07'),
(45, 16, 11, 1, 350.00, 1, '2024-07-25 08:20:05', '2024-07-25 08:20:18'),
(46, 16, 9, 1, 250.00, 1, '2024-07-25 08:20:05', '2024-07-25 08:20:18'),
(47, 16, 15, 1, 180.00, 1, '2024-07-25 08:20:05', '2024-07-25 08:20:18'),
(48, 16, 11, 1, 350.00, 1, '2024-07-25 08:21:06', '2024-07-25 08:21:15'),
(49, 16, 13, 1, 150.00, 1, '2024-07-25 08:21:06', '2024-07-25 08:21:16'),
(50, 17, 11, 1, 350.00, 1, '2024-07-27 07:55:52', '2024-07-27 08:39:21'),
(51, 17, 13, 1, 150.00, 1, '2024-07-27 07:55:52', '2024-07-27 08:39:23'),
(52, 17, 9, 1, 250.00, 1, '2024-07-27 07:55:52', '2024-07-27 08:39:28'),
(53, 17, 15, 1, 180.00, 1, '2024-07-27 07:55:52', '2024-07-27 08:39:28'),
(54, 18, 10, 1, 250.00, 1, '2024-07-27 07:56:18', '2024-07-28 08:11:41'),
(55, 18, 15, 1, 180.00, 1, '2024-07-27 07:56:18', '2024-07-28 08:05:30'),
(56, 18, 9, 1, 250.00, 1, '2024-07-27 07:56:18', '2024-07-28 09:20:34'),
(57, 19, 13, 1, 150.00, 1, '2024-07-27 08:38:50', '2024-07-28 09:19:59'),
(58, 19, 15, 1, 180.00, 1, '2024-07-27 08:38:50', '2024-07-29 07:09:32'),
(59, 20, 10, 5, 250.00, 1, '2024-07-27 10:42:25', '2024-07-28 07:07:51'),
(60, 20, 11, 4, 350.00, 1, '2024-07-27 10:42:25', '2024-07-28 07:07:51'),
(61, 20, 9, 3, 250.00, 1, '2024-07-27 10:42:25', '2024-07-28 07:07:51'),
(62, 20, 9, 2, 250.00, 1, '2024-07-27 10:42:25', '2024-07-28 07:07:51'),
(63, 21, 10, 1, 250.00, 1, '2024-07-28 06:59:57', '2024-07-28 07:07:48'),
(64, 21, 13, 1, 150.00, 1, '2024-07-28 06:59:57', '2024-07-28 07:07:48'),
(65, 21, 15, 1, 180.00, 1, '2024-07-28 06:59:57', '2024-07-28 07:07:48'),
(66, 22, 11, 1, 350.00, 1, '2024-07-28 08:15:36', '2024-07-28 09:05:29'),
(67, 22, 11, 1, 350.00, 1, '2024-07-28 08:15:36', '2024-07-28 09:05:31'),
(68, 22, 9, 1, 250.00, 1, '2024-07-28 08:15:36', '2024-07-28 09:05:44'),
(69, 23, 13, 1, 150.00, 1, '2024-07-28 08:16:11', '2024-07-28 09:05:42'),
(70, 23, 9, 1, 250.00, 1, '2024-07-28 08:16:11', '2024-07-28 09:15:38'),
(71, 23, 15, 1, 180.00, 1, '2024-07-28 08:16:11', '2024-07-28 09:15:38'),
(72, 24, 9, 1, 250.00, 1, '2024-07-28 09:12:40', '2024-07-28 09:15:36'),
(73, 24, 15, 1, 180.00, 1, '2024-07-28 09:12:40', '2024-07-28 09:15:36'),
(74, 25, 13, 1, 150.00, 1, '2024-07-28 09:14:00', '2024-07-28 09:15:35'),
(75, 25, 9, 1, 250.00, 1, '2024-07-28 09:14:00', '2024-07-28 09:15:35'),
(76, 25, 15, 1, 180.00, 1, '2024-07-28 09:14:00', '2024-07-28 09:15:35'),
(77, 26, 11, 1, 350.00, 1, '2024-07-28 09:15:13', '2024-07-28 09:46:57'),
(78, 26, 13, 1, 150.00, 1, '2024-07-28 09:15:13', '2024-07-28 09:46:59'),
(79, 26, 15, 1, 180.00, 1, '2024-07-28 09:15:13', '2024-07-28 09:47:01'),
(80, 27, 10, 1, 250.00, 1, '2024-07-28 09:33:33', '2024-07-28 09:47:30'),
(81, 27, 13, 1, 150.00, 1, '2024-07-28 09:33:33', '2024-07-28 09:47:30'),
(82, 27, 9, 1, 250.00, 1, '2024-07-28 09:33:33', '2024-07-28 09:47:30'),
(83, 28, 13, 1, 150.00, 1, '2024-07-28 09:34:13', '2024-07-28 09:50:37'),
(84, 28, 13, 1, 150.00, 1, '2024-07-28 09:34:13', '2024-07-29 06:10:54'),
(85, 29, 9, 1, 250.00, 1, '2024-07-28 09:35:57', '2024-07-28 09:47:28'),
(86, 29, 13, 1, 150.00, 1, '2024-07-28 09:35:57', '2024-07-28 09:47:28'),
(87, 30, 10, 1, 250.00, 1, '2024-07-29 07:11:00', '2024-07-29 07:11:48'),
(88, 30, 9, 1, 250.00, 1, '2024-07-29 07:11:00', '2024-07-30 05:05:29'),
(89, 30, 15, 1, 180.00, 1, '2024-07-29 07:11:00', '2024-07-30 05:32:00'),
(90, 30, 15, 1, 180.00, 1, '2024-07-29 07:11:00', '2024-07-30 05:32:00'),
(91, 31, 10, 1, 250.00, 1, '2024-07-29 07:51:24', '2024-07-29 08:13:54'),
(92, 32, 9, 1, 250.00, 1, '2024-07-29 08:20:26', '2024-07-29 09:12:51'),
(93, 32, 9, 1, 250.00, 1, '2024-07-29 08:20:26', '2024-07-29 09:12:51'),
(94, 32, 15, 1, 180.00, 1, '2024-07-29 08:20:26', '2024-07-29 09:12:51'),
(95, 33, 9, 1, 250.00, 1, '2024-07-29 08:20:27', '2024-07-30 05:30:37'),
(96, 33, 9, 1, 250.00, 1, '2024-07-29 08:20:27', '2024-07-30 05:30:34'),
(97, 33, 15, 1, 180.00, 1, '2024-07-29 08:20:27', '2024-07-30 05:30:31'),
(98, 34, 10, 1, 250.00, 1, '2024-07-29 09:13:11', '2024-07-30 06:49:40'),
(99, 34, 9, 1, 250.00, 1, '2024-07-29 09:13:11', '2024-07-30 05:53:31'),
(100, 35, 10, 1, 250.00, 1, '2024-07-29 09:13:11', '2024-07-31 08:23:20'),
(101, 35, 9, 1, 250.00, 1, '2024-07-29 09:13:11', '2024-07-31 08:23:20'),
(102, 36, 10, 1, 250.00, 1, '2024-07-29 09:13:39', '2024-07-30 05:06:04'),
(103, 36, 15, 1, 180.00, 1, '2024-07-29 09:13:39', '2024-07-29 09:23:43'),
(104, 37, 13, 1, 150.00, 1, '2024-07-29 09:13:48', '2024-07-30 05:54:41'),
(105, 37, 15, 1, 180.00, 1, '2024-07-29 09:13:48', '2024-07-30 05:54:41'),
(106, 38, 10, 1, 250.00, 1, '2024-07-29 09:15:10', '2024-07-30 05:31:27'),
(107, 38, 11, 1, 350.00, 1, '2024-07-29 09:15:10', '2024-07-30 05:31:52'),
(108, 38, 13, 1, 150.00, 1, '2024-07-29 09:15:10', '2024-07-30 05:31:52'),
(109, 38, 9, 1, 250.00, 1, '2024-07-29 09:15:10', '2024-07-30 05:31:52'),
(110, 38, 15, 1, 180.00, 1, '2024-07-29 09:15:10', '2024-07-30 05:31:52'),
(111, 39, 11, 1, 350.00, 1, '2024-07-30 05:57:53', '2024-07-30 09:40:45'),
(112, 39, 15, 1, 180.00, 1, '2024-07-30 05:57:53', '2024-07-30 09:40:45'),
(113, 39, 13, 1, 150.00, 1, '2024-07-30 05:57:53', '2024-07-30 09:40:45'),
(114, 39, 15, 1, 180.00, 1, '2024-07-30 05:57:53', '2024-07-30 09:40:45'),
(115, 40, 11, 1, 350.00, 1, '2024-07-30 05:58:23', '2024-07-31 07:54:23'),
(116, 40, 13, 1, 150.00, 1, '2024-07-30 05:58:23', '2024-07-31 08:22:22'),
(117, 41, 11, 1, 350.00, 1, '2024-07-30 06:01:43', '2024-07-31 08:16:04'),
(118, 41, 11, 1, 350.00, 1, '2024-07-30 06:01:43', '2024-07-31 08:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `supplier_id` int NOT NULL,
  `payment_method_id` int NOT NULL,
  `purchase_id` int DEFAULT NULL,
  `date` date NOT NULL,
  `amount` double(20,2) NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `supplier_id`, `payment_method_id`, `purchase_id`, `date`, `amount`, `note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-07-01', 3500.00, NULL, 1, 1, NULL, '2024-07-01 10:03:40', '2024-07-01 10:03:40'),
(2, 1, 1, 2, '2024-07-07', 28200.00, NULL, 1, 1, NULL, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(3, 1, 1, 3, '2024-07-11', 35500.00, 'Note', 1, 1, NULL, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(4, 1, 1, 4, '2024-07-14', 19805.80, NULL, 1, 1, NULL, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(5, 1, 1, 5, '2024-07-25', 34330.00, NULL, 1, 1, NULL, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(6, 1, 1, 6, '2024-07-25', 15460.00, NULL, 1, 1, NULL, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(7, 1, 1, 6, '2024-07-25', 5000.00, NULL, 1, 1, NULL, '2024-07-25 08:52:48', '2024-07-25 08:52:48'),
(9, 1, 1, 7, '2024-07-25', 1200.00, NULL, 1, 1, NULL, '2024-07-25 08:56:58', '2024-07-25 08:56:58'),
(10, 1, 1, 8, '2024-07-25', 700.00, NULL, 1, 1, NULL, '2024-07-25 08:56:58', '2024-07-25 08:56:58'),
(11, 1, 1, NULL, '2024-07-25', 3100.00, NULL, 1, 1, NULL, '2024-07-25 08:56:58', '2024-07-25 08:56:58');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `title`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 1, '2024-03-23 05:02:30', '2024-03-23 05:02:30'),
(2, 'bKash', 0, '2024-03-23 05:03:18', '2024-04-30 07:56:02'),
(3, 'Nagad', 0, '2024-03-23 05:03:30', '2024-04-30 07:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` bigint UNSIGNED NOT NULL,
  `pp_id` bigint UNSIGNED NOT NULL,
  `raw_material_id` int NOT NULL,
  `quantity` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ppd_raw_materials`
--

INSERT INTO `ppd_raw_materials` (`id`, `pp_id`, `raw_material_id`, `quantity`, `created_at`, `updated_at`) VALUES
(7, 2, 7, 15.00, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(8, 2, 8, 100.00, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(9, 2, 3, 5.00, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(10, 2, 2, 5.00, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(11, 2, 6, 10.00, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(12, 2, 5, 20.00, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(13, 2, 4, 10.00, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(14, 2, 1, 10.00, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(47, 4, 7, 30.00, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(48, 4, 8, 200.00, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(49, 4, 3, 10.00, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(50, 4, 2, 10.00, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(51, 4, 6, 20.00, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(52, 4, 5, 40.00, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(53, 4, 4, 20.00, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(54, 4, 1, 20.00, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(55, 3, 7, 0.15, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(56, 3, 8, 1.00, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(57, 3, 3, 0.05, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(58, 3, 2, 0.05, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(59, 3, 4, 0.10, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(60, 3, 5, 0.20, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(61, 3, 1, 0.10, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(62, 3, 6, 0.10, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(63, 5, 4, 10.00, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(64, 5, 5, 20.00, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(65, 5, 1, 10.00, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(66, 5, 7, 15.00, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(67, 5, 6, 10.00, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(68, 5, 8, 100.00, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(69, 5, 3, 5.00, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(70, 5, 2, 5.00, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(83, 8, 14, 25.00, '2024-07-13 09:36:33', '2024-07-13 09:36:33'),
(84, 8, 2, 3.10, '2024-07-13 09:36:33', '2024-07-13 09:36:33'),
(85, 8, 1, 15.00, '2024-07-13 09:36:33', '2024-07-13 09:36:33'),
(86, 8, 3, 3.00, '2024-07-13 09:36:33', '2024-07-13 09:36:33'),
(87, 8, 7, 10.00, '2024-07-13 09:36:33', '2024-07-13 09:36:33'),
(88, 8, 5, 2.00, '2024-07-13 09:36:33', '2024-07-13 09:36:33'),
(89, 9, 14, 25.00, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(90, 9, 7, 15.00, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(91, 9, 5, 7.00, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(92, 9, 2, 3.10, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(93, 9, 1, 15.00, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(94, 9, 3, 3.00, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(95, 9, 6, 5.00, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(96, 10, 4, 2.00, '2024-07-25 08:30:01', '2024-07-25 08:30:01'),
(97, 10, 5, 2.00, '2024-07-25 08:30:01', '2024-07-25 08:30:01'),
(98, 10, 1, 2.00, '2024-07-25 08:30:01', '2024-07-25 08:30:01'),
(99, 10, 7, 1.50, '2024-07-25 08:30:01', '2024-07-25 08:30:01'),
(100, 10, 8, 30.00, '2024-07-25 08:30:01', '2024-07-25 08:30:01'),
(101, 10, 3, 1.50, '2024-07-25 08:30:01', '2024-07-25 08:30:01'),
(102, 10, 2, 1.50, '2024-07-25 08:30:01', '2024-07-25 08:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `pp_details`
--

CREATE TABLE `pp_details` (
  `id` bigint UNSIGNED NOT NULL,
  `pp_id` bigint UNSIGNED NOT NULL,
  `recipe_id` bigint UNSIGNED NOT NULL,
  `quantity` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pp_details`
--

INSERT INTO `pp_details` (`id`, `pp_id`, `recipe_id`, `quantity`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 100, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(4, 2, 2, 100, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(5, 2, 3, 100, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(27, 4, 1, 200, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(28, 4, 2, 200, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(29, 4, 3, 200, '2024-07-10 12:00:10', '2024-07-10 12:00:10'),
(30, 3, 1, 1, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(31, 3, 3, 1, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(32, 3, 2, 1, '2024-07-10 12:00:22', '2024-07-10 12:00:22'),
(33, 5, 3, 100, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(34, 5, 2, 100, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(35, 5, 1, 100, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(40, 8, 7, 150, '2024-07-13 09:36:33', '2024-07-13 09:36:33'),
(41, 8, 4, 100, '2024-07-13 09:36:33', '2024-07-13 09:36:33'),
(42, 9, 4, 100, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(43, 9, 7, 150, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(44, 9, 2, 50, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(45, 10, 3, 20, '2024-07-25 08:30:01', '2024-07-25 08:30:01'),
(46, 10, 1, 30, '2024-07-25 08:30:01', '2024-07-25 08:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` int NOT NULL,
  `menu_id` int NOT NULL,
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
(123, 2, 1, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(124, 2, 2, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(125, 2, 3, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(126, 2, 4, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(127, 2, 5, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(128, 2, 111, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(129, 2, 112, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(130, 2, 149, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(131, 2, 151, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(132, 2, 156, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(133, 2, 157, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(134, 2, 158, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(135, 2, 152, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(136, 2, 153, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(137, 2, 154, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(138, 2, 155, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(139, 2, 115, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(140, 2, 125, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(141, 2, 126, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(142, 2, 136, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(143, 2, 137, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(144, 2, 127, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(145, 2, 129, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(146, 2, 130, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(147, 2, 131, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(148, 2, 128, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(149, 2, 132, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(150, 2, 133, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(151, 2, 134, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(152, 2, 135, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(153, 2, 116, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(154, 2, 120, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(155, 2, 121, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(156, 2, 122, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(157, 2, 123, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(158, 2, 124, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(159, 2, 117, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(160, 2, 118, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(161, 2, 119, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(162, 2, 150, '2024-07-06 13:18:41', '2024-07-06 13:18:41'),
(176, 4, 53, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(177, 4, 54, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(178, 4, 61, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(179, 4, 62, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(180, 4, 63, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(181, 4, 64, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(182, 4, 55, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(183, 4, 59, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(184, 4, 60, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(185, 4, 56, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(186, 4, 57, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(187, 4, 58, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(188, 4, 67, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(189, 4, 68, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(190, 4, 69, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(191, 4, 72, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(192, 4, 73, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(193, 4, 74, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(194, 4, 76, '2024-07-16 09:29:43', '2024-07-16 09:29:43'),
(195, 4, 1, '2024-07-16 09:29:44', '2024-07-16 09:29:44'),
(196, 5, 159, '2024-07-29 09:27:08', '2024-07-29 09:27:08'),
(197, 5, 65, '2024-07-29 09:27:08', '2024-07-29 09:27:08'),
(198, 5, 66, '2024-07-29 09:27:08', '2024-07-29 09:27:08'),
(199, 5, 1, '2024-07-29 09:27:08', '2024-07-29 09:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `production_plans`
--

CREATE TABLE `production_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `plan_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL,
  `created_by_id` int NOT NULL,
  `updated_by_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `production_plans`
--

INSERT INTO `production_plans` (`id`, `plan_no`, `date`, `note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(2, '0000001', '2024-07-10', NULL, 1, 1, 0, '2024-07-10 10:47:42', '2024-07-10 10:47:42'),
(3, '0000010', '2024-07-10', NULL, 1, 1, 1, '2024-07-10 10:48:34', '2024-07-10 12:00:22'),
(4, '0000009', '2024-07-10', 'Note', 1, 1, 1, '2024-07-10 10:49:07', '2024-07-10 12:00:10'),
(5, '0000011', '2024-07-11', NULL, 1, 1, 0, '2024-07-11 10:54:19', '2024-07-11 10:54:19'),
(8, '0000012', '2024-07-14', NULL, 1, 1, 0, '2024-07-13 09:36:33', '2024-07-13 09:36:33'),
(9, '0000013', '2024-07-26', NULL, 1, 1, 0, '2024-07-25 08:25:55', '2024-07-25 08:25:55'),
(10, '0000014', '2024-07-26', NULL, 1, 1, 0, '2024-07-25 08:30:01', '2024-07-25 08:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint UNSIGNED NOT NULL,
  `supplier_id` int NOT NULL,
  `vouchar_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `total_price` double(20,2) NOT NULL,
  `vat_tax` double(20,2) NOT NULL,
  `discount` double(20,2) NOT NULL,
  `total_payable` double(20,2) NOT NULL,
  `paid_amount` double(20,2) NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `vouchar_no`, `date`, `total_price`, `vat_tax`, `discount`, `total_payable`, `paid_amount`, `note`, `payment_status`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, '0000001', '2024-07-01', 3500.00, 0.00, 0.00, 3500.00, 3500.00, NULL, '1', '1', 1, NULL, '2024-07-01 10:03:40', '2024-07-01 10:03:40'),
(2, 1, '0000002', '2024-07-07', 28200.00, 0.00, 0.00, 28200.00, 28200.00, NULL, '1', '1', 1, NULL, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(3, 1, '0000003', '2024-07-11', 35500.00, 0.00, 0.00, 35500.00, 35500.00, 'Note', '1', '1', 1, NULL, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(4, 1, '0000004', '2024-07-14', 20210.00, 0.00, 404.20, 19805.80, 19805.80, NULL, '1', '1', 1, NULL, '2024-07-13 10:20:40', '2024-07-13 10:20:40'),
(5, 1, '0000005', '2024-07-25', 34330.00, 0.00, 0.00, 34330.00, 34330.00, NULL, '1', '1', 1, NULL, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(6, 1, '0000006', '2024-07-25', 30460.00, 0.00, 0.00, 30460.00, 20460.00, NULL, '0', '1', 1, NULL, '2024-07-25 08:37:06', '2024-07-25 08:53:33'),
(7, 1, '0000007', '2024-07-25', 1200.00, 0.00, 0.00, 1200.00, 1200.00, NULL, '1', '1', 1, NULL, '2024-07-25 08:55:02', '2024-07-25 08:56:58'),
(8, 1, '0000008', '2024-07-25', 700.00, 0.00, 0.00, 700.00, 700.00, NULL, '1', '1', 1, NULL, '2024-07-25 08:55:16', '2024-07-25 08:56:58');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_type_id` int NOT NULL,
  `quantity` double(20,2) NOT NULL,
  `unit_price` double(20,2) NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `product_type_id`, `quantity`, `unit_price`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 31, 1, 100.00, 25.00, 2500.00, '2024-07-01 10:03:40', '2024-07-01 10:03:40'),
(2, 1, 32, 1, 50.00, 20.00, 1000.00, '2024-07-01 10:03:40', '2024-07-01 10:03:40'),
(3, 2, 7, 3, 10.00, 1000.00, 10000.00, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(4, 2, 8, 3, 10.00, 20.00, 200.00, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(5, 2, 1, 3, 10.00, 400.00, 4000.00, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(6, 2, 6, 3, 10.00, 1000.00, 10000.00, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(7, 2, 4, 3, 10.00, 100.00, 1000.00, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(8, 2, 2, 3, 10.00, 100.00, 1000.00, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(9, 2, 5, 3, 10.00, 100.00, 1000.00, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(10, 2, 3, 3, 10.00, 100.00, 1000.00, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(11, 3, 7, 3, 15.00, 1000.00, 15000.00, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(12, 3, 8, 3, 100.00, 20.00, 2000.00, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(13, 3, 6, 3, 10.00, 1000.00, 10000.00, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(14, 3, 1, 3, 10.00, 400.00, 4000.00, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(15, 3, 4, 3, 10.00, 100.00, 1000.00, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(16, 3, 2, 3, 5.00, 100.00, 500.00, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(17, 3, 5, 3, 20.00, 100.00, 2000.00, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(18, 3, 3, 3, 10.00, 100.00, 1000.00, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(19, 4, 7, 3, 10.00, 1000.00, 10000.00, '2024-07-13 10:20:40', '2024-07-13 10:20:40'),
(20, 4, 1, 3, 15.00, 400.00, 6000.00, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(21, 4, 2, 3, 3.10, 100.00, 310.00, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(22, 4, 5, 3, 2.00, 100.00, 200.00, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(23, 4, 14, 3, 25.00, 120.00, 3000.00, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(24, 4, 3, 3, 3.00, 100.00, 300.00, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(25, 4, 5, 3, 1.00, 100.00, 100.00, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(26, 4, 12, 3, 1.00, 200.00, 200.00, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(27, 4, 5, 3, 1.00, 100.00, 100.00, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(28, 5, 7, 3, 16.50, 1000.00, 16500.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(29, 5, 8, 3, 30.00, 20.00, 600.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(30, 5, 6, 3, 5.00, 1000.00, 5000.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(31, 5, 1, 3, 17.00, 400.00, 6800.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(32, 5, 4, 3, 2.00, 100.00, 200.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(33, 5, 2, 3, 4.60, 100.00, 460.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(34, 5, 5, 3, 9.00, 100.00, 900.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(35, 5, 14, 3, 25.00, 120.00, 3000.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(36, 5, 3, 3, 4.50, 100.00, 450.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(37, 5, 8, 3, 1.00, 20.00, 20.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(38, 5, 1, 3, 1.00, 400.00, 400.00, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(39, 6, 7, 3, 16.50, 1000.00, 16500.00, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(40, 6, 8, 3, 30.00, 20.00, 600.00, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(41, 6, 6, 3, 5.00, 1000.00, 5000.00, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(42, 6, 1, 3, 17.00, 400.00, 6800.00, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(43, 6, 4, 3, 2.00, 100.00, 200.00, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(44, 6, 2, 3, 4.60, 100.00, 460.00, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(45, 6, 5, 3, 9.00, 100.00, 900.00, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(46, 7, 7, 3, 1.00, 1000.00, 1000.00, '2024-07-25 08:55:02', '2024-07-25 08:55:02'),
(47, 7, 2, 3, 1.00, 100.00, 100.00, '2024-07-25 08:55:02', '2024-07-25 08:55:02'),
(48, 7, 3, 3, 1.00, 100.00, 100.00, '2024-07-25 08:55:02', '2024-07-25 08:55:02'),
(49, 8, 5, 3, 1.00, 100.00, 100.00, '2024-07-25 08:55:16', '2024-07-25 08:55:16'),
(50, 8, 12, 3, 1.00, 200.00, 200.00, '2024-07-25 08:55:16', '2024-07-25 08:55:16'),
(51, 8, 1, 3, 1.00, 400.00, 400.00, '2024-07-25 08:55:16', '2024-07-25 08:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisitions`
--

CREATE TABLE `purchase_requisitions` (
  `id` bigint UNSIGNED NOT NULL,
  `vouchar_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `total_price` double(20,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_requisitions`
--

INSERT INTO `purchase_requisitions` (`id`, `vouchar_no`, `date`, `total_price`, `note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, '0000001', '2024-07-10', 105350.00, NULL, '1', 1, NULL, '2024-07-11 10:53:41', '2024-07-11 10:53:41'),
(2, '8941193041413', '2024-07-11', 35000.00, NULL, '1', 1, NULL, '2024-07-11 10:57:28', '2024-07-11 10:57:28'),
(3, '8941193041414', '2024-07-11', 35000.00, NULL, '1', 1, NULL, '2024-07-13 09:53:27', '2024-07-13 09:53:27'),
(4, '8941193041415', '2024-07-14', 19810.00, NULL, '1', 1, NULL, '2024-07-13 09:56:45', '2024-07-13 09:56:45'),
(5, '8941193041416', '2024-07-26', 33910.00, NULL, '1', 1, NULL, '2024-07-25 08:31:28', '2024-07-25 08:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisition_details`
--

CREATE TABLE `purchase_requisition_details` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_requisition_id` bigint UNSIGNED NOT NULL,
  `item_id` int NOT NULL,
  `item_type_id` int NOT NULL,
  `quantity` double(20,2) NOT NULL,
  `unit_price` double(20,2) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_requisition_details`
--

INSERT INTO `purchase_requisition_details` (`id`, `purchase_requisition_id`, `item_id`, `item_type_id`, `quantity`, `unit_price`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 3, 45.15, 1000.00, 45150.00, '2024-07-11 10:53:41', '2024-07-11 10:53:41'),
(2, 1, 8, 3, 301.00, 20.00, 6020.00, '2024-07-11 10:53:41', '2024-07-11 10:53:41'),
(3, 1, 6, 3, 30.10, 1000.00, 30100.00, '2024-07-11 10:53:41', '2024-07-11 10:53:41'),
(4, 1, 1, 3, 30.10, 400.00, 12040.00, '2024-07-11 10:53:41', '2024-07-11 10:53:41'),
(5, 1, 4, 3, 30.10, 100.00, 3010.00, '2024-07-11 10:53:41', '2024-07-11 10:53:41'),
(6, 1, 2, 3, 15.05, 100.00, 1505.00, '2024-07-11 10:53:41', '2024-07-11 10:53:41'),
(7, 1, 5, 3, 60.20, 100.00, 6020.00, '2024-07-11 10:53:41', '2024-07-11 10:53:41'),
(8, 1, 3, 3, 15.05, 100.00, 1505.00, '2024-07-11 10:53:41', '2024-07-11 10:53:41'),
(9, 2, 7, 3, 15.00, 1000.00, 15000.00, '2024-07-11 10:57:28', '2024-07-11 10:57:28'),
(10, 2, 8, 3, 100.00, 20.00, 2000.00, '2024-07-11 10:57:28', '2024-07-11 10:57:28'),
(11, 2, 6, 3, 10.00, 1000.00, 10000.00, '2024-07-11 10:57:28', '2024-07-11 10:57:28'),
(12, 2, 1, 3, 10.00, 400.00, 4000.00, '2024-07-11 10:57:28', '2024-07-11 10:57:28'),
(13, 2, 4, 3, 10.00, 100.00, 1000.00, '2024-07-11 10:57:28', '2024-07-11 10:57:28'),
(14, 2, 2, 3, 5.00, 100.00, 500.00, '2024-07-11 10:57:28', '2024-07-11 10:57:28'),
(15, 2, 5, 3, 20.00, 100.00, 2000.00, '2024-07-11 10:57:28', '2024-07-11 10:57:28'),
(16, 2, 3, 3, 5.00, 100.00, 500.00, '2024-07-11 10:57:28', '2024-07-11 10:57:28'),
(17, 3, 7, 3, 15.00, 1000.00, 15000.00, '2024-07-13 09:53:27', '2024-07-13 09:53:27'),
(18, 3, 8, 3, 100.00, 20.00, 2000.00, '2024-07-13 09:53:27', '2024-07-13 09:53:27'),
(19, 3, 6, 3, 10.00, 1000.00, 10000.00, '2024-07-13 09:53:27', '2024-07-13 09:53:27'),
(20, 3, 1, 3, 10.00, 400.00, 4000.00, '2024-07-13 09:53:27', '2024-07-13 09:53:27'),
(21, 3, 4, 3, 10.00, 100.00, 1000.00, '2024-07-13 09:53:27', '2024-07-13 09:53:27'),
(22, 3, 2, 3, 5.00, 100.00, 500.00, '2024-07-13 09:53:27', '2024-07-13 09:53:27'),
(23, 3, 5, 3, 20.00, 100.00, 2000.00, '2024-07-13 09:53:27', '2024-07-13 09:53:27'),
(24, 3, 3, 3, 5.00, 100.00, 500.00, '2024-07-13 09:53:27', '2024-07-13 09:53:27'),
(25, 4, 7, 3, 10.00, 1000.00, 10000.00, '2024-07-13 09:56:45', '2024-07-13 09:56:45'),
(26, 4, 1, 3, 15.00, 400.00, 6000.00, '2024-07-13 09:56:46', '2024-07-13 09:56:46'),
(27, 4, 2, 3, 3.10, 100.00, 310.00, '2024-07-13 09:56:46', '2024-07-13 09:56:46'),
(28, 4, 5, 3, 2.00, 100.00, 200.00, '2024-07-13 09:56:46', '2024-07-13 09:56:46'),
(29, 4, 14, 3, 25.00, 120.00, 3000.00, '2024-07-13 09:56:46', '2024-07-13 09:56:46'),
(30, 4, 3, 3, 3.00, 100.00, 300.00, '2024-07-13 09:56:46', '2024-07-13 09:56:46'),
(31, 5, 7, 3, 16.50, 1000.00, 16500.00, '2024-07-25 08:31:28', '2024-07-25 08:31:28'),
(32, 5, 8, 3, 30.00, 20.00, 600.00, '2024-07-25 08:31:28', '2024-07-25 08:31:28'),
(33, 5, 6, 3, 5.00, 1000.00, 5000.00, '2024-07-25 08:31:28', '2024-07-25 08:31:28'),
(34, 5, 1, 3, 17.00, 400.00, 6800.00, '2024-07-25 08:31:28', '2024-07-25 08:31:28'),
(35, 5, 4, 3, 2.00, 100.00, 200.00, '2024-07-25 08:31:28', '2024-07-25 08:31:28'),
(36, 5, 2, 3, 4.60, 100.00, 460.00, '2024-07-25 08:31:28', '2024-07-25 08:31:28'),
(37, 5, 5, 3, 9.00, 100.00, 900.00, '2024-07-25 08:31:28', '2024-07-25 08:31:28'),
(38, 5, 14, 3, 25.00, 120.00, 3000.00, '2024-07-25 08:31:28', '2024-07-25 08:31:28'),
(39, 5, 3, 3, 4.50, 100.00, 450.00, '2024-07-25 08:31:28', '2024-07-25 08:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` bigint UNSIGNED NOT NULL,
  `item_id` int NOT NULL,
  `total_cost` double NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipe_status` tinyint NOT NULL DEFAULT '0',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `item_id`, `total_cost`, `note`, `recipe_status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 10, 80, NULL, 1, 1, 1, '2024-07-10 06:18:59', '2024-07-16 07:10:56'),
(2, 11, 210, NULL, 1, 1, 1, '2024-07-10 06:19:29', '2024-07-16 07:10:52'),
(3, 9, 60, NULL, 1, 1, 1, '2024-07-10 06:19:51', '2024-07-16 07:10:47'),
(4, 13, 114.1, NULL, 1, 1, 1, '2024-07-13 09:12:35', '2024-07-16 07:10:22'),
(7, 15, 56, NULL, 1, 1, 1, '2024-07-13 09:36:06', '2024-07-16 07:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_details`
--

CREATE TABLE `recipe_details` (
  `id` bigint UNSIGNED NOT NULL,
  `recipe_id` bigint UNSIGNED NOT NULL,
  `raw_material_id` int NOT NULL,
  `sub_quantity` double(10,3) NOT NULL,
  `sub_unit_price` double(10,2) NOT NULL,
  `sub_unit_id` int NOT NULL,
  `main_unit_id` int NOT NULL,
  `main_quantity` double(10,3) NOT NULL,
  `main_unit_price` double(10,2) NOT NULL,
  `cost` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipe_details`
--

INSERT INTO `recipe_details` (`id`, `recipe_id`, `raw_material_id`, `sub_quantity`, `sub_unit_price`, `sub_unit_id`, `main_unit_id`, `main_quantity`, `main_unit_price`, `cost`, `created_at`, `updated_at`) VALUES
(27, 7, 14, 100.000, 0.12, 2, 1, 0.100, 120.00, 12, '2024-07-16 07:09:56', '2024-07-16 07:09:56'),
(28, 7, 2, 20.000, 0.10, 2, 1, 0.020, 100.00, 2, '2024-07-16 07:09:56', '2024-07-16 07:09:56'),
(29, 7, 1, 100.000, 0.40, 2, 1, 0.100, 400.00, 40, '2024-07-16 07:09:56', '2024-07-16 07:09:56'),
(30, 7, 3, 20.000, 0.10, 2, 1, 0.020, 100.00, 2, '2024-07-16 07:09:56', '2024-07-16 07:09:56'),
(35, 3, 4, 100.000, 0.10, 2, 1, 0.100, 100.00, 10, '2024-07-16 07:10:47', '2024-07-16 07:10:47'),
(36, 3, 5, 100.000, 0.10, 2, 1, 0.100, 100.00, 10, '2024-07-16 07:10:47', '2024-07-16 07:10:47'),
(37, 3, 1, 100.000, 0.40, 2, 1, 0.100, 400.00, 40, '2024-07-16 07:10:47', '2024-07-16 07:10:47'),
(38, 2, 7, 100.000, 1.00, 2, 1, 0.100, 1000.00, 100, '2024-07-16 07:10:52', '2024-07-16 07:10:52'),
(39, 2, 6, 100.000, 1.00, 2, 1, 0.100, 1000.00, 100, '2024-07-16 07:10:52', '2024-07-16 07:10:52'),
(40, 2, 5, 100.000, 0.10, 2, 1, 0.100, 100.00, 10, '2024-07-16 07:10:52', '2024-07-16 07:10:52'),
(41, 1, 7, 50.000, 1.00, 2, 1, 0.050, 1000.00, 50, '2024-07-16 07:10:56', '2024-07-16 07:10:56'),
(42, 1, 8, 1.000, 20.00, 7, 7, 1.000, 20.00, 20, '2024-07-16 07:10:56', '2024-07-16 07:10:56'),
(43, 1, 3, 50.000, 0.10, 2, 1, 0.050, 100.00, 5, '2024-07-16 07:10:56', '2024-07-16 07:10:56'),
(44, 1, 2, 50.000, 0.10, 2, 1, 0.050, 100.00, 5, '2024-07-16 07:10:56', '2024-07-16 07:10:56'),
(45, 4, 14, 100.000, 0.12, 2, 1, 0.100, 120.00, 12, '2024-07-25 08:23:12', '2024-07-25 08:23:12'),
(46, 4, 7, 100.000, 1.00, 2, 1, 0.100, 1000.00, 100, '2024-07-25 08:23:12', '2024-07-25 08:23:12'),
(47, 4, 5, 20.000, 0.10, 2, 1, 0.020, 100.00, 2, '2024-07-25 08:23:12', '2024-07-25 08:23:12'),
(48, 4, 2, 1.000, 0.10, 2, 1, 0.001, 0.00, 0, '2024-07-25 08:23:12', '2024-07-25 08:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `is_superadmin` tinyint DEFAULT '0',
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `is_superadmin`, `role`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 1, NULL, NULL),
(2, 0, 'HR Manager', 1, '2024-07-06 11:12:52', '2024-07-06 11:12:52'),
(3, 0, 'Sales Representative', 1, '2024-07-06 12:37:01', '2024-07-06 12:37:01'),
(4, 0, 'Delivery Man', 1, '2024-07-13 11:25:14', '2024-07-13 11:25:14'),
(5, 0, 'Chef', 1, '2024-07-29 09:27:08', '2024-07-29 09:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `salary_processes`
--

CREATE TABLE `salary_processes` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_salary` double(20,2) NOT NULL,
  `bonus` double(20,2) NOT NULL DEFAULT '0.00',
  `overtime` double(20,2) NOT NULL DEFAULT '0.00',
  `others` double(20,2) NOT NULL DEFAULT '0.00',
  `absent` double(20,2) NOT NULL DEFAULT '0.00',
  `late` double(20,2) NOT NULL DEFAULT '0.00',
  `loan` double(20,2) NOT NULL DEFAULT '0.00',
  `net_payable` double(20,2) NOT NULL DEFAULT '0.00',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_processes`
--

INSERT INTO `salary_processes` (`id`, `employee_id`, `year`, `month`, `basic_salary`, `bonus`, `overtime`, `others`, `absent`, `late`, `loan`, `net_payable`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024', '07', 20000.00, 10000.00, 0.00, 0.00, 11000.00, 2000.00, 0.00, 17000.00, 1, NULL, '2024-07-24 08:47:58', '2024-07-25 09:11:10'),
(2, 2, '2024', '07', 40000.00, 5500.00, 0.00, 0.00, 22000.00, 0.00, 0.00, 23500.00, 1, NULL, '2024-07-24 08:47:58', '2024-07-25 09:11:10'),
(3, 3, '2024', '07', 50000.00, 2000.00, 0.00, 0.00, 27500.00, 0.00, 0.00, 24500.00, 1, NULL, '2024-07-24 08:47:58', '2024-07-25 09:11:10'),
(4, 4, '2024', '07', 35000.00, 3500.00, 0.00, 0.00, 19250.00, 0.00, 0.00, 19250.00, 1, NULL, '2024-07-24 08:47:58', '2024-07-25 09:11:10'),
(5, 5, '2024', '07', 15000.00, 7500.00, 281.25, 0.00, 8250.00, 0.00, 0.00, 14531.25, 1, NULL, '2024-07-24 08:47:58', '2024-07-25 09:11:10'),
(6, 6, '2024', '07', 35000.00, 8000.00, 0.00, 0.00, 19250.00, 0.00, 0.00, 23750.00, 1, NULL, '2024-07-24 08:47:58', '2024-07-25 09:11:10'),
(7, 7, '2024', '07', 50000.00, 2000.00, 0.00, 0.00, 27500.00, 0.00, 0.00, 24500.00, 1, NULL, '2024-07-24 08:47:58', '2024-07-25 09:11:10'),
(8, 8, '2024', '07', 50000.00, 7000.00, 0.00, 0.00, 27500.00, 0.00, 0.00, 29500.00, 1, NULL, '2024-07-24 08:47:58', '2024-07-25 09:11:10'),
(9, 9, '2024', '07', 50000.00, 6000.00, 0.00, 0.00, 27500.00, 0.00, 0.00, 28500.00, 1, NULL, '2024-07-24 08:47:58', '2024-07-25 09:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `salary_process_temps`
--

CREATE TABLE `salary_process_temps` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_salary` double(20,2) NOT NULL,
  `bonus` double(20,2) NOT NULL DEFAULT '0.00',
  `overtime` double(20,2) NOT NULL DEFAULT '0.00',
  `others` double(20,2) NOT NULL DEFAULT '0.00',
  `absent` double(20,2) NOT NULL DEFAULT '0.00',
  `late` double(20,2) NOT NULL DEFAULT '0.00',
  `loan` double(20,2) NOT NULL DEFAULT '0.00',
  `net_payable` double(20,2) NOT NULL DEFAULT '0.00',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_histories`
--

CREATE TABLE `stock_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `item_id` int NOT NULL,
  `date` date NOT NULL,
  `particular` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_in_qty` double(20,2) NOT NULL DEFAULT '0.00',
  `stock_out_qty` double(20,2) NOT NULL DEFAULT '0.00',
  `rate` double(20,2) NOT NULL DEFAULT '0.00',
  `current_stock` double(20,2) NOT NULL DEFAULT '0.00',
  `created_by_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_histories`
--

INSERT INTO `stock_histories` (`id`, `item_id`, `date`, `particular`, `stock_in_qty`, `stock_out_qty`, `rate`, `current_stock`, `created_by_id`, `created_at`, `updated_at`) VALUES
(1, 31, '2024-07-01', 'Opening Stock', 50.00, 0.00, 25.00, 50.00, 1, '2024-07-01 09:46:39', '2024-07-01 09:46:39'),
(2, 32, '2024-07-01', 'Opening Stock', 100.00, 0.00, 20.00, 100.00, 1, '2024-07-01 09:50:49', '2024-07-01 09:50:49'),
(3, 33, '2024-07-01', 'Opening Stock', 20.00, 0.00, 200.00, 20.00, 1, '2024-07-01 09:56:09', '2024-07-01 09:56:09'),
(4, 31, '2024-07-01', 'Purchase', 100.00, 0.00, 25.00, 150.00, 1, '2024-07-01 10:03:40', '2024-07-01 10:03:40'),
(5, 32, '2024-07-01', 'Purchase', 50.00, 0.00, 20.00, 150.00, 1, '2024-07-01 10:03:40', '2024-07-01 10:03:40'),
(6, 32, '2024-07-01', 'Sales', 0.00, 20.00, 30.00, 130.00, 1, '2024-07-01 10:04:41', '2024-07-01 10:04:41'),
(7, 31, '2024-07-01', 'Sales', 0.00, 10.00, 30.00, 140.00, 1, '2024-07-01 10:04:42', '2024-07-01 10:04:42'),
(8, 31, '2024-07-01', 'Sales', 0.00, 10.00, 30.00, 130.00, 1, '2024-07-01 12:54:07', '2024-07-01 12:54:07'),
(9, 32, '2024-07-01', 'Sales', 0.00, 10.00, 30.00, 120.00, 1, '2024-07-01 12:54:07', '2024-07-01 12:54:07'),
(10, 14, '2024-07-01', 'Sales', 0.00, 1.00, 60.00, -1.00, 1, '2024-07-01 12:54:56', '2024-07-01 12:54:56'),
(11, 31, '2024-07-01', 'Sales', 0.00, 5.00, 30.00, 125.00, 1, '2024-07-01 12:55:54', '2024-07-01 12:55:54'),
(12, 32, '2024-07-01', 'Sales', 0.00, 5.00, 30.00, 115.00, 1, '2024-07-01 12:55:54', '2024-07-01 12:55:54'),
(13, 31, '2024-07-01', 'Sales', 0.00, 50.00, 30.00, 75.00, 10, '2024-07-01 15:05:12', '2024-07-01 15:05:12'),
(14, 32, '2024-07-01', 'Sales', 0.00, 10.00, 30.00, 105.00, 10, '2024-07-01 15:05:12', '2024-07-01 15:05:12'),
(15, 18, '0000-00-00', NULL, 0.00, 0.00, 0.00, -1.00, 1, '2024-07-04 11:21:14', '2024-07-04 11:21:14'),
(16, 33, '0000-00-00', NULL, 0.00, 0.00, 0.00, 19.00, 1, '2024-07-04 11:21:14', '2024-07-04 11:21:14'),
(17, 1, '2024-07-07', 'Opening Stock', 10.00, 0.00, 400.00, 10.00, 1, '2024-07-07 13:22:29', '2024-07-07 13:22:29'),
(18, 2, '2024-07-07', 'Opening Stock', 10.00, 0.00, 100.00, 10.00, 1, '2024-07-07 13:24:43', '2024-07-07 13:24:43'),
(19, 3, '2024-07-07', 'Opening Stock', 10.00, 0.00, 100.00, 10.00, 1, '2024-07-07 13:37:10', '2024-07-07 13:37:10'),
(20, 4, '2024-07-07', 'Opening Stock', 10.00, 0.00, 100.00, 10.00, 1, '2024-07-07 13:37:58', '2024-07-07 13:37:58'),
(21, 5, '2024-07-07', 'Opening Stock', 5.00, 0.00, 100.00, 5.00, 1, '2024-07-07 13:39:13', '2024-07-07 13:39:13'),
(22, 6, '2024-07-07', 'Opening Stock', 5.00, 0.00, 1000.00, 5.00, 1, '2024-07-07 13:44:14', '2024-07-07 13:44:14'),
(23, 7, '2024-07-07', 'Opening Stock', 5.00, 0.00, 1000.00, 5.00, 1, '2024-07-07 13:51:00', '2024-07-07 13:51:00'),
(24, 8, '2024-07-07', 'Opening Stock', 100.00, 0.00, 20.00, 100.00, 1, '2024-07-07 13:53:59', '2024-07-07 13:53:59'),
(25, 7, '2024-07-07', 'Purchase', 10.00, 0.00, 1000.00, 15.00, 1, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(26, 8, '2024-07-07', 'Purchase', 10.00, 0.00, 20.00, 110.00, 1, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(27, 1, '2024-07-07', 'Purchase', 10.00, 0.00, 400.00, 20.00, 1, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(28, 6, '2024-07-07', 'Purchase', 10.00, 0.00, 1000.00, 15.00, 1, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(29, 4, '2024-07-07', 'Purchase', 10.00, 0.00, 100.00, 20.00, 1, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(30, 2, '2024-07-07', 'Purchase', 10.00, 0.00, 100.00, 20.00, 1, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(31, 5, '2024-07-07', 'Purchase', 10.00, 0.00, 100.00, 15.00, 1, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(32, 3, '2024-07-07', 'Purchase', 10.00, 0.00, 100.00, 20.00, 1, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(33, 12, '2024-07-09', 'Opening Stock', 10.00, 0.00, 200.00, 10.00, 1, '2024-07-09 06:59:04', '2024-07-09 06:59:04'),
(34, 7, '2024-07-11', 'Purchase', 15.00, 0.00, 1000.00, 30.00, 1, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(35, 8, '2024-07-11', 'Purchase', 100.00, 0.00, 20.00, 210.00, 1, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(36, 6, '2024-07-11', 'Purchase', 10.00, 0.00, 1000.00, 25.00, 1, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(37, 1, '2024-07-11', 'Purchase', 10.00, 0.00, 400.00, 30.00, 1, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(38, 4, '2024-07-11', 'Purchase', 10.00, 0.00, 100.00, 30.00, 1, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(39, 2, '2024-07-11', 'Purchase', 5.00, 0.00, 100.00, 25.00, 1, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(40, 5, '2024-07-11', 'Purchase', 20.00, 0.00, 100.00, 35.00, 1, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(41, 3, '2024-07-11', 'Purchase', 10.00, 0.00, 100.00, 30.00, 1, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(42, 14, '2024-07-13', 'Opening Stock', 0.00, 0.00, 120.00, 0.00, 1, '2024-07-13 09:11:00', '2024-07-13 09:11:00'),
(43, 7, '2024-07-14', 'Purchase', 10.00, 0.00, 1000.00, 40.00, 1, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(44, 1, '2024-07-14', 'Purchase', 15.00, 0.00, 400.00, 45.00, 1, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(45, 2, '2024-07-14', 'Purchase', 3.10, 0.00, 100.00, 28.10, 1, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(46, 5, '2024-07-14', 'Purchase', 2.00, 0.00, 100.00, 37.00, 1, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(47, 14, '2024-07-14', 'Purchase', 25.00, 0.00, 120.00, 25.00, 1, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(48, 3, '2024-07-14', 'Purchase', 3.00, 0.00, 100.00, 33.00, 1, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(49, 5, '2024-07-14', 'Purchase', 1.00, 0.00, 100.00, 38.00, 1, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(50, 12, '2024-07-14', 'Purchase', 1.00, 0.00, 200.00, 11.00, 1, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(51, 5, '2024-07-14', 'Purchase', 1.00, 0.00, 100.00, 39.00, 1, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(52, 7, '2024-07-25', 'Purchase', 16.50, 0.00, 1000.00, 56.50, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(53, 8, '2024-07-25', 'Purchase', 30.00, 0.00, 20.00, 240.00, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(54, 6, '2024-07-25', 'Purchase', 5.00, 0.00, 1000.00, 30.00, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(55, 1, '2024-07-25', 'Purchase', 17.00, 0.00, 400.00, 62.00, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(56, 4, '2024-07-25', 'Purchase', 2.00, 0.00, 100.00, 32.00, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(57, 2, '2024-07-25', 'Purchase', 4.60, 0.00, 100.00, 32.70, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(58, 5, '2024-07-25', 'Purchase', 9.00, 0.00, 100.00, 48.00, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(59, 14, '2024-07-25', 'Purchase', 25.00, 0.00, 120.00, 50.00, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(60, 3, '2024-07-25', 'Purchase', 4.50, 0.00, 100.00, 37.50, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(61, 8, '2024-07-25', 'Purchase', 1.00, 0.00, 20.00, 241.00, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(62, 1, '2024-07-25', 'Purchase', 1.00, 0.00, 400.00, 63.00, 1, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(63, 7, '2024-07-25', 'Purchase', 16.50, 0.00, 1000.00, 73.00, 1, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(64, 8, '2024-07-25', 'Purchase', 30.00, 0.00, 20.00, 271.00, 1, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(65, 6, '2024-07-25', 'Purchase', 5.00, 0.00, 1000.00, 35.00, 1, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(66, 1, '2024-07-25', 'Purchase', 17.00, 0.00, 400.00, 80.00, 1, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(67, 4, '2024-07-25', 'Purchase', 2.00, 0.00, 100.00, 34.00, 1, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(68, 2, '2024-07-25', 'Purchase', 4.60, 0.00, 100.00, 37.30, 1, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(69, 5, '2024-07-25', 'Purchase', 9.00, 0.00, 100.00, 57.00, 1, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(70, 1, '0000-00-00', NULL, 0.00, 0.00, 0.00, 79.00, 1, '2024-07-25 08:54:27', '2024-07-25 08:54:27'),
(71, 6, '0000-00-00', NULL, 0.00, 0.00, 0.00, 34.00, 1, '2024-07-25 08:54:27', '2024-07-25 08:54:27'),
(72, 1, '0000-00-00', NULL, 0.00, 0.00, 0.00, 78.00, 1, '2024-07-25 08:54:27', '2024-07-25 08:54:27'),
(73, 7, '2024-07-25', 'Purchase', 1.00, 0.00, 1000.00, 74.00, 1, '2024-07-25 08:55:02', '2024-07-25 08:55:02'),
(74, 2, '2024-07-25', 'Purchase', 1.00, 0.00, 100.00, 38.30, 1, '2024-07-25 08:55:02', '2024-07-25 08:55:02'),
(75, 3, '2024-07-25', 'Purchase', 1.00, 0.00, 100.00, 38.50, 1, '2024-07-25 08:55:02', '2024-07-25 08:55:02'),
(76, 5, '2024-07-25', 'Purchase', 1.00, 0.00, 100.00, 58.00, 1, '2024-07-25 08:55:16', '2024-07-25 08:55:16'),
(77, 12, '2024-07-25', 'Purchase', 1.00, 0.00, 200.00, 12.00, 1, '2024-07-25 08:55:16', '2024-07-25 08:55:16'),
(78, 1, '2024-07-25', 'Purchase', 1.00, 0.00, 400.00, 79.00, 1, '2024-07-25 08:55:16', '2024-07-25 08:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `organization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_payable` double(20,2) NOT NULL DEFAULT '0.00',
  `opening_receivable` double(20,2) NOT NULL DEFAULT '0.00',
  `current_balance` double(20,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`, `organization`, `opening_payable`, `opening_receivable`, `current_balance`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 'Anamul Islam', 'puqor@mailinator.com', '01839317038', 'Vel dolor sunt simil', 'Owens Torres LLC', 100.00, 0.00, 10100.00, '1', 1, NULL, '2024-07-01 06:31:49', '2024-07-25 08:56:58'),
(2, 'Malek Azad', 'zacikoqac@mailinator.com', '01839317038', 'Suscipit voluptatem', 'Webster and Barton Trading', 0.00, 1000.00, -1000.00, '1', 1, NULL, '2024-07-01 06:32:42', '2024-07-01 06:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_ledgers`
--

CREATE TABLE `supplier_ledgers` (
  `id` bigint UNSIGNED NOT NULL,
  `supplier_id` int NOT NULL,
  `purchase_id` int DEFAULT NULL,
  `payment_id` int DEFAULT NULL,
  `particular` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `debit_amount` double(20,2) NOT NULL,
  `credit_amount` double(20,2) NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by_id` int DEFAULT NULL,
  `updated_by_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_ledgers`
--

INSERT INTO `supplier_ledgers` (`id`, `supplier_id`, `purchase_id`, `payment_id`, `particular`, `date`, `debit_amount`, `credit_amount`, `note`, `status`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'Opening Payable', '2024-07-01', 0.00, 100.00, NULL, 1, 1, NULL, '2024-07-01 06:31:49', '2024-07-01 06:31:49'),
(2, 2, NULL, NULL, 'Opening Receivable', '2024-07-01', 1000.00, 0.00, NULL, 1, 1, NULL, '2024-07-01 06:32:42', '2024-07-01 06:32:42'),
(3, 1, 1, NULL, 'Purchase', '2024-07-01', 0.00, 3500.00, NULL, 1, 1, NULL, '2024-07-01 10:03:40', '2024-07-01 10:03:40'),
(4, 1, NULL, 1, 'Paid To Supplier', '2024-07-01', 3500.00, 0.00, NULL, 1, 1, NULL, '2024-07-01 10:03:40', '2024-07-01 10:03:40'),
(5, 1, 2, NULL, 'Purchase', '2024-07-07', 0.00, 28200.00, NULL, 1, 1, NULL, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(6, 1, NULL, 2, 'Paid To Supplier', '2024-07-07', 28200.00, 0.00, NULL, 1, 1, NULL, '2024-07-07 14:31:00', '2024-07-07 14:31:00'),
(7, 1, 3, NULL, 'Purchase', '2024-07-11', 0.00, 35500.00, 'Note', 1, 1, NULL, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(8, 1, NULL, 3, 'Paid To Supplier', '2024-07-11', 35500.00, 0.00, 'Note', 1, 1, NULL, '2024-07-11 13:01:47', '2024-07-11 13:01:47'),
(9, 1, 4, NULL, 'Purchase', '2024-07-14', 0.00, 19805.80, NULL, 1, 1, NULL, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(10, 1, NULL, 4, 'Paid To Supplier', '2024-07-14', 19805.80, 0.00, NULL, 1, 1, NULL, '2024-07-13 10:20:41', '2024-07-13 10:20:41'),
(11, 1, 5, NULL, 'Purchase', '2024-07-25', 0.00, 34330.00, NULL, 1, 1, NULL, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(12, 1, NULL, 5, 'Paid To Supplier', '2024-07-25', 34330.00, 0.00, NULL, 1, 1, NULL, '2024-07-25 08:34:48', '2024-07-25 08:34:48'),
(13, 1, 6, NULL, 'Purchase', '2024-07-25', 0.00, 30460.00, NULL, 1, 1, NULL, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(14, 1, NULL, 6, 'Paid To Supplier', '2024-07-25', 15460.00, 0.00, NULL, 1, 1, NULL, '2024-07-25 08:37:06', '2024-07-25 08:37:06'),
(15, 1, NULL, 7, 'Paid To Supplier', '2024-07-25', 5000.00, 0.00, NULL, 1, 1, NULL, '2024-07-25 08:52:48', '2024-07-25 08:52:48'),
(17, 1, 7, NULL, 'Purchase', '2024-07-25', 0.00, 1200.00, NULL, 1, 1, NULL, '2024-07-25 08:55:02', '2024-07-25 08:55:02'),
(18, 1, 8, NULL, 'Purchase', '2024-07-25', 0.00, 700.00, NULL, 1, 1, NULL, '2024-07-25 08:55:16', '2024-07-25 08:55:16'),
(19, 1, NULL, 9, 'Paid To Supplier', '2024-07-25', 1200.00, 0.00, NULL, 1, 1, NULL, '2024-07-25 08:56:58', '2024-07-25 08:56:58'),
(20, 1, NULL, 10, 'Paid To Supplier', '2024-07-25', 700.00, 0.00, NULL, 1, 1, NULL, '2024-07-25 08:56:58', '2024-07-25 08:56:58'),
(21, 1, NULL, 11, 'Paid In Advanced', '2024-07-25', 3100.00, 0.00, NULL, 1, 1, NULL, '2024-07-25 08:56:58', '2024-07-25 08:56:58');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint UNSIGNED NOT NULL,
  `is_default` tinyint DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_seat` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `is_available` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `is_default`, `title`, `total_seat`, `status`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 0, 'Table - 01', 6, 1, 0, '2024-03-21 09:55:03', '2024-07-04 11:34:20'),
(2, 0, 'Table - 02', 5, 1, 1, '2024-03-21 10:04:04', '2024-06-30 09:10:25'),
(3, 0, 'Table - 03', 4, 1, 0, '2024-03-21 10:04:29', '2024-07-04 11:44:35'),
(4, 0, 'Table - 04', 3, 1, 1, '2024-03-21 10:04:43', '2024-06-30 13:40:39'),
(5, 0, 'Table - 05', 2, 1, 0, '2024-03-21 10:04:51', '2024-07-13 11:08:29'),
(6, 1, 'Parcel', 7, 1, 1, '2024-03-21 10:05:02', '2024-06-29 13:35:25'),
(11, 0, 'Table - 06', 10, 1, 1, '2024-06-30 13:48:45', '2024-06-30 13:48:45'),
(12, 0, 'Table - 07', 10, 1, 1, '2024-06-30 13:56:12', '2024-07-28 09:47:21'),
(13, 0, 'Table - 10', 10, 1, 1, '2024-06-30 13:56:44', '2024-07-16 09:34:05'),
(14, 0, 'Table - 08', 10, 1, 1, '2024-06-30 13:57:13', '2024-07-16 09:34:38'),
(15, 0, 'Table - 09', 10, 1, 0, '2024-06-30 13:57:23', '2024-07-31 09:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint UNSIGNED NOT NULL,
  `is_default` tinyint DEFAULT NULL,
  `unit_type` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `is_default`, `unit_type`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'weight', 'kg', 1, NULL, NULL),
(2, 1, 'weight', 'gm', 1, '2024-07-07 11:35:07', '2024-07-07 11:35:07'),
(3, 1, 'volume', 'ltr', 1, '2024-07-07 11:40:57', '2024-07-07 11:40:57'),
(4, 1, 'volume', 'ml', 1, '2024-07-07 11:41:13', '2024-07-07 11:41:13'),
(7, 1, 'count', 'pcs', 1, '2024-07-07 11:47:05', '2024-07-07 11:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `google_id`, `facebook_id`, `phone`, `default_address`, `image`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Malek Azad', 'admin@gmail.com', '$2y$10$nfBiU5lwi0SMVZQryw7YqeXOjO1D5fC.wrw8nyw9NSDS6T/MwxhI6', NULL, NULL, '01839317038', 'Companygonj, Noakhali.', '', NULL, NULL, NULL, '2024-01-24 09:45:33'),
(3, 'Nowab Shorif', 'nsanoman@gmail.com', '$2y$10$eadL0JnVW4Y/VSnnHqbA1.7KwQuarPcHvDXAYFM7eYVDR7N0z0MCy', NULL, NULL, '01839317038', 'Companygonj, Noakhali.', '', NULL, 'nkQUqfBv58y9RV4P1C4R3b1ZmgLb9cydgN11XpPibDSsiu17Z23oLRX9QgeV', '2024-01-02 12:59:51', '2024-01-29 10:15:29'),
(4, 'Nowab Shorif', 'noman@gmail.com', '$2y$10$oY8fbyLIFiPPAtT2EjNA5em9FZas8N.xgYG.veh0T98FRW.8OD.hG', NULL, NULL, '01839317038', 'Companygonj, Noakhali.', NULL, NULL, NULL, '2024-01-14 06:30:18', '2024-01-14 06:30:18'),
(5, 'Nowab Shorif', 'aman@gmail.com', '$2y$10$XYof07GT8QRRv0qaqPiZpu78Wsv5GP2AJR5Fs7WtzXHAgD49T8dI6', NULL, NULL, '234567890', 'Companygonj, Noakhali.', NULL, NULL, NULL, '2024-01-14 06:33:19', '2024-01-14 06:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_holidays`
--

CREATE TABLE `weekly_holidays` (
  `id` bigint UNSIGNED NOT NULL,
  `saturday` tinyint NOT NULL DEFAULT '0',
  `sunday` tinyint NOT NULL DEFAULT '0',
  `monday` tinyint NOT NULL DEFAULT '0',
  `tuesday` tinyint NOT NULL DEFAULT '0',
  `wednesday` tinyint NOT NULL DEFAULT '0',
  `thursday` tinyint NOT NULL DEFAULT '0',
  `friday` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weekly_holidays`
--

INSERT INTO `weekly_holidays` (`id`, `saturday`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0, 0, 0, 1, '2024-06-01 08:41:59', '2024-07-25 09:02:02');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `attendance_processes`
--
ALTER TABLE `attendance_processes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance_process_details`
--
ALTER TABLE `attendance_process_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `basic_infos`
--
ALTER TABLE `basic_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `category_types`
--
ALTER TABLE `category_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_details`
--
ALTER TABLE `expense_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense_heads`
--
ALTER TABLE `expense_heads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `h_r_settings`
--
ALTER TABLE `h_r_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `issue_items`
--
ALTER TABLE `issue_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `issue_item_details`
--
ALTER TABLE `issue_item_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan_installments`
--
ALTER TABLE `loan_installments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppd_raw_materials`
--
ALTER TABLE `ppd_raw_materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `pp_details`
--
ALTER TABLE `pp_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `production_plans`
--
ALTER TABLE `production_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `purchase_requisitions`
--
ALTER TABLE `purchase_requisitions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_requisition_details`
--
ALTER TABLE `purchase_requisition_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipe_details`
--
ALTER TABLE `recipe_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salary_processes`
--
ALTER TABLE `salary_processes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `salary_process_temps`
--
ALTER TABLE `salary_process_temps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_histories`
--
ALTER TABLE `stock_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_ledgers`
--
ALTER TABLE `supplier_ledgers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `weekly_holidays`
--
ALTER TABLE `weekly_holidays`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `recipe_details_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
