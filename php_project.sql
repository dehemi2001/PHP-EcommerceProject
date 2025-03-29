-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 05:56 PM
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
(1, 1302000.00, 'Not Paid', 1, 774075447, 'Negombo', 'Negombo', '2025-03-28 08:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 1, '1', 'Lenevo LOQ', 'featured1.png', 400000.00, 1, 1, '2025-03-28 08:28:01'),
(2, 1, '2', 'HP Victus', 'featured2.png', 500000.00, 1, 1, '2025-03-28 08:28:01'),
(3, 1, '5', 'Asus ExpertCenter', 'desktop1.png', 400000.00, 1, 1, '2025-03-28 08:28:01'),
(4, 1, '9', 'Keyboard', 'accessorie1.png', 2000.00, 1, 1, '2025-03-28 08:28:01');

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
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(1, 'Lenevo LOQ', 'Laptop Computers', 'Lenevo LOQ (Gaming Laptop)\n\nFocus: Entry-level gaming laptop.\nKey Specs:\nIntel/AMD CPUs (e.g., Intel Core i5/i7, AMD Ryzen 5/7).\nNVIDIA GeForce RTX graphics (e.g., RTX 3050, 4050).\n15.6\" or 16\" FHD/QHD displays with high refresh rates.\nSSD storage, ample RAM.\nGaming-centric thermal design.', 'featured1.png', 'featured1-2.png', 'featured1-3.png', 'featured1-4.png', 400000.00, 0, 'black'),
(2, 'HP Victus', 'Laptop Computers', 'Focus: Mainstream gaming and multimedia laptop. Key Specs: Intel/AMD CPUs (e.g., Intel Core i5/i7, AMD Ryzen 5/7). NVIDIA GeForce RTX graphics (e.g., RTX 3050, 4060). 15.6\" or 16\" FHD displays, high refresh rates. SSD storage, expandable RAM. Enhanced audio, modern design.', 'featured2.png', 'featured2.png', 'featured2.png', 'featured2.png', 500000.00, 0, 'black'),
(3, 'Dell Inspiron 16', 'Laptop Computers', 'Focus: Versatile laptop for everyday tasks and productivity. Key Specs: Intel/AMD CPUs (e.g., Intel Core i5/i7, AMD Ryzen 5/7). Integrated or discrete graphics (e.g., Intel Iris Xe, NVIDIA GeForce MX series). 16\" FHD+ displays, optional touch. SSD storage, ample RAM. Sleek design, long battery life.', 'featured3.png', 'featured3.png', 'featured3.png', 'featured3.png', 600000.00, 0, 'black'),
(4, 'Gigabyte G5', 'Laptop Computers', 'Focus: Performance-driven gaming laptop. Key Specs: Intel Core i5/i7 CPUs. NVIDIA GeForce RTX graphics (e.g., RTX 4050, 4060). 15.6\" FHD displays, high refresh rates. SSD storage, expandable RAM. Advanced cooling, gaming keyboard.', 'featured4.png', 'featured4.png', 'featured4.png', 'featured4.png', 300000.00, 0, 'black'),
(5, 'Asus ExpertCenter', 'Desktop Computers', 'Focus: Reliable and secure business desktop. Key Specs: Intel Core i3/i5/i7 CPUs. Integrated or discrete graphics. Various storage options (HDD, SSD). Multiple connectivity ports. Security features, robust build.', 'desktop1.png', 'desktop1.png', 'desktop1.png', 'desktop1.png', 400000.00, 0, 'black'),
(6, 'Lenevo Think Center', 'Desktop Computers', 'Focus: Secure and manageable business desktop. Key Specs: Intel Core i3/i5/i7/i9 CPUs. Integrated or discrete graphics. Various storage options (HDD, SSD). ThinkShield security features. Compact or tower form factors.', 'desktop2.png', 'desktop2.png', 'desktop2.png', 'desktop2.png', 500000.00, 0, 'black'),
(7, 'Dell PowerEdge T140', 'Desktop Computers', 'Focus: Small business server for basic workloads. Key Specs: Intel Xeon E-2200 series processors. Up to 64GB DDR4 ECC RAM. Multiple storage bays (HDD, SSD). RAID support. Basic remote management.', 'desktop3.png', 'desktop3.png', 'desktop3.png', 'desktop3.png', 600000.00, 0, 'black'),
(8, 'Lenevo IdeaCentre AIO 3', 'Desktop Computers', 'Focus: Space-saving all-in-one desktop for home or office. Key Specs: Intel/AMD CPUs (e.g., Intel Core i3/i5, AMD Ryzen 3/5). Integrated graphics. 24\" or 27\" FHD displays. SSD or HDD storage. Integrated webcam, speakers.', 'desktop4.png', 'desktop4.png', 'desktop4.png', 'desktop4.png', 300000.00, 0, 'black'),
(9, 'Keyboard', 'Accessories', 'Awesome Accessorie', 'accessorie1.png', 'accessorie1.png', 'accessorie1.png', 'accessorie1.png', 2000.00, 0, 'black'),
(10, 'Mouse', 'Accessories', 'Awesome Accessorie', 'accessorie2.png', 'accessorie2.png', 'accessorie2.png', 'accessorie2.png', 1000.00, 0, 'black'),
(11, 'Monitor', 'Accessories', 'Awesome Accessorie', 'accessorie3.png', 'accessorie3.png', 'accessorie3.png', 'accessorie3.png', 7000.00, 0, 'black'),
(12, 'Speakers', 'Accessories', 'Awesome Accessorie', 'accessorie4.png', 'accessorie4.png', 'accessorie4.png', 'accessorie4.png', 5000.00, 0, 'black');

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
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
