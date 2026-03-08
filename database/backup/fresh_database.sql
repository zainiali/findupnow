-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               9.0.1 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table abcserv.abcs_settings
DROP TABLE IF EXISTS `abcs_settings`;
CREATE TABLE IF NOT EXISTS `abcs_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.abcs_settings: ~1 rows (approximately)
DELETE FROM `abcs_settings`;
INSERT INTO `abcs_settings` (`id`, `maintenance_mode`, `logo`, `favicon`, `contact_email`, `enable_subscription_notify`, `enable_save_contact_message`, `text_direction`, `timezone`, `sidebar_lg_header`, `sidebar_sm_header`, `topbar_phone`, `topbar_email`, `opening_time`, `currency_name`, `currency_icon`, `currency_rate`, `theme_one`, `counter_bg_image`, `join_as_a_provider_banner`, `home2_join_as_provider`, `home3_join_as_provider`, `join_as_a_provider_title`, `join_as_a_provider_btn`, `app_short_title`, `app_full_title`, `app_description`, `google_playstore_link`, `app_store_link`, `app_image`, `home2_app_image`, `home3_app_image`, `subscriber_image`, `subscriber_title`, `subscriber_description`, `subscription_bg`, `home2_subscription_bg`, `home3_subscription_bg`, `blog_page_subscription_image`, `default_avatar`, `home2_contact_foreground`, `home2_contact_background`, `home2_contact_call_as`, `home2_contact_phone`, `home2_contact_available`, `home2_contact_form_title`, `home2_contact_form_description`, `how_it_work_background`, `how_it_work_foreground`, `how_it_work_title`, `how_it_work_description`, `how_it_work_items`, `selected_theme`, `theme_one_color`, `theme_two_color`, `theme_three_color`, `login_image`, `footer_logo`, `created_at`, `updated_at`, `show_provider_contact_info`, `currency_position`, `commission_type`, `live_chat`, `app_version`) VALUES
	(1, 1, 'uploads/website-images/logo-2022-09-07-04-23-36-4331.webp', 'uploads/website-images/favicon-2022-09-07-04-23-36-1566.webp', 'contact@gmail.com', 1, 1, 'ltr', 'America/Los_Angeles', 'Aabcserv', 'AS', '+1347-430-9510', 'websolutionus1@gmail.com', '10.00 AM-7.00PM', 'USD', '$', 85.76, '#009bc2', 'uploads/website-images/counter-bg--2022-09-29-12-43-47-5215.webp', 'uploads/website-images/join-provider-bg--2022-12-03-06-07-16-1842.webp', 'uploads/website-images/join-provider-home2bg--2022-10-04-10-15-33-5535.webp', 'uploads/website-images/join-provider-home2bg--2022-12-03-06-07-18-5741.webp', 'Join with us to Sale your service & growth your Experience', 'Provider Joining', 'Download Now', 'App is available for free on Google Play & App Store', 'Get the latest resources for downloading, installing, and updating mosto app.Select your device platform & Use Our app and Enjoy Your Life.', 'https://play.google.com/store/apps/', 'https://www.apple.com/app-store/', 'uploads/website-images/mobile-app-bg--2022-08-29-01-17-54-3596.webp', 'uploads/website-images/mobile-app-bg--2022-09-22-11-27-36-1745.webp', 'uploads/website-images/mobile-app-bg--2022-09-22-11-27-52-2026.webp', 'uploads/website-images/sub-foreground--2022-09-08-10-47-16-9543.webp', 'সাবস্ক্রাইভ নাও', 'Get the updates, offers, tips and enhance your page building experience', 'uploads/website-images/sub-background-2022-09-08-10-47-05-7260.webp', 'uploads/website-images/sub-background-2022-09-22-11-42-07-6877.webp', 'uploads/website-images/sub-background-2022-09-22-11-41-47-4054.webp', 'uploads/website-images/blog-sub-background-2022-09-14-04-20-56-9366.webp', 'uploads/website-images/default-avatar-2022-12-25-04-17-13-8891.webp', 'uploads/website-images/home2-contact-foreground--2022-12-03-06-08-24-3082.webp', 'uploads/website-images/home2-contact-background-2022-09-22-12-08-16-6090.webp', 'Call as now', '+90 456 789 251', 'We are available 24/7', 'Do you have any question ?', 'Fill the form now & Request an Estimate', 'uploads/website-images/home3-hiw-background-2022-09-22-12-52-40-5965.webp', 'uploads/website-images/home3-hiw-foreground--2022-09-29-01-06-00-1394.webp', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '[{"title":"Select The Service","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"},{"title":"Pick Your Schedule","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"},{"title":"Place Your Booking & Relax","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"}]', 0, '#378fff', '#00bf8c', '#2251f2', 'uploads/website-images/login-page-2022-11-06-04-12-11-6638.webp', 'uploads/website-images/logo-2022-11-06-04-53-35-7489.webp', NULL, '2024-12-31 01:59:54', 1, 'before_price', 'subscription', 'enable', 'Version : 3.0');

-- Dumping structure for table abcserv.about_us
DROP TABLE IF EXISTS `about_us`;
CREATE TABLE IF NOT EXISTS `about_us` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.about_us: ~1 rows (approximately)
DELETE FROM `about_us`;
INSERT INTO `about_us` (`id`, `status`, `foreground_image`, `background_image`, `small_image_one`, `small_image_two`, `small_image_three`, `total_rating`, `why_choose_background`, `why_choose_foreground`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'uploads/website-images/about-us-foreground-2022-08-28-01-05-24-9243.webp', 'uploads/website-images/about-us-bg-2022-08-28-01-05-24-2606.webp', 'uploads/website-images/about-us-client-one-2022-08-28-01-13-54-7019.webp', 'uploads/website-images/about-us-client-one-2022-08-28-01-14-58-9497.webp', 'uploads/website-images/about-us-client-one-2022-08-28-01-14-58-4843.webp', '25k+', 'uploads/website-images/about-us-bg-2022-08-28-01-40-24-9733.webp', 'uploads/website-images/about-us-foreground-2022-08-28-01-40-33-7719.webp', '2022-01-30 06:30:23', '2024-12-04 00:16:35');

-- Dumping structure for table abcserv.about_us_translations
DROP TABLE IF EXISTS `about_us_translations`;
CREATE TABLE IF NOT EXISTS `about_us_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `about_us_id` bigint unsigned NOT NULL,
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

