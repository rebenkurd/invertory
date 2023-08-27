-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 27, 2023 at 04:06 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invertory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `debit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `old_debit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `name`, `email`, `mobile`, `phone`, `address`, `debit`, `old_debit`, `created_at`, `updated_at`) VALUES
(1, 'CU000001', 'هێمن ابراهیم قادر', 'ahmadmhamad@gmail.com', '9492135765', '9492135765', 'NEWYORK', '49600', '-10000', '2023-08-04 09:46:50', '2023-08-11 15:22:09'),
(3, 'CU000002', 'محمد محمود عبدالله', 'hama@email.com', '9492135765', '9492135765', 'NEWYORK', '59000', '0', '2023-08-11 15:15:47', '2023-08-11 15:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invertories`
--

CREATE TABLE `invertories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invertories`
--

INSERT INTO `invertories` (`id`, `name`, `email`, `mobile`, `phone`, `image`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Invertory', 'invertory@email.com', '949213576544', '9493333333334', 'uploads/settings/1773671469875319_invertory.png', 'Sulaymanyah', '2023-08-04 13:33:55', '2023-08-08 11:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_01_053220_create_products_table', 2),
(6, '2023_08_01_113533_create_purchases_table', 3),
(7, '2023_08_01_125625_create_product_items_table', 4),
(8, '2023_08_03_112337_create_product_items_table', 5),
(9, '2023_08_04_110548_create_suppliers_table', 6),
(10, '2023_08_04_115240_create_invertories_table', 7),
(11, '2023_08_04_123248_create_customers_table', 8),
(12, '2023_08_04_133518_create_payments_table', 9),
(13, '2023_08_11_163656_create_sales_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_id` bigint UNSIGNED DEFAULT NULL,
  `sale_id` bigint UNSIGNED DEFAULT NULL,
  `pay_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `purchase_id`, `sale_id`, `pay_date`, `pay_type`, `pay_note`, `pay_amount`, `created_at`, `updated_at`) VALUES
(66, 16, 0, '2023-08-07 15:08:49', 'cash', NULL, '100000', '2023-08-07 12:08:49', NULL),
(68, 17, 0, '2023-08-07 15:12:01', 'cash', NULL, '101000', '2023-08-07 12:12:01', NULL),
(69, 20, 0, '2023-08-07 15:15:53', 'cash', 'kl;kj;', '35000', '2023-08-07 12:15:53', NULL),
(72, 19, 0, '2023-08-07 16:01:23', 'cash', NULL, '5000', '2023-08-07 13:01:23', NULL),
(73, 20, 0, '2023-08-07 16:01:53', 'cash', NULL, '100000', '2023-08-07 13:01:53', NULL),
(74, NULL, 3, '2023-08-11 18:11:37', 'cash', 'fdhfg', '5000', '2023-08-11 15:11:37', NULL),
(75, NULL, 4, '2023-08-11 18:20:30', 'cash', NULL, '100000', '2023-08-11 15:20:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `pr_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pr_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pr_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `x_margin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` enum('iqd','usd') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'iqd',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pr_code`, `pr_name`, `pr_image`, `stock`, `price`, `qty`, `x_margin`, `selling_price`, `currency`, `notes`, `created_at`, `updated_at`) VALUES
(10, '43546547', 'Samsung', 'uploads/products/1773207619875768_product.png', '1', '25000', '44', '10', '27500.00', 'usd', 'fert', '2023-08-03 08:36:04', '2023-08-11 15:21:08'),
(11, '79879', 'Apple Iphone', 'uploads/products/1773207640746974_product.png', '1', '200', '40', '50', '300.00', 'iqd', 'dsf', '2023-08-03 08:36:24', '2023-08-11 15:22:42'),
(12, '2123333', 'Apple Watch', 'uploads/products/1773207670260981_product.png', '1', '1000', '78', '5', '1050.00', 'usd', 'trett', '2023-08-03 08:36:52', '2023-08-11 15:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_items`
--

CREATE TABLE `product_items` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `purchase_id` bigint UNSIGNED DEFAULT NULL,
  `sale_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_items`
--

INSERT INTO `product_items` (`id`, `product_id`, `purchase_id`, `sale_id`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(31, 12, 11, NULL, '10', '10000.00', '2023-08-04 12:36:36', '2023-08-07 12:17:42'),
(34, 12, 13, NULL, '1', '1000.00', '2023-08-04 12:39:17', NULL),
(37, 12, 16, NULL, '4', '4000.00', '2023-08-05 09:10:18', NULL),
(38, 11, 16, NULL, '5', '1000.00', '2023-08-05 09:10:18', '2023-08-07 12:12:01'),
(39, 10, 16, NULL, '1', '25000.00', '2023-08-05 09:10:18', '2023-08-07 12:17:42'),
(40, 11, 17, NULL, '5', '1000.00', '2023-08-05 11:57:58', NULL),
(41, 10, 17, NULL, '4', '100000.00', '2023-08-05 11:57:58', NULL),
(42, 11, 18, NULL, '5', '1000.00', '2023-08-06 10:45:41', NULL),
(43, 12, 18, NULL, '5', '5000.00', '2023-08-06 10:45:41', NULL),
(44, 10, 18, NULL, '5', '125000.00', '2023-08-06 10:45:41', NULL),
(45, 12, 19, NULL, '10', '10000.00', '2023-08-06 11:40:25', NULL),
(46, 12, 20, NULL, '8', '8000.00', '2023-08-07 12:15:53', NULL),
(47, 11, 20, NULL, '10', '2000.00', '2023-08-07 12:15:53', NULL),
(48, 10, 20, NULL, '5', '125000.00', '2023-08-07 12:15:53', NULL),
(53, 11, NULL, 3, '5', '1000.00', '2023-08-11 15:11:37', NULL),
(54, 10, NULL, 3, '2', '50000.00', '2023-08-11 15:11:37', NULL),
(55, 12, NULL, 4, '7', '7000.00', '2023-08-11 15:20:30', NULL),
(56, 11, NULL, 4, '10', '2000.00', '2023-08-11 15:20:30', NULL),
(57, 10, NULL, 4, '6', '150000.00', '2023-08-11 15:20:30', NULL),
(58, 11, NULL, 5, '18', '3600.00', '2023-08-11 15:22:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `invertory_id` bigint UNSIGNED NOT NULL,
  `purchase_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` enum('iqd','usd') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'iqd',
  `attach_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_status` enum('paid','partial','unpaid') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_due` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_status` tinyint DEFAULT '0',
  `return_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `invertory_id`, `purchase_date`, `invoice_no`, `currency`, `attach_file`, `amount`, `pay_status`, `pay_due`, `return_status`, `return_date`, `notes`, `created_at`, `updated_at`) VALUES
(11, 1, 1, '2023-08-28', 'PR000009', 'iqd', NULL, '5000.00', 'unpaid', '5000', 0, NULL, NULL, '2023-08-04 12:36:36', '2023-08-07 11:52:00'),
(13, 1, 1, '2023-08-22', 'PR000012', 'usd', 'uploads/invoices/1773582345398357_invoice.png', '1000.00', 'unpaid', '1000', 0, NULL, NULL, '2023-08-04 12:39:17', '2023-08-07 11:57:13'),
(16, 1, 1, '2023-08-22', 'PR000014', 'usd', 'uploads/invoices/1773582166954489_invoice.png', '130000.00', 'partial', '30000', 0, NULL, NULL, '2023-08-05 09:10:18', '2023-08-07 12:08:49'),
(17, 1, 1, '2023-08-24', 'PR000017', 'usd', NULL, '101000.00', 'paid', '0', 0, NULL, NULL, '2023-08-05 11:57:58', '2023-08-07 12:12:01'),
(18, 1, 1, '2023-09-04', 'PR000018', 'usd', 'uploads/invoices/1773582309357921_invoice.png', '131000.00', 'unpaid', '131000', 0, NULL, 'dsaf', '2023-08-06 10:45:41', '2023-08-07 11:57:54'),
(19, 1, 1, '2023-08-19', 'PR000019', 'iqd', NULL, '10000.00', 'partial', '5000', 1, '2023-08-11 16:25:42', NULL, '2023-08-06 11:40:25', '2023-08-11 13:25:42'),
(20, 1, 1, '2023-08-31', 'PR000020', 'iqd', 'uploads/invoices/1773583837489200_invoice.png', '135000.00', 'paid', '0', 1, '2023-08-11 13:50:41', 'Hello Evning', '2023-08-07 12:15:53', '2023-08-11 10:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `invertory_id` bigint UNSIGNED NOT NULL,
  `sale_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` enum('iqd','usd') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'iqd',
  `attach_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_status` enum('paid','partial','unpaid') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_due` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_status` tinyint DEFAULT '0',
  `return_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `invertory_id`, `sale_date`, `invoice_no`, `currency`, `attach_file`, `amount`, `pay_status`, `pay_due`, `return_status`, `return_date`, `notes`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '2023-08-15', 'SL000003', 'usd', 'uploads/invoices/1773957281136049_invoice.png', '51000.00', 'partial', '46000', 0, NULL, 'FDSGFDG', '2023-08-11 15:11:37', NULL),
(4, 3, 1, '2023-08-23', '1221324', 'usd', 'uploads/invoices/1773957840040654_invoice.png', '159000.00', 'partial', '59000', 1, '2023-08-11 18:21:08', NULL, '2023-08-11 15:20:30', '2023-08-11 15:21:08'),
(5, 1, 1, '2023-08-20', 'SL000005', 'iqd', NULL, '3600.00', 'unpaid', '3600.00', 1, '2023-08-11 18:22:42', NULL, '2023-08-11 15:22:09', '2023-08-11 15:22:42');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `payment_id` bigint UNSIGNED DEFAULT NULL,
  `supplier_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `debit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `old_debit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `payment_id`, `supplier_id`, `name`, `email`, `mobile`, `phone`, `address`, `debit`, `old_debit`, `created_at`, `updated_at`) VALUES
(1, NULL, 'SP000001', 'rebin', 'rebin@gmail.com', '0001255', '949213', 'geee', '174000', '306000', '2023-08-04 08:36:10', '2023-08-07 13:01:53'),
(3, NULL, 'SP000002', 'فرمان احمد', 'frman@gmail.com', NULL, '9492135765', 'NEWYORK', '0', '0', '2023-08-11 15:15:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_seen` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `image`, `username`, `role`, `phone`, `address`, `status`, `last_seen`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@email.com', NULL, '$2y$10$8zys4pSmSuhGWYygzXBbte8H7pZxOWE5au9Pg1g9yn8ODOjlyJgFO', 'fV365P1B7OHqXFv8XgnUWXKRodOoi7ndH2iDj5wADocl92IvX6rAKo2t14J7', 'uploads/users/1772950503564217_user.png', '', 'admin', NULL, NULL, 'active', NULL, '2023-07-31 04:53:10', '2023-07-31 04:53:10'),
(2, 'rebinrafiq', 'rebinrafiq@gmail.com', NULL, '$2y$10$WNUBCI.oFCgN4nmBPkheyuv7.zxMyXwp/nR9gcBuuM1WKLrduUcoa', NULL, NULL, '', 'user', NULL, NULL, 'active', NULL, NULL, NULL),
(3, 'casher', 'casher@email.com', NULL, '$2y$10$Mb6J.qtk01tvrt/RS4L9teowFdLzIVFQD3GEoVT1I2aP5y4nBPs6u', 'spsN5gME8vHXw9mnVIBzLyhXKSmDilUXO8mb7EvZP01x7zjGyINDKLBsnqYW', 'uploads/users/1772950544832539_user.png', 'casher', 'admin', '9492135765', 'NEWYORK', 'inactive', NULL, '2023-07-31 08:57:43', '2023-07-31 12:29:58'),
(5, 'hama', 'hama@email.com', NULL, '$2y$10$bIHlCySDXfLnH5eGP3gXRuA.2mYRiqBpctct11IFHGMCbZVlaKYVO', 'aOnIce1t0bn8J2WQ1ecwI0rTPEIooHuu8WXDnYZFtTanUgHmbsD4ysje3FAt', NULL, '', 'user', NULL, NULL, 'active', NULL, '2023-07-31 09:41:17', NULL),
(6, 'kobin', 'kobin@email.com', NULL, '$2y$10$mq7qU8UlHdqktX0rWMTtF.ylHX/BZmEoVj8QXox7xgnaRc4mUrOee', 'm6ewmGwgwyLh4u4wCc2CfWSeduCJuSibItaAym4x3BUcLXeqXpW6Xm4LFKIn', NULL, '', 'user', NULL, NULL, 'active', NULL, '2023-07-31 09:42:44', NULL),
(7, 'rebin', 'rebin@email.com', NULL, '$2y$10$pSHzI4ri2jWiwzY1.l87lOByWkYLZYJvp5MNfvKtIZ9LIZ66DQtV.', 'QovU7hNxJvHtVQ0Z9Nl3ulaghooD4QZ3wMJWF6C72niGGjZbcrfBg5Eh5dRL', 'uploads/users/1772950503564217_user.png', 'rebin', 'admin', '123456', '4qurna', 'inactive', NULL, '2023-07-31 11:57:54', '2023-07-31 12:29:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_customer_id_unique` (`customer_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invertories`
--
ALTER TABLE `invertories`
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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_pay` (`purchase_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_items`
--
ALTER TABLE `product_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product_id`),
  ADD KEY `purchase` (`purchase_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`),
  ADD KEY `supplier` (`supplier_id`),
  ADD KEY `invertory` (`invertory_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_invertory_id_foreign` (`invertory_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invertories`
--
ALTER TABLE `invertories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_items`
--
ALTER TABLE `product_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `purchase_pay` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_items`
--
ALTER TABLE `product_items`
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `invertory` FOREIGN KEY (`invertory_id`) REFERENCES `invertories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_invertory_id_foreign` FOREIGN KEY (`invertory_id`) REFERENCES `invertories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
