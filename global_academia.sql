-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 02, 2022 at 11:43 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `global_academia`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_invitations`
--

CREATE TABLE `admin_invitations` (
  `id` int(11) NOT NULL,
  `code` varchar(300) NOT NULL DEFAULT '0',
  `posted` varchar(50) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `agent_requests`
--

CREATE TABLE `agent_requests` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `approved` tinyint(4) DEFAULT '0',
  `created_at` varchar(150) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent_requests`
--

INSERT INTO `agent_requests` (`id`, `user_id`, `approved`, `created_at`, `seen`, `status`) VALUES
(1, '10', 0, '1646294386', 0, 1),
(2, '12', 0, '1648314041', 0, 0),
(3, '13', 0, '1648314146', 0, 0),
(4, '14', 0, '1648315045', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `agent_students`
--

CREATE TABLE `agent_students` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `date_of_birth` varchar(250) DEFAULT NULL,
  `phone_number` varchar(250) DEFAULT NULL,
  `phone_number_2` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `fathers_name` varchar(250) DEFAULT NULL,
  `mothers_name` varchar(250) DEFAULT NULL,
  `passport_number` varchar(250) DEFAULT NULL,
  `nationality` varchar(250) DEFAULT NULL,
  `country_of_residence` varchar(250) DEFAULT NULL,
  `id_photo` varchar(250) DEFAULT NULL,
  `passport_file` varchar(250) DEFAULT NULL,
  `transcript_file` varchar(250) DEFAULT NULL,
  `diploma_file` varchar(250) DEFAULT NULL,
  `other_files` int(11) DEFAULT NULL,
  `middle_name` varchar(250) DEFAULT NULL,
  `application_no` varchar(255) DEFAULT NULL,
  `status` varchar(250) DEFAULT 'awaiting_approval',
  `note` text,
  `signed_by` varchar(250) DEFAULT NULL,
  `is_notified` int(11) NOT NULL DEFAULT '0',
  `isClosed` int(11) NOT NULL DEFAULT '0',
  `mark_university` varchar(11) DEFAULT 'no',
  `ischecked` varchar(11) NOT NULL DEFAULT 'applied',
  `acceptance_letter` varchar(250) DEFAULT NULL,
  `type` varchar(11) NOT NULL DEFAULT 'single',
  `request_update` int(11) NOT NULL DEFAULT '0',
  `created_at` varchar(250) NOT NULL,
  `commision` varchar(25) DEFAULT NULL,
  `language_certificate` varchar(250) DEFAULT NULL,
  `reference_id` varchar(100) DEFAULT NULL,
  `applicant_note` text,
  `transcript_name` varchar(250) DEFAULT NULL,
  `diploma_name` varchar(250) DEFAULT NULL,
  `passport_name` varchar(250) DEFAULT NULL,
  `language_certificate_name` varchar(250) DEFAULT NULL,
  `id_photo_name` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `applicant_type` varchar(100) NOT NULL DEFAULT 'agent_applicant',
  `time` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent_students`
--

INSERT INTO `agent_students` (`id`, `agent_id`, `username`, `first_name`, `last_name`, `date_of_birth`, `phone_number`, `phone_number_2`, `email`, `fathers_name`, `mothers_name`, `passport_number`, `nationality`, `country_of_residence`, `id_photo`, `passport_file`, `transcript_file`, `diploma_file`, `other_files`, `middle_name`, `application_no`, `status`, `note`, `signed_by`, `is_notified`, `isClosed`, `mark_university`, `ischecked`, `acceptance_letter`, `type`, `request_update`, `created_at`, `commision`, `language_certificate`, `reference_id`, `applicant_note`, `transcript_name`, `diploma_name`, `passport_name`, `language_certificate_name`, `id_photo_name`, `user_id`, `applicant_type`, `time`) VALUES
(1, 10, 'Bon_HmP4_Mwa', 'Boniface', 'Mwanza', '2015-01-01', '+905523257568', '', 'bonihgu@gmail.com', 'HAGGAI', 'ELIZABERTH', 'cn3232', 'Turkey', 'Turkey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'awaiting_approval', NULL, NULL, 0, 0, 'no', 'applied', NULL, 'multiple', 0, '1647480597', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'agent_applicant', 1647480597);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `text` text,
  `time` int(32) NOT NULL DEFAULT '0',
  `active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_views`
--

CREATE TABLE `announcement_views` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `announcement_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `applicant_chat`
--

CREATE TABLE `applicant_chat` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `applicant_email` varchar(250) NOT NULL,
  `message` text,
  `file` varchar(250) DEFAULT NULL,
  `from` varchar(250) DEFAULT NULL,
  `to` varchar(250) DEFAULT NULL,
  `action_slug` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applicant_chat`
--

INSERT INTO `applicant_chat` (`id`, `admin_id`, `applicant_email`, `message`, `file`, `from`, `to`, `action_slug`, `created_at`) VALUES
(1, NULL, 'fghfhfdgh@gmail.com', 'amkd cocugu', NULL, 'admin', 'dfsdg fsdfgsd', NULL, '2022-03-27 17:27:28'),
(2, NULL, 'fghfhfdgh@gmail.com', 'ne var lab', NULL, 'dfsdg fsdfgsd', 'admin', NULL, '2022-03-27 17:28:08'),
(3, NULL, 'fghfhfdgh@gmail.com', '', NULL, 'admin', 'dfsdg  fsdfgsd', 'document_missing', '2022-03-27 17:28:42'),
(4, NULL, 'fghfhfdgh@gmail.com', '', NULL, 'admin', 'dfsdg  fsdfgsd', 'passport_missing', '2022-03-27 17:28:43'),
(5, NULL, 'fghfhfdgh@gmail.com', '', NULL, 'admin', 'dfsdg  fsdfgsd', 'transcript_missing', '2022-03-27 17:28:44'),
(6, NULL, 'fghfhfdgh@gmail.com', '', NULL, 'admin', 'dfsdg  fsdfgsd', 'passport_missing', '2022-03-27 17:28:45'),
(7, NULL, 'fghfhfdgh@gmail.com', '', NULL, 'admin', 'dfsdg  fsdfgsd', 'stamp_missing_on_transcript', '2022-03-27 17:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_education_info`
--

CREATE TABLE `applicant_education_info` (
  `id` int(11) NOT NULL,
  `date_of_birth` varchar(250) DEFAULT NULL,
  `phone_number` varchar(250) DEFAULT NULL,
  `phone_number_2` varchar(250) DEFAULT NULL,
  `fathers_name` varchar(250) DEFAULT NULL,
  `mothers_name` varchar(250) DEFAULT NULL,
  `passport_number` varchar(250) DEFAULT NULL,
  `nationality` varchar(250) DEFAULT NULL,
  `country_of_residence` varchar(250) DEFAULT NULL,
  `id_photo` varchar(250) DEFAULT NULL,
  `passport_file` varchar(250) DEFAULT NULL,
  `transcript_file` varchar(250) DEFAULT NULL,
  `diploma_file` varchar(250) DEFAULT NULL,
  `other_files` int(11) DEFAULT NULL,
  `middle_name` varchar(250) DEFAULT NULL,
  `note` text,
  `type` varchar(11) NOT NULL DEFAULT 'single',
  `created_at` varchar(250) DEFAULT NULL,
  `language_certificate` varchar(250) DEFAULT NULL,
  `reference_id` varchar(100) DEFAULT NULL,
  `applicant_note` text,
  `transcript_name` varchar(250) DEFAULT NULL,
  `diploma_name` varchar(250) DEFAULT NULL,
  `passport_name` varchar(250) DEFAULT NULL,
  `language_certificate_name` varchar(250) DEFAULT NULL,
  `id_photo_name` varchar(250) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applicant_education_info`
--

INSERT INTO `applicant_education_info` (`id`, `date_of_birth`, `phone_number`, `phone_number_2`, `fathers_name`, `mothers_name`, `passport_number`, `nationality`, `country_of_residence`, `id_photo`, `passport_file`, `transcript_file`, `diploma_file`, `other_files`, `middle_name`, `note`, `type`, `created_at`, `language_certificate`, `reference_id`, `applicant_note`, `transcript_name`, `diploma_name`, `passport_name`, `language_certificate_name`, `id_photo_name`, `user_id`, `first_name`, `last_name`) VALUES
(1, '2022-04-19', '6148436482', '', 'Cadsf', 'asfasd', 's4343', 'Zambia', 'Zambia', NULL, NULL, 'upload/photos/2022/04/Rxg1jBDFhGdNyRThNGaX_01_c20777726c1617d51eb3d1931dec10d9_image.png', NULL, NULL, NULL, NULL, 'multiple', '1648798137', NULL, NULL, NULL, '004_a.png', NULL, NULL, NULL, NULL, 20, 'Brycord', 'Muchindu');

-- --------------------------------------------------------

--
-- Table structure for table `applican_universities`
--

CREATE TABLE `applican_universities` (
  `id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `program_id` int(11) NOT NULL,
  `application_status` varchar(250) DEFAULT 'awaiting_approval',
  `is_checked` varchar(250) DEFAULT 'queued',
  `acceptance_letter` varchar(250) DEFAULT NULL,
  `uniqid` varchar(25) NOT NULL,
  `edit_request` varchar(20) NOT NULL DEFAULT 'none',
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `reference_id` varchar(11) DEFAULT NULL,
  `applied_by` int(11) NOT NULL DEFAULT '0',
  `student_id` int(11) DEFAULT NULL,
  `applicant_type` varchar(150) NOT NULL DEFAULT 'guest',
  `payment_receipt_required` int(3) NOT NULL DEFAULT '0',
  `payment_receipt_file` varchar(250) DEFAULT NULL,
  `payment_receipt_file_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `university_id` varchar(250) DEFAULT NULL,
  `program_id` varchar(250) DEFAULT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `date_of_birth` varchar(250) DEFAULT NULL,
  `phone_number` varchar(250) DEFAULT NULL,
  `phone_number_2` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `fathers_name` varchar(250) DEFAULT NULL,
  `mothers_name` varchar(250) DEFAULT NULL,
  `passport_number` varchar(250) DEFAULT NULL,
  `nationality` varchar(250) DEFAULT NULL,
  `country_of_residence` varchar(250) DEFAULT NULL,
  `id_photo` varchar(250) DEFAULT NULL,
  `passport_file` varchar(250) DEFAULT NULL,
  `transcript_file` varchar(250) DEFAULT NULL,
  `diploma_file` varchar(250) DEFAULT NULL,
  `other_files` int(11) DEFAULT NULL,
  `middle_name` varchar(250) DEFAULT NULL,
  `application_no` varchar(255) DEFAULT NULL,
  `status` varchar(250) DEFAULT 'awaiting_approval',
  `note` text,
  `signed_by` varchar(250) DEFAULT NULL,
  `is_notified` int(11) NOT NULL DEFAULT '0',
  `isClosed` int(11) NOT NULL DEFAULT '0',
  `mark_university` varchar(11) DEFAULT 'no',
  `ischecked` varchar(11) NOT NULL DEFAULT 'applied',
  `acceptance_letter` varchar(250) DEFAULT NULL,
  `type` varchar(11) NOT NULL DEFAULT 'single',
  `request_update` int(11) NOT NULL DEFAULT '0',
  `created_at` varchar(250) NOT NULL,
  `commision` varchar(25) DEFAULT NULL,
  `language_certificate` varchar(250) DEFAULT NULL,
  `reference_id` varchar(100) DEFAULT NULL,
  `applicant_note` text,
  `transcript_name` varchar(250) DEFAULT NULL,
  `diploma_name` varchar(250) DEFAULT NULL,
  `passport_name` varchar(250) DEFAULT NULL,
  `language_certificate_name` varchar(250) DEFAULT NULL,
  `id_photo_name` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `applicant_type` varchar(100) NOT NULL DEFAULT 'guest',
  `time` int(20) NOT NULL DEFAULT '0',
  `applied_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `university_id`, `program_id`, `first_name`, `last_name`, `date_of_birth`, `phone_number`, `phone_number_2`, `email`, `fathers_name`, `mothers_name`, `passport_number`, `nationality`, `country_of_residence`, `id_photo`, `passport_file`, `transcript_file`, `diploma_file`, `other_files`, `middle_name`, `application_no`, `status`, `note`, `signed_by`, `is_notified`, `isClosed`, `mark_university`, `ischecked`, `acceptance_letter`, `type`, `request_update`, `created_at`, `commision`, `language_certificate`, `reference_id`, `applicant_note`, `transcript_name`, `diploma_name`, `passport_name`, `language_certificate_name`, `id_photo_name`, `user_id`, `applicant_type`, `time`, `applied_by`) VALUES
(1, '5', '4', 'Brycord', 'Muchindu', '2022-04-19', '6148436482', '', NULL, 'Cadsf', 'asfasd', 's4343', 'Zambia', 'Zambia', NULL, NULL, 'upload/photos/2022/04/Rxg1jBDFhGdNyRThNGaX_01_c20777726c1617d51eb3d1931dec10d9_image.png', NULL, NULL, NULL, NULL, 'awaiting_approval', NULL, NULL, 0, 0, 'no', 'applied', NULL, 'multiple', 0, '1648798652', NULL, NULL, NULL, NULL, '004_a.png', NULL, NULL, NULL, NULL, 20, 'guest', 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `apps_sessions`
--

CREATE TABLE `apps_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `session_id` varchar(120) NOT NULL DEFAULT '',
  `platform` varchar(32) NOT NULL DEFAULT '',
  `platform_details` text,
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apps_sessions`
--

INSERT INTO `apps_sessions` (`id`, `user_id`, `session_id`, `platform`, `platform_details`, `time`) VALUES
(1, 2, '638cfca9071766e21a61cf3e28c77688d7ba08d5159957615654d40b17adacc21bcff3b9fb6d27a979', 'web', 'a:6:{s:9:\"userAgent\";s:21:\"PostmanRuntime/7.26.3\";s:4:\"name\";s:7:\"Unknown\";s:7:\"version\";s:6:\"7.26.3\";s:8:\"platform\";s:7:\"Unknown\";s:7:\"pattern\";s:60:\"#(?<browser>Version||other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\";s:10:\"ip_address\";s:3:\"::1\";}', 1599576156),
(4, 2, 'db6e31fa5c619d3ad45a4a9c22cf0d7b0b55b16716122724880801947a3df0e751034cdef5f3fb50cc', 'web', 'a:6:{s:9:\"userAgent\";s:21:\"PostmanRuntime/7.26.8\";s:4:\"name\";s:7:\"Unknown\";s:7:\"version\";s:6:\"7.26.8\";s:8:\"platform\";s:7:\"Unknown\";s:7:\"pattern\";s:60:\"#(?<browser>Version||other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#\";s:10:\"ip_address\";s:3:\"::1\";}', 1612272488);

-- --------------------------------------------------------

--
-- Table structure for table `bank_receipts`
--

CREATE TABLE `bank_receipts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `description` tinytext,
  `price` varchar(50) NOT NULL DEFAULT '0',
  `mode` varchar(50) NOT NULL DEFAULT '',
  `track_id` varchar(50) CHARACTER SET utf8mb4 DEFAULT '',
  `approved` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `receipt_file` varchar(250) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved_at` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `promote_charge_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banned`
--

CREATE TABLE `banned` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `time` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banned`
--

INSERT INTO `banned` (`id`, `ip_address`, `time`) VALUES
(1, '192.168.1.1', '1604756173'),
(2, '165.56.181.119', '1604946106');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'theme', 'default'),
(2, 'censored_words', ''),
(3, 'title', 'Global Academia'),
(4, 'name', 'Global Academia'),
(5, 'keyword', 'Global Academia'),
(6, 'email', 'cbmkboniface@gmail.com'),
(7, 'description', 'Find Your Dream University'),
(8, 'validation', 'on'),
(9, 'recaptcha', 'on'),
(10, 'recaptcha_key', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI'),
(11, 'language', 'english'),
(21, 'smtp_or_mail', 'smtp'),
(22, 'smtp_host', 'smtp.mailtrap.io'),
(23, 'smtp_username', '9545edce34cce1'),
(24, 'smtp_password', '83ce15fb4a4634'),
(25, 'smtp_encryption', 'tls'),
(26, 'smtp_port', '587'),
(27, 'delete_account', 'on'),
(36, 'last_admin_collection', '1648798671'),
(45, 'user_registration', 'on'),
(54, 'job_listing_statics', '[{&quot;month&quot;:&quot;January&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;February&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;March&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;April&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;May&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;June&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;July&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;August&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;September&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;October&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;November&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;December&quot;,&quot;new_job&quot;:16}]'),
(58, 'google', ''),
(59, 'last_created_sitemap', '10-01-2019'),
(60, 'is_ok', '1'),
(64, 'paypal_id', 'AaoTphDDLDa1pjOYTF_iCfbAK3yJDYnrS1DHGJCIeJmzuDSMh4FbRWGBTnL65zkM2oW05yphfyLt5nhB'),
(65, 'paypal_secret', 'EDOX-rx7kMia4t60dqWeRnHYxms4UyZfdop_jYkd0nIb45PfHNEHmJ_c7OwSwGlRBa0Qia0uU1I4G4Cs'),
(66, 'paypal_mode', 'sandbox'),
(67, 'last_backup', '04-12-2020'),
(68, 'user_ads', 'on'),
(71, 's3_upload', 'off'),
(72, 's3_bucket_name', ''),
(73, 'amazone_s3_key', ''),
(74, 'amazone_s3_s_key', ''),
(75, 'region', 'us-east-1'),
(87, 'night_mode', 'light'),
(92, 'ftp_username', ''),
(98, 'ftp_host', 'localhost'),
(99, 'ftp_port', '21'),
(101, 'ftp_password', ''),
(102, 'ftp_upload', 'off'),
(103, 'ftp_endpoint', 'storage.askme.com'),
(104, 'ftp_path', './'),
(137, 'server_key', '4354435354'),
(145, 'max_image_upload_size', '256000000'),
(146, 'google_place_api', 'AIzaSyB7rRpQJyQJZYzxrvStRGFkbB0MxXWGrO0'),
(147, 'facebook_url', 'https://www.facebook.com'),
(148, 'twitter_url', 'https://www.twitter.com'),
(149, 'google_url', 'https://www.google.com'),
(150, 'profile_visit_notification', 'on'),
(152, 'ad_c_price', '0.05'),
(153, 'ad_v_price', '0.01'),
(154, 'ads_currency', 'USD'),
(156, 'google_map_api', 'AIzaSyBOfpaMO_tMMsuvS2T4zx4llbtsFqMuT9Y'),
(157, 'last_update', '1538060393'),
(165, 'total_unactive_users', '3'),
(166, 'auto_friend_users', 'qbizns'),
(168, 'fb_login', 'on'),
(169, 'plus_login', 'on'),
(170, 'tw_login', 'off'),
(174, 'promote_question_cost', '1.23'),
(175, 'max_post_per_hour', '20'),
(176, 'max_user_reg_hour', '1000'),
(177, 'post_text_limit', '400'),
(178, 'nearby_question_distance', '10'),
(179, 'last_promote_question_update', '1625487734'),
(180, 'version', '1.1'),
(181, 'server', 'ajax'),
(182, 'server', 'nodejs'),
(183, 'video_upload', 'on'),
(184, 'currency_symbol_array', 'a:10:{s:3:\"USD\";s:1:\"$\";s:3:\"EUR\";s:3:\"€\";s:3:\"JPY\";s:2:\"¥\";s:3:\"TRY\";s:3:\"₺\";s:3:\"GBP\";s:2:\"£\";s:3:\"RUB\";s:6:\"руб\";s:3:\"PLN\";s:3:\"zł\";s:3:\"ILS\";s:3:\"₪\";s:3:\"BRL\";s:2:\"R$\";s:3:\"INR\";s:3:\"₹\";}'),
(185, 'currency_array', 'a:10:{i:0;s:3:\"USD\";i:1;s:3:\"EUR\";i:2;s:3:\"JPY\";i:3;s:3:\"TRY\";i:4;s:3:\"GBP\";i:5;s:3:\"RUB\";i:6;s:3:\"PLN\";i:7;s:3:\"ILS\";i:8;s:3:\"BRL\";i:9;s:3:\"INR\";}'),
(186, 'paypal_currency', 'USD'),
(187, 'checkout_currency', ''),
(188, 'checkout_payment', 'no'),
(189, 'checkout_mode', 'sandbox'),
(190, 'checkout_seller_id', ''),
(191, 'checkout_publishable_key', ''),
(192, 'credit_card', 'no'),
(193, 'stripe_currency', ''),
(194, 'bank_payment', 'yes'),
(195, 'bank_transfer_note', 'In order to confirm the bank transfer, you will need to upload a receipt or take a screenshot of your transfer within 1 day from your payment date. If a bank transfer is made but no receipt is uploaded within this period, your order will be cancelled. We will verify and confirm your receipt within 3 working days from the date you upload it.'),
(196, 'server', 'ajax'),
(197, 'verification_badge', 'on'),
(198, 'login_auth', '0'),
(199, 'two_factor', '1'),
(200, 'two_factor_type', 'email'),
(201, 'sms_phone_number', '+19852185730'),
(202, 'sms_twilio_password', 'fb50200eee0364a082f23b520eafdd4b'),
(203, 'sms_twilio_username', 'ACf0155bb3fa042c15399cadae68b687ea'),
(204, 'sms_t_phone_number', '+19852185730'),
(205, 'invite_links_system', '0'),
(206, 'user_links_limit', ''),
(207, 'expire_user_links', ''),
(208, 'stripe_payment', 'on'),
(209, 'stripe_version', ''),
(210, 'stripe_secret', ''),
(211, 'spaces_key', 'VLIOOSXCTGTLL356IC5G'),
(212, 'spaces_secret', 'sV3I1yZiCn2ld6/Vsg2z6/qdKiAOMheAK5PjMYUCNAs'),
(213, 'space_name', 'asktest'),
(214, 'space_region', 'ams3'),
(215, 'spaces', 'off'),
(216, 'cloud_upload', 'off'),
(217, 'cloud_file_path', 'https://storage.cloud.google.com/askmetest/upload/index.html?authuser=0'),
(218, 'cloud_bucket_name', 'askmetest'),
(219, 'max_upload_all_users', '0'),
(220, 'fileSharing', 'on'),
(221, 'audio_upload', 'on'),
(222, 'mime_types', 'text/plain,video/mp4,video/mov,video/mpeg,video/flv,video/avi,video/webm,audio/wav,audio/mpeg,video/quicktime,audio/mp3,image/png,image/jpeg,image/gif,application/pdf,application/msword,application/zip,application/x-rar-compressed,text/pdf,application/x-pointplus,text/css'),
(223, 'allowedExtenstion', 'jpg,png,jpeg,gif,mkv,docx,zip,rar,pdf,doc,mp3,mp4,flv,wav,txt,mov,avi,webm,wav,mpeg,mp4'),
(224, 'wowonder_domain_uri', ''),
(225, 'vkontakte_domain_uri', ''),
(226, 'wowonder_img', ''),
(227, 'vkonktake_domain_uri', ''),
(228, 'vkontakte_app_key', ''),
(229, 'vkontakte_app_ID', ''),
(230, 'vkontakte_login', 'off'),
(231, 'wowonder_login', 'off'),
(232, 'wowonder_app_key', ''),
(233, 'wowonder_app_ID', ''),
(234, 'twitter_app_key', ''),
(235, 'twitter_app_ID', ''),
(236, 'bank_description', '<div class=\"bank_info\"><div class=\"dt_settings_header bg_gradient\"><div class=\"dt_settings_circle-1\"></div><div class=\"dt_settings_circle-2\"></div><div class=\"bank_info_innr\"><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path fill=\"currentColor\" d=\"M11.5,1L2,6V8H21V6M16,10V17H19V10M2,22H21V19H2M10,10V17H13V10M4,10V17H7V10H4Z\"></path></svg><h4 class=\"bank_name\">Garanti Bank</h4><div class=\"row\"><div class=\"col col-md-12\"><div class=\"bank_account\"><p>4796824372433055</p><span class=\"help-block\">Account number / IBAN</span></div></div><div class=\"col col-md-12\"><div class=\"bank_account_holder\"><p>Antoian Kordiyal</p><span class=\"help-block\">Account name</span></div></div><div class=\"col col-md-6\"><div class=\"bank_account_code\"><p>TGBATRISXXX</p><span class=\"help-block\">Routing code</span></div></div><div class=\"col col-md-6\"><div class=\"bank_account_country\"><p>United States</p><span class=\"help-block\">Country</span></div></div></div></div></div></div>'),
(237, 'user_statics', '[{\"month\":\"January\",\"new_users\":0},{\"month\":\"February\",\"new_users\":1},{\"month\":\"March\",\"new_users\":11},{\"month\":\"April\",\"new_users\":0},{\"month\":\"May\",\"new_users\":0},{\"month\":\"June\",\"new_users\":0},{\"month\":\"July\",\"new_users\":0},{\"month\":\"August\",\"new_users\":0},{\"month\":\"September\",\"new_users\":0},{\"month\":\"October\",\"new_users\":0},{\"month\":\"November\",\"new_users\":0},{\"month\":\"December\",\"new_users\":0}]'),
(239, 'user_statics', '[{\"month\":\"January\",\"new_users\":0},{\"month\":\"February\",\"new_users\":1},{\"month\":\"March\",\"new_users\":11},{\"month\":\"April\",\"new_users\":0},{\"month\":\"May\",\"new_users\":0},{\"month\":\"June\",\"new_users\":0},{\"month\":\"July\",\"new_users\":0},{\"month\":\"August\",\"new_users\":0},{\"month\":\"September\",\"new_users\":0},{\"month\":\"October\",\"new_users\":0},{\"month\":\"November\",\"new_users\":0},{\"month\":\"December\",\"new_users\":0}]'),
(240, 'job_listing_statics', '[{&quot;month&quot;:&quot;January&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;February&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;March&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;April&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;May&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;June&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;July&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;August&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;September&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;October&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;November&quot;,&quot;new_job&quot;:0},{&quot;month&quot;:&quot;December&quot;,&quot;new_job&quot;:16}]'),
(241, 'user_statics', '[{\"month\":\"January\",\"new_users\":0},{\"month\":\"February\",\"new_users\":1},{\"month\":\"March\",\"new_users\":11},{\"month\":\"April\",\"new_users\":0},{\"month\":\"May\",\"new_users\":0},{\"month\":\"June\",\"new_users\":0},{\"month\":\"July\",\"new_users\":0},{\"month\":\"August\",\"new_users\":0},{\"month\":\"September\",\"new_users\":0},{\"month\":\"October\",\"new_users\":0},{\"month\":\"November\",\"new_users\":0},{\"month\":\"December\",\"new_users\":0}]'),
(242, 'total_active_users', '9'),
(243, 'total_pages', '0'),
(244, 'total_applications', '11'),
(245, 'total_job_posted', '16'),
(246, 'total_job_share', '0'),
(247, 'total_reports', '1'),
(248, 'weekly_user_vist', '0'),
(249, 'get_number_of_applicants', '1'),
(250, 'reports_count', '0'),
(251, 'get_total_universities', '59'),
(252, 'get_active_users', '15'),
(253, 'get_total_application_to_universities', '0'),
(254, 'get_students_with_missing_documents', '0'),
(255, 'get_total_agents', '4'),
(256, 'get_total_agent_request', '3');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL DEFAULT '0',
  `user_two` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user_one`, `user_two`, `time`) VALUES
(1, 8, 9, 1622460088),
(8, 9, 8, 1622460088);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `tuition_fees` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discounted_fees` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discipline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `university_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `main_image`, `university`, `department`, `language`, `degree`, `duration`, `tuition_fees`, `discounted_fees`, `description`, `requirement`, `discipline`, `location`, `remember_token`, `created_at`, `updated_at`, `university_id`) VALUES
(1, 'upload/photos/2022/03/fHqt3r1NGZmvqjoOCxPS_30_be290b626c4b4db062e6e9d49cd477a3_image.jpg', 'Acibadem University', 'Architecture', 'en', 'Associate', 4, '$6250', 4000, 'Description', 'Requirement', 'This, that, thisthat', 'Istanbul', NULL, '2021-05-16 09:47:47', '2021-07-08 08:24:56', 5),
(2, '1624639772.jpg', 'Acibadem University', 'Architecture', 'English', 'Bachelor', 4, '$6200', 4000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-06-25 16:49:32', 5),
(3, NULL, 'Acibadem University', 'AVIATION MANAGEMENT', 'en', 'Master', 4, '$5.50', 2000, NULL, NULL, 'Engineering', NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 5),
(4, NULL, 'Acibadem University', 'AUDIOLOGY', 'en', 'PhD', 4, '$85232', 2009, NULL, NULL, '', NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 5),
(5, NULL, 'Acibadem University', 'BANKING AND INSURANCE', 'Turkish', 'Associate', 4, '$5.50 ', 2000, NULL, NULL, 'Arts', NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 5),
(6, NULL, 'Acibadem University', 'BIOMEDICAL ENGINEERING (ENGLISH)', 'English', 'Bachelor', 4, '$6.25', 0, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-06-14 21:57:47', 5),
(7, NULL, 'Acibadem University', 'BUSINESS ADMINISTRATION', 'English', 'Master', 4, '$5.50 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 5),
(8, NULL, 'Altinbas University', 'CHILD DEVELOPMENT', 'Turkish', 'PhD', 4, '$5.56 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(9, NULL, 'Altinbas University', 'CIVIL ENGINEERING (ENGLISH)', 'English', 'Associate', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(10, NULL, 'Altinbas University', 'CIVIL ENGINEERING', 'Turkish', 'Bachelor', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(11, '1624275463.jpg', 'Altinbas University', 'COMPUTER ENGINEERING (ENGLISH)', 'English', 'Master', 4, '$6.25', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-06-21 11:37:43', 7),
(12, NULL, 'Altinbas University', 'DENTISTRY (ENGLISH)', 'English', 'PhD', 5, '$20.00 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(13, NULL, 'Altinbas University', 'DENTISTRY', 'Turkish', 'Associate', 5, '$18.50 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(14, NULL, 'Altinbas University', 'ECONOMICS AND FINANCE (ENGLISH)', 'English', 'Bachelor', 4, '$5.50 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(15, NULL, 'Altinbas University', 'ELECTRICAL ELECTRONICS ENGINEERING (ENGLISH)', 'English', 'Master', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(16, NULL, 'Altinbas University', 'ENGLISH TEACHING (ENGLISH)', 'Turkish', 'PhD', 4, '$5.28 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(17, NULL, 'Altinbas University', 'ERGOTHERAPY', 'Turkish', 'Associate', 4, '$5.56 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(18, NULL, 'Altinbas University', 'GASTRONOMY AND CULINARY ARTS', 'Turkish', 'Bachelor', 4, '$5.28 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(19, NULL, 'Altinbas University', '0', 'Turkish', 'Master', 4, '$5.00 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(20, NULL, 'Altinbas University', 'HEALTH MANAGEMENT (ENGLISH)', 'English', 'PhD', 4, '$5.56 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 7),
(21, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'HUMAN RESOURCES MANAGEMENT', 'Turkish', 'UNDERGRADUATE', 4, '$5.50 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(22, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INDUSTRIAL PRODUCT DESIGN', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(23, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INDUSTRIAL ENGINEERING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(24, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERIOR ARCHITECTURE AND ENVIRONMENTAL DESIGN (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(25, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERIOR ARCHITECTURE AND ENVIRONMENTAL DESIGN', 'Turkish', 'UNDERGRADUATE', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(26, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL LOGISTICS MANAGEMENT', 'Turkish', 'UNDERGRADUATE', 4, '$5.50 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(27, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL LOGISTICS MANAGEMENT(ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.50 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(28, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL SCHOOL OF MEDICINE (ENGLISH)', 'English', 'UNDERGRADUATE', 6, '$32.50 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(29, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL TRADE AND FINANCE', 'Turkish', 'UNDERGRADUATE', 4, '$5.50 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(30, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL TRADE AND FINANCE (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.50 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(31, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'JOURNALISM', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(32, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'LAW', 'Turkish', 'UNDERGRADUATE', 4, '$9.03 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(33, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MANAGEMENT INFORMATION SYSTEMS', 'Turkish', 'UNDERGRADUATE', 4, '$5.50 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(34, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MANAGEMENT INFORMATION SYSTEMS (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.50 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(35, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MEDIA AND VISUAL ARTS', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(36, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MEDICINE (TURKISH)', 'Turkish', 'UNDERGRADUATE', 6, '$25.00 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(37, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MIDWIFERY', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(38, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, '$5.00 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(39, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NEW MEDIA AND COMMUNICATION', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(40, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NURSING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$6.25 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(41, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NURSING', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(42, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, '$5.00 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(43, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NUTRITION AND DIETETICS', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(44, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, '$5.00 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(45, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'ORTHOSIS AND PROSTHESIS', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(46, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHARMACY', 'Turkish', 'UNDERGRADUATE', 5, '$10.42 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(47, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHARMACY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$15.00 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(48, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHYSIOTHERAPY AND REHABILITATION (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$6.25 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(49, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHYSIOTHERAPY AND REHABILITATION', 'Turkish', 'UNDERGRADUATE', 4, '$5.00 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(50, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND INTERNATIONAL RELATIONS (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(51, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND PUBLIC ADMINISTRATION', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(52, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND PUBLIC ADMINISTRATION (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(53, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PRESCHOOL TEACHING', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(54, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PRIMARY MATHEMATICS TEACHING', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(55, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(56, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGICAL COUNSELING AND GUIDANCE (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(57, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGY', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(58, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(59, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PUBLIC RELATIONS AND ADVERTISING', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(60, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PUBLIC RELATIONS AND ADVERTISING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(61, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'RADIO TELEVISION AND CINEMA', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(62, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SOCIAL SERVICES', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(63, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPECIAL EDUCATION TEACHING', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(64, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPEECH AND LANGUAGE THERAPY', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(65, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPEECH AND LANGUAGE THERAPY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.56 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(66, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'TURKISH MUSIC ART MAJOR', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(67, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'URBAN DESIGN AND LANDSCAPE ARCHITECTURE', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(68, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'VISUAL COMMUNICATION DESIGN', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-05-16 09:47:47', '2021-05-16 09:47:47', 34),
(69, NULL, 'Acibadem University', 'Architecture', 'English', 'Associate', 4, '$6.250', NULL, NULL, NULL, NULL, 'Istanbul', NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 5),
(70, NULL, 'Acibadem University', 'ARCHITECTURE (ENGLISH)', 'English', 'Bachelor', 4, '$6.25', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 5),
(71, NULL, 'Acibadem University', 'AVIATION MANAGEMENT', 'Turkish', 'Master', 4, '$5.50 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 5),
(72, NULL, 'Acibadem University', 'AUDIOLOGY', 'Turkish', 'PhD', 4, '$5.00 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 5),
(73, NULL, 'Acibadem University', 'BANKING AND INSURANCE', 'Turkish', 'Associate', 4, '$5.50 ', 2000, NULL, NULL, 'Arts', NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 5),
(74, NULL, 'Acibadem University', 'BIOMEDICAL ENGINEERING (ENGLISH)', 'English', 'Bachelor', 4, '$6.25', NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 5),
(75, NULL, 'Acibadem University', 'BUSINESS ADMINISTRATION', 'English', 'Master', 4, '$5.50 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 5),
(76, NULL, 'Altinbas University', 'CHILD DEVELOPMENT', 'Turkish', 'PhD', 4, '$5.56 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(77, NULL, 'Altinbas University', 'CIVIL ENGINEERING (ENGLISH)', 'English', 'Associate', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(78, NULL, 'Altinbas University', 'CIVIL ENGINEERING', 'Turkish', 'Bachelor', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(79, NULL, 'Altinbas University', 'COMPUTER ENGINEERING (ENGLISH)', 'English', 'Master', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(80, NULL, 'Altinbas University', 'DENTISTRY (ENGLISH)', 'English', 'PhD', 5, '$20.00 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(81, NULL, 'Altinbas University', 'DENTISTRY', 'English', 'Associate', 5, '$18.50 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(82, NULL, 'Altinbas University', 'ECONOMICS AND FINANCE (ENGLISH)', 'English', 'Bachelor', 4, '$5.50 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(83, NULL, 'Altinbas University', 'ELECTRICAL ELECTRONICS ENGINEERING (ENGLISH)', 'English', 'Master', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(84, NULL, 'Altinbas University', 'ENGLISH TEACHING (ENGLISH)', 'Turkish', 'PhD', 4, '$5.28 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(85, NULL, 'Altinbas University', 'ERGOTHERAPY', 'Turkish', 'Associate', 4, '$5.56 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(86, NULL, 'Altinbas University', 'GASTRONOMY AND CULINARY ARTS', 'Turkish', 'Bachelor', 4, '$5.28 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(87, NULL, 'Altinbas University', '0', 'Turkish', 'Master', 4, '$5.00 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(88, NULL, 'Altinbas University', 'HEALTH MANAGEMENT (ENGLISH)', 'English', 'PhD', 4, '$5.56 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 7),
(89, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'HUMAN RESOURCES MANAGEMENT', 'Turkish', 'UNDERGRADUATE', 4, '$5.50 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(90, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INDUSTRIAL PRODUCT DESIGN', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(91, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INDUSTRIAL ENGINEERING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(92, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERIOR ARCHITECTURE AND ENVIRONMENTAL DESIGN (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(93, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERIOR ARCHITECTURE AND ENVIRONMENTAL DESIGN', 'Turkish', 'UNDERGRADUATE', 4, '$6.25 ', 2000, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(94, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL LOGISTICS MANAGEMENT', 'Turkish', 'UNDERGRADUATE', 4, '$5.50 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(95, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL LOGISTICS MANAGEMENT(ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.50 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(96, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL SCHOOL OF MEDICINE (ENGLISH)', 'English', 'UNDERGRADUATE', 6, '$32.50 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(97, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL TRADE AND FINANCE', 'Turkish', 'UNDERGRADUATE', 4, '$5.50 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(98, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL TRADE AND FINANCE (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.50 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(99, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'JOURNALISM', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(100, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'LAW', 'English', 'UNDERGRADUATE', 4, '$9.03 ', 44444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(101, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MANAGEMENT INFORMATION SYSTEMS', 'Turkish', 'UNDERGRADUATE', 4, '$5.50 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(102, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MANAGEMENT INFORMATION SYSTEMS (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.50 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(103, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MEDIA AND VISUAL ARTS', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(104, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MEDICINE (TURKISH)', 'Turkish', 'UNDERGRADUATE', 6, '$25.00 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(105, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MIDWIFERY', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(106, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, '$5.00 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(107, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NEW MEDIA AND COMMUNICATION', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(108, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NURSING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$6.25 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(109, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NURSING', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 55555, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(110, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, '$5.00 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(111, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NUTRITION AND DIETETICS', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(112, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, '$5.00 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(113, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'ORTHOSIS AND PROSTHESIS', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(114, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHARMACY', 'Turkish', 'UNDERGRADUATE', 5, '$10.42 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(115, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHARMACY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$15.00 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(116, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHYSIOTHERAPY AND REHABILITATION (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$6.25 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(117, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHYSIOTHERAPY AND REHABILITATION', 'Turkish', 'UNDERGRADUATE', 4, '$5.00 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(118, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND INTERNATIONAL RELATIONS (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(119, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND PUBLIC ADMINISTRATION', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:50', '2021-06-14 22:00:50', 34),
(120, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND PUBLIC ADMINISTRATION (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(121, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PRESCHOOL TEACHING', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(122, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PRIMARY MATHEMATICS TEACHING', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(123, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(124, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGICAL COUNSELING AND GUIDANCE (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(125, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGY', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(126, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(127, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PUBLIC RELATIONS AND ADVERTISING', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(128, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PUBLIC RELATIONS AND ADVERTISING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(129, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'RADIO TELEVISION AND CINEMA', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(130, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SOCIAL SERVICES', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(131, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPECIAL EDUCATION TEACHING', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(132, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPEECH AND LANGUAGE THERAPY', 'Turkish', 'UNDERGRADUATE', 4, '$5.56 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(133, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPEECH AND LANGUAGE THERAPY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, '$5.56 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(134, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'TURKISH MUSIC ART MAJOR', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(135, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'URBAN DESIGN AND LANDSCAPE ARCHITECTURE', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(136, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'VISUAL COMMUNICATION DESIGN', 'Turkish', 'UNDERGRADUATE', 4, '$5.28 ', 4444, NULL, NULL, NULL, NULL, NULL, '2021-06-14 22:00:51', '2021-06-14 22:00:51', 34),
(137, NULL, 'Istanbul Galata University', 'DENTISTRY (TURKISH)', 'tr', 'Undergraduate', NULL, '21000', 10500, '<p><br></p>', '<p><br></p>', '<p>Medical and Health</p>', NULL, NULL, '2021-06-20 12:57:40', '2021-06-20 12:57:40', NULL),
(138, NULL, 'Istanbul Galata University', 'DENTISTRY (TURKISH)', 'Turkish', 'Undergraduate', 5, '21000', 10500, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(139, NULL, 'Istanbul Galata University', 'INTERIOR DESIGN AND ENVIRONMENTAL DESIGN (TURKISH)', 'Turkish', 'Undergraduate', 4, '4500', 1950, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(140, NULL, 'Istanbul Galata University', 'PUBLIC RELATIONS AND ADVERTISING (TURKISH)', 'Turkish', 'Undergraduate', 4, '3500', 1500, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(141, NULL, 'Istanbul Galata University', 'COMMUNICATION DESIGN (TURKISH)', 'Turkish', 'Undergraduate', 4, '3500', 1500, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(142, NULL, 'Istanbul Galata University', 'MANAGEMENT INFORMATION SYSTEMS (TURKISH)', 'Turkish', 'Undergraduate', 4, '4500', 1950, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(143, NULL, 'Istanbul Galata University', 'PSYCHOLOGY (TURKISH)', 'Turkish', 'Undergraduate', 4, '4500', 1950, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(144, NULL, 'Istanbul Galata University', 'GASTRONOMY AND CULINARY ARTS (TURKISH)', 'Turkish', 'Undergraduate', 4, '4500', 1950, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(145, NULL, 'Istanbul Galata University', 'COACHING TRAINING (TURKISH)', 'Turkish', 'Undergraduate', 4, '4500', 1950, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(146, NULL, 'Istanbul Galata University', 'ORAL AND DENTAL HEALTH (TURKISH)', 'Turkish', 'Associate Degree', 2, '3000', 1300, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(147, NULL, 'Istanbul Galata University', 'ANESTHESIA (TURKISH)', 'Turkish', 'Associate Degree', 2, '3000', 1300, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(148, NULL, 'Istanbul Galata University', 'FIRST AID AND EMERGENCY (TURKISH)', 'Turkish', 'Associate Degree', 2, '3000', 1300, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(149, NULL, 'Istanbul Galata University', 'MEDICAL IMAGING TECHNIQUES (TURKISH)', 'Turkish', 'Associate Degree', 2, '3000', 1300, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(150, NULL, 'Istanbul Galata University', 'PHYSIOTHERAPY (TURKISH)', 'Turkish', 'Associate Degree', 2, '3000', 1300, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(151, NULL, 'Istanbul Galata University', 'TURKISH LANGUAGE (TOMER) (TURKISH)', 'Turkish', 'Undergraduate', 1, '1750', 1000, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(152, NULL, 'Istanbul Galata University', 'DENTISTRY (ENGLISH)', 'English', 'Undergraduate', 5, '27000', 13500, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(153, NULL, 'Istanbul Galata University', 'PSYCHOLOGY (ENGLISH)', 'English', 'Undergraduate', 4, '5000', 2500, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(154, NULL, 'Istanbul Galata University', 'INTERIOR DESIGN AND ENVIRONMENTAL DESIGN (ENGLISH)', 'English', 'Undergraduate', 4, '5000', 2500, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(155, NULL, 'Istanbul Galata University', 'PHARMACY SERVICES (TURKISH)', 'Turkish', 'Associate Degree', 2, '3000', 1300, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(156, NULL, 'Istanbul Galata University', 'COOKERY (TURKISH)', 'Turkish', 'Associate Degree', 2, '3000', 1300, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(157, NULL, 'Istanbul Galata University', 'NURSING (TURKISH)', 'Turkish', 'Undergraduate', 4, '4500', 1950, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(158, NULL, 'Istanbul Galata University', 'PHYSIOTHERAPY AND REHABILITATION (TURKISH)', 'Turkish', 'Undergraduate', 4, '4500', 1950, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(159, NULL, 'Istanbul Galata University', 'NUTRITION AND DIETETICS (TURKISH)', 'Turkish', 'Undergraduate', 4, '4500', 1950, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(179, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-21 11:58:46', '2021-06-21 11:58:46', NULL),
(180, 'Prorgam Image', 'University Name', 'Department', 'Language', 'Degree', 0, NULL, 0, 'Disounted Fes', 'Description', 'Requirement', 'Despline', 'Location', NULL, NULL, 0),
(181, '1625732696.jpg', 'Acibadem University', 'Architecture', 'en', 'Associate', 4, NULL, 0, '4000', 'Description', 'Requirement', 'This, that, thisthat', 'Istanbul', NULL, NULL, 5),
(182, '1624639772.jpg', 'Acibadem University', 'Architecture', 'English', 'Bachelor', 4, NULL, 0, '4000', NULL, NULL, NULL, NULL, NULL, NULL, 5),
(183, NULL, 'Acibadem University', 'AVIATION MANAGEMENT', 'Turkish', 'Master', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 5),
(184, NULL, 'Acibadem University', 'AUDIOLOGY', 'Turkish', 'PhD', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 5),
(185, NULL, 'Acibadem University', 'BANKING AND INSURANCE', 'Turkish', 'Associate', 4, NULL, 0, '2000', NULL, NULL, 'Arts', NULL, NULL, NULL, 5),
(186, NULL, 'Acibadem University', 'BIOMEDICAL ENGINEERING (ENGLISH)', 'English', 'Bachelor', 4, NULL, 0, '0', NULL, NULL, NULL, NULL, NULL, NULL, 5),
(187, NULL, 'Acibadem University', 'BUSINESS ADMINISTRATION', 'English', 'Master', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 5),
(188, NULL, 'Altinbas University', 'CHILD DEVELOPMENT', 'Turkish', 'PhD', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(189, NULL, 'Altinbas University', 'CIVIL ENGINEERING (ENGLISH)', 'English', 'Associate', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(190, NULL, 'Altinbas University', 'CIVIL ENGINEERING', 'Turkish', 'Bachelor', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(191, '1624275463.jpg', 'Altinbas University', 'COMPUTER ENGINEERING (ENGLISH)', 'English', 'Master', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(192, NULL, 'Altinbas University', 'DENTISTRY (ENGLISH)', 'English', 'PhD', 5, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(193, NULL, 'Altinbas University', 'DENTISTRY', 'Turkish', 'Associate', 5, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(194, NULL, 'Altinbas University', 'ECONOMICS AND FINANCE (ENGLISH)', 'English', 'Bachelor', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(195, NULL, 'Altinbas University', 'ELECTRICAL ELECTRONICS ENGINEERING (ENGLISH)', 'English', 'Master', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(196, NULL, 'Altinbas University', 'ENGLISH TEACHING (ENGLISH)', 'Turkish', 'PhD', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(197, NULL, 'Altinbas University', 'ERGOTHERAPY', 'Turkish', 'Associate', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(198, NULL, 'Altinbas University', 'GASTRONOMY AND CULINARY ARTS', 'Turkish', 'Bachelor', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(199, NULL, 'Altinbas University', '0', 'Turkish', 'Master', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(200, NULL, 'Altinbas University', 'HEALTH MANAGEMENT (ENGLISH)', 'English', 'PhD', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(201, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'HUMAN RESOURCES MANAGEMENT', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(202, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INDUSTRIAL PRODUCT DESIGN', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(203, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INDUSTRIAL ENGINEERING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(204, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERIOR ARCHITECTURE AND ENVIRONMENTAL DESIGN (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(205, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERIOR ARCHITECTURE AND ENVIRONMENTAL DESIGN', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(206, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL LOGISTICS MANAGEMENT', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(207, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL LOGISTICS MANAGEMENT(ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(208, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL SCHOOL OF MEDICINE (ENGLISH)', 'English', 'UNDERGRADUATE', 6, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(209, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL TRADE AND FINANCE', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(210, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL TRADE AND FINANCE (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(211, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'JOURNALISM', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(212, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'LAW', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(213, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MANAGEMENT INFORMATION SYSTEMS', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(214, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MANAGEMENT INFORMATION SYSTEMS (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(215, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MEDIA AND VISUAL ARTS', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(216, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MEDICINE (TURKISH)', 'Turkish', 'UNDERGRADUATE', 6, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(217, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MIDWIFERY', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(218, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(219, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NEW MEDIA AND COMMUNICATION', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(220, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NURSING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(221, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NURSING', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(222, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(223, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NUTRITION AND DIETETICS', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(224, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(225, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'ORTHOSIS AND PROSTHESIS', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(226, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHARMACY', 'Turkish', 'UNDERGRADUATE', 5, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(227, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHARMACY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(228, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHYSIOTHERAPY AND REHABILITATION (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(229, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHYSIOTHERAPY AND REHABILITATION', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(230, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND INTERNATIONAL RELATIONS (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(231, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND PUBLIC ADMINISTRATION', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(232, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND PUBLIC ADMINISTRATION (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(233, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PRESCHOOL TEACHING', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(234, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PRIMARY MATHEMATICS TEACHING', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(235, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(236, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGICAL COUNSELING AND GUIDANCE (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(237, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGY', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(238, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(239, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PUBLIC RELATIONS AND ADVERTISING', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(240, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PUBLIC RELATIONS AND ADVERTISING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(241, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'RADIO TELEVISION AND CINEMA', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(242, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SOCIAL SERVICES', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(243, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPECIAL EDUCATION TEACHING', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(244, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPEECH AND LANGUAGE THERAPY', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(245, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPEECH AND LANGUAGE THERAPY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(246, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'TURKISH MUSIC ART MAJOR', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(247, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'URBAN DESIGN AND LANDSCAPE ARCHITECTURE', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(248, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'VISUAL COMMUNICATION DESIGN', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(249, NULL, 'Acibadem University', 'Architecture', 'English', 'Associate', 4, NULL, 0, NULL, NULL, NULL, NULL, 'Istanbul', NULL, NULL, 5),
(250, NULL, 'Acibadem University', 'ARCHITECTURE (ENGLISH)', 'English', 'Bachelor', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 5),
(251, NULL, 'Acibadem University', 'AVIATION MANAGEMENT', 'Turkish', 'Master', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 5),
(252, NULL, 'Acibadem University', 'AUDIOLOGY', 'Turkish', 'PhD', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 5),
(253, NULL, 'Acibadem University', 'BANKING AND INSURANCE', 'Turkish', 'Associate', 4, NULL, 0, '2000', NULL, NULL, 'Arts', NULL, NULL, NULL, 5),
(254, NULL, 'Acibadem University', 'BIOMEDICAL ENGINEERING (ENGLISH)', 'English', 'Bachelor', 4, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
(255, NULL, 'Acibadem University', 'BUSINESS ADMINISTRATION', 'English', 'Master', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 5),
(256, NULL, 'Altinbas University', 'CHILD DEVELOPMENT', 'Turkish', 'PhD', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(257, NULL, 'Altinbas University', 'CIVIL ENGINEERING (ENGLISH)', 'English', 'Associate', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(258, NULL, 'Altinbas University', 'CIVIL ENGINEERING', 'Turkish', 'Bachelor', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(259, NULL, 'Altinbas University', 'COMPUTER ENGINEERING (ENGLISH)', 'English', 'Master', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(260, NULL, 'Altinbas University', 'DENTISTRY (ENGLISH)', 'English', 'PhD', 5, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(261, NULL, 'Altinbas University', 'DENTISTRY', 'English', 'Associate', 5, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(262, NULL, 'Altinbas University', 'ECONOMICS AND FINANCE (ENGLISH)', 'English', 'Bachelor', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(263, NULL, 'Altinbas University', 'ELECTRICAL ELECTRONICS ENGINEERING (ENGLISH)', 'English', 'Master', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(264, NULL, 'Altinbas University', 'ENGLISH TEACHING (ENGLISH)', 'Turkish', 'PhD', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(265, NULL, 'Altinbas University', 'ERGOTHERAPY', 'Turkish', 'Associate', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(266, NULL, 'Altinbas University', 'GASTRONOMY AND CULINARY ARTS', 'Turkish', 'Bachelor', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(267, NULL, 'Altinbas University', '0', 'Turkish', 'Master', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(268, NULL, 'Altinbas University', 'HEALTH MANAGEMENT (ENGLISH)', 'English', 'PhD', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 7),
(269, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'HUMAN RESOURCES MANAGEMENT', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(270, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INDUSTRIAL PRODUCT DESIGN', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(271, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INDUSTRIAL ENGINEERING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(272, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERIOR ARCHITECTURE AND ENVIRONMENTAL DESIGN (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(273, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERIOR ARCHITECTURE AND ENVIRONMENTAL DESIGN', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '2000', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(274, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL LOGISTICS MANAGEMENT', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(275, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL LOGISTICS MANAGEMENT(ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(276, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL SCHOOL OF MEDICINE (ENGLISH)', 'English', 'UNDERGRADUATE', 6, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(277, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL TRADE AND FINANCE', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(278, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'INTERNATIONAL TRADE AND FINANCE (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(279, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'JOURNALISM', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(280, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'LAW', 'English', 'UNDERGRADUATE', 4, NULL, 0, '44444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(281, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MANAGEMENT INFORMATION SYSTEMS', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(282, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MANAGEMENT INFORMATION SYSTEMS (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(283, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MEDIA AND VISUAL ARTS', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(284, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MEDICINE (TURKISH)', 'Turkish', 'UNDERGRADUATE', 6, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(285, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'MIDWIFERY', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(286, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(287, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NEW MEDIA AND COMMUNICATION', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(288, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NURSING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(289, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NURSING', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '55555', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(290, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(291, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'NUTRITION AND DIETETICS', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(292, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(293, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'ORTHOSIS AND PROSTHESIS', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(294, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHARMACY', 'Turkish', 'UNDERGRADUATE', 5, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(295, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHARMACY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(296, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHYSIOTHERAPY AND REHABILITATION (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(297, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PHYSIOTHERAPY AND REHABILITATION', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(298, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND INTERNATIONAL RELATIONS (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34);
INSERT INTO `course` (`id`, `main_image`, `university`, `department`, `language`, `degree`, `duration`, `tuition_fees`, `discounted_fees`, `description`, `requirement`, `discipline`, `location`, `remember_token`, `created_at`, `updated_at`, `university_id`) VALUES
(299, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND PUBLIC ADMINISTRATION', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(300, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'POLITICAL SCIENCE AND PUBLIC ADMINISTRATION (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(301, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PRESCHOOL TEACHING', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(302, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PRIMARY MATHEMATICS TEACHING', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(303, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', '0', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(304, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGICAL COUNSELING AND GUIDANCE (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(305, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGY', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(306, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PSYCHOLOGY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(307, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PUBLIC RELATIONS AND ADVERTISING', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(308, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'PUBLIC RELATIONS AND ADVERTISING (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(309, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'RADIO TELEVISION AND CINEMA', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(310, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SOCIAL SERVICES', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(311, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPECIAL EDUCATION TEACHING', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(312, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPEECH AND LANGUAGE THERAPY', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(313, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'SPEECH AND LANGUAGE THERAPY (ENGLISH)', 'English', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(314, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'TURKISH MUSIC ART MAJOR', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(315, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'URBAN DESIGN AND LANDSCAPE ARCHITECTURE', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(316, NULL, 'ISTANBUL MEDIPOL UNIVERSITY', 'VISUAL COMMUNICATION DESIGN', 'Turkish', 'UNDERGRADUATE', 4, NULL, 0, '4444', NULL, NULL, NULL, NULL, NULL, NULL, 34),
(317, NULL, 'Istanbul Galata University', 'DENTISTRY (TURKISH)', 'tr', 'Undergraduate', NULL, NULL, 21000, '10500', '<p><br></p>', '<p><br></p>', '<p>Medical and Health</p>', NULL, NULL, NULL, NULL),
(318, NULL, 'Istanbul Galata University', 'DENTISTRY (TURKISH)', 'Turkish', 'Undergraduate', 5, NULL, 21000, '10500', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(319, NULL, 'Istanbul Galata University', 'INTERIOR DESIGN AND ENVIRONMENTAL DESIGN (TURKISH)', 'Turkish', 'Undergraduate', 4, NULL, 4500, '1950', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(320, NULL, 'Istanbul Galata University', 'PUBLIC RELATIONS AND ADVERTISING (TURKISH)', 'Turkish', 'Undergraduate', 4, NULL, 3500, '1500', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(321, NULL, 'Istanbul Galata University', 'COMMUNICATION DESIGN (TURKISH)', 'Turkish', 'Undergraduate', 4, NULL, 3500, '1500', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(322, NULL, 'Istanbul Galata University', 'MANAGEMENT INFORMATION SYSTEMS (TURKISH)', 'Turkish', 'Undergraduate', 4, NULL, 4500, '1950', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(323, NULL, 'Istanbul Galata University', 'PSYCHOLOGY (TURKISH)', 'Turkish', 'Undergraduate', 4, NULL, 4500, '1950', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(324, NULL, 'Istanbul Galata University', 'GASTRONOMY AND CULINARY ARTS (TURKISH)', 'Turkish', 'Undergraduate', 4, NULL, 4500, '1950', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(325, NULL, 'Istanbul Galata University', 'COACHING TRAINING (TURKISH)', 'Turkish', 'Undergraduate', 4, NULL, 4500, '1950', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(326, NULL, 'Istanbul Galata University', 'ORAL AND DENTAL HEALTH (TURKISH)', 'Turkish', 'Associate Degree', 2, NULL, 3000, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(327, NULL, 'Istanbul Galata University', 'ANESTHESIA (TURKISH)', 'Turkish', 'Associate Degree', 2, NULL, 3000, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(328, NULL, 'Istanbul Galata University', 'FIRST AID AND EMERGENCY (TURKISH)', 'Turkish', 'Associate Degree', 2, NULL, 3000, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(329, NULL, 'Istanbul Galata University', 'MEDICAL IMAGING TECHNIQUES (TURKISH)', 'Turkish', 'Associate Degree', 2, NULL, 3000, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(330, NULL, 'Istanbul Galata University', 'PHYSIOTHERAPY (TURKISH)', 'Turkish', 'Associate Degree', 2, NULL, 3000, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(331, NULL, 'Istanbul Galata University', 'TURKISH LANGUAGE (TOMER) (TURKISH)', 'Turkish', 'Undergraduate', 1, NULL, 1750, '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(332, NULL, 'Istanbul Galata University', 'DENTISTRY (ENGLISH)', 'English', 'Undergraduate', 5, NULL, 27000, '13500', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(333, NULL, 'Istanbul Galata University', 'PSYCHOLOGY (ENGLISH)', 'English', 'Undergraduate', 4, NULL, 5000, '2500', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(334, NULL, 'Istanbul Galata University', 'INTERIOR DESIGN AND ENVIRONMENTAL DESIGN (ENGLISH)', 'English', 'Undergraduate', 4, NULL, 5000, '2500', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(335, NULL, 'Istanbul Galata University', 'PHARMACY SERVICES (TURKISH)', 'Turkish', 'Associate Degree', 2, NULL, 3000, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(336, NULL, 'Istanbul Galata University', 'COOKERY (TURKISH)', 'Turkish', 'Associate Degree', 2, NULL, 3000, '1300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(337, NULL, 'Istanbul Galata University', 'NURSING (TURKISH)', 'Turkish', 'Undergraduate', 4, NULL, 4500, '1950', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(338, NULL, 'Istanbul Galata University', 'PHYSIOTHERAPY AND REHABILITATION (TURKISH)', 'Turkish', 'Undergraduate', 4, NULL, 4500, '1950', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(339, NULL, 'Istanbul Galata University', 'NUTRITION AND DIETETICS (TURKISH)', 'Turkish', 'Undergraduate', 4, NULL, 4500, '1950', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(341, 'upload/photos/2022/03/VAvOKZkSmoNNwgsHdH8a_24_8667043422ca6c3db35a35a2aeaedb32_image.png', 'Chawama university', 'Whichraft', 'en', 'degree', 4, '4000', 2000, NULL, NULL, 'Lusaka', NULL, NULL, NULL, NULL, 111);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `program_id` varchar(11) DEFAULT NULL,
  `university_id` varchar(11) DEFAULT NULL,
  `department_slag` varchar(250) NOT NULL,
  `department` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `program_id`, `university_id`, `department_slag`, `department`) VALUES
(1, NULL, '111', 'whichraft', 'Whichraft');

-- --------------------------------------------------------

--
-- Table structure for table `hashtags`
--

CREATE TABLE `hashtags` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL DEFAULT '',
  `tag` varchar(255) NOT NULL DEFAULT '',
  `last_trend_time` int(11) NOT NULL DEFAULT '0',
  `trend_use_num` int(11) NOT NULL DEFAULT '0',
  `expire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hashtags`
--

INSERT INTO `hashtags` (`id`, `hash`, `tag`, `last_trend_time`, `trend_use_num`, `expire`) VALUES
(1, '8d0c8f9d1a9539021fda006427b993b9', 'asdfas', 1614156597, 1, '2021-02-26'),
(2, 'adbf5a778175ee757c34d0eba4e932bc', 'asda', 1614156667, 1, '2021-02-26'),
(3, '912ec803b2ce49e4a541068d495ab570', 'asdf', 1614161065, 1, '2021-02-26'),
(4, '22ca8686bfa31a2ae5f55a7f60009e14', 'asdfasd', 1614161077, 1, '2021-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `html_emails`
--

CREATE TABLE `html_emails` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `value` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `html_emails`
--

INSERT INTO `html_emails` (`id`, `name`, `value`) VALUES
(1, 'notification', '<p>Hello {{uname}}, <br /><br /> New notification from <a href=\"{{notify_link}}\">{{username}}{{c}}</a>: <br /> {{full_name}} {{contents}} <a href=\"{{user_link}}\">{{username}}{{c}}</a> <br /><br /> {{site_name}} Team.</p>'),
(2, 'confirm', '<p>Hello {{USERNAME}}, <br /><br /> Please confirm your email address by clicking the link below: <br /> <a href=\"{{CODE_URL}}\">Confirm email address</a> <br /><br /> {{SITE_NAME}} Team.</p>'),
(3, 'reset', '<p>Hello {{username}}, <br /><br /> Here is your reset code: <br /> <a>{{code_url}}</a> <br /><br /> {{site_name}} Team.</p>'),
(4, 'unusual_login', '<p>Hi {{username}},<br /><br /> Please verify that it\'s you<br /><br /> Your sign in attempt seems a little different than usual. This could be because you are signing in from a different device or a different location.<br /><br /> If you are attempting to sign-in, please use the following code to confirm your identity:<br /><br /> {{code}}<br /><br /> Here are the details of the sign-in attempt:<br /> Date: {{date}}<br /> Account: {{email}}<br /> Location: {{countryCode}}<br /> IP Address: {{ip_address}}<br /> City: {{city}}<br /><br /> If this wasn\'t you, please reset your password.<br /><br /> Yours securely,<br /> Team {{site_name}}</p>');

-- --------------------------------------------------------

--
-- Table structure for table `invitation_links`
--

CREATE TABLE `invitation_links` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `invited_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(300) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `time` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `langs`
--

CREATE TABLE `langs` (
  `id` int(11) NOT NULL,
  `lang_key` varchar(160) DEFAULT NULL,
  `english` text,
  `arabic` text,
  `dutch` text,
  `french` text,
  `german` text,
  `russian` text,
  `spanish` text,
  `turkish` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `langs`
--

INSERT INTO `langs` (`id`, `lang_key`, `english`, `arabic`, `dutch`, `french`, `german`, `russian`, `spanish`, `turkish`) VALUES
(1, 'copyright', 'Copyright © {1} {0}. All rights reserved.', 'حقوق الطبع والنشر © {1} {0}. كل الحقوق محفوظة.', 'Copyright © {1} {0}. Alle rechten voorbehouden.', 'Copyright © {1} {0}. Tous les droits sont réservés.', 'Copyright © {1} {0}. Alle Rechte vorbehalten.', 'авторское право © {1} {0}. Все права защищены.', 'Copyright © {1} {0}. Todos los derechos reservados.', 'Telif hakkı © {1} {0}. Tüm hakları Saklıdır.'),
(2, 'about_us', 'About Us', 'معلومات عنا', 'Over ons', 'À propos de nous', 'Über uns', 'Насчет нас', 'Sobre nosotros', 'Hakkımızda'),
(3, 'terms', 'Terms', 'شروط', 'Voorwaarden', 'termes', 'Bedingungen', 'термины', 'Condiciones', 'şartlar'),
(4, 'contact', 'Contact', 'اتصل', 'Contact', 'Contact', 'Kontakt', 'контакт', 'Contacto', 'Temas'),
(5, 'agency', 'Agency', 'وكالة', 'agentschap', 'Agence', 'Agentur', 'Агентство', 'Agencia', 'Ajans'),
(6, 'startup', 'Start-Up', 'بدء', 'Opstarten', 'Commencez', 'Anlaufen', 'Запускать', 'Puesta en marcha', 'Başlamak'),
(7, 'business', 'Business', 'اعمال', 'Bedrijf', 'Affaires', 'Geschäft', 'Бизнес', 'Negocio', 'iş'),
(8, 'available_in', '{0} available in', '{0} متاح في', '{0} beschikbaar in', '{0} disponible dans', '{0} verfügbar in', '{0} доступно в', '{0} disponible en', '{0} mevcut'),
(9, 'curious', 'Curious?', 'فضولي؟', 'Nieuwsgierig?', 'Curieuse?', 'Neugierig?', 'Любопытно?', '¿Curioso?', 'Meraklı?'),
(10, 'just_ask', 'Just ask!', 'فقط إسأل!', 'Gewoon vragen!', 'Il suffit de demander!', 'Einfach fragen!', 'Просто спроси!', '¡Solo pregunta!', 'Sadece sor!'),
(11, 'openly_or_anonymously', 'Openly or anonymously', 'بصراحة أو مجهول', 'Openlijk of anoniem', 'Ouvertement ou anonymement', 'Offen oder anonym', 'Открыто или анонимно', 'Abiertamente o anónimamente', 'Açık veya anonim olarak'),
(12, 'get_started', 'Get Started', 'البدء', 'Begin', 'Commencer', 'Loslegen', 'Начать', 'Empezar', 'Başlamak'),
(13, 'login', 'Login', 'تسجيل دخول', 'Log in', 's\'identifier', 'Anmeldung', 'авторизоваться', 'iniciar sesión', 'oturum aç'),
(14, 'home', 'Home', 'الصفحة الرئيسية', 'Huis', 'Accueil', 'Zuhause', 'Главная', 'Casa', 'Ev'),
(15, 'register', 'Register', 'تسجيل', 'Registreren', 'registre', 'Registrieren', 'регистр', 'Registro', 'Kayıt olmak'),
(16, 'sign_up_reg', 'Sign Up!', 'سجل!', 'Inschrijven!', 'S\'inscrire!', 'Anmelden!', 'Подписаться!', '¡Regístrate!', 'Kaydol!'),
(17, 'fill_out_form', 'Fill out the form to get started.', 'املأ النموذج للبدء.', 'Vul het formulier in om te beginnen.', 'Remplissez le formulaire pour commencer.', 'Füllen Sie das Formular aus, um zu beginnen.', 'Заполните форму, чтобы начать.', 'Rellena el formulario para empezar.', 'Başlamak için formu doldurun.'),
(18, 'username', 'Username', 'اسم المستخدم', 'Gebruikersnaam', 'Nom d\'utilisateur', 'Nutzername', 'имя пользователя', 'Nombre de usuario', 'Kullanıcı adı'),
(19, 'email_id', 'Email ID', 'عنوان الايميل', 'E-mail identiteit', 'Identifiant Email', 'E-Mail', 'Эл. адрес', 'Identificación de correo', 'Email kimliği'),
(20, 'password', 'Password', 'كلمه السر', 'Wachtwoord', 'Mot de passe', 'Passwort', 'пароль', 'Contraseña', 'Parola'),
(21, 'confirm_password', 'Confirm Password', 'تأكيد كلمة المرور', 'bevestig wachtwoord', 'Confirmez le mot de passe', 'Passwort bestätigen', 'Подтвердите Пароль', 'Confirmar contraseña', 'Şifreyi Onayla'),
(22, 'terms_and_conditions', 'Terms and Conditions', 'الأحكام والشروط', 'Voorwaarden', 'Termes et conditions', 'Geschäftsbedingungen', 'Условия и положения', 'Términos y Condiciones', 'Şartlar ve koşullar'),
(23, 'already_have_an_account', 'Already have an account?', 'هل لديك حساب؟', 'Heb je al een account?', 'Vous avez déjà un compte?', 'Hast du schon ein Konto?', 'Уже есть аккаунт?', '¿Ya tienes una cuenta?', 'Zaten hesabınız var mı?'),
(24, 'i_agree_to_the', 'I agree to the', 'أنا أوافق على', 'Ik ga akkoord met de', 'je suis d\'accord avec le', 'Ich stimme dem zu', 'я согласен', 'Estoy de acuerdo con la', 'Katılıyorum'),
(25, 'cookie_message', 'This website uses cookies to ensure you get the best experience on our website.', 'يستخدم موقع الويب هذا ملفات تعريف الارتباط لضمان حصولك على أفضل تجربة على موقعنا.', 'Deze website maakt gebruik van cookies om ervoor te zorgen dat u de beste ervaring op onze website krijgt.', 'Ce site utilise des cookies pour vous garantir la meilleure expérience sur notre site.', 'Diese Website verwendet Cookies, um sicherzustellen, dass Sie das beste Erlebnis auf unserer Website erhalten.', 'Этот веб-сайт использует куки-файлы, чтобы обеспечить вам максимальную отдачу от нашего веб-сайта.', 'Este sitio web utiliza cookies para garantizar que obtenga la mejor experiencia en nuestro sitio web.', 'Bu web sitesi, web sitemizde en iyi deneyimi yaşamanızı sağlamak için çerezleri kullanır.'),
(26, 'cookie_dismiss', 'Got It!', 'فهمتك!', 'Begrepen!', 'Je l\'ai!', 'Ich habs!', 'Понял!', '¡Lo tengo!', 'Anladım!'),
(27, 'cookie_link', 'Learn More', 'أعرف أكثر', 'Kom meer te weten', 'Apprendre encore plus', 'Lern mehr', 'Учить больше', 'Aprende más', 'Daha fazla bilgi edin'),
(28, 'about', 'About', 'حول', 'Wat betreft', 'Sur', 'Über', 'Около', 'Acerca de', 'hakkında'),
(29, 'services', 'Services', 'خدمات', 'Diensten', 'Prestations de service', 'Dienstleistungen', 'Сервисы', 'Servicios', 'Hizmetler'),
(30, 'more', 'More', 'أكثر من', 'Meer', 'Plus', 'Mehr', 'Больше', 'Más', 'Daha'),
(31, 'welcome_pack', 'Welcome Back!', 'مرحبا بعودتك!', 'Welkom terug!', 'Nous saluons le retour!', 'Willkommen zurück!', 'Добро пожаловать обратно!', '¡Dar una buena acogida!', 'Tekrar hoşgeldiniz!'),
(32, 'login_to_manage_our_account', 'Login to manage your account.', 'تسجيل الدخول لإدارة حسابك.', 'Meld u aan om uw account te beheren.', 'Connectez-vous pour gérer votre compte.', 'Melden Sie sich an, um Ihr Konto zu verwalten.', 'Войдите, чтобы управлять своей учетной записью.', 'Inicie sesión para gestionar su cuenta.', 'Hesabınızı yönetmek için giriş yapın.'),
(33, 'forget_your_password', 'Forgot your password ?', 'نسيت رقمك السري ؟', 'Uw wachtwoord vergeten ?', 'Mot de passe oublié ?', 'Haben Sie Ihr Passwort vergessen ?', 'Забыли пароль ?', 'Olvidaste tu contraseña ?', 'Parolanızı mı unuttunuz ?'),
(35, 'dont_have_account', 'Do not have an account?', 'لا تملك حساب؟', 'Heb je geen account?', 'Vous n\'avez pas de compte?', 'Haben Sie kein Konto?', 'Еще не регистрировались?', '¿No tiene una cuenta?', 'Bir hesabınız yok mu?'),
(36, 'or', 'OR', 'أو', 'OF', 'OU', 'ODER', 'ИЛИ ЖЕ', 'O', 'VEYA'),
(37, 'facebook', 'Facebook', 'فيس بوك', 'Facebook', 'Facebook', 'Facebook', 'facebook', 'Facebook', 'Facebook'),
(38, 'google', 'Google', 'جوجل', 'Google', 'Google', 'Google', 'Google', 'Google', 'Google'),
(39, 'twitter', 'Twitter', 'تغريد', 'tjilpen', 'Gazouillement', 'Twitter', 'щебет', 'Gorjeo', 'heyecan'),
(40, 'enter_your_email_address', 'Enter your email address below.', 'أدخل عنوان البريد الالكتروني أدناه.', 'Voer hieronder uw e-mailadres in.', 'Entrez votre adresse email ci-dessous.', 'Geben Sie unten Ihre E-Mail-Adresse ein.', 'Введите адрес вашей электронной почты ниже.', 'Ingrese su dirección de correo electrónico a continuación.', 'E-posta adresinizi aşağıya girin.'),
(42, 'request_reset_link', 'Request Reset Link', 'طلب إعادة تعيين الرابط', 'Verzoek Reset Link', 'Demander un lien de réinitialisation', 'Reset-Link anfordern', 'Запросить сброс ссылки', 'Solicitar Restablecer Enlace', 'Sıfırlama Bağlantısı İste'),
(43, 'back_to_login', 'Back to Login', 'العودة إلى تسجيل الدخول', 'Terug naar Inloggen', 'Retour connexion', 'Zurück zur Anmeldung', 'Вернуться на страницу входа', 'Atrás para iniciar sesión', 'Girişe Geri Dön'),
(44, 'reset_password', 'Reset password', 'إعادة تعيين كلمة المرور', 'Wachtwoord opnieuw instellen', 'Réinitialiser le mot de passe', 'Passwort zurücksetzen', 'Сброс пароля', 'Restablecer la contraseña', 'Şifreyi yenile'),
(45, 'privacy_policy', 'Privacy Policy', 'سياسة خاصة', 'Privacybeleid', 'Politique de confidentialité', 'Datenschutz-Bestimmungen', 'политика конфиденциальности', 'Política de privacidad', 'Gizlilik Politikası'),
(46, 'terms_of_use', 'Terms of Use', 'تعليمات الاستخدام', 'Gebruiksvoorwaarden', 'Conditions d\'utilisation', 'Nutzungsbedingungen', 'Условия эксплуатации', 'Términos de Uso', 'Kullanım Şartları'),
(47, 'contact_us', 'Contact Us', 'اتصل بنا', 'Neem contact met ons op', 'Contactez nous', 'Kontaktiere uns', 'Связаться с нами', 'Contáctenos', 'Bizimle iletişime geçin'),
(48, 'first_name', 'First name', 'الاسم الاول', 'Voornaam', 'Prénom', 'Vorname', 'Имя', 'Nombre de pila', 'İsim'),
(49, 'last_name', 'Last name', 'الكنية', 'Achternaam', 'Nom de famille', 'Nachname', 'Фамилия', 'Apellido', 'Soyadı'),
(50, 'send', 'Send', 'إرسال', 'Sturen', 'Envoyer', 'Senden', 'послать', 'Enviar', 'göndermek'),
(51, 'how_can_we_help', 'How can we help?', 'كيف يمكن أن نساعد؟', 'Hoe kunnen we helpen?', 'Comment pouvons nous aider?', 'Wie können wir helfen?', 'Как мы можем помочь?', '¿Cómo podemos ayudar?', 'Nasıl yardımcı olabiliriz?'),
(52, 'please_check_details', 'Please check the details', 'يرجى التحقق من التفاصيل', 'Controleer de details', 'S\'il vous plaît vérifier les détails', 'Bitte überprüfen Sie die Details', 'Пожалуйста, проверьте детали', 'Por favor revise los detalles', 'Lütfen detayları kontrol et'),
(53, 'email_invalid_characters', 'E-mail is invalid', 'البريد الإلكتروني غير صالح', 'Email is ongeldig', 'Le courriel est invalide', 'E-Mail ist ungültig', 'E-mail неверен', 'El correo electrónico es invalido', 'E-posta geçersiz'),
(54, 'email_sent', 'E-mail sent successfully! Please check your inbox/spam.', 'تم إرسال البريد الإلكتروني بنجاح! يرجى التحقق من البريد الوارد / البريد المزعج.', 'E-mail succesvol verzonden! Controleer uw inbox / spam.', 'E-mail envoyé avec succès! Veuillez vérifier votre boîte de réception / spam.', 'Email wurde erfolgreich Versendet! Bitte überprüfen Sie Ihren Posteingang / Spam.', 'Письмо успешно отправлено! Пожалуйста, проверьте ваш почтовый ящик / спам.', 'Correo electrónico enviado con éxito! Por favor revise su bandeja de entrada / spam.', 'E-posta başarıyla gönderildi! Lütfen gelen kutunuzu / spam adresinizi kontrol edin.'),
(55, 'error_msg', 'Something went wrong Please try again later!', 'هناك شئ خاطئ، يرجى المحاولة فى وقت لاحق!', 'Er is iets misgegaan Probeer het later opnieuw!', 'Quelque chose c\'est mal passé. Merci d\'essayer plus tard!', 'Etwas ist schief gelaufen. Bitte versuchen Sie es später noch einmal!', 'Что-то пошло не так. Пожалуйста, повторите попытку позже!', 'Algo salió mal Por favor, intente de nuevo más tarde!', 'Bir şeyler yanlış oldu. Lütfen sonra tekrar deneyiniz!'),
(57, 'email_not_exist', 'E-mail not exist', 'البريد الإلكتروني غير موجود', 'E-mail bestaat niet', 'E-mail n\'existe pas', 'E-Mail existiert nicht', 'Электронная почта не существует', 'E-mail no existe', 'E-posta mevcut değil'),
(59, 'account_is_not_active', 'Your account is not active yet, didn\'t get the email?', 'حسابك غير نشط حتى الآن ، لم أحصل على البريد الإلكتروني؟', 'Uw account is nog niet actief, heeft de e-mail niet ontvangen?', 'Votre compte n\'est pas encore actif, vous n\'avez pas reçu l\'e-mail?', 'Ihr Konto ist noch nicht aktiv, Sie haben die E-Mail nicht erhalten?', 'Ваша учетная запись еще не активна, не получили письмо?', 'Su cuenta aún no está activa, ¿no recibió el correo electrónico?', 'Hesabınız henüz aktif değil, e-postayı alamadınız mı?'),
(60, 'resend_email', 'Resend E-mail', 'إعادة إرسال البريد الإلكتروني', 'Email opnieuw verzenden', 'Ré-envoyer l\'email', 'E-Mail zurücksenden', 'Переслать E-mail', 'Reenviar email', 'Emaili yeniden gönder'),
(61, 'invalid_username_or_password', 'Invalid username or password', 'خطأ في اسم المستخدم أو كلمة مرور', 'ongeldige gebruikersnaam of wachtwoord', 'Nom d\'utilisateur ou mot de passe invalide', 'ungültiger Benutzername oder Passwort', 'неправильное имя пользователя или пароль', 'usuario o contraseña invalido', 'Geçersiz kullanıcı adı veya şifre'),
(62, 'username_is_taken', 'Username is taken', 'اسم المستخدم ماخوذ', 'Gebruikersnaam is in gebruik', 'Le nom d\'utilisateur est pris', 'Benutzername ist vergeben', 'Имя пользователя занято', 'Nombre de usuario es tomado', 'Kullanıcı adı alınmış'),
(63, 'username_characters_length', 'Username must be between 5 / 32', 'يجب أن يكون اسم المستخدم بين 5/32', 'Gebruikersnaam moet tussen 5/32 zijn', 'Le nom d\'utilisateur doit être compris entre 5/32', 'Der Benutzername muss zwischen 5 und 32 liegen', 'Имя пользователя должно быть между 5/32', 'El nombre de usuario debe estar entre 5/32', 'Kullanıcı adı 5/32 arasında olmalıdır'),
(64, 'username_invalid_characters', 'Invalid username characters', 'أحرف اسم المستخدم غير صالحة', 'Ongeldige gebruikersnaamtekens', 'Nom d\'utilisateur invalide', 'Ungültige Zeichen für den Benutzernamen', 'Неверные символы имени пользователя', 'Caracteres de usuario inválidos', 'Geçersiz kullanıcı adı karakterleri'),
(66, 'password_not_match', 'Password not match', 'كلمة السر ليست جيدة', 'Wachtwoord komt niet overeen', 'Le mot de passe ne correspond pas', 'Passwort stimmt nicht überein', 'Пароль не совпадает', 'La contraseña no coincide', 'Şifre eşleşmiyor'),
(67, 'password_is_short', 'Password is too short', 'كلمة المرور قصيرة جدا', 'Wachtwoord is te kort', 'Le mot de passe est trop court', 'Das Passwort ist zu kurz', 'Пароль слишком короткий', 'La contraseña es demasiado corta', 'Şifre çok kısa'),
(68, 'reCaptcha_error', 'Please Check the re-captcha.', 'يرجى التحقق من إعادة captcha.', 'Controleer de re-captcha.', 'S\'il vous plaît vérifier le re-captcha.', 'Bitte überprüfen Sie das Captcha erneut.', 'Пожалуйста, проверьте повторно код проверки.', 'Por favor revise el re-captcha.', 'Lütfen re-captcha\'yı kontrol edin.'),
(69, 'terms_accept', 'Please agree to the Terms of use & Privacy Policy', 'يرجى الموافقة على شروط الاستخدام وسياسة الخصوصية', 'Ga akkoord met de gebruiksvoorwaarden en het privacybeleid', 'Veuillez accepter les conditions d\'utilisation et la politique de confidentialité', 'Bitte stimmen Sie den Nutzungsbedingungen und Datenschutzbestimmungen zu', 'Пожалуйста, согласитесь с условиями использования и политикой конфиденциальности', 'Por favor acepte los Términos de uso y la Política de privacidad.', 'Lütfen kullanım şartlarını ve gizlilik politikasını kabul edin.'),
(70, 'successfully_joined_desc', 'Registration successful! We have sent you an email, Please check your inbox/spam to verify your account.', 'التسجيل ناجح! لقد أرسلنا إليك بريدًا إلكترونيًا ، يرجى التحقق من البريد الوارد / الرسائل غير المرغوب فيها للتحقق من حسابك.', 'Registratie gelukt! We hebben je een e-mail gestuurd. Controleer je inbox / spam om je account te verifiëren.', 'Inscription réussi! Nous vous avons envoyé un courrier électronique. Veuillez vérifier votre boîte de réception / spam pour vérifier votre compte.', 'Registrierung erfolgreich! Wir haben Ihnen eine E-Mail gesendet. Bitte überprüfen Sie Ihren Posteingang / Spam, um Ihr Konto zu bestätigen.', 'Регистрация прошла успешно! Мы отправили вам письмо, пожалуйста, проверьте свой почтовый ящик / спам, чтобы подтвердить свой аккаунт.', '¡Registro exitoso! Le hemos enviado un correo electrónico. Verifique su bandeja de entrada / correo no deseado para verificar su cuenta.', 'Kayıt başarılı! Size bir e-posta gönderdik, hesabınızı doğrulamak için lütfen gelen kutunuzu / spam’nizi kontrol edin.'),
(71, 'please_wait', 'Please wait..', 'ارجوك انتظر..', 'Even geduld aub..', 'S\'il vous plaît, attendez..', 'Warten Sie mal..', 'Пожалуйста, подождите..', 'Por favor espera..', 'Lütfen bekle..'),
(72, 'log_out', 'Log Out', 'الخروج', 'Uitloggen', 'Connectez - Out', 'Ausloggen', 'Выйти', 'Cerrar sesión', 'Çıkış Yap'),
(73, 'settings', 'Settings', 'الإعدادات', 'instellingen', 'Réglages', 'die Einstellungen', 'настройки', 'Ajustes', 'Ayarlar'),
(74, 'email_exists', 'This e-mail is already in use', 'هذا البريد استخدم من قبل', 'Deze email is al in gebruik', 'Cet e-mail est déjà utilisée', 'Diese E-Mail-Adresse wird schon verwendet', 'Этот электронный адрес уже используется', 'Este correo electrónico ya está en uso', 'Bu e-posta zaten kullanılıyor'),
(76, 'you_already_loggedin', 'You already logged in', 'لقد قمت بتسجيل الدخول بالفعل', 'Je bent al ingelogd', 'Vous êtes déjà connecté', 'Sie haben sich bereits angemeldet', 'Вы уже вошли в систему', 'Ya has iniciado sesión', 'Zaten giriş yaptınız'),
(77, 'successfully_resend_desc', 'Confirmation email sent successful! Please check your inbox/spam to verify your account.', 'تم إرسال رسالة التأكيد بنجاح! يرجى التحقق من بريدك الوارد / البريد المزعج للتحقق من حسابك.', 'Bevestigingsmail succesvol verzonden! Controleer uw inbox / spam om uw account te verifiëren.', 'Email de confirmation envoyé avec succès! Veuillez vérifier votre boîte de réception / spam pour vérifier votre compte.', 'Bestätigungsemail erfolgreich versendet! Bitte überprüfen Sie Ihren Posteingang / Spam, um Ihr Konto zu bestätigen.', 'Письмо с подтверждением отправлено успешно! Пожалуйста, проверьте свой почтовый ящик / спам, чтобы подтвердить свой аккаунт.', 'Correo electrónico de confirmación enviado correctamente! Por favor revise su bandeja de entrada / spam para verificar su cuenta.', 'Onay e-postası başarıyla gönderildi! Lütfen hesabınızı doğrulamak için gelen kutunuzu / spam’ınızı kontrol edin.'),
(78, 'error_while_send_confirmation_email', 'An error occurred while sending the confirmation email', 'حدث خطأ أثناء إرسال رسالة التأكيد الإلكترونية', 'Er is een fout opgetreden tijdens het verzenden van de bevestigingsmail', 'Une erreur s\'est produite lors de l\'envoi du courrier électronique de confirmation', 'Beim Senden der Bestätigungs-E-Mail ist ein Fehler aufgetreten', 'При отправке письма с подтверждением произошла ошибка', 'Se produjo un error al enviar el correo electrónico de confirmación.', 'Onay e-postası gönderilirken bir hata oluştu'),
(79, 'invalid_request', 'Invalid request', 'طلب غير صالح', 'Ongeldig verzoek', 'Requête invalide', 'Ungültige Anfrage', 'Неверный запрос', 'Solicitud no válida', 'Geçersiz istek'),
(80, 'password_reset', 'Password Reset', 'إعادة ضبط كلمة المرور', 'Wachtwoord reset', 'Réinitialiser le mot de passe', 'Passwort zurücksetzen', 'Восстановление пароля', 'Restablecimiento de contraseña', 'Parola sıfırlama'),
(81, 'enter_new_password', 'Enter new password to proceed.', 'أدخل كلمة المرور الجديدة للمتابعة.', 'Voer een nieuw wachtwoord in om door te gaan.', 'Entrez un nouveau mot de passe pour continuer.', 'Geben Sie ein neues Passwort ein, um fortzufahren.', 'Введите новый пароль, чтобы продолжить.', 'Introduzca la nueva contraseña para continuar.', 'Devam etmek için yeni şifre girin.'),
(82, 'new_password', 'New password', 'كلمة السر الجديدة', 'Nieuw paswoord', 'Nouveau mot de passe', 'Neues Kennwort', 'Новый пароль', 'Nueva contraseña', 'Yeni Şifre'),
(83, 'confirm_new_password', 'Confirm new password', 'تأكيد كلمة المرور الجديدة', 'Bevestig nieuw wachtwoord', 'Confirmer le nouveau mot de passe', 'Bestätige neues Passwort', 'Подтвердите новый пароль', 'Confirmar nueva contraseña', 'Yeni şifreyi onayla'),
(84, 'reset', 'Reset', 'إعادة تعيين', 'Reset', 'Réinitialiser', 'Zurücksetzen', 'Сброс', 'Reiniciar', 'Reset'),
(85, 'change_password', 'Change Password', 'غير كلمة السر', 'Wachtwoord wijzigen', 'Changer le mot de passe', 'Ändere das Passwort', 'Изменить пароль', 'Cambia la contraseña', 'Şifre değiştir'),
(86, 'email_code_not_found', 'You click on the invalid link, try again later.', 'انقر على الرابط غير الصالح ، أعد المحاولة لاحقًا.', 'U klikt op de ongeldige link en probeert het later opnieuw.', 'Vous cliquez sur le lien non valide, réessayez plus tard.', 'Sie klicken auf den ungültigen Link und versuchen es später erneut.', 'Вы нажимаете на недействительную ссылку, попробуйте позже.', 'Haz clic en el enlace inválido, inténtalo de nuevo más tarde.', 'Geçersiz bağlantıya tıklayın, daha sonra tekrar deneyin.'),
(87, 'no_user_found_with_this_data', 'There is no user found with this data, please try again.', 'لا يوجد مستخدم لديه هذه البيانات ، يرجى المحاولة مرة أخرى.', 'Er is geen gebruiker gevonden met deze gegevens. Probeer het opnieuw.', 'Aucun utilisateur n\'a été trouvé avec ces données. Veuillez réessayer.', 'Es wurde kein Benutzer mit diesen Daten gefunden. Bitte versuchen Sie es erneut.', 'Пользователь с этими данными не найден, пожалуйста, попробуйте еще раз.', 'No se ha encontrado ningún usuario con estos datos, inténtalo de nuevo.', 'Bu verilerle hiçbir kullanıcı bulunamadı, lütfen tekrar deneyin.'),
(88, 'avatar', 'Avatar', 'الصورة الرمزية', 'avatar', 'Avatar', 'Benutzerbild', 'Аватар', 'Avatar', 'Avatar'),
(89, 'info', 'Info', 'معلومات', 'info', 'Info', 'Info', 'Информация', 'Información', 'Bilgi'),
(90, 'add_profile_picture', 'Add Profile Picture', 'إضافة صورة الملف الشخصي', 'Profielfoto toevoegen', 'Ajouter une photo de profil', 'Profilbild hinzufügen', 'Добавить аватарку', 'Añadir foto de perfil', 'Profil Resmi Ekle'),
(91, 'show_unique_personality', 'Show your unique personality and style.', 'أظهر شخصيتك الفريدة وأسلوبك.', 'Toon uw unieke persoonlijkheid en stijl.', 'Montrez votre personnalité et votre style uniques.', 'Zeigen Sie Ihre einzigartige Persönlichkeit und Ihren Stil.', 'Покажите свою уникальную индивидуальность и стиль.', 'Muestra tu personalidad y estilo únicos.', 'Eşsiz kişiliğinizi ve tarzınızı gösterin.'),
(92, 'next', 'Next', 'التالى', 'volgende', 'Suivant', 'Nächster', 'следующий', 'Siguiente', 'Sonraki'),
(94, 'about_you', 'About You', 'حولك', 'Over jou', 'Au propos de vous', 'Über dich', 'О вас', 'Acerca de ti', 'Senin hakkında'),
(95, 'share_your_information', 'Share your information with our community.', 'شارك معلوماتك مع مجتمعنا.', 'Deel uw informatie met onze community.', 'Partagez vos informations avec notre communauté.', 'Teilen Sie Ihre Informationen mit unserer Community.', 'Поделитесь своей информацией с нашим сообществом.', 'Comparte tu información con nuestra comunidad.', 'Bilgilerinizi topluluğumuzla paylaşın.'),
(96, 'male', 'Male', 'الذكر', 'Mannetje', 'Mâle', 'Männlich', 'мужчина', 'Masculino', 'Erkek'),
(97, 'female', 'Female', 'إناثا', 'Vrouw', 'Femelle', 'Weiblich', 'женский', 'Hembra', 'Kadın'),
(98, 'finish', 'Finish', 'إنهاء', 'Af hebben', 'terminer', 'Fertig', 'Конец', 'Terminar', 'Bitiş'),
(99, 'profile', 'Profile', 'الملف الشخصي', 'Profiel', 'Profil', 'Profil', 'Профиль', 'Perfil', 'Profil'),
(100, 'avatar_uploaded_successfully', 'Your avatar uploaded successfully ', 'تم تحميل الصورة الرمزية بنجاح', 'Je avatar is succesvol geüpload', 'Votre avatar a été téléchargé avec succès', 'Ihr Avatar wurde erfolgreich hochgeladen', 'Ваш аватар успешно загружен', 'Tu avatar subido exitosamente', 'Avatarın başarıyla yüklendi'),
(102, 'setting_updated', 'Settings successfully updated!', 'تم تحديث الإعدادات بنجاح!', 'Instellingen succesvol bijgewerkt!', 'Paramètres mis à jour avec succès!', 'Einstellungen erfolgreich aktualisiert!', 'Настройки успешно обновлены!', 'Configuraciones exitosamente actualizadas!', 'Ayarlar başarıyla güncellendi!'),
(103, 'invalid_type_image', 'Invalid Type, you must select image file.', 'نوع غير صالح ، يجب تحديد ملف الصورة.', 'Ongeldig type, moet u een afbeeldingsbestand selecteren.', 'Type non valide, vous devez sélectionner un fichier image.', 'Ungültiger Typ, Sie müssen die Bilddatei auswählen.', 'Неверный тип, вы должны выбрать файл изображения.', 'Tipo no válido, debe seleccionar el archivo de imagen.', 'Geçersiz Tür, görüntü dosyasını seçmelisiniz.'),
(104, 'img_size_not_greater', 'Image Size should not be greater than', 'يجب ألا يكون حجم الصورة أكبر من', 'Beeldgrootte mag niet groter zijn dan', 'La taille de l\'image ne doit pas être supérieure à', 'Die Bildgröße sollte nicht größer als sein', 'Размер изображения не должен быть больше чем', 'El tamaño de la imagen no debe ser mayor que', 'Resim Boyutu daha büyük olmamalıdır'),
(105, 'edit_profile', 'Edit Profile', 'تعديل الملف الشخصي', 'Bewerk profiel', 'Editer le profil', 'Profil bearbeiten', 'Редактировать профиль', 'Editar perfil', 'Profili Düzenle'),
(106, 'search', 'Search', 'بحث', 'Zoeken', 'Chercher', 'Suche', 'Поиск', 'Buscar', 'Arama'),
(107, 'advanced_search', 'Advanced Search', 'البحث المتقدم', 'geavanceerd zoeken', 'Recherche Avancée', 'Erweiterte Suche', 'Расширенный поиск', 'Búsqueda Avanzada', 'gelişmiş Arama'),
(108, 'search_questions_and_users', 'Search questions and users...', 'البحث عن الأسئلة والمستخدمين ...', 'Zoekvragen en gebruikers ...', 'Rechercher des questions et des utilisateurs ...', 'Fragen und Benutzer suchen ...', 'Поиск вопросов и пользователей ...', 'Buscar preguntas y usuarios ...', 'Soruları ve kullanıcıları arayın ...'),
(109, 'questions', 'Questions', 'الأسئلة', 'vragen', 'Des questions', 'Fragen', 'Вопросы', 'Preguntas', 'Sorular'),
(110, 'users', 'Users', 'المستخدمين', 'gebruikers', 'Utilisateurs', 'Benutzer', 'пользователей', 'Usuarios', 'Kullanıcılar'),
(111, 'report_post', 'Report Post', 'تقرير المشاركة', 'Rapportpost', 'Signaler un message', 'Beitrag melden', 'Пожаловаться на сообщение', 'Reportar publicacion', 'Gönderiyi bildir'),
(112, 'trending', 'Trending', 'الشائع', 'richten', 'Tendances', 'tendieren', 'иметь тенденцию', 'Tendencias', 'Akım'),
(114, 'user_profile', 'User Profile', 'ملف تعريفي للمستخدم', 'Gebruikersprofiel', 'Profil de l\'utilisateur', 'Benutzerprofil', 'Профиль пользователя', 'Perfil del usuario', 'Kullanıcı profili'),
(115, 'general', 'General', 'جنرال لواء', 'Algemeen', 'Général', 'Allgemeines', 'генеральный', 'General', 'Genel'),
(117, 'notifications', 'Notifications', 'إخطارات', 'meldingen', 'Les notifications', 'Benachrichtigungen', 'Уведомления', 'Notificaciones', 'Bildirimler'),
(118, 'account', 'Account', 'الحساب', 'Account', 'Compte', 'Konto', 'учетная запись', 'Cuenta', 'hesap'),
(119, 'blocked_users', 'Blocked Users', 'مستخدمين محجوبين', 'Geblokkeerde gebruikers', 'Utilisateurs bloqués', 'Blockierte Benutzer', 'Заблокированные пользователи', 'Usuarios bloqueados', 'Engellenmiş kullanıcılar'),
(121, 'delete_account', 'Delete Account', 'حذف الحساب', 'Account verwijderen', 'Supprimer le compte', 'Konto löschen', 'Удалить аккаунт', 'Borrar cuenta', 'Hesabı sil'),
(122, 'unbloack', 'Unblock', 'رفع الحظر', 'deblokkeren', 'Débloquer', 'Blockierung aufheben', 'открыть', 'Desatascar', 'engeli kaldırmak'),
(123, 'change', 'Change', 'يتغيرون', 'Verandering', 'Changement', 'Veränderung', '+ Изменить', 'Cambio', 'Değişiklik'),
(124, 'current_password', 'Current Password', 'كلمة المرور الحالي', 'huidig ​​wachtwoord', 'Mot de passe actuel', 'derzeitiges Passwort', 'Текущий пароль', 'contraseña actual', 'Şimdiki Şifre'),
(127, 'delete_warn1', 'Are you sure you want to delete your account? All content including published questions, will be permanetly removed!', 'هل انت متأكد انك تريد حذف حسابك؟ سيتم إزالة جميع المحتويات بما في ذلك الأسئلة المنشورة نهائيًا!', 'Weet je zeker dat je je account wilt verwijderen? Alle inhoud inclusief gepubliceerde vragen, zal permanent worden verwijderd!', 'Êtes-vous sûr de vouloir supprimer votre compte? Tout le contenu, y compris les questions publiées, sera définitivement supprimé!', 'Möchten Sie Ihr Konto wirklich löschen? Alle Inhalte einschließlich veröffentlichter Fragen werden permanent entfernt!', 'Вы уверены, что хотите удалить свой аккаунт? Весь контент, включая опубликованные вопросы, будет окончательно удален!', '¿Estás seguro de que quieres eliminar tu cuenta? ¡Todo el contenido, incluidas las preguntas publicadas, se eliminará permanentemente!', 'Hesabınızı silmek istediğinizden emin misiniz? Yayınlanan sorular da dahil olmak üzere tüm içerikler kalıcı olarak kaldırılacak!'),
(128, 'delete_warn2', 'Nobody will be able to find or visit your page.', 'لن يتمكن أحد من العثور على صفحة الخاصة بك أو زيارتها.', 'Niemand zal uw pagina kunnen vinden of bezoeken.', 'Personne ne pourra trouver ou visiter votre page.', 'Niemand kann Ihre Seite finden oder besuchen.', 'Никто не сможет найти или посетить вашу страницу.', 'Nadie podrá encontrar o visitar tu página de.', 'sayfanızı kimse bulamaz veya ziyaret edemez.'),
(129, 'delete', 'Delete', 'حذف', 'Verwijder', 'Effacer', 'Löschen', 'удалять', 'Borrar', 'silmek'),
(130, 'save', 'Save', 'حفظ', 'Opslaan', 'sauvegarder', 'sparen', 'Сохранить', 'Salvar', 'Kayıt etmek'),
(133, 'email', 'Email', 'البريد الإلكتروني', 'E-mail', 'Email', 'Email', 'Эл. адрес', 'Email', 'E-posta'),
(134, 'birth_date', 'Birth date', 'تاريخ الولادة', 'Geboortedatum', 'Date de naissance', 'Geburtstag', 'Дата рождения', 'Fecha de nacimiento', 'Doğum günü'),
(135, 'about_me', 'About Me', 'عني', 'Over mij', 'À propos de moi', 'Über mich', 'Обо мне', 'Sobre mi', 'Benim hakkımda'),
(136, 'location', 'Location', 'موقعك', 'Plaats', 'Emplacement', 'Ort', 'Место нахождения', 'Ubicación', 'yer'),
(137, 'website', 'Website', 'موقع الكتروني', 'Website', 'Site Internet', 'Webseite', 'Веб-сайт', 'Sitio web', 'Web sitesi'),
(138, 'instagram', 'Instagram', 'إينستاجرام', 'Instagram', 'Instagram', 'Instagram', 'Instagram', 'Instagram', 'Instagram'),
(139, 'current_password_dont_match', 'Current password doesn\'t match.', 'كلمة المرور الحالية غير متطابقة.', 'Huidig ​​wachtwoord komt niet overeen.', 'Le mot de passe actuel ne correspond pas.', 'Das aktuelle Passwort stimmt nicht überein.', 'Текущий пароль не совпадает.', 'La contraseña actual no coincide.', 'Mevcut şifre eşleşmiyor.'),
(140, 'new_password_dont_match', 'New password doesn\'t match.', 'كلمة المرور الجديدة غير متطابقة.', 'Nieuw wachtwoord komt niet overeen.', 'Le nouveau mot de passe ne correspond pas.', 'Neues Passwort stimmt nicht überein', 'Новый пароль не совпадает.', 'La nueva contraseña no coincide.', 'Yeni şifre eşleşmiyor.'),
(141, 'email_me_when', 'Email me when', 'البريد الالكتروني لي عندما', 'E-mail mij wanneer', 'Envoyez-moi quand', 'Mailen Sie mir wann', 'Напишите мне, когда', 'Envíame un correo electrónico cuando', 'Bana ne zaman e-posta gönder'),
(142, 'someone_answered_my_questions', 'Someone answered my questions', 'أجاب شخص ما أسئلتي', 'Iemand heeft mijn vragen beantwoord', 'Quelqu\'un a répondu à mes questions', 'Jemand hat meine Fragen beantwortet', 'Кто-то ответил на мои вопросы', 'Alguien contestó mis preguntas', 'Birisi sorularıma cevap verdi'),
(143, 'someone_visited_my_profile', 'Someone visited my profile', 'زار شخص ما ملفي الشخصي', 'Iemand heeft mijn profiel bezocht', 'Quelqu\'un a visité mon profil', 'Jemand hat mein Profil besucht', 'Кто-то посетил мой профиль', 'Alguien visitó mi perfil', 'Birisi profilimi ziyaret etti'),
(144, 'your_account_was_deleted', 'Your account was deleted', 'تم حذف حسابك', 'Je account is verwijderd', 'Votre compte a été supprimé', 'Ihr Konto wurde gelöscht', 'Ваш аккаунт был удален', 'Tu cuenta fue eliminada', 'Hesabınız silindi'),
(145, 'admin_panel', 'Admin Panel', 'لوحة الادارة', 'Administratie Paneel', 'panneau d\'administration', 'Administrationsmenü', 'Панель администратора', 'Panel de administrador', 'Admin Paneli'),
(146, '404_title', 'Looks like you\'re lost in space!', 'Looks like you\'re lost in space!', 'Looks like you\'re lost in space!', 'Looks like you\'re lost in space!', 'Looks like you\'re lost in space!', 'Looks like you\'re lost in space!', 'Looks like you\'re lost in space!', 'Looks like you\'re lost in space!'),
(147, '404_desc', 'The page you were looking for doesn\'t exist.', 'The page you were looking for doesn\'t exist.', 'The page you were looking for doesn\'t exist.', 'The page you were looking for doesn\'t exist.', 'The page you were looking for doesn\'t exist.', 'The page you were looking for doesn\'t exist.', 'The page you were looking for doesn\'t exist.', 'The page you were looking for doesn\'t exist.'),
(148, 'image_upload_error', 'Image upload error', 'خطأ في تحميل الصورة', 'Fout bij uploaden van afbeelding', 'Erreur de téléchargement d\'image', 'Fehler beim Hochladen der Bilder', 'Ошибка загрузки изображения', 'Error de carga de la imagen', 'Resim yükleme hatası'),
(149, 'year', 'year', 'عام', 'jaar', 'année', 'Jahr', 'год', 'año', 'yıl'),
(150, 'month', 'month', 'شهر', 'maand', 'mois', 'Monat', 'месяц', 'mes', 'ay'),
(151, 'day', 'day', 'يوم', 'dag', 'journée', 'Tag', 'день', 'día', 'gün'),
(152, 'hour', 'hour', 'ساعة', 'uur', 'heure', 'Stunde', 'час', 'hora', 'saat'),
(153, 'minute', 'minute', 'اللحظة', 'minuut', 'minute', 'Minute', 'минут', 'minuto', 'dakika'),
(154, 'second', 'second', 'ثانيا', 'tweede', 'seconde', 'zweite', 'второй', 'segundo', 'ikinci'),
(155, 'years', 'years', 'سنوات', 'jaar', 'années', 'Jahre', 'лет', 'años', 'yıl'),
(156, 'months', 'months', 'الشهور', 'maanden', 'mois', 'Monate', 'месяцы', 'meses', 'ay'),
(157, 'days', 'days', 'أيام', 'dagen', 'journées', 'Tage', 'дней', 'dias', 'günler'),
(158, 'hours', 'hours', 'ساعات', 'uur', 'heures', 'Std', 'часов', 'horas', 'saatler'),
(159, 'minutes', 'minutes', 'الدقائق', 'notulen', 'minutes', 'Protokoll', 'минут', 'minutos', 'dakika'),
(160, 'seconds', 'seconds', 'ثواني', 'seconden', 'secondes', 'Sekunden', 'секунд', 'segundos', 'saniye'),
(161, 'time_ago', 'ago', 'منذ', 'geleden', 'depuis', 'vor', 'тому назад', 'hace', 'önce'),
(162, 'no_notifications', 'no_notifications', 'لا إشعارات', 'geen notificaties', 'aucune notification', 'keine Benachrichtigungen', 'no_notifications', 'no Notificaciones', 'no_notifications'),
(163, 'you_do_not_have_any_notifications', 'You do not have any notifications', 'ليس لديك أي إخطارات', 'U hebt geen meldingen', 'Vous n\'avez aucune notification', 'Sie haben keine Benachrichtigungen', 'У вас нет никаких уведомлений', 'No tienes ninguna notificación.', 'Hiçbir bildiriminiz yok'),
(164, 'notification_answer_it', 'Answer It', 'الإجابة عليه', 'Antwoord Het', 'Répondez', 'Antworte es', 'Ответить', 'Contestarlo', 'Cevapla'),
(165, 'notification_asked_you_question', 'asked you a Question.', 'سألتك سؤال.', 'vroeg je een vraag.', 'vous a posé une question.', 'habe dir eine Frage gestellt.', 'задал вам вопрос.', 'te hice una pregunta.', 'sana bir soru sordum.'),
(166, 'notification_answered_your_question', 'answered your question.', 'أجاب على سؤالك.', '.', 'répondu à votre question.', 'beantwortete deine Frage', 'ответил на ваш вопрос.', 'Respondió su pregunta.', 'sorunuzu cevapladı'),
(167, 'notification_view_answer', 'View Answer', 'اعرض الإجابة', 'Bekijk antwoord', 'Voir la réponse', 'Antwort anzeigen', 'Посмотреть ответ', 'Ver respuesta', 'Cevabı Görüntüle'),
(168, 'located_in', 'Located in', 'يقع في', 'Gevestigd in', 'Situé dans', 'Gelegen in', 'Находится в', 'Situado en', 'Konumlanmış'),
(169, 'follow', 'Follow', 'إتبع', 'Volgen', 'Suivre', 'Folgen', 'следить', 'Seguir', 'Takip et'),
(170, 'following', 'Following', 'التالية', 'Volgend op', 'Suivant', 'Folgenden', 'Следующий', 'Siguiendo', 'Takip etme'),
(171, 'notification_followed_u', 'Followed you', 'تبعتك', 'Je gevolgd', 'Je t\'ai suivi', 'Dir gefolgt', 'Следовал за вами', 'Te siguió', 'Seni takip'),
(172, 'notification_unfollowed_u', 'UnFollowed you', 'الغيت متابعتك', 'UnFollowed you', 'Ne vous suit plus', 'Hat dir entfolgt', 'Отписался от вас', 'Dejó de seguirte', 'Tavsiye edilmedi'),
(173, 'followers', 'Followers', 'متابعون', 'Volgers', 'Suiveurs', 'Anhänger', 'Читают', 'Seguidores', 'İzleyiciler'),
(174, 'show_more', 'Show more', 'أظهر المزيد', 'Laat meer zien', 'Montre plus', 'Zeig mehr', 'Показать больше', 'Mostrar más', 'Daha fazla göster'),
(175, 'no_followers_yet', 'No followers yet', 'لا يوجد متابعين بعد', 'Nog geen volgers', 'Pas encore d\'adeptes', 'Noch keine Follower', 'Нет последователей еще', 'No hay seguidores todavía', 'Henüz takipçisi yok'),
(176, 'not_following_any_user', 'Not following any user', 'عدم متابعة أي مستخدم', 'Geen enkele gebruiker volgen', 'Ne suit aucun utilisateur', 'Folgt keinem Benutzer', 'Не подписан ни на одного пользователя', 'No siguiendo a ningún usuario', 'Herhangi bir kullanıcıyı takip etmemek'),
(177, 'no_more_followers', 'No more followers', 'لا مزيد من المتابعين', 'Geen volgers meer', 'Pas plus d\'adeptes', 'Keine Anhänger mehr', 'Нет больше последователей', 'No mas seguidores', 'Artık takipçisi yok'),
(178, 'no_more_following_user', 'No more following user', 'لا مزيد من متابعة المستخدم', 'Geen volgende gebruiker meer', 'Pas plus d\'utilisateur suivant', 'Kein weiterer Benutzer mehr', 'Нет больше следующего пользователя', 'No más usuario siguiente', 'Artık kullanıcı yok'),
(179, 'country', 'Country', 'بلد', 'land', 'Pays', 'Land', 'Страна', 'País', 'ülke'),
(180, 'people_you_may_know', 'People you may know', 'قد تكون تعرف الناس', 'Mensen die u misschien kent', 'Les gens que vous connaissez peut-être', 'Leute die Sie vielleicht kennen', 'Люди, которых вы, возможно, знаете', 'Gente que pueda conocer', 'Tanıyor Olabileceğiniz İnsanlar'),
(181, 'no_more_users_to_show', 'No more users to show', 'لا مزيد من المستخدمين للعرض', 'Geen gebruikers meer om te laten zien', 'Pas plus d\'utilisateurs à montrer', 'Keine weiteren Benutzer zum Anzeigen', 'Нет больше пользователей, чтобы показать', 'No hay más usuarios para mostrar', 'Gösterilecek başka kullanıcı yok'),
(182, 'question', 'Question', 'سؤال', 'Vraag', 'Question', 'Frage', 'Вопрос', 'Pregunta', 'Soru'),
(183, 'photo_poll', 'Photo Poll', 'استفتاء صور', 'Foto peiling', 'Sondage photo', 'Fotoumfrage', 'Фото опрос', 'Encuesta de fotos', 'Fotoğraf Anketi'),
(184, 'what_s_going_on__ask_anything..', 'What&#039;s going on? Ask anything..', 'ماذا يحدث هنا؟ اسأل أي شيء ..', 'Wat gebeurd er? Vraag iets..', 'Que se passe-t-il? Demandez n\'importe quoi ..', 'Was ist los? Frag irgendwas..', 'В чем дело? Спроси что-нибудь ..', '¿Que esta pasando? Pregunta cualquier cosa..', 'Neler oluyor? Dilediğini sor..'),
(185, 'ask_anonymously', 'Ask anonymously', 'اسأل متخفيا', 'vraag anoniem', 'demander anonymement', 'Anonym Fragen', 'спросить анонимно', 'Pregunta anónimamente', 'Anonim olarak sor'),
(186, 'create_photo_poll', 'Create photo poll', 'إنشاء استفتاء صور', 'Maak een foto-enquête', 'Créer un sondage photo', 'Fotoumfrage erstellen', 'Создать фото опрос', 'Crear encuesta de fotos', 'Fotoğraf anketi oluştur'),
(187, 'choice_1', 'Choice 1', 'الاختيار 1', 'Keuze 1', 'Choix 1', 'Wahl 1', 'Выбор 1', 'Elección 1', 'Seçim 1'),
(188, 'click_to_upload_your_image', 'Click to upload your image', 'انقر لتحميل صورتك', 'Klik om uw afbeelding te uploaden', 'Cliquez pour télécharger votre image', 'Klicken Sie hier, um Ihr Bild hochzuladen', 'Нажмите, чтобы загрузить свое изображение', 'Haz click para subir tu imagen.', 'Resminizi yüklemek için tıklayın'),
(189, 'choice_2', 'Choice 2', 'الاختيار 2', 'Keuze 2', 'Choix 2', 'Wahl 2', 'Выбор 2', 'Elección 2', 'Seçim 2'),
(190, 'cancel', 'Cancel', 'إلغاء', 'annuleren', 'Annuler', 'Stornieren', 'отменить', 'Cancelar', 'İptal etmek'),
(191, 'you_haven___t_posted_any_questions_yet', 'You haven&#039;t posted any questions yet', 'لم تنشر أي أسئلة حتى الآن', 'Je hebt nog geen vragen geplaatst', 'Vous n\'avez pas encore posté de questions', 'Sie haben noch keine Fragen gestellt', 'У вас еще нет вопросов', 'Aún no has publicado ninguna pregunta.', 'Henüz bir soru göndermediniz'),
(192, 'done', 'Done.', 'فعله.', 'Gedaan.', 'Terminé.', 'Erledigt.', 'Готово.', 'Hecho.', 'Bitti.'),
(193, 'you_have_to_select_two_image.', 'You have to select two image.', 'يجب عليك اختيار صورتين.', 'U moet twee afbeeldingen selecteren.', 'Vous devez sélectionner deux images.', 'Sie müssen zwei Bilder auswählen.', 'Вы должны выбрать два изображения.', 'Tienes que seleccionar dos imágenes.', 'İki resim seçmelisin.'),
(194, 'ask', 'Ask', 'يطلب', 'Vragen', 'Demander', 'Fragen', 'Просить', 'Pedir', 'Sor'),
(195, 'notification_profile_visit_u', 'visited your profile.', 'زار ملفك الشخصي.', 'heb je profiel bezocht.', 'a visité votre profil.', 'besuchte dein Profil.', 'посетил ваш профиль.', 'visitó tu perfil.', 'Profilini ziyaret etti.'),
(196, 'answer_it', 'Answer It', 'الإجابة عليه', 'Antwoord Het', 'Répondez', 'Antworte es', 'Ответить', 'Contestarlo', 'Cevapla'),
(197, 'write_your_answer_here.', 'Write your answer here.', 'اكتب إجابتك هنا.', 'Schrijf hier je antwoord.', 'Écrivez votre réponse ici.', 'Schreibe deine Antwort hier.', 'Напишите здесь ваш ответ.', 'Escribe tu respuesta aquí.', 'Cevabınızı buraya yazın.'),
(198, 'answer', 'Answer', 'إجابة', 'Antwoord', 'Réponse', 'Antworten', 'Ответ', 'Responder', 'Cevap'),
(199, 'anonymous', 'Anonymous', 'مجهول', 'Anoniem', 'Anonyme', 'Anonym', 'анонимное', 'Anónimo', 'Anonim'),
(200, 'share', 'Share', 'شارك', 'Delen', 'Partager', 'Aktie', 'Поделиться', 'Compartir', 'Pay'),
(201, 'it___s_not_recommended_to_make_a_poll_with_photos_of_your_friends_without_their_consent._we_will_remove_such_a_poll__if_it___s_reported.', 'It&#039;s not recommended to make a poll with photos of your friends without their consent. We will remove such a poll, if it&#039;s reported.', 'لا يُنصح بإجراء استطلاع رأي يحتوي على صور لأصدقائك دون موافقتهم. سنقوم بإزالة مثل هذا الاستطلاع ، إذا تم الإبلاغ عنه.', 'Het is niet aan te raden om een ​​peiling uit te voeren met foto\'s van je vrienden zonder hun toestemming. We zullen een dergelijke peiling verwijderen als deze is gemeld.', 'Il n\'est pas recommandé de faire un sondage avec les photos de vos amis sans leur consentement. Nous allons supprimer un tel sondage, s\'il est rapporté.', 'Es wird nicht empfohlen, eine Umfrage mit Fotos Ihrer Freunde ohne deren Zustimmung durchzuführen. Wir werden eine solche Umfrage entfernen, wenn sie gemeldet wird.', 'Не рекомендуется делать опрос с фотографиями ваших друзей без их согласия. Мы удалим такой опрос, если он будет опубликован.', 'No se recomienda hacer una encuesta con fotos de tus amigos sin su consentimiento. Vamos a eliminar tal encuesta, si se informa.', 'Arkadaşlarınızın fotoğraflarıyla izinsiz olarak anket yapmak önerilmez. Bildirildiği takdirde böyle bir anketi kaldıracağız.'),
(202, 'edit', 'Edit', 'تصحيح', 'Bewerk', 'modifier', 'Bearbeiten', 'редактировать', 'Editar', 'Düzenle'),
(203, 'report', 'Report', 'أبلغ عن', 'Verslag doen van', 'rapport', 'Bericht', 'отчет', 'Informe', 'Rapor'),
(204, 'delete_question', 'Delete question', 'حذف السؤال', 'Vraag verwijderen', 'Supprimer la question', 'Frage löschen', 'Удалить вопрос', 'Eliminar pregunta', 'Soruyu sil'),
(205, 'are_you_sure_you_want_to_continue__this_action_can_t_be_undo', 'Are you sure you want to continue? this action can&#039;t be undo', 'هل أنت متأكد من أنك تريد المتابعة؟ لا يمكن التراجع عن هذا الإجراء', 'Weet je zeker dat je door wilt gaan? deze actie kan niet ongedaan worden gemaakt', 'Es-tu sur de vouloir continuer? cette action ne peut pas être annulée', 'Sind Sie sicher, dass Sie fortfahren möchten? Diese Aktion kann nicht rückgängig gemacht werden', 'Вы уверены что хотите продолжить? это действие не может быть отменено', 'Estás seguro de que quieres continuar? esta acción no se puede deshacer', 'Devam etmek istediğine emin misin? bu işlem geri alınamaz'),
(206, 'close', 'CLOSE', 'أغلق', 'DICHTBIJ', 'FERMER', 'SCHLIESSEN', 'БЛИЗКО', 'CERRAR', 'KAPAT'),
(207, 'question_deleted_successfully', 'Question deleted successfully', 'تم حذف السؤال بنجاح', 'Vraag is met succes verwijderd', 'Question supprimée avec succès', 'Frage erfolgreich gelöscht', 'Вопрос успешно удален', 'Pregunta eliminada exitosamente', 'Soru başarıyla silindi'),
(208, 'error_while_delete_question', 'An error occurred while deleting the question.', 'حدث خطأ أثناء حذف السؤال.', 'Er is een fout opgetreden bij het verwijderen van de vraag.', 'Une erreur s\'est produite lors de la suppression de la question.', 'Beim Löschen der Frage ist ein Fehler aufgetreten.', 'Произошла ошибка при удалении вопроса.', 'Se ha producido un error al eliminar la pregunta.', 'Soruyu silerken bir hata oluştu.'),
(209, 'edit_question', 'Edit question', 'تحرير السؤال', 'Bewerk vraag', 'Modifier la question', 'Frage bearbeiten', 'Редактировать вопрос', 'Editar pregunta', 'Soruyu düzenle'),
(210, 'question_updated_successfully', 'Question updated successfully.', 'تم تحديث السؤال بنجاح.', 'Vraag is succesvol bijgewerkt.', 'Question mise à jour avec succès.', 'Frage erfolgreich aktualisiert.', 'Вопрос успешно обновлен.', 'Pregunta actualizada con éxito.', 'Soru başarıyla güncellendi.'),
(211, 'load_more_questions', 'Load more questions', 'تحميل المزيد من الأسئلة', 'Laad meer vragen', 'Charger plus de questions', 'Laden Sie weitere Fragen', 'Загрузить больше вопросов', 'Cargar más preguntas', 'Daha fazla soru yükle'),
(212, 'no_more_questions', 'No more questions', 'لا مزيد من الاسئلة', 'Geen vragen meer', 'Pas plus de questions', 'Keine weiteren Fragen', 'Больше нет вопросов', 'No mas preguntas', 'Daha fazla soru yok'),
(213, 'report_question', 'Report question', 'السؤال عن السؤال', 'Vraag melden', 'Signaler une question', 'Frage melden', 'Сообщить о вопросе', 'Pregunta de informe', 'Soruyu bildir'),
(214, 'write_here_the_reason_of_reporting.', 'Write here the reason of reporting.', 'اكتب هنا سبب الإبلاغ.', 'Schrijf hier de reden van rapportage.', 'Écrivez ici la raison du signalement.', 'Schreiben Sie hier den Grund der Meldung.', 'Напишите здесь причину сообщения.', 'Escriba aquí el motivo de la presentación de informes.', 'Raporlama nedenini buraya yazın.'),
(215, 'delete_report', 'Delete report', 'حذف التقرير', 'Verwijder rapport', 'Supprimer le rapport', 'Bericht löschen', 'Удалить отчет', 'Eliminar informe', 'Raporu sil'),
(216, 'unreport', 'Unreport', 'Unreport', 'Unreport', 'Déclarer', 'Bericht nicht melden', 'Unreport', 'Desinformar', 'Bildir'),
(217, 'report_deleted_successfully', 'Report deleted successfully', 'تم حذف التقرير بنجاح', 'Rapport is succesvol verwijderd', 'Rapport supprimé avec succès', 'Bericht erfolgreich gelöscht', 'Отчет успешно удален', 'Informe eliminado con éxito', 'Rapor başarıyla silindi'),
(218, 'question_likes', 'Question likes', 'سؤال يحب', 'Vraag leuk', 'Question aime', 'Frage mag', 'Вопрос лайков', 'Pregunta le gusta', 'Soru sever'),
(219, 'you_already_shared_this_post', 'You already shared this post.', 'لقد شاركت هذه المشاركة بالفعل.', 'Je hebt dit bericht al gedeeld.', 'Vous avez déjà partagé ce post.', 'Sie haben diesen Beitrag bereits geteilt.', 'Вы уже поделились этим постом.', 'Ya has compartido esta publicación.', 'Bu yayını zaten paylaştınız.'),
(220, 'question_shared_successfully', 'Question was successfully added to your timeline!\r\n\r\n', 'تمت إضافة سؤال بنجاح إلى المخطط الزمني الخاص بك!', 'Vraag is toegevoegd aan je tijdlijn!', 'La question a été ajoutée avec succès à votre timeline!', 'Die Frage wurde erfolgreich zu Ihrer Timeline hinzugefügt!', 'Вопрос был успешно добавлен в ваш график!', 'La pregunta se agregó exitosamente a tu línea de tiempo!', 'Soru, zaman çizelgenize başarıyla eklendi!'),
(221, 'shared', 'shared', 'مشترك', 'gedeelde', 'partagé', 'geteilt', 'общий', 'compartido', 'paylaşılan'),
(222, 'question.', 'question.', 'سؤال.', 'vraag.', 'question.', 'Frage.', 'вопрос.', 'pregunta.', 'soru.'),
(223, 'like_your_question', 'liked your question', 'أحب سؤالك', 'beviel je vraag', 'aimé votre question', 'mochte deine Frage', 'понравился твой вопрос', 'me gustó tu pregunta', 'sorunuzu beğendim'),
(224, 'share_your_question', 'shared your question', 'شارك سؤالك', 'deelde je vraag', 'partagé votre question', 'hat deine Frage geteilt', 'поделился своим вопросом', 'compartió tu pregunta', 'sorunuzu paylaştı'),
(225, 'answered', 'answered', 'أجاب', 'antwoordde', 'répondu', 'antwortete', 'ответил', 'contestado', 'cevap'),
(226, 'open_in_new_tab', 'Open in new tab', 'فتح في علامة تبويب جديدة', 'Openen in nieuw tabblad', 'Ouvrir dans un nouvel onglet', 'In neuem Tab öffnen', 'Открыть в новой вкладке', 'Abrir en una pestaña nueva', 'Yeni sekmede aç'),
(227, 'share_question', 'Share question', 'حصة السؤال', 'Vraag delen', 'Partager la question', 'Frage teilen', 'Поделитесь вопросом', 'Compartir pregunta', 'Soruyu paylaş'),
(228, 'share_to_timeline', 'Share to timeline', 'شارك في الجدول الزمني', 'Delen op tijdlijn', 'Partager sur la timeline', 'Teilen Sie mit der Zeitleiste', 'Поделиться с графиком', 'Compartir en la línea de tiempo', 'Zaman çizelgesine paylaş'),
(229, 'copy_link', 'Copy link', 'انسخ الرابط', 'Kopieer link', 'Copier le lien', 'Link kopieren', 'Копировать ссылку', 'Copiar link', 'Bağlantıyı kopyala'),
(230, 'click_on_link_to_copy', 'Click on link to Copy', 'انقر على رابط للنسخ', 'Klik op de link om te kopiëren', 'Cliquez sur le lien pour copier', 'Klicken Sie auf den Link zum Kopieren', 'Нажмите на ссылку, чтобы скопировать', 'Haga clic en el enlace para copiar', 'Kopyalamak için linke tıklayın'),
(231, 'link_copied.', 'Link copied.', 'رابط المنسوخ.', 'Link gekopieerd.', 'Lien copié.', 'Link kopiert', 'Ссылка скопирована.', 'Enlace copiado.', 'Bağlantı kopyalandı.'),
(232, 'trending_questions', 'Trending Questions', 'الأسئلة الشائعة', 'Trending vragen', 'Questions tendances', 'Aktuelle Fragen', 'Актуальные вопросы', 'Preguntas de tendencias', 'Popüler Sorular'),
(233, 'notification_view_question', 'View question', 'عرض السؤال', 'Bekijk vraag', 'Voir la question', 'Frage anzeigen', 'Посмотреть вопрос', 'Ver pregunta', 'Soruyu görüntüle'),
(234, 'someone_liked_my_questions', 'Someone liked my questions', 'شخص ما أحب أسئلتي', 'Iemand vond mijn vragen leuk', 'Quelqu\'un a aimé mes questions', 'Jemand mochte meine Fragen', 'Кому-то понравились мои вопросы', 'A alguien le gustaron mis preguntas', 'Birisi sorularımı beğendi'),
(235, 'someone_shared_my_questions', 'Someone shared my questions', 'شارك شخص ما أسئلتي', 'Iemand heeft mijn vragen gedeeld', 'Quelqu\'un a partagé mes questions', 'Jemand hat meine Fragen geteilt', 'Кто-то поделился моими вопросами', 'Alguien ha compartido mis preguntas', 'Birisi sorularımı paylaştı'),
(236, 'mention_post', 'mentioned you in a question.', 'ذكرك في سؤال.', 'heeft je in een vraag genoemd.', 'vous a mentionné dans une question.', 'hat dich in einer Frage erwähnt.', 'упомянул вас в вопросе.', 'te mencioné en una pregunta.', 'bir soruda sizden bahsetti.'),
(237, 'mention_your_question_replay', 'mentioned you in a reply.', 'ذكرت لك في الرد.', 'heeft je in een antwoord genoemd.', 'vous a mentionné dans une réponse.', 'hat Sie in einer Antwort erwähnt.', 'упомянул вас в ответе.', 'te mencioné en una respuesta.', 'bir cevapta sizden bahsetti.');
INSERT INTO `langs` (`id`, `lang_key`, `english`, `arabic`, `dutch`, `french`, `german`, `russian`, `spanish`, `turkish`) VALUES
(238, 'mention_your_question_answer', 'mentioned you in a answer.', 'ذكرك في إجابة.', 'heeft je in een antwoord genoemd.', 'vous a mentionné dans une réponse.', 'hat dich in einer Antwort erwähnt.', 'упомянул вас в ответе.', 'Te mencioné en una respuesta.', 'Bir cevapta sizden bahsetti.'),
(239, 'please_log_in_to_ask_answer_share_and_like__', 'Please log in to ask,answer,share and like !', 'يرجى تسجيل الدخول لطرح والإجابة والمشاركة ومثل!', 'Log in om te vragen, te beantwoorden, te delen en leuk te vinden!', 'Veuillez vous connecter pour demander, répondre, partager et aimer!', 'Bitte melden Sie sich an, um zu fragen, zu antworten, zu teilen und zu mögen!', 'Пожалуйста, войдите, чтобы задать вопрос, ответить, поделиться и лайк!', 'Por favor inicie sesión para preguntar, responder, compartir y gustar!', 'Sormak, cevaplamak, paylaşmak ve beğenmek için lütfen giriş yapın!'),
(240, 'no_results_found_for_your_query.', 'No results found for your query.', 'لا توجد نتائج للاستعلام.', 'Geen resultaten gevonden voor uw zoekopdracht.', 'Aucun résultat n\'a été trouvé pour votre recherche.', 'Keine Ergebnisse für Ihre Anfrage gefunden.', 'Результатов по вашему запросу не найдено.', 'No se encontraron resultados para su consulta.', 'Terimi için sonuç bulunamadı.'),
(241, 'write_your_replay_here.', 'Write your replay here.', 'اكتب ردك هنا.', 'Schrijf hier je herhaling.', 'Ecrivez votre replay ici.', 'Schreiben Sie Ihre Wiederholung hier.', 'Напишите свой реплей здесь.', 'Escribe tu repetición aquí.', 'Replay\'inizi buraya yazın.'),
(242, 'replay', 'Reply', 'الرد', 'Antwoord', 'Répondre', 'Antworten', 'Ответить', 'Respuesta', 'cevap'),
(243, 'replay_it', 'Reply', 'الرد', 'Antwoord', 'Répondre', 'Antworten', 'Ответить', 'Respuesta', 'cevap'),
(244, 'notification_view_replay', 'view reply', 'شاهد الرد', 'bekijk antwoord', 'voir la réponse', 'Antwort anzeigen', 'посмотреть ответ', 'ver respuesta', 'cevabı görüntüle'),
(245, 'replay_your_question', 'replied to your answer', 'رد على إجابتك', 'antwoordde op uw antwoord', 'répondu à votre réponse', 'antwortete auf deine Antwort', 'ответил на ваш ответ', 'respondió a tu respuesta', 'cevabınıza cevap verdi'),
(246, 'no_replies_yet.', 'No replies yet.', 'لا توجد ردود بعد.', 'Nog geen antwoorden.', 'Aucune réponse pour le moment.', 'Noch keine Antworten', 'Ответов пока нет.', 'No hay respuestas todavía.', 'Henüz bir cevap yok.'),
(247, 'no_replies_to_show.', 'No replies to show.', 'لا توجد ردود لعرضها.', 'Geen antwoorden te zien.', 'Aucune réponse à afficher.', 'Keine Antworten zu zeigen.', 'Нет ответов, чтобы показать.', 'No hay respuestas para mostrar.', 'Gösterilecek cevap yok.'),
(248, 'like_your_replay', 'liked your reply', 'أعجبني ردك', 'vond je antwoord leuk', 'aimé votre réponse', 'mochte deine Antwort', 'понравился твой ответ', 'me gustó tu respuesta', 'cevabını beğendim'),
(249, 'public', 'Public', 'عامة', 'Openbaar', 'Publique', 'Öffentlichkeit', 'общественного', 'Público', 'halka açık'),
(250, 'private', 'Private', 'نشر', 'Privaat', 'Privé', 'Privatgelände', 'Частный', 'Privado', 'Özel'),
(251, 'user_ask', 'asked you a question', 'سألتك سؤال', 'stelde je een vraag', 'vous a posé une question', 'habe dir eine Frage gestellt', 'задал вам вопрос', 'te hice una pregunta', 'sana bir soru sordum'),
(252, 'asked', 'asked', 'طلبت', 'gevraagd', 'a demandé', 'fragte', 'спросил', 'preguntó', 'diye sordu'),
(253, 'someone', 'Someone', 'شخصا ما', 'Iemand', 'Quelqu\'un', 'Jemand', 'Кто то', 'Alguien', 'Birisi'),
(254, 'no_question_found.', 'No question found.', 'لم يتم العثور على سؤال.', 'Geen vraag gevonden', 'Aucune question trouvée.', 'Keine Frage gefunden', 'Вопрос не найден.', 'No se encontró ninguna pregunta.', 'Hiçbir soru bulunamadı.'),
(255, 'no_users_found.', 'No users found.', 'لم يتم العثور على أي مستخدم.', 'Geen gebruikers gevonden.', 'Aucun utilisateur trouvé.', 'Keine Benutzer gefunden.', 'Пользователи не найдены.', 'No se encontraron usuarios.', 'Kullanıcı bulunamadı.'),
(256, 'recent_searches', 'Recent searches', 'عمليات البحث الأخيرة', 'Recente zoekopdrachten', 'Recherches récentes', 'Letzte Suchanfragen', 'Недавние поиски', 'Búsquedas recientes', 'Son aramalar'),
(257, 'clear', 'Clear', 'واضح', 'Duidelijk', 'Clair', 'klar', 'Очистить', 'Claro', 'Açık'),
(258, 'trending_searches', 'Trending searches', 'عمليات البحث الرائجة', 'Populaire zoekopdrachten', 'Tendances de recherche', 'Trend-Suchanfragen', 'Тенденции поиска', 'Búsquedas de tendencias', 'Popüler aramalar'),
(259, 'not_recent_search_found', 'Not recent search found', 'لم يتم العثور على بحث حديث', 'Geen recente zoekopdracht gevonden', 'Recherche récente non trouvée', 'Nicht letzte Suche gefunden', 'Не найден недавний поиск', 'No se ha encontrado una búsqueda reciente.', 'Son arama bulunamadı'),
(260, 'not_trending_search_found', 'Not trending search found', 'لم يتم العثور على نتائج البحث', 'Geen trending zoekopdracht gevonden', 'Pas de recherche trouvée', 'Trendsuche nicht gefunden', 'Не найдено тенденций поиска', 'No hay tendencias de búsqueda encontradas', 'Trend araması bulunamadı'),
(261, 'load_more_users', 'Load more users', 'تحميل المزيد من المستخدمين', 'Meer gebruikers laden', 'Charger plus d\'utilisateurs', 'Laden Sie mehr Benutzer', 'Загрузить больше пользователей', 'Cargar más usuarios', 'Daha fazla kullanıcı yükle'),
(262, 'no_more_users', 'No more users', 'لا مزيد من المستخدمين', 'Geen gebruikers meer', 'Pas plus d\'utilisateurs', 'Keine weiteren Benutzer', 'Нет больше пользователей', 'No mas usuarios', 'Başka kullanıcı yok'),
(263, 'advertising', 'Advertising', 'إعلان', 'Advertising', 'La publicité', 'Werbung', 'реклама', 'Publicidad', 'reklâm'),
(264, 'create_new', 'Create New', 'خلق جديد إبداع جديد', 'Maak nieuw', 'Créer un nouveau', 'Erstelle neu', 'Создать новый', 'Crear nuevo', 'Yeni oluşturmak'),
(265, 'wallet', 'Wallet', 'محفظة نقود', 'Portemonnee', 'Portefeuille', 'Brieftasche', 'Бумажник', 'Billetera', 'Cüzdan'),
(266, 'id', 'id', 'هوية شخصية', 'ID kaart', 'identifiant', 'Ich würde', 'Я бы', 'carné de identidad', 'İD'),
(267, 'company', 'company', 'شركة', 'bedrijf', 'entreprise', 'Unternehmen', 'Компания', 'empresa', 'şirket'),
(268, 'bidding', 'bidding', 'مزايدة', 'bod', 'enchère', 'Bieten', 'торги', 'ofertas', 'teklif verme'),
(269, 'clicks', 'clicks', 'نقرات', 'clicks', 'clics', 'Klicks', 'щелчки', 'clics', 'tıklama'),
(270, 'views', 'views', 'الآراء', 'keer bekeken', 'vues', 'Ansichten', 'Просмотры', 'puntos de vista', 'görünümler'),
(271, 'status', 'status', 'الحالة', 'staat', 'statut', 'Status', 'статус', 'estado', 'durum'),
(272, 'action', 'action', 'عمل', 'actie', 'action', 'Aktion', 'действие', 'acción', 'aksiyon'),
(273, 'no_ads_found', 'No ads found', 'لم يتم العثور على إعلانات', 'Geen advertenties gevonden', 'Aucune annonce trouvée', 'Keine Anzeigen gefunden', 'Объявления не найдены', 'No se encontraron anuncios', 'Hiçbir reklam bulunamadı'),
(274, 'enter_a_link_to_your_site', 'Enter a link to your site', 'أدخل رابطًا إلى موقعك', 'Voer een link naar uw site in', 'Entrez un lien vers votre site', 'Geben Sie einen Link zu Ihrer Site ein', 'Введите ссылку на ваш сайт', 'Introduce un enlace a tu sitio', 'Sitenize bir link girin'),
(275, 'title', 'Title', 'عنوان', 'Titel', 'Titre', 'Titel', 'заглавие', 'Título', 'Başlık'),
(276, 'description', 'Description', 'وصف', 'Omschrijving', 'La description', 'Beschreibung', 'Описание', 'Descripción', 'Açıklama'),
(277, 'media', 'Media', 'وسائل الإعلام', 'Media', 'Médias', 'Medien', 'Средства массовой информации', 'Medios de comunicación', 'medya'),
(278, 'no_file_chosen', 'No file chosen', 'لم تقم باختيار ملف', 'Geen bestand gekozen', 'Aucun fichier choisi', 'Keine Datei ausgewählt', 'Файл не выбран', 'Ningún archivo elegido', 'Dosya seçili değil'),
(279, 'audience', 'Audience', 'جمهور', 'Publiek', 'Public', 'Publikum', 'Аудитория', 'Audiencia', 'seyirci'),
(280, 'gender', 'Gender', 'جنس', 'Geslacht', 'Le sexe', 'Geschlecht', 'Пол', 'Género', 'Cinsiyet'),
(281, 'all', 'All', 'الكل', 'Allemaal', 'Tout', 'Alles', 'Все', 'Todos', 'Herşey'),
(282, 'estimated_reach', 'Estimated reach', 'الوصول المقدر', 'Geschat bereik', 'Portée estimée', 'Geschätzte Reichweite', 'Расчетный охват', 'Alcance estimado', 'Tahmini erişim'),
(283, 'publish', 'Publish', 'نشر', 'Publiceren', 'Publier', 'Veröffentlichen', 'Публиковать', 'Publicar', 'Yayınla'),
(284, 'url', 'Url', 'رابط', 'url', 'URL', 'URL', 'Веб-сайт', 'Url', 'URL'),
(285, 'choose_file', 'Choose File', 'اختر ملف', 'Kies bestand', 'Choisir le fichier', 'Datei wählen', 'Выберите файл', 'Elija el archivo', 'Dosya seçin'),
(286, 'pay_per_click', 'Pay Per Click (${{PRICE}})', 'الدفع مقابل النقر ($ {{PRICE}})', 'Betaal per klik ($ {{PRICE}})', 'Pay Per Click ($ {{PRICE}})', 'Pay Per Click ($ {{PRICE}})', 'Оплата за клик ($ {{PRICE}})', 'Pago por clic ($ {{PRICE}})', 'Tıklama Başına Ödeme ($ {{PRICE}})'),
(287, 'pay_per_imprssion', 'Pay Per Impression (${{PRICE}})', 'الدفع مقابل الظهور ($ {{PRICE}})', 'Betaal per vertoning ($ {{PRICE}})', 'Pay Per Impression ($ {{PRICE}})', 'Pay Per Impression ($ {{PRICE}})', 'Оплата за показ ($ {{PRICE}})', 'Pago por impresión ($ {{PRICE}})', 'Gösterim Başına Ödeme ($ {{PRICE}})'),
(288, 'your_current_wallet_balance_is__0__please_top_up_your_wallet_to_continue.', 'Your current wallet balance is: 0, please top up your wallet to continue.', 'رصيد المحفظة الحالي هو: 0 ، يرجى تعبئة محفظتك للمتابعة.', 'Je huidige walletsaldo is: 0, vul je portemonnee bij om door te gaan.', 'Votre solde de portefeuille actuel est égal à: 0, veuillez recharger votre portefeuille pour continuer.', 'Ihr aktuelles Guthabenkonto ist: 0, bitte füllen Sie Ihr Guthaben auf, um fortzufahren.', 'Ваш текущий баланс кошелька: 0, пополните свой кошелек, чтобы продолжить.', 'El saldo actual de su billetera es: 0, por favor recargue su billetera para continuar.', 'Geçerli cüzdan bakiyeniz: 0, lütfen devam etmek için cüzdanınızı doldurun.'),
(289, 'top_up', 'Top up', 'فوق حتى', 'Herladen', 'Recharger', 'Auffüllen', 'Пополнить', 'Completar', 'Tamam'),
(290, 'replenishment_notif', 'Your balance has been replenished by', 'رصيدك تم تجديده بواسطة', 'Je saldo is aangevuld door', 'Votre solde a été réapprovisionné par', 'Ihr Guthaben wurde von aufgestockt', 'Ваш баланс был пополнен', 'Su saldo ha sido repuesto por', 'Bakiyeniz tarafından doldurulan'),
(291, 'my_balance', 'My balance', 'رصيدي', 'Mijn balans', 'Mon solde', 'Mein Gleichgewicht', 'Мой баланс', 'Mi balance', 'Benim dengem'),
(292, 'replenish_my_balance', 'Replenish my balance', 'تجديد رصيدي', 'Vul mijn balans aan', 'Reconstituer mon solde', 'Fülle mein Gleichgewicht auf', 'Пополнить мой баланс', 'Reponer mi equilibrio', 'Bakiyemi doldur'),
(293, 'continue', 'Continue', 'استمر', 'Doorgaan met', 'Continuer', 'Fortsetzen', 'Продолжить', 'Continuar', 'Devam et'),
(294, 'ad_added', 'Your ad has been successfully added!', 'تمت إضافة إعلانك بنجاح!', 'Uw advertentie is succesvol toegevoegd!', 'Votre annonce a été ajoutée avec succès!', 'Ihre Anzeige wurde erfolgreich hinzugefügt!', 'Ваше объявление было успешно добавлено!', 'Su anuncio ha sido añadido con éxito!', 'Reklamınız başarıyla eklendi!'),
(295, 'file_too_big', 'File size error: The file exceeds allowed the limit ({file_size}) and can not be uploaded.', 'خطأ في حجم الملف: تجاوز الملف المسموح به ({file_size}) ولا يمكن تحميله.', 'Fout bestandsgrootte: het bestand overschrijdt de toegestane limiet ({file_size}) en kan niet worden geüpload.', 'Erreur de taille de fichier: le fichier dépasse la limite autorisée ({taille_fichier}) et ne peut pas être téléchargé.', 'Dateigrößenfehler: Die Datei überschreitet den Grenzwert ({file_size}) und kann nicht hochgeladen werden.', 'Ошибка размера файла: файл превышает допустимый предел ({file_size}) и не может быть загружен.', 'Error de tamaño de archivo: el archivo supera el límite permitido ({file_size}) y no se puede cargar.', 'Dosya boyutu hatası: Dosya sınırı aşıyor ({file_size}) ve limit yüklenemiyor.'),
(296, 'select_valid_vid', 'Media file is invalid. Please select a valid video', 'ملف الوسائط غير صالح. يرجى تحديد فيديو صالح', 'Mediabestand is ongeldig. Selecteer een geldige video', 'Le fichier multimédia n\'est pas valide. Veuillez sélectionner une vidéo valide', 'Mediendatei ist ungültig. Bitte wähle ein gültiges Video', 'Медиа-файл недействителен. Пожалуйста, выберите действительное видео', 'El archivo de medios no es válido. Por favor seleccione un video válido', 'Medya dosyası geçersiz. Lütfen geçerli bir video seçin'),
(297, 'select_valid_img', 'Media file is invalid. Please select a valid image', 'ملف الوسائط غير صالح. يرجى اختيار صورة صالحة', 'Mediabestand is ongeldig. Selecteer een geldige afbeelding', 'Le fichier multimédia n\'est pas valide. Veuillez sélectionner une image valide', 'Mediendatei ist ungültig. Bitte wählen Sie ein gültiges Bild aus', 'Медиа-файл недействителен. Пожалуйста, выберите действительное изображение', 'El archivo de medios no es válido. Por favor seleccione una imagen válida', 'Medya dosyası geçersiz. Lütfen geçerli bir resim seçin'),
(298, 'select_valid_img_vid', 'Media file is invalid. Please select a valid image or video', 'ملف الوسائط غير صالح. يرجى تحديد صورة أو فيديو صالح', 'Mediabestand is ongeldig. Selecteer een geldige afbeelding of video', 'Le fichier multimédia n\'est pas valide. Veuillez sélectionner une image ou une vidéo valide', 'Mediendatei ist ungültig. Bitte wählen Sie ein gültiges Bild oder Video', 'Медиа-файл недействителен. Пожалуйста, выберите действительное изображение или видео', 'El archivo de medios no es válido. Por favor seleccione una imagen o video válido', 'Medya dosyası geçersiz. Lütfen geçerli bir resim veya video seçin'),
(299, 'enter_valid_title', 'Please enter a valid title', 'يرجى إدخال عنوان صالح', 'Voer een geldige titel in', 'S\'il vous plaît entrer un titre valide', 'Bitte geben Sie einen gültigen Titel ein', 'Пожалуйста, введите правильный заголовок', 'Por favor ingrese un título válido', 'Lütfen geçerli bir başlık girin'),
(300, 'enter_valid_url', 'Please enter a valid link!', 'الرجاء إدخال رابط صالح!', 'Voer alstublieft een geldige link in!', 'S\'il vous plaît entrer un lien valide!', 'Bitte geben Sie einen gültigen Link ein!', 'Пожалуйста, введите действительную ссылку!', 'Por favor, introduzca un enlace válido!', 'Lütfen geçerli bir link giriniz!'),
(301, 'invalid_company_name', 'Please enter a valid company name!', 'الرجاء إدخال اسم شركة صالح!', 'Voer alstublieft een geldige bedrijfsnaam in!', 'S\'il vous plaît entrer un nom de société valide!', 'Bitte geben Sie einen gültigen Firmennamen ein!', 'Пожалуйста, введите правильное название компании!', 'Por favor, introduzca un nombre de empresa válido!', 'Lütfen geçerli bir firma adı giriniz!'),
(302, 'active', 'Active', 'نشيط', 'Actief', 'actif', 'Aktiv', 'активный', 'Activo', 'Aktif'),
(303, 'edit_ads', 'Edit ads', 'تحرير الإعلانات', 'Bewerk advertenties', 'Modifier des annonces', 'Anzeigen bearbeiten', 'Редактировать объявления', 'Editar anuncios', 'Reklamları düzenle'),
(304, 'back_to_your_ads.', 'Back to your ads.', 'رجوع إلى إعلاناتك.', 'Terug naar uw advertenties.', 'Retour à vos annonces.', 'Zurück zu Ihren Anzeigen', 'Вернуться к вашим объявлениям.', 'Volver a sus anuncios.', 'Reklamlarınıza dönün.'),
(305, 'ad_saved', 'Your ad has been successfully saved!', 'تم حفظ إعلانك بنجاح!', 'Uw advertentie is succesvol opgeslagen!', 'Votre annonce a été enregistrée avec succès!', 'Ihre Anzeige wurde erfolgreich gespeichert!', 'Ваше объявление было успешно сохранено!', 'Su anuncio ha sido guardado con éxito!', 'Reklamınız başarıyla kaydedildi!'),
(307, 'confirm_delete_ad', 'Are you sure you want to delete this ad', 'هل أنت متأكد أنك تريد حذف هذا الإعلان', 'Weet je zeker dat je deze advertentie wilt verwijderen?', 'Êtes-vous sûr de vouloir supprimer cette annonce?', 'Möchten Sie diese Anzeige wirklich löschen?', 'Вы уверены, что хотите удалить эту рекламу', 'Estás seguro de que quieres eliminar esta publicidad', 'Bu reklamı silmek istediğinize emin misiniz?'),
(308, 'delete_ad', 'Delete ad', 'حذف الإعلان', 'Advertentie verwijderen', 'Supprimer l\'annonce', 'Anzeige löschen', 'Удалить объявление', 'Eliminar anuncio', 'Reklamı sil'),
(310, 'not_active', 'Not Active', 'غير نشيط', 'Niet actief', 'Pas actif', 'Nicht aktiv', 'Не активен', 'No activo', 'Aktif değil'),
(314, 'sponsored', 'sponsored', 'برعاية', 'gesponsorde', 'sponsorisé', 'gesponsert', 'спонсируемый', 'patrocinado', 'sponsorlu'),
(315, 'this', 'this', 'هذه', 'deze', 'ce', 'diese', 'этот', 'esta', 'bu'),
(316, 'reply', 'Reply', 'الرد', 'Antwoord', 'Répondre', 'Antworten', 'Ответить', 'Respuesta', 'cevap'),
(317, 'write_your_reply_here.', 'Write your reply here.', 'اكتب ردك هنا.', 'Schrijf hier uw antwoord.', 'Écrivez votre réponse ici.', 'Schreiben Sie Ihre Antwort hier.', 'Напишите свой ответ здесь.', 'Escribe tu respuesta aquí.', 'Cevabınızı buraya yazın.'),
(318, 'night_mode', 'Night mode', 'وضع الليل', 'Nachtstand', 'Mode nuit', 'Nacht-Modus', 'Ночной режим', 'Modo nocturno', 'Gece modu'),
(319, 'day_mode', 'Day mode', 'وضع اليوم', 'Dagmodus', 'Mode jour', 'Tagesmodus', 'Дневной режим', 'Modo día', 'Gün modu'),
(323, 'hide', 'hide', 'إخفاء', 'verbergen', 'cacher', 'verbergen', 'скрывать', 'esconder', 'saklamak'),
(324, 'spend', 'Spend', 'أنفق', 'Besteden', 'Dépenser', 'Verbringen', 'Проводить', 'Gastar', 'harcamak'),
(325, 'promote_question', 'Promote question', 'تعزيز السؤال', 'Vraag promoten', 'Promouvoir la question', 'Frage fördern', 'Продвигать вопрос', 'Promover pregunta', 'Soruyu yükseltin'),
(326, 'promote', 'Promote', 'ترويج', 'Promoten', 'Promouvoir', 'Fördern', 'содействовать', 'Promover', 'Desteklemek'),
(329, 'your_balance_is__', 'Your balance is', 'رصيدك هو', 'Je saldo is', 'Votre solde est', 'Ihr Gleichgewicht ist', 'Ваш баланс', 'Su balance es', 'Bakiyeniz'),
(330, 'your_question_will_be_promoted_for_24_hours_with', 'Your question will be promoted for 24 hours for', 'سيتم الترويج لسؤالك لمدة 24 ساعة', 'Uw vraag zal voor 24 uur worden gepromoot', 'Votre question sera promue pendant 24 heures pour', 'Ihre Frage wird 24 Stunden lang befördert', 'Ваш вопрос будет продвигаться в течение 24 часов для', 'Su pregunta será promovida por 24 horas para', 'Sorunuz 24 saat boyunca tanıtılacak'),
(331, 'unpromote', 'UnPromote', 'إلغاء الترويج', 'UnPromote', 'Annuler la promotion', 'UnPromote', 'UnPromote', 'No promover', 'UnPromote'),
(332, 'question_promoted_successfully', 'The question promoted  successfully', 'تم الترويج للسؤال بنجاح', 'De vraag is met succes gepromoot', 'La question promue avec succès', 'Die Frage wurde erfolgreich gefördert', 'Вопрос успешно продвигается', 'La pregunta promovida con éxito.', 'Soru başarıyla desteklendi'),
(333, 'promoted_for_24_hours', 'Promoted for 24 hours', 'رقيت لمدة 24 ساعة', '24 uur gepromoot', 'Promu pendant 24 heures', 'Befördert für 24 Stunden', 'Повышен в течение 24 часов', 'Promocionado por 24 horas.', '24 saat terfi'),
(334, 'question_unpromoted_successfully', 'The question unpromoted  successfully', 'السؤال unpromoted بنجاح', 'De vraag is niet succesvol gesteund', 'La question mal choisie', 'Die Frage wurde erfolgreich befürwortet', 'Вопрос не продвигается успешно', 'La pregunta no promueve exitosamente.', 'Soru başarılı bir şekilde yanıtlanmadı'),
(335, 'pay_using_paypal', 'Pay using PayPal', 'ادفع باستخدام PayPal', 'Betaal met PayPal', 'Payer avec PayPal', 'Zahlen Sie mit PayPal', 'Оплатить с помощью PayPal', 'Pagar usando paypal', 'PayPal ile ödeme yap'),
(336, 'vote', 'Vote', 'تصويت', 'Stemmen', 'Vote', 'Abstimmung', 'Голос', 'Votar', 'Oy'),
(337, 'question_voted_successfully', 'Question voted successfully', 'تم التصويت بنجاح', 'Vraag met succes goedgekeurd', 'Question votée avec succès', 'Frage erfolgreich gewählt', 'Вопрос проголосовал успешно', 'Pregunta votada con éxito', 'Soru başarıyla oy kullandı'),
(338, 'your_balance_is', 'Your balance is', 'رصيدك هو', 'Je saldo is', 'Votre solde est', 'Ihr Gleichgewicht ist', 'Ваш баланс', 'Su balance es', 'Bakiyeniz'),
(339, 'your_question_will_be_promoted_for_24_hours_for', 'Your question will be promoted for 24 hours for', 'سيتم الترويج لسؤالك لمدة 24 ساعة', 'Uw vraag zal voor 24 uur worden gepromoot', 'Votre question sera promue pendant 24 heures pour', 'Ihre Frage wird 24 Stunden lang befördert', 'Ваш вопрос будет продвигаться в течение 24 часов для', 'Su pregunta será promovida por 24 horas para', 'Sorunuz 24 saat boyunca tanıtılacak'),
(340, 'like', 'Like', 'مثل', 'Net zoals', 'Comme', 'Mögen', 'подобно', 'Me gusta', 'Sevmek'),
(341, 'liked', 'Liked', 'احب', 'vond', 'Aimé', 'Gefallen', 'Понравилось', 'Gustó', 'sevilen'),
(342, 'votes', 'Votes', 'الأصوات', 'stemmen', 'Votes', 'Abstimmungen', 'Голосов', 'Votos', 'oy'),
(343, 'your_question_was_successfully_posted', 'Your question was successfully posted', 'تم نشر سؤالك بنجاح', 'Uw vraag is succesvol geplaatst', 'Votre question a été postée avec succès', 'Ihre Frage wurde erfolgreich veröffentlicht', 'Ваш вопрос был успешно отправлен', 'Tu pregunta fue publicada con éxito.', 'Sorunuz başarıyla gönderildi'),
(344, 'your_report_was_successfully_posted', 'Your reported was successfully posted', 'تم نشر تقريرك بنجاح', 'Uw melding is succesvol geplaatst', 'Votre rapport a été posté avec succès', 'Ihre Meldung wurde erfolgreich veröffentlicht', 'Ваше сообщение было успешно опубликовано', 'Su informe fue publicado con éxito', 'Raporunuz başarıyla gönderildi'),
(345, 'your_answer_was_successfully_posted', 'Your answer was successfully posted', 'تم نشر إجابتك بنجاح', 'Uw antwoord is succesvol geplaatst', 'Votre réponse a été postée avec succès', 'Ihre Antwort wurde erfolgreich veröffentlicht', 'Ваш ответ был успешно опубликован', 'Tu respuesta fue publicada con éxito.', 'Cevabınız başarıyla gönderildi'),
(346, 'your_post_is_now_being_promoted', 'Your post is now being promoted', 'يتم الآن ترقية مشاركتك', 'Je bericht wordt nu gepromoveerd', 'Votre message est maintenant promu', 'Ihr Beitrag wird jetzt beworben', 'Ваш пост сейчас продвигается', 'Tu publicación ahora está siendo promovida.', 'Yayınınız şimdi tanıtılıyor'),
(347, 'character_limit_exceeded', 'Post character limit exceeded, allowed {{num}} characters', 'تم تجاوز حد عدد الأحرف المسموح به ، سمحت لعدد {{num}} من الأحرف', 'Limiet berichtteken overschreden, toegestane {{num}} tekens', 'Post limite de caractères dépassée, {{num}} caractères autorisés', 'Postzeichenlimit überschritten, erlaubte {{num}} Zeichen', 'Превышено ограничение на количество символов в сообщении', 'Se excedió el límite de caracteres de la publicación, caracteres {{num}} permitidos', 'Yayınlanan karakter sınırı aşıldı, {{num}} karaktere izin verildi'),
(348, 'limit_exceeded', 'Limit exceeded, please try again later.', 'تم تجاوز الحد ، يرجى المحاولة مرة أخرى في وقت لاحق.', 'Limiet overschreden, probeer het later opnieuw.', 'Limite dépassée, veuillez réessayer ultérieurement.', 'Limit überschritten, bitte versuchen Sie es später erneut.', 'Превышен лимит, повторите попытку позже.', 'Límite excedido, por favor intente de nuevo más tarde.', 'Sınır aşıldı, lütfen daha sonra tekrar deneyin.'),
(349, 'post_limit_exceeded', 'Post Limit exceeded, please try again later.', 'تم تجاوز حد النشر ، يرجى المحاولة مرة أخرى في وقت لاحق.', 'Postlimiet overschreden, probeer het later opnieuw.', 'Post Limit dépassé, veuillez réessayer ultérieurement.', 'Post Limit überschritten, bitte versuchen Sie es später erneut.', 'Превышен лимит сообщений, повторите попытку позже.', 'Se excedió el límite de publicación, inténtalo de nuevo más tarde.', 'Gönderi Sınırı aşıldı, lütfen daha sonra tekrar deneyin.'),
(350, 'answered_an_anonymous_question.', 'answered an anonymous question.', 'أجاب على سؤال مجهول.', 'antwoordde een anonieme vraag.', 'a répondu à une question anonyme.', 'beantwortete eine anonyme Frage.', 'ответил на анонимный вопрос.', 'Respondió una pregunta anónima.', 'isimsiz bir soruyu cevapladı.'),
(351, 'near_by_questions', 'Near by questions', 'بالقرب من الأسئلة', 'Dichtbij door vragen', 'Questions à proximité', 'In der Nähe von Fragen', 'Рядом с вопросами', 'Cerca de preguntas', 'Soruların yanında'),
(352, 'haven___t_posted_any_questions_yet', 'haven’t posted any questions yet', 'لم تنشر أي أسئلة حتى الآن', 'heb nog geen vragen geplaatst', 'n\'a pas encore posté de questions', 'hat noch keine Fragen gestellt', 'еще не отвечал ни на какие вопросы', 'no ha publicado ninguna pregunta todavía', 'henüz bir soru göndermediniz'),
(353, 'there_is_no_near_by_questions_yet', 'There is no near by questions yet', 'لا يوجد بالقرب من الأسئلة حتى الآن', 'Er zijn nog geen vragen in de buurt', 'Il n\'y a pas encore de question à proximité', 'Es gibt noch keine nahen Fragen', 'Еще нет вопросов рядом', 'No hay preguntas cercanas todavía.', 'Henüz soruların yaklaştığı bir şey yok.'),
(354, 'there_is_no_trending_questions_yet', 'There is no trending questions yet', 'لا توجد أسئلة شائعة حتى الآن', 'Er zijn nog geen trending-vragen', 'Il n\'y a pas encore de questions sur les tendances', 'Es gibt noch keine aktuellen Fragen', 'Там нет трендовых вопросов еще', 'Aún no hay preguntas de tendencias.', 'Henüz bir trend soru yok'),
(355, 'likes', 'likes', 'الإعجابات', 'sympathieën', 'aime', 'Likes', 'нравится', 'gustos', 'seviyor'),
(356, 'please_login_to_ask__answer__share__like__and_vote.', 'Please login to ask, answer, share, like, and vote.', 'الرجاء تسجيل الدخول للسؤال والإجابة والمشاركة والإبداء والتصويت.', 'Meld u aan om te vragen, te beantwoorden, te delen, leuk te vinden en te stemmen.', 'Veuillez vous connecter pour demander, répondre, partager, aimer et voter.', 'Bitte loggen Sie sich ein, um zu fragen, zu antworten, zu teilen, zu wählen und abzustimmen.', 'Пожалуйста, войдите, чтобы спрашивать, отвечать, делиться, ставить лайки и голосовать.', 'Por favor inicie sesión para preguntar, responder, compartir, \"me gusta\" y votar.', 'Sormak, cevaplamak, paylaşmak, beğenmek ve oy vermek için lütfen giriş yapın.'),
(357, 'created_a_new_poll.', 'created a new poll.', 'إنشاء استطلاع جديد.', 'heeft een nieuwe peiling gemaakt.', 'créé un nouveau sondage.', 'eine neue Umfrage erstellt.', 'создал новый опрос.', 'creó una nueva encuesta.', 'yeni bir anket oluşturdu.'),
(358, 'ago', 'ago', 'منذ', 'geleden', 'depuis', 'vor', 'тому назад', 'hace', 'önce'),
(359, 'from_now', 'from now', 'من الان', 'vanaf nu', 'à partir de maintenant', 'in', 'отныне', 'desde ahora', 'şu andan itibaren'),
(360, 'any_moment_now', 'any moment now', 'في اي لحظة الان', 'elk moment nu', 'n\'importe quel moment maintenant', 'jeden Moment jetzt', 'в любой момент', 'cualquier momento ahora', 'her an şimdi'),
(361, 'just_now', 'Just now', 'في هذة اللحظة', 'Net nu', 'Juste maintenant', 'Gerade jetzt', 'Прямо сейчас', 'Justo ahora', 'Şu anda'),
(362, 'about_a_minute_ago', 'about a minute ago', 'منذ دقيقة واحدة', 'ongeveer een minuut geleden', 'Il y a environ une minute', 'vor ungefähr einer Minute', 'около минуты назад', 'hace alrededor de un minuto', 'yaklaşık bir dakika önce'),
(363, '_d_minutes_ago', '%d minutes ago', 'قبل %d دقيقة', '%d minuten geleden', 'il y a %d minutes', 'vor %d Minuten', '%d минут назад', 'Hace %d minutos', '%d dakika önce'),
(364, 'about_an_hour_ago', 'about an hour ago', 'منذ ساعة تقريبا', 'ongeveer een uur geleden', 'il y a à peu près une heure', 'vor ungefähr einer Stunde', 'около часа назад', 'Hace aproximadamente una hora', 'yaklaşık bir saat önce'),
(365, '_d_hours_ago', '%d hours ago', 'قبل %d ساعة', '%d uur geleden', 'il y a %d heures', 'Vor %d Stunden', '%d часов назад', 'Hace %d horas', '%d saat önce'),
(366, 'a_day_ago', 'a day ago', 'قبل يوم', 'een dag geleden', 'il y a un jour', 'vor einem Tag', 'день назад', 'Hace un día', 'bir gün önce'),
(367, '_d_days_ago', '%d days ago', 'قبل %d يومًا', '%d dagen geleden', 'il y a %d jours', 'vor %d Tagen', '%d дней назад', 'Hace %d días', '%d gün önce'),
(368, 'about_a_month_ago', 'about a month ago', 'منذ شهر تقريبا', 'ongeveer een maand geleden', 'il y a environ un mois', 'vor ungefähr einem Monat', 'Около месяца назад', 'Hace más o menos un mes', 'yaklaşık bir ay önce'),
(369, '_d_months_ago', '%d months ago', 'قبل %d شهر', '%d maanden geleden', 'il y a %d mois', 'vor %d Monaten', '%d месяцев назад', 'Hace %d meses', '%d ay önce'),
(370, 'about_a_year_ago', 'about a year ago', 'قبل نحو سنة', 'ongeveer een jaar geleden', 'il y a un an à peu près', 'vor etwa einem Jahr', 'около года назад', 'Hace un año', 'yaklaşık bir yıl önce'),
(371, '_d_years_ago', '%d years ago', 'قبل %d سنة', '%d jaar geleden', 'il y a %d années', 'Vor %d Jahren', '%d лет назад', 'hace %d años', '%d yıl önce'),
(372, 'website_url', 'website Url', 'رابط الموقع', 'Website URL', 'URL de site web', 'Webadresse', 'ссылка на сайт', 'URL del sitio web', 'Web Sitesi URL\'si'),
(373, 'timeline', 'timeline', 'الجدول الزمني', 'tijdlijn', 'chronologie', 'Zeitleiste', 'график', 'línea de tiempo', 'zaman çizelgesi'),
(374, 'vs', 'vs', 'ضد', 'vs', 'contre', 'vs', 'против', 'vs', 'vs'),
(375, '__user_gender', '{{USER}} gender', '{{USER}} الجنس', '{{USER}} geslacht', '{{USER}} genre', '{{USER}} Geschlecht', '{{USER}} пол', '{{USUARIO}} género', '{{USER}} cinsiyet'),
(376, 'reply_updated_successfully', 'Reply updated successfully', 'تم تحديث الرد بنجاح', 'Antwoord is succesvol bijgewerkt', 'Réponse mise à jour avec succès', 'Antwort erfolgreich aktualisiert', 'Ответ успешно обновлен', 'Respuesta actualizada exitosamente', 'Yanıt başarıyla güncellendi'),
(377, 'answer_updated_successfully', 'Answer updated successfully', 'تم تحديث الرد بنجاح', 'Antwoord is succesvol bijgewerkt', 'Réponse mise à jour avec succès', 'Antwort erfolgreich aktualisiert', 'Ответ успешно обновлен', 'Respuesta actualizada con éxito', 'Yanıt başarıyla güncellendi'),
(378, 'messages', 'Messages', 'الرسائل', 'Berichten', 'messages', 'Mitteilungen', 'Сообщения', 'Mensajes', 'Mesajlar'),
(379, 'wowonder', 'WoWonder', 'رائع', 'WoWonder', 'WoWonder', 'WoWonder', 'WoWonder', 'WoWonder', 'WoWonder'),
(380, 'vkontakte', 'VKontakte', 'فكونتاكتي', 'VKontakte', 'VKontakte', 'VKontakte', 'В Контакте', 'VKontakte', 'VKontakte'),
(381, 'select_gender', 'Select gender', 'حدد نوع الجنس', 'Select Gender', 'Sélectionnez le sexe', 'Wähle Geschlecht', 'Выберите пол', 'Seleccione género', 'Cinsiyet seç'),
(382, 'select', 'Select', 'تحديد', 'Selecteer', 'Sélectionner', 'Wählen', 'Выбрать', 'Seleccione', 'seçmek'),
(383, 'select__gender', 'Select gender', 'حدد نوع الجنس', 'Selecteer geslacht', 'Sélectionnez le sexe', 'Wähle Geschlecht', 'Выберите пол', 'Seleccione género', 'Cinsiyet seç'),
(384, 'paypal', 'PayPal', 'باي بال', '', 'Pay Pal', 'PayPal', 'PayPal', 'PayPal', 'PayPal'),
(385, 'bank_transfer', 'Bank Transfer', 'التحويل المصرفي', 'Overschrijving', 'Virement', 'Banküberweisung', 'Банковский перевод', 'Transferencia bancaria', 'Banka transferi'),
(386, 'credit_card', 'Credit Card', 'بطاقة ائتمان', 'Kredietkaart', 'Carte de crédit', 'Kreditkarte', 'Кредитная карта', 'Tarjeta de crédito', 'Kredi kartı'),
(387, 'name', 'Name', 'اسم', 'Naam', 'Nom', 'Name', 'название', 'Nombre', 'ad'),
(388, 'card_number', 'Card Number', 'رقم البطاقة', 'Kaartnummer', 'Numéro de carte', 'Kartennummer', 'Номер карты', 'Número de tarjeta', 'Kart numarası'),
(389, 'pay', 'Pay', 'دفع', 'Betalen', 'Payer', 'Zahlen', 'Оплатить', 'Pagar', 'Ödemek'),
(390, 'upload', 'Upload', '', 'Uploaden', 'Télécharger', 'Hochladen', 'Загрузить', 'Subir', 'Yükleme'),
(391, 'browse_to_upload', 'Browse to upload', 'تصفح للتحميل', '', 'Parcourir pour télécharger', 'Zum Hochladen navigieren', 'Просмотрите, чтобы загрузить', 'Navegar para subir', 'Yüklemek için göz atın'),
(392, 'replenish', 'Replenish', 'جدد', 'Bijvullen', 'Remplir', 'Auffüllen', 'Восполнение', 'Reponer', 'Yenileyici'),
(393, 'amount', 'Amount', '', 'Bedrag', 'Montant', 'Menge', 'Количество', 'Cantidad', 'Miktar'),
(394, 'confirmation', 'Confirmation', 'التأكيد', 'Bevestiging', 'Confirmation', 'Bestätigung', 'подтверждение', 'Confirmación', 'Onayla'),
(395, 'deleted', 'Deleted', 'تم الحذف', 'Verwijderd', 'Supprimé', 'Gelöscht', 'Исключен', 'Eliminado', 'silindi'),
(396, 'currency', 'Currency', 'عملة', 'Valuta', 'Devise', 'Währung', 'валюта', 'Moneda', 'Para birimi'),
(397, 'rent', 'Rent', '', '', 'Location', 'Miete', 'Арендная плата', 'Alquilar', 'Kira'),
(398, 'subscribe', 'Subscribe', '', 'Abonneren', 'Souscrire', 'Abonnieren', 'Подписывайся', 'Suscribir', 'Abone ol'),
(399, 'choose_payment_method', 'Choose Payment Method', 'اختر وسيلة الدفع', 'Kies betalingsmethode', 'Choisissez le mode de paiement', 'Zahlungsart auswählen', 'Выберите способ оплаты', 'Elige el método de pago', 'Ödeme yöntemini seçin'),
(400, 'error', 'Error', 'خطأ', 'Fout', 'Erreur', 'Error', 'ошибка', 'Error', 'Hata'),
(401, 'checkout_text', 'checkout text', 'نص الخروج', 'afreken tekst', 'texte de paiement', 'Checkout-Text', 'текст оформления заказа', 'texto de pago', 'ödeme metni'),
(402, 'address', 'address', 'عنوان', 'adres', '', 'Adresse', 'адрес', 'habla a', 'adres'),
(403, 'city', 'city', 'مدينة', 'stad', '', 'Stadt', 'город', 'ciudad', 'Kent'),
(404, 'state', 'state', 'حالة', 'staat', 'Etat', 'Zustand', 'штат', 'estado', 'durum'),
(405, 'zip', 'zip', '', 'zip', 'Zip *: français', 'Postleitzahl', 'застежка-молния', 'Código Postal', 'zip'),
(406, 'phone_number', 'Phone Number', 'رقم الهاتف', 'Telefoonnummer', 'Numéro de téléphone', 'Telefonnummer', 'Телефонный номер', 'Número de teléfono', 'Telefon numarası'),
(407, 'no', 'No', '', 'Nee', 'Non', 'Nein', 'нет', 'No', 'Hayır'),
(408, 'yes', 'Yes', 'نعم', 'Ja', 'Oui', 'Ja', 'да', 'si', 'Evet'),
(409, 'no_messages_were_found__please_choose_a_channel_to_chat.', 'No messages were found, please choose a user to chat.', 'لم يتم العثور على رسائل ، يرجى اختيار مستخدم للدردشة.', 'Er zijn geen berichten gevonden. Kies een gebruiker om te chatten.', 'Aucun message n\'a été trouvé, veuillez choisir un utilisateur pour discuter.', 'Es wurden keine Nachrichten gefunden. Bitte wählen Sie einen Benutzer zum Chatten aus.', 'Сообщения не найдены, выберите пользователя для чата.', 'No se encontraron mensajes, elija un usuario para chatear.', 'Mesaj bulunamadı, lütfen sohbet etmek için bir kullanıcı seçin.'),
(410, 'no_users_found', 'No users found', 'لم يتم العثور على مستخدمين', 'Geen gebruikers gevonden', '', 'Keine Benutzer gefunden', 'Пользователи не найдены', 'No se encontraron usuarios', 'Kullanıcı bulunamadı'),
(411, 'chat', 'Chat', 'دردشة', 'Chat', 'Bavarder', 'Plaudern', 'Чат', 'Charla', 'Sohbet'),
(412, 'load_more_messages', 'Load more messages', 'تحميل المزيد من الرسائل', 'Laad meer berichten', 'Charger plus de messages', 'Laden Sie weitere Nachrichten', 'Загрузить больше сообщений', 'Cargar más mensajes', 'Daha fazla mesaj yükle'),
(413, 'write_message', 'Write message', 'اكتب رسالة', 'Schrijf een bericht', 'Écrire un message', 'Nachricht schreiben', 'Напиши сообщение', 'Escribe un mensaje', 'Mesaj Yaz'),
(414, 'are_you_sure_you_want_delete_chat', 'Are you sure you want to delete this chat?', 'هل أنت متأكد أنك تريد حذف هذه الدردشة؟', 'Weet u zeker dat u deze chat wilt verwijderen?', 'Voulez-vous vraiment supprimer ce chat?', 'Möchten Sie diesen Chat wirklich löschen?', 'Вы уверены, что хотите удалить этот чат?', '¿Estás seguro de que deseas eliminar este chat?', 'Bu sohbeti silmek istediğinizden emin misiniz?'),
(415, 'no_messages_were_found__say_hi_', 'No messages were found, say Hi!', 'لم يتم العثور على رسائل ، قل مرحباً!', '', 'Aucun message n\'a été trouvé, dites Salut!', 'Es wurden keine Nachrichten gefunden, sagen Sie Hallo!', 'Сообщений не найдено. Передайте привет!', 'No se encontraron mensajes, di ¡Hola!', 'Mesaj bulunamadı, Merhaba deyin!'),
(416, 'please_check_the_details', 'Please check the details', 'يرجى التحقق من التفاصيل', 'Controleer de details', 'Veuillez vérifier les détails', 'Bitte überprüfen Sie die Details', 'Пожалуйста, проверьте детали', 'Por favor revise los detalles', 'Lütfen ayrıntıları kontrol edin'),
(417, 'confirming_your_payment__please_wait..', 'Confirming your payment, please wait..', 'لتأكيد الدفع ، يرجى الانتظار ..', 'Uw betaling wordt bevestigd, even geduld ...', 'Confirmation de votre paiement, veuillez patienter.', 'Bestätigen Sie Ihre Zahlung, bitte warten Sie ..', 'Подтверждение платежа, подождите ..', 'Confirmando su pago, espere ...', 'Ödemenizi onaylıyoruz, lütfen bekleyin ..'),
(418, 'payment_declined__please_try_again_later.', 'Payment declined, please try again later.', 'تم رفض الدفع ، يرجى المحاولة مرة أخرى في وقت لاحق.', 'Betaling geweigerd. Probeer het later opnieuw.', 'Paiement refusé, veuillez réessayer plus tard.', 'Zahlung abgelehnt, bitte versuchen Sie es später erneut.', 'Платеж отклонен, повторите попытку позже.', 'Pago rechazado. Vuelva a intentarlo más tarde.', 'Ödeme reddedildi, lütfen daha sonra tekrar deneyin.'),
(419, 'verification', 'Verification', 'التحقق', 'Verificatie', 'Vérification', 'Überprüfung', 'верификация', 'Verificación', 'Doğrulama'),
(420, 'upload_id', 'Upload ID', '', 'Upload-ID', '', 'ID hochladen', 'ID загрузки', 'Cargar ID', 'ID yükle'),
(421, 'select_id', 'Select ID', 'حدد معرف', 'Selecteer ID', 'Sélectionnez ID', 'ID auswählen', 'Выберите ID', 'Seleccionar ID', 'Kimlik seçin'),
(422, 'message', 'Message', 'رسالة', 'Bericht', 'Message', 'Botschaft', 'Сообщение', 'Mensaje', 'İleti'),
(423, 'submit_request', 'Submit Request', 'تقديم الطلب', 'Aanvraag indienen', 'Envoyer la demande', 'Anfrage einreichen', 'Отправить запрос', 'Enviar peticion', 'İstek gönderin'),
(424, 'file_is_too_big', 'The file is too big, please try another one.', 'الملف كبير جدًا ، يرجى تجربة ملف آخر.', 'Het bestand is te groot, probeer een ander bestand.', 'Le fichier est trop volumineux, veuillez en essayer un autre.', 'Die Datei ist zu groß, bitte versuchen Sie es mit einer anderen.', 'Файл слишком большой, попробуйте другой.', 'El archivo es demasiado grande, pruebe con otro.', 'Dosya çok büyük, lütfen başka bir tane deneyin.'),
(425, 'u_are_verified', 'you are now verified.', 'تم التحقق منك الآن.', 'je bent nu geverifieerd.', 'vous êtes maintenant vérifié.', 'Sie sind jetzt verifiziert.', 'теперь вы проверены.', 'ahora está verificado.', 'şimdi doğrulandınız.'),
(426, 'verif_request_received', 'Verification request received.', '', 'Verificatieverzoek ontvangen.', 'Demande de vérification reçue.', 'Bestätigungsanfrage erhalten.', 'Запрос на подтверждение получен.', 'Se recibió la solicitud de verificación.', 'Doğrulama talebi alındı.'),
(427, 'inactive', 'inactive', 'غير نشط', 'inactief', '', 'inaktiv', 'неактивный', 'inactivo', 'pasif'),
(428, 'pro_mbr', 'Pro Member', 'عضو محترف', 'Pro-lid', '', 'Pro Mitglied', 'Член профи', 'Miembro Pro', 'Pro Üye'),
(429, 'free_mbr', 'Free Member', 'عضو مجاني', '', 'Membre gratuit', 'Freies Mitglied', 'Бесплатный член', 'miembro gratuito', 'Ücretsiz Üye'),
(430, 'type', 'Type', 'نوع', '', 'Type', 'Art', 'Тип', 'Tipo', 'tip'),
(431, 'user', 'User', '', 'Gebruiker', 'Utilisateur', 'Benutzer', 'пользователь', 'Usuario', 'kullanıcı'),
(432, 'admin', 'Admin', 'مشرف', 'beheerder', 'Administrateur', 'Administrator', 'Администратор', 'Administración', 'yönetim'),
(433, 'verified', 'Verified', 'تم التحقق', 'Geverifieerd', 'Vérifié', 'Verifiziert', 'Проверенный', 'Verificado', 'Doğrulanmış'),
(434, 'not_verified', 'Not verified', 'لم يتم التحقق منها', 'niet geverifieerd', 'non vérifié', 'Nicht verifiziert', 'не подтверждено', 'No verificado', 'Doğrulanmadı'),
(435, 'user_upload_limit', 'User Upload Limit', 'حد تحميل المستخدم', 'Limiet gebruikersupload', 'Limite de téléchargement utilisateur', 'Benutzer-Upload-Limit', 'Лимит загрузки пользователей', 'Límite de carga del usuario', 'Kullanıcı Yükleme Sınırı'),
(436, 'check_out_text', 'Check Out Text', 'سحب النص', 'Bekijk tekst', 'Extraire le texte', 'Text auschecken', 'Проверить текст', 'Ver texto', 'Metni Kontrol Et'),
(437, 'chose_payment_method', 'Chose Payment Method', 'اختر وسيلة الدفع', 'Kies betalingsmethode', 'Choisissez le mode de paiement', 'Zahlungsart auswählen', 'Выберите способ оплаты', 'Elige el método de pago', 'Ödeme yöntemini seçin'),
(438, 'are_you_sure_you_want_to_delete_the_chat', 'Are you sure you want to delete this chat?', 'هل أنت متأكد أنك تريد حذف هذه الدردشة؟', 'Weet u zeker dat u deze chat wilt verwijderen?', 'Voulez-vous vraiment supprimer ce chat?', 'Möchten Sie diesen Chat wirklich löschen?', 'Вы уверены, что хотите удалить этот чат?', '¿Estás seguro de que deseas eliminar este chat?', 'Bu sohbeti silmek istediğinizden emin misiniz?'),
(439, 'verif_sent', 'Your verification request has been sent.', 'تم إرسال طلب التحقق الخاص بك.', 'Uw verificatieverzoek is verzonden.', 'Votre demande de vérification a été envoyée.', 'Ihre Bestätigungsanfrage wurde gesendet.', 'Ваш запрос на подтверждение отправлен.', 'Su solicitud de verificación ha sido enviada.', 'Doğrulama talebiniz gönderildi.'),
(440, 'upload_your_id', 'Upload Your ID', 'قم بتحميل المعرف الخاص بك', 'Upload uw ID', 'Téléchargez votre identifiant', 'Laden Sie Ihre ID hoch', 'Загрузите свой идентификатор', 'Cargue su ID', 'Kimliğinizi Yükleyin'),
(441, 'select_file', 'Select File', 'حدد ملف', 'Selecteer bestand', 'Choisir le dossier', 'Datei aussuchen', 'Выбрать файл', 'Seleccione Archivo', 'Dosya Seç'),
(442, 'submit_your_request', 'Submit Your Request', 'أرسل طلبك', 'Dien uw verzoek in', 'Soumettez votre demande', 'Senden Sie Ihre Anfrage', 'Отправьте свой запрос', 'Envíe su solicitud', 'Talebinizi Gönderin'),
(443, 'verification_request_is_still_pending', 'Your Verification Request Is Still Pending', 'طلب التحقق الخاص بك لا يزال معلقًا', 'Uw verificatieverzoek is nog in behandeling', 'Votre demande de vérification est toujours en attente', 'Ihre Bestätigungsanfrage steht noch aus', 'Ваш запрос на подтверждение еще не принят', 'Su solicitud de verificación aún está pendiente', 'Doğrulama İsteğiniz Hala Beklemede'),
(444, 'bank_payment_request_sent', 'Your bank payment request has been sent.', 'تم إرسال طلب الدفع المصرفي الخاص بك.', 'Uw betalingsverzoek is verzonden.', 'Votre demande de paiement bancaire a été envoyée.', 'Ihre Bankzahlungsanforderung wurde gesendet.', 'Ваш запрос на банковский платеж отправлен.', 'Su solicitud de pago bancaria ha sido enviada.', 'Banka ödeme talebiniz gönderildi.'),
(445, 'select_your_id', 'Select Your ID', 'حدد المعرف الخاص بك', 'Selecteer uw ID', 'Sélectionnez votre identifiant', 'Wählen Sie Ihre ID', 'Выберите свой ID', 'Seleccione su ID', 'Kimliğinizi Seçin'),
(446, 'two-factor_authentication', 'Two-factor authentication', '', 'Twee-factor-authenticatie', 'Authentification à deux facteurs', 'Zwei-Faktor-Authentifizierung', 'Двухфакторная аутентификация', 'Autenticación de dos factores', 'İki faktörlü kimlik doğrulama'),
(447, 'phone', 'Phone', 'هاتف', 'Telefoon', 'Téléphone', 'Telefon', 'Телефон', 'Teléfono', 'Telefon'),
(448, 'enable', 'Enable', 'ممكن', 'Inschakelen', 'Activer', 'Aktivieren', 'включить', 'Habilitar', 'etkinleştirme'),
(449, 'disable', 'Disable', 'تعطيل', '', '', 'Deaktivieren', 'Отключить', 'Inhabilitar', 'Devre Dışı'),
(450, 'phone_number_should_be_as_this_format___90..', 'Phone number should be as this format: +90..', '', 'Telefoonnummer moet de volgende notatie hebben: +90 ..', 'Le numéro de téléphone doit être au format suivant: +90 ..', 'Die Telefonnummer sollte das folgende Format haben: +90 ..', 'Номер телефона должен быть в следующем формате: +90 ..', 'El número de teléfono debe tener este formato: +90 ..', 'Telefon numarası şu biçimde olmalıdır: +90 ..'),
(451, 'settings_successfully_updated_', 'Settings successfully updated!', 'تم تحديث الإعدادات بنجاح!', '', '', 'Einstellungen erfolgreich aktualisiert!', 'Настройки успешно обновлены!', '¡Configuración actualizada correctamente!', 'Ayarlar başarıyla güncellendi!'),
(452, 'please_check_your_details.', 'Please check your details.', 'الرجاء مراجعة التفاصيل الخاصة بك.', 'Check alsjeblieft je gegevens.', 'S\'il vous plaît vérifier vos informations.', 'Bitte überprüfe deine Details.', 'Пожалуйста, проверьте свои данные.', 'Por favor comprueba tus detalles.', 'Lütfen bilgilerinizi kontrol edin.'),
(453, 'something_went_wrong__please_try_again_later.', 'Something went wrong, please try again later.', '', 'Er is iets misgegaan, probeer het later opnieuw.', '', 'Es ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.', 'Что-то пошло не так. Пожалуйста, повторите попытку позже.', 'Se produjo un error. Vuelve a intentarlo más tarde.', 'Bir şeyler yanlış oldu. Lütfen sonra tekrar deneyiniz.'),
(454, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'We have sent you an email with the confirmation code.', 'لقد أرسلنا لك بريدًا إلكترونيًا يحتوي على رمز التأكيد.', 'We hebben je een e-mail gestuurd met de bevestigingscode.', 'Nous vous avons envoyé un email avec le code de confirmation.', 'Wir haben Ihnen eine E-Mail mit dem Bestätigungscode gesendet.', 'Мы отправили вам электронное письмо с кодом подтверждения.', 'Le hemos enviado un correo electrónico con el código de confirmación.', 'Size onay kodunu içeren bir e-posta gönderdik.'),
(455, 'a_confirmation_message_was_sent.', 'A confirmation message was sent.', 'تم إرسال رسالة تأكيد.', 'Er is een bevestigingsbericht verzonden.', '', 'Eine Bestätigungsnachricht wurde gesendet.', 'Было отправлено подтверждающее сообщение.', 'Se envió un mensaje de confirmación.', 'Bir onay mesajı gönderildi.'),
(456, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We have sent a message that contains the confirmation code to enable Two-factor authentication.', 'لقد أرسلنا رسالة تحتوي على رمز التأكيد لتمكين المصادقة الثنائية.', 'We hebben een bericht gestuurd met de bevestigingscode om tweefactorauthenticatie mogelijk te maken.', 'Nous avons envoyé un message contenant le code de confirmation pour activer l\'authentification à deux facteurs.', 'Wir haben eine Nachricht gesendet, die den Bestätigungscode enthält, um die Zwei-Faktor-Authentifizierung zu aktivieren.', 'Мы отправили сообщение, содержащее код подтверждения для включения двухфакторной аутентификации.', 'Hemos enviado un mensaje que contiene el código de confirmación para habilitar la autenticación de dos factores.', 'İki faktörlü kimlik doğrulamayı etkinleştirmek için onay kodunu içeren bir mesaj gönderdik.'),
(457, 'confirmation_code', 'Confirmation code', 'تأكيد الكود', 'Bevestigingscode', 'Code de confirmation', 'Bestätigungscode', 'Код подтверждения', 'Código de confirmación', 'Onay kodu'),
(458, 'your_phone_number_has_been_successfully_verified.', 'Your phone number has been successfully verified.', 'تم التحقق من رقم هاتفك بنجاح.', 'Uw telefoonnummer is succesvol geverifieerd.', 'Votre numéro de téléphone a été vérifié avec succès.', 'Ihre Telefonnummer wurde erfolgreich überprüft.', 'Ваш номер телефона успешно подтвержден.', 'Su número de teléfono se ha verificado correctamente.', 'Telefon numaranız başarıyla doğrulandı.'),
(459, 'card_charged', 'Thank you, Your payment was successful.', 'شكرا لك ، دفعتك كانت ناجحة.', 'Bedankt. Uw betaling is gelukt.', 'Merci, votre paiement a été effectué avec succès.', 'Vielen Dank, Ihre Zahlung war erfolgreich.', 'Спасибо, ваш платеж прошел успешно.', 'Gracias, su pago se realizó correctamente.', 'Teşekkürler, ödemeniz başarılı oldu.'),
(460, 'custom_thumbnail', 'Custom Thumbnail', 'صورة مصغرة مخصصة', 'Aangepaste miniatuur', 'Miniature personnalisée', 'Benutzerdefinierte Miniaturansicht', 'Пользовательский эскиз', 'Miniatura personalizada', 'Özel Küçük Resim'),
(461, 'payment_declined', 'Payment declined', 'تم رفض الدفع', 'Betaling geweigerd', 'Paiement refusé', 'Zahlung abgelehnt', 'Платеж отклонен', 'Pago rechazado', 'Ödeme Reddedildi'),
(462, 'payment', 'Payment', 'دفع', 'Betaling', 'Paiement', 'Zahlung', 'Оплата', 'Pago', 'Ödeme'),
(463, 'payment_verification', 'Payment Verification', 'التحقق من الدفع', 'Betalingsverificatie', 'Vérification des paiements', 'Zahlungsüberprüfung', 'Подтверждение платежа', 'Verificación de pago', 'Ödeme Doğrulaması'),
(464, 'wallet_payment_recharge', 'Wallet Payment Recharge', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(465, 'file_exceeds_upload_limit', 'File Exceeds Upload Limit', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(466, 'a_confirmation_email_has_been_sent.', 'A confirmation email has been sent.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(467, 'we_have_sent_an_email_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We have sent an email that contains the confirmation code to enable Two-factor authentication.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(468, 'please_wait..', 'Please wait..', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(469, 'weekly_top_events', 'Weekly Top Events', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(470, 'login_to_view_more', 'login to View more', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(471, 'top_weekly__events', 'Top Weekly  Events', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(472, 'are_you_bored', 'Are you Bored', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(473, 'check_out_the_events_on', 'Check out the Events on', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(474, 'hap_yard__the_world_s_biggest_event_website', 'Hap yard, the World&#039;s Biggest Event Website', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(475, 'events_attended', 'EVENTS ATTENDED', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(476, 'personal', 'Personal', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(477, 'sports', 'Sports', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(478, 'presention', 'Presention', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(479, 'partnered_with', 'Partnered With', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(480, 'online', 'Online', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(481, 'account_recharge', 'Account Recharge', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(482, 'choose_a_payment_method.', 'Choose a payment method.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(483, 'upload_receipt', 'Upload Receipt', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(484, 'confirm', 'Confirm', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(485, 'redirecting..', 'Redirecting..', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(486, 'oops__an_error_found.', 'Oops, an error found.', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `langs` (`id`, `lang_key`, `english`, `arabic`, `dutch`, `french`, `german`, `russian`, `spanish`, `turkish`) VALUES
(487, 'year', 'year', 'عام', 'jaar', 'année', 'Jahr', 'год', 'año', 'yıl'),
(488, 'month', 'month', 'شهر', 'maand', 'mois', 'Monat', 'месяц', 'mes', 'ay'),
(489, 'day', 'day', 'يوم', 'dag', 'journée', 'Tag', 'день', 'día', 'gün'),
(490, 'hour', 'hour', 'ساعة', 'uur', 'heure', 'Stunde', 'час', 'hora', 'saat'),
(491, 'minute', 'minute', 'اللحظة', 'minuut', 'minute', 'Minute', 'минут', 'minuto', 'dakika'),
(492, 'second', 'second', 'ثانيا', 'tweede', 'seconde', 'zweite', 'второй', 'segundo', 'ikinci'),
(493, 'years', 'years', 'سنوات', 'jaar', 'années', 'Jahre', 'лет', 'años', 'yıl'),
(494, 'months', 'months', 'الشهور', 'maanden', 'mois', 'Monate', 'месяцы', 'meses', 'ay'),
(495, 'days', 'days', 'أيام', 'dagen', 'journées', 'Tage', 'дней', 'dias', 'günler'),
(496, 'hours', 'hours', 'ساعات', 'uur', 'heures', 'Std', 'часов', 'horas', 'saatler'),
(497, 'minutes', 'minutes', 'الدقائق', 'notulen', 'minutes', 'Protokoll', 'минут', 'minutos', 'dakika'),
(498, 'seconds', 'seconds', 'ثواني', 'seconden', 'secondes', 'Sekunden', 'секунд', 'segundos', 'saniye'),
(499, 'time_ago', 'ago', 'منذ', 'geleden', 'depuis', 'vor', 'тому назад', 'hace', 'önce'),
(500, 'duration', 'Duration', NULL, NULL, NULL, NULL, NULL, NULL, 'Süre'),
(501, 'language', 'Language', NULL, NULL, NULL, NULL, NULL, NULL, 'Dil'),
(502, 'fees', 'Fees', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(503, 'discount', 'Discount', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(504, 'add_to_application_list', 'Add to Application List', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(505, 'apply_now', 'Apply Now', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(506, 'details', 'Details', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(507, 'lesson_saved', 'Lesson Saved', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(508, 'you_have_already_saved_this_job', 'You Have Already Saved This Job', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(509, 'foundation', 'Foundation', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(510, 'international_students', 'International Students', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(511, 'total_programs', 'Total Programs', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(512, 'degree', 'Degree', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(513, 'fee', 'Fee', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(514, 'discounted_fee', 'Discounted fee', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(515, 'annual_fee', 'Annual fee', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(516, 'our_fee', 'Our fee', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(517, 'program_details', 'Program Details', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(518, 'apply', 'Apply', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(519, 'langauge', 'Langauge', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(520, 'requirements', 'Requirements', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(521, 'despline', 'Despline', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(522, 'program_overview', 'Program Overview', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(523, 'university', 'University', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(524, 'department', 'Department', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(525, 'tuition_fees', 'Tuition Fees', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(526, 'discipline', 'Discipline', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(527, 'library', 'Library', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(528, 'wifi', 'Wifi', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(529, 'gym', 'Gym', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(530, 'cafeteria', 'Cafeteria', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(531, 'hairdresser', 'Hairdresser', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(532, 'atm', 'Atm', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(533, 'car_park', 'Car Park', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(534, 'bank', 'bank', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(535, 'security', 'Security', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(536, 'virtual_court', 'Virtual Court', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(537, 'walking_track', 'Walking Track', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(538, 'barrier_free_campus', 'Barrier Free Campus', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(539, 'dining_hall', 'Dining Hall', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(540, 'auditorium', 'Auditorium', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(541, 'medical_center_first_aid', 'Medical Center First Aid', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(542, 'tennis_court', 'Tennis Court', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(543, 'associate_degree', 'Associate Degree', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(544, 'undergraudate_program', 'Undergraudate Program', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(545, 'graudate_program', 'Graudate Program', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(546, 'phd_program', 'Phd Program', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(547, 'yes', 'Yes', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(548, 'accomodation', 'Accomodation', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(549, 'domitory', 'Domitory', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(550, 'female_domitory', 'Female Domitory', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(551, 'male_domitory', 'Male Domitory', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(552, 'university_overview', 'University Overview', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(553, 'university_type', 'University type', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(554, 'foundation_year', 'Foundation Year', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(555, 'languages', 'Languages', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(556, 'education', 'Education', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(557, 'sports_facilities', 'Sports Facilities', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(558, 'student_associations', 'Student Associations', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(559, 'laboratories', 'Laboratories', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(560, 'study_mode', 'Study Mode', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(561, 'total_students', 'Total Students', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(562, 'you_are_applying_to', 'You Are Applying To', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(563, 'in', 'In', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(564, 'log_in', 'Log In', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(565, 'dont_have_an_account', 'Dont have an account', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(566, 'register_here', 'Register here', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(567, 'log_in_here', 'Log in here', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(568, 'overview', 'Overview', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(569, 'buy', 'Buy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(570, 'redeem', 'Redeem', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(571, 'father_names', 'Father Names', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(572, 'mother_name', 'Mother Name', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(573, 'upload_your_documents', 'Upload your Documents', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(574, 'diploma', 'Diploma', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(575, 'transcript', 'Transcript', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(576, 'passport', 'Passport', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(577, 'photo', 'Photo', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(578, 'your_application_was_submited', 'Your application was submited', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(579, 'submit', 'Submit', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(580, 'back_to_site', 'back to site', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(581, 'university_added', 'University Added', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(582, 'someone_saved_an_application', 'Someone saved an application', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(583, 'someone_saved_your_profile', 'Someone saved your profile', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(584, 'you_changed_your_account_password', 'You changed your account password', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(585, 'applicant_saved', 'Applicant Saved', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(586, 'visit_profile', 'Someone visited your profile', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(587, 'you_saved_an_applicant', 'You saved an applicant', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(588, 'someone_saved_your_profile', 'You saved someone\'s profile ', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(589, 'new_university_applicant', 'New University Application\r\n', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(590, 'dashboard', 'Dashboard', NULL, NULL, NULL, NULL, NULL, NULL, 'Kullanıcı Paneli'),
(591, 'logout', 'Logout', NULL, NULL, NULL, NULL, NULL, NULL, 'Çıkış Yap'),
(592, 'program', 'Program', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(593, 'application', 'Application', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(594, 'see_programs', 'See Programs', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(595, 'programs_at', 'Programs At', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(596, 'this_university_has_no_active_programs', 'This university has no active programs', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(597, 'disciplines', 'Disciplines', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(598, 'medicine_and_health', 'Medicine And Health', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(599, 'engineering', 'Engineering', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(600, 'great', 'Great', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(601, 'we_ll_help_you_apply_for_your_chosen_program', 'we&#039;ll help you apply for your chosen program', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(602, 'information', 'Information', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(603, 'documents', 'Documents', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(604, 'names', 'Names', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(605, 'fathers_name', 'Fathers Name', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(606, 'mothers_name', 'Mothers Name', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(607, 'date_of_birth', 'Date of Birth', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(608, 'optional', 'optional', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(609, 'passport_number', 'Passport Number', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(610, 'nationality', 'Nationality', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(611, 'country_of_residence', 'Country of Residence', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(612, 'previous', 'Previous', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(613, 'are_you_sure_you_want_to_submit', 'Are you sure you want to submit', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(614, 'click_to_upload', 'Click to upload', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(615, 'add_missing_documents', 'Add Missing Documents', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(616, 'check_status', 'Check Status', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(617, 'application_status_update', 'Application Status Update', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(618, 'request_changes', 'Request Changes', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(619, 'document_missing', 'Document Missing', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(620, 'awaiting_review', 'Awaiting Review', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(621, 'awaiting_approval', 'Awaiting Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(622, 'diploma_missing', 'Diploma Missing', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(623, 'transcript_missing', 'Transcript Missing', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(624, 'passport_missing', 'Passport Missing', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(625, 'stamp_missing_on_transcript', 'Stamp Missing On Transcript', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(626, 'stamp_missing_on_diploma', 'Stamp Missing On Diploma', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(627, 'translation_of_transcript_missing', 'Translation Of Transcript Missing', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(628, 'translation_of_highschool_diploma_missing', 'Translation of High School Diploma missing', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(629, 'accepted_click_to_download_your_accpetance_letter', 'Congrations, click to download your acceptance letter', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(630, 'surname', 'Surname', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(631, 'firstname', 'Firstname', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(632, 'lastname', 'Lastname', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(633, 'applied', 'Applied', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(634, 'rejected', 'Rejected', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(635, 'university_logo', 'University Logo', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(636, 'congratulations_you_have_been_accepted_at', 'Congratulations you have been accepted at', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(637, 'you_can_download_your_acceptance_letter', 'You can download your acceptance letter', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(638, 'here', 'here', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(639, 'status_email_successifully_sent', 'Status email successfully sent', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(640, 'enter_our_email_or_reference_id', 'Enter our email or Reference ID', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(641, 'language_certificate', 'Language Certificate', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(642, 'reference_id', 'Reference ID', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(643, 'forgot_reference_id', 'Forgot Reference id', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(644, 'enter_email', 'Enter Email', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(645, 'send_confirmation', 'Send Confirmation', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(646, 'add_note', 'Add Note', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(647, 'note_sent', 'Note Submitted', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(648, 'edit_application', 'edit application', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(649, 'enter_national_id_or_passport_no', 'Enter National ID or Passport No', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(650, 'send_note', 'Send note', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(651, 'admin_notes', 'Admin Notes', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(652, 'update_program', 'Update Program', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(653, 'certificate', 'Certificate', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(654, 'application_id', 'Application ID', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(655, '....', '....', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(656, 'none', 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(657, 'approved', 'Approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(658, 'requested', 'Requested', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(659, 'queued', 'Queued', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(660, 'accepted', 'Accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(661, 'rejected', 'Rejected', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(662, 'happy_end', 'Happy End', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(663, 'account_types', 'ACcount Types', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(664, 'agent', 'Agent', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(665, 'applicant', 'Applicant', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(666, 'comfirm_password', 'Comfirm Password', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(667, 'menu', 'Menu', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(668, 'my_applications', 'My Applications', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(669, 'my_profile', 'My Profile', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(670, 'applications', 'Applications', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(671, 'account_type', 'Account Type', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(672, 'save_changes', 'Save Changes', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(673, 'phone_number_1', 'Phone Number 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(674, 'phone_number_2', 'Phone Number 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(675, 'id_photo', 'ID Photo', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(676, 'old_password', 'Old Password', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(677, 'edit_request_will_be_sent.', 'Edit request will be sent.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(678, 'wait_for_admin_approval_before_you_edit_your_application.', 'Wait for Admin approval before you edit your application.', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(679, 'your_account_agent_account_registration_has_been_approved', 'Your account Agent Account registration has been approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(680, 'you_now_have_access_right_to_the_agent_account', 'You now have access right to the Agent account', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(681, 'login_to_the_platform', 'Login to the Platform', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(682, 'account_registration_approval', 'Account Registration Approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(683, 'manage_students', 'Manage Students', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(684, 'add_to_cart', 'Add to Cart', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(685, 'international', 'International', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(686, 'students', 'Students', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(687, 'total', 'Total', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(688, 'programs', 'Programs', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(689, 'program_details_page', 'Program details page', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(690, 'your_account_await_approval', 'Registration successful, Your Account is Awaiting Approval. This process might take a few hours or days, Kindly keep track of your email inbox for the approval email', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(691, 'your_account_account_has_be_successfully_created_by', 'Your account Account has be successfully created by', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(692, 'team', 'Team', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(693, 'you_now_have_access_to_the_system', 'You now have access to the system', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(694, 'here_are_your_login_credentials', 'Here are your login credentials', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(695, 'university_details', 'University Details', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `question_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `question_id`) VALUES
(1, 2, 11),
(2, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notifier_id` int(11) NOT NULL DEFAULT '0',
  `recipient_id` int(11) NOT NULL DEFAULT '0',
  `application_id` int(11) NOT NULL DEFAULT '0',
  `replay_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT '',
  `text` text,
  `url` varchar(3000) NOT NULL DEFAULT '',
  `seen` varchar(50) NOT NULL DEFAULT '0',
  `time` varchar(50) NOT NULL DEFAULT '0',
  `sent_push` int(11) NOT NULL DEFAULT '0',
  `target` varchar(11) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notifier_id`, `recipient_id`, `application_id`, `replay_id`, `type`, `text`, `url`, `seen`, `time`, `sent_push`, `target`, `admin`) VALUES
(1, 10, 0, 0, 0, 'new_application', ' Applied at <b>Altinbas University</b> inCIVIL ENGINEERING (ENGLISH)</b>', '/admin-cp/view-application?id=8445', '0', '1647481012', 0, 'all', 0),
(2, 10, 0, 0, 0, 'new_application', ' Applied at <b>Altinbas University</b> inCIVIL ENGINEERING (ENGLISH)</b>', '/admin-cp/view-application?id=3603', '0', '1647483283', 0, 'all', 0),
(3, 10, 0, 0, 0, 'new_application', ' Applied at <b>Altinbas University</b> inCHILD DEVELOPMENT</b>', '/admin-cp/view-application?id=8534', '0', '1647483408', 0, 'all', 0),
(4, 20, 0, 0, 0, 'new_application', ' Applied at <b>Altinbas University</b> inENGLISH TEACHING (ENGLISH)</b>', '/admin-cp/view-application?id=0071', '0', '1648325390', 0, 'all', 0),
(5, 20, 0, 0, 0, 'new_application', ' Applied at <b>Acibadem University</b> inBANKING AND INSURANCE</b>', '/admin-cp/view-application?id=7947', '0', '1648325657', 0, 'all', 0),
(6, 20, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inuniversity not found</b>', '/admin-cp/view-application?id=', '0', '1648325717', 0, 'all', 0),
(7, 20, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inuniversity not found</b>', '/admin-cp/view-application?id=', '0', '1648330474', 0, 'all', 0),
(8, 20, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inuniversity not found</b>', '/admin-cp/view-application?id=', '0', '1648330476', 0, 'all', 0),
(9, 20, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inINTERNATIONAL TRADE AND FINANCE (ENGLISH)</b>', '/admin-cp/view-application?id=7819', '0', '1648346302', 0, 'all', 0),
(10, 20, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inINTERNATIONAL TRADE AND FINANCE (ENGLISH)</b>', '/admin-cp/view-application?id=5415', '0', '1648346662', 0, 'all', 0),
(11, 10, 0, 0, 0, 'new_application', ' Applied at <b>Acibadem University</b> inAUDIOLOGY</b>', '/admin-cp/view-application?id=4621', '0', '1648350133', 0, 'all', 0),
(12, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=0520', '0', '1648350199', 0, 'all', 0),
(13, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=0860', '0', '1648350208', 0, 'all', 0),
(14, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=4918', '0', '1648350210', 0, 'all', 0),
(15, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=0145', '0', '1648350212', 0, 'all', 0),
(16, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=9304', '0', '1648350214', 0, 'all', 0),
(17, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=6850', '0', '1648350219', 0, 'all', 0),
(18, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=0290', '0', '1648350221', 0, 'all', 0),
(19, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=8341', '0', '1648350223', 0, 'all', 0),
(20, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=6609', '0', '1648350230', 0, 'all', 0),
(21, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=2064', '0', '1648350232', 0, 'all', 0),
(22, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=5192', '0', '1648350234', 0, 'all', 0),
(23, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=0059', '0', '1648350236', 0, 'all', 0),
(24, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=7400', '0', '1648350238', 0, 'all', 0),
(25, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=5009', '0', '1648350242', 0, 'all', 0),
(26, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=9100', '0', '1648350244', 0, 'all', 0),
(27, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=2248', '0', '1648350246', 0, 'all', 0),
(28, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=6087', '0', '1648350402', 0, 'all', 0),
(29, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inJOURNALISM</b>', '/admin-cp/view-application?id=8796', '0', '1648350510', 0, 'all', 0),
(30, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inuniversity not found</b>', '/admin-cp/view-application?id=', '0', '1648350594', 0, 'all', 0),
(31, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inMEDIA AND VISUAL ARTS</b>', '/admin-cp/view-application?id=1776', '0', '1648350626', 0, 'all', 0),
(32, 10, 0, 0, 0, 'new_application', ' Applied at <b>Altinbas University</b> inCIVIL ENGINEERING</b>', '/admin-cp/view-application?id=0780', '0', '1648593119', 0, 'all', 0),
(33, 10, 0, 0, 0, 'new_application', ' Applied at <b>Acibadem University</b> inAVIATION MANAGEMENT</b>', '/admin-cp/view-application?id=2430', '0', '1648593345', 0, 'all', 0),
(34, 10, 0, 0, 0, 'new_application', ' Applied at <b>Altinbas University</b> inCHILD DEVELOPMENT</b>', '/admin-cp/view-application?id=4264', '0', '1648593799', 0, 'all', 0),
(35, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inHUMAN RESOURCES MANAGEMENT</b>', '/admin-cp/view-application?id=4429', '0', '1648593942', 0, 'all', 0),
(36, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inNURSING (ENGLISH)</b>', '/admin-cp/view-application?id=3981', '0', '1648593960', 0, 'all', 0),
(37, 10, 0, 0, 0, 'new_application', ' Applied at <b>Acibadem University</b> inARCHITECTURE (ENGLISH)</b>', '/admin-cp/view-application?id=4412', '0', '1648594149', 0, 'all', 0),
(38, 10, 0, 0, 0, 'new_application', ' Applied at <b>Acibadem University</b> inARCHITECTURE (ENGLISH)</b>', '/admin-cp/view-application?id=4544', '0', '1648594151', 0, 'all', 0),
(39, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inLAW</b>', '/admin-cp/view-application?id=9560', '0', '1648594166', 0, 'all', 0),
(40, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inNURSING (ENGLISH)</b>', '/admin-cp/view-application?id=5244', '0', '1648594195', 0, 'all', 0),
(41, 20, 0, 0, 0, 'new_application', ' Applied at <b>Acibadem University</b> inBUSINESS ADMINISTRATION</b>', '/admin-cp/view-application?id=4737', '0', '1648597958', 0, 'all', 0),
(42, 10, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inINTERNATIONAL LOGISTICS MANAGEMENT(ENGLISH)</b>', '/admin-cp/view-application?id=3936', '0', '1648673315', 0, 'all', 0),
(43, 20, 0, 0, 0, 'new_application', ' Applied at <b>Altinbas University</b> inCIVIL ENGINEERING</b>', '/admin-cp/view-application?id=8984', '0', '1648769880', 0, 'all', 0),
(44, 20, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inuniversity not found</b>', '/admin-cp/view-application?id=8633', '0', '1648798654', 0, 'all', 0),
(45, 20, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inuniversity not found</b>', '/admin-cp/view-application?id=3190', '0', '1648798756', 0, 'all', 0),
(46, 20, 0, 0, 0, 'new_application', ' Applied at <b>university not found</b> inuniversity not found</b>', '/admin-cp/view-application?id=0083', '0', '1648798886', 0, 'all', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `type` varchar(15) NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pro_plan` varchar(100) DEFAULT '',
  `info` varchar(100) DEFAULT '0',
  `via` varchar(100) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `type`, `date`, `pro_plan`, `info`, `via`) VALUES
(1, 2, 34, 'replenish', '2021-03-01 11:07:44', '', '0', ''),
(2, 2, 45, 'replenish', '2021-03-01 11:08:26', '', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `text` text,
  `seen` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `platform` varchar(30) NOT NULL DEFAULT 'web',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session_id`, `user_id`, `platform`, `time`) VALUES
(12, 'e930231b6943fe0f9450f847e8736b378013697b15976443174916037dfb97da3b788e4560d5c4c6bf', 4, 'web', 1597644317),
(16, '4daf42d269393fcf8f8fb4e7c7b28e3f25033e821597690169522c74687f6897f2c6c69634c80ab142', 7, 'web', 1597690169),
(18, '258c4166c79f4383075d5dc08ded0c1424fec6891597690495970cd1dcff64a685fef9f105ac67de6d', 4, 'web', 1597690495),
(19, 'aa0e75c22bed8229583bf6329e305d1f01e7fd841597991614100e51538e5c6fb97d0e5adc4a7a1cd3', 4, 'web', 1597991614),
(20, '51733bef65c56b980bce2e082e1d5a250e48aeba15980163561e50dc2887431824a984bef4e915ada1', 4, 'web', 1598016356),
(21, 'b48bb2ffd8c0d2222fe63e29e328a82bd8928d85159824894963af83fef5ea32f2bf2f023032594391', 4, 'web', 1598248949),
(22, 'deb915ce8d1208d1fa486ad7089a8f510a42de4b159871283626c62d8411b5117d44a56d0d03aa02cd', 4, 'web', 1598712836),
(27, 'bd642e5c4378564ab0b0e59f73a394f4773dd9c41599547019d604af1e429b4bc4c8e22eed59aa6b4e', 2, 'web', 1599547019),
(28, '638cfca9071766e21a61cf3e28c77688d7ba08d5159957615654d40b17adacc21bcff3b9fb6d27a979', 2, 'mobile', 1599576156),
(29, 'f02ef1cd71ea5256dc52bda9a2bfcce2b1d3802415999774371297b2c9d96d4e4acf62d570776f84b9', 2, 'web', 1599977437),
(31, '7e1e8d27aae6ff3b3d488c83fbacdf7671c49f9a160023856454928f151d50a3c3eaa4cdb00d65a7c2', 17, 'web', 1600238564),
(32, '92b6f541bd3c4e9eb39591396ae2b585f887bb2a1601631830c8ebde6cc09d65164ab2d5c4a1ac5e3d', 2, 'web', 1601631830),
(35, 'ce414cdc0fde9a3e71225f961547edf2f3deecb6160165116375fdbafcc64094a9ea225ca198ae0d68', 2, 'web', 1601651163),
(36, '44d185c18530539ca88821abe18eafabfec1d9c016016512483ac2f2d446d335064388654566e5fb4f', 2, 'web', 1601651248),
(37, 'd3c6fb69c0402c51a4d189958bbcae0aa53c328a160165589216f477a134b717bb7588f28106b34422', 2, 'web', 1601655892),
(38, '77410efdabf7be968bbc2591dca16d1cf0f451ce1601656374583f2173d113b2e83f6d08ef3a3117a1', 2, 'web', 1601656374),
(39, '9fce6a6184c912ad6b998ae82287239ea7bf6da21601656878fe895e58942ea99fbd1c6a21e7de507d', 2, 'web', 1601656878),
(40, '6561581ad8b8a7ec235bf061391ef0ad44fd2736160165724132be9010888e6c153167ee289dede4a7', 2, 'web', 1601657241),
(41, '50c9fa502558df6e4eaa1a2bad594d52ace8b3ae16016586907993a3785f269561dda7a456062a6512', 2, 'web', 1601658690),
(42, '3a815a8f128199b0f4acf6655fc406b64d1eda971601658844a0bd03d49043e8641f05539601f1d113', 2, 'web', 1601658844),
(43, '197d30dc4b20d8242e11f1e0bb748a89511d40d416016633644eed432810d23fe5e3f75d1db9b9e2b9', 2, 'web', 1601663364),
(44, '2a23e31ddc58d224f6e5b11aa193ee50e63120081601663702c58afa70c434d13204fc85a66da52a70', 2, 'web', 1601663702),
(45, '3af6f6fecfe0edeca7d905e467586d69a63ab29016016637531ee44a7de39f70d887b71e74164b8952', 2, 'web', 1601663753),
(47, '3786970d796f112c137f1fe0fff34eea15f2f5b6160166700457d8837c4c7db84a981e3c2a87f3f0f1', 2, 'web', 1601667004),
(49, '59f83d522f5eef2a7cd845eda0a0e067c324e56916017035692c8149b1352ad8aafc6dd7cb9875763f', 2, 'web', 1601703569),
(50, '88cd6ebf6230317f6e9a52bd02178953e64aa5ae1601705299a9c37e4bf854283be6a985985d96e358', 2, 'web', 1601705299),
(51, '7f6f51f4f43c996d6abbaf115798bf55b69b35901601707935180025aa5baeb3731ff8ba4afa22ff6f', 2, 'web', 1601707935),
(52, '8836c012772867d1639ec454024f319e050536fb1601707996d317a1d76b61ac241444119754c832e0', 2, 'web', 1601707996),
(55, '3d2e9490f155a60322d91003226b512cca89cfc516020907046db9eaef46f78b223fba8cef40acd971', 2, 'web', 1602090704),
(56, '2d2841f7cd06fa1babad24abc18bb4b8dc1e308f16021576103a523e9e6a4961503092e8de033fb4d2', 2, 'web', 1602157610),
(57, 'd738db973b34ff876260e17b37ac6512784595fe1602160123e117d22f047353d3e39bb6ca793c6a21', 2, 'web', 1602160123),
(58, 'ed89367c0e952c5540f9091dafee573eea40d0aa1602503137e977f30f1933b8213455cb93cb1bce2c', 2, 'web', 1602503137),
(59, '0464c937c7d64263dae0cd9eba008d0d5153b5ea16026697393d2e2830fa6241f61345ba4fc2ff9196', 2, 'web', 1602669739),
(60, '5f32b76851592a205fdcdd3ded8dcec4020e07d316026705810d65fabc22bc37014004ed031d3169c3', 2, 'web', 1602670581),
(61, '9d1ade5befc5f124f2d3c431eae1c0353f3a8da51603104510a7fc895758e28372a878609267b68183', 2, 'web', 1603104510),
(63, 'bd9f4f8525fa7a6c4bb6b43c7a2f5cd307156382160330292787839edc14396348e4f018c94f92154e', 2, 'web', 1603302927),
(64, '0363fc7890063f3dc82db418a271ff4948b9be301603352789c6d093c2a6a6a991085a583544fb2561', 2, 'web', 1603352789),
(66, '1c14ea0f40c36c01fecca0432b00fe9e7bcb961a1604745729af57c356b93a7d43d9b1e42a09aa5dd1', 2, 'web', 1604745729),
(67, '3d932214f0d5ed2bfe58da219d6ca999981b6ef41605565532eb5ca785d9a41611b2ea7eef17343742', 2, 'web', 1605565532),
(68, '7e550fd766adb28ce7a3ae6238270c294a14ef0b16057037127da2ab70ec7149c5e3df0e8dcbed92b0', 2, 'web', 1605703712),
(69, '5082c59ab1c4a2d66a94793f270b17ae70500d6816061171135ff889247fd1e5dab3fe7146eefdd96f', 2, 'web', 1606117113),
(70, '86d2ca1f644e32a8edb02e61c29da83fd3022ecb1606796519ba6ab218fff2add974e5dac91307c49f', 2, 'web', 1606796519),
(71, 'ff7d2490eda9646d97201109b12b69f8dbedd4b01607091215ae16c66a596b266abf9e51efd5f76a79', 2, 'web', 1607091215),
(72, 'f1dc4542e93719fccfb8331d4622fc9b35d129de1608551971e9402ae4a81c03028b5b61f7b84b649f', 2, 'web', 1608551971),
(74, '7e35fc7e7b9b263fb5a47af6846ba75cfc525d8c1609771020bbdc3c06df8a3fe24a905bce1824792f', 2, 'web', 1609771020),
(75, '1a9853c6ee953fe34f38bc6e0f73730c2b1465ef161106663965b386f3d935fafe25465edcb597e6ac', 2, 'web', 1611066639),
(76, 'e1b211608e5413dea010d15972c6c60be886702216117544908e24f9e982fe1ca9f62e5db8cf0e4379', 2, 'web', 1611754490),
(77, '365958c712de991231ea31a4608f95a6e2031c9316121695145b4a4a3189fd0523e9fdc2cd0d0f8f13', 2, 'web', 1612169514),
(78, '87cda572bacc6371e2107c8c5e43ffad4d45b73d1612252048c4302a0710d19bc03676179ed2c8fd50', 2, 'mobile', 1612252048),
(79, '2c5b0ca2a258fb35e489b88cc7fd0c14ae4ea50f16122573227caf73372068238bad5e27fb0e8599d7', 2, 'mobile', 1612257322),
(80, 'db6e31fa5c619d3ad45a4a9c22cf0d7b0b55b16716122724880801947a3df0e751034cdef5f3fb50cc', 2, 'mobile', 1612272488),
(81, 'e1d6188362a4d2b651dc734937e743d434f010c61612277856962a28eea2f1ce98cb95cb040c132f57', 2, 'web', 1612277856),
(83, '621561e15109eb912fdd2903bad58cf6314dd8b41614158190340fb9296cc7a70b8978a927a0091278', 2, 'web', 1614158190),
(85, 'd8d1db9a2e462d79f33814e03559e99332b6bbde161458917921c661a81ef5949a6a7e338360980a9c', 2, 'web', 1614589179),
(86, 'c9078e70f2e31aa824854582494c43ae2e1239ed16145911424605cca761e13c350779396f929a327e', 2, 'web', 1614591142),
(87, '320694eaacf2b3e1d8dd8b2338462bd9265bb535161459522917f3b49ffe0b5fe140b375458f1e5a9b', 2, 'web', 1614595229),
(88, '5b575eedde6ebf8e61bb4782a4a2f05f97bc5dd61614675030fff340a8d2dad7edd0c65a92b2bb076e', 2, 'web', 1614675030),
(89, 'a4d897e66a0ec8209f134ee5e5449fbcec0281ce16224118952ca0d20698cdeb70638fd722d0a98c73', 2, 'web', 1622411895),
(90, 'e3035c45f37808442a4e45aa0dbdb3fee8abd1d016232560481b48bc5cca30a1e8bfaf4cb3329e19f3', 2, 'web', 1623256048),
(92, 'ca35baec1073a7a22f79394290f9b710f036486d1626025587ee1ca1bc7b3daa60b89849146e24f983', 2, 'web', 1626025587),
(93, 'd0b5b2ec979a4584d0c817ca9ae9cfda08a6ac0b1626029119e2636d33877e645ed48b6fce27dd77b9', 2, 'web', 1626029119),
(94, '49174c180c50ec20fe114ea1c9131ac1abee53661626034934f5bfdf28bb576cadfe3b404617634a13', 2, 'web', 1626034934),
(95, '3360feceb71c0fd4cc2850b1e81bc47725053b721626083073fd065cfc6d43e302cd3e6dbba3eeb3ea', 2, 'web', 1626083073),
(96, '7060c3a493d0c7a5e962fc61035555226f1d8691162610582176ef958a53427f7cf60eb98b5c0ed9de', 2, 'web', 1626105821),
(98, '50f0e3030cbba41458e8e8d8cd45308b6b8390f316262138695f97a508fa166c26f0edc300bb660ae7', 2, 'web', 1626213869),
(99, 'd5d59adb12285b841b7dc30ea5599586e4b46b2f16262434911119763118c218d0d47aa2598e91249f', 2, 'web', 1626243491),
(100, '5efec1ab1b692caa20a0df9213fd8ec9228da9cd16262521383353caf75a03e3577b9eb672aff77332', 2, 'web', 1626252138),
(101, '795dfc593f17ff739d3d58343b804fd1b89c957716262526342479a95c8cc0ea2e940cb12d284116b4', 2, 'web', 1626252634),
(102, 'b2a794800b50b7f67636083cd2c4b58017d699781626263649e26058c4b3d6420c358fbb5772944a90', 2, 'web', 1626263649),
(103, 'ac878fbc54c797bfe3f29956f3eb5c1a00f0934e162626629326f3fb885baae70fbe182775202d8ad9', 2, 'web', 1626266293),
(104, 'a304206a42d2c6d48ec50bd0291f07aaaf773f04162627363642bc14c9ea657d543b57c4a980ed89c1', 2, 'web', 1626273636),
(105, 'fa4da7f6cf47743146027c2d6628631092d51ef116262747160408bc67728d72301fdc891ecb3d0675', 2, 'web', 1626274716),
(106, '38b7a4c8cd362f464cb0c2151aedb8f0fd1723a21626275547eda31b6ef06839f8843a0672a8852c35', 2, 'web', 1626275547),
(107, 'ed4ccd9c690a8350d01f2e73337d77927b034cb41626276214c7592a3085cef4d0e5ff7cd4c8e8d1f9', 2, 'web', 1626276214),
(108, 'e5f9a3f2b17868498ca57f259e3935e8694c8ad61626276711dd0ffd73116f65aed27e2e5feb3e95c6', 2, 'web', 1626276711),
(109, '83765b1fb482deaf51eed26cde675fc274d9c34b16262877708814bb9e7d3d4f35852de88a8641d265', 2, 'web', 1626287770),
(111, '61ad0b70565a45b7a17767eef0a5a82fa5606cac162634343709081e9e759f092ce5f8cd890ff11a46', 2, 'web', 1626343437),
(112, 'e54991059b57a5fd6624740ca9c8ac5349b1179c1626411584a5258b0653958e43805540ab297bf87b', 2, 'web', 1626411584),
(113, '19eea22466757f40b1f0153593d093e7c0cf68ff16264954098b739ad80604d1d0ee2a2905a2fa17dc', 2, 'web', 1626495409),
(114, '6fcfe70158da854a1391d720f565c15bcd8a2aeb1626495964fcff58fac225c6258bbba715fd739861', 2, 'web', 1626495964),
(115, '035f54f74d6260250a6f3a603087216e6deed5b816265018560da96230d728dc1b71b47a6087503120', 2, 'web', 1626501856),
(116, '194ba760a460adf04817dff63f32227129b823391626727611dc0a061e9109ccd5119077dd2b724858', 2, 'web', 1626727611),
(117, 'c5d1eda2f276999b0c8f2e8f173f254f0c4882cd16267525462131b2b88f6ff3aaf36a5a1b68a7ab99', 2, 'web', 1626752546),
(118, 'a7346d6444f36e7b02e54397352fc0318afc86ab1626990899773347a29d211edc7628e24cc00edbd5', 2, 'web', 1626990899),
(119, '555586f909aeece706c943da8d4b0f9f9840af861627991783b2c7086942819e4a3cbec120c5f41cfd', 2, 'web', 1627991783),
(120, 'f85bb5f8c87fd2162f17e972a8fd0979eb61035f16280532624a9bc02e8c44e2ab260c0cf7e246d0fe', 2, 'web', 1628053262),
(121, 'd2bab5966662199b3370f9e580fc0fb3da6b57e116280931212beff74a539b5b7006de683b3a267af4', 2, 'web', 1628093121),
(122, '587097ccb3359a0bc3e7804a57b87cb3e7d8399c16281029264acacaa27807223e61698ed24574156b', 2, 'web', 1628102926),
(123, '904cb552655141c82f5845cf70173d15cd00b8091628103182099898eb0e37f87ca5231f27bce85836', 2, 'web', 1628103182),
(124, '52c389c274a760e905a2bdedc7300ae8e1d836251628218901065be8991ce2e704860e7631460ef0e1', 2, 'web', 1628218901),
(126, '96066618da84081b6adf043ebb1a6957cbfdeed4162825044952bb9d351bb925e4af26941e177865b3', 2, 'web', 1628250449),
(127, '858125c13e6890deaebaa9fd90dbb1fc75f698291629100362dead931a33c0783f459361ad3d64d12a', 2, 'web', 1629100362),
(128, '2c06b563e9bbad923bac1ee982cc9168c3bbd5911629102856a0b5b7036fd51a46877d96f4e4a92feb', 2, 'web', 1629102856),
(129, '9a5e267591b35ff0f2e7f6faf15dcf35fda5da59162911861983f2c279f735b4e8eb2b1b1b608b37af', 2, 'web', 1629118619),
(130, '73c2509cca401aca46ecf8775870690cd1d8b4df162912449523ccd0a5f20f435bdbffcecc538edd35', 2, 'web', 1629124495),
(131, '332233cd238a4b5abfa0a95ed490c731b175790d162912484814af68a0a5d2c3df7201dc9eba9f03bb', 2, 'web', 1629124848),
(132, '675af5c640c38b5ed4941432c2feddeb914652cf1629124879c0ab9a75858dfac0952a0ac25a434cd9', 2, 'web', 1629124879),
(133, '7af8d532bb3b43d171bad1a863d942ef45397fb51629125422c76d718747edde56fd248ef9b2565cc9', 2, 'web', 1629125422),
(134, 'a1e4bb66dc6ef903f6e94a28141d67cb28de632316291256158572fccf48bf01b3ea3a296420795e75', 2, 'web', 1629125615),
(135, '64a236ec91603d91a452a9544a6dd571c324514916291256830a3e6afccbaf7118951c0e4e0e78fdfb', 2, 'web', 1629125683),
(136, '3e9cb28966fb4bbea476862df862d8b5e36be5c916291257437a3d3c3525c9f2d7ee4ede033ee10e50', 2, 'web', 1629125743),
(137, '51146ae54bd55d019ac4c925836e7cca87d7238e1629126046cdf1e2d2a7f141f3f17f646d08d60944', 2, 'web', 1629126046),
(138, '16dfc4907c20b3de3921140a647a7ef155a3a189162912607917d8bbb7d4506738ddfd4c852b42fe28', 2, 'web', 1629126079),
(139, 'b0af95bcd1efb66ae5cfdcb8cd4259094c6d85b71629126796322d25f0f562fb80ae061dd6705a3a6c', 2, 'web', 1629126796),
(140, '6c9cd18da97c3847ad63ce895ddc108286f939721629135997386beba0cb0b30f0d66dc94e1bab0a46', 2, 'web', 1629135997),
(141, 'a60c5a9f01e90dbe260d5b11c2b0392242ed95ce1629138690b0b02ac7f2e87fe0f2cfc4fb73833ff9', 2, 'web', 1629138690),
(142, '9288bc601e717a98fce0c40da10e53316ee5df8716291441536b85669967d8ec3367f813551175ac0d', 2, 'web', 1629144153),
(143, '697d97d6bd745a0e3806429d9bb01434e36b27d41629181331b8bd4a7555427f47faea0c76246b1183', 2, 'web', 1629181331),
(144, 'ed36a4da5c1d524ca97cce1de1cfcaf97482f68c16294584260511547cfa5c1b0e7a9c02f8fe3fb86e', 2, 'web', 1629458426),
(145, 'f45bfe5930b37b22a67f63e1b4386d7501632fc0162945843287987d635fc3e7c6b3daa8286b1d331c', 2, 'web', 1629458432),
(146, '753449db5e3d36204a365cb72598bc1b91416a911629458436b7fb2c8922e73f09085063e4945b415e', 2, 'web', 1629458436),
(149, '2bec49faf3602d39074e06bc1387e413f523a06c1629637523a935446eeb56b28e5528a2b89e36f67f', 2, 'web', 1629637523),
(150, '15e65b85aa18ad20315c1cf7c40636e766d724471629664558b080f37201b4e1bb9e0e98ab1dbffb06', 2, 'web', 1629664558),
(151, '6a24e28ee4938a21ea17b92601910b51973124f01629807099c658a53bff5d55b4ef45234b8be367c1', 2, 'web', 1629807099),
(154, '22fc495f161396e4eb52bbb7c66c19cfbee6baab1630932573026ec651fd26dce39ec44ddaff342a09', 2, 'web', 1630932573),
(158, '7a4a8d94ceee619c335e23764a983d6ad68f1af01632478206bfbb387f875924b76bc88c21ef8245f1', 2, 'web', 1632478206),
(159, 'af70d8d8e1f7b59ddb69e57d2c033a6e4b102c901632478234f10a1c2d773afac84d1fe7f24ec0f425', 2, 'web', 1632478234),
(160, 'aa733241feb71b0ad33e04d33e8c9f9832ed4bdd1632905613dec56bdd33232c3a14f529dc24d293d1', 2, 'web', 1632905613),
(161, '2095d8856e58cca9b118ead14ee0f0fd54cf49f21633073654d5484d6ae64bdf0dd4142e7413e50c86', 2, 'web', 1633073654),
(162, '01ec023c7534059f11858c48dad5c002d0c4c89016332570347dd6366113a57b5f62951c9fefbd1cab', 2, 'web', 1633257034),
(163, '3a1901688f44efcc8d58efcab03c8133a6df2c0d16349041494ffc6ab4406e5c6091bb6c18f2f757a3', 2, 'web', 1634904149),
(164, '17e3b01da982337cc1eb194da7c4bd44fbe45cd01634905013a3c03ba95f006cc495b09d3e77013497', 2, 'web', 1634905013),
(165, 'f95cc057d0340c76282bb7b828b47acdb808d2d816353474520bf1aaef9bc53f54dbf66a195e88dec3', 2, 'web', 1635347452),
(166, 'ae9da404c0902cbbb08cfbda06ca54c6d5c433d71635498531a62c691f49a111b9394cdb4b6f783411', 2, 'web', 1635498531),
(167, '1e7b889482b9f7349a5e32cca390ded6f9717a3d1635921281690b18e68f63beaa26a0e22437ef045e', 2, 'web', 1635921281),
(168, '47d6fdf4f35613ed78b15730d7e8ee12b1b56ffb16359213108c4d9eecec99aa43ff1a2d96cfb7ca50', 2, 'web', 1635921310),
(169, 'ebb24c32afa639ea451b2b819292a7f5daec01ee1636061450f3c64bde7ffb748c9487bc1019964ff6', 2, 'web', 1636061450),
(170, '3132d5b0c0e234bb21df27592fff3d4258f3ed78163652745896f06780309996a7851e218bd6a3fba0', 2, 'web', 1636527458),
(173, 'e56145f58713fa30a34e5253d1551d31f5e9a33116371375430e298520d0b0d43815172d54861012f1', 2, 'web', 1637137543),
(174, '115d87b9650df78d5142d5e3c6fdadf3870e1eac16375760197cff83dda496471a80663b97e41ac9e6', 2, 'web', 1637576019),
(175, '2c203a8d4a3e0b5e0b668af68f08433314f8ae47163765696647209c582eec301c7d121c0a59faa699', 2, 'web', 1637656966),
(176, '86e98fa3b558f205aec60f52285ea28eb4f342591637659829a837b0503bc9c4d9b7ed51f3827357db', 2, 'web', 1637659829),
(177, '3ff4d6b9495f3e4fa8dd58a5046ac23ac0c70dd01637679302980ba943e148d0e526d794cf9731ed47', 2, 'web', 1637679302),
(178, '008a866d9d23e7590bff12c2d0f32df2f3131f4916376822191b9552b1a781b33330b3c6898e5dabb5', 2, 'web', 1637682219),
(179, '2d098b725446d72168b10b6452627bf799fc15321637682467127047060c37f634604509c186dfade9', 2, 'web', 1637682467),
(180, 'a2d3dbd35353a0cc1892ac0bcfd786c80258b61616456335127e2be4c2f81ddb25efca7d82e0123fc8', 2, 'web', 1645633512),
(181, '34d3e8fd9fbb7d188dba7b3c67bb52118ced443416460082434d2ce1d4b484ab9c4e8e581f98d9441b', 9, 'web', 1646008243),
(182, '4de698b75bcabac98954c24da35fa3473464f70f1646009083ddb6bf61415de0f2c8b3bc6ed9c998c7', 9, 'web', 1646009083),
(184, 'a105f38a4183400026f05dcf7e57c2e964b34aea1646078501f58bc24c15d93e1b3781bff8c2d4602e', 9, 'web', 1646078501),
(188, '23eb2bf23b40a8a7bb55a525eccbf64f2455b2c5164629438682d7dfb35bda18a16db66355ccf71e2e', 10, 'web', 1646294386),
(189, 'e37d8bc267a2dbb87dc8520cb451c46056a97a8616462949694fa7f9d3d9713808fe22a46ca7f1f0a0', 9, 'web', 1646294969),
(192, '0f3a1ceaed86ba38f048bf241a6feca3723e3c141646376927c8820b0d4ed7d186d86870a6dae9a6c3', 9, 'web', 1646376927),
(193, 'c7988c97ec1f9b259e63315ed4ca19ba91ae65611646578312a8cd06db1eca1bf46b0a3eb4439e77b9', 11, 'web', 1646578312),
(196, '70e0c25f45cc18009dbb5c3db0d40e2c38087c7816466887401b409b7f7568b0e2d945a19d1cd04b51', 2, 'web', 1646688740),
(200, '90e830ad0f9cccf433cbae2b24228d6c544a5b181646788503050ff74ac15d9324bd2e3991caef9110', 2, 'web', 1646788503),
(202, 'a01d5879bdf3e5a3e5c1ad248711bc68be995b721646837576261294163097621ac7ede200f60aa3c1', 2, 'web', 1646837576),
(204, '053f4afc9e991b7ec45de3a506cf04ad50354b2c16469206876865ee77bb60909563c02795ce41a45d', 11, 'web', 1646920687),
(205, '857e41152a21448c5385ed01ea7d4232c8d15d521646951317f678a7ad0195ecc58144629be788df43', 2, 'web', 1646951317),
(209, 'dbf5487d183a8669f32d5b6f26791dc1f06806cb16469989388c2d02cfc1ef3ddd4191e8065849ee9f', 11, 'web', 1646998938),
(215, 'd3f03a0253ab110e8b4c6001416e12e494b12ee1164721655409d21a7660d8a1b7e65c38a3a5947b0f', 10, 'web', 1647216554),
(217, '387652ab9c2ec6ae465c26e272291643f00e5a5e1647309100074b8efb0f0d14b1b73fd95445e78bcb', 2, 'web', 1647309100),
(219, '6074a83bb9bec5d58016f4252ff3abba6468e56c1647309129bab1733b323ed9dccf1bf95ac8a1c4fe', 2, 'web', 1647309129),
(229, 'fa02386487d26d2a462e6c025728e59c43bb0ea31647456224eafc1c0f37d804fe55bf428f0e56731a', 10, 'web', 1647456224),
(231, '5ce38e2db247b6e9c78da699a68591eb6961c29916483140412ddd07a2959bc43954ace30fcab64103', 12, 'web', 1648314041),
(232, 'd8a80bfcf761d2c73fc77e4ef7bf79ac5e3993fc16483141464b6419079e6d54b7ffc0e3010993703d', 13, 'web', 1648314146),
(233, '6a9136b19d3c0969ec32f4d476264b88fac10c8116483150454b52ef2fecc897f32580d2bb0b61b572', 14, 'web', 1648315045),
(244, 'c75aac45b6a2b63a2fd11b2ca99a144a079b7c611648402663c51a9151301d448dfc2651cd52f8f42e', 16, 'web', 1648402663),
(263, 'e6732054dfc77585b91fa52a7440a6f210aa00b4164879887668b3ee1c62f39458ba5f6a74470fe221', 20, 'web', 1648798876);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `type` varchar(400) NOT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `type`, `text`) VALUES
(1, 'terms', '&lt;h4&gt;1- Write your Terms Of Use here.&lt;/h4&gt;           &lt;br&gt;        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  &lt;br&gt;        &lt;br&gt;&lt;br&gt; &lt;br&gt;       &lt;h4&gt;2- Random title&lt;/h4&gt; &lt;br&gt;       Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(2, 'privacy-policy', '&lt;h4&gt;1- Write your Privacy Policy here.&lt;/h4&gt;           &lt;br&gt;       Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  &lt;br&gt;        &lt;br&gt;&lt;br&gt; &lt;br&gt;       &lt;h4&gt;2- Random title&lt;/h4&gt; &lt;br&gt;       Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(3, 'about-us', '&lt;h4&gt;1- Write your About Us here.&lt;/h4&gt;           &lt;br&gt;       Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  &lt;br&gt;        &lt;br&gt;&lt;br&gt; &lt;br&gt;       &lt;h4&gt;2- Random title&lt;/h4&gt; &lt;br&gt;       Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university_logo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foundation` int(11) DEFAULT NULL,
  `lang_edu_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_edu_tk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_facilitie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_teams` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_associations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laboratories` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asso_degrees` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `undergraduate_program` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mater_programs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ph_d_programs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `international_students` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_students` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `study_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dormitory` tinyint(1) DEFAULT NULL,
  `female` tinyint(1) DEFAULT NULL,
  `male` tinyint(1) DEFAULT NULL,
  `library` tinyint(1) DEFAULT NULL,
  `wifi` tinyint(1) DEFAULT NULL,
  `gym` tinyint(1) DEFAULT NULL,
  `cafeteria` tinyint(1) DEFAULT NULL,
  `copy_center` tinyint(1) DEFAULT NULL,
  `hairdresser` tinyint(1) DEFAULT NULL,
  `atm` tinyint(1) DEFAULT NULL,
  `car_park` tinyint(1) DEFAULT NULL,
  `bank` tinyint(1) DEFAULT NULL,
  `security` tinyint(1) DEFAULT NULL,
  `vertural_court` tinyint(1) DEFAULT NULL,
  `walking_track` tinyint(1) DEFAULT NULL,
  `barrier_free` tinyint(1) DEFAULT NULL,
  `tennis_court` tinyint(1) DEFAULT NULL,
  `dining_hall` tinyint(1) DEFAULT NULL,
  `auditorium` tinyint(1) DEFAULT NULL,
  `medial_center` tinyint(1) DEFAULT NULL,
  `hospital` tinyint(1) DEFAULT NULL,
  `bachelor` tinyint(1) DEFAULT NULL,
  `master_programs` tinyint(1) DEFAULT NULL,
  `master` tinyint(1) DEFAULT NULL,
  `certificate` tinyint(1) DEFAULT NULL,
  `phd` tinyint(1) DEFAULT NULL,
  `associate_degree` tinyint(1) DEFAULT NULL,
  `medicine_health` tinyint(1) DEFAULT NULL,
  `pharmacy` tinyint(1) DEFAULT NULL,
  `dentisy` tinyint(1) DEFAULT NULL,
  `engineering` tinyint(1) DEFAULT NULL,
  `computer_science` tinyint(1) DEFAULT NULL,
  `agriculture` tinyint(1) DEFAULT NULL,
  `art_design` tinyint(1) DEFAULT NULL,
  `business_management` tinyint(1) DEFAULT NULL,
  `education_traning` tinyint(1) DEFAULT NULL,
  `engineering1` tinyint(1) DEFAULT NULL,
  `sports` tinyint(1) DEFAULT NULL,
  `journalism` tinyint(1) DEFAULT NULL,
  `law` tinyint(1) DEFAULT NULL,
  `medicine_health1` tinyint(1) DEFAULT NULL,
  `natural_science` tinyint(1) DEFAULT NULL,
  `social_science` tinyint(1) DEFAULT NULL,
  `medicine` tinyint(1) DEFAULT NULL,
  `applied_science` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `university_name_slug` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `main_image`, `university_logo`, `description`, `title`, `university`, `location`, `university_type`, `foundation`, `lang_edu_en`, `lang_edu_tk`, `sp_facilitie`, `sp_teams`, `st_associations`, `laboratories`, `asso_degrees`, `undergraduate_program`, `mater_programs`, `ph_d_programs`, `international_students`, `total_students`, `study_mode`, `dormitory`, `female`, `male`, `library`, `wifi`, `gym`, `cafeteria`, `copy_center`, `hairdresser`, `atm`, `car_park`, `bank`, `security`, `vertural_court`, `walking_track`, `barrier_free`, `tennis_court`, `dining_hall`, `auditorium`, `medial_center`, `hospital`, `bachelor`, `master_programs`, `master`, `certificate`, `phd`, `associate_degree`, `medicine_health`, `pharmacy`, `dentisy`, `engineering`, `computer_science`, `agriculture`, `art_design`, `business_management`, `education_traning`, `engineering1`, `sports`, `journalism`, `law`, `medicine_health1`, `natural_science`, `social_science`, `medicine`, `applied_science`, `remember_token`, `created_at`, `updated_at`, `university_name_slug`) VALUES
(5, 'upload/photos/2022/03/qnSmch3rPwocqiD4O4zq_30_6e0143008c10559c95c5a6b1e60baf63_image.jpg', 'upload/photos/2021/08/TGm5RqRKQyHjOztRgu9e_06_36eca81af96f7edba67a3caf8e5826cd_image.jpg', 'hety test edit', 'Acibadem University', 'Acibadem University', 'Istanbul', 'Istanbul', 2012, '1', '1', '5', '6', '41', '51', '52', '34', NULL, '10', '100', '4315', 'Full-Time', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 33, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 1, NULL, '2021-05-16 09:44:29', '2021-06-29 11:12:19', 'acibadem_university'),
(6, 'upload/photos/2022/03/wkaanVzHeuHPaZhdjKxd_30_824c3406647a749e54b16a74d8647278_image.jpg', NULL, '', '', 'Alanya HEP University', 'Antalya', 'Antalya', 2011, '0', '1', '0', '0', '12', '6', '0', '16', NULL, '0', '64', '394', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 2, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', 'alanya_hep_university'),
(7, 'upload/photos/2021/07/8c3EnCy7UMTdZLCt1eKr_20_52772059e3bd4d1146befa6fc9d91523_image.jpeg', 'upload/photos/2021/07/BpOGs99Z2Cag5jqGXF6O_20_52772059e3bd4d1146befa6fc9d91523_image.gif', '', '', 'Altinbas University', 'Istanbul', 'Istanbul', 2008, '0', '1', '0', '4', '68', '84', '24', '58', NULL, '10', '3762', '10337', 'Full-Time', 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 30, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 1, 1, NULL, '2021-05-16 09:44:29', '2021-06-24 22:04:33', NULL),
(8, NULL, NULL, NULL, NULL, 'Ankara Science University', 'Ankara', 'Private', 2020, '0', '1', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'N/A', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, NULL, 1, 1, 1, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(9, '1625384797.ico', NULL, NULL, NULL, 'Ankara Medipol University', 'Ankara', 'Ankara', 2018, '0', '1', '0', '0', '0', '1', NULL, NULL, NULL, '1', 'N/A', '697', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, NULL, 0, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-07-04 07:46:37', NULL),
(10, NULL, NULL, NULL, NULL, 'Antalya AKEV University', 'Antalya', 'Private', 2015, '0', '1', '8', '0', '6', '6', '23', '16', NULL, '0', 'N/A', '538', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 0, 1, 0, 0, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, NULL, 1, 1, 0, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(11, NULL, NULL, NULL, NULL, 'Antalya Bilim University', 'Antalya', 'Private', 2010, '0', '1', '21', '5', '34', '18', '12', '55', NULL, '0', '346', '3961', 'Full-Time', 1, 1, 0, 1, 1, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 11, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(12, NULL, NULL, NULL, NULL, 'Atilim University', 'Ankara', 'Private', 1997, '0', '1', '11', '28', '65', '185', '5', '136', NULL, '13', '572', '9465', 'Full-Time', 0, 0, 0, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 70, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 1, NULL, 1, 1, 0, NULL, 1, 1, 1, 1, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(13, NULL, NULL, NULL, NULL, 'Bahcesehir University', 'Istanbul', 'Private', 1998, '0', '1', '0', '5', '73', '82', '29', '142', NULL, '28', '4686', '25334', 'Full-Time', 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 127, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 0, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(14, NULL, NULL, NULL, NULL, 'Baskent University', 'Ankara', 'Private', 1994, '0', '1', '9', '21', '114', '46', '176', '230', NULL, '38', '530', '16747', 'Full-Time', 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 127, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 1, 1, 0, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(16, NULL, '1624639648.png', NULL, NULL, 'Bezmialem Vakif University', 'Istanbul', 'Istanbul', 2010, '0', '1', '11', '15', '32', '0', '40', '25', NULL, '11', '142', '3270', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 1, 1, 17, 1, 0, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-06-25 16:47:28', NULL),
(18, NULL, NULL, NULL, NULL, 'Demiroglu  Bilim University', 'Istanbul', 'Private', 2006, '0', '1', 'N/A', 'N/A', 'N/A', '1', NULL, NULL, NULL, NULL, 'N/A', '2491', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 1, 1, NULL, 1, 0, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, NULL, 0, 0, 0, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(19, NULL, NULL, NULL, NULL, 'Fenerbahce University', 'Istanbul', 'Private', 2016, '0', '1', '13', '14', '63', '8', '20', '35', NULL, '0', '52', '391', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, NULL, 0, 1, 0, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(20, NULL, NULL, NULL, NULL, 'Gedik University', 'Istanbul', 'Private', 2011, '0', '1', '4', '0', '21', '30', '109', '82', NULL, '7', '318', '5183', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 40, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 0, NULL, 0, 1, 0, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(21, NULL, NULL, NULL, NULL, 'Halic University', 'Istanbul', 'Private', 1998, '0', '1', '14', '8', '42', '79', '82', '141', NULL, '6', '807', '10898', 'Full-Time', 0, 0, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 55, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 0, 1, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(22, NULL, NULL, NULL, NULL, 'Isik University', 'Istanbul', 'Private', 1996, '0', '1', '9', '15', '63', '37', '100', '116', NULL, '6', '587', '7640', 'Full-Time', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 55, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, NULL, 1, 1, 0, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(27, '1624639598.jpg', '1624639599.png', NULL, NULL, 'Istanbul Bilgi University', 'Istanbul', 'Istanbul', 1996, '0', '1', '7', '16', '106', '112', '128', '140', NULL, '6', '1513', 'N/A', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 61, 1, 0, 1, 1, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 1, 0, 1, 1, 1, 1, NULL, '2021-05-16 09:44:29', '2021-06-25 16:46:39', NULL),
(28, NULL, NULL, NULL, NULL, 'Istanbul Esenyurt University', 'Istanbul', 'Private', 2013, '0', '1', '8', '17', '35', '15', '82', '60', NULL, '0', '338', '7365', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 16, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 0, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(29, NULL, NULL, 'Istanbul Galata University is located in Istanbul.', NULL, 'Istanbul Galata University', 'Istanbul', 'Istanbul', 2019, '0', '1', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'N/A', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-06-20 12:46:11', NULL),
(39, NULL, NULL, NULL, NULL, 'Istanbul Commerce University', 'Istanbul', 'Private', 2001, '1', '0', '0', '0', '0', '0', '75', '106', NULL, '12', '764', '9372', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 67, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 1, 1, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(43, NULL, NULL, NULL, NULL, 'Kadir Has University', 'Istanbul', 'Private', 1997, '1', '0', '0', '0', '0', '29', '4', '83', NULL, '11', '255', '5878', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 53, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 0, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(44, NULL, NULL, NULL, NULL, 'Kocaeli Health and Technology University', 'Kocaeli', 'Private', 2020, '1', '0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'N/A', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 0, 0, 0, 1, 0, 1, 1, 0, NULL, 0, 0, 1, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(45, NULL, NULL, NULL, NULL, 'Koc University', 'Istanbul', 'Private', 1992, '1', '0', '13', '23', '66', '239', '0', '68', NULL, '28', '439', '8172', 'Full-Time', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 62, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 1, 1, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(46, NULL, NULL, NULL, NULL, 'Konya Food and Agriculture University', 'Konya', 'Private', 2013, '1', '0', '3', '0', '8', '25', '0', '9', NULL, '0', '7', '627', 'Full-Time', 0, 0, 0, 0, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 12, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, NULL, 0, 0, 1, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(47, NULL, NULL, NULL, NULL, 'KTO Karatay University', 'Konya', 'Private', 2009, '1', '0', '1', '17', '52', '56', '33', '77', NULL, '4', '308', '8370', 'Full-Time', 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 27, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(48, NULL, NULL, NULL, NULL, 'Lokman Hekim University', 'Ankara', 'Private', 2018, '1', '0', '11', '1', '14', '12', '19', '20', NULL, '5', '90', '1152', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 0, 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, 1, 15, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, NULL, 1, 0, 0, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(49, NULL, NULL, NULL, NULL, 'Maltepe University', 'Istanbul', 'Private', 1997, '1', '0', '11', '6', '50', '60', '73', '169', NULL, '13', '432', '12069', 'Full-Time', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 66, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(50, NULL, NULL, NULL, NULL, 'MEF University', 'Istanbul', 'Private', 2012, '1', '0', '0', '14', '44', '8', '0', '43', NULL, '0', '15', '3507', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 31, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 0, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(51, NULL, NULL, NULL, NULL, 'Near East University', 'N. Cyprus', 'Private', NULL, '1', '0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'N/A', 'Full-Time', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 1, NULL, 0, 1, 0, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(52, NULL, NULL, NULL, NULL, 'Nisantasi University', 'Istanbul', 'Private', 2009, '1', '0', '6', '17', '58', '186', '182', '118', NULL, '1', '1443', '20011', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 12, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 0, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(53, NULL, NULL, NULL, NULL, 'Ostim Technical University', 'Ankara', 'Private', 2017, '1', '0', '6', '0', '20', '20', '21', '17', NULL, '0', '17', '254', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 0, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(54, NULL, NULL, NULL, NULL, 'Ozyegin University', 'Istanbul', 'Private', 2007, '1', '0', '14', '27', '53', '65', '0', '67', NULL, '8', '500', '7954', 'Full-Time', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 20, 1, 0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(55, NULL, NULL, NULL, NULL, 'Sabanci University', 'Istanbul', 'Private', 1996, '1', '0', '8', '13', '52', 'N/A', '0', '16', NULL, '15', '464', '5180', 'Full-Time', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 45, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 1, 1, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(56, NULL, NULL, NULL, NULL, 'TED University', 'Ankara', 'Private', 2009, '1', '0', '6', '16', '24', '22', '0', '50', NULL, '0', '134', '3767', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 14, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 1, NULL, 0, 1, 0, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(57, NULL, NULL, NULL, NULL, 'Uskudar University', 'Istanbul', 'Private', 2011, '1', '0', '6', '6', '73', '78', '124', '78', NULL, '10', '2512', '21227', 'Full-Time', 1, 1, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 1, 1, 67, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(58, NULL, NULL, NULL, NULL, 'Yasar University', '?zmir', 'Private', 2001, '1', '0', '10', '12', '45', '111', '48', '108', NULL, '16', '237', '9803', 'Full-Time', 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 67, 1, 0, 1, 1, 1, 0, 1, 1, 0, 0, 1, 1, 1, NULL, 0, 1, 0, NULL, 1, 1, 0, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(59, NULL, NULL, NULL, NULL, 'Yeditepe University', 'Istanbul', 'Private', 1996, '1', '0', '13', '54', '42', '312', '8', '178', NULL, '44', '688', '23224', 'Full-Time', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 127, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 0, NULL, 1, 1, 0, 1, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(60, NULL, NULL, NULL, NULL, 'Yeni Yuzyil University', 'Istanbul', 'Private', 2009, '1', '0', '25', '6', '60', '30', '59', '61', NULL, '2', '408', '8580', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 30, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, NULL, 0, 1, 1, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(61, NULL, NULL, NULL, NULL, 'Yuksek Ihtisas University', 'Ankara', 'Private', 2013, '1', '0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', '31', '1253', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, NULL, 0, 0, 1, NULL, 1, 1, 1, 0, NULL, '2021-05-16 09:44:29', '2021-05-16 09:44:29', NULL),
(72, 'upload/photos/2021/07/zEgLMLYHYEkFIpFbmH86_12_605fbc7cdecf774d408587af1edbe959_image.png', NULL, '', '', 'Beykoz University', 'Istanbul', 'Istanbul', 2016, '0', '1', '0', '6', '23', '14', '85', '34', NULL, '0', '77', '4059', 'Full-Time', 0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 2, 1, 0, 0, 1, 0, 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 1, 0, 0, 1, 1, 0, 1, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(74, NULL, NULL, NULL, NULL, 'Biruni University', 'Istanbul', 'Private', 2014, '0', '1', '7', '12', '44', '37', '105', '76', NULL, '7', '469', '9744', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, NULL, 1, NULL, NULL, 1, 1, 1, 1, 1, 15, 1, NULL, 1, 1, NULL, NULL, 1, NULL, 1, NULL, 1, 1, 1, NULL, NULL, 1, 1, NULL, 1, 1, 1, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(80, NULL, NULL, NULL, NULL, 'Istanbul Arel University', 'Istanbul', 'Private', 2007, '0', '1', '10', '7', '53', '84', '177', '145', NULL, '8', '468', '12354', 'Full-Time', 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, NULL, 1, NULL, NULL, 1, 1, 1, 1, 1, 48, 1, NULL, 1, 1, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(81, NULL, NULL, NULL, NULL, 'Istanbul Atlas University', 'Istanbul', 'Private', 2018, '0', '1', '14', '0', '28', '38', '20', '22', NULL, '0', 'N/A', 'N/A', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, NULL, 1, NULL, NULL, 1, 1, 1, 1, 1, 3, 1, 1, 1, 1, NULL, 1, 1, NULL, 1, NULL, 1, 1, 1, NULL, NULL, NULL, 1, NULL, 1, 1, 1, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(82, NULL, NULL, NULL, NULL, 'Istanbul Aydin University', 'Istanbul', 'Private', 2007, '0', '1', '8', '31', '110', '182', '302', '153', NULL, '20', '4778', '35151', 'Full-Time', 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 84, 1, 1, 1, 1, NULL, 1, 1, NULL, 1, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, 1, 1, 1, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(83, NULL, NULL, NULL, NULL, 'Istanbul Ayvansaray University', 'Istanbul', 'Private', 2016, '0', '1', '2', '10', '52', '11', '135', '42', NULL, '1', '206', 'N/A', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, NULL, 1, NULL, NULL, 1, 1, 1, NULL, 1, 15, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, 1, NULL, 1, 1, 1, NULL, 1, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(88, NULL, NULL, NULL, NULL, 'Istanbul Gelisim University', 'Istanbul', 'Private', 2011, '1', '0', '12', '0', '83', '125', '196', '149', NULL, '6', '1933', '28908', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, NULL, 1, NULL, NULL, 1, 1, 1, NULL, 1, 63, 1, NULL, 1, 1, NULL, NULL, 1, NULL, 1, NULL, 1, 1, 1, NULL, 1, 1, NULL, NULL, 1, 1, NULL, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(89, NULL, NULL, NULL, NULL, 'Istanbul Kent University', 'Istanbul', 'Private', 2016, '1', '0', '0', '2', '40', '25', '31', '43', NULL, '0', '63', '2903', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, NULL, 1, NULL, NULL, 1, 1, 1, NULL, 1, 7, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(90, NULL, NULL, NULL, NULL, 'Istanbul Kultur University', 'Istanbul', 'Private', 1997, '1', '0', '0', '0', '0', '0', '75', '106', NULL, '12', '1367', '15979', 'Full-Time', 1, 1, 1, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, NULL, 1, 67, 1, NULL, 1, 1, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(91, NULL, NULL, NULL, NULL, 'Istanbul Medipol University', 'Istanbul', 'Istanbul', 2009, '1', '0', '3', '3', '88', '141', '197', '157', NULL, '36', '2800', '33638', 'Full-Time', 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, 1, 68, 1, NULL, 1, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(92, NULL, NULL, NULL, NULL, 'Istanbul Okan University', 'Istanbul', 'Private', 1999, '1', '0', '7', '20', '76', '79', '93', '100', NULL, '18', '767', '17280', 'Full-Time', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 54, 1, NULL, 1, 1, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, NULL, 1, 1, 1, NULL, 1, 1, NULL, 1, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(93, NULL, NULL, NULL, NULL, 'Istanbul Rumeli University', 'Istanbul', 'Private', 2015, '1', '0', '13', '4', '24', '17', '94', '51', NULL, '0', '51', '3460', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, NULL, 1, NULL, NULL, 1, 1, 1, NULL, 1, 10, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, 1, NULL, 1, 1, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(94, NULL, NULL, NULL, NULL, 'Istanbul S.Zaim University', 'Istanbul', 'Private', 2010, '1', '0', '10', '10', '37', '20', '0', '102', NULL, '19', '1125', '11131', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, NULL, 1, 65, 1, NULL, 1, 1, NULL, NULL, 1, NULL, 1, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(96, NULL, NULL, NULL, NULL, 'Istanbul Commerce University', 'Istanbul', 'Private', 2001, '1', '0', '0', '0', '0', '0', '75', '106', NULL, '12', '764', '9372', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, NULL, 1, 67, 1, NULL, 1, 1, NULL, 1, 1, NULL, 1, NULL, 1, 1, 1, NULL, NULL, 1, 1, NULL, 1, 1, 1, 1, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(97, NULL, NULL, NULL, NULL, 'Istinye University', 'Istanbul', 'Private', 2015, '1', '0', '4', '4', '70', '13', '58', '93', NULL, '2', '779', '8172', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, NULL, 1, NULL, NULL, 1, 1, 1, 1, 1, 16, 1, NULL, 1, 1, NULL, 1, 1, NULL, 1, NULL, 1, 1, 1, NULL, NULL, 1, 1, NULL, 1, 1, 1, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(98, NULL, NULL, NULL, NULL, 'Izmir University of Economics', '?zmir', 'Private', 2001, '1', '0', '5', '6', '49', '49', '65', '93', NULL, '9', '263', '9441', 'Full-Time', 1, 1, 1, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 61, 1, NULL, 1, 1, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, 1, 1, NULL, 1, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(99, NULL, NULL, NULL, NULL, 'Izmir Tinaztepe University', '?zmir', 'Private', 2018, '1', '0', '0', '0', '13', '8', '10', '9', NULL, '0', '0', '0', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, NULL, 1, NULL, NULL, 1, 1, 1, 1, 1, 5, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, NULL, NULL, 1, 1, NULL, 1, 1, NULL, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(108, NULL, NULL, NULL, NULL, 'Near East University', 'N. Cyprus', 'Private', NULL, '1', '0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'N/A', 'Full-Time', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, 1, NULL, 1, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, 1, 1, 1, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(109, NULL, NULL, NULL, NULL, 'Nisantasi University', 'Istanbul', 'Private', 2009, '1', '0', '6', '17', '58', '186', '182', '118', NULL, '1', '1443', '20011', 'Full-Time', NULL, NULL, NULL, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, NULL, 1, NULL, NULL, 1, 1, 1, NULL, 1, 12, 1, NULL, 1, 1, NULL, 1, 1, NULL, 1, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, 1, 1, 1, NULL, NULL, '2021-06-21 11:56:03', '2021-06-21 11:56:03', NULL),
(110, 'upload/photos/2022/03/9cmSlTOgkYdfc6SdZWMs_24_bebb9a40edb950fc0aa6f6b1254fbf80_image.jpg', 'upload/photos/2022/03/ccIHbsmYvNJKzmKXQDzG_24_bebb9a40edb950fc0aa6f6b1254fbf80_image.jpg', '', 'Chibolya university', 'Chibolya university', 'Lusaka', 'State', 1997, 'english', 'turkish', '15', '54', '15', '9', '48', '8', NULL, '6', '56', '10', '56', 1, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 68, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 'chibolya_university');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `ip_address` varchar(150) NOT NULL DEFAULT '',
  `password` varchar(150) NOT NULL DEFAULT '',
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `gender` varchar(10) NOT NULL DEFAULT 'male',
  `email_code` varchar(150) NOT NULL DEFAULT '',
  `language` varchar(22) NOT NULL DEFAULT 'english',
  `avatar` varchar(100) NOT NULL DEFAULT 'upload/photos/d-avatar.jpg',
  `cover` varchar(100) NOT NULL DEFAULT 'upload/photos/d-cover.jpg',
  `country_id` int(11) NOT NULL DEFAULT '0',
  `about` text,
  `location` varchar(250) DEFAULT '',
  `website` varchar(250) DEFAULT '',
  `google` varchar(50) DEFAULT '',
  `facebook` varchar(50) DEFAULT '',
  `twitter` varchar(50) DEFAULT '',
  `instagram` varchar(100) DEFAULT '',
  `active` int(11) NOT NULL DEFAULT '0',
  `admin` int(11) NOT NULL DEFAULT '0',
  `access_level` int(11) NOT NULL DEFAULT '4',
  `verified` int(11) NOT NULL DEFAULT '0',
  `last_active` int(11) NOT NULL DEFAULT '0',
  `last_follow_id` int(10) UNSIGNED DEFAULT '0',
  `registered` varchar(40) NOT NULL DEFAULT '0000/00',
  `startup` int(10) UNSIGNED DEFAULT '0',
  `birth_date` varchar(20) DEFAULT '',
  `notification_on_application` int(10) UNSIGNED DEFAULT '1',
  `notification_on_visit_profile` int(10) UNSIGNED DEFAULT '1',
  `turn_on_email_notifications` int(10) UNSIGNED DEFAULT '1',
  `share_my_profile` int(10) UNSIGNED DEFAULT '1',
  `wallet` varchar(20) NOT NULL DEFAULT '0.00',
  `src` varchar(50) NOT NULL DEFAULT 'site',
  `last_location_update` varchar(30) NOT NULL DEFAULT '0',
  `lat` varchar(200) NOT NULL DEFAULT '0',
  `lng` varchar(200) NOT NULL DEFAULT '0',
  `two_factor` int(11) NOT NULL DEFAULT '0',
  `new_email` varchar(255) DEFAULT NULL,
  `two_factor_verified` int(11) NOT NULL DEFAULT '0',
  `new_phone` varchar(32) DEFAULT NULL,
  `phone_number` varchar(32) DEFAULT NULL,
  `user_upload_limit` varchar(150) DEFAULT NULL,
  `account_type` varchar(150) NOT NULL DEFAULT 'applicant',
  `is_pro` int(11) NOT NULL DEFAULT '0',
  `pro_time` varchar(100) DEFAULT NULL,
  `time` int(20) NOT NULL DEFAULT '0',
  `time_code_sent` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `ip_address`, `password`, `first_name`, `last_name`, `gender`, `email_code`, `language`, `avatar`, `cover`, `country_id`, `about`, `location`, `website`, `google`, `facebook`, `twitter`, `instagram`, `active`, `admin`, `access_level`, `verified`, `last_active`, `last_follow_id`, `registered`, `startup`, `birth_date`, `notification_on_application`, `notification_on_visit_profile`, `turn_on_email_notifications`, `share_my_profile`, `wallet`, `src`, `last_location_update`, `lat`, `lng`, `two_factor`, `new_email`, `two_factor_verified`, `new_phone`, `phone_number`, `user_upload_limit`, `account_type`, `is_pro`, `pro_time`, `time`, `time_code_sent`) VALUES
(2, 'root', 'cbmkboniface@gmail.com', '::1', '$2y$10$Cts1nSrcfuQ6pz/KbCGIu.EXYDRLTkNz0AtYDINfVXyXwgnElR3T.', 'BONIFACE', 'MWANZA', 'female', '0041', 'english', 'upload/photos/d-avatar.jpg', 'upload/photos/2020/10/MbujiUzuXVstjtVzNvXi_02_13fa8e67f213a2dc6422251197109062_image.jpg', 0, '', '', '', '', '', '', '', 1, 1, 1, 0, 1625487735, 0, '2020/8', 2, '', 1, 1, 1, 1, '113', 'site', '1626092538', '39.77667', '30.52056', 0, NULL, 0, NULL, NULL, '0', 'admin', 0, NULL, 0, '1648502756'),
(4, 'paul_jere939', 'pauljere@gmail.com', '::1', '$2y$10$ub8ZuKsxmESpe1tkS92yV.vZ6ImKLuI7TYUjOfJM3O38mfaT1pMOC', 'Paul', 'Jere', 'male', '6a03329353fb590efbca7b760d0f44cbf00fb3cc', 'turkish', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 1, 1, 0, 1636174007, 0, '2021/11', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'applicant', 0, NULL, 0, NULL),
(5, 'musa_mwanza426', 'asdaf@yahoo.com', '::1', '$2y$10$BI0sFJDqothtRSWBjmy/SuqLoSbKP/Aqd/rWDWODrn2vko9WMDrwe', 'Musa', 'Mwanza', 'male', '6d616ca916b6d759ae1c7697862a9262eb22b34b', 'turkish', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 0, 4, 0, 1636174137, 0, '2021/11', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'applicant', 0, NULL, 0, NULL),
(6, 'mehmet_durmaz752', 'mehmed@gmail.com', '::1', '$2y$10$5TD.cjAZyDM9CHPAxemXPO5WmaeZtXasSbhaF.oH0ym/NPlshbM46', 'Mehmet', 'Durmaz', 'male', '39c7d17ba3bbe8f549340a432c20ee4cb69bbb3d', 'turkish', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 1, 3, 0, 1636284445, 0, '2021/11', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'applicant', 0, NULL, 0, NULL),
(7, 'debagge_test966', 'debtest@gmail.com', '::1', '$2y$10$0eKjaNmt2qIZPMxrdWagX.efg4N7adCyZAuXmzcmemM4YVmH/EMMi', 'Debagge', 'TEst', 'male', '2645361158a9f04673456bdc2f7c055079be04df', 'turkish', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 1, 1, 0, 1636446549, 0, '2021/11', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'applicant', 0, NULL, 0, NULL),
(8, 'damla_nur826', 'damla@globalacademia.com', '159.146.40.232', '$2y$10$wd4zd6Yq9km/1fO03QcYueh4FbrNGo/5Quwd.gpjENDMN8XMEnrqC', 'Damla', 'Nur', 'male', '453546e313559872d5c1e8392fc85298e6549a55', 'turkish', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 1, 3, 0, 1637659901, 0, '2021/11', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'applicant', 0, NULL, 0, NULL),
(9, 'asd_xU6n_asd', 'root@asdf.com', '::1', '$2y$10$wd4zd6Yq9km/1fO03QcYueh4FbrNGo/5Quwd.gpjENDMN8XMEnrqC', '', '', 'male', '69f5f980790a5eb2272d77db3b5c9accda115687', 'english', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 0, 4, 0, 1646008243, 0, '2022/2', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'applicant', 0, NULL, 0, NULL),
(10, 'Kom_c3gb_Meh', 'komisyoncu@km.com', '::1', '$2y$10$QwA5nWg/.pUOiibdiRpcU..0Hfj/qj2COypxq2q7k28YTXWO/Zf76', 'Komisyoncu', 'Mulahi', 'male', '904b793fa32b154249e9f901225612e59d65e12d', 'english', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 0, 4, 0, 1646294386, 0, '2022/3', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'agent', 0, NULL, 0, NULL),
(11, 'Tel_9So1_Mwa', 'telo@masda.com', '::1', '$2y$10$sAQQLo3gwaQZDMkLQy7yhOx0xV2QxzHeXikEE6k.Jaz0OE5wLKjh2', 'Teloas', 'Mwanza', 'male', '8c2eef7dcb284088994d00225bc7417d2dc37673', 'turkish', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 0, 4, 0, 1646578312, 0, '2022/3', 0, '', 1, 1, 1, 0, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'applicant', 0, NULL, 0, NULL),
(12, 'Cos_1cDo_Age', 'comsicagency@gmail.com', '::1', '$2y$10$cjR/dfGvaWGNwpJanBl/Ju8KZcHlOt3mhhpeOt7fRMs.fmXLNRNw2', 'Cosmic', 'Agency', 'male', '98add4a26365b475797845ecbfb8427eb7bdf081', 'english', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 0, 0, 0, 0, 1648314041, 0, '2022/3', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'agent', 0, NULL, 0, NULL),
(13, 'Cos_QqbM_Age', 'comsicagenc@gmail.com', '::1', '$2y$10$mxedI4ZJ0V.9lg.DEeontehKbVAJlozf34L55oMcfdw32mJYYQULy', 'Cosmi', 'Agenc', 'male', '31deed68434d434b62ca969e2cfe44bac3d89538', 'english', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 0, 0, 0, 0, 1648314146, 0, '2022/3', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'agent', 0, NULL, 0, NULL),
(14, 'Luc_EXp7_Stu', 'lucrativestudy@gmail.com', '::1', '$2y$10$Jnv6CndbWvzfVDd08UPch.IAz79OgT1rC0HEjnyn1IxoW5ki7ptxa', 'Lucrative', 'Study', 'male', 'e4a00ded0de8ee2b5b31e396898e18ef428b4d0c', 'english', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 0, 0, 0, 0, 1648315045, 0, '2022/3', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'agent', 0, NULL, 0, NULL),
(15, 'Jon_9rIu_Dee', 'jonnydeep@gmail.com', '::1', '$2y$10$FaS7VaW3U2QpWtDHIo1VL.n4LgGbbwST46ZI2rtZnQBgVEao.qZXa', 'Jonny', 'Deep', 'male', 'fd429c4759f3d23fe6215d55390c5eeabda39d52', 'english', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 0, 0, 0, 1648315437, 0, '2022/3', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'applicant', 0, NULL, 0, NULL),
(16, 'ayse_gul365', 'ayse.gur@global.com', '::1', '$2y$10$hZhpc3RuwHb2F9fKNm6VveUmlfTj/7nEDG/WNKltACR5OBvl43/Rq', 'Ayse', 'Gul', 'male', '4283', 'turkish', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 1, 3, 0, 1648322225, 0, '2022/3', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'worker', 0, NULL, 0, '1648506262'),
(17, 'canan_gamze998', 'canangamze@gmail.com', '::1', '$2y$10$u0YwQkiQk.q/o9MCvmB2oejg4w7Ze1ixsNADJI3TIGNucwVholtHi', 'Canan', 'Gamze', 'male', '24a2e0687e0015aa84d1cc445e738e45e3bef64c', 'turkish', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 1, 3, 0, 1648322444, 0, '2022/3', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'worker', 0, NULL, 0, NULL),
(18, 'husnu_coban065', 'hunsucoban@globalacademia.com', '::1', '$2y$10$zrTj7aNJA41/PQw1O.otRuoleXpBv2Sz2R2zf1xd0EZW1oxdu5iIi', 'Husnu', 'Coban', 'male', '68f6267ac9bed349a66600f7f4e77a9f844dd4a3', 'turkish', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 1, 3, 0, 1648322603, 0, '2022/3', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'worker', 0, NULL, 0, NULL),
(19, 'atlar_patlar344', 'atlarptlar@globaacademia.com', '::1', '$2y$10$e.lX5pDlVT6gU4U3EnuuVe7uK3XetHQ93AFEvHkGHMZ54rcT74LNq', 'Atlar', 'Patlar', 'male', 'e86730d8004ae2e538c11215e892082dee135950', 'turkish', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 1, 3, 0, 1648322663, 0, '2022/3', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'worker', 0, NULL, 0, NULL),
(20, 'Bry_N8cJ_Muc', 'brycordmuchindu@gmail.com', '::1', '$2y$10$IK6PhA6cWdqaPJemlGa9G.sylljkChwRjFvZ.qxd1CsuB3ARajB.q', 'Brycord', 'Muchindu', 'male', '991acb687461c780646e834f3db18e003a79c2ee', 'english', 'upload/photos/d-avatar.jpg', 'upload/photos/d-cover.jpg', 0, NULL, '', '', '', '', '', '', 1, 0, 0, 0, 1648325218, 0, '2022/3', 0, '', 1, 1, 1, 1, '0.00', 'site', '0', '0', '0', 0, NULL, 0, NULL, NULL, NULL, 'applicant', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int(11) NOT NULL,
  `notifier_id` int(11) NOT NULL DEFAULT '0',
  `recipient_id` int(11) NOT NULL DEFAULT '0',
  `application_no` varchar(25) DEFAULT NULL,
  `replay_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT '',
  `text` text,
  `url` varchar(3000) NOT NULL DEFAULT '',
  `seen` varchar(50) NOT NULL DEFAULT '0',
  `time` varchar(50) NOT NULL DEFAULT '0',
  `sent_push` int(11) NOT NULL DEFAULT '0',
  `target` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `notifier_id`, `recipient_id`, `application_no`, `replay_id`, `type`, `text`, `url`, `seen`, `time`, `sent_push`, `target`) VALUES
(1, 0, 10, '2664', 0, 'application_status', 'Your application atAltinbas University in CHILD DEVELOPMENT status changed to Accepted', '/admin-cp/view-application?id=', '0', '1648402577', 0, 'all');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_invitations`
--
ALTER TABLE `admin_invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`(255));

--
-- Indexes for table `agent_requests`
--
ALTER TABLE `agent_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_students`
--
ALTER TABLE `agent_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `announcement_views`
--
ALTER TABLE `announcement_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `announcement_id` (`announcement_id`);

--
-- Indexes for table `applicant_chat`
--
ALTER TABLE `applicant_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicant_education_info`
--
ALTER TABLE `applicant_education_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `id` (`id`,`user_id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`);

--
-- Indexes for table `applican_universities`
--
ALTER TABLE `applican_universities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps_sessions`
--
ALTER TABLE `apps_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `platform` (`platform`);

--
-- Indexes for table `bank_receipts`
--
ALTER TABLE `bank_receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banned`
--
ALTER TABLE `banned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `value` (`value`(191));

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `last_trend_time` (`last_trend_time`),
  ADD KEY `trend_use_num` (`trend_use_num`),
  ADD KEY `tag` (`tag`(191)),
  ADD KEY `expire` (`expire`);

--
-- Indexes for table `html_emails`
--
ALTER TABLE `html_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `invitation_links`
--
ALTER TABLE `invitation_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `invited_id` (`invited_id`),
  ADD KEY `code` (`code`),
  ADD KEY `time` (`time`);

--
-- Indexes for table `langs`
--
ALTER TABLE `langs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_key` (`lang_key`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipient_id` (`recipient_id`),
  ADD KEY `type` (`type`),
  ADD KEY `seen` (`seen`),
  ADD KEY `notifier_id` (`notifier_id`),
  ADD KEY `time` (`time`),
  ADD KEY `question_id` (`application_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `seen` (`seen`),
  ADD KEY `question_id` (`question_id`) USING BTREE;

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `platform` (`platform`),
  ADD KEY `time` (`time`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`),
  ADD KEY `password` (`password`),
  ADD KEY `last_active` (`last_active`),
  ADD KEY `admin` (`admin`),
  ADD KEY `active` (`active`),
  ADD KEY `registered` (`registered`),
  ADD KEY `ip_address` (`ip_address`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `verified` (`verified`),
  ADD KEY `lat` (`lat`(191)),
  ADD KEY `lng` (`lng`(191));

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipient_id` (`recipient_id`),
  ADD KEY `type` (`type`),
  ADD KEY `seen` (`seen`),
  ADD KEY `notifier_id` (`notifier_id`),
  ADD KEY `time` (`time`),
  ADD KEY `application_no` (`application_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_invitations`
--
ALTER TABLE `admin_invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_requests`
--
ALTER TABLE `agent_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `agent_students`
--
ALTER TABLE `agent_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_views`
--
ALTER TABLE `announcement_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applicant_chat`
--
ALTER TABLE `applicant_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `applicant_education_info`
--
ALTER TABLE `applicant_education_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applican_universities`
--
ALTER TABLE `applican_universities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apps_sessions`
--
ALTER TABLE `apps_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_receipts`
--
ALTER TABLE `bank_receipts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banned`
--
ALTER TABLE `banned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hashtags`
--
ALTER TABLE `hashtags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `html_emails`
--
ALTER TABLE `html_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invitation_links`
--
ALTER TABLE `invitation_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `langs`
--
ALTER TABLE `langs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
