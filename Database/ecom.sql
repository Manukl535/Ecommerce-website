-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 11:35 AM
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
('MANU@GMAIL.COM');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `count_id` int(100) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `feedback` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`count_id`, `name`, `email`, `phone`, `feedback`) VALUES
(2, 'MANU', 'MANU@GMAIL.COM', '7022015320', 'Hello!!'),
(3, 'MANU', 'MANU@GMAIL.COM', '7022015320', 'Hello Posh this is Manu'),
(4, 'MANU', 'MANU@GMAIL.COM', '7022015320', 'Hello! Hello! Hello!'),
(5, 'MICHEAL', 'MICHEAL@GMAIL.COM', '7022015320', 'HELLO POSH!!'),
(6, 'MANU', 'MANU@GMAIL.COM', '7022015320', 'HELLO POSH!!');

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
  `order_date` date DEFAULT NULL,
  `order_quantity` varchar(10) DEFAULT NULL,
  `dod` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_name`, `email`, `user_phone`, `user_city`, `user_state`, `user_address`, `order_date`, `order_quantity`, `dod`) VALUES
(1, '2198', 'Paid', '1', 'MANU', 'MANU@GMAIL.COM', '7022015320', 'Bengaluru', 'Karnataka', 'ATTIBELE', '2024-02-25', '2', '2024-02-25'),
(2, '999', 'Paid', '1', 'MANU', 'MANU@GMAIL.COM', '7022015320', 'Bengaluru', 'Karnataka', 'ATTIBELE', '2024-02-25', '1', '2024-02-25'),
(6, '1299', 'Paid', '1', 'MANU', 'MANU@GMAIL.COM', '7022015320', 'Bengaluru', 'Karnataka', 'ATTIBELE', '2024-02-25', '1', '2024-02-26'),
(7, '899', 'Paid', '1', 'MANU', 'MANU@GMAIL.COM', '7022015320', 'Bengaluru', 'Karnataka', 'ATTIBELE', '2024-02-25', '1', '2024-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `item_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `product_id` int(50) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_image` varchar(50) DEFAULT NULL,
  `product_price` varchar(50) DEFAULT NULL,
  `product_quantity` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `dod` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`, `dod`) VALUES
