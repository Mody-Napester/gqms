-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2019 at 02:22 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gqms`
--

-- --------------------------------------------------------

--
-- Table structure for table `desks`
--

CREATE TABLE `desks` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor_id` int(11) NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desks`
--

INSERT INTO `desks` (`id`, `uuid`, `floor_id`, `ip`, `name_ar`, `name_en`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'd4b5d9a2-d0bd-4b78-ac96-bc1c94dabed6', 1, '10.1.35.193', 'شباك 1', 'D1', 1, 1, 1, NULL, '2019-04-11 17:17:28', '2019-04-15 06:34:45'),
(2, 'c4d2d5ef-05ec-4b9a-b237-0a74a568d4dd', 1, '192.168.1.5', 'شباك 5', 'D5', 1, 1, 1, NULL, '2019-04-11 21:11:44', '2019-04-13 12:35:47');

-- --------------------------------------------------------

--
-- Table structure for table `desk_queues`
--

CREATE TABLE `desk_queues` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor_id` int(11) NOT NULL,
  `desk_id` int(11) DEFAULT NULL,
  `queue_number` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desk_queues`
--

INSERT INTO `desk_queues` (`id`, `uuid`, `floor_id`, `desk_id`, `queue_number`, `status`, `created_at`, `updated_at`) VALUES
(44, '4de7d9f8-a688-4fe0-8965-e575abb45452', 1, 1, 101, 4, '2019-04-14 20:54:20', '2019-04-14 20:58:02'),
(45, '8ec82f01-da2d-44b6-8077-5b5082f33453', 1, 1, 102, 4, '2019-04-14 20:54:32', '2019-04-14 20:59:36'),
(46, 'fd7f9a49-879b-46dd-941b-27e47d4338c2', 1, 1, 103, 4, '2019-04-14 20:59:00', '2019-04-14 20:59:58'),
(47, 'a7a52b66-0642-4261-ab3e-ae0ce5869014', 1, 1, 101, 4, '2019-04-15 06:47:11', '2019-04-15 08:24:15'),
(48, '66404c41-a77c-4efe-9868-8155f8362dc8', 1, 1, 102, 4, '2019-04-15 06:47:13', '2019-04-15 08:24:17'),
(49, 'd1def99f-564d-4c78-a5aa-c785fa7e7b97', 1, 1, 103, 3, '2019-04-15 06:47:14', '2019-04-15 08:24:46'),
(50, 'd3ac616e-1a31-420e-9584-2036cda9c894', 1, 1, 104, 4, '2019-04-15 06:47:16', '2019-04-15 08:30:58'),
(51, 'fc3046a8-5587-4b96-b12a-429551554eaf', 1, 1, 105, 3, '2019-04-15 07:17:23', '2019-04-15 08:31:02'),
(52, 'b8ee632e-ca3f-49a1-9b83-c80ac4453d37', 1, 1, 106, 4, '2019-04-15 07:22:54', '2019-04-15 08:31:07'),
(53, '44b747f7-d8ba-4362-aff2-400fec9e498f', 1, 1, 107, 4, '2019-04-15 07:29:09', '2019-04-15 08:31:08'),
(54, '655993df-02ac-4079-bf86-e8fdd75170f8', 1, 1, 108, 4, '2019-04-15 07:41:51', '2019-04-15 09:02:50'),
(55, '2a0e4643-a487-49ee-9ae9-0b4894576397', 1, 1, 109, 4, '2019-04-15 07:43:15', '2019-04-15 09:54:10'),
(56, '02ceca06-4835-424f-99d4-5de317a1540c', 1, 1, 110, 4, '2019-04-15 07:47:06', '2019-04-15 09:54:19'),
(57, '875f395f-e45d-43c2-9aee-cc07a1ca664a', 1, 1, 111, 4, '2019-04-15 07:47:08', '2019-04-15 10:26:04'),
(58, '4efc6836-4fb4-43ab-8568-9034384d7461', 1, 1, 112, 4, '2019-04-15 07:49:53', '2019-04-15 10:26:18'),
(59, '8945ccb0-d3ce-4375-a1b3-355b8505ca3d', 1, 1, 113, 4, '2019-04-15 07:50:28', '2019-04-15 10:29:12'),
(60, '7e25bc28-3b4e-4bf8-ab3d-4af0f90fa3b8', 1, 1, 114, 4, '2019-04-15 07:55:00', '2019-04-15 10:29:26'),
(61, '940fa205-e0b9-44b0-b5b0-b020a465bf8f', 1, 1, 115, 3, '2019-04-15 08:16:02', '2019-04-15 11:37:31'),
(62, 'a987f003-e5ba-40b7-96f5-a763594274fe', 1, 1, 116, 3, '2019-04-15 08:16:11', '2019-04-15 11:37:44'),
(63, '01b7f2f2-362a-4c7e-86a8-06b98114e296', 1, 1, 117, 4, '2019-04-15 08:17:21', '2019-04-15 13:42:16'),
(64, '4f1b25e9-a5d4-45a2-842f-8380b28a6380', 1, 1, 118, 3, '2019-04-15 08:20:36', '2019-04-15 13:44:12'),
(65, '4b4f97c1-c16a-4d0e-a795-5c2e41eb0f11', 1, 1, 119, 2, '2019-04-15 08:21:52', '2019-04-15 13:44:12'),
(66, '27c24ee4-d2ca-4728-af13-6bc84d1755ab', 1, NULL, 120, 1, '2019-04-15 08:23:05', '2019-04-15 08:23:05'),
(67, 'c5e82142-b72e-48d0-a13a-69ed6286a125', 1, NULL, 121, 1, '2019-04-15 08:23:35', '2019-04-15 08:23:35'),
(68, '99c78bfa-c959-428a-81ad-e61fb4338612', 1, NULL, 122, 1, '2019-04-15 08:23:47', '2019-04-15 08:23:47'),
(69, 'bdb2ada0-566d-4c8d-8f44-0cb7c8ca5634', 1, NULL, 123, 1, '2019-04-15 08:24:27', '2019-04-15 08:24:27'),
(70, '1830eb88-9b7b-49bc-89c1-185741618dae', 1, NULL, 124, 1, '2019-04-15 08:32:30', '2019-04-15 08:32:30'),
(71, 'f0c4a51e-c61b-492c-8858-1363921b0f20', 1, NULL, 125, 1, '2019-04-15 08:51:19', '2019-04-15 08:51:19'),
(72, '392bfcb4-e9c8-484e-9819-bc0d9bdb2f12', 1, NULL, 126, 1, '2019-04-15 08:54:45', '2019-04-15 08:54:45'),
(73, '2649ad76-4c45-498e-8128-95540709a6e5', 1, NULL, 127, 1, '2019-04-15 08:55:16', '2019-04-15 08:55:16'),
(74, '3f992664-bb75-47b9-b178-2cdb2d19a375', 1, NULL, 128, 1, '2019-04-15 08:56:11', '2019-04-15 08:56:11'),
(75, '46036743-fc5e-42d6-bcc6-fb517d14a410', 1, NULL, 129, 1, '2019-04-15 08:56:39', '2019-04-15 08:56:39'),
(76, 'd63d0a65-f7b6-4c06-8aa5-c8d8210b4ed0', 1, NULL, 130, 1, '2019-04-15 08:57:05', '2019-04-15 08:57:05'),
(77, 'd856f266-4770-4934-8bd4-cc0b28c17dee', 1, NULL, 131, 1, '2019-04-15 09:05:01', '2019-04-15 09:05:01'),
(78, '8f4c5bec-1af5-4ff9-847a-75bd9560b660', 1, NULL, 132, 1, '2019-04-15 09:40:59', '2019-04-15 09:40:59'),
(79, '80fef640-82bc-4bd0-afaa-034123c40da2', 1, NULL, 133, 1, '2019-04-15 09:41:56', '2019-04-15 09:41:56'),
(80, '9906f3f4-17b5-4d7c-a31b-6be73de07c72', 1, NULL, 134, 1, '2019-04-15 09:42:00', '2019-04-15 09:42:00'),
(81, 'ab506c1e-6bfd-4d66-bbda-322fa530f41f', 1, NULL, 135, 1, '2019-04-15 09:52:46', '2019-04-15 09:52:46'),
(82, '74046f6b-be73-4d35-b6ba-91c54eb5ede4', 1, NULL, 136, 1, '2019-04-15 09:53:01', '2019-04-15 09:53:01'),
(83, 'b900d6a0-44c8-42ea-bcff-22594f6ae1bf', 1, NULL, 137, 1, '2019-04-15 09:53:16', '2019-04-15 09:53:16'),
(84, 'a99f6c2c-d428-474b-863a-c3888b5806c1', 1, NULL, 138, 1, '2019-04-15 09:53:28', '2019-04-15 09:53:28'),
(85, '3f899bf2-4001-47f1-a39a-b454a4a0f9ca', 1, NULL, 139, 1, '2019-04-15 13:40:53', '2019-04-15 13:40:53'),
(86, 'ff9828d3-f0e9-4915-890d-a6c0f3657707', 1, NULL, 140, 1, '2019-04-15 13:41:19', '2019-04-15 13:41:19'),
(87, 'bcc437f3-1065-46ee-baed-de7328a86753', 1, 1, 101, 4, '2019-04-16 15:58:15', '2019-04-16 16:35:03'),
(88, '6fa8ba09-4d9b-4357-9539-702d7d428d7f', 1, 1, 102, 3, '2019-04-16 15:58:47', '2019-04-16 16:39:31'),
(89, '9043719e-7644-42c3-a236-161c8fee6ad4', 1, 1, 103, 2, '2019-04-16 15:58:49', '2019-04-16 16:39:31'),
(90, '92dc6fe8-e904-45f4-a195-29d32dd9804b', 1, NULL, 104, 1, '2019-04-16 15:58:51', '2019-04-16 15:58:51'),
(91, 'd0cf9c6e-fba5-4cb3-9e6a-56a36db63158', 1, NULL, 105, 1, '2019-04-16 15:58:55', '2019-04-16 15:58:55'),
(92, '725f612a-fd6e-4b4e-bfab-a93ca9f408b2', 1, NULL, 106, 1, '2019-04-16 15:58:56', '2019-04-16 15:58:56'),
(93, 'd56caf64-e892-4b49-b70a-e62a02a266b0', 1, NULL, 107, 1, '2019-04-16 15:58:59', '2019-04-16 15:58:59'),
(94, '8e201f71-8f80-4af6-b084-05ef031bb44e', 1, NULL, 108, 1, '2019-04-16 15:59:01', '2019-04-16 15:59:01'),
(95, '2d260c5f-803d-41fc-a7cf-86be6f8ef8b9', 1, 1, 101, 4, '2019-04-17 09:40:48', '2019-04-17 10:03:14'),
(96, 'a4dddc33-9bf4-4f26-9f12-7c696efb30b3', 1, 1, 102, 3, '2019-04-17 09:40:50', '2019-04-17 10:03:29'),
(97, '8bcc13d5-3e5e-496b-83be-74d9eba23509', 1, 1, 103, 2, '2019-04-17 09:40:51', '2019-04-17 10:03:29'),
(98, '1c7e74ed-a48e-4d27-8387-c44086117939', 1, NULL, 104, 1, '2019-04-17 09:54:31', '2019-04-17 09:54:31'),
(99, '3ea89ae1-b0b2-4e41-952d-42af3a7891f5', 1, NULL, 105, 1, '2019-04-17 09:54:33', '2019-04-17 09:54:33'),
(100, '5411fb61-17e0-4516-88f2-50668780ccf7', 1, NULL, 106, 1, '2019-04-17 10:00:30', '2019-04-17 10:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `desk_queue_statuses`
--

CREATE TABLE `desk_queue_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `desk_queue_id` int(11) NOT NULL,
  `queue_status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desk_queue_statuses`
