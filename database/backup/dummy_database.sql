-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2025 at 09:46 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET foreign_key_checks = 0;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `global_wsus_abc`
--

-- --------------------------------------------------------

--
-- Table structure for table `abcs_settings`
--

DROP TABLE IF EXISTS `abcs_settings`;
CREATE TABLE IF NOT EXISTS `abcs_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `maintenance_mode` int NOT NULL DEFAULT '0',
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_subscription_notify` int NOT NULL DEFAULT '1',
  `enable_save_contact_message` int NOT NULL DEFAULT '1',
  `text_direction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LTR',
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_lg_header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_sm_header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topbar_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topbar_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_rate` double NOT NULL DEFAULT '1',
  `theme_one` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter_bg_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_as_a_provider_banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_join_as_provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home3_join_as_provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_as_a_provider_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_as_a_provider_btn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_short_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_full_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `google_playstore_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_store_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_app_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home3_app_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscriber_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscriber_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscriber_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subscription_bg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_subscription_bg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home3_subscription_bg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_page_subscription_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_contact_foreground` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_contact_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_contact_call_as` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_contact_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_contact_available` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_contact_form_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_contact_form_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `how_it_work_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `how_it_work_foreground` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `how_it_work_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `how_it_work_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `how_it_work_items` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `selected_theme` int NOT NULL DEFAULT '0',
  `theme_one_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_two_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_three_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `show_provider_contact_info` int DEFAULT '1',
  `currency_position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'before_price',
  `commission_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'commission',
  `live_chat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enable',
  `app_version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Version : 3.0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abcs_settings`
--

INSERT INTO `abcs_settings` (`id`, `maintenance_mode`, `logo`, `favicon`, `contact_email`, `enable_subscription_notify`, `enable_save_contact_message`, `text_direction`, `timezone`, `sidebar_lg_header`, `sidebar_sm_header`, `topbar_phone`, `topbar_email`, `opening_time`, `currency_name`, `currency_icon`, `currency_rate`, `theme_one`, `counter_bg_image`, `join_as_a_provider_banner`, `home2_join_as_provider`, `home3_join_as_provider`, `join_as_a_provider_title`, `join_as_a_provider_btn`, `app_short_title`, `app_full_title`, `app_description`, `google_playstore_link`, `app_store_link`, `app_image`, `home2_app_image`, `home3_app_image`, `subscriber_image`, `subscriber_title`, `subscriber_description`, `subscription_bg`, `home2_subscription_bg`, `home3_subscription_bg`, `blog_page_subscription_image`, `default_avatar`, `home2_contact_foreground`, `home2_contact_background`, `home2_contact_call_as`, `home2_contact_phone`, `home2_contact_available`, `home2_contact_form_title`, `home2_contact_form_description`, `how_it_work_background`, `how_it_work_foreground`, `how_it_work_title`, `how_it_work_description`, `how_it_work_items`, `selected_theme`, `theme_one_color`, `theme_two_color`, `theme_three_color`, `login_image`, `footer_logo`, `created_at`, `updated_at`, `show_provider_contact_info`, `currency_position`, `commission_type`, `live_chat`, `app_version`) VALUES
(1, 1, 'uploads/website-images/logo-2022-09-07-04-23-36-4331.webp', 'uploads/website-images/favicon-2022-09-07-04-23-36-1566.webp', 'contact@gmail.com', 1, 1, 'ltr', 'America/Los_Angeles', 'Aabcserv', 'AS', '+1347-430-9510', 'websolutionus1@gmail.com', '10.00 AM-7.00PM', 'USD', '$', 85.76, '#009bc2', 'uploads/website-images/counter-bg--2022-09-29-12-43-47-5215.webp', 'uploads/website-images/join-provider-bg--2022-12-03-06-07-16-1842.webp', 'uploads/website-images/join-provider-home2bg--2022-10-04-10-15-33-5535.webp', 'uploads/website-images/join-provider-home2bg--2022-12-03-06-07-18-5741.webp', 'Join with us to Sale your service & growth your Experience', 'Provider Joining', 'Download Now', 'App is available for free on Google Play & App Store', 'Get the latest resources for downloading, installing, and updating mosto app.Select your device platform & Use Our app and Enjoy Your Life.', 'https://play.google.com/store/apps/', 'https://www.apple.com/app-store/', 'uploads/website-images/mobile-app-bg--2022-08-29-01-17-54-3596.webp', 'uploads/website-images/mobile-app-bg--2022-09-22-11-27-36-1745.webp', 'uploads/website-images/mobile-app-bg--2022-09-22-11-27-52-2026.webp', 'uploads/website-images/sub-foreground--2022-09-08-10-47-16-9543.webp', 'সাবস্ক্রাইভ নাও', 'Get the updates, offers, tips and enhance your page building experience', 'uploads/website-images/sub-background-2022-09-08-10-47-05-7260.webp', 'uploads/website-images/sub-background-2022-09-22-11-42-07-6877.webp', 'uploads/website-images/sub-background-2022-09-22-11-41-47-4054.webp', 'uploads/website-images/blog-sub-background-2022-09-14-04-20-56-9366.webp', 'uploads/website-images/default-avatar-2022-12-25-04-17-13-8891.webp', 'uploads/website-images/home2-contact-foreground--2022-12-03-06-08-24-3082.webp', 'uploads/website-images/home2-contact-background-2022-09-22-12-08-16-6090.webp', 'Call as now', '+90 456 789 251', 'We are available 24/7', 'Do you have any question ?', 'Fill the form now & Request an Estimate', 'uploads/website-images/home3-hiw-background-2022-09-22-12-52-40-5965.webp', 'uploads/website-images/home3-hiw-foreground--2022-09-29-01-06-00-1394.webp', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '[{\"title\":\"Select The Service\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Pick Your Schedule\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Place Your Booking & Relax\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"}]', 0, '#378fff', '#00bf8c', '#2251f2', 'uploads/website-images/login-page-2022-11-06-04-12-11-6638.webp', 'uploads/website-images/logo-2022-11-06-04-53-35-7489.webp', NULL, '2024-12-31 01:59:54', 1, 'before_price', 'subscription', 'enable', 'Version : 3.0');

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

DROP TABLE IF EXISTS `about_us`;
CREATE TABLE IF NOT EXISTS `about_us` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` tinyint DEFAULT NULL,
  `foreground_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `small_image_one` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `small_image_two` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `small_image_three` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_rating` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_choose_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_choose_foreground` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `status`, `foreground_image`, `background_image`, `small_image_one`, `small_image_two`, `small_image_three`, `total_rating`, `why_choose_background`, `why_choose_foreground`, `created_at`, `updated_at`) VALUES
(1, NULL, 'uploads/website-images/about-us-foreground-2022-08-28-01-05-24-9243.webp', 'uploads/website-images/about-us-bg-2022-08-28-01-05-24-2606.webp', 'uploads/website-images/about-us-client-one-2022-08-28-01-13-54-7019.webp', 'uploads/website-images/about-us-client-one-2022-08-28-01-14-58-9497.webp', 'uploads/website-images/about-us-client-one-2022-08-28-01-14-58-4843.webp', '25k+', 'uploads/website-images/about-us-bg-2022-08-28-01-40-24-9733.webp', 'uploads/website-images/about-us-foreground-2022-08-28-01-40-33-7719.webp', '2022-01-30 06:30:23', '2024-12-04 00:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `about_us_translations`
--

DROP TABLE IF EXISTS `about_us_translations`;
CREATE TABLE IF NOT EXISTS `about_us_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `about_us_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_us_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_us` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `why_choose_us_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_choose_desciption` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title_one` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_one` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title_two` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_two` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title_three` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_three` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us_translations`
--

INSERT INTO `about_us_translations` (`id`, `about_us_id`, `lang_code`, `header`, `header_description`, `about_us_title`, `about_us`, `why_choose_us_title`, `why_choose_desciption`, `title_one`, `description_one`, `title_two`, `description_two`, `title_three`, `description_three`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'How It Works', 'There are many variations of passages of Lorem Ipsum available but the majority', 'Know About Us', '<p style=\"font-size: 16px; font-family: Roboto, sans-serif;\">What sets Websolutionus apart, we believe in our commitment to providing actual value to our consumers. In the business, our dedication and quality are unrivaled. We\'re more than a technology service provider. We care as much about our customer&rsquo;s achievements as we do about our own, therefore we share business risks with them so they may take chances with technological innovations. We provide the following services.</p>\r\n<ul>\r\n<li>Laravel Website Development</li>\r\n<li>Mobile Application Development</li>\r\n<li>WordPress Theme Development</li>\r\n<li>Search Engine Optimization (SEO)</li>\r\n</ul>', 'There Some Reasons to Hire The Proeasy', '<p>We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc. We believe on just in time. We provide all web solutions accordingly and ensure the best service. We rely on new creation and the best management policy. We usually monitor the market and policies.</p>', 'Top-Rated Company', 'We offer low-cost services and cutting-edge technologies to help you improve your application and bring more value to your consumers', 'Superior Quality', 'We assist enterprises to decrease the risk of security events across the SDLC and launch internet solutions with protection.', 'Friendly Provide Services', 'We assist our customers to determine the right way for them and provide business eLearning solutions.', '2025-01-01 22:52:36', '2025-01-01 22:52:36'),
(2, 1, 'bn', 'কিভাবে এটা কাজ করে', 'There are many variations of passages of Lorem Ipsum available but the majority', 'আমাদের সম্পর্কে জানুন', '<p style=\"font-size: 16px; font-family: Roboto, sans-serif;\">What sets Websolutionus apart, we believe in our commitment to providing actual value to our consumers. In the business, our dedication and quality are unrivaled. We\'re more than a technology service provider. We care as much about our customer&rsquo;s achievements as we do about our own, therefore we share business risks with them so they may take chances with technological innovations. We provide the following services.</p>\r\n<ul>\r\n<li>Laravel Website Development</li>\r\n<li>Mobile Application Development</li>\r\n<li>WordPress Theme Development</li>\r\n<li>Search Engine Optimization (SEO)</li>\r\n</ul>', 'Proeasy ভাড়া করার কিছু কারণ আছে', '<p>We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc. We believe on just in time. We provide all web solutions accordingly and ensure the best service. We rely on new creation and the best management policy. We usually monitor the market and policies.</p>', 'Top-Rated Company', 'We offer low-cost services and cutting-edge technologies to help you improve your application and bring more value to your consumers', 'Superior Quality', 'We assist enterprises to decrease the risk of security events across the SDLC and launch internet solutions with protection.', 'Friendly Provide Services', 'We assist our customers to determine the right way for them and provide business eLearning solutions.', '2025-01-01 22:52:36', '2025-01-02 00:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `additional_services`
--

DROP TABLE IF EXISTS `additional_services`;
CREATE TABLE IF NOT EXISTS `additional_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `service_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additional_services`
--

