-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 08:03 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicinepoint_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_10_172612_create_employees_table', 1),
(5, '2020_08_15_000005_create_t_status_table', 1),
(6, '2021_02_21_210607_create_t_product_category_table', 1),
(7, '2021_03_05_204926_create_t_products_table', 1),
(8, '2021_03_19_113311_create_t_blog_table', 1),
(9, '2021_03_20_233714_create_t_farmerproductsreg_table', 1),
(10, '2021_03_25_224439_create_t_orders_table', 1),
(11, '2021_03_25_225624_create_t_ordersitems_table', 1),
(12, '2021_07_10_000705_create_t_transaction_table', 1),
(13, '2021_07_26_211440_create_t_orders_tmp', 1),
(14, '2021_07_26_211513_create_t_ordersitems_tmp', 1);

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
-- Table structure for table `t_blog`
--

CREATE TABLE `t_blog` (
  `BlogId` int(10) UNSIGNED NOT NULL,
  `BlogType` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BlogDateTime` datetime NOT NULL,
  `BlogTitle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Thumbnail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `EmbedCode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_blog`
--

INSERT INTO `t_blog` (`BlogId`, `BlogType`, `BlogDateTime`, `BlogTitle`, `Thumbnail`, `EmbedCode`, `Content`, `created_at`, `updated_at`) VALUES
(1, 'Text', '2022-01-23 10:15:10', 'Blood Pressure Check', 'blog/DWKHiBbxn0mpfUPhykbRUPl32wJwhWejP4OMS92d.jpeg', NULL, 'Measure your blood pressure regularly to help your health care team diagnose any health problems early.', NULL, NULL),
(2, 'Video', '2022-01-06 21:30:32', 'Corona Virus Advisory', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/4j1geg4RMv0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'The COVID-19 battle can only be won by understanding every symptom and following all precautionary measures prescribed by the medical professionals. Contact your nearest govt authorized VRDL centre or call on the helpline no. 011-23978046 if you see these symptoms. Stay safe!', NULL, NULL),
(3, 'Video', '2021-12-30 15:14:33', 'COVID-19 Information Series', 'blog/IZ3bkC03W94dBH9CiWd7IEVT3vQG8lh38mej2hno.jpeg', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Z430CwVBU8E\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'How to overcome COVID-19', NULL, NULL),
(4, 'Text', '2021-12-01 18:25:11', 'Physical exercise', 'blog/Mbfv90UYwVribTUC5gwCLnVPNG9ZPqLUlznZusfK.jpeg', NULL, 'Physical exercise means the regular movement of the limbs of our body according to rules. It is very much essential to keep our body fit and mind sound. There lies a close relationship between our body and mind. We cannot think of a sound and fresh mind without a sound health. It is a physical exercise which enables us to build sound health. Physical exercise makes our body active and the muscles more strong. It also improves our power of digestion and blood circulation.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_farmerproductsreg`
--

CREATE TABLE `t_farmerproductsreg` (
  `FProductId` int(10) UNSIGNED NOT NULL,
  `UserId` bigint(20) UNSIGNED NOT NULL,
  `RegDate` datetime NOT NULL,
  `ProductId` int(10) UNSIGNED NOT NULL,
  `Availability` int(11) NOT NULL,
  `Status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AppCancellDate` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_orders`
--

CREATE TABLE `t_orders` (
  `OrdersId` int(10) UNSIGNED NOT NULL,
  `UserId` bigint(20) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `TotalPrice` double(12,2) NOT NULL DEFAULT 0.00,
  `BuyerName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsPayment` smallint(6) NOT NULL DEFAULT 0,
  `ReadyOrCancellDate` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_orders`
--

INSERT INTO `t_orders` (`OrdersId`, `UserId`, `OrderDate`, `TotalPrice`, `BuyerName`, `Phone`, `Address`, `Status`, `IsPayment`, `ReadyOrCancellDate`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-01-01 23:00:58', 500.00, NULL, '', '', 'Order', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_ordersitems`
--

CREATE TABLE `t_ordersitems` (
  `OrdersItemId` int(10) UNSIGNED NOT NULL,
  `OrdersId` int(10) UNSIGNED NOT NULL,
  `ProductId` int(10) UNSIGNED NOT NULL,
  `Qty` double(12,2) NOT NULL DEFAULT 0.00,
  `UnitPrice` double(12,2) NOT NULL DEFAULT 0.00,
  `TotalPrice` double(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_ordersitems`
--

INSERT INTO `t_ordersitems` (`OrdersItemId`, `OrdersId`, `ProductId`, `Qty`, `UnitPrice`, `TotalPrice`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20.00, 1.00, 20.00, NULL, NULL),
(2, 1, 3, 1.00, 80.00, 80.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_ordersitems_tmp`
--

CREATE TABLE `t_ordersitems_tmp` (
  `OrdersItemId` int(10) UNSIGNED NOT NULL,
  `OrdersId` int(10) UNSIGNED NOT NULL,
  `ProductId` int(10) UNSIGNED NOT NULL,
  `Qty` double(12,2) NOT NULL DEFAULT 0.00,
  `UnitPrice` double(12,2) NOT NULL DEFAULT 0.00,
  `TotalPrice` double(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_ordersitems_tmp`
--

INSERT INTO `t_ordersitems_tmp` (`OrdersItemId`, `OrdersId`, `ProductId`, `Qty`, `UnitPrice`, `TotalPrice`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1.00, 1350.00, 1350.00, NULL, NULL),
(2, 2, 1, 2.00, 1350.00, 2700.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_orders_tmp`
--

CREATE TABLE `t_orders_tmp` (
  `OrdersId` int(10) UNSIGNED NOT NULL,
  `OrderDate` datetime NOT NULL,
  `TotalPrice` double(12,2) NOT NULL DEFAULT 0.00,
  `BuyerName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsPayment` smallint(6) NOT NULL DEFAULT 0,
  `ReadyOrCancellDate` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_orders_tmp`
--

INSERT INTO `t_orders_tmp` (`OrdersId`, `OrderDate`, `TotalPrice`, `BuyerName`, `Phone`, `Address`, `Status`, `IsPayment`, `ReadyOrCancellDate`, `created_at`, `updated_at`) VALUES
(1, '2022-01-22 00:13:30', 1350.00, 'kjh', '01921232956', '2', 'Order', 0, NULL, NULL, NULL),
(2, '2022-01-22 00:13:57', 2700.00, '3213', '01921232956', '2', 'Order', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_products`
--

CREATE TABLE `t_products` (
  `ProductId` int(10) UNSIGNED NOT NULL,
  `ProdCatId` int(10) UNSIGNED NOT NULL,
  `ProductName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` double(12,2) NOT NULL DEFAULT 0.00,
  `ImageURL` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Remarks` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Availability` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_products`
--

INSERT INTO `t_products` (`ProductId`, `ProdCatId`, `ProductName`, `Price`, `ImageURL`, `Remarks`, `Availability`, `created_at`, `updated_at`) VALUES
(1, 1, 'Napa 500mg', 1.00, 'products/9yzGveyWN2abFVhQNPYh3xM5oh2NAU7E8IyEkkcA.jpeg', 'Napa tablet of Beximco Pharmaceuticals Ltd.', 600, NULL, NULL),
(2, 1, 'Ace 500mg', 1.00, 'products/bgHJXWd9IDa7uaXbIUNPUi9Nw9QwZESTV6FUPJU3.jpeg', 'Paracetamol tablet of Square Pharmaceuticals Ltd.', 300, NULL, NULL),
(3, 6, 'Calbo C', 80.00, 'products/LqncLUDwht1lOsKxNMJ0S6sD2f5OkaEukr1Y9L5A.jpeg', 'Calcium and Vitamin C of Square Pharmaceuticals Ltd.', 100, NULL, NULL),
(4, 1, 'Fexo 120mg', 8.00, 'products/rcC6dH78VPFlqU0wH9fFS6qKkzNRxCB7BrblBIsk.jpeg', 'Fexo tablet of Square Pharmaceuticals Ltd.', 500, NULL, NULL),
(5, 2, 'Sergel 20mg', 7.00, 'products/yljB619UXhmYjA7mB1Fdvk8NvSdI5rpd7pF19lwZ.jpeg', 'Sergel tablet of Healthcare Pharmaceuticals Ltd.', 550, NULL, NULL),
(6, 1, 'Seclo 20mg', 6.00, 'products/7S6f602VRLOEH0lCapyKcxPJnBRKrmNfkeLEAbr0.jpeg', 'Seclo tablet of Square Pharmaceuticals Ltd.', 300, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_product_category`
--

CREATE TABLE `t_product_category` (
  `ProdCatId` int(10) UNSIGNED NOT NULL,
  `CategoryName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_product_category`
--

INSERT INTO `t_product_category` (`ProdCatId`, `CategoryName`, `created_at`, `updated_at`) VALUES
(1, 'Tablet', NULL, NULL),
(2, 'Capsule', NULL, NULL),
(3, 'Injection', NULL, NULL),
(4, 'Syrup', NULL, NULL),
(6, 'Bottle', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_status`
--

CREATE TABLE `t_status` (
  `Status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SerialNo` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_status`
--

INSERT INTO `t_status` (`Status`, `SerialNo`, `created_at`, `updated_at`) VALUES
('Accepted', 3, NULL, NULL),
('Canceled', 2, NULL, NULL),
('Dateover', 5, NULL, NULL),
('Issued', 4, NULL, NULL),
('Requested', 1, NULL, NULL),
('Returned', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_transaction`
--

CREATE TABLE `t_transaction` (
  `TransId` int(10) UNSIGNED NOT NULL,
  `TransDate` datetime NOT NULL,
  `FarmerId` int(10) UNSIGNED NOT NULL,
  `ProductId` int(10) UNSIGNED NOT NULL,
  `Qty` double(12,2) NOT NULL DEFAULT 0.00,
  `TransType` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usercode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userrole` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activestatus` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ImageURL` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usercode`, `name`, `email`, `userrole`, `activestatus`, `phone`, `address`, `nid`, `ImageURL`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'A00001', 'Administrator', 'administrator@esm.com', 'Admin', 'Active', '01689763654', 'Dhaka', '8954124574', NULL, NULL, '$2y$10$qMAGc1.OizBpoJpN3JbKTuTphmZWgnKKXpDA220GA8O2aULyEQaeS', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `t_blog`
--
ALTER TABLE `t_blog`
  ADD PRIMARY KEY (`BlogId`);

--
-- Indexes for table `t_farmerproductsreg`
--
ALTER TABLE `t_farmerproductsreg`
  ADD PRIMARY KEY (`FProductId`),
  ADD KEY `t_farmerproductsreg_productid_foreign` (`ProductId`),
  ADD KEY `t_farmerproductsreg_userid_foreign` (`UserId`);

--
-- Indexes for table `t_orders`
--
ALTER TABLE `t_orders`
  ADD PRIMARY KEY (`OrdersId`);

--
-- Indexes for table `t_ordersitems`
--
ALTER TABLE `t_ordersitems`
  ADD PRIMARY KEY (`OrdersItemId`),
  ADD KEY `t_ordersitems_productid_foreign` (`ProductId`),
  ADD KEY `t_ordersitems_ordersid_foreign` (`OrdersId`);

--
-- Indexes for table `t_ordersitems_tmp`
--
ALTER TABLE `t_ordersitems_tmp`
  ADD PRIMARY KEY (`OrdersItemId`);

--
-- Indexes for table `t_orders_tmp`
--
ALTER TABLE `t_orders_tmp`
  ADD PRIMARY KEY (`OrdersId`);

--
-- Indexes for table `t_products`
--
ALTER TABLE `t_products`
  ADD PRIMARY KEY (`ProductId`),
  ADD UNIQUE KEY `t_products_productname_unique` (`ProductName`),
  ADD KEY `t_products_prodcatid_foreign` (`ProdCatId`);

--
-- Indexes for table `t_product_category`
--
ALTER TABLE `t_product_category`
  ADD PRIMARY KEY (`ProdCatId`),
  ADD UNIQUE KEY `t_product_category_categoryname_unique` (`CategoryName`);

--
-- Indexes for table `t_status`
--
ALTER TABLE `t_status`
  ADD PRIMARY KEY (`Status`);

--
-- Indexes for table `t_transaction`
--
ALTER TABLE `t_transaction`
  ADD PRIMARY KEY (`TransId`),
  ADD KEY `t_transaction_productid_foreign` (`ProductId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usercode_unique` (`usercode`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_blog`
--
ALTER TABLE `t_blog`
  MODIFY `BlogId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_farmerproductsreg`
--
ALTER TABLE `t_farmerproductsreg`
  MODIFY `FProductId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_orders`
--
ALTER TABLE `t_orders`
  MODIFY `OrdersId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_ordersitems`
--
ALTER TABLE `t_ordersitems`
  MODIFY `OrdersItemId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_ordersitems_tmp`
--
ALTER TABLE `t_ordersitems_tmp`
  MODIFY `OrdersItemId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_orders_tmp`
--
ALTER TABLE `t_orders_tmp`
  MODIFY `OrdersId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_products`
--
ALTER TABLE `t_products`
  MODIFY `ProductId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_product_category`
--
ALTER TABLE `t_product_category`
  MODIFY `ProdCatId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_transaction`
--
ALTER TABLE `t_transaction`
  MODIFY `TransId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_farmerproductsreg`
--
ALTER TABLE `t_farmerproductsreg`
  ADD CONSTRAINT `t_farmerproductsreg_productid_foreign` FOREIGN KEY (`ProductId`) REFERENCES `t_products` (`ProductId`),
  ADD CONSTRAINT `t_farmerproductsreg_userid_foreign` FOREIGN KEY (`UserId`) REFERENCES `users` (`id`);

--
-- Constraints for table `t_ordersitems`
--
ALTER TABLE `t_ordersitems`
  ADD CONSTRAINT `t_ordersitems_ordersid_foreign` FOREIGN KEY (`OrdersId`) REFERENCES `t_orders` (`OrdersId`),
  ADD CONSTRAINT `t_ordersitems_productid_foreign` FOREIGN KEY (`ProductId`) REFERENCES `t_products` (`ProductId`);

--
-- Constraints for table `t_products`
--
ALTER TABLE `t_products`
  ADD CONSTRAINT `t_products_prodcatid_foreign` FOREIGN KEY (`ProdCatId`) REFERENCES `t_product_category` (`ProdCatId`);

--
-- Constraints for table `t_transaction`
--
ALTER TABLE `t_transaction`
  ADD CONSTRAINT `t_transaction_productid_foreign` FOREIGN KEY (`ProductId`) REFERENCES `t_products` (`ProductId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
