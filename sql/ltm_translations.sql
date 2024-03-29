-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2019 at 10:50 AM
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

--
-- Dumping data for table `ltm_translations`
--

INSERT INTO `ltm_translations` (`id`, `status`, `locale`, `group`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 0, 'en', 'auth', 'failed', 'These credentials do not match our records.', '2019-07-01 09:47:12', '2019-09-03 09:05:52'),
(2, 0, 'en', 'auth', 'throttle', 'Too many login attempts. Please try again in :seconds seconds.', '2019-07-01 09:47:12', '2019-09-03 09:05:52'),
(3, 0, 'en', 'pagination', 'previous', '« Previous', '2019-07-01 09:47:13', '2019-09-03 09:43:16'),
(4, 0, 'en', 'pagination', 'next', 'Next »', '2019-07-01 09:47:13', '2019-09-03 09:43:16'),
(5, 0, 'en', 'passwords', 'password', 'Passwords must be at least six characters and match the confirmation.', '2019-07-01 09:47:13', '2019-09-03 09:50:26'),
(6, 0, 'en', 'passwords', 'reset', 'Your password has been reset!', '2019-07-01 09:47:13', '2019-09-03 09:50:26'),
(7, 0, 'en', 'passwords', 'sent', 'We have e-mailed your password reset link!', '2019-07-01 09:47:13', '2019-09-03 09:50:26'),
(8, 0, 'en', 'passwords', 'token', 'This password reset token is invalid.', '2019-07-01 09:47:13', '2019-09-03 09:50:26'),
(9, 0, 'en', 'passwords', 'user', 'We can\'t find a user with that e-mail address.', '2019-07-01 09:47:13', '2019-09-03 09:50:26'),
(10, 0, 'en', 'validation', 'accepted', 'The :attribute must be accepted.', '2019-07-01 09:47:13', '2019-09-01 06:26:13'),
(11, 0, 'en', 'validation', 'active_url', 'The :attribute is not a valid URL.', '2019-07-01 09:47:13', '2019-09-01 06:26:13'),
(12, 0, 'en', 'validation', 'after', 'The :attribute must be a date after :date.', '2019-07-01 09:47:13', '2019-09-01 06:26:13'),
(13, 0, 'en', 'validation', 'after_or_equal', 'The :attribute must be a date after or equal to :date.', '2019-07-01 09:47:13', '2019-09-01 06:26:14'),
(14, 0, 'en', 'validation', 'alpha', 'The :attribute may only contain letters.', '2019-07-01 09:47:13', '2019-09-01 06:26:14'),
(15, 0, 'en', 'validation', 'alpha_dash', 'The :attribute may only contain letters, numbers, dashes and underscores.', '2019-07-01 09:47:13', '2019-09-01 06:26:14'),
(16, 0, 'en', 'validation', 'alpha_num', 'The :attribute may only contain letters and numbers.', '2019-07-01 09:47:13', '2019-09-01 06:26:15'),
(17, 0, 'en', 'validation', 'array', 'The :attribute must be an array.', '2019-07-01 09:47:13', '2019-09-01 06:26:15'),
(18, 0, 'en', 'validation', 'before', 'The :attribute must be a date before :date.', '2019-07-01 09:47:13', '2019-09-01 06:26:15'),
(19, 0, 'en', 'validation', 'before_or_equal', 'The :attribute must be a date before or equal to :date.', '2019-07-01 09:47:13', '2019-09-01 06:26:16'),
(20, 0, 'en', 'validation', 'between.numeric', 'The :attribute must be between :min and :max.', '2019-07-01 09:47:13', '2019-09-01 06:26:16'),
(21, 0, 'en', 'validation', 'between.file', 'The :attribute must be between :min and :max kilobytes.', '2019-07-01 09:47:14', '2019-09-01 06:26:17'),
(22, 0, 'en', 'validation', 'between.string', 'The :attribute must be between :min and :max characters.', '2019-07-01 09:47:14', '2019-09-01 06:26:17'),
(23, 0, 'en', 'validation', 'between.array', 'The :attribute must have between :min and :max items.', '2019-07-01 09:47:14', '2019-09-01 06:26:17'),
(24, 0, 'en', 'validation', 'boolean', 'The :attribute field must be true or false.', '2019-07-01 09:47:14', '2019-09-01 06:26:17'),
(25, 0, 'en', 'validation', 'confirmed', 'The :attribute confirmation does not match.', '2019-07-01 09:47:14', '2019-09-01 06:26:17'),
(26, 0, 'en', 'validation', 'date', 'The :attribute is not a valid date.', '2019-07-01 09:47:14', '2019-09-01 06:26:17'),
(27, 0, 'en', 'validation', 'date_format', 'The :attribute does not match the format :format.', '2019-07-01 09:47:14', '2019-09-01 06:26:17'),
(28, 0, 'en', 'validation', 'different', 'The :attribute and :other must be different.', '2019-07-01 09:47:14', '2019-09-01 06:26:18'),
(29, 0, 'en', 'validation', 'digits', 'The :attribute must be :digits digits.', '2019-07-01 09:47:14', '2019-09-01 06:26:18'),
(30, 0, 'en', 'validation', 'digits_between', 'The :attribute must be between :min and :max digits.', '2019-07-01 09:47:14', '2019-09-01 06:26:18'),
(31, 0, 'en', 'validation', 'dimensions', 'The :attribute has invalid image dimensions.', '2019-07-01 09:47:14', '2019-09-01 06:26:19'),
(32, 0, 'en', 'validation', 'distinct', 'The :attribute field has a duplicate value.', '2019-07-01 09:47:14', '2019-09-01 06:26:19'),
(33, 0, 'en', 'validation', 'email', 'The :attribute must be a valid email address.', '2019-07-01 09:47:14', '2019-09-01 06:26:19'),
(34, 0, 'en', 'validation', 'exists', 'The selected :attribute is invalid.', '2019-07-01 09:47:14', '2019-09-01 06:26:19'),
(35, 0, 'en', 'validation', 'file', 'The :attribute must be a file.', '2019-07-01 09:47:15', '2019-09-01 06:26:19'),
(36, 0, 'en', 'validation', 'filled', 'The :attribute field must have a value.', '2019-07-01 09:47:15', '2019-09-01 06:26:19'),
(37, 0, 'en', 'validation', 'gt.numeric', 'The :attribute must be greater than :value.', '2019-07-01 09:47:15', '2019-09-01 06:26:19'),
(38, 0, 'en', 'validation', 'gt.file', 'The :attribute must be greater than :value kilobytes.', '2019-07-01 09:47:15', '2019-09-01 06:26:19'),
(39, 0, 'en', 'validation', 'gt.string', 'The :attribute must be greater than :value characters.', '2019-07-01 09:47:15', '2019-09-01 06:26:20'),
(40, 0, 'en', 'validation', 'gt.array', 'The :attribute must have more than :value items.', '2019-07-01 09:47:15', '2019-09-01 06:26:20'),
(41, 0, 'en', 'validation', 'gte.numeric', 'The :attribute must be greater than or equal :value.', '2019-07-01 09:47:15', '2019-09-01 06:26:20'),
(42, 0, 'en', 'validation', 'gte.file', 'The :attribute must be greater than or equal :value kilobytes.', '2019-07-01 09:47:15', '2019-09-01 06:26:20'),
(43, 0, 'en', 'validation', 'gte.string', 'The :attribute must be greater than or equal :value characters.', '2019-07-01 09:47:15', '2019-09-01 06:26:20'),
(44, 0, 'en', 'validation', 'gte.array', 'The :attribute must have :value items or more.', '2019-07-01 09:47:15', '2019-09-01 06:26:20'),
(45, 0, 'en', 'validation', 'image', 'The :attribute must be an image.', '2019-07-01 09:47:15', '2019-09-01 06:26:20'),
(46, 0, 'en', 'validation', 'in', 'The selected :attribute is invalid.', '2019-07-01 09:47:16', '2019-09-01 06:26:20'),
(47, 0, 'en', 'validation', 'in_array', 'The :attribute field does not exist in :other.', '2019-07-01 09:47:16', '2019-09-01 06:26:20'),
(48, 0, 'en', 'validation', 'integer', 'The :attribute must be an integer.', '2019-07-01 09:47:16', '2019-09-01 06:26:20'),
(49, 0, 'en', 'validation', 'ip', 'The :attribute must be a valid IP address.', '2019-07-01 09:47:16', '2019-09-01 06:26:21'),
(50, 0, 'en', 'validation', 'ipv4', 'The :attribute must be a valid IPv4 address.', '2019-07-01 09:47:16', '2019-09-01 06:26:21'),
(51, 0, 'en', 'validation', 'ipv6', 'The :attribute must be a valid IPv6 address.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(52, 0, 'en', 'validation', 'json', 'The :attribute must be a valid JSON string.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(53, 0, 'en', 'validation', 'lt.numeric', 'The :attribute must be less than :value.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(54, 0, 'en', 'validation', 'lt.file', 'The :attribute must be less than :value kilobytes.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(55, 0, 'en', 'validation', 'lt.string', 'The :attribute must be less than :value characters.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(56, 0, 'en', 'validation', 'lt.array', 'The :attribute must have less than :value items.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(57, 0, 'en', 'validation', 'lte.numeric', 'The :attribute must be less than or equal :value.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(58, 0, 'en', 'validation', 'lte.file', 'The :attribute must be less than or equal :value kilobytes.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(59, 0, 'en', 'validation', 'lte.string', 'The :attribute must be less than or equal :value characters.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(60, 0, 'en', 'validation', 'lte.array', 'The :attribute must not have more than :value items.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(61, 0, 'en', 'validation', 'max.numeric', 'The :attribute may not be greater than :max.', '2019-07-01 09:47:16', '2019-09-01 06:26:22'),
(62, 0, 'en', 'validation', 'max.file', 'The :attribute may not be greater than :max kilobytes.', '2019-07-01 09:47:17', '2019-09-01 06:26:22'),
(63, 0, 'en', 'validation', 'max.string', 'The :attribute may not be greater than :max characters.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(64, 0, 'en', 'validation', 'max.array', 'The :attribute may not have more than :max items.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(65, 0, 'en', 'validation', 'mimes', 'The :attribute must be a file of type: :values.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(66, 0, 'en', 'validation', 'mimetypes', 'The :attribute must be a file of type: :values.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(67, 0, 'en', 'validation', 'min.numeric', 'The :attribute must be at least :min.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(68, 0, 'en', 'validation', 'min.file', 'The :attribute must be at least :min kilobytes.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(69, 0, 'en', 'validation', 'min.string', 'The :attribute must be at least :min characters.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(70, 0, 'en', 'validation', 'min.array', 'The :attribute must have at least :min items.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(71, 0, 'en', 'validation', 'not_in', 'The selected :attribute is invalid.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(72, 0, 'en', 'validation', 'not_regex', 'The :attribute format is invalid.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(73, 0, 'en', 'validation', 'numeric', 'The :attribute must be a number.', '2019-07-01 09:47:17', '2019-09-01 06:26:23'),
(74, 0, 'en', 'validation', 'present', 'The :attribute field must be present.', '2019-07-01 09:47:17', '2019-09-01 06:26:24'),
(75, 0, 'en', 'validation', 'regex', 'The :attribute format is invalid.', '2019-07-01 09:47:17', '2019-09-01 06:26:24'),
(76, 0, 'en', 'validation', 'required', 'The :attribute field is required.', '2019-07-01 09:47:18', '2019-09-01 06:26:24'),
(77, 0, 'en', 'validation', 'required_if', 'The :attribute field is required when :other is :value.', '2019-07-01 09:47:18', '2019-09-01 06:26:24'),
(78, 0, 'en', 'validation', 'required_unless', 'The :attribute field is required unless :other is in :values.', '2019-07-01 09:47:18', '2019-09-01 06:26:24'),
(79, 0, 'en', 'validation', 'required_with', 'The :attribute field is required when :values is present.', '2019-07-01 09:47:18', '2019-09-01 06:26:24'),
(80, 0, 'en', 'validation', 'required_with_all', 'The :attribute field is required when :values is present.', '2019-07-01 09:47:18', '2019-09-01 06:26:24'),
(81, 0, 'en', 'validation', 'required_without', 'The :attribute field is required when :values is not present.', '2019-07-01 09:47:18', '2019-09-01 06:26:24'),
(82, 0, 'en', 'validation', 'required_without_all', 'The :attribute field is required when none of :values are present.', '2019-07-01 09:47:18', '2019-09-01 06:26:24'),
(83, 0, 'en', 'validation', 'same', 'The :attribute and :other must match.', '2019-07-01 09:47:18', '2019-09-01 06:26:24'),
(84, 0, 'en', 'validation', 'size.numeric', 'The :attribute must be :size.', '2019-07-01 09:47:18', '2019-09-01 06:26:25'),
(85, 0, 'en', 'validation', 'size.file', 'The :attribute must be :size kilobytes.', '2019-07-01 09:47:18', '2019-09-01 06:26:25'),
(86, 0, 'en', 'validation', 'size.string', 'The :attribute must be :size characters.', '2019-07-01 09:47:18', '2019-09-01 06:26:25'),
(87, 0, 'en', 'validation', 'size.array', 'The :attribute must contain :size items.', '2019-07-01 09:47:19', '2019-09-01 06:26:25'),
(88, 0, 'en', 'validation', 'string', 'The :attribute must be a string.', '2019-07-01 09:47:19', '2019-09-01 06:26:25'),
(89, 0, 'en', 'validation', 'timezone', 'The :attribute must be a valid zone.', '2019-07-01 09:47:19', '2019-09-01 06:26:25'),
(90, 0, 'en', 'validation', 'unique', 'The :attribute has already been taken.', '2019-07-01 09:47:19', '2019-09-01 06:26:25'),
(91, 0, 'en', 'validation', 'uploaded', 'The :attribute failed to upload.', '2019-07-01 09:47:19', '2019-09-01 06:26:25'),
(92, 0, 'en', 'validation', 'url', 'The :attribute format is invalid.', '2019-07-01 09:47:19', '2019-09-01 06:26:25'),
(93, 0, 'en', 'validation', 'custom.attribute-name.rule-name', 'custom-message', '2019-07-01 09:47:19', '2019-09-01 06:26:25'),
(94, 0, 'ar', 'sidebar', 'Dashboard', 'الرئيسية', '2019-09-01 06:26:11', '2019-09-03 10:07:48'),
(95, 0, 'ar', 'sidebar', 'Get_my_IP', 'الاي بى', '2019-09-01 06:26:11', '2019-09-03 10:07:48'),
(96, 0, 'ar', 'sidebar', 'Desk_queue', 'انتظار الاستقبال', '2019-09-01 06:26:11', '2019-09-03 10:07:48'),
(97, 0, 'ar', 'sidebar', 'Doctors_queue', 'قائمة انتظار الأطباء', '2019-09-01 06:26:11', '2019-09-03 10:07:48'),
(98, 0, 'en', 'sidebar', 'Dashboard', 'Dashboard', '2019-09-01 06:26:13', '2019-09-03 10:07:48'),
(99, 0, 'en', 'sidebar', 'Desk_queue', 'Desk queue', '2019-09-01 06:26:13', '2019-09-03 10:07:48'),
(100, 0, 'en', 'sidebar', 'Doctors_queue', 'Doctors queue', '2019-09-01 06:26:13', '2019-09-03 10:07:48'),
(101, 0, 'en', 'sidebar', 'Get_my_IP', 'Get my IP', '2019-09-01 06:26:13', '2019-09-03 10:07:48'),
(102, 0, 'en', 'desks', 'Skipped', 'Skipped', '2019-09-01 06:26:42', '2019-09-03 09:34:31'),
(103, 0, 'en', 'desks', 'Done', 'Done', '2019-09-01 06:26:42', '2019-09-03 09:34:31'),
(104, 0, 'en', 'desks', 'Done_button', 'Done button', '2019-09-01 06:26:42', '2019-09-03 09:34:31'),
(105, 0, 'en', 'desks', 'Done_and_next', 'Done And Next', '2019-09-01 06:26:42', '2019-09-03 09:34:31'),
(106, 0, 'en', 'desks', 'Skip_button', 'Skip button', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(107, 0, 'en', 'desks', 'Skip', 'Skip', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(108, 0, 'en', 'desks', 'Skip_and_next', 'Skip And Next', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(109, 0, 'en', 'desks', 'Search', 'Search', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(110, 0, 'en', 'desks', 'Current_Serving_Queue', 'Current Serving Queue', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(111, 0, 'en', 'desks', 'Waiting', 'Waiting', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(112, 0, 'en', 'desks', 'Skip_And_Next', 'Skip And Next', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(113, 0, 'en', 'desks', 'Next', 'Next', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(114, 0, 'en', 'desks', 'Call_Again', 'Call Again', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(115, 0, 'en', 'desks', 'Done_And_Next', 'Done And Next', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(116, 0, 'en', 'desks', 'Today_Queue', 'Today Queue', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(117, 0, 'en', 'desks', 'Queue', 'Queue', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(118, 0, 'en', 'desks', 'Status', 'Status', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(119, 0, 'en', 'desks', 'Action', 'Action', '2019-09-01 06:26:43', '2019-09-03 09:34:31'),
(120, 0, 'en', 'desks', 'Call_again', 'Call again', '2019-09-01 06:26:44', '2019-09-03 09:34:31'),
(121, 0, 'en', 'desks', 'By', 'By', '2019-09-01 06:26:44', '2019-09-03 09:34:31'),
(122, 0, 'en', 'floors', 'Floors', 'Floors', '2019-09-01 06:26:44', '2019-09-03 09:42:28'),
(123, 0, 'en', 'floors', 'Index', 'Index', '2019-09-01 06:26:44', '2019-09-03 09:42:28'),
(124, 0, 'en', 'floors', 'Search_filter', 'Search filter', '2019-09-01 06:26:44', '2019-09-03 09:42:28'),
(125, 0, 'en', 'floors', 'Create_new', 'Create new', '2019-09-01 06:26:44', '2019-09-03 09:42:28'),
(126, 0, 'en', 'rooms', 'Skipped', 'Skipped', '2019-09-01 06:26:44', '2019-09-03 10:09:26'),
(127, 0, 'en', 'rooms', 'Patient_Out', 'Patient Out', '2019-09-01 06:26:44', '2019-09-03 10:09:26'),
(128, 0, 'en', 'rooms', 'Waiting', 'Waiting', '2019-09-01 06:26:44', '2019-09-03 10:09:26'),
(129, 0, 'en', 'rooms', 'Call_Next', 'Call Next', '2019-09-01 06:26:45', '2019-09-03 10:09:26'),
(130, 0, 'en', 'rooms', 'Call_Next_Again', 'Call Next Again', '2019-09-01 06:26:45', '2019-09-03 10:09:26'),
(131, 0, 'en', 'rooms', 'Patient_in', 'Patient in', '2019-09-01 06:26:45', '2019-09-03 10:09:26'),
(132, 0, 'en', 'rooms', 'Patient_out', 'Patient out', '2019-09-01 06:26:45', '2019-09-03 10:09:26'),
(133, 0, 'en', 'rooms', 'Today_Queue', 'Today_Queue', '2019-09-01 06:26:45', '2019-09-03 10:09:26'),
(134, 0, 'en', 'rooms', 'Search', 'Search', '2019-09-01 06:26:45', '2019-09-03 10:09:26'),
(135, 0, 'en', 'rooms', 'All', 'All', '2019-09-01 06:26:46', '2019-09-03 10:09:26'),
(136, 0, 'en', 'rooms', 'Queue', 'Queue', '2019-09-01 06:26:46', '2019-09-03 10:09:26'),
(137, 0, 'en', 'rooms', 'Status', 'Status', '2019-09-01 06:26:46', '2019-09-03 10:09:26'),
(138, 0, 'en', 'rooms', 'Action', 'Action', '2019-09-01 06:26:46', '2019-09-03 10:09:26'),
(139, 0, 'en', 'rooms', 'Call_again', 'Call Again', '2019-09-01 06:26:46', '2019-09-03 10:09:26'),
(140, 0, 'en', 'rooms', 'From', 'From', '2019-09-01 06:26:46', '2019-09-03 10:09:26'),
(141, 0, 'en', '_json', 'Reset Password', 'Reset Password', '2019-09-01 06:26:46', '2019-09-03 08:20:55'),
(142, 0, 'en', '_json', 'E-Mail Address', 'E-Mail Address', '2019-09-01 06:26:46', '2019-09-03 08:20:55'),
(143, 0, 'en', '_json', 'Send Password Reset Link', 'Send Password Reset Link', '2019-09-01 06:26:46', '2019-09-03 08:20:55'),
(144, 0, 'en', '_json', 'Password', 'Password', '2019-09-01 06:26:46', '2019-09-03 08:20:55'),
(145, 0, 'en', '_json', 'Confirm Password', 'Confirm Password', '2019-09-01 06:26:47', '2019-09-03 08:20:55'),
(146, 0, 'en', '_json', 'Verify Your Email Address', 'Verify Your Email Address', '2019-09-01 06:26:47', '2019-09-03 08:20:55'),
(147, 0, 'en', '_json', 'A fresh verification link has been sent to your email address.', 'A fresh verification link has been sent to your email address.', '2019-09-01 06:26:47', '2019-09-03 08:20:55'),
(148, 0, 'en', '_json', 'Before proceeding, please check your email for a verification link.', 'Before proceeding, please check your email for a verification link.', '2019-09-01 06:26:47', '2019-09-03 08:20:55'),
(149, 0, 'en', '_json', 'If you did not receive the email', 'If you did not receive the email', '2019-09-01 06:26:48', '2019-09-03 08:20:55'),
(150, 0, 'en', '_json', 'click here to request another', 'click here to request another', '2019-09-01 06:26:48', '2019-09-03 08:20:55'),
(151, 0, 'en', '_json', 'Toggle navigation', 'Toggle navigation', '2019-09-01 06:26:48', '2019-09-03 08:20:55'),
(152, 0, 'en', '_json', 'Login', 'Login', '2019-09-01 06:26:48', '2019-09-03 08:20:55'),
(153, 0, 'en', '_json', 'Register', 'Register', '2019-09-01 06:26:48', '2019-09-03 08:20:55'),
(154, 0, 'en', '_json', 'Logout', 'Logout', '2019-09-01 06:26:48', '2019-09-03 08:20:55'),
(155, 0, 'ar', 'desks', 'Skipped', 'تخطى', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(156, 0, 'ar', 'desks', 'Done', 'تم', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(157, 0, 'ar', 'desks', 'Done_button', 'تم', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(158, 0, 'ar', 'desks', 'Done_and_next', 'تم و التالى', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(159, 0, 'ar', 'desks', 'Skip_button', 'تخطى', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(160, 0, 'ar', 'desks', 'Skip', 'تخطى', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(161, 0, 'ar', 'desks', 'Skip_and_next', 'تخطى و التالى', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(162, 0, 'ar', 'desks', 'Search', 'بحث', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(163, 0, 'ar', 'desks', 'Current_Serving_Queue', NULL, '2019-09-02 08:19:40', '2019-09-02 08:19:40'),
(164, 0, 'ar', 'desks', 'Waiting', 'الانتظار', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(165, 0, 'ar', 'desks', 'Skip_And_Next', 'تخطى و التالى', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(166, 0, 'ar', 'desks', 'Next', 'التالى', '2019-09-02 08:19:40', '2019-09-03 09:34:31'),
(167, 0, 'ar', 'desks', 'Call_Again', 'النداء مره اخرى', '2019-09-02 08:19:41', '2019-09-03 09:34:31'),
(168, 0, 'ar', 'desks', 'Done_And_Next', 'تم و التالى', '2019-09-02 08:19:41', '2019-09-03 09:34:31'),
(169, 0, 'ar', 'desks', 'Today_Queue', 'قائمة انتظار اليوم', '2019-09-02 08:19:41', '2019-09-03 09:34:31'),
(170, 0, 'ar', 'desks', 'Queue', 'قائمة الانتظار', '2019-09-02 08:19:41', '2019-09-03 09:34:31'),
(171, 0, 'ar', 'desks', 'Status', 'الحاله', '2019-09-02 08:19:41', '2019-09-03 09:34:31'),
(172, 0, 'ar', 'desks', 'Action', 'مفعل', '2019-09-02 08:19:41', '2019-09-03 09:34:31'),
(173, 0, 'ar', 'desks', 'Call_again', 'النداء مره اخرى', '2019-09-02 08:19:41', '2019-09-03 09:34:31'),
(174, 0, 'ar', 'desks', 'By', 'بواسطة', '2019-09-02 08:19:41', '2019-09-03 09:34:31'),
(175, 0, 'ar', 'floors', 'Floors', 'دور', '2019-09-02 08:19:41', '2019-09-03 09:42:28'),
(176, 0, 'ar', 'floors', 'Index', NULL, '2019-09-02 08:19:41', '2019-09-02 08:19:41'),
(177, 0, 'ar', 'floors', 'Search_filter', 'بحث', '2019-09-02 08:19:41', '2019-09-03 09:42:28'),
(178, 0, 'ar', 'floors', 'Create_new', 'اضافة جديد', '2019-09-02 08:19:41', '2019-09-03 09:42:28'),
(179, 0, 'ar', 'rooms', 'Skipped', 'التخطي', '2019-09-02 08:19:41', '2019-09-03 10:09:26'),
(180, 0, 'ar', 'rooms', 'Patient_Out', 'خروج المريض', '2019-09-02 08:19:41', '2019-09-03 10:09:26'),
(181, 0, 'ar', 'rooms', 'Waiting', 'انتظار', '2019-09-02 08:19:41', '2019-09-03 10:09:26'),
(182, 0, 'ar', 'rooms', 'Call_Next', 'التالي', '2019-09-02 08:19:41', '2019-09-03 10:09:26'),
(183, 0, 'ar', 'rooms', 'Call_Next_Again', 'التالي مرة اخري', '2019-09-02 08:19:41', '2019-09-03 10:09:26'),
(184, 0, 'ar', 'rooms', 'Patient_in', 'دخول المريض', '2019-09-02 08:19:41', '2019-09-03 10:09:26'),
(185, 0, 'ar', 'rooms', 'Patient_out', 'خروج المريض', '2019-09-02 08:19:41', '2019-09-03 10:09:26'),
(186, 0, 'ar', 'rooms', 'Today_Queue', 'قائمة انتظار اليوم', '2019-09-02 08:19:41', '2019-09-03 10:09:26'),
(187, 0, 'ar', 'rooms', 'Search', 'البحث', '2019-09-02 08:19:42', '2019-09-03 10:09:26'),
(188, 0, 'ar', 'rooms', 'All', 'الكل', '2019-09-02 08:19:42', '2019-09-03 10:09:26'),
(189, 0, 'ar', 'rooms', 'Queue', 'قائمية الانتظار', '2019-09-02 08:19:42', '2019-09-03 10:09:26'),
(190, 0, 'ar', 'rooms', 'Status', 'الحالة', '2019-09-02 08:19:42', '2019-09-03 10:09:26'),
(191, 0, 'ar', 'rooms', 'Action', 'تفعيل', '2019-09-02 08:19:42', '2019-09-03 10:09:26'),
(192, 0, 'ar', 'rooms', 'Call_again', 'النداء مرة اخري', '2019-09-02 08:19:42', '2019-09-03 10:09:26'),
(193, 0, 'ar', 'rooms', 'From', 'من', '2019-09-02 08:19:42', '2019-09-03 10:09:26'),
(194, 0, 'ar', '_json', 'Reset Password', NULL, '2019-09-02 08:19:42', '2019-09-02 08:19:42'),
(195, 0, 'ar', '_json', 'E-Mail Address', NULL, '2019-09-02 08:19:42', '2019-09-02 08:19:42'),
(196, 0, 'ar', '_json', 'Send Password Reset Link', NULL, '2019-09-02 08:19:42', '2019-09-02 08:19:42'),
(197, 0, 'ar', '_json', 'Password', NULL, '2019-09-02 08:19:42', '2019-09-02 08:19:42'),
(198, 0, 'ar', '_json', 'Confirm Password', NULL, '2019-09-02 08:19:42', '2019-09-02 08:19:42'),
(199, 0, 'ar', '_json', 'Verify Your Email Address', NULL, '2019-09-02 08:19:42', '2019-09-02 08:19:42'),
(200, 0, 'ar', '_json', 'A fresh verification link has been sent to your email address.', 'تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني', '2019-09-02 08:19:42', '2019-09-03 08:20:55'),
(201, 0, 'ar', '_json', 'Before proceeding, please check your email for a verification link.', NULL, '2019-09-02 08:19:43', '2019-09-02 08:19:43'),
(202, 0, 'ar', '_json', 'If you did not receive the email', NULL, '2019-09-02 08:19:43', '2019-09-02 08:19:43'),
(203, 0, 'ar', '_json', 'click here to request another', NULL, '2019-09-02 08:19:43', '2019-09-02 08:19:43'),
(204, 0, 'ar', '_json', 'Toggle navigation', NULL, '2019-09-02 08:19:43', '2019-09-02 08:19:43'),
(205, 0, 'ar', '_json', 'Login', NULL, '2019-09-02 08:19:43', '2019-09-02 08:19:43'),
(206, 0, 'ar', '_json', 'Register', NULL, '2019-09-02 08:19:43', '2019-09-02 08:19:43'),
(207, 0, 'ar', '_json', 'Logout', NULL, '2019-09-02 08:19:43', '2019-09-02 08:19:43'),
(208, 0, 'en', 'floors', 'Show_All', 'show all', '2019-09-03 06:35:41', '2019-09-03 09:42:28'),
(209, 0, 'en', 'floors', 'Search', 'search', '2019-09-03 06:35:41', '2019-09-03 09:42:28'),
(210, 0, 'en', 'floors', 'Create_new_Floor', 'Create new Floor', '2019-09-03 06:35:41', '2019-09-03 09:42:28'),
(211, 0, 'en', 'floors', 'All_Floors', 'All Floors', '2019-09-03 06:35:41', '2019-09-03 09:42:28'),
(212, 0, 'en', 'dashboard', 'Profile', 'Profile', '2019-09-03 06:35:41', '2019-09-03 09:34:40'),
(213, 0, 'en', 'dashboard', 'Logout', 'Logout', '2019-09-03 06:35:41', '2019-09-03 09:34:40'),
(214, 0, 'en', 'dashboard', 'Go_not_available', 'Go not available', '2019-09-03 06:35:41', '2019-09-03 09:34:40'),
(215, 0, 'en', 'dashboard', 'Go_available', 'Go available', '2019-09-03 06:35:41', '2019-09-03 09:34:40'),
(216, 0, 'en', 'dashboard', 'All_rights_reserved', 'All rights reserved', '2019-09-03 06:35:41', '2019-09-03 09:34:40'),
(217, 0, 'en', 'sidebar', 'Security', 'Security', '2019-09-03 06:35:41', '2019-09-03 10:07:48'),
(218, 0, 'en', 'sidebar', 'Authorization', 'Authorization', '2019-09-03 06:35:41', '2019-09-03 10:07:48'),
(219, 0, 'en', 'sidebar', 'Permission_Groups', 'Permission Groups', '2019-09-03 06:35:41', '2019-09-03 10:07:48'),
(220, 0, 'en', 'sidebar', 'Permissions', 'Permissions', '2019-09-03 06:35:41', '2019-09-03 10:07:48'),
(221, 0, 'en', 'sidebar', 'Roles', 'Roles', '2019-09-03 06:35:41', '2019-09-03 10:07:48'),
(222, 0, 'en', 'sidebar', 'Resources', 'Resources', '2019-09-03 06:35:41', '2019-09-03 10:07:48'),
(223, 0, 'en', 'sidebar', 'Users', 'Users', '2019-09-03 06:35:41', '2019-09-03 10:07:48'),
(224, 0, 'en', 'sidebar', 'Floors', 'Floors', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(225, 0, 'en', 'sidebar', 'Reception_Areas', 'Reception Areas', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(226, 0, 'en', 'sidebar', 'Desks', 'Desks', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(227, 0, 'en', 'sidebar', 'Rooms', 'Rooms', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(228, 0, 'en', 'sidebar', 'Screens', 'Screens', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(229, 0, 'en', 'sidebar', 'Printers', 'Printers', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(230, 0, 'en', 'sidebar', 'Ganzory_Resources', 'Ganzory Resources', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(231, 0, 'en', 'sidebar', 'Clinics', 'Clinics', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(232, 0, 'en', 'sidebar', 'Specialities', 'Specialities', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(233, 0, 'en', 'sidebar', 'Doctors', 'Doctors', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(234, 0, 'en', 'sidebar', 'Patients', 'Patients', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(235, 0, 'en', 'sidebar', 'Reservations', 'Reservations', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(236, 0, 'en', 'sidebar', 'Schedules', 'Schedules', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(237, 0, 'en', 'sidebar', 'Queues', 'Queues', '2019-09-03 06:35:42', '2019-09-03 10:07:48'),
(238, 0, 'en', 'sidebar', 'Queues_History', 'Queues History', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(239, 0, 'en', 'sidebar', 'Desk_queue_History', 'Desk queue History', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(240, 0, 'en', 'sidebar', 'Doctors_queue_History', 'Doctors queue History', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(241, 0, 'en', 'sidebar', 'Settings', 'Settings', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(242, 0, 'en', 'sidebar', 'Speciality_to_area', 'Specialty to area', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(243, 0, 'en', 'sidebar', 'Translations', 'Translations', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(244, 0, 'en', 'sidebar', 'Logs', 'Logs', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(245, 0, 'en', 'sidebar', 'User_logins', 'User logins', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(246, 0, 'en', 'sidebar', 'User_actions', 'User actions', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(247, 0, 'en', 'sidebar', 'Reports', 'Reports', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(248, 0, 'en', 'sidebar', 'Desks_Reports', 'Desks Reports', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(249, 0, 'en', 'sidebar', 'Doctors_Reports', 'Doctors Reports', '2019-09-03 06:35:43', '2019-09-03 10:07:48'),
(250, 0, 'ar', 'dashboard', 'Profile', 'الملف الشخصى', '2019-09-03 08:26:05', '2019-09-03 09:34:40'),
(251, 0, 'ar', 'dashboard', 'All_rights_reserved', 'جميع الحقوق محفوظة', '2019-09-03 08:53:41', '2019-09-03 09:34:40'),
(252, 0, 'ar', 'dashboard', 'Go_available', 'متاح', '2019-09-03 08:54:16', '2019-09-03 09:34:40'),
(253, 0, 'ar', 'dashboard', 'Go_not_available', 'غير متاح', '2019-09-03 08:54:26', '2019-09-03 09:34:40'),
(254, 0, 'ar', 'dashboard', 'Logout', 'تسجيل الخروج', '2019-09-03 08:54:54', '2019-09-03 09:34:40'),
(255, 0, 'ar', 'auth', 'failed', 'هذه البيانات لا تتطابق مع سجلاتنا', '2019-09-03 08:57:33', '2019-09-03 09:05:52'),
(256, 0, 'ar', 'auth', 'throttle', 'عدد كبير جداً من محاولات تسجيل الدخول. الرجاء المحاولة مرة أخرى', '2019-09-03 09:04:15', '2019-09-03 09:05:52'),
(257, 0, 'ar', 'sidebar', 'Authorization', 'تفويض', '2019-09-03 09:16:07', '2019-09-03 10:07:48'),
(258, 0, 'ar', 'sidebar', 'Clinics', 'العيادات', '2019-09-03 09:16:26', '2019-09-03 10:07:48'),
(259, 0, 'ar', 'sidebar', 'Desk_queue_History', 'سجل قائمة انتظار المكتب', '2019-09-03 09:20:59', '2019-09-03 10:07:48'),
(260, 0, 'ar', 'sidebar', 'Desks', 'الاستقبال', '2019-09-03 09:21:11', '2019-09-03 10:07:48'),
(261, 0, 'ar', 'sidebar', 'Desks_Reports', 'تقارير الاستقبال', '2019-09-03 09:21:47', '2019-09-03 10:07:48'),
(262, 0, 'ar', 'sidebar', 'Doctors', 'الاطباء', '2019-09-03 09:22:23', '2019-09-03 10:07:48'),
(263, 0, 'ar', 'sidebar', 'Doctors_Reports', 'تقارير الاطباء', '2019-09-03 09:22:35', '2019-09-03 10:07:48'),
(264, 0, 'ar', 'sidebar', 'Doctors_queue_History', 'سجل قائمة انتظار الأطباء', '2019-09-03 09:26:28', '2019-09-03 10:07:48'),
(265, 0, 'ar', 'sidebar', 'Floors', 'الادوار', '2019-09-03 09:28:02', '2019-09-03 10:07:48'),
(266, 0, 'ar', 'sidebar', 'Ganzory_Resources', 'موارد الجنزورى', '2019-09-03 09:34:45', '2019-09-03 10:07:48'),
(267, 0, 'ar', 'sidebar', 'Patients', 'المرضى', '2019-09-03 09:35:34', '2019-09-03 10:07:48'),
(268, 0, 'ar', 'floors', 'All_Floors', 'الادوار', '2019-09-03 09:36:25', '2019-09-03 09:42:28'),
(269, 0, 'ar', 'sidebar', 'Permission_Groups', 'مجموعات الصلاحيات', '2019-09-03 09:36:39', '2019-09-03 10:07:48'),
(270, 0, 'ar', 'floors', 'Create_new_Floor', 'اضافة دور جديد', '2019-09-03 09:36:46', '2019-09-03 09:42:28'),
(271, 0, 'ar', 'sidebar', 'Permissions', 'الصلاحيات', '2019-09-03 09:36:53', '2019-09-03 10:07:48'),
(272, 0, 'ar', 'sidebar', 'Printers', 'الطابعات', '2019-09-03 09:37:10', '2019-09-03 10:07:48'),
(273, 0, 'ar', 'sidebar', 'Queues', 'قائمة انتظار', '2019-09-03 09:37:25', '2019-09-03 10:07:48'),
(274, 0, 'ar', 'sidebar', 'Queues_History', 'سجل قائمة الانتظار', '2019-09-03 09:37:38', '2019-09-03 10:07:48'),
(275, 0, 'ar', 'sidebar', 'Reception_Areas', 'منطقة الاستقبال', '2019-09-03 09:37:55', '2019-09-03 10:07:48'),
(276, 0, 'ar', 'sidebar', 'Reports', 'التقارير', '2019-09-03 09:38:06', '2019-09-03 10:07:48'),
(277, 0, 'ar', 'sidebar', 'Reservations', 'الحجوزات', '2019-09-03 09:38:17', '2019-09-03 10:07:48'),
(278, 0, 'ar', 'sidebar', 'Resources', 'الموارد', '2019-09-03 09:38:30', '2019-09-03 10:07:48'),
(279, 0, 'ar', 'sidebar', 'Rooms', 'الغرف', '2019-09-03 09:38:55', '2019-09-03 10:07:48'),
(280, 0, 'ar', 'sidebar', 'Roles', 'الأدوار', '2019-09-03 09:39:25', '2019-09-03 10:07:48'),
(281, 0, 'ar', 'floors', 'Search', 'بحث', '2019-09-03 09:39:30', '2019-09-03 09:42:28'),
(282, 0, 'ar', 'floors', 'Show_All', 'عرض', '2019-09-03 09:40:41', '2019-09-03 09:42:28'),
(283, 0, 'ar', 'sidebar', 'Schedules', 'الجداول', '2019-09-03 09:41:24', '2019-09-03 10:07:48'),
(284, 0, 'ar', 'sidebar', 'Screens', 'الشاشات', '2019-09-03 09:41:32', '2019-09-03 10:07:48'),
(285, 0, 'ar', 'sidebar', 'Security', 'الامن', '2019-09-03 09:41:40', '2019-09-03 10:07:48'),
(286, 0, 'ar', 'sidebar', 'Settings', 'الاعدادات', '2019-09-03 09:41:51', '2019-09-03 10:07:48'),
(287, 0, 'ar', 'sidebar', 'Specialities', 'التخصصات', '2019-09-03 09:41:58', '2019-09-03 10:07:48'),
(288, 0, 'ar', 'pagination', 'next', 'القادم', '2019-09-03 09:42:52', '2019-09-03 09:43:16'),
(289, 0, 'ar', 'pagination', 'previous', 'السابق', '2019-09-03 09:43:10', '2019-09-03 09:43:16'),
(290, 0, 'ar', 'passwords', 'password', 'يجب أن تكون كلمات المرور ستة أحرف على الأقل', '2019-09-03 09:43:34', '2019-09-03 09:50:26'),
(291, 0, 'ar', 'sidebar', 'Speciality_to_area', 'التخصص بالنسبة للمنطقة', '2019-09-03 09:43:36', '2019-09-03 10:07:48'),
(292, 0, 'ar', 'sidebar', 'Translations', 'الترجمة', '2019-09-03 09:43:47', '2019-09-03 10:07:48'),
(293, 0, 'ar', 'passwords', 'sent', 'ارسالنا بريد  الكترونى لتغير كلمة المرور', '2019-09-03 09:43:52', '2019-09-03 09:50:26'),
(294, 0, 'ar', 'passwords', 'user', 'مستخدم', '2019-09-03 09:44:04', '2019-09-03 09:50:26'),
(295, 0, 'ar', 'passwords', 'reset', 'تمت إعادة تعيين كلمة المرور', '2019-09-03 09:45:55', '2019-09-03 09:50:26'),
(296, 0, 'ar', 'sidebar', 'User_actions', 'إجراءات المستخدم', '2019-09-03 09:46:41', '2019-09-03 10:07:48'),
(297, 0, 'ar', 'sidebar', 'User_logins', 'تسجيلات دخول المستخدم', '2019-09-03 09:47:18', '2019-09-03 10:07:48'),
(298, 0, 'ar', 'sidebar', 'Users', 'المستخدمين', '2019-09-03 09:47:35', '2019-09-03 10:07:48'),
(299, 0, 'ar', 'sidebar', 'Logs', 'السجلات', '2019-09-03 09:48:41', '2019-09-03 10:07:48'),
(300, 0, 'ar', 'passwords', 'token', 'كلمة المرور غيرمستخدمة', '2019-09-03 09:50:22', '2019-09-03 09:50:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
