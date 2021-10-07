-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2021 at 08:49 AM
-- Server version: 10.3.25-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urssbd_firstfit`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `phone`, `address`, `member_id`, `extra2`, `extra3`, `extra4`, `created_at`, `updated_at`) VALUES
(1, 'Test Member', 'testMember@firstfit.com', '$2y$10$Z3JvTncInWr8njBhpJS8G.y4b3RebbzW5UidbsJlm52c1KTbnfuSm', '0152121133', '498 Middle Azampur', '1', NULL, NULL, NULL, '2021-09-14 12:15:08', '2021-09-14 12:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `customer_invoices`
--

CREATE TABLE `customer_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_invoice_products`
--

CREATE TABLE `customer_invoice_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `collection_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `manipulations` text COLLATE utf8_unicode_ci NOT NULL,
  `custom_properties` text COLLATE utf8_unicode_ci NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_details`
--

CREATE TABLE `member_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proof_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_details`
--

INSERT INTO `member_details` (`id`, `member_id`, `image`, `proof_image`, `created_at`, `updated_at`) VALUES
(0, 1, NULL, NULL, '2021-09-14 12:15:08', '2021-09-14 12:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2018_03_07_055231_create_media_table', 1),
('2018_03_07_055231_create_mst_enquiries_table', 1),
('2018_03_07_055231_create_mst_expenses_categories_table', 1),
('2018_03_07_055231_create_mst_members_table', 1),
('2018_03_07_055231_create_mst_plans_table', 1),
('2018_03_07_055231_create_mst_services_table', 1),
('2018_03_07_055231_create_mst_sms_events_table', 1),
('2018_03_07_055231_create_mst_sms_triggers_table', 1),
('2018_03_07_055231_create_mst_users_table', 1),
('2018_03_07_055231_create_permission_role_table', 1),
('2018_03_07_055231_create_permissions_table', 1),
('2018_03_07_055231_create_role_user_table', 1),
('2018_03_07_055231_create_roles_table', 1),
('2018_03_07_055231_create_trn_access_log_table', 1),
('2018_03_07_055231_create_trn_cheque_details_table', 1),
('2018_03_07_055231_create_trn_enquiry_followups_table', 1),
('2018_03_07_055231_create_trn_expenses_table', 1),
('2018_03_07_055231_create_trn_invoice_details_table', 1),
('2018_03_07_055231_create_trn_invoice_table', 1),
('2018_03_07_055231_create_trn_payment_details_table', 1),
('2018_03_07_055231_create_trn_settings_table', 1),
('2018_03_07_055231_create_trn_sms_log_table', 1),
('2018_03_07_055231_create_trn_subscriptions_table', 1),
('2018_03_07_055232_add_foreign_keys_to_mst_enquiries_table', 1),
('2018_03_07_055232_add_foreign_keys_to_mst_expenses_categories_table', 1),
('2018_03_07_055232_add_foreign_keys_to_mst_members_table', 1),
('2018_03_07_055232_add_foreign_keys_to_mst_plans_table', 1),
('2018_03_07_055232_add_foreign_keys_to_mst_services_table', 1),
('2018_03_07_055232_add_foreign_keys_to_mst_sms_events_table', 1),
('2018_03_07_055232_add_foreign_keys_to_permission_role_table', 1),
('2018_03_07_055232_add_foreign_keys_to_role_user_table', 1),
('2018_03_07_055232_add_foreign_keys_to_trn_access_log_table', 1),
('2018_03_07_055232_add_foreign_keys_to_trn_cheque_details_table', 1),
('2018_03_07_055232_add_foreign_keys_to_trn_enquiry_followups_table', 1),
('2018_03_07_055232_add_foreign_keys_to_trn_expenses_table', 1),
('2018_03_07_055232_add_foreign_keys_to_trn_invoice_details_table', 1),
('2018_03_07_055232_add_foreign_keys_to_trn_invoice_table', 1),
('2018_03_07_055232_add_foreign_keys_to_trn_payment_details_table', 1),
('2018_03_07_055232_add_foreign_keys_to_trn_subscriptions_table', 1),
('2020_12_17_215441_create_usersDetails_table', 1),
('2020_12_18_001934_create_member_details_table', 1),
('2020_12_18_232712_create_websites_table', 1),
('2020_12_19_020545_create_trainers_table', 1),
('2020_12_19_195106_create_plan__services_table', 1),
('2020_12_20_032918_create_news_letters_table', 1),
('2020_12_21_020526_create_plan_on_sales_table', 1),
('2021_08_09_205534_website_enquiry', 2),
('2021_08_10_121001_create_customers_table', 3),
('2021_08_11_202023_categories', 4),
('2021_08_11_202128_products', 4),
('2021_08_14_024754_create_shop_invoices_table', 5),
('2021_08_14_024811_create_shop_invoice_items_table', 5),
('2021_08_14_191314_create_working_schedules_table', 6),
('2021_08_15_014310_create_customer_invoices_table', 7),
('2021_08_15_014329_create_customer_invoice_products_table', 7),
('2021_08_20_233726_create_pos_invoices_table', 8),
('2021_08_20_233755_create_pos_invoice_products_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `mst_enquiries`
--

CREATE TABLE `mst_enquiries` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Unique record ID',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DOB` date NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = Lost , 1 = Lead  , 2 =Member',
  `contact` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pin_code` int(11) NOT NULL,
  `occupation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `start_by` date NOT NULL,
  `interested_in` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `aim` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_expenses_categories`
--

CREATE TABLE `mst_expenses_categories` (
  `id` int(11) NOT NULL COMMENT 'Unique Record Id for system',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'category name',
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_members`
--

CREATE TABLE `mst_members` (
  `id` int(11) NOT NULL COMMENT 'Unique Record Id for system',
  `member_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Unique member id for reference',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'member''s name',
  `photo` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'member''s photo',
  `DOB` date NOT NULL COMMENT 'member''s date of birth',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'member''s email id',
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'member''s address',
  `status` tinyint(1) NOT NULL COMMENT '0 for inactive , 1 for active',
  `proof_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'name of the proof provided by member',
  `proof_photo` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'photo of the proof',
  `gender` char(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'member''s gender',
  `contact` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'member''s contact number',
  `emergency_contact` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `health_issues` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pin_code` int(11) NOT NULL,
  `occupation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `aim` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mst_members`
--

INSERT INTO `mst_members` (`id`, `member_code`, `name`, `photo`, `DOB`, `email`, `address`, `status`, `proof_name`, `proof_photo`, `gender`, `contact`, `emergency_contact`, `health_issues`, `pin_code`, `occupation`, `aim`, `source`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'MP2', 'Test Member', '', '1997-12-27', 'testMember@firstfit.com', '498 Middle Azampur', 1, 'testm1', '', 'm', '0152121133', '0173015986', 'none', 1230, '0', '0', '0', '2021-09-13 18:00:00', '2021-09-13 18:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_plans`
--

CREATE TABLE `mst_plans` (
  `id` int(11) NOT NULL COMMENT 'Unique Record Id for system',
  `plan_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Unique plan id for reference',
  `plan_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'name of the plan',
  `plan_details` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'plan details',
  `days` int(11) NOT NULL COMMENT 'duration of the plans in days',
  `amount` int(11) NOT NULL COMMENT 'amount to charge for the plan',
  `status` tinyint(1) NOT NULL COMMENT '0 for inactive , 1 for active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mst_plans`
--

INSERT INTO `mst_plans` (`id`, `plan_code`, `plan_name`, `plan_details`, `days`, `amount`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'plan1', 'Regular Plan', 'details', 30, 500, 1, '2021-08-14 17:27:45', '2021-08-14 17:27:45', 1, 1),
(2, 'plan2', 'Summer Plan', 'Summer plan details', 30, 1500, 1, '2021-08-18 18:48:21', '2021-08-18 18:48:21', 1, 1),
(3, 'plan3', 'Semi Long Plan', 'Plan for a couple of month.', 60, 1400, 1, '2021-09-14 13:11:15', '2021-09-14 13:11:15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_services`
--

CREATE TABLE `mst_services` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `service_thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_sms_events`
--

CREATE TABLE `mst_sms_events` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `send_to` int(11) NOT NULL COMMENT '0 = active members , 1 = inactive members , 2= lead enquiries , 3 = lost enquiries',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_sms_triggers`
--

CREATE TABLE `mst_sms_triggers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mst_sms_triggers`
--

INSERT INTO `mst_sms_triggers` (`id`, `name`, `alias`, `message`, `status`, `updated_at`) VALUES
(1, 'Member admission (Paid)', 'member_admission_with_paid_invoice', 'Hi %s , Welcome to %s . Your payment of Usd %u against your invoice no. %s has been received. Thank you and we hope to see you in action soon. Good day!', 0, '2021-08-09 19:50:23'),
(2, 'Member admission (Partial)', 'member_admission_with_partial_invoice', 'Hi %s , Welcome to %s . Your payment of Usd %u against your invoice no. %s has been received. Outstanding payment to be cleared is Usd %u .Thank you!', 0, '2021-08-09 19:50:23'),
(3, 'Member admission (Unpaid)', 'member_admission_with_unpaid_invoice', 'Hi %s , Welcome to %s . Your payment of Usd %u is pending against your invoice no. %s . Thank you!', 0, '2021-08-09 19:50:23'),
(4, 'Enquiry placement', 'enquiry_placement', 'Hi %s , Thank you for your enquiry with %s . We would love to hear from you soon. Good day!', 0, '2021-08-09 19:50:23'),
(5, 'Followup', 'followup', 'Hi %s , This is regarding the inquiry you placed at %s . Let us know by when would you like to get started? Good day!', 0, '2021-08-09 19:50:23'),
(6, 'Subscription renewal (Paid)', 'subscription_renewal_with_paid_invoice', 'Hi %s , Your subscription has been renewed successfully. Your payment of Usd %u against your invoice no. %s  has been received. Thank you!', 0, '2021-08-09 19:50:23'),
(7, 'Subscription renewal (Partial)', 'subscription_renewal_with_partial_invoice', 'Hi %s , Your subscription has been renewed successfully. Your payment of Usd %u against your invoice no. %s has been received. Outstanding payment to be cleared is Usd %u . Thank you!', 0, '2021-08-09 19:50:23'),
(8, 'Subscription renewal (Unpaid)', 'subscription_renewal_with_unpaid_invoice', 'Hi %s , Your subscription has been renewed successfully. Your payment of Usd %u is pending against your invoice no. %s . Thank you!', 0, '2021-08-09 19:50:23'),
(9, 'Subscription expiring', 'subscription_expiring', 'Hi %s ,  Last few days to renew your gym subscription. Kindly renew it before %s . Thank you!', 0, '2021-08-09 19:50:23'),
(10, 'Subscription expired', 'subscription_expired', 'Hi %s , Your gym subscription has been expired on %s . Kindly renew it soon!', 0, '2021-08-09 19:50:23'),
(11, 'Payment recieved', 'payment_recieved', 'Hi %s , Your payment of Usd %u  has been received against your invoice no. %s . Thank you!', 0, '2021-08-09 19:50:23'),
(12, 'Pending invoice', 'pending_invoice', 'Hi %s , Your payment of Usd %u is still pending against your invoice no. %s . Kindly clear it soon!', 0, '2021-08-09 19:50:23'),
(13, 'Expense alertexpense_alert', 'expense_alert', 'Hi , You have an expense lined up for%s of Usd %u on %s . Thank you!', 0, '2021-08-09 19:50:23'),
(14, 'Member birthday wishes', 'member_birthday', 'Hi %s , Team %s wishes you a very Happy birthday :) Enjoy your day!Payment with cheque', 0, '2021-08-09 19:50:23'),
(15, 'Payment with cheque', 'payment_with_cheque', 'Hi %s , your cheque of Usd %u with cheque no. %u has been recieved against your invoice no. %s . Regards %s .', 0, '2021-08-09 19:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `mst_users`
--

CREATE TABLE `mst_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mst_users`
--

INSERT INTO `mst_users` (`id`, `name`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$BjY/wS.6um3L.QbG/k6CZuyvCirfRljg0sHWUSP1DY/l71alCo7y.', 1, 'qtfxGlZaIlJwAbR4yh3bzEzh1vWLhcZFrRAAKVc18T2Agh8o5MVLKWbdMZy5', '2021-08-09 13:50:24', '2021-09-14 12:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

CREATE TABLE `news_letters` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `group_key`, `created_at`, `updated_at`) VALUES
(1, 'manage-gymie', 'Manage Gymie', '', 'Global', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(2, 'view-dashboard-quick-stats', 'View quick stats on dashboard', '', 'Dashboard', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(3, 'view-dashboard-charts', 'View charts on dashboard', '', 'Dashboard', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(4, 'view-dashboard-members-tab', 'View members tab on dashboard', '', 'Dashboard', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(5, 'view-dashboard-enquiries-tab', 'View enquiries tab on dashboard', '', 'Dashboard', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(6, 'add-member', 'Add member', '', 'Members', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(7, 'view-member', 'View member details', '', 'Members', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(8, 'edit-member', 'Edit member details', '', 'Members', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(9, 'delete-member', 'Delete member', '', 'Members', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(10, 'add-plan', 'Add plans', '', 'Plans', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(11, 'view-plan', 'View plan details', '', 'Plans', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(12, 'edit-plan', 'Edit plan details', '', 'Plans', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(13, 'delete-plan', 'Delete plans', '', 'Plans', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(14, 'add-subscription', 'Add subscription', '', 'Subscriptions', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(15, 'edit-subscription', 'Edit subscription details', '', 'Subscriptions', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(16, 'renew-subscription', 'Renew subscription', '', 'Subscriptions', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(17, 'view-invoice', 'View invoice', '', 'Invoices', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(18, 'add-payment', 'Add payments', '', 'Payments', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(19, 'view-subscription', 'View subscription details', '', 'Subscriptions', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(20, 'view-payment', 'View payment details', '', 'Payments', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(21, 'edit-payment', 'Edit payment details', '', 'Payments', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(22, 'manage-members', 'Manage members', '', 'Members', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(23, 'manage-plans', 'Manage plans', '', 'Plans', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(24, 'manage-subscriptions', 'Manage subscriptions', '', 'Subscriptions', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(25, 'manage-invoices', 'Manage invoices', '', 'Invoices', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(26, 'manage-payments', 'Manage payments', '', 'Payments', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(27, 'manage-users', 'Manage users', '', 'Users', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(28, 'add-enquiry', 'Add enquiry', '', 'Enquiries', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(29, 'view-enquiry', 'View enquiry details', '', 'Enquiries', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(30, 'edit-enquiry', 'Edit enquiry details', '', 'Enquiries', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(31, 'add-enquiry-followup', 'Add enquiry followup', '', 'Enquiries', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(32, 'edit-enquiry-followup', 'Edit enquiry followup', '', 'Enquiries', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(33, 'transfer-enquiry', 'Transfer enquiry', '', 'Enquiries', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(34, 'manage-enquiries', 'Manage enquiries', '', 'Enquiries', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(35, 'add-expense', 'Add expense', '', 'Expenses', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(36, 'view-expense', 'View expense details', '', 'Expenses', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(37, 'edit-expense', 'Edit expense details', '', 'Expenses', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(38, 'manage-expenses', 'Manage expenses', '', 'Expenses', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(39, 'add-expenseCategory', 'Add expense category', '', 'Expense Categories', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(40, 'view-expenseCategory', 'View expense categories', '', 'Expense Categories', '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(41, 'edit-expenseCategory', 'Edit expense category details', '', 'Expense Categories', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(42, 'delete-expenseCategory', 'Delete expense category', '', 'Expense Categories', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(43, 'manage-expenseCategories', 'Manage expense categories', '', 'Expense Categories', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(44, 'manage-settings', 'Manage settings', '', 'Global', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(45, 'cancel-subscription', 'Cancel subscription', '', 'Subscriptions', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(46, 'manage-services', 'Manage services', '', 'Services', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(47, 'add-service', 'Add services', '', 'Services', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(48, 'edit-service', 'Edit service details', '', 'Services', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(49, 'view-service', 'View service details', '', 'Services', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(50, 'manage-sms', 'Manage SMS', '', 'SMS', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(51, 'pagehead-stats', 'View pagehead counts', '', 'Global', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(52, 'view-dashboard-expense-tab', 'View expenses tab on dashboard', '', 'Dashboard', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(53, 'print-invoice', 'Print invoices', '', 'Invoices', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(54, 'delete-invoice', 'Delete invoices', '', 'Invoices', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(55, 'delete-subscription', 'Delete subscriptions', '', 'Subscriptions', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(56, 'delete-payment', 'Delete payment transactions', '', 'Payments', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(57, 'delete-expense', 'Delete expense details', '', 'Expenses', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(58, 'delete-service', 'Delete Service details', '', 'Services', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(59, 'add-discount', 'Add discount on a invoice', '', 'Invoices', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(60, 'change-subscription', 'Upgrade or downgrade a subscription', '', 'Subscriptions', '2021-08-09 13:50:24', '2021-08-09 13:50:24'),
(61, 'manage-pos', 'Manage POS', '', 'POS', '2021-08-21 15:56:48', '2021-08-21 15:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(36, 3),
(40, 3),
(45, 3),
(54, 3),
(55, 3),
(56, 3);

-- --------------------------------------------------------

--
-- Table structure for table `plan_on_sales`
--

CREATE TABLE `plan_on_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL COMMENT 'this is the foreign key of from plan table',
  `amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `month` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'this is the months in word for the plan ',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plan_on_sales`
--

INSERT INTO `plan_on_sales` (`id`, `plan_id`, `amount`, `discount`, `month`, `created_at`, `updated_at`) VALUES
(1, 1, 500, 50, '6 month', '2021-08-18 18:46:51', '2021-08-18 18:46:51'),
(2, 2, 1500, 1200, '12 month', '2021-08-18 18:48:38', '2021-08-18 18:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `plan__services`
--

CREATE TABLE `plan__services` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_invoices`
--

CREATE TABLE `pos_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sold_by` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid` int(11) NOT NULL,
  `change_amount` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_invoice_products`
--

CREATE TABLE `pos_invoice_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'product.png',
  `purchase_price` double(8,2) NOT NULL,
  `sale_price` double(8,2) NOT NULL,
  `min_stock` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `discount_price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(2, 'Gymie', NULL, NULL, '2021-08-09 13:50:23', '2021-08-09 13:50:23'),
(3, 'Manager', NULL, NULL, '2021-08-09 13:50:23', '2021-08-09 13:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_invoices`
--

CREATE TABLE `shop_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  `tax_amount` int(11) DEFAULT NULL,
  `checked` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `sold_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_invoice_items`
--

CREATE TABLE `shop_invoice_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trn_access_log`
--

CREATE TABLE `trn_access_log` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `action` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `record` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trn_cheque_details`
--

CREATE TABLE `trn_cheque_details` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = recieved , 1 = deposited , 2 = cleared , 3 = bounced',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trn_enquiry_followups`
--

CREATE TABLE `trn_enquiry_followups` (
  `id` int(10) UNSIGNED NOT NULL,
  `enquiry_id` int(10) UNSIGNED NOT NULL,
  `followup_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `outcome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = Pending , 1 = Done',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trn_expenses`
--

CREATE TABLE `trn_expenses` (
  `id` int(11) NOT NULL COMMENT 'Unique Record Id for system',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'name of the expense',
  `category_id` int(11) NOT NULL COMMENT 'name of the category of expense',
  `amount` int(11) NOT NULL COMMENT 'expense amount',
  `due_date` date NOT NULL COMMENT 'Due Date for the expense created',
  `repeat` tinyint(1) NOT NULL COMMENT '0 = never repeat , 1 = every day , 2 = every week , 3 = every month , 4 = every year',
  `paid` tinyint(1) NOT NULL COMMENT '0 = false , 1 = true i.e. paid',
  `note` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trn_invoice`
--

CREATE TABLE `trn_invoice` (
  `id` int(11) NOT NULL COMMENT 'Unique Record Id for system',
  `member_id` int(11) NOT NULL COMMENT 'links to unique record id of mst_members',
  `total` int(11) NOT NULL COMMENT 'total fees/amount generated',
  `pending_amount` int(11) NOT NULL COMMENT 'pending amount',
  `note` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'note regarding payments',
  `status` tinyint(1) NOT NULL COMMENT '0 = Unpaid, 1 = Paid,  2 = Partial 3 = overpaid',
  `invoice_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'number of the inovice/reciept',
  `discount_percent` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `discount_amount` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `discount_note` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `tax` int(11) NOT NULL,
  `additional_fees` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trn_invoice`
--

INSERT INTO `trn_invoice` (`id`, `member_id`, `total`, `pending_amount`, `note`, `status`, `invoice_number`, `discount_percent`, `discount_amount`, `discount_note`, `created_at`, `updated_at`, `created_by`, `updated_by`, `tax`, `additional_fees`) VALUES
(1, 1, 550, 0, ' ', 1, 'IP5', '0', '0', '', '2021-09-13 18:00:00', '2021-09-13 18:00:00', 1, 1, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trn_invoice_details`
--

CREATE TABLE `trn_invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL COMMENT 'links to unique record id of trn_invoice',
  `item_amount` int(11) NOT NULL COMMENT 'amount of the items',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `plan_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trn_invoice_details`
--

INSERT INTO `trn_invoice_details` (`id`, `invoice_id`, `item_amount`, `created_at`, `updated_at`, `created_by`, `updated_by`, `plan_id`) VALUES
(1, 1, 500, '2021-09-13 18:00:00', '2021-09-13 18:00:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trn_payment_details`
--

CREATE TABLE `trn_payment_details` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL COMMENT 'links to unique record id of trn_invoice',
  `payment_amount` int(11) NOT NULL COMMENT 'amount of transaction being done',
  `mode` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '1 = Cash , 0 = Cheque',
  `note` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'misc. note',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trn_payment_details`
--

INSERT INTO `trn_payment_details` (`id`, `invoice_id`, `payment_amount`, `mode`, `note`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 550, '1', ' ', '2021-09-13 18:00:00', '2021-09-13 18:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trn_settings`
--

CREATE TABLE `trn_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trn_settings`
--

INSERT INTO `trn_settings` (`id`, `key`, `value`, `updated_at`) VALUES
(1, 'financial_start', '', '2021-08-09 19:50:23'),
(2, 'financial_end', '', '2021-08-09 19:50:23'),
(3, 'gym_email', 'jambasangsanggym@gmail.gm', '2021-08-09 19:50:23'),
(4, 'gym_logo', '', '2021-08-09 19:50:23'),
(5, 'gym_name', 'Company Name', '2021-08-09 19:50:23'),
(6, 'gym_address_1', '', '2021-08-09 19:50:23'),
(7, 'gym_address_2', '', '2021-08-09 19:50:23'),
(8, 'invoice_prefix', 'IP', '2021-08-09 19:50:23'),
(9, 'invoice_last_number', '5', '2021-09-14 18:15:08'),
(10, 'invoice_name_type', 'gym_name', '2021-08-09 19:50:23'),
(11, 'invoice_number_mode', '1', '2021-08-09 19:50:23'),
(12, 'member_prefix', 'MP', '2021-08-09 19:50:23'),
(13, 'member_last_number', '2', '2021-09-14 18:15:08'),
(14, 'member_number_mode', '1', '2021-08-09 19:50:23'),
(15, 'last_membership_check', '', '2021-08-09 19:50:23'),
(16, 'admission_fee', '0', '2021-08-09 19:50:23'),
(17, 'taxes', '10', '2021-08-09 19:50:23'),
(18, 'sms_api_key', '', '2021-08-09 19:50:23'),
(19, 'sms_sender_id', '', '2021-08-09 19:50:23'),
(20, 'sms', '0', '2021-08-09 19:50:23'),
(21, 'primary_contact', '081290348080', '2021-08-09 19:50:23'),
(22, 'discounts', '5,10,15,20,25', '2021-08-09 19:50:23'),
(23, 'sms_balance', '0', '2021-08-09 19:50:23'),
(24, 'sms_request', '0', '2021-08-09 19:50:23'),
(25, 'sender_id_list', '', '2021-08-09 19:50:23'),
(26, 'theme_color', '#263238', '2021-08-09 19:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `trn_sms_log`
--

CREATE TABLE `trn_sms_log` (
  `id` int(11) NOT NULL,
  `number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `shoot_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NA',
  `send_time` datetime NOT NULL,
  `sender_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trn_subscriptions`
--

CREATE TABLE `trn_subscriptions` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL COMMENT 'links to unique record id of mst_members',
  `invoice_id` int(11) NOT NULL COMMENT 'links to unique record id of trn_invoice',
  `plan_id` int(11) NOT NULL COMMENT 'links to unique record if of mst_plans',
  `start_date` date NOT NULL COMMENT 'start date of subscription',
  `end_date` date NOT NULL COMMENT 'end date of subscription',
  `status` tinyint(1) NOT NULL COMMENT '0 = expired, 1 = ongoing, 2 = renewed, 3 = canceled',
  `is_renewal` tinyint(1) NOT NULL COMMENT '0= false , 1=true',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trn_subscriptions`
--

INSERT INTO `trn_subscriptions` (`id`, `member_id`, `invoice_id`, `plan_id`, `start_date`, `end_date`, `status`, `is_renewal`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 1, 1, '2021-09-14', '2021-09-18', 1, 0, '2021-09-13 18:00:00', '2021-09-13 18:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

CREATE TABLE `users_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`id`, `user_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, '', '2021-08-09 13:50:24', '2021-08-09 13:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `website_enquiry`
--

CREATE TABLE `website_enquiry` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `working_schedules`
--

CREATE TABLE `working_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `working_schedules`
--

INSERT INTO `working_schedules` (`id`, `member_id`, `day`, `time`, `created_at`, `updated_at`) VALUES
(1, 1, 'Monday', '6:30 AM', '2021-09-14 11:53:47', '2021-09-14 11:53:47'),
(2, 1, 'Wednesday', '6:30 AM', '2021-09-14 11:53:47', '2021-09-14 11:53:47'),
(3, 1, 'Friday', '8:30 AM', '2021-09-14 11:53:47', '2021-09-14 11:54:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `customer_invoices`
--
ALTER TABLE `customer_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sale_id` (`sale_id`);

--
-- Indexes for table `customer_invoice_products`
--
ALTER TABLE `customer_invoice_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `member_details`
--
ALTER TABLE `member_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_enquiries`
--
ALTER TABLE `mst_enquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_mst_enquiries_mst_staff_1` (`created_by`),
  ADD KEY `FK_mst_enquiries_mst_staff_2` (`updated_by`);

--
-- Indexes for table `mst_expenses_categories`
--
ALTER TABLE `mst_expenses_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_mst_expenses_categories_mst_users_1` (`created_by`),
  ADD KEY `FK_mst_expenses_categories_mst_users_2` (`updated_by`);

--
-- Indexes for table `mst_members`
--
ALTER TABLE `mst_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_id` (`member_code`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `contact` (`contact`),
  ADD KEY `FK_mst_members_mst_users_1` (`created_by`),
  ADD KEY `FK_mst_members_mst_users_2` (`updated_by`);

--
-- Indexes for table `mst_plans`
--
ALTER TABLE `mst_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plan_id` (`plan_code`),
  ADD KEY `FK_mst_plans_mst_users_1` (`created_by`),
  ADD KEY `FK_mst_plans_mst_users_2` (`updated_by`);

--
-- Indexes for table `mst_services`
--
ALTER TABLE `mst_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_mst_services_mst_users_1` (`created_by`),
  ADD KEY `FK_mst_services_mst_users_2` (`updated_by`);

--
-- Indexes for table `mst_sms_events`
--
ALTER TABLE `mst_sms_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_mst_sms_events_mst_users_1` (`created_by`),
  ADD KEY `FK_mst_sms_events_mst_users_2` (`updated_by`);

--
-- Indexes for table `mst_sms_triggers`
--
ALTER TABLE `mst_sms_triggers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_users`
--
ALTER TABLE `mst_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `news_letters`
--
ALTER TABLE `news_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `plan_on_sales`
--
ALTER TABLE `plan_on_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan__services`
--
ALTER TABLE `plan__services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_invoices`
--
ALTER TABLE `pos_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`);

--
-- Indexes for table `pos_invoice_products`
--
ALTER TABLE `pos_invoice_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_invoices`
--
ALTER TABLE `shop_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_invoice_items`
--
ALTER TABLE `shop_invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_access_log`
--
ALTER TABLE `trn_access_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_cheque_details`
--
ALTER TABLE `trn_cheque_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_enquiry_followups`
--
ALTER TABLE `trn_enquiry_followups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_expenses`
--
ALTER TABLE `trn_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_invoice`
--
ALTER TABLE `trn_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_invoice_details`
--
ALTER TABLE `trn_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_payment_details`
--
ALTER TABLE `trn_payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_settings`
--
ALTER TABLE `trn_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_subscriptions`
--
ALTER TABLE `trn_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_enquiry`
--
ALTER TABLE `website_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_schedules`
--
ALTER TABLE `working_schedules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_invoices`
--
ALTER TABLE `customer_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_invoice_products`
--
ALTER TABLE `customer_invoice_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_enquiries`
--
ALTER TABLE `mst_enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique record ID';

--
-- AUTO_INCREMENT for table `mst_expenses_categories`
--
ALTER TABLE `mst_expenses_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Record Id for system';

--
-- AUTO_INCREMENT for table `mst_members`
--
ALTER TABLE `mst_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Record Id for system', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_plans`
--
ALTER TABLE `mst_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Record Id for system', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_services`
--
ALTER TABLE `mst_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_sms_events`
--
ALTER TABLE `mst_sms_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_sms_triggers`
--
ALTER TABLE `mst_sms_triggers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mst_users`
--
ALTER TABLE `mst_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news_letters`
--
ALTER TABLE `news_letters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `plan_on_sales`
--
ALTER TABLE `plan_on_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plan__services`
--
ALTER TABLE `plan__services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_invoices`
--
ALTER TABLE `pos_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_invoice_products`
--
ALTER TABLE `pos_invoice_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop_invoices`
--
ALTER TABLE `shop_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_invoice_items`
--
ALTER TABLE `shop_invoice_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trn_access_log`
--
ALTER TABLE `trn_access_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trn_cheque_details`
--
ALTER TABLE `trn_cheque_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trn_enquiry_followups`
--
ALTER TABLE `trn_enquiry_followups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trn_expenses`
--
ALTER TABLE `trn_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Record Id for system';

--
-- AUTO_INCREMENT for table `trn_invoice`
--
ALTER TABLE `trn_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Record Id for system', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trn_invoice_details`
--
ALTER TABLE `trn_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trn_payment_details`
--
ALTER TABLE `trn_payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trn_settings`
--
ALTER TABLE `trn_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `trn_subscriptions`
--
ALTER TABLE `trn_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_details`
--
ALTER TABLE `users_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `website_enquiry`
--
ALTER TABLE `website_enquiry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `working_schedules`
--
ALTER TABLE `working_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