(1, 1, 7, 'Orange Grpahic Shirt ', 'shirt3.png ', '1299', '1', '1', '2024-02-25 07:52:35', '2024-02-25'),
(2, 1, 1, 'Men Relaxed blue Hoodie ', 'sweat1.png ', '899', '1', '1', '2024-02-25 07:52:35', '2024-02-25'),
(3, 2, 4, 'Men printed hoodie ', 'sweat4.png ', '999', '1', '1', '2024-02-25 09:03:58', '2024-02-25'),
(7, 6, 12, 'Women printed croptop ', 'women4.png ', '1299', '1', '1', '2024-02-25 11:06:50', '2024-02-26'),
(8, 7, 80, 'Men Hat ', 'men_hat4.png ', '899', '1', '1', '2024-02-25 11:26:20', '2024-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `Gender`, `product_name`, `product_category`, `product_description`, `product_image`, `product_price`, `product_special offer`, `product_color`) VALUES
(1, 'Men', 'Men Relaxed blue Hoodie', 'Apperal/Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'sweat1.png', 899.00, 0, 'Blue'),
(2, 'Men', 'Men turtle neck hoodie', 'Apperal/Hoodie', 'Turtle neck sweatshirt hoodie fabric made from a cotton blend.  Soft brushed inside', 'sweat2.png\r\n', 899.00, 0, 'Blue'),
(3, 'Men', 'Men football printed Hoodie', 'Apperal/Hoodie', 'Men football printed fire hoodie.Made with cotton blend,soft brushed inside.', 'sweat3.png', 799.00, 0, 'Blue'),
(4, 'Men', 'Men printed hoodie', 'Apperal/Hoodie', 'Hoodie with boom prints ,made with cotton blend .Relaxed fit with soft brushed inside', 'sweat4.png', 999.00, 0, 'Blue'),
(5, 'Men', 'Black Printed Shirt ', 'Apperal/shirt', 'Men\'s Black Printed Shirt', 'shirt1.png', 1199.00, 0, 'Black'),
(6, 'Men', 'White Printed Shirt', 'Apperal/shirt', 'Men\'s Black Printed Shirt', 'shirt2.png', 1399.00, 0, 'Blue'),
(7, 'Men', 'Orange Grpahic Shirt', 'Apperal/shirt', 'Men\'s Black Printed Shirt', 'shirt3.png', 1299.00, 0, 'Black'),
(8, 'Men', 'Green Graphic Shirt', 'Apperal/shirt', 'Men\'s Black Printed Shirt', 'shirt4.png', 699.00, 0, 'Black'),
(9, 'Women', 'Women hoodie', 'Apperal/Hoodie', 'Women hoodie with soft bruised inside,made with cooton and silk blend.', 'women1.png', 999.00, 0, 'Blue'),
(10, 'Women', 'Women lavender Hoodie', 'Apperal/Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'women2.png', 799.00, 0, 'Blue'),
(11, 'Women', 'Women white relaxed hoodie', 'Apperal/Hoodie', 'White women Hoodie in sweatshirt fabric made from a cotton blend. Soft brushed inside', 'women3.png', 899.00, 0, 'Blue'),
(12, 'Women', 'Women printed croptop', 'Apperal/Hoodie', 'Women stylish printed croptop made with cotton and silk blend.Most comfortable as soft brushed inside', 'women4.png', 1299.00, 0, 'Blue'),
(13, 'Men', 'Men T Shirt', 'Apparal/tshirt', 'T Shirt', 'tshirt1.png', 899.00, 0, 'White'),
(14, 'Men', 'Men T Shirt', 'Apparal/tshirt', 'T Shirt', 'tshirt2.png', 899.00, 0, 'White'),
(15, 'Men', 'Men T Shirt', 'Apparal/tshirt', 'T Shirt', 'tshirt3.png', 899.00, 0, 'White'),
(16, 'Men', 'Men T Shirt', 'Apparal/tshirt', 'T Shirt', 'tshirt4.png', 899.00, 0, 'White'),
(17, 'Men', 'Men T Shirt', 'Apparal/polo_tshirt', 'T Shirt', 'polot1.png', 899.00, 0, 'White'),
(18, 'Men', 'Men T Shirt', 'Apparal/polo_tshirt', 'T Shirt', 'polot2.png', 899.00, 0, 'White'),
(19, 'Men', 'Men T Shirt', 'Apparal/polo_tshirt', 'T Shirt', 'polot3.png', 899.00, 0, 'White'),
(20, 'Men', 'Men T Shirt', 'Apparal/polo_tshirt', 'T Shirt', 'polot4.png', 899.00, 0, 'White'),
(21, 'Women', 'Women Frock', 'Apparal/frocks', 'Frock', 'frock1.png', 899.00, 0, 'Gold'),
(22, 'Women', 'Women Frock', 'Apparal/frocks', 'Frock', 'frock2.png', 899.00, 0, 'Gold'),
(23, 'Women', 'Women Frock', 'Apparal/frocks', 'Frock', 'frock3.png', 899.00, 0, 'Gold'),
(24, 'Women', 'Women Frock', 'Apparal/frocks', 'Frock', 'frock4.png', 899.00, 0, 'Gold'),
(25, 'Women', 'Women Sweater', 'Apparal/sweater', 'Sweater', 'sweat_1.png', 899.00, 0, 'White'),
(26, 'Women', 'Women Sweater', 'Apparal/sweater', 'Sweater', 'sweat_2.png', 899.00, 0, 'White'),
(27, 'Women', 'Women Sweater', 'Apparal/sweater', 'Sweater', 'sweat_3.png', 899.00, 0, 'White'),
(28, 'Women', 'Women Sweater', 'Apparal/sweater', 'Sweater', 'sweat_4.png', 899.00, 0, 'White'),
(29, 'Women', 'Women Crop Top', 'Apparal/croptop', 'Crop Top', 'crop1.png', 899.00, 0, 'White'),
(30, 'Women', 'Women Crop Top', 'Apparal/croptop', 'Crop Top', 'crop2.png', 899.00, 0, 'White'),
(31, 'Women', 'Women Crop Top', 'Apparal/croptop', 'Crop Top', 'crop3.png', 899.00, 0, 'White'),
(32, 'Women', 'Women Crop Top', 'Apparal/croptop', 'Crop Top', 'crop4.png', 899.00, 0, 'White'),
(33, 'Women', 'Women Onepiece Dress', 'Apparal/onepiece', 'Onepiece', 'onepiece1.png', 899.00, 0, 'White'),
(34, 'Women', 'Women Onepiece Dress', 'Apparal/onepiece', 'Onepiece', 'onepiece2.png', 899.00, 0, 'White'),
(35, 'Women', 'Women Onepiece Dress', 'Apparal/onepiece', 'Onepiece', 'onepiece3.png', 899.00, 0, 'White'),
(36, 'Women', 'Women Onepiece Dress', 'Apparal/onepiece', 'Onepiece', 'onepiece4.png', 899.00, 0, 'White'),
(37, 'Women', 'Women Sandal', 'Footwear/sandals', 'Sandal', 'Girls_sandals1.png', 899.00, 0, 'White'),
(38, 'Women', 'Women Sandal', 'Footwear/sandals', 'Sandal', 'Girls_sandals2.png', 899.00, 0, 'White'),
(39, 'Women', 'Women Sandal', 'Footwear/sandals', 'Sandal', 'Girls_sandals3.png', 899.00, 0, 'White'),
(40, 'Women', 'Women Sandal', 'Footwear/sandals', 'Sandal', 'Girls_sandals4.png', 899.00, 0, 'White'),
(41, 'Women', 'Women Shoes', 'Footwear/shoes', 'Shoes', 'Girl_Shoe1.png', 899.00, 0, 'White'),
(42, 'Women', 'Women Shoes', 'Footwear/shoes', 'Shoes', 'Girl_Shoe2.png', 899.00, 0, 'White'),
(43, 'Women', 'Women Shoes', 'Footwear/shoes', 'Shoes', 'Girl_Shoe3.png', 899.00, 0, 'White'),
(44, 'Women', 'Women Shoes', 'Footwear/shoes', 'Shoes', 'Girl_Shoe4.png', 899.00, 0, 'White'),
(45, 'Women', 'Women Flats', 'Footwear/flats', 'Flats', 'Flat1.png', 899.00, 0, 'White'),
(46, 'Women', 'Women Flats', 'Footwear/flats', 'Flats', 'Flat2.png', 899.00, 0, 'White'),
(47, 'Women', 'Women Flats', 'Footwear/flats', 'Flats', 'Flat3.png', 899.00, 0, 'White'),
(48, 'Women', 'Women Flats', 'Footwear/flats', 'Flats', 'Flat4.png', 899.00, 0, 'White'),
(49, 'Women', 'Women Boots', 'Footwear/boots', 'Flats', 'Boots1.png', 899.00, 0, 'White'),
(50, 'Women', 'Women Boots', 'Footwear/boots', 'Flats', 'Boots2.png', 899.00, 0, 'White'),
(51, 'Women', 'Women Boots', 'Footwear/boots', 'Flats', 'Boots3.png', 899.00, 0, 'White'),
(52, 'Women', 'Women Boots', 'Footwear/boots', 'Flats', 'Boots4.png', 899.00, 0, 'White'),
(53, 'Men', 'Men Sandal', 'Footwear/sandals', 'Sandal', 'Boys_sandals1.png', 899.00, 0, 'White'),
(54, 'Men', 'Men Sandal', 'Footwear/sandals', 'Sandal', 'Boys_sandals2.png', 899.00, 0, 'White'),
(55, 'Men', 'Men Sandal', 'Footwear/sandals', 'Sandal', 'Boys_sandals3.png', 899.00, 0, 'White'),
(56, 'Men', 'Men Sandal', 'Footwear/sandals', 'Sandal', 'Boys_sandals4.png', 899.00, 0, 'White'),
(57, 'Men', 'Men Crocks', 'Footwear/crocks', 'Shoes', 'crocks1.png', 899.00, 0, 'White'),
(58, 'Men', 'Men Crocks', 'Footwear/crocks', 'Shoes', 'crocks2.png', 899.00, 0, 'White'),
(59, 'Men', 'Men Crocks', 'Footwear/crocks', 'Shoes', 'crocks3.png', 899.00, 0, 'White'),
(60, 'Men', 'Men Crocks', 'Footwear/crocks', 'Shoes', 'crocks4.png', 899.00, 0, 'White'),
(61, 'Men', 'Men Sneakers', 'Footwear/sneakers', 'Sneakers', 'sneakers1.png', 899.00, 0, 'White'),
(62, 'Men', 'Men Sneakers', 'Footwear/sneakers', 'Sneakers', 'sneakers2.png', 899.00, 0, 'White'),
(63, 'Men', 'Men Sneakers', 'Footwear/sneakers', 'Sneakers', 'sneakers3.png', 899.00, 0, 'White'),
(64, 'Men', 'Men Sneakers', 'Footwear/sneakers', 'Sneakers', 'sneakers4.png', 899.00, 0, 'White'),
(65, 'Men', 'Men Formal Shoes', 'Footwear/formals', 'Shoes', 'formal_Shoe1.png', 899.00, 0, 'White'),
(66, 'Men', 'Men Formal Shoes', 'Footwear/formals', 'Shoes', 'formal_Shoe2.png', 899.00, 0, 'White'),
(67, 'Men', 'Men Formal Shoes', 'Footwear/formals', 'Shoes', 'formal_Shoe3.png', 899.00, 0, 'White'),
(68, 'Men', 'Men Formal Shoes', 'Footwear/formals', 'Shoes', 'formal_Shoe4.png', 899.00, 0, 'White'),
(69, 'Men', 'Men Sunglass', 'Accessories/sunglass', 'Sunglass', 'men_sunglass1.png', 899.00, 0, 'White'),
(70, 'Men', 'Men Sunglass', 'Accessories/sunglass', 'Sunglass', 'men_sunglass2.png', 899.00, 0, 'White'),
(71, 'Men', 'Men Sunglass', 'Accessories/sunglass', 'Sunglass', 'men_sunglass3.png', 899.00, 0, 'White'),
(72, 'Men', 'Men Sunglass', 'Accessories/sunglass', 'Sunglass', 'men_sunglass4.png', 899.00, 0, 'White'),
(73, 'Men', 'Men Watch', 'Accessories/watch', 'Watch', 'men_watch1.png', 899.00, 0, 'White'),
(74, 'Men', 'Men Watch', 'Accessories/watch', 'Watch', 'men_watch2.png', 899.00, 0, 'White'),
(75, 'Men', 'Men Watch', 'Accessories/watch', 'Watch', 'men_watch3.png', 899.00, 0, 'White'),
(76, 'Men', 'Men Watch', 'Accessories/watch', 'Watch', 'men_watch4.png', 899.00, 0, 'White'),
(77, 'Men', 'Men Hat', 'Accessories/hat', 'Hat', 'men_hat1.png', 899.00, 0, 'White'),
(78, 'Men', 'Men Hat', 'Accessories/hat', 'Hat', 'men_hat2.png', 899.00, 0, 'White'),
(79, 'Men', 'Men Hat', 'Accessories/hat', 'Hat', 'men_hat3.png', 899.00, 0, 'White'),
(80, 'Men', 'Men Hat', 'Accessories/hat', 'Hat', 'men_hat4.png', 899.00, 0, 'White'),
(81, 'Men', 'Men Wallet', 'Accessories/wallet', 'Wallet', 'wallet1.png', 899.00, 0, 'White'),
(82, 'Men', 'Men Wallet', 'Accessories/wallet', 'Wallet', 'wallet2.png', 899.00, 0, 'White'),
(83, 'Men', 'Men Wallet', 'Accessories/wallet', 'Wallet', 'wallet3.png', 899.00, 0, 'White'),
(84, 'Men', 'Men Wallet', 'Accessories/wallet', 'Wallet', 'wallet4.png', 899.00, 0, 'White'),
(85, 'Women', 'Women Sunglass', 'Accessories/sunglass', 'Sunglass', 'women_sunglass1.png', 899.00, 0, 'White'),
(86, 'Women', 'Women Sunglass', 'Accessories/sunglass', 'Sunglass', 'women_sunglass2.png', 899.00, 0, 'White'),
(87, 'Women', 'Women Sunglass', 'Accessories/sunglass', 'Sunglass', 'women_sunglass3.png', 899.00, 0, 'White'),
(88, 'Women', 'Women Sunglass', 'Accessories/sunglass', 'Sunglass', 'women_sunglass4.png', 899.00, 0, 'White'),
(89, 'Women', 'Women Watch', 'Accessories/watch', 'Watch', 'women_watch1.png', 899.00, 0, 'White'),
(90, 'Women', 'Women Watch', 'Accessories/watch', 'Watch', 'women_watch2.png', 899.00, 0, 'White'),
(91, 'Women', 'Women Watch', 'Accessories/watch', 'Watch', 'women_watch3.png', 899.00, 0, 'White'),
(92, 'Women', 'Women Watch', 'Accessories/watch', 'Watch', 'women_watch4.png', 899.00, 0, 'White'),
(93, 'Women', 'Women Hat', 'Accessories/hat', 'Hat', 'women_hat1.png', 899.00, 0, 'White'),
(94, 'Women', 'Women Hat', 'Accessories/hat', 'Hat', 'women_hat2.png', 899.00, 0, 'White'),
(95, 'Women', 'Women Hat', 'Accessories/hat', 'Hat', 'women_hat3.png', 899.00, 0, 'White'),
(96, 'Women', 'Women Hat', 'Accessories/hat', 'Hat', 'women_hat4.png', 899.00, 0, 'White'),
(97, 'Women', 'Women Hand Bag', 'Accessories/bag', 'Bag', 'Bag1.png', 899.00, 0, 'White'),
(98, 'Women', 'Women Hand Bag', 'Accessories/bag', 'Bag', 'Bag2.png', 899.00, 0, 'White'),
(99, 'Women', 'Women Hand Bag', 'Accessories/bag', 'Bag', 'Bag3.png', 899.00, 0, 'White'),
(100, 'Women', 'Women Hand Bag', 'Accessories/bag', 'Bag', 'Bag4.png', 899.00, 0, 'White');

-- --------------------------------------------------------

--
-- Table structure for table `return_requests`
--

CREATE TABLE `return_requests` (
  `return_id` int(11) NOT NULL,
  `order_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `comments` varchar(500) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_city` varchar(50) NOT NULL,
  `user_state` varchar(50) NOT NULL,
  `return_status` varchar(20) NOT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `account_number` varchar(30) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_requests`
--

INSERT INTO `return_requests` (`return_id`, `order_id`, `user_id`, `product_id`, `reason`, `comments`, `user_name`, `user_phone`, `user_address`, `user_city`, `user_state`, `return_status`, `bank`, `account_number`, `ifsc_code`) VALUES
(14, '1', '1', '1', 'Product Damaged', 'Product Damaged', 'MANU', '7022015320', 'ATTIBELE', 'Bengaluru', 'Karnataka', 'Yes', 'Canara Bank', '0696108036571', 'CNRB0000696'),
(17, '1', '1', '7', 'Product Damaged', 'Hello', 'MANU', '7022015320', 'ATTIBELE', 'Bengaluru', 'Karnataka', 'Yes', 'Canara Bank', '0696108036571', 'CNRB0000696'),
(18, '2', '1', '4', 'Product Damaged', 'Product Damaged', 'MANU', '7022015320', 'ATTIBELE', 'Bengaluru', 'Karnataka', 'Yes', 'Canara Bank', '0696108036571', 'CNRB0000696');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `phone`, `email`, `password`, `otp`) VALUES
(1, 'MANU', '+917022015320', 'MANU@GMAIL.COM', '112233', '287121');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`count_id`);

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
-- Indexes for table `return_requests`
--
ALTER TABLE `return_requests`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `count_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `return_requests`
--
ALTER TABLE `return_requests`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
