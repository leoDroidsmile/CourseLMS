-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Апр 04 2021 г., 20:43
-- Версия сервера: 10.3.28-MariaDB-log-cll-lve
-- Версия PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `olmaa_lms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `addons`
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

-- --------------------------------------------------------

--
-- Структура таблицы `admin_earnings`
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
-- Структура таблицы `affiliates`
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
-- Структура таблицы `affiliate_histories`
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
-- Структура таблицы `affiliate_payments`
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
-- Структура таблицы `api_password_resets`
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
-- Структура таблицы `blogs`
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
-- Структура таблицы `carts`
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
-- Структура таблицы `categories`
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

-- --------------------------------------------------------

--
-- Структура таблицы `certificates`
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
-- Дамп данных таблицы `certificates`
--

INSERT INTO `certificates` (`id`, `template_text`, `top_text`, `header_text`, `footer_text`, `permissions`, `image`, `badge`, `logo`, `created_at`, `updated_at`) VALUES
(1, NULL, 'CERTIFICATE OR ACHIEVEMENT', 'THIS CERTIFICATE IS PROUDLY PRESENTED TO', 'FOR THE SUCCESSFUL COMPLETION OF', 'NO', 'uploads/certificate/c-1.jpg', 'uploads/certificate/aio5kW0XqrpgDftg4w08m0ZDsONI7G5cmkbmskBv.png', 'uploads/certificate/eeozYqUveBgouCmTFoPsSCAyfCK1cJXxA2p60OhX.png', '2020-12-20 11:11:46', '2020-12-21 07:05:51');

-- --------------------------------------------------------

--
-- Структура таблицы `certificate_stores`
--

CREATE TABLE `certificate_stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `classes`
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

-- --------------------------------------------------------

--
-- Структура таблицы `class_contents`
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

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
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

-- --------------------------------------------------------

