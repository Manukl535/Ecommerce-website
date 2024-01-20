-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 08:50 PM
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
  `user_phone` varchar(50) DEFAULT NULL,
  `user_city` varchar(50) DEFAULT NULL,
  `user_address` varchar(50) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, '899', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 11:25:49'),
(2, '899', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 11:29:05'),
(3, '889', 'on_hold', '1', '7022015320', 'MANU', 'ANU', '2024-01-20 11:48:49'),
(4, '889', 'on_hold', '1', '7022015320', 'MANU', 'ANU', '2024-01-20 11:48:57'),
(5, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:07:46'),
(6, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:08:01'),
(7, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:09:09'),
(8, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:09:16'),
(9, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:10:02'),
(10, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:10:03'),
(11, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:10:49'),
(12, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:13:15'),
(13, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:13:24'),
(14, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:13:52'),
(15, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:15:11'),
(16, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:15:35'),
(17, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:18:02'),
(18, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:18:10'),
(19, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:21:46'),
(20, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:21:47'),
(21, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:30:01'),
(22, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:30:22'),
(23, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:30:42'),
(24, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:30:58'),
(25, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:31:20'),
(26, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:31:47'),
(27, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:31:57'),
(28, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:32:14'),
(29, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:32:43'),
(30, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:33:02'),
(31, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:33:43'),
(32, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:34:03'),
(33, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:34:24'),
(34, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:34:46'),
(35, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:34:59'),
(36, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:35:17'),
(37, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:35:28'),
(38, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:35:50'),
(39, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:36:13'),
(40, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:37:57'),
(41, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:38:18'),
(42, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:38:38'),
(43, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:38:59'),
(44, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:39:58'),
(45, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:40:16'),
(46, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:40:50'),
(47, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:41:22'),
(48, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:42:17'),
(49, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:42:42'),
(50, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:42:43'),
(51, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:43:29'),
(52, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:43:52'),
(53, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:44:05'),
(54, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:44:50'),
(55, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:45:27'),
(56, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:45:32'),
(57, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:45:33'),
(58, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:45:57'),
(59, '889', 'on_hold', '1', '7022015320', 'manu', 'manu', '2024-01-20 12:47:14'),
(60, '889', 'on_hold', '1', '7022015320', 'manu', 'manu', '2024-01-20 12:49:56'),
(61, '889', 'on_hold', '1', '7022015320', 'MANU', 'MNAU', '2024-01-20 12:52:55'),
(62, '889', 'on_hold', '1', '7022015320', 'MANU', 'MNAU', '2024-01-20 12:55:11'),
(63, '889', 'on_hold', '1', '7022015320', 'MANU', 'MNAU', '2024-01-20 12:55:55'),
(64, '889', 'on_hold', '1', '7022015320', 'MANU', 'MNAU', '2024-01-20 12:57:04'),
(65, '889', 'on_hold', '1', '7022015320', 'MANU', 'MNAU', '2024-01-20 12:57:15'),
(66, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:58:36'),
(67, '889', 'on_hold', '1', '7022015320', 'MANU', 'MANU', '2024-01-20 12:59:17');

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
(1, 1, '11 ', 'Women white relaxed hoodie ', 'women3.png ', '899', '1', '1', '2024-01-20 11:25:49'),
(2, 2, '11 ', 'Women white relaxed hoodie ', 'women3.png ', '899', '1', '1', '2024-01-20 11:29:05'),
(3, 3, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 11:48:49'),
(4, 4, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 11:48:57'),
(5, 5, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:07:46'),
(6, 6, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:08:01'),
(7, 7, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:09:09'),
(8, 8, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:09:16'),
(9, 9, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:10:02'),
(10, 10, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:10:03'),
(11, 11, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:10:49'),
(12, 12, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:13:15'),
(13, 13, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:13:24'),
(14, 14, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:13:52'),
(15, 15, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:15:11'),
(16, 16, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:15:35'),
(17, 17, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:18:02'),
(18, 18, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:18:10'),
(19, 19, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:21:46'),
(20, 20, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:21:47'),
(21, 21, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:30:01'),
(22, 22, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:30:22'),
(23, 23, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:30:42'),
(24, 24, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:30:58'),
(25, 25, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:31:20'),
(26, 26, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:31:47'),
(27, 27, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:31:57'),
(28, 28, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:32:14'),
(29, 29, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:32:43'),
(30, 30, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:33:02'),
(31, 31, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:33:43'),
(32, 32, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:34:03'),
(33, 33, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:34:24'),
(34, 34, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:34:46'),
(35, 35, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:34:59'),
(36, 36, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:35:17'),
(37, 37, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:35:28'),
(38, 38, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:35:50'),
(39, 39, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:36:13'),
(40, 40, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:37:57'),
(41, 41, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:38:18'),
(42, 42, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:38:38'),
(43, 43, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:38:59'),
(44, 44, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:39:58'),
(45, 45, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:40:16'),
(46, 46, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:40:50'),
(47, 47, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:41:22'),
(48, 48, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:42:17'),
(49, 49, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:42:42'),
(50, 50, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:42:43'),
(51, 51, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:43:29'),
(52, 52, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:43:52'),
(53, 53, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:44:05'),
(54, 54, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:44:50'),
(55, 55, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:45:27'),
(56, 56, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:45:32'),
(57, 57, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:45:33'),
(58, 58, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:45:57'),
(59, 59, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:47:14'),
(60, 60, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:49:56'),
(61, 61, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:52:55'),
(62, 62, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:55:11'),
(63, 63, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:55:55'),
(64, 64, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:57:04'),
(65, 65, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:57:15'),
(66, 66, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:58:36'),
(67, 67, '3 ', 'Men football printed Hoodie ', 'sweat3.png ', '889', '1', '1', '2024-01-20 12:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `product2`
--

CREATE TABLE `product2` (
  `product_id` int(11) DEFAULT NULL,
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
(1, 'MANU', '7022015320', 'MANU@EMAIL.COM', 'dc39df9add');

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`user_name`,`email`,`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
