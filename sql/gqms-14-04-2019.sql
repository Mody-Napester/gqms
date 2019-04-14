-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2019 at 05:23 PM
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
(1, 'd4b5d9a2-d0bd-4b78-ac96-bc1c94dabed6', 1, '192.168.1.63', 'شباك 1', 'D1', 1, 1, 1, NULL, '2019-04-11 17:17:28', '2019-04-14 06:14:01'),
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
(1, 'b1b6a2fe-bfaf-4eb2-a444-1bc83d98f688', 1, NULL, 101, 1, '2019-04-12 08:11:52', '2019-04-13 16:13:31'),
(2, '99d18f74-a90e-47d9-932d-bd15aeef7a0d', 1, NULL, 102, 1, '2019-04-12 08:12:06', '2019-04-13 15:35:53'),
(3, '1d2ff2b7-48d4-4eeb-91c8-f5e12b470820', 1, NULL, 103, 1, '2019-04-12 09:05:20', '2019-04-13 15:36:42'),
(4, '9068476a-4ff7-411f-8f25-7f745c3472ca', 1, NULL, 104, 1, '2019-04-12 15:51:17', '2019-04-13 15:36:45'),
(5, 'a6cba931-1b74-45f9-b3a6-758c01395b3a', 1, NULL, 105, 1, '2019-04-12 15:51:22', '2019-04-13 15:36:46'),
(6, '9a57b47f-38d4-4f87-b584-90e08882afd1', 1, NULL, 106, 1, '2019-04-12 15:51:38', '2019-04-13 15:36:47'),
(7, 'd67e15ef-618d-4018-bcec-892c59fd3df5', 1, NULL, 107, 1, '2019-04-13 06:47:57', '2019-04-13 16:55:01'),
(8, '04b3bf3c-8fe9-467c-8b0a-4a994852b7ab', 1, NULL, 108, 1, '2019-04-13 06:52:10', '2019-04-13 16:59:04'),
(9, 'e88d78a9-1ad4-48ed-ae92-71a8140e6658', 1, NULL, 109, 1, '2019-04-13 06:54:39', '2019-04-13 16:59:16'),
(10, '3b8fdbda-0d4a-4147-b79d-4f898be1181f', 1, NULL, 110, 1, '2019-04-13 12:13:16', '2019-04-13 16:59:16'),
(11, 'ede9c38c-762a-48ed-a098-f9c1fdac281b', 2, NULL, 101, 1, '2019-04-13 12:45:50', '2019-04-13 12:46:19'),
(12, 'fd5c8c74-d4ad-46da-a176-c6dfae169b76', 2, NULL, 102, 1, '2019-04-13 12:46:04', '2019-04-13 12:51:07'),
(13, '23f0d2c9-f44e-47c8-a000-e3bf5fbdc11f', 2, NULL, 103, 1, '2019-04-13 12:46:05', '2019-04-13 12:46:05'),
(14, 'bb8ccaff-d5e7-460c-99be-65ec2a203680', 2, NULL, 104, 1, '2019-04-13 12:46:07', '2019-04-13 12:46:07'),
(15, 'a1d52c94-4a7f-499f-a7c2-f4b54d631c55', 2, NULL, 105, 1, '2019-04-13 12:46:08', '2019-04-13 12:46:08'),
(16, '6b4b2b31-7aa1-42ec-9210-19b577f95a52', 1, NULL, 111, 1, '2019-04-13 13:02:29', '2019-04-13 17:01:55'),
(17, 'c7eae50e-430a-4565-971d-579ea1a366cb', 1, NULL, 112, 1, '2019-04-13 13:16:35', '2019-04-13 17:03:18'),
(18, '2ef1ced9-7a6f-41f1-9c4c-7eb8349b22d2', 1, NULL, 113, 1, '2019-04-13 13:16:51', '2019-04-13 17:03:25'),
(19, '0da67a02-24df-4c97-9914-ace69c35e569', 1, NULL, 114, 1, '2019-04-13 13:16:52', '2019-04-13 17:03:25'),
(20, '53992868-68c0-45ef-957f-a8e0e5e77af4', 1, NULL, 115, 1, '2019-04-13 13:16:54', '2019-04-13 17:13:33'),
(21, '13bd9ba6-9771-4351-9d98-a6d1f21e7fd7', 1, NULL, 110, 1, '2019-04-13 13:28:52', '2019-04-13 17:13:36'),
(22, '507dc360-6c9e-4636-849d-1c4530fafa94', 1, NULL, 111, 1, '2019-04-13 13:29:01', '2019-04-13 17:13:37'),
(23, '7cefb296-3fa3-40b2-a2c5-710ea818f304', 1, NULL, 112, 1, '2019-04-13 15:46:54', '2019-04-13 17:20:48'),
(24, '2b398342-59dc-4d21-9e15-fa7a7fb2eb92', 1, NULL, 113, 1, '2019-04-13 15:46:56', '2019-04-13 17:20:50'),
(25, 'ba7cacae-bce8-444e-bcba-a088c6686da8', 1, NULL, 114, 1, '2019-04-13 15:46:57', '2019-04-13 17:21:05'),
(26, '1be7d1c1-73e5-4701-a20d-b4d90566c38a', 1, NULL, 115, 1, '2019-04-13 15:46:58', '2019-04-13 17:21:07'),
(27, 'cd3483c5-d108-45f0-a4e3-174e020f76de', 1, NULL, 116, 1, '2019-04-13 16:28:01', '2019-04-13 17:21:22'),
(28, 'b3677fff-7942-4312-96fc-f1c0c53d7eba', 1, 1, 101, 3, '2019-04-14 06:15:40', '2019-04-14 12:03:14'),
(29, '9c8b78a5-85d3-44b3-a7a4-fa47e3c499a3', 1, 1, 102, 4, '2019-04-14 06:16:02', '2019-04-14 12:03:42'),
(30, 'f0958feb-8ad6-462c-811b-a098d94d6eb5', 1, 1, 103, 3, '2019-04-14 06:16:08', '2019-04-14 12:04:23'),
(31, 'a61c2b49-9154-44e5-9bb7-4a427ce2ea6d', 1, 1, 104, 4, '2019-04-14 06:16:10', '2019-04-14 12:54:28'),
(32, 'c39d6697-f1f7-43a2-a009-dadbed8d2624', 1, 1, 105, 3, '2019-04-14 06:18:50', '2019-04-14 12:55:28'),
(33, 'f3e4ab3a-5e89-4a29-befb-53c0c11d3d72', 1, 1, 106, 2, '2019-04-14 06:21:33', '2019-04-14 12:55:28'),
(34, '02dbb25e-c1b0-4888-be5d-c48c6d5af45e', 1, NULL, 107, 1, '2019-04-14 06:21:38', '2019-04-14 06:22:27'),
(35, '8eb6ed59-5c0a-46b9-9d89-1058f83beebf', 1, NULL, 108, 1, '2019-04-14 06:21:39', '2019-04-14 09:59:35'),
(36, '6b8ea206-b4cb-40a2-939e-41d73987ee27', 1, NULL, 109, 1, '2019-04-14 06:21:40', '2019-04-14 06:21:40'),
(37, '15a7d34d-7bde-4cf0-99d1-e15042c4fad1', 1, NULL, 110, 1, '2019-04-14 06:21:43', '2019-04-14 06:21:43'),
(38, 'cfc5cf71-354b-4ab2-a57d-6aa74362db02', 1, NULL, 111, 1, '2019-04-14 06:21:44', '2019-04-14 06:21:44'),
(39, 'ac11be8a-31bc-441f-aee9-23d74cec98c8', 1, NULL, 112, 1, '2019-04-14 06:21:46', '2019-04-14 06:21:46'),
(40, '0240949b-7b55-41cd-a093-e3856cd4845a', 1, NULL, 113, 1, '2019-04-14 06:21:46', '2019-04-14 06:21:46'),
(41, 'e421f9e8-39f1-49a1-8d87-b9f3744e57e6', 1, NULL, 114, 1, '2019-04-14 06:21:47', '2019-04-14 06:21:47'),
(42, 'aca9983f-f285-46ea-8b18-63d186fe6111', 1, NULL, 115, 1, '2019-04-14 06:21:48', '2019-04-14 06:21:48'),
(43, '652a0964-9ae4-4cb6-87e2-957cbb40cb5a', 1, NULL, 116, 1, '2019-04-14 06:21:50', '2019-04-14 06:21:50');

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
(55, 3, 28, 1, '2019-04-14 10:53:17', '2019-04-14 10:53:17'),
(56, 3, 28, 3, '2019-04-14 12:03:14', '2019-04-14 12:03:14'),
(57, 3, 29, 1, '2019-04-14 12:03:15', '2019-04-14 12:03:15'),
(58, 3, 29, 4, '2019-04-14 12:03:42', '2019-04-14 12:03:42'),
(59, 3, 30, 1, '2019-04-14 12:03:42', '2019-04-14 12:03:42'),
(60, 3, 30, 3, '2019-04-14 12:04:23', '2019-04-14 12:04:23'),
(61, 3, 31, 1, '2019-04-14 12:04:23', '2019-04-14 12:04:23'),
(62, 3, 31, 4, '2019-04-14 12:54:28', '2019-04-14 12:54:28'),
(63, 3, 32, 1, '2019-04-14 12:54:28', '2019-04-14 12:54:28'),
(64, 3, 32, 3, '2019-04-14 12:55:28', '2019-04-14 12:55:28'),
(65, 3, 33, 1, '2019-04-14 12:55:28', '2019-04-14 12:55:28');

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
(1, '01b60345-ceea-4284-a143-2c54f23b01f6', 1, 1, '192.168.1.6', 'كشك الدور الاول', 'Kiosk Floor 1', 1, 1, 1, NULL, '2019-04-11 21:37:41', '2019-04-11 21:38:10'),
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
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `desk_id`, `login_ip`, `name`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_by`, `updated_by`, `status`, `type`, `api_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '3322b3c3-b3ee-45ed-8549-fb1505228790', NULL, NULL, 'Ahmed Samy', '01002589847', 'ahmsam39@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'Q53XPALZ2l8GhDm15pGPM7MmKqEW1r8imwIXAp9vFJBHgjpO2G7w7wI9r5wN', 1, 1, 1, 0, NULL, NULL, '2019-04-04 10:58:52', '2019-04-14 13:18:17'),
(2, '3018e110-bc9a-46a0-870e-92ae16d0765f', NULL, NULL, 'Yasser Hamdy', '123456789', 'desk2@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'bYIN0dzyI0pdNbQjg8wvY37dVOYUyoYiPoD48V4uSG53zYuuxJdVuKVqTDJV', 1, 1, 1, 1, NULL, NULL, '2019-04-07 09:47:57', '2019-04-13 15:38:03'),
(3, '31e9a2af-6c96-45f4-845c-81737da7bca5', NULL, NULL, 'Amany Essam', '123456789', 'desk1@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'Seihpauf3J4zkxDreqdno4s1NGfuVnblInYPF7OOxUqBJPIBFfnm1s0lRoQh', 1, 1, 1, 2, NULL, NULL, '2019-04-12 09:10:05', '2019-04-14 12:55:44');

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
(36, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-14 14:55:51', NULL, '2019-04-14 12:55:51', '2019-04-14 12:55:51');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `desk_queue_statuses`
--
ALTER TABLE `desk_queue_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
