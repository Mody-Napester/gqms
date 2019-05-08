-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2019 at 04:29 PM
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
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` int(11) NOT NULL,
  `source_clinic_id` int(11) NOT NULL,
  `name_en` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`id`, `uuid`, `source_clinic_id`, `name_en`, `name_ar`, `created_at`, `updated_at`) VALUES
(1, 112233, 12, 'Heart Clinic', 'عيادة القلب', '2019-05-06 00:59:21', '2019-05-06 00:59:24');

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
(1, 'd4b5d9a2-d0bd-4b78-ac96-bc1c94dabed6', 1, '10.1.30.58', 'شباك 1', 'D1', 1, 1, 1, NULL, '2019-04-11 17:17:28', '2019-05-06 05:50:32'),
(2, 'c4d2d5ef-05ec-4b9a-b237-0a74a568d4dd', 2, '192.168.1.5', 'شباك 5', 'D5', 1, 1, 1, NULL, '2019-04-11 21:11:44', '2019-04-20 06:51:12'),
(3, '48528cbb-f31c-418d-bd10-b44268124e5c', 1, '10.1.35.58', 'شباك 2', 'D2', 1, 1, 1, NULL, '2019-04-19 14:09:04', '2019-04-28 09:29:55'),
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

--
-- Dumping data for table `desk_queues`
--

INSERT INTO `desk_queues` (`id`, `uuid`, `floor_id`, `desk_id`, `queue_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'bcc99aed-527b-4368-95b7-6e3fcf91b54b', 1, 1, 'F1-001', 4, '2019-05-06 09:01:12', '2019-05-06 09:02:01'),
(2, '06d2229d-1316-4e92-9db7-839741f68944', 1, 1, 'F1-002', 4, '2019-05-06 09:01:14', '2019-05-06 09:03:51'),
(3, 'fe2b84dd-57f3-4408-bd36-a79d35bfe965', 1, 1, 'F1-003', 4, '2019-05-06 09:01:16', '2019-05-06 09:05:37'),
(4, '7a8d8154-e960-4699-84c6-26970c97141d', 1, 1, 'F1-004', 4, '2019-05-06 09:01:17', '2019-05-06 09:12:09'),
(5, 'a3cd8827-46e2-4c31-a2b3-30b6c9fb3573', 1, 1, 'F1-005', 2, '2019-05-06 09:01:19', '2019-05-06 09:19:47'),
(6, '2a90284c-81cf-47b0-9761-4c4c1357f71a', 1, NULL, 'F1-006', 1, '2019-05-06 09:19:31', '2019-05-06 09:19:31'),
(7, '56e64fcb-6b24-43b0-8d7e-ee0514f2b54d', 1, NULL, 'F1-007', 1, '2019-05-06 09:19:32', '2019-05-06 09:19:32'),
(8, '44d6d70f-7fb8-4257-949d-b39f311c91b5', 1, NULL, 'F1-008', 1, '2019-05-06 09:19:33', '2019-05-06 09:19:33'),
(9, 'df8a1e86-4b97-432f-8dc5-f7b3b30f0e33', 1, 1, 'F1-001', 4, '2019-05-07 06:45:39', '2019-05-07 10:34:25'),
(10, '7004933f-7885-42a3-8559-5e380871d5e9', 1, 1, 'F1-002', 4, '2019-05-07 06:45:42', '2019-05-07 10:38:43'),
(11, '033ff064-d0b7-4687-bc54-33202c397541', 1, 1, 'F1-003', 4, '2019-05-07 06:45:46', '2019-05-07 10:43:57'),
(12, '696f9c17-858b-4a0f-9cae-15208faf2da0', 1, 1, 'F1-004', 4, '2019-05-07 06:45:48', '2019-05-07 10:44:55'),
(13, '180990fa-aed1-4613-9ec1-fd6d7b738e25', 1, NULL, 'F1-005', 1, '2019-05-07 06:45:53', '2019-05-07 06:45:53'),
(14, '534e91da-b7f2-4c94-8859-8bb053b123fa', 1, 1, 'F1-001', 4, '2019-05-08 06:52:50', '2019-05-08 06:58:19'),
(15, 'ca0fb9a9-0000-4db1-85f9-5e2ba9fc2232', 1, 1, 'F1-002', 4, '2019-05-08 06:52:51', '2019-05-08 06:59:26'),
(16, '85fd9d51-3ac2-4e4b-a0d5-138a03645ca4', 1, 1, 'F1-003', 4, '2019-05-08 06:52:52', '2019-05-08 07:23:32'),
(17, '9a306483-97f1-49d9-8eb4-677b945988d1', 1, 1, 'F1-004', 4, '2019-05-08 06:52:53', '2019-05-08 07:31:31'),
(18, '721a46b4-5608-4562-b748-4cbed9ffd8aa', 1, 1, 'F1-005', 4, '2019-05-08 06:52:54', '2019-05-08 10:11:07'),
(19, 'd4dca3a6-6d83-4288-8792-ed837edc78ec', 1, 1, 'F1-006', 4, '2019-05-08 06:52:55', '2019-05-08 10:10:47'),
(20, 'feef3400-b7f3-4785-8ecd-fab4fecaadb4', 1, 1, 'F1-007', 4, '2019-05-08 06:52:55', '2019-05-08 10:24:13'),
(21, 'bcf477df-469b-48da-81c2-85ff1a05acc8', 1, 1, 'F1-008', 4, '2019-05-08 06:52:56', '2019-05-08 11:04:47'),
(22, '0f3424b9-d278-4f91-a744-ce1d0d65da1a', 1, 1, 'F1-009', 4, '2019-05-08 06:52:57', '2019-05-08 11:05:39'),
(23, '493131dd-2c2b-41f9-bd32-641347d5c947', 1, 1, 'F1-010', 4, '2019-05-08 06:52:58', '2019-05-08 11:11:22'),
(24, 'ca931cc5-31f5-4c38-9491-29868ea62e98', 1, 1, 'F1-011', 2, '2019-05-08 10:36:03', '2019-05-08 11:11:32'),
(25, '11eded22-1a28-46ca-853d-98acdf4746c4', 1, NULL, 'F1-012', 1, '2019-05-08 11:03:59', '2019-05-08 11:03:59'),
(26, '1a5b05c9-6814-4379-9000-8593e4e7b18d', 1, NULL, 'F1-013', 1, '2019-05-08 11:04:06', '2019-05-08 11:04:06');

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
(1, 3, 1, 2, '2019-05-06 09:01:32', '2019-05-06 09:01:32'),
(2, 3, 1, 4, '2019-05-06 09:01:43', '2019-05-06 09:01:43'),
(3, 3, 1, 4, '2019-05-06 09:02:02', '2019-05-06 09:02:02'),
(4, 3, 2, 2, '2019-05-06 09:03:45', '2019-05-06 09:03:45'),
(5, 3, 2, 4, '2019-05-06 09:03:51', '2019-05-06 09:03:51'),
(6, 3, 3, 2, '2019-05-06 09:03:55', '2019-05-06 09:03:55'),
(7, 3, 3, 4, '2019-05-06 09:05:38', '2019-05-06 09:05:38'),
(8, 3, 4, 2, '2019-05-06 09:05:42', '2019-05-06 09:05:42'),
(9, 3, 4, 4, '2019-05-06 09:12:09', '2019-05-06 09:12:09'),
(10, 3, 5, 2, '2019-05-06 09:19:47', '2019-05-06 09:19:47'),
(11, 3, 9, 2, '2019-05-07 06:48:05', '2019-05-07 06:48:05'),
(12, 3, 9, 4, '2019-05-07 10:34:25', '2019-05-07 10:34:25'),
(13, 3, 10, 2, '2019-05-07 10:34:36', '2019-05-07 10:34:36'),
(14, 3, 10, 4, '2019-05-07 10:38:43', '2019-05-07 10:38:43'),
(15, 3, 11, 2, '2019-05-07 10:38:49', '2019-05-07 10:38:49'),
(16, 3, 11, 4, '2019-05-07 10:43:57', '2019-05-07 10:43:57'),
(17, 3, 12, 2, '2019-05-07 10:44:23', '2019-05-07 10:44:23'),
(18, 3, 12, 4, '2019-05-07 10:44:55', '2019-05-07 10:44:55'),
(19, 3, 14, 2, '2019-05-08 06:55:11', '2019-05-08 06:55:11'),
(20, 3, 14, 4, '2019-05-08 06:58:19', '2019-05-08 06:58:19'),
(21, 3, 15, 2, '2019-05-08 06:58:26', '2019-05-08 06:58:26'),
(22, 3, 15, 4, '2019-05-08 06:59:26', '2019-05-08 06:59:26'),
(23, 3, 16, 2, '2019-05-08 06:59:48', '2019-05-08 06:59:48'),
(24, 3, 16, 4, '2019-05-08 07:23:32', '2019-05-08 07:23:32'),
(25, 3, 17, 2, '2019-05-08 07:23:35', '2019-05-08 07:23:35'),
(26, 3, 17, 4, '2019-05-08 07:31:31', '2019-05-08 07:31:31'),
(27, 3, 18, 2, '2019-05-08 10:10:39', '2019-05-08 10:10:39'),
(28, 3, 18, 3, '2019-05-08 10:10:44', '2019-05-08 10:10:44'),
(29, 3, 19, 2, '2019-05-08 10:10:44', '2019-05-08 10:10:44'),
(30, 3, 18, 5, '2019-05-08 10:10:47', '2019-05-08 10:10:47'),
(31, 3, 18, 4, '2019-05-08 10:11:08', '2019-05-08 10:11:08'),
(32, 3, 20, 2, '2019-05-08 10:11:13', '2019-05-08 10:11:13'),
(33, 3, 20, 4, '2019-05-08 10:24:13', '2019-05-08 10:24:13'),
(34, 3, 21, 2, '2019-05-08 10:24:15', '2019-05-08 10:24:15'),
(35, 3, 21, 4, '2019-05-08 11:04:47', '2019-05-08 11:04:47'),
(36, 3, 22, 2, '2019-05-08 11:05:30', '2019-05-08 11:05:30'),
(37, 3, 22, 4, '2019-05-08 11:05:39', '2019-05-08 11:05:39'),
(38, 3, 23, 2, '2019-05-08 11:11:16', '2019-05-08 11:11:16'),
(39, 3, 23, 4, '2019-05-08 11:11:22', '2019-05-08 11:11:22'),
(40, 3, 24, 2, '2019-05-08 11:11:32', '2019-05-08 11:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `source_doctor_id` int(11) NOT NULL,
  `source_clinic_id` int(11) NOT NULL,
  `name_en` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `uuid`, `user_id`, `source_doctor_id`, `source_clinic_id`, `name_en`, `name_ar`, `created_at`, `updated_at`) VALUES
