-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2019 at 09:52 PM
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
(1, 'd4b5d9a2-d0bd-4b78-ac96-bc1c94dabed6', 1, '10.1.35.194', 'شباك 1', 'D1', 1, 1, 1, NULL, '2019-04-11 17:17:28', '2019-04-17 11:01:50'),
(2, 'c4d2d5ef-05ec-4b9a-b237-0a74a568d4dd', 2, '192.168.1.5', 'شباك 5', 'D5', 1, 1, 1, NULL, '2019-04-11 21:11:44', '2019-04-20 06:51:12'),
(3, '48528cbb-f31c-418d-bd10-b44268124e5c', 1, '12840984084', 'شباك 2', 'D2', 1, 1, 1, NULL, '2019-04-19 14:09:04', '2019-04-19 14:09:04'),
(4, '04fd4589-95f9-4a30-a9aa-d5cbb106eea2', 1, '54064654654', 'شباك 3', 'D3', 1, 1, 1, NULL, '2019-04-19 14:09:28', '2019-04-19 14:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `desk_queues`
--

CREATE TABLE `desk_queues` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor_id` int(11) NOT NULL,
  `desk_id` int(11) DEFAULT NULL,
  `queue_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '623b6a28-0c96-4b80-bbe4-66e891761931', 'الدور الثانى', 'F2', 1, 1, 1, NULL, '2019-04-11 17:14:19', '2019-04-13 06:58:00'),
(3, 'abb47682-609e-41ee-8770-b981ae8875e5', 'الدور الثالث', 'F3', 1, 1, 1, NULL, '2019-04-19 13:58:53', '2019-04-19 13:58:53'),
(4, 'a6397028-e413-46a7-a34f-8018911cfc69', 'F4', 'F4', 1, 1, 1, NULL, '2019-04-21 08:10:51', '2019-04-21 08:10:51'),
(5, '0ada49fc-3a0c-487b-a29a-35c56c0f896a', 'F5', 'F5', 1, 1, 1, NULL, '2019-04-21 08:11:00', '2019-04-21 08:11:00'),
(6, '0bd78a84-2922-410c-8180-7dc9e6e33d69', 'F6', 'F6', 1, 1, 1, NULL, '2019-04-21 08:11:11', '2019-04-21 08:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `floor_kiosk`
--

CREATE TABLE `floor_kiosk` (
  `floor_id` int(10) UNSIGNED NOT NULL,
  `kiosk_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floor_kiosk`
--

INSERT INTO `floor_kiosk` (`floor_id`, `kiosk_id`) VALUES
(1, 9),
(2, 9),
(2, 3),
(3, 3),
(1, 1),
(2, 1),
(1, 5),
(2, 5),
(3, 5),
(6, 5);

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
(39, '2019_04_11_134138_create_screen_types_table', 2),
(41, '2019_04_18_092904_create_floor_kiosk_table', 3);

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
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `screens` (`id`, `uuid`, `slug`, `screen_type_id`, `floor_id`, `ip`, `name_ar`, `name_en`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '01b60345-ceea-4284-a143-2c54f23b01f6', 'f1-k1', 1, 1, '10.1.10.160', 'كشك الدور الاول', 'K1', 1, 1, 1, NULL, '2019-04-11 21:37:41', '2019-04-21 07:31:48'),
(2, '2035e89b-f53e-4df9-817b-73643205dcbd', 'rysbshn-aldor-althan', 2, 2, '192.168.1.10', 'ريسبشن الدور الثانى', 'Reception 2', 1, 1, 1, NULL, '2019-04-11 22:06:16', '2019-04-21 07:25:45'),
(3, 'ba9a4182-af94-4bcb-827a-380fe358b06c', 'kshk-aldor-althan', 1, 2, '192.168.1.8', 'كشك الدور الثانى', 'Kiosk Floor 2', 1, 1, 1, NULL, '2019-04-13 12:45:43', '2019-04-21 07:25:51'),
(4, '98d560b7-9f66-4543-bbb4-ff8ffda64fed', 'rysbshn-aldor-alalol', 2, 1, '192.168.1.2', 'ريسبشن الدور الالول', 'Reception 1', 1, 1, 1, NULL, '2019-04-14 05:38:26', '2019-04-21 07:25:57'),
(5, 'eea83c15-2058-43f5-b83e-620c2e872795', 'f1-yjtyj', 1, 1, '47258268', 'eg', 'yjtyj', 1, 1, 1, NULL, '2019-04-21 08:10:06', '2019-04-21 08:13:37');

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
(1, '3322b3c3-b3ee-45ed-8549-fb1505228790', 1, '10.1.35.194', 'Ahmed Samy', '01002589847', 'ahmsam39@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'BHVkXiVKlo9l5fZhYIsxJz3Hldi2HheK35eRkUsUGOhaJs6sOibrqQSgKk0z', 1, 1, 1, 0, 0, NULL, NULL, '2019-04-04 10:58:52', '2019-04-18 13:17:20'),
(2, '3018e110-bc9a-46a0-870e-92ae16d0765f', NULL, NULL, 'Yasser Hamdy', '123456789', 'desk2@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'bYIN0dzyI0pdNbQjg8wvY37dVOYUyoYiPoD48V4uSG53zYuuxJdVuKVqTDJV', 1, 1, 1, 1, 0, NULL, NULL, '2019-04-07 09:47:57', '2019-04-13 15:38:03'),
(3, '31e9a2af-6c96-45f4-845c-81737da7bca5', 1, '10.1.35.194', 'Amany Essam', '123456789', 'desk1@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'nZ2LS8mFYxs8Rr3jdX1I21kVzRqNaS7pUBTaJ8vRrTEDmxCiRtXb6rtKCzgP', 1, 1, 1, 2, 1, NULL, NULL, '2019-04-12 09:10:05', '2019-04-21 16:35:04');

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
(1, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-20 07:19:15', NULL, '2019-04-20 05:19:15', '2019-04-20 05:19:15'),
(2, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-20 07:59:02', NULL, '2019-04-20 05:59:02', '2019-04-20 05:59:02'),
(3, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-21 08:39:50', NULL, '2019-04-21 06:39:50', '2019-04-21 06:39:50'),
(4, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-21 09:06:12', NULL, '2019-04-21 07:06:12', '2019-04-21 07:06:12'),
(5, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-21 12:49:48', NULL, '2019-04-21 10:49:48', '2019-04-21 10:49:48');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `desk_queues`
--
ALTER TABLE `desk_queues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `desk_queue_statuses`
--
ALTER TABLE `desk_queue_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
