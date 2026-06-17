-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 03:49 AM
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
-- Database: `food_order_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT 'default_food.jpg',
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price`, `image`, `status`, `created_at`) VALUES
(6, 'Tea', 'Special Chai', 1.00, '1779116414_1779065665_Tea.jpg', 1, '2026-05-18 00:54:25'),
(7, 'Buger ', 'Cheese Buger Special', 2.00, '1779066070_burger.avif', 1, '2026-05-18 01:01:10'),
(8, 'Potato Chips', 'Aalu Chips', 1.00, '1779066193_Potato Chips', 1, '2026-05-18 01:03:13'),
(9, 'Pizza', 'Special Beef Burger', 2.50, '1779066319_pizza', 1, '2026-05-18 01:05:19'),
(10, 'Chicken Recipes', 'Food & Wine\'s Best Chicken Recipes', 5.00, '1779066438_Chicken.jpg', 1, '2026-05-18 01:07:18'),
(11, 'Salad ', 'Quick and Easy Pasta Salad', 0.50, '1779066521_Salad.jfif', 1, '2026-05-18 01:08:41'),
(12, 'Biryanii', 'Exploring Aurangabad through Its 12 Famous Food Items - Swiggy Diaries', 8.00, '1779066600_Biryani.jfif', 1, '2026-05-18 01:10:00'),
(13, 'Trendy Item', 'Trendy and Unique Restaurant Menu ', 1.50, '1779066835_Trendy Item.jfif', 1, '2026-05-18 01:13:55'),
(14, 'Fast Food', 'Realistic Fast Food Items in Accurate View Detailed Food', 3.50, '1779066949_Fast Food.webp', 1, '2026-05-18 01:15:49'),
(15, 'Chicken Burger', 'Special Chicken Burger with Cheese', 1.20, '1779116598_Simple Burger.jfif', 1, '2026-05-18 15:03:18'),
(16, 'Special Deal', 'Deals with the Burger', 4.00, '1779116730_Special Deal Burger.jfif', 1, '2026-05-18 15:05:30'),
(17, 'Chicken ', 'Fresh Food ', 1.20, '1779195814_1779066438_Chicken.jpg', 1, '2026-05-19 13:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Preparing','Completed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `status`, `created_at`) VALUES
(1, 1, 1.00, 'Cancelled', '2026-05-18 00:59:47'),
(2, 2, 2.00, 'Pending', '2026-05-18 01:17:42'),
(3, 2, 2.00, 'Preparing', '2026-05-18 01:17:52'),
(4, 2, 3.50, 'Completed', '2026-05-18 10:03:32'),
(5, 1, 2.00, 'Pending', '2026-05-18 15:05:52'),
(6, 2, 4.00, 'Pending', '2026-05-18 15:08:52'),
(7, 2, 2.00, 'Cancelled', '2026-05-18 15:09:10'),
(8, 2, 5.00, 'Pending', '2026-05-19 13:02:11'),
(9, 2, 1.00, 'Preparing', '2026-06-01 18:26:17');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_item_id`, `quantity`, `price`) VALUES
(1, 1, 6, 1, 1.00),
(2, 2, 8, 2, 1.00),
(3, 3, 7, 1, 2.00),
(4, 4, 14, 1, 3.50),
(5, 5, 7, 1, 2.00),
(6, 6, 16, 1, 4.00),
(7, 7, 7, 1, 2.00),
(8, 8, 10, 1, 5.00),
(9, 9, 6, 1, 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@food.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2026-05-18 00:29:51'),
(2, 'Aqib Ali Ilyas', 'aqibaliyaas@gmail.com', '$2y$10$/aXYROzXb4P8Y10rmQ5JrOOvK3wWKqOW3oPYS.O4Qv4PnAGmffQ6y', 'user', '2026-05-18 01:10:48'),
(3, 'Muhammad Sadiq', 'saqidshigri@gmail.com', '$2y$10$yGIiiJYl/LQOaN4OYYN5euC22nESpp1MH55147XMqwZ.cp72Qgm/2', 'user', '2026-05-18 15:10:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `menu_item_id` (`menu_item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