-- Dumping data for table abcserv.about_us_translations: ~2 rows (approximately)
DELETE FROM `about_us_translations`;
INSERT INTO `about_us_translations` (`id`, `about_us_id`, `lang_code`, `header`, `header_description`, `about_us_title`, `about_us`, `why_choose_us_title`, `why_choose_desciption`, `title_one`, `description_one`, `title_two`, `description_two`, `title_three`, `description_three`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', 'How It Works', 'There are many variations of passages of Lorem Ipsum available but the majority', 'Know About Us', '<p style="font-size: 16px; font-family: Roboto, sans-serif;">What sets Websolutionus apart, we believe in our commitment to providing actual value to our consumers. In the business, our dedication and quality are unrivaled. We\'re more than a technology service provider. We care as much about our customer&rsquo;s achievements as we do about our own, therefore we share business risks with them so they may take chances with technological innovations. We provide the following services.</p>\r\n<ul>\r\n<li>Laravel Website Development</li>\r\n<li>Mobile Application Development</li>\r\n<li>WordPress Theme Development</li>\r\n<li>Search Engine Optimization (SEO)</li>\r\n</ul>', 'There Some Reasons to Hire The Proeasy', '<p>We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc. We believe on just in time. We provide all web solutions accordingly and ensure the best service. We rely on new creation and the best management policy. We usually monitor the market and policies.</p>', 'Top-Rated Company', 'We offer low-cost services and cutting-edge technologies to help you improve your application and bring more value to your consumers', 'Superior Quality', 'We assist enterprises to decrease the risk of security events across the SDLC and launch internet solutions with protection.', 'Friendly Provide Services', 'We assist our customers to determine the right way for them and provide business eLearning solutions.', '2025-01-01 22:52:36', '2025-01-01 22:52:36'),
	(2, 1, 'bn', 'কিভাবে এটা কাজ করে', 'There are many variations of passages of Lorem Ipsum available but the majority', 'আমাদের সম্পর্কে জানুন', '<p style="font-size: 16px; font-family: Roboto, sans-serif;">What sets Websolutionus apart, we believe in our commitment to providing actual value to our consumers. In the business, our dedication and quality are unrivaled. We\'re more than a technology service provider. We care as much about our customer&rsquo;s achievements as we do about our own, therefore we share business risks with them so they may take chances with technological innovations. We provide the following services.</p>\r\n<ul>\r\n<li>Laravel Website Development</li>\r\n<li>Mobile Application Development</li>\r\n<li>WordPress Theme Development</li>\r\n<li>Search Engine Optimization (SEO)</li>\r\n</ul>', 'Proeasy ভাড়া করার কিছু কারণ আছে', '<p>We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc. We believe on just in time. We provide all web solutions accordingly and ensure the best service. We rely on new creation and the best management policy. We usually monitor the market and policies.</p>', 'Top-Rated Company', 'We offer low-cost services and cutting-edge technologies to help you improve your application and bring more value to your consumers', 'Superior Quality', 'We assist enterprises to decrease the risk of security events across the SDLC and launch internet solutions with protection.', 'Friendly Provide Services', 'We assist our customers to determine the right way for them and provide business eLearning solutions.', '2025-01-01 22:52:36', '2025-01-02 00:10:30');

-- Dumping structure for table abcserv.additional_services
DROP TABLE IF EXISTS `additional_services`;
CREATE TABLE IF NOT EXISTS `additional_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `service_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.additional_services: ~0 rows (approximately)
DELETE FROM `additional_services`;

-- Dumping structure for table abcserv.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.admins: ~0 rows (approximately)
DELETE FROM `admins`;

-- Dumping structure for table abcserv.appointment_schedules
DROP TABLE IF EXISTS `appointment_schedules`;
CREATE TABLE IF NOT EXISTS `appointment_schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.appointment_schedules: ~0 rows (approximately)
DELETE FROM `appointment_schedules`;

-- Dumping structure for table abcserv.banned_histories
DROP TABLE IF EXISTS `banned_histories`;
CREATE TABLE IF NOT EXISTS `banned_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reasone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.banned_histories: ~0 rows (approximately)
DELETE FROM `banned_histories`;

-- Dumping structure for table abcserv.banner_images
DROP TABLE IF EXISTS `banner_images`;
CREATE TABLE IF NOT EXISTS `banner_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.banner_images: ~15 rows (approximately)
DELETE FROM `banner_images`;
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

-- Dumping structure for table abcserv.basic_payments
DROP TABLE IF EXISTS `basic_payments`;
CREATE TABLE IF NOT EXISTS `basic_payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.basic_payments: ~19 rows (approximately)
DELETE FROM `basic_payments`;
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

-- Dumping structure for table abcserv.blogs
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.blogs: ~0 rows (approximately)
DELETE FROM `blogs`;

-- Dumping structure for table abcserv.blog_categories
DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.blog_categories: ~0 rows (approximately)
DELETE FROM `blog_categories`;

-- Dumping structure for table abcserv.blog_comments
DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.blog_comments: ~0 rows (approximately)
DELETE FROM `blog_comments`;

-- Dumping structure for table abcserv.breadcrumb_images
DROP TABLE IF EXISTS `breadcrumb_images`;
CREATE TABLE IF NOT EXISTS `breadcrumb_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_type` int NOT NULL DEFAULT '1',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.breadcrumb_images: ~12 rows (approximately)
DELETE FROM `breadcrumb_images`;
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

-- Dumping structure for table abcserv.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.categories: ~0 rows (approximately)
DELETE FROM `categories`;

-- Dumping structure for table abcserv.category_translations
DROP TABLE IF EXISTS `category_translations`;
CREATE TABLE IF NOT EXISTS `category_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `lang_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.category_translations: ~0 rows (approximately)
DELETE FROM `category_translations`;

-- Dumping structure for table abcserv.cities
DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country_state_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.cities: ~0 rows (approximately)
DELETE FROM `cities`;

-- Dumping structure for table abcserv.complete_requests
DROP TABLE IF EXISTS `complete_requests`;
CREATE TABLE IF NOT EXISTS `complete_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL,
  `order_id` int NOT NULL,
  `resone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.complete_requests: ~0 rows (approximately)
DELETE FROM `complete_requests`;

