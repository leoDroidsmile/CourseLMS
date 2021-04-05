-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 11:16 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codecanyon_courselms_bundle`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_identifier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 1,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`id`, `name`, `unique_identifier`, `version`, `activated`, `image`, `created_at`, `updated_at`) VALUES
(9, 'coupon', NULL, '1', 1, 'coupon-preview.jpg', '2021-02-25 10:01:29', '2021-02-25 10:01:29'),
(10, 'certificate', NULL, '1', 1, 'certificate-banner.jpg', '2021-02-25 10:02:31', '2021-02-25 10:02:31'),
(11, 'quiz', NULL, '1', 1, 'quiz-banner.jpg', '2021-02-25 10:03:18', '2021-02-25 10:03:18'),
(12, 'zoom', NULL, '1', 1, 'zoom-banner.jpg', '2021-02-25 10:14:30', '2021-02-25 10:14:30'),
(13, 'forum', NULL, '1', 1, 'forum-banner.jpg', '2021-02-25 10:15:32', '2021-02-25 10:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `admin_earnings`
--

CREATE TABLE `admin_earnings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `purposes` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_account_id` bigint(20) UNSIGNED NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_confirm` tinyint(1) NOT NULL DEFAULT 0,
  `is_cancel` tinyint(1) NOT NULL DEFAULT 0,
  `balance` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_histories`
--

CREATE TABLE `affiliate_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `affiliate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `refer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_payments`
--

CREATE TABLE `affiliate_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `current_balance` double DEFAULT NULL,
  `process` enum('Bank','Paypal','Stripe') COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_account_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Request','Confirm') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_change_date` datetime DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `confirm_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_password_resets`
--