INSERT INTO `additional_services` (`id`, `service_id`, `service_name`, `image`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 'Home Move', 'uploads/custom-images/service-add-2022-10-03-03-12-56-9482.webp', 1, 10, '2022-10-03 03:12:56', '2022-10-03 03:12:56'),
(2, 2, 'Pc Repair', 'uploads/custom-images/service-add-2022-10-03-03-12-56-9074.webp', 1, 5, '2022-10-03 03:12:56', '2022-10-03 03:12:56'),
(3, 3, 'Service One', 'uploads/custom-images/service-add-2022-10-03-03-17-30-6778.webp', 1, 10, '2022-10-03 03:17:30', '2022-10-03 03:17:30'),
(4, 3, 'Service Two', 'uploads/custom-images/service-add-2022-10-03-03-17-30-2641.webp', 1, 8, '2022-10-03 03:17:30', '2022-10-03 03:17:30'),
(5, 3, 'Service Three', 'uploads/custom-images/service-add-2022-10-03-03-17-30-1451.webp', 1, 15, '2022-10-03 03:17:30', '2022-10-03 03:17:30'),
(6, 3, 'Service Four', 'uploads/custom-images/service-add-2022-10-03-03-17-30-5205.webp', 1, 4, '2022-10-03 03:17:30', '2022-10-03 03:17:30'),
(7, 5, 'Extra Service One', 'uploads/custom-images/service-add-2022-10-03-03-28-39-1242.webp', 1, 3, '2022-10-03 03:28:39', '2022-10-03 03:28:39'),
(8, 5, 'Extra Service Two', 'uploads/custom-images/service-add-2022-10-03-03-28-39-5634.webp', 1, 5, '2022-10-03 03:28:39', '2022-10-03 03:28:39'),
(9, 5, 'Extra Service Three', 'uploads/custom-images/service-add-2022-10-03-03-28-39-3764.webp', 1, 4, '2022-10-03 03:28:39', '2022-10-03 03:28:39'),
(10, 6, 'Extra service one', 'uploads/custom-images/service-add-2022-10-03-03-34-32-5974.webp', 1, 7, '2022-10-03 03:34:33', '2022-10-03 03:34:33'),
(11, 6, 'Extra service two', 'uploads/custom-images/service-add-2022-10-03-03-34-33-8795.webp', 1, 5, '2022-10-03 03:34:33', '2022-10-03 03:34:33'),
(12, 6, 'Extra service three', 'uploads/custom-images/service-add-2022-10-03-03-34-33-2395.webp', 1, 6, '2022-10-03 03:34:33', '2022-10-03 03:34:33'),
(13, 7, 'Service One', 'uploads/custom-images/service-add-2022-10-03-03-43-20-1580.webp', 1, 12, '2022-10-03 03:43:20', '2022-10-03 03:43:20'),
(14, 7, 'Service Two', 'uploads/custom-images/service-add-2022-10-03-03-43-20-3644.webp', 1, 20, '2022-10-03 03:43:20', '2022-10-03 03:43:20'),
(15, 7, 'Service Three', 'uploads/custom-images/service-add-2022-10-03-03-43-20-4494.webp', 1, 13, '2022-10-03 03:43:20', '2022-10-03 03:43:20'),
(16, 9, 'Service One', 'uploads/custom-images/service-add-2022-10-03-03-54-30-9396.webp', 1, 20, '2022-10-03 03:54:31', '2022-10-03 03:54:31'),
(17, 9, 'Service Two', 'uploads/custom-images/service-add-2022-10-03-03-54-31-4918.webp', 1, 13, '2022-10-03 03:54:31', '2022-10-03 03:54:31'),
(18, 9, 'Service Three', 'uploads/custom-images/service-add-2022-10-03-03-54-31-7614.webp', 1, 8, '2022-10-03 03:54:31', '2022-10-03 03:54:31'),
(19, 10, 'Service One', 'uploads/custom-images/service-add-2022-10-03-04-03-43-1630.webp', 1, 5, '2022-10-03 04:03:43', '2022-10-03 04:03:43'),
(20, 10, 'Service Two', 'uploads/custom-images/service-add-2022-10-03-04-03-43-9623.webp', 1, 6, '2022-10-03 04:03:44', '2022-10-03 04:03:44'),
(21, 11, 'Service One', 'uploads/custom-images/service-add-2022-10-03-04-08-32-9378.webp', 1, 10, '2022-10-03 04:08:32', '2022-10-03 04:08:32'),
(22, 11, 'Service Two', 'uploads/custom-images/service-add-2022-10-03-04-08-32-1195.webp', 1, 12, '2022-10-03 04:08:33', '2022-10-03 04:08:33'),
(23, 12, 'Service one', 'uploads/custom-images/service-add-2022-10-03-04-11-58-9305.webp', 1, 12, '2022-10-03 04:11:58', '2022-10-03 04:11:58'),
(24, 12, 'Service two', 'uploads/custom-images/service-add-2022-10-03-04-11-58-3485.webp', 1, 16, '2022-10-03 04:11:58', '2022-10-03 04:11:58'),
(25, 12, 'Service three', 'uploads/custom-images/service-add-2022-10-03-04-11-58-2352.webp', 1, 8, '2022-10-03 04:11:58', '2022-10-03 04:11:58'),
(26, 13, 'Service One', 'uploads/custom-images/service-add-2023-05-24-11-34-43-8746.webp', 1, 12, '2022-10-03 04:17:45', '2023-05-24 09:34:43'),
(27, 13, 'Service Two', 'uploads/custom-images/service-add-2023-05-24-11-34-43-9833.webp', 1, 9, '2022-10-03 04:17:46', '2023-05-24 09:34:43'),
(28, 13, 'Service Three', 'uploads/custom-images/service-add-2023-05-24-11-34-43-7445.webp', 1, 3, '2022-10-03 04:17:46', '2023-05-24 09:34:43'),
(29, 21, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-35-47-1935.webp', 1, 5, '2023-01-13 22:35:47', '2023-01-13 22:35:47'),
(30, 21, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-35-47-2424.webp', 1, 7, '2023-01-13 22:35:48', '2023-01-13 22:35:48'),
(31, 20, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-38-21-7962.webp', 1, 10, '2023-01-13 22:38:21', '2023-01-13 22:38:21'),
(32, 20, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-38-22-1651.webp', 1, 8, '2023-01-13 22:38:22', '2023-01-13 22:38:22'),
(33, 20, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-38-22-2896.webp', 1, 14, '2023-01-13 22:38:23', '2023-01-13 22:38:23'),
(34, 19, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-40-07-6132.webp', 1, 12, '2023-01-13 22:40:07', '2023-01-13 22:40:07'),
(35, 19, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-40-07-6399.webp', 1, 14, '2023-01-13 22:40:08', '2023-01-13 22:40:08'),
(36, 19, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-40-08-8105.webp', 1, 5, '2023-01-13 22:40:08', '2023-01-13 22:40:08'),
(37, 18, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-41-22-2543.webp', 1, 3, '2023-01-13 22:41:22', '2023-01-13 22:41:22'),
(38, 18, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-41-22-8164.webp', 1, 2, '2023-01-13 22:41:23', '2023-01-13 22:41:23'),
(39, 18, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-41-23-2513.webp', 1, 5, '2023-01-13 22:41:23', '2023-01-13 22:41:23'),
(40, 17, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-42-45-2192.webp', 1, 10, '2023-01-13 22:42:45', '2023-01-13 22:42:45'),
(41, 17, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-42-45-7669.webp', 1, 5, '2023-01-13 22:42:46', '2023-01-13 22:42:46'),
(42, 17, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-42-46-4320.webp', 1, 6, '2023-01-13 22:42:46', '2023-01-13 22:42:46'),
(43, 16, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-43-40-3193.webp', 1, 2, '2023-01-13 22:43:41', '2023-01-13 22:43:41'),
(44, 16, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-43-41-8190.webp', 1, 3, '2023-01-13 22:43:41', '2023-01-13 22:43:41'),
(45, 16, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-43-41-7647.webp', 1, 8, '2023-01-13 22:43:42', '2023-01-13 22:43:42'),
(46, 15, 'Service One', 'uploads/custom-images/service-add-2023-01-14-10-44-31-5768.webp', 1, 10, '2023-01-13 22:44:31', '2023-01-13 22:44:31'),
(47, 15, 'Service Two', 'uploads/custom-images/service-add-2023-01-14-10-44-31-2276.webp', 1, 5, '2023-01-13 22:44:31', '2023-01-13 22:44:31'),
(48, 15, 'Service Three', 'uploads/custom-images/service-add-2023-01-14-10-44-31-3957.webp', 1, 6, '2023-01-13 22:44:32', '2023-01-13 22:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super_admin` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `forget_password_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_schedules`
--

DROP TABLE IF EXISTS `appointment_schedules`;
CREATE TABLE IF NOT EXISTS `appointment_schedules` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment_schedules`
--

INSERT INTO `appointment_schedules` (`id`, `user_id`, `day`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Sunday', '08:00', '08:20', 1, '2023-01-08 22:57:25', '2023-01-08 22:57:25'),
(2, 2, 'Sunday', '08:20', '08:40', 1, '2023-01-08 22:57:42', '2023-01-08 22:57:42'),
(3, 2, 'Sunday', '08:40', '09:00', 1, '2023-01-08 23:15:41', '2023-01-08 23:15:41'),
(5, 2, 'Sunday', '09:00', '09:20', 1, '2023-01-08 23:49:13', '2023-01-08 23:49:13'),
(6, 2, 'Sunday', '09:20', '09:40', 1, '2023-01-08 23:49:24', '2023-01-08 23:49:24'),
(7, 2, 'Sunday', '09:40', '10:00', 1, '2023-01-08 23:49:40', '2023-01-08 23:49:40'),
(8, 2, 'Sunday', '10:00', '10:20', 1, '2023-01-08 23:55:16', '2023-01-08 23:55:16'),
(9, 2, 'Sunday', '10:20', '10:40', 1, '2023-01-08 23:55:56', '2023-01-08 23:55:56'),
(10, 2, 'Sunday', '10:40', '11:00', 1, '2023-01-08 23:57:47', '2023-01-08 23:57:47'),
(11, 2, 'Sunday', '11:00', '11:20', 1, '2023-01-08 23:57:54', '2023-01-08 23:57:54'),
(12, 2, 'Sunday', '11:20', '11:40', 1, '2023-01-08 23:58:09', '2023-01-08 23:58:09'),
(13, 2, 'Sunday', '11:40', '12:00', 1, '2023-01-08 23:58:19', '2023-01-08 23:58:19'),
(14, 2, 'Sunday', '12:00', '12:20', 1, '2023-01-08 23:59:35', '2023-01-08 23:59:35'),
(15, 2, 'Sunday', '12:20', '12:40', 1, '2023-01-09 00:00:06', '2023-01-09 00:00:06'),
(16, 2, 'Sunday', '12:40', '13:00', 1, '2023-01-09 00:00:54', '2023-01-09 00:01:18'),
(17, 2, 'Sunday', '13:00', '13:30', 1, '2023-01-09 00:01:42', '2023-01-09 00:01:42'),
(18, 2, 'Sunday', '13:30', '14:00', 1, '2023-01-09 00:01:54', '2023-01-09 00:01:54'),
(19, 2, 'Monday', '08:00', '08:20', 1, '2023-01-08 22:57:25', '2023-01-08 22:57:25'),
(20, 2, 'Monday', '08:20', '08:40', 1, '2023-01-08 22:57:42', '2023-01-08 22:57:42'),
(21, 2, 'Monday', '08:40', '09:00', 1, '2023-01-08 23:15:41', '2023-01-08 23:15:41'),
(22, 2, 'Monday', '09:00', '09:20', 1, '2023-01-08 23:49:13', '2023-01-08 23:49:13'),
(23, 2, 'Monday', '09:20', '09:40', 1, '2023-01-08 23:49:24', '2023-01-08 23:49:24'),
(24, 2, 'Monday', '09:40', '10:00', 1, '2023-01-08 23:49:40', '2023-01-08 23:49:40'),
(25, 2, 'Monday', '10:00', '10:20', 1, '2023-01-08 23:55:16', '2023-01-08 23:55:16'),
(26, 2, 'Monday', '10:20', '10:40', 1, '2023-01-08 23:55:56', '2023-01-08 23:55:56'),
(27, 2, 'Monday', '10:40', '11:00', 1, '2023-01-08 23:57:47', '2023-01-08 23:57:47'),
(28, 2, 'Monday', '11:00', '11:20', 1, '2023-01-08 23:57:54', '2023-01-08 23:57:54'),
(29, 2, 'Monday', '11:20', '11:40', 1, '2023-01-08 23:58:09', '2023-01-08 23:58:09'),
(30, 2, 'Monday', '11:40', '12:00', 1, '2023-01-08 23:58:19', '2023-01-08 23:58:19'),
(31, 2, 'Monday', '12:00', '12:20', 1, '2023-01-08 23:59:35', '2023-01-08 23:59:35'),
(32, 2, 'Monday', '12:20', '12:40', 1, '2023-01-09 00:00:06', '2023-01-09 00:00:06'),
(33, 2, 'Monday', '12:40', '13:00', 1, '2023-01-09 00:00:54', '2023-01-09 00:01:18'),
(34, 2, 'Monday', '13:00', '13:30', 1, '2023-01-09 00:01:42', '2023-01-09 00:01:42'),
(35, 2, 'Monday', '13:30', '14:00', 1, '2023-01-09 00:01:54', '2023-01-09 00:01:54'),
(36, 2, 'Tuesday', '08:00', '08:20', 1, '2023-01-08 22:57:25', '2023-01-08 22:57:25'),
(37, 2, 'Tuesday', '08:20', '08:40', 1, '2023-01-08 22:57:42', '2023-01-08 22:57:42'),
(38, 2, 'Tuesday', '08:40', '09:00', 1, '2023-01-08 23:15:41', '2023-01-08 23:15:41'),
(39, 2, 'Tuesday', '09:00', '09:20', 1, '2023-01-08 23:49:13', '2023-01-08 23:49:13'),
(40, 2, 'Tuesday', '09:20', '09:40', 1, '2023-01-08 23:49:24', '2023-01-08 23:49:24'),
(41, 2, 'Tuesday', '09:40', '10:00', 1, '2023-01-08 23:49:40', '2023-01-08 23:49:40'),
(42, 2, 'Tuesday', '10:00', '10:20', 1, '2023-01-08 23:55:16', '2023-01-08 23:55:16'),
(43, 2, 'Tuesday', '10:20', '10:40', 1, '2023-01-08 23:55:56', '2023-01-08 23:55:56'),
(44, 2, 'Tuesday', '10:40', '11:00', 1, '2023-01-08 23:57:47', '2023-01-08 23:57:47'),
(45, 2, 'Tuesday', '11:00', '11:20', 1, '2023-01-08 23:57:54', '2023-01-08 23:57:54'),
(46, 2, 'Tuesday', '11:20', '11:40', 1, '2023-01-08 23:58:09', '2023-01-08 23:58:09'),
(47, 2, 'Tuesday', '11:40', '12:00', 1, '2023-01-08 23:58:19', '2023-01-08 23:58:19'),
(48, 2, 'Tuesday', '12:00', '12:20', 1, '2023-01-08 23:59:35', '2023-01-08 23:59:35'),
(49, 2, 'Tuesday', '12:20', '12:40', 1, '2023-01-09 00:00:06', '2023-01-09 00:00:06'),
(50, 2, 'Tuesday', '12:40', '13:00', 1, '2023-01-09 00:00:54', '2023-01-09 00:01:18'),
(51, 2, 'Tuesday', '13:00', '13:30', 1, '2023-01-09 00:01:42', '2023-01-09 00:01:42'),
(52, 2, 'Tuesday', '13:30', '14:00', 1, '2023-01-09 00:01:54', '2023-01-09 00:01:54'),
(53, 2, 'Wednesday', '08:00', '08:20', 1, '2023-01-08 22:57:25', '2023-01-08 22:57:25'),
(54, 2, 'Wednesday', '08:20', '08:40', 1, '2023-01-08 22:57:42', '2023-01-08 22:57:42'),
(55, 2, 'Wednesday', '08:40', '09:00', 1, '2023-01-08 23:15:41', '2023-01-08 23:15:41'),
(56, 2, 'Wednesday', '09:00', '09:20', 1, '2023-01-08 23:49:13', '2023-01-08 23:49:13'),
(57, 2, 'Wednesday', '09:20', '09:40', 1, '2023-01-08 23:49:24', '2023-01-08 23:49:24'),
(58, 2, 'Wednesday', '09:40', '10:00', 1, '2023-01-08 23:49:40', '2023-01-08 23:49:40'),
(59, 2, 'Wednesday', '10:00', '10:20', 1, '2023-01-08 23:55:16', '2023-01-08 23:55:16'),
(60, 2, 'Wednesday', '10:20', '10:40', 1, '2023-01-08 23:55:56', '2023-01-08 23:55:56'),
(61, 2, 'Wednesday', '10:40', '11:00', 1, '2023-01-08 23:57:47', '2023-01-08 23:57:47'),
(62, 2, 'Wednesday', '11:00', '11:20', 1, '2023-01-08 23:57:54', '2023-01-08 23:57:54'),
(63, 2, 'Wednesday', '11:20', '11:40', 1, '2023-01-08 23:58:09', '2023-01-08 23:58:09'),
(64, 2, 'Wednesday', '11:40', '12:00', 1, '2023-01-08 23:58:19', '2023-01-08 23:58:19'),
(65, 2, 'Wednesday', '12:00', '12:20', 1, '2023-01-08 23:59:35', '2023-01-08 23:59:35'),
(66, 2, 'Wednesday', '12:20', '12:40', 1, '2023-01-09 00:00:06', '2023-01-09 00:00:06'),
(67, 2, 'Wednesday', '12:40', '13:00', 1, '2023-01-09 00:00:54', '2023-01-09 00:01:18'),
(68, 2, 'Wednesday', '13:00', '13:30', 1, '2023-01-09 00:01:42', '2023-01-09 00:01:42'),
(69, 2, 'Wednesday', '13:30', '14:00', 1, '2023-01-09 00:01:54', '2023-01-09 00:01:54'),
(70, 2, 'Thursday', '08:00', '08:20', 1, '2023-01-08 22:57:25', '2023-01-08 22:57:25'),
(71, 2, 'Thursday', '08:20', '08:40', 1, '2023-01-08 22:57:42', '2023-01-08 22:57:42'),
(72, 2, 'Thursday', '08:40', '09:00', 1, '2023-01-08 23:15:41', '2023-01-08 23:15:41'),
(73, 2, 'Thursday', '09:00', '09:20', 1, '2023-01-08 23:49:13', '2023-01-08 23:49:13'),
(74, 2, 'Thursday', '09:20', '09:40', 1, '2023-01-08 23:49:24', '2023-01-08 23:49:24'),
(75, 2, 'Thursday', '09:40', '10:00', 1, '2023-01-08 23:49:40', '2023-01-08 23:49:40'),
(76, 2, 'Thursday', '10:00', '10:20', 1, '2023-01-08 23:55:16', '2023-01-08 23:55:16'),
(77, 2, 'Thursday', '10:20', '10:40', 1, '2023-01-08 23:55:56', '2023-01-08 23:55:56'),
(78, 2, 'Thursday', '10:40', '11:00', 1, '2023-01-08 23:57:47', '2023-01-08 23:57:47'),
(79, 2, 'Thursday', '11:00', '11:20', 1, '2023-01-08 23:57:54', '2023-01-08 23:57:54'),
(80, 2, 'Thursday', '11:20', '11:40', 1, '2023-01-08 23:58:09', '2023-01-08 23:58:09'),
(81, 2, 'Thursday', '11:40', '12:00', 1, '2023-01-08 23:58:19', '2023-01-08 23:58:19'),
(82, 2, 'Thursday', '12:00', '12:20', 1, '2023-01-08 23:59:35', '2023-01-08 23:59:35'),
(83, 2, 'Thursday', '12:20', '12:40', 1, '2023-01-09 00:00:06', '2023-01-09 00:00:06'),
(84, 2, 'Thursday', '12:40', '13:00', 1, '2023-01-09 00:00:54', '2023-01-09 00:01:18'),
(85, 2, 'Thursday', '13:00', '13:30', 1, '2023-01-09 00:01:42', '2023-01-09 00:01:42'),
(86, 2, 'Thursday', '13:30', '14:00', 1, '2023-01-09 00:01:54', '2023-01-09 00:01:54'),
(87, 4, 'Sunday', '08:00', '08:20', 1, '2023-01-08 22:57:25', '2023-01-08 22:57:25'),
(88, 4, 'Sunday', '08:20', '08:40', 1, '2023-01-08 22:57:42', '2023-01-08 22:57:42'),
(89, 4, 'Sunday', '08:40', '09:00', 1, '2023-01-08 23:15:41', '2023-01-08 23:15:41'),
(90, 4, 'Sunday', '09:00', '09:20', 1, '2023-01-08 23:49:13', '2023-01-08 23:49:13'),
(91, 4, 'Sunday', '09:20', '09:40', 1, '2023-01-08 23:49:24', '2023-01-08 23:49:24'),
(92, 4, 'Sunday', '09:40', '10:00', 1, '2023-01-08 23:49:40', '2023-01-08 23:49:40'),
(93, 4, 'Sunday', '10:00', '10:20', 1, '2023-01-08 23:55:16', '2023-01-08 23:55:16'),
(94, 4, 'Sunday', '10:20', '10:40', 1, '2023-01-08 23:55:56', '2023-01-08 23:55:56'),
(95, 4, 'Sunday', '10:40', '11:00', 1, '2023-01-08 23:57:47', '2023-01-08 23:57:47'),
(96, 4, 'Sunday', '11:00', '11:20', 1, '2023-01-08 23:57:54', '2023-01-08 23:57:54'),
(97, 4, 'Sunday', '11:20', '11:40', 1, '2023-01-08 23:58:09', '2023-01-08 23:58:09'),
(98, 4, 'Sunday', '11:40', '12:00', 1, '2023-01-08 23:58:19', '2023-01-08 23:58:19'),
(99, 4, 'Sunday', '12:00', '12:20', 1, '2023-01-08 23:59:35', '2023-01-08 23:59:35'),
(100, 4, 'Sunday', '12:20', '12:40', 1, '2023-01-09 00:00:06', '2023-01-09 00:00:06'),
(101, 4, 'Sunday', '12:40', '13:00', 1, '2023-01-09 00:00:54', '2023-01-09 00:01:18'),
(102, 4, 'Sunday', '13:00', '13:30', 1, '2023-01-09 00:01:42', '2023-01-09 00:01:42'),
(103, 4, 'Sunday', '13:30', '14:00', 1, '2023-01-09 00:01:54', '2023-01-09 00:01:54'),
(104, 4, 'Monday', '08:00', '08:20', 1, '2023-01-08 22:57:25', '2023-01-08 22:57:25'),
(105, 4, 'Monday', '08:20', '08:40', 1, '2023-01-08 22:57:42', '2023-01-08 22:57:42'),
(106, 4, 'Monday', '08:40', '09:00', 1, '2023-01-08 23:15:41', '2023-01-08 23:15:41'),
(107, 4, 'Monday', '09:00', '09:20', 1, '2023-01-08 23:49:13', '2023-01-08 23:49:13'),
(108, 4, 'Monday', '09:20', '09:40', 1, '2023-01-08 23:49:24', '2023-01-08 23:49:24'),
(109, 4, 'Monday', '09:40', '10:00', 1, '2023-01-08 23:49:40', '2023-01-08 23:49:40'),
(110, 4, 'Monday', '10:00', '10:20', 1, '2023-01-08 23:55:16', '2023-01-08 23:55:16'),
(111, 4, 'Monday', '10:20', '10:40', 1, '2023-01-08 23:55:56', '2023-01-08 23:55:56'),
(112, 4, 'Monday', '10:40', '11:00', 1, '2023-01-08 23:57:47', '2023-01-08 23:57:47'),
(113, 4, 'Monday', '11:00', '11:20', 1, '2023-01-08 23:57:54', '2023-01-08 23:57:54'),
(114, 4, 'Monday', '11:20', '11:40', 1, '2023-01-08 23:58:09', '2023-01-08 23:58:09'),
(115, 4, 'Monday', '11:40', '12:00', 1, '2023-01-08 23:58:19', '2023-01-08 23:58:19'),
(116, 4, 'Monday', '12:00', '12:20', 1, '2023-01-08 23:59:35', '2023-01-08 23:59:35'),
(117, 4, 'Monday', '12:20', '12:40', 1, '2023-01-09 00:00:06', '2023-01-09 00:00:06'),
(118, 4, 'Monday', '12:40', '13:00', 1, '2023-01-09 00:00:54', '2023-01-09 00:01:18'),
(119, 4, 'Monday', '13:00', '13:30', 1, '2023-01-09 00:01:42', '2023-01-09 00:01:42'),
(120, 4, 'Monday', '13:30', '14:00', 1, '2023-01-09 00:01:54', '2023-01-09 00:01:54'),
(121, 4, 'Tuesday', '08:00', '08:20', 1, '2023-01-08 22:57:25', '2023-01-08 22:57:25'),
(122, 4, 'Tuesday', '08:20', '08:40', 1, '2023-01-08 22:57:42', '2023-01-08 22:57:42'),
(123, 4, 'Tuesday', '08:40', '09:00', 1, '2023-01-08 23:15:41', '2023-01-08 23:15:41'),
(124, 4, 'Tuesday', '09:00', '09:20', 1, '2023-01-08 23:49:13', '2023-01-08 23:49:13'),
(125, 4, 'Tuesday', '09:20', '09:40', 1, '2023-01-08 23:49:24', '2023-01-08 23:49:24'),
(126, 4, 'Tuesday', '09:40', '10:00', 1, '2023-01-08 23:49:40', '2023-01-08 23:49:40'),
(127, 4, 'Tuesday', '10:00', '10:20', 1, '2023-01-08 23:55:16', '2023-01-08 23:55:16'),
(128, 4, 'Tuesday', '10:20', '10:40', 1, '2023-01-08 23:55:56', '2023-01-08 23:55:56'),
(129, 4, 'Tuesday', '10:40', '11:00', 1, '2023-01-08 23:57:47', '2023-01-08 23:57:47'),
(130, 4, 'Tuesday', '11:00', '11:20', 1, '2023-01-08 23:57:54', '2023-01-08 23:57:54'),
(131, 4, 'Tuesday', '11:20', '11:40', 1, '2023-01-08 23:58:09', '2023-01-08 23:58:09'),
(132, 4, 'Tuesday', '11:40', '12:00', 1, '2023-01-08 23:58:19', '2023-01-08 23:58:19'),
(133, 4, 'Tuesday', '12:00', '12:20', 1, '2023-01-08 23:59:35', '2023-01-08 23:59:35'),
(134, 4, 'Tuesday', '12:20', '12:40', 1, '2023-01-09 00:00:06', '2023-01-09 00:00:06'),
(135, 4, 'Tuesday', '12:40', '13:00', 1, '2023-01-09 00:00:54', '2023-01-09 00:01:18'),
(136, 4, 'Tuesday', '13:00', '13:30', 1, '2023-01-09 00:01:42', '2023-01-09 00:01:42'),
(137, 4, 'Tuesday', '13:30', '14:00', 1, '2023-01-09 00:01:54', '2023-01-09 00:01:54'),
(138, 4, 'Wednesday', '08:00', '08:20', 1, '2023-01-08 22:57:25', '2023-01-08 22:57:25'),
(139, 4, 'Wednesday', '08:20', '08:40', 1, '2023-01-08 22:57:42', '2023-01-08 22:57:42'),
(140, 4, 'Wednesday', '08:40', '09:00', 1, '2023-01-08 23:15:41', '2023-01-08 23:15:41'),
(141, 4, 'Wednesday', '09:00', '09:20', 1, '2023-01-08 23:49:13', '2023-01-08 23:49:13'),
(142, 4, 'Wednesday', '09:20', '09:40', 1, '2023-01-08 23:49:24', '2023-01-08 23:49:24'),
(143, 4, 'Wednesday', '09:40', '10:00', 1, '2023-01-08 23:49:40', '2023-01-08 23:49:40'),
(144, 4, 'Wednesday', '10:00', '10:20', 1, '2023-01-08 23:55:16', '2023-01-08 23:55:16'),
(145, 4, 'Wednesday', '10:20', '10:40', 1, '2023-01-08 23:55:56', '2023-01-08 23:55:56'),
(146, 4, 'Wednesday', '10:40', '11:00', 1, '2023-01-08 23:57:47', '2023-01-08 23:57:47'),
(147, 4, 'Wednesday', '11:00', '11:20', 1, '2023-01-08 23:57:54', '2023-01-08 23:57:54'),
(148, 4, 'Wednesday', '11:20', '11:40', 1, '2023-01-08 23:58:09', '2023-01-08 23:58:09'),
(149, 4, 'Wednesday', '11:40', '12:00', 1, '2023-01-08 23:58:19', '2023-01-08 23:58:19'),
(150, 4, 'Wednesday', '12:00', '12:20', 1, '2023-01-08 23:59:35', '2023-01-08 23:59:35'),
(151, 4, 'Wednesday', '12:20', '12:40', 1, '2023-01-09 00:00:06', '2023-01-09 00:00:06'),
(152, 4, 'Wednesday', '12:40', '13:00', 1, '2023-01-09 00:00:54', '2023-01-09 00:01:18'),
(153, 4, 'Wednesday', '13:00', '13:30', 1, '2023-01-09 00:01:42', '2023-01-09 00:01:42'),
(154, 4, 'Wednesday', '13:30', '14:00', 1, '2023-01-09 00:01:54', '2023-01-09 00:01:54'),
(155, 4, 'Thursday', '08:00', '08:20', 1, '2023-01-08 22:57:25', '2023-01-08 22:57:25'),
(156, 4, 'Thursday', '08:20', '08:40', 1, '2023-01-08 22:57:42', '2023-01-08 22:57:42'),
(157, 4, 'Thursday', '08:40', '09:00', 1, '2023-01-08 23:15:41', '2023-01-08 23:15:41'),
(158, 4, 'Thursday', '09:00', '09:20', 1, '2023-01-08 23:49:13', '2023-01-08 23:49:13'),
(159, 4, 'Thursday', '09:20', '09:40', 1, '2023-01-08 23:49:24', '2023-01-08 23:49:24'),
(160, 4, 'Thursday', '09:40', '10:00', 1, '2023-01-08 23:49:40', '2023-01-08 23:49:40'),
(161, 4, 'Thursday', '10:00', '10:20', 1, '2023-01-08 23:55:16', '2023-01-08 23:55:16'),
(162, 4, 'Thursday', '10:20', '10:40', 1, '2023-01-08 23:55:56', '2023-01-08 23:55:56'),
(163, 4, 'Thursday', '10:40', '11:00', 1, '2023-01-08 23:57:47', '2023-01-08 23:57:47'),
(164, 4, 'Thursday', '11:00', '11:20', 1, '2023-01-08 23:57:54', '2023-01-08 23:57:54'),
(165, 4, 'Thursday', '11:20', '11:40', 1, '2023-01-08 23:58:09', '2023-01-08 23:58:09'),
(166, 4, 'Thursday', '11:40', '12:00', 1, '2023-01-08 23:58:19', '2023-01-08 23:58:19'),
(167, 4, 'Thursday', '12:00', '12:20', 1, '2023-01-08 23:59:35', '2023-01-08 23:59:35'),
(168, 4, 'Thursday', '12:20', '12:40', 1, '2023-01-09 00:00:06', '2023-01-09 00:00:06'),
(169, 4, 'Thursday', '12:40', '13:00', 1, '2023-01-09 00:00:54', '2023-01-09 00:01:18'),
(170, 4, 'Thursday', '13:00', '13:30', 1, '2023-01-09 00:01:42', '2023-01-09 00:01:42'),
(171, 4, 'Thursday', '13:30', '14:00', 1, '2023-01-09 00:01:54', '2023-01-09 00:01:54'),
(172, 26, 'Friday', '4:30 PM', '5:30 PM', 1, '2023-05-21 14:33:48', '2023-05-21 14:34:57'),
(173, 26, 'Saturday', '1:35 PM', '1:50 PM', 1, '2023-05-21 14:35:49', '2023-05-21 14:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `banned_histories`
--

DROP TABLE IF EXISTS `banned_histories`;
CREATE TABLE IF NOT EXISTS `banned_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reasone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banner_images`
--

DROP TABLE IF EXISTS `banner_images`;
CREATE TABLE IF NOT EXISTS `banner_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `header` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_images`
--

INSERT INTO `banner_images` (`id`, `title`, `description`, `link`, `image`, `button_text`, `banner_location`, `status`, `header`, `created_at`, `updated_at`) VALUES
(1, 'Up To - 35% Off', 'Hot Deals', 'product', 'uploads/website-images/Mega-menu-2022-02-13-07-53-14-1062.webp', 'Shop Now', 'Mega Menu Banner', 1, NULL, NULL, '2022-02-13 07:53:14'),
(2, 'Up To -20% Off', 'Hot Deals', 'product', 'uploads/website-images/banner--2022-02-10-10-24-47-2663.webp', 'Shop Now', 'Home Page One Column Banner', 1, NULL, NULL, '2022-02-13 07:45:52'),
(3, 'Up To -35% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-03-42-16-1335.webp', 'Shop Now', 'Home Page First Two Column Banner One', 1, NULL, NULL, '2022-02-13 07:46:01'),
(4, 'Up To -40% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-03-42-16-1434.webp', 'Shop Now', 'Home Page First Two Column Banner Two', 1, NULL, NULL, '2022-02-13 07:46:01'),
(5, 'Up To -28% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-04-18-01-2862.webp', 'Shop Now', 'Home Page Second Two Column Banner one', 1, NULL, NULL, '2022-02-13 07:46:15'),
(6, 'Up To -22% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-06-04-18-01-6995.webp', 'Shop Now', 'Home Page Second Two Column Banner two', 1, NULL, NULL, '2022-02-13 07:46:15'),
(7, 'Up To -35% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-13-04-57-46-4114.webp', 'Shop Now', 'Home Page Third Two Column Banner one', 1, NULL, NULL, '2022-02-13 07:46:27'),
(8, 'Up To -15% Off', 'Hot Deals', 'product', 'uploads/website-images/banner-2022-02-13-04-58-43-7437.webp', 'Shop Now', 'Home Page Third Two Column Banner Two', 1, NULL, NULL, '2022-02-13 07:46:27'),
(9, 'This is Tittle', 'This is Description', 'product', 'uploads/website-images/banner-2022-02-06-04-24-44-6895.webp', 'dd', 'Shopping cart bottom', 1, '', NULL, '2022-02-13 07:47:23'),
(10, 'This is Title', 'This is Description', 'product', 'uploads/website-images/banner-2022-02-06-04-25-59-9719.webp', NULL, 'Shopping cart bottom', 0, NULL, NULL, '2022-02-13 07:47:23'),
(11, 'This is Tittle', 'This is Description', 'product', 'uploads/website-images/banner-2022-02-06-04-26-46-8505.webp', 'dd', 'Campaign page', 1, '', NULL, '2022-02-13 07:47:31'),
(12, 'This is Tittle', 'This is Description', 'product', 'uploads/website-images/banner-2022-01-30-06-21-06-4562.webp', 'dd', 'Campaign page', 0, '', NULL, '2022-02-13 07:47:31'),
(13, 'This is Tittle', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Shop Now', 'uploads/website-images/banner-2022-02-07-10-48-37-9226.webp', 'dd', 'Login page', 0, 'Our Achievement', NULL, '2022-02-06 22:48:39'),
(14, 'Black Friday Sale', 'Up To -70% Off', 'product', 'uploads/website-images/banner-2022-02-06-04-24-02-9777.webp', NULL, 'Product Detail', 1, NULL, NULL, '2022-02-13 07:46:54'),
(15, 'Default Profile Image', NULL, NULL, 'uploads/website-images/default-avatar-2022-02-07-10-10-46-1477.webp', NULL, 'Default Profile Image', 0, NULL, NULL, '2022-02-06 22:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `basic_payments`
--

DROP TABLE IF EXISTS `basic_payments`;
CREATE TABLE IF NOT EXISTS `basic_payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_payments`
--

INSERT INTO `basic_payments` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'stripe_key', 'pk_test_33mdngCLuLsmECXOe8mbde9f00pZGT4uu9', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(2, 'stripe_secret', 'sk_test_MroTZzRZRv2KJ9Hmaro73SE800UOR90Q9u', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(3, 'stripe_currency_id', '1', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(4, 'stripe_status', 'active', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(5, 'stripe_charge', '0', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(6, 'stripe_image', 'website/images/gateways/stripe.webp', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(7, 'paypal_client_id', 'AWlV5x8Lhj9BRF8-TnawXtbNs-zt69mMVXME1BGJUIoDdrAYz8QIeeTBQp0sc2nIL9E529KJZys32Ipy', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(8, 'paypal_secret_key', 'EEvn1J_oIC6alxb-FoF4t8buKwy4uEWHJ4_Jd_wolaSPRMzFHe6GrMrliZAtawDDuE-WKkCKpWGiz0Yn', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(9, 'paypal_account_mode', 'sandbox', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(10, 'paypal_app_id', 'paypal_app_id', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(11, 'paypal_currency_id', '1', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(12, 'paypal_charge', '0', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(13, 'paypal_status', 'active', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(14, 'paypal_image', 'website/images/gateways/paypal.webp', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(15, 'bank_information', 'Bank Name => Your bank name\r\nAccount Number =>  Your bank account number\r\nRouting Number => Your bank routing number\r\nBranch => Your bank branch name', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(16, 'bank_status', 'active', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(17, 'bank_image', 'website/images/gateways/bank.webp', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(18, 'bank_charge', '0', '2024-08-26 02:53:12', '2024-08-26 02:53:12'),
(19, 'bank_currency_id', '1', '2024-08-26 02:53:12', '2024-08-26 02:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_category_id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `show_homepage` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `admin_id`, `title`, `slug`, `blog_category_id`, `image`, `description`, `views`, `seo_title`, `seo_description`, `status`, `show_homepage`, `created_at`, `updated_at`) VALUES
(1, 1, 'Logistics of container smart cargo ship and cargo plane', 'logistics-of-container-cargo-ship-and-cargo-plane', 1, 'uploads/custom-images/blog--2022-09-29-11-23-39-3061.webp', '<p>Lorem ipsum dolor sit amet, nibh saperet te pri, at nam diceret disputationi. Quo an consul impedit, usu possim evertitur dissentiet ei, ridens minimum nominavi et vix. An per mutat adipisci. Ut pericula dissentias sed, est ea modus gloriatur. Aliquip persius has cu, oportere adversarium mei an, justo fabulas in vix.</p><p>Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.</p><p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p><p>Te soleat legendos molestiae cum. Tale sanctus invidunt cu per, quo at modo recteque elaboraret. Ex mazim homero per. Eu nec exerci doctus, cu mei oblique copiosae. Consul diceret usu ne.</p><p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p><p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.<br></p>', 0, 'Logistics of container cargo ship and cargo plane', 'Logistics of container cargo ship and cargo plane', 1, 1, '2022-09-28 23:23:40', '2022-11-06 02:51:04'),
(2, 1, 'Service maintenance repair engine and washing in transport', 'service-maintenance-repair-engine-and-washing-in-transport', 4, 'uploads/custom-images/blog--2022-09-29-11-27-10-7404.webp', '<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p><p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p><p>Usu ad solet diceret, usu at appetere percipit appellantur, te est primis audire gloriatur. Scripta noluisse no mel, vis ne decore ridens labitur. Stet erant saepe eu mea. An mel dolore salutandi abhorreant. An quo aliquip maluisset, mea quaeque indoctum in, pro augue veritus praesent te.</p><p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p><p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.<br></p><p>Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.</p><p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.<br></p>', 0, 'Service maintenance repair engine in transport', 'Service maintenance repair engine in transport', 1, 1, '2022-09-28 23:27:10', '2022-11-06 02:50:30'),
(3, 1, 'Rubber glove cleaning table disinfectant alcohol spray', 'rubber-glove-cleaning-table-disinfectant-alcohol-spray', 3, 'uploads/custom-images/blog--2022-09-29-11-31-38-4858.webp', '<p>Doming aliquid te pro. Mei et quodsi ornatus praesent, summo debet vis eu, dolor soleat nostrud sea eu. Cu altera possim sanctus est. Ea iriure repudiandae per, no eam legendos consectetuer. Mel at justo doming voluptatum. Mel mentitum fabellas deserunt no, et duo amet unum appetere.</p><p>Nec in rebum primis causae. Affert iisque ex pri, vis utinam vivendo definitionem ad, nostrum omnesque per et. Omnium antiopam cotidieque cu sit. Id pri placerat voluptatum, vero dicunt dissentiunt eum et, adhuc iisque vis no. Eu suavitate contentiones definitionem mel, ex vide insolens ocurreret eam. Et dico blandit mea. Sea tollit vidisse mandamus te, qui movet efficiendi ex.</p><p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p><p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p><p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.<br></p>', 0, 'Rubber glove cleaning table disinfectant alcohol spray', 'Rubber glove cleaning table disinfectant alcohol spray', 1, 1, '2022-09-28 23:31:39', '2022-09-28 23:31:39'),
(4, 1, 'Man cutting beard at a shop barber our smart salon', 'man-cutting-beard-at-a-shop-barber-our-smart-salon', 3, 'uploads/custom-images/blog--2022-09-29-11-33-28-5301.webp', '<p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p><p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p><p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque, pro ea fuisset consectetuer. Ex aeterno forensibus has, dicta propriae est ei, ex alterum apeirian quo.</p><p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p><p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p><p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.<br></p>', 0, 'Man cutting beard at a shop barber salon', 'Man cutting beard at a shop barber salon', 1, 1, '2022-09-28 23:33:28', '2022-11-06 02:49:53'),
(5, 1, 'Spry and disinfection of office and home to prevent', 'spry-and-disinfection-of-office-and-home-to-prevent-', 1, 'uploads/custom-images/blog--2022-09-29-11-35-00-7694.webp', '<p>Sint dignissim consectetuer nec et, per ad probatus referrentur, vel cu consequat sententiae. Ad duis fugit dictas mea, et cum stet oratio cetero. Ne pri omittam fastidii. No per harum dicant neglegentur, sea ei esse volumus adolescens. Nulla argumentum at pri, vel apeirian principes in. An dicam dicant consul mea, ne per option appetere argumentum, vim legere senserit et.</p><p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p><p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p><p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p><p>Pri tempor appareat no, eruditi repudiandae vix at. Eos at brute omnesque voluptaria, facer putent intellegam eu pri. Mei debitis ullamcorper eu, at quo idque mundi. Vis in suas porro consequat, nec ad dolor adversarium, ut praesent cotidieque sit. Veniam civibus omittantur duo ut, te his alterum complectitur. Mea omnis oratio impedit ne.</p><p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.<br></p>', 0, 'Spry and disinfection of office to prevent', 'Spry and disinfection of office to prevent', 1, 1, '2022-09-28 23:35:00', '2022-11-06 02:47:24'),
(6, 1, 'Switchboard an a electrical connecting cable.', 'switchboard-an-a-electrical-connecting-cable', 6, 'uploads/custom-images/blog--2022-09-29-11-36-42-4939.webp', '<p>Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt partiendo. No postea numquam ocurreret duo, unum abhorreant cu nam, fugit fastidii percipitur nam id.</p><p>Appetere fabellas ius te. Nonumes splendide deseruisse ea vis, alii velit vel eu. Eos ut scaevola platonem rationibus. Vis natum vivendo sententiae in, ea aperiam apeirian pri, in partem eleifend quo. Pro ex nobis utinam, nam et vidit numquam fastidii, ne per munere adolescens.</p><p>Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur, usu ut quot scripta. Sea te nisl expetenda, ad quo congue argumentum, sit quis simul accusam cu. Usu ei perfecto repudiare tincidunt, ut quas malis erant vim. An mel vidit iudicabit.</p><p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p><p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque,</p><p>Doming aliquid te pro. Mei et quodsi ornatus praesent, summo debet vis eu, dolor soleat nostrud sea eu. Cu altera possim sanctus est. Ea iriure repudiandae per, no eam legendos consectetuer. Mel at justo doming voluptatum. Mel mentitum fabellas deserunt no, et duo amet unum appetere.&nbsp;Doming aliquid te pro. Mei et quodsi ornatus praesent, summo debet vis eu, dolor soleat nostrud sea eu. Cu altera possim sanctus est. Ea iriure repudiandae per, no eam legendos consectetuer.</p>', 0, 'Switchboard an a electrical connecting cable.', 'Switchboard an a electrical connecting cable.', 1, 1, '2022-09-28 23:36:42', '2022-09-28 23:37:48'),
(7, 1, 'Home Move Service From One City to Another City', 'home-move-service-from-one-city-to-another-city', 8, 'uploads/custom-images/blog--2022-09-29-11-47-01-1630.webp', '<p><p>Doming aliquid te pro. Mei et quodsi ornatus praesent, summo debet vis eu, dolor soleat nostrud sea eu. Cu altera possim sanctus est. Ea iriure repudiandae per, no eam legendos consectetuer. Mel at justo doming voluptatum. Mel mentitum fabellas deserunt no, et duo amet unum appetere.</p><p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque, pro ea fuisset consectetuer. Ex aeterno forensibus has, dicta propriae est ei, ex alterum apeirian quo.</p>Meliore inimicus duo ut, tation veritus elaboraret eam cu. Cum in alii agam aliquip, aperiam salutandi et per. Ex vis summo probatus ocurreret, ex assum sententiae pri, blandit sensibus moderatius ei eos. Vix nobis phaedrum neglegentur et.</p><p>Appetere fabellas ius te. Nonumes splendide deseruisse ea vis, alii velit vel eu. Eos ut scaevola platonem rationibus. Vis natum vivendo sententiae in, ea aperiam apeirian pri, in partem eleifend quo. Pro ex nobis utinam, nam et vidit numquam fastidii, ne per munere adolescens.</p><p>Sit vivendum eleifend adipiscing ea. Modus legere suscipiantur an vel, melius patrioque est cu, eum at audire probatus repudiandae. Ei tempor definitiones eam, sea dico omnium ne. Eam ad ubique tincidunt elaboraret, malis aperiri sit et. Ut quo vero inimicus. Sed at munere fuisset noluisse, eleifend senserit an vix.</p><p>Te soleat legendos molestiae cum. Tale sanctus invidunt cu per, quo at modo recteque elaboraret. Ex mazim homero per. Eu nec exerci doctus, cu mei oblique copiosae. Consul diceret usu ne.<br></p>', 0, 'Home Move Service From One City to Another City', 'Home Move Service From One City to Another City', 1, 0, '2022-09-28 23:47:01', '2022-09-28 23:51:17'),
(8, 1, 'Now Get Massage Service with our lovely team', 'now-get-massage-service-from-mr-joe', 5, 'uploads/custom-images/blog--2022-09-29-11-48-32-6544.webp', '<p>Vim et alterum ornatus vivendum, ut mea solum repudiare. His etiam delenit tibique no, ad harum omnes scribentur qui, ne wisi detracto his. Ei movet accusam pri. Ex vel diam quas urbanitas, ne has velit affert habemus. At quis nonumy disputando nec, falli scaevola vel ea. Omittantur concludaturque nam eu, ex est vocent virtute.</p>\r\n<p>Te soleat legendos molestiae cum. Tale sanctus invidunt cu per, quo at modo recteque elaboraret. Ex mazim homero per. Eu nec exerci doctus, cu mei oblique copiosae. Consul diceret usu ne.</p>\r\n<p>Ipsum volumus pertinax mea ut, eu erat tacimates nam. Tibique copiosae verterem mea no, eam ex melius option, soluta timeam et his. Sit simul gubergren reformidans id, amet minimum nominavi eos ea. Et augue dicta vix. Mea ne utamur referrentur.</p>\r\n<p>In vim natum soleat nostro, pri in eloquentiam contentiones. Eu sit sapientem reprehendunt, omnis aliquid eu eos. No quot illum veniam est, ne pro iudico saperet mnesarchum. Ea pri nostro disputando contentiones, eu nec menandri qualisque, vis ex equidem invidunt. Et accusam detracto splendide per, congue meliore id sea. Has eu aeterno patrioque expetendis, mel ei dissentiet reformidans.</p>\r\n<p>Ut qui eligendi urbanitas. Assum periculis te mel, libris quidam te sit. Qui nisl nemore eleifend id, in illud ullum sea. Ut nusquam sapientem comprehensam ius. His molestie complectitur ex.</p>', 0, 'Now Get Massage Service From Mr Joe', 'Now Get Massage Service From Mr Joe', 1, 0, '2022-09-28 23:48:32', '2023-01-18 02:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home Cleaning', 'home-cleaning', 1, '2022-09-28 23:18:01', '2022-09-28 23:18:01'),
(2, 'Painting & Renovation', 'painting-renovation', 1, '2022-09-28 23:20:11', '2022-09-28 23:20:11'),
(3, 'Cleaning & Pest Control', 'cleaning-pest-control', 1, '2022-09-28 23:20:23', '2022-09-28 23:20:23'),
(4, 'Emergency Services', 'emergency-services', 1, '2022-09-28 23:20:34', '2022-09-28 23:20:34'),
(5, 'Car Care Services', 'car-care-services', 1, '2022-09-28 23:20:44', '2022-09-28 23:20:44'),
(6, 'Electric & Plumbing', 'electric-plumbing', 1, '2022-09-28 23:20:52', '2022-09-28 23:20:52'),
(8, 'Home Move', 'home-move', 1, '2022-09-28 23:21:18', '2022-09-28 23:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `name`, `email`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(2, 7, 'David Richard', 'user@gmail.com', 'Id est maiorum volutpat, ad nominavi suscipit suscipiantur vix. Ut ius veri aperiam reprehendunt. Ut per unum sapientem consequuntur', 1, '2022-09-28 23:53:04', '2022-09-28 23:53:13'),
(3, 7, 'John Doe', 'john@gmail.com', 'Appetere fabellas ius te. Nonumes splendide deseruisse ea vis, alii velit vel eu. Eos ut scaevola platonem rationibus. Vis natum vivendo', 1, '2022-09-28 23:53:41', '2022-09-28 23:53:53'),
(4, 8, 'David Richard', 'david@gmail.com', 'Appetere fabellas ius te. Nonumes splendide deseruisse ea vis, alii velit vel eu. Eos ut scaevola platonem rationibus vis natum vivendo.', 1, '2022-09-28 23:54:38', '2022-09-28 23:56:19'),
(5, 8, 'David Simmons', 'simmons@gmail.com', 'Per ex vero nonumy. Ius eu doming nominavi mediocrem, aliquid efficiantur no vim, sanctus admodum mnesarchum ad pro. No sea invidunt', 1, '2022-09-28 23:55:08', '2022-09-28 23:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `breadcrumb_images`
--

DROP TABLE IF EXISTS `breadcrumb_images`;
CREATE TABLE IF NOT EXISTS `breadcrumb_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_type` int NOT NULL DEFAULT '1',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `breadcrumb_images`
--

INSERT INTO `breadcrumb_images` (`id`, `location`, `image_type`, `image`, `created_at`, `updated_at`) VALUES
(1, 'About Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-22-51-8693.webp', NULL, '2022-11-06 04:22:51'),
(2, 'Contact Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-23-12-8618.webp', NULL, '2022-11-06 04:23:12'),
(3, 'Blog Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-23-56-1117.webp', NULL, '2022-11-06 04:23:56'),
(4, 'FAQ Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-24-30-8075.webp', NULL, '2022-11-06 04:24:30'),
(5, 'Terms & Conditions Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-24-43-4592.webp', NULL, '2022-11-06 04:24:43'),
(6, 'Privacy Policy Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-25-00-9412.webp', NULL, '2022-11-06 04:25:00'),
(7, 'Custom Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-25-22-7776.webp', NULL, '2022-11-06 04:25:22'),
(8, 'Service, Booking Page', 1, 'uploads/website-images/banner-us-2022-11-06-04-26-02-1017.webp', NULL, '2022-11-06 04:26:02'),
(9, 'Provider Page', 1, 'uploads/website-images/banner-us-2022-09-15-01-43-35-3681.webp', NULL, '2022-09-15 01:43:35'),
(10, 'Dashboard', 1, 'uploads/website-images/banner-us-2022-11-06-04-27-04-9821.webp', NULL, '2022-11-06 04:27:04'),
(11, 'Login, Register', 1, 'uploads/website-images/banner-us-2022-11-06-04-29-26-8727.webp', NULL, '2022-11-06 04:29:26'),
(12, 'Join as a provider', 1, 'uploads/website-images/banner-us-2022-11-06-04-29-54-1086.webp', NULL, '2022-11-06 04:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `icon`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'painting', 'uploads/custom-images/category-2022-12-04-05-48-57-1083.webp', 'uploads/custom-images/category-2022-09-29-01-25-32-7758.webp', 1, '2022-09-29 01:25:32', '2024-12-16 05:56:15'),
(2, 'cleaning', 'uploads/custom-images/category-2022-12-04-05-49-19-9484.webp', 'uploads/custom-images/category-2022-11-06-01-29-18-4240.webp', 1, '2022-09-29 01:26:46', '2022-12-04 05:49:19'),
(3, 'pest-control', 'uploads/custom-images/category-2022-12-04-05-54-52-6882.webp', 'uploads/custom-images/category-2022-09-29-01-27-41-4934.webp', 1, '2022-09-29 01:27:41', '2022-12-04 05:54:52'),
(4, 'ac-repair', 'uploads/custom-images/category-2022-12-04-05-49-40-7608.webp', 'uploads/custom-images/category-2022-09-29-01-28-59-3308.webp', 1, '2022-09-29 01:28:59', '2022-12-04 05:49:40'),
(5, 'car-services', 'uploads/custom-images/category-2022-12-04-05-49-57-3871.webp', 'uploads/custom-images/category-2022-09-29-01-29-56-4318.webp', 1, '2022-09-29 01:29:56', '2022-12-04 05:49:57'),
(6, 'plumbing', 'uploads/custom-images/category-2022-12-04-05-59-25-1109.webp', 'uploads/custom-images/category-2022-09-29-01-31-49-2090.webp', 1, '2022-09-29 01:31:49', '2022-12-04 05:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

DROP TABLE IF EXISTS `category_translations`;
CREATE TABLE IF NOT EXISTS `category_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `lang_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Painting', '2024-12-16 22:55:22', '2024-12-16 22:55:22'),
(2, 2, 'en', 'Cleaning', '2024-12-16 22:55:22', '2024-12-16 22:55:22'),
(3, 3, 'en', 'Pest Control', '2024-12-16 22:55:22', '2024-12-16 22:55:22'),
(4, 4, 'en', 'AC Repair', '2024-12-16 22:55:22', '2024-12-16 22:55:22'),
(5, 5, 'en', 'Car Services', '2024-12-16 22:55:22', '2024-12-16 22:55:22'),
(6, 6, 'en', 'Plumbing', '2024-12-16 22:55:22', '2024-12-16 22:55:22'),
(7, 1, 'bn', 'পেইন্টিং', '2024-12-16 22:55:22', '2024-12-16 23:13:56'),
(8, 2, 'bn', 'ক্লিনিং', '2024-12-16 22:55:22', '2024-12-16 23:31:27'),
(9, 3, 'bn', 'কীটপতঙ্গ নিয়ন্ত্রণ', '2024-12-16 22:55:22', '2024-12-16 23:31:32'),
(10, 4, 'bn', 'এসি মেরামত', '2024-12-16 22:55:22', '2024-12-16 23:31:37'),
(11, 5, 'bn', 'গাড়ী সেবা', '2024-12-16 22:55:22', '2024-12-16 23:31:42'),
(12, 6, 'bn', 'প্লাম্বিং', '2024-12-16 22:55:22', '2024-12-16 23:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_state_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_state_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Florida City', 'florida-city', 1, '2022-01-30 03:29:19', '2022-02-05 22:18:33'),
(2, 1, 'Los Angeles', 'los-angeles', 1, '2022-01-30 03:29:29', '2022-02-05 22:20:30'),
(4, 2, 'Tallahassee', 'tallahassee', 1, '2022-02-05 22:18:49', '2022-02-05 22:18:49'),
(5, 2, 'Weston', 'weston', 1, '2022-02-05 22:19:56', '2022-02-05 22:19:56'),
(6, 1, 'San Jose', 'san-jose', 1, '2022-02-05 22:21:08', '2022-02-05 22:21:08'),
(7, 1, 'San Diego', 'san-diego', 1, '2022-02-05 22:21:26', '2022-02-05 22:21:26'),
(8, 4, 'Gandhinagar', 'gandhinagar', 1, '2022-02-05 22:22:21', '2022-02-05 22:22:21'),
(9, 5, 'Chandigarh', 'chandigarh', 1, '2022-02-05 22:22:44', '2022-02-05 22:22:44'),
(10, 7, 'London', 'london', 1, '2022-02-05 22:23:12', '2022-02-05 22:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `complete_requests`
--

DROP TABLE IF EXISTS `complete_requests`;
CREATE TABLE IF NOT EXISTS `complete_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL,
  `order_id` int NOT NULL,
  `resone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complete_requests`
--

INSERT INTO `complete_requests` (`id`, `provider_id`, `order_id`, `resone`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 'this is test resone', '2022-11-09 23:38:11', '2022-11-09 23:38:11'),
(2, 2, 9, 'this is test resone', '2022-11-09 23:44:49', '2022-11-09 23:44:49'),
(3, 2, 10, 'Please complete the booking.', '2022-12-20 21:48:10', '2022-12-20 21:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
CREATE TABLE IF NOT EXISTS `configurations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `config` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `config`, `value`, `created_at`, `updated_at`) VALUES
(1, 'setup_stage', '1', '2024-12-03 23:13:51', '2024-12-03 23:14:31'),
(2, 'setup_complete', '0', '2024-12-03 23:13:51', '2024-12-03 23:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(2, 'John Doe', 'user@gmail.com', '123-343-4444', 'Subscribe Verification', 'Feel Free to Get in Touch', '2022-12-20 21:20:18', '2022-12-20 21:20:18'),
(3, 'John Doe', 'user@gmail.com', '123-343-4444', 'Subscribe Verification', 'Feel Free to Get in Touch', '2022-12-20 21:24:38', '2022-12-20 21:24:38'),
(4, 'John Doe', 'agent@gmail.com', '123-343-4444', 'Subscribe Verification', 'Fill the form now & Request an Estimate', '2022-12-20 21:25:12', '2022-12-20 21:25:12'),
(6, 'John Doe', 'user@gmail.com', '123-343-4444', 'Subscribe Verification', 'Do you have any question ?\r\nFill the form now &amp; Request an Estimate', '2023-01-14 23:24:20', '2023-01-14 23:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `contact_pages`
--

DROP TABLE IF EXISTS `contact_pages`;
CREATE TABLE IF NOT EXISTS `contact_pages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supporter_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `off_day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_pages`
--

INSERT INTO `contact_pages` (`id`, `supporter_image`, `support_time`, `off_day`, `email`, `address`, `phone`, `map`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/supporter--2022-08-28-02-04-43-1575.webp', '10.00AM to 07.00PM', 'Friday Off', 'websolutionus1@gmail.com\r\nwebsolutionus@gmail.com', '7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States', '+1347-430-9510\r\n+4247-100-9510', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.681138843672!2d-73.89482218459395!3d40.747041279328165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25f01328248b3%3A0x62300784dd275f96!2s7232%20Broadway%20%23%20308%2C%20Flushing%2C%20NY%2011372%2C%20USA!5e0!3m2!1sen!2sbd!4v1652467683397!5m2!1sen!2sbd\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2022-01-30 06:31:58', '2022-09-29 00:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `cookie_consents`
--

DROP TABLE IF EXISTS `cookie_consents`;
CREATE TABLE IF NOT EXISTS `cookie_consents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '1',
  `border` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `corners` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `border_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_bg_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_text_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `link_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cookie_consents`
--

INSERT INTO `cookie_consents` (`id`, `status`, `border`, `corners`, `background_color`, `text_color`, `border_color`, `btn_bg_color`, `btn_text_color`, `message`, `link_text`, `btn_text`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'thin', 'normal', '#184dec', '#fafafa', '#0a58d6', '#fffceb', '#222758', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the when an unknown printer took.', 'More Info', 'Yes', NULL, NULL, '2022-02-13 02:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

DROP TABLE IF EXISTS `counters`;
CREATE TABLE IF NOT EXISTS `counters` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `icon`, `number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/custom-images/counter--2022-09-29-12-40-42-5094.webp', '2547', 1, '2022-09-29 00:40:42', '2024-12-08 21:56:49'),
(2, 'uploads/custom-images/counter--2022-09-29-12-41-15-9354.webp', '1532', 1, '2022-09-29 00:41:15', '2022-09-29 00:41:15'),
(3, 'uploads/custom-images/counter--2022-09-29-12-41-37-4353.webp', '2103', 1, '2022-09-29 00:41:37', '2022-09-29 00:41:37'),
(4, 'uploads/custom-images/counter--2022-09-29-12-42-06-6458.webp', '25', 1, '2022-09-29 00:42:06', '2022-09-29 00:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `counter_translations`
--

DROP TABLE IF EXISTS `counter_translations`;
CREATE TABLE IF NOT EXISTS `counter_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `counter_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counter_translations`
--

INSERT INTO `counter_translations` (`id`, `counter_id`, `lang_code`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Total Orders', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
(2, 1, 'bn', 'মোট অর্ডার', '2024-12-24 23:16:03', '2025-01-01 00:39:39'),
(3, 2, 'en', 'Active Clients', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
(4, 2, 'bn', 'Active Clients', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
(5, 3, 'en', 'Team Members', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
(6, 3, 'bn', 'Team Members', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
(7, 4, 'en', 'Years of Experience', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
(8, 4, 'bn', 'Years of Experience', '2024-12-24 23:16:03', '2024-12-24 23:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'United State', 'united-state', 1, '2022-01-30 03:28:28', '2022-02-05 22:11:42'),
(2, 'India', 'india', 1, '2022-01-30 03:28:39', '2022-08-30 00:18:46'),
(4, 'United Kindom', 'united-kindom', 1, '2022-02-05 22:11:51', '2022-02-05 22:11:51'),
(5, 'Australia', 'australia', 1, '2022-02-05 22:12:36', '2022-02-05 22:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `country_states`
--

DROP TABLE IF EXISTS `country_states`;
CREATE TABLE IF NOT EXISTS `country_states` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_states`
--

INSERT INTO `country_states` (`id`, `country_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'California', 'california', 1, '2022-01-30 03:29:00', '2022-02-05 22:14:28'),
(2, 1, 'Florida', 'florida', 1, '2022-01-30 03:29:07', '2022-02-05 22:14:42'),
(3, 1, 'Alaska', 'alaska', 1, '2022-02-05 01:49:14', '2022-02-05 22:15:09'),
(4, 2, 'Gujarat', 'gujarat', 1, '2022-02-05 22:16:27', '2022-02-05 22:16:27'),
(5, 2, 'Punjab', 'punjab', 1, '2022-02-05 22:16:39', '2022-02-05 22:16:39'),
(6, 2, 'Rajasthan', 'rajasthan', 1, '2022-02-05 22:16:48', '2022-02-05 22:16:48'),
(7, 4, 'England', 'england', 1, '2022-02-05 22:17:35', '2022-02-05 22:17:35'),
(8, 4, 'Scotland', 'scotland', 1, '2022-02-05 22:17:44', '2022-02-05 22:17:44'),
(9, 4, 'Wales', 'wales', 1, '2022-02-05 22:17:53', '2022-02-05 22:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL DEFAULT '0',
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_percentage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `provider_id`, `coupon_code`, `offer_percentage`, `expired_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 'newyear23', '15', '2023-03-29', 1, '2023-03-08 23:40:26', '2023-03-08 23:50:28'),
(3, 0, 'blackfriday', '25', '2023-03-31', 1, '2023-03-09 00:24:24', '2023-03-09 00:24:24'),
(4, 0, 'startsunday', '20', '2023-03-28', 1, '2023-03-09 00:24:38', '2023-03-09 00:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_histories`
--

DROP TABLE IF EXISTS `coupon_histories`;
CREATE TABLE IF NOT EXISTS `coupon_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_id` int NOT NULL,
  `discount_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_histories`
--

INSERT INTO `coupon_histories` (`id`, `provider_id`, `user_id`, `coupon_code`, `coupon_id`, `discount_amount`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'newyear23', 2, '20', '2023-03-09 00:01:18', NULL),
(2, 0, 1, 'blackfriday', 3, '20', '2023-03-09 00:01:18', NULL),
(3, 2, 1, 'newyear23', 2, '6.3', '2023-03-09 03:06:50', '2023-03-09 03:06:50'),
(4, 2, 1, 'newyear23', 2, '5.1', '2023-03-09 03:13:28', '2023-03-09 03:13:28'),
(5, 0, 1, 'blackfriday', 3, '8.5', '2023-03-09 03:19:31', '2023-03-09 03:19:31'),
(6, 0, 1, 'startsunday', 4, '7.4', '2023-03-09 03:24:22', '2023-03-09 03:24:22'),
(7, 2, 1, 'newyear23', 2, '1.5', '2023-03-09 03:27:37', '2023-03-09 03:27:37'),
(8, 2, 1, 'newyear23', 2, '5.1', '2023-03-09 03:31:14', '2023-03-09 03:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `customizable_page_translations`
--

DROP TABLE IF EXISTS `customizable_page_translations`;
CREATE TABLE IF NOT EXISTS `customizable_page_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customizeable_page_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customizable_page_translations_customizeable_page_id_index` (`customizeable_page_id`),
  KEY `customizable_page_translations_lang_code_index` (`lang_code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customizable_page_translations`
--

INSERT INTO `customizable_page_translations` (`id`, `customizeable_page_id`, `lang_code`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Terms & Conditions', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2024-12-03 23:13:51', '2024-12-03 23:13:51'),
(2, 2, 'en', 'Privacy Policy', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2024-12-03 23:13:51', '2024-12-03 23:13:51'),
(3, 3, 'en', 'Example Page', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2024-12-03 23:13:51', '2024-12-03 23:13:51'),
(4, 1, 'bn', 'Terms & Conditions', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2024-12-14 23:42:41', '2024-12-14 23:42:41'),
(5, 2, 'bn', 'Privacy Policy', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2024-12-14 23:42:41', '2024-12-14 23:42:41'),
(6, 3, 'bn', 'Example Page', '<h3 class=\"title\">Who we are</h3>\n                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>\n                    <h3 class=\"title\">Comments</h3>\n                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown\n                        in the comments form, and also the visitor’s IP address and browser user agent string to\n                        help spam detection.</p>\n                    <p>An anonymized string created from your email address (also called a hash) may be provided\n                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy\n                        is available here: https://automattic.com/privacy/. After approval of your comment, your\n                        profile picture is visible to the public in the context of your comment.</p>\n                    <h3 class=\"title\">Media</h3>\n                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading\n                        images with embedded location data (EXIF GPS) included. Visitors to the website can\n                        download and extract any location data from images on the website.</p>\n                    <h3 class=\"title\">Cookies</h3>\n                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your\n                        name, email address and website in\n                        cookies. These are for your convenience so that you do not have to fill in your details\n                        again when you leave another\n                        comment. These cookies will last for one year.</p>\n                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser\n                        accepts cookies. This cookie\n                        contains no personal data and is discarded when you close your browser.</p>\n                    <p>When you log in, we will also set up several cookies to save your login information and\n                        your screen display choices.\n                        Login cookies last for two days, and screen options cookies last for a year. If you\n                        select \"Remember Me\", your login\n                        will persist for two weeks. If you log out of your account, the login cookies will be\n                        removed.</p>\n                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.\n                        This cookie includes no personal\n                        data and simply indicates the post ID of the article you just edited. It expires after 1\n                        day.</p>\n                    <h3 class=\"title\">Embedded content from other websites</h3>\n                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,\n                        images, articles, etc.). Embedded\n                        content from other websites behaves in the exact same way as if the visitor has visited\n                        the other website.</p>\n                    <p>These websites may collect data about you, use cookies, embed additional third-party\n                        tracking, and monitor your\n                        interaction with that embedded content, including tracking your interaction with the\n                        embedded content if you have an\n                        account and are logged in to that website.</p>\n                    <p>For users that register on our website (if any), we also store the personal information\n                        they provide in their user\n                        profile. All users can see, edit, or delete their personal information at any time\n                        (except they cannot change their\n                        username). Website administrators can also see and edit that information. browser user\n                        agent string to help spam detection.</p>', '2024-12-14 23:42:41', '2024-12-14 23:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `customizeable_pages`
--

DROP TABLE IF EXISTS `customizeable_pages`;
CREATE TABLE IF NOT EXISTS `customizeable_pages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customizeable_pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customizeable_pages`
--

INSERT INTO `customizeable_pages` (`id`, `slug`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(3, 'example', NULL, 1, '2024-12-03 23:13:51', '2024-12-03 23:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `custom_addons`
--

DROP TABLE IF EXISTS `custom_addons`;
CREATE TABLE IF NOT EXISTS `custom_addons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `isPaid` tinyint(1) NOT NULL DEFAULT '1',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `author` json DEFAULT NULL,
  `options` json DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_addons_name_index` (`name`),
  KEY `idx_custom_addons_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_codes`
--

DROP TABLE IF EXISTS `custom_codes`;
CREATE TABLE IF NOT EXISTS `custom_codes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `css` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `header_javascript` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `body_javascript` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `footer_javascript` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_codes`
--

INSERT INTO `custom_codes` (`id`, `css`, `header_javascript`, `body_javascript`, `footer_javascript`, `created_at`, `updated_at`) VALUES
(1, '//write your css code here without the style tag', '//write your javascript here without the script tag', '//write your javascript here without the script tag', '//write your javascript here without the script tag', '2024-12-11 00:13:28', '2024-12-11 00:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `custom_paginations`
--

DROP TABLE IF EXISTS `custom_paginations`;
CREATE TABLE IF NOT EXISTS `custom_paginations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_paginations`
--

INSERT INTO `custom_paginations` (`id`, `page_name`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'Blog Page', 6, NULL, '2022-02-07 02:39:56'),
(2, 'Service Page', 9, NULL, '2022-10-03 04:18:39'),
(3, 'Provider Page', 8, NULL, '2022-02-06 20:14:01'),
(4, 'Blog Comment', 4, NULL, '2022-09-14 21:06:58'),
(5, 'Provider Review', 2, NULL, '2022-09-14 23:01:34'),
(6, 'Language List', 50, '2024-12-15 10:31:57', '2024-12-15 04:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Password Reset', 'Password Reset', '<h4>Dear <b>{{name}}</b>,</h4>\r\n    <p>Do you want to reset your password? Please Click the following link and Reset Your Password.</p>', NULL, '2021-12-09 04:06:57'),
(2, 'Contact Email', 'Contact Email', '<p>Name: <b>{{name}}</b></p><p>\r\n\r\nEmail: <b>{{email}}</b></p><p>\r\n\r\nPhone: <b>{{phone}}</b></p><p><span style=\"background-color: transparent;\">Subject: <b>{{subject}}</b></span></p><p>\r\n\r\nMessage: <b>{{message}}</b></p>', NULL, '2021-12-10 17:44:34'),
(3, 'Subscribe Notification', 'Subscribe Notification', '<h2><b>Hi there</b>,</h2><p>\r\nCongratulations! Your Subscription has been created successfully. Please Click the following link and Verified Your Subscription. If you won\'t approve this link, after 24hourse your subscription will be denay</p>', NULL, '2021-12-10 17:44:53'),
(4, 'User Verification', 'User Verification', '<p>Dear <b>{{user_name}}</b>,\r\n</p><p>Congratulations! Your Account has been created successfully. Please Click the following link and Active your Account.</p>', NULL, '2021-12-10 17:45:25'),
(5, 'Provider Withdraw', 'Provider Withdraw Approval', '<p>Hi <b>{{provider_name}}</b>,</p><p>Your withdraw Request Approval successfully. Please check your account.</p><p>Withdraw Details:</p><p>Withdraw method : <b>{{withdraw_method}}</b>,</p><p>Total Amount :<b> {{total_amount}}</b>,</p><p>Withdraw charge : <b>{{withdraw_charge}}</b>,</p><p>Withdraw&nbsp; Amount : <b>{{withdraw_amount}}</b>,</p><p>Approval Date :<b> {{approval_date}}</b></p>', NULL, '2022-08-29 21:24:53'),
(6, 'Order Successfully', 'Order Successfully', '<p>Hi {{user_name}},</p><p> \r\nThanks for your new order. Your order id has been submited .</p><p>Total Amount : {{total_amount}},</p><p>Payment Method : {{payment_method}},</p><p>Payment Status : {{payment_status}},</p><p>Order Status : {{order_status}},</p><p>Order Date: {{order_date}},</p><p>Order Detail: {{order_detail}}</p>', NULL, '2022-01-10 15:37:03'),
(8, 'New Order Mail to Client', 'New Order Mail to Client', '<p>Hi&nbsp;{{name}}, Thanks for your new order. Your order has been placed.</p><p>Order Id : {{order_id}}</p><p>Amount : {{amount}}</p><p>Schedule Date : {{schedule_date}}</p>', NULL, '2022-09-24 04:15:23'),
(9, 'New Order Mail to Provider', 'New Order Mail to Provider', '<p>Hi&nbsp;{{name}}, A new order has been placed to you .</p><p>Order Id : {{order_id}}</p><p>Amount : {{amount}}</p><p>Schedule Date : {{schedule_date}}</p>', NULL, '2022-09-24 04:16:22'),
(10, 'User Verification For OTP', 'User Verification', '<p>Dear <b>{{user_name}}</b>,\r\n</p><p>Congratulations! Your Account has been created successfully. Please Copy the code and verify your account</p>', NULL, '2021-12-10 17:45:25'),
(11, 'Password Reset For OTP', 'Password Reset', '<h4>Dear <b>{{name}}</b>,</h4>\r\n    <p>Do you want to reset your password? Please copy and past the code</p>', NULL, '2021-12-09 04:06:57'),
(21, 'password_reset', 'Password Reset', '<p>Dear {{user_name}},</p>\n                <p>Do you want to reset your password? Please Click the following link and Reset Your Password.</p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(22, 'contact_mail', 'Contact Email', '<p>Hello there,</p>\n                <p>&nbsp;Mr. {{name}} has sent a new message. you can see the message details below.&nbsp;</p>\n                <p>Email: {{email}}</p>\n                <p>Phone: {{phone}}</p>\n                <p>Subject: {{subject}}</p>\n                <p>Message: {{message}}</p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(23, 'subscribe_notification', 'Subscribe Notification', '<p>Hi there, Congratulations! Your Subscription has been created successfully. Please Click the following link and Verified Your Subscription. If you will not approve this link, you can not get any newsletter from us.</p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(24, 'social_login', 'Social Login', '<p>Hello {{user_name}},</p>\n                <p>Welcome to {{app_name}}! Your account has been created successfully.</p>\n                <p>Your password: {{password}}</p>\n                <p>You can log in to your account at <a href=\"https://websolutionus.com\">https://websolutionus.com</a></p>\n                <p>Thank you for joining us.</p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(25, 'user_verification', 'User Verification', '<p>Dear {{user_name}},</p>\n                <p>Congratulations! Your account has been created successfully. Please click the following link to activate your account.</p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(26, 'approved_withdraw', 'Withdraw Request Approval', '<p>Dear {{user_name}},</p>\n                <p>We are happy to say that, we have send a withdraw amount to your provided bank information.</p>\n                <p>Thanks &amp; Regards</p>\n                <p>WebSolutionUs</p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `error_pages`
--

DROP TABLE IF EXISTS `error_pages`;
CREATE TABLE IF NOT EXISTS `error_pages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `error_pages`
--

INSERT INTO `error_pages` (`id`, `page_name`, `page_number`, `header`, `description`, `button_text`, `created_at`, `updated_at`) VALUES
(1, '404 Error', '404', 'That Page Doesn\'t Exist!', 'Sorry, the page you were looking for could not be found.', 'Go to Home', NULL, '2021-12-12 22:25:14'),
(2, '500 Error', '500', 'That Page Doesn\'t Exist!', 'Sorry, the page you were looking for could not be found.', 'Go to Home', NULL, '2021-12-06 03:46:52'),
(3, '505 Error', '505', 'That Page Doesn\'t Exist!', 'Sorry, the page you were looking for could not be found.', 'Go to Home', NULL, '2021-12-06 03:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_comments`
--

DROP TABLE IF EXISTS `facebook_comments`;
CREATE TABLE IF NOT EXISTS `facebook_comments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_type` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facebook_comments`
--

INSERT INTO `facebook_comments` (`id`, `app_id`, `comment_type`, `created_at`, `updated_at`) VALUES
(1, '882238482112522', 1, NULL, '2022-10-08 01:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_pixels`
--

DROP TABLE IF EXISTS `facebook_pixels`;
CREATE TABLE IF NOT EXISTS `facebook_pixels` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '0',
  `app_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facebook_pixels`
--

INSERT INTO `facebook_pixels` (`id`, `status`, `app_id`, `created_at`, `updated_at`) VALUES
(1, 1, '972911606915059', NULL, '2021-12-13 16:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-09-29 00:04:11', '2022-09-29 00:04:11'),
(2, 1, '2022-09-29 00:05:19', '2022-09-29 00:05:19'),
(3, 1, '2022-09-29 00:05:41', '2022-09-29 00:05:41'),
(4, 1, '2022-09-29 00:06:01', '2022-09-29 00:06:01'),
(5, 1, '2022-09-29 00:06:23', '2022-09-29 00:06:23'),
(6, 1, '2022-09-29 00:06:53', '2022-09-29 00:06:53'),
(7, 1, '2022-09-29 00:07:15', '2022-09-29 00:07:15'),
(8, 1, '2022-09-29 00:08:08', '2022-09-29 00:08:08'),
(9, 1, '2022-09-29 00:09:10', '2022-09-29 00:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `faq_translations`
--

DROP TABLE IF EXISTS `faq_translations`;
CREATE TABLE IF NOT EXISTS `faq_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `faq_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_translations`
--

INSERT INTO `faq_translations` (`id`, `faq_id`, `lang_code`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'What does WebSolutionUs do?', '<p>WebSolutionUs provides the best web solutions (web design, web development, search engine optimization, etc.) for international clients.</p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(2, 2, 'en', 'Do you have an affiliate program?', '<p>We are currently working on our affiliate program setup. Soon it will be released to the public.&nbsp;<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(3, 3, 'en', 'Will I get the complete source code?', '<p>Yes, our source codes are open. If you purchase our product, you will get the complete source code.&nbsp;<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(4, 4, 'en', 'Do you provide customization service?', '<p>Yes, we provide the customization service for a small amount of fee. But it depends. If we become busy with projects, we do not take any custom orders.&nbsp;<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(5, 5, 'en', 'Can I test your product before purchase?', '<p>We currently do not offer this service, but soon we will start this service.<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(6, 6, 'en', 'What do we assist?', '<p>WebSolutionUS is a group of talented application developers that create products for marketplaces like Codecanyon and Themeforest. WebSolutionUS also creates customized websites, software, and applications for a variety of clients and businesses all around the world. WebSolutionUS offers exceptional assistance to ensure a successful business platform. We are envato marketplace approved and provide direct sales also.<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(7, 7, 'en', 'Can I avail the maintenance support for my clients?', '<p>Yes, you may design websites for your clients using our services, including scripting and themes. We like providing attractive and practical design ideas for clients.<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(8, 8, 'en', 'What is the refund policy detail?', '<p>Because you are using the best digital product and service, most of the time &nbsp; refunds will not be necessary, and because no returns will be given for digital items unless the product you bought is probably unnecessary, and you submitted a support request but had no response within one business day, and the product\'s primary statement was completely false. For additional information, please see our Refund Policy.<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(9, 9, 'en', 'How long will I get the service support?', '<p>At the end of the service session, are you puzzled? Okay, you may pay a little amount to renew support at any moment. In the vast majority of circumstances, it is not necessary. We like assisting our customers.<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(10, 1, 'bn', 'What does WebSolutionUs do?', '<p>WebSolutionUs provides the best web solutions (web design, web development, search engine optimization, etc.) for international clients.</p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(11, 2, 'bn', 'Do you have an affiliate program?', '<p>We are currently working on our affiliate program setup. Soon it will be released to the public.&nbsp;<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(12, 3, 'bn', 'Will I get the complete source code?', '<p>Yes, our source codes are open. If you purchase our product, you will get the complete source code.&nbsp;<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(13, 4, 'bn', 'Do you provide customization service?', '<p>Yes, we provide the customization service for a small amount of fee. But it depends. If we become busy with projects, we do not take any custom orders.&nbsp;<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(14, 5, 'bn', 'Can I test your product before purchase?', '<p>We currently do not offer this service, but soon we will start this service.<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(15, 6, 'bn', 'What do we assist?', '<p>WebSolutionUS is a group of talented application developers that create products for marketplaces like Codecanyon and Themeforest. WebSolutionUS also creates customized websites, software, and applications for a variety of clients and businesses all around the world. WebSolutionUS offers exceptional assistance to ensure a successful business platform. We are envato marketplace approved and provide direct sales also.<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(16, 7, 'bn', 'Can I avail the maintenance support for my clients?', '<p>Yes, you may design websites for your clients using our services, including scripting and themes. We like providing attractive and practical design ideas for clients.<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(17, 8, 'bn', 'What is the refund policy detail?', '<p>Because you are using the best digital product and service, most of the time &nbsp; refunds will not be necessary, and because no returns will be given for digital items unless the product you bought is probably unnecessary, and you submitted a support request but had no response within one business day, and the product\'s primary statement was completely false. For additional information, please see our Refund Policy.<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18'),
(18, 9, 'bn', 'How long will I get the service support?', '<p>At the end of the service session, are you puzzled? Okay, you may pay a little amount to renew support at any moment. In the vast majority of circumstances, it is not necessary. We like assisting our customers.<br></p>', '2025-01-05 00:51:18', '2025-01-05 00:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `footers`
--

DROP TABLE IF EXISTS `footers`;
CREATE TABLE IF NOT EXISTS `footers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_us` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `first_column` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_column` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third_column` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footers`
--

INSERT INTO `footers` (`id`, `phone`, `email`, `address`, `about_us`, `first_column`, `second_column`, `third_column`, `copyright`, `payment_image`, `created_at`, `updated_at`) VALUES
(1, '+1347-430-9510', 'websolutionus1@gmail.com', '7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States', 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc.  We rely on new creation and the best management policy. We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', 'Important Link', 'Quick Link', 'Our Service', 'Copyright 2022, Websolutionus. All Rights Reserved.', 'uploads/website-images/payment-card-2022-08-28-04-29-12-1387.webp', NULL, '2022-12-03 04:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `footer_links`
--

DROP TABLE IF EXISTS `footer_links`;
CREATE TABLE IF NOT EXISTS `footer_links` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `column` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_links`
--

INSERT INTO `footer_links` (`id`, `column`, `link`, `title`, `created_at`, `updated_at`) VALUES
(1, '1', 'contact-us', 'Contact Us', '2022-09-29 01:16:42', '2022-09-29 01:16:42'),
(2, '1', 'blogs', 'Our Blog', '2022-09-29 01:17:20', '2022-09-29 01:17:20'),
(3, '1', 'faq', 'FAQ', '2022-09-29 01:18:28', '2022-09-29 01:18:28'),
(4, '1', 'terms-and-conditions', 'Terms and Conditions', '2022-09-29 01:18:45', '2022-09-29 01:18:45'),
(5, '1', 'privacy-policy', 'Privacy Policy', '2022-09-29 01:19:13', '2022-09-29 01:19:13'),
(6, '2', 'services', 'Our Services', '2022-09-29 01:20:17', '2022-09-29 01:20:17'),
(7, '2', 'about-us', 'Why Choose Us', '2022-09-29 01:20:35', '2022-09-29 01:20:35'),
(8, '2', 'dashboard', 'My Profile', '2022-09-29 01:21:12', '2022-09-29 01:21:12'),
(9, '2', 'about-us', 'About Us', '2022-09-29 01:21:39', '2022-09-29 01:21:39'),
(10, '2', 'join-as-a-provider', 'Join as a Provider', '2022-09-29 01:22:37', '2022-09-29 01:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `footer_social_links`
--

DROP TABLE IF EXISTS `footer_social_links`;
CREATE TABLE IF NOT EXISTS `footer_social_links` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_social_links`
--

INSERT INTO `footer_social_links` (`id`, `link`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/', 'fa fa-facebook', '2022-09-29 01:14:50', '2023-01-15 03:22:49'),
(2, 'https://www.twitter.com/', 'fab fa-twitter', '2022-09-29 01:15:06', '2022-09-29 01:15:06'),
(3, 'https://www.instagram.com/', 'fab fa-instagram', '2022-09-29 01:15:27', '2022-09-29 01:15:27'),
(4, 'https://www.linkedin.com/', 'fa fa-linkedin', '2022-09-29 01:15:44', '2023-01-15 03:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `footer_translations`
--

DROP TABLE IF EXISTS `footer_translations`;
CREATE TABLE IF NOT EXISTS `footer_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `footer_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_us` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_translations`
--

INSERT INTO `footer_translations` (`id`, `footer_id`, `lang_code`, `about_us`, `address`, `copyright`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc.  We rely on new creation and the best management policy. We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', '7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States', 'Copyright 2022, Websolutionus. All Rights Reserved.', '2025-01-01 00:52:10', '2025-01-01 00:52:10'),
(2, 1, 'bn', 'আমরা হলাম dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc.  We rely on new creation and the best management policy. We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', '7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States', 'Copyright 2022, Websolutionus. All Rights Reserved.', '2025-01-01 00:52:10', '2025-01-01 03:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `how_it_works`
--

DROP TABLE IF EXISTS `how_it_works`;
CREATE TABLE IF NOT EXISTS `how_it_works` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `how_it_works`
--

INSERT INTO `how_it_works` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'uploads/custom-images/how-it-work-2022-09-29-12-20-12-1071.webp', '2022-09-29 00:20:12', '2022-09-29 00:20:12'),
(2, 'uploads/custom-images/how-it-work-2022-09-29-12-20-54-8399.webp', '2022-09-29 00:20:55', '2022-09-29 00:20:55'),
(3, 'uploads/custom-images/how-it-work-2022-09-29-12-21-46-2428.webp', '2022-09-29 00:21:46', '2022-09-29 00:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `how_it_work_translations`
--

DROP TABLE IF EXISTS `how_it_work_translations`;
CREATE TABLE IF NOT EXISTS `how_it_work_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `how_it_work_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `how_it_work_translations`
--

INSERT INTO `how_it_work_translations` (`id`, `how_it_work_id`, `lang_code`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Online Booking', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:07:24'),
(2, 2, 'en', 'Get Expert Cleaner', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:07:24'),
(3, 3, 'en', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:07:24'),
(4, 1, 'bn', 'অনলাইন বুকিং', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:30:06'),
(5, 2, 'bn', 'Get Expert Cleaner', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:07:24'),
(6, 3, 'bn', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"c098f35f-a13e-4cc1-b1c5-02ba60c88df9\",\"displayName\":\"App\\\\Events\\\\BuyerProviderMessage\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:31:\\\"App\\\\Events\\\\BuyerProviderMessage\\\":2:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:4:\\\"data\\\";a:1:{i:0;a:2:{s:8:\\\"buyer_id\\\";i:2;s:10:\\\"message_id\\\";i:0;}}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1734153762, 1734153762),
(2, 'default', '{\"uuid\":\"72371612-88b0-44ae-9a03-463211fdef0f\",\"displayName\":\"App\\\\Events\\\\BuyerProviderMessage\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:31:\\\"App\\\\Events\\\\BuyerProviderMessage\\\":2:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:4:\\\"data\\\";a:1:{i:0;a:2:{s:8:\\\"buyer_id\\\";i:2;s:10:\\\"message_id\\\";i:0;}}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1734153767, 1734153767);

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

DROP TABLE IF EXISTS `job_posts`;
CREATE TABLE IF NOT EXISTS `job_posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `city_id` int NOT NULL,
  `thumb_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_view` bigint NOT NULL DEFAULT '0',
  `regular_price` decimal(8,2) NOT NULL,
  `is_urgent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disable',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disable',
  `approved_by_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`id`, `user_id`, `category_id`, `city_id`, `thumb_image`, `slug`, `job_type`, `title`, `description`, `address`, `total_view`, `regular_price`, `is_urgent`, `status`, `approved_by_admin`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 13:11:19', '2024-07-07 13:28:56'),
(2, 1, 3, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 13:11:19', '2024-07-07 13:28:56'),
(3, 1, 1, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 13:11:19', '2024-07-07 13:28:56'),
(4, 1, 2, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 13:11:19', '2024-07-07 13:28:56'),
(6, 1, 3, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 13:11:19', '2024-07-07 13:28:56'),
(7, 1, 1, 1, 'uploads/custom-images/jobpost-2024-07-08-01-11-19-9628.webp', 'software-engineer-for-android-development', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You’ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user’s journey. Effectively pitch wireframes to and solutions to stakeholders. You’ll be the greatest advocate forour work, but you’ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users’needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and “can-do” demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', 'Syllet', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-07 13:11:19', '2024-07-07 13:28:56'),
(10, 1, 1, 2, 'uploads/custom-images/jobpost-2024-07-09-11-43-19-9569.webp', 'software-engineer-for-android-development-user1', 'Daily', 'Software engineer for android Development', '<h4 class=\"descripiton-title\">Job Description</h4>\r\n<p class=\"job-description mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n<h4 class=\"descripiton-title\">The Work You&rsquo;ll Do</h4>\r\n<p class=\"mb-4\">Support the Creative Directors and Associate Creative Directors of experience design to concept andoversee the production of bold, innovative, award-winning campaigns and digital experiences. Make strategic and tactical UX decisions related to design and usability as well as features andfunctions. Creates low- and high-fidelity wireframes that represent a user&rsquo;s journey. Effectively pitch wireframes to and solutions to stakeholders. You&rsquo;ll be the greatest advocate forour work, but you&rsquo;ll also listen and internalize feedback that we can come back with creative thatexceeds expectations.</p>\r\n<h4 class=\"descripiton-title\">Qualifications</h4>\r\n<p class=\"mb-4\">At least 5-8 years of experience with UX and UI design. 2 years of experience with design thinking or similar framework that focuses on defining users&rsquo;needs early. Strong portfolio showing expert concept, layout, and typographic skills, as well as creativity andability to adhere to brand standards. Expertise in Figma, Adobe Creative Cloud suite, Microsoft suite. Ability to collaborate well with cross-disciplinary agency team and stakeholders at all levels. Forever learning: Relentless desire to learn and leverage the latest web technologies. Detail-oriented: You must be highly organized, be able to multi-task, and meet tight deadlines. Independence: The ability to make things happen with limited direction. Excellent proactiveattitude, take-charge personality, and &ldquo;can-do&rdquo; demeanor. Proficiency with Front-End UI technologies a bonus but not necessary (such as HTML, CSS,JavaScript).</p>\r\n<p class=\"mb-4\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae our as listl illosl inventore veritatis quasi as our explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, Sed quia consequuntur magni dolores as eosas qui ratione voluptatem. As porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modis tempora incidunt ut laboxre et dolore magnam aliquam a voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis as suscipit laboriosam, nisi ultra a aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatu.</p>', '403/B(2nd Floor), Shahid Baki Road, Malibag Chowdhury Para, Dhaka : 1219, Bangladesh.', 0, 100.00, 'disable', 'enable', 'approved', '2024-07-09 11:43:19', '2024-07-09 13:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `job_post_translations`
--

DROP TABLE IF EXISTS `job_post_translations`;
CREATE TABLE IF NOT EXISTS `job_post_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_post_id` int NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_requests`
--

DROP TABLE IF EXISTS `job_requests`;
CREATE TABLE IF NOT EXISTS `job_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_post_id` int NOT NULL,
  `seller_id` int NOT NULL,
  `user_id` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `resume` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_requests`
--

INSERT INTO `job_requests` (`id`, `job_post_id`, `seller_id`, `user_id`, `description`, `status`, `resume`, `created_at`, `updated_at`) VALUES
(1, 1, 28, 1, 'kjjkljljk', 'approved', 'uploads/resume/pdf_668bb626d6324.pdf', '2024-07-07 14:49:26', '2024-07-07 17:33:23'),
(2, 1, 28, 1, 'kjjkljljk', 'rejected', 'uploads/resume/pdf_668bb626d6324.pdf', '2024-07-07 14:49:26', '2024-07-07 17:33:23'),
(3, 1, 28, 1, 'kjjkljljk', 'rejected', 'uploads/resume/pdf_668bb626d6324.pdf', '2024-07-07 14:49:26', '2024-07-07 17:33:23'),
(4, 1, 28, 1, 'kjjkljljk', 'rejected', 'uploads/resume/pdf_668bb626d6324.pdf', '2024-07-07 14:49:26', '2024-07-07 17:33:23'),
(5, 11, 1, 28, 'pls hired me', 'approved', 'uploads/resume/pdf_668e4a13aef5f.pdf', '2024-07-09 13:45:07', '2024-07-09 13:46:28'),
(6, 12, 2, 1, 'applied', 'approved', 'uploads/resume/pdf_669608cfba009.pdf', '2024-07-15 10:44:47', '2024-07-15 11:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_information`
--

DROP TABLE IF EXISTS `kyc_information`;
CREATE TABLE IF NOT EXISTS `kyc_information` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kyc_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_information`
--

INSERT INTO `kyc_information` (`id`, `kyc_id`, `user_id`, `file`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'uploads/custom-images/document-2024-06-26-02-48-52-2757.webp', 'Pls Approve My KYC Verifaction', 1, '2024-06-25 14:48:52', '2024-06-25 14:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_types`
--

DROP TABLE IF EXISTS `kyc_types`;
CREATE TABLE IF NOT EXISTS `kyc_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_types`
--

INSERT INTO `kyc_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Passport', 1, '2024-06-25 14:46:10', '2024-06-25 14:46:10'),
(2, 'Driving Licience', 1, '2024-06-25 14:47:39', '2024-06-25 14:47:39'),
(3, 'Nid', 1, '2024-06-25 14:47:47', '2024-06-25 14:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `is_default` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_name_unique` (`name`),
  UNIQUE KEY `languages_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `direction`, `status`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'ltr', '1', '1', '2024-12-03 23:13:49', '2024-12-12 00:14:13'),
(2, 'Bangla', 'bn', 'ltr', '1', '0', '2024-12-14 23:42:41', '2024-12-14 23:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `maintainance_texts`
--

DROP TABLE IF EXISTS `maintainance_texts`;
CREATE TABLE IF NOT EXISTS `maintainance_texts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maintainance_texts`
--

INSERT INTO `maintainance_texts` (`id`, `status`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'uploads/website-images/maintainance-mode-2022-08-31-09-12-11-5142.webp', 'We are upgrading our site.  We will come back soon.  \r\nPlease stay with us. \r\nThank yous.', NULL, '2024-12-09 00:01:35');

-- --------------------------------------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping structure for table global_wsus_abc.menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table global_wsus_abc.menus: ~3 rows (approximately)
DELETE FROM `menus`;
INSERT INTO `menus` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Main Menu', 'main-menu', '2024-12-03 23:13:51', '2024-12-03 23:13:51'),
	(2, 'Quick Links', 'quick-link', '2025-03-05 14:22:58', '2025-03-05 14:22:59'),
	(3, 'Important Link', 'important-link', '2025-03-05 14:23:23', '2025-03-05 14:23:24');

-- Dumping structure for table global_wsus_abc.menu_items
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '0',
  `menu_id` bigint unsigned NOT NULL,
  `custom_item` tinyint(1) NOT NULL DEFAULT '0',
  `open_new_tab` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table global_wsus_abc.menu_items: ~22 rows (approximately)
DELETE FROM `menu_items`;
INSERT INTO `menu_items` (`id`, `label`, `link`, `parent_id`, `sort`, `menu_id`, `custom_item`, `open_new_tab`, `created_at`, `updated_at`) VALUES
	(5, 'Pages', '#', 0, 4, 1, 0, 0, '2024-12-03 23:13:51', '2025-01-12 23:46:05'),
	(6, 'Privacy Policy', '/privacy-policy', 5, 5, 1, 0, 0, '2024-12-03 23:13:51', '2025-01-12 23:13:04'),
	(10, 'Home', '/', 0, 1, 1, 0, 0, '2025-01-12 23:09:14', '2025-01-12 23:46:05'),
	(11, 'About Us', '/about-us', 0, 2, 1, 0, 0, '2025-01-12 23:09:32', '2025-01-12 23:46:05'),
	(12, 'Services', '/services', 0, 3, 1, 0, 0, '2025-01-12 23:09:41', '2025-01-12 23:46:05'),
	(13, 'Blog', '/blogs', 0, 5, 1, 0, 0, '2025-01-12 23:09:58', '2025-01-12 23:46:05'),
	(14, 'Contact Us', '/contact-us', 0, 6, 1, 0, 0, '2025-01-12 23:10:07', '2025-01-12 23:46:05'),
	(15, 'Subscription Plan', '/subscription/plan', 5, 1, 1, 0, 0, '2025-01-12 23:10:31', '2025-01-12 23:13:04'),
	(16, 'Job List', '/job-list', 5, 2, 1, 0, 0, '2025-01-12 23:10:54', '2025-01-12 23:13:04'),
	(17, 'FAQ', '/faq', 5, 3, 1, 0, 0, '2025-01-12 23:11:01', '2025-01-12 23:13:04'),
	(18, 'Terms And Conditions', '/terms-and-conditions', 5, 4, 1, 0, 0, '2025-01-12 23:11:21', '2025-01-12 23:13:04'),
	(19, 'Example Page', '/page/example', 5, 6, 1, 0, 0, '2025-01-12 23:12:41', '2025-01-12 23:13:04'),
	(20, 'Contact Us', '/contact-us', 0, 1, 2, 0, 0, '2025-03-05 02:27:32', '2025-03-05 02:29:08'),
	(21, 'Our Blog', '/blogs', 0, 2, 2, 0, 0, '2025-03-05 02:28:02', '2025-03-05 02:29:08'),
	(22, 'FAQ', '/faq', 0, 3, 2, 0, 0, '2025-03-05 02:28:09', '2025-03-05 02:29:08'),
	(23, 'Terms And Conditions', '/terms-and-conditions', 0, 4, 2, 0, 0, '2025-03-05 02:28:22', '2025-03-05 02:29:08'),
	(24, 'Privacy Policy', '/privacy-policy', 0, 5, 2, 0, 0, '2025-03-05 02:28:28', '2025-03-05 02:29:08'),
	(25, 'Our Services', '/services', 0, 1, 3, 0, 0, '2025-03-05 02:29:21', '2025-03-05 02:30:33'),
	(26, 'Why Choose Us', '/about-us', 0, 2, 3, 0, 0, '2025-03-05 02:29:50', '2025-03-05 02:30:33'),
	(27, 'My Profile', '/dashboard', 0, 3, 3, 0, 0, '2025-03-05 02:30:02', '2025-03-05 02:30:33'),
	(28, 'Join as a Provider', '/join-as-a-provider', 0, 4, 3, 0, 0, '2025-03-05 02:30:14', '2025-03-05 02:30:33'),
	(29, 'Job List', '/job-list', 0, 5, 3, 0, 0, '2025-03-05 02:30:29', '2025-03-05 02:30:33');

-- Dumping structure for table global_wsus_abc.menu_item_translations
DROP TABLE IF EXISTS `menu_item_translations`;
CREATE TABLE IF NOT EXISTS `menu_item_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_item_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_item_translations_menu_item_id_foreign` (`menu_item_id`),
  CONSTRAINT `menu_item_translations_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table global_wsus_abc.menu_item_translations: ~44 rows (approximately)
DELETE FROM `menu_item_translations`;
INSERT INTO `menu_item_translations` (`id`, `menu_item_id`, `lang_code`, `label`, `created_at`, `updated_at`) VALUES
	(5, 5, 'en', 'Pages', '2024-12-03 23:13:51', '2024-12-03 23:13:51'),
	(6, 6, 'en', 'Privacy Policy', '2024-12-03 23:13:51', '2024-12-03 23:13:51'),
	(14, 5, 'bn', 'পেইজ', '2024-12-14 23:42:41', '2025-01-12 23:37:51'),
	(15, 6, 'bn', 'Privacy Policy', '2024-12-14 23:42:41', '2024-12-14 23:42:41'),
	(19, 10, 'en', 'Home', '2025-01-12 23:09:14', '2025-01-12 23:09:14'),
	(20, 10, 'bn', 'হোম', '2025-01-12 23:09:14', '2025-01-12 23:37:39'),
	(21, 11, 'en', 'About Us', '2025-01-12 23:09:32', '2025-01-12 23:09:32'),
	(22, 11, 'bn', 'আমাদের সম্পর্কে', '2025-01-12 23:09:32', '2025-01-12 23:38:10'),
	(23, 12, 'en', 'Services', '2025-01-12 23:09:41', '2025-01-12 23:09:41'),
	(24, 12, 'bn', 'সার্ভিসেস', '2025-01-12 23:09:41', '2025-01-12 23:38:16'),
	(25, 13, 'en', 'Blog', '2025-01-12 23:09:58', '2025-01-12 23:09:58'),
	(26, 13, 'bn', 'ব্লগ', '2025-01-12 23:09:58', '2025-01-12 23:38:23'),
	(27, 14, 'en', 'Contact Us', '2025-01-12 23:10:07', '2025-01-12 23:10:07'),
	(28, 14, 'bn', 'যোগাযোগ', '2025-01-12 23:10:07', '2025-01-12 23:38:30'),
	(29, 15, 'en', 'Subscription Plan', '2025-01-12 23:10:31', '2025-01-12 23:10:31'),
	(30, 15, 'bn', 'Subscription Plan', '2025-01-12 23:10:31', '2025-01-12 23:10:31'),
	(31, 16, 'en', 'Job List', '2025-01-12 23:10:54', '2025-01-12 23:10:54'),
	(32, 16, 'bn', 'Job List', '2025-01-12 23:10:54', '2025-01-12 23:10:54'),
	(33, 17, 'en', 'FAQ', '2025-01-12 23:11:01', '2025-01-12 23:11:01'),
	(34, 17, 'bn', 'FAQ', '2025-01-12 23:11:01', '2025-01-12 23:11:01'),
	(35, 18, 'en', 'Terms And Conditions', '2025-01-12 23:11:21', '2025-01-12 23:11:21'),
	(36, 18, 'bn', 'Terms And Conditions', '2025-01-12 23:11:21', '2025-01-12 23:11:21'),
	(37, 19, 'en', 'Example Page', '2025-01-12 23:12:41', '2025-01-12 23:12:41'),
	(38, 19, 'bn', 'Example Page', '2025-01-12 23:12:41', '2025-01-12 23:12:41'),
	(39, 20, 'en', 'Contact Us', '2025-03-05 02:27:32', '2025-03-05 02:27:32'),
	(40, 20, 'bn', 'Contact Us', '2025-03-05 02:27:32', '2025-03-05 02:27:32'),
	(41, 21, 'en', 'Our Blog', '2025-03-05 02:28:02', '2025-03-05 02:28:02'),
	(42, 21, 'bn', 'Our Blog', '2025-03-05 02:28:02', '2025-03-05 02:28:02'),
	(43, 22, 'en', 'FAQ', '2025-03-05 02:28:09', '2025-03-05 02:28:09'),
	(44, 22, 'bn', 'FAQ', '2025-03-05 02:28:09', '2025-03-05 02:28:09'),
	(45, 23, 'en', 'Terms And Conditions', '2025-03-05 02:28:22', '2025-03-05 02:28:22'),
	(46, 23, 'bn', 'Terms And Conditions', '2025-03-05 02:28:22', '2025-03-05 02:28:22'),
	(47, 24, 'en', 'Privacy Policy', '2025-03-05 02:28:28', '2025-03-05 02:28:28'),
	(48, 24, 'bn', 'Privacy Policy', '2025-03-05 02:28:28', '2025-03-05 02:28:28'),
	(49, 25, 'en', 'Our Services', '2025-03-05 02:29:21', '2025-03-05 02:29:21'),
	(50, 25, 'bn', 'Our Services', '2025-03-05 02:29:21', '2025-03-05 02:29:21'),
	(51, 26, 'en', 'Why Choose Us', '2025-03-05 02:29:50', '2025-03-05 02:29:50'),
	(52, 26, 'bn', 'Why Choose Us', '2025-03-05 02:29:50', '2025-03-05 02:29:50'),
	(53, 27, 'en', 'My Profile', '2025-03-05 02:30:02', '2025-03-05 02:30:02'),
	(54, 27, 'bn', 'My Profile', '2025-03-05 02:30:02', '2025-03-05 02:30:02'),
	(55, 28, 'en', 'Join as a Provider', '2025-03-05 02:30:14', '2025-03-05 02:30:14'),
	(56, 28, 'bn', 'Join as a Provider', '2025-03-05 02:30:14', '2025-03-05 02:30:14'),
	(57, 29, 'en', 'Job List', '2025-03-05 02:30:29', '2025-03-05 02:30:29'),
	(58, 29, 'bn', 'Job List', '2025-03-05 02:30:29', '2025-03-05 02:30:29');

-- Dumping structure for table global_wsus_abc.menu_translations
DROP TABLE IF EXISTS `menu_translations`;
CREATE TABLE IF NOT EXISTS `menu_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_translations_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_translations_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table global_wsus_abc.menu_translations: ~6 rows (approximately)
DELETE FROM `menu_translations`;
INSERT INTO `menu_translations` (`id`, `menu_id`, `lang_code`, `name`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', 'Main Menu', '2024-12-03 23:13:51', '2024-12-03 23:13:51'),
	(3, 1, 'bn', 'Main Menu', '2024-12-14 23:42:41', '2024-12-14 23:42:41'),
	(5, 2, 'en', 'Quick Link', '2025-03-05 14:25:47', '2025-03-05 14:25:47'),
	(6, 2, 'bn', 'Quick Link', '2025-03-05 14:25:47', '2025-03-05 14:25:47'),
	(7, 3, 'en', 'Importent Link', '2025-03-05 14:26:47', NULL),
	(8, 3, 'bn', 'Importent Link', '2025-03-05 14:26:47', NULL);

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `buyer_id` int NOT NULL,
  `provider_id` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `buyer_read_msg` int NOT NULL DEFAULT '0',
  `provider_read_msg` int NOT NULL DEFAULT '0',
  `send_by` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `buyer_id`, `provider_id`, `message`, `buyer_read_msg`, `provider_read_msg`, `send_by`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, 1, 0, 'buyer', 19, '2024-07-28 13:30:43', '2024-12-10 23:24:36'),
(2, 1, 4, 'AZxZXZX', 1, 0, 'buyer', 0, '2024-07-28 14:39:11', '2024-12-10 23:24:36'),
(3, 1, 4, 'XzxZX', 1, 0, 'buyer', 0, '2024-07-28 14:39:15', '2024-12-10 23:24:36'),
(4, 2, 2, NULL, 1, 0, 'buyer', 14, '2024-12-13 23:22:42', '2024-12-15 22:45:43'),
(5, 2, 2, 'hello', 1, 0, 'buyer', 0, '2024-12-13 23:22:47', '2024-12-15 22:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `message_documents`
--

DROP TABLE IF EXISTS `message_documents`;
CREATE TABLE IF NOT EXISTS `message_documents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_message_id` int NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_documents`
--

INSERT INTO `message_documents` (`id`, `ticket_message_id`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 6, 'support-file-1664946649.webp', '2022-10-04 23:10:49', '2022-10-04 23:10:49'),
(2, 6, 'support-file-1664946649.webp', '2022-10-04 23:10:49', '2022-10-04 23:10:49'),
(3, 6, 'support-file-1664946649.webp', '2022-10-04 23:10:49', '2022-10-04 23:10:49'),
(4, 26, 'support-file-1664949635.webp', '2022-10-05 00:00:35', '2022-10-05 00:00:35'),
(5, 26, 'support-file-1664949635.webp', '2022-10-05 00:00:35', '2022-10-05 00:00:35'),
(6, 30, 'support-file-1664949755.webp', '2022-10-05 00:02:35', '2022-10-05 00:02:35'),
(7, 30, 'support-file-1664949755.webp', '2022-10-05 00:02:35', '2022-10-05 00:02:35'),
(8, 38, 'support-file-1668053670.webp', '2022-11-09 22:14:30', '2022-11-09 22:14:30'),
(9, 39, 'support-file-1668053722.webp', '2022-11-09 22:15:22', '2022-11-09 22:15:22'),
(10, 66, 'support-file-1711430965.webp', '2024-03-25 10:29:25', '2024-03-25 10:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_12_16_110319_create_category_translations_table', 1),
(2, '2024_12_24_045643_create_section_content_translations_table', 2),
(3, '2024_12_24_131339_create_slider_translations_table', 3),
(4, '2024_12_24_145338_create_mobile_slider_translations_table', 4),
(5, '2024_12_25_045314_create_counter_translations_table', 5),
(6, '2024_12_25_060208_create_testimonial_translations_table', 6),
(8, '2024_12_30_115710_create_setting_translations_table', 7),
(9, '2025_01_01_062357_create_footer_translations_table', 8),
(10, '2025_01_02_043522_create_about_us_translations_table', 9),
(11, '2025_01_02_062421_create_how_it_work_translations_table', 10),
(12, '2025_01_05_041400_create_terms_and_condition_translations_table', 11),
(13, '2025_01_05_063940_create_faq_translations_table', 12),
(14, '2025_01_07_133647_create_provider_payment_gatways_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_sliders`
--

DROP TABLE IF EXISTS `mobile_sliders`;
CREATE TABLE IF NOT EXISTS `mobile_sliders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `serial` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_sliders`
--

INSERT INTO `mobile_sliders` (`id`, `image`, `status`, `serial`, `created_at`, `updated_at`) VALUES
(1, 'uploads/custom-images/mb-slider-2023-02-02-01-17-30-2566.webp', 1, 2, '2023-02-02 00:55:00', '2023-02-02 01:17:30'),
(3, 'uploads/custom-images/mb-slider-2023-02-02-01-17-19-2477.webp', 1, 1, '2023-02-02 01:17:19', '2023-02-02 01:18:26'),
(4, 'uploads/custom-images/mb-slider-2023-02-02-01-18-15-4748.webp', 1, 10, '2023-02-02 01:18:16', '2023-02-02 01:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_slider_translations`
--

DROP TABLE IF EXISTS `mobile_slider_translations`;
CREATE TABLE IF NOT EXISTS `mobile_slider_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile_slider_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_one` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_two` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_slider_translations`
--

INSERT INTO `mobile_slider_translations` (`id`, `mobile_slider_id`, `lang_code`, `title_one`, `title_two`, `created_at`, `updated_at`) VALUES
(1, 3, 'en', 'Digital marketing', 'Title Two', '2024-12-24 10:27:45', '2024-12-24 10:27:45'),
(2, 3, 'bn', 'Digital marketing', 'Title Two', '2024-12-24 10:27:45', '2024-12-24 10:27:45'),
(3, 1, 'en', 'Title One', 'Service', '2024-12-24 10:27:45', '2024-12-24 10:27:45'),
(4, 1, 'bn', 'Title One', 'Service', '2024-12-24 10:27:45', '2024-12-24 10:27:45'),
(5, 4, 'en', 'Wemen\'s Jeans Collection', '35% Offer', '2024-12-24 10:27:45', '2024-12-24 10:27:45'),
(6, 4, 'bn', 'Wemen\'s Jeans Collection', '35% Offer', '2024-12-24 10:27:45', '2024-12-24 10:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `multi_currencies`
--

DROP TABLE IF EXISTS `multi_currencies`;
CREATE TABLE IF NOT EXISTS `multi_currencies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `currency_rate` double(8,2) NOT NULL,
  `currency_position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'before_price',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_currencies`
--

INSERT INTO `multi_currencies` (`id`, `currency_name`, `country_code`, `currency_code`, `currency_icon`, `is_default`, `currency_rate`, `currency_position`, `status`, `created_at`, `updated_at`) VALUES
(1, '$-USD', 'US', 'USD', '$', 'yes', 1.00, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(2, '₦-Naira', 'NG', 'NGN', '₦', 'no', 417.35, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(3, '₹-Rupee', 'IN', 'INR', '₹', 'no', 74.66, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(4, '₱-Peso', 'PH', 'PHP', '₱', 'no', 55.07, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(5, '$-CAD', 'CA', 'CAD', '$', 'no', 1.27, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(6, '৳-Taka', 'BD', 'BDT', '৳', 'no', 80.00, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

DROP TABLE IF EXISTS `news_letters`;
CREATE TABLE IF NOT EXISTS `news_letters` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_verified',
  `verify_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int NOT NULL,
  `provider_id` int NOT NULL DEFAULT '0',
  `service_id` int NOT NULL DEFAULT '0',
  `package_amount` double NOT NULL DEFAULT '0',
  `total_amount` double NOT NULL DEFAULT '0',
  `coupon_discount` double DEFAULT '0',
  `gateway_fee` double(8,2) NOT NULL DEFAULT '0.00',
  `payable_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `payable_amount_without_rate` double(8,2) NOT NULL DEFAULT '0.00',
  `payable_currency` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `booking_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_schedule_id` int NOT NULL DEFAULT '0',
  `schedule_time_slot` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_amount` double NOT NULL DEFAULT '0',
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `refound_status` int NOT NULL DEFAULT '0',
  `payment_refound_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transection_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_approval_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_completed_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_declined_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_features` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `additional_services` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `complete_by_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `client_id`, `provider_id`, `service_id`, `package_amount`, `total_amount`, `coupon_discount`, `gateway_fee`, `payable_amount`, `payable_amount_without_rate`, `payable_currency`, `paid_amount`, `payment_details`, `booking_date`, `appointment_schedule_id`, `schedule_time_slot`, `additional_amount`, `payment_method`, `payment_status`, `refound_status`, `payment_refound_date`, `transection_id`, `order_status`, `order_approval_date`, `order_completed_date`, `order_declined_date`, `package_features`, `additional_services`, `client_address`, `order_note`, `complete_by_admin`, `created_at`, `updated_at`) VALUES
(121, '287042412', 1, 4, 21, 20, 20, 0, 0.00, 20.00, 20.00, 'USD', NULL, NULL, '13-01-2025', 114, '11:20 AM - 11:40 AM', 0, 'stripe', 'pending', 0, NULL, NULL, 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[]', '{\"name\":\"Md Abiruzzaman\",\"email\":\"admin@gmail.com\",\"phone\":\"01787350212\",\"address\":\"Joshar Bazar, Shibpur, Narshindgi\",\"post_code\":\"1200\",\"order_note\":null}', NULL, NULL, '2025-01-09 00:57:16', '2025-01-09 00:57:16'),
(122, '603919495', 1, 4, 20, 15, 25, 0, 0.00, 25.00, 25.00, 'USD', NULL, NULL, '13-01-2025', 117, '12:20 PM - 12:40 PM', 10, 'stripe', 'pending', 0, NULL, NULL, 'awaiting_for_provider_approval', NULL, NULL, NULL, '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', '[{\"service_name\":\"Service One\",\"qty\":\"1\",\"price\":10}]', '{\"name\":\"Md Abiruzzaman\",\"email\":\"admin@gmail.com\",\"phone\":\"01787350212\",\"address\":\"Joshar Bazar, Shibpur, Narshindgi\",\"post_code\":\"1200\",\"order_note\":null}', NULL, NULL, '2025-01-09 02:46:39', '2025-01-09 02:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
CREATE TABLE IF NOT EXISTS `partners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `link`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'https://websolutionus.com/', 'uploads/custom-images/our-partner-2022-09-29-12-53-34-4755.webp', 1, '2022-09-29 00:53:35', '2022-09-29 00:53:35'),
(2, 'https://websolutionus.com/service', 'uploads/custom-images/our-partner-2022-09-29-12-54-08-8857.webp', 1, '2022-09-29 00:54:08', '2022-09-29 00:54:08'),
(3, 'https://codecanyon.net/user/websolutionus/portfolio', 'uploads/custom-images/our-partner-2022-09-29-12-54-34-2602.webp', 1, '2022-09-29 00:54:34', '2022-09-29 00:54:34'),
(4, 'https://www.google.com/', 'uploads/custom-images/-2023-01-15-03-30-10-1839.webp', 1, '2022-09-29 00:54:54', '2023-01-15 03:30:10'),
(5, NULL, 'uploads/custom-images/our-partner-2022-09-29-12-55-08-6101.webp', 1, '2022-09-29 00:55:08', '2022-09-29 00:55:08'),
(6, NULL, 'uploads/custom-images/our-partner-2022-09-29-12-55-25-2540.webp', 1, '2022-09-29 00:55:25', '2022-09-29 00:55:25'),
(7, NULL, 'uploads/custom-images/our-partner-2022-09-29-12-55-42-2263.webp', 1, '2022-09-29 00:55:42', '2022-09-29 00:55:42'),
(8, NULL, 'uploads/custom-images/our-partner-2022-09-29-12-55-55-5814.webp', 1, '2022-09-29 00:55:55', '2022-09-29 00:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'razorpay_key', 'rzp_test_cvrsy43xvBZfDT', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(2, 'razorpay_secret', 'c9AmI4C5vOfSWmZehhlns5df', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(3, 'razorpay_name', 'WebSolutionUs', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(4, 'razorpay_description', 'This is test payment window', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(5, 'razorpay_charge', '0.15', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(6, 'razorpay_theme_color', '#6d0ce4', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(7, 'razorpay_status', 'active', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(8, 'razorpay_currency_id', '3', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(9, 'razorpay_image', 'website/images/gateways/razorpay.webp', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(10, 'flutterwave_public_key', 'flutterwave_public_key', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(11, 'flutterwave_secret_key', 'flutterwave_secret_key', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(12, 'flutterwave_app_name', 'WebSolutionUs', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(13, 'flutterwave_charge', '0', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(14, 'flutterwave_currency_id', '2', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(15, 'flutterwave_status', 'inactive', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(16, 'flutterwave_image', 'website/images/gateways/flutterwave.webp', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(17, 'paystack_public_key', 'paystack_public_key', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(18, 'paystack_secret_key', 'paystack_secret_key', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(19, 'paystack_status', 'inactive', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(20, 'paystack_charge', '0', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(21, 'paystack_image', 'website/images/gateways/paystack.webp', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(22, 'paystack_currency_id', '2', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(23, 'mollie_key', 'mollie_key', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(24, 'mollie_charge', '0', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(25, 'mollie_image', 'website/images/gateways/mollie.webp', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(26, 'mollie_status', 'inactive', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(27, 'mollie_currency_id', '5', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(28, 'instamojo_account_mode', 'Sandbox', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(29, 'instamojo_client_id', 'instamojo_client_id', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(30, 'instamojo_client_secret', 'instamojo_client_secret', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(31, 'instamojo_charge', '0', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(32, 'instamojo_image', 'website/images/gateways/instamojo.webp', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(33, 'instamojo_currency_id', '3', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(34, 'instamojo_status', 'inactive', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(35, 'sslcommerz_store_id', 'test669499013b632', '2024-12-03 23:13:50', '2024-12-17 22:40:14'),
(36, 'sslcommerz_store_password', 'test669499013b632@ssl', '2024-12-03 23:13:50', '2024-12-17 22:40:14'),
(37, 'sslcommerz_image', 'website/images/gateways/sslcommerz.webp', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(38, 'sslcommerz_test_mode', '1', '2024-12-03 23:13:50', '2024-12-17 22:40:14'),
(39, 'sslcommerz_localhost', '1', '2024-12-03 23:13:50', '2024-12-17 22:40:14'),
(40, 'sslcommerz_status', 'active', '2024-12-03 23:13:50', '2024-12-17 22:40:14'),
(41, 'crypto_sandbox', '1', '2024-12-03 23:13:50', '2024-12-17 22:40:06'),
(42, 'crypto_api_key', 'WzrKM5s3vzWKj4wDGrz6uJzG81Hdf35pe7ov7Wyv', '2024-12-03 23:13:50', '2024-12-17 22:40:06'),
(43, 'crypto_image', 'website/images/gateways/crypto.webp', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(44, 'crypto_status', 'active', '2024-12-03 23:13:50', '2024-12-17 22:40:06'),
(45, 'sslcommerz_charge', '0', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(46, 'crypto_charge', '0', '2024-08-26 08:53:12', '2024-08-26 08:53:12'),
(47, 'crypto_receive_currency', 'BTC', '2024-08-26 08:53:12', '2024-08-26 08:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(2, 'admin.profile.view', 'admin', 'admin profile', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(3, 'admin.profile.update', 'admin', 'admin profile', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(4, 'order.management', 'admin', 'order management', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(5, 'admin.view', 'admin', 'admin', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(6, 'admin.create', 'admin', 'admin', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(7, 'admin.store', 'admin', 'admin', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(8, 'admin.edit', 'admin', 'admin', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(9, 'admin.update', 'admin', 'admin', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(10, 'admin.delete', 'admin', 'admin', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(11, 'role.view', 'admin', 'role', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(12, 'role.create', 'admin', 'role', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(13, 'role.store', 'admin', 'role', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(14, 'role.assign', 'admin', 'role', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(15, 'role.edit', 'admin', 'role', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(16, 'role.update', 'admin', 'role', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(17, 'role.delete', 'admin', 'role', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(18, 'setting.view', 'admin', 'setting', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(19, 'setting.update', 'admin', 'setting', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(20, 'basic.payment.view', 'admin', 'basic payment', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(21, 'basic.payment.update', 'admin', 'basic payment', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(22, 'currency.view', 'admin', 'currency', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(23, 'currency.create', 'admin', 'currency', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(24, 'currency.store', 'admin', 'currency', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(25, 'currency.edit', 'admin', 'currency', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(26, 'currency.update', 'admin', 'currency', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(27, 'currency.delete', 'admin', 'currency', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(28, 'customer.view', 'admin', 'customer', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(29, 'customer.bulk.mail', 'admin', 'customer', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(30, 'customer.create', 'admin', 'customer', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(31, 'customer.store', 'admin', 'customer', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(32, 'customer.edit', 'admin', 'customer', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(33, 'customer.update', 'admin', 'customer', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(34, 'customer.delete', 'admin', 'customer', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(35, 'language.view', 'admin', 'language', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(36, 'language.create', 'admin', 'language', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(37, 'language.store', 'admin', 'language', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(38, 'language.edit', 'admin', 'language', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(39, 'language.update', 'admin', 'language', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(40, 'language.delete', 'admin', 'language', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(41, 'language.translate', 'admin', 'language', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(42, 'language.single.translate', 'admin', 'language', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(43, 'menu.view', 'admin', 'menu builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(44, 'menu.create', 'admin', 'menu builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(45, 'menu.update', 'admin', 'menu builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(46, 'menu.delete', 'admin', 'menu builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(47, 'page.view', 'admin', 'page builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(48, 'page.create', 'admin', 'page builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(49, 'page.store', 'admin', 'page builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(50, 'page.edit', 'admin', 'page builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(51, 'page.component.add', 'admin', 'page builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(52, 'page.update', 'admin', 'page builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(53, 'page.delete', 'admin', 'page builder', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(54, 'subscription.view', 'admin', 'subscription', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(55, 'subscription.create', 'admin', 'subscription', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(56, 'subscription.store', 'admin', 'subscription', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(57, 'subscription.edit', 'admin', 'subscription', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(58, 'subscription.update', 'admin', 'subscription', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(59, 'subscription.delete', 'admin', 'subscription', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(60, 'payment.view', 'admin', 'payment', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(61, 'payment.update', 'admin', 'payment', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(62, 'social.link.management', 'admin', 'social link management', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(63, 'sitemap.management', 'admin', 'sitemap management', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(64, 'tax.view', 'admin', 'tax management', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(65, 'tax.create', 'admin', 'tax management', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(66, 'tax.translate', 'admin', 'tax management', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(67, 'tax.store', 'admin', 'tax management', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(68, 'tax.edit', 'admin', 'tax management', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(69, 'tax.update', 'admin', 'tax management', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(70, 'tax.delete', 'admin', 'tax management', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(71, 'newsletter.view', 'admin', 'newsletter', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(72, 'newsletter.mail', 'admin', 'newsletter', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(73, 'newsletter.delete', 'admin', 'newsletter', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(74, 'addon.view', 'admin', 'Addons', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(75, 'addon.install', 'admin', 'Addons', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(76, 'addon.update', 'admin', 'Addons', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(77, 'addon.status.change', 'admin', 'Addons', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(78, 'addon.remove', 'admin', 'Addons', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(79, 'manage.booking', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(80, 'manage.services', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(81, 'manage.coupon', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(82, 'manage.category', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(83, 'manage.provider', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(84, 'manage.kyc', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(85, 'manage.job', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(86, 'manage.user', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(87, 'manage.refund', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(88, 'manage.support.ticket', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(89, 'manage.withdraw', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(90, 'manage.website', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(91, 'manage.sections', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(92, 'manage.header.footer', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(93, 'manage.location', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(94, 'manage.report', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(95, 'manage.blog', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(96, 'manage.contact.message', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(97, 'manage.menu.builder', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00'),
(98, 'manage.page.builder', 'admin', 'Website Permissions', '2025-02-09 12:00:00', '2025-02-09 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `popular_posts`
--

DROP TABLE IF EXISTS `popular_posts`;
CREATE TABLE IF NOT EXISTS `popular_posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_id` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `popular_posts`
--

INSERT INTO `popular_posts` (`id`, `blog_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 6, 1, '2022-09-28 23:49:56', '2022-09-28 23:49:56'),
(3, 7, 1, '2022-09-28 23:50:02', '2022-09-28 23:50:02'),
(4, 2, 1, '2022-09-28 23:50:33', '2022-09-28 23:50:33'),
(5, 1, 1, '2022-12-25 04:48:28', '2022-12-25 04:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `provider_client_reports`
--

DROP TABLE IF EXISTS `provider_client_reports`;
CREATE TABLE IF NOT EXISTS `provider_client_reports` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `client_id` int NOT NULL,
  `provider_id` int NOT NULL,
  `report_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `report` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_payment_gateways`
--

DROP TABLE IF EXISTS `provider_payment_gateways`;
CREATE TABLE IF NOT EXISTS `provider_payment_gateways` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=392 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_payment_gateways`
--

INSERT INTO `provider_payment_gateways` (`id`, `user_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, '2', 'razorpay_key', NULL, '2025-01-07 23:23:04', '2025-01-08 01:23:51'),
(2, '2', 'razorpay_secret', 'razorpay_secret', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(3, '2', 'razorpay_name', 'WebSolutionUs', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(4, '2', 'razorpay_description', 'This is test payment window', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(5, '2', 'razorpay_charge', '0.15', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(6, '2', 'razorpay_theme_color', '#6d0ce4', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(7, '2', 'razorpay_status', 'inactive', '2025-01-07 23:23:04', '2025-01-08 01:23:51'),
(8, '2', 'razorpay_currency_id', '3', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(9, '2', 'razorpay_image', 'website/images/gateways/razorpay.webp', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(10, '2', 'flutterwave_public_key', NULL, '2025-01-07 23:23:04', '2025-01-08 04:50:52'),
(11, '2', 'flutterwave_secret_key', 'flutterwave_secret_key', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(12, '2', 'flutterwave_app_name', 'WebSolutionUs', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(13, '2', 'flutterwave_charge', '0', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(14, '2', 'flutterwave_currency_id', '2', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(15, '2', 'flutterwave_status', 'inactive', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(16, '2', 'flutterwave_image', 'website/images/gateways/flutterwave.webp', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(17, '2', 'paystack_public_key', NULL, '2025-01-07 23:23:04', '2025-01-08 05:02:45'),
(18, '2', 'paystack_secret_key', 'paystack_secret_key', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(19, '2', 'paystack_status', 'inactive', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(20, '2', 'paystack_charge', '0', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(21, '2', 'paystack_image', 'website/images/gateways/paystack.webp', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(22, '2', 'paystack_currency_id', '2', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(23, '2', 'mollie_key', 'mollie_key', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(24, '2', 'mollie_charge', '0', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(25, '2', 'mollie_image', 'website/images/gateways/mollie.webp', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(26, '2', 'mollie_status', 'inactive', '2025-01-07 23:23:04', '2025-01-08 05:29:05'),
(27, '2', 'mollie_currency_id', '5', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(28, '2', 'instamojo_account_mode', 'Sandbox', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(29, '2', 'instamojo_client_id', 'instamojo_client_id', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(30, '2', 'instamojo_client_secret', 'instamojo_client_secret', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(31, '2', 'instamojo_charge', '0', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(32, '2', 'instamojo_image', 'website/images/gateways/instamojo.webp', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(33, '2', 'instamojo_currency_id', '3', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(34, '2', 'instamojo_status', 'inactive', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(35, '2', 'sslcommerz_store_id', 'sslcommerz_store_id', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(36, '2', 'sslcommerz_store_password', 'sslcommerz_store_password@ssl', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(37, '2', 'sslcommerz_image', 'website/images/gateways/sslcommerz.webp', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(38, '2', 'sslcommerz_test_mode', '1', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(39, '2', 'sslcommerz_localhost', '1', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(40, '2', 'sslcommerz_status', 'active', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(41, '2', 'crypto_sandbox', '1', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(42, '2', 'crypto_api_key', 'crypto_api_key', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(43, '2', 'crypto_image', 'website/images/gateways/crypto.webp', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(44, '2', 'crypto_status', 'active', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(45, '2', 'sslcommerz_charge', '0', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(46, '2', 'crypto_charge', '0', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(47, '2', 'stripe_key', NULL, '2025-01-07 23:23:04', '2025-01-08 00:54:05'),
(48, '2', 'stripe_secret', 'stripe_secret', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(49, '2', 'stripe_currency_id', '1', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(50, '2', 'stripe_status', 'inactive', '2025-01-07 23:23:04', '2025-01-08 00:54:05'),
(51, '2', 'stripe_charge', '0', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(52, '2', 'stripe_image', 'website/images/gateways/stripe.webp', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(53, '2', 'paypal_client_id', NULL, '2025-01-07 23:23:04', '2025-01-08 00:24:47'),
(54, '2', 'paypal_secret_key', NULL, '2025-01-07 23:23:04', '2025-01-08 00:24:47'),
(55, '2', 'paypal_account_mode', 'live', '2025-01-07 23:23:04', '2025-01-08 00:24:47'),
(56, '2', 'paypal_app_id', 'paypal_app_id', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(57, '2', 'paypal_currency_id', '1', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(58, '2', 'paypal_charge', '0', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(59, '2', 'paypal_status', 'inactive', '2025-01-07 23:23:04', '2025-01-08 00:24:47'),
(60, '2', 'paypal_image', 'website/images/gateways/paypal.webp', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(61, '2', 'bank_information', 'Bank Name => Your bank name\r\n            Account Number => Your bank account number\r\n            Routing Number => Your bank routing number\r\n            Branch => Your bank branch name', '2025-01-07 23:23:04', '2025-01-08 05:53:32'),
(62, '2', 'bank_status', 'active', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(63, '2', 'bank_image', 'website/images/gateways/bank.webp', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(64, '2', 'bank_charge', '0', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(65, '2', 'bank_currency_id', '1', '2025-01-07 23:23:04', '2025-01-07 23:23:04'),
(66, '4', 'razorpay_key', 'razorpay_key', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(67, '4', 'razorpay_secret', 'razorpay_secret', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(68, '4', 'razorpay_name', 'WebSolutionUs', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(69, '4', 'razorpay_description', 'This is test payment window', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(70, '4', 'razorpay_charge', '0.15', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(71, '4', 'razorpay_theme_color', '#6d0ce4', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(72, '4', 'razorpay_status', 'active', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(73, '4', 'razorpay_currency_id', '3', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(74, '4', 'razorpay_image', 'website/images/gateways/razorpay.webp', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(75, '4', 'flutterwave_public_key', 'flutterwave_public_key', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(76, '4', 'flutterwave_secret_key', 'flutterwave_secret_key', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(77, '4', 'flutterwave_app_name', 'WebSolutionUs', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(78, '4', 'flutterwave_charge', '0', '2025-01-09 02:45:26', '2025-01-09 02:45:26'),
(79, '4', 'flutterwave_currency_id', '2', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(80, '4', 'flutterwave_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(81, '4', 'flutterwave_image', 'website/images/gateways/flutterwave.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(82, '4', 'paystack_public_key', 'paystack_public_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(83, '4', 'paystack_secret_key', 'paystack_secret_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(84, '4', 'paystack_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(85, '4', 'paystack_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(86, '4', 'paystack_image', 'website/images/gateways/paystack.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(87, '4', 'paystack_currency_id', '2', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(88, '4', 'mollie_key', 'mollie_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(89, '4', 'mollie_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(90, '4', 'mollie_image', 'website/images/gateways/mollie.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(91, '4', 'mollie_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(92, '4', 'mollie_currency_id', '5', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(93, '4', 'instamojo_account_mode', 'Sandbox', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(94, '4', 'instamojo_client_id', 'instamojo_client_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(95, '4', 'instamojo_client_secret', 'instamojo_client_secret', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(96, '4', 'instamojo_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(97, '4', 'instamojo_image', 'website/images/gateways/instamojo.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(98, '4', 'instamojo_currency_id', '3', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(99, '4', 'instamojo_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(100, '4', 'sslcommerz_store_id', 'sslcommerz_store_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(101, '4', 'sslcommerz_store_password', 'sslcommerz_store_password@ssl', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(102, '4', 'sslcommerz_image', 'website/images/gateways/sslcommerz.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(103, '4', 'sslcommerz_test_mode', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(104, '4', 'sslcommerz_localhost', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(105, '4', 'sslcommerz_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(106, '4', 'crypto_sandbox', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(107, '4', 'crypto_api_key', 'crypto_api_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(108, '4', 'crypto_image', 'website/images/gateways/crypto.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(109, '4', 'crypto_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(110, '4', 'sslcommerz_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(111, '4', 'crypto_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(112, '4', 'stripe_key', 'stripe_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(113, '4', 'stripe_secret', 'stripe_secret', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(114, '4', 'stripe_currency_id', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(115, '4', 'stripe_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(116, '4', 'stripe_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(117, '4', 'stripe_image', 'website/images/gateways/stripe.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(118, '4', 'paypal_client_id', 'paypal_client_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(119, '4', 'paypal_secret_key', 'paypal_secret_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(120, '4', 'paypal_account_mode', 'sandbox', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(121, '4', 'paypal_app_id', 'paypal_app_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(122, '4', 'paypal_currency_id', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(123, '4', 'paypal_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(124, '4', 'paypal_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(125, '4', 'paypal_image', 'website/images/gateways/paypal.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(126, '4', 'bank_information', 'Bank Name => Your bank name\n            Account Number => Your bank account number\n            Routing Number => Your bank routing number\n            Branch => Your bank branch name', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(127, '4', 'bank_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(128, '4', 'bank_image', 'website/images/gateways/bank.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(129, '4', 'bank_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(130, '4', 'bank_currency_id', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(131, '5', 'razorpay_key', 'razorpay_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(132, '5', 'razorpay_secret', 'razorpay_secret', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(133, '5', 'razorpay_name', 'WebSolutionUs', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(134, '5', 'razorpay_description', 'This is test payment window', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(135, '5', 'razorpay_charge', '0.15', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(136, '5', 'razorpay_theme_color', '#6d0ce4', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(137, '5', 'razorpay_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(138, '5', 'razorpay_currency_id', '3', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(139, '5', 'razorpay_image', 'website/images/gateways/razorpay.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(140, '5', 'flutterwave_public_key', 'flutterwave_public_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(141, '5', 'flutterwave_secret_key', 'flutterwave_secret_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(142, '5', 'flutterwave_app_name', 'WebSolutionUs', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(143, '5', 'flutterwave_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(144, '5', 'flutterwave_currency_id', '2', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(145, '5', 'flutterwave_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(146, '5', 'flutterwave_image', 'website/images/gateways/flutterwave.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(147, '5', 'paystack_public_key', 'paystack_public_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(148, '5', 'paystack_secret_key', 'paystack_secret_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(149, '5', 'paystack_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(150, '5', 'paystack_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(151, '5', 'paystack_image', 'website/images/gateways/paystack.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(152, '5', 'paystack_currency_id', '2', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(153, '5', 'mollie_key', 'mollie_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(154, '5', 'mollie_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(155, '5', 'mollie_image', 'website/images/gateways/mollie.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(156, '5', 'mollie_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(157, '5', 'mollie_currency_id', '5', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(158, '5', 'instamojo_account_mode', 'Sandbox', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(159, '5', 'instamojo_client_id', 'instamojo_client_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(160, '5', 'instamojo_client_secret', 'instamojo_client_secret', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(161, '5', 'instamojo_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(162, '5', 'instamojo_image', 'website/images/gateways/instamojo.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(163, '5', 'instamojo_currency_id', '3', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(164, '5', 'instamojo_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(165, '5', 'sslcommerz_store_id', 'sslcommerz_store_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(166, '5', 'sslcommerz_store_password', 'sslcommerz_store_password@ssl', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(167, '5', 'sslcommerz_image', 'website/images/gateways/sslcommerz.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(168, '5', 'sslcommerz_test_mode', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(169, '5', 'sslcommerz_localhost', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(170, '5', 'sslcommerz_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(171, '5', 'crypto_sandbox', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(172, '5', 'crypto_api_key', 'crypto_api_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(173, '5', 'crypto_image', 'website/images/gateways/crypto.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(174, '5', 'crypto_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(175, '5', 'sslcommerz_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(176, '5', 'crypto_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(177, '5', 'stripe_key', 'stripe_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(178, '5', 'stripe_secret', 'stripe_secret', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(179, '5', 'stripe_currency_id', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(180, '5', 'stripe_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(181, '5', 'stripe_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(182, '5', 'stripe_image', 'website/images/gateways/stripe.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(183, '5', 'paypal_client_id', 'paypal_client_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(184, '5', 'paypal_secret_key', 'paypal_secret_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(185, '5', 'paypal_account_mode', 'sandbox', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(186, '5', 'paypal_app_id', 'paypal_app_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(187, '5', 'paypal_currency_id', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(188, '5', 'paypal_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(189, '5', 'paypal_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(190, '5', 'paypal_image', 'website/images/gateways/paypal.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(191, '5', 'bank_information', 'Bank Name => Your bank name\n            Account Number => Your bank account number\n            Routing Number => Your bank routing number\n            Branch => Your bank branch name', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(192, '5', 'bank_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(193, '5', 'bank_image', 'website/images/gateways/bank.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(194, '5', 'bank_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(195, '5', 'bank_currency_id', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(196, '6', 'razorpay_key', 'razorpay_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(197, '6', 'razorpay_secret', 'razorpay_secret', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(198, '6', 'razorpay_name', 'WebSolutionUs', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(199, '6', 'razorpay_description', 'This is test payment window', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(200, '6', 'razorpay_charge', '0.15', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(201, '6', 'razorpay_theme_color', '#6d0ce4', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(202, '6', 'razorpay_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(203, '6', 'razorpay_currency_id', '3', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(204, '6', 'razorpay_image', 'website/images/gateways/razorpay.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(205, '6', 'flutterwave_public_key', 'flutterwave_public_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(206, '6', 'flutterwave_secret_key', 'flutterwave_secret_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(207, '6', 'flutterwave_app_name', 'WebSolutionUs', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(208, '6', 'flutterwave_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(209, '6', 'flutterwave_currency_id', '2', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(210, '6', 'flutterwave_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(211, '6', 'flutterwave_image', 'website/images/gateways/flutterwave.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(212, '6', 'paystack_public_key', 'paystack_public_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(213, '6', 'paystack_secret_key', 'paystack_secret_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(214, '6', 'paystack_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(215, '6', 'paystack_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(216, '6', 'paystack_image', 'website/images/gateways/paystack.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(217, '6', 'paystack_currency_id', '2', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(218, '6', 'mollie_key', 'mollie_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(219, '6', 'mollie_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(220, '6', 'mollie_image', 'website/images/gateways/mollie.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(221, '6', 'mollie_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(222, '6', 'mollie_currency_id', '5', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(223, '6', 'instamojo_account_mode', 'Sandbox', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(224, '6', 'instamojo_client_id', 'instamojo_client_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(225, '6', 'instamojo_client_secret', 'instamojo_client_secret', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(226, '6', 'instamojo_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(227, '6', 'instamojo_image', 'website/images/gateways/instamojo.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(228, '6', 'instamojo_currency_id', '3', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(229, '6', 'instamojo_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(230, '6', 'sslcommerz_store_id', 'sslcommerz_store_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(231, '6', 'sslcommerz_store_password', 'sslcommerz_store_password@ssl', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(232, '6', 'sslcommerz_image', 'website/images/gateways/sslcommerz.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(233, '6', 'sslcommerz_test_mode', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(234, '6', 'sslcommerz_localhost', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(235, '6', 'sslcommerz_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(236, '6', 'crypto_sandbox', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(237, '6', 'crypto_api_key', 'crypto_api_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(238, '6', 'crypto_image', 'website/images/gateways/crypto.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(239, '6', 'crypto_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(240, '6', 'sslcommerz_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(241, '6', 'crypto_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(242, '6', 'stripe_key', 'stripe_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(243, '6', 'stripe_secret', 'stripe_secret', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(244, '6', 'stripe_currency_id', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(245, '6', 'stripe_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(246, '6', 'stripe_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(247, '6', 'stripe_image', 'website/images/gateways/stripe.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(248, '6', 'paypal_client_id', 'paypal_client_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(249, '6', 'paypal_secret_key', 'paypal_secret_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(250, '6', 'paypal_account_mode', 'sandbox', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(251, '6', 'paypal_app_id', 'paypal_app_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(252, '6', 'paypal_currency_id', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(253, '6', 'paypal_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(254, '6', 'paypal_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(255, '6', 'paypal_image', 'website/images/gateways/paypal.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(256, '6', 'bank_information', 'Bank Name => Your bank name\n            Account Number => Your bank account number\n            Routing Number => Your bank routing number\n            Branch => Your bank branch name', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(257, '6', 'bank_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(258, '6', 'bank_image', 'website/images/gateways/bank.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(259, '6', 'bank_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(260, '6', 'bank_currency_id', '1', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(261, '7', 'razorpay_key', 'razorpay_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(262, '7', 'razorpay_secret', 'razorpay_secret', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(263, '7', 'razorpay_name', 'WebSolutionUs', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(264, '7', 'razorpay_description', 'This is test payment window', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(265, '7', 'razorpay_charge', '0.15', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(266, '7', 'razorpay_theme_color', '#6d0ce4', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(267, '7', 'razorpay_status', 'active', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(268, '7', 'razorpay_currency_id', '3', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(269, '7', 'razorpay_image', 'website/images/gateways/razorpay.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(270, '7', 'flutterwave_public_key', 'flutterwave_public_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(271, '7', 'flutterwave_secret_key', 'flutterwave_secret_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(272, '7', 'flutterwave_app_name', 'WebSolutionUs', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(273, '7', 'flutterwave_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(274, '7', 'flutterwave_currency_id', '2', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(275, '7', 'flutterwave_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(276, '7', 'flutterwave_image', 'website/images/gateways/flutterwave.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(277, '7', 'paystack_public_key', 'paystack_public_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(278, '7', 'paystack_secret_key', 'paystack_secret_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(279, '7', 'paystack_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(280, '7', 'paystack_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(281, '7', 'paystack_image', 'website/images/gateways/paystack.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(282, '7', 'paystack_currency_id', '2', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(283, '7', 'mollie_key', 'mollie_key', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(284, '7', 'mollie_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(285, '7', 'mollie_image', 'website/images/gateways/mollie.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(286, '7', 'mollie_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(287, '7', 'mollie_currency_id', '5', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(288, '7', 'instamojo_account_mode', 'Sandbox', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(289, '7', 'instamojo_client_id', 'instamojo_client_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(290, '7', 'instamojo_client_secret', 'instamojo_client_secret', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(291, '7', 'instamojo_charge', '0', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(292, '7', 'instamojo_image', 'website/images/gateways/instamojo.webp', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(293, '7', 'instamojo_currency_id', '3', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(294, '7', 'instamojo_status', 'inactive', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(295, '7', 'sslcommerz_store_id', 'sslcommerz_store_id', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(296, '7', 'sslcommerz_store_password', 'sslcommerz_store_password@ssl', '2025-01-09 02:45:27', '2025-01-09 02:45:27'),
(297, '7', 'sslcommerz_image', 'website/images/gateways/sslcommerz.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(298, '7', 'sslcommerz_test_mode', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(299, '7', 'sslcommerz_localhost', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(300, '7', 'sslcommerz_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(301, '7', 'crypto_sandbox', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(302, '7', 'crypto_api_key', 'crypto_api_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(303, '7', 'crypto_image', 'website/images/gateways/crypto.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(304, '7', 'crypto_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(305, '7', 'sslcommerz_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(306, '7', 'crypto_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(307, '7', 'stripe_key', 'stripe_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(308, '7', 'stripe_secret', 'stripe_secret', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(309, '7', 'stripe_currency_id', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(310, '7', 'stripe_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(311, '7', 'stripe_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(312, '7', 'stripe_image', 'website/images/gateways/stripe.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(313, '7', 'paypal_client_id', 'paypal_client_id', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(314, '7', 'paypal_secret_key', 'paypal_secret_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(315, '7', 'paypal_account_mode', 'sandbox', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(316, '7', 'paypal_app_id', 'paypal_app_id', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(317, '7', 'paypal_currency_id', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(318, '7', 'paypal_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(319, '7', 'paypal_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(320, '7', 'paypal_image', 'website/images/gateways/paypal.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(321, '7', 'bank_information', 'Bank Name => Your bank name\n            Account Number => Your bank account number\n            Routing Number => Your bank routing number\n            Branch => Your bank branch name', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(322, '7', 'bank_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(323, '7', 'bank_image', 'website/images/gateways/bank.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(324, '7', 'bank_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(325, '7', 'bank_currency_id', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(326, '28', 'razorpay_key', 'razorpay_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(327, '28', 'razorpay_secret', 'razorpay_secret', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(328, '28', 'razorpay_name', 'WebSolutionUs', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(329, '28', 'razorpay_description', 'This is test payment window', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(330, '28', 'razorpay_charge', '0.15', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(331, '28', 'razorpay_theme_color', '#6d0ce4', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(332, '28', 'razorpay_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(333, '28', 'razorpay_currency_id', '3', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(334, '28', 'razorpay_image', 'website/images/gateways/razorpay.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(335, '28', 'flutterwave_public_key', 'flutterwave_public_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(336, '28', 'flutterwave_secret_key', 'flutterwave_secret_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(337, '28', 'flutterwave_app_name', 'WebSolutionUs', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(338, '28', 'flutterwave_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(339, '28', 'flutterwave_currency_id', '2', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(340, '28', 'flutterwave_status', 'inactive', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(341, '28', 'flutterwave_image', 'website/images/gateways/flutterwave.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(342, '28', 'paystack_public_key', 'paystack_public_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(343, '28', 'paystack_secret_key', 'paystack_secret_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(344, '28', 'paystack_status', 'inactive', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(345, '28', 'paystack_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(346, '28', 'paystack_image', 'website/images/gateways/paystack.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(347, '28', 'paystack_currency_id', '2', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(348, '28', 'mollie_key', 'mollie_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(349, '28', 'mollie_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(350, '28', 'mollie_image', 'website/images/gateways/mollie.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(351, '28', 'mollie_status', 'inactive', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(352, '28', 'mollie_currency_id', '5', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(353, '28', 'instamojo_account_mode', 'Sandbox', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(354, '28', 'instamojo_client_id', 'instamojo_client_id', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(355, '28', 'instamojo_client_secret', 'instamojo_client_secret', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(356, '28', 'instamojo_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(357, '28', 'instamojo_image', 'website/images/gateways/instamojo.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(358, '28', 'instamojo_currency_id', '3', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(359, '28', 'instamojo_status', 'inactive', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(360, '28', 'sslcommerz_store_id', 'sslcommerz_store_id', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(361, '28', 'sslcommerz_store_password', 'sslcommerz_store_password@ssl', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(362, '28', 'sslcommerz_image', 'website/images/gateways/sslcommerz.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(363, '28', 'sslcommerz_test_mode', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(364, '28', 'sslcommerz_localhost', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(365, '28', 'sslcommerz_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(366, '28', 'crypto_sandbox', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(367, '28', 'crypto_api_key', 'crypto_api_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(368, '28', 'crypto_image', 'website/images/gateways/crypto.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(369, '28', 'crypto_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(370, '28', 'sslcommerz_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(371, '28', 'crypto_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(372, '28', 'stripe_key', 'stripe_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(373, '28', 'stripe_secret', 'stripe_secret', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(374, '28', 'stripe_currency_id', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(375, '28', 'stripe_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(376, '28', 'stripe_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(377, '28', 'stripe_image', 'website/images/gateways/stripe.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(378, '28', 'paypal_client_id', 'paypal_client_id', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(379, '28', 'paypal_secret_key', 'paypal_secret_key', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(380, '28', 'paypal_account_mode', 'sandbox', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(381, '28', 'paypal_app_id', 'paypal_app_id', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(382, '28', 'paypal_currency_id', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(383, '28', 'paypal_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(384, '28', 'paypal_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(385, '28', 'paypal_image', 'website/images/gateways/paypal.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(386, '28', 'bank_information', 'Bank Name => Your bank name\n            Account Number => Your bank account number\n            Routing Number => Your bank routing number\n            Branch => Your bank branch name', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(387, '28', 'bank_status', 'active', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(388, '28', 'bank_image', 'website/images/gateways/bank.webp', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(389, '28', 'bank_charge', '0', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(390, '28', 'bank_currency_id', '1', '2025-01-09 02:45:28', '2025-01-09 02:45:28'),
(391, '2', 'crypto_receive_currency', 'BTC', '2025-01-07 23:23:04', '2025-01-07 23:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `provider_withdraws`
--

DROP TABLE IF EXISTS `provider_withdraws`;
CREATE TABLE IF NOT EXISTS `provider_withdraws` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` double NOT NULL,
  `withdraw_amount` double NOT NULL,
  `withdraw_charge` double NOT NULL,
  `account_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `approved_date` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_withdraws`
--

INSERT INTO `provider_withdraws` (`id`, `user_id`, `method`, `total_amount`, `withdraw_amount`, `withdraw_charge`, `account_info`, `status`, `approved_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'Bank', 12, 11.88, 1, 'IBBL Uttara Branch,\r\nAccount : 4545315455...45541', 1, '2022-12-25', '2022-10-07 21:26:18', '2022-12-25 05:15:38'),
(2, 2, 'Bank', 15, 14.85, 1, 'Bank Name:  IBBL\r\nAccount Number:  545455.....4587555\r\nBranch: Uttara, Dhaka', 0, NULL, '2022-12-25 22:56:10', '2022-12-25 22:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_histories`
--

DROP TABLE IF EXISTS `purchase_histories`;
CREATE TABLE IF NOT EXISTS `purchase_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL,
  `plan_id` int NOT NULL,
  `plan_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum_service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateway_fee` double(8,2) NOT NULL DEFAULT '0.00',
  `total_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `payable_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `payable_amount_without_rate` double(8,2) NOT NULL DEFAULT '0.00',
  `payable_currency` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_histories`
--

INSERT INTO `purchase_histories` (`id`, `provider_id`, `plan_id`, `plan_name`, `plan_price`, `expiration_date`, `expiration`, `maximum_service`, `status`, `gateway_fee`, `total_amount`, `payable_amount`, `payable_amount_without_rate`, `payable_currency`, `paid_amount`, `payment_details`, `payment_method`, `payment_status`, `transaction`, `created_at`, `updated_at`) VALUES
(25, 2, 2, 'Premium', '29', '2025-12-22', 'yearly', '20', 'active', 0.00, 0.00, 0.00, 0.00, '', NULL, NULL, 'stripe', 'success', 'txn_3QYlkxLdrMGLvvfW3S01fLh8', '2024-12-22 03:06:13', '2024-12-22 03:47:55'),
(26, 2, 2, 'Premium', '29', '2025-12-23', 'yearly', '20', 'pending', 0.04, 29.00, 29.04, 29.00, 'USD', NULL, NULL, 'razorpay', 'pending', NULL, '2024-12-23 03:32:06', '2024-12-23 03:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `refund_requests`
--

DROP TABLE IF EXISTS `refund_requests`;
CREATE TABLE IF NOT EXISTS `refund_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `order_id` int NOT NULL,
  `account_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `resone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'awaiting_for_admin_approval',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refund_requests`
--

INSERT INTO `refund_requests` (`id`, `client_id`, `order_id`, `account_information`, `resone`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'IBBL AAA Branch\r\nAccount Number : 32145221112', 'this is test resone', 'awaiting_for_admin_approval', '2022-10-04 03:54:02', '2022-10-04 03:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `provider_id` int NOT NULL DEFAULT '0',
  `review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `service_id`, `user_id`, `provider_id`, `review`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 1, 2, 'Lorem ipsum dolor sit amet, nibh saperet te pri, at nam diceret disputationi. Quo an consul impedit, usu possim evertitur dissentiet ei, ridens minimum nominavi et vix.', 5, 1, '2022-10-03 05:22:13', '2022-10-03 05:22:36'),
(2, 12, 1, 2, 'There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour.', 5, 1, '2022-10-04 04:29:20', '2022-10-04 04:29:48'),
(3, 15, 1, 4, 'There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form', 5, 1, '2023-01-13 22:55:14', '2023-01-13 22:55:38'),
(4, 15, 1, 4, 'If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.', 5, 1, '2023-01-13 23:07:38', '2023-01-13 23:07:53'),
(8, 15, 1, 4, 'Hello', 3, 0, '2023-05-17 15:27:00', '2023-05-17 15:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', '2024-12-03 23:13:50', '2024-12-03 23:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL,
  `day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_of_day` int NOT NULL,
  `start` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `provider_id`, `day`, `serial_of_day`, `start`, `end`, `status`, `created_at`, `updated_at`) VALUES
(43, 2, 'Sunday', 0, '10:00', '18:00', 1, '2022-10-05 04:32:35', '2022-10-05 04:32:35'),
(44, 2, 'Monday', 1, '09:00', '19:00', 1, '2022-10-05 04:32:35', '2022-11-09 21:58:00'),
(45, 2, 'Tuesday', 2, '10:30', '18:00', 1, '2022-10-05 04:32:35', '2022-11-09 21:58:00'),
(46, 2, 'Wednesday', 3, '08:00', '20:00', 1, '2022-10-05 04:32:35', '2022-11-09 21:58:00'),
(47, 2, 'Thursday', 4, '09:30', '19:30', 1, '2022-10-05 04:32:35', '2022-11-09 21:58:00'),
(48, 2, 'Friday', 5, '10:00', '18:30', 0, '2022-10-05 04:32:35', '2022-11-09 21:58:00'),
(49, 2, 'Saturday', 6, '11:00', '18:00', 0, '2022-10-05 04:32:35', '2022-11-09 21:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `section_contents`
--

DROP TABLE IF EXISTS `section_contents`;
CREATE TABLE IF NOT EXISTS `section_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_contents`
--

INSERT INTO `section_contents` (`id`, `section_name`, `created_at`, `updated_at`) VALUES
(1, 'Category', NULL, '2023-01-14 22:23:04'),
(2, 'Featured Service', NULL, '2022-11-06 01:11:42'),
(3, 'Popular Service', NULL, '2022-11-06 01:11:48'),
(4, 'Testimonial', NULL, '2022-11-06 01:11:56'),
(5, 'Latest News', NULL, '2022-11-06 01:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `section_content_translations`
--

DROP TABLE IF EXISTS `section_content_translations`;
CREATE TABLE IF NOT EXISTS `section_content_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_content_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_content_translations`
--

INSERT INTO `section_content_translations` (`id`, `section_content_id`, `lang_code`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Our Categories', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', '2024-12-23 17:12:32', '2024-12-23 17:12:32'),
(2, 1, 'bn', 'Our Categorie', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', '2024-12-23 17:12:32', '2024-12-23 23:41:57'),
(3, 2, 'en', 'Featured Services', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', '2024-12-23 17:12:32', '2024-12-23 17:12:32'),
(4, 2, 'bn', 'Featured Services', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', '2024-12-23 17:12:32', '2024-12-23 17:12:32'),
(5, 3, 'en', 'Popular Services', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', '2024-12-23 17:12:32', '2024-12-23 17:12:32'),
(6, 3, 'bn', 'Popular Services', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', '2024-12-23 17:12:32', '2024-12-23 17:12:32'),
(7, 4, 'en', 'Testimonial', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', '2024-12-23 17:12:32', '2024-12-23 17:12:32'),
(8, 4, 'bn', 'Testimonial', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', '2024-12-23 17:12:32', '2024-12-23 17:12:32'),
(9, 5, 'en', 'Latest News', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', '2024-12-23 17:12:32', '2024-12-23 17:12:32'),
(10, 5, 'bn', 'Latest News', 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration', '2024-12-23 17:12:32', '2024-12-23 17:12:32');

-- --------------------------------------------------------

--
-- Table structure for table `section_controls`
--

DROP TABLE IF EXISTS `section_controls`;
CREATE TABLE IF NOT EXISTS `section_controls` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_controls`
--

INSERT INTO `section_controls` (`id`, `page_name`, `section_name`, `status`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'home1', 'Intro(Home1, Home2, Home3)', 1, 0, NULL, '2022-09-27 01:34:04'),
(2, 'home1', 'Category (Home1, Home2, Home3)', 1, 9, NULL, '2022-09-29 01:30:29'),
(3, 'home1', 'Featured Services (Home1, Home2, Home3)', 1, 6, NULL, '2022-10-03 04:20:38'),
(4, 'home1', 'Countdown (Home1, Home2, Home3)', 1, 4, NULL, '2022-09-29 00:42:30'),
(5, 'home1', 'Popular Service (Home1, Home2, Home3)', 1, 6, NULL, '2022-10-03 04:21:35'),
(6, 'home1', 'Join as a provider (Home1, Home2, Home3)', 1, 0, NULL, '2022-09-27 02:08:01'),
(7, 'home1', 'Mobile app (Home1, Home2, Home3)', 1, 0, NULL, '2022-09-27 02:11:30'),
(8, 'home1', 'Testimonial (Home1, Home2, Home3)', 1, 6, NULL, '2022-09-29 00:47:03'),
(9, 'home1', 'Blog (Home1, Home2, Home3)', 1, 3, NULL, '2022-12-20 21:06:41'),
(10, 'home1', 'Subscribe Now (Home1, Home2, Home3)', 1, 0, NULL, NULL),
(21, 'home2', 'Contact Us(Home2)', 1, 0, NULL, '2022-09-27 03:07:40'),
(22, 'home2', 'Our Partner(Home2, Home3)', 1, 20, NULL, '2022-09-29 00:56:54'),
(33, 'home3', 'How it work (Home3)', 1, 0, NULL, NULL),
(35, 'about', 'How it work(About)', 1, 0, NULL, '2022-09-27 03:19:53'),
(36, 'about', 'About Us (About)', 1, 0, NULL, '2022-09-27 03:19:53'),
(37, 'about', 'Countdown (About)', 1, 4, NULL, '2022-09-29 00:42:30'),
(38, 'about', 'Why choose us (About)', 1, 0, NULL, '2022-09-27 03:25:25'),
(39, 'about', 'Join as provider (About)', 0, 0, NULL, '2022-09-27 03:30:26'),
(40, 'about', 'Testimonial (About)', 1, 6, NULL, '2022-09-29 00:47:04'),
(41, 'service', 'Our Partner(Service)', 1, 20, NULL, '2022-09-29 00:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

DROP TABLE IF EXISTS `seo_settings`;
CREATE TABLE IF NOT EXISTS `seo_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `page_name`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 'Home Page', 'Home || WebSolutionUS', 'Home || WebSolutionUS', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(2, 'About Page', 'About || WebSolutionUS', 'About || WebSolutionUS', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(3, 'Contact Us', 'Contact Us - Service', 'Contact Us', NULL, '2022-09-27 04:12:07'),
(5, 'Service', 'Our Service - Service', 'Our Service', NULL, '2022-09-27 04:19:48'),
(6, 'Blog', 'Blog - Service', 'Blog', NULL, '2022-09-27 04:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `location_id` int DEFAULT NULL,
  `provider_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `make_featured` tinyint NOT NULL DEFAULT '0',
  `featured_expired_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `make_popular` tinyint NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `is_banned` tinyint NOT NULL DEFAULT '0',
  `seo_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `what_you_will_provide` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `benifit` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `package_features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `approve_by_admin` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category_id`, `location_id`, `provider_id`, `name`, `slug`, `price`, `image`, `details`, `make_featured`, `featured_expired_date`, `make_popular`, `status`, `is_banned`, `seo_title`, `seo_description`, `what_you_will_provide`, `benifit`, `package_features`, `approve_by_admin`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 2, 'Commercial And Home cleaning crew ladies working as our team', 'commercial-cleaning-crew-ladies-working-as-team', 50, 'uploads/custom-images/Service-2022-10-03-02-49-36-7030.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'Commercial cleaning crew ladies working as team', 'Commercial cleaning crew ladies working as team', '[\"Page Load (time, size, number of requests).\",\"Advance Data analysis operation.\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Timely Worked\",\"Work Guarantee\",\"Professional Work\"]', '[\"Floor And Carpet Cleaning\",\"Sofa And Divain Cleaning\",\"Chair And Table Cleaning\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', 1, '2022-10-03 02:49:36', '2022-11-06 01:49:13'),
(2, 6, NULL, 2, 'AC conditioner technician checks the operation and best servicing', 'ac-conditioner-technician-checks-the-operation', 40, 'uploads/custom-images/Service-2022-10-03-02-55-22-8862.webp', '<p>Ei usu malis aeque efficiantur. Mazim dolor denique duo ad, augue ornatus sententiae vel at, duo id sumo vulputate. His legimus assueverit ut, commune maluisset deterruisset id mel. Oblique volumus eos ut, quo autem posidonium definitiones cu. Cu usu lorem consul concludaturque, pro ea fuisset consectetuer. Ex aeterno forensibus has, dicta propriae est ei, ex alterum apeirian quo.<br></p>', 1, NULL, 0, 1, 0, 'AC conditioner technician checks the operation', 'AC conditioner technician checks the operation', '[\"Laravel Website Development\",\"Mobile Application Development\",\"WordPress Theme Development\",\"Software Development\",\"Custom Website Development\"]', '[\"Search Engine Marketing (SEM)\",\"Social Media Marketing (SMM)\",\"Digital Marketing\",\"Search Engine Optimization (SEO)\"]', '[\"Floor And Carpet Cleaning\",\"Sofa And Divain Cleaning\",\"Chair And Table Cleaning\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', 1, '2022-10-03 02:55:22', '2022-11-06 01:48:43'),
(3, 4, NULL, 2, 'Your Home and Office Electrician engineer work tester measuring', 'electrician-engineer-work-tester-measuring', 32, 'uploads/custom-images/Service-2022-10-03-03-17-30-3814.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'Electrician engineer work tester measuring', 'Electrician engineer work tester measuring', '[\"Digital Merketing\",\"Company Profile Build\",\"Business Growing\",\"How to Profit\"]', '[\"Timely Worked\",\"Professional Work\",\"Work Gurenty\",\"Hair Cutting Girls\"]', '[\"Digital Marketing\",\"Company Profile Build\",\"Business Growing\",\"How to Profit\"]', 1, '2022-10-03 03:17:30', '2022-11-06 03:53:40'),
(4, 5, NULL, 2, 'Car Washing And Cleaning Service At Home or Office With Our Team', 'car-washing-and-cleaning-service-at-home-or-office', 60, 'uploads/custom-images/Service-2022-10-03-03-24-47-2750.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'Car Washing And Cleaning Service At Home or Office', 'Car Washing And Cleaning Service At Home or Office', '[\"Quality Service\",\"Timely Work\",\"Service Gurantee\",\"Sofa And Divain Cleaning\",\"Hair Cutting Girls\"]', '[\"Car Cleaning\",\"Car Washing\",\"Sofa And Divain Cleaning\",\"Hair Cutting Girls\"]', '[\"Car Cleaning\",\"Car Washing\",\"Quality Service\",\"Timely Work\",\"Sofa And Divain Cleaning\"]', 1, '2022-10-03 03:24:47', '2022-11-06 03:52:41'),
(5, 3, NULL, 2, 'AC And Your Fridge Repair Service By Expert AC Repair Machenic', 'ac-repair-service-by-expert-ac-repair-machenic', 30, 'uploads/custom-images/Service-2022-10-03-03-28-39-9275.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'AC Repair Service By Expert AC Repair Machenic', 'AC Repair Service By Expert AC Repair Machenic', '[\"AC Change\",\"Ac Repair\",\"Chair And Table Cleaning\",\"Sofa And Divain Cleaning\"]', '[\"Service Gurantee\",\"Quality Service\",\"Chair And Table Cleaning\",\"Sofa And Divain Cleaning\"]', '[\"AC Change\",\"Ac Repair\",\"Service Gurantee\",\"Quality Service\",\"Chair And Table Cleaning\"]', 1, '2022-10-03 03:28:39', '2022-11-06 03:51:32'),
(6, 4, NULL, 2, 'Women Beauty Care Service and Massage with Expert Beautisian', 'women-beauty-care-service-with-expert-beautisian', 45, 'uploads/custom-images/Service-2022-10-03-03-34-32-2940.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Women Beauty Care Service with Expert Beautisian', 'Women Beauty Care Service with Expert Beautisian', '[\"Weeding soft layer makeup\",\"Hair Bonding\",\"Adance Data analysis operation.\",\"Company Profile Build\",\"Floor And Carpet Cleaning\"]', '[\"High Quality Products\",\"Quality Service\",\"Home Service Available\",\"Adance Data analysis operation.\",\"Floor And Carpet Cleaning\"]', '[\"Weeding soft layer makeup\",\"Hair Bonding\",\"Company Profile Build\",\"Adance Data analysis operation.\",\"Floor And Carpet Cleaning\"]', 1, '2022-10-03 03:34:32', '2022-11-06 03:47:43'),
(7, 1, NULL, 2, 'Our Cool Painting Service Only For You and Your Colorfull Home', 'our-cool-painting-service-only-for-you', 12, 'uploads/custom-images/Service-2022-10-03-03-43-20-7046.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 1, NULL, 0, 1, 0, 'Our Cool Painting Service Only For You', 'Our Cool Painting Service Only For You', '[\"Service Guaranty\",\"Quality Service\",\"Timely Work\",\"Chair And Table Cleaning\",\"Kitchenroom Cleaning\"]', '[\"Chair And Table Cleaning\",\"Kitchenroom Cleaning\",\"Page Load (time, size, number of requests).\",\"Company Profile Build\"]', '[\"Wall Painting 12x12\",\"Timely Work\",\"Quality Service\",\"Sofa And Divain Cleaning\",\"Chair And Table Cleaning\"]', 1, '2022-10-03 03:43:20', '2022-11-06 03:46:01'),
(8, 4, NULL, 2, 'Home Move Service From One City to Another City With Our Team', 'home-move-service-from-one-city-to-another-city', 12, 'uploads/custom-images/Service-2022-10-03-03-46-32-3041.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.</p>', 0, NULL, 1, 1, 0, 'Home Move Service From One City to Another City', 'Home Move Service From One City to Another City', '[\"Double Bed\",\"Single Bed\",\"Washroom Cleaning\",\"Adance Data analysis operation.\",\"Kitchenroom Cleaning\"]', '[\"Timely Work\",\"Quality Service\",\"Service Guaranty\",\"Washroom Cleaning\",\"Adance Data analysis operation.\"]', '[\"Fridge\",\"TV\",\"Single Bed\",\"Double Bed\",\"Washroom Cleaning\",\"Kitchenroom Cleaning\"]', 1, '2022-10-03 03:46:32', '2022-11-06 03:36:53'),
(9, 5, NULL, 2, 'Car Cleaning Service From Best Cleaner For Commercial cleaning', 'car-cleaning-service-from-best-cleaner', 24, 'uploads/custom-images/Service-2022-10-03-03-54-30-9825.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'Car Cleaning Service From Best Cleaner', 'Car Cleaning Service From Best Cleaner', '[\"Adance Data analysis operation\",\"Washroom Cleaning\",\"Chair And Table Cleaning\",\"Hair Cutting Boys\"]', '[\"Service Guaranty\",\"Quality Service\",\"Timely Work\",\"Adance Data analysis operation\"]', '[\"Car Wash\",\"Car inner Dry Wash\",\"Adance Data analysis operation\",\"Washroom Cleaning\",\"Chair And Table Cleaning\"]', 1, '2022-10-03 03:54:30', '2022-11-06 03:34:46'),
(10, 4, NULL, 2, 'Hair Cutting Service At Reasonable Price For Handsome People', 'hair-cutting-service-at-reasonable-price', 8, 'uploads/custom-images/Service-2022-10-03-04-03-43-3928.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 1, NULL, 0, 1, 0, 'Hair Cutting Service At Reasonable Price', 'Hair Cutting Service At Reasonable Price', '[\"Quality Service\",\"Coffee Offer\",\"Company Profile Build\",\"Possible procured her\",\"Adance Data analysis operation\"]', '[\"Adance Data analysis operation\",\"Possible procured her trifling Obtain pain\",\"Page Load (time, size, number of requests).\",\"Company Profile Build\"]', '[\"Hair Cutting Boys\",\"Hair Cutting Girls\",\"Washroom Cleaning\",\"Sofa And Divain Cleaning\",\"Floor And Carpet Cleaning\"]', 1, '2022-10-03 04:03:43', '2022-11-06 03:32:45'),
(11, 5, NULL, 2, 'AC Cleaning Service ! Get ASAP And Take The Best Benifits', 'ac-cleaning-service-get-asap-and-take-the-best-benifits', 15, 'uploads/custom-images/Service-2022-10-03-04-08-32-9969.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'AC Cleaning Service ! Get ASAP And Take The Best Benifits', 'AC Cleaning Service ! Get ASAP And Take The Best Benifits', '[\"Washroom Cleaning\",\"Page Load (time, size, number of requests).\",\"Company Profile Build\",\"Adance Data analysis operation.\",\"Page Load (time, size, number of requests)\"]', '[\"Home Service\",\"Service Gurantee\",\"Quality Service\",\"Page Load (time, size, number of requests)\",\"Kitchenroom Cleaning\"]', '[\"One Ton AC\",\"Two Ton AC\",\"Sofa And Divain Cleaning\",\"Floor And Carpet Cleaning\",\"Washroom Cleaning\"]', 1, '2022-10-03 04:08:32', '2022-11-06 03:27:57'),
(12, 6, NULL, 2, 'Grow your business at low cost from us ladies working as team', 'grow-your-business-at-low-cost-from-us', 12, 'uploads/custom-images/Service-2022-10-03-04-11-58-8828.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 1, NULL, 0, 1, 0, 'Grow your business at low cost from us', 'Grow your business at low cost from us', '[\"AC Change\",\"Ac Repair\",\"Floor And Carpet Cleaning\",\"Chair And Table Cleaning\",\"Sofa And Divain Cleaning\"]', '[\"Service Gurantee\",\"Quality Service\",\"Floor And Carpet Cleaning\",\"Chair And Table Cleaning\",\"Sofa And Divain Cleaning\"]', '[\"Business Module Build\",\"Reach Your Customer\",\"Branding Your Business\",\"Get Business Logic\",\"Floor And Carpet Cleaning\"]', 1, '2022-10-03 04:11:58', '2022-11-06 03:26:14'),
(13, 2, NULL, 2, 'Cleaning Your Old House From Our Expert Cleaner Team at Low Cost', 'cleaning-your-old-house-from-our-expert-cleaner-team-at-low-cost', 10, 'uploads/custom-images/Service-2023-05-24-11-33-28-9583.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.</p>', 1, NULL, 0, 1, 0, 'Cleaning Your Old House From Our Expert Cleaner Team at Low Cost', 'Cleaning Your Old House From Our Expert Cleaner Team at Low Cost', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2022-10-03 04:17:45', '2023-05-24 09:33:28'),
(14, 6, NULL, 2, 'Get Our TV Repair Service At Reasonable Price', 'get-our-tv-repair-service-at-reasonable-price', 10, 'uploads/custom-images/Service-2022-10-04-09-47-48-3934.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Get Our TV Repair Service At Reasonable Price', 'Get Our TV Repair Service At Reasonable Price', '[\"Chair And Table Cleaning\",\"Page Load (time, size, number of requests).\",\"Adance Data analysis operation.\",\"Company Profile Build\"]', '[\"Company Profile Build\",\"Adance Data analysis operation.\",\"Page Load (time, size, number of requests).\",\"Chair And Table Cleaning\"]', '[\"TV Wall Mount Installation\",\"LCD\\/LED TV Repair Services\",\"TV Full Service\",\"Floor And Carpet Cleaning\",\"Chair And Table Cleaning\"]', 1, '2022-10-03 21:47:48', '2023-01-13 21:58:10'),
(15, 2, NULL, 4, 'Winter AC Master Cleaning and  Servicing Service', 'winter-ac-master-cleaning-and-servicing-service', 28, 'uploads/custom-images/Service-2023-01-14-09-30-19-2452.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 1, NULL, 1, 1, 0, 'Winter AC Master Cleaning and  Servicing Service', 'Winter AC Master Cleaning and  Servicing Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-13 21:30:20', '2023-01-15 02:17:00'),
(16, 4, NULL, 4, 'Inverter AC Installation & Uninstallation Service', 'inverter-ac-installation-uninstallation-service', 65, 'uploads/custom-images/Service-2023-01-14-09-44-19-6302.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Inverter AC Installation & Uninstallation Service', 'Inverter AC Installation & Uninstallation Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-13 21:44:20', '2023-01-15 02:16:53'),
(17, 2, NULL, 4, 'Home & Outdoor Deep Cleaning Service', 'home-outdoor-deep-cleaning-service', 50, 'uploads/custom-images/Service-2023-01-14-09-46-57-2700.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 1, NULL, 0, 1, 0, 'Home & Outdoor Deep Cleaning Service', 'Home & Outdoor Deep Cleaning Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-13 21:46:57', '2023-01-15 02:16:45'),
(18, 5, NULL, 4, 'Car Dent, Paint and Repair  Service', 'car-dent-paint-and-repair-service', 40, 'uploads/custom-images/Service-2023-01-14-09-49-18-8993.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Car Dent, Paint and Repair  Service', 'Car Dent, Paint and Repair  Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-13 21:49:18', '2023-01-15 02:16:39'),
(19, 5, NULL, 4, 'Car Repair & Decoration Renovation Service', 'car-repair-decoration-renovation-service', 65, 'uploads/custom-images/Service-2023-01-14-09-52-03-2764.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Car Repair & Decoration Renovation Service', 'Car Repair & Decoration Renovation Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-13 21:52:04', '2023-01-15 02:16:29'),
(20, 6, NULL, 4, 'Electric and Gas Oven Setting Service', 'electric-and-gas-oven-setting-service', 15, 'uploads/custom-images/Service-2023-01-14-09-54-41-1144.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 1, 1, 0, 'Electric and Gas Oven Setting Service', 'Electric and Gas Oven Setting Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-13 21:54:41', '2023-01-15 02:16:21'),
(21, 6, NULL, 4, 'Electric Oven Repair & Fixing Service', 'electric-oven-repair-fixing-service', 20, 'uploads/custom-images/Service-2023-01-14-09-57-02-6815.webp', '<p>There are many variations of passages of Lo rem Ipsum available but the majorty have suffered in as some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anythng embarrassing as hidden in the middle of text.<br></p>', 0, NULL, 0, 1, 0, 'Electric Oven Repair & Fixing Service', 'Electric Oven Repair & Fixing Service', '[\"Kitchen Clean\",\"Roof Clean\",\"Kitchenroom Cleaning\",\"Possible procured her trifling Obtain pain.\",\"Company Profile Build\"]', '[\"Service Gurantee\",\"Quality Service\",\"Timely Work\",\"Company Profile Build\",\"Page Load (time, size, number of requests).\"]', '[\"Room Cleaning\",\"Roof Clean\",\"Kitchen Clean\",\"Washroom\",\"Kitchenroom Cleaning\"]', 1, '2023-01-13 21:57:03', '2023-01-15 02:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `service_areas`
--

DROP TABLE IF EXISTS `service_areas`;
CREATE TABLE IF NOT EXISTS `service_areas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL DEFAULT '0',
  `city_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_areas`
--

INSERT INTO `service_areas` (`id`, `provider_id`, `city_id`, `created_at`, `updated_at`) VALUES
(6, 4, 1, '2023-04-03 00:59:50', '2023-04-03 00:59:50'),
(7, 2, 2, '2023-04-03 01:04:58', '2023-04-03 01:04:58'),
(8, 2, 6, '2023-04-03 01:04:58', '2023-04-03 01:04:58'),
(9, 2, 7, '2023-04-03 01:04:58', '2023-04-03 01:04:58'),
(10, 4, 4, '2023-04-03 01:05:41', '2023-04-03 01:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'ABCServe', '2024-12-03 23:13:49', '2025-01-12 03:47:29'),
(2, 'version', '3.00', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(3, 'logo', 'uploads/website-images/logo-2022-09-07-04-23-36-4331.webp', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(4, 'timezone', 'Asia/Dhaka', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(5, 'date_format', 'Y-m-d', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(6, 'time_format', 'h:i A', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(7, 'favicon', 'uploads/website-images/favicon-2022-09-07-04-23-36-1566.webp', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(8, 'cookie_status', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(9, 'border', 'normal', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(10, 'corners', 'thin', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(11, 'background_color', '#184dec', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(12, 'text_color', '#fafafa', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(13, 'border_color', '#0a58d6', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(14, 'btn_bg_color', '#fffceb', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(15, 'btn_text_color', '#222758', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(16, 'link_text', 'More Info', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(17, 'btn_text', 'Yes', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(18, 'message', 'This website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only upon approval.', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(19, 'copyright_text', '2010-2025 aabcserve.com. All rights reserved.', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(20, 'recaptcha_site_key', 'recaptcha_site_key', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(21, 'recaptcha_secret_key', 'recaptcha_secret_key', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(22, 'recaptcha_status', 'inactive', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(23, 'tawk_status', 'inactive', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(24, 'tawk_chat_link', 'tawk_chat_link', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(25, 'googel_tag_status', 'inactive', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(26, 'googel_tag_id', 'google_tag_id', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(27, 'google_analytic_status', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(28, 'google_analytic_id', 'google_analytic_id', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(29, 'pixel_status', 'inactive', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(30, 'pixel_app_id', 'pixel_app_id', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(31, 'google_login_status', 'inactive', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(32, 'gmail_client_id', 'google_client_id', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(33, 'gmail_secret_id', 'google_secret_id', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(34, 'default_avatar', 'uploads/website-images/default-avatar.webp', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(35, 'breadcrumb_image', 'uploads/website-images/breadcrumb-image.webp', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(36, 'mail_host', 'sandbox.smtp.mailtrap.io', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(37, 'mail_sender_email', 'sender@gmail.com', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(38, 'mail_username', 'mail_username', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(39, 'mail_password', 'mail_password', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(40, 'mail_port', '2525', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(41, 'mail_encryption', 'ssl', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(42, 'mail_sender_name', 'WebSolutionUs', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
(43, 'contact_message_receiver_mail', 'receiver@gmail.com', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(44, 'pusher_app_id', 'pusher_app_id', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(45, 'pusher_app_key', 'pusher_app_key', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(46, 'pusher_app_secret', 'pusher_app_secret', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(47, 'pusher_app_cluster', 'pusher_app_cluster', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(48, 'pusher_status', 'inactive', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(49, 'club_point_rate', '1', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(50, 'club_point_status', 'active', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(51, 'maintenance_mode', '0', '2024-12-03 23:13:50', '2025-01-06 23:57:50'),
(52, 'maintenance_image', 'uploads/website-images/maintenance.webp', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(53, 'maintenance_title', 'Website Under maintenance', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(54, 'maintenance_description', '<p>We are currently performing maintenance on our website to<br>improve your experience. Please check back later.</p>\n            <p><a title=\"Websolutions\" href=\"https://websolutionus.com/\">Websolutions</a></p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(55, 'last_update_date', '2024-03-12 12:00:00', '2024-12-03 23:13:50', '2024-12-03 23:14:21'),
(56, 'is_queable', 'inactive', '2024-12-03 23:13:50', '2024-12-11 23:03:08'),
(57, 'comments_auto_approved', 'active', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(58, 'contact_team_member', 'active', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
(59, 'search_engine_indexing', 'inactive', '2024-12-03 23:13:50', '2025-01-06 23:28:28'),
(145, 'contact_email', 'contact@gmail.com', '2024-08-18 10:12:37', NULL),
(146, 'enable_subscription_notify', '1', '2024-08-18 10:12:37', NULL),
(147, 'enable_save_contact_message', '1', '2024-08-18 10:12:37', NULL),
(148, 'text_direction', 'ltr', '2024-08-18 10:12:37', NULL),
(149, 'sidebar_lg_header', 'Aabcserv', '2024-08-18 10:12:37', '2025-01-12 03:47:29'),
(150, 'sidebar_sm_header', 'AS', '2024-08-18 10:12:37', '2025-01-12 03:47:29'),
(151, 'topbar_phone', '+1347-430-9510', '2024-08-18 10:12:37', NULL),
(152, 'topbar_email', 'websolutionus1@gmail.com', '2024-08-18 10:12:37', NULL),
(153, 'opening_time', '10.00 AM-7.00PM', '2024-08-18 10:12:37', NULL),
(154, 'currency_name', 'USD', '2024-08-18 10:12:37', NULL),
(155, 'currency_icon', '$', '2024-08-18 10:12:37', NULL),
(156, 'currency_rate', '85.76', '2024-08-18 10:12:37', NULL),
(157, 'theme_one', '#009bc2', '2024-08-18 10:12:37', NULL),
(158, 'counter_bg_image', 'uploads/website-images/counter-bg--2022-09-29-12-43-47-5215.webp', '2024-08-18 10:12:37', NULL),
(159, 'join_as_a_provider_banner', 'uploads/website-images/join-provider-bg--2022-12-03-06-07-16-1842.webp', '2024-08-18 10:12:37', NULL),
(160, 'home2_join_as_provider', 'uploads/website-images/join-provider-home2bg--2022-10-04-10-15-33-5535.webp', '2024-08-18 10:12:37', NULL),
(161, 'home3_join_as_provider', 'uploads/website-images/join-provider-home2bg--2022-12-03-06-07-18-5741.webp', '2024-08-18 10:12:37', NULL),
(162, 'join_as_a_provider_title', 'Join with us to Sale your service & growth your Experience', '2024-08-18 10:12:37', NULL),
(163, 'join_as_a_provider_btn', 'Provider Joining', '2024-08-18 10:12:37', NULL),
(164, 'app_short_title', 'Download Now', '2024-08-18 10:12:37', NULL),
(165, 'app_full_title', 'App is available for free on Google Play & App Store', '2024-08-18 10:12:37', NULL),
(166, 'app_description', 'Get the latest resources for downloading, installing, and updating mosto app.Select your device platform & Use Our app and Enjoy Your Life.', '2024-08-18 10:12:37', NULL),
(167, 'google_playstore_link', 'https://play.google.com/store/apps/', '2024-08-18 10:12:37', NULL),
(168, 'app_store_link', 'https://www.apple.com/app-store/', '2024-08-18 10:12:37', NULL),
(169, 'app_image', 'uploads/website-images/mobile-app-bg--2022-08-29-01-17-54-3596.webp', '2024-08-18 10:12:37', NULL),
(170, 'home2_app_image', 'uploads/website-images/mobile-app-bg--2022-09-22-11-27-36-1745.webp', '2024-08-18 10:12:37', NULL),
(171, 'home3_app_image', 'uploads/website-images/mobile-app-bg--2022-09-22-11-27-52-2026.webp', '2024-08-18 10:12:37', NULL),
(172, 'subscriber_image', 'uploads/website-images/sub-foreground--2022-09-08-10-47-16-9543.webp', '2024-08-18 10:12:37', NULL),
(173, 'subscriber_title', 'Subscribe Now', '2024-08-18 10:12:37', NULL),
(174, 'subscriber_description', 'Get the updates, offers, tips and enhance your page building experience', '2024-08-18 10:12:37', NULL),
(175, 'subscription_bg', 'uploads/website-images/sub-background-2022-09-08-10-47-05-7260.webp', '2024-08-18 10:12:37', NULL),
(176, 'home2_subscription_bg', 'uploads/website-images/sub-background-2022-09-22-11-42-07-6877.webp', '2024-08-18 10:12:37', NULL),
(177, 'home3_subscription_bg', 'uploads/website-images/sub-background-2022-09-22-11-41-47-4054.webp', '2024-08-18 10:12:37', NULL),
(178, 'blog_page_subscription_image', 'uploads/website-images/blog-sub-background-2022-09-14-04-20-56-9366.webp', '2024-08-18 10:12:37', NULL),
(179, 'default_avatar', 'uploads/website-images/default-avatar-2022-12-25-04-17-13-8891.webp', '2024-08-18 10:12:37', NULL),
(180, 'home2_contact_foreground', 'uploads/website-images/home2-contact-foreground--2022-12-03-06-08-24-3082.webp', '2024-08-18 10:12:37', NULL),
(181, 'home2_contact_background', 'uploads/website-images/home2-contact-background-2022-09-22-12-08-16-6090.webp', '2024-08-18 10:12:37', NULL),
(182, 'home2_contact_call_as', 'Call as now', '2024-08-18 10:12:37', NULL),
(183, 'home2_contact_phone', '+90 456 789 251', '2024-08-18 10:12:37', NULL),
(184, 'home2_contact_available', 'We are available 24/7', '2024-08-18 10:12:37', NULL),
(185, 'home2_contact_form_title', 'Do you have any question ?', '2024-08-18 10:12:37', NULL),
(186, 'home2_contact_form_description', 'Fill the form now & Request an Estimate', '2024-08-18 10:12:37', NULL),
(187, 'how_it_work_background', 'uploads/website-images/home3-hiw-background-2022-09-22-12-52-40-5965.webp', '2024-08-18 10:12:37', NULL),
(188, 'how_it_work_foreground', 'uploads/website-images/home3-hiw-foreground--2022-09-29-01-06-00-1394.webp', '2024-08-18 10:12:37', NULL),
(189, 'how_it_work_title', 'Enjoy Services', '2024-08-18 10:12:37', NULL),
(190, 'how_it_work_description', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2024-08-18 10:12:37', NULL),
(191, 'how_it_work_items', '[{\"title\":\"Select The Service\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Pick Your Schedule\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Place Your Booking & Relax\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority haves\"}]', '2024-08-18 10:12:37', '2024-12-08 22:44:15'),
(192, 'selected_theme', '0', '2024-08-18 10:12:37', '2025-01-12 03:47:29'),
(193, 'theme_one_color', '#378fff', '2024-08-18 10:12:37', '2025-01-12 03:47:29'),
(194, 'theme_two_color', '#00bf8c', '2024-08-18 10:12:37', '2025-01-12 03:47:29'),
(195, 'theme_three_color', '#2251f2', '2024-08-18 10:12:37', '2025-01-12 03:47:29'),
(196, 'login_image', 'uploads/website-images/login-page-2022-11-06-04-12-11-6638.webp', '2024-08-18 10:12:37', NULL),
(197, 'currency_position', 'before_price', '2024-08-18 10:12:37', NULL),
(198, 'commission_type', 'commission', '2024-08-18 10:12:37', '2025-01-12 03:47:29'),
(199, 'live_chat', 'enable', '2024-08-18 10:12:37', '2025-01-12 03:47:29'),
(200, 'app_version', 'Version : 3.0', '2024-08-18 10:12:37', NULL),
(201, 'show_provider_contact_info', '1', '2025-01-09 11:06:49', '2025-01-12 03:47:29'),
(203, 'footer_logo', 'uploads/website-images/logo-2022-11-06-04-53-35-7489.webp', '2025-01-12 06:27:45', '2025-01-12 06:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `setting_translations`
--

DROP TABLE IF EXISTS `setting_translations`;
CREATE TABLE IF NOT EXISTS `setting_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_lg_header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_sm_header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_as_a_provider_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_as_a_provider_btn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_short_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_full_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subscriber_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscriber_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `home2_contact_call_as` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_contact_available` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_contact_form_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_contact_form_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `how_it_work_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `how_it_work_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `how_it_work_items` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_translations`
--

INSERT INTO `setting_translations` (`id`, `setting_id`, `lang_code`, `sidebar_lg_header`, `sidebar_sm_header`, `opening_time`, `join_as_a_provider_title`, `join_as_a_provider_btn`, `app_short_title`, `app_full_title`, `app_description`, `subscriber_title`, `subscriber_description`, `home2_contact_call_as`, `home2_contact_available`, `home2_contact_form_title`, `home2_contact_form_description`, `how_it_work_title`, `how_it_work_description`, `how_it_work_items`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Aabcserv', 'AS', '10.00 AM-7.00PM', 'Join with us to Sale your service & growth your Experience', 'Provider Joining', 'Download Now', 'App is available for free on Google Play & App Store', 'Get the latest resources for downloading, installing, and updating mosto app.Select your device platform & Use Our app and Enjoy Your Life.', 'Subscribe Now', 'Get the updates, offers, tips and enhance your page building experience', 'Call as now', 'We are available 24/7', 'Do you have any question ?', 'Fill the form now & Request an Estimate', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '[{\"title\":\"Select The Service\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Pick Your Schedule\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Place Your Booking & Relax\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"}]', '2024-12-30 23:19:12', '2024-12-30 23:19:12'),
(2, 1, 'bn', 'Aabcserv', 'AS', '10.00 AM-7.00PM', 'Join with us to Sale your service & growth your Experience', 'Provider Joining', 'Download Now', 'App is available for free on Google Play & App Store', 'Get the latest resources for downloading, installing, and updating mosto app.Select your device platform & Use Our app and Enjoy Your Life.', 'Subscribe naO', 'আপডেট, অফার, টিপস পান এবং আপনার পৃষ্ঠা তৈরির অভিজ্ঞতা বাড়ান৷', 'Call as noও', 'We are available 24/৭', 'Do you have any question ?', 'Fill the form now & Request an Estimate', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '[{\"title\":\"Select The \\u09b8\\u09be\\u09b0\\u09cd\\u09ad\\u09bf\\u09b8\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Pick Your Schedule\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"},{\"title\":\"Place Your Booking & Relax\",\"description\":\"There are many variations of passages of Lorem Ipsum available, but the majority have\"}]', '2024-12-30 23:19:12', '2025-01-01 00:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home3_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `popular_tag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `home2_image`, `home3_image`, `popular_tag`, `created_at`, `updated_at`) VALUES
(1, 'uploads/website-images/slider-2022-10-01-11-03-17-9020.webp', 'uploads/website-images/slider-2023-01-15-05-42-46-4524.webp', 'uploads/website-images/slider-2022-09-22-11-15-09-1295.webp', '[{\"value\":\"Painting\"},{\"value\":\"Cleaner\"},{\"value\":\"Home Move\"},{\"value\":\"Electronics\"}]', '2022-01-30 04:25:59', '2023-01-15 05:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `slider_translations`
--

DROP TABLE IF EXISTS `slider_translations`;
CREATE TABLE IF NOT EXISTS `slider_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `slider_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `header_one` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `header_two` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_service_sold` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider_translations`
--

INSERT INTO `slider_translations` (`id`, `slider_id`, `lang_code`, `title`, `description`, `header_one`, `header_two`, `total_service_sold`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Premium Service 24/7', 'There are many variations of passages of Lorem Ipsum available, but or randomised words which don\'t look', 'We Provide High Quality Professional', 'Services', '43434', '2024-12-24 08:21:04', '2024-12-24 08:21:04'),
(2, 1, 'bn', 'প্রিমিয়াম Service 24/7', 'There are many variations of passages of Lorem Ipsum available, but or randomised words which don\'t look', 'We Provide High Quality Professional', 'সার্ভিসেস', '৪৩৪৩৪', '2024-12-24 08:21:04', '2024-12-24 08:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `socialite_credentials`
--

DROP TABLE IF EXISTS `socialite_credentials`;
CREATE TABLE IF NOT EXISTS `socialite_credentials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `provider_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refresh_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

DROP TABLE IF EXISTS `social_links`;
CREATE TABLE IF NOT EXISTS `social_links` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_login_information`
--

DROP TABLE IF EXISTS `social_login_information`;
CREATE TABLE IF NOT EXISTS `social_login_information` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_facebook` int NOT NULL DEFAULT '0',
  `facebook_client_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook_secret_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_gmail` int NOT NULL DEFAULT '0',
  `gmail_client_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gmail_secret_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook_redirect_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gmail_redirect_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_login_information`
--

INSERT INTO `social_login_information` (`id`, `is_facebook`, `facebook_client_id`, `facebook_secret_id`, `is_gmail`, `gmail_client_id`, `gmail_secret_id`, `facebook_redirect_url`, `gmail_redirect_url`, `created_at`, `updated_at`) VALUES
(1, 1, '1844188565781706', 'f32f45abcf57a4dc23ac6f2b2e8e2241', 1, '810593187924-706in12herrovuq39i2pbn483otijei8.apps.googleusercontent.com', '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', 'http://localhost/web-solution-us/ecommerce_ibrahim/callback/google', 'http://localhost/web-solution-us/ecommerce_ibrahim/callback/google', NULL, '2022-01-22 13:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_histories`
--

DROP TABLE IF EXISTS `subscription_histories`;
CREATE TABLE IF NOT EXISTS `subscription_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `subscription_plan_id` int NOT NULL,
  `plan_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_price` double(8,2) NOT NULL,
  `expiration_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tax_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payable_subtotal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `gateway_charge` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payable_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payable_without_rate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `paid_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payable_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('pending','success','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending, success, rejected',
  `status` enum('pending','active','expired') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending, active, expired',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscription_histories_uuid_unique` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_histories`
--

INSERT INTO `subscription_histories` (`id`, `uuid`, `user_id`, `subscription_plan_id`, `plan_name`, `plan_price`, `expiration_date`, `expiration`, `payment_method`, `payment_details`, `tax_amount`, `payable_subtotal`, `gateway_charge`, `payable_amount`, `payable_without_rate`, `paid_amount`, `payable_currency`, `transaction`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ac754c8d-ff0f-47ce-96d4-23b6985bd8dd', 1001, 2, 'Basic', 9.99, '2024-09-26 10:28:54', '30', 'stripe', NULL, '0.1', '10.09', '0', '10.09', '10.09', '0', 'usd', NULL, 'pending', 'pending', '2024-11-25 06:32:55', '2024-11-25 06:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

DROP TABLE IF EXISTS `subscription_plans`;
CREATE TABLE IF NOT EXISTS `subscription_plans` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum_service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `plan_name`, `plan_price`, `expiration_date`, `maximum_service`, `status`, `serial`, `created_at`, `updated_at`) VALUES
(2, 'Premium', '29', 'yearly', '20', '1', '2', '2023-06-18 11:22:20', '2023-06-18 11:22:20'),
(3, 'Free', '0', 'monthly', '10', '1', '1', '2023-06-18 11:30:04', '2023-06-18 15:06:53'),
(4, 'Gold', '49', 'lifetime', '50', '1', '3', '2023-06-18 14:40:25', '2023-06-18 14:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `tawk_chats`
--

DROP TABLE IF EXISTS `tawk_chats`;
CREATE TABLE IF NOT EXISTS `tawk_chats` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `chat_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tawk_chats`
--

INSERT INTO `tawk_chats` (`id`, `chat_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'https://embed.tawk.to/5a7c31ded7591465c7077c48/default', 0, NULL, '2022-10-07 23:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
CREATE TABLE IF NOT EXISTS `taxes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` decimal(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax_translations`
--

DROP TABLE IF EXISTS `tax_translations`;
CREATE TABLE IF NOT EXISTS `tax_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tax_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tax_translations_tax_id_foreign` (`tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

DROP TABLE IF EXISTS `terms_and_conditions`;
CREATE TABLE IF NOT EXISTS `terms_and_conditions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `created_at`, `updated_at`) VALUES
(1, '2022-01-30 06:34:53', '2023-01-18 03:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_condition_translations`
--

DROP TABLE IF EXISTS `terms_and_condition_translations`;
CREATE TABLE IF NOT EXISTS `terms_and_condition_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `terms_and_condition_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_and_condition` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `privacy_policy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_condition_translations`
--

INSERT INTO `terms_and_condition_translations` (`id`, `terms_and_condition_id`, `lang_code`, `terms_and_condition`, `privacy_policy`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', '<p><strong>1. What Are Terms and Conditions?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. Does My Online Service Need Terms and Conditions?</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site.&nbsp;</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Lim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '<p><strong>1. What Are Privacy Policy?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. Ecommerce Terms and Conditions Examples</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2025-01-04 23:51:23', '2025-01-04 23:51:23'),
(2, 1, 'bn', '<p><strong>1. What Are Terms and Conditions?</strong></p>\r\n<p>লরিম অপসম is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. Does My Online Service Need Terms and Conditions?</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site.&nbsp;</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Lim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '<p><strong>1. What Are প্রাইভেসি Policy?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. Ecommerce Terms and Conditions Examples</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2025-01-04 23:51:23', '2025-01-05 00:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/custom-images/john-doe-20220929124436.webp', 1, '2022-09-29 00:44:37', '2022-11-06 01:37:38'),
(2, 'uploads/custom-images/david-richard-20220929124535.webp', 1, '2022-09-29 00:45:35', '2022-11-06 01:37:47'),
(3, 'uploads/custom-images/david-simmons-20220929124643.webp', 1, '2022-09-29 00:46:43', '2022-11-06 01:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_translations`
--

DROP TABLE IF EXISTS `testimonial_translations`;
CREATE TABLE IF NOT EXISTS `testimonial_translations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `testimonial_id` bigint UNSIGNED NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonial_translations`
--

INSERT INTO `testimonial_translations` (`id`, `testimonial_id`, `lang_code`, `name`, `designation`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'John Doe', 'MBBS, FCPS, FRCS', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:13:01'),
(2, 1, 'bn', 'জন ডো', 'MBBS, FCPS, FRCS', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:23:29'),
(3, 2, 'en', 'David Richard', 'Web Developer', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:13:01'),
(4, 2, 'bn', 'David Richard', 'Web Developer', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:13:01'),
(5, 3, 'en', 'David Simmons', 'Graphic Designer', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:13:01'),
(6, 3, 'bn', 'David Simmons', 'Graphic Designer', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `order_id`, `subject`, `ticket_id`, `ticket_from`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Subscribe Verification', '1635062237', 'Client', 'in_progress', '2022-10-04 22:25:49', '2022-10-04 22:41:04'),
(2, 1, 1, 'Client login issue', '837063363', 'Client', 'in_progress', '2022-10-04 22:44:18', '2022-10-04 22:44:49'),
(3, 1, 1, 'this is ticket subject', '429031825', 'Client', 'pending', '2022-11-08 23:55:22', '2022-11-08 23:55:22'),
(4, 2, 9, 'This is test ticket', '280534528', 'provider', 'pending', '2022-11-09 22:01:49', '2022-11-09 22:01:49'),
(5, 2, 9, 'this is subject', '685296566', 'provider', 'in_progress', '2022-11-09 22:24:43', '2024-02-18 15:35:25'),
(7, 1, 1, 'This is a subject field', '180042280', 'Client', 'pending', '2023-05-07 08:36:40', '2023-05-07 08:36:40'),
(22, 1, 117, 'Test Email', '518461685', 'Client', 'in_progress', '2024-04-24 08:05:50', '2024-04-24 08:13:03'),
(23, 2, 1, 'test support', '1026978045', 'provider', 'pending', '2024-09-02 23:47:12', '2024-09-02 23:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_messages`
--

DROP TABLE IF EXISTS `ticket_messages`;
CREATE TABLE IF NOT EXISTS `ticket_messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `user_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unseen_admin` int NOT NULL DEFAULT '0',
  `unseen_user` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_messages`
--

INSERT INTO `ticket_messages` (`id`, `ticket_id`, `user_id`, `admin_id`, `message`, `message_from`, `unseen_admin`, `unseen_user`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 'test message', 'client', 1, 1, '2022-10-04 22:25:49', '2023-06-15 00:44:58'),
(2, 1, 1, 1, 'Please share your problem', 'admin', 1, 1, '2022-10-04 22:41:04', '2023-06-15 00:44:58'),
(3, 1, 1, 1, 'Test message from support team', 'admin', 1, 1, '2022-10-04 22:43:36', '2023-06-15 00:44:58'),
(4, 2, 1, 0, 'I can\'t login your site, please help', 'client', 1, 1, '2022-10-04 22:44:18', '2023-01-14 21:18:08'),
(5, 2, 1, 1, 'We deactivate your account, You can\'t login.', 'admin', 1, 1, '2022-10-04 22:44:49', '2023-01-14 21:18:08'),
(6, 2, 1, 1, 'Please open file below', 'admin', 1, 1, '2022-10-04 23:10:49', '2023-01-14 21:18:08'),
(7, 2, 1, 0, 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO', 'client', 1, 1, '2022-10-04 23:45:22', '2023-01-14 21:18:08'),
(8, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-04 23:47:07', '2023-01-14 21:18:08'),
(9, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-04 23:47:24', '2023-01-14 21:18:08'),
(10, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-04 23:48:40', '2023-01-14 21:18:08'),
(11, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-04 23:48:57', '2023-01-14 21:18:08'),
(12, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-04 23:49:08', '2023-01-14 21:18:08'),
(13, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-10-04 23:49:15', '2023-01-14 21:18:08'),
(14, 2, 1, 0, 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO', 'client', 1, 1, '2022-10-04 23:50:05', '2023-01-14 21:18:08'),
(15, 2, 1, 0, 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO', 'client', 1, 1, '2022-10-04 23:51:33', '2023-01-14 21:18:08'),
(16, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-04 23:52:18', '2023-01-14 21:18:08'),
(17, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-04 23:54:01', '2023-01-14 21:18:08'),
(18, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-04 23:54:20', '2023-01-14 21:18:08'),
(19, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-04 23:54:38', '2023-01-14 21:18:08'),
(20, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-04 23:54:54', '2023-01-14 21:18:08'),
(21, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-04 23:55:39', '2023-01-14 21:18:08'),
(22, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-04 23:55:46', '2023-01-14 21:18:08'),
(23, 2, 1, 0, 'test', 'client', 1, 1, '2022-10-04 23:58:59', '2023-01-14 21:18:08'),
(24, 2, 1, 0, 'features like Laravel, customized website, PHP,', 'client', 1, 1, '2022-10-04 23:59:57', '2023-01-14 21:18:08'),
(25, 2, 1, 0, 'features like Laravel, customized website, PHP,', 'client', 1, 1, '2022-10-05 00:00:13', '2023-01-14 21:18:08'),
(26, 2, 1, 0, 'features like Laravel, customized website, PHP,', 'client', 1, 1, '2022-10-05 00:00:35', '2023-01-14 21:18:08'),
(27, 2, 1, 0, 'We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', 'client', 1, 1, '2022-10-05 00:01:31', '2023-01-14 21:18:08'),
(28, 2, 1, 0, 'We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', 'client', 1, 1, '2022-10-05 00:01:35', '2023-01-14 21:18:08'),
(29, 1, 1, 0, 'We are dedicated to work with all dynamic features like Laravel,', 'client', 1, 1, '2022-10-05 00:02:21', '2023-06-15 00:44:58'),
(30, 1, 1, 0, 'We are dedicated to work with all dynamic features like Laravel,', 'client', 1, 1, '2022-10-05 00:02:35', '2023-06-15 00:44:58'),
(31, 1, 1, 1, 'wait', 'admin', 1, 1, '2022-10-05 00:03:31', '2023-06-15 00:44:58'),
(32, 1, 1, 0, 'any update ?', 'client', 1, 1, '2022-10-05 04:48:00', '2023-06-15 00:44:58'),
(33, 3, 1, 0, 'this is ticket message', 'client', 0, 1, '2022-11-08 23:55:23', '2024-03-26 10:56:44'),
(34, 2, 1, 0, 'this is test message', 'client', 1, 1, '2022-11-09 00:04:24', '2023-01-14 21:18:08'),
(35, 4, 2, 0, 'This is test message', 'provider', 1, 1, '2022-11-09 22:01:49', '2024-04-24 08:12:35'),
(36, 4, 2, 0, 'are you there ?', 'provider', 1, 1, '2022-11-09 22:06:51', '2024-04-24 08:12:35'),
(37, 4, 2, 0, 'this is test message', 'provider', 1, 1, '2022-11-09 22:14:09', '2024-04-24 08:12:35'),
(38, 4, 2, 0, 'this is test message', 'provider', 1, 1, '2022-11-09 22:14:30', '2024-04-24 08:12:35'),
(39, 4, 2, 0, 'this is test message', 'provider', 1, 1, '2022-11-09 22:15:22', '2024-04-24 08:12:35'),
(40, 5, 2, 0, 'this is test message', 'provider', 1, 1, '2022-11-09 22:24:43', '2024-09-02 23:46:28'),
(41, 2, 1, 1, 'We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', 'admin', 1, 1, '2022-12-25 05:20:36', '2023-01-14 21:18:08'),
(43, 7, 1, 0, 'this is a message field..', 'client', 0, 1, '2023-05-07 08:36:40', '2024-03-26 10:56:37'),
(47, 9, 17, 0, 'this is message', 'provider', 0, 1, '2023-05-16 13:28:46', '2023-05-16 13:28:46'),
(48, 10, 17, 0, 'ddddd', 'provider', 0, 1, '2023-05-16 13:50:27', '2023-05-16 14:03:46'),
(49, 11, 17, 0, 'message', 'provider', 0, 1, '2023-05-16 14:03:32', '2023-05-16 14:03:32'),
(50, 12, 17, 0, 'message', 'provider', 0, 1, '2023-05-16 14:03:49', '2023-05-16 14:03:49'),
(51, 13, 17, 0, 'mmmmmmmmmmmm', 'provider', 0, 1, '2023-05-16 14:09:21', '2023-05-16 14:09:21'),
(61, 5, 2, 1, 'tyututyuty', 'admin', 1, 1, '2024-02-18 15:35:25', '2024-09-02 23:46:28'),
(62, 5, 2, 1, 'utyutyutyu', 'admin', 1, 1, '2024-02-18 15:35:32', '2024-09-02 23:46:28'),
(63, 22, 1, 0, 'drgdgdfg', 'client', 1, 1, '2024-04-24 08:05:50', '2024-07-07 17:23:04'),
(64, 22, 1, 1, 'hlw', 'admin', 1, 1, '2024-04-24 08:13:03', '2024-07-07 17:23:04'),
(65, 22, 1, 0, 'hi', 'client', 1, 1, '2024-04-24 08:13:24', '2024-07-07 17:23:04'),
(66, 22, 1, 1, 'cvbcvbcvb', 'admin', 1, 1, '2024-03-25 10:29:25', '2024-07-07 17:23:04'),
(67, 23, 2, 0, 'this is new test message', 'provider', 1, 1, '2024-09-02 23:47:12', '2024-12-13 23:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kyc_status` int DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forget_password_token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forget_password_otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `provider_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int DEFAULT '0',
  `state_id` int DEFAULT '0',
  `city_id` int DEFAULT '0',
  `zip_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_provider` int NOT NULL DEFAULT '0',
  `verify_token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_mail_verify_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified` int NOT NULL DEFAULT '0',
  `agree_policy` int DEFAULT '0',
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `kyc_status`, `email_verified_at`, `password`, `remember_token`, `forget_password_token`, `forget_password_otp`, `status`, `provider_id`, `provider`, `provider_avatar`, `image`, `phone`, `country_id`, `state_id`, `city_id`, `zip_code`, `address`, `is_provider`, `verify_token`, `otp_mail_verify_token`, `email_verified`, `agree_policy`, `designation`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', NULL, 'user@gmail.com', 0, NULL, '$2y$10$nBjBnvup0nEOKcYrryPQ4O2lAnm/m8M3T7/P1MW2qxlGU5wMViPAm', 'AYxCuZl2rlB792TfdVdYuEeD01wo4AP09hFRUdIMMUVbEsgtj1BdqfNVQemy', 'OdfAwBv0qZRt26ADKL3Vl9LIatjJjb7m6Js1oSSvhch0GXklY0dwM3Gs6XEnqxyiTwWYsjQ4fpqtzimE6CagXRnKbXQKof9ZtUkz', NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/john-doe-2023-05-08-10-44-45-5121.webp', '123-343-4444', 0, 0, 0, NULL, 'Florida City, FL, UK', 0, NULL, NULL, 1, 0, NULL, '2022-09-29 01:44:31', '2023-05-17 15:49:17'),
(2, 'David Simmons', 'david-simmons83', 'provider@gmail.com', 0, NULL, '$2y$10$Li84xiyyPQtlTfFPbQLZkeUsmwXr87YGc/mbzZ03Y8iakasaZY3yu', 'cVEMJKHT56mCjJMoHCOLfzWsB7zOb9Crlz6m1Y1OlbNmlXcLtaJM3jzFz1kR', NULL, NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/david-simmons-2023-05-07-10-44-34-5733.webp', '123-343-4444', 1, 1, 2, NULL, 'Los Angeles, CA, USAAAAA', 1, NULL, NULL, 1, 0, 'Electrician', '2022-09-29 01:44:31', '2023-05-16 11:59:29'),
(4, 'David Richard', 'david_richard', 'provider1@gmail.com', 0, NULL, '$2y$10$KVMjtClALn6AGJ4ObaUqpeq/RbbawUgkkMEOSjJs1dqS/A2F9ji5C', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/david-richard-2023-01-15-03-38-17-3004.webp', '123-343-4444', 1, 2, 1, NULL, 'Florida City, FL, USA', 1, NULL, NULL, 1, 0, 'Web Developer', '2022-10-04 00:24:21', '2023-01-15 03:38:17'),
(5, 'Daniel Paul', 'daniel_paul', 'provider2@gmail.com', 0, NULL, '$2y$10$SHHv2G/f/PRLQPwR.dnBIulyGdV1u2bo4fUNrpjJxcKsoEOE9JW3G', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '125-985-4587', 2, 5, 9, NULL, 'Gandhinagar, Gujarat, India', 1, NULL, NULL, 1, 0, 'Graphic Designer', '2022-10-04 00:45:34', '2022-10-04 00:55:05'),
(6, 'David Miller', 'david_miller', 'provider3@gmail.com', 0, NULL, '$2y$10$XROzn42ksW.wG3an5./30enVsC6OBBV2gUzWc7VXwj8UAZd5yrGse', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '123-343-4444', 1, 1, NULL, NULL, 'California, USA', 1, NULL, NULL, 1, 0, 'Web Developer', '2022-10-04 00:54:14', '2023-07-02 14:56:49'),
(7, 'Ken Williamson', 'testusername_14', 'ken@gmail.com', 0, NULL, '$2y$10$Os9CLodYJrxevTolDPG8TuT6Pr1URAqWx6BkLjlF2krAjiyk2TDmS', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '123-954-8745', 1, 3, 2, NULL, 'test address', 1, 'bSRkndxcC0PrO279K5WWEcE2B14uUCfPZrD3S4ffqtCdGHHzIJodPiJMIED1nXSspy7PGBZYHFLXfDPAC44oMgUUdL9s7h5vSn1H', NULL, 0, 0, 'electrician', '2022-11-08 02:46:47', '2024-12-05 01:02:27'),
(9, 'api user', NULL, 'apiuser@gmail.com', 0, NULL, '$2y$10$WE4c1puU88mGFD5jOULWEOuFMNfIo4SNiZNTNdsZlXW5ahHGiIbaS', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, '482031', 0, 0, NULL, '2022-11-09 01:24:14', '2022-11-09 01:24:14'),
(10, 'John Abraham', NULL, 'user1@gmail.com', 0, NULL, '$2y$10$u7XO20zsYqIRGAl8iJB4cu.K2Ip6BpBYKCJqvaijcQYn1vtHPV24m', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, 1, 0, NULL, '2023-01-09 03:34:55', '2023-01-09 03:35:55'),
(11, 'Food &amp; Drink', NULL, 'food&amp;and@gmail.com', 0, NULL, '$2y$10$Y.EJfizRPCj3d2T8J3teEuKBxJI.VKfp43eNtrmflXWDXjc51C8KO', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 0, 'GpOR1S9BXtLfoEEsg3DQyNlLMxorq5y1z59wPnTVLmCxFADXLnNbEtAvAwdEokYT6EAvWCwJbKgha82BI55PyuRT4K5ZF8TUQYKj', NULL, 0, 0, NULL, '2023-01-15 01:15:38', '2023-01-15 01:15:38'),
(16, 'Banglaeshi Cleaner', NULL, 'mapajiy811@jobbrett.com', 0, NULL, '$2y$10$ydWvTfYUL3CV/TwgTICgQu0L5lUItdt1.ZLpoastPy5Fe/EHxV5Pa', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/banglaeshi-cleaner-2023-05-07-05-52-31-9414.webp', '01712365478', 2, 4, 8, NULL, 'Dhaka, Bangladesh', 0, NULL, NULL, 1, 0, 'Developer', '2023-05-07 15:14:11', '2023-05-07 15:52:31'),
(25, 'Hello Cleaner', NULL, 'sexowic230@carpetra.com', 0, NULL, '$2y$10$XSjWUvTyQKVzL/aA9AnTFOn5M3PfLuypHAcK5WBnlt1SIsmuuh6KK', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'uploads/custom-images/hello-cleaner-2023-05-17-03-53-04-9256.webp', '01512376890', 4, 7, 10, NULL, 'Dhaka, Bangladesh', 0, NULL, NULL, 1, 0, 'Electrician', '2023-05-17 12:22:39', '2023-05-21 14:11:02'),
(26, 'Person User', NULL, 'nefed97472@andorem.com', 0, NULL, '$2y$10$ohPurecc9uH32qSPJbmjyeUQmDPGZVVXogfQhW1rCxAOyglk81z52', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '01512546988', 1, 1, 2, NULL, 'Dhaka, Bangladesh', 0, NULL, NULL, 1, 0, 'Electrician', '2023-05-21 13:17:55', '2023-05-21 14:21:39'),
(27, 'Jhon Harry', NULL, 'kadise2954@mevori.com', 0, NULL, '$2y$10$xqCdhmvr4yycCjHSjxOIweFvv2CIYPAXIAVvVDgL/KB4zekc7N5VW', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '01312345678', 0, 0, 0, NULL, 'California', 0, NULL, NULL, 1, 0, NULL, '2023-05-23 08:51:56', '2023-05-23 08:54:50'),
(28, 'Rashedul Islam', NULL, 'rashed4pa@gmail.com', 0, NULL, '$2y$10$rBkq79CA6pCe5BOVt9fSBea5rOCnSpVATvhavuvwgoFiA5JTfRgcW', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 1, 'C1I5lpgo8c6djO7FHeVBMnUjFRw1HPtZORYr8taAuEap5Epo14fvGBs4tu4rp3iUYBheDZv35aExQfPKJVf8QCQeIyH3nDuSzpp9', NULL, 0, 0, NULL, '2024-02-19 09:33:05', '2024-12-07 21:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

DROP TABLE IF EXISTS `withdraw_methods`;
CREATE TABLE IF NOT EXISTS `withdraw_methods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_amount` double NOT NULL DEFAULT '0',
  `max_amount` double NOT NULL DEFAULT '0',
  `withdraw_charge` double NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `name`, `min_amount`, `max_amount`, `withdraw_charge`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank', 10, 20, 1, '<p>Bank Name: Your bank name</p>\r\n<p><span style=\"background-color: transparent;\">Account Number:&nbsp; Your bank account number</span></p>\r\n<p>Routing Number: Your bank routing number</p>\r\n<p>Branch: Your bank branch name</p>', 1, '2022-10-07 21:15:37', '2024-12-08 01:58:04'),
(3, 'Mobile Bank', 10, 300, 4, '<p>Mobile banking</p>\r\n<p>Bank Name</p>', 1, '2023-05-07 13:36:11', '2023-05-07 13:36:11'),
(4, 'Cash On', 20, 400, 2, '<p>Cash On Delivery</p>\r\n<p>Pay you Your Cash.</p>', 1, '2023-05-07 14:12:02', '2023-05-07 14:12:02');

--
-- Constraints for dumped tables
--
--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tax_translations`
--
ALTER TABLE `tax_translations`
  ADD CONSTRAINT `tax_translations_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SET foreign_key_checks = 1;