--
-- Структура таблицы `course_comments`
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
-- Структура таблицы `course_purchase_histories`
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
-- Структура таблицы `currencies`
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
-- Дамп данных таблицы `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `rate`, `is_published`, `align`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Dollar', 'USD', '$', 1, 1, 1, NULL, NULL, '2020-06-10 01:47:09');

-- --------------------------------------------------------

--
-- Структура таблицы `enrollments`
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
-- Структура таблицы `failed_jobs`
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
-- Структура таблицы `forums`
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
-- Структура таблицы `forum_post_views`
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
-- Структура таблицы `helpful_answers`
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
-- Структура таблицы `instructors`
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

-- --------------------------------------------------------

--
-- Структура таблицы `instructor_accounts`
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
-- Структура таблицы `instructor_earnings`
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
-- Структура таблицы `instructor_subscription_earnings`
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
-- Структура таблицы `jobs`
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
-- Структура таблицы `know_abouts`
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
-- Дамп данных таблицы `know_abouts`
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
-- Структура таблицы `languages`
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
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 'Flag_of_the_United_States.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `laravel_logger_activity`
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
-- Дамп данных таблицы `laravel_logger_activity`
--

INSERT INTO `laravel_logger_activity` (`id`, `description`, `userType`, `userId`, `route`, `ipAddress`, `userAgent`, `locale`, `referer`, `methodType`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Viewed /', 'Guest', NULL, 'http://lms.olmaa.net', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/install/setup/admin/store', 'GET', '2021-04-04 13:46:45', '2021-04-04 13:46:45', NULL),
(2, 'Logged In', 'Registered', 1, 'http://lms.olmaa.net/login', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/login', 'POST', '2021-04-04 13:47:33', '2021-04-04 13:47:33', NULL),
(3, 'Viewed dashboard/home', 'Registered', 1, 'http://lms.olmaa.net/dashboard/home', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/login', 'GET', '2021-04-04 13:47:33', '2021-04-04 13:47:33', NULL),
(4, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/home', 'POST', '2021-04-04 13:47:35', '2021-04-04 13:47:35', NULL),
(5, 'Viewed dashboard/addon/manager', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/manager', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/home', 'GET', '2021-04-04 13:47:45', '2021-04-04 13:47:45', NULL),
(6, 'Viewed dashboard/addon/index/page', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/index/page?_token=ScmB7rJWVUxFOZe1PkNsoxev5XdelBan8trYmXCO', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'GET', '2021-04-04 13:47:46', '2021-04-04 13:47:46', NULL),
(7, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'POST', '2021-04-04 13:47:46', '2021-04-04 13:47:46', NULL),
(8, 'Viewed dashboard/addon/installation', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/installation', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'GET', '2021-04-04 13:47:52', '2021-04-04 13:47:52', NULL),
(9, 'Viewed dashboard/addon/install/page', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/install/page?_token=ScmB7rJWVUxFOZe1PkNsoxev5XdelBan8trYmXCO', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/installation', 'GET', '2021-04-04 13:47:52', '2021-04-04 13:47:52', NULL),
(10, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/installation', 'POST', '2021-04-04 13:47:52', '2021-04-04 13:47:52', NULL),
(11, 'Viewed dashboard/addon/setup/coupon', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/setup/coupon', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/installation', 'GET', '2021-04-04 13:48:05', '2021-04-04 13:48:05', NULL),
(12, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/setup/coupon', 'POST', '2021-04-04 13:48:06', '2021-04-04 13:48:06', NULL),
(13, 'Created dashboard/addon/install', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/install', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/setup/coupon', 'POST', '2021-04-04 13:48:30', '2021-04-04 13:48:30', NULL),
(14, 'Viewed dashboard/addon/manager', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/manager', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/setup/coupon', 'GET', '2021-04-04 13:48:31', '2021-04-04 13:48:31', NULL),
(15, 'Viewed dashboard/addon/index/page', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/index/page?_token=ScmB7rJWVUxFOZe1PkNsoxev5XdelBan8trYmXCO', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'GET', '2021-04-04 13:48:32', '2021-04-04 13:48:32', NULL),
(16, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'POST', '2021-04-04 13:48:32', '2021-04-04 13:48:32', NULL),
(17, 'Viewed dashboard/addon/installation', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/installation', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'GET', '2021-04-04 13:48:41', '2021-04-04 13:48:41', NULL),
(18, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/installation', 'POST', '2021-04-04 13:48:42', '2021-04-04 13:48:42', NULL),
(19, 'Viewed dashboard/addon/install/page', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/install/page?_token=ScmB7rJWVUxFOZe1PkNsoxev5XdelBan8trYmXCO', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/installation', 'GET', '2021-04-04 13:48:42', '2021-04-04 13:48:42', NULL),
(20, 'Viewed dashboard/addon/manager', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/manager', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/installation', 'GET', '2021-04-04 13:48:44', '2021-04-04 13:48:44', NULL),
(21, 'Viewed dashboard/addon/index/page', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/index/page?_token=ScmB7rJWVUxFOZe1PkNsoxev5XdelBan8trYmXCO', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'GET', '2021-04-04 13:48:46', '2021-04-04 13:48:46', NULL),
(22, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'POST', '2021-04-04 13:48:46', '2021-04-04 13:48:46', NULL),
(23, 'Viewed dashboard/addon/setup/wallet', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/setup/wallet', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/installation', 'GET', '2021-04-04 13:48:56', '2021-04-04 13:48:56', NULL),
(24, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/setup/wallet', 'POST', '2021-04-04 13:48:57', '2021-04-04 13:48:57', NULL),
(25, 'Created dashboard/addon/install', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/install', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/setup/wallet', 'POST', '2021-04-04 13:50:08', '2021-04-04 13:50:08', NULL),
(26, 'Viewed dashboard/addon/manager', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/manager', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/setup/wallet', 'GET', '2021-04-04 13:50:08', '2021-04-04 13:50:08', NULL),
(27, 'Viewed dashboard/addon/index/page', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/index/page?_token=ScmB7rJWVUxFOZe1PkNsoxev5XdelBan8trYmXCO', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'GET', '2021-04-04 13:50:09', '2021-04-04 13:50:09', NULL),
(28, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'POST', '2021-04-04 13:50:09', '2021-04-04 13:50:09', NULL),
(29, 'Viewed dashboard/addon/manager', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/manager', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'GET', '2021-04-04 13:55:02', '2021-04-04 13:55:02', NULL),
(30, 'Viewed dashboard/addon/index/page', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/index/page?_token=ScmB7rJWVUxFOZe1PkNsoxev5XdelBan8trYmXCO', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'GET', '2021-04-04 13:55:03', '2021-04-04 13:55:03', NULL),
(31, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'POST', '2021-04-04 13:55:03', '2021-04-04 13:55:03', NULL),
(32, 'Viewed dashboard/theme/manager', 'Registered', 1, 'http://lms.olmaa.net/dashboard/theme/manager', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/addon/manager', 'GET', '2021-04-04 13:55:29', '2021-04-04 13:55:29', NULL),
(33, 'Viewed dashboard/theme/index/page', 'Registered', 1, 'http://lms.olmaa.net/dashboard/theme/index/page?_token=ScmB7rJWVUxFOZe1PkNsoxev5XdelBan8trYmXCO', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/theme/manager', 'GET', '2021-04-04 13:55:30', '2021-04-04 13:55:30', NULL),
(34, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/theme/manager', 'POST', '2021-04-04 13:55:30', '2021-04-04 13:55:30', NULL),
(35, 'Viewed /', 'Guest', NULL, 'http://lms.olmaa.net', '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'en-GB,en-US;q=0.9,en;q=0.8', NULL, 'GET', '2021-04-04 14:26:54', '2021-04-04 14:26:54', NULL),
(36, 'Failed Login Attempt', 'Guest', NULL, 'http://lms.olmaa.net/login', '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'en-GB,en-US;q=0.9,en;q=0.8', 'http://lms.olmaa.net/login', 'POST', '2021-04-04 14:27:39', '2021-04-04 14:27:39', NULL),
(37, 'Logged In', 'Registered', 1, 'http://lms.olmaa.net/login', '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'en-GB,en-US;q=0.9,en;q=0.8', 'http://lms.olmaa.net/login', 'POST', '2021-04-04 14:27:58', '2021-04-04 14:27:58', NULL),
(38, 'Viewed dashboard/home', 'Registered', 1, 'http://lms.olmaa.net/dashboard/home', '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'en-GB,en-US;q=0.9,en;q=0.8', 'http://lms.olmaa.net/login', 'GET', '2021-04-04 14:27:59', '2021-04-04 14:27:59', NULL),
(39, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'en-GB,en-US;q=0.9,en;q=0.8', 'http://lms.olmaa.net/dashboard/home', 'POST', '2021-04-04 14:28:02', '2021-04-04 14:28:02', NULL),
(40, 'Viewed dashboard/addon/manager', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/manager', '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'en-GB,en-US;q=0.9,en;q=0.8', 'http://lms.olmaa.net/dashboard/home', 'GET', '2021-04-04 14:28:06', '2021-04-04 14:28:06', NULL),
(41, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'en-GB,en-US;q=0.9,en;q=0.8', 'http://lms.olmaa.net/dashboard/addon/manager', 'POST', '2021-04-04 14:28:07', '2021-04-04 14:28:07', NULL),
(42, 'Viewed dashboard/addon/index/page', 'Registered', 1, 'http://lms.olmaa.net/dashboard/addon/index/page?_token=tgmIOjYlxtOPDu0I5Cb5Da8lH0BnwIJmjw6aVuFz', '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'en-GB,en-US;q=0.9,en;q=0.8', 'http://lms.olmaa.net/dashboard/addon/manager', 'GET', '2021-04-04 14:28:07', '2021-04-04 14:28:07', NULL),
(43, 'Crawler crawled http://lms.olmaa.net', 'Crawler', NULL, 'http://lms.olmaa.net', '5.255.253.134', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', NULL, NULL, 'GET', '2021-04-04 22:16:35', '2021-04-04 22:16:35', NULL),
(44, 'Crawler crawled http://lms.olmaa.net', 'Crawler', NULL, 'http://lms.olmaa.net', '5.255.253.174', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', NULL, NULL, 'GET', '2021-04-05 01:18:34', '2021-04-05 01:18:34', NULL),
(45, 'Logged In', 'Registered', 1, 'http://lms.olmaa.net', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', NULL, 'GET', '2021-04-05 05:54:33', '2021-04-05 05:54:33', NULL),
(46, 'Viewed /', 'Registered', 1, 'http://lms.olmaa.net', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', NULL, 'GET', '2021-04-05 05:54:33', '2021-04-05 05:54:33', NULL),
(47, 'Viewed dashboard/home', 'Registered', 1, 'http://lms.olmaa.net/dashboard/home', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/', 'GET', '2021-04-05 05:54:40', '2021-04-05 05:54:40', NULL),
(48, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/home', 'POST', '2021-04-05 05:54:42', '2021-04-05 05:54:42', NULL),
(49, 'Logged Out', 'Registered', 1, 'http://lms.olmaa.net/logout', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/home', 'POST', '2021-04-05 05:54:44', '2021-04-05 05:54:44', NULL),
(50, 'Viewed /', 'Guest', NULL, 'http://lms.olmaa.net', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/home', 'GET', '2021-04-05 05:54:45', '2021-04-05 05:54:45', NULL),
(51, 'Logged In', 'Registered', 1, 'http://lms.olmaa.net/login', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/login', 'POST', '2021-04-05 06:39:15', '2021-04-05 06:39:15', NULL),
(52, 'Viewed dashboard/home', 'Registered', 1, 'http://lms.olmaa.net/dashboard/home', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/login', 'GET', '2021-04-05 06:39:16', '2021-04-05 06:39:16', NULL),
(53, 'Created dashboard/media/manager/slide', 'Registered', 1, 'http://lms.olmaa.net/dashboard/media/manager/slide', '217.145.231.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7', 'http://lms.olmaa.net/dashboard/home', 'POST', '2021-04-05 06:39:17', '2021-04-05 06:39:17', NULL),
(54, 'Viewed /', 'Guest', NULL, 'http://lms.olmaa.net', '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'en-GB,en-US;q=0.9,en;q=0.8', NULL, 'GET', '2021-04-05 10:41:48', '2021-04-05 10:41:48', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `massages`
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
-- Структура таблицы `media_managers`
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

-- --------------------------------------------------------

--
-- Структура таблицы `meetings`
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
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
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
-- Структура таблицы `notification_users`
--

CREATE TABLE `notification_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notification_users`
--

INSERT INTO `notification_users` (`id`, `user_id`, `is_read`, `data`, `created_at`, `updated_at`) VALUES
(1, 19, 0, '{\"body\":\"You enrolled new course  The Complete Digital finance Marketing Course\"}', '2020-12-09 06:20:23', '2020-12-09 06:20:23'),
(2, 5, 0, '{\"body\":\"The Complete Digital finance Marketing Course this course enrolled by natok\"}', '2020-12-09 06:20:23', '2020-12-09 06:20:23'),
(3, 19, 0, '{\"body\":\"You enrolled new course  Wordpress For Beginner\"}', '2020-12-09 06:33:50', '2020-12-09 06:33:50'),
(4, 5, 0, '{\"body\":\"Wordpress For Beginner this course enrolled by natok\"}', '2020-12-09 06:33:50', '2020-12-09 06:33:50'),
(5, 19, 0, '{\"body\":\"You enrolled new course  The Complete Digital finance Marketing Course\"}', '2020-12-21 06:09:59', '2020-12-21 06:09:59'),
(6, 5, 0, '{\"body\":\"The Complete Digital finance Marketing Course this course enrolled by natok\"}', '2020-12-21 06:09:59', '2020-12-21 06:09:59'),
(7, 19, 0, '{\"body\":\"You enrolled new course  Learn Photography\"}', '2020-12-21 06:10:00', '2020-12-21 06:10:00'),
(8, 5, 0, '{\"body\":\"Learn Photography this course enrolled by natok\"}', '2020-12-21 06:10:00', '2020-12-21 06:10:00'),
(9, 19, 0, '{\"body\":\"You enrolled new course  Advance Wordpress\"}', '2020-12-21 06:10:00', '2020-12-21 06:10:00'),
(10, 5, 0, '{\"body\":\"Advance Wordpress this course enrolled by natok\"}', '2020-12-21 06:10:00', '2020-12-21 06:10:00'),
(11, 21, 0, '{\"body\":\"Flutter & Dart - The Complete Guide new course uploaded by rumon\"}', '2020-12-21 06:45:29', '2020-12-21 06:45:29'),
(12, 21, 0, '{\"body\":\"The Complete Android N Developer Course new course uploaded by rumon\"}', '2020-12-21 06:52:47', '2020-12-21 06:52:47'),
(13, 19, 0, '{\"body\":\"You enrolled new course  The Complete Android N Developer Course\"}', '2020-12-21 06:57:51', '2020-12-21 06:57:51'),
(14, 21, 0, '{\"body\":\"The Complete Android N Developer Course this course enrolled by natok\"}', '2020-12-21 06:57:51', '2020-12-21 06:57:51'),
(15, 19, 0, '{\"body\":\"You enrolled new course  Flutter & Dart - The Complete Guide\"}', '2020-12-21 06:57:52', '2020-12-21 06:57:52'),
(16, 21, 0, '{\"body\":\"Flutter & Dart - The Complete Guide this course enrolled by natok\"}', '2020-12-21 06:57:52', '2020-12-21 06:57:52'),
(17, 21, 0, '{\"body\":\"rumon profile updated \"}', '2020-12-21 07:11:55', '2020-12-21 07:11:55'),
(18, 22, 0, '{\"body\":\"prince profile updated \"}', '2020-12-21 07:13:57', '2020-12-21 07:13:57'),
(19, 5, 0, '{\"body\":\"instructor1@mail.com profile updated \"}', '2020-12-21 07:15:45', '2020-12-21 07:15:45'),
(20, 23, 0, '{\"body\":\"Azharul Islam Naeem profile updated \"}', '2020-12-21 07:35:28', '2020-12-21 07:35:28'),
(21, 21, 0, '{\"body\":\"rumon profile updated \"}', '2020-12-21 08:06:24', '2020-12-21 08:06:24'),
(22, 19, 0, '{\"body\":\"You enrolled new course  Python for Beginners - Basics to Advanced Python\"}', '2020-12-21 10:18:00', '2020-12-21 10:18:00'),
(23, 5, 0, '{\"body\":\"Python for Beginners - Basics to Advanced Python this course enrolled by natok\"}', '2020-12-21 10:18:00', '2020-12-21 10:18:00'),
(24, 19, 0, '{\"body\":\"You enrolled package\"}', '2020-12-21 10:23:10', '2020-12-21 10:23:10'),
(25, 19, 0, '{\"body\":\" this Package enrolled by natok\"}', '2020-12-21 10:23:10', '2020-12-21 10:23:10');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_access_tokens`
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
-- Структура таблицы `oauth_auth_codes`
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
-- Структура таблицы `oauth_clients`
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
-- Структура таблицы `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `packages`
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
-- Дамп данных таблицы `packages`
--

INSERT INTO `packages` (`id`, `image`, `price`, `commission`, `is_published`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'uploads/package/x1t7704KOJG6WYqqcMghQ5d0eIS3osh7MfJq6QvJ.jpeg', 0, 0, 1, NULL, '2020-06-09 09:49:18', '2020-06-10 14:02:54'),
(2, 'uploads/package/S5YUUuMRd7BLRP11SmhllvrgGaBoIwfImDS2VtcM.jpeg', 10, 20, 1, NULL, '2020-06-09 09:49:35', '2020-06-10 14:02:39'),
(3, 'uploads/package/aCRKkSZnF3IPWSsNMZ7eL1ZSePOmxdll0Gj7dqv1.jpeg', 30, 5, 1, NULL, '2020-06-10 01:55:32', '2020-06-10 14:02:31');

-- --------------------------------------------------------

--
-- Структура таблицы `package_purchase_histories`
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

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
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
-- Структура таблицы `page_contents`
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
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
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
-- Структура таблицы `personal_access_tokens`
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
-- Структура таблицы `post_replies`
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
-- Структура таблицы `questions`
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
-- Структура таблицы `quizzes`
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
-- Структура таблицы `quiz_scores`
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
-- Структура таблицы `seen_contents`
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
-- Структура таблицы `sliders`
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
-- Дамп данных таблицы `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `sub_title`, `url`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'uploads/slider/A1M6f36uzdGHw6VUPWUk1ti9IFtiykT8ZQtqIRQ9.jpeg', 'Course LMS, best online learning platform', 'Find your course and start learning', NULL, 1, NULL, '2020-06-10 13:55:53');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
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

