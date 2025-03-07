-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 03:29 PM
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
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(10, 'Men', 1),
(11, 'Wedding Contrast', 1),
(12, 'Women', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(1, 'hardik', 'hardik@gmail.com', '728500', 'hii hardik ', '2025-01-30 15:05:05'),
(2, 'DODIYA HARDIK DINESHBHAI', 'hardikdodiya2410@gmail.com', '07285008403', '2410', '0000-00-00 00:00:00'),
(3, 'DODIYA HARDIK DINESHBHAI', 'hardikdodiya2410@gmail.com', '07285008403', '2410', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` int(11) NOT NULL,
  `txnid` varchar(200) NOT NULL,
  `mihpayid` varchar(200) NOT NULL,
  `payu_status` varchar(10) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `added_on`) VALUES
(26, 0, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'Payu', 100, 'pending', 1, '633a8179cda0ebf68932', '', '', '2025-01-30 09:15:28'),
(27, 2, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'Payu', 100, 'success', 1, 'b2efa044ee6c3234e0d9', '403993715533272156', '', '2025-01-30 09:15:54'),
(28, 2, '38/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'Payu', 1000, 'success', 1, '888152f3213b89dd5344', '403993715533272175', '', '2025-01-30 09:21:13'),
(29, 2, '32/A', 'Bhavnagar', 364140, 'Payu', 1100, 'success', 1, '86b96d9ed16e6e446545', '403993715533272189', '', '2025-01-30 09:24:37'),
(30, 2, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'Payu', 100, 'success', 1, '555c131e062038d3ac22', '403993715533272198', '', '2025-01-30 09:27:53'),
(31, 2, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'Payu', 10000, 'success', 1, '4bac2734bb88d8e3bec6', '403993715533272210', '', '2025-01-30 09:30:27'),
(32, 2, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Talaja (M)', 364140, 'Payu', 100, 'success', 1, '00253f829a2dd47e0cc1', '403993715533272214', '', '2025-01-30 09:33:56'),
(33, 3, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'Payu', 100, 'success', 5, '9d77709b110d4c2b70b9', '403993715533272221', '', '2025-01-30 09:35:27'),
(34, 2, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'Payu', 100, 'success', 1, 'a7d2b608e4be51a131ad', '403993715533306815', '', '2025-02-05 06:21:21'),
(35, 4, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'Payu', 100, 'pending', 1, '2eb38a02ecd450fb0bbd', '', '', '2025-02-05 09:06:09'),
(36, 2, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'Payu', 8000, 'success', 1, '408ba2f955d0e6699420', '403993715533308184', '', '2025-02-06 01:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(0, 26, 6, 1, 100),
(0, 27, 6, 1, 100),
(0, 28, 6, 10, 100),
(0, 29, 6, 11, 100),
(0, 30, 6, 1, 100),
(0, 31, 6, 100, 100),
(0, 32, 6, 1, 100),
(0, 33, 6, 1, 100),
(0, 34, 6, 1, 100),
(0, 35, 6, 1, 100),
(0, 36, 11, 1, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `best_seller` int(11) NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `sub_categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `best_seller`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES
(12, 3, 4, 'product-2 weeding-def', 5000, 500, 5, '135439684_m3.jpeg', 'Short Description', 'Short Description', 1, '', '<br />\r\n<b>Warning</b>:  Undefined variable $meta_desc in <b>C:\\xampp\\htdocs\\ecom\\Admin\\manage_product.php</b> on line <b>197</b><br />', '', 1),
(13, 10, 9, 'men-1-bl', 5000, 5000, 5, '419383016_men7.png', 'Short Description', 'Short Description', 1, '', '<br />\r\n<b>Warning</b>:  Undefined variable $meta_desc in <b>C:\\xampp\\htdocs\\ecom\\Admin\\manage_product.php</b> on line <b>199</b><br />', '', 1),
(14, 11, 10, 'women-sam', 4500, 500, 5, '418903266_WhatsApp Image 2024-12-28 at 14.42.57_449eae6d.jpg', 'Short Description', 'Short Description', 0, '', '<br />\r\n<b>Warning</b>:  Undefined variable $meta_desc in <b>C:\\xampp\\htdocs\\ecom\\Admin\\manage_product.php</b> on line <b>199</b><br />', '', 1),
(15, 11, 11, 'women-def', 50000, 4500, 5, '208606723_WhatsApp Image 2024-12-28 at 14.51.36_9bad0eb0.jpg', 'Short Description', 'Short Description', 1, '', '<br />\r\n<b>Warning</b>:  Undefined variable $meta_desc in <b>C:\\xampp\\htdocs\\ecom\\Admin\\manage_product.php</b> on line <b>199</b><br />', '', 1),
(16, 12, 12, 'women-leigha', 5000, 200, 5, '298334932_WhatsApp Image 2024-12-28 at 14.51.37_ddd42074.jpg', 'Short Description', 'Short Description', 1, '', '<br />\r\n<b>Warning</b>:  Undefined variable $meta_desc in <b>C:\\xampp\\htdocs\\ecom\\Admin\\manage_product.php</b> on line <b>199</b><br />', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `categories_id`, `sub_categories`, `status`) VALUES
(9, 10, 'blazer', 1),
(10, 11, 'same-color', 1),
(11, 11, 'def-color', 1),
(12, 12, 'Leigha', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(2, 'hardik', '2410', 'hardikdodiya2410@gmail.com', '728500', '2025-01-30 14:04:06'),
(3, 'DODIYA HARDIK DINESHBHAI', '123456', 'hardikdodiya241@gmail.com', '07285008403', '0000-00-00 00:00:00'),
(4, 'DODIYA HARDIK DINESHBHAI', '123456', '123456@gmail.com', '07285008403', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_on`) VALUES
(1, 2, 6, '2025-02-05 01:51:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