CREATE TABLE `api_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_price` double DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `parent_category_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_item` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `is_popular`, `top`, `icon`, `is_published`, `parent_category_id`, `created_at`, `updated_at`, `is_item`) VALUES
(1, 'Web Development', 'web-development1', 1, 1, '/uploads/media_manager/10.png', 1, 0, '2020-06-09 09:48:52', '2020-12-21 06:31:28', 0),
(2, 'Education', 'education2', 1, 0, '/uploads/media_manager/14.png', 1, 0, '2020-06-09 10:35:08', '2020-12-21 06:31:41', 0),
(3, 'Business', 'business3', 1, 0, '/uploads/media_manager/13.png', 1, 0, '2020-06-10 02:01:03', '2020-12-21 06:31:57', 0),
(4, 'Finance and Banking', 'finance-and-banking4', 1, 0, '/uploads/media_manager/15.png', 1, 3, '2020-06-10 02:01:48', '2020-12-21 07:03:47', 0),
(5, 'Marketing', 'marketing5', 1, 0, '/uploads/media_manager/12.png', 1, 0, '2020-06-10 02:02:49', '2020-12-21 06:32:26', 0),
(6, 'Photography', 'photography6', 1, 0, '/uploads/media_manager/17.png', 1, 0, '2020-06-10 02:19:05', '2020-12-21 06:32:39', 0),
(7, 'Music', 'music7', 1, 0, '/uploads/media_manager/11.png', 1, 0, '2020-06-10 02:19:58', '2020-12-21 06:33:00', 0),
(8, 'Mobile Apps Development', 'mobile-apps-development', 1, 1, '/uploads/media_manager/16.png', 1, 0, '2020-12-21 06:30:09', '2020-12-21 06:59:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `template_text`, `top_text`, `header_text`, `footer_text`, `permissions`, `image`, `badge`, `logo`, `created_at`, `updated_at`) VALUES
(1, NULL, 'CERTIFICATE OR ACHIEVEMENT', 'THIS CERTIFICATE IS PROUDLY PRESENTED TO', 'FOR THE SUCCESSFUL COMPLETION OF', 'NO', 'uploads/certificate/c-1.jpg', 'uploads/certificate/aio5kW0XqrpgDftg4w08m0ZDsONI7G5cmkbmskBv.png', 'uploads/certificate/eeozYqUveBgouCmTFoPsSCAyfCK1cJXxA2p60OhX.png', '2020-12-20 11:11:46', '2020-12-21 07:05:51'),
(2, NULL, 'CERTIFICATE OR ACHIEVEMENT', 'THIS CERTIFICATE IS PROUDLY PRESENTED TO', 'FOR THE SUCCESSFUL COMPLETION OF', 'NO', 'uploads/certificate/c-1.jpg', NULL, NULL, '2021-02-25 10:02:31', '2021-02-25 10:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_stores`
--

CREATE TABLE `certificate_stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificate_stores`
--

INSERT INTO `certificate_stores` (`id`, `uid`, `user_id`, `image`, `created_at`, `updated_at`) VALUES
(1, '2119', 19, 'uploads/certificate/2119.jpg', '2020-12-20 11:15:13', '2020-12-20 11:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `title`, `course_id`, `priority`, `is_published`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 'Introduction', 11, 0, 1, NULL, '2020-06-10 07:33:45', '2020-06-10 07:33:45'),
(6, 'Basic knowledge', 11, 0, 1, NULL, '2020-06-10 07:34:53', '2020-06-10 07:34:53'),
(7, 'Diving into deep', 11, 0, 1, '2020-06-11 00:13:13', '2020-06-10 07:35:25', '2020-06-11 00:13:13'),
(8, 'Introduction', 1, 0, 1, NULL, '2020-06-10 07:33:45', '2020-06-10 07:33:45'),
(9, 'Basic knowledge', 1, 0, 1, NULL, '2020-06-10 07:34:53', '2020-06-10 07:34:53'),
(10, 'Diving into deep', 1, 0, 1, '2020-06-11 00:13:34', '2020-06-10 07:35:25', '2020-06-11 00:13:34'),
(11, 'Introduction', 2, 0, 1, NULL, '2020-06-10 07:33:45', '2020-06-10 07:33:45'),
(12, 'Basic knowledge', 2, 0, 1, NULL, '2020-06-10 07:34:53', '2020-06-10 07:34:53'),
(13, 'Diving into deep', 2, 0, 1, '2020-06-11 00:14:34', '2020-06-10 07:35:25', '2020-06-11 00:14:34'),
(14, 'Introduction', 5, 0, 1, NULL, '2020-06-10 07:33:45', '2020-06-10 07:33:45'),
(15, 'Basic knowledge', 5, 0, 1, NULL, '2020-06-10 07:34:53', '2020-06-10 07:34:53'),
(16, 'Diving into deep', 5, 0, 1, '2020-06-11 00:15:22', '2020-06-10 07:35:25', '2020-06-11 00:15:22'),
(17, 'Introduction', 6, 0, 1, NULL, '2020-06-10 07:33:45', '2020-06-10 07:33:45'),
(18, 'Basic knowledge', 6, 0, 1, NULL, '2020-06-10 07:34:53', '2020-06-10 07:34:53'),
(19, 'Diving into deep', 6, 0, 1, '2020-06-11 00:15:40', '2020-06-10 07:35:25', '2020-06-11 00:15:40'),
(20, 'Introduction', 9, 0, 1, NULL, '2020-06-10 07:33:45', '2020-06-10 07:33:45'),
(21, 'Basic knowledge', 9, 0, 1, NULL, '2020-06-10 07:34:53', '2020-06-10 07:34:53'),
(22, 'Diving into deep', 9, 0, 1, NULL, '2020-06-10 07:35:25', '2020-06-10 07:35:25'),
(23, 'Introduction', 19, 0, 1, NULL, '2020-06-11 00:30:52', '2020-06-11 00:30:52'),
(24, 'Basic knowledge', 19, 0, 1, NULL, '2020-06-11 00:31:04', '2020-06-11 00:31:04'),
(25, 'Introduction', 20, 0, 1, NULL, '2020-06-11 00:40:48', '2020-06-11 00:40:48'),
(26, 'Diving into deep', 20, 0, 1, NULL, '2020-06-11 00:40:59', '2020-06-11 00:40:59'),
(27, 'Introduction', 21, 0, 1, NULL, '2020-06-11 00:52:06', '2020-06-11 00:52:06'),
(28, 'Diving into deep', 21, 0, 1, NULL, '2020-06-11 00:52:13', '2020-06-11 00:52:13'),
(29, 'Introduction', 22, 0, 1, NULL, '2020-06-11 00:59:40', '2020-06-11 00:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `class_contents`
--

CREATE TABLE `class_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_type` enum('Video','Document','Quiz') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` enum('Youtube','HTML5','Vimeo','File','Live','Quiz') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `is_preview` tinyint(1) NOT NULL DEFAULT 0,
  `source_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meeting_id` bigint(20) DEFAULT NULL,
  `quiz_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_contents`
--

INSERT INTO `class_contents` (`id`, `title`, `content_type`, `provider`, `video_url`, `duration`, `file`, `description`, `class_id`, `priority`, `is_published`, `is_preview`, `source_code`, `deleted_at`, `created_at`, `updated_at`, `meeting_id`, `quiz_id`) VALUES
(5, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 5, 1, 1, 0, NULL, NULL, '2020-06-10 07:35:47', '2020-06-11 15:48:15', NULL, NULL),
(6, 'Starting from scratch', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 5, 2, 1, 0, NULL, NULL, '2020-06-10 07:36:20', '2020-06-11 15:48:15', NULL, NULL),
(7, 'Important Announcement', 'Document', NULL, NULL, NULL, 'uploads/class_contents/KBpAR5ae5YF9eisRvoxHOjfHIMO0IxFK0trBdH5F.jpeg', NULL, 5, 0, 1, 0, 'uploads/class_source_codes/DhPorF4ppJKg0fudLzFIxByrGvUWbGCIaKeae5fd.zip', '2020-06-11 00:12:45', '2020-06-10 07:37:26', '2020-06-11 00:12:45', NULL, NULL),
(8, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 6, 3, 1, 0, NULL, NULL, '2020-06-10 07:38:56', '2020-06-11 15:48:07', NULL, NULL),
(9, 'Diving into deep', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 6, 4, 1, 0, NULL, NULL, '2020-06-10 07:39:18', '2020-06-11 15:48:07', NULL, NULL),
(10, 'Important Announcement', 'Video', NULL, NULL, NULL, NULL, NULL, 7, 0, 1, 0, NULL, NULL, '2020-06-10 07:39:33', '2020-06-10 07:39:33', NULL, NULL),
(11, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 8, 0, 1, 0, NULL, NULL, '2020-06-10 07:35:47', '2020-06-10 07:35:47', NULL, NULL),
(12, 'Starting from scratch', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 8, 0, 1, 0, NULL, NULL, '2020-06-10 07:36:20', '2020-06-10 07:36:20', NULL, NULL),
(13, 'Important Announcement', 'Document', NULL, NULL, NULL, 'uploads/class_contents/KBpAR5ae5YF9eisRvoxHOjfHIMO0IxFK0trBdH5F.jpeg', NULL, 8, 0, 1, 0, 'uploads/class_source_codes/DhPorF4ppJKg0fudLzFIxByrGvUWbGCIaKeae5fd.zip', '2020-06-11 00:13:26', '2020-06-10 07:37:26', '2020-06-11 00:13:26', NULL, NULL),
(14, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 9, 0, 1, 0, NULL, NULL, '2020-06-10 07:38:56', '2020-06-10 07:38:56', NULL, NULL),
(15, 'Diving into deep', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 9, 0, 1, 0, NULL, NULL, '2020-06-10 07:39:18', '2020-06-10 07:39:18', NULL, NULL),
(16, 'Important Announcement', 'Video', NULL, NULL, NULL, NULL, NULL, 10, 0, 1, 0, NULL, NULL, '2020-06-10 07:39:33', '2020-06-10 07:39:33', NULL, NULL),
(17, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 11, 0, 1, 0, NULL, NULL, '2020-06-10 07:35:47', '2020-06-10 07:35:47', NULL, NULL),
(18, 'Starting from scratch', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 11, 0, 1, 0, NULL, NULL, '2020-06-10 07:36:20', '2020-06-10 07:36:20', NULL, NULL),
(19, 'Important Announcement', 'Document', NULL, NULL, NULL, 'uploads/class_contents/KBpAR5ae5YF9eisRvoxHOjfHIMO0IxFK0trBdH5F.jpeg', NULL, 11, 0, 1, 0, 'uploads/class_source_codes/DhPorF4ppJKg0fudLzFIxByrGvUWbGCIaKeae5fd.zip', '2020-06-11 00:13:46', '2020-06-10 07:37:26', '2020-06-11 00:13:46', NULL, NULL),
(20, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 12, 0, 1, 0, NULL, NULL, '2020-06-10 07:38:56', '2020-06-10 07:38:56', NULL, NULL),
(21, 'Diving into deep', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 12, 0, 1, 0, NULL, NULL, '2020-06-10 07:39:18', '2020-06-10 07:39:18', NULL, NULL),
(22, 'Important Announcement', 'Video', NULL, NULL, NULL, NULL, NULL, 13, 0, 1, 0, NULL, NULL, '2020-06-10 07:39:33', '2020-06-10 07:39:33', NULL, NULL),
(23, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 14, 0, 1, 0, NULL, NULL, '2020-06-10 07:35:47', '2020-06-10 07:35:47', NULL, NULL),
(24, 'Starting from scratch', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 14, 0, 1, 0, NULL, NULL, '2020-06-10 07:36:20', '2020-06-10 07:36:20', NULL, NULL),
(25, 'Important Announcement', 'Document', NULL, NULL, NULL, 'uploads/class_contents/KBpAR5ae5YF9eisRvoxHOjfHIMO0IxFK0trBdH5F.jpeg', NULL, 14, 0, 1, 0, 'uploads/class_source_codes/DhPorF4ppJKg0fudLzFIxByrGvUWbGCIaKeae5fd.zip', '2020-06-11 00:15:18', '2020-06-10 07:37:26', '2020-06-11 00:15:18', NULL, NULL),
(26, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 15, 0, 1, 0, NULL, NULL, '2020-06-10 07:38:56', '2020-06-10 07:38:56', NULL, NULL),
(27, 'Diving into deep', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 15, 0, 1, 0, NULL, NULL, '2020-06-10 07:39:18', '2020-06-10 07:39:18', NULL, NULL),
(28, 'Important Announcement', 'Video', NULL, NULL, NULL, NULL, NULL, 16, 0, 1, 0, NULL, NULL, '2020-06-10 07:39:33', '2020-06-10 07:39:33', NULL, NULL),
(29, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 17, 0, 1, 0, NULL, NULL, '2020-06-10 07:35:47', '2020-06-10 07:35:47', NULL, NULL),
(30, 'Starting from scratch', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 17, 0, 1, 0, NULL, NULL, '2020-06-10 07:36:20', '2020-06-10 07:36:20', NULL, NULL),
(31, 'Important Announcement', 'Document', NULL, NULL, NULL, 'uploads/class_contents/KBpAR5ae5YF9eisRvoxHOjfHIMO0IxFK0trBdH5F.jpeg', NULL, 17, 0, 1, 0, 'uploads/class_source_codes/DhPorF4ppJKg0fudLzFIxByrGvUWbGCIaKeae5fd.zip', '2020-06-11 00:15:35', '2020-06-10 07:37:26', '2020-06-11 00:15:35', NULL, NULL),
(32, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 18, 0, 1, 0, NULL, NULL, '2020-06-10 07:38:56', '2020-06-10 07:38:56', NULL, NULL),
(33, 'Diving into deep', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 18, 0, 1, 0, NULL, NULL, '2020-06-10 07:39:18', '2020-06-10 07:39:18', NULL, NULL),
(34, 'Important Announcement', 'Video', NULL, NULL, NULL, NULL, NULL, 19, 0, 1, 0, NULL, NULL, '2020-06-10 07:39:33', '2020-06-10 07:39:33', NULL, NULL),
(35, 'Starting from scratch', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 20, 0, 1, 0, NULL, NULL, '2020-06-10 07:36:20', '2020-06-10 07:36:20', NULL, NULL),
(36, 'Important Announcement', 'Document', NULL, NULL, NULL, 'uploads/class_contents/KBpAR5ae5YF9eisRvoxHOjfHIMO0IxFK0trBdH5F.jpeg', NULL, 20, 0, 1, 0, 'uploads/class_source_codes/DhPorF4ppJKg0fudLzFIxByrGvUWbGCIaKeae5fd.zip', '2020-06-11 00:16:09', '2020-06-10 07:37:26', '2020-06-11 00:16:09', NULL, NULL),
(37, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 20, 0, 1, 0, NULL, '2020-06-11 00:15:57', '2020-06-10 07:38:56', '2020-06-11 00:15:57', NULL, NULL),
(38, 'Diving into deep', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 21, 0, 1, 0, NULL, NULL, '2020-06-10 07:39:18', '2020-06-10 07:39:18', NULL, NULL),
(39, 'Important Announcement', 'Video', NULL, NULL, NULL, NULL, NULL, 21, 0, 1, 0, NULL, '2020-06-11 00:16:15', '2020-06-10 07:39:33', '2020-06-11 00:16:15', NULL, NULL),
(40, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 22, 0, 1, 0, NULL, NULL, '2020-06-10 07:35:47', '2020-06-10 07:35:47', NULL, NULL),
(41, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 23, 0, 1, 1, 'uploads/class_source_codes/Gda9sKA4sMA67soA3Mt4dSUL6nkl3buP8s8v6zZC.zip', NULL, '2020-06-11 00:31:28', '2020-06-11 00:34:40', NULL, NULL),
(42, 'Diving into deep', 'Document', NULL, NULL, NULL, 'uploads/class_contents/1l0Rgmmik4lXyi7qcPqBXyoR6iPxMqJtvWCihJ8B.zip', '<p>This is the document details</p>', 23, 0, 1, 0, NULL, NULL, '2020-06-11 00:32:01', '2020-06-11 00:34:39', NULL, NULL),
(43, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 24, 0, 1, 0, 'uploads/class_source_codes/WEWZmc9x803yfvW5NKseDULQcSTZrjWZ5q9rhU0U.zip', NULL, '2020-06-11 00:32:19', '2020-06-11 00:32:19', NULL, NULL),
(44, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 25, 0, 1, 1, NULL, NULL, '2020-06-11 00:41:12', '2020-06-11 00:56:00', NULL, NULL),
(45, 'Important Announcement', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 25, 0, 1, 1, 'uploads/class_source_codes/JYcW06ECKIkUW8YQKjKJX7GooG3RkhRCl9S8TJTo.zip', NULL, '2020-06-11 00:41:35', '2020-06-11 00:56:04', NULL, NULL),
(46, 'Diving into deep', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 26, 0, 1, 0, NULL, NULL, '2020-06-11 00:41:49', '2020-06-11 00:41:49', NULL, NULL),
(47, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 27, 0, 1, 1, NULL, NULL, '2020-06-11 00:55:14', '2020-06-11 00:55:18', NULL, NULL),
(48, 'Basic knowledge', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 27, 0, 1, 1, NULL, NULL, '2020-06-11 00:55:32', '2020-06-11 00:55:34', NULL, NULL),
(49, 'Diving into deep', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 28, 0, 1, 0, NULL, NULL, '2020-06-11 00:55:48', '2020-06-11 00:55:48', NULL, NULL),
(50, 'Introduction', 'Video', 'Youtube', 'https://youtu.be/_rKk-urv1Is', 2296, NULL, NULL, 29, 0, 1, 1, NULL, NULL, '2020-06-11 00:59:56', '2020-06-11 01:00:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `start_day` datetime NOT NULL,
  `end_day` datetime NOT NULL,
  `min_value` double DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('Beginner','Advanced','All Levels') COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `short_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overview_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` enum('Youtube','HTML5','Vimeo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirement` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `outcome` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tag` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT 0,
  `price` double DEFAULT NULL,
  `is_discount` tinyint(1) NOT NULL DEFAULT 0,
  `discount_price` double DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'english',
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `level`, `rating`, `short_description`, `big_description`, `image`, `overview_url`, `provider`, `requirement`, `outcome`, `tag`, `is_free`, `price`, `is_discount`, `discount_price`, `language`, `meta_title`, `meta_description`, `is_published`, `user_id`, `category_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Wordpress For Beginner', 'wordpress-for-beginner', 'Beginner', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/course/xdB5bQTHb3tXlrS58aoreimgMuTgE2lvrBkCCtMR.jpeg', 'https://youtu.be/QKnvPClWlLk', 'Youtube', '[\"Computer, Internet\"]', '[\"Web development\"]', '[\"Wordpres\"]', 1, NULL, 0, NULL, 'English', '[\"Meta\"]', 'Meta', 1, 5, 1, NULL, '2020-06-09 10:29:55', '2020-06-10 14:07:04'),
(2, 'Python for Beginners - Basics to Advanced Python', 'python-for-beginners-basics-to-advanced-python-development', 'Beginner', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/course/aB1WlGyFMa8LFRiBAZxtYcFwROmLe04mco9GSozl.jpeg', 'https://youtu.be/QKnvPClWlLk', 'Youtube', '[\"Basic of c,computer,internet\"]', '[\"learn new skill, skill development\"]', '[\"python, coding\"]', 0, 20, 1, 5, 'English', '[\"Meta\"]', 'Meta', 1, 5, 1, NULL, '2020-06-09 10:29:55', '2020-06-10 14:07:37'),
(5, 'Learn Photography', 'learn-photography', 'Beginner', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/course/hEiI5UjOI8DTYAgnBp3v0bkf7OhNwD9b2ySz4KnX.jpeg', 'https://youtu.be/QKnvPClWlLk', 'Youtube', '[\"Camera, Lens\"]', '[\"Photography, photographar\"]', '[\"dslr, camera, photography\"]', 1, NULL, 0, NULL, 'English', '[\"Photography\"]', 'Photography', 1, 5, 6, NULL, '2020-06-09 10:29:55', '2020-06-10 14:07:56'),
(6, 'Advance Wordpress', 'advance-wordpress', 'Advanced', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/course/dqsdqNqvQGmiPahTsQmAWWcy0IKs01YipDi2r463.jpeg', 'https://youtu.be/QKnvPClWlLk', 'Youtube', '[\"Basic wordpress knowledge,computer, internet\"]', '[\"Build website,learn coding\"]', '[\"wordpress\"]', 1, NULL, 0, NULL, 'English', '[\"Meta\"]', 'Meta', 1, 5, 1, NULL, '2020-06-09 10:29:55', '2020-06-11 00:17:31'),
(9, 'Learn how to play guitar', 'learn-how-to-play-guitar', 'Beginner', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/course/DBP1Nj0oBdMDEy4wnUpG1DVVpRTChH1jESjBNTqd.jpeg', 'https://youtu.be/QKnvPClWlLk', 'Youtube', '[\"guitar,time,Patience\"]', '[\"Guitarist\"]', '[\"Guitar, Music\"]', 0, 30, 1, 10, 'English', '[\"Guitar Learning\"]', 'Learn how to play guitar', 1, 5, 7, NULL, '2020-06-09 10:29:55', '2020-06-10 14:08:46'),
(11, 'The Complete Financial Analyst Course 2020', 'the-complete-financial-analyst-course-2020', 'Beginner', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/course/cJND1JsRLhOOEONLmLK3QTgAs53m23xZeOZsEPB3.jpeg', 'https://youtu.be/QKnvPClWlLk', 'Youtube', '[\"Computer, internet                                                            ,Eagerness\"]', '[\"Business statistic,Business policy\"]', '[\"business,policy\"]', 1, 20, 0, NULL, 'Bengali', '[\"business policy\"]', 'Business course', 1, 5, 4, NULL, '2020-06-10 04:06:23', '2020-06-10 23:53:58'),
(19, 'Outcome Based Education (OBE) & Academic Quality Assurance', 'outcome-based-education-obe-and-academic-quality-assurance', 'Beginner', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/course/EOcKJ945IWhaeDE2MJCrWgUkMaj1nWL4UwUlfxRz.jpeg', 'https://youtu.be/QKnvPClWlLk', 'Youtube', '[\"Basic knowledge of digital marketing terms,Basic understanding of business,Pen and paper for taking notes,Internet connection\"]', '[\"Outcome Text, Outcome\"]', '[\"Education\"]', 1, 50, 1, 20, 'Bengali', '[\"meta title\"]', 'Meta description', 1, 5, 2, NULL, '2020-06-11 00:30:46', '2020-06-11 00:32:52'),
(20, 'The Complete Digital finance Marketing Course', 'the-complete-digital-finance-marketing-course', 'Advanced', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/course/W3il4ig1WwQ8Cpn4QnVM0U8uHp9qVYLAJtjCu3GO.jpeg', 'https://youtu.be/QKnvPClWlLk', 'Youtube', '[\"Basic knowledge of digital marketing terms,Basic understanding of business\"]', '[\"Basic understanding of business\"]', '[\"Basic understanding of business\"]', 1, 20, 0, NULL, 'English', '[\"Meta title\"]', 'Meta Description', 1, 5, 5, NULL, '2020-06-11 00:40:42', '2020-06-11 06:26:52'),
(21, 'Microsoft SQL Server 2019 for Everyone', 'microsoft-sql-server-2019-for-everyone', 'All Levels', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/course/DlolL30aMOQmC81xNCDfmnjdSL4OuZqsIlS4Hm7s.jpeg', 'https://youtu.be/QKnvPClWlLk', 'Youtube', '[\"Basic knowledge of digital marketing terms,Pen and paper for taking notes\"]', '[\"Basic knowledge of digital marketing terms\"]', '[\"Basic knowledge of digital marketing terms,Digital Marketing\"]', 1, 20, 0, NULL, 'English', '[\"Meta Title\"]', 'Meta Description', 1, 5, 3, NULL, '2020-06-11 00:46:21', '2020-06-11 00:46:36'),
(22, 'Digital finance Marketing Course', 'digital-finance-marketing-course', 'Beginner', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/course/Kx9x37vpM42whMPQAUp61e21EWiJFCOWLknn3meo.jpeg', 'https://youtu.be/QKnvPClWlLk', 'Youtube', '[\"Basic knowledge of digital marketing terms\"]', '[\"Basic knowledge of digital marketing terms\"]', '[\"Basic knowledge of digital marketing terms\"]', 1, NULL, 0, NULL, 'English', '[\"Meta Title\"]', 'Meta Description', 1, 5, 4, NULL, '2020-06-11 00:59:33', '2020-06-11 00:59:33'),
(23, 'Flutter & Dart - The Complete Guide', 'flutter-and-dart-the-complete-guide', 'Beginner', '1', '<p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">The entire course <strong style=\"margin: 0px; padding: 0px;\">was completely re-recorded and updated </strong>- it\'s totally up-to-date with the latest version of Flutter!</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">With the latest update, I also added <strong style=\"margin: 0px; padding: 0px;\">Push Notifications</strong> and <strong style=\"margin: 0px; padding: 0px;\">Image Upload</strong>!</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">---</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">Join the most comprehensive & bestselling Flutter course and learn how to build amazing iOS and Android apps!</strong></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">You don\'t need to learn Android/ Java and iOS/ Swift to build real native mobile apps!</strong></p>', '<p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">Flutter - a framework developed by Google - allows you to learn one language (Dart) and build beautiful native mobile apps in no time. Flutter is a SDK providing the tooling to compile Dart code into native code and it also gives you a rich set of pre-built and pre-styled UI elements (so called widgets) which you can use to compose your user interfaces.</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">Flutter is extremely trending</strong> and gets used for major Google apps like their Adwords app - it\'s now marked as \"ready for production\", hence now is the time to jump in and learn it!</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">This course will teach Flutter & Dart from scratch, NO prior knowledge of either of the two is required! And you certainly don\'t need any Android or iOS development experience since the whole idea behind Flutter is to only learn one language.</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">You\'ll learn Flutter not only in theory but <strong style=\"margin: 0px; padding: 0px;\">we\'ll build a complete, realistic app</strong> throughout this course. This app will feature both all the core basics as well as advanced features like using Google Maps, the device camera, adding animations and more!</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">With Flutter, you\'ll be able to write code only once and ship your apps both to the Apple AppStore and Google Play.</strong></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">Use Google\'s Material Design to build beautiful, yet fully customizable, apps in no time with almost zero effort. You can use the rich widget suite Flutter provides to add common UI elements like buttons, switches, forms, toolbars, lists and more - or you simply build your own widgets - Flutter makes that a breeze, too.</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">Here\'s what\'s included in the course:</strong></p><ul style=\"margin: 0.8rem 0px 0px; padding: 0px 0px 0px 2.4rem; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><li style=\"margin: 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Detailed setup instructions for both macOS and Windows</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">A thorough introduction to Flutter, Dart and the concept behind widgets</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">An overview of the built-in widgets and how you may add your own ones</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Debugging tipps & tricks</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Page navigation with tabs, side drawers and stack-based navigation</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">State management solutions</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Handling and validating user input</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Connecting your Flutter app to backend servers by sending Http requests</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">User authentication</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Adding Google Maps</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Using native device features like the camera</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Adding beautiful animations & page transitions</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Image Upload</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Push Notifications - manual approach and automated</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">How to publish your app to the app stores</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">And more!</p></li></ul><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">This course is for you if ...</strong></p><ul style=\"margin: 0.8rem 0px 0px; padding: 0px 0px 0px 2.4rem; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><li style=\"margin: 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">You\'re interested in building real native mobile apps for the two most popular mobile platforms - iOS and Android</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">You want to explore the full set of features Flutter offers</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Don\'t want to spend hours learning two completely different languages</p></li></ul><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">Course prerequisites:</strong></p><ul style=\"margin: 0.8rem 0px 0px; padding: 0px 0px 0px 2.4rem; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><li style=\"margin: 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">Basic programming language knowledge will help a lot but is not a hard requirement</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">You DON\'T need to know Flutter or Dart</p></li><li style=\"margin: 0.4rem 0px 0px; padding: 0px 0px 0px 0.8rem;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: inherit; max-width: 118.4rem;\">You DON\'T need to know iOS (Swift/ObjectiveC) or Android (Java)</p></li></ul>', '/uploads/media_manager/19.jpg', 'https://youtu.be/I9ceqw5Ny-4', 'Youtube', '[\"Basic programming language will help but is not a must-have\",\"                                                        You can use either Windows\",\"                                                        NO prior iOS or Android development experience is required\"]', '[\"NO prior Flutter or Dart experience is required - this course starts at zero!\",\"                                                                      Learn Flutter and Dart from the ground up\",\"                                                                       step-by-step\"]', '[\"Flutter \",\"apk\",\"android\",\"ios\"]', 1, NULL, 0, NULL, 'English', '[\"\"]', NULL, 1, 21, 8, NULL, '2020-12-21 06:45:29', '2020-12-21 06:57:06');
INSERT INTO `courses` (`id`, `title`, `slug`, `level`, `rating`, `short_description`, `big_description`, `image`, `overview_url`, `provider`, `requirement`, `outcome`, `tag`, `is_free`, `price`, `is_discount`, `discount_price`, `language`, `meta_title`, `meta_description`, `is_published`, `user_id`, `category_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(24, 'The Complete Android N Developer Course', 'the-complete-android-n-developer-course', 'Beginner', '1', '<p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\"><em style=\"margin: 0px; padding: 0px;\">Please note support for this course has now stopped, and that there is a newer version of the course (The Complete Android Oreo Developer Course) available.</em></strong></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><em style=\"margin: 0px; padding: 0px;\">In this Android N version of the course I use Android Studio versions 2.0 and 2.1.2, and recommend students do the same.</em></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><br style=\"margin: 0px; padding: 0px;\"></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">So you want to build your own apps?</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">And you want to build them… from the comfort of your home… in your own time… without having to attend class… or wade through endless textbooks (or online guides). <em style=\"margin: 0px; padding: 0px;\">Am I right?</em></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">And let me guess: you <em style=\"margin: 0px; padding: 0px;\">only</em> want the latest technology, software and techniques—because you’ve got big plans, big ideas—and let’s be honest… you’re impatient and you want to jump the queue?</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">My name’s Rob Percival, creator of the world’s best-selling online coding courses… andI’ve designed<strong style=\"margin: 0px; padding: 0px;\"> The Complete Android N Developer Course</strong>, especially for YOU.</p>', '<p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">Building on last year’s runaway success: The Complete Android Developer Course (Udemy’s best-ever-selling Android course, with over 50,000 happy students), <strong style=\"margin: 0px; padding: 0px;\">The Complete Android N Developer Course</strong> has been refined, honed and microscopically polished to deliver even more valuable content, all designed for the latest Android 7. </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">A huge range of technologies are covered, including open source Parse Server, Firebase, Admob, GDX (game development), Bluetooth and a whole lot more.</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">This time, using hot-off-the-press <strong style=\"margin: 0px; padding: 0px;\">Android Nougat</strong> (putting unparalleled levels of performance, productivity and security directly into your hands), <strong style=\"margin: 0px; padding: 0px;\">The Complete Android N Developer Course </strong>includes building a WhatsApp clone PLUS three <em style=\"margin: 0px; padding: 0px;\">brand spanking new</em> chapters on how to market your apps—and start piling in the cash.</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">What’s stopping you from signing up to today?</strong></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      You don’t have enough time: <em style=\"margin: 0px; padding: 0px;\">Not an issue</em>. We’ve designed this course so you can learn everything you need in as little as SIX WEEKS.</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      You’re still weighing up the value: <em style=\"margin: 0px; padding: 0px;\">Listen. </em>We’ve made this course bigger, better and more affordable—with even more content and more insider money-making tips—than EVER before. In fact, if you don’t 100% get everything you need from it… we’ll give you your MONEY BACK.</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      You don’t have any previous experience: <em style=\"margin: 0px; padding: 0px;\">Seriously, not a problem</em>. This course is expertly designed to teach everyone from complete beginners, right through to pro developers.  <em style=\"margin: 0px; padding: 0px;\">(And yes, even pro developers take this course to quickly absorb the latest skills, while refreshing existing ones).</em>    </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><em style=\"margin: 0px; padding: 0px;\">“Detailed instructions for beginners, easy to follow as all Rob\'s courses. I would definitely recommend this course :)”</em>   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><em style=\"margin: 0px; padding: 0px;\">“As a full time developer, I dreamed of writing a game, but never got anywhere. Too much analysis, object-oriented development training. Then Rob built flappy birds right before my eyes. Now I have a game going into the app store. This course is great for pro-developers too!”</em>   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">Straight up: No other course will take you to expert app developer in as fast a time as this. <em style=\"margin: 0px; padding: 0px;\">Have other courses done this for you?</em> </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><br style=\"margin: 0px; padding: 0px;\"></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">Buy this course today and this is what you’ll get.</strong></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">Firstly, using Java and Android Studio, I\'ll teach you how to build real, marketable apps by cloning WhatsApp, Uber and Instagram.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">And by the way—just like my other record-smashing courses—this course is project based, which means you build your own apps in REALTIME…As. You. Learn.     </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">Over half a million students tell me this is THE most motivating and effective way to absorb information.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      You\'ll start by downloading Android Studio and building an easy-peasy Currency Converter app.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      Next up: you\'ll build a Favourite Places app and a Brain Training app, before working your way up to WhatsApp, Uber and Instagram clones — using Parse Server.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      You\'ll also get a full guide on submitting your apps to Google Play, plus THREE BRAND NEW WALK-THROUGH chapters explaining exactly how to effectively market your apps—and generate revenue with Google Ads.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      You\'ll learn all the latest Android N features, including App Permissions and Android Pay.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      And finally, we\'ll take a look at Android Wear - the future of wearable computing.</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">Can you believe you get all this (and more) for just $200?</strong>  </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><em style=\"margin: 0px; padding: 0px;\">“Amazing course that teaches you everything you want to learn about making android apps from the basic to the advanced. Even if you have no knowledge you can learn so much from this course.”</em>  </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">What else will I get if I buy this course now?</strong></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      FULL LIFETIME ACCESS (including video downloads and updates) for a ludicrously affordable one-off fee.    </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      $50 Amazon AWS Credit for hosting your own social apps.</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      PEACE OF MIND: Learn from the creator of three of the most popular online courses, successfully teaching over 200,000 students and receiving 10,000 5* reviews.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      CONTINUOUS PROJECT SUPPORT: Whenever you need it, in the course forums.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      SUPERIOR LEARNING: Build your own real apps as you go, with not a yawnsome programming concept in sight.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      £300 WORTH OF EXCLUSIVE APP TEMPLATES, icons and backgrounds (designed for Android N)    </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      ONE YEAR’S FREE WEB HOSTING on Eco Web Hosting\'s Advanced Package, worth £119. *Limited to one year per student not per course*</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><em style=\"margin: 0px; padding: 0px;\">“So much more understandable than the other 6+ classes I have taken elsewhere. This course is a must! Thank you!”</em>  </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">Why learn to make Android apps?</strong>   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      Android is without a doubt THE biggest mobile platform in the world, with over 80% market share and over 1 billion devices sold in 2016 alone.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      You can develop for Android on a Windows, Mac or Linux computer.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      Java is a fantastic language to learn, allowing you to make apps for PC, Mac and the web, as well as Android.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      Android app discovery is way superior to the App Store, so your app has a far better chance of getting seen—and bought.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      Ad-based revenue is a lot more common on Android than on iOS, and a cinch to set up with Google Ads.  </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><em style=\"margin: 0px; padding: 0px;\">“Top class professional presentation of a well-constructed course. Consistently pitched at the right level to remain interesting and challenging, this course quickly brings the student to a point where generating their own applications is realistic and fun</em>.”  </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">Who is this for?</strong>   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">Anyone who wants to learn to code to become an app developer: This is a complete course, just like my Complete Web, iOS and Apple Watch courses. So once you’re up and coding like a demon app developer, it’ll ALSO teach you how to <em style=\"margin: 0px; padding: 0px;\">make money from your apps</em>.    </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">Sound good?   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">It’s also for anyone who wants to understand how computers work: Learning to code is so much more than being able to make apps - knowing how computers work opens news doors to our awesome digital world</p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"> </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><em style=\"margin: 0px; padding: 0px;\">“Rob has a knack for explaining material in an easily digestible way. The mini challenges he presents within his lectures are an excellent way to commit things to memory. The lectures are well paced - fast enough to maintain your interest but not so fast that you get left in the dust!”</em>   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">Is this course right for me?</strong>   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">Look: if you’re still not convinced, I urge you to check out my 5* reviews. There’s over half a million of them on Udemy, alone.  No other course on the World Wide Web has achieved such consistent ratings.    </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><em style=\"margin: 0px; padding: 0px;\">Coding and app development is the future</em>. Whether you’ve got plans to create the next Facebook, or you want to get ahead at work and increase your earning potential, I GUARANTEE anyone will find <strong style=\"margin: 0px; padding: 0px;\">The Complete Android N Developer Course</strong> course show-stoppingly useful.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">A quick summary of why <strong style=\"margin: 0px; padding: 0px;\">The Complete Android N Developer Course</strong> is the number one resource for budding app developers, like you:   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      Time-tested, quick-to-pick up learning strategies   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      Quality insider tips, that only the pros normally know  </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      Home-based learning—so you can go as fast or slow as you please   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">·      Simple, jargon-free language and HD definition  </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><strong style=\"margin: 0px; padding: 0px;\">Who Am I?</strong>   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">I\'m Rob.    </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">I run three of the most successful online coding courses on the planet, and I’m so excited to share them with you.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">I have a degree in Mathematics from Cambridge University, and am a web and app developer based in Cambridge, UK. Since working as a secondary school teacher for 10 years, I’ve never lost my love for teaching.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">Maybe that’s why my goal is so simple: To get as many people benefitting from app development as possible. But more importantly, that my courses are enjoyable and deliver tangible results for you… Today and tomorrow.    </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">These are the things that drive me to keep pushing what’s possible in online learning.   </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\">OK, let’s begin… </p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><br style=\"margin: 0px; padding: 0px;\"></p><p style=\"margin: 0.8rem 0px 0px; padding: 0px; font-size: 14px; max-width: 118.4rem; color: rgb(60, 59, 55); font-family: \"sf pro text\", -apple-system, BlinkMacSystemFont, Roboto, \"segoe ui\", Helvetica, Arial, sans-serif, \"apple color emoji\", \"segoe ui emoji\", \"segoe ui symbol\";\"><em style=\"margin: 0px; padding: 0px;\">“Outstanding! Rob delivers high quality content once more. It\'s not just the endless content and the clear explanations that you get but more importantly the confidence that you build. A must for any developer.”</em></p>', '/uploads/media_manager/20.jpg', 'https://youtu.be/aS__9RbCyHg', 'Youtube', '[\"A Windows PC\",\"                                                         Mac or Linux Computer\",\"                                                        ZERO programming knowledge required - I\'ll teach you everything you need to know\"]', '[\"ZERO programming knowledge required - I\'ll teach you everything you need to know\"]', '[\"Android\",\"kotlin\",\"java\"]', 1, NULL, 0, NULL, 'English', '[\"\"]', NULL, 1, 21, 8, NULL, '2020-12-21 06:52:47', '2020-12-21 06:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `course_comments`
--

CREATE TABLE `course_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` double DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `replay` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_purchase_histories`
--

CREATE TABLE `course_purchase_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enrollment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `align` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `rate`, `is_published`, `align`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Dollar', 'USD', '$', 1, 1, 1, NULL, NULL, '2020-06-10 01:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `discussion` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_post_views`
--

CREATE TABLE `forum_post_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `helpful_answers`
--

CREATE TABLE `helpful_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_reply_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `linked` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tw` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `signature` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `email`, `phone`, `address`, `image`, `balance`, `linked`, `fb`, `tw`, `skype`, `about`, `package_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`, `signature`) VALUES
(3, 'Shohanur', 'instructor@mail.com', NULL, 'H#20, R#20, Address City, Town', 'uploads/instructor/1YRauZ3XoItxFYjjY1S4W3OOR4zYrtxvrTJNYbqG.jpg', 331, 'https://www.linkedin.com/', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.skypee.com/', 'This is my about us section.', 1, 5, NULL, '2020-06-10 04:08:06', '2020-12-21 10:18:00', NULL),
(8, 'rumon', 'rumon@mail.com', NULL, NULL, 'uploads/instructor/ZguHDula9P98arVGlSHNKhsp1SMZLaXFSfE6VmKj.jpg', 0, NULL, NULL, NULL, NULL, NULL, 1, 21, NULL, '2020-12-21 06:37:08', '2020-12-21 08:06:24', NULL),
(9, 'prince', 'prince@mail.com', NULL, NULL, 'uploads/instructor/G1v5q9RkbF9Qz8FbygQZpMoF6vDKWSotKwXvEdZw.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 22, NULL, '2020-12-21 07:12:31', '2020-12-21 07:13:57', NULL),
(10, 'Azharul Islam Naeem', 'naeem@mail.com', NULL, NULL, 'uploads/instructor/NC77i2wPd5e4s1OhlLBaKr5u95ifOMaeiHuNfOiu.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 23, NULL, '2020-12-21 07:34:31', '2020-12-21 07:35:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructor_accounts`
--

CREATE TABLE `instructor_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bank',
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routing_number` int(11) DEFAULT NULL,
  `paypal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Paypal',
  `paypal_acc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_acc_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Stripe',
  `stripe_acc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_acc_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_card_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_earnings`
--

CREATE TABLE `instructor_earnings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `course_price` double NOT NULL,
  `will_get` double NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_subscription_earnings`
--

CREATE TABLE `instructor_subscription_earnings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_subscription_payments`
--

CREATE TABLE `instructor_subscription_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `know_abouts`
--

CREATE TABLE `know_abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `align` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `know_abouts`
--

INSERT INTO `know_abouts` (`id`, `icon`, `title`, `desc`, `align`, `video`, `image`, `created_at`, `updated_at`) VALUES
(1, 'icofont-document-folder', 'Delectus commodo id', 'Nostrud repudiandae', 'left', 'https://www.medomogyko.org', 'uploads/know/87rNny7BLgp7GdyXrel4VYEACaLmfVRppenINEOB.png', '2020-12-09 10:04:00', '2020-12-09 10:11:35'),
(2, 'icofont-document-folder', 'Inventore quam maxim', 'Nulla adipisicing si', 'right', 'https://www.mujawoxataryjes.co.uk', NULL, '2020-12-09 10:06:39', '2020-12-09 10:06:39'),
(3, NULL, NULL, NULL, 'center', 'https://www.youtube.com/watch?v=Pzh27L4Y1YU', 'uploads/know/tD9JbJnB3RFkiHQNc1TE64uMDQkwDL0lM3eg2EFj.jpg', '2020-12-09 10:07:30', '2020-12-21 06:00:49'),
(4, 'icofont-document-folder', 'Id delectus id deb', 'Id molestiae veniam', 'left', 'https://www.doqehy.mobi', 'uploads/know/uG08D5XIjehzStEuFpXZ5HkABb3xPHFysqeI7QK9.png', '2020-12-09 10:08:00', '2020-12-09 10:08:00'),
(5, 'icofont-document-folder', 'Aut modi aliquip ali', 'Vel animi aperiam f', 'left', 'https://www.fahuxab.net', 'uploads/know/BB07a4L4KYYDfnTBOpBfy0Lcfm8SlSh6bcw7qLQs.png', '2020-12-09 10:09:10', '2020-12-09 10:09:10'),
(6, 'icofont-document-folder', 'Voluptatem sit ullam', 'Voluptatem sequi qu', 'right', NULL, NULL, '2020-12-09 10:55:24', '2020-12-21 06:02:03'),
(7, 'icofont-document-folder', 'Online Course', 'Explore a variety of fresh topics', 'top', NULL, NULL, '2020-12-13 03:11:37', '2020-12-13 03:11:37'),
(8, 'icofont-cubes', 'expert instruction', 'expert instruction', 'top', NULL, NULL, '2020-12-13 03:12:26', '2020-12-13 03:12:26'),
(9, 'icofont-gears', 'lifetime access', 'Learn on your schedule', 'top', NULL, NULL, '2020-12-13 03:13:09', '2020-12-13 03:13:09'),
(10, 'icofont-document-folder', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has', 'right', NULL, NULL, '2020-12-21 06:17:17', '2020-12-21 06:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 'Flag_of_the_United_States.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laravel_logger_activity`
--

CREATE TABLE `laravel_logger_activity` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `userType` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `route` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipAddress` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userAgent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `methodType` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laravel_logger_activity`
--

INSERT INTO `laravel_logger_activity` (`id`, `description`, `userType`, `userId`, `route`, `ipAddress`, `userAgent`, `locale`, `referer`, `methodType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4289, 'Viewed /', 'Guest', NULL, 'http://localhost/courselms-learning-management-system', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/', 'GET', '2021-02-25 09:59:40', '2021-02-25 09:59:40', NULL),
(4290, 'Logged In', 'Registered', 18, 'http://localhost/courselms-learning-management-system/login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/login', 'POST', '2021-02-25 09:59:51', '2021-02-25 09:59:51', NULL),
(4291, 'Viewed dashboard/home', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/home', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/login', 'GET', '2021-02-25 09:59:52', '2021-02-25 09:59:52', NULL),
(4292, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/home', 'POST', '2021-02-25 09:59:54', '2021-02-25 09:59:54', NULL),
(4293, 'Viewed dashboard/addon/manager', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/home', 'GET', '2021-02-25 10:00:03', '2021-02-25 10:00:03', NULL),
(4294, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'POST', '2021-02-25 10:00:05', '2021-02-25 10:00:05', NULL),
(4295, 'Viewed dashboard/addon/index/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/index/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:00:05', '2021-02-25 10:00:05', NULL),
(4296, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:00:45', '2021-02-25 10:00:45', NULL),
(4297, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:00:46', '2021-02-25 10:00:46', NULL),
(4298, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:00:46', '2021-02-25 10:00:46', NULL),
(4299, 'Viewed dashboard/addon/setup/coupon', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/coupon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:00:51', '2021-02-25 10:00:51', NULL),
(4300, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/coupon', 'POST', '2021-02-25 10:00:52', '2021-02-25 10:00:52', NULL),
(4301, 'Created dashboard/addon/install', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/coupon', 'POST', '2021-02-25 10:01:29', '2021-02-25 10:01:29', NULL),
(4302, 'Viewed dashboard/addon/manager', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/coupon', 'GET', '2021-02-25 10:01:30', '2021-02-25 10:01:30', NULL),
(4303, 'Viewed dashboard/addon/index/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/index/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:01:32', '2021-02-25 10:01:32', NULL),
(4304, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'POST', '2021-02-25 10:01:32', '2021-02-25 10:01:32', NULL),
(4305, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:01:46', '2021-02-25 10:01:46', NULL),
(4306, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:01:47', '2021-02-25 10:01:47', NULL),
(4307, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:01:47', '2021-02-25 10:01:47', NULL),
(4308, 'Viewed dashboard/addon/setup/certificate', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/certificate', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:01:53', '2021-02-25 10:01:53', NULL),
(4309, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/certificate', 'POST', '2021-02-25 10:01:54', '2021-02-25 10:01:54', NULL),
(4310, 'Created dashboard/addon/install', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/certificate', 'POST', '2021-02-25 10:02:31', '2021-02-25 10:02:31', NULL),
(4311, 'Viewed dashboard/addon/manager', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/certificate', 'GET', '2021-02-25 10:02:31', '2021-02-25 10:02:31', NULL),
(4312, 'Viewed dashboard/addon/index/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/index/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:02:33', '2021-02-25 10:02:33', NULL),
(4313, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'POST', '2021-02-25 10:02:33', '2021-02-25 10:02:33', NULL),
(4314, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:02:48', '2021-02-25 10:02:48', NULL),
(4315, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:02:50', '2021-02-25 10:02:50', NULL),
(4316, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:02:50', '2021-02-25 10:02:50', NULL),
(4317, 'Viewed dashboard/addon/setup/quiz', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/quiz', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:02:56', '2021-02-25 10:02:56', NULL),
(4318, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/quiz', 'POST', '2021-02-25 10:02:57', '2021-02-25 10:02:57', NULL),
(4319, 'Created dashboard/addon/install', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/quiz', 'POST', '2021-02-25 10:03:18', '2021-02-25 10:03:18', NULL),
(4320, 'Viewed dashboard/addon/manager', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/quiz', 'GET', '2021-02-25 10:03:18', '2021-02-25 10:03:18', NULL),
(4321, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'POST', '2021-02-25 10:03:20', '2021-02-25 10:03:20', NULL),
(4322, 'Viewed dashboard/addon/index/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/index/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:03:20', '2021-02-25 10:03:20', NULL),
(4323, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:03:27', '2021-02-25 10:03:27', NULL),
(4324, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:03:29', '2021-02-25 10:03:29', NULL),
(4325, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:03:29', '2021-02-25 10:03:29', NULL),
(4326, 'Viewed dashboard/addon/setup/zoom', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:03:41', '2021-02-25 10:03:41', NULL),
(4327, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:03:41', '2021-02-25 10:03:41', NULL),
(4328, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:03:42', '2021-02-25 10:03:42', NULL),
(4329, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:03:43', '2021-02-25 10:03:43', NULL),
(4330, 'Viewed dashboard/addon/setup/quiz', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/quiz', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:03:50', '2021-02-25 10:03:50', NULL),
(4331, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/quiz', 'POST', '2021-02-25 10:03:52', '2021-02-25 10:03:52', NULL),
(4332, 'Viewed dashboard/addon/manager', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/quiz', 'GET', '2021-02-25 10:04:11', '2021-02-25 10:04:11', NULL),
(4333, 'Viewed dashboard/addon/index/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/index/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:04:12', '2021-02-25 10:04:12', NULL),
(4334, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'POST', '2021-02-25 10:04:12', '2021-02-25 10:04:12', NULL),
(4335, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:04:14', '2021-02-25 10:04:14', NULL),
(4336, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:04:16', '2021-02-25 10:04:16', NULL),
(4337, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:04:16', '2021-02-25 10:04:16', NULL),
(4338, 'Viewed dashboard/addon/setup/zoom', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:04:18', '2021-02-25 10:04:18', NULL),
(4339, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:04:19', '2021-02-25 10:04:19', NULL),
(4340, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:04:20', '2021-02-25 10:04:20', NULL),
(4341, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:04:20', '2021-02-25 10:04:20', NULL),
(4342, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:07:17', '2021-02-25 10:07:17', NULL),
(4343, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:07:18', '2021-02-25 10:07:18', NULL),
(4344, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:07:18', '2021-02-25 10:07:18', NULL),
(4345, 'Viewed dashboard/addon/setup/zoom', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:07:21', '2021-02-25 10:07:21', NULL),
(4346, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:07:21', '2021-02-25 10:07:21', NULL),
(4347, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:07:22', '2021-02-25 10:07:22', NULL),
(4348, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:07:22', '2021-02-25 10:07:22', NULL),
(4349, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:07:47', '2021-02-25 10:07:47', NULL),
(4350, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:07:48', '2021-02-25 10:07:48', NULL),
(4351, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:07:48', '2021-02-25 10:07:48', NULL),
(4352, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:08:50', '2021-02-25 10:08:50', NULL),
(4353, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:08:51', '2021-02-25 10:08:51', NULL),
(4354, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:08:51', '2021-02-25 10:08:51', NULL),
(4355, 'Viewed dashboard/addon/setup/zoom', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:09:11', '2021-02-25 10:09:11', NULL),
(4356, 'Viewed dashboard/addon/setup/zoom', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:11:23', '2021-02-25 10:11:23', NULL),
(4357, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', 'POST', '2021-02-25 10:11:24', '2021-02-25 10:11:24', NULL),
(4358, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:11:26', '2021-02-25 10:11:26', NULL),
(4359, 'Viewed dashboard/addon/setup/paytm', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/paytm', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:11:31', '2021-02-25 10:11:31', NULL),
(4360, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/paytm', 'POST', '2021-02-25 10:11:33', '2021-02-25 10:11:33', NULL),
(4361, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:11:34', '2021-02-25 10:11:34', NULL),
(4362, 'Viewed dashboard/addon/setup/zoom', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:11:35', '2021-02-25 10:11:35', NULL),
(4363, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', 'POST', '2021-02-25 10:11:37', '2021-02-25 10:11:37', NULL),
(4364, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:11:38', '2021-02-25 10:11:38', NULL),
(4365, 'Viewed dashboard/addon/setup/quiz', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/quiz', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:11:39', '2021-02-25 10:11:39', NULL),
(4366, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/quiz', 'POST', '2021-02-25 10:11:41', '2021-02-25 10:11:41', NULL),
(4367, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:11:42', '2021-02-25 10:11:42', NULL),
(4368, 'Viewed dashboard/addon/setup/forum', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/forum', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:11:43', '2021-02-25 10:11:43', NULL),
(4369, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/forum', 'POST', '2021-02-25 10:11:45', '2021-02-25 10:11:45', NULL),
(4370, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:11:46', '2021-02-25 10:11:46', NULL),
(4371, 'Viewed dashboard/addon/setup/certificate', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/certificate', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:11:47', '2021-02-25 10:11:47', NULL),
(4372, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/certificate', 'POST', '2021-02-25 10:11:49', '2021-02-25 10:11:49', NULL),
(4373, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:11:50', '2021-02-25 10:11:50', NULL),
(4374, 'Viewed dashboard/addon/setup/subscription', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/subscription', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:11:51', '2021-02-25 10:11:51', NULL),
(4375, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/subscription', 'POST', '2021-02-25 10:11:53', '2021-02-25 10:11:53', NULL),
(4376, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:11:54', '2021-02-25 10:11:54', NULL),
(4377, 'Viewed dashboard/addon/setup/coupon', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/coupon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:11:55', '2021-02-25 10:11:55', NULL),
(4378, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/coupon', 'POST', '2021-02-25 10:11:57', '2021-02-25 10:11:57', NULL),
(4379, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:11:59', '2021-02-25 10:11:59', NULL),
(4380, 'Viewed dashboard/addon/setup/zoom', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:14:07', '2021-02-25 10:14:07', NULL),
(4381, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', 'POST', '2021-02-25 10:14:10', '2021-02-25 10:14:10', NULL),
(4382, 'Created dashboard/addon/install', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', 'POST', '2021-02-25 10:14:30', '2021-02-25 10:14:30', NULL),
(4383, 'Viewed dashboard/addon/manager', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/zoom', 'GET', '2021-02-25 10:14:31', '2021-02-25 10:14:31', NULL),
(4384, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'POST', '2021-02-25 10:14:33', '2021-02-25 10:14:33', NULL),
(4385, 'Viewed dashboard/addon/index/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/index/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:14:33', '2021-02-25 10:14:33', NULL),
(4386, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:14:45', '2021-02-25 10:14:45', NULL),
(4387, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:14:47', '2021-02-25 10:14:47', NULL),
(4388, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:14:47', '2021-02-25 10:14:47', NULL),
(4389, 'Viewed dashboard/addon/setup/coupon', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/coupon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:14:58', '2021-02-25 10:14:58', NULL),
(4390, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/coupon', 'POST', '2021-02-25 10:15:01', '2021-02-25 10:15:01', NULL),
(4391, 'Viewed dashboard/addon/manager', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/coupon', 'GET', '2021-02-25 10:15:01', '2021-02-25 10:15:01', NULL),
(4392, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'POST', '2021-02-25 10:15:04', '2021-02-25 10:15:04', NULL),
(4393, 'Viewed dashboard/addon/index/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/index/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:15:04', '2021-02-25 10:15:04', NULL),
(4394, 'Viewed dashboard/addon/installation', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:15:07', '2021-02-25 10:15:07', NULL),
(4395, 'Viewed dashboard/addon/install/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:15:09', '2021-02-25 10:15:09', NULL),
(4396, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'POST', '2021-02-25 10:15:09', '2021-02-25 10:15:09', NULL),
(4397, 'Viewed dashboard/addon/setup/forum', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/forum', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/installation', 'GET', '2021-02-25 10:15:13', '2021-02-25 10:15:13', NULL),
(4398, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/forum', 'POST', '2021-02-25 10:15:15', '2021-02-25 10:15:15', NULL),
(4399, 'Created dashboard/addon/install', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/install', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/forum', 'POST', '2021-02-25 10:15:32', '2021-02-25 10:15:32', NULL),
(4400, 'Viewed dashboard/addon/manager', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/setup/forum', 'GET', '2021-02-25 10:15:34', '2021-02-25 10:15:34', NULL);
INSERT INTO `laravel_logger_activity` (`id`, `description`, `userType`, `userId`, `route`, `ipAddress`, `userAgent`, `locale`, `referer`, `methodType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4401, 'Viewed dashboard/addon/index/page', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/addon/index/page?_token=Yzs1St1D9bn9BhbdVhi7x9s71J6Ib9FwxEIPhjrp', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'GET', '2021-02-25 10:15:36', '2021-02-25 10:15:36', NULL),
(4402, 'Created dashboard/media/manager/slide', 'Registered', 18, 'http://localhost/courselms-learning-management-system/dashboard/media/manager/slide', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', 'en-US,en;q=0.9', 'http://localhost/courselms-learning-management-system/dashboard/addon/manager', 'POST', '2021-02-25 10:15:36', '2021-02-25 10:15:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `massages`
--

CREATE TABLE `massages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enroll_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_managers`
--

CREATE TABLE `media_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resolution` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_managers`
--

INSERT INTO `media_managers` (`id`, `user_id`, `title`, `type`, `image`, `alt`, `resolution`, `size`, `created_at`, `updated_at`) VALUES
(1, 18, NULL, 'thumbnail', NULL, NULL, NULL, NULL, '2020-12-12 05:25:28', '2020-12-12 05:25:28'),
(2, 18, 'dsd', 'slider', NULL, NULL, NULL, NULL, '2020-12-12 05:25:52', '2020-12-12 05:25:52'),
(3, 18, 'kjlk', 'category', '/uploads/media_manager/3.png', 'image', '792x1738', '18', '2020-12-12 05:26:11', '2020-12-12 10:25:03'),
(4, 18, NULL, 'category', '/uploads/media_manager/4.png', 'image', '275x231', '15', '2020-12-12 06:14:02', '2020-12-12 06:14:02'),
(5, 18, 's', 'category', '/uploads/media_manager/5.png', 'image', '792x1738', '18', '2020-12-12 10:28:33', '2020-12-12 10:28:34'),
(6, 18, 'sds', 'category', '/uploads/media_manager/6.png', 'image', '517x156', '39', '2020-12-12 10:28:46', '2020-12-12 10:28:46'),
(7, 18, NULL, 'organization', '/uploads/media_manager/7.png', 'image', '275x231', '15', '2020-12-12 10:28:56', '2020-12-12 10:28:56'),
(8, 18, NULL, 'category', '/uploads/media_manager/8.png', 'image', '275x231', '15', '2020-12-12 10:30:35', '2020-12-12 10:30:35'),
(9, 18, NULL, 'category', '/uploads/media_manager/9.png', 'image', '84x84', '5', '2020-12-21 06:12:08', '2020-12-21 06:12:08'),
(10, 18, NULL, 'category', '/uploads/media_manager/10.png', 'image', '114x69', '3', '2020-12-21 06:12:39', '2020-12-21 06:12:39'),
(11, 18, NULL, 'category', '/uploads/media_manager/11.png', 'image', '116x82', '5', '2020-12-21 06:13:11', '2020-12-21 06:13:11'),
(12, 18, NULL, 'category', '/uploads/media_manager/12.png', 'image', '87x85', '8', '2020-12-21 06:13:28', '2020-12-21 06:13:28'),
(13, 18, NULL, 'category', '/uploads/media_manager/13.png', 'image', '89x79', '6', '2020-12-21 06:13:47', '2020-12-21 06:13:47'),
(14, 18, NULL, 'category', '/uploads/media_manager/14.png', 'image', '131x77', '3', '2020-12-21 06:14:04', '2020-12-21 06:14:04'),
(15, 18, NULL, 'category', '/uploads/media_manager/15.png', 'image', '126x94', '6', '2020-12-21 06:14:24', '2020-12-21 06:14:24'),
(16, 18, NULL, 'category', '/uploads/media_manager/16.png', 'image', '116x90', '5', '2020-12-21 06:14:55', '2020-12-21 06:14:55'),
(17, 18, NULL, 'category', '/uploads/media_manager/17.png', 'image', '125x62', '7', '2020-12-21 06:15:27', '2020-12-21 06:15:27'),
(18, 18, NULL, 'thumbnail', '/uploads/media_manager/18.jpg', 'image', '240x135', '13', '2020-12-21 06:35:49', '2020-12-21 06:35:49'),
(19, 21, NULL, 'thumbnail', '/uploads/media_manager/19.jpg', 'image', '240x135', '13', '2020-12-21 06:40:40', '2020-12-21 06:40:40'),
(20, 21, NULL, 'thumbnail', '/uploads/media_manager/20.jpg', 'image', '240x135', '16', '2020-12-21 06:48:09', '2020-12-21 06:48:09'),
(21, 18, NULL, 'thumbnail', '/uploads/media_manager/21.png', 'image', '700x318', '27', '2020-12-21 09:10:45', '2020-12-21 09:10:45'),
(22, 18, NULL, 'thumbnail', '/uploads/media_manager/22.jpeg', 'image', '1000x400', '72', '2020-12-21 09:10:56', '2020-12-21 09:10:56'),
(23, 18, NULL, 'thumbnail', '/uploads/media_manager/23.png', 'image', '700x241', '28', '2020-12-21 09:23:40', '2020-12-21 09:23:40'),
(24, 18, NULL, 'category', '/uploads/media_manager/24.png', 'image', '700x466', '539', '2020-12-21 09:23:52', '2020-12-21 09:23:52'),
(25, 18, NULL, 'thumbnail', '/uploads/media_manager/25.png', 'image', '600x402', '43', '2020-12-21 09:24:05', '2020-12-21 09:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `owner_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `zoom_url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_by` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agenda` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2020_02_18_053228_create_categories_table', 1),
(11, '2020_03_18_055630_create_languages_table', 1),
(12, '2020_03_18_085009_create_currencies_table', 1),
(13, '2020_03_18_101231_create_system_settings_table', 1),
(14, '2020_03_20_104650_create_packages_table', 1),
(15, '2020_03_20_104940_create_instructors_table', 1),
(16, '2020_03_20_105907_create_package_purchase_histories_table', 1),
(17, '2020_03_20_110758_create_courses_table', 1),
(18, '2020_03_20_115215_create_classes_table', 1),
(19, '2020_03_20_115803_create_class_contents_table', 1),
(20, '2020_03_20_120806_create_students_table', 1),
(21, '2020_03_20_121712_create_enrollments_table', 1),
(22, '2020_03_20_122043_create_carts_table', 1),
(23, '2020_03_20_123531_create_course_purchase_histories_table', 1),
(24, '2020_03_20_123839_create_wishlists_table', 1),
(25, '2020_03_20_124006_create_admin_earnings_table', 1),
(26, '2020_03_20_124108_create_support_tickets_table', 1),
(27, '2020_03_20_124319_create_support_ticket_replays_table', 1),
(28, '2020_04_01_045351_create_sliders_table', 1),
(29, '2020_04_03_082248_create_instructor_earnings_table', 1),
(30, '2020_04_14_032755_create_jobs_table', 1),
(31, '2020_04_17_061729_create_verify_users_table', 1),
(32, '2020_05_04_192324_create_seen_contents_table', 1),
(33, '2020_05_05_053312_create_api_password_resets_table', 1),
(34, '2020_05_05_074657_create_massages_table', 1),
(35, '2020_05_05_153038_create_course_comments_table', 1),
(36, '2020_05_12_131611_create_pages_table', 1),
(37, '2020_05_12_131737_create_page_contents_table', 1),
(38, '2020_05_14_093225_create_instructor_accounts_table', 1),
(39, '2020_05_14_093226_create_payments_table', 1),
(40, '2020_06_04_210613_create_notification_users_table', 1),
(41, '2020_07_22_091509_create_affiliates_table', 2),
(42, '2020_07_22_091735_create_student_accounts_table', 2),
(43, '2020_07_22_130558_create_affiliate_histories_table', 2),
(44, '2020_07_22_160131_create_affiliate_payments_table', 2),
(45, '2017_11_04_103444_create_laravel_logger_activity_table', 3),
(46, '2020_10_11_033846_create_media_managers_table', 3),
(47, '2020_10_18_094822_create_addons_table', 3),
(48, '2020_10_21_065301_create_zooms_table', 3),
(49, '2020_10_21_070224_create_meetings_table', 3),
(50, '2020_10_27_085339_create_quizzes_table', 3),
(51, '2020_10_28_060028_create_questions_table', 3),
(52, '2020_10_31_072548_create_quiz_scores_table', 3),
(53, '2020_11_04_084300_create_forums_table', 3),
(54, '2020_11_05_033142_create_post_replies_table', 3),
(55, '2020_11_05_053014_create_helpful_answers_table', 3),
(56, '2020_11_05_093812_create_forum_post_views_table', 3),
(57, '2020_11_07_034618_create_certificates_table', 3),
(58, '2020_11_07_103613_create_certificate_stores_table', 3),
(59, '2020_11_12_025008_create_subscriptions_table', 4),
(60, '2020_11_12_091519_create_subscription_courses_table', 5),
(61, '2020_11_12_092738_create_subscription_settings_table', 5),
(62, '2020_11_15_025521_create_subscription_enrollments_table', 5),
(63, '2020_11_15_041645_create_subscription_carts_table', 5),
(64, '2020_11_17_092014_create_instructor_subscription_payments_table', 6),
(65, '2020_11_17_131708_create_instructor_subscription_earnings_table', 6),
(66, '2020_11_19_093520_create_subscription_course_requests_table', 6),
(67, '2020_12_09_125134_create_know_abouts_table', 6),
(68, '2019_11_18_105032_create_pages_table', 7),
(69, '2019_11_18_105615_create_uploads_table', 7),
(70, '2020_04_18_064412_create_page_translations_table', 7),
(71, '2020_04_18_065546_create_settings_table', 7),
(73, '2020_12_10_152024_create_blogs_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notification_users`
--

CREATE TABLE `notification_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `commission` double NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `image`, `price`, `commission`, `is_published`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'uploads/package/x1t7704KOJG6WYqqcMghQ5d0eIS3osh7MfJq6QvJ.jpeg', 0, 0, 1, NULL, '2020-06-09 09:49:18', '2020-06-10 14:02:54'),
(2, 'uploads/package/S5YUUuMRd7BLRP11SmhllvrgGaBoIwfImDS2VtcM.jpeg', 10, 20, 1, NULL, '2020-06-09 09:49:35', '2020-06-10 14:02:39'),
(3, 'uploads/package/aCRKkSZnF3IPWSsNMZ7eL1ZSePOmxdll0Gj7dqv1.jpeg', 30, 5, 1, NULL, '2020-06-10 01:55:32', '2020-06-10 14:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `package_purchase_histories`
--

CREATE TABLE `package_purchase_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_purchase_histories`
--

INSERT INTO `package_purchase_histories` (`id`, `amount`, `payment_method`, `user_id`, `package_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, 5, 1, NULL, '2020-12-20 11:26:08', '2020-12-20 11:26:08'),
(2, 0, NULL, 21, 1, NULL, '2020-12-21 06:37:08', '2020-12-21 06:37:08'),
(3, 0, NULL, 22, 1, NULL, '2020-12-21 07:12:31', '2020-12-21 07:12:31'),
(4, 0, NULL, 23, 1, NULL, '2020-12-21 07:34:31', '2020-12-21 07:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

CREATE TABLE `page_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `current_balance` double DEFAULT NULL,
  `process` enum('Bank','Paypal','Stripe') COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Request','Confirm') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_change_date` datetime DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_replies`
--

CREATE TABLE `post_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reply` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` double(8,2) NOT NULL,
  `options` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_time` int(11) DEFAULT NULL,
  `pass_mark` double(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `number_of_attempts` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_scores`
--

CREATE TABLE `quiz_scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `minutes` int(11) NOT NULL,
  `score` double(8,2) NOT NULL,
  `wrong` double(8,2) NOT NULL,
  `right` double(8,2) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seen_contents`
--

CREATE TABLE `seen_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enroll_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `content_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `sub_title`, `url`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'uploads/slider/A1M6f36uzdGHw6VUPWUk1ti9IFtiykT8ZQtqIRQ9.jpeg', 'Course LMS, best online learning platform', 'Find your course and start learning', NULL, 1, NULL, '2020-06-10 13:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tw` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linked` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phone`, `address`, `about`, `image`, `fb`, `tw`, `linked`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'student', 'student@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, NULL, '2020-12-09 03:52:33', '2020-12-09 03:52:33');

-- --------------------------------------------------------

--
-- Table structure for table `student_accounts`
--

CREATE TABLE `student_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bank',
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routing_number` int(11) DEFAULT NULL,
  `paypal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Paypal',
  `paypal_acc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_acc_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Stripe',
  `stripe_acc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_acc_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_card_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double DEFAULT NULL,
  `instructor_payment` double DEFAULT 0,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `popular` tinyint(1) NOT NULL DEFAULT 0,
  `deactive` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `name`, `description`, `price`, `instructor_payment`, `duration`, `popular`, `deactive`, `created_at`, `updated_at`) VALUES
(1, 'Package one', '[\"This is for old student\"]', 0, NULL, 'Free', 1, 1, '2020-12-21 07:47:39', '2020-12-21 10:07:02'),
(2, 'Package tow', '[\"This is for new Student\"]', 10, 5, 'Weekly', 0, 1, '2020-12-21 07:48:15', '2020-12-21 07:49:05'),
(3, 'Package three', '[\"This is for any Student\"]', 20, 5, 'Monthly', 0, 1, '2020-12-21 07:48:56', '2020-12-21 07:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_carts`
--

CREATE TABLE `subscription_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_package` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_price` double NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_courses`
--

CREATE TABLE `subscription_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_courses`
--

INSERT INTO `subscription_courses` (`id`, `subscription_duration`, `course_id`, `user_id`, `is_published`, `created_at`, `updated_at`) VALUES
(1, '\"[\\\"Free\\\",\\\"Weekly\\\",\\\"Monthly\\\"]\"', 2, 5, 1, '2020-12-21 08:51:22', '2020-12-21 08:56:59'),
(2, '\"[\\\"Monthly\\\"]\"', 9, 5, 1, '2020-12-21 09:00:19', '2020-12-21 09:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_course_requests`
--

CREATE TABLE `subscription_course_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_course_requests`
--

INSERT INTO `subscription_course_requests` (`id`, `course_id`, `user_id`, `subscription_duration`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 'Free', NULL, '2020-12-21 07:49:46', '2020-12-21 07:49:46'),
(2, 2, 5, 'Weekly', NULL, '2020-12-21 07:49:47', '2020-12-21 07:49:47'),
(3, 2, 5, 'Monthly', NULL, '2020-12-21 07:49:50', '2020-12-21 07:49:50'),
(4, 9, 5, 'Free', NULL, '2020-12-21 07:49:51', '2020-12-21 07:49:51'),
(5, 9, 5, 'Weekly', NULL, '2020-12-21 07:49:52', '2020-12-21 07:49:52'),
(6, 9, 5, 'Monthly', NULL, '2020-12-21 07:49:52', '2020-12-21 07:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_enrollments`
--

CREATE TABLE `subscription_enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_package` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_price` double NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_enrollments`
--

INSERT INTO `subscription_enrollments` (`id`, `subscription_package`, `subscription_price`, `user_id`, `start_at`, `end_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Free', 0, 19, '2020-12-21 16:23:10', '2020-12-21 16:08:39', NULL, '2020-12-21 10:23:10', '2020-12-21 10:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_settings`
--

CREATE TABLE `subscription_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_settings`
--

INSERT INTO `subscription_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(9, 'enable_instructor_request', '0', NULL, '2020-12-21 07:41:27'),
(10, 'enable_all_course', '1', NULL, '2020-12-21 07:41:27'),
(11, 'enable_free_trial', '1', NULL, '2020-12-21 07:41:27'),
(12, 'payment_schedule', 'Monthly', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `replay_count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_replays`
--

CREATE TABLE `support_ticket_replays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'default_currencies', '1', NULL, NULL),
(2, 'type_logo', 'uploads/site/header.png', NULL, NULL),
(3, 'type_name', 'Course LMS', NULL, '2020-12-09 03:14:50'),
(4, 'type_footer', 'Course LMS', NULL, '2020-12-09 03:14:50'),
(5, 'type_mail', 'courselms@mail.com', NULL, '2020-12-09 03:14:50'),
(6, 'type_address', 'Uttara Dhaka Bangladesh', NULL, '2020-12-09 03:14:50'),
(7, 'type_fb', 'facebook.com', NULL, '2020-12-09 03:14:50'),
(8, 'type_tw', 'twitter.com', NULL, '2020-12-09 03:14:50'),
(9, 'type_number', '0123456789', NULL, '2020-12-09 03:14:50'),
(10, 'type_google', 'google.com', NULL, '2020-12-09 03:14:50'),
(11, 'footer_logo', 'uploads/site/footer.png', NULL, NULL),
(12, 'favicon_icon', 'uploads/site/icon.png', NULL, NULL),
(13, 'default_currencies', '1', NULL, NULL),
(14, 'type_logo', '', NULL, NULL),
(15, 'type_name', '', NULL, NULL),
(16, 'type_footer', '', NULL, NULL),
(17, 'type_mail', '', NULL, NULL),
(18, 'type_address', '', NULL, NULL),
(19, 'type_fb', '', NULL, NULL),
(20, 'type_tw', '', NULL, NULL),
(21, 'type_number', '', NULL, NULL),
(22, 'type_google', '', NULL, NULL),
(23, 'footer_logo', '', NULL, NULL),
(24, 'favicon_icon', '', NULL, NULL),
(25, 'affiliate', 'Active', NULL, '2020-07-22 22:36:50'),
(26, 'commission', '1', NULL, NULL),
(27, 'withdraw_limit', '10', NULL, NULL),
(28, 'cookies_limit', '10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 1,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`, `slug`, `version`, `activated`, `image`, `created_at`, `updated_at`) VALUES
(1, 'frontend', 'frontend', '1.0', 0, 'default_banner.jpg', '2020-12-20 10:19:39', '2020-12-21 07:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('Student','Instructor','Admin') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT 0,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'uploads/user/user.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `zoom_email` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jwt_token` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `slug`, `email`, `user_type`, `email_verified_at`, `verified`, `password`, `banned`, `provider_id`, `image`, `remember_token`, `created_at`, `updated_at`, `zoom_email`, `jwt_token`) VALUES
(5, 'Shohanur Rahman Akash', 'Shohanur', 'instructor@mail.com', 'Instructor', NULL, 1, '$2y$10$Y7fwyZA3C/8LV2/6SfHbieNiojqBjZK4UTLkmjcnrejgvy0dJ4Au.', 0, NULL, 'uploads/instructor/1YRauZ3XoItxFYjjY1S4W3OOR4zYrtxvrTJNYbqG.jpg', NULL, '2020-06-10 04:08:06', '2020-12-21 07:15:45', NULL, NULL),
(18, 'admin', 'admin', 'admin@mail.com', 'Admin', NULL, 1, '$2y$10$Y7fwyZA3C/8LV2/6SfHbieNiojqBjZK4UTLkmjcnrejgvy0dJ4Au.', 0, NULL, 'uploads/user/user.png', NULL, '2020-12-09 03:15:07', '2020-12-09 03:15:07', NULL, NULL),
(19, 'STUDENT', 'student', 'student@mail.com', 'Student', NULL, 1, '$2y$10$Y7fwyZA3C/8LV2/6SfHbieNiojqBjZK4UTLkmjcnrejgvy0dJ4Au.', 0, NULL, 'uploads/user/user.png', NULL, '2020-12-09 03:52:33', '2020-12-09 03:52:33', NULL, NULL),
(21, 'Rumon', 'rumon', 'rumon@mail.com', 'Instructor', NULL, 1, '$2y$10$9HW9tP5Z.jPMX5m6rDGcgORWCAtLVcQaszr9MtxuhgKWS8o5EzRaS', 0, NULL, 'uploads/instructor/ZguHDula9P98arVGlSHNKhsp1SMZLaXFSfE6VmKj.jpg', NULL, '2020-12-21 06:37:08', '2020-12-21 08:06:24', NULL, NULL),
(22, 'Prince', 'prince', 'prince@mail.com', 'Instructor', NULL, 1, '$2y$10$fRFX3/gPCa23MjiyRoLTnOipA1YkKaAHKreLm.bLbKoKnReHrVupm', 0, NULL, 'uploads/instructor/G1v5q9RkbF9Qz8FbygQZpMoF6vDKWSotKwXvEdZw.jpg', NULL, '2020-12-21 07:12:31', '2020-12-21 07:13:57', NULL, NULL),
(23, 'Azharul Islam Naeem', 'azharul-islam-naeem', 'naeem@mail.com', 'Instructor', NULL, 1, '$2y$10$KbYqaGH11Qje5MwJ6ajQlOJRGwYFdULHMSu7H/gGzk/J.bwOXOmiu', 0, NULL, 'uploads/instructor/NC77i2wPd5e4s1OhlLBaKr5u95ifOMaeiHuNfOiu.jpg', NULL, '2020-12-21 07:34:31', '2020-12-21 07:35:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verify_users`
--

CREATE TABLE `verify_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verify_users`
--

INSERT INTO `verify_users` (`id`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 19, 'cbc75259022e1fd336f2c28b82b926e78ea5e1d3', '2020-12-09 03:53:09', '2020-12-09 03:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_price` double DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zooms`
--

CREATE TABLE `zooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_earnings`
--
ALTER TABLE `admin_earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_histories`
--
ALTER TABLE `affiliate_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_payments`
--
ALTER TABLE `affiliate_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_password_resets`
--
ALTER TABLE `api_password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_password_resets_email_index` (`email`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_course_id_foreign` (`course_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_stores`
--
ALTER TABLE `certificate_stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_course_id_foreign` (`course_id`);

--
-- Indexes for table `class_contents`
--
ALTER TABLE `class_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_contents_class_id_foreign` (`class_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_slug_unique` (`slug`),
  ADD KEY `courses_user_id_foreign` (`user_id`),
  ADD KEY `courses_category_id_foreign` (`category_id`);

--
-- Indexes for table `course_comments`
--
ALTER TABLE `course_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_comments_course_id_foreign` (`course_id`),
  ADD KEY `course_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `course_purchase_histories`
--
ALTER TABLE `course_purchase_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_purchase_histories_enrollment_id_foreign` (`enrollment_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`),
  ADD KEY `enrollments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_post_views`
--
ALTER TABLE `forum_post_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `helpful_answers`
--
ALTER TABLE `helpful_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `instructors_email_unique` (`email`),
  ADD KEY `instructors_package_id_foreign` (`package_id`),
  ADD KEY `instructors_user_id_foreign` (`user_id`);

--
-- Indexes for table `instructor_accounts`
--
ALTER TABLE `instructor_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `instructor_earnings`
--
ALTER TABLE `instructor_earnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_earnings_enrollment_id_foreign` (`enrollment_id`),
  ADD KEY `instructor_earnings_package_id_foreign` (`package_id`),
  ADD KEY `instructor_earnings_user_id_foreign` (`user_id`);

--
-- Indexes for table `instructor_subscription_earnings`
--
ALTER TABLE `instructor_subscription_earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor_subscription_payments`
--
ALTER TABLE `instructor_subscription_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `know_abouts`
--
ALTER TABLE `know_abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laravel_logger_activity`
--
ALTER TABLE `laravel_logger_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `massages`
--
ALTER TABLE `massages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `massages_enroll_id_foreign` (`enroll_id`),
  ADD KEY `massages_user_id_foreign` (`user_id`);

--
-- Indexes for table `media_managers`
--
ALTER TABLE `media_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_users`
--
ALTER TABLE `notification_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_purchase_histories`
--
ALTER TABLE `package_purchase_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_purchase_histories_user_id_foreign` (`user_id`),
  ADD KEY `package_purchase_histories_package_id_foreign` (`package_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_contents_page_id_foreign` (`page_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_account_id_foreign` (`account_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `post_replies`
--
ALTER TABLE `post_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seen_contents`
--
ALTER TABLE `seen_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seen_contents_enroll_id_foreign` (`enroll_id`),
  ADD KEY `seen_contents_course_id_foreign` (`course_id`),
  ADD KEY `seen_contents_class_id_foreign` (`class_id`),
  ADD KEY `seen_contents_content_id_foreign` (`content_id`),
  ADD KEY `seen_contents_user_id_foreign` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Indexes for table `student_accounts`
--
ALTER TABLE `student_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_carts`
--
ALTER TABLE `subscription_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_courses`
--
ALTER TABLE `subscription_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_course_requests`
--
ALTER TABLE `subscription_course_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_enrollments`
--
ALTER TABLE `subscription_enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_settings`
--
ALTER TABLE `subscription_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `support_ticket_replays`
--
ALTER TABLE `support_ticket_replays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_ticket_replays_ticket_id_foreign` (`ticket_id`),
  ADD KEY `support_ticket_replays_user_id_foreign` (`user_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verify_users`
--
ALTER TABLE `verify_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_course_id_foreign` (`course_id`);

--
-- Indexes for table `zooms`
--
ALTER TABLE `zooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `admin_earnings`
--
ALTER TABLE `admin_earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `affiliate_histories`
--
ALTER TABLE `affiliate_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `affiliate_payments`
--
ALTER TABLE `affiliate_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_password_resets`
--
ALTER TABLE `api_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `certificate_stores`
--
ALTER TABLE `certificate_stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `class_contents`
--
ALTER TABLE `class_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `course_comments`
--
ALTER TABLE `course_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_purchase_histories`
--
ALTER TABLE `course_purchase_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_post_views`
--
ALTER TABLE `forum_post_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `helpful_answers`
--
ALTER TABLE `helpful_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `instructor_accounts`
--
ALTER TABLE `instructor_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `instructor_earnings`
--
ALTER TABLE `instructor_earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `instructor_subscription_earnings`
--
ALTER TABLE `instructor_subscription_earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor_subscription_payments`
--
ALTER TABLE `instructor_subscription_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `know_abouts`
--
ALTER TABLE `know_abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laravel_logger_activity`
--
ALTER TABLE `laravel_logger_activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4403;

--
-- AUTO_INCREMENT for table `massages`
--
ALTER TABLE `massages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media_managers`
--
ALTER TABLE `media_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `notification_users`
--
ALTER TABLE `notification_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package_purchase_histories`
--
ALTER TABLE `package_purchase_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_replies`
--
ALTER TABLE `post_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seen_contents`
--
ALTER TABLE `seen_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_accounts`
--
ALTER TABLE `student_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscription_carts`
--
ALTER TABLE `subscription_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscription_courses`
--
ALTER TABLE `subscription_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription_course_requests`
--
ALTER TABLE `subscription_course_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscription_enrollments`
--
ALTER TABLE `subscription_enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription_settings`
--
ALTER TABLE `subscription_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_ticket_replays`
--
ALTER TABLE `support_ticket_replays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `verify_users`
--
ALTER TABLE `verify_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `zooms`
--
ALTER TABLE `zooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_contents`
--
ALTER TABLE `class_contents`
  ADD CONSTRAINT `class_contents_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_comments`
--
ALTER TABLE `course_comments`
  ADD CONSTRAINT `course_comments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
