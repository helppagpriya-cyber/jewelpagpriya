-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2025 at 03:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PAGPRIYA by Ojas Jewel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('1b6453892473a467d07372d45eb05abc2031647a', 'i:2;', 1742678568),
('1b6453892473a467d07372d45eb05abc2031647a:timer', 'i:1742678568;', 1742678568),
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1742885936),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1742885936;', 1742885936),
('admin@gmail.com|127.0.0.1', 'i:1;', 1742526071),
('admin@gmail.com|127.0.0.1:timer', 'i:1742526071;', 1742526071),
('da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:2;', 1743614442),
('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1743614442;', 1743614442),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1743771957),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1743771957;', 1743771957);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_size_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `product_size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(19, 4, 5, 8, 1, '2025-03-23 00:08:23', '2025-03-23 00:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Ring', 'ring', 'users/01JM9Q3NRASWQ099GP8025WM74.jpg', 1, '2025-02-17 04:56:22', '2025-02-18 07:51:01'),
(2, 1, 'Couple Ring', 'couple-ring', 'users/01JM9Q57QH90ET0CETSH9AQZV6.jpg', 1, '2025-02-17 04:57:13', '2025-02-17 09:18:40'),
(3, 1, 'Casual Ring', 'casual-ring', 'users/01JM9Q9NFG8FPA8F6M5WJFTYDD.jpg', 1, '2025-02-17 04:59:38', '2025-02-17 09:18:39'),
(4, NULL, 'Earing', 'earing', 'users/01JMA037NMFS9CZF2RJ09SAX2T.jpg', 1, '2025-02-17 07:33:25', '2025-02-18 07:41:19'),
(5, 4, 'Jhumar', 'jhumar', 'users/01JMA04GKXKREGD70Z4R4R2VQ7.jpg', 1, '2025-02-17 07:34:07', '2025-02-17 09:18:37'),
(6, NULL, 'Neckless', 'neckless', 'users/01JPSV705QHQ9320TD0CN9BDJ6.jpg', 1, '2025-03-20 07:47:20', '2025-03-20 07:47:20'),
(7, 6, 'Chain', 'chain', 'users/01JPSV8KMVRBJAZ2ENTEXGSDZM.jpg', 1, '2025-03-20 07:48:13', '2025-03-20 07:48:13');

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
-- Table structure for table `gemstones`
--

CREATE TABLE `gemstones` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gemstones`
--

INSERT INTO `gemstones` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Diamond', 'diamond', 1, '2025-02-16 12:09:47', '2025-02-16 12:14:16'),
(2, 'Ruby', 'ruby', 1, '2025-02-16 12:14:28', '2025-02-16 12:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metals`
--

CREATE TABLE `metals` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metals`
--

INSERT INTO `metals` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gold', 'gold', 1, '2025-02-16 11:56:05', '2025-02-16 12:04:21'),
(4, 'Silver', 'silver', 1, '2025-03-20 08:06:16', '2025-03-20 08:06:16'),
(5, 'Platinum', 'platinum', 1, '2025-03-20 08:06:51', '2025-03-20 08:06:51'),
(6, 'Rose Gold', 'rose-gold', 1, '2025-03-20 08:07:03', '2025-03-20 08:07:03');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_31_181413_create_user_addresses_table', 1),
(5, '2025_01_31_182507_create_occasions_table', 1),
(6, '2025_01_31_183156_create_metals_table', 1),
(7, '2025_01_31_183425_create_gemstones_table', 1),
(8, '2025_01_31_184115_create_categories_table', 1),
(9, '2025_01_31_184700_create_products_table', 1),
(10, '2025_01_31_191348_create_product_sizes_table', 1),
(11, '2025_02_01_182602_create_product_discounts_table', 1),
(12, '2025_02_01_183101_create_wishlists_table', 1),
(13, '2025_02_01_183258_create_carts_table', 1),
(14, '2025_02_01_184126_create_orders_table', 1),
(15, '2025_02_01_190218_create_order_details_table', 1),
(16, '2025_02_01_191108_create_reviews_table', 1),
(17, '2025_02_08_182003_create_sliders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `occasions`
--

CREATE TABLE `occasions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `occasions`
--