-- --------------------------------------------------------

--
-- Структура таблицы `student_accounts`
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
-- Структура таблицы `subscriptions`
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

-- --------------------------------------------------------

--
-- Структура таблицы `support_tickets`
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
-- Структура таблицы `support_ticket_replays`
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
-- Структура таблицы `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `system_settings`
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
-- Структура таблицы `themes`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `name`, `slug`, `version`, `activated`, `image`, `created_at`, `updated_at`) VALUES
(1, 'frontend', 'frontend', '1.0', 1, 'default_banner.jpg', '2021-04-04 13:55:29', '2021-04-04 13:55:29');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
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
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `slug`, `email`, `user_type`, `email_verified_at`, `verified`, `password`, `banned`, `provider_id`, `image`, `remember_token`, `created_at`, `updated_at`, `zoom_email`, `jwt_token`) VALUES
(1, 'Sylvia H Alarcon', 'sylvia-h-alarcon', 'admin@gmail.com', 'Admin', NULL, 1, '$2y$10$tAqHlGoZ/NKmCa9aC0VP1ekPIwepG3UVsjbEpmdNxuvlfhV4Dcoxa', 0, NULL, 'uploads/user/user.png', 'H1uB9ePpbmcKWBJDIvWtLYjfP75YIxuztEXWdpWLXckp9dUu708UGvoP2E1B', '2021-04-04 13:46:38', '2021-04-04 13:46:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `verify_users`
--

CREATE TABLE `verify_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `wishlists`
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
-- Структура таблицы `zooms`
--

