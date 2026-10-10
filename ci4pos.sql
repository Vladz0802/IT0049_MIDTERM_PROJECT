-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2026 at 03:51 AM
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
-- Database: `ci4pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'Juan Dela Cruz', 'juan.delacruz@example.com', '0917-111-2222', '2026-10-09 09:19:54'),
(2, 'Maria Santos', 'maria.santos@example.com', '0917-222-3333', '2026-10-09 09:19:54'),
(3, 'Pedro Reyes', 'pedro.reyes@example.com', '0917-333-4444', '2026-10-09 09:19:54'),
(4, 'Ana Lim', 'ana.lim@example.com', '0917-444-5555', '2026-10-09 09:19:54'),
(5, 'Carlo Bautista', 'carlo.bautista@example.com', '0917-555-6666', '2026-10-09 09:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock_quantity`, `image`, `created_at`) VALUES
(1, 'Instant Noodles (Cup)', 18.00, 60, NULL, '2026-10-09 09:19:54'),
(2, 'Canned Sardines 155g', 24.50, 40, NULL, '2026-10-09 09:19:54'),
(3, '3-in-1 Coffee Sachet', 7.00, 115, NULL, '2026-10-09 09:19:54'),
(4, 'Bottled Water 500ml', 15.00, 48, NULL, '2026-10-09 09:19:54'),
(5, 'Cola 1.5L', 68.00, 24, NULL, '2026-10-09 09:19:54'),
(6, 'White Sugar 1kg', 82.00, 15, NULL, '2026-10-09 09:19:54'),
(7, 'Laundry Soap Bar', 22.00, 30, NULL, '2026-10-09 09:19:54'),
(8, 'Egg (per piece)', 9.50, 5, NULL, '2026-10-09 09:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `sold_by` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `customer_id`, `sold_by`, `quantity`, `total_price`, `created_at`) VALUES
(1, 3, NULL, 1, 5, 35.00, '2026-10-10 01:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `avatar`, `created_at`) VALUES
(1, 'jcruz', 'Juan Dela Cruz', '$2y$10$zFzvWpag.EZru0xBu6eU4OIoVUShZlgEv1wgfrETcB4OovuxjmDMi', NULL, '2026-10-09 09:19:54'),
(2, 'msantos', 'Maria Santos', '$2y$10$zFzvWpag.EZru0xBu6eU4OIoVUShZlgEv1wgfrETcB4OovuxjmDMi', NULL, '2026-10-09 09:19:54'),
(3, 'preyes', 'Pedro Reyes', '$2y$10$zFzvWpag.EZru0xBu6eU4OIoVUShZlgEv1wgfrETcB4OovuxjmDMi', NULL, '2026-10-09 09:19:54'),
(4, 'alim', 'Ana Lim', '$2y$10$zFzvWpag.EZru0xBu6eU4OIoVUShZlgEv1wgfrETcB4OovuxjmDMi', NULL, '2026-10-09 09:19:54'),
(5, 'cbautista', 'Carlo Bautista', '$2y$10$zFzvWpag.EZru0xBu6eU4OIoVUShZlgEv1wgfrETcB4OovuxjmDMi', NULL, '2026-10-09 09:19:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_product_id_foreign` (`product_id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_sold_by_foreign` (`sold_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sales_sold_by_foreign` FOREIGN KEY (`sold_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