INSERT INTO `occasions` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Wedding', 'wedding', 1, '2025-02-11 23:47:27', '2025-02-16 11:51:52'),
(2, 'Festival', 'festival', 1, '2025-02-11 23:47:37', '2025-02-12 02:28:37'),
(4, 'Daily Wear', 'daily-wear', 1, '2025-02-12 00:37:54', '2025-03-20 08:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','shipped','delivered','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `shipped_date` date DEFAULT NULL,
  `delivered_date` date DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COD',
  `payment_status` enum('pending','done') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_address_id` bigint UNSIGNED DEFAULT NULL,
  `tracking_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `shipped_date`, `delivered_date`, `payment_mode`, `payment_status`, `user_address_id`, `tracking_no`, `created_at`, `updated_at`) VALUES
(10, 4, 'delivered', NULL, NULL, 'COD', 'pending', 5, NULL, '2025-03-22 22:55:12', '2025-03-22 22:55:12'),
(14, 2, 'delivered', NULL, NULL, 'COD', 'pending', 1, NULL, '2025-03-23 01:15:55', '2025-03-23 01:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_size_id` bigint UNSIGNED DEFAULT NULL,
  `product_discount_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` int DEFAULT NULL,
  `is_express_delivery` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `delivery_charges` int DEFAULT NULL,
  `is_gifted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_size_id`, `product_discount_id`, `quantity`, `price`, `is_express_delivery`, `delivery_charges`, `is_gifted`, `created_at`, `updated_at`) VALUES
(6, 10, 3, 5, NULL, 1, 26000, 0, NULL, 0, '2025-03-22 22:55:12', '2025-03-22 22:55:12'),
(7, 10, 4, 7, NULL, 1, 65000, 0, NULL, 0, '2025-03-22 22:55:12', '2025-03-22 22:55:12'),
(11, 14, 4, 7, NULL, 1, 65000, 0, NULL, 0, '2025-03-23 01:15:55', '2025-03-23 01:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `metal_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `gemstone_id` bigint UNSIGNED DEFAULT NULL,
  `occasion_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_charge` int DEFAULT NULL,
  `express_delivery_available` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'false=No, true=Yes',
  `express_delivery_charge` int DEFAULT NULL,
  `warranty_period` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `metal_id`, `category_id`, `gemstone_id`, `occasion_id`, `name`, `slug`, `description`, `gender`, `delivery_charge`, `express_delivery_available`, `express_delivery_charge`, `warranty_period`, `images`, `certificate`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, NULL, 'Diamond Ring', 'diamond-ring', '<p>&nbsp;demo desrption.&nbsp;</p><p>&nbsp;demo desrption.&nbsp;</p><p>&nbsp;demo desrption.&nbsp;</p>', 'F', NULL, 0, NULL, NULL, '[\"products\\/01JNX9A5HAWFQZW0GX0J97ZFT5.jpg\",\"products\\/01JNX9A5JD41QTQNXR01DRAWPY.jpg\",\"products\\/01JNXN1NJVE32ESYJHDV7T37KT.jpg\"]', NULL, 1, '2025-03-09 05:35:45', '2025-03-20 08:18:40'),
