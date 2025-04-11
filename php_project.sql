-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 12:28 PM
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
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Dehemi', 'dp.dehemisuvipul@gmail.com', 'd00f5d5217896fb7fd601412cb890830');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(10,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, 802000.00, 'Not Paid', 1, 774075447, 'Negombo', '314/1A, G. D. S. Gamhewa Mawatha, Thimbirigaskatuwa', '2025-04-11 12:26:35'),
(2, 1500000.00, 'Not Paid', 1, 774075447, 'Negombo', '314/1A, G. D. S. Gamhewa Mawatha, Thimbirigaskatuwa', '2025-04-11 12:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_quantity`) VALUES
(1, 1, 12, 1),
(2, 1, 8, 1),
(3, 1, 4, 1),
(4, 2, 6, 2),
(5, 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_special_offer` double NOT NULL,
  `product_color` varchar(100) NOT NULL,
  `stock_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`, `stock_quantity`) VALUES
(1, 'Speakers', 'Accessories', 'Focus: Enhanced audio for multimedia and gaming.\r\nKey Specs:\r\n2.1 channel configuration (two satellite speakers, one subwoofer).\r\nTotal power output (e.g., 50W RMS).\r\nFrequency response (e.g., 40Hz - 20kHz).\r\nWired or wireless connectivity (Bluetooth).\r\nVolume and bass controls.\r\n3.5mm audio input, and sometimes optical inputs.', 'accessorie4.png', 'accessorie4-2.png', 'accessorie4-3.png', 'accessorie4-4.png', 5000.00, 0, 'Black', 10),
(2, 'Monitor', 'Accessories', 'Focus: Immersive and smooth gaming visuals.\r\nKey Specs:\r\n27-inch QHD (2560x1440) resolution.\r\n144Hz refresh rate, 1ms response time.\r\nIPS or VA panel.\r\nAdaptive-Sync technology (e.g., FreeSync, G-Sync).\r\nHDR support.\r\nMultiple display inputs (HDMI, DisplayPort).', 'accessorie3.png', 'accessorie3-2.png', 'accessorie3-3.png', 'accessorie3-4.png', 7000.00, 0, 'Black', 10),
(3, 'Mouse', 'Accessories', 'Focus: Precision and speed for gaming.\r\nKey Specs:\r\nHigh-DPI optical sensor (e.g., 16,000+ DPI).\r\nAdjustable DPI settings.\r\nProgrammable buttons.\r\nRGB lighting.\r\nErgonomic design.\r\nLow latency wired or wireless connection.', 'accessorie2.png', 'accessorie2-2.png', 'accessorie2-3.png', 'accessorie2-4.png', 1000.00, 0, 'Black', 10),
(4, 'Keyboard', 'Accessories', 'Focus: High-performance gaming keyboard.\r\nKey Specs:\r\nMechanical switches (e.g., Cherry MX, Kailh, Outemu).   \r\nRGB backlighting, customizable effects.\r\nN-key rollover (NKRO) and anti-ghosting.   \r\nProgrammable macro keys.   \r\nDurable construction, aluminum frame.\r\nWired or wireless connectivity.', 'accessorie1.png', 'accessorie1-2.png', 'accessorie1-3.png', 'accessorie1-4.png', 2000.00, 0, 'Black', 10),
(5, 'Lenevo IdeaCentre AIO 3', 'Desktop Computers', 'Focus: Space-saving all-in-one desktop for home or office.\r\nKey Specs:\r\nIntel/AMD CPUs (e.g., Intel Core i3/i5, AMD Ryzen 3/5).\r\nIntegrated graphics.\r\n24\" or 27\" FHD displays.\r\nSSD or HDD storage.\r\nIntegrated webcam, speakers.', 'desktop4.png', 'desktop4-2.png', 'desktop4-3.png', 'desktop4-4.png', 300000.00, 2, 'White', 10),
(6, 'Dell PowerEdge T140', 'Desktop Computers', 'Focus: Small business server for basic workloads.\r\nKey Specs:\r\nIntel Xeon E-2200 series processors.\r\nUp to 64GB DDR4 ECC RAM.\r\nMultiple storage bays (HDD, SSD).\r\nRAID support.\r\nBasic remote management.', 'desktop3.png', 'desktop3-2.png', 'desktop3-3.png', 'desktop3-4.png', 600000.00, 0, 'Black', 10),
(7, 'Lenevo Think Center', 'Desktop Computers', 'Focus: Secure and manageable business desktop.\r\nKey Specs:\r\nIntel Core i3/i5/i7/i9 CPUs.\r\nIntegrated or discrete graphics.\r\nVarious storage options (HDD, SSD).\r\nThinkShield security features.\r\nCompact or tower form factors.', 'desktop2.png', 'desktop2-2.png', 'desktop2-3.png', 'desktop2-4.png', 500000.00, 2, 'Black', 10),
(8, 'Asus ExpertCenter', 'Desktop Computers', 'Focus: Reliable and secure business desktop.\r\nKey Specs:\r\nIntel Core i3/i5/i7 CPUs.\r\nIntegrated or discrete graphics.\r\nVarious storage options (HDD, SSD).\r\nMultiple connectivity ports.\r\nSecurity features, robust build.', 'desktop1.png', 'desktop1-2.png', 'desktop1-3.png', 'desktop1-4.png', 400000.00, 10, 'Black', 10),
(9, 'Asus TUF', 'Laptop Computers', 'Focus: Durable and affordable gaming laptops and desktops.\r\nKey Specs (Laptops):\r\nIntel/AMD CPUs (e.g., Intel Core i5/i7, AMD Ryzen 5/7/9).\r\nNVIDIA GeForce RTX graphics (e.g., RTX 3050, 4060, 4070).\r\n15.6\" or 17.3\" FHD/QHD displays, high refresh rates.\r\nSSD storage, expandable RAM.\r\nMIL-STD-810H military-grade durability.\r\nAdvanced cooling systems.', 'featured4.png', 'featured4-2.png', 'featured4-3.png', 'featured4-4.png', 400000.00, 5, 'Black', 10),
(10, 'Dell Inspiron 16', 'Laptop Computers', 'Focus: Versatile laptop for everyday tasks and productivity.\r\nKey Specs:\r\nIntel/AMD CPUs (e.g., Intel Core i5/i7, AMD Ryzen 5/7).\r\nIntegrated or discrete graphics (e.g., Intel Iris Xe, NVIDIA GeForce MX series).\r\n16\" FHD+ displays, optional touch.\r\nSSD storage, ample RAM.\r\nSleek design, long battery life.', 'featured3.png', 'featured3-2.png', 'featured3-3.png', 'featured3-4.png', 600000.00, 2.5, 'Black', 10),
(11, 'HP Victus', 'Laptop Computers', 'Focus: Mainstream gaming and multimedia laptop.\r\nKey Specs:\r\nIntel/AMD CPUs (e.g., Intel Core i5/i7, AMD Ryzen 5/7).\r\nNVIDIA GeForce RTX graphics (e.g., RTX 3050, 4060).\r\n15.6\" or 16\" FHD displays, high refresh rates.\r\nSSD storage, expandable RAM.\r\nEnhanced audio, modern design.', 'featured2.png', 'featured2-2.png', 'featured2-3.png', 'featured2-4.png', 500000.00, 2.5, 'Black', 10),
(12, 'Lenevo LOQ', 'Laptop Computers', 'Focus: Entry-level gaming laptop.\r\nKey Specs:\r\nIntel/AMD CPUs (e.g., Intel Core i5/i7, AMD Ryzen 5/7).\r\nNVIDIA GeForce RTX graphics (e.g., RTX 3050, 4050).\r\n15.6\" or 16\" FHD/QHD displays with high refresh rates.\r\nSSD storage, ample RAM.\r\nGaming-centric thermal design.', 'featured1.png', 'featured1-2.png', 'featured1-3.png', 'featured1-4.png', 400000.00, 2.5, 'Black', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Dehemi', 'dp.dehemisuvipul@gmail.com', 'd00f5d5217896fb7fd601412cb890830');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_orders_users` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_order_items_orders` (`order_id`),
  ADD KEY `fk_order_items_products` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payments_orders` (`order_id`),
  ADD KEY `fk_payments_users` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `fk_order_items_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `fk_payments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
