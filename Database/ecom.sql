-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 05:51 PM
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
  `product_special_offer` varchar(10) NOT NULL,
  `product_color` varchar(100) NOT NULL,
  `available_qty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `Gender`, `product_name`, `product_category`, `product_description`, `product_image`, `product_price`, `product_special_offer`, `product_color`, `available_qty`) VALUES
(1, 'Men', 'Men Relaxed blue Hoodie', 'Apperal/Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'sweat1.png', 899.00, 'N/A', 'Blue', '1'),
(2, 'Men', 'Men turtle neck hoodie', 'Apperal/Hoodie', 'Turtle neck sweatshirt hoodie fabric made from a cotton blend.  Soft brushed inside', 'sweat2.png\r\n', 899.00, 'N/A', 'Blue', '0'),
(3, 'Men', 'Men football printed Hoodie', 'Apperal/Hoodie', 'Men football printed fire hoodie.Made with cotton blend,soft brushed inside.', 'sweat3.png', 799.00, 'N/A', 'Blue', '99'),
(4, 'Men', 'Men printed hoodie', 'Apperal/Hoodie', 'Hoodie with boom prints ,made with cotton blend .Relaxed fit with soft brushed inside', 'sweat4.png', 999.00, 'N/A', 'Blue', '100'),
(5, 'Men', 'Black Printed Shirt ', 'Apperal/shirt', 'Men\'s Black Printed Shirt', 'shirt1.png', 1199.00, 'N/A', 'Black', '100'),
(6, 'Men', 'White Printed Shirt', 'Apperal/shirt', 'Men\'s Black Printed Shirt', 'shirt2.png', 1399.00, 'N/A', 'Blue', '100'),
(7, 'Men', 'Orange Grpahic Shirt', 'Apperal/shirt', 'Men\'s Black Printed Shirt', 'shirt3.png', 1299.00, 'N/A', 'Black', '100'),
(8, 'Men', 'Green Graphic Shirt', 'Apperal/shirt', 'Men\'s Black Printed Shirt', 'shirt4.png', 699.00, 'N/A', 'Black', '100'),
(9, 'Women', 'Women hoodie', 'Apperal/Hoodie', 'Women hoodie with soft bruised inside,made with cooton and silk blend.', 'women1.png', 999.00, 'N/A', 'Blue', '100'),
(10, 'Women', 'Women lavender Hoodie', 'Apperal/Hoodie', 'Hoodie in sweatshirt fabric made from a cotton blend. Relaxed fit with a jersey-lined, Soft brushed inside', 'women2.png', 799.00, 'N/A', 'Blue', '100'),
(11, 'Women', 'Women white relaxed hoodie', 'Apperal/Hoodie', 'White women Hoodie in sweatshirt fabric made from a cotton blend. Soft brushed inside', 'women3.png', 899.00, 'N/A', 'Blue', '100'),
(12, 'Women', 'Women printed croptop', 'Apperal/Hoodie', 'Women stylish printed croptop made with cotton and silk blend.Most comfortable as soft brushed inside', 'women4.png', 1299.00, 'N/A', 'Blue', '99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