CREATE TABLE `zooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `admin_earnings`
--
ALTER TABLE `admin_earnings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `affiliate_histories`
--
ALTER TABLE `affiliate_histories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `affiliate_payments`
--
ALTER TABLE `affiliate_payments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `api_password_resets`
--
ALTER TABLE `api_password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_password_resets_email_index` (`email`);

--
-- Индексы таблицы `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_course_id_foreign` (`course_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `certificate_stores`
--
ALTER TABLE `certificate_stores`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_course_id_foreign` (`course_id`);

--
-- Индексы таблицы `class_contents`
--
ALTER TABLE `class_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_contents_class_id_foreign` (`class_id`);

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_slug_unique` (`slug`),
  ADD KEY `courses_user_id_foreign` (`user_id`),
  ADD KEY `courses_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `course_comments`
--
ALTER TABLE `course_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_comments_course_id_foreign` (`course_id`),
  ADD KEY `course_comments_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `course_purchase_histories`
--
ALTER TABLE `course_purchase_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_purchase_histories_enrollment_id_foreign` (`enrollment_id`);

--
-- Индексы таблицы `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`),
  ADD KEY `enrollments_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forum_post_views`
--
ALTER TABLE `forum_post_views`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `helpful_answers`
--
ALTER TABLE `helpful_answers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `instructors_email_unique` (`email`),
  ADD KEY `instructors_package_id_foreign` (`package_id`),
  ADD KEY `instructors_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `instructor_accounts`
--
ALTER TABLE `instructor_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_accounts_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `instructor_earnings`
--
ALTER TABLE `instructor_earnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_earnings_enrollment_id_foreign` (`enrollment_id`),
  ADD KEY `instructor_earnings_package_id_foreign` (`package_id`),
  ADD KEY `instructor_earnings_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `instructor_subscription_earnings`
--
ALTER TABLE `instructor_subscription_earnings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Индексы таблицы `know_abouts`
--
ALTER TABLE `know_abouts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `laravel_logger_activity`
--
ALTER TABLE `laravel_logger_activity`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `massages`
--
ALTER TABLE `massages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `massages_enroll_id_foreign` (`enroll_id`),
  ADD KEY `massages_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `media_managers`
--
ALTER TABLE `media_managers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notification_users`
--
ALTER TABLE `notification_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_users_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `package_purchase_histories`
--
ALTER TABLE `package_purchase_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_purchase_histories_user_id_foreign` (`user_id`),
  ADD KEY `package_purchase_histories_package_id_foreign` (`package_id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_contents_page_id_foreign` (`page_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_account_id_foreign` (`account_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `post_replies`
--
ALTER TABLE `post_replies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `quiz_scores`
--
ALTER TABLE `quiz_scores`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `seen_contents`
--
ALTER TABLE `seen_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seen_contents_enroll_id_foreign` (`enroll_id`),
  ADD KEY `seen_contents_course_id_foreign` (`course_id`),
  ADD KEY `seen_contents_class_id_foreign` (`class_id`),
  ADD KEY `seen_contents_content_id_foreign` (`content_id`),
  ADD KEY `seen_contents_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `student_accounts`
--
ALTER TABLE `student_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_tickets_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `support_ticket_replays`
--
ALTER TABLE `support_ticket_replays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_ticket_replays_ticket_id_foreign` (`ticket_id`),
  ADD KEY `support_ticket_replays_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `verify_users`
--
ALTER TABLE `verify_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_course_id_foreign` (`course_id`);

--
-- Индексы таблицы `zooms`
--
ALTER TABLE `zooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `addons`
--
ALTER TABLE `addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `admin_earnings`
--
ALTER TABLE `admin_earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `affiliate_histories`
--
ALTER TABLE `affiliate_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `affiliate_payments`
--
ALTER TABLE `affiliate_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `api_password_resets`
--
ALTER TABLE `api_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `certificate_stores`
--
ALTER TABLE `certificate_stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `class_contents`
--
ALTER TABLE `class_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `course_comments`
--
ALTER TABLE `course_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `course_purchase_histories`
--
ALTER TABLE `course_purchase_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `forums`
--
ALTER TABLE `forums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `forum_post_views`
--
ALTER TABLE `forum_post_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `helpful_answers`
--
ALTER TABLE `helpful_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `instructor_accounts`
--
ALTER TABLE `instructor_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `instructor_earnings`
--
ALTER TABLE `instructor_earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `instructor_subscription_earnings`
--
ALTER TABLE `instructor_subscription_earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `know_abouts`
--
ALTER TABLE `know_abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `laravel_logger_activity`
--
ALTER TABLE `laravel_logger_activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT для таблицы `massages`
--
ALTER TABLE `massages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `media_managers`
--
ALTER TABLE `media_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT для таблицы `notification_users`
--
ALTER TABLE `notification_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `package_purchase_histories`
--
ALTER TABLE `package_purchase_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `post_replies`
--
ALTER TABLE `post_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `quiz_scores`
--
ALTER TABLE `quiz_scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `seen_contents`
--
ALTER TABLE `seen_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `student_accounts`
--
ALTER TABLE `student_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `support_ticket_replays`
--
ALTER TABLE `support_ticket_replays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `verify_users`
--
ALTER TABLE `verify_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `zooms`
--
ALTER TABLE `zooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `class_contents`
--
ALTER TABLE `class_contents`
  ADD CONSTRAINT `class_contents_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `course_comments`
--
ALTER TABLE `course_comments`
  ADD CONSTRAINT `course_comments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