(1, 112233, 4, 12, 1, 'Ahmed Samy', 'احمد سامى', '2019-05-06 00:59:21', '2019-05-06 00:59:24');

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
(41, '2019_04_18_092904_create_floor_kiosk_table', 3),
(42, '2019_04_22_130444_create_doctors_table', 4),
(43, '2019_04_22_130512_create_clinics_table', 4),
(44, '2019_04_22_130931_create_specialities_table', 4),
(45, '2019_04_22_130946_create_reservations_table', 4),
(46, '2019_04_22_131046_create_rooms_table', 4),
(49, '2019_04_24_075808_add_room_id_to_users', 5),
(50, '2019_04_24_082639_create_screen_room_table', 6),
(53, '2019_04_24_130608_create_room_queues_table', 7),
(54, '2019_04_24_130624_create_room_queue_statuses_table', 7);

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
(16, '2203dff0-9d94-4a5f-aba6-452aee0e0914', 'doctor_queue', 1, 1, NULL, '2019-04-12 11:30:17', '2019-04-12 11:30:17'),
(17, 'd97066b1-bc3c-4d9f-a5ae-daeb1455b53c', 'rooms', 1, 1, NULL, '2019-04-23 10:58:42', '2019-04-23 10:58:42');

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
(8, 16),
(1, 17),
(2, 17),
(3, 17),
(4, 17),
(5, 17),
(6, 17),
(7, 17);

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
(1, 12, 1),
(1, 17, 1),
(2, 17, 1),
(3, 17, 1),
(4, 17, 1),
(5, 17, 1),
(6, 17, 1),
(7, 17, 1),
(8, 10, 3),
(8, 16, 3),
(6, 17, 3),
(6, 8, 2),
(8, 10, 2),
(8, 13, 2);

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
(1, '0dd31434-4bf1-435f-9ead-6e1e7fc338bb', 1, 'label-purple', 'انتظار', 'Waiting', NULL, NULL),
(2, '84b5212d-8fa7-4838-9a80-718340b3bdbf', 1, 'label-primary', 'على الشباك', 'Called', NULL, NULL),
(3, '269b52b6-bf53-46de-b77c-25d160896bf1', 1, 'label-danger', 'غير موجود', 'Skipped', NULL, NULL),
(4, 'c51ac2b2-4635-4b0d-a1ee-9701306bf0c1', 1, 'label-success', 'تم الخدمة', 'Done', NULL, NULL),
(5, '1e962d13-1c39-4d13-be9a-f9c125908faa', 1, 'label-warning', 'رجوع', 'Call from skip', NULL, NULL),
(6, '3c5180bb-2efa-411f-a031-422e31b99bc2', 2, 'label-purple', 'انتظار', 'Waiting', NULL, NULL),
(7, 'fcd09945-450b-4b28-85ed-cf06803d513d', 2, 'label-primary', 'على الشباك', 'Called', NULL, NULL),
(8, '360f220b-780b-4bca-8eda-4200a137ee1c', 2, 'label-pink', 'فى العيادة', 'Patient In', NULL, NULL),
(9, '81276e85-b787-416a-83e7-a87ca9570821', 2, 'label-danger', 'غير موجود', 'Skipped', NULL, NULL),
(10, '2c6fc7c5-a2c2-4c00-9e49-ec9929b05e57', 2, 'label-success', 'تم الكشف', 'Patient Out', NULL, NULL),
(11, 'efdb1890-c690-404d-a1c6-d45f7f757a94', 2, 'label-warning', 'رجوع', 'Call from skip', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `desk_queue_id` int(11) DEFAULT NULL,
  `source_reservation_serial` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_patient_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_queue_number` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `uuid`, `clinic_id`, `doctor_id`, `desk_queue_id`, `source_reservation_serial`, `source_patient_name`, `source_queue_number`, `created_at`, `updated_at`) VALUES
(1, '1111', 1, 1, 23, '123', 'Saly Ibrahim', '15', '2019-05-05 23:36:31', '2019-05-08 11:11:22');

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
(1, '1ac8d13b-2290-4312-8af9-804323097039', 'Admin', 'user', 'label-success', '#010', 1, 1, NULL, '2019-04-07 06:40:19', '2019-04-23 10:59:46'),
(2, '1c70bf15-768d-46ff-b2b8-eb32d8c86096', 'Desk', 'user', 'label-danger', '#f00', 1, 1, NULL, '2019-04-11 17:28:15', '2019-04-24 10:54:31'),
(3, 'ee7945a5-59d8-4a4e-9457-c698639f7797', 'Doctor', 'icon', 'label-warning', 'yellow', 1, 1, NULL, '2019-04-24 09:20:36', '2019-04-24 10:52:08');

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
(1, 1),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
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
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `uuid`, `floor_id`, `ip`, `name_ar`, `name_en`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '0da2d115-0957-4f7a-8728-e3794d036957', 1, '10.1.30.58', 'عيادة الاسنان', 'R1', 1, 1, 1, NULL, '2019-04-23 11:18:02', '2019-05-06 05:50:21'),
(2, '4cdb8b9a-1734-4d9d-a6c5-46283f9fc5c7', 1, '192.168.1.4', 'عيادة القلب', 'R2', 1, 1, 1, NULL, '2019-04-24 06:42:43', '2019-05-05 21:35:31'),
(3, '2a5f1d74-508f-4991-bf85-6f4e6bc6e12e', 1, '4646464564056', 'عيادة الصدر', 'R3', 1, 1, 1, NULL, '2019-04-24 06:47:05', '2019-04-28 07:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `room_queues`
--

CREATE TABLE `room_queues` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `queue_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_queues`
--

INSERT INTO `room_queues` (`id`, `uuid`, `floor_id`, `room_id`, `queue_number`, `status`, `created_at`, `updated_at`) VALUES
(8, 'd9e1065c-e28d-404f-b9d1-e28454ffcd20', 1, 1, '15', 6, '2019-05-08 11:11:22', '2019-05-08 11:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `room_queue_statuses`
--

CREATE TABLE `room_queue_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_queue_id` int(11) NOT NULL,
  `queue_status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '98d560b7-9f66-4543-bbb4-ff8ffda64fed', 'f1-reception-1', 2, 1, '192.168.1.2', 'ريسبشن الدور الالول', 'Reception 1', 1, 1, 1, NULL, '2019-04-14 05:38:26', '2019-04-24 08:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `screen_room`
--

CREATE TABLE `screen_room` (
  `screen_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screen_room`
--

INSERT INTO `screen_room` (`screen_id`, `room_id`) VALUES
(4, 1),
(4, 2),
(4, 3);

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
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` int(11) NOT NULL,
  `source_speciality_id` int(11) NOT NULL,
  `name_en` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`id`, `uuid`, `source_speciality_id`, `name_en`, `name_ar`, `created_at`, `updated_at`) VALUES
(1, 112233, 12, 'Endocrine glands', 'غدد صماء', '2019-05-06 00:59:21', '2019-05-06 00:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desk_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
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

INSERT INTO `users` (`id`, `uuid`, `desk_id`, `room_id`, `login_ip`, `name`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_by`, `updated_by`, `status`, `type`, `available`, `api_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '3322b3c3-b3ee-45ed-8549-fb1505228790', NULL, NULL, NULL, 'Ahmed Samy', '01002589847', 'ahmsam39@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'H4gRNaORovyjU9wbSS23cz0O2sNIk8MegV4RzXkkL0u9MQmCpCt5mupOJxUc', 1, 1, 1, 0, 0, NULL, NULL, '2019-04-04 10:58:52', '2019-04-30 05:04:44'),
(2, '3018e110-bc9a-46a0-870e-92ae16d0765f', NULL, NULL, NULL, 'Yasser Hamdy', '123456789', 'desk2@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'bYIN0dzyI0pdNbQjg8wvY37dVOYUyoYiPoD48V4uSG53zYuuxJdVuKVqTDJV', 1, 1, 1, 1, 0, NULL, NULL, '2019-04-07 09:47:57', '2019-04-13 15:38:03'),
(3, '31e9a2af-6c96-45f4-845c-81737da7bca5', 1, NULL, '10.1.30.58', 'Amany Essam', '123456789', 'desk1@gmail.com', NULL, '$2y$10$fVDOvS5s1Uky4oqVV2lCce1EyHpnly2P4HgNd4TvDyrSit1Qi/252', 'he9OPq4amYGWOlLBTZnc6b5zn4OlTJYMJbRtHWnzeEQ1uthvAZyrGq8HXvDv', 1, 1, 1, 2, 1, NULL, NULL, '2019-04-12 09:10:05', '2019-05-08 06:43:44'),
(4, 'a0d43faa-2118-4584-958d-1579c8a204d1', NULL, 1, '10.1.30.58', 'Dr Ahmed', '0123456789', 'room1@gmail.com', NULL, '$2y$10$amLKqbkEdxx.1jUQvOmW6.S2Rz5XpfDs5.kvpgekSb2s.JvgNwn5m', 'o3VRRpH6LZOB1cXKjNLb3y9aQSIgrK7dWZ8NyDhwpq4TpPxAz2U2fjpOVTmJ', 1, 1, 1, 1, 1, NULL, NULL, '2019-04-24 09:20:48', '2019-05-08 06:54:28');

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
(5, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-21 12:49:48', NULL, '2019-04-21 10:49:48', '2019-04-21 10:49:48'),
(6, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-22 08:17:30', NULL, '2019-04-22 06:17:30', '2019-04-22 06:17:30'),
(7, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-22 10:56:01', NULL, '2019-04-22 08:56:01', '2019-04-22 08:56:01'),
(8, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-23 08:00:21', NULL, '2019-04-23 06:00:21', '2019-04-23 06:00:21'),
(9, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-23 08:04:25', NULL, '2019-04-23 06:04:25', '2019-04-23 06:04:25'),
(10, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-23 10:33:05', NULL, '2019-04-23 08:33:05', '2019-04-23 08:33:05'),
(11, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-23 12:31:56', NULL, '2019-04-23 10:31:56', '2019-04-23 10:31:56'),
(12, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-23 12:34:56', NULL, '2019-04-23 10:34:56', '2019-04-23 10:34:56'),
(13, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-23 18:40:45', NULL, '2019-04-23 16:40:44', '2019-04-23 16:40:44'),
(14, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-23 18:40:57', NULL, '2019-04-23 16:40:57', '2019-04-23 16:40:57'),
(15, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-24 06:50:53', NULL, '2019-04-24 04:50:53', '2019-04-24 04:50:53'),
(16, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-24 06:53:32', NULL, '2019-04-24 04:53:32', '2019-04-24 04:53:32'),
(17, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-24 06:55:58', NULL, '2019-04-24 04:55:58', '2019-04-24 04:55:58'),
(18, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-24 11:23:40', NULL, '2019-04-24 09:23:40', '2019-04-24 09:23:40'),
(19, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-24 13:00:24', NULL, '2019-04-24 11:00:24', '2019-04-24 11:00:24'),
(20, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-24 13:01:37', NULL, '2019-04-24 11:01:37', '2019-04-24 11:01:37'),
(21, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-28 07:03:55', NULL, '2019-04-28 05:03:55', '2019-04-28 05:03:55'),
(22, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-28 07:26:36', NULL, '2019-04-28 05:26:36', '2019-04-28 05:26:36'),
(23, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-28 09:16:13', NULL, '2019-04-28 07:16:13', '2019-04-28 07:16:13'),
(24, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-28 11:06:29', NULL, '2019-04-28 09:06:29', '2019-04-28 09:06:29'),
(25, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-28 11:24:09', NULL, '2019-04-28 09:24:09', '2019-04-28 09:24:09'),
(26, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-28 11:31:32', NULL, '2019-04-28 09:31:32', '2019-04-28 09:31:32'),
(27, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-28 12:26:14', NULL, '2019-04-28 10:26:14', '2019-04-28 10:26:14'),
(28, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-28 12:46:50', NULL, '2019-04-28 10:46:50', '2019-04-28 10:46:50'),
(29, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-28 12:56:38', NULL, '2019-04-28 10:56:38', '2019-04-28 10:56:38'),
(30, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-28 12:58:40', NULL, '2019-04-28 10:58:40', '2019-04-28 10:58:40'),
(31, 1, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-30 06:56:52', NULL, '2019-04-30 04:56:52', '2019-04-30 04:56:52'),
(32, 4, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-30 07:06:34', NULL, '2019-04-30 05:06:34', '2019-04-30 05:06:34'),
(33, 3, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-30 13:20:51', NULL, '2019-04-30 11:20:51', '2019-04-30 11:20:51'),
(34, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-30 13:21:39', NULL, '2019-04-30 11:21:39', '2019-04-30 11:21:39'),
(35, 3, '::1', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-04-30 13:24:14', NULL, '2019-04-30 11:24:14', '2019-04-30 11:24:14'),
(36, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-05 06:07:52', NULL, '2019-05-05 04:07:51', '2019-05-05 04:07:51'),
(37, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-05 06:08:56', NULL, '2019-05-05 04:08:56', '2019-05-05 04:08:56'),
(38, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-05 11:21:54', NULL, '2019-05-05 09:21:54', '2019-05-05 09:21:54'),
(39, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-05 11:29:40', NULL, '2019-05-05 09:29:40', '2019-05-05 09:29:40'),
(40, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-05 15:38:51', NULL, '2019-05-05 13:38:51', '2019-05-05 13:38:51'),
(41, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-05 19:09:04', NULL, '2019-05-05 17:09:04', '2019-05-05 17:09:04'),
(42, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-05 23:35:05', NULL, '2019-05-05 21:35:05', '2019-05-05 21:35:05'),
(43, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-06 07:49:55', NULL, '2019-05-06 05:49:55', '2019-05-06 05:49:55'),
(44, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-06 07:51:30', NULL, '2019-05-06 05:51:30', '2019-05-06 05:51:30'),
(45, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-06 09:19:33', NULL, '2019-05-06 07:19:33', '2019-05-06 07:19:33'),
(46, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-06 09:40:38', NULL, '2019-05-06 07:40:38', '2019-05-06 07:40:38'),
(47, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-06 09:41:22', NULL, '2019-05-06 07:41:22', '2019-05-06 07:41:22'),
(48, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-07 08:18:02', NULL, '2019-05-07 06:18:02', '2019-05-07 06:18:02'),
(49, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-07 08:18:18', NULL, '2019-05-07 06:18:18', '2019-05-07 06:18:18'),
(50, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-07 08:43:06', NULL, '2019-05-07 06:43:06', '2019-05-07 06:43:06'),
(51, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-07 12:32:33', NULL, '2019-05-07 10:32:33', '2019-05-07 10:32:33'),
(52, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-07 12:34:16', NULL, '2019-05-07 10:34:16', '2019-05-07 10:34:16'),
(53, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-08 08:43:45', NULL, '2019-05-08 06:43:45', '2019-05-08 06:43:45'),
(54, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-08 08:51:09', NULL, '2019-05-08 06:51:09', '2019-05-08 06:51:09'),
(55, 4, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-08 08:54:29', NULL, '2019-05-08 06:54:29', '2019-05-08 06:54:29'),
(56, 1, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-08 11:32:55', NULL, '2019-05-08 09:32:55', '2019-05-08 09:32:55'),
(57, 3, 'UNKNOWN', '{\"browser_name_regex\":\"~^.*$~\",\"browser_name_pattern\":\"*\",\"browser\":\"Default Browser\",\"version\":\"0\",\"majorver\":\"0\",\"minorver\":\"0\",\"platform\":\"unknown\",\"alpha\":\"\",\"beta\":\"\",\"win16\":\"\",\"win32\":\"\",\"win64\":\"\",\"frames\":\"1\",\"iframes\":\"\",\"tables\":\"1\",\"cookies\":\"\",\"backgroundsounds\":\"\",\"cdf\":\"\",\"vbscript\":\"\",\"javaapplets\":\"\",\"javascript\":\"\",\"activexcontrols\":\"\",\"isbanned\":\"\",\"ismobiledevice\":\"\",\"issyndicationreader\":\"\",\"crawler\":\"\",\"cssversion\":\"0\",\"supportscss\":\"\",\"aol\":\"\",\"aolversion\":\"0\"}', '2019-05-08 12:10:36', NULL, '2019-05-08 10:10:36', '2019-05-08 10:10:36');

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
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
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
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_queues`
--
ALTER TABLE `room_queues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_queue_statuses`
--
ALTER TABLE `room_queue_statuses`
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
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
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
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `desks`
--
ALTER TABLE `desks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `desk_queues`
--
ALTER TABLE `desk_queues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `desk_queue_statuses`
--
ALTER TABLE `desk_queue_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `queue_statuses`
--
ALTER TABLE `queue_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `room_queues`
--
ALTER TABLE `room_queues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `room_queue_statuses`
--
ALTER TABLE `room_queue_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `specialities`
--
ALTER TABLE `specialities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_login_histories`
--
ALTER TABLE `user_login_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