(2, 1, 5, 2, 2, 'Gold Jhumar', 'gold-jhumar', '<p>Description Description Description Description&nbsp;</p>', 'F', 100, 1, 200, '1 Month', '[\"products\\/01JP7KBMSE3EMFC9QZ8JZMK7NZ.jpg\",\"products\\/01JP7KCX00SFMBDVBE58WB5C4G.jpg\"]', NULL, 1, '2025-03-13 05:21:40', '2025-03-20 08:18:32'),
(3, 1, 2, 1, 2, 'Diamond Ring fine', 'diamond-ring-fine', '<p>demo demo</p>', 'F', NULL, 0, NULL, '15 Days', '[\"products\\/01JP7JVD3E2K7EGYBM51671QXS.jpg\",\"products\\/01JP7JVD3VZT6AWBSW0ZT1WCRM.jpg\"]', NULL, 1, '2025-03-13 05:34:52', '2025-03-20 08:18:26'),
(4, 6, 7, 1, 4, 'Elegant chain', 'elegant-chain', '<p>Elegant women stylish daily wear neckless chain.</p>', 'F', NULL, 1, 100, '1 Month', '[\"products\\/01JPSWHDSNKZEKK5G5SNVZS894.jpg\",\"products\\/01JPSWHDSSH8MWKYSFX5M1BWA5.jpg\",\"products\\/01JPSWHDSW5PRBHC2WGQ8PKTYF.jpg\",\"products\\/01JPSWHDSZ4WSY7A4JT0WWFSFZ.jpg\"]', NULL, 1, '2025-03-20 08:10:30', '2025-03-20 08:18:17'),
(5, 4, 7, NULL, 4, 'Silver stylish chain', 'silver-stylish-chain', '<ul><li>&nbsp;Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit.&nbsp;</li><li>&nbsp;Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit.&nbsp;</li><li>&nbsp;Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit.&nbsp;</li><li>&nbsp;Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit.&nbsp;</li><li>&nbsp;Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit.&nbsp;</li></ul>', 'F', NULL, 0, NULL, '1 Month', '[\"products\\/01JPSWSSM4YNHJS5KMEGJ8W16N.jpg\",\"products\\/01JPSWSSM8DKS888CB9JPWSHC2.jpg\",\"products\\/01JPSWSSMB2R5VYA0P6S5TFQFV.jpg\",\"products\\/01JPSWSSMFA2FGTFD8ZZYMSJ1B.jpg\"]', NULL, 1, '2025-03-20 08:15:04', '2025-03-20 08:18:04'),
(6, 1, 3, 1, 4, 'Men stylish ring', 'men-stylish-ring', '<ul><li>&nbsp;Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit.&nbsp;</li><li>&nbsp;Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit.&nbsp;</li><li>&nbsp;Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit.&nbsp;</li></ul>', 'M', NULL, 1, 150, NULL, '[\"products\\/01JPSX3KD1NYYYX0ZFPV8NH584.png\",\"products\\/01JPSX3KD5VP7P40AWETQR77RE.jpg\",\"products\\/01JPSX3KD8Q50H04ZQ3JF1AAK9.jpg\",\"products\\/01JPSX3KDBJBQVCAWF92EB7H09.jpg\"]', NULL, 1, '2025-03-20 08:20:26', '2025-03-20 08:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_discounts`
--

CREATE TABLE `product_discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `discount` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_discounts`
--

INSERT INTO `product_discounts` (`id`, `product_id`, `discount`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2000, '2025-03-10', '2025-04-15', '2025-03-09 21:39:27', '2025-04-04 07:36:59'),
(2, 2, 1000, '2025-03-11', '2025-03-12', '2025-03-13 13:40:58', '2025-03-13 13:41:31'),
(3, 6, 5000, '2025-03-20', '2025-03-31', '2025-03-20 08:22:46', '2025-03-20 08:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL,
  `metal_weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metal_purity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metal_price` int DEFAULT '0',
  `gemstone_weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gemstone_purity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gemstone_price` int DEFAULT '0',
  `num_of_gemstone` int DEFAULT NULL,
  `making_charges` int DEFAULT '0',
  `gst` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size`, `stock`, `metal_weight`, `metal_purity`, `metal_price`, `gemstone_weight`, `gemstone_purity`, `gemstone_price`, `num_of_gemstone`, `making_charges`, `gst`, `created_at`, `updated_at`) VALUES
(1, 1, '22', 20, '2 GM', '22 K', 10000, '1 GM', '24 K', 8000, 2, 5000, 1000, '2025-03-09 08:52:20', '2025-03-09 21:13:51'),
(2, 1, '20', 15, '1 GM', '22 K', 8000, '2 GM', '24 K', 6000, 2, 5000, 3000, '2025-03-09 22:23:37', '2025-03-09 22:25:01'),
(3, 2, 'S', 15, '1 GM', '22 K', 10000, '1 GM', '24 K', 5000, 1, 5000, 1000, '2025-03-17 14:00:05', '2025-03-17 14:00:05'),
(4, 2, 'M', 14, '2 GM', '22 K', 20000, '1 GM', '24 K', 5000, 1, 5000, 2000, '2025-03-17 14:00:47', '2025-03-17 14:00:47'),
(5, 3, '18', 10, '2 GM', '22 K', 10000, '1 GM', '24 K', 10000, 1, 5000, 1000, '2025-03-20 07:17:25', '2025-03-21 07:22:28'),
(6, 3, '20', 10, '1 GM', '22 K', 12000, '1 GM', '24 K', 10000, 1, 5500, 2500, '2025-03-20 07:19:59', '2025-03-22 04:16:11'),
(7, 4, 'Free size', 51, '10 GM', '22 K', 60000, NULL, NULL, 0, NULL, 3000, 2000, '2025-03-20 08:12:55', '2025-03-20 08:12:55'),
(8, 5, 'Free size', 21, '10 GM', '24 K', 27000, NULL, NULL, 0, NULL, 2000, 1000, '2025-03-20 08:15:59', '2025-03-20 08:15:59'),
(9, 6, '22', 20, '2 GM', '22 K', 20000, '1 GM', '24 K', 10000, 1, 3000, 2000, '2025-03-20 08:21:35', '2025-03-20 08:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `image`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 5, 'Nice Product.... !', '[\"reviews\\/01JQ60CH5WYB0HKMBBF673AWNY.jpg\",\"reviews\\/01JQ60CH60R3C6V97T2PXTTFR0.jpg\"]', '2025-03-18 12:25:57', '2025-03-25 01:08:37'),
(3, 2, 2, 5, NULL, NULL, '2025-03-20 08:37:39', '2025-03-20 08:37:39'),
(4, 2, 3, 3, NULL, NULL, '2025-03-20 08:37:48', '2025-03-20 08:37:48'),
(5, 3, 4, 5, NULL, NULL, '2025-03-20 08:38:18', '2025-03-20 08:38:18'),
(6, 2, 4, 5, 'Very nice product !!! it is awesome ...\nI loved the product ....\nBest shopping ever.... !! Thanks PAGPRIYA by Ojas Jewel', '[\"reviews\\/01JQ61G3HX2R9RYRAKF8Y3W5V8.jpg\"]', '2025-03-23 01:47:28', '2025-03-25 01:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('LnZqSng3edu6oRagmSZ6Cslvh5FHsTxdz6HplCMB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoieVdJNE10ZEFzUGpHcVhoNVR4MFFuTFZKdk9UVmFsWXk5R0xTRWVuZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1743772696);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bg_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `text`, `description`, `image`, `bg_color`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Simple & Elegent daily wear Jewellery', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates, voluptatum.', 'sliders/01JPQVE6Y8ZZDX8EJ3H8D3PK7J.jpg', '#5C3422', 1, '2025-02-17 08:49:38', '2025-03-19 13:43:57'),
(2, 'Designer Rings for Beautiful ladies....', 'Get the offer now... ! Be the first to win the gift ....', 'sliders/01JPQVCPM9CZNXM89XZFZRPJZW.jpg', '#8c360e', 1, '2025-02-17 09:02:59', '2025-03-19 13:43:26'),
(3, 'Get the GIft Now !!!', 'Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit, Lorem ipsum dolor sit.', 'sliders/01JPQXBM44T23QBSWJCTWEJYD0.jpg', '#a64f26', 1, '2025-03-19 13:46:20', '2025-03-19 13:46:20');

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
  `role` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=User, 1=Admin',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Amisha', 'aakbari078@rku.ac.in', NULL, '$2y$12$6uxkRZuGy39lBDT3gvwkcOfu5SQlrPxCwZD5ZES7dEAp7XJv0sCb2', '1', 'users/01JKWAVWCK61GR8R26JETBKR3J.jpg', 'IhuxX6BrfMqQM5LSVQa0j2iz3jU6o7t1SnjZe8YQ04rTOcbkZwryBiQLVgBq', '2025-02-11 23:46:31', '2025-03-21 04:08:40'),
(2, 'Dhruvi', 'dhruvi@gmail.com', NULL, '$2y$12$l69AL883y3D7vTC12.Uhg.FfRVULaiDbv9NGHVdAsFj8x/T6nyFVG', '0', NULL, NULL, '2025-02-12 00:00:16', '2025-03-13 06:13:10'),
(3, 'Nita Sharma', 'nita@gmail.com', NULL, '$2y$12$bUJKlMRTU2L13TCV4fh3R.84LxnuYus6rEDuzIodoc/8gP67wVpge', '0', NULL, NULL, '2025-03-20 07:13:44', '2025-03-20 07:13:44'),
(4, 'Deep', 'deep@gmail.com', NULL, '$2y$12$a.pqACqcEjjUwcX.IGPSyeRvDLjRIHLk8/k1NbW3P70esC3MDt1N6', '0', 'storage/users/urDiDjF5jHNDYzt049gbgiHfEHsXAq9p66e3lH10.jpg', NULL, '2025-03-21 03:30:43', '2025-03-22 15:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `phone` bigint NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin` int NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `phone`, `address`, `pin`, `city`, `state`, `created_at`, `updated_at`) VALUES
(1, 2, 1234567890, '<p><strong>\"</strong><strong style=\"text-decoration: underline;\">Happy Home</strong><strong>\",</strong>Street no. 3,Jagnath main road</p>', 123456, 'Rajkot', 'Gujarat', '2025-02-14 07:46:09', '2025-02-14 07:46:32'),
(2, 1, 1234567890, '<p>demo address Admin</p>', 123456, 'demo', 'Demo', '2025-03-16 06:18:48', '2025-03-16 06:18:48'),
(3, 2, 1234567890, '<p>Adddress of Junagadh</p>', 123456, 'Junagadh', 'Gujarat', '2025-03-16 06:19:24', '2025-03-16 06:19:24'),
(4, 3, 1234567890, '<p>This is addresss of nita from jamnagar.</p>', 123456, 'Jamnagar', 'Gujarat', '2025-03-20 07:21:52', '2025-03-20 07:21:52'),
(5, 4, 1234567890, '\'Deep\' Address', 123456, 'Rajkot', 'Gujarat', '2025-03-22 15:41:23', '2025-03-22 15:41:23'),
(6, 4, 1234567890, 'Addresss 2 of Deep', 123456, 'Jamnagar', 'Gujarat', '2025-03-22 15:43:11', '2025-03-22 15:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(4, 1, 1, NULL, NULL),
(5, 1, 2, NULL, NULL),
(6, 1, 3, NULL, NULL),
(7, 1, 4, NULL, NULL),
(18, 4, 6, '2025-03-23 01:02:08', '2025-03-23 01:02:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_product_size_id_foreign` (`product_size_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gemstones`
--
ALTER TABLE `gemstones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gemstones_slug_unique` (`slug`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metals`
--
ALTER TABLE `metals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `metals_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occasions`
--
ALTER TABLE `occasions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `occasions_slug_unique` (`slug`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_user_address_id_foreign` (`user_address_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_product_size_id_foreign` (`product_size_id`),
  ADD KEY `order_details_product_discount_id_foreign` (`product_discount_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_metal_id_foreign` (`metal_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_gemstone_id_foreign` (`gemstone_id`),
  ADD KEY `products_occasion_id_foreign` (`occasion_id`);

--
-- Indexes for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_discounts_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gemstones`
--
ALTER TABLE `gemstones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metals`
--
ALTER TABLE `metals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `occasions`
--
ALTER TABLE `occasions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_product_size_id_foreign` FOREIGN KEY (`product_size_id`) REFERENCES `product_sizes` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_address_id_foreign` FOREIGN KEY (`user_address_id`) REFERENCES `user_addresses` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_discount_id_foreign` FOREIGN KEY (`product_discount_id`) REFERENCES `product_discounts` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_details_product_size_id_foreign` FOREIGN KEY (`product_size_id`) REFERENCES `product_sizes` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_gemstone_id_foreign` FOREIGN KEY (`gemstone_id`) REFERENCES `gemstones` (`id`),
  ADD CONSTRAINT `products_metal_id_foreign` FOREIGN KEY (`metal_id`) REFERENCES `metals` (`id`),
  ADD CONSTRAINT `products_occasion_id_foreign` FOREIGN KEY (`occasion_id`) REFERENCES `occasions` (`id`);

--
-- Constraints for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD CONSTRAINT `product_discounts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