--

INSERT INTO `desk_queue_statuses` (`id`, `user_id`, `desk_queue_id`, `queue_status_id`, `created_at`, `updated_at`) VALUES
(66, 3, 44, 2, '2019-04-14 20:54:39', '2019-04-14 20:54:39'),
(67, 3, 44, 4, '2019-04-14 20:58:02', '2019-04-14 20:58:02'),
(68, 3, 45, 2, '2019-04-14 20:58:03', '2019-04-14 20:58:03'),
(69, 3, 45, 4, '2019-04-14 20:59:36', '2019-04-14 20:59:36'),
(70, 3, 46, 2, '2019-04-14 20:59:37', '2019-04-14 20:59:37'),
(71, 3, 46, 4, '2019-04-14 20:59:58', '2019-04-14 20:59:58'),
(72, 3, 47, 2, '2019-04-15 08:24:12', '2019-04-15 08:24:12'),
(73, 3, 47, 4, '2019-04-15 08:24:15', '2019-04-15 08:24:15'),
(74, 3, 48, 2, '2019-04-15 08:24:16', '2019-04-15 08:24:16'),
(75, 3, 48, 4, '2019-04-15 08:24:17', '2019-04-15 08:24:17'),
(76, 3, 49, 2, '2019-04-15 08:24:17', '2019-04-15 08:24:17'),
(77, 3, 49, 3, '2019-04-15 08:24:46', '2019-04-15 08:24:46'),
(78, 3, 50, 2, '2019-04-15 08:24:46', '2019-04-15 08:24:46'),
(79, 3, 50, 4, '2019-04-15 08:30:58', '2019-04-15 08:30:58'),
(80, 3, 51, 2, '2019-04-15 08:30:58', '2019-04-15 08:30:58'),
(81, 3, 51, 3, '2019-04-15 08:31:03', '2019-04-15 08:31:03'),
(82, 3, 52, 2, '2019-04-15 08:31:03', '2019-04-15 08:31:03'),
(83, 3, 52, 4, '2019-04-15 08:31:07', '2019-04-15 08:31:07'),
(84, 3, 53, 2, '2019-04-15 08:31:07', '2019-04-15 08:31:07'),
(85, 3, 53, 4, '2019-04-15 08:31:08', '2019-04-15 08:31:08'),
(86, 3, 54, 2, '2019-04-15 08:31:08', '2019-04-15 08:31:08'),
(87, 3, 54, 4, '2019-04-15 09:02:50', '2019-04-15 09:02:50'),
(88, 3, 55, 2, '2019-04-15 09:02:50', '2019-04-15 09:02:50'),
(89, 3, 55, 4, '2019-04-15 09:54:10', '2019-04-15 09:54:10'),
(90, 3, 56, 2, '2019-04-15 09:54:10', '2019-04-15 09:54:10'),
(91, 3, 56, 4, '2019-04-15 09:54:19', '2019-04-15 09:54:19'),
(92, 3, 57, 2, '2019-04-15 09:54:19', '2019-04-15 09:54:19'),
(93, 3, 57, 4, '2019-04-15 10:26:04', '2019-04-15 10:26:04'),
(94, 3, 58, 2, '2019-04-15 10:26:04', '2019-04-15 10:26:04'),
(95, 3, 58, 4, '2019-04-15 10:26:18', '2019-04-15 10:26:18'),
(96, 3, 59, 2, '2019-04-15 10:26:18', '2019-04-15 10:26:18'),
(97, 3, 59, 4, '2019-04-15 10:29:12', '2019-04-15 10:29:12'),
(98, 3, 60, 2, '2019-04-15 10:29:12', '2019-04-15 10:29:12'),
(99, 3, 60, 4, '2019-04-15 10:29:26', '2019-04-15 10:29:26'),
(100, 3, 61, 2, '2019-04-15 10:29:27', '2019-04-15 10:29:27'),
(101, 3, 61, 3, '2019-04-15 11:37:31', '2019-04-15 11:37:31'),
(102, 3, 62, 2, '2019-04-15 11:37:31', '2019-04-15 11:37:31'),
(103, 3, 62, 3, '2019-04-15 11:37:44', '2019-04-15 11:37:44'),
(104, 3, 63, 2, '2019-04-15 11:37:45', '2019-04-15 11:37:45'),
(105, 3, 63, 4, '2019-04-15 13:42:17', '2019-04-15 13:42:17'),
(106, 3, 64, 2, '2019-04-15 13:42:17', '2019-04-15 13:42:17'),
(107, 3, 64, 3, '2019-04-15 13:44:12', '2019-04-15 13:44:12'),
(108, 3, 65, 2, '2019-04-15 13:44:12', '2019-04-15 13:44:12'),
(109, 3, 87, 2, '2019-04-16 16:34:22', '2019-04-16 16:34:22'),
(110, 3, 87, 4, '2019-04-16 16:35:03', '2019-04-16 16:35:03'),
(111, 3, 88, 2, '2019-04-16 16:35:03', '2019-04-16 16:35:03'),
(112, 3, 88, 3, '2019-04-16 16:39:31', '2019-04-16 16:39:31'),
(113, 3, 89, 2, '2019-04-16 16:39:31', '2019-04-16 16:39:31'),
(114, 3, 95, 2, '2019-04-17 10:00:48', '2019-04-17 10:00:48'),
(115, 3, 95, 4, '2019-04-17 10:03:14', '2019-04-17 10:03:14'),
(116, 3, 96, 2, '2019-04-17 10:03:14', '2019-04-17 10:03:14'),
(117, 3, 96, 3, '2019-04-17 10:03:29', '2019-04-17 10:03:29'),
(118, 3, 97, 2, '2019-04-17 10:03:29', '2019-04-17 10:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `uuid`, `name_ar`, `name_en`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '7f69b930-ed28-41b9-a52a-562847712289', 'الدور الاول', 'F1', 1, 1, 1, NULL, '2019-04-11 17:13:57', '2019-04-13 06:57:51'),
(2, '623b6a28-0c96-4b80-bbe4-66e891761931', 'الدور الثانى', 'F2', 1, 1, 1, NULL, '2019-04-11 17:14:19', '2019-04-13 06:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `lookups`
--

CREATE TABLE `lookups` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ltm_translations`
--

CREATE TABLE `ltm_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `locale` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `key` text COLLATE utf8mb4_bin NOT NULL,
  `value` text COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_15_084804_create_permission_groups_table', 1),
(4, '2018_10_15_084816_create_permissions_table', 1),
(5, '2018_10_15_084829_create_roles_table', 1),
(6, '2018_10_15_084929_create_role_user_table', 1),
(7, '2018_10_15_085102_create_permission_role_table', 1),
(8, '2018_10_15_092900_create_permission_group_permission_table', 1),
(9, '2018_12_05_132532_create_lookups_table', 1),
(10, '2019_03_21_125019_create_user_login_histories_table', 1),
(31, '2014_04_02_193005_create_translations_table', 2),
(32, '2019_04_07_113522_create_floors_table', 2),
(33, '2019_04_07_113610_create_desks_table', 2),
(34, '2019_04_07_113855_create_screens_table', 2),
(35, '2019_04_10_110823_create_desk_queues_table', 2),
(36, '2019_04_10_120805_create_queue_statuses_table', 2),
(37, '2019_04_10_121913_create_desk_queue_statuses_table', 2),
(38, '2019_04_11_080542_create_websockets_statistics_entries_table', 2),
(39, '2019_04_11_134138_create_screen_types_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `uuid`, `name`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '5e55aa21-7713-430d-991b-df8229b7c0eb', 'users', 1, 1, NULL, '2019-04-07 06:39:29', '2019-04-07 06:39:29'),
(2, 'b2f615c5-b43b-4cca-9b59-6bdac60f2bf7', 'authorizations', 1, 1, NULL, '2019-04-09 08:47:23', '2019-04-09 08:47:23'),
(4, 'd9384789-cf5c-4768-9ac3-45a24b62a708', 'permission_groups', 1, 1, NULL, '2019-04-09 08:49:27', '2019-04-09 08:49:27'),
(5, '6f8b35e0-cbdc-4296-b8aa-ccb20fc6d7c5', 'permissions', 1, 1, NULL, '2019-04-09 08:49:53', '2019-04-09 08:49:53'),
(6, '091c2a89-4352-48a0-bd9b-c639811e93ee', 'roles', 1, 1, NULL, '2019-04-09 08:50:21', '2019-04-09 08:50:21'),
(7, 'f22bde8c-546e-454d-b01b-8d839d6df38e', 'floors', 1, 1, NULL, '2019-04-09 08:50:43', '2019-04-09 08:50:43'),
(8, '271e1618-01f6-47bb-9978-0559182de2c5', 'desks', 1, 1, NULL, '2019-04-09 08:51:15', '2019-04-09 08:51:15'),
(9, '4e61f62f-72df-45ab-97e1-7f2310dff340', 'screens', 1, 1, NULL, '2019-04-09 08:51:46', '2019-04-09 08:51:46'),
(10, '03a78cf3-7b95-4a0f-9238-a220ffa48a26', 'queues', 1, 1, NULL, '2019-04-09 08:52:44', '2019-04-09 08:52:44'),
(11, 'eb8920af-a48a-44a0-bc8b-1d318e368288', 'settings', 1, 1, NULL, '2019-04-09 08:52:57', '2019-04-09 08:52:57'),
(12, 'a2da419a-4dcf-43c0-a1dd-ac7f873eafa2', 'transaltions', 1, 1, NULL, '2019-04-09 08:53:21', '2019-04-09 08:53:21'),
(13, 'a5ac0824-6d61-4e85-919c-606182b4f339', 'desk_queue', 1, 1, NULL, '2019-04-12 10:11:19', '2019-04-12 10:11:19'),
(14, '70abc86e-2e7a-4de7-904b-355d81276165', 'security', 1, 1, NULL, '2019-04-12 10:14:26', '2019-04-12 10:14:26'),
(15, '43222c0a-1741-4461-9a2b-7d0116ad869d', 'resources', 1, 1, NULL, '2019-04-12 10:15:25', '2019-04-12 10:15:25'),
(16, '2203dff0-9d94-4a5f-aba6-452aee0e0914', 'doctor_queue', 1, 1, NULL, '2019-04-12 11:30:17', '2019-04-12 11:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `uuid`, `name`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'affd1061-1d30-4063-8b19-6b11de7055dd', 'index', 1, 1, NULL, '2019-04-07 06:38:22', '2019-04-07 06:38:22'),
(2, '4d73666a-df29-467e-9938-289d5ff473c4', 'create', 1, 1, NULL, '2019-04-07 06:38:32', '2019-04-07 06:38:32'),
(3, '6d478d5c-c893-4cbf-8307-261127b86af4', 'store', 1, 1, NULL, '2019-04-07 06:38:40', '2019-04-07 06:38:40'),
(4, 'e57b2f24-0870-445e-8198-6b581fb8a34b', 'edit', 1, 1, NULL, '2019-04-07 06:38:46', '2019-04-07 06:38:46'),
(5, '943c4492-926f-4aeb-b92a-8cb993c69100', 'update', 1, 1, NULL, '2019-04-07 06:38:50', '2019-04-07 06:38:50'),
(6, '60960e5d-b309-4c1d-9e3f-ee85ba1884f4', 'show', 1, 1, NULL, '2019-04-07 06:38:58', '2019-04-07 06:38:58'),
(7, 'd9d912b2-b551-4599-81ce-34000f29ae01', 'delete', 1, 1, NULL, '2019-04-07 06:39:04', '2019-04-07 06:39:04'),
(8, '36d8f2c4-8500-41bb-a27d-84ad08a1430c', 'use', 1, 1, NULL, '2019-04-07 06:39:16', '2019-04-07 06:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `permission_group_permission`
--

CREATE TABLE `permission_group_permission` (
  `permission_group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_group_permission`
--

INSERT INTO `permission_group_permission` (`permission_group_id`, `permission_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(1, 5),
(2, 5),
(3, 5),
(4, 5),
(5, 5),
(6, 5),
(7, 5),
(1, 6),
(2, 6),
(3, 6),
(4, 6),
(5, 6),
(6, 6),
(7, 6),
(1, 7),
(2, 7),
(3, 7),
(4, 7),
(5, 7),
(6, 7),
(7, 7),
(1, 8),
(2, 8),
(3, 8),
(4, 8),
(5, 8),
(6, 8),
(7, 8),
(1, 9),
(2, 9),
(3, 9),
(4, 9),
(5, 9),
(6, 9),
(7, 9),
(8, 10),
(8, 11),
(1, 12),
(8, 13),
(8, 14),
(8, 15),
(8, 16);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_group_id`, `permission_id`, `role_id`) VALUES
(6, 8, 2),
(6, 9, 2),
(7, 9, 2),
(8, 10, 2),
(8, 13, 2),
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 1),
(7, 1, 1),
(8, 2, 1),
(1, 4, 1),
(2, 4, 1),
(3, 4, 1),
(4, 4, 1),
(5, 4, 1),
(6, 4, 1),
(7, 4, 1),
(1, 5, 1),
(2, 5, 1),
(3, 5, 1),
(4, 5, 1),
(5, 5, 1),
(6, 5, 1),
(7, 5, 1),
(1, 6, 1),
(2, 6, 1),
(3, 6, 1),
(4, 6, 1),
(5, 6, 1),
(6, 6, 1),
(7, 6, 1),
(1, 7, 1),
(2, 7, 1),
(3, 7, 1),
(4, 7, 1),
(5, 7, 1),
(6, 7, 1),
(7, 7, 1),
(1, 8, 1),
(2, 8, 1),
(3, 8, 1),
(4, 8, 1),
(5, 8, 1),
(6, 8, 1),
(7, 8, 1),
(1, 9, 1),
(2, 9, 1),
(3, 9, 1),
(4, 9, 1),
(5, 9, 1),
(6, 9, 1),
(7, 9, 1),
(8, 11, 1),
(1, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `queue_statuses`
--

CREATE TABLE `queue_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_type` int(11) NOT NULL,
  `class` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `queue_statuses`
--

INSERT INTO `queue_statuses` (`id`, `uuid`, `queue_type`, `class`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, '3599f760-5e8c-44f2-bc09-271bdaaab998', 1, 'label-purple', 'انتظار', 'Waiting', NULL, NULL),
(2, 'd88508ab-febe-4c8b-ad58-c1415a16a15a', 1, 'label-primary', 'على الشباك', 'Called', NULL, NULL),
(3, 'eef0c0ae-5778-4e67-a920-231e7ce8abe9', 1, 'label-danger', 'غير موجود', 'Skipped', NULL, NULL),
(4, 'c5bf2900-07ff-4a24-b827-a7c8202f21b1', 1, 'label-success', 'تم الخدمة', 'Done', NULL, NULL),
(5, '2080268f-c5a1-416c-b87c-e4d344ea6e4e', 1, 'label-warning', 'رجوع', 'Cell from skip', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `uuid`, `name`, `icon`, `class`, `color`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1ac8d13b-2290-4312-8af9-804323097039', 'Admin', 'user', 'label-success', '#010', 1, 1, NULL, '2019-04-07 06:40:19', '2019-04-14 12:57:57'),
(2, '1c70bf15-768d-46ff-b2b8-eb32d8c86096', 'Desk', 'user', 'label-danger', '#f00', 1, 1, NULL, '2019-04-11 17:28:15', '2019-04-12 10:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(2, 3),
(2, 2),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screen_type_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`id`, `uuid`, `screen_type_id`, `floor_id`, `ip`, `name_ar`, `name_en`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '01b60345-ceea-4284-a143-2c54f23b01f6', 1, 1, '10.1.10.160', 'كشك الدور الاول', 'Kiosk Floor 1', 1, 1, 1, NULL, '2019-04-11 21:37:41', '2019-04-15 06:58:31'),
(2, '2035e89b-f53e-4df9-817b-73643205dcbd', 2, 2, '192.168.1.10', 'ريسبشن الدور الثانى', 'Reception Floor 2', 1, 1, 1, NULL, '2019-04-11 22:06:16', '2019-04-11 22:06:16'),
(3, 'ba9a4182-af94-4bcb-827a-380fe358b06c', 1, 2, '192.168.1.8', 'كشك الدور الثانى', 'Kiosk Floor 2', 1, 1, 1, NULL, '2019-04-13 12:45:43', '2019-04-13 12:45:43'),
(4, '98d560b7-9f66-4543-bbb4-ff8ffda64fed', 2, 1, '192.168.1.2', 'ريسبشن الدور الالول', 'Reception Floor 1', 1, 1, 1, NULL, '2019-04-14 05:38:26', '2019-04-14 05:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `screen_types`
--

CREATE TABLE `screen_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screen_types`
--

INSERT INTO `screen_types` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'كشك', 'Kiosk', NULL, NULL),
(2, 'ريسبشن', 'Reception', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desk_id` int(11) DEFAULT NULL,
  `login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `available` tinyint(1) DEFAULT '0',
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `desk_id`, `login_ip`, `name`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_by`, `updated_by`, `status`, `type`, `available`, `api_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '3322b3c3-b3ee-45ed-8549-fb1505228790', 1, '10.1.35.193', 'Ahmed Samy', '01002589847', 'ahmsam39@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', '5J0VBt9FlKAwjmyCRfDH97nMUl8ljqJjKZa5WrEASCuX3oObSwrV61fVq0eg', 1, 1, 1, 0, 0, NULL, NULL, '2019-04-04 10:58:52', '2019-04-15 09:14:57'),
(2, '3018e110-bc9a-46a0-870e-92ae16d0765f', NULL, NULL, 'Yasser Hamdy', '123456789', 'desk2@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'bYIN0dzyI0pdNbQjg8wvY37dVOYUyoYiPoD48V4uSG53zYuuxJdVuKVqTDJV', 1, 1, 1, 1, 0, NULL, NULL, '2019-04-07 09:47:57', '2019-04-13 15:38:03'),
(3, '31e9a2af-6c96-45f4-845c-81737da7bca5', 1, '10.1.35.193', 'Amany Essam', '123456789', 'desk1@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'C5HuJVPcNgXaWkcnzQWYlpufmN8qzyjAbo38idgmaXLYU1gV7LnyW2SbRrD7', 1, 1, 1, 2, 1, NULL, NULL, '2019-04-12 09:10:05', '2019-04-17 10:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_login_histories`
--

CREATE TABLE `user_login_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_date_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_login_histories`
--

INSERT INTO `user_login_histories` (`id`, `user_id`, `login_ip`, `login_data`, `login_date_time`, `logout_date_time`, `created_at`, `updated_at`) VALUES
(6, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-11 19:12:44', NULL, '2019-04-11 17:12:44', '2019-04-11 17:12:44'),
(7, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-11 23:00:42', NULL, '2019-04-11 21:00:42', '2019-04-11 21:00:42'),
(8, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-12 09:52:56', NULL, '2019-04-12 07:52:56', '2019-04-12 07:52:56'),
(9, 3, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-12 11:10:25', NULL, '2019-04-12 09:10:25', '2019-04-12 09:10:25'),
(10, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-12 11:11:16', NULL, '2019-04-12 09:11:16', '2019-04-12 09:11:16'),
(11, 3, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-12 12:08:06', NULL, '2019-04-12 10:08:06', '2019-04-12 10:08:06'),
(12, 3, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-12 13:19:53', NULL, '2019-04-12 11:19:53', '2019-04-12 11:19:53'),
(13, 3, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-12 13:21:00', NULL, '2019-04-12 11:21:00', '2019-04-12 11:21:00'),
(14, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-12 16:14:04', NULL, '2019-04-12 14:14:04', '2019-04-12 14:14:04'),
(15, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-12 20:32:43', NULL, '2019-04-12 18:32:43', '2019-04-12 18:32:43'),
(16, 3, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-12 20:48:34', NULL, '2019-04-12 18:48:34', '2019-04-12 18:48:34'),
(17, 3, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-13 07:07:18', NULL, '2019-04-13 05:07:18', '2019-04-13 05:07:18'),
(18, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-13 08:57:35', NULL, '2019-04-13 06:57:35', '2019-04-13 06:57:35'),
(19, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-13 09:30:54', NULL, '2019-04-13 07:30:54', '2019-04-13 07:30:54'),
(20, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-13 11:24:37', NULL, '2019-04-13 09:24:37', '2019-04-13 09:24:37'),
(21, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-13 14:12:39', NULL, '2019-04-13 12:12:39', '2019-04-13 12:12:39'),
(22, 2, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-13 14:32:53', NULL, '2019-04-13 12:32:53', '2019-04-13 12:32:53'),
(23, 2, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-13 17:38:03', NULL, '2019-04-13 15:38:03', '2019-04-13 15:38:03'),
(24, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 07:30:45', NULL, '2019-04-14 05:30:45', '2019-04-14 05:30:45'),
(25, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 07:33:48', NULL, '2019-04-14 05:33:48', '2019-04-14 05:33:48'),
(26, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 08:10:08', NULL, '2019-04-14 06:10:08', '2019-04-14 06:10:08'),
(27, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 08:14:29', NULL, '2019-04-14 06:14:29', '2019-04-14 06:14:29'),
(28, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 14:27:56', NULL, '2019-04-14 12:27:56', '2019-04-14 12:27:56'),
(29, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 14:28:23', NULL, '2019-04-14 12:28:23', '2019-04-14 12:28:23'),
(30, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 14:35:14', NULL, '2019-04-14 12:35:14', '2019-04-14 12:35:14'),
(31, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 14:44:54', NULL, '2019-04-14 12:44:54', '2019-04-14 12:44:54'),
(32, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 14:47:43', NULL, '2019-04-14 12:47:43', '2019-04-14 12:47:43'),
(33, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 14:50:11', NULL, '2019-04-14 12:50:11', '2019-04-14 12:50:11'),
(34, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 14:53:05', NULL, '2019-04-14 12:53:05', '2019-04-14 12:53:05'),
(35, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 14:55:16', NULL, '2019-04-14 12:55:16', '2019-04-14 12:55:16'),
(36, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 14:55:51', NULL, '2019-04-14 12:55:51', '2019-04-14 12:55:51'),
(37, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 18:07:18', NULL, '2019-04-14 16:07:18', '2019-04-14 16:07:18'),
(38, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 22:45:51', NULL, '2019-04-14 20:45:51', '2019-04-14 20:45:51'),
(39, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-15 08:29:53', NULL, '2019-04-15 06:29:53', '2019-04-15 06:29:53'),
(40, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-15 08:35:06', NULL, '2019-04-15 06:35:06', '2019-04-15 06:35:06'),
(41, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-15 08:58:03', NULL, '2019-04-15 06:58:03', '2019-04-15 06:58:03'),
(42, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-15 11:03:09', NULL, '2019-04-15 09:03:09', '2019-04-15 09:03:09'),
(43, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-15 11:14:57', NULL, '2019-04-15 09:14:57', '2019-04-15 09:14:57'),
(44, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-16 17:50:51', NULL, '2019-04-16 15:50:51', '2019-04-16 15:50:51'),
(45, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-17 08:29:09', NULL, '2019-04-17 06:29:09', '2019-04-17 06:29:09'),
(46, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-17 12:11:31', NULL, '2019-04-17 10:11:31', '2019-04-17 10:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `desks`
--
ALTER TABLE `desks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desk_queues`
--
ALTER TABLE `desk_queues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desk_queue_statuses`
--
ALTER TABLE `desk_queue_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookups`
--
ALTER TABLE `lookups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue_statuses`
--
ALTER TABLE `queue_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screen_types`
--
ALTER TABLE `screen_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_login_histories`
--
ALTER TABLE `user_login_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `desks`
--
ALTER TABLE `desks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `desk_queues`
--
ALTER TABLE `desk_queues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `desk_queue_statuses`
--
ALTER TABLE `desk_queue_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lookups`
--
ALTER TABLE `lookups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `queue_statuses`
--
ALTER TABLE `queue_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `screen_types`
--
ALTER TABLE `screen_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_login_histories`
--
ALTER TABLE `user_login_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
