-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2024 at 05:32 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sagoralibd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sagor', 'admin@example.com', NULL, '$2y$12$oq3RTIBsSXsR6z7Fhvo4e.9Q3m8zoQMPGn2gTN.rlzG5SsIuHR/Gm', NULL, '2024-07-14 01:23:20', '2024-07-14 01:23:20'),
(3, 'Sagor Ali BD', 'mdsagorali033@gmail.com', NULL, '$2y$12$U4YOrkLYrTxvfeDtU92HHOW3EA7fOaSj0vP853MOCugL7QmSFfHcy', NULL, '2024-07-26 02:06:06', '2024-07-26 02:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `showHome` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(1, 'App', 'app', 1, 'Yes', '2024-07-16 04:21:40', '2024-07-16 04:21:40'),
(2, 'Web design', 'web-design', 1, 'Yes', '2024-07-16 04:21:48', '2024-07-16 04:21:48'),
(3, 'Web development', 'web-development', 1, 'Yes', '2024-07-16 04:22:05', '2024-07-16 04:22:05'),
(4, 'Laravel development', 'laravel-development', 1, 'No', '2024-07-16 04:22:24', '2024-07-16 04:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` double DEFAULT NULL,
  `status` enum('in_review','approved','progress','rejected','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in_review',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`id`, `user_id`, `title`, `description`, `budget`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Web design', '<p>I have an web design project</p>', 6000, 'approved', '2024-07-16 09:32:19', '2024-07-16 09:32:19'),
(2, 6, 'fb security', '<p>sdfsafdsafd</p>', 453535, 'in_review', '2024-07-16 09:34:34', '2024-07-16 09:34:34'),
(4, 4, 'test3', '<p>fasfasf</p>', 444444444, 'rejected', '2024-07-16 23:01:15', '2024-07-16 23:01:15'),
(5, 4, 'test', '<p>test</p>', 56321, 'in_review', '2024-07-17 01:41:42', '2024-07-17 01:41:42'),
(6, 4, 'test2 test2 test2 test2 sdfasfdsalkdfsd lksdflsjflsajfsajf;afsajfd lsdfjsafjsafkjsafkjsafkjshfkjsa', '<p>When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.</p>', 65465, 'completed', '2024-07-17 01:42:12', '2024-07-17 01:42:12'),
(7, 2, 'testsss', '<p>&nbsp;tesssssssssssss</p>', 5200, 'in_review', '2024-07-18 07:35:54', '2024-07-18 07:35:54'),
(8, 6, 'fsafdsafs', '<p>fdsafsafsaf</p>', 234242, 'in_review', '2024-07-18 07:43:49', '2024-07-18 07:43:49'),
(9, 4, 'Web desitng project', '<p><font color=\"#474747\" face=\"Arial, sans-serif\"><span style=\"font-size: 14px;\">A disabled option is unusable and un-clickable. The disabled attribute can be set to keep a user from selecting the option until some other condition has been&nbsp;</span></font></p><p><font color=\"#474747\" face=\"Arial, sans-serif\"><span style=\"font-size: 14px;\">A disabled option is unusable and un-clickable. The disabled attribute can be set to keep a user from selecting the option until some other condition has been&nbsp;</span></font></p><p><font color=\"#474747\" face=\"Arial, sans-serif\"><span style=\"font-size: 14px;\">A disabled option is unusable and un-clickable. The disabled attribute can be set to keep a user from selecting the option until some other condition has been&nbsp;</span></font></p><p><br></p>', 55000, 'in_review', '2024-07-18 07:45:28', '2024-07-18 07:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `project_cost` double NOT NULL,
  `payment_type` enum('advance','final') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `pay_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tranjection_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('hold','accept','reject','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hold',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_payments`
--

INSERT INTO `customer_payments` (`id`, `user_id`, `order_id`, `project_cost`, `payment_type`, `amount`, `pay_method`, `tranjection_id`, `pay_slip`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 9, 20000, 'advance', 10000, 'bkash', '01793925555', 'paymentIMG/Screenshot 2024-07-18 111140.png', 'hold', '2024-07-24 09:32:04', '2024-07-24 09:32:04'),
(2, 2, 2, 20000, 'advance', 10000, 'nagod', '01773925555', 'paymentIMG/Screenshot 2024-07-18 110530.png', 'hold', '2024-07-24 09:32:58', '2024-07-24 09:32:58'),
(3, 4, 4, 55000, 'advance', 20000, 'bkash', '01775925952', 'paymentIMG/Screenshot 2024-07-18 105029.png', 'hold', '2024-07-24 09:43:20', '2024-07-24 09:43:20');

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
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `portfolio_id` bigint UNSIGNED NOT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `portfolio_id`, `images`, `created_at`, `updated_at`) VALUES
(1, 1, 'images_file/images (19).jpeg', '2024-07-18 21:46:35', '2024-07-18 21:46:35'),
(2, 1, 'images_file/images (18).jpeg', '2024-07-18 21:46:35', '2024-07-18 21:46:35'),
(3, 1, 'images_file/images (17).jpeg', '2024-07-18 21:46:35', '2024-07-18 21:46:35');

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
-- Table structure for table `mains`
--

CREATE TABLE `mains` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bc_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mains`
--

INSERT INTO `mains` (`id`, `title`, `sub_title`, `bc_image`, `profile_picture`, `resume`, `full_name`, `profile`, `email`, `phone`, `about_me`, `created_at`, `updated_at`) VALUES
(1, 'Sagor', 'I will make a website for you.', 'img/sagoralibd4443.jpg', 'profile_img/sagor 600x600.jpg', 'pdf/Sagor Ali BD CV.pdf', 'Sagor Ali BD', 'Laravel developer', 'mdsagorali033@gmail.com', '01537298343', '<p style=\"text-align: justify; \">Hello! I\'m <b>Md.Sagor Ali,</b> a passionate web developer with a keen interest in creating dynamic and user-friendly websites. With over 3 years of experience in the industry, I have honed my skills in various web technologies and frameworks, including HTML, CSS, JavaScript, and Laravel.</p><p style=\"text-align: justify; \">I specialize in both front-end and back-end development, ensuring that every project I undertake is not only visually appealing but also functionally robust. My journey in web development began with a curiosity for coding and has transformed into a fulfilling career where I get to solve complex problems and bring creative ideas to life.</p><p style=\"text-align: justify; \">In my portfolio, you\'ll find a range of projects that showcase my ability to deliver high-quality work, from personal blogs and e-commerce sites to full-stack applications. Each project is a testament to my commitment to excellence and my continuous pursuit of learning and improvement.</p><p style=\"text-align: justify; \">When I\'m not coding, you can find me exploring new technologies, reading about the latest trends in web development, or enjoying a good book. I\'m always open to new challenges and opportunities, so feel free to get in touch if you\'d like to collaborate or learn more about my work.</p><p>Thank you for visiting my portfolio!</p>', '2024-07-16 04:18:19', '2024-07-25 00:36:47');

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
(28, '0001_01_01_000000_create_users_table', 1),
(29, '0001_01_01_000001_create_cache_table', 1),
(30, '0001_01_01_000002_create_jobs_table', 1),
(31, '2024_06_28_120623_create_mains_table', 1),
(32, '2024_06_28_153334_create_services_table', 1),
(33, '2024_06_30_051832_create_admins_table', 1),
(34, '2024_07_01_140314_create_category_table', 1),
(35, '2024_07_02_074845_create_portfolios_table', 1),
(36, '2024_07_05_112332_create_galleries_table', 1),
(37, '2024_07_13_165235_create_services_ratings_table', 1),
(38, '2024_07_15_034808_add_image_and_address_to_users_table', 2),
(44, '2024_07_16_102919_create_customer_orders_table', 3),
(47, '2024_07_16_102943_create_customer_payments_table', 4),
(49, '2024_07_25_035205_create_visitors_table', 5),
(50, '2024_07_25_091134_create_visitor_logs_table', 6);

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
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `clint` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `showHome` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `post_type` enum('project','blog') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'blog',
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `title`, `slug`, `short_description`, `description`, `clint`, `project_url`, `tags`, `status`, `showHome`, `post_type`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', '<p>sfasdfsfsf</p>', '<p>sfdsafsafasf</p>', 'Nur', 'www.test.com', 'sdfsadf,sfasf,sdfsfsf', '1', 'Yes', 'project', 1, '2024-07-18 21:46:33', '2024-07-18 21:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'fa-brands fa-laravel', 'Laravel website service', '<p>Laravel website service&nbsp;Laravel website service&nbsp;<span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Laravel website service&nbsp;Laravel website service&nbsp;</span><br></p>', '2024-07-14 01:24:00', '2024-07-14 01:24:00'),
(2, 'fa-solid fa-code', 'Web design', '<p>Test text dummy text&nbsp;<span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span></p><p>Test text dummy text&nbsp;<span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span><span style=\"color: var(--bs-card-color); font-size: 1rem;\">Test text dummy text&nbsp;</span></p><p>Test text dummy text Test text dummy text Test text dummy text Test text dummy text Test text dummy text Test text dummy text Test text dummy text Test text dummy text Test text dummy text Test text dummy text&nbsp;<span style=\"color: var(--bs-card-color); font-size: 1rem;\"><br></span><span style=\"color: var(--bs-card-color); font-size: 1rem;\"><br></span></p>', '2024-07-14 05:40:59', '2024-07-14 05:40:59'),
(3, 'fa-solid fa-code', 'Bug fixing', '<p>We will fix you website bugs</p>', '2024-07-16 04:23:46', '2024-07-16 04:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `services_ratings`
--

CREATE TABLE `services_ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `services_id` bigint UNSIGNED NOT NULL,
  `portfolio_id` bigint UNSIGNED DEFAULT NULL,
  `comment` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services_ratings`
--

INSERT INTO `services_ratings` (`id`, `user_id`, `services_id`, `portfolio_id`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(13, 3, 2, NULL, 'Thank you somuch for the service', 5, 0, '2024-07-14 05:41:36', '2024-07-25 21:53:55'),
(14, 2, 2, NULL, 'Many many thanks ; I was very happy', 4, 0, '2024-07-14 09:44:36', '2024-07-14 09:44:36'),
(15, 2, 2, NULL, 'This is about my 2nd project you have done successfully. Thank you', 5, 0, '2024-07-14 09:57:42', '2024-07-14 09:57:42'),
(16, 4, 1, NULL, 'Thank you so much for this service. I was very happy with you.', 5, 1, '2024-07-25 21:08:42', '2024-07-25 22:08:25');

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
('tTNgZjmK2bji767jTIm0KdnBsy6evXhlafL0QmVH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaU14Nzh2bzFsUEk5UU93dk9wN0Q1Q3J3TG9mQ2tIMHFJS1AyNzlnVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9wb3J0Zm9saW8uY29tLnRlc3QvdmlzaXRvcnMiO31zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czozOiJ1cmwiO2E6MDp7fX0=', 1721982118);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `address`, `phone`, `user_type`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', NULL, NULL, NULL, 0, 1, '2024-07-14 01:23:19', '$2y$12$u8WDJ4b4a2LwX3apBmNm4.6wzyHnXG66fonwDjpi5bBmdY3qZcVLG', 'IXqgaGbDcv', '2024-07-14 01:23:19', '2024-07-14 01:23:19'),
(2, 'Rony Islam Roni', 'jon2@gmail.com', 'user-profile-img/white-500x500.jpg', 'new adderss', '01938759999', 1, 1, NULL, '$2y$12$A2Lz9XAekH.sFjbfTQeL..5PnsD7jfywNX.DxcQoRhJR8UJxpoytm', NULL, '2024-07-14 01:24:46', '2024-07-15 00:32:33'),
(3, 'Benojir Ahommed', 'toni1@gmail.com', 'user-profile-img/image-819884-1719194251.jpg', 'Toni islam address , Dhaka', '01773965959', 1, 1, NULL, '$2y$12$hN30EOae3hr5jO0792HzSuvNohrwE2WzqHtD103eyEpMmgqeO3Yqq', NULL, '2024-07-14 05:33:53', '2024-07-17 06:25:57'),
(4, 'Habib', 'habib1@gmail.com', 'user-profile-img/contractor-website-design.jpg', '1/C Sorkarpara, 4 no Risikul, Godagari, Rajshai-2', '01779635952', 1, 1, NULL, '$2y$12$OlXXPiYe2ZD0.scti4c/7.UD/cqDFNImNE2E7Lvs.X6G2Y.ug3BIS', NULL, '2024-07-15 01:07:11', '2024-07-25 18:59:26'),
(6, 'Rubi', 'rubi@gmail.com', NULL, NULL, '01938559995', 0, 1, NULL, '$2y$12$t7BHpj/yoJxW66PRawjRzuhzz4uqJv6Qtj5U0FscB.CHCynwcT9mS', NULL, '2024-07-15 01:18:55', '2024-07-15 01:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `ip_address`, `user_agent`, `url`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'http://portfolio.com.test', '2024-07-25 19:39:19', '2024-07-25 19:39:19'),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'http://portfolio.com.test', '2024-07-25 19:39:50', '2024-07-25 19:39:50'),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'http://portfolio.com.test/visitors', '2024-07-25 19:40:04', '2024-07-25 19:40:04'),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test', '2024-07-25 19:41:05', '2024-07-25 19:41:05'),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-page-service', '2024-07-25 19:42:36', '2024-07-25 19:42:36'),
(6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 19:42:47', '2024-07-25 19:42:47'),
(7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/user-dashboad', '2024-07-25 19:45:52', '2024-07-25 19:45:52'),
(8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/logout', '2024-07-25 19:46:09', '2024-07-25 19:46:09'),
(9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/user-login', '2024-07-25 19:46:09', '2024-07-25 19:46:09'),
(10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/register', '2024-07-25 19:46:23', '2024-07-25 19:46:23'),
(11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test', '2024-07-25 20:36:45', '2024-07-25 20:36:45'),
(12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-page-service', '2024-07-25 20:37:45', '2024-07-25 20:37:45'),
(13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 20:37:47', '2024-07-25 20:37:47'),
(14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-page-service', '2024-07-25 20:37:56', '2024-07-25 20:37:56'),
(15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 20:37:59', '2024-07-25 20:37:59'),
(16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test', '2024-07-25 20:38:00', '2024-07-25 20:38:00'),
(17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-portfolio-details/1/details', '2024-07-25 20:38:03', '2024-07-25 20:38:03'),
(18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-page-service', '2024-07-25 20:38:12', '2024-07-25 20:38:12'),
(19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 20:38:14', '2024-07-25 20:38:14'),
(20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/user-login', '2024-07-25 21:07:39', '2024-07-25 21:07:39'),
(21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/user-login', '2024-07-25 21:07:52', '2024-07-25 21:07:52'),
(22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/user-login', '2024-07-25 21:08:01', '2024-07-25 21:08:01'),
(23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/user-dashboad', '2024-07-25 21:08:01', '2024-07-25 21:08:01'),
(24, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-page-service', '2024-07-25 21:08:05', '2024-07-25 21:08:05'),
(25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:08:07', '2024-07-25 21:08:07'),
(26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/save-rating/1', '2024-07-25 21:08:42', '2024-07-25 21:08:42'),
(27, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:08:42', '2024-07-25 21:08:42'),
(28, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:22:17', '2024-07-25 21:22:17'),
(29, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:23:28', '2024-07-25 21:23:28'),
(30, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:24:29', '2024-07-25 21:24:29'),
(31, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:25:26', '2024-07-25 21:25:26'),
(32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:34:18', '2024-07-25 21:34:18'),
(33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:34:35', '2024-07-25 21:34:35'),
(34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:34:47', '2024-07-25 21:34:47'),
(35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:36:17', '2024-07-25 21:36:17'),
(36, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:36:44', '2024-07-25 21:36:44'),
(37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:36:44', '2024-07-25 21:36:44'),
(38, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:36:45', '2024-07-25 21:36:45'),
(39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:37:20', '2024-07-25 21:37:20'),
(40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:37:46', '2024-07-25 21:37:46'),
(41, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:38:24', '2024-07-25 21:38:24'),
(42, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:46:24', '2024-07-25 21:46:24'),
(43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:47:20', '2024-07-25 21:47:20'),
(44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 21:52:49', '2024-07-25 21:52:49'),
(45, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 22:08:27', '2024-07-25 22:08:27'),
(46, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 23:09:00', '2024-07-25 23:09:00'),
(47, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 23:09:04', '2024-07-25 23:09:04'),
(48, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'http://portfolio.com.test/single-view-service/1', '2024-07-25 23:09:08', '2024-07-25 23:09:08'),
(49, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'http://portfolio.com.test/admin/login', '2024-07-26 01:40:56', '2024-07-26 01:40:56'),
(50, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'http://portfolio.com.test/admin/login', '2024-07-26 01:41:00', '2024-07-26 01:41:00'),
(51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'http://portfolio.com.test/admin-login', '2024-07-26 02:05:10', '2024-07-26 02:05:10'),
(52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'http://portfolio.com.test/admin/login', '2024-07-26 02:05:10', '2024-07-26 02:05:10'),
(53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'http://portfolio.com.test/admin/login', '2024-07-26 02:05:21', '2024-07-26 02:05:21'),
(54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'http://portfolio.com.test/admin/login', '2024-07-26 02:05:22', '2024-07-26 02:05:22'),
(55, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'http://portfolio.com.test/admin/login', '2024-07-26 02:05:25', '2024-07-26 02:05:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_payments_user_id_foreign` (`user_id`),
  ADD KEY `customer_payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_portfolio_id_foreign` (`portfolio_id`);

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
-- Indexes for table `mains`
--
ALTER TABLE `mains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `portfolios_slug_unique` (`slug`),
  ADD KEY `portfolios_category_id_foreign` (`category_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_ratings`
--
ALTER TABLE `services_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_ratings_user_id_foreign` (`user_id`),
  ADD KEY `services_ratings_services_id_foreign` (`services_id`),
  ADD KEY `services_ratings_portfolio_id_foreign` (`portfolio_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mains`
--
ALTER TABLE `mains`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services_ratings`
--
ALTER TABLE `services_ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD CONSTRAINT `customer_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD CONSTRAINT `customer_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `customer_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_portfolio_id_foreign` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services_ratings`
--
ALTER TABLE `services_ratings`
  ADD CONSTRAINT `services_ratings_portfolio_id_foreign` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_ratings_services_id_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
