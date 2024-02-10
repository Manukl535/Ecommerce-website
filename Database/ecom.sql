-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2024 at 05:55 PM
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
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`email`) VALUES
('MANUKLMANU2@GMAIL.COM');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `order_cost` varchar(50) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `user_name` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `user_phone` varchar(50) DEFAULT NULL,
  `user_city` varchar(50) DEFAULT NULL,
  `user_state` varchar(20) NOT NULL,
  `user_address` varchar(50) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT NULL,
  `order_quantity` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_name`, `email`, `user_phone`, `user_city`, `user_state`, `user_address`, `order_date`, `order_quantity`) VALUES
(3, '899', 'Not Paid', '35', 'MANU', 'MANU@GMAIL.COM', '7022015320', 'Bengaluru', 'Karnataka', 'ATTIBELE', '2024-02-10 11:14:57', '1');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `item_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_image` varchar(50) DEFAULT NULL,
  `product_price` varchar(50) DEFAULT NULL,
  `product_quantity` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(6, 3, '11 ', 'Women white relaxed hoodie ', 'women3.png ', '899', '1', '35', '2024-02-10 11:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `product2`
--

CREATE TABLE `product2` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_category` varchar(100) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_price` decimal(6,2) DEFAULT NULL,
  `product_special_offer` int(2) DEFAULT NULL,
  `product_color` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special offer`, `product_color`) VALUES
(1, 'Men Relaxed blue Hoodie', 'Men Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'sweat1.png', 'sweat2.png', 'sweat3.png', 'sweat4.png', 899.00, 0, 'Blue'),
(2, 'Men turtle neck hoodie', 'Men Hoodie', 'Turtle neck sweatshirt hoodie fabric made from a cotton blend.  Soft brushed inside', 'sweat2.png\r\n', 'sweat2.png', 'sweat3.png', 'sweat4.png', 799.00, 0, 'Blue'),
(3, 'Men football printed Hoodie', 'Men Hoodie', 'Men football printed fire hoodie.Made with cotton blend,soft brushed inside.', 'sweat3.png', 'sweat2.png', 'sweat3.png', 'sweat4.png', 889.00, 0, 'Blue'),
(4, 'Men printed hoodie', 'Men Hoodie', 'Hoodie with boom prints ,made with cotton blend .Relaxed fit with soft brushed inside', 'sweat4.png', 'sweat2.png', 'sweat3.png', 'sweat4.png', 999.00, 0, 'Blue'),
(5, 'Black Printed Shirt ', 'shirts', 'Men\'s Black Printed Shirt', 'shirt1.png', 'shirt1.png', 'shirt1.png', 'shirt1.png', 1199.00, 0, 'Black'),
(6, 'Black Shirt', 'shirts', 'Men\'s Black Printed Shirt', 'shirt2.png', 'shirt2.png', 'shirt2.png', 'shirt2.png', 1399.00, 0, 'Blue'),
(7, 'Black Printed Shirt ', 'shirts', 'Men\'s Black Printed Shirt', 'shirt3.png', 'shirt3.png', 'shirt3.png', 'shirt3.png', 1299.00, 0, 'Black'),
(8, 'Black Printed Shirt ', 'shirts', 'Men\'s Black Printed Shirt', 'shirt4.png', 'shirt4.png', 'shirt4.png', 'shirt4.png', 699.00, 0, 'Black'),
(9, 'Women hoodie', 'women Hoodie', 'Women hoodie with soft bruised inside,made with cooton and silk blend.', 'women1.png', 'women1.png', 'women1.png', 'women1.png', 999.00, 0, 'Blue'),
(10, 'Women lavender Hoodie', 'women Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'women2.png', 'women1.png', 'women1.png', 'women1.png', 799.00, 0, 'Blue'),
(11, 'Women white relaxed hoodie', 'women Hoodie', 'White women Hoodie in sweatshirt fabric made from a cotton blend. Soft brushed inside', 'women3.png', 'women1.png', 'women1.png', 'women1.png', 899.00, 0, 'Blue'),
(12, 'Women printed croptop', 'women Hoodie', 'Women stylish printed croptop made with cotton and silk blend.Most comfortable as soft brushed inside', 'women4.png', 'women1.png', 'women1.png', 'women1.png', 1299.00, 0, 'Blue');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `phone`, `email`, `password`) VALUES
(34, 'TEST', '9876543210', 'TEST@GMAIL.COM', '112233'),
(35, 'MANU', '7022015320', 'MANU@GMAIL.COM', '112233');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `product2`
--
ALTER TABLE `product2`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product2`
--
ALTER TABLE `product2`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
