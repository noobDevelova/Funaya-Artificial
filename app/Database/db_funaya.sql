-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 16, 2025 at 02:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_funaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'Electronics Baru Test', 'electronics-baru-test', 'Electronics Baru', '2025-01-25 19:29:22', '2025-02-01 09:17:44', NULL),
(13, 'Furniture', 'furniture', 'Various types of furniture for home and office.', '2025-01-25 19:29:22', '2025-01-25 19:29:22', NULL),
(14, 'Clothing', 'clothing', 'Fashionable clothing for men, women, and children.', '2025-01-25 19:29:22', '2025-01-25 19:29:22', NULL),
(15, 'Books', 'books', 'A collection of books ranging from fiction to non-fiction.', '2025-01-25 19:29:22', '2025-01-25 19:29:22', NULL),
(16, 'Groceries', 'groceries', 'Daily essentials and food items.', '2025-01-25 19:29:22', '2025-01-25 19:29:22', NULL),
(17, 'Toys', 'toys', 'Toys for kids, including educational and entertainment items.', '2025-01-25 19:29:22', '2025-01-25 19:29:22', NULL),
(18, 'Sports', 'sports', 'Sports equipment and apparel for various activities.', '2025-01-25 19:29:22', '2025-01-25 19:29:22', NULL),
(19, 'Beauty & Personal Care', 'beauty-personal-care', 'Skincare, makeup, and personal care products.', '2025-01-25 19:29:51', '2025-02-16 02:24:29', '2025-02-16 02:24:29'),
(20, 'Health & Wellness', 'health-wellness', 'Health supplements, fitness products, and wellness items.', '2025-01-25 19:29:51', '2025-01-27 10:45:06', '2025-01-27 10:45:06'),
(21, 'Automotive', 'automotive', 'Automotive parts, accessories, and tools.', '2025-01-25 19:29:51', '2025-01-25 19:29:51', NULL),
(22, 'Home Appliances', 'home-appliances', 'Appliances for cooking, cleaning, and home improvement.', '2025-01-25 19:29:51', '2025-01-25 19:29:51', NULL),
(23, 'Garden & Outdoor', 'garden-outdoor', 'Outdoor furniture, gardening tools, and outdoor decor.', '2025-01-25 19:29:51', '2025-01-25 19:29:51', NULL),
(24, 'Pet Supplies', 'pet-supplies', 'Products for pet care, including food, toys, and accessories.', '2025-01-25 19:29:51', '2025-01-27 10:45:14', '2025-01-27 10:45:14'),
(25, 'Stationery', 'stationery', 'Paper, pens, and office supplies for school or office use.', '2025-01-25 19:29:51', '2025-01-25 19:29:51', NULL),
(31, 'Test test ', 'test-test', 'Test test ', '2025-01-26 08:11:01', '2025-01-27 10:44:13', '2025-01-27 10:44:13'),
(32, 'Test Kategori Edit', 'test-kategori-edit', 'Test Kategori baru', '2025-02-01 03:09:49', '2025-02-01 03:10:21', '2025-02-01 03:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_logs`
--

CREATE TABLE `inventory_logs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `activity_type` enum('stock_in','stock_out','adjustment') NOT NULL,
  `quantity` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `logged_by` int(11) NOT NULL,
  `logged_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_logs`
--

INSERT INTO `inventory_logs` (`id`, `product_id`, `activity_type`, `quantity`, `remarks`, `logged_by`, `logged_at`) VALUES
(1, 52, 'stock_in', 200, 'Pemasukan Stok Barang', 1, '2025-02-09 12:19:17'),
(2, 54, 'stock_in', 200, 'Pemasukan Stok Barang', 1, '2025-02-09 12:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `minimum_stock` int(11) DEFAULT 0,
  `unit` varchar(50) DEFAULT 'pcs',
  `category_id` int(11) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `show_on_catalog` tinyint(1) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `price`, `stock`, `minimum_stock`, `unit`, `category_id`, `cover_image`, `created_by`, `updated_by`, `created_at`, `updated_at`, `show_on_catalog`, `deleted_at`, `is_active`) VALUES
(52, 'Testing produk 1', 'testing-produk-1', 90000.00, 200, 90, 'pcs', 17, 'testing-produk-1.jpg', 1, 1, '2025-02-04 15:33:23', '2025-02-16 01:54:12', 1, NULL, 1),
(53, 'Testing produk 2', 'testing-produk-2', 120000.00, 0, 20, 'pcs', 15, 'testing-produk-2.png', 1, 1, '2025-02-05 13:44:43', '2025-02-16 02:32:28', 0, '2025-02-16 02:32:28', 0),
(54, 'Testing produk 3', 'testing-produk-3', 9000000.00, 180, 12, 'pcs', 17, 'bunga-bangkay.jpg', 1, 1, '2025-02-05 13:45:41', '2025-02-16 01:55:32', 1, NULL, 1),
(57, 'Bunga Raya', 'bunga-raya', 9000.00, 0, 90, 'pcs', 17, 'bunga-raya.png', 1, NULL, '2025-02-10 06:27:59', '2025-02-10 06:27:59', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(30) DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `material` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `additional_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `color`, `size`, `material`, `description`, `additional_info`) VALUES
(45, 52, 'test warna', 'test uk', 'test bahan', 'test', 'testing'),
(46, 53, 'test', 'test', 'test', 'test', NULL),
(47, 54, 'test', 'test', 'test', 'test', 'test test test test'),
(50, 57, 'test', 'test', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(15,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `purchase_date`, `total_amount`, `created_by`, `created_at`) VALUES
(11, 6, '2025-02-09 12:19:17', 400000000.00, 1, '2025-02-09 12:19:17'),
(12, 7, '2025-02-09 12:19:34', 30000000.00, 1, '2025-02-09 12:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(15,2) GENERATED ALWAYS AS (`quantity` * `price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `price`) VALUES
(11, 11, 52, 200, 2000000.00),
(12, 12, 54, 200, 150000.00);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'manager', '2024-12-25 07:26:40', '2024-12-25 07:26:40'),
(2, 'employee', '2024-12-25 07:26:40', '2024-12-25 07:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(15,2) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `sale_date`, `total_amount`, `created_by`) VALUES
(3, '2025-02-11 20:26:48', 2760000.00, 1),
(4, '2025-02-11 20:28:11', 180000000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(15,2) GENERATED ALWAYS AS (`quantity` * `price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `price`) VALUES
(4, 3, 53, 23, 120000.00),
(5, 4, 54, 20, 9000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `adjustment_type` enum('addition','subtraction') NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `adjusted_by` int(11) NOT NULL,
  `adjusted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `slug`, `contact_person`, `phone`, `email`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Supplier A Test Edit', 'supplier-a-test-edit', 'John Doe ', '081234567890', 'suppliera@example.com', 'Jl. Raya No. 1, Jakarta', '2025-01-19 03:23:03', '2025-02-01 10:19:09', '2025-02-01 10:19:09'),
(2, 'Supplier B', 'supplier-b', 'Jane Doe', '082345678901', 'supplierb@example.com', 'Jl. Merdeka No. 2, Bandung', '2025-01-19 03:23:03', '2025-01-29 17:15:47', NULL),
(3, 'Supplier C', 'supplier-c', 'Michael Smith', '083456789012', 'supplierc@example.com', 'Jl. Sudirman No. 3, Surabaya', '2025-01-19 03:23:03', '2025-02-01 09:31:30', NULL),
(5, 'test edit data anjeng', 'test-edit-data-anjeng', 'test', '9879879879898', 'test@gmail.com', '1233423234', '2025-01-25 14:10:27', '2025-02-01 10:19:29', '2025-02-01 10:19:29'),
(6, 'PT. Exync Developer Team', 'pt-exync-developer-team', 'Adrian Des', '0980988798798', 'test@gmail.com', 'Jl. Kebagusan Raya no. 80', '2025-01-25 14:17:27', '2025-02-01 09:35:39', NULL),
(7, 'PT. Ayam Cemani', 'pt-ayam-cemani', 'test', '0980980980', 'test@gmail.com', '1231231311', '2025-01-25 14:19:34', '2025-02-01 09:25:43', NULL),
(8, 'PT. Kode', 'pt-kode', 'Test', '09809809809', 'test@gmail.com', '12313324234235', '2025-01-25 14:33:57', '2025-01-29 17:16:29', NULL),
(10, 'Test Supplier', 'test-supplier', 'Test Nama', '80909089890', 'test@gmail.com', 'Jl. Kebagusan Raya no. 80', '2025-01-27 13:47:27', '2025-02-01 10:19:04', '2025-02-01 10:19:04'),
(11, 'Test Supplier Baru', 'test-supplier-baru', 'Supplier Baru', '08998980898', 'test@gmail.com', 'test jalan baru', '2025-02-01 04:13:56', '2025-02-01 04:13:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `is_active`, `email`, `phone_number`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'testmanager', '$2y$10$wgMt/fnQbQKKFCNW5kNCz.gk6VcGzKRG.rMtkqt.ViN7i32nWF1PG', 1, 1, 'testmanager@funaya.com', '098980978789', '2025-02-16 06:08:59', '2024-12-25 07:27:58', '2025-02-16 13:08:59', NULL),
(44, 'testmanager2', '$2y$10$pL9kkodQ/b9QnAWqYFQIMuatj/rkKrw7nowq1DQbmRgMzKLWnSq.O', 1, 0, 'testmanager2@funaya.com', '086767788726', NULL, '2025-02-03 07:12:35', '2025-02-16 01:52:08', NULL),
(45, 'manager001', '$2y$10$abcd1234efgh5678ijklmnopqrstuvwx', 1, 1, 'admin001@example.com', '081111111111', '2024-07-31 01:00:00', '2025-02-16 04:55:53', '2025-02-15 22:49:19', NULL),
(46, 'admin002', '$2y$10$wxyz5678mnop1234abcdijklqrstuvwx', 1, 0, 'admin002@example.com', '081222222222', '2024-07-30 02:15:00', '2025-02-16 04:55:53', '2025-02-16 01:52:15', NULL),
(47, 'admin003', '$2y$10$mnop1234wxyz5678qrstabcdefuvwx', 1, 1, 'admin003@example.com', '081333333333', '2024-07-23 08:30:00', '2025-02-16 04:55:53', '2025-02-16 04:55:53', NULL),
(48, 'admin004', '$2y$10$qrst5678mnop1234wxyzabcdefuvwx', 1, 1, 'admin004@example.com', '081444444444', '2024-07-22 07:00:00', '2025-02-16 04:55:53', '2025-02-16 04:55:53', NULL),
(49, 'admin005', '$2y$10$ijkl1234abcd5678mnopqrstuvwxwz', 1, 1, 'admin005@example.com', '081555555555', '2024-07-21 09:45:00', '2025-02-16 04:55:53', '2025-02-16 04:55:53', NULL),
(50, 'karyawan001', '$2y$10$abcdef1234wxyz5678mnopqrstuvwx', 2, 1, 'karyawan001@example.com', '082111111111', '2024-07-29 07:10:00', '2025-02-16 04:55:53', '2025-02-16 00:34:35', NULL),
(51, 'karyawan002', '$2y$10$lmnop9876qrst5432uvwxyzabcdefgh', 2, 1, 'karyawan002@example.com', '082222222222', '2024-07-28 13:05:00', '2025-02-16 04:55:53', '2025-02-16 04:55:53', NULL),
(52, 'karyawan003', '$2y$10$uvwx5678mnop1234ijklabcdefqrst', 2, 1, 'karyawan003@example.com', '082333333333', '2024-07-27 04:30:00', '2025-02-16 04:55:53', '2025-02-16 00:34:04', '2025-02-16 00:34:04'),
(53, 'karyawan004', '$2y$10$abcd5678qrst1234wxyzmnopuvwxjk', 2, 1, 'karyawan004@example.com', '082444444444', '2024-07-26 10:50:00', '2025-02-16 04:55:53', '2025-02-16 00:34:10', '2025-02-16 00:34:10'),
(54, 'karyawan005', '$2y$10$mnop1234wxyz5678qrstabcdefuvwx', 2, 1, 'karyawan005@example.com', '082555555555', '2024-07-25 06:25:00', '2025-02-16 04:55:53', '2025-02-16 00:34:14', '2025-02-16 00:34:14'),
(55, 'karyawan006', '$2y$10$qrst5678mnop1234wxyzabcdefuvwx', 2, 1, 'karyawan006@example.com', '082666666666', '2024-07-24 03:45:00', '2025-02-16 04:55:53', '2025-02-16 04:55:53', NULL),
(56, 'karyawan007', '$2y$10$ijkl1234abcd5678mnopqrstuvwxwz', 2, 1, 'karyawan007@example.com', '082777777777', '2024-07-23 08:30:00', '2025-02-16 04:55:53', '2025-02-16 04:55:53', NULL),
(57, 'testmanager3', '$2y$10$5I0eGezdzwQkX1jVOMfWjudCJDHFfEo5SeM3x0JuMrMkcijK1.cwS', 1, 0, 'testmanager3@funaya.com', '0899988777661', NULL, '2025-02-15 23:14:04', '2025-02-15 23:14:04', NULL),
(58, 'testkaryawan', '$2y$10$XkB3lJZx/TCGIvpdUvUNLOEFRJE./jqqix4xMEx4XMjIiBRZLe18e', 2, 1, 'testkaryawan@gmail.com', '0897776877881', '2025-02-16 06:09:14', '2025-02-16 06:08:03', '2025-02-16 13:09:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `logged_by` (`logged_by`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_ibfk_1` (`created_by`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_ibfk_1` (`sale_id`),
  ADD KEY `sale_items_ibfk_2` (`product_id`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `adjusted_by` (`adjusted_by`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  ADD CONSTRAINT `inventory_logs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_logs_ibfk_2` FOREIGN KEY (`logged_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `purchase_items_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD CONSTRAINT `stock_adjustments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_adjustments_ibfk_2` FOREIGN KEY (`adjusted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
