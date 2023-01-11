-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 02:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(30) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `cost_price` int(30) NOT NULL,
  `selling_price` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `barcode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `cost_price`, `selling_price`, `quantity`, `created_at`, `updated_at`, `barcode`) VALUES
(1, 'tea', 1, 2, 500, '2022-12-20 21:10:53', '2023-01-09 14:03:39', '19952023'),
(18, 'water', 3, 4, 82, '2022-12-31 19:30:38', '2023-01-09 22:57:25', '0'),
(19, 'coffee', 1, 6, -12, '2022-12-31 19:30:55', '2023-01-09 21:30:49', '0'),
(20, 'candy', 2, 8, 0, '2023-01-01 12:49:31', '2023-01-05 17:44:43', '0'),
(23, 'pepsi', 1, 2, 299, '2023-01-08 19:46:07', '2023-01-09 21:31:05', ''),
(33, 'Pen', 1, 2, 300, '2023-01-09 22:30:52', '2023-01-09 22:30:52', ''),
(34, 'Gas', 20, 30, 800, '2023-01-09 22:31:15', '2023-01-09 23:05:23', ''),
(35, 'Bleach', 2, 4, 358, '2023-01-09 22:31:43', '2023-01-09 22:59:14', ''),
(36, 'Bankai', 30, 50, 299, '2023-01-09 22:32:08', '2023-01-09 22:55:23', '');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(30) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `selling_price` int(30) NOT NULL,
  `quantity` int(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_sales` int(10) NOT NULL,
  `item_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `item_name`, `selling_price`, `quantity`, `created_at`, `updated_at`, `total_sales`, `item_id`) VALUES
(1297, 'water', 4, 2, '2023-01-07 21:27:39', '2023-01-07 21:27:39', 8, 18),
(1298, 'coffee', 6, 4, '2023-01-07 21:27:46', '2023-01-07 21:27:46', 24, 19),
(1299, 'tea', 2, 4, '2023-01-07 21:27:50', '2023-01-07 21:27:50', 8, 1),
(1300, 'water', 4, 10, '2023-01-07 23:21:19', '2023-01-07 23:21:19', 40, 18),
(1301, 'water', 4, 5, '2023-01-08 19:14:47', '2023-01-08 19:14:47', 20, 18),
(1302, 'coffee', 6, 6, '2023-01-08 19:41:20', '2023-01-08 19:41:20', 36, 19),
(1308, 'coffee', 6, 22, '2023-01-09 21:30:49', '2023-01-09 21:30:49', 132, 19),
(1311, 'Bankai', 50, 1, '2023-01-09 22:34:43', '2023-01-09 22:34:43', 50, 36),
(1313, 'Bleach', 4, 2, '2023-01-09 22:59:14', '2023-01-09 22:59:14', 8, 35);

-- --------------------------------------------------------

--
-- Table structure for table `transactions_users`
--

CREATE TABLE `transactions_users` (
  `id` int(20) UNSIGNED NOT NULL,
  `transaction_id` int(30) UNSIGNED NOT NULL,
  `user_id` int(30) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions_users`
--

INSERT INTO `transactions_users` (`id`, `transaction_id`, `user_id`) VALUES
(142, 1297, 12),
(143, 1298, 12),
(144, 1299, 12),
(145, 1300, 12),
(146, 1301, 12),
(147, 1302, 17),
(153, 1308, 12),
(156, 1311, 12),
(158, 1313, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(50) NOT NULL,
  `permissions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `display_name`, `username`, `email`, `password`, `role`, `permissions`, `created_at`, `updated_at`) VALUES
(12, 'Messi ', 'super.admin', 'super@admin', '$2y$10$iMFdcdvMn498Fuy6ghw1a.FqxiXB7LDQquqBCkRoeNqLgEw51Uqju', 'admin', 'a:13:{i:0;s:12:\"items:create\";i:1;s:10:\"items:read\";i:2;s:12:\"items:update\";i:3;s:12:\"items:delete\";i:4;s:19:\"transactions:create\";i:5;s:17:\"transactions:read\";i:6;s:19:\"transactions:update\";i:7;s:19:\"transactions:delete\";i:8;s:12:\"users:create\";i:9;s:10:\"users:read\";i:10;s:12:\"users:update\";i:11;s:12:\"users:delete\";i:12;s:14:\"dashboard:read\";}', '2023-01-09 01:30:15', '2023-01-09 01:30:15'),
(14, 'Accountant', 'accountant', 'accountant@user.com', '$2y$10$iMFdcdvMn498Fuy6ghw1a.FqxiXB7LDQquqBCkRoeNqLgEw51Uqju', 'accountant', 'a:3:{i:0;s:17:\"transactions:read\";i:1;s:19:\"transactions:update\";i:2;s:19:\"transactions:delete\";}', '2023-01-03 21:25:01', '2023-01-03 21:25:01'),
(15, 'Jon', 'procure', 'procure@user.com', '$2y$10$iMFdcdvMn498Fuy6ghw1a.FqxiXB7LDQquqBCkRoeNqLgEw51Uqju', 'procurement', 'a:4:{i:0;s:12:\"items:create\";i:1;s:10:\"items:read\";i:2;s:12:\"items:update\";i:3;s:12:\"items:delete\";}', '2023-01-03 21:25:09', '2023-01-03 21:25:09'),
(17, 'seller bankai', 'bankai', 'bankai@user.com', '$2y$10$qFos7H2I7cVXkKNo6J80puWKh3NqACEiaXGefck2LzoaFseeJpePS', 'seller', 'a:1:{i:0;s:19:\"transactions:create\";}', '2023-01-09 21:20:57', '2023-01-09 21:20:57'),
(19, 'Jon Snow', 'lord.snow', 'snow@user.com', '$2y$10$1PaLj4iCZ3vAea5A3lN4TeVl6ILs9pJWueAvyhgh0XopWXFdV4vjm', 'seller', 'a:1:{i:0;s:19:\"transactions:create\";}', '2023-01-09 23:04:37', '2023-01-09 23:04:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions_users`
--
ALTER TABLE `transactions_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1315;

--
-- AUTO_INCREMENT for table `transactions_users`
--
ALTER TABLE `transactions_users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
