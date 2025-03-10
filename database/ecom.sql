-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 04:32 PM
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
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `role`, `email`, `mobile`, `status`) VALUES
(1, 'hardik', 'hardik', 1, 'hardikdodiya2410@gmail.com', '1234567890', 1),
(2, 'admin', 'admin', 0, '', '', 1),
(4, 'vinay', 'vinay', 1, 'vinay@gmail.com', '7285008403', 1),
(5, 'keval', 'keval', 1, 'kevaldodiya40@gmail.com', '8200500184', 1),
(7, 'meet', 'dfhfgh', 1, 'hardik@gmail.com', '7285008403', 1);

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
(13, 'Women', 1),
(14, 'men', 1);

-- --------------------------------------------------------

--
-- Table structure for table `color_master`
--

CREATE TABLE `color_master` (
  `id` int(11) NOT NULL,
  `color` varchar(200) NOT NULL,
  `order_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `color_master`
--

INSERT INTO `color_master` (`id`, `color`, `order_by`, `status`) VALUES
(1, 'red', 1, 1),
(2, 'black', 2, 1);

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
  `added_on` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(12, 'HARDIK', 'hardikdodiya2410@gmail.com', '0728500840', 'hi my name hardik and this website is perfect for colth rent', '04-03-2025 10:21:38'),
(13, 'HARDIK', 'hardikdodiya2410@gmail.com', '0728500840', 'hi my name hardik and this website is perfect for colth rent', '04-03-2025 10:24:07'),
(14, 'HARDIK', 'hardikdodiya2410@gmail.com', '0728500840', 'hi may name is hardik ', '04-03-2025 10:27:45'),
(15, 'HARDIK', 'hardikdodiya2410@gmail.com', '0728500840', 'hi may name is hardik ', '04-03-2025 10:29:15'),
(16, 'hardik', 'hardikdodiya2410@gmail.com', '7285008403', 'this website is perfect ', '05-03-2025 12:46:10'),
(17, 'jay', 'jay709604@gmail.com', '7096049904', 'this website is perfect for rent cloth ', '10-03-2025 12:54:48'),
(18, 'jay', 'jay709604@gmail.com', '7096049904', 'this website perfect for rent colth', '10-03-2025 12:58:31'),
(19, 'jay', 'jay709604@gmail.com', '7096049904', 'sdfgdfjghfkghdfskjghdfshghdfgh', '10-03-2025 01:02:08'),
(20, 'jay', 'jay709604@gmail.com', '7096049904', 'dhgfhjgfhgh', '10-03-2025 01:03:50'),
(21, 'jay', 'jay709604@gmail.com', '7096049904', 'fghgfh', '10-03-2025 01:07:08'),
(22, 'jay', 'jay709604@gmail.com', '7096049904', 'gnggng', '10-03-2025 01:08:46'),
(23, 'jay', 'jay709604@gmail.com', '7096049904', 'gnggng', '10-03-2025 01:11:04'),
(24, 'vinay', 'vinaydodiya22@gmail.com', '9537413107', 'this website is perfect for rent colth ', '10-03-2025 08:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_master`
--

CREATE TABLE `coupon_master` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `coupon_type` varchar(10) NOT NULL,
  `cart_min_value` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon_master`
--

INSERT INTO `coupon_master` (`id`, `coupon_code`, `coupon_value`, `coupon_type`, `cart_min_value`, `status`) VALUES
(1, 'first%5', 5, 'Percentage', 100, 1);

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
  `length` float NOT NULL,
  `breadth` float NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `txnid` varchar(200) NOT NULL,
  `mihpayid` varchar(200) NOT NULL,
  `ship_order_id` int(11) NOT NULL,
  `ship_shipment_id` int(11) NOT NULL,
  `payu_status` varchar(10) NOT NULL,
  `added_on` datetime NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `length`, `breadth`, `height`, `weight`, `txnid`, `mihpayid`, `ship_order_id`, `ship_shipment_id`, `payu_status`, `added_on`, `coupon_id`, `coupon_code`, `coupon_value`) VALUES
(1, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 400, 'success', 1, 0, 0, 0, 0, '322c2fefaf6afe3c6b80', '', 0, 0, '', '2025-03-08 03:48:59', 0, '', 0),
(2, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 200, 'success', 1, 0, 0, 0, 0, '7f738f7d3e05259b1e1c', '', 0, 0, '', '2025-03-08 03:54:30', 0, '', 0),
(3, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 500, 'success', 1, 0, 0, 0, 0, '0e6d57849c7d2c165659', '', 0, 0, '', '2025-03-08 03:56:36', 0, '', 0),
(4, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 300, 'success', 1, 0, 0, 0, 0, 'cda4ad83ef4f8562228b', '', 0, 0, '', '2025-03-08 04:06:54', 0, '', 0),
(5, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 400, 'success', 1, 0, 0, 0, 0, '9ab58236a1a4193b423e', '', 0, 0, '', '2025-03-08 04:09:07', 0, '', 0),
(6, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 300, 'success', 1, 0, 0, 0, 0, 'ace2018c188764605453', '', 0, 0, '', '2025-03-08 04:09:55', 0, '', 0),
(7, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 300, 'success', 1, 0, 0, 0, 0, 'fa0f01b51988b73a10e1', '', 0, 0, '', '2025-03-08 09:18:59', 0, '', 0),
(8, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 200, 'success', 1, 0, 0, 0, 0, 'c3f8ad799260497e34f8', '', 0, 0, '', '2025-03-08 09:20:05', 0, '', 0),
(9, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 100, 'success', 1, 0, 0, 0, 0, '2ad6aab62f1dd4b8ccfc', '', 0, 0, '', '2025-03-08 11:46:22', 0, '', 0),
(10, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 200, 'success', 1, 0, 0, 0, 0, '29cb30e838a48d980b1d', '', 0, 0, '', '2025-03-09 12:00:22', 0, '', 0),
(11, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 100, 'success', 1, 0, 0, 0, 0, 'ea8321caa26c6b8a582e', '', 0, 0, '', '2025-03-09 12:14:11', 0, '', 0),
(12, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 400, 'success', 1, 0, 0, 0, 0, '1093d9b964edd73ffefc', '', 0, 0, '', '2025-03-09 12:46:50', 0, '', 0),
(13, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 570, 'success', 1, 0, 0, 0, 0, '5cfd2bf22d42cf50c90d', '', 0, 0, '', '2025-03-09 02:16:29', 1, 'first%5', 30),
(14, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 900, 'success', 1, 0, 0, 0, 0, '11122d44cbefde2d0a8d', '', 0, 0, '', '2025-03-09 01:27:14', 0, '', 0),
(15, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 300, 'success', 1, 0, 0, 0, 0, '35313e3fe88e1fdaa8a0', '', 0, 0, '', '2025-03-09 02:14:07', 0, '', 0),
(16, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 400, 'success', 1, 0, 0, 0, 0, '87f044e337ca1a61912c', '', 0, 0, '', '2025-03-09 02:41:53', 0, '', 0),
(17, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 1000, 'success', 1, 0, 0, 0, 0, 'cac5e2df4075811eb283', '', 0, 0, '', '2025-03-09 09:05:31', 0, '', 0),
(18, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 100, 'success', 1, 0, 0, 0, 0, '7d770a913ea655ad0c38', '', 0, 0, '', '2025-03-09 09:07:42', 0, '', 0),
(19, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 300, 'success', 1, 0, 0, 0, 0, '31b376d1a702c9f8749a', '', 0, 0, '', '2025-03-09 10:15:07', 0, '', 0),
(20, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 200, 'success', 1, 0, 0, 0, 0, 'e9157d51809ba336a6a2', '', 0, 0, '', '2025-03-09 10:35:47', 0, '', 0),
(21, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 200, 'success', 1, 0, 0, 0, 0, 'e507fbe3b5c2e61ecced', '', 0, 0, '', '2025-03-09 10:42:25', 0, '', 0),
(22, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 300, 'success', 1, 0, 0, 0, 0, '01183cf82840b2191d96', '', 0, 0, '', '2025-03-09 10:50:47', 0, '', 0),
(23, 3, 'striroad', 'Bhavnagar', 364140, 'COD', 380, 'success', 1, 0, 0, 0, 0, 'ad150434ed2cc20320bb', '', 0, 0, '', '2025-03-10 12:33:07', 1, 'first%5', 20),
(24, 3, 'striroad', 'Bhavnagar', 364140, 'COD', 700, 'success', 1, 0, 0, 0, 0, '32a9dff4ee3a05fc40ac', '', 0, 0, '', '2025-03-10 12:37:58', 0, '', 0),
(25, 3, 'striroad', 'Bhavnagar', 364140, 'COD', 570, 'success', 1, 0, 0, 0, 0, 'b948be4c81fe76733fb1', '', 0, 0, '', '2025-03-10 12:43:41', 1, 'first%5', 30),
(26, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 95, 'success', 1, 0, 0, 0, 0, '66d2e0ad9e094822db84', '', 0, 0, '', '2025-03-10 05:24:33', 1, 'first%5', 5),
(27, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 1800, 'success', 1, 0, 0, 0, 0, '0bf3912b78dbd14d49f5', '', 0, 0, '', '2025-03-10 05:26:14', 0, '', 0),
(28, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 700, 'success', 4, 10, 10, 10, 10, '88aaef44ee59e0a5b024', '', 779451763, 775906521, '', '2025-03-10 05:26:56', 0, '', 0),
(29, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 600, 'Success', 5, 0, 0, 0, 0, '50846d6aff0628cc9142', '', 0, 0, '', '2025-03-10 06:27:10', 0, '', 0),
(30, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 285, 'Success', 5, 10, 10, 10, 10, '00006aefcf0e5e126010', '', 779443812, 775898576, '', '2025-03-10 06:29:32', 1, 'first%5', 15),
(31, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 380, 'Success', 5, 101, 101, 10, 10, 'bc4ce0cdb08b63d183b9', '', 779494328, 775949008, '', '2025-03-10 07:49:35', 1, 'first%5', 20),
(32, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 1100, 'Success', 5, 10, 10, 10, 10, 'af2f42d4156b71e79842', '', 779500519, 775955203, '', '2025-03-10 07:59:48', 0, '', 0),
(33, 4, 'shree pc parmar Chatra lay', 'Bhavngar', 364140, 'COD', 200, 'success', 1, 0, 0, 0, 0, '45a7ddeba4d7cd0e8d04', '', 0, 0, '', '2025-03-10 08:06:47', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `rent_from` date DEFAULT NULL,
  `rent_to` date DEFAULT NULL,
  `rental_days` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `product_attr_id`, `qty`, `rent_from`, `rent_to`, `rental_days`, `price`) VALUES
(1, 1, 1, 1, 2, NULL, NULL, 0, 200),
(2, 2, 1, 1, 1, NULL, NULL, 0, 200),
(3, 3, 1, 2, 1, NULL, NULL, 0, 300),
(4, 3, 2, 3, 1, NULL, NULL, 0, 200),
(5, 4, 2, 4, 1, NULL, NULL, 0, 300),
(6, 5, 2, 3, 2, NULL, NULL, 0, 200),
(7, 6, 2, 4, 1, NULL, NULL, 0, 300),
(8, 7, 2, 4, 1, NULL, NULL, 0, 300),
(9, 8, 1, 1, 1, NULL, NULL, 0, 200),
(10, 9, 6, 10, 1, NULL, NULL, 0, 100),
(11, 10, 6, 10, 2, NULL, NULL, 0, 100),
(12, 11, 6, 10, 1, NULL, NULL, 0, 100),
(13, 12, 6, 10, 4, NULL, NULL, 0, 100),
(14, 13, 6, 10, 6, NULL, NULL, 0, 100),
(15, 14, 1, 2, 3, NULL, NULL, 0, 300),
(16, 15, 6, 10, 3, NULL, NULL, 0, 100),
(17, 16, 2, 3, 2, NULL, NULL, 0, 200),
(18, 17, 7, 11, 10, NULL, NULL, 0, 100),
(19, 18, 7, 11, 1, NULL, NULL, 0, 100),
(20, 19, 2, 4, 1, '0000-00-00', '0000-00-00', 0, 300),
(21, 20, 7, 11, 2, '2025-03-09', '2025-03-19', 0, 100),
(22, 21, 7, 11, 2, '2025-03-10', '2025-03-13', 0, 100),
(23, 22, 7, 11, 3, '2025-03-11', '2025-03-13', 0, 100),
(24, 23, 7, 11, 1, '2025-03-10', '2025-03-15', 0, 100),
(25, 24, 7, 11, 1, '2025-03-22', '2025-03-30', 7, 100),
(26, 25, 1, 2, 1, '2025-03-12', '2025-03-15', 2, 300),
(27, 26, 6, 10, 1, '2025-03-11', '2025-03-13', 1, 100),
(28, 27, 1, 1, 3, '2025-03-11', '2025-03-15', 3, 200),
(29, 28, 6, 10, 1, '2025-03-15', '2025-03-23', 7, 100),
(30, 29, 2, 4, 1, '2025-03-11', '2025-03-14', 2, 300),
(31, 30, 2, 4, 1, '2025-03-11', '2025-03-13', 1, 300),
(32, 31, 2, 3, 1, '2025-03-11', '2025-03-14', 2, 200),
(33, 32, 7, 11, 1, '2025-03-11', '2025-03-14', 2, 100),
(34, 32, 6, 10, 1, '2025-03-11', '2025-03-21', 9, 100),
(35, 33, 7, 11, 1, '2025-03-11', '2025-03-14', 2, 100);

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
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `best_seller` int(11) NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `sub_categories_id`, `name`, `image`, `short_desc`, `description`, `best_seller`, `meta_title`, `meta_desc`, `meta_keyword`, `status`, `added_by`) VALUES
(1, 14, 16, 'sherwani', '367020829_208606723_WhatsApp Image 2024-12-28 at 14.51.36_9bad0eb0.jpg', 'sd', 'd', 1, 'meta title', 'md', 'mk', 1, 2),
(2, 13, 13, 'bridal lehenga', '908821947_121184725_WhatsApp Image 2024-12-28 at 14.42.57_449eae6d.jpg', 'asdt', 'ewrg', 0, 'wer', 'sdfg', 'sdfg', 1, 2),
(6, 14, 16, 'qty 1', '761686901_frontier1.jpg', 'redqty1', 'redqty1', 0, 'redqty1', 'redqty1', 'redqty1', 1, 2),
(7, 14, 16, 'same color', '281738075_azaleass3.jpg', 'shortr', 'sdfhf', 1, 'sdffh', 'fgh\r\nWarning:  Undefined variable $meta_desc in C:\\xampp\\htdocs\\ecom\\Admin\\manage_product.php on line 412', 'dfg', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `mrp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `size_id`, `color_id`, `mrp`, `price`, `qty`) VALUES
(1, 1, 1, 2, 100, 200, 1),
(2, 1, 2, 1, 200, 300, 1),
(3, 2, 3, 2, 100, 200, 1),
(4, 2, 4, 1, 200, 300, 1),
(10, 6, 1, 1, 100, 100, 1),
(11, 7, 1, 1, 100, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_images` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_images`) VALUES
(1, 1, '367020829_208606723_WhatsApp Image 2024-12-28 at 14.51.36_9bad0eb0.jpg'),
(2, 1, '889403741_frontier1.jpg'),
(3, 2, '908821947_121184725_WhatsApp Image 2024-12-28 at 14.42.57_449eae6d.jpg'),
(4, 3, '857974696_208606723_WhatsApp Image 2024-12-28 at 14.51.36_9bad0eb0.jpg'),
(5, 4, '910582773_ayshi3.jpeg'),
(6, 5, '410327213_ayshi1.jpeg'),
(7, 6, '761686901_frontier1.jpg'),
(8, 7, '281738075_azaleass3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `user_id`, `rating`, `review`, `status`, `added_on`) VALUES
(1, 6, 1, 'Very Good', 'this product is very good', 1, '2025-03-08 10:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `shiprocket_token`
--

CREATE TABLE `shiprocket_token` (
  `id` int(11) NOT NULL,
  `token` varchar(500) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shiprocket_token`
--

INSERT INTO `shiprocket_token` (`id`, `token`, `added_on`) VALUES
(1, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjU4NTg5NTMsInNvdXJjZSI6InNyLWF1dGgtaW50IiwiZXhwIjoxNzQyNDc1OTE3LCJqdGkiOiJtbk9MbUtBVXd2N0lFcHJ2IiwiaWF0IjoxNzQxNjExOTE3LCJpc3MiOiJodHRwczovL3NyLWF1dGguc2hpcHJvY2tldC5pbi9hdXRob3JpemUvdXNlciIsIm5iZiI6MTc0MTYxMTkxNywiY2lkIjo1NjQ4NTM1LCJ0YyI6MzYwLCJ2ZXJib3NlIjpmYWxzZSwidmVuZG9yX2lkIjowLCJ2ZW5kb3JfY29kZSI6IiJ9.frnaQnbFa2Ayc8ndJlwX-NaITgKqitVMuZ8v1zNLbps', '2025-03-10 01:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `size_master`
--

CREATE TABLE `size_master` (
  `id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size_master`
--

INSERT INTO `size_master` (`id`, `size`, `order_by`, `status`) VALUES
(1, 'S', 1, 1),
(2, 'M', 2, 1),
(3, 'X', 3, 1),
(4, 'Xl', 4, 1);

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
(12, 12, 'Leigha', 1),
(13, 13, 'Bridal-Lehenga', 1),
(14, 13, 'Designer-Lehenga', 1),
(15, 13, 'gown', 1),
(16, 14, 'sherwani', 1),
(17, 14, 'suit', 1),
(18, 14, 'blazer', 1),
(19, 14, 'tuxedo', 1),
(20, 15, 'Same-color', 1),
(21, 15, 'Different-color', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(2, 'bhavik', 'Bhavik@123', 'gohilbhavik182@gmail.com', '9157503526', '2025-03-07 12:42:31'),
(3, 'jay', 'hardik', 'jay709604@gmail.com', '7096049904', '2025-03-10 08:00:55'),
(8, 'Hardik', 'Hardik@123', 'vinaydodiya22@gmail.com', '7285008403', '2025-03-10 08:35:13');

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
(112, 30, 2, '2025-03-03 12:20:41');

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
-- Indexes for table `color_master`
--
ALTER TABLE `color_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_master`
--
ALTER TABLE `coupon_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shiprocket_token`
--
ALTER TABLE `shiprocket_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size_master`
--
ALTER TABLE `size_master`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `color_master`
--
ALTER TABLE `color_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `coupon_master`
--
ALTER TABLE `coupon_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shiprocket_token`
--
ALTER TABLE `shiprocket_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size_master`
--
ALTER TABLE `size_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
