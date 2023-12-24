-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2023 at 04:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usersdb`
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
('manu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback`) VALUES
('hii'),
('hii');

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
(1, 'Men Relaxed Hoodie', 'Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'sweat1.png', 'sweat2.png', 'sweat3.png', 'sweat4.png', 2499.00, 0, 'Blue'),
(2, 'Men Relaxed Hoodie', 'Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'sweat2.png\r\n', 'sweat2.png', 'sweat3.png', 'sweat4.png', 2499.00, 0, 'Blue'),
(3, 'Men Relaxed Hoodie', 'Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'sweat3.png', 'sweat2.png', 'sweat3.png', 'sweat4.png', 2499.00, 0, 'Blue'),
(4, 'Men Relaxed Hoodie', 'Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'sweat4.png', 'sweat2.png', 'sweat3.png', 'sweat4.png', 2499.00, 0, 'Blue'),
(5, 'Black Printed Shirt ', 'shirts', 'Men\'s Black Printed Shirt', 'shirt1.png', 'shirt1.png', 'shirt1.png', 'shirt1.png', 1499.00, 0, 'Black'),
(6, 'Black Shirt', 'shirts', 'Men\'s Black Printed Shirt', 'shirt2.png', 'shirt2.png', 'shirt2.png', 'shirt2.png', 1399.00, 0, 'Blue'),
(7, 'Black Printed Shirt ', 'shirts', 'Men\'s Black Printed Shirt', 'shirt3.png', 'shirt3.png', 'shirt3.png', 'shirt3.png', 1299.00, 0, 'Black'),
(8, 'Black Printed Shirt ', 'shirts', 'Men\'s Black Printed Shirt', 'shirt4.png', 'shirt4.png', 'shirt4.png', 'shirt4.png', 1299.00, 0, 'Black');

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special offer`, `product_color`) VALUES
(1, 'Men Relaxed Hoodie', 'Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'women1.png', 'women1.png', 'women1.png', 'women1.png', 2499.00, 0, 'Blue');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'MANU', 'MANU'),
(93, 'SRISHA', '1122');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