-- Dumping structure for table abcserv.configurations
DROP TABLE IF EXISTS `configurations`;
CREATE TABLE IF NOT EXISTS `configurations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `config` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.configurations: ~2 rows (approximately)
DELETE FROM `configurations`;
INSERT INTO `configurations` (`id`, `config`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'setup_stage', '1', '2024-12-03 23:13:51', '2024-12-03 23:14:31'),
	(2, 'setup_complete', '0', '2024-12-03 23:13:51', '2024-12-03 23:14:31');

-- Dumping structure for table abcserv.contact_messages
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.contact_messages: ~0 rows (approximately)
DELETE FROM `contact_messages`;

-- Dumping structure for table abcserv.contact_pages
DROP TABLE IF EXISTS `contact_pages`;
CREATE TABLE IF NOT EXISTS `contact_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.contact_pages: ~1 rows (approximately)
DELETE FROM `contact_pages`;
INSERT INTO `contact_pages` (`id`, `supporter_image`, `support_time`, `off_day`, `email`, `address`, `phone`, `map`, `created_at`, `updated_at`) VALUES
	(1, 'uploads/website-images/supporter--2022-08-28-02-04-43-1575.webp', '10.00AM to 07.00PM', 'Friday Off', 'websolutionus1@gmail.com\r\nwebsolutionus@gmail.com', '7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States', '+1347-430-9510\r\n+4247-100-9510', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.681138843672!2d-73.89482218459395!3d40.747041279328165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25f01328248b3%3A0x62300784dd275f96!2s7232%20Broadway%20%23%20308%2C%20Flushing%2C%20NY%2011372%2C%20USA!5e0!3m2!1sen!2sbd!4v1652467683397!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', '2022-01-30 06:31:58', '2022-09-29 00:01:31');

-- Dumping structure for table abcserv.cookie_consents
DROP TABLE IF EXISTS `cookie_consents`;
CREATE TABLE IF NOT EXISTS `cookie_consents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.cookie_consents: ~1 rows (approximately)
DELETE FROM `cookie_consents`;
INSERT INTO `cookie_consents` (`id`, `status`, `border`, `corners`, `background_color`, `text_color`, `border_color`, `btn_bg_color`, `btn_text_color`, `message`, `link_text`, `btn_text`, `link`, `created_at`, `updated_at`) VALUES
	(1, 1, 'thin', 'normal', '#184dec', '#fafafa', '#0a58d6', '#fffceb', '#222758', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the when an unknown printer took.', 'More Info', 'Yes', NULL, NULL, '2022-02-13 02:06:04');

-- Dumping structure for table abcserv.counters
DROP TABLE IF EXISTS `counters`;
CREATE TABLE IF NOT EXISTS `counters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.counters: ~4 rows (approximately)
DELETE FROM `counters`;
INSERT INTO `counters` (`id`, `icon`, `number`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'uploads/custom-images/counter--2022-09-29-12-40-42-5094.webp', '2547', 1, '2022-09-29 00:40:42', '2024-12-08 21:56:49'),
	(2, 'uploads/custom-images/counter--2022-09-29-12-41-15-9354.webp', '1532', 1, '2022-09-29 00:41:15', '2022-09-29 00:41:15'),
	(3, 'uploads/custom-images/counter--2022-09-29-12-41-37-4353.webp', '2103', 1, '2022-09-29 00:41:37', '2022-09-29 00:41:37'),
	(4, 'uploads/custom-images/counter--2022-09-29-12-42-06-6458.webp', '25', 1, '2022-09-29 00:42:06', '2022-09-29 00:42:06');

-- Dumping structure for table abcserv.counter_translations
DROP TABLE IF EXISTS `counter_translations`;
CREATE TABLE IF NOT EXISTS `counter_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `counter_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.counter_translations: ~8 rows (approximately)
DELETE FROM `counter_translations`;
INSERT INTO `counter_translations` (`id`, `counter_id`, `lang_code`, `title`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', 'Total Orders', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
	(2, 1, 'bn', 'মোট অর্ডার', '2024-12-24 23:16:03', '2025-01-01 00:39:39'),
	(3, 2, 'en', 'Active Clients', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
	(4, 2, 'bn', 'Active Clients', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
	(5, 3, 'en', 'Team Members', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
	(6, 3, 'bn', 'Team Members', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
	(7, 4, 'en', 'Years of Experience', '2024-12-24 23:16:03', '2024-12-24 23:16:03'),
	(8, 4, 'bn', 'Years of Experience', '2024-12-24 23:16:03', '2024-12-24 23:16:03');

-- Dumping structure for table abcserv.countries
DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.countries: ~0 rows (approximately)
DELETE FROM `countries`;

-- Dumping structure for table abcserv.country_states
DROP TABLE IF EXISTS `country_states`;
CREATE TABLE IF NOT EXISTS `country_states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.country_states: ~0 rows (approximately)
DELETE FROM `country_states`;

-- Dumping structure for table abcserv.coupons
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL DEFAULT '0',
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_percentage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.coupons: ~0 rows (approximately)
DELETE FROM `coupons`;

-- Dumping structure for table abcserv.coupon_histories
DROP TABLE IF EXISTS `coupon_histories`;
CREATE TABLE IF NOT EXISTS `coupon_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_id` int NOT NULL,
  `discount_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.coupon_histories: ~0 rows (approximately)
DELETE FROM `coupon_histories`;

-- Dumping structure for table abcserv.customizable_page_translations
DROP TABLE IF EXISTS `customizable_page_translations`;
CREATE TABLE IF NOT EXISTS `customizable_page_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customizeable_page_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customizable_page_translations_customizeable_page_id_index` (`customizeable_page_id`),
  KEY `customizable_page_translations_lang_code_index` (`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.customizable_page_translations: ~0 rows (approximately)
DELETE FROM `customizable_page_translations`;

-- Dumping structure for table abcserv.customizeable_pages
DROP TABLE IF EXISTS `customizeable_pages`;
CREATE TABLE IF NOT EXISTS `customizeable_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customizeable_pages_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.customizeable_pages: ~0 rows (approximately)
DELETE FROM `customizeable_pages`;

-- Dumping structure for table abcserv.custom_addons
DROP TABLE IF EXISTS `custom_addons`;
CREATE TABLE IF NOT EXISTS `custom_addons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.custom_addons: ~0 rows (approximately)
DELETE FROM `custom_addons`;

-- Dumping structure for table abcserv.custom_codes
DROP TABLE IF EXISTS `custom_codes`;
CREATE TABLE IF NOT EXISTS `custom_codes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `css` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `header_javascript` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `body_javascript` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `footer_javascript` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.custom_codes: ~1 rows (approximately)
DELETE FROM `custom_codes`;
INSERT INTO `custom_codes` (`id`, `css`, `header_javascript`, `body_javascript`, `footer_javascript`, `created_at`, `updated_at`) VALUES
	(1, '//write your css code here without the style tag', '//write your javascript here without the script tag', '//write your javascript here without the script tag', '//write your javascript here without the script tag', '2024-12-11 00:13:28', '2024-12-11 00:13:28');

-- Dumping structure for table abcserv.custom_paginations
DROP TABLE IF EXISTS `custom_paginations`;
CREATE TABLE IF NOT EXISTS `custom_paginations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.custom_paginations: ~6 rows (approximately)
DELETE FROM `custom_paginations`;
INSERT INTO `custom_paginations` (`id`, `page_name`, `qty`, `created_at`, `updated_at`) VALUES
	(1, 'Blog Page', 6, NULL, '2022-02-07 02:39:56'),
	(2, 'Service Page', 9, NULL, '2022-10-03 04:18:39'),
	(3, 'Provider Page', 8, NULL, '2022-02-06 20:14:01'),
	(4, 'Blog Comment', 4, NULL, '2022-09-14 21:06:58'),
	(5, 'Provider Review', 2, NULL, '2022-09-14 23:01:34'),
	(6, 'Language List', 50, '2024-12-15 10:31:57', '2024-12-15 04:33:04');

-- Dumping structure for table abcserv.email_templates
DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.email_templates: ~16 rows (approximately)
DELETE FROM `email_templates`;
INSERT INTO `email_templates` (`id`, `name`, `subject`, `message`, `created_at`, `updated_at`) VALUES
	(1, 'Password Reset', 'Password Reset', '<h4>Dear <b>{{name}}</b>,</h4>\r\n    <p>Do you want to reset your password? Please Click the following link and Reset Your Password.</p>', NULL, '2021-12-09 04:06:57'),
	(2, 'Contact Email', 'Contact Email', '<p>Name: <b>{{name}}</b></p><p>\r\n\r\nEmail: <b>{{email}}</b></p><p>\r\n\r\nPhone: <b>{{phone}}</b></p><p><span style="background-color: transparent;">Subject: <b>{{subject}}</b></span></p><p>\r\n\r\nMessage: <b>{{message}}</b></p>', NULL, '2021-12-10 17:44:34'),
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
	(24, 'social_login', 'Social Login', '<p>Hello {{user_name}},</p>\n                <p>Welcome to {{app_name}}! Your account has been created successfully.</p>\n                <p>Your password: {{password}}</p>\n                <p>You can log in to your account at <a href="https://websolutionus.com">https://websolutionus.com</a></p>\n                <p>Thank you for joining us.</p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
	(25, 'user_verification', 'User Verification', '<p>Dear {{user_name}},</p>\n                <p>Congratulations! Your account has been created successfully. Please click the following link to activate your account.</p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
	(26, 'approved_withdraw', 'Withdraw Request Approval', '<p>Dear {{user_name}},</p>\n                <p>We are happy to say that, we have send a withdraw amount to your provided bank information.</p>\n                <p>Thanks &amp; Regards</p>\n                <p>WebSolutionUs</p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50');

-- Dumping structure for table abcserv.error_pages
DROP TABLE IF EXISTS `error_pages`;
CREATE TABLE IF NOT EXISTS `error_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.error_pages: ~3 rows (approximately)
DELETE FROM `error_pages`;
INSERT INTO `error_pages` (`id`, `page_name`, `page_number`, `header`, `description`, `button_text`, `created_at`, `updated_at`) VALUES
	(1, '404 Error', '404', 'That Page Doesn\'t Exist!', 'Sorry, the page you were looking for could not be found.', 'Go to Home', NULL, '2021-12-12 22:25:14'),
	(2, '500 Error', '500', 'That Page Doesn\'t Exist!', 'Sorry, the page you were looking for could not be found.', 'Go to Home', NULL, '2021-12-06 03:46:52'),
	(3, '505 Error', '505', 'That Page Doesn\'t Exist!', 'Sorry, the page you were looking for could not be found.', 'Go to Home', NULL, '2021-12-06 03:46:57');

-- Dumping structure for table abcserv.facebook_comments
DROP TABLE IF EXISTS `facebook_comments`;
CREATE TABLE IF NOT EXISTS `facebook_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_type` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.facebook_comments: ~1 rows (approximately)
DELETE FROM `facebook_comments`;
INSERT INTO `facebook_comments` (`id`, `app_id`, `comment_type`, `created_at`, `updated_at`) VALUES
	(1, '882238482112522', 1, NULL, '2022-10-08 01:22:03');

-- Dumping structure for table abcserv.facebook_pixels
DROP TABLE IF EXISTS `facebook_pixels`;
CREATE TABLE IF NOT EXISTS `facebook_pixels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '0',
  `app_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.facebook_pixels: ~1 rows (approximately)
DELETE FROM `facebook_pixels`;
INSERT INTO `facebook_pixels` (`id`, `status`, `app_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '972911606915059', NULL, '2021-12-13 16:38:44');

-- Dumping structure for table abcserv.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table abcserv.faqs
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.faqs: ~0 rows (approximately)
DELETE FROM `faqs`;

-- Dumping structure for table abcserv.faq_translations
DROP TABLE IF EXISTS `faq_translations`;
CREATE TABLE IF NOT EXISTS `faq_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `faq_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.faq_translations: ~0 rows (approximately)
DELETE FROM `faq_translations`;

-- Dumping structure for table abcserv.footers
DROP TABLE IF EXISTS `footers`;
CREATE TABLE IF NOT EXISTS `footers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.footers: ~1 rows (approximately)
DELETE FROM `footers`;
INSERT INTO `footers` (`id`, `phone`, `email`, `address`, `about_us`, `first_column`, `second_column`, `third_column`, `copyright`, `payment_image`, `created_at`, `updated_at`) VALUES
	(1, '+1347-430-9510', 'websolutionus1@gmail.com', '7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States', 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc.  We rely on new creation and the best management policy. We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', 'Important Link', 'Quick Link', 'Our Service', 'Copyright 2022, Websolutionus. All Rights Reserved.', 'uploads/website-images/payment-card-2022-08-28-04-29-12-1387.webp', NULL, '2022-12-03 04:25:01');

-- Dumping structure for table abcserv.footer_links
DROP TABLE IF EXISTS `footer_links`;
CREATE TABLE IF NOT EXISTS `footer_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `column` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.footer_links: ~10 rows (approximately)
DELETE FROM `footer_links`;
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

-- Dumping structure for table abcserv.footer_social_links
DROP TABLE IF EXISTS `footer_social_links`;
CREATE TABLE IF NOT EXISTS `footer_social_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.footer_social_links: ~4 rows (approximately)
DELETE FROM `footer_social_links`;
INSERT INTO `footer_social_links` (`id`, `link`, `icon`, `created_at`, `updated_at`) VALUES
	(1, 'https://www.facebook.com/', 'fa fa-facebook', '2022-09-29 01:14:50', '2023-01-15 03:22:49'),
	(2, 'https://www.twitter.com/', 'fab fa-twitter', '2022-09-29 01:15:06', '2022-09-29 01:15:06'),
	(3, 'https://www.instagram.com/', 'fab fa-instagram', '2022-09-29 01:15:27', '2022-09-29 01:15:27'),
	(4, 'https://www.linkedin.com/', 'fa fa-linkedin', '2022-09-29 01:15:44', '2023-01-15 03:23:05');

-- Dumping structure for table abcserv.footer_translations
DROP TABLE IF EXISTS `footer_translations`;
CREATE TABLE IF NOT EXISTS `footer_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `footer_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_us` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.footer_translations: ~2 rows (approximately)
DELETE FROM `footer_translations`;
INSERT INTO `footer_translations` (`id`, `footer_id`, `lang_code`, `about_us`, `address`, `copyright`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', 'We are dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc.  We rely on new creation and the best management policy. We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', '7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States', 'Copyright 2022, Websolutionus. All Rights Reserved.', '2025-01-01 00:52:10', '2025-01-01 00:52:10'),
	(2, 1, 'bn', 'আমরা হলাম dedicated to work with all dynamic features like Laravel, customized website, PHP, SEO, etc.  We rely on new creation and the best management policy. We usually monitor the market and policies. We provide all web solutions accordingly and ensure the best service.', '7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States', 'Copyright 2022, Websolutionus. All Rights Reserved.', '2025-01-01 00:52:10', '2025-01-01 03:27:19');

-- Dumping structure for table abcserv.how_it_works
DROP TABLE IF EXISTS `how_it_works`;
CREATE TABLE IF NOT EXISTS `how_it_works` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.how_it_works: ~3 rows (approximately)
DELETE FROM `how_it_works`;
INSERT INTO `how_it_works` (`id`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'uploads/custom-images/how-it-work-2022-09-29-12-20-12-1071.webp', '2022-09-29 00:20:12', '2022-09-29 00:20:12'),
	(2, 'uploads/custom-images/how-it-work-2022-09-29-12-20-54-8399.webp', '2022-09-29 00:20:55', '2022-09-29 00:20:55'),
	(3, 'uploads/custom-images/how-it-work-2022-09-29-12-21-46-2428.webp', '2022-09-29 00:21:46', '2022-09-29 00:21:46');

-- Dumping structure for table abcserv.how_it_work_translations
DROP TABLE IF EXISTS `how_it_work_translations`;
CREATE TABLE IF NOT EXISTS `how_it_work_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `how_it_work_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.how_it_work_translations: ~6 rows (approximately)
DELETE FROM `how_it_work_translations`;
INSERT INTO `how_it_work_translations` (`id`, `how_it_work_id`, `lang_code`, `title`, `description`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', 'Online Booking', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:07:24'),
	(2, 2, 'en', 'Get Expert Cleaner', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:07:24'),
	(3, 3, 'en', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:07:24'),
	(4, 1, 'bn', 'অনলাইন বুকিং', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:30:06'),
	(5, 2, 'bn', 'Get Expert Cleaner', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:07:24'),
	(6, 3, 'bn', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '2025-01-02 03:07:24', '2025-01-02 03:07:24');

-- Dumping structure for table abcserv.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.jobs: ~2 rows (approximately)
DELETE FROM `jobs`;
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
	(1, 'default', '{"uuid":"c098f35f-a13e-4cc1-b1c5-02ba60c88df9","displayName":"App\\\\Events\\\\BuyerProviderMessage","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":14:{s:5:\\"event\\";O:31:\\"App\\\\Events\\\\BuyerProviderMessage\\":2:{s:4:\\"user\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":5:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:2;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";s:15:\\"collectionClass\\";N;}s:4:\\"data\\";a:1:{i:0;a:2:{s:8:\\"buyer_id\\";i:2;s:10:\\"message_id\\";i:0;}}}s:5:\\"tries\\";N;s:7:\\"timeout\\";N;s:7:\\"backoff\\";N;s:13:\\"maxExceptions\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:19:\\"chainCatchCallbacks\\";N;s:5:\\"delay\\";N;s:11:\\"afterCommit\\";N;s:10:\\"middleware\\";a:0:{}s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1734153762, 1734153762),
	(2, 'default', '{"uuid":"72371612-88b0-44ae-9a03-463211fdef0f","displayName":"App\\\\Events\\\\BuyerProviderMessage","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"Illuminate\\\\Broadcasting\\\\BroadcastEvent","command":"O:38:\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\":14:{s:5:\\"event\\";O:31:\\"App\\\\Events\\\\BuyerProviderMessage\\":2:{s:4:\\"user\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":5:{s:5:\\"class\\";s:15:\\"App\\\\Models\\\\User\\";s:2:\\"id\\";i:2;s:9:\\"relations\\";a:0:{}s:10:\\"connection\\";s:5:\\"mysql\\";s:15:\\"collectionClass\\";N;}s:4:\\"data\\";a:1:{i:0;a:2:{s:8:\\"buyer_id\\";i:2;s:10:\\"message_id\\";i:0;}}}s:5:\\"tries\\";N;s:7:\\"timeout\\";N;s:7:\\"backoff\\";N;s:13:\\"maxExceptions\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:19:\\"chainCatchCallbacks\\";N;s:5:\\"delay\\";N;s:11:\\"afterCommit\\";N;s:10:\\"middleware\\";a:0:{}s:7:\\"chained\\";a:0:{}}"}}', 0, NULL, 1734153767, 1734153767);

-- Dumping structure for table abcserv.job_posts
DROP TABLE IF EXISTS `job_posts`;
CREATE TABLE IF NOT EXISTS `job_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.job_posts: ~0 rows (approximately)
DELETE FROM `job_posts`;

-- Dumping structure for table abcserv.job_post_translations
DROP TABLE IF EXISTS `job_post_translations`;
CREATE TABLE IF NOT EXISTS `job_post_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_post_id` int NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.job_post_translations: ~0 rows (approximately)
DELETE FROM `job_post_translations`;

-- Dumping structure for table abcserv.job_requests
DROP TABLE IF EXISTS `job_requests`;
CREATE TABLE IF NOT EXISTS `job_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_post_id` int NOT NULL,
  `seller_id` int NOT NULL,
  `user_id` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `resume` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.job_requests: ~0 rows (approximately)
DELETE FROM `job_requests`;

-- Dumping structure for table abcserv.kyc_information
DROP TABLE IF EXISTS `kyc_information`;
CREATE TABLE IF NOT EXISTS `kyc_information` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kyc_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.kyc_information: ~0 rows (approximately)
DELETE FROM `kyc_information`;

-- Dumping structure for table abcserv.kyc_types
DROP TABLE IF EXISTS `kyc_types`;
CREATE TABLE IF NOT EXISTS `kyc_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.kyc_types: ~3 rows (approximately)
DELETE FROM `kyc_types`;
INSERT INTO `kyc_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Passport', 1, '2024-06-25 14:46:10', '2024-06-25 14:46:10'),
	(2, 'Driving Licience', 1, '2024-06-25 14:47:39', '2024-06-25 14:47:39'),
	(3, 'Nid', 1, '2024-06-25 14:47:47', '2024-06-25 14:47:47');

-- Dumping structure for table abcserv.languages
DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.languages: ~1 rows (approximately)
DELETE FROM `languages`;
INSERT INTO `languages` (`id`, `name`, `code`, `direction`, `status`, `is_default`, `created_at`, `updated_at`) VALUES
	(1, 'English', 'en', 'ltr', '1', '1', '2024-12-03 23:13:49', '2024-12-12 00:14:13');

-- Dumping structure for table abcserv.maintainance_texts
DROP TABLE IF EXISTS `maintainance_texts`;
CREATE TABLE IF NOT EXISTS `maintainance_texts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.maintainance_texts: ~1 rows (approximately)
DELETE FROM `maintainance_texts`;
INSERT INTO `maintainance_texts` (`id`, `status`, `image`, `description`, `created_at`, `updated_at`) VALUES
	(1, 0, 'uploads/website-images/maintainance-mode-2022-08-31-09-12-11-5142.webp', 'We are upgrading our site.  We will come back soon.  \r\nPlease stay with us. \r\nThank yous.', NULL, '2024-12-09 00:01:35');

-- Dumping structure for table abcserv.menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.menus: ~3 rows (approximately)
DELETE FROM `menus`;
INSERT INTO `menus` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Main Menu', 'main-menu', '2024-12-03 23:13:51', '2024-12-03 23:13:51'),
	(2, 'Quick Links', 'quick-link', '2025-03-05 14:22:58', '2025-03-05 14:22:59'),
	(3, 'Important Link', 'important-link', '2025-03-05 14:23:23', '2025-03-05 14:23:24');

-- Dumping structure for table abcserv.menu_items
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

-- Dumping data for table abcserv.menu_items: ~22 rows (approximately)
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

-- Dumping structure for table abcserv.menu_item_translations
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

-- Dumping data for table abcserv.menu_item_translations: ~44 rows (approximately)
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

-- Dumping structure for table abcserv.menu_translations
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

-- Dumping data for table abcserv.menu_translations: ~6 rows (approximately)
DELETE FROM `menu_translations`;
INSERT INTO `menu_translations` (`id`, `menu_id`, `lang_code`, `name`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', 'Main Menu', '2024-12-03 23:13:51', '2024-12-03 23:13:51'),
	(3, 1, 'bn', 'Main Menu', '2024-12-14 23:42:41', '2024-12-14 23:42:41'),
	(5, 2, 'en', 'Quick Link', '2025-03-05 14:25:47', '2025-03-05 14:25:47'),
	(6, 2, 'bn', 'Quick Link', '2025-03-05 14:25:47', '2025-03-05 14:25:47'),
	(7, 3, 'en', 'Importent Link', '2025-03-05 14:26:47', NULL),
	(8, 3, 'bn', 'Importent Link', '2025-03-05 14:26:47', NULL);

-- Dumping structure for table abcserv.messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.messages: ~0 rows (approximately)
DELETE FROM `messages`;

-- Dumping structure for table abcserv.message_documents
DROP TABLE IF EXISTS `message_documents`;
CREATE TABLE IF NOT EXISTS `message_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_message_id` int NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.message_documents: ~0 rows (approximately)
DELETE FROM `message_documents`;

-- Dumping structure for table abcserv.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.migrations: ~13 rows (approximately)
DELETE FROM `migrations`;
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

-- Dumping structure for table abcserv.mobile_sliders
DROP TABLE IF EXISTS `mobile_sliders`;
CREATE TABLE IF NOT EXISTS `mobile_sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `serial` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.mobile_sliders: ~3 rows (approximately)
DELETE FROM `mobile_sliders`;
INSERT INTO `mobile_sliders` (`id`, `image`, `status`, `serial`, `created_at`, `updated_at`) VALUES
	(1, 'uploads/custom-images/mb-slider-2023-02-02-01-17-30-2566.webp', 1, 2, '2023-02-02 00:55:00', '2023-02-02 01:17:30'),
	(3, 'uploads/custom-images/mb-slider-2023-02-02-01-17-19-2477.webp', 1, 1, '2023-02-02 01:17:19', '2023-02-02 01:18:26'),
	(4, 'uploads/custom-images/mb-slider-2023-02-02-01-18-15-4748.webp', 1, 10, '2023-02-02 01:18:16', '2023-02-02 01:18:36');

-- Dumping structure for table abcserv.mobile_slider_translations
DROP TABLE IF EXISTS `mobile_slider_translations`;
CREATE TABLE IF NOT EXISTS `mobile_slider_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mobile_slider_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_one` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_two` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.mobile_slider_translations: ~6 rows (approximately)
DELETE FROM `mobile_slider_translations`;
INSERT INTO `mobile_slider_translations` (`id`, `mobile_slider_id`, `lang_code`, `title_one`, `title_two`, `created_at`, `updated_at`) VALUES
	(1, 3, 'en', 'Digital marketing', 'Title Two', '2024-12-24 10:27:45', '2024-12-24 10:27:45'),
	(2, 3, 'bn', 'Digital marketing', 'Title Two', '2024-12-24 10:27:45', '2024-12-24 10:27:45'),
	(3, 1, 'en', 'Title One', 'Service', '2024-12-24 10:27:45', '2024-12-24 10:27:45'),
	(4, 1, 'bn', 'Title One', 'Service', '2024-12-24 10:27:45', '2024-12-24 10:27:45'),
	(5, 4, 'en', 'Wemen\'s Jeans Collection', '35% Offer', '2024-12-24 10:27:45', '2024-12-24 10:27:45'),
	(6, 4, 'bn', 'Wemen\'s Jeans Collection', '35% Offer', '2024-12-24 10:27:45', '2024-12-24 10:27:45');

-- Dumping structure for table abcserv.model_has_permissions
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.model_has_permissions: ~0 rows (approximately)
DELETE FROM `model_has_permissions`;

-- Dumping structure for table abcserv.model_has_roles
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.model_has_roles: ~0 rows (approximately)
DELETE FROM `model_has_roles`;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\Admin', 1);

-- Dumping structure for table abcserv.multi_currencies
DROP TABLE IF EXISTS `multi_currencies`;
CREATE TABLE IF NOT EXISTS `multi_currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.multi_currencies: ~6 rows (approximately)
DELETE FROM `multi_currencies`;
INSERT INTO `multi_currencies` (`id`, `currency_name`, `country_code`, `currency_code`, `currency_icon`, `is_default`, `currency_rate`, `currency_position`, `status`, `created_at`, `updated_at`) VALUES
	(1, '$-USD', 'US', 'USD', '$', 'yes', 1.00, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
	(2, '₦-Naira', 'NG', 'NGN', '₦', 'no', 417.35, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
	(3, '₹-Rupee', 'IN', 'INR', '₹', 'no', 74.66, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
	(4, '₱-Peso', 'PH', 'PHP', '₱', 'no', 55.07, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
	(5, '$-CAD', 'CA', 'CAD', '$', 'no', 1.27, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49'),
	(6, '৳-Taka', 'BD', 'BDT', '৳', 'no', 80.00, 'before_price', 'active', '2024-12-03 23:13:49', '2024-12-03 23:13:49');

-- Dumping structure for table abcserv.news_letters
DROP TABLE IF EXISTS `news_letters`;
CREATE TABLE IF NOT EXISTS `news_letters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_verified',
  `verify_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.news_letters: ~0 rows (approximately)
DELETE FROM `news_letters`;

-- Dumping structure for table abcserv.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.orders: ~0 rows (approximately)
DELETE FROM `orders`;

-- Dumping structure for table abcserv.partners
DROP TABLE IF EXISTS `partners`;
CREATE TABLE IF NOT EXISTS `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.partners: ~0 rows (approximately)
DELETE FROM `partners`;

-- Dumping structure for table abcserv.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table abcserv.payment_gateways
DROP TABLE IF EXISTS `payment_gateways`;
CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.payment_gateways: ~47 rows (approximately)
DELETE FROM `payment_gateways`;
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

-- Dumping structure for table abcserv.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.permissions: ~98 rows (approximately)
DELETE FROM `permissions`;
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

-- Dumping structure for table abcserv.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
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

-- Dumping data for table abcserv.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table abcserv.popular_posts
DROP TABLE IF EXISTS `popular_posts`;
CREATE TABLE IF NOT EXISTS `popular_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.popular_posts: ~0 rows (approximately)
DELETE FROM `popular_posts`;

-- Dumping structure for table abcserv.provider_client_reports
DROP TABLE IF EXISTS `provider_client_reports`;
CREATE TABLE IF NOT EXISTS `provider_client_reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.provider_client_reports: ~0 rows (approximately)
DELETE FROM `provider_client_reports`;

-- Dumping structure for table abcserv.provider_payment_gateways
DROP TABLE IF EXISTS `provider_payment_gateways`;
CREATE TABLE IF NOT EXISTS `provider_payment_gateways` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.provider_payment_gateways: ~0 rows (approximately)
DELETE FROM `provider_payment_gateways`;

-- Dumping structure for table abcserv.provider_withdraws
DROP TABLE IF EXISTS `provider_withdraws`;
CREATE TABLE IF NOT EXISTS `provider_withdraws` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.provider_withdraws: ~0 rows (approximately)
DELETE FROM `provider_withdraws`;

-- Dumping structure for table abcserv.purchase_histories
DROP TABLE IF EXISTS `purchase_histories`;
CREATE TABLE IF NOT EXISTS `purchase_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.purchase_histories: ~0 rows (approximately)
DELETE FROM `purchase_histories`;

-- Dumping structure for table abcserv.refund_requests
DROP TABLE IF EXISTS `refund_requests`;
CREATE TABLE IF NOT EXISTS `refund_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `order_id` int NOT NULL,
  `account_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `resone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'awaiting_for_admin_approval',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.refund_requests: ~0 rows (approximately)
DELETE FROM `refund_requests`;

-- Dumping structure for table abcserv.reviews
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `provider_id` int NOT NULL DEFAULT '0',
  `review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.reviews: ~0 rows (approximately)
DELETE FROM `reviews`;

-- Dumping structure for table abcserv.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.roles: ~0 rows (approximately)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'admin', '2024-12-03 23:13:50', '2024-12-03 23:13:50');

-- Dumping structure for table abcserv.role_has_permissions
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.role_has_permissions: ~98 rows (approximately)
DELETE FROM `role_has_permissions`;
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

-- Dumping structure for table abcserv.schedules
DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL,
  `day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_of_day` int NOT NULL,
  `start` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.schedules: ~0 rows (approximately)
DELETE FROM `schedules`;

-- Dumping structure for table abcserv.section_contents
DROP TABLE IF EXISTS `section_contents`;
CREATE TABLE IF NOT EXISTS `section_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.section_contents: ~5 rows (approximately)
DELETE FROM `section_contents`;
INSERT INTO `section_contents` (`id`, `section_name`, `created_at`, `updated_at`) VALUES
	(1, 'Category', NULL, '2023-01-14 22:23:04'),
	(2, 'Featured Service', NULL, '2022-11-06 01:11:42'),
	(3, 'Popular Service', NULL, '2022-11-06 01:11:48'),
	(4, 'Testimonial', NULL, '2022-11-06 01:11:56'),
	(5, 'Latest News', NULL, '2022-11-06 01:12:04');

-- Dumping structure for table abcserv.section_content_translations
DROP TABLE IF EXISTS `section_content_translations`;
CREATE TABLE IF NOT EXISTS `section_content_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_content_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.section_content_translations: ~10 rows (approximately)
DELETE FROM `section_content_translations`;
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

-- Dumping structure for table abcserv.section_controls
DROP TABLE IF EXISTS `section_controls`;
CREATE TABLE IF NOT EXISTS `section_controls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.section_controls: ~20 rows (approximately)
DELETE FROM `section_controls`;
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

-- Dumping structure for table abcserv.seo_settings
DROP TABLE IF EXISTS `seo_settings`;
CREATE TABLE IF NOT EXISTS `seo_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.seo_settings: ~5 rows (approximately)
DELETE FROM `seo_settings`;
INSERT INTO `seo_settings` (`id`, `page_name`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
	(1, 'Home Page', 'Home || WebSolutionUS', 'Home || WebSolutionUS', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
	(2, 'About Page', 'About || WebSolutionUS', 'About || WebSolutionUS', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
	(3, 'Contact Us', 'Contact Us - Service', 'Contact Us', NULL, '2022-09-27 04:12:07'),
	(5, 'Service', 'Our Service - Service', 'Our Service', NULL, '2022-09-27 04:19:48'),
	(6, 'Blog', 'Blog - Service', 'Blog', NULL, '2022-09-27 04:12:15');

-- Dumping structure for table abcserv.services
DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.services: ~0 rows (approximately)
DELETE FROM `services`;

-- Dumping structure for table abcserv.service_areas
DROP TABLE IF EXISTS `service_areas`;
CREATE TABLE IF NOT EXISTS `service_areas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int NOT NULL DEFAULT '0',
  `city_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.service_areas: ~0 rows (approximately)
DELETE FROM `service_areas`;

-- Dumping structure for table abcserv.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.settings: ~117 rows (approximately)
DELETE FROM `settings`;
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
	(54, 'maintenance_description', '<p>We are currently performing maintenance on our website to<br>improve your experience. Please check back later.</p>\n            <p><a title="Websolutions" href="https://websolutionus.com/">Websolutions</a></p>', '2024-12-03 23:13:50', '2024-12-03 23:13:50'),
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
	(191, 'how_it_work_items', '[{"title":"Select The Service","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"},{"title":"Pick Your Schedule","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"},{"title":"Place Your Booking & Relax","description":"There are many variations of passages of Lorem Ipsum available, but the majority haves"}]', '2024-08-18 10:12:37', '2024-12-08 22:44:15'),
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

-- Dumping structure for table abcserv.setting_translations
DROP TABLE IF EXISTS `setting_translations`;
CREATE TABLE IF NOT EXISTS `setting_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `setting_id` bigint unsigned NOT NULL,
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

-- Dumping data for table abcserv.setting_translations: ~2 rows (approximately)
DELETE FROM `setting_translations`;
INSERT INTO `setting_translations` (`id`, `setting_id`, `lang_code`, `sidebar_lg_header`, `sidebar_sm_header`, `opening_time`, `join_as_a_provider_title`, `join_as_a_provider_btn`, `app_short_title`, `app_full_title`, `app_description`, `subscriber_title`, `subscriber_description`, `home2_contact_call_as`, `home2_contact_available`, `home2_contact_form_title`, `home2_contact_form_description`, `how_it_work_title`, `how_it_work_description`, `how_it_work_items`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', 'Aabcserv', 'AS', '10.00 AM-7.00PM', 'Join with us to Sale your service & growth your Experience', 'Provider Joining', 'Download Now', 'App is available for free on Google Play & App Store', 'Get the latest resources for downloading, installing, and updating mosto app.Select your device platform & Use Our app and Enjoy Your Life.', 'Subscribe Now', 'Get the updates, offers, tips and enhance your page building experience', 'Call as now', 'We are available 24/7', 'Do you have any question ?', 'Fill the form now & Request an Estimate', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '[{"title":"Select The Service","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"},{"title":"Pick Your Schedule","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"},{"title":"Place Your Booking & Relax","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"}]', '2024-12-30 23:19:12', '2024-12-30 23:19:12'),
	(2, 1, 'bn', 'Aabcserv', 'AS', '10.00 AM-7.00PM', 'Join with us to Sale your service & growth your Experience', 'Provider Joining', 'Download Now', 'App is available for free on Google Play & App Store', 'Get the latest resources for downloading, installing, and updating mosto app.Select your device platform & Use Our app and Enjoy Your Life.', 'Subscribe naO', 'আপডেট, অফার, টিপস পান এবং আপনার পৃষ্ঠা তৈরির অভিজ্ঞতা বাড়ান৷', 'Call as noও', 'We are available 24/৭', 'Do you have any question ?', 'Fill the form now & Request an Estimate', 'Enjoy Services', 'If you are going to use a passage of you need to be sure there isn\'t anything emc barrassing hidden in the middle', '[{"title":"Select The \\u09b8\\u09be\\u09b0\\u09cd\\u09ad\\u09bf\\u09b8","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"},{"title":"Pick Your Schedule","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"},{"title":"Place Your Booking & Relax","description":"There are many variations of passages of Lorem Ipsum available, but the majority have"}]', '2024-12-30 23:19:12', '2025-01-01 00:40:10');

-- Dumping structure for table abcserv.sliders
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home2_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home3_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `popular_tag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.sliders: ~1 rows (approximately)
DELETE FROM `sliders`;
INSERT INTO `sliders` (`id`, `image`, `home2_image`, `home3_image`, `popular_tag`, `created_at`, `updated_at`) VALUES
	(1, 'uploads/website-images/slider-2022-10-01-11-03-17-9020.webp', 'uploads/website-images/slider-2023-01-15-05-42-46-4524.webp', 'uploads/website-images/slider-2022-09-22-11-15-09-1295.webp', '[{"value":"Painting"},{"value":"Cleaner"},{"value":"Home Move"},{"value":"Electronics"}]', '2022-01-30 04:25:59', '2023-01-15 05:42:48');

-- Dumping structure for table abcserv.slider_translations
DROP TABLE IF EXISTS `slider_translations`;
CREATE TABLE IF NOT EXISTS `slider_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slider_id` bigint unsigned NOT NULL,
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

-- Dumping data for table abcserv.slider_translations: ~2 rows (approximately)
DELETE FROM `slider_translations`;
INSERT INTO `slider_translations` (`id`, `slider_id`, `lang_code`, `title`, `description`, `header_one`, `header_two`, `total_service_sold`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', 'Premium Service 24/7', 'There are many variations of passages of Lorem Ipsum available, but or randomised words which don\'t look', 'We Provide High Quality Professional', 'Services', '43434', '2024-12-24 08:21:04', '2024-12-24 08:21:04'),
	(2, 1, 'bn', 'প্রিমিয়াম Service 24/7', 'There are many variations of passages of Lorem Ipsum available, but or randomised words which don\'t look', 'We Provide High Quality Professional', 'সার্ভিসেস', '৪৩৪৩৪', '2024-12-24 08:21:04', '2024-12-24 08:40:50');

-- Dumping structure for table abcserv.socialite_credentials
DROP TABLE IF EXISTS `socialite_credentials`;
CREATE TABLE IF NOT EXISTS `socialite_credentials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `provider_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refresh_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.socialite_credentials: ~0 rows (approximately)
DELETE FROM `socialite_credentials`;

-- Dumping structure for table abcserv.social_links
DROP TABLE IF EXISTS `social_links`;
CREATE TABLE IF NOT EXISTS `social_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.social_links: ~0 rows (approximately)
DELETE FROM `social_links`;

-- Dumping structure for table abcserv.social_login_information
DROP TABLE IF EXISTS `social_login_information`;
CREATE TABLE IF NOT EXISTS `social_login_information` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.social_login_information: ~1 rows (approximately)
DELETE FROM `social_login_information`;
INSERT INTO `social_login_information` (`id`, `is_facebook`, `facebook_client_id`, `facebook_secret_id`, `is_gmail`, `gmail_client_id`, `gmail_secret_id`, `facebook_redirect_url`, `gmail_redirect_url`, `created_at`, `updated_at`) VALUES
	(1, 1, '1844188565781706', 'f32f45abcf57a4dc23ac6f2b2e8e2241', 1, '810593187924-706in12herrovuq39i2pbn483otijei8.apps.googleusercontent.com', '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', 'http://localhost/web-solution-us/ecommerce_ibrahim/callback/google', 'http://localhost/web-solution-us/ecommerce_ibrahim/callback/google', NULL, '2022-01-22 13:38:19');

-- Dumping structure for table abcserv.subscription_histories
DROP TABLE IF EXISTS `subscription_histories`;
CREATE TABLE IF NOT EXISTS `subscription_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.subscription_histories: ~1 rows (approximately)
DELETE FROM `subscription_histories`;
INSERT INTO `subscription_histories` (`id`, `uuid`, `user_id`, `subscription_plan_id`, `plan_name`, `plan_price`, `expiration_date`, `expiration`, `payment_method`, `payment_details`, `tax_amount`, `payable_subtotal`, `gateway_charge`, `payable_amount`, `payable_without_rate`, `paid_amount`, `payable_currency`, `transaction`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'ac754c8d-ff0f-47ce-96d4-23b6985bd8dd', 1001, 2, 'Basic', 9.99, '2024-09-26 10:28:54', '30', 'stripe', NULL, '0.1', '10.09', '0', '10.09', '10.09', '0', 'usd', NULL, 'pending', 'pending', '2024-11-25 06:32:55', '2024-11-25 06:32:55');

-- Dumping structure for table abcserv.subscription_plans
DROP TABLE IF EXISTS `subscription_plans`;
CREATE TABLE IF NOT EXISTS `subscription_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum_service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.subscription_plans: ~0 rows (approximately)
DELETE FROM `subscription_plans`;

-- Dumping structure for table abcserv.tawk_chats
DROP TABLE IF EXISTS `tawk_chats`;
CREATE TABLE IF NOT EXISTS `tawk_chats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chat_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.tawk_chats: ~1 rows (approximately)
DELETE FROM `tawk_chats`;
INSERT INTO `tawk_chats` (`id`, `chat_link`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'https://embed.tawk.to/5a7c31ded7591465c7077c48/default', 0, NULL, '2022-10-07 23:54:40');

-- Dumping structure for table abcserv.taxes
DROP TABLE IF EXISTS `taxes`;
CREATE TABLE IF NOT EXISTS `taxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` decimal(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.taxes: ~0 rows (approximately)
DELETE FROM `taxes`;

-- Dumping structure for table abcserv.tax_translations
DROP TABLE IF EXISTS `tax_translations`;
CREATE TABLE IF NOT EXISTS `tax_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tax_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tax_translations_tax_id_foreign` (`tax_id`),
  CONSTRAINT `tax_translations_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.tax_translations: ~0 rows (approximately)
DELETE FROM `tax_translations`;

-- Dumping structure for table abcserv.terms_and_conditions
DROP TABLE IF EXISTS `terms_and_conditions`;
CREATE TABLE IF NOT EXISTS `terms_and_conditions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.terms_and_conditions: ~1 rows (approximately)
DELETE FROM `terms_and_conditions`;
INSERT INTO `terms_and_conditions` (`id`, `created_at`, `updated_at`) VALUES
	(1, '2022-01-30 06:34:53', '2023-01-18 03:15:25');

-- Dumping structure for table abcserv.terms_and_condition_translations
DROP TABLE IF EXISTS `terms_and_condition_translations`;
CREATE TABLE IF NOT EXISTS `terms_and_condition_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `terms_and_condition_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_and_condition` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `privacy_policy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.terms_and_condition_translations: ~2 rows (approximately)
DELETE FROM `terms_and_condition_translations`;
INSERT INTO `terms_and_condition_translations` (`id`, `terms_and_condition_id`, `lang_code`, `terms_and_condition`, `privacy_policy`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', '<p><strong>1. What Are Terms and Conditions?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. Does My Online Service Need Terms and Conditions?</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site.&nbsp;</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Lim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '<p><strong>1. What Are Privacy Policy?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. Ecommerce Terms and Conditions Examples</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2025-01-04 23:51:23', '2025-01-04 23:51:23'),
	(2, 1, 'bn', '<p><strong>1. What Are Terms and Conditions?</strong></p>\r\n<p>লরিম অপসম is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. Does My Online Service Need Terms and Conditions?</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site.&nbsp;</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Lim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '<p><strong>1. What Are প্রাইভেসি Policy?</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>2. Ecommerce Terms and Conditions Examples</strong></p>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<p><strong>Features :</strong></p>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<p><strong>3. Protect Your Property</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p><strong>4. What to Include in Terms and Conditions for Online Stores</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<p><strong>05.Pricing and Payment Terms</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2025-01-04 23:51:23', '2025-01-05 00:04:02');

-- Dumping structure for table abcserv.testimonials
DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.testimonials: ~0 rows (approximately)
DELETE FROM `testimonials`;

-- Dumping structure for table abcserv.testimonial_translations
DROP TABLE IF EXISTS `testimonial_translations`;
CREATE TABLE IF NOT EXISTS `testimonial_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `testimonial_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.testimonial_translations: ~6 rows (approximately)
DELETE FROM `testimonial_translations`;
INSERT INTO `testimonial_translations` (`id`, `testimonial_id`, `lang_code`, `name`, `designation`, `comment`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', 'John Doe', 'MBBS, FCPS, FRCS', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:13:01'),
	(2, 1, 'bn', 'জন ডো', 'MBBS, FCPS, FRCS', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:23:29'),
	(3, 2, 'en', 'David Richard', 'Web Developer', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:13:01'),
	(4, 2, 'bn', 'David Richard', 'Web Developer', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:13:01'),
	(5, 3, 'en', 'David Simmons', 'Graphic Designer', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:13:01'),
	(6, 3, 'bn', 'David Simmons', 'Graphic Designer', 'There are mainy variatons of passages of abut the majority have suffereds alteration in humour, or randomisejd words which rando generators on the Internet tend', '2024-12-25 00:13:01', '2024-12-25 00:13:01');

-- Dumping structure for table abcserv.tickets
DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.tickets: ~0 rows (approximately)
DELETE FROM `tickets`;

-- Dumping structure for table abcserv.ticket_messages
DROP TABLE IF EXISTS `ticket_messages`;
CREATE TABLE IF NOT EXISTS `ticket_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.ticket_messages: ~0 rows (approximately)
DELETE FROM `ticket_messages`;

-- Dumping structure for table abcserv.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table abcserv.users: ~0 rows (approximately)
DELETE FROM `users`;

-- Dumping structure for table abcserv.withdraw_methods
DROP TABLE IF EXISTS `withdraw_methods`;
CREATE TABLE IF NOT EXISTS `withdraw_methods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table abcserv.withdraw_methods: ~3 rows (approximately)
DELETE FROM `withdraw_methods`;
INSERT INTO `withdraw_methods` (`id`, `name`, `min_amount`, `max_amount`, `withdraw_charge`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Bank', 10, 20, 1, '<p>Bank Name: Your bank name</p>\r\n<p><span style="background-color: transparent;">Account Number:&nbsp; Your bank account number</span></p>\r\n<p>Routing Number: Your bank routing number</p>\r\n<p>Branch: Your bank branch name</p>', 1, '2022-10-07 21:15:37', '2024-12-08 01:58:04'),
	(3, 'Mobile Bank', 10, 300, 4, '<p>Mobile banking</p>\r\n<p>Bank Name</p>', 1, '2023-05-07 13:36:11', '2023-05-07 13:36:11'),
	(4, 'Cash On', 20, 400, 2, '<p>Cash On Delivery</p>\r\n<p>Pay you Your Cash.</p>', 1, '2023-05-07 14:12:02', '2023-05-07 14:12:02');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